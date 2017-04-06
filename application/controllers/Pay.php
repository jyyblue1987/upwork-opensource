<?php

\Stripe\Stripe::setApiKey(STRIPE_SK);

use PayPal\PayPalAPI\CreateBillingAgreementResponseType; 

class Pay extends Winjob_Controller
{
    
    private $job_payment_datas = array(); 
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('common_mod'));
        $this->load_language();
    }
    
    protected function load_language()
    {
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }

    /* TODO: To delete later */
    public function index_old()
    {
        $data = array();
        $this->Admintheme->webview("clientpay/index", $data);
    }
    
    public function index()
    {
        $this->checkForEmployer();
        
        $client_id = $this->session->userdata('id');
        
        $filters =  $this->_filters_values();
        
        //load all model
        $this->load->model( array( 'payment_model' ) );
        
        //get all freelancers
        $employers = $this->payment_model->all_user_involved_in_txn( $client_id, true );
        
        //get all payment transaction
        $payment_txns       = $this->payment_model->get_payment_list_of_employer( $client_id, $filters );
        
        //extract filters values ( from_internal, from_date, to_internal, to_date, trx_type, employer, employer_internal )
        extract( $filters );
        $this->twig->display('webview/employer/pay', compact(
            'from_date', 'to_date', 'trx_type', 'employer', 'employers', 'payment_txns'
        ));
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
    
    public function add_card(){
        
        $this->isEmployer();
        
        if(is_get())//Display stripe credit card.
        {
            $this->load->model('common_mod');
            $countries = $this->common_mod->load_countries();
            $this->twig->display('webview/payment/twig/add_credit_card', compact('user_id', 'countries'));
        }
        else//Create a stripe customer account for charge its CC later.
        {
            $form_data = $this->input->post();
            $token     = $form_data['stripeToken'];
            $user_id   = $this->session->userdata('id');
            
            try {
                // Create a Customer
                $customer = \Stripe\Customer::create(array(
                    "source"      => $token,
                    "description" => $form_data['fname'] . " ". $form_data['lname'] ." - " . $user_id,
                    "email"       => $this->session->userdata('email')
                ));
            } catch (Exception $e) {
                log_message('error', "Error when creating stripe customer...");
                $this->session->set_flashdata('error', $this->lang->line('text_app_stripe_error_customer_creation'));
                redirect(home_url());
            }
            
            $this->load->model(array('payment_methods_model'));
            $defaultPrimaryMethod = $this->payment_methods_model->get_primary_method_payment( $user_id );
            
            $isPrimary = ( ( $defaultPrimaryMethod ) == null ? 1 : 0 );
            
            $card_data = $customer->sources->data[0];
            $webuser_payment_service = array(
                'user_id'             => $user_id,
                'service_name'        => 'stripe',
                'service_description' => sprintf( $this->lang->line('text_app_card_ending_in'), $card_data->brand, $card_data->last4 ),
                'is_primary'          => $isPrimary,
                'is_deleted'          => 0,
                'service_payer_id'    => $customer->id
            );
            
            if( $this->payment_methods_model->save_method( $webuser_payment_service ) )
            {
                $this->_payment_method_added();
                
            }else{
                log_message('error', "Error when registering stripe customer identifier into database...");
                $this->session->set_flashdata('error', $this->lang->line('text_app_stripe_error_customer_creation'));
                redirect(home_url());
            }
        }
    }
    
    public function add_paypal_account()
    {
        if( is_get() )
        {
            $this->twig->display('webview/payment/twig/add_paypal_account');
        }
        else
        {   
            $this->load->library(array('winjob_paypal'));
            
            try
            {
                $response = $this->winjob_paypal->init_billing_agreement_without_charge();
                
                if( strtolower($response->Ack) =='success')
                {
                    redirect( PAYPAL_USER_AUTH_URL . $response->Token);
                }
                else
                {
                    $this->session->set_flashdata('error', $this->lang->line('text_app_network_paypal_connection_error'));
                }
            }
            catch(PayPal\Exception\PPConnectionException $e)
            {
                log_message('error', "Error when setting up the billing agreements for referent transaction... " . $e->getMessage());
                $this->session->set_flashdata('error', $this->lang->line('text_app_error_when_adding_paypal_account'));
            }
            redirect(back());
        }
    }
    
    public function get_paypal_express_checkout(){
        
        $token = $this->input->get('token');
        
        if( ! empty($token) )
        {
            $this->load->library(array('winjob_paypal'));
            
            try
            {
                $response      = $this->winjob_paypal->create_billing_agreement_without_charge( $token );
                $client_detail = $this->winjob_paypal->get_billing_agreement_customer_detail( $token );
                
                if( strtolower($response->Ack) =='success')
                {         
                    $user_id   = $this->session->userdata('id');
                    $this->load->model(array('payment_methods_model'));
                    $defaultPrimaryMethod = $this->payment_methods_model->get_primary_method_payment( $user_id );

                    $isPrimary = ( ( $defaultPrimaryMethod ) == null ? 1 : 0 );
                    
                    $webuser_payment_service = array(
                        'user_id'             => $user_id,
                        'service_name'        => 'paypal',
                        'service_description' => $client_detail->PayerInfo->Payer,
                        'is_primary'          => $isPrimary,
                        'is_deleted'          => 0,
                        'service_payer_id'    => $response->BillingAgreementID
                    );
                    
                    if( $this->payment_methods_model->save_method( $webuser_payment_service ) )
                    {
                        $this->_payment_method_added();
                    }
                }
                else
                {
                    $this->session->set_flashdata('error', $this->lang->line('text_app_network_paypal_connection_error'));
                }
            }
            catch(PayPal\Exception\PPConnectionException $e)
            {
                log_message('error', "Error when creating a billing agreements for referent transaction... " . $e->getMessage());
                $this->session->set_flashdata('error', $this->lang->line('text_app_error_when_adding_paypal_account'));
            }
        }
        else
        {
            $this->session->set_flashdata('error', $this->lang->line('text_app_need_to_authorized_billing_frist'));
        }   
        
        redirect( site_url('pay/add_paypal_account') );
    }
    
    private function _payment_method_added()
    {
        $this->load->model(array('webuser_model'));
        
        $user_id = $this->session->userdata('id');
        $webuser = $this->webuser_model->load_informations( $user_id );
        
        if(!empty($webuser))
        {
            $subject = "Successfully Added Payment Method";
            $details = array(
                'fname'   => ucfirst( $webuser->webuser_fname ),
                'company' => 'Winjob',
                'slogan'  => 'Hire Talented Freelancers For a Low Cost',
                'para1'   => 'Your new payment method has been add for your account. If you did not make this change, please <a href="' . site_url() . 'contact" style="color: #0061A7; text-decoration: none;">contact us</a>.'
            );

            $this->Sesmailer->sesemail($webuser->webuser_email, $subject, $this->Emailtemplate->emailview('set_primary_payment', $details));
        }
        
        $this->session->set_flashdata('success', $this->lang->line('text_app_payment_method_added'));
        redirect( base_url('pay/billing') );
    }
    
    public function set_paypal_express_checkout(){
       //TODO: Implement this function to handle cancellation from an employer.
    }
    
    public function set_primary()
    {
        $this->isEmployer(); 
        
        $user_id   = $this->session->userdata('id');
        $form_data = $this->input->post();
        
        if(empty( $form_data['service_payer_id'] ))
        {
            $this->session->set_flashdata('error', $this->lang->line('text_app_provide_a_valid_method'));
            redirect(back());
        }
        
        $this->load->model(array('payment_methods_model', 'webuser_model'));
        $method = $this->payment_methods_model->get_method_payment( $user_id, $form_data['service_payer_id'] );
        
        if( !empty($method) )
        {
            $this->payment_methods_model->reset_primary_method_payment( $user_id );

            $this->payment_methods_model->set_primary_method_payment( $user_id, $form_data['service_payer_id'] );
            
            $this->session->set_flashdata('success', $this->lang->line('text_app_payment_primary_setted'));
            
            $webuser = $this->webuser_model->load_informations( $user_id );
            
            if(!empty($webuser))
            {
                $subject = "Updated Primary Payment Method";
                $details = array(
                    'fname'   => ucfirst( $webuser->webuser_fname ),
                    'company' => 'Winjob',
                    'slogan'  => 'Hire Talented Freelancers For a Low Cost',
                    'para1'   => 'Your payment method has been updated for your account. If you did not make this change, please <a href="' . site_url() . 'contact" style="color: #0061A7; text-decoration: none;">contact us</a>.'
                );
                $this->Sesmailer->sesemail($result->webuser_email, $subject, $this->Emailtemplate->emailview('set_primary_payment', $details));
            }
        }
        else
        {
            $this->session->set_flashdata('error', $this->lang->line('text_app_payment_method_not_found'));
        }
        
        redirect(site_url("pay/billing"));
    }
    
    
    public function remove_method()
    {
        $this->isEmployer();
        
        $user_id   = $this->session->userdata('id');
        $form_data = $this->input->post();
        
        $this->load->model(array('payment_methods_model'));
        $method = $this->payment_methods_model->get_method_payment( $user_id, $form_data['service_payer_id'] );
        
        if( !empty($method) )
        {
            if($method->is_primary)
            {
                $this->session->set_flashdata('error', $this->lang->line('text_app_primary_payment_method_deletionçnot_allowed'));
            }
            else
            {
                $method = $this->payment_methods_model->soft_delete_payment_method( $user_id, $form_data['service_payer_id'] );
                $this->session->set_flashdata('success', $this->lang->line('text_app_payment_method_deleted'));
            }
        }
        else
        {
            $this->session->set_flashdata('error', $this->lang->line('text_app_payment_method_not_found'));
        }
        
        redirect(site_url("pay/billing"));
    }
    
    public function edit_card()
    {
        $this->isEmployer(); 
        
        $user_id   = $this->session->userdata('id');
        $form_data = $this->input->post();
        
        $this->load->model(array('payment_methods_model'));
        $method = $this->payment_methods_model->get_method_payment( $user_id, $form_data['service_payer_id'] );
        
        if( !empty($method) )
        {
            try
            {
                $this->load->model('common_mod');
                $countries        = $this->common_mod->load_countries();
                $service_payer_id = $form_data['service_payer_id'];
                
                $customer = \Stripe\Customer::retrieve( $service_payer_id );
                $card     = $customer->sources->retrieve( $customer->default_source );
                
                return $this->twig->display('webview/payment/twig/update_credit_card', compact('user_id', 'countries', 'service_payer_id', 'card'));
                
            } catch (Exception $e) {
                log_message('error', "Error when retreiving stripe customer... #" . $form_data['service_payer_id']);
                $this->session->set_flashdata('error', $this->lang->line('text_app_stripe_error_customer_retreiving'));
            }
        }
        else
        {
         $this->session->set_flashdata('error', $this->lang->line('text_app_payment_method_not_found'));
        }
        
        redirect(site_url("pay/billing"));
    }
    
    public function update_card_details(){
        
        $stripe_token = $this->input->post('stripeToken');
        
        if (!empty($stripe_token))
        {
            $customer_id = $this->input->post('customer_id');
            $user_id     = $this->session->userdata('id'); 
            
            try 
            {
                $customer         = \Stripe\Customer::retrieve($customer_id); // stored in your application
                $customer->source = $stripe_token;                            // obtained with Checkout
                $customer->save();
                $card_data        = $customer->sources->data[0];
                
                $webuser_payment_service = array(
                    'service_description' => sprintf( $this->lang->line('text_app_card_ending_in'), $card_data->brand, $card_data->last4 ),
                );
                
                $this->load->model(array('payment_methods_model'));
                $this->payment_methods_model->update_method( $user_id, $customer_id, $webuser_payment_service );
            
                $this->session->set_flashdata('success', $this->lang->line('text_app_payment_method_updated'));
            }
            catch(\Stripe\Error\Card $e) 
            {
                $body = $e->getJsonBody();
                log_message('error', "Error when retreiving stripe customer... #" . $form_data['service_payer_id'] . PHP_EOL . json_encode($body, JSON_PRETTY_PRINT, 512));
                $this->session->set_flashdata('error', $this->lang->line('text_app_payment_method_error_in_updating'));
              
            }
        }
        
        redirect(site_url("pay/billing"));
    }
    
    private function _filters_values()
    {
        $from          = $this->input->get('from');
        $from_internal = ( ! empty( $from ) ) ? date('Y-m-d', strtotime( $from ) ) : null;
        $from_date     = ( ! empty( $from ) ) ? date('D, M j, Y', strtotime( $from ) ) : null; 
        
        $to            = $this->input->get('to');
        $to_internal   = ( ! empty( $to ) ) ? date('Y-m-d', strtotime( $to ) ) : null;
        $to_date       = ( ! empty( $to ) ) ? date('D, M j, Y', strtotime( $to ) ) : null; 
        
        $employer          = $this->input->get('employer');
        $employer_internal = ! empty( $employer ) ? base64_decode($employer) : null;
        $trx_type          = $this->input->get('trx_type');
        
        return compact('from_internal', 'from_date', 'to_internal', 'to_date', 'trx_type', 'employer', 'employer_internal');
    }
    
    public function balance(){
        
        $this->checkForFreelancer();
        
        $user_id = $this->session->userdata('id');
        
        $filters =  $this->_filters_values();
        
        //load all model
        $this->load->model( array( 'payment_model' ) );
        
        //get all employer who has sent current freelancer money
        $employers = $this->payment_model->all_user_involved_in_txn( $user_id );
                    
        //calculate $amount_in_progress (Only for Hourly job contract)
        $amount_in_progress = $this->payment_model->get_amount_in_progress( $user_id );
        
        //calculate $amount_pending (hourly pending + fixed pending amount)
        $amount_pending     = $this->payment_model->get_amount_pending( $user_id );
        
        //calculate $amount_available (hourly available amount + fixed available amount)
        $amount_available   = $this->payment_model->get_amount_available( $user_id);
        
        //get all payment transaction
        $payment_txns       = $this->payment_model->get_payment_list( $user_id, $filters );
        
        //extract filters values ( from_internal, from_date, to_internal, to_date, trx_type, employer, employer_internal )
        extract( $filters );
        
        $this->twig->display('webview/freelancer/balance', compact(
            'amount_in_progress', 'amount_pending', 'amount_available',
            'from_date', 'to_date', 'trx_type', 'employer', 'employers', 'payment_txns'
        ));
        
    }
    
    /* TODO: Remove that code later. */
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

            JOIN webuser ON webuser.webuser_id = payments.buser_id

            JOIN jobs ON jobs.id = payments.job_id

            JOIN job_accepted ON job_accepted.job_id = payments.job_id

            JOIN job_bids ON job_bids.job_id = payments.job_id

            WHERE job_bids.user_id = payments.user_id

            AND job_accepted.fuser_id = payments.user_id

            AND payments.user_id =$user_id

            UNION ALL SELECT  'hourly' AS job_type, ja.id, dt.date as payment_create, 'hire' as hire_end_id, 'title' as title, dt.des as des,ja.fuser_id,ja.job_id,ja.contact_id, 'offer_bid_amount' as offer_bid_amount,u.webuser_fname,u.webuser_lname,'payment_gross' as payment_gross, 'txn_id' as txn_id,ja.contact_id as con_id,dt.amount as amount, '2' as type

            FROM daily_hourly_transaction dt

            LEFT JOIN job_accepted ja ON ja.contact_id = dt.contract_id

            LEFT JOIN webuser u ON u.webuser_id = dt.cuser_id

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
        $this->isEmployer();
        
        $this->load->model(array('payment_methods_model'));
        $all_payment_methods = $this->payment_methods_model->get_all( $this->session->userdata("id") );
        $this->twig->display('webview/payment/twig/billing', compact('all_payment_methods'));
    }


    public function remaining( )
    {
        if( $this->input->is_ajax_request())
        {
            $this->load->model('validators/contractValidator');
            
            $contract_id = $this->input->get('fmJob');
            $contract    = $this->contractValidator->is_valid_contract( $contract_id );
            
            if( $contract == false || ( ! $this->contractValidator->user_can_access_current_contract( $contract ) ) )
                return $this->ajax_response(array('message' => $this->contractValidator->get_error_message(), 'status' => 'error'));
            
            $this->load->model('job/bids_model');
            
            $title     = empty( $contract->hire_title ) ? $contract->hire_title : $contract->title ;
            $remaining = $this->bids_model->remaing_to_pay( $contract->job_id, $contract->fuser_id );
            
            $this->ajax_response(array('remaining' => $remaining, 'title' => $title, 'status' => 'success'));
        }
        else
        {
            redirect( home_url() );
        }
    }
    
    public function  contract()
    {   
        if( $this->input->is_ajax_request())
        {
            $this->load->model('validators/contractValidator');
            
            //extract all contract data value ($contract_id, $amount) 
            extract($this->input->post());
            
            $contract    = $this->contractValidator->is_valid_contract( $contract_id );
            
            if( $contract == false || ( ! $this->contractValidator->user_can_access_current_contract( $contract ) ) )
                return $this->ajax_response(array('message' => $this->contractValidator->get_error_message(), 'status' => 'error'));
            
            if( empty( $amount ) )
                $this->ajax_response(array('message' => $this->lang->line('text_job_invalid_amount'), 'status' => 'error'));
            
            $this->load->model(array('payment_model', 'contracts_model', 'job/bids_model'));
            
            $chargeUser = chargePrimary($contract->buser_id, $amount);

            if ($chargeUser['status_code'] == 1) {
                $this->ajax_response(array('message' => $this->lang->line('text_job_payment_insuffisant_fund'), 'status' => 'error' )); 
            }

            $this->payment_model->save_job_transaction($contract->job_id, $contract->fuser_id, $contract->buser_id, $amount, $action);
            $this->bids_model->update_fixedpay_amount($contract->job_id, $contract->fuser_id, $amount);

            $this->ajax_response(array('message' => $this->lang->line('text_job_payment_success'), 'status' => 'success' ));
        }
        else
        {
            redirect( home_url( ));
        }
    }
    
}
