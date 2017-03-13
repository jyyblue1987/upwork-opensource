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
                'character_limiter',
                'app_substr',
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
                'app_user_img'
             )
        ));
        // added by (Donfack Zeufack Hermann) end
        
        // added by (Donfack Zeufack Hermann) start 
        // remove variable initialization from header view file.
        //Define them as global variable fpr all view page.
        $this->initialize_global_view_variable();
        // added by (Donfack Zeufack Hermann) end
    }
    
    public function get_default_lang() {
        return $this->_default_lang;
    }
    
    private function initialize_global_view_variable(){
        $this->load->model('notification_model');
        $user_id = $this->session->userdata('id');
        $this->twig->addGlobal('notification', $this->conversation->index());
        $this->twig->addGlobal('notification_details', $this->conversation->details());
        $this->twig->addGlobal('job_alert_count', $this->conversation->job_alert());
        $this->twig->addGlobal('freelancerend', $this->conversation->freelancerend());
        $this->twig->addGlobal('clientend', $this->conversation->clientend());
        $this->twig->addGlobal('notif_count', $this->notification_model->user_notification_count( $user_id ));
        $this->twig->addGlobal('notifications', $this->notification_model->user_notification( $user_id ));
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
}
