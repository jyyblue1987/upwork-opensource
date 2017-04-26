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
 */
class Applications extends Winjob_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load_language();
        $this->load->model(array(
            'process', 'employer', 'webuser_model', 
            'profile/profileModel', 'job_work_diary_model'));
    }
    
    protected function load_language()
    {
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
    
    public function index($job_id)
    {
        $this->checkForEmployer();
        
        $display_job_id = $job_id;
        $job_id = base64_decode($job_id);
        
        if(!is_numeric($job_id)){
            $this->session->set_flashdata('error', 'invalid job');
            redirect(back());
        }
        
        //load current client informations.
        $user_id = $this->session->userdata(USER_ID);
        $this->employer->init( $user_id );
        
        $bids        = $this->process->get_bids($job_id);
        $is_active   = $this->employer->is_active();
        $job_details = $this->process->get_job_details($job_id);
        
        $applicants  = $bids['rows'];
        $declined    = $this->process->get_rejected($job_id, true);
        $offered     = $this->process->get_offers($job_id, true);
        $hired       = $this->process->get_hires($this->user_id, $job_id, true);
        $interviews  = $this->process->get_interviews($this->user_id, $job_id, true);
        
        $job_type    = ucfirst($job_details['job_type']);
        $job_title   = ucwords($job_details['title']);
        
        $applications = array();
        if($bids['rows'] > 0)
        {
            foreach($bids['data'] as $key => $bid)
            {
                $ended_jobs         = $this->process->cnt_ended_jobs($bid->user_id);
                $freelancer_profile = $this->webuser_model->load_profile($bid->user_id);
                $accepted_jobs      = $this->process->accepted_jobs($bid->user_id);
                $user_rating        = $this->webuser_model->get_total_rating($bid->user_id);
                $skills             = $this->profileModel->get_skills($bid->user_id);
                
                foreach($accepted_jobs as $job)
                {
                    $feedbacks = $this->process->get_feedbacks($job->fuser_id, $job->job_id);
                    $diary     = $this->job_work_diary_model->get_work_hours($job->fuser_id, $job->job_id);
                }
            }
        }
        
        $this->twig->display('webview/jobs/twig/applications', compact(
            'applications', 'is_active', 'job_type', 'job_title', 'display_job_id',   
            'applicants', 'declined', 'offered', 'hired', 'interviews'
        ));
    }
}
