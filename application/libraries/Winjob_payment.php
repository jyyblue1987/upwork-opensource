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
    
    public function invoice( $invoice, $total_hour, $contract_amount  )
    {
        if( ! empty( $invoice['id'] ) &&   ! empty( $invoice['invoice_id'] ) )
        {
            $this->update_invoice( $invoice, $total_hour, $contract_amount   );
        }
        else
        {
            $this->create_invoice( $invoice, $total_hour, $contract_amount  );
        }
    }
    
    public function update_invoice( $invoice, $total_hour, $contract_amount  )
    {
        $this->get_payment_service()->update_invoice( $invoice, $total_hour, $contract_amount  );
    }
    
    public function create_invoice( $invoice, $total_hour, $contract_amount  )
    {
        $this->get_payment_service()->create_invoice( $invoice, $total_hour, $contract_amount  );
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
