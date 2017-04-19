<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends Winjob_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load_language();
    }
    
    public function index()    {
        if ($this->Adminlogincheck->checkx()){
		
        }
    }
    
    protected function load_language(){
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
    
    public function contract(){
        
        $this->authorized();
        
        $job_id      = (int) base64_decode( $this->input->get( 'fmJob' ) );
        $user_id     = (int) $this->session->userdata('id'); 
        
        try{
            $this->load->model('jobs_model');
        }catch( RuntimeException $e ){
            log_message('debug', $e->getMessage());
            $this->session->set_flashdata('error', $this->lang->line('text_app_runtime_exception_message'));
            redirect( back( ) );
        }
        
        $employer_id  = null;
        $with_country = false; 
        
        if( $this->session->userdata('type') == FREELANCER ){
            $employer_id  = (int) base64_decode( $this->input->get( 'buser' ) );
            $with_country = true;
        }
        
        //load job and its related datas
        $job_status = $this->jobs_model->load_job_status( null, $user_id, $job_id, $with_country );
        
        //if job does not exists 
        if( empty( $job_status ) ){
            $this->session->set_flashdata('error', $this->lang->line('text_job_message_no_exists'));
            redirect( back( ) );
        }
        
        //has seen feedback
        $this->jobs_model->set_feedback_saw($job_id, $user_id);
        
        if($job_status.job_type == FIXED_JOB_TYPE){
            //get total paid
            $total_paid = $this->jobs_model->get_total_paid( $bid_id, $job_status->fixedpay_amount );
        }else{
            //get gain
            $gain_infos = $this->jobs_model->get_final_paid_infos($job_id, $user_id);
            if($gain_infos['amount_by_hour'] === null){
                $gain_infos['amount_by_hour'] = !empty($job_status->offer_bid_amount) ? $job_status->offer_bid_amount : $job_status->bid_amount;
            }
        }
         
        
        //get employer feeback 
        $employer_feedback = $this->jobs_model->get_feedbacks( $job_id, $employer_id, $user_id );
        
        //get freelancer feeback 
        $freelancer_feedback = $this->jobs_model->get_feedbacks( $job_id, $user_id, $user_id );
        
        $this->twig->display('webview/jobs/twig/contract', compact('job_status', 'total_paid', 'gain_infos', 'employer_feedback', 'freelancer_feedback'));
    }
    
	public function fixed_freelancer()    {
        
        if ($this->Adminlogincheck->checkx()){
			
            if($this->session->userdata('type') != 2){
            redirect(site_url("jobs-home"));
        }
            $jobId     = base64_decode($_GET['fmJob']);
            $user_id   = $this->session->userdata('id');
            $sender_id = base64_decode($_GET['buser']);
			
            $data_feedback=array('haveseen'=>0);
            $this->db->where('feedback_userid',$user_id);
            $this->db->where('feedback_job_id',$jobId);
            $this->db->where('sender_id !=',$user_id);
            $this->db->where('haveseen',1);
            $this->db->update('job_feedback',$data_feedback);
		
            $this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created');
            $this->db->from('job_accepted');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.buser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.fuser_id',$user_id);
            $this->db->where('job_accepted.job_id',$jobId);
            $query=$this->db->get();
            $job_status = $query->row();

            $this->db->select('*');
            $this->db->from('job_hire_end');
            $this->db->where('bid_id',$job->bid_id);
            $query_end=$this->db->get();
            $job_end = $query_end->result();
            
            $this->db->select('*');
            $this->db->from('job_feedback');
            $this->db->where('job_feedback.feedback_job_id',$jobId);
            $this->db->where('job_feedback.feedback_userid',$user_id);
            $this->db->where('job_feedback.sender_id',$sender_id);
            $this->db->order_by('job_feedback.feedback_id', "desc");
            $this->db->limit(1, 0);
            $query_client = $this->db->get();
            $clientfeedback = $query_client->row();
			
			
            $this->db->select('*');
            $this->db->from('job_feedback');
            $this->db->where('job_feedback.feedback_job_id',$jobId);
            $this->db->where('job_feedback.feedback_userid',$user_id);
            $this->db->where('job_feedback.sender_id',$user_id);
            $this->db->order_by('job_feedback.feedback_id', "desc");
            $this->db->limit(1, 0);
            $freelancer_Query = $this->db->get();
            $freelancerfeedback = $freelancer_Query->row();
			
            $data = array(
                'job'=>$job_status,
                'freelancerfeedback'=>$freelancerfeedback,
                'clientfeedback'=>$clientfeedback,
                'job_end'=>$job_end
            );
            
            $this->Admintheme->webview("feedback/fixed_freelancer", $data);
            
        }
    }
	
	public function hourly_freelancer()    {
        
        if ($this->Adminlogincheck->checkx()){
            if($this->session->userdata('type') != 2){
            redirect(site_url("jobs-home"));
        }
           $jobId = base64_decode($_GET['fmJob']);
			$user_id = $this->session->userdata('id');
			$sender_id = base64_decode($_GET['buser']);
			
			$data_feedback=array('haveseen'=>0);
			$this->db->where('feedback_userid',$user_id);
			$this->db->where('feedback_job_id',$jobId);
			$this->db->where('sender_id !=',$user_id);
			$this->db->where('haveseen',1);
			$this->db->update('job_feedback',$data_feedback);
			
			$this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created');
			$this->db->from('job_accepted');
			$this->db->join('webuser', 'webuser.webuser_id=job_accepted.buser_id', 'inner');
			$this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
			$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
			$this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
			$this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.fuser_id',$user_id);
			$this->db->where('job_accepted.job_id',$jobId);
			$query=$this->db->get();
			$job = $query->row();
			
			$this->db->select('*');
			$this->db->from('job_feedback');
			$this->db->where('job_feedback.feedback_job_id',$jobId);
			$this->db->where('job_feedback.feedback_userid',$user_id);
			$this->db->where('job_feedback.sender_id',$sender_id);
			$this->db->order_by('job_feedback.feedback_id', "desc");
			$this->db->limit(1, 0);
			$query_client = $this->db->get();
			$clientfeedback = $query_client->row();
			
			
			$this->db->select('*');
			$this->db->from('job_feedback');
			$this->db->where('job_feedback.feedback_job_id',$jobId);
			$this->db->where('job_feedback.feedback_userid',$user_id);
			$this->db->where('job_feedback.sender_id',$user_id);
			$this->db->order_by('job_feedback.feedback_id', "desc");
			$this->db->limit(1, 0);
			$freelancer_Query = $this->db->get();
			$freelancerfeedback = $freelancer_Query->row();
			
            $data = array('job'=>$job,'freelancerfeedback'=>$freelancerfeedback,'clientfeedback'=>$clientfeedback);
            $this->Admintheme->webview("feedback/hourly_freelancer", $data);  
        }
    }
	public function fixed_client()    {
        
        if ($this->Adminlogincheck->checkx()){
            if($this->session->userdata('type') != 1){
            redirect(site_url("find-jobs"));
        }

			 $jobId = base64_decode($_GET['fmJob']);
			$user_id = $this->session->userdata('id');
			$sender_id = base64_decode($_GET['fuser']);
			
			$data_feedback=array('haveseen'=>0);
			$this->db->where('feedback_userid',$sender_id);
			$this->db->where('feedback_job_id',$jobId);
			$this->db->where('sender_id',$sender_id);
			$this->db->where('haveseen',1);
			$this->db->update('job_feedback',$data_feedback);
			
			$this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created');
			$this->db->from('job_accepted');
			$this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
			$this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
			$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
			$this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
			$this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.fuser_id',$sender_id);
			$this->db->where('job_accepted.job_id',$jobId);
			$query=$this->db->get();
			$job = $query->row();
			
			$this->db->select('*');
			$this->db->from('job_hire_end');
			$this->db->where('bid_id',$job->bid_id);
			$query_end=$this->db->get();
			$job_end = $query_end->result();
		
			$this->db->select('*');
			$this->db->from('job_feedback');
			$this->db->where('job_feedback.feedback_job_id',$jobId);
			$this->db->where('job_feedback.feedback_userid',$sender_id);
			$this->db->where('job_feedback.sender_id',$user_id);
			$this->db->order_by('job_feedback.feedback_id', "desc");
			$this->db->limit(1, 0);
			$query_client = $this->db->get();
			$clientfeedback = $query_client->row();
			
			
			$this->db->select('*');
			$this->db->from('job_feedback');
			$this->db->where('job_feedback.feedback_job_id',$jobId);
			$this->db->where('job_feedback.feedback_userid',$sender_id);
			$this->db->where('job_feedback.sender_id',$sender_id);
			$this->db->order_by('job_feedback.feedback_id', "desc");
			$this->db->limit(1, 0);
			$freelancer_Query = $this->db->get();
			$freelancerfeedback = $freelancer_Query->row();
			
            $data = array('job'=>$job,'freelancerfeedback'=>$freelancerfeedback,'clientfeedback'=>$clientfeedback,'job_end'=>$job_end);
            $this->Admintheme->webview("feedback/fixed_client", $data);
        }
    }
	
	public function hourly_client()    {
        
        if ($this->Adminlogincheck->checkx()){
            if($this->session->userdata('type') != 1){
            redirect(site_url("find-jobs"));
        }

            $jobId = base64_decode($_GET['fmJob']);
			$user_id = $this->session->userdata('id');
			$sender_id = base64_decode($_GET['fuser']);
			
			$data_feedback=array('haveseen'=>0);
			$this->db->where('feedback_userid',$sender_id);
			$this->db->where('feedback_job_id',$jobId);
			$this->db->where('haveseen',1);
			$this->db->where('sender_id',$sender_id);
			$this->db->update('job_feedback',$data_feedback);
			
			$this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created');
			$this->db->from('job_accepted');
			$this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
			$this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
			$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
			$this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
			$this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.fuser_id',$sender_id);
			$this->db->where('job_accepted.job_id',$jobId);
			$query=$this->db->get();
			$job = $query->row();
			
			$this->db->select('*');
			$this->db->from('job_feedback');
			$this->db->where('job_feedback.feedback_job_id',$jobId);
			$this->db->where('job_feedback.feedback_userid',$sender_id);
			$this->db->where('job_feedback.sender_id',$user_id);
			$this->db->order_by('job_feedback.feedback_id', "desc");
			$this->db->limit(1, 0);
			$query_client = $this->db->get();
			$clientfeedback = $query_client->row();
			
			
			$this->db->select('*');
			$this->db->from('job_feedback');
			$this->db->where('job_feedback.feedback_job_id',$jobId);
			$this->db->where('job_feedback.feedback_userid',$sender_id);
			$this->db->where('job_feedback.sender_id',$sender_id);
			$this->db->order_by('job_feedback.feedback_id', "desc");
			$this->db->limit(1, 0);
			$freelancer_Query = $this->db->get();
			$freelancerfeedback = $freelancer_Query->row();
			
            $data = array('job'=>$job,'freelancerfeedback'=>$freelancerfeedback,'clientfeedback'=>$clientfeedback);
            $this->Admintheme->webview("feedback/hourly_client", $data);  
        }
    }
}
?>