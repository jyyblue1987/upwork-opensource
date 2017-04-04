<?php

defined('BASEPATH') || exit('No direct script access allowed'); 

use PayPal\EBLBaseComponents\SetExpressCheckoutRequestDetailsType;
use PayPal\EBLBaseComponents\BillingAgreementDetailsType;
use PayPal\Service\PayPalAPIInterfaceServiceService; 
use PayPal\PayPalAPI\SetExpressCheckoutRequestType;
use PayPal\PayPalAPI\SetExpressCheckoutReq;
use PayPal\PayPalAPI\CreateBillingAgreementRequestType;
use PayPal\PayPalAPI\GetExpressCheckoutDetailsReq;
use PayPal\PayPalAPI\GetExpressCheckoutDetailsRequestType;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Invoice;
use PayPal\Api\MerchantInfo;
use PayPal\Api\BillingInfo;
use PayPal\Api\PaymentTerm;
use PayPal\Api\ShippingInfo;
use PayPal\Api\InvoiceItem;
use PayPal\Api\Currency;

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
    
    
    public function create_invoice( $invoice, $total_hour, $contract_amount  )
    {
        $paypal_invoice = $this->_build_empty_invoice( $invoice['description'] );
        
        // Merchant Info
        $paypal_invoice->getMerchantInfo()
            ->setEmail( PAYPAL_PAYMENT_RECEIVER )
            ->setbusinessName( PAYPAL_BUSINESS_NAME );
        
        $item = new InvoiceItem();
        $item
            ->setName( $invoice['description'] )
            ->setQuantity( $total_hour )
            ->setUnitPrice(new Currency());

        $item->getUnitPrice()
            ->setCurrency("USD")
            ->setValue( $contract_amount );
        
        $paypal_invoice->setItems( array( $item ) );
        
        try 
        {
            // ### Create Invoice
            $paypal_invoice->create( $this->_get_api_rest_context() );
            return $paypal_invoice->getId();
        } 
        catch (Exception $ex) 
        {
            log_message('error', 'Error when creating an invoice ' . $ex->getMessage());
        }
    }
    
    private function _build_empty_invoice( $note )
    {
        $invoice = new Invoice();
        
        $invoice
            ->setMerchantInfo(new MerchantInfo())
            ->setNote($note);
        
        return $invoice;
    }
    
    public function update_invoice( $invoice ){
        dump( $invoice, true);
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
                'log.LogLevel'   => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled'  => true,
            )
        );
        
        return $apiContext;
    }
}
