<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Declined extends Winjob_Controller {

    private $process;
    private $user_id;
    private $employer;
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Category', 'Common_mod', 'Webuser_model', 'Process', 'Employer', 'profile/ProfileModel', 'Job_work_diary_model', 'adminforms', 'job_details'));
		
		$this->load_language();
		
        $this->process = new Process();
        $this->user_id = $this->session->userdata(USER_ID);
        $this->employer = new Employer($this->user_id);
    }

    public function index() {
	
		
	
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $budget = 0;
            $total_work = 0;
            $feedbackScore = 0;

            $records = array();
            $_price = array();
            $_freelancer = array();
            
            $job_id = base64_decode($_GET['job_id']);
			
			// hui added for job details
			$user_id = $this->session->userdata(USER_ID);
			$this->job_details->init($user_id, $job_id );
            $bids = $this->process->get_bids($job_id);
            $emp = $this->employer->is_active();
            $job_details = $this->process->get_job_details($job_id);
			
			//Hui added for twig 
			$applicants = $this->process->get_applications( $job_id, TRUE );
			$declined = $this->process->get_rejected( $job_id, TRUE);
			$offered = $this->process->get_offers( $job_id, TRUE );
			$hired = $this->process->get_hires( $user_id, $job_id, TRUE );
			$interviews = $this->process->get_interviews( $user_id, $job_id, TRUE );
			
			
		
			// hui ended
			 
			$rejects = $this->process->get_rejected($job_id);
			
            foreach($rejects['data'] AS $_rejects){
								
               $ended_jobs = $this->process->cnt_ended_jobs($_rejects->webuser_id);
               $freelancer_profile = $this->ProfileModel->get_profile($_rejects->webuser_id);
               $accepted_jobs = $this->process->accepted_jobs($_rejects->webuser_id);
               $pic = $this->Adminforms->getdatax("picture", "webuser", $_rejects->webuser_id);
               $country = $this->ProfileModel->get_country($_rejects->webuser_country);
               $skills = $this->ProfileModel->get_skills($_rejects->webuser_id);
               $user_rating = $this->Webuser_model->get_total_rating($_rejects->webuser_id);
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
			
			/*
                $records[] = array(
                   'ended_jobs' => $ended_jobs,
                   'tagline' => ucfirst($freelancer_profile['tagline']),
                   'budget' => $budget,
                   'feedback_score' => $feedbackScore,
                   'total_work' => $total_work,
                   'pic' => $_pic,
                   'fname' => $_rejects->webuser_fname,
                   'lname' => $_rejects->webuser_lname,
                   'user_id' => $_rejects->webuser_id,
                   'job_id' => $_rejects->job_id,
                   'bid_id' => $_rejects->bid_id,
                   'bid_amount' => $_rejects->bid_amount,
                   'country' => ucfirst($country['country_name']),
                   'letter' => $_rejects->cover_latter,
                   'skills' => $skills,
                   'rating' => $user_rating,
                   'bid_reject' => $_rejects->bid_reject
                );*/
				
				
				/**********************************************************************************/
				/**********************************************************************************/
				
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
					'fname' => $_rejects->webuser_fname,
					'lname' => $_rejects->webuser_lname,
					'hire_url' => site_url("jobs/offers?user_id=" . base64_encode($_rejects->webuser_id)
						. "&job_id=" . base64_encode($this->job_details->get_jobid())),
					'profile_url' => site_url("applicants?user_id=") . base64_encode($_rejects->webuser_id) . "&job_id=" . base64_encode($this->job_details->get_jobid()) . "&bid_id=" . base64_encode($_rejects->id) . '/declined',
					
					'user_id' => $_rejects->webuser_id,
					'skills' => $skills,
					'country' => ucfirst($country['country_name']),
				];
				
				$applications[] = array(
					'job' => $this->job_details,
					'bid' => $_rejects,
					'applicant' => $applicant,
					'decline' => '1',
					'bid_reject' => $_rejects->bid_reject
				);
				
				
				
				
				/**********************************************************************************/
				/**********************************************************************************/
			
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
			'display' => 'decline',
			'interviews' => $interviews
			]);
		
		
        }
    
	
	
	}

}
