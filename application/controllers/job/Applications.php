<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Applications
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 *
 * @property Process              $process
 * @property Employer             $employer
 * @property Webuser_model        $webuser_model
 * @property ProfileModel         $profileModel
 * @property Job_work_diary_model $job_work_diary_model
 * @property Job_details          $job_details
 * @property Adminforms           $adminforms
 * @property ProfileModel         $user_id
 */
class Applications extends Winjob_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load_language();
        $this->load->model(array(
            'process', 'employer', 'webuser_model', 
            'profile/profileModel', 'job_work_diary_model', 'adminforms', 'job_details'));
    }
    
    protected function load_language()
    {
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
    
    public function index($job_id)
    {
		
        $this->checkForEmployer();
        
        $job_id = base64_decode($job_id);
        
        if(!is_numeric($job_id)){
            $this->session->set_flashdata('error', 'invalid job');
            redirect(back());
        }
        
        //load current client informations.
        $user_id = $this->session->userdata(USER_ID);
        $this->employer->init( $user_id );
		$this->job_details->init($user_id, $job_id );
	
		$bids = $this->process->get_bids( $job_id );
		$applicants = $this->process->get_applications( $job_id, TRUE );
		$declined = $this->process->get_rejected( $job_id, TRUE );
		$offered = $this->process->get_offers( $job_id, TRUE );
		$hired = $this->process->get_hires( $user_id, $job_id, TRUE );
		$interviews = $this->process->get_interviews( $user_id, $job_id, TRUE );
		
		
        $applications = array();
		if ($bids['rows'] > 0){
			
			foreach($bids['data'] AS $bid){
				$earned = 0;
				$total_work = 0;
				$feedback_score = 0;
				$totalscore = 0;
				$rating_feedback = 0;
				
				$ended_jobs = $this->process->cnt_ended_jobs($bid->user_id);
				$freelancer_profile = $this->profileModel->get_profile($bid->user_id);
				$accepted_jobs = $this->process->accepted_jobs($bid->user_id);
				$pic = $this->adminforms->getdatax("picture", "webuser", $bid->user_id);
				$country = new Employer($bid->user_id);
				$skills = $this->profileModel->get_skills($bid->user_id);
				$user_rating = $this->webuser_model->get_total_rating($bid->user_id);
			
				foreach($accepted_jobs AS $a_job){
					$feedbacks = $this->process->get_feedbacks($a_job->fuser_id, $a_job->job_id);
					$diary = $this->job_work_diary_model->get_work_hours($a_job->fuser_id, $a_job->job_id);
				
					foreach($diary AS $_diary){
						$total_work += $_diary->total_hour;
					}
					
					if( $a_job->jobstatus == 1 && ! empty( $feedbacks ) )
					{
						if( $a_job->job_type === 'fixed' )
						{
							$price = $a_job->fixedpay_amount;
						} else
						{
							$amount = $a_job->offer_bid_amount ?: $a_job->bid_amount;
							$price = $a_job->fixedpay_amount * $amount;
						}
						$feedback_score += ( $feedbacks['feedback_score'] * $price );
						$earned += $price;
					}
				}
				
				if($feedback_score && $earned) {
					$totalscore = $feedback_score / $earned;
					$rating_feedback = ($totalscore/5)*100;
				}
				
				$bid->cover_latter = mb_substr($bid->cover_latter, 0, 100);
				
				$applicant = [
					'ended_jobs' => $ended_jobs,
					'tagline' => ucfirst($freelancer_profile['tagline']),
					'earned' => $earned,
					'totalscore' => $totalscore,
					'rating_feedback' => $rating_feedback,
					'rating' => $user_rating,
					'total_work' => $total_work,
					'pic' => $pic != "" ? $pic : "assets/user.png",
					'fname' => $bid->webuser_fname,
					'lname' => $bid->webuser_lname,
					'hire_url' => site_url("jobs/offers?user_id=" . base64_encode($bid->user_id)
						. "&job_id=" . base64_encode($this->job_details->get_jobid())),
						
					'profile_url' => site_url("applicants?user_id=") . base64_encode($bid->user_id) . "&job_id=" . base64_encode($this->job_details->get_jobid()) . "&bid_id=" . base64_encode($bid->id),
					
					'user_id' => $bid->user_id,
					'skills' => $skills,
					'country' => ucfirst($country->get_country()),
					
				];
				
				$applications[] = array(
					'job' => $this->job_details,
					'bid' => $bid,
					'applicant' => $applicant,
					'decline' => '0',
					'bid_reject' => $bid->bid_reject
				);
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
			'display' => 'application',
			'interviews' => $interviews
        ]);
    }
}
