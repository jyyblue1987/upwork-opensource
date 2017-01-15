<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetsent extends CI_Controller {

	public function index()
	{
	$data = array(
               'title' => "Reset Link Sent",
				       'page' => "resetsent",
							 'js' =>array(),
							 'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/owl.carousel.min.js","assets/js/homepage.js"),
							 'css' =>array("assets/css/layerslider.css","assets/css/owl.carousel.css","assets/css/owl.theme.css"),
          );
            	$this->Admintheme->webview("resetsent",$data);


	}
}
