<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Feedback extends CI_Controller{
    
    public function index()    {
        
        if ($this->Adminlogincheck->checkx()){
			
            
            
        }
    }
    
	public function fixed_freelancer()    {
        
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
			
            $data = array('job'=>$job,'freelancerfeedback'=>$freelancerfeedback,'clientfeedback'=>$clientfeedback,'job_end'=>$job_end);
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