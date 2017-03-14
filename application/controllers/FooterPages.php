<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FooterPages extends CI_Controller{
    
    public function add_fund(){
        $data = array(
               'title' => "How to add fund?",
		'page' => "add-fund",
		'js' =>array(),
		'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/owl.carousel.min.js","assets/js/homepage.js"),
		'css' =>array("assets/css/layerslider.css","assets/css/owl.carousel.css","assets/css/owl.theme.css"),
            );
            	$this->Admintheme->webview("footerpages/add_fund",$data);
	}

    public function cancellation(){
        $data = array(
            'title' => "Cancellation and Refunds",
            'page' => "cancellation-refund",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/cancellation", $data);
    }

    public function desktop_app(){
        $data = array(
            'title' => "Desktop Application",
            'page' => "desktop-app",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/desktop_app", $data);
    }

    public function enterprise(){
        $data = array(
            'title' => "Enterprise Solution",
            'page' => "enterprise-solution",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/enterprise", $data);
    }

    public function fees(){
        $data = array(
            'title' => "Fees and Charges",
            'page' => "fees-charges",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/fees", $data);
    }

    public function getwork_done(){
        $data = array(
            'title' => "How to get your work done?",
            'page' => "getwork-done",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/getworkdone", $data);
    }

    public function help(){
        $data = array(
            'title' => "Help and Support",
            'page' => "help",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/help", $data);
    }

    public function join(){
        $data = array(
            'title' => "How to Join us?",
            'page' => "how-to-join",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/join", $data);
    }

    public function make_better(){
        $data = array(
            'title' => "Help Make Winjob better",
            'page' => "make-better",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/make_better", $data);
    }

    public function press(){
        $data = array(
            'title' => "Press",
            'page' => "press",
            'js' =>array(),
            'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/owl.carousel.min.js","assets/js/homepage.js"),
            'css' =>array("assets/css/layerslider.css","assets/css/owl.carousel.css","assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/press",$data);
    }

    public function create_ticket(){
        $data = array(
            'title' => "How to create support tickets?",
            'page' => "create-ticket",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/ticket", $data);
    }

    public function trust_safety(){
        $data = array(
            'title' => "Trust and Safety",
            'page' => "trust-safety",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/trustsafety", $data);
    }
    
    public function feedback(){
        $data = array(
            'title' => "Feedback",
            'page' => "feedback",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/feedback", $data);
    }
}