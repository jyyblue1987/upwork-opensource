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
        $this->Admintheme->custom_webview("footerpages/cancellation", $data);
    }

    public function desktop_app(){
        $data = array(
            'title' => "Desktop Application",
            'page' => "desktop-app",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->custom_webview("footerpages/desktop_app", $data);
    }

    public function enterprise(){
        $data = array(
            'title' => "Enterprise Solution",
            'page' => "enterprise-solution",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->custom_webview("footerpages/enterprise", $data);
    }

    public function fees(){
        $data = array(
            'title' => "Fees and Charges",
            'page' => "fees-charges",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->custom_webview("footerpages/fees", $data);
    }

    public function getwork_done(){
        $data = array(
            'title' => "How to get your work done?",
            'page' => "getwork-done",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->custom_webview("footerpages/getworkdone", $data);
    }
    
    //Added by Ralfh 3/22/2017
    //employer help start
    public function employer_help(){
        $data = array(
            'title' => "Employer Help",
            'page' => "employer-help",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css", "assets/css/pages/employer-help.css"),
        );
        $this->Admintheme->webview("footerpages/employer-help/employer-help", $data);
    }

    public function freelancer_help(){
        $data = array(
            'title' => "Freelancer Help",
            'page' => "freelancer-help",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css", "assets/css/pages/freelancer-help.css"),
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
        $this->Admintheme->employer_help_webview("footerpages/employer-help/verified-payments", $data);
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
        'title' => "Communicating with Freelanners",
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
        'title' => "Understanding the Workroom",
        'page' => "understanding-workroom",
        'type' => "fourth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/understanding-workroom", $data);
    }

    //end of fourth

    //fifth
    public function understanding_invoce_safepay(){
        $data = array(
        'title' => "Understanding Invoices and SafePay",
        'page' => "understanding-invoce-safepay",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/understanding-invoce-safepay", $data);
    }
    public function paying_invoice(){
        $data = array(
        'title' => "Paying an Invoice",
        'page' => "paying-invoice",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/paying-invoice", $data);
    }
    public function adding_funds(){
        $data = array(
        'title' => "Adding Funds to SafePay",
        'page' => "adding-funds",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/adding-funds", $data);
    }
    public function understanding_autopay(){
        $data = array(
        'title' => "Understanding AutoPay",
        'page' => "understanding-autopay",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/understanding-autopay", $data);
    }
    public function managing_feedback(){
        $data = array(
        'title' => "Managing Feedback",
        'page' => "managing-feedback",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/managing-feedback", $data);
    }
    public function adding_payment_methods(){
        $data = array(
        'title' => "Adding and Verifying Payment Methods",
        'page' => "adding-payment-methods",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/adding-payment-methods", $data);
    }
    public function our_service(){
        $data = array(
        'title' => "Our 1099 Service",
        'page' => "our-service",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/our-service", $data);
    }
    //end of fifth

    //sixth

    public function requesting_safepay_refund(){
        $data = array(
        'title' => "Requesting a SafePay Refund",
        'page' => "requesting-safepay-refund",
        'type' => "sixth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/requesting-safepay-refund", $data);
    }
    public function requesting_invoice_refund(){
        $data = array(
        'title' => "Requesting an Invoice Refund",
        'page' => "requesting-invoice-refund",
        'type' => "sixth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/requesting-invoice-refund", $data);
    }
    public function entering_negotiation(){
        $data = array(
        'title' => "Entering Negotiation",
        'page' => "entering-negotiation",
        'type' => "sixth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/entering-negotiation", $data);
    }
    public function escalating_dispute(){
        $data = array(
        'title' => "Escalating a Dispute to Arbitration",
        'page' => "escalating-dispute",
        'type' => "sixth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->employer_help_webview("footerpages/employer-help/escalating-dispute", $data);
    }
    //end of sixth
    //employer help end

    //freelancer help start
    ///first
    public function f_registering_account(){
        $data = array(
        'title' => "Registering an Account",
        'page' => "registering-account",
        'type' => "first",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/registering-account", $data);
    }
    public function f_costs_to_use(){
        $data = array(
        'title' => "Costs to Use Winjobs.com",
        'page' => "costs-to-use",
        'type' => "first",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/costs-to-use", $data);
    }
    public function f_editing_account(){
        $data = array(
        'title' => "Editing Your Account",
        'page' => "editing-account",
        'type' => "first",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/editing-account", $data);
    }
    //end of first

    //second
    public function f_understanding_profile(){
        $data = array(
        'title' => "Understanding Your Profile",
        'page' => "understanding-profile",
        'type' => "second",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/understanding-profile", $data);
    }
    public function f_adding_portfolio_services(){
        $data = array(
        'title' => "Adding Portfolios and Services",
        'page' => "adding-portfolio-services",
        'type' => "second",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/adding-portfolio-services", $data);
    }
    public function f_taking_skill_tests(){
        $data = array(
        'title' => "Taking Skill Tests",
        'page' => "taking-skill-tests",
        'type' => "second",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/taking-skill-tests", $data);
    }
    public function f_purchasing_membership(){
        $data = array(
        'title' => "Purchasing a Membership",
        'page' => "purchasing-membership",
        'type' => "second",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/purchasing-membership", $data);
    }
    //end of second

    //third
    public function f_searching_jobs(){
        $data = array(
        'title' => "Searching for Jobs",
        'page' => "searching-jobs",
        'type' => "third",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/searching-jobs", $data);
    }
    public function f_receiving_invitations(){
        $data = array(
        'title' => "Receiving Invitations",
        'page' => "receiving-invitations",
        'type' => "third",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/receiving-invitations", $data);
    }
    public function f_receiving_job_matches(){
        $data = array(
        'title' => "Receiving Jobs Matches",
        'page' => "receiving-job-matches",
        'type' => "third",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/receiving-job-matches", $data);
    }
    public function f_adding_jobs_to_wishlist(){
        $data = array(
        'title' => "Adding Jobs to Your Watch List",
        'page' => "adding-jobs-to-wishlist",
        'type' => "third",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/adding-jobs-to-wishlist", $data);
    }
    public function f_submitting_quotes(){
        $data = array(
        'title' => "Submitting Quotes",
        'page' => "submitting-quotes",
        'type' => "third",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/submitting-quotes", $data);
    }
    public function f_understanding_quotes_terms(){
        $data = array(
        'title' => "Understanding Quote Terms",
        'page' => "understanding-quotes-terms",
        'type' => "third",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/understanding-quotes-terms", $data);
    }
    //end of third
    
    //fourth
    public function f_communicating_with_employers(){
        $data = array(
        'title' => "Communicating with Employers",
        'page' => "communicating-with-employers",
        'type' => "fourth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/communicating-with-employers", $data);
    }
    public function f_sending_agreement(){
        $data = array(
        'title' => "Sending an Agreement",
        'page' => "sending-agreement",
        'type' => "fourth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/sending-agreement", $data);
    }
    public function f_adding_files_to_workroom(){
        $data = array(
        'title' => "Adding Files to the Workroom",
        'page' => "adding-files-to-workroom",
        'type' => "fourth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/adding-files-to-workroom", $data);
    }
    public function f_using_timetracker(){
        $data = array(
        'title' => "Using Time Tracker",
        'page' => "using-timetracker",
        'type' => "fourth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/using-timetracker", $data);
    }
    public function f_managing_team(){
        $data = array(
        'title' => "Managing Your Team",
        'page' => "managing-team",
        'type' => "fourth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/managing-team", $data);
    }
    //end of fourth
    //fifth
    public function f_understanding_payment(){
        $data = array(
        'title' => "Understanding Payment on Winjobs.com",
        'page' => "understanding-payment",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/understanding-payment", $data);
    }
    public function f_sending_invoices(){
        $data = array(
        'title' => "Sending Invoices",
        'page' => "sending-invoices",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/sending-invoices", $data);
    }
    public function f_payment_schedule(){
        $data = array(
        'title' => "Our Payment Schedule",
        'page' => "payment-schedule",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/payment-schedule", $data);
    }
    public function f_verified_payment_methods(){
        $data = array(
        'title' => "Verified Payment Methods",
        'page' => "verified-payment-methods",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/verified-payment-methods", $data);
    }
    public function f_adding_transfer_method(){
        $data = array(
        'title' => "Adding a Transfer Method",
        'page' => "adding-transfer-method",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/adding-transfer-method", $data);
    }
    public function f_managing_feedback(){
        $data = array(
        'title' => "Managing Feedback",
        'page' => "managing-feedback",
        'type' => "fifth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/managing-feedback", $data);
    }

    //end of fifth

    //sixth
    public function f_issuing_safepay_refund(){
        $data = array(
        'title' => "Issuing a SafePay Refund",
        'page' => "issuing-safepay-refund",
        'type' => "sixth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/issuing-safepay-refund", $data);
    }
    public function f_issuing_invoice_refund(){
        $data = array(
        'title' => "Issuing an Invoice Refund",
        'page' => "issuing-invoice-refund",
        'type' => "sixth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/issuing-invoice-refund", $data);
    }
    public function f_entering_negotiation(){
        $data = array(
        'title' => "Entering Negotiation",
        'page' => "entering-negotiation",
        'type' => "sixth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/entering-negotiation", $data);
    }
    public function f_escalating_dispute_arbitration(){
        $data = array(
        'title' => "Escalating a Dispute to Arbitration",
        'page' => "escalating-dispute-arbitration",
        'type' => "sixth",
        'js' => array(),
        'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
        'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->freelancer_help_webview("footerpages/freelancer-help/escalating-dispute-arbitration", $data);
    }

    //end of sixth
    //freelancer help end


//Added by Ralfh 3/22/2017 -- end
    public function join(){
        $data = array(
            'title' => "How to Join us?",
            'page' => "how-to-join",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->custom_webview("footerpages/join", $data);
    }

    public function make_better(){
        $data = array(
            'title' => "Help Make Winjob better",
            'page' => "make-better",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->custom_webview("footerpages/make_better", $data);
    }

    public function press(){
        $data = array(
            'title' => "Press",
            'page' => "press",
            'js' =>array(),
            'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/owl.carousel.min.js","assets/js/homepage.js"),
            'css' =>array("assets/css/layerslider.css","assets/css/owl.carousel.css","assets/css/owl.theme.css"),
        );
        $this->Admintheme->custom_webview("footerpages/press",$data);
    }

    public function create_ticket(){
        $data = array(
            'title' => "How to create support tickets?",
            'page' => "create-ticket",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->custom_webview("footerpages/ticket", $data);
    }

    public function trust_safety(){
        $data = array(
            'title' => "Trust and Safety",
            'page' => "trust-safety",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->custom_webview("footerpages/trustsafety", $data);
    }
    
    public function feedback(){
        $data = array(
            'title' => "Feedback",
            'page' => "feedback",
            'js' => array(),
            'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
            'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
        );
        $this->Admintheme->custom_webview("footerpages/feedback", $data);
    }
}