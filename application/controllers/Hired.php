<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hired extends CI_Controller {

    private $process;
    private $user_id;
    private $employer;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Category', 'Common_mod', 'Webuser_model', 'Process', 'Employer', 'profile/ProfileModel', 'Job_work_diary_model'));
        $this->process = new Process();
        $this->user_id = $this->session->userdata('id');
        $this->employer = new Employer($this->user_id);
    }

    public function index() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

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

            foreach($hires['data'] AS $_interviews){
               $pic = $this->Adminforms->getdatax("picture", "webuser", $_interviews->webuser_id);
               $country = $this->ProfileModel->get_country($_interviews->webuser_country);
               $_pic = $pic != "" ? $pic : "assets/user.png";

                $records[] = array(
                   'pic' => $_pic,
                   'fname' => $_interviews->webuser_fname,
                   'lname' => $_interviews->webuser_lname,
                   'user_id' => $_interviews->webuser_id,
                   'job_id' => $_interviews->job_id,
                   'bid_id' => $_interviews->id,
                   'bid_amount' => $_interviews->bid_amount,
                   'country' => ucfirst($country['country_name']),
                   'fixedpay_amount' => $_interviews->fixedpay_amount,
                   'weekly_limit' => $_interviews->weekly_limit,
                   'hire_title' => ucwords($_interviews->hire_title),
                   'offer_bid' => $_interviews->offer_bid_amount,
                   'fuser_id' => $_interviews->fuser_id
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
                'title' => 'Hires - Winjob'
            );

            $this->Admintheme->webview("hired", $data);
        }
    }

}
