<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base controller repository of all common controller functionnality.
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Winjob_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // added by (Donfack Zeufack Hermann) start load twig library with custom helper function
        $this->load->library('twig', array(
            'functions' => array(
                'home_url', 
                'app_header_link_template',
                'app_user_dropdown_template',
                'app_user_data',
                'app_sub_header_template',
                'app_profile_url',
                'app_modular_js'
             )
        ));
        // added by (Donfack Zeufack Hermann) end
    }
}
