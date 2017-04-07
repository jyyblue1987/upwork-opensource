<?php

\Stripe\Stripe::setApiKey(STRIPE_SK);

/**
 * Description of Winjob_stripe
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Winjob_stripe {
    
    public function create_invoice( $invoices, $service )
    {   
        if(empty($invoices) && ! is_array($invoices)) return null;
        
        foreach( $invoices as $invoice)
        {
            $stripe_invoice_item = \Stripe\InvoiceItem::create(array(
                                        "customer"    => $service->service_payer_id,
                                        "amount"      => $invoice['amount'],
                                        "currency"    => $invoice['currency'],
                                        "description" => $invoice['description']
                                    ));
        }
        
        return \Stripe\Invoice::create(array( "customer" => $service->service_payer_id ));
    }
    
    public function update_invoice( $invoice )
    {
        dump( $invoice, true);
    }
    
    public function pay_invoice( $invoice_id )
    {
        $invoice = \Stripe\Invoice::retrieve( $invoice_id );
        $result  = $invoice->pay();
        return $result->charge;
    }
}
