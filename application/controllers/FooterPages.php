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
//Added by Ralfh 3/22/2017
    public function employer_help(){
        $data = array(
            'title' => "Employer Help",
            'page' => "employer-help",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/employer-help/employer-help", $data);
    }

    public function freelancer_help(){
        $data = array(
            'title' => "Freelancer Help",
            'page' => "freelancer-help",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->webview("footerpages/freelancer-help/freelancer-help", $data);
    }
    //first
    public function registering_account(){
        $data = array(
        'title' => "Registering an Account",
        'page' => "registering-account",
        'type' => "first",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/registering-account", $data);
    }


    public function costs_to_use(){
        $data = array(
        'title' => "Costs to Use",
        'page' => "costs-to-use",
        'type' => "first",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/costs-to-use", $data);
    }

    public function understanding_account_settings(){
        $data = array(
        'title' => "Understanding Account Settings",
        'page' => "understanding-account-settings",
        'type' => "first",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/understanding-account-settings", $data);
    }

    public function verified_payments(){
        $data = array(
        'title' => "Verified Payments",
        'page' => "verified-payments",
        'type' => "first",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/verified_payments", $data);
    }
    //end of first

    //second
    public function posting_jobs(){
        $data = array(
        'title' => "Posting Jobs",
        'page' => "posting-jobs",
        'type' => "second",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/posting-jobs", $data);
    }
    public function jobs_description(){
        $data = array(
        'title' => "Your Jobs Description",
        'page' => "jobs-description",
        'type' => "second",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/jobs-description", $data);
    }
    public function featuring_jobs(){
        $data = array(
        'title' => "Featuring Your Job",
        'page' => "featuring-jobs",
        'type' => "second",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/featuring-jobs", $data);
    }
    public function job_status(){
        $data = array(
        'title' => "Your Job Status",
        'page' => "job-status",
        'type' => "second",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/job-status", $data);
    }
    public function posting_restrictions(){
        $data = array(
        'title' => "Posting Restrictions",
        'page' => "posting-restrictions",
        'type' => "second",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/posting-restrictions", $data);
    }
    //end of second
    //third
    public function finding_freelancers(){
        $data = array(
        'title' => "Finding a Freelancer",
        'page' => "finding-freelancers",
        'type' => "third",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/finding-freelancers", $data);
    }

    public function viewing_quotes(){
        $data = array(
        'title' => "Viewing Quotes",
        'page' => "viewing-quotes",
        'type' => "third",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/viewing-quotes", $data);
    }
    public function awarding_job(){
        $data = array(
        'title' => "Awarding a Job",
        'page' => "awarding-job",
        'type' => "third",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/awarding-job", $data);
    }
    public function deciding_agreement(){
        $data = array(
        'title' => "Deciding on an Agreement",
        'page' => "deciding-agreement",
        'type' => "third",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/deciding-agreement", $data);
    }
    //end of third

    //fourth
    public function communicating_with_freelancers(){
        $data = array(
        'title' => "Deciding on an Agreement",
        'page' => "communicating-with-freelancers",
        'type' => "fourth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/communicating-with-freelancers", $data);
    }
    public function adding_files(){
        $data = array(
        'title' => "Adding Files to the Workroom",
        'page' => "adding-files",
        'type' => "fourth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/adding-files", $data);
    }
    public function managing_team(){
        $data = array(
        'title' => "Managing your Team",
        'page' => "managing-team",
        'type' => "fourth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/managing-team", $data);
    }
    public function understanding_time_tracker(){
        $data = array(
        'title' => "Understanding Time Tracker",
        'page' => "understanding-time-tracker",
        'type' => "fourth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/understanding-time-tracker", $data);
    }
    public function understanding_workroom(){
        $data = array(
        'title' => "Undersating the Workroom",
        'page' => "understanding-workroom",
        'type' => "fourth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/understanding-workroom", $data);
    }

    //end of fourth
//Added by Ralfh 3/22/2017 -- end
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