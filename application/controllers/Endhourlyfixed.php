<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Endhourlyfixed extends CI_Controller {

    public function index() {

        if ($this->Adminlogincheck->checkx()) {

        }
    }

    public function fixed_freelancer() {

        if ($this->Adminlogincheck->checkx()) {
            
            $jobId = base64_decode($_GET['fmJob']);
            $user_id = $this->session->userdata('id');
            $client_id = base64_decode($_GET['buser']);
            
            $this->db->select('*,jobs.status AS job_status,jobs.job_duration AS jobduration,jobs.created AS job_created');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.buser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.buser_id', $client_id);
            $this->db->where('job_accepted.fuser_id', $user_id);
            $this->db->where('job_accepted.job_id', $jobId);
            $query = $this->db->get();
            $job = $query->row();

            $this->db->select('*');
            $this->db->from('job_hire_end');
            $this->db->where('bid_id', $job->bid_id);
            $query_end = $this->db->get();
            $job_end = $query_end->result();

            $data = array('job' => $job, 'job_end' => $job_end);
            $this->Admintheme->webview("endhourlyfixed/fixed_freelancer", $data);
        }
    }

    public function hourly_freelancer() {

        if ($this->Adminlogincheck->checkx()) {

            $jobId = base64_decode($_GET['fmJob']);
            $user_id = $this->session->userdata('id');
            $client_id = base64_decode($_GET['buser']);
            $this->db->select('*,jobs.status AS job_status,jobs.job_duration AS jobduration,jobs.created AS job_created');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.buser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.buser_id', $client_id);
            $this->db->where('job_accepted.fuser_id', $user_id);
            $this->db->where('job_accepted.job_id', $jobId);
            $query = $this->db->get();
            $job = $query->row();


            $data = array('job' => $job);
            $this->Admintheme->webview("endhourlyfixed/hourly_freelancer", $data);
        }
    }

    public function fixed_client() {
        if ($this->Adminlogincheck->checkx()) {

            $jobId = base64_decode($_GET['fmJob']);
            $sender_id = $this->session->userdata('id');
            $user_id = base64_decode($_GET['fuser']);
            $this->db->select('*,jobs.status AS job_status,jobs.job_duration AS jobduration,jobs.created AS job_created');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.buser_id', $sender_id);
            $this->db->where('job_accepted.fuser_id', $user_id);
            $this->db->where('job_accepted.job_id', $jobId);
            $query = $this->db->get();
            $job = $query->row();

            $this->db->select('*');
            $this->db->from('job_hire_end');
            $this->db->where('bid_id', $job->bid_id);
            $query_end = $this->db->get();
            $job_end = $query_end->result();

            $data = array('job' => $job, 'job_end' => $job_end);
            $this->Admintheme->webview("endhourlyfixed/fixed_client", $data);
        }
    }

    public function hourly_client() {

        if ($this->Adminlogincheck->checkx()) {

            $jobId = base64_decode($_GET['fmJob']);
            $sender_id = $this->session->userdata('id');
            $user_id = base64_decode($_GET['fuser']);
            $this->db->select('*,jobs.status AS job_status,jobs.job_duration AS jobduration,jobs.created AS job_created');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.buser_id', $sender_id);
            $this->db->where('job_accepted.fuser_id', $user_id);
            $this->db->where('job_accepted.job_id', $jobId);
            $query = $this->db->get();
            $job = $query->row();


            $data = array('job' => $job);
            $this->Admintheme->webview("endhourlyfixed/hourly_client", $data);
        }
    }

    public function end_contactfromSubmit() {
        if ($this->Adminlogincheck->checkx()) {
            parse_str($_POST['form'], $form);
            //if(isset($form['optradio']) && $form['optradio'] ==2 ){
            //	$paidtype = "2";
            //	$paidAmount = $form['endpay'];
            //}else{
            //	$paidAmount = 0.0;
            //	$paidtype = "0";
            //}
            $job_type = $form['job_type'];
            $skills = $form['skills'];
            $quality = $form['quality'];
            $ability = $form['ability'];
            $deadline = $form['deadline'];
            $communication = $form['communication'];
            $score = $form['score'];
            $Comment = $form['Comment'];
            $jobId = $form['job_id'];
            $user_id = $form['user_id'];
            $client_id = $form['clientid'];
            $offer_end = array(
                'feedback_job_id' => $jobId,
                'feedback_userid' => $user_id,
                'feedback_clientid' => $client_id,
                'sender_id' => $form['sender_id'],
                'feedback_skill' => $skills,
                'feedback_quality' => $quality,
                'feedback_ability' => $ability,
                'feedback_deadline' => $deadline,
                'feedback_communication' => $communication,
                'feedback_score' => $score,
                'feedback_comment' => $Comment,
                'haveseen' => 1,
            );

            $this->db->insert('job_feedback', $offer_end);


            //$this->db->select('*');
            //$this->db->from('job_bids');
            //$this->db->where('user_id',$user_id);
            //$this->db->where('job_id',$jobId);
            //$query=$this->db->get();
            //$jobtest = $query->row();
            //$bid_id =  $jobtest->id;

            if ($jobtest->end_date == "") {
                $date = date("Y-m-d H:m:s");
                $data_bids = array('jobstatus' => 1, 'end_date' => $date);
                $this->db->where('user_id', $user_id);
                $this->db->where('job_id', $jobId);
                $this->db->update('job_bids', $data_bids);
            } else {
                $data_bids = array('jobstatus' => 1,);
                $this->db->where('user_id', $user_id);
                $this->db->where('job_id', $jobId);
                $this->db->update('job_bids', $data_bids);
            }

//			if($job_type == "fixed"){
//
//				 $jobendpay_end = array(
//						'bid_id' => $bid_id,
//						'weekly_limit' =>0 ,
//						'offer_bid_amount'=>NULL,
//						'offer_bid_fee' => NULL,
//						'offer_bid_earning' =>NULL,
//						'fixed_pay_status' => $paidtype,
//						'weekly_amount' =>0.00,
//                        'fixedpay_amount' =>$paidAmount,
//					 );
//
//				$this->db->insert('job_hire_end',$jobendpay_end);
//			}


            $response['success'] = true;
            print_r(json_encode($response));
        }
    }

    public function end_contactfromclient() {
        if ($this->Adminlogincheck->checkx()) {
            parse_str($_POST['form'], $form);
            if (isset($form['optradio']) && $form['optradio'] == 2) {
                $paidtype = "2";
                $paidAmount = $form['endpay'];
                //updates by haseeburrehman.com starts
                $user_id = $this->session->userdata('id');
                $chargeUser = chargePrimary($user_id, $paidAmount);
                if($chargeUser['status_code'] == 1){
                  $response['success'] = "insufficient";
                  print_r(json_encode($response));
                  die();
                }

                //updates by haseeburrehman.com ends
            } else {
                $paidAmount = 0.0;
                $paidtype = "0";
            }
            $job_type = $form['job_type'];
            $skills = $form['skills'];
            $quality = $form['quality'];
            $ability = $form['ability'];
            $deadline = $form['deadline'];
            $communication = $form['communication'];
            $score = $form['score'];
            $Comment = $form['Comment'];
            $jobId = $form['job_id'];
            $user_id = $form['user_id'];
            $client_id = $form['clientid'];
            $offer_end = array(
                'feedback_job_id' => $jobId,
                'feedback_userid' => $user_id,
                'feedback_clientid' => $client_id,
                'sender_id' => $form['sender_id'],
                'feedback_skill' => $skills,
                'feedback_quality' => $quality,
                'feedback_ability' => $ability,
                'feedback_deadline' => $deadline,
                'feedback_communication' => $communication,
                'feedback_score' => $score,
                'feedback_comment' => $Comment,
                'haveseen' => 1,
            );

            $this->db->insert('job_feedback', $offer_end);


            $this->db->select('*');
            $this->db->from('job_bids');
            $this->db->where('user_id', $user_id);
            $this->db->where('job_id', $jobId);
            $query = $this->db->get();
            $jobtest = $query->row();
            $bid_id = $jobtest->id;

            if ($jobtest->end_date == "") {
                $date = date("Y-m-d H:m:s");
                $data_bids = array('jobstatus' => 1, 'end_date' => $date);
                $this->db->where('user_id', $user_id);
                $this->db->where('job_id', $jobId);
                $this->db->update('job_bids', $data_bids);
            } else {
                $data_bids = array('jobstatus' => 1,);
                $this->db->where('user_id', $user_id);
                $this->db->where('job_id', $jobId);
                $this->db->update('job_bids', $data_bids);
            }

            if ($job_type == "fixed") {

                $jobendpay_end = array(
                    'bid_id' => $bid_id,
                    'weekly_limit' => 0,
                    'offer_bid_amount' => NULL,
                    'offer_bid_fee' => NULL,
                    'offer_bid_earning' => NULL,
                    'fixed_pay_status' => $paidtype,
                    'weekly_amount' => 0.00,
                    'fixedpay_amount' => $paidAmount,
                );

                $this->db->insert('job_hire_end', $jobendpay_end);

                if ($paidAmount != 0) {
                    $data['job_id'] = (int) $jobId;
                    $data['user_id'] = (int) $user_id;
                    $data['buser_id'] = (int) $client_id ;
;


                    if ($paidAmount == 1) {
                        $data['des'] = 'Payment';
                    } elseif ($paidAmount == 2) {
                        $data['des'] = 'Milestone';
                    }
                    $data['payment_gross'] = $paidAmount;

                    $this->db->insert('payments', $data);
                }
            }


            $response['success'] = "done";
            print_r(json_encode($response));
        }
    }

}

?>
