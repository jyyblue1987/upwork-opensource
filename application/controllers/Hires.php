<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hires extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Category', 'Common_mod'));
    }

    public function index() {

        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }
$sender_id = $this->session->userdata(USER_ID);
            $user_id = $this->session->userdata('id');
            $jobId = base64_decode($_GET['job_id']);
            $this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created');
            $this->db->from('job_accepted');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.buser_id', $user_id);
            $this->db->where('job_accepted.job_id', $jobId);
            $this->db->where('job_bids.jobstatus', '0');
                          // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 3);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
			 

            $query = $this->db->get();
            $acccept_jobList = $query->result();



            //total number of interview
    // added by jahid start 
           
                 $this->db->select('*');
                $this->db->from('job_conversation');
                $this->db->join('job_bids', 'job_conversation.bid_id=job_bids.id', 'inner');
                $this->db->where('job_conversation.sender_id', $sender_id);
                $this->db->where('job_conversation.job_id', $job_id);
                $this->db->where('job_bids.bid_reject', 0);
                   
             $this->db->where('job_bids.job_progres_status', 1);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             
                $this->db->group_by('job_conversation.bid_id');
                $query = $this->db->get();
                $interview_count = $query->num_rows();
                
                // added by jahid end 

            // total number of job
            $this->db->select('*');
            $this->db->from('job_bids');
                // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 0);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
                 // added by jahid end 
            $this->db->where(array('job_id' => $jobId, 'status!=1' => null));
            $query_totalApplication = $this->db->get();
            $Application_count = $query_totalApplication->num_rows();

            //Offer count
            $this->db->select('*');
            $this->db->from('job_bids');
            $this->db->where('job_bids.hired', '1');
            $this->db->where('job_bids.job_id', $jobId);
                            // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 2);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
                 // added by jahid end 
            $query_totaloffer = $this->db->get();
            $Offer_count = $query_totaloffer->num_rows();

//hire
            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->where('job_accepted.buser_id', $sender_id);
            $this->db->where('job_accepted.job_id', $jobId);
            $this->db->where('job_bids.jobstatus', '0');
            
                            // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 3);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
                 // added by jahid end 
            
            $query = $this->db->get();
            $hire_count = $query->num_rows();
// reject count
            $this->db->select('*');
            $this->db->from('job_bids');
             // added by jahid start 
            $this->db->where(array('job_id' => $jobId));
            $this->db->where("(withdrawn=1 OR bid_reject=1)", NULL, FALSE);
             // added by jahid end 
            $query_totalreject = $this->db->get();
            $reject_count = $query_totalreject->num_rows();
            $data = array('acccept_jobList' => $acccept_jobList, 
                'interview_count' => $interview_count, 
                'Application_count' => $Application_count,
                'jobId' => $jobId,
                'hire_count' => $hire_count,
                'reject_count' => $reject_count,
                'Offer_count' => $Offer_count,
                    );


            $this->Admintheme->webview("hires", $data);
        }
    }

}
