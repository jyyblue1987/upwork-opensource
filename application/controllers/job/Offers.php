<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Offer
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Offers extends Winjob_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load_language();
    }
    
    protected function load_language()
    {
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
        $this->load->model( array( 
            'webuser_model', 
            'skills_model', 
            'jobs_model', 
            'payment_methods_model', 
            'job/bids_model', 
            'payment_model', 
            'process'
        ));
    }
    
    public function index()
    {
        //Display offer for decision
        if($this->session->userdata('type') == FREELANCER)
            return $this->decide_on_offer();
        
        //display offer on client side.
        $this->checkForEmployer();
        
        // check if account is suspend then redirect to payment start 
        $user_id = $this->session->userdata(USER_ID);
        
        if( ! $this->webuser_model->is_active( $user_id) )
            redirect(site_url("pay/methods_card"));
        
        $payment_set    = $this->payment_methods_model->get_primary( $user_id );
        
        if( empty( $payment_set ) )
            redirect(site_url("pay/methods_card"));
        
        $freelancer_id = $this->input->get('user_id');
        $decoded_f_id  = base64_decode( $freelancer_id );
        $job_id        = $this->input->get('job_id');
        $decoded_j_id  = base64_decode( $job_id );
        
        if( empty( $freelancer_id ) || empty( $job_id ))
        {
            $this->session->set_flashdata('error', $this->lang->line('text_app_invalid_bid_parameter'));
            redirect(site_url("jobs-home"));
        }
        
        $job             = $this->jobs_model->load_informations( $decoded_j_id );
        $webuser_profile = $this->webuser_model->load_profile( $decoded_f_id ); 
        $bid             = $this->bids_model->load( $decoded_j_id, $decoded_f_id );
                        
        $data = array(
            'applier_id'   => $freelancer_id,
            'job_id'       => $job_id,
            'job_details'  => $job,
            'user_details' => $webuser_profile,
            'bid_details'  => $bid,
            'current_date' => date('d-m-Y'),
            'decoded_f_id' => $decoded_f_id,
            'decoded_j_id' => $decoded_j_id
        );
        
        $this->twig->display("webview/jobs/twig/offers", $data);
    }
    
    public function decide_on_offer()
    {
        $this->checkForFreelancer();
         
        $user_id = $this->session->userdata(USER_ID);
        
        $job_id = $this->input->get('fmJob');
        $bid_id = $this->input->get('bid_id');
        
        if(empty($job_id) || empty($bid_id))
        {
            $this->session->set_flashdata('error', 'Some parameters are missing.');
            redirect(back());
        }
        
        $job_id        = base64_decode($job_id);
        $bid_id        = base64_decode($bid_id);
        $job_details   = $this->jobs_model->load_offer($job_id, $bid_id );
        
        if(empty($job_details))
        {
            $this->session->set_flashdata('error', 'Offer does not exists or has been withdrawn by client.');
            redirect(back());
        }
        
        $user_details  = $this->webuser_model->load_profile( $user_id );
        $client_detail = $this->webuser_model->load_profile( $job_details->client_id );
        
        $data = array(
            'job_details'        => $job_details, 
            'client_details'     => $client_detail, 
            'user_details'       => $user_details
        );
        
        $this->twig->display("webview/jobs/twig/freelancer-offers", $data);
    }
    
    private function _generate_characters( $length )
    {
        $alphabets = range('A', 'Z');
        $numbers = range('0', '9');
        $final_array = array_merge($alphabets, $numbers);
        $rcovercode = '';
        $length = 10;
        while ($length--) {
            $key = array_rand($final_array);
            $rcovercode .= $final_array[$key];
        }
        
        return $rcovercode;
    }
    
    public function accept()
    {
        if(is_post())
        {
            if ( ! $this->Adminlogincheck->checkx() ){
                $this->ajax_response (array(
                    'message' => 'Refresh your browser before to process',
                    'status'  => 'error'
                ));
            }

            if ($this->session->userdata('type') != FREELANCER) 
            {
                $this->ajax_response (array(
                    'message' => 'You do not have the rights to decline this offer.',
                    'status'  => 'error'
                ));
            }
            
            parse_str($this->input->post('form'), $form);
            
            $user_id   = $this->session->userdata( USER_ID );
            $client_id = $form['client_id'];
            $message   = trim(rtrim($form['confo_notes']));
            $job_id    = $form['job_id'];
            $bid_id    = $form['bid_id'];
            $terms     = $form['terms'];
            
            if(empty($message))
            {
                $this->ajax_response (array(
                    'message' => 'Please enter a message.',
                    'status'  => 'error'
                ));
            }
            
            if($terms != 'on')
            {
                $this->ajax_response (array(
                    'message' => 'Please accept the user agreement.',
                    'status'  => 'error'
                ));
            }
            
            if(empty($bid_id) || empty($job_id) || empty($client_id ) || !is_numeric($client_id))
            {
                $this->ajax_response (array(
                    'message' => 'Please refresh your browser and try again.',
                    'status'  => 'error'
                ));
            }
            
            $job_id    = base64_decode($form['job_id']);
            $bid_id    = base64_decode($form['bid_id']);
            
            $bid = $this->bids_model->load_informations($bid_id);
        
            if(empty($bid) || $bid->job_progres_status != 2 || $bid->hired != '1' || $bid->user_id != $user_id)
            {
                $this->ajax_response (array(
                    'message'  => 'You accept or decline this offer.',
                    'status'   => 'error',
                    'redirect' => true,
                    'redirect_url' => site_url('my-offers')
                ));
            }
            
            /* contact id */
            $contact_id = $user_id . '_' . $this->_generate_characters( 10 );
            $payment    = '$'.$bid->bid_earning;
            
            $client_address = $this->webuser_model->load_address($client_id);
            
            if(!empty($client_address))
            {
                $address  = $client_address->address.' '.$client_address->address1;
                $address1 = $client_address->city.' '.$client_address->state.' '.$client_address->zipcode;
                $country  = $client_address->country;
            }
            
            $freelancer_tax = $this->webuser_model->load_tax_informations($user_id);
            
            if(!empty($freelancer_tax))
            {
                $fl_address  = $freelancer_tax->address.' '.$freelancer_tax->address_line1;
                $fl_address1 = $freelancer_tax->city.' '.$freelancer_tax->state.' '.$freelancer_tax->zipcode;
                $fl_country  = $freelancer_tax->country;
            }
            
            
            $freelancer_address = $this->webuser_model->load_address($user_id);
            
            if(!empty($client_address))
            {
                $address_profile  = $freelancer_address->address.' '.$freelancer_address->address1;
                $address1_profile = $freelancer_address->city.' '.$freelancer_address->state.' '.$freelancer_address->zipcode;
                $country_profile  = $freelancer_address->country;
            }
            
            $job        = $this->jobs_model->load_informations($bid->job_id);
            
            if (!empty($job)) {
                $job_title = $job->title;
            }
            
            $freelancer = $this->webuser_model->load_informations( $user_id );
            $client     = $this->webuser_model->load_informations( $client_id );
            
            $client_name     = ($client->webuser_fname . ' ' . $client->webuser_lname);
            $freelancer_name = ($freelancer->webuser_fname . ' ' . $freelancer->webuser_lname);
                    
            $subject      = "Invoice for Contract $contact_id";
            $company_name = $freelancer->webuser_company;
            
            $details = array(
                'fname'         => $freelancer_name,
                'company'       => 'Winjob',
                'verification'  => site_url()."jobs/" . str_replace(' ', '-', $job_title) . "/" . $form['job_id'],
                'slogan'        => 'Hire Talented Freelancers For a Low Cost',
                'para1'         => 'You have successfully received '.$payment.' from '.$company_name.'. Please see details below.',
                'payment'       => $payment,
                'company_name'  => $company_name,
                'client'        => $client_name,
                'date'          => date('F j, Y'),
                'contract'      => $contact_id,
                'invoice_no'    => mt_rand() . "<br>",
                'job_title'     => $job_title
            );
            
            $details_employer = array(
                'company'      => 'Winjob',
                'slogan'       => 'Hire Talented Freelancers For a Low Cost',
                'payment'      => $payment,
                'company_name' => $company_name,
                'client'       => $client_name,
                'freelancer'   => $freelancer_name,
                'date'         => date('F j, Y'),
                'contract'     => $contact_id,
                'invoice_no'   => !empty($invoice_no) ? $invoice_no : null,
                'job_title'    => $job_title,
                'address'      => $address,
                'address1'     => $address1,
                'country'      => $country,
                'fl_address'   => $fl_address ? $fl_address : $address_profile,
                'fl_address1'  => $fl_address1 ? $fl_address1 : $address1_profile,
                'fl_country'   => $fl_country ? $fl_country : $country_profile
            );
            
            //Email sent to client when offer is accepted 
            $accept_subject = "Job Offer has been Accepted by $freelancer_name";
            $accept_email = array(
                'company'      => 'Winjob',
                'slogan'       => 'Hire Talented Freelancers For a Low Cost',
                'fname'        => $client_name,
                'verification' => site_url()."jobs/" . str_replace(' ', '-', $job_title) . "/" . $form['job_id'],
                'para1'        => 'Your contract has started with ' . $freelancer_name . '. Please review the job post below.',
            );
            
            //Email sent to freelancer when offer is accepted
            $accept_freelancer_sbj = "You have Accepted Job Offer from $client_name";
            $accept_freelancer = array(
                'company'      => 'Winjob',
                'slogan'       => 'Hire Talented Freelancers For a Low Cost',
                'fname'        => $freelancer_name,
                'verification' => site_url()."jobs/" . str_replace(' ', '-', $job_title) . "/" . $form['job_id'],
                'para1'        => 'Your contract has started with '.$client_name.'. Please review the job post below.',
            );
            
            $this->Sesmailer->sesemail($freelancer_name, $subject, $this->Emailtemplate->emailview('freelancer_invoice', $details));
            $this->Sesmailer->sesemail($client->webuser_email,$subject,$this->Emailtemplate->emailview('employer_invoice', $details_employer));
            $this->Sesmailer->sesemail($client->webuser_email,$accept_subject,$this->Emailtemplate->emailview('job_offer', $accept_email));
            $this->Sesmailer->sesemail($freelancer->webuser_email,$accept_freelancer_sbj,$this->Emailtemplate->emailview('job_offer', $accept_freelancer));
            
            $offer_confo_data = array(
                'fuser_id'   => $user_id,
                'job_id'     => $job_id,
                'buser_id'   => $client_id,
                'bid_id'     => $bid_id,
                'comments'   => $message,
                'contact_id' => $contact_id,
            );
            
            $this->db->insert('job_accepted', $offer_confo_data);
            
            $this->bids_model->update(array(
                'job_progres_status' => 3,
                'hired' => '0'
            ), array(
                'user_id' => $user_id ,
                'job_id'  => $job_id
            ));
            
            $this->ajax_response (array(
                'message'      => 'Offer accepted.',
                'status'       => 'success',
                'redirect'     => true,
                'redirect_url' => site_url('win-jobs')
            ));
        }
        else
        {   
            $this->authorized();
            
            $job_id = $this->input->get('fmJob');
            $bid_id = $this->input->get('fmBiD');

            if(empty($job_id) || empty($bid_id))
            {
                $this->session->set_flashdata('error', 'Some parameters are missing.');
                redirect(back());
            }

            $display_job_id = $job_id;
            $display_bid_id = $bid_id;
            $job_id         = base64_decode($job_id);
            $bid_id         = base64_decode($bid_id);
            $job_details    = $this->jobs_model->load_offer($job_id, $bid_id );

            if(empty($job_details))
            {
                $this->session->set_flashdata('error', 'Offer does not exists or has been withdrawn by client.');
                redirect(back());
            }

            $user_id = $this->session->userdata('id');

            $user_details  = $this->webuser_model->load_profile( $user_id );
            $client_detail = $this->webuser_model->load_profile( $job_details->client_id );

            $data = array(
                'user_details'   => $user_details, 
                'client_details' => $client_detail,
                'job_id'         => $display_job_id,
                'bid_id'         => $display_bid_id
            );

            $this->twig->display('webview/jobs/twig/accept-offer', $data);
        }
    }
    
    public function decline()
    {
        if ( ! $this->Adminlogincheck->checkx() ){
            $this->ajax_response (array(
                'message' => 'Refresh your browser before to process',
                'status'  => 'error'
            ));
        }
        
        if ($this->session->userdata('type') != FREELANCER) 
        {
            $this->ajax_response (array(
                'message' => 'You do not have the rights to decline this offer.',
                'status'  => 'error'
            ));
        }
        
        $bid_id  = $this->input->post('bid_id');
        
        if(empty($bid_id))
        {
            $this->ajax_response (array(
                'message' => 'Please refresh your browser and try again.',
                'status'  => 'error'
            ));
        }
        
        $user_id = $this->session->userdata( USER_ID );
        
        $bid = $this->bids_model->load_informations($bid_id);
        
        if(empty($bid) || $bid->job_progres_status != 2 || $bid->hired != '1' || $bid->user_id != $user_id)
        {
            $this->ajax_response (array(
                'status'   => 'error',
                'redirect' => true,
                'redirect_url' => site_url('my-offers')
            ));
        }
        
        if($this->bids_model->update(array('hired' => '1'), array('id' => $bid_id)))
        {
            $all_payments = $this->payment_model->load_all_payment($bid_id);
            
            if(!empty($all_payments))
            {
                foreach($all_payments as $payment)
                {
                    //load related library
                    $service_library = 'winjob_' . strtolower($payment->service_name);
                    if( ! property_exists($this, $service_library) )
                        $this->load->library($service_library);
                    
                    if($this->{$service_library}->refund($payment->txn_id))
                    {
                        $this->payment_model->update(array('refund' => true), array('payment_id' => $payment->payment_id));
                    }
                }
            }
            
            $this->ajax_response (array(
                'message'      => 'Well done! You have successfully decline offer.',
                'status'       => 'success',
                'redirect'     => true,
                'redirect_url' => site_url('jobs-home')
            ));
        }
        else
        {
            $this->ajax_response (array(
                'message'      => 'An error has occured! Try to refresh your page and try again.',
                'status'       => 'error',
            ));
        }
    }
    
    public function hired()
    {
        if ( ! $this->Adminlogincheck->checkx() )
        {
            $this->ajax_response(array(
                'message' => 'Please refresh your page.',
                'status'  => 'error'
            ));
        }
            
        if ($this->session->userdata('type') != EMPLOYER) 
        {
            $this->ajax_response(array(
                'message' => 'You do not have the right to access to this page.',
                'status'  => 'error',
                'redirect'     => true,
                'redirect_url' => home_url(),
            ));
        }
        
        $buser_id    = $this->session->userdata( USER_ID );
        $applier_id  = $this->input->post('applier_id');
        $job_id      = $this->input->post('job_id');
        $title       = $this->input->post('title');
        $term        = $this->input->post('terms');
        
        if(empty($applier_id) || empty($job_id))
        {
            $this->ajax_response(array(
                'message' => 'An error has occurred! Refresh your page and try again',
                'status'  => 'error'
            ));
        }
        
        if(empty($term) || $term != 'on')
        {
            $this->ajax_response(array(
                'message' => 'Have you understand our Agreement and policy?',
                'status'  => 'error'
            ));
        }
        
        $job = $this->jobs_model->load_informations( $job_id );
        
        if(empty($job))
        {
            $this->ajax_response(array(
                'message' => 'The jobs do not exist or has been deleted',
                'status'  => 'error',
                'redirect'     => true,
                'redirect_url' => home_url(),
            ));
        }
        
        if($job->user_id != $buser_id)
        {
            $this->ajax_response(array(
                'message' => 'You do not have a rights on the current job.',
                'status'  => 'error',
                'redirect'     => true,
                'redirect_url' => home_url(),
            ));
        }
        
        $bid = $this->bids_model->load( $job_id, $applier_id );
        
        if(empty($bid))
        {
            $this->ajax_response(array(
                'message' => 'The current bid do not exists or has been deleted.',
                'status'  => 'error'
            )); 
        }
        
        $message    = $this->input->post('message');
        $start_date = $this->input->post('start_date');
        $budget     = (float)trim(rtrim($this->input->post('budget')));
        
        if ( ! empty( $budget ) ) {
            $this->bids_model->hire_on($job_id, $applier_id, $budget);
        }
        
        $budget_type = $this->input->post('budget_type');
        
        if( $job->job_type == FIXED_JOB_TYPE )
        {
            if($budget_type == 2)
            {
                $budget = $this->input->post('milestone_input');
            }
        }
        else
        {   
            $weekly_limit = $this->input->post('limit');
            
            if ($weekly_limit != 0) {
                $weekly_limit_amount = $this->input->post('weekly_limit_amount');
            } else {
                $weekly_limit_amount = 0.00;
            }
            
            $allow_freelancer = $this->input->post('allow_freelancer');
            if (empty($allow_freelancer)) 
            {
                $allow_freelancer = 0;
            }
        }
        
        $bid_data = array(
            'job_progres_status' =>  2, 
            'hired'              =>  '1',
            'hire_title'         =>  ( !empty($title) ? $title : $job->title ), 
            'hire_message'       =>  $message,
            'start_date'         =>  str_replace('/', '-', $start_date)
        ); 
        
        if( $job->job_type == FIXED_JOB_TYPE )
        {
            $additionnal_data = array(
                'fixedpay_amount'  => $budget,
                'fixed_pay_status' => $budget_type, 
                'payment_status'   => 0
            );
        }
        else
        {
            $additionnal_data = array(
                'weekly_limit'     => $weekly_limit, 
                'allow_freelancer' => $allow_freelancer, 
                'weekly_amount'    => $weekly_limit_amount, 
                'payment_status'   => 0
            );
        }
        
        $bid_data = array_merge($bid_data, $additionnal_data);
        
        if($job->job_type == FIXED_JOB_TYPE && !empty( $budget_type ) && !empty($budget))
        {
            //get employer primary method for charging.
            $primary = $this->payment_methods_model->get_primary( $buser_id );

            if( empty( $primary ) )
            {
                $this->ajax_response(array(
                    'message'      => 'Unsuccessfull.',
                    'status'       => 'error',
                    'redirect'     => true,
                    'redirect_url' => site_url("pay/methods_card"),
                ));
            }

            //load related library
            $service_library = 'winjob_' . strtolower($primary->service_name);
            if( ! property_exists($this, $service_library) )
                $this->load->library($service_library);

            $transaction_id = $this->{$service_library}->paid($budget, "usd", $primary);

            if( $transaction_id == null)
            {
                $this->ajax_response(array(
                    'message'      => 'Failed payment for insufficient funds.',
                    'status'       => 'error'
                ));
            }

            if ($budget_type == 1) 
            {
                $des = 'Full Paid';
            } 
            elseif ($budget_type == 2)
            {
                $des = 'Milestone';
            }

            $this->payment_model->save(array(
                'job_id'        => (int) $job_id,
                'user_id'       => (int) $applier_id,
                'buser_id'      => (int) $buser_id,
                'bid_id'        => $bid->id,
                'payment_gross' => $budget,
                'des'           => $des,
                'service_name'  => $primary->service_name,
                'txn_id'        => $transaction_id
            ));
        }
        
        if($this->bids_model->update($bid_data, array('user_id' => $applier_id , 'job_id' => $job_id)))
        { 
            $this->ajax_response(array(
                'message'      => 'Offer sent.',
                'status'       => 'success',
                'redirect'     => true,
                'redirect_url' => site_url("offered?job_id=" . base64_encode($job_id)),
            ));
        }
        else
        {
            $this->ajax_response(array(
                'message' => 'Unsuccessfull.',
                'status'  => 'error'
            ));
        }
    }

    public function active()
    {
        $this->checkForFreelancer();
        
        $user_id = $this->session->userdata(USER_ID);
        $offers  = $this->process->get_active_offers($user_id);
        $archived_offers  = $this->process->get_archived_offers($user_id);
        
        //dump($archived_offers, true); 
        
        $this->twig->display('webview/jobs/twig/my-offers', compact('offers', 'archived_offers'));
    }
}





















