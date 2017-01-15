<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profilesetting extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('common_mod'));
        $this->load->model(array('timezone'));
    }

	public function index()
	{
		$profile = $_GET['profile'];
            if($this->Adminlogincheck->checkx()){
                //webuser details//
                $condition = " AND webuser_id=".$this->session->userdata(USER_ID);
                $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS,null,$condition);
                if(empty($webUserContactDetails['rows'])){
                    $webUserContactDetails['rows'][0] = "";
                }

                //webuser contact details//
                $webuserCountry = $this->common_mod->getSpecificColVal(COUNTEY_TABLE,"country_name"," AND country_id  =".$this->session->userdata('webuser_country'));
                $countryList = $this->common_mod->get(COUNTEY_TABLE,null," AND country_status=1");
                $timezones = $this->timezone->get_timezones();
                $timezone = $this->timezone->get((int)$webUserContactDetails['rows'][0]['timezone']);

                $data = array(
                    'title' => "Profile Setting",
                    'page' => "profilesetting",
                    'name' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
                    'id' => $this->session->userdata('id'),
                    'js' =>array(),
                    'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/owl.carousel.min.js","assets/js/homepage.js"),
                    'css' =>array("assets/css/layerslider.css","assets/css/owl.carousel.css","assets/css/owl.theme.css"),
                    'countryList' => $countryList['rows'],
                    'open' => 'account',
                    'openSub' =>'profile-basic',
                    'webuserContactDetails' =>$webUserContactDetails['rows'][0],
                    'webuserCountry'=>$webuserCountry,
                    'timezone' => $timezone,
                    'timezones' => $timezones,
					'profile'=>$profile
                );
                    $this->Admintheme->webview("profilesetting",$data);
                }else{
                    redirect(site_url("signin"));
                }
	}
}

