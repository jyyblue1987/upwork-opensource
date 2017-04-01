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
        //\PayPal\Core\PPHttpConfig::$DEFAULT_CURL_OPTS[CURLOPT_SSLVERSION] = 1;
        
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
    
}
