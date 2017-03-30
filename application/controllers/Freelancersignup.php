<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Freelancersignup extends CI_Controller {

    public function index() {
        $data = array(
            'title' => "Freelancer Sign Up - Winjob",
            'page' => "freelancersignup",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css", "assets/css/pages/freelancersignup.css"),
        );
        $this->Admintheme->custom_webview("freelancersignup", $data);
    }
    
    public function popup_signup(){
        $this->load->view('webview/freelancersignup');
    }

}
