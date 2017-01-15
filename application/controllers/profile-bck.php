<?php

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->basic();
    }

    public function basic()
    {
        if ($this->Adminlogincheck->checkx()) {
            $data = array(
                'title' => "Profile Setting",
                'page' => "profilesetting",
                'name' => $this->session->userdata('fname') . " " . $this->session->userdata('lname'),
                'id' => $this->session->userdata('id'),
                'js' => array(),
                'jsf' => array(
                    "assets/js/layerslider.transitions.js",
                    "assets/js/layerslider.kreaturamedia.jquery.js",
                    "assets/js/owl.carousel.min.js",
                    "assets/js/homepage.js"
                ),
                'css' => array(
                    "assets/css/layerslider.css",
                    "assets/css/owl.carousel.css",
                    "assets/css/owl.theme.css"
                )
            );
            $this->Admintheme->webview("profile/profile_basic", $data);
        } else {
            redirect(site_url("signin"));
        }
    }
    
    public function basic_bio()
    {
        if ($this->Adminlogincheck->checkx()) {
            $data = array(
                'title' => "Profile Setting",
                'page' => "profilesetting",
                'name' => $this->session->userdata('fname') . " " . $this->session->userdata('lname'),
                'id' => $this->session->userdata('id'),
                'js' => array(),
                'jsf' => array(
                    "assets/js/layerslider.transitions.js",
                    "assets/js/layerslider.kreaturamedia.jquery.js",
                    "assets/js/owl.carousel.min.js",
                    "assets/js/homepage.js"
                ),
                'css' => array(
                    "assets/css/layerslider.css",
                    "assets/css/owl.carousel.css",
                    "assets/css/owl.theme.css"
                )
            );
            $this->Admintheme->webview("profile/profile_basic_bio", $data);
        } else {
            redirect(site_url("signin"));
        }
    }
}