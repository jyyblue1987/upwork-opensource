<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employeersignup extends CI_Controller {

	public function index()
	{

	$data = array(
               'title' => "Employer Sign Up - Winjob",
				       'page' => "employeersignup",
							 'js' =>array(),
							 'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/owl.carousel.min.js","assets/js/homepage.js"),
							 'css' =>array("assets/css/layerslider.css","assets/css/owl.carousel.css","assets/css/owl.theme.css", "assets/css/pages/employeersignup.css"),
          );
            	$this->Admintheme->custom_webview("employeersignup",$data);


	}
}
