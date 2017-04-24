<?php

use PayPal\EBLBaseComponents\SetExpressCheckoutRequestDetailsType;
use PayPal\EBLBaseComponents\BillingAgreementDetailsType;
use PayPal\Service\PayPalAPIInterfaceServiceService; 
use PayPal\PayPalAPI\SetExpressCheckoutRequestType;
use PayPal\PayPalAPI\SetExpressCheckoutReq;
use PayPal\PayPalAPI\CreateBillingAgreementRequestType;
use PayPal\PayPalAPI\GetExpressCheckoutDetailsReq;
use PayPal\PayPalAPI\GetExpressCheckoutDetailsRequestType;
use PayPal\CoreComponentTypes\BasicAmountType;
use PayPal\EBLBaseComponents\PaymentDetailsType;
use PayPal\EBLBaseComponents\DoReferenceTransactionRequestDetailsType;
use PayPal\PayPalAPI\DoReferenceTransactionRequestType;
use PayPal\PayPalAPI\DoReferenceTransactionReq;
use PayPal\PayPalAPI\RefundTransactionReq;
use PayPal\PayPalAPI\RefundTransactionRequestType;


use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Invoice;
use PayPal\Api\MerchantInfo;
use PayPal\Api\BillingInfo;
use PayPal\Api\InvoiceItem;
use PayPal\Api\Currency;
use PayPal\Api\PaymentDetail;

use Carbon\Carbon;

/**
 * Library for handle paypall transaction for winjob.
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Winjob_paypal {
    
    //https://developer.paypal.com/docs/classic/express-checkout/integration-guide/ECReferenceTxns/#step1
    public function init_billing_agreement_without_charge()
    {
        $returnUrl       = base_url('pay/get_paypal_express_checkout');
        $cancelUrl       = base_url('pay/set_paypal_express_checkout');
        $currencyCode    = "USD";
        
        //Initialize all the necessary variable see the documentation from the above url.
        $setECReqDetails         = new SetExpressCheckoutRequestDetailsType();
        $setECReqType            = new SetExpressCheckoutRequestType();
        $setECReq                = new SetExpressCheckoutReq();
        $billingAgreementDetails = new BillingAgreementDetailsType("MerchantInitiatedBilling");	
	
        $setECReqDetails->CancelURL = $cancelUrl;
        $setECReqDetails->ReturnURL = $returnUrl;
        
        // Billing agreement details
        $billingAgreementDetails->BillingAgreementDescription = 'Billing agreement for hourly contract';
        
        $setECReqDetails->BillingAgreementDetails       = array($billingAgreementDetails);
        $setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
        $setECReq->SetExpressCheckoutRequest            = $setECReqType;
        return  $this->get_paypal_service()->SetExpressCheckout($setECReq);
    }
    
    public function create_billing_agreement_without_charge( $token ){
        
        $createBAReqType        = new CreateBillingAgreementRequestType();
        $createBAReq            = new \PayPal\PayPalAPI\CreateBillingAgreementReq();
        
        $createBAReqType->Token = $token;
        $createBAReq->CreateBillingAgreementRequest = $createBAReqType;
        return  $this->get_paypal_service()->CreateBillingAgreement($createBAReq);
    }
    
    public function get_billing_agreement_customer_detail( $token )
    {
        $getExpressCheckoutDetailsRequest = new GetExpressCheckoutDetailsRequestType($token);
        $getExpressCheckoutReq            = new GetExpressCheckoutDetailsReq();
        
        $getExpressCheckoutReq->GetExpressCheckoutDetailsRequest = $getExpressCheckoutDetailsRequest;
        $result =  $this->get_paypal_service()->GetExpressCheckoutDetails( $getExpressCheckoutReq );
        return $result->GetExpressCheckoutDetailsResponseDetails;
    }
    
    public function get_paypal_service()
    {   
        \PayPal\Core\PPHttpConfig::$DEFAULT_CURL_OPTS[CURLOPT_SSLVERSION] = 1;
        
        $config = array(
            "acct1.UserName"    =>  "seller.test_api1.haseeburrehman.com",
            "acct1.Password"    =>  "HY6ENM7SA5SNFQNA",
            "acct1.Signature"   =>  "AFcWxV21C7fd0v3bYYYRCpSSRl31AnJosL9DcfX40xgafuxK5ReHIdQB",
            "acct1.CertPath"    =>  APPPATH . "librairies/cert_key.pem",
            "log.FileName"      =>  APPPATH . "logs/paypal.log",
            "mode"              => "sandbox",
            "log.LogEnabled"    => true,
            "validation.level"  => "log",
            "log.LogLevel"      => "INFO",
        );
        
        $wrapper =  new PayPalAPIInterfaceServiceService( $config );
        
        return $wrapper;
    }
    
    public function execute_agreement()
    {
        
    }
    
    
    public function create_invoice( $invoices, $service  )
    {
        if(empty($invoices) && ! is_array($invoices)) return null;
        
        $now = Carbon::now(new DateTimeZone('UTC'));
        
        $paypal_invoice = $this->_build_empty_invoice( "Weekly invoice for active hourly contracts - " . date("d-m-Y H:i:s", $now->timestamp) );
        
        // Merchant Info
        $paypal_invoice->getMerchantInfo()
            ->setEmail( PAYPAL_MERCHANT_EMAIL )
            ->setbusinessName( PAYPAL_BUSINESS_NAME );
                
        $billing = $paypal_invoice->getBillingInfo();
        $billing[0]->setEmail( $service->service_description );
        
        $all_items      = array();
        
        foreach( $invoices as $invoice)
        {
            $item = new InvoiceItem();
            $item
                ->setName( $invoice['description'] )
                ->setDescription( $invoice['description'] )
                ->setQuantity( 1 )
                ->setUnitPrice(new Currency());

            $item->getUnitPrice()
                ->setCurrency("USD")
                ->setValue( $invoice['amount'] );
            
            $all_items[] = $item;
        }
        
        
        $paypal_invoice->setItems( $all_items );
        
        try 
        {
            $paypal_invoice->create( $this->_get_api_rest_context() );
            return $paypal_invoice->getId();
        } 
        catch (Exception $ex) 
        {
            log_message('error', 'Error when creating an invoice ' . $ex->getMessage());
        }
        
        return null;
    }
    
    private function _build_empty_invoice( $note )
    {
        $invoice = new Invoice();
        
        $invoice
            ->setMerchantInfo(new MerchantInfo())
            ->setBillingInfo(array(new BillingInfo()))
            ->setNote($note);
        
        return $invoice;
    }
    
    public function pay_invoice( $invoice_id, $service )
    {
        $invoice = $this->get_invoice( $invoice_id );
        
        if( $invoice == null ) //return null transaction
            return null;
        
        $amount_to_paid = $invoice->getTotalAmount();
        
        //Process payment of the current invoice.
        $amount = new BasicAmountType($amount_to_paid->getCurrency(), $amount_to_paid->getValue());
        
        // Information about the payment.
        $paymentDetails                = new PaymentDetailsType();
        $paymentDetails->OrderTotal    = $amount;
        $paymentDetails->NotifyURL     = site_url( PAYPAL_IPN_NOTIFY_URL );
        
        $RTRequestDetails = new DoReferenceTransactionRequestDetailsType();
        
        $RTRequestDetails->PaymentDetails = $paymentDetails;
        $RTRequestDetails->ReferenceID    = $service->service_payer_id;
        $RTRequestDetails->PaymentAction  = 'Sale';
        $RTRequestDetails->PaymentType    = 'Any';
        
        $RTRequest = new DoReferenceTransactionRequestType();
        $RTRequest->DoReferenceTransactionRequestDetails  = $RTRequestDetails;

        $RTReq = new DoReferenceTransactionReq();
        $RTReq->DoReferenceTransactionRequest = $RTRequest;
        
        try 
        {
            $RTResponse = $this->get_paypal_service()->DoReferenceTransaction($RTReq);
            
            if( strtolower($RTResponse->Ack) == 'success' ){
                
                $transaction    = $RTResponse->DoReferenceTransactionResponseDetails;
                $transaction    = $transaction->PaymentInfo;
                
                $transaction_id = $transaction->TransactionID;
                if( strtolower($transaction->PaymentStatus) == "completed")
                {
                    //mark invoice as paid
                    if($this->mark_invoice_as_paid($invoice, $transaction))
                    {
                        return $transaction_id;
                    }
                }
            }
        }
        catch (Exception $ex) 
        {   
            log_message('error', 'Error when creating an invoice ' . $ex->getMessage());
        }
        return null;
    }
    
    public function get_invoice( $invoice_id )
    {
        try {
            return Invoice::get($invoice_id, $this->_get_api_rest_context());
        } catch (Exception $ex) {
            log_message('error', 'Error when retreiving an invoice ' . $ex->getMessage());
        }
        return null;
    }
    
    public function mark_invoice_as_paid( $invoice, $payment_infos )
    {        
        try {
            
            $record       = new PaymentDetail();
            $record->setMethod('PAYPAL');
            $record->setDate(date("Y-m-d H:i:s T", strtotime($payment_infos->PaymentDate)));
            $record->setNote("Successfull payment.");
            
            return $invoice->recordPayment($record, $this->_get_api_rest_context());
            
        } catch (Exception $ex) {
            log_message('error', 'Error when marking an invoice ' . $invoice->getId() . ' as paid ' . $ex->getMessage());
        }
        return false;
    }
    
    public function paid($amount, $currency, $service)
    {
        //Process payment of the current invoice.
        $amount = new BasicAmountType(strtoupper($currency), $amount * 100);
        
        // Information about the payment.
        $paymentDetails                = new PaymentDetailsType();
        $paymentDetails->OrderTotal    = $amount;
        $paymentDetails->NotifyURL     = site_url( PAYPAL_IPN_NOTIFY_URL );
        
        $RTRequestDetails = new DoReferenceTransactionRequestDetailsType();
        
        $RTRequestDetails->PaymentDetails = $paymentDetails;
        $RTRequestDetails->ReferenceID    = $service->service_payer_id;
        $RTRequestDetails->PaymentAction  = 'Sale';
        $RTRequestDetails->PaymentType    = 'Any';
        
        $RTRequest = new DoReferenceTransactionRequestType();
        $RTRequest->DoReferenceTransactionRequestDetails  = $RTRequestDetails;

        $RTReq = new DoReferenceTransactionReq();
        $RTReq->DoReferenceTransactionRequest = $RTRequest;
        
        try 
        {
            $RTResponse = $this->get_paypal_service()->DoReferenceTransaction($RTReq);
            
            if( strtolower($RTResponse->Ack) == 'success' )
            {   
                $transaction    = $RTResponse->DoReferenceTransactionResponseDetails;
                return $transaction->TransactionID;
            }
        }
        catch (Exception $ex) 
        {   
            log_message('error', 'Error when charging the client #' . $service->service_payer_id . ' ' . $ex->getMessage());
        }
        return null;
    }
    
    public function refund($transaction_id)
    {
        $refundRequest = new RefundTransactionRequestType();
        $refundRequest->RefundType = 'FULL';
        $refundRequest->TransactionID = $transaction_id;
        
        $refundReq = new RefundTransactionReq();
        $refundReq->RefundTransactionRequest = $refundRequest;
        
        try 
        {
            /* wrap API method calls on the service object with a try catch */
            $refundResponse = $this->get_paypal_service()->RefundTransaction($refundReq);
            
            if(isset($refundResponse) && strtolower($refundResponse->Ack) == 'success' ) 
            {
                return true;
            }
        } catch (Exception $ex) {
            log_message('error', 'Error when refunding the client for transaction #' . $transaction_id . ' ' . $ex->getMessage());
        }
        
        return false;
    }
    
    private function _get_api_rest_context()
    {
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                PAYPAL_CLIENT_ID,
                PAYPAL_CLIENT_SECRET
            )
        );

        $apiContext->setConfig(
            array(
                'mode'           => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName'   => APPPATH . 'logs/paypal.log',
                'log.LogLevel'   => 'FINE', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled'  => true,
            )
        );
        
        return $apiContext;
    }
}
