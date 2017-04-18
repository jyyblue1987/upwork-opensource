<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon; 

class Freelancerinvite extends Winjob_Controller {
	
    public function __construct()
    {
        parent::__construct();
        
        $this->load_language();
        
        $this->load->model(array('common_mod', 'Category', 'profile/ProfileModel', 'Process', 'jobs_model'));
        $this->process = new Process();
      
    }
    
    /**
     * Load the appropriate language file
     */
    protected function load_language(){
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
	

    public function index() {

        $this->checkForFreelancer();
        
        $job_id = $this->input->get('fmJob');
        $id = $this->session->userdata('id');
        
        if(empty($job_id))
        {
            $this->session->set_flashdata('error', $this->lang->line('text_app_invalid_application_parameter'));
            redirect( home_url() );
        }
        
        $this->load->model(array(
            'job/bids_model', 'timezone', 'payment_methods_model', 
            'job_work_diary_model', 'webuser_model', 'payment_model'
        ));
        
        $postId       = base64_decode($job_id);
	$record       = $this->jobs_model->load_client_infos( $postId );
        $bids_details = $this->bids_model->load($postId, $id);
        
        if( empty( $bids_details ) ){
            //$this->session->set_flashdata('error', $this->lang->line('text_app_invalid_application_state'));
            redirect( home_url() );
        }
           
       $conversation       = $this->process->get_conversation($postId, $bids_details->id);
       
       if( ! empty( $conversation['data'] ) )
        {
            $all_conv_ids = array();
            
            foreach ($conversation['data'] AS $_convo) 
            {
                $all_conv_ids[] =  $_convo->id;
            }

            $images = $this->process->get_all_images_of_each_message( $all_conv_ids );
        }
        
        $job_skills = $this->jobs_model->get_skills( $postId );
        $applicants = $this->process->get_applications($postId);
        $interviews = $this->process->get_interviews($record->user_id, $postId);
        $hires      = $this->process->get_hires($record->user_id, $postId);
        
        //Get the timezone.
        $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS, null, " AND webuser_id=" . $id);
        $timezone              = $this->timezone->get($webUserContactDetails['rows'][0]['timezone']);
        $user_timezone         = get_right_timezone( $timezone['name'] );
        $date                  = Carbon::now( new DateTimeZone( $user_timezone ) );
        
        $payment_set    = $this->payment_methods_model->get_primary( $record->user_id );
        $record_sidebar = $this->jobs_model->num_sent_by( $record->user_id );
        $record_hire    = $this->jobs_model->number_freelancer_hired($record->user_id);
        $workedhours    = $this->job_work_diary_model->get_hour_work_for( $record->user_id );
        $country        = $this->ProfileModel->get_country($record->webuser_country);
        $attachments    = $this->process->get_attachments( $bids_details->id );
        $rating         = $this->webuser_model->get_total_rating( $record->user_id, true );
        $amount_spent   = $this->payment_model->get_amount_spent( $record->user_id );
        
        $data = array(
            'value'            => $record,
            'subcategory_name' => $this->jobs_model->get_category( $record->category ),
            'attachments'      => explode(",", $record->userfile),
            'applicants'       => $applicants['rows'],
            'hires'            => $hires['rows'], 
            'interviews'       => $interviews['rows'],
            'bid_details'      => $bids_details,
            'conversation'     => $conversation,
            'images'           => $images,
            'fname'            => $record->webuser_fname,
            'lname'            => $record->webuser_lname,
            'crt_user_time'    => $date, //Current time from user timezone
            'user_timezone'    => $user_timezone,
            'payment_set'      => $payment_set,
            'record_sidebar'   => $record_sidebar,
            'hire'             => $record_hire,
            'skills'           => $job_skills,
            'workedhours'      => $workedhours, 
            'country'          => ucfirst($country['country_name']),
            'cover_letter'     => $bids_details->cover_latter, 
            'user_id'          => $record->clientid,
            'f_id'             => $bids_details->user_id,
            'f_attachments'    => $attachments, 
            'accepted_jobs'    => $accepted_jobs,
            'rating'           => $rating,
            'amount_spent'     => $amount_spent
        );
        
        $this->twig->display('webview/twig/my-interview', $data);
    }
}
