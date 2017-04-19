<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
           
	if($this->Adminlogincheck->checkx()){
		redirect(site_url("dashboard"));
		}else{
			$params = array(
                	'title' => "Winjob Home"
            	);
			/*$data = array(
                            'title' => "Homepage",
                            'page' => "homepage",
                            'js' =>array(),
                            'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/owl.carousel.min.js","assets/js/homepage.js"),
                            'css' =>array("assets/css/layerslider.css","assets/css/owl.carousel.css","assets/css/owl.theme.css"),
                        );
                        $this->Admintheme->webview("home",$data);
                         * 
                         */
                    $this->Admintheme->custom_webview("winjob/home",$params);
		}
	}
	 
	public function homepage(){
            $params = array(
                'title' => "Winjob Home"
            );
            $this->Admintheme->custom_webview("winjob/home",$params);
        }
}
