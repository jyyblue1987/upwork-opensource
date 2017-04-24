<?php

\Stripe\Stripe::setApiKey(STRIPE_SK);

use Carbon\Carbon;
use Stripe\Error;

/**
 * Description of Winjob_stripe
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Winjob_stripe {
    
    public function create_invoice( $invoices, $service )
    {   
        if(empty($invoices) && ! is_array($invoices)) return null;
        
        try
        {
            foreach( $invoices as $invoice)
            {
                $stripe_invoice_item = \Stripe\InvoiceItem::create(array(
                                            "customer"    => $service->service_payer_id,
                                            "amount"      => $invoice['amount'],
                                            "currency"    => $invoice['currency'],
                                            "description" => $invoice['description']
                                        ));
            }

            $invoice =  \Stripe\Invoice::create(array( "customer" => $service->service_payer_id ));

            //Close invoice to avoid stripe to charge amount automatically.
            $invoice->closed = true;
            $invoice->save();

            return $invoice->id;
        } 
        catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
        }
        
        return null;
    }
    
    public function pay_invoice( $invoice_id, $service )
    {   
        try
        {
            $invoice = $this->get_invoice( $invoice_id );
                    
            if( $invoice == null ) //return null transaction
                return null;
            
            $now = Carbon::now(new DateTimeZone('UTC'));

            //charge stripe account. 
            $charge =   \Stripe\Charge::create(array(
                            "amount"      => $invoice->amount_due,
                            "currency"    => "usd",
                            "customer"    => $service->service_payer_id,
                            "description" => "Weekly charge for active hourly contracts - " . date("d-m-Y H:i:s", $now->timestamp)
                        ));

            if( ! empty($charge) ) {
                $invoice->forgiven = true;
                $invoice->save();
                return $charge->id;
            }
            
        } 
        catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
        }
        
        return null;
    }
    
    public function get_invoice( $invoice_id )
    {
        try {
            return \Stripe\Invoice::retrieve( $invoice_id );
        } catch (Exception $ex) {
            log_message('error', 'Error when retreiving an invoice ' . $ex->getMessage());
        }
        return null;
    }
    
    public function refund($charge_id)
    {
        try 
        {
            $re = \Stripe\Refund::create(array( "charge" => $charge_id ));
            
            if(!empty($re))
            {
                return true;
            }
        } 
        catch (Exception $ex)
        {
            log_message('error', 'Error when refund a charge #' . $charge_id . $ex->getMessage());
        }
        
        return false;
    }
    
    public function paid($amount, $currency, $service)
    {
        $now = Carbon::now(new DateTimeZone('UTC'));

        try
        {
            //charge stripe account. 
            $charge =   \Stripe\Charge::create(array(
                            "amount"      => $amount * 100,
                            "currency"    => $currency,
                            "customer"    => $service->service_payer_id,
                            "description" => "Offer's payment for fixed job - " . date("d-m-Y H:i:s", $now->timestamp)
                        ));
            
            if(!empty($charge))
                return $charge->id;
        }
        catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
        }
        return null;
    }
}
