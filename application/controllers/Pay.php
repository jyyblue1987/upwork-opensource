<?php
\Stripe\Stripe::setApiKey(STRIPE_SK);
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\ShippingAddress;
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;

use PayPal\Core\PayPalConfigManager;
use PayPal\Core\PayPalCredentialManager;

use PayPal\Service\AdaptivePaymentsService;
use PayPal\Types\AP\PreapprovalDetailsRequest;
use PayPal\Types\Common\RequestEnvelope;

use PayPal\Types\AP\FundingConstraint;
use PayPal\Types\AP\FundingTypeInfo;
use PayPal\Types\AP\FundingTypeList;
use PayPal\Types\AP\PayRequest;
use PayPal\Types\AP\Receiver;
use PayPal\Types\AP\ReceiverList;
use PayPal\Types\AP\SenderIdentifier;
use PayPal\Types\Common\PhoneNumberType;

class Pay extends Winjob_Controller
{
    
    private $job_payment_datas = array(); 
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('common_mod'));
        
        // added by (Donfack Zeufack Hermann) start 
        // load the default language for the current user.
        $this->load_language();
        // added by (Donfack Zeufack Hermann) end
    }
    
    

    public function index()
    {
        $data = array();
        $this->Admintheme->webview("clientpay/index", $data);
    }
    //payment function by haseeburrehman.com starts
    public function addCC($sub = null)
    {
        $user_id = $this->session->userdata('id');
        if (empty($sub)) {
            $this->load->view('MasterCardSelection/index');
        } elseif ($sub == "edit") {
            $form_data = $this->input->post();
            try {
                $qdata = array();
                $cu = \Stripe\Customer::retrieve($form_data['scid']);
                $cu->source = $form_data['stripeToken'];
                $cu->save();
                $success = "Your card details have been updated!";
            //get cc ref data from db
            $this->db->select('*');
                $this->db->from('stripe_customerdetail');
                $this->db->where('stripe_customerdetail.stripeCustomerID', $form_data['scid']);
                $qdata['scr'] = $this->db->get()->result();
            //updating cc data in db
            $this->db->where('ccdetails.sr', $qdata['scr'][0]->attachedTo);
                $this->db->update('ccdetails', $form_data);
            } catch (\Stripe\Error\Card $e) {
                $body = $e->getJsonBody();
                $err  = $body['error'];
                $error = $err['message'];
            }
        } elseif ($sub == "add") {
            $form_data = $this->input->post();
            $token = $form_data['stripeToken'];
            try {
                // Create a Customer
            $customer = \Stripe\Customer::create(array(
              "source" => $token,
              "description" => $form_data['fname']." ".$form_data['lname']." - ".$user_id)
            );
            } catch (Exception $e) {
                echo $e->getMessage();
                die();
            }


            $query = ("INSERT INTO ccdetails VALUES(NULL,".$this->db->escape($form_data['fname']).",".$this->db->escape($form_data['lname']).",".$this->db->escape(substr($form_data['cardNumber'], -4)).",".$this->db->escape($form_data['cvv']).",".$this->db->escape($form_data['month']).",".$this->db->escape($form_data['year']).",".$this->db->escape($form_data['country']).",".$this->db->escape($form_data['address']).",".$this->db->escape($form_data['address2']).",".$this->db->escape($form_data['city']).",".$this->db->escape($form_data['zip']).",".$this->db->escape(time()).",".$this->db->escape(time()).",".$this->db->escape($user_id).",'0')");
            if ($this->db->query($query)) {
                $insert_id = $this->db->insert_id();
                $isPrimary = "";
                if (primaryPaymentMethodExistance($user_id)) {
                    $isPrimary = "0";
                } else {
                    $isPrimary = "1";
                }
                $bml_insert = array(
              'belongsTo' => $user_id,
              'paymentMethod' => 'stripe',
              'attachedTo' => $insert_id,
              'isPrimary' => $isPrimary,
              'isDeleted' => 0
            );

                if ($this->db->insert('billingmethodlist', $bml_insert)) {
                    if ($customer->id) {
                        $query2 = ("INSERT INTO stripe_customerdetail VALUES(NULL, ".$this->db->escape($user_id).", ".$this->db->escape($customer).", ".$this->db->escape($customer->id).",".$this->db->escape($insert_id).")");
                        if ($this->db->query($query2)) {
                            header('Location: /pay/billing?addCard=success');
                        }
                    }
                }
            
            //added by arjay
            //get email and name of employer
            $this->db->select('*');
            $this->db->from('webuser');
            $this->db->where('webuser_id', $user_id);
            $query = $this->db->get();
            $result = $query->row();

            if ($query->num_rows() > 0) {
                $fname = $result->webuser_fname;
                $email = $result->webuser_email;
            }

            $subject = "Successfully Added Payment Method";
            $details = array(
                    'fname' => ucfirst($fname),
                    'company' => 'Winjob',
                    'slogan' => 'Hire Talented Freelancers For a Low Cost',
                    'para1' => 'Your new payment method has been add for your account. If you did not make this change, please <a href="' . site_url() . 'contact" style="color: #0061A7; text-decoration: none;">contact us</a>.'
                );
                $response = $this->Sesmailer->sesemail($email, $subject, $this->Emailtemplate->emailview('set_primary_payment', $details));
                
            } else {
                echo "error";
            }
          //print_r($form_data);
          //$this->load->view('welcome_message');
        } else {
            header('Location: ../../Billing?from=addCC');
        }
    }
    public function addPP($sub = "")
    {
        if (empty($sub)) {
            $form_data = $this->input->post();
            if ($form_data['paypal_agreement'] == "yes") {
                $user_id = $this->session->userdata('id');
                $agreementPA = ppCreateInitialAgreement("USD");
                if ($agreementPA['TOKEN'] != "") {
                    header("Location: ".PAYPAL_USER_AUTH_URL.$agreementPA['TOKEN']);
                } else {
                    echo "error_agAP";
                }
            } else {
                header("location: ../../");
            }

        //$token = $agreementPA->preapprovalKey;
        //$payPalURL = PAYPAL_URL.$token;
        //$insert_data = array('belongsTo' => $user_id,'PA_key' => $token,'dateadded' => time(), 'isActive' => "1");
        //if($this->db->insert('paypal_PAkey', $insert_data)){
        //  header('Location: '.$payPalURL);
        //}else{
        //  echo "here";
        //}
        } elseif ($sub == "ExecuteAgreement") {
            if (isset($_GET['return']) && isset($_GET['token'])) {
                $user_id = $this->session->userdata('id');
                $url = PAYPAL_BILLING_API_URL;
            //create Agreement HR
            $fields = array(
              'USER' => PAYPAL_API_USER,
              'PWD' => PAYPAL_API_PASS,
              'SIGNATURE' => PAYPAL_API_SIGN,
              'METHOD' => 'CreateBillingAgreement',
              'TOKEN' => $_GET['token'],
              'VERSION' => 86
            );
                $result = hr_curl_post($url, $fields);
                $bag = array();
                parse_str($result, $bag);
                if ($bag['BILLINGAGREEMENTID'] != "" && $bag['ACK'] == "Success") {
                    //get payer's Data HR
              $fields = array(
                'USER' => PAYPAL_API_USER,
                'PWD' => PAYPAL_API_PASS,
                'SIGNATURE' => PAYPAL_API_SIGN,
                'METHOD' => 'GetExpressCheckoutDetails',
                'TOKEN' => $_GET['token'],
                'VERSION' => 86
              );
                    $result = hr_curl_post($url, $fields);
                    $details = array();
                    parse_str($result, $details);
                    if ($details['EMAIL'] != "") {
                        $insert_data = array(
                  'pp_fname' => $details['FIRSTNAME'],
                  'pp_lname' => $details['LASTNAME'],
                  'pp_email' => $details['EMAIL'],
                  'agreement_id' => $bag['BILLINGAGREEMENTID'],
                  'agreement_state' => $details['BILLINGAGREEMENTACCEPTEDSTATUS'],
                  'payer_id' => $details['PAYERID'],
                  'belongsTo' => $user_id,
                  'dateadded' => time(),
                  'completeObject' => serialize($details)
                );
                        if ($this->db->insert('paypal_object', $insert_data)) {
                            $isPrimary = "";
                            if (primaryPaymentMethodExistance($user_id)) {
                                $isPrimary = "1";
                            } else {
                                $isPrimary = "1";
                            }
                            $insert_id2 = $this->db->insert_id();
                            $insert_data2 = array(
                    'belongsTo' => $user_id,
                    'paymentMethod' => 'paypal',
                    'attachedTo' => $insert_id2,
                    'isPrimary' => $isPrimary,
                    'isDeleted' => '0'
                  );
                            if ($this->db->insert('billingmethodlist', $insert_data2)) {
                                header('Location: /pay/billing?addPP=success');
                            }
                        }
                    }
                }
            } elseif (isset($_GET['cancel'])) {
                echo "canceled";
            }


/*
        //print_r($_GET);
        //$form_data = $this->input->post();
        //print_r($form_data);
        $user_id = $this->session->userdata('id');
        if(isset($_GET['success']) && $_GET['success'] == "true"){
          $this->db->select('*');
          $this->db->from('paypal_PAkey');
          $this->db->where('paypal_PAkey.belongsTo',$user_id);
          $this->db->where('paypal_PAkey.isActive', "1");
          $query_getPA = $this->db->get()->result();
          //print_r($query_getPA[0]->PA_key);
          if($query_getPA[0]->PA_key != NULL){
            $requestEnvelope = new RequestEnvelope("en_US");
            $preapprovalDetailsRequest = new PreapprovalDetailsRequest($requestEnvelope, $query_getPA[0]->PA_key);
            $service = new AdaptivePaymentsService(Configuration::getAcctAndConfig());
            try{
              $response = $service->PreapprovalDetails($preapprovalDetailsRequest);
              //header("Content-Type: text/plain");
              //print_r($response);die();
              $insert_data5 = array(
                'email' => $response->senderEmail,
                'paypal_accID' => $response->sender->accountId,
                'dateadded' => time(),
                'completeObject' => serialize($response),
                'belongsTo' => $user_id,
                'PA_key' => $query_getPA[0]->PA_key
              );

              if($this->db->insert('paypal_PA_object', $insert_data5)){
                $insert_id2 = $this->db->insert_id();
                $insert_data2 = array(
                  'belongsTo' => $user_id,
                  'paymentMethod' => 'paypal',
                  'attachedTo' => $insert_id2,
                  'isPrimary' => '0',
                  'isDeleted' => '0'
                );
                if($this->db->insert('billingmethodlist', $insert_data2)){
                  header('Location: /pay/billing?addPP=success');
                }else{
                  echo 'error_bml';
                }

              }else{
                echo 'error_2';
              }

            }catch(Exception $ex){
              echo $ex;
            }
          }else{
            echo "error_invalid";
          }
        }else{
          echo 'error_s';
        }
*/
        } elseif ($sub == "chargePP") {
        }


/*
      $apiContext = new \PayPal\Rest\ApiContext(
          new \PayPal\Auth\OAuthTokenCredential(PAYPAL_CID,PAYPAL_CIDS)
      );
      if(empty($sub)){
          $form_data = $this->input->post();

          $updatedPlan = ppCreateInitialPlan();
          //header('content-type: text/plain');
          //print_r($updatedPlan);

          $agreement = new Agreement();
          $agreement->setName('Base Agreement')
            ->setDescription('Basic Agreement')
            ->setStartDate(gmdate("Y-m-d\TH:i:s\Z", time()+20));


          $plan = new Plan();
          $plan->setId($updatedPlan->getId());

          $agreement->setPlan($plan);
          $payer = new Payer();
          $payer->setPaymentMethod('paypal');
          $agreement->setPayer($payer);

          try{
            $agreement = $agreement->create($apiContext);
            $approvalUrl = $agreement->getApprovalLink();
            header('Location: '.$approvalUrl);
          }catch(Exception $ex){
            echo $ex->getCode(); // Prints the Error Code
            echo $ex->getData(); // Prints the detailed error message
            die($ex);
          }

      }elseif($sub = "ExecuteAgreement"){
          if (isset($_GET['success']) && $_GET['success'] == 'true') {
            $token = $_GET['token'];
            $agreement = new \PayPal\Api\Agreement();

            try{
              $agreement->execute($token, $apiContext);
              $insert_data = array(
                'pp_fname' => $agreement->payer->payer_info->first_name,
                'pp_lname' => $agreement->payer->payer_info->last_name,
                'pp_email' => $agreement->payer->payer_info->email,
                'agreement_id' => $agreement->id,
                'agreement_state' => $agreement->state,
                'payer_id' => $agreement->payer->payer_info->payer_id,
                'belongsTo' => $user_id,
                'dateadded' => time(),
                'completeObject' => $agreement
              );
              if($this->db->insert('paypal_object', $insert_data)){
                $insert_id2 = $this->db->insert_id();
                $insert_data2 = array(
                  'belongsTo' => $user_id,
                  'paymentMethod' => 'paypal',
                  'attachedTo' => $insert_id2,
                  'isPrimary' => '0',
                  'isDeleted' => '0'
                );
                if($this->db->insert('billingmethodlist', $insert_data2)){
                  header('Location: /pay/billing?addPP=success');
                  //header('content-type: text/plain');
                  //echo $agreement."\n\n";
                  //print_r($apiContext);
                  //updateOutstandingAgreementAmmount('a','a','a');
                  //echo "done";
                }else{
                  echo "error: 47-pp-ins";
                }
              }else{
                echo "error";
              }

            }catch (Exception $ex){
              echo $ex;
            }


          }
      }
*/
    }
    public function makePrimary()
    {
        $user_id = $this->session->userdata('id');
        $form_data = $this->input->post();
        if ($form_data['makePrimary'] == "yes") {
            $method = $form_data['method'];
            $id = $form_data['id'];
            $type = '';
            switch ($form_data['method']) {
          case 'card':
            $type = "stripe";
            break;
          case 'paypal':
            $type = "paypal";
            break;
        }
            $this->db->select('*');
            $this->db->from('billingmethodlist');
            $this->db->where("billingmethodlist.belongsTo", $user_id);
            $this->db->where("billingmethodlist.isPrimary", "1");
            $query_getPrimary = $this->db->get()->result();
            if (count($query_getPrimary) > 0) {
                $updateArray['isPrimary'] = "0";
                $this->db->where("billingmethodlist.belongsTo", $user_id);
                $this->db->where("billingmethodlist.sr", $query_getPrimary[0]->sr);
                $this->db->update("billingmethodlist", $updateArray);
          //print_r($query_getPrimary[0]->sr);die();
            }
            $updateArray['isPrimary'] = "1";
            $this->db->where("billingmethodlist.belongsTo", $user_id);
            $this->db->where("billingmethodlist.paymentMethod", $type);
            $this->db->where("billingmethodlist.attachedTo", $id);
            $this->db->update("billingmethodlist", $updateArray);
            
            //added by arjay
            //get email and name of employer
            $this->db->select('*');
            $this->db->from('webuser');
            $this->db->where('webuser_id', $user_id);
            $query = $this->db->get();
            $result = $query->row();

            if ($query->num_rows() > 0) {
                $fname = $result->webuser_fname;
                $email = $result->webuser_email;
            }

            $subject = "Updated Primary Payment Method";
            $details = array(
                    'fname' => ucfirst($fname),
                    'company' => 'Winjob',
                    'slogan' => 'Hire Talented Freelancers For a Low Cost',
                    'para1' => 'Your payment method has been updated for your account. If you did not make this change, please <a href="' . site_url() . 'contact" style="color: #0061A7; text-decoration: none;">contact us</a>.'
                );
                $response = $this->Sesmailer->sesemail($email, $subject, $this->Emailtemplate->emailview('set_primary_payment', $details));

            header('Location: ../pay/billing?primary=changed');
        }
    }
    public function removePaymentMethod()
    {
        $user_id = $this->session->userdata('id');
        $form_data = $this->input->post();
        if ($form_data['remove'] == "yes") {
            $type = '';
            switch ($form_data['type']) {
          case 'card':
            $type = "stripe";
            break;
          case 'paypal':
            $type = "paypal";
            break;
        }
            $id = $form_data['id'];
            $updateArray['isDeleted'] = "1";//array('isDeleted' => 1);
        $this->db->where("billingmethodlist.belongsTo", $user_id);
            $this->db->where("billingmethodlist.paymentMethod", $type);
            $this->db->where("billingmethodlist.attachedTo", $id);
            $this->db->where("billingmethodlist.isPrimary", "0");
            $this->db->update("billingmethodlist", $updateArray);
            $this->db->trans_complete();
            if ($this->db->affected_rows() == '1') {
                header('Location: ../pay/billing?delete=true');
            } else {
                header('Location: ../pay/billing?delete=false');
            }
        }
      //print_r($form_data);
    }
    //payment function by haseeburrehman.com ends
    public function freelancerbalance()
    {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }
            $user_id = $this->session->userdata('id');

            $this->db->select('*');
            $this->db->from('payments');
            $this->db->join('webuser', 'webuser.webuser_id = payments.buser_id', 'inner');
            $this->db->where('payments.user_id', $user_id);
            $this->db->group_by('buser_id');
            $query_listuser = $this->db->get();
            $list_client = $query_listuser->result();

            date_default_timezone_set("UTC");
            $today = strtotime('today');
            $today = date('y-m-d', $today);
            $this_week_start = strtotime('monday this week');
            $this_week_start = date('y-m-d', $this_week_start);
          //  var_dump($today);var_dump($this_week_start);die();
             $next_week_start = strtotime('monday next week');
            $next_week_start = date('y-m-d', $next_week_start);

            $this_week_end = strtotime('+1 week sunday');
            $this_week_end = date('y-m-d', $this_week_end);

            $last_week_start = strtotime('previous monday');
            $last_week_start = date('y-m-d', $last_week_start);
            $last_week_end = strtotime('previous sunday');
            $last_week_end = date('y-m-d', $last_week_end);

            $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where('fuser_id', $user_id);
            $this->db->where('working_date >=', $this_week_start);
            $this->db->where('working_date <=', $today);
            $query_progress = $this->db->get();
            $job_progress = $query_progress->result();


            $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where('fuser_id', $user_id);
            $this->db->where('working_date <', $this_week_start);
            $this->db->where('working_date >=', $last_week_start);
            $query_pending = $this->db->get();
            $job_pending = $query_pending->result();

            $this->db->select('*,job_bids.id as bid_id');
            $this->db->from('job_bids');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('jobs.job_type', 'fixed');
            $this->db->where('job_bids.payment_status', 1);
            $this->db->where('job_bids.start_date >=', $today);
            $this->db->where('job_bids.start_date <=', $next_week_start);
            $this->db->where('job_bids.user_id', $user_id);
            $query_pending_fixed = $this->db->get();
            //echo $this->db->last_query(); exit;
            $job_pending_fixed = $query_pending_fixed->result();


            $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where('fuser_id', $user_id);
            $this->db->where('working_date <=', $last_week_start);
            $query_available = $this->db->get();
            $job_available_hourly = $query_available->result();

            $this->db->select('*,job_bids.id as bid_id');
            $this->db->from('job_bids');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('jobs.job_type', 'fixed');
//            $this->db->where('job_bids.payment_status',1);
            $this->db->where('job_bids.start_date <=', $last_week_start);
            $this->db->where('job_bids.user_id', $user_id);
            $query_available_fixed = $this->db->get();
            $job_available_fixed = $query_available_fixed->result();

            $this->db->select('*');
            $this->db->from('withdraw');
            $this->db->where('userid', $user_id);
            $query_withdraw = $this->db->get();
            $withdraws = $query_withdraw->result();




            $this->db->select('*');
            $this->db->from('payments');
            $this->db->join('webuser', 'webuser.webuser_id = payments.buser_id', 'inner');
            $this->db->join('jobs', 'jobs.id = payments.job_id', 'inner');
            $this->db->join('job_accepted', 'job_accepted.job_id = payments.job_id', 'inner');
            $this->db->where('job_accepted.fuser_id = payments.user_id');
            $this->db->join('job_bids', 'job_bids.job_id = payments.job_id', 'inner');
            $this->db->where('job_bids.user_id = payments.user_id');
            $this->db->order_by("jobs.id", "DESC");

            if (isset($_GET['startDate']) && $_GET['startDate'] != "") {
                $this->db->where('payments.payment_create >=', date('Y-m-d', strtotime($_GET['startDate'])));
            }
            if (isset($_GET['endDate']) && $_GET['endDate'] != "") {
                $this->db->or_where('payments.payment_create <=', date('Y-m-d', strtotime($_GET['endDate'])));
            }
            if (isset($_GET['trxTypes']) && $_GET['trxTypes'] != "") {
                // $this->db->where('payments.buser_id', $client_id);
            }
            if (isset($_GET['employers']) && $_GET['employers'] != "") {
                $this->db->where('payments.buser_id', base64_decode($_GET['employers']));
            }
            $this->db->where('payments.user_id', $user_id);
            $query_payment = $this->db->get();
            $list_payments = $query_payment->result();

            $sql = ("SELECT jobs.job_type, job_accepted.id,payments.payment_create,payments.hire_end_id,jobs.title,payments.des,job_accepted.fuser_id,job_accepted.job_id,job_accepted.contact_id,job_bids.offer_bid_amount,webuser.webuser_fname,webuser.webuser_lname,payments.payment_gross,payments.txn_id, 'con_id' as con_id, 'amount' as amount, '1' as type

            FROM payments

            JOIN webuser ON webuser.webuser_id = payments.user_id

            JOIN jobs ON jobs.id = payments.job_id

            JOIN job_accepted ON job_accepted.job_id = payments.job_id

            JOIN job_bids ON job_bids.job_id = payments.job_id

            WHERE job_bids.user_id = payments.user_id

            AND job_accepted.fuser_id = payments.user_id

            AND payments.user_id =$user_id

            UNION ALL SELECT  'hourly' AS job_type, ja.id, dt.date as payment_create, 'hire' as hire_end_id, 'title' as title, dt.des as des,ja.fuser_id,ja.job_id,ja.contact_id, 'offer_bid_amount' as offer_bid_amount,u.webuser_fname,u.webuser_lname,'payment_gross' as payment_gross, 'txn_id' as txn_id,ja.contact_id as con_id,dt.amount as amount, '2' as type

            FROM daily_hourly_transaction dt

            LEFT JOIN job_accepted ja ON ja.contact_id = dt.contract_id

            LEFT JOIN webuser u ON u.webuser_id = dt.fuser_id

            WHERE dt.fuser_id = $user_id ORDER BY payment_create DESC");
            $query = $this->db->query($sql);
            $list_payments = $query->result();



            /* fixed pending start */

            $seven_days_pre=date('Y-m-d H:i:s', strtotime('-7 days'));
            $today1 = strtotime('today');
            $today1 = date('y-m-d H:i:s', $today1);
            $this->db->select_sum('payments.payment_gross');
            $this->db->from('payments');
            $this->db->join('webuser', 'webuser.webuser_id = payments.buser_id', 'inner');
            $this->db->join('jobs', 'jobs.id = payments.job_id', 'inner');
            $this->db->join('job_accepted', 'job_accepted.job_id = payments.job_id', 'inner');
            $this->db->where('job_accepted.fuser_id = payments.user_id');
            $this->db->join('job_bids', 'job_bids.job_id = payments.job_id', 'inner');
            $this->db->where('job_bids.user_id = payments.user_id');
            $this->db->where('payments.payment_create >=', $seven_days_pre);
            $this->db->where('payments.payment_create <=', $today1);
            $this->db->where('payments.user_id', $user_id);
            $this->db->where('jobs.job_type', 'fixed');
            $query_payment_fixed_pending = $this->db->get();
            $payment_fixed_pending = $query_payment_fixed_pending->result();


          /* fixed pending end */

          /* fixed available start */

        $this->db->select_sum('payments.payment_gross');
            $this->db->from('payments');
            $this->db->join('webuser', 'webuser.webuser_id = payments.buser_id', 'inner');
            $this->db->join('jobs', 'jobs.id = payments.job_id', 'inner');
            $this->db->join('job_accepted', 'job_accepted.job_id = payments.job_id', 'inner');
            $this->db->where('job_accepted.fuser_id = payments.user_id');
            $this->db->join('job_bids', 'job_bids.job_id = payments.job_id', 'inner');
            $this->db->where('job_bids.user_id = payments.user_id');
        //$this->db->where('payments.payment_create >=', $seven_days_pre);
        $this->db->where('payments.payment_create <=', $seven_days_pre);
            $this->db->where('payments.user_id', $user_id);
            $this->db->where('jobs.job_type', 'fixed');
            $query_payment_fixed_avail = $this->db->get();
            $payment_fixed_avail = $query_payment_fixed_avail->result();

      /* fixed available end */


      /* Hourly available start */

        $this->db->select_sum('payments.payment_gross');
            $this->db->from('payments');
            $this->db->join('webuser', 'webuser.webuser_id = payments.buser_id', 'inner');
            $this->db->join('jobs', 'jobs.id = payments.job_id', 'inner');
            $this->db->join('job_accepted', 'job_accepted.job_id = payments.job_id', 'inner');
            $this->db->where('job_accepted.fuser_id = payments.user_id');
            $this->db->join('job_bids', 'job_bids.job_id = payments.job_id', 'inner');
            $this->db->where('job_bids.user_id = payments.user_id');
            $this->db->where('payments.payment_create <=', $seven_days_pre);
            $this->db->where('payments.user_id', $user_id);
            $this->db->where('jobs.job_type', 'hourly');
            $this->db->order_by('payment_create');
            $query_payment_hourly_avail = $this->db->get();
            $payment_hourly_avail = $query_payment_fixed_avail->result();

            $data = array('payment_hourly_avail'=>$payment_hourly_avail,'payment_fixed_avail'=>$payment_fixed_avail,'payment_fixed_pending'=>$payment_fixed_pending,'list_users' => $list_client, 'list_payments' => $list_payments, 'job_progress' => $job_progress, 'job_pending' => $job_pending, 'job_pending_fixed' => $job_pending_fixed, 'job_available_hourly' => $job_available_hourly, 'job_available_fixed' => $job_available_fixed, 'withdraws' => $withdraws, 'title' => 'My Balance - Winjob');
            $this->Admintheme->webview("clientpay/freelancerbalance", $data);
        }
    }

    public function billing()
    {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }
            $data = array();
            $data = array(
                'page' => "profilesetting",
                'name' => $this->session->userdata('fname') . " " . $this->session->userdata('lname'),
                'id' => $this->session->userdata('id'),
                'js' => array(),
                'jsf' => array(
                    "assets/js/layerslider.transitions.js",
                    "assets/js/layerslider.kreaturamedia.jquery.js",
                    "assets/js/owl.carousel.min.js",
                    "assets/js/homepage.js",
                    "assets/js/jqiery-ui.js"
                ),
                'css' => array(
                    "assets/css/layerslider.css",
                    "assets/css/owl.carousel.css",
                    "assets/css/owl.theme.css"
                ),
                'open' => "profile",
                'openSub' => "profile-bio",
                'skillList' => array(
                    "Java", "PHP", "HTML", "CSS", "Javascript", "Jquery"
                ),
               // 'projectCateList' => $value['projectCateList'],
            );
            $user_id = $this->session->userdata('id');
            $this->db->select('*');
            //updated by haseeburrehman.com starts -
            $this->db->from('billingmethodlist');
            $this->db->where('billingmethodlist.belongsTo', $user_id);
            $this->db->where('billingmethodlist.paymentMethod', "stripe");
            $this->db->where('billingmethodlist.isDeleted', "0");
            $this->db->join('ccdetails', 'ccdetails.sr = billingmethodlist.attachedTo', 'inner');
            $this->db->join('stripe_customerdetail', 'stripe_customerdetail.attachedTo = billingmethodlist.attachedTo', 'left');
            //updated by haseeburrehman.com ends
            $query = $this->db->get();
            $result = $query->result();
            $data['cards'] = $result;

            //updated by haseeburrehman.com starts -
            $this->db->select('*');
            $this->db->from('billingmethodlist');
            $this->db->where('billingmethodlist.belongsTo', $user_id);
            $this->db->where('billingmethodlist.paymentMethod', "paypal");
            $this->db->where('billingmethodlist.isDeleted', "0");
            $this->db->join('paypal_object', 'paypal_object.sr = billingmethodlist.attachedTo', 'inner');
            $query = $this->db->get();
            $result = $query->result();
            $data['paypals'] = $result;
            //updated by haseeburrehman.com ends



            $this->Admintheme->webview("payment/billing", $data);
        }
    }

    public function methods_paypal()
    {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }
            $data = array();

            $this->Admintheme->webview("payment/methods-paypal", $data);
        }
    }

    public function methods_card()
    {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }
            $data = array();

            $this->Admintheme->webview("payment/methods-card", $data);
        }
    }

    public function add_milestone()
    {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }
            $data = array();
            if ($this->input->post('job_id') && $this->input->post('fuser_id') && $this->input->post('buser_id')) {
                //  echo "hahah";
                $data['job_id'] = $this->input->post('job_id');
                $data['fuser_id'] = $this->input->post('fuser_id');
                $data['buser_id'] = $this->input->post('buser_id');
            }

            if ($this->input->post('job_id') && $this->input->post('user_id') && $this->input->post('buser_id') && $this->input->post('amount')) {

              //updates by haseeburrehman.com starts
              $user_id = $this->session->userdata('id');
                $chargeUser = chargePrimary($user_id, $this->input->post('amount'));
                if ($chargeUser['status_code'] == 1) {
                    echo "Failed payment for Insufficient funds";
                    die();
                }
              //updates by haseeburrehman.com ends


                $data['job_id'] = (int)$this->input->post('job_id');
                $data['user_id'] = (int)$this->input->post('user_id');
                $data['buser_id'] = (int)$this->input->post('buser_id');
                $data['des'] = 'Milestone';
                $data['payment_gross'] = $this->input->post('amount');

                $this->db->insert('payments', $data);
              //  print_r($data);die();

                $this->db->select('*');
                $this->db->from('job_bids');
                $this->db->where('user_id', $this->input->post('user_id'));
                $this->db->where('job_id', $this->input->post('job_id'));

                $query = $this->db->get();
                $result = $query->result();
                $result = $result[0];

                $updated_data['fixedpay_amount'] = $result->fixedpay_amount + (int) $this->input->post('amount');
                $this->db->where('user_id', $this->input->post('user_id'));
                $this->db->where('job_id', $this->input->post('job_id'));
                $this->db->update('job_bids', $updated_data);

                echo "done";
                die();
                //redirect(site_url("jobs/fixed_client_view?fmJob=NTY=&fuser=MTU="));
                //redirect(site_url("pay/clientpay"));
            }
            if ($this->input->post('amount')) {
                redirect(site_url("jobs-home"));
            }


            $this->load->view("webview/payment/add_milestone", $data);
        }
    }
    
    // added by (Donfack Zeufack Hermann) start description
    private function hasValidJobPaymentDatas(){
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('job_id', 'Job', 'numeric', array('numeric' => 'Provide correct job\'s informations.'));
        $this->form_validation->set_rules('fuser_id', 'Freelancer', 'numeric', array('numeric' => 'Provide a valid freelancer\'s informations.'));
        $this->form_validation->set_rules('buser_id', 'Client', 'numeric', array('numeric' => 'Provide a valid client\'s informations.'));
        
        $amount = $this->input->post('amount');
        if(! empty($amount)){
          $this->form_validation->set_rules('amount', 'Amount', 'numeric', array('numeric' => 'Payment amount is not a valid. Please entre a valid value e.g: 12 or 12.5'));
        } 
        
        return $this->form_validation->run();
    }      
    // added by (Donfack Zeufack Hermann) end
    

    public function full_milestone()
    {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }
            
            $data = array();
            
           // added by (Donfack Zeufack Hermann) start enhance payment code to make more readable
           if($this->hasValidJobPaymentDatas()){
             
              $this->load->model(array('job/bids_model', 'payment_model'));
            
              //extract all job data value ($job_id, $fuser_id, $buser_id, $amount) 
              extract($this->input->post());
            
              if(!empty($amount)){ // Process the payment
                
                $this->bids_model->remaing_to_pay($job_id, $fuser_id);
                
                $user_id    = $this->session->userdata('id');
                $chargeUser = chargePrimary($user_id, $amount);

                if ($chargeUser['status_code'] == 1) {
                    echo "Failed payment for Insufficient funds";
                    die();
                }
                
                $this->payment_model->save_job_transaction($job_id, $fuser_id, $buser_id, $amount);
                $this->bids_model->update_fixedpay_amount($job_id, $fuser_id, $amount);
                
                echo "done::" . base64_encode($job_id) . "::" . base64_encode($fuser_id);
                die();
                
              }else{ // Load job payment interface
                  
                $remaining = $this->bids_model->remaing_to_pay($job_id, $fuser_id);
                $this->load->view("webview/payment/full_payment", compact('remaining', 'job_id', 'fuser_id', 'buser_id'));
                
              }
              
            }else{
                //TODO: Add message for allow client to understand when happenned
                redirect(site_url("jobs-home"));
            }
            // added by (Donfack Zeufack Hermann) end
        }
    }

    public function clientpay()
    {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $client_id = $this->session->userdata('id');

            $this->db->select('*');
            $this->db->from('payments');
            $this->db->join('webuser', 'webuser.webuser_id = payments.user_id', 'inner');
            $this->db->where('payments.buser_id', $client_id);
            $this->db->group_by('user_id');
            $query_listuser = $this->db->get();
            $list_users = $query_listuser->result();



            $this->db->select('*');
            $this->db->from('payments');
            $this->db->join('webuser', 'webuser.webuser_id = payments.user_id', 'inner');
            $this->db->join('jobs', 'jobs.id = payments.job_id', 'inner');
            $this->db->join('job_accepted', 'job_accepted.job_id = payments.job_id', 'inner');
            $this->db->where('job_accepted.fuser_id = payments.user_id');
            $this->db->join('job_bids', 'job_bids.job_id = payments.job_id', 'inner');
            $this->db->where('job_bids.user_id = payments.user_id');
            /*$this->db->order_by("jobs.id", "DESC");*/
            if (isset($_GET['startDate']) && $_GET['startDate'] != "") {
                $this->db->where('payments.payment_create >=', date('Y-m-d', strtotime($_GET['startDate'])));
            }
            if (isset($_GET['endDate']) && $_GET['endDate'] != "") {
                $this->db->or_where('payments.payment_create <=', date('Y-m-d', strtotime($_GET['endDate'])));
            }
            if (isset($_GET['trxTypes']) && $_GET['trxTypes'] != "") {
                // $this->db->where('payments.buser_id', $client_id);
            }
            if (isset($_GET['employers']) && $_GET['employers'] != "") {
                $this->db->where('payments.user_id', base64_decode($_GET['employers']));
            }

            $this->db->where('payments.buser_id', $client_id);
            $this->db->order_by("payments.payment_create");
            $query_payment = $this->db->get();
            $list_payments = $query_payment->result();

            /*------------NUEVA CONSULTA--------*/

            $sql = ("SELECT jobs.job_type, job_accepted.id,payments.payment_create,payments.hire_end_id,jobs.title,payments.des,job_accepted.fuser_id,job_accepted.job_id,job_accepted.contact_id,job_bids.offer_bid_amount,webuser.webuser_fname,webuser.webuser_lname,payments.payment_gross,payments.txn_id, 'con_id' as con_id, 'amount' as amount, '1' as type

            FROM payments

            JOIN webuser ON webuser.webuser_id = payments.user_id

            JOIN jobs ON jobs.id = payments.job_id

            JOIN job_accepted ON job_accepted.job_id = payments.job_id

            JOIN job_bids ON job_bids.job_id = payments.job_id

            WHERE job_bids.user_id = payments.user_id

            AND job_accepted.fuser_id = payments.user_id

            AND payments.buser_id =$client_id

            UNION ALL SELECT  'hourly' AS job_type, ja.id, dt.date as payment_create, 'hire' as hire_end_id, 'title' as title, dt.des as des,ja.fuser_id,ja.job_id,ja.contact_id, 'offer_bid_amount' as offer_bid_amount,u.webuser_fname,u.webuser_lname,'payment_gross' as payment_gross, 'txn_id' as txn_id,ja.contact_id as con_id,dt.amount as amount, '2' as type

            FROM daily_hourly_transaction dt

            LEFT JOIN job_accepted ja ON ja.contact_id = dt.contract_id

            LEFT JOIN webuser u ON u.webuser_id = dt.fuser_id

            WHERE dt.cuser_id = $client_id ORDER BY payment_create DESC");
            $query = $this->db->query($sql);
            $list_payments = $query->result();

            $data = array('list_users' => $list_users, 'list_payments' => $list_payments);
            $this->Admintheme->webview("clientpay/clientpay", $data);
        }
    }
}
