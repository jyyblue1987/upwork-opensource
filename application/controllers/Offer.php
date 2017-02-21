<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Offer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Category', 'Common_mod'));
    }

    public function index() {

        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $paypalInfo = $this->input->post();
            if (!empty($paypalInfo)) {

                $data['user_id'] = $paypalInfo['custom'];
                $data['buser_id'] = base64_decode($_GET['buser_id']);
                $data['job_id'] = $paypalInfo["item_number"];
                $data['bid_id'] = base64_decode($_GET['fbid_id']);
                $data['txn_id'] = $paypalInfo["txn_id"];
                $data['payment_gross'] = $paypalInfo["payment_gross"];
                $data['currency_code'] = $paypalInfo["mc_currency"];
                $data['payer_email'] = $paypalInfo["payer_email"];
                //$data['payment_status']    = $paypalInfo["payment_status"];

                $this->db->insert('payments', $data);
            }




            if (isset($_GET['job_id'])) {

                //$user_id = $this->session->userdata('id');
                $job_id = base64_decode($_GET['job_id']);
                $sender_id = $this->session->userdata('id');

                $this->db->select('*,job_bids.id as bid_id');
                $this->db->from('job_bids');
                $this->db->join('webuser', 'webuser.webuser_id = job_bids.user_id', 'inner');
                $this->db->join('country', 'country.country_id = webuser.webuser_country', 'inner');
                $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
                $this->db->where('job_bids.job_id', $job_id);
                $this->db->where('job_bids.hired', '1');
                $this->db->where('job_bids.bid_reject', 0);
                
                              // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 2);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
                
                $this->db->group_by('bid_id');
                $query = $this->db->get();
                $conversation_count = $query->num_rows();
                $result = $query->result();


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

                // total number of job
                $this->db->select('*');
                $this->db->from('job_bids');
                $this->db->where(array('job_id' => $job_id, 'bid_reject' => 0, 'status!=1' => null));
                                              // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 0);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
                $query_totalApplication = $this->db->get();
                $Application_count = $query_totalApplication->num_rows();

                //Offer count
                $this->db->select('*');
                $this->db->from('job_bids');
                                              // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 2);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
                $this->db->where(array('job_id' => $job_id, 'hired' => '1'));
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


                // reject count
                $this->db->select('*');
                $this->db->from('job_bids');
                // added by Jahid start 
                $this->db->where(array('job_id' => $job_id));
                $this->db->where("(withdrawn=1 OR bid_reject=1)", NULL, FALSE);
                // added by Jahid end 
                $query_totalreject = $this->db->get();
                $reject_count = $query_totalreject->num_rows();
                
                
               $this->db->where('id', $job_id);
               $q = $this->db->get('jobs');
               $jobDetails = $q->row();
               
            }


            $data = array('jobDetails' => $jobDetails,'messages' => $result, 'hire_count' => $hire_count, 'interview_count' => $interview_count, 'Application_count' => $Application_count, 'Offer_count' => $Offer_count, 'reject_count' => $reject_count);
            $this->Admintheme->webview("offer", $data);
        }
    }

}
