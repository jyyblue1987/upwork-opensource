<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public function index()
	{

		if($this->Adminlogincheck->checkx()){

			
	$data = array(
               'title' => "Dashboard",
				       'page' => "dashboard",
				       'name' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				       'id' => $this->session->userdata('id'),
							 'js' =>array(),
							 'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/owl.carousel.min.js","assets/js/homepage.js"),
							 'css' =>array("assets/css/layerslider.css","assets/css/owl.carousel.css","assets/css/owl.theme.css"),
          );
            	$this->Admintheme->webview("dashboard",$data);

				
				

		}else{
		redirect(site_url("signin"));
		}


	}
}
