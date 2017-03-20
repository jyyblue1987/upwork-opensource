<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Ended_jobs
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Ended_jobs extends Winjob_Controller{
    
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
			
            $data = array(
                        'acccept_jobList' => $acccept_jobList,
                        'past_hire'       => count( $acccept_jobList ),
                        'title'           => "Finished Jobs - Winjob");
            
            $this->twig->display('webview/jobs/twig/ended-jobs', $data);
        }
    }
}