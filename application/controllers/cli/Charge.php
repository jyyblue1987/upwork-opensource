<?php

use Carbon\Carbon;

/**
 * This controller will help to handle charging for hourly contract.
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Charge extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->helper('cli');
        $this->load->model( array('invoice_model', 'payment_model', 'payment_methods_model', 'webuser_model') );
        
        //Enable logging informations.
        $this->config->set_item('log_threshold', 3);
    }
    
    public function invoices_in_failures()
    {   
        if(is_cli())
        {
            log_message("INFO", 'Try to process all failed processed invoices.');
            
            $invoices_failures = $this->invoice_model->get_invoices_in_processing_failure();
        
            if(empty($invoices_failures)) return; 
            
            pl_array($invoices_failures);

            $account_to_activate = array(); 

            foreach( $invoices_failures as $key => $invoice )
            {
                $employer_id = $invoice->webuser_id; 

                //get employer primary method for charging.
                $primary = $this->payment_methods_model->get_primary( $employer_id );

                if( empty( $primary ) ) continue;

                //load related library
                $service_library = 'winjob_' . strtolower($primary->service_name);
                if( ! property_exists($this, $service_library) )
                    $this->load->library($service_library);

                //process payment through primary service.
                $transaction_id = $this->{$service_library}->paid_invoice( $invoice->invoice_service_id );
                
                if( $transaction_id )
                {
                    if( ! in_array( $user_id, $account_to_activate ) )
                        array_push ($account_to_activate, $employer_id);

                    $this->invoice_model->set_status($invoice->invoice_service_id, $transaction_id, INVOICE_PAID);
                }
                else
                {
                    $this->invoice_model->set_status($invoice->invoice_service_id, INVOICE_PROCESSING_PAID);

                    $keys = array_keys($account_to_activate, $employer_id);

                    if( count($keys) )
                    {
                        foreach($keys as $key)
                            unset( $account_to_activate[$key] );
                    }
                }
            }

            //Activate all account successfully charged.
            if( count($account_to_activate) > 0 )
                $this->webuser_model->activated_all( $account_to_activate );
        }
    }
    
    public function hourly_invoices_items()
    {
        if(is_cli())
        {
            log_message("INFO", 'General invoice and payment processing launched.');

            //Get all unpaid invoice item from the last week.
            $now                 = Carbon::now();
            $now->timezone       = new DateTimeZone('UTC');
            $startOfWeek         = date('Y-m-d H:i:s' , $now->copy()->startOfWeek()->timestamp ); 
            $endOfWeek           = date('Y-m-d H:i:s' , $now->copy()->endOfWeek()->timestamp );
            
            $invoices_items = $this->invoice_model->load_all_unpaid($startOfWeek, $endOfWeek);
            
            if(empty($invoices_items)) return; 
            
            $invoices_group_by_client = $this->_group_by_employer( $invoices_items );
            
            if( $invoices_group_by_client == null ) return;
            
            //array to handle account to deactivate later.
            $account_to_deactived = array();
                    
            foreach( $invoices_group_by_client as $employer_id => $invoices )
            {   
                //get employer primary method for charging.
                $primary = $this->payment_methods_model->get_primary( $employer_id );
                
                if( empty( $primary ) ) continue;
                
                //load related library
                $service_library = 'winjob_' . strtolower($primary->service_name);
                if( ! property_exists($this, $service_library) )
                    $this->load->library($service_library);
                
                //create an invoice
                $invoice_service_id = $this->{$service_library}->create_invoice( $invoices['invoices'], $primary );
                
                if($invoice_service_id == null) continue;
                
                $transaction_id     = $this->{$service_library}->pay_invoice( $invoice_service_id, $primary );
                                
                $status     = ( $transaction_id == null ? INVOICE_PROCESSING_PAID : INVOICE_PAID );
                $invoice_id = $this->invoice_model->save_invoice(array(
                                    'service_name'       => $primary->service_name,
                                    'invoice_service_id' => $invoice_service_id,
                                    'transaction_id'     => $transaction_id,
                                    'status'             => $status
                                ));
                
                $this->invoice_model->update_invoices_items($startOfWeek, $endOfWeek, $invoices['bid_ids'], $invoice_id, $status);
                
                if($status == INVOICE_PROCESSING_PAID)
                    $account_to_deactived[] = $employer_id;
            }
            
            if(count($account_to_deactived))
            {
                $this->webuser_model->deactivated_all( $account_to_activate );
            }
        }                
    }
    
    public function handle_paypal_ipn()
    {
        file_put_contents(__DIR__ . '/log.txt', PHP_EOL . json_encode($this->input->input_stream(), JSON_PRETTY_PRINT, 512) . PHP_EOL, FILE_APPEND);
    }
    
    private function _group_by_employer( $invoices_items )
    {
        if( empty( $invoices_items ) ) return null; 
        
        $invoices = array();
        
        foreach( $invoices_items as $item )
        {
            //Invoice items
            $invoices[ $item->webuser_id ]["invoices"][] = array(
                'amount'      => $item->amount_due * 100,
                'currency'    => 'usd',
                'description' => $item->description,
            );
            $invoices[ $item->webuser_id ]["bid_ids"][] = $item->bid_id;
        }
        
        return $invoices;
    }
}
