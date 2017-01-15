<?php

\Stripe\Stripe::setApiKey(STRIPE_SK);

use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Service\AdaptivePaymentsService;
use PayPal\Types\AP\PreapprovalRequest;
use PayPal\Types\Common\RequestEnvelope;
use PayPal\CoreComponentTypes\BasicAmountType;
use PayPal\EBLBaseComponents\AddressType;
use PayPal\EBLBaseComponents\BillingAgreementDetailsType;
use PayPal\EBLBaseComponents\PaymentDetailsItemType;
use PayPal\EBLBaseComponents\PaymentDetailsType;
use PayPal\EBLBaseComponents\SetExpressCheckoutRequestDetailsType;
use PayPal\PayPalAPI\SetExpressCheckoutReq;
use PayPal\PayPalAPI\SetExpressCheckoutRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;

// 0 = default protocol (likely TLSv1), 1 = TLSv1; unsafe: 2 = SSLv2, 3 = SSLv3
\PayPal\Core\PPHttpConfig::$DEFAULT_CURL_OPTS[CURLOPT_SSLVERSION] = 1;

class Configuration {

    // For a full list of configuration parameters refer in wiki page (https://github.com/paypal/sdk-core-php/wiki/Configuring-the-SDK)
    public static function getConfig() {
        $config = array(
            // values: 'sandbox' for testing
            //		   'live' for production
            //         'tls' for testing if your server supports TLSv1.2
            "mode" => "sandbox"
                // TLSv1.2 Check: Comment the above line, and switch the mode to tls as shown below
                // "mode" => "tls"
                // These values are defaulted in SDK. If you want to override default values, uncomment it and add your value.
                // "http.ConnectionTimeOut" => "5000",
                // "http.Retry" => "2",
        );
        return $config;
    }

    // Creates a configuration array containing credentials and other required configuration parameters.
    public static function getAcctAndConfig() {
        $config = array(
            // Signature Credential
            //"acct1.UserName" => "jb-us-seller_api1.paypal.com",
            //"acct1.Password" => "WX4WTU3S8MY44S7F",
            //"acct1.Signature" => "AFcWxV21C7fd0v3bYYYRCpSSRl31A7yDhhsPUU2XhtMoZXsWHFxu-RWy",
            //"acct1.AppId" => "APP-80W284485P519543T"
            //sandbox hr
            "acct1.UserName" => PAYPAL_API_USER,
            "acct1.Password" => PAYPAL_API_PASS,
            "acct1.Signature" => PAYPAL_API_SIGN,
            //"acct1.AppId" => "APP-80W284485P519543T",
            // Sample Certificate Credential
            // "acct1.UserName" => "certuser_biz_api1.paypal.com",
            // "acct1.Password" => "D6JNKKULHN3G5B8A",
            // Certificate path relative to config folder or absolute path in file system
            "acct1.CertPath" => "https://www.paypal-knowledge.com/resources/sites/PAYPAL/content/live/FAQ/1000/FAQ1772/en_US/www.sandbox.paypal.com_SHA-2_09292017.pem",
                // "acct1.AppId" => "APP-80W284485P519543T"
        );
        return array_merge($config, self::getConfig());
        ;
    }

}

if (!function_exists('hr_curl_post')) {

    function hr_curl_post($url, $fields) {
        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

}
if (!function_exists('chargePrimary')) {

    function chargePrimary($user_id, $amount, $currency = "usd") {
        $output = array();
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('billingmethodlist');
        $CI->db->where('billingmethodlist.belongsTo', $user_id);
        $CI->db->where('billingmethodlist.isPrimary', "1");
        $result = $CI->db->get()->result();

        if (empty($result)) {
            return 1;
        }
        // var_dump($user_id);die();
        if ($result[0]->paymentMethod == "stripe") {
            $chargeUser = stripeCharge($result[0]->attachedTo, $user_id, $amount, $currency);
            if ($chargeUser['status']) {
                $status = "ok"; //valid values are (ok, error)
                $status_code = "0";
                $status_message = "charge_successful";
            } else {
                $status = "error";
                $status_code = "1";
                $status = "charge_unsuccessful";
            }
        } elseif ($result[0]->paymentMethod == "paypal") {
            $chargeUser = paypalCharge($result[0]->attachedTo, $user_id, $amount, $currency);
            if ($chargeUser['status']) {
                $status = "ok"; //valid values are (ok, error)
                $status_code = "0";
                $status_message = "charge_successful";
            } else {
                $status = "error";
                $status_code = "1";
                $status_message = "charge_unsuccessful";
            }
        } else {
            $status = "error";
            $status_code = "9";
        }
       // var_dump($chargeUser['transaction_id']);
        $output = array(
            'status' => $status,
            'status_code' => $status_code,
            'status_message' => $status_message,
            'transaction_id' => $chargeUser['transaction_id']
        );
        return $output;
    }

}
if (!function_exists('paypalCharge')) {

    function paypalCharge($attachedTo, $user_id, $amount, $currency = "USD") {
        $CI = & get_instance();
        $CI->db->from('paypal_object');
        $CI->db->where('paypal_object.belongsTo', $user_id);
        $CI->db->where('paypal_object.sr', $attachedTo);
        $result = $CI->db->get()->result();
        $url = PAYPAL_BILLING_API_URL;
        $fields = array(
            'USER' => PAYPAL_API_USER,
            'PWD' => PAYPAL_API_PASS,
            'SIGNATURE' => PAYPAL_API_SIGN,
            'METHOD' => 'DoReferenceTransaction',
            'VERSION' => 86,
            'PAYMENTREQUEST_0_AMT' => 0,
            'CURRENCYCODE' => strtoupper($currency),
            'PAYMENTACTION' => 'Sale',
            'REFERENCEID' => $result[0]->agreement_id,
            'AMT' => $amount
        );
        $charge = hr_curl_post($url, $fields);
        $chargeResult = array();
        parse_str($charge, $chargeResult);
       // print_r($chargeResult);die();
        if ($chargeResult['ACK'] == "Success") {
            return array(
                'status' => true,
                'transaction_id' => $chargeResult['TRANSACTIONID']
            );
        } else {
            return array(
                'status' => false,
                'transaction_id' => ''
            );
        }
    }

}
if (!function_exists('stripeCharge')) {

    function stripeCharge($attachedTo, $user_id, $amount, $currency = "usd") {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('stripe_customerdetail');
        $CI->db->where('stripe_customerdetail.belongsTo', $user_id);
        $CI->db->where('stripe_customerdetail.attachedTo', $attachedTo);
        $result = $CI->db->get()->result();
        $amount = $amount * 100;
        $stripeCharge = \Stripe\Charge::create(array(
                    "amount" => $amount, // Amount in cents
                    "currency" => $currency,
                    "customer" => $result[0]->stripeCustomerID)
        );

        if ($stripeCharge->status == "succeeded") {
            return array(
                'status' => true,
                'transaction_id' => $stripeCharge['id']
            );
        } else {
            return array(
                'status' => false,
                'transaction_id' => ''
            );
        }
    }

}
if (!function_exists('ppCreateInitialAgreement')) {

    function ppCreateInitialAgreement($currency_code) {
        $Rurl = dirname('http://www.winjob.com/pay/addPP');
        $returnUrl = "$Rurl/addPP/ExecuteAgreement?return";
        $cancelUrl = "$Rurl/addPP/ExecuteAgreement?cancel";

        $url = PAYPAL_BILLING_API_URL;
        $fields = array(
            'USER' => PAYPAL_API_USER,
            'PWD' => PAYPAL_API_PASS,
            'SIGNATURE' => PAYPAL_API_SIGN,
            'METHOD' => 'SetExpressCheckout',
            'VERSION' => 86,
            'PAYMENTREQUEST_0_PAYMENTACTION' => 'AUTHORIZATION',
            'PAYMENTREQUEST_0_AMT' => 0,
            'L_BILLINGTYPE0' => 'MerchantInitiatedBilling',
            'PAYMENTREQUEST_0_CURRENCYCODE' => $currency_code,
            'L_BILLINGAGREEMENTDESCRIPTION0' => 'Basic Payment Agreement',
            'cancelUrl' => $cancelUrl,
            'returnUrl' => $returnUrl
        );
        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $outr = array();
        parse_str($result, $outr);

        return $outr;

        /*
          $url = dirname('http://www.winjob.com/pay/addPP');
          $returnUrl = "$url/addPP/ExecuteAgreement?return";
          $cancelUrl = "$url/addPP/ExecuteAgreement?cancel";
          $currencyCode = $currency_code;
          $paymentDetails = new PaymentDetailsType();
          $itemTotalValue = 0;
          $taxTotalValue = 0;
          $orderTotalValue = 0;
          $paymentDetails->OrderTotal = new BasicAmountType($currencyCode, $orderTotalValue);
          $paymentDetails->PaymentAction = "Authorization";

          //$billingAgreementDetails = new BillingAgreementDetailsType('MerchantInitiatedBilling');
          //$billingAgreementDetails->BillingAgreementDescription = "Basic Agreement";

          $setECReqDetails = new SetExpressCheckoutRequestDetailsType();

          //$setECReqDetails->BillingAgreementDetails = array($billingAgreementDetails);
          $setECReqDetails->CancelURL = $cancelUrl;
          $setECReqDetails->ReturnURL = $returnUrl;

          $setECReqType = new SetExpressCheckoutRequestType();
          $setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
          $setECReq = new SetExpressCheckoutReq();
          $setECReq->SetExpressCheckoutRequest = $setECReqType;

          $paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());

          try{
          $setECResponse = $paypalService->SetExpressCheckout($setECReq);
          header("Location: ".PAYPAL_USER_AUTH_URL.$setECResponse->Token);

          }catch (Exception $ex){
          echo $ex;
          }
         */
    }

    /* function ppCreateInitialAgreement($currency_code){
      $baseUrl = PAYPAL_BASE_URL;
      $requestEnvelope = new RequestEnvelope("en_US");
      $preapprovalRequest = new PreapprovalRequest(
      $requestEnvelope,
      $baseUrl."/ExecuteAgreement?success=false",
      $currency_code,
      $baseUrl."/ExecuteAgreement?success=true",
      gmdate("Y-m-d\TH:i:s\Z", time())
      );
      $service = new AdaptivePaymentsService(Configuration::getAcctAndConfig());
      try{
      $response = $service->Preapproval($preapprovalRequest);
      return $response;
      }
      catch (Exception $ex){
      echo $ex;
      }
      } */
}
if (!function_exists('ppCreateInitialPlan')) {

    function ppCreateInitialPlan() {
        $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(PAYPAL_CID, PAYPAL_CIDS)
        );
        $baseUrl = PAYPAL_BASE_URL;
        $plan = new Plan();
        $plan->setName('InitialAgreement')
                ->setDescription('Agreement Deposit.')
                ->setType('INFINITE');
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('AgreementDeposit')
                ->setType('Regular')
                ->setFrequency('Month')
                ->setFrequencyInterval("1")
                ->setCycles("0")
                ->setAmount(new Currency(array('value' => 1, 'currency' => 'USD')));
        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl("$baseUrl/ExecuteAgreement?success=true")
                ->setCancelUrl("$baseUrl/ExecuteAgreement?success=false")
                ->setAutoBillAmount("yes")
                ->setInitialFailAmountAction("CONTINUE")
                ->setMaxFailAttempts("0")
                ->setSetupFee(new Currency(array('value' => 0, 'currency' => 'USD')));
        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);
        try {
            $createdPlan = $plan->create($apiContext);
            $patch = new Patch();
            $value = new PayPalModel('{
	       "state":"ACTIVE"
	     }');

            $patch->setOp('replace')
                    ->setPath('/')
                    ->setValue($value);
            $patchRequest = new PatchRequest();
            $patchRequest->addPatch($patch);

            $createdPlan->update($patchRequest, $apiContext);
            $plan = Plan::get($createdPlan->getId(), $apiContext);

            $output = $plan;
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            //$output = $ex;
            echo $ex->getCode(); // Prints the Error Code
            echo $ex->getData(); // Prints the detailed error message
            die($ex);
        } catch (Exception $ex) {
            $output = $ex;
        }
        return @$output;
    }

}

if (!function_exists('updateOutstandingAgreementAmmount')) {

    function updateOutstandingAgreementAmmount($agreementID, $amount, $currency) {
        $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(PAYPAL_CID, PAYPAL_CIDS)
        );

        print_r($apiContext);
        die();

        $url = 'https://api.sandbox.paypal.com/v1/payments/billing-agreements/' . $agreementID . '/set-balance';
        $fields = array(
            'value' => $amount,
            'currency' => $currency
        );
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        $ch = curl_init();
        $request_headers = array();
        $request_headers[] = 'Content-Type:application/json';
        $request_headers[] = 'Authorization: Bearer ' . $apiContext;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}
if (!function_exists('primaryPaymentMethodExistance')) {

    function primaryPaymentMethodExistance($user_id) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('billingmethodlist');
        $CI->db->where('billingmethodlist.belongsTo', $user_id);
        $CI->db->where('billingmethodlist.isPrimary', "1");
        $result = $CI->db->get()->result();
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

}
?>
