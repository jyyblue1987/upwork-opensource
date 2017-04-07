<?php

use Carbon\Carbon;

/**
 * This controller will help to handle daily charging for hourly contract.
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

            $now                 = Carbon::now();
            $now->timezone       = new DateTimeZone('UTC');
            $startOfWeek         = date('Y-m-d H:i:s' , $now->copy()->startOfWeek()->timestamp ); 
            $endOfWeek           = date('Y-m-d H:i:s' , $now->copy()->endOfWeek()->timestamp );
            
            $invoices_items = $this->invoice_model->load_all_unpaid($startOfWeek, $endOfWeek);
            
            if(empty($invoices_items)) return; 
            
            $invoices_group_by_client = $this->_group_by_employer( $invoices_items );
            
            if( $invoices_group_by_client == null ) return;
            
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
                $invoice_service    = $this->{$service_library}->create_invoice( $invoices['invoices'], $primary );
                $transaction_id     = $this->{$service_library}->pay_invoice( $invoice_service->id );
                
                $status = ( $transaction_id == null ? INVOICE_PROCESSING_PAID : INVOICE_PAID );
                $invoice_id = $this->invoice_model->save_invoice(array(
                                    'service_name'       => $primary->service_name,
                                    'invoice_service_id' => $invoice_service->id,
                                    'transaction_id'     => $transaction_id,
                                    'status'             => $status
                                ));
                
                $this->invoice_model->update_invoices_items($startOfWeek, $endOfWeek, $invoices['bid_ids'], $invoice_id, $status);
            }
        }                
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
    
    
    private function _daily_charge( $working_date )
    {
        $diaries = $this->contracts_model->get_all_work_diary_of( $working_date );
                
        if( ! empty($diaries) )
        {
            foreach( $diaries as $key => $diary)
            {
                $bid_amount  = ( ! empty($diary->offer_bid_amount) ? $diary->offer_bid_amount : $diary->bid_amount);
                $amount      = $diary->total_hour * $bid_amount;
                $user_id     = $diary->cuser_id;
                
                $transaction = array(
                    'contract_id'  => $diary->contact_id,
                    'fuser_id'     => $diary->fuser_id,
                    'cuser_id'     => $diary->cuser_id,
                    'currency'     => 'usd',
                    'amount'       => $amount,
                    'des'          => $diary->total_hour . 'hrs*$' . $bid_amount,
                    'date'         => date('Y-m-d H:i:s' , $now->timestamp )
                );
                
                $primary_payment_method = $this->payment_methods_model->get_primary_method_payment();
                
                pl( $primary_payment_method );
                
                if( $primary_payment_method  )
                {
                    $chargeUser  = chargePrimary($user_id, $amount);
                    
                    $transaction += array(
                        'trans_through'  => $primary_payment_method,
                        'transaction_id' => ( isset($chargeUser['transaction_id']) ? $chargeUser['transaction_id'] : '' )
                    );
                    
                    if( $chargeUser['status_code'] == 1 )//Transaction failed.
                    {
                        $transaction['status'] = 'Pending';
                        $this->webuser_model->desactived( $user_id, 1 );
                        //set failed transaction message through mailing service (transaction failed)
                        
                    }
                    else
                    {
                        $transaction['status'] = 'Processed';
                    }
                }
                else
                {   
                    $transaction += array(
                        'trans_through'  => 'not set',
                        'transaction_id' => '',
                        'status'         => "Failed"
                    );
                    $this->webuser_model->desactived( $user_id, 1 );
                    //set failed transaction message through mailing service (No primary payment method)
                }
                
                log_message("INFO", 'log transaction item');
                log_message("INFO", json_encode($transaction, JSON_PRETTY_PRINT, 512));
                
                $this->payment_model->save_transaction( $transaction );
            }
        }
        else
        {
            log_message("INFO", 'No Hourly payment to handle today');
        }
    }
}
