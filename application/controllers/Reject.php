<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reject extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Category', 'Common_mod'));
    }

    public function index() {

        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            if (isset($_GET['job_id'])) {

                //$user_id = $this->session->userdata('id');
                $job_id = base64_decode($_GET['job_id']);
                $sender_id = $this->session->userdata('id');

                  // added by jahid start 
                
                $this->db->select('*,job_bids.id as bid_id,jobs.user_id as client_id,job_bids.user_id as freelancer_id');
                $this->db->from('job_bids');
                $this->db->join('webuser', 'webuser.webuser_id = job_bids.user_id', 'inner');
                $this->db->join('country', 'country.country_id = webuser.webuser_country', 'inner');
                $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
                $this->db->where('job_bids.job_id', $job_id);
                $this->db->where('job_bids.hired', '0');
                $this->db->where("(job_bids.withdrawn=1 OR job_bids.bid_reject=1)", NULL, FALSE);
                $query = $this->db->get();
                $records1 = $query->result();
                 
                
           
                
                
/*
                
                $this->db->select('*,job_bids.id as bid_id,jobs.user_id as client_id,job_bids.user_id as freelancer_id');
                $this->db->from('job_bids');
                $this->db->join('webuser', 'webuser.webuser_id = job_bids.user_id', 'inner');
                $this->db->join('country', 'country.country_id = webuser.webuser_country', 'inner');
                $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
                $this->db->where('job_bids.job_id', $job_id);
                $this->db->where('job_bids.status', '1'); 
                  // added by jahid start 
                $this->db->where("(job_bids.withdrawn=1 OR job_bids.bid_reject=1)", NULL, FALSE);
                // added by jahid end  
                $query = $this->db->get();
                $records2 = $query->result();
                  */
                
               // $records = array_merge($records1,$records2);
                 $records = $records1;

                 // added by jahid end  
                // total number of job Application
                $this->db->select('*');
                $this->db->from('job_bids');
                              // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 0);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
                $this->db->where(array('job_id' => $job_id, 'bid_reject' => 0, 'status!=1' => null));
                $query_totalApplication = $this->db->get();
                $Application_count = $query_totalApplication->num_rows();

                //total number of interview
                $this->db->select('*');
                $this->db->from('job_conversation');
                $this->db->join('job_bids', 'job_conversation.bid_id=job_bids.id', 'inner');
                $this->db->where('job_conversation.sender_id', $sender_id);
                $this->db->where('job_conversation.job_id', $job_id);
                $this->db->where('job_bids.bid_reject', 0);
                              // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 1);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
                $this->db->group_by('job_conversation.bid_id');
                $query = $this->db->get();
                $interview_count = $query->num_rows();

                //Offer count
                $this->db->select('*');
                $this->db->from('job_bids');
                              // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 2);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
                $this->db->where(array('job_id' => $job_id, 'bid_reject' => 0, 'hired' => '1'));
                $query_totaloffer = $this->db->get();
                $Offer_count = $query_totaloffer->num_rows();

                $this->db->select('*');
                $this->db->from('job_accepted');
                $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
                $this->db->where('job_accepted.buser_id', $sender_id);
                $this->db->where('job_accepted.job_id', $job_id);
                $this->db->where('job_bids.jobstatus', '0');
                              // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 3);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
                $query = $this->db->get();
                $hire_count = $query->num_rows();

                $this->db->where('id', $job_id);
                $q = $this->db->get('jobs');
                $jobDetails = $q->row();
             }
             
             $this->db->select('*');
			$this->db->from('webuser');
            $this->db->where('webuser.webuser_id', $sender_id);
            $query_status = $this->db->get();
			$ststus = $query_status->row();

            $data = array('messages' => $records, 'Application_count' => $Application_count, 'interview_count' => $interview_count, 'Offer_count' => $Offer_count, 'hire_count' => $hire_count, 'jobDetails' => $jobDetails,'ststus'=>$ststus, 'title' => 'Rejected - Winjob');
            $this->Admintheme->webview("reject", $data);
        }
    }

}
