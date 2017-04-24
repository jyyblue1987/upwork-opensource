<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Offered extends Winjob_Controller {

    private $process;
    private $user_id;
    private $employer;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Category', 'Common_mod', 'Webuser_model', 'Process', 'Employer', 'profile/ProfileModel'));

        $this->process = new Process();
        $this->user_id = $this->session->userdata('id');
        $this->employer = new Employer($this->user_id);
    }

    public function index() {
        
        $this->checkForEmployer();

        $paypalInfo = $this->input->post();
        if (!empty($paypalInfo)) {

            $data = array(
                'user_id' => $paypalInfo['custom'],
                'buser_id' => base64_decode($_GET['buser_id']),
                'job_id' => $paypalInfo["item_number"],
                'bid_id' => base64_decode($_GET['fbid_id']),
                'txn_id' => $paypalInfo["txn_id"],
                'payment_gross' => $paypalInfo["payment_gross"],
                'currency_code' => $paypalInfo["mc_currency"],
                'payer_email' => $paypalInfo["payer_email"]
            );

            $this->db->insert('payments', $data);
        }

        if (isset($_GET['job_id'])) {
            $records = array();
            $job_id = base64_decode($_GET['job_id']);
            $bids = $this->process->get_bids($job_id);
            $emp = $this->employer->is_active();
            $job_details = $this->process->get_job_details($job_id);

            $applicants = $this->process->get_applications($job_id);
            $rejects = $this->process->get_rejected($job_id);
            $offers = $this->process->get_offers($job_id);
            $hires = $this->process->get_hires($this->user_id, $job_id);
            $interviews = $this->process->get_interviews($this->user_id, $job_id);

            foreach($offers['data'] AS $_offers){
               $accepted_jobs = $this->process->accepted_jobs($_offers->webuser_id);
               $pic = $this->Adminforms->getdatax("picture", "webuser", $_offers->webuser_id);
               $country = $this->ProfileModel->get_country($_offers->webuser_country);
               $_pic = $pic != "" ? $pic : "assets/user.png";

                $records[] = array(
                   'pic' => $_pic,
                   'fname' => $_offers->webuser_fname,
                   'lname' => $_offers->webuser_lname,
                   'user_id' => $_offers->webuser_id,
                   'job_id' => $_offers->job_id,
                   'bid_id' => $_offers->bid_id,
                   'bid_amount' => $_offers->bid_amount,
                   'country' => ucfirst($country['country_name']),
                   'hire_title' => ucwords($_offers->hire_title),
                   'title' => ucwords($_offers->title)
                );
            }

            $data = array(
                'records' => $records,
                'jobId' => base64_encode($job_id),
                'status' => $emp,
                'applicants' => $applicants['rows'],
                'rejects' => $rejects['rows'],
                'offers' => $offers['rows'],
                'hires' => $hires['rows'],
                'interviews' => $interviews['rows'],
                'job_type' => ucfirst($job_details['job_type']),
                'job_title' => ucwords($job_details['title']),
                'title' => 'Offers - Winjob'
            );
        }

        $this->Admintheme->webview("offered", $data);
    }

}
