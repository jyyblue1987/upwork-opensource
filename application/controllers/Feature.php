<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feature extends CI_Controller {

	public function index()
	{

			$data = array(
               'title' => "Homepage",
				       'page' => "feature",
							 'js' =>array(),
							 'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/feature.js"),
							 'css' =>array("assets/css/layerslider.css","assets/css/owl.theme.css"),
          );
            	$this->Admintheme->webview("feature",$data);

	}
}
