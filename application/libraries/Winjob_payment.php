<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Winjob_payment
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Winjob_payment 
{   
    private $payment_service;
    
    public function invoice( $contract_id, $invoice )
    {
        if( ! empty( $invoice->id ) )
        {
            $this->update_invoice( $invoice->id, $invoice->invoice_infos  );
        }
        else
        {
            $this->create_invoice( $invoice->invoice_infos );
        }
    }
    
    public function update_invoice( $invoice_id, $invoice_infos )
    {
        $this->get_payment_service()->update_invoice( $invoice_id, $invoice_infos );
    }
    
    public function create_invoice()
    {
        $this->get_payment_service()->create_invoice( $invoice_infos );
    }
    
    public function set_payment_service( $payment_service )
    {
        $this->payment_service = $payment_service;
    }
    
    public function get_payment_service()
    {
        return $this->payment_service;
    }
}
