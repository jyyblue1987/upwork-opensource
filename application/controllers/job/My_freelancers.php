<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of My_freelancers
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class My_freelancers extends Winjob_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // added by (Donfack Zeufack Hermann) start 
        // load the default language for the current user.
        $this->load_language();
        // added by (Donfack Zeufack Hermann) end
    }
    
    protected function load_language(){
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
    
    public function index() {
         
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }
            
            // added by (Donfack Zeufack Hermann) start 
            
            // load models
            try{
                $this->load->model(array('jobs_model', 'webuser_model'));
            }catch(RuntimeException $e){
                log_message('debug', $e->getMessage());
                $this->session->set_flashdata('error', $this->lang->line('text_job_runtime_exception_message'));
                redirect(site_url(home_url()));
            }
            
            // fetch employer staff data
            $employer_id         = $this->session->userdata('id');
            $nb_freelancer_hired = $this->jobs_model->number_freelancer_hired( $employer_id );
            $jobs_accepted       = $this->jobs_model->load_all_jobs_freelancer_hired($employer_id);
                        
            date_default_timezone_set("UTC"); 
            $today               = date('y-m-d', strtotime('today'));
            $this_week_start     = date('y-m-d', strtotime('monday this week'));
            
            $job_ids             = $this->extrat_all_job_ids( $jobs_accepted );
            $freelancer_job_hour = $this->jobs_model->get_all_freelancer_total_hour($job_ids, $this_week_start, $today);
            
            $nb_offer            = $this->jobs_model->number_offer( $employer_id );
            $nb_past_hired       = $this->jobs_model->number_past_hired( $employer_id );
            $webuser             = $this->webuser_model->load_informations( $employer_id );
            
            $this->twig->display('webview/jobs/twig/my-freelancers', compact('nb_freelancer_hired', 'jobs_accepted', 'freelancer_job_hour', 'nb_offer', 'past_hired', 'webuser'));
            // added by (Donfack Zeufack Hermann) end
        }
    }
    
}