<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Winsjob extends CI_Controller{
    
    public function index()    {
        
        if($this->session->userdata('type') != 2){
            redirect(site_url("jobs-home"));
        }
        
        if ($this->Adminlogincheck->checkx()){
            $user_id = $this->session->userdata('id');
            
             $this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created, webuser.cropped_image');
			$this->db->from('job_accepted');
			$this->db->join('webuser', 'webuser.webuser_id=job_accepted.buser_id', 'inner');
			$this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
			$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
			$this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
			$this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.fuser_id',$user_id);
			 $this->db->where('job_bids.jobstatus', '0' );
            
             $query=$this->db->get();
			$acccept_jobList = $query->result();
			
            $data = array('acccept_jobList'=>$acccept_jobList);
            $this->Admintheme->webview("jobs/winsjob", $data);
            
            
        }
    }
	public function endjobs()    {
        
        if ($this->Adminlogincheck->checkx()){
            if($this->session->userdata('type') != 2){
            redirect(site_url("jobs-home"));
        }
            $user_id = $this->session->userdata('id');
            
             $this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created');
			$this->db->from('job_accepted');
			$this->db->join('webuser', 'webuser.webuser_id=job_accepted.buser_id', 'inner');
			$this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
			$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
			$this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
			$this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.fuser_id',$user_id);
			 $this->db->where('job_bids.jobstatus', '1' );
            
             $query=$this->db->get();
			$acccept_jobList = $query->result();
			
            $data = array('acccept_jobList'=>$acccept_jobList);
            $this->Admintheme->webview("jobs/endjobs", $data);
            
            
        }
    }
    
}
?>