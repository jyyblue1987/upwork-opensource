<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Win_jobs
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Win_jobs extends Winjob_Controller{
    
    public function __construct() {
        parent::__construct();
        // added by (Donfack Zeufack Hermann) start 
        // load the default language for the current user.
        $this->load_language();
        // added by (Donfack Zeufack Hermann) end
    }
    protected function load_language(){
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
    
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
            
            $this->load->model('jobs_model');
            date_default_timezone_set("UTC"); 
            $today               = date('y-m-d', strtotime('today'));
            $this_week_start     = date('y-m-d', strtotime('monday this week'));
            
            $job_ids             = $this->extrat_all_job_ids( $acccept_jobList );
            $freelancer_job_hour = $this->jobs_model->get_each_work_total_hour($job_ids, $user_id, $this_week_start, $today);
                       
            $data = array(
                        'acccept_jobList' => $acccept_jobList,
                        'count_' => count( $acccept_jobList ),
                        'title' => "My Jobs - Winjob",
                        'freelancer_job_hour' => $freelancer_job_hour
                    );
            
            $this->twig->display('webview/jobs/twig/win-jobs', $data);            
        }
    }
}