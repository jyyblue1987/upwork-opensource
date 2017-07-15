<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Offered extends Winjob_Controller {

    private $process;
    private $user_id;
    private $employer;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Category', 'Common_mod', 'Webuser_model', 'Process', 'Employer', 'profile/ProfileModel', 'Job_work_diary_model', 'adminforms', 'job_details'));

        $this->process = new Process();
        $this->user_id = $this->session->userdata('id');
        $this->employer = new Employer($this->user_id);
		
		$this->load_language();
    }
	/*   Hui added for langugae  */
	protected function load_language(){
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
	/*   end */
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

        if (isset($_GET['job_id'])){
            $records = array();
            $job_id = base64_decode($_GET['job_id']);
            $bids = $this->process->get_bids($job_id);
            $emp = $this->employer->is_active();
            $job_details = $this->process->get_job_details($job_id);

           
            
            $offers = $this->process->get_offers($job_id);
          
			/*   Hui added for offered  */
			$user_id = $this->session->userdata(USER_ID);
			$this->job_details->init($user_id, $job_id );
			
			$applicants = $this->process->get_applications( $job_id, TRUE );
			$declined = $this->process->get_rejected( $job_id, TRUE);
			$offered = $this->process->get_offers( $job_id, TRUE );
			$hired = $this->process->get_hires( $user_id, $job_id, TRUE );
			$interviews = $this->process->get_interviews( $user_id, $job_id, TRUE );
			/*   end */
            
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
				
				/*   Hui added for offered  */
				$ended_jobs = $this->process->cnt_ended_jobs($_offers->webuser_id);
                $freelancer_profile = $this->ProfileModel->get_profile($_offers->webuser_id);
               $accepted_jobs = $this->process->accepted_jobs($_offers->webuser_id);
               $pic = $this->Adminforms->getdatax("picture", "webuser", $_offers->webuser_id);
               $country = $this->ProfileModel->get_country($_offers->webuser_country);
               $skills = $this->ProfileModel->get_skills($_offers->webuser_id);
               $user_rating = $this->Webuser_model->get_total_rating($_offers->webuser_id);
               $_pic = $pic != "" ? $pic : "assets/user.png";

               foreach($accepted_jobs AS $a_jobs){
                   $feedbacks = $this->process->get_feedbacks($a_jobs->fuser_id, $a_jobs->job_id);
                   $diary = $this->Job_work_diary_model->get_work_hours($a_jobs->fuser_id, $a_jobs->job_id);

                    foreach($diary AS $_diary){
                        $total_work += $_diary->total_hour;
                    }
                    
                   if($a_jobs->jobstatus == 1){
                       if(!empty($feedbacks)){
                            if($a_jobs->job_type == 'fixed'){
                                $price = $a_jobs->fixedpay_amount;
                                $feedbackScore += ($feedbacks['feedback_score'] * $price);
                                $budget += $price;
                            }else{
                                
                                if($a_jobs->offer_bid_amount){
                                    $amount = $a_jobs->offer_bid_amount;
                                }else{
                                    $amount = $a_jobs->bid_amount;
                                }

                                $price = $a_jobs->fixedpay_amount * $amount;
                                $feedbackScore += ($feedbacks['feedback_score'] * $price);
                                $budget += $price;
                            }
                        }
                    }
                }
				
				if($feedbackScore && $budget) {
					$totalscore = $feedbackScore / $budget;
					$rating_feedback = ($totalscore/5)*100;
				}
				
				
				
				$applicant = [
					'ended_jobs' => $ended_jobs,
					'tagline' => ucfirst($freelancer_profile['tagline']),
					'earned' => $budget,
					'totalscore' => $totalscore,
					'rating_feedback' => $rating_feedback,
					'rating' => $user_rating,
					'total_work' => $total_work,
					'pic' => $pic != "" ? $pic : "assets/user.png",
					'fname' => $_offers->webuser_fname,
					'lname' => $_offers->webuser_lname,
					'hire_url' => site_url("jobs/offers?user_id=" . base64_encode($_offers->webuser_id)
						. "&job_id=" . base64_encode($this->job_details->get_jobid())),
					'profile_url' => site_url("canceloffer?bid_id=") . base64_encode($_offers->bid_id) . "&job_id=" . base64_encode($this->job_details->get_jobid()),
					'user_id' => $_offers->webuser_id,
					'skills' => $skills,
					'country' => ucfirst($country['country_name']),
					'cancel_url' => site_url("canceloffer?bid_id=") . base64_encode($_offers->bid_id) . "&job_id="
						. base64_encode($this->job_details->get_jobid()),
				];
				
				$applications[] = array(
					'job' => $this->job_details,
					'bid' => $_offers,
					'applicant' => $applicant,
					'decline' => '3',
					'bid_reject' => $_offers->bid_reject
				);
			
				/*   end */
            }
        }
		$this->twig->display('webview/jobs/twig/applications', [
        	'is_active' => $this->employer->is_active(),
            'applications' => $applications,
			'job_type' => $this->job_details->get_jobtype(),
			'job_title' => $this->job_details->get_title(),
			'display_job_id' => base64_encode($job_id),
            'applicants' => $applicants,
			'declined' => $declined,
			'offered' => $offered,
			'hired' => $hired,
			'display' => 'offered',
			'interviews' => $interviews
			]);
    }

}
