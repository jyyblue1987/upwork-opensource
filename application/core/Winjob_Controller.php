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
                
        // added by (Donfack Zeufack Hermann) start load twig library with custom helper function
        $this->load->library('twig', array(
            'functions' => array(
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
    }
    
    function get_default_lang() {
        return $this->_default_lang;
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
