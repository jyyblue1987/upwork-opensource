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
        $this->load->model( array('contracts_model', 'payment_model', 'payment_methods_model', 'webuser_model') );
        
        //Enable logging informations.
        $this->config->set_item('log_threshold', 3);
    }
    
    public function daily()
    {
        if(is_cli())
        {
            log_message("INFO", 'Daily payment process launched.');

            $now                 = Carbon::now();
            $now->timezone       = new DateTimeZone('UTC');
            $working_date        = date('Y-m-d' , $now->timestamp ); 

            $this->_charge_failed_transaction( $working_date );

            $this->_daily_charge( $working_date );    
        }                
    }
    
    private function _charge_failed_transaction( $working_date )
    {
        $transactions = $this->payment_model->get_failed_transaction();
        
        foreach( $transactions as $key => $transaction ){
            
        }
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
