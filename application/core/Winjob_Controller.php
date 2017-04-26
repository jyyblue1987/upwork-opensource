<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base controller repository of all common controller functionnality.
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Winjob_Controller extends CI_Controller {
    
    private $_default_lang = 'english';
    
    public function __construct() {
        parent::__construct();
                
        // added by (Donfack Zeufack Hermann) start 
        // load twig library with custom helper function
        $this->load->library('twig', array(
            'functions' => array(
                'character_limiter', 'url_title',
                'app_substr',
                'str_replace',
                'url_title',
                'app_date',
                'base64_encode',
                'home_url', 
                'app_header_link_template',
                'app_user_dropdown_template',
                'app_user_data',
                'app_sub_header_template',
                'app_profile_url',
                'app_modular_js',
                'app_lang',
                'app_user_img',
                'has_flash', 'flashdata', 'csrf_name', 'csrf_token',
                'app_time_elapsed_string', 'strtotime', 'app_workdiary_capture', 
                'current_user_datetime', 'round', 'get_all_php_timezones', 'app_convert_date_in_local'
             )
        ));
        // added by (Donfack Zeufack Hermann) end
        
        // added by (Donfack Zeufack Hermann) start 
        // remove variable initialization from header view file.
        //Define them as global variable fpr all view page.
        $this->initialize_global_view_variable();
        // added by (Donfack Zeufack Hermann) end
        
        // added by (Donfack Zeufack Hermann) start 
        //Allow to redirect back to the previous url
        $this->load->library('user_agent');
        // save the redirect_back data from referral url (where user first was prior to login)
        $back_url = $this->agent->referrer();
        $this->session->set_userdata('redirect_back',  ( !empty($back_url) ? $back_url : home_url() ) );
        // added by (Donfack Zeufack Hermann) end
          
    }
    
    public function get_default_lang() {
        return $this->_default_lang;
    }
    
    private function initialize_global_view_variable(){
        $this->load->model(array('notification_model', 'webuser_model'));
        $user_id = $this->session->userdata('id');
        $this->twig->addGlobal('notification', $this->conversation->index());
        $this->twig->addGlobal('notification_details', $this->conversation->details());
        $this->twig->addGlobal('job_alert_count', $this->conversation->job_alert());
        $this->twig->addGlobal('freelancerend', $this->conversation->freelancerend());
        $this->twig->addGlobal('clientend', $this->conversation->clientend());
        $this->twig->addGlobal('notif_count', $this->notification_model->user_notification_count( $user_id ));
        $this->twig->addGlobal('notifications', $this->notification_model->user_notification( $user_id ));
        $this->twig->addGlobal('user_timezone',  $this->session->userdata('user_timezone'));
    }
    
        
    /**
     * 
     * Help to set the default app language for the current user.
     * 
     * @return void
     */
    protected function set_default_lang( $lang = null ){
        
        if($lang == null){
            $current_lang = $this->session->userdata('language');
        }else{
            $current_lang = $lang;
        }
        
        $this->_default_lang = !empty($current_lang) && in_array($current_lang, $this->config->item('allowed_language')) ?  $current_lang : 'english';
    }
    
    /**
     * Load the appropriate language file
     */
    protected function load_language(){
        $this->lang->load('app', $this->get_default_lang());
    }
    
    protected function extrat_all_job_ids( $jobs ){
        $job_ids = array();
        foreach( $jobs as $job){
            $job_ids[] = $job->job_id;
        }
        return $job_ids; 
    }
    
    protected function authorized(){
        if ( ! $this->Adminlogincheck->checkx() )
           redirect(home_url());  
    }
    
    protected function ajax_response( $data ){
        
        if(is_array($data))
            $data = json_encode ($data);
        
        echo $data; die; 
    }
    
    protected  function isEmployer(){
        if ($this->session->userdata('type') != EMPLOYER) {
            redirect( home_url() );
        }
    }

    protected  function isFreelancer(){
        if ($this->session->userdata('type') != FREELANCER) {
            redirect( home_url() );
        }
    }

    protected function checkForEmployer(){
        $this->authorized();
        $this->isEmployer();
    }
    
    protected function checkForFreelancer(){
        $this->authorized();
        $this->isFreelancer();
    }
    
    protected function display_active_contracts( $is_active_contract_page = true ){
        
        $this->checkForEmployer();
           
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

        $this->twig->display('webview/jobs/twig/my-freelancers', compact(
                'nb_freelancer_hired', 'jobs_accepted', 
                'freelancer_job_hour', 'nb_offer', 
                'past_hired', 'webuser', 'is_active_contract_page'));
        
    }
    
    protected function display_ended_contracts( $is_ended_contracts_page = true ){
        
        $this->checkForEmployer();
        
        $user_id = $this->session->userdata('id');
        
        $this->load->model( array( 'contracts_model', 'jobs_model' ) );

        $result              = $this->contracts_model->get_ended_of( $user_id );
        $past_hire           = count( $result );
        $job_ids             = $this->extrat_all_job_ids( $result );
        $freelancer_job_hour = $this->jobs_model->get_all_freelancer_total_hour($job_ids);

        $data = array(
            'messages' => $result,
            'past_hire' => $past_hire, 
            'freelancer_job_hour' => $freelancer_job_hour,
            'is_ended_contracts_page' => $is_ended_contracts_page
        );

        $this->twig->display( 'webview/jobs/twig/past-hires', $data );
    }
}
