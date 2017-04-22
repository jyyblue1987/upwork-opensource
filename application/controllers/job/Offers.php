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
            'webuser_model', 'skills_model', 'jobs_model', 
            'payment_methods_model', 'job/bids_model', 'payment_model'
        ));
    }
    
    public function index()
    {
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
            'current_date' => date('d/m/Y'),
            'decoded_f_id' => $decoded_f_id,
            'decoded_j_id' => $decoded_j_id
        );
        
        $this->twig->display("webview/jobs/twig/offers", $data);
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
            'hired'              =>  1,
            'hire_title'         =>  ( !empty($title) ? $title : $job->title ), 
            'hire_message'       =>  $message,
            'start_date'         =>  $start_date
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
        
        if($this->bids_model->update($bid_data, array('user_id' => $applier_id , 'job_id' => $job_id)))
        {
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
                
                $transaction = $this->{$service_library}->paid($budget, "usd", $primary);
                
                if( $transaction == null)
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
                    'payment_gross' => $budget,
                    'des'           => $des
                ));
            }
            
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
}





















