<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resource extends CI_Controller {

	public function index()
	{

			$data = array(
               'title' => "Homepage",
				       'page' => "resource",
							 'js' =>array(),
							 'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/feature.js","assets/global/vendor/jquery-wizard/jquery-wizard.js","assets/global/js/components/jquery-wizard.js"),
							 'css' =>array("assets/css/layerslider.css","assets/css/owl.theme.css","assets/global/vendor/jquery-wizard/jquery-wizard.css"),
          );
            	$this->Admintheme->webview("resource",$data);

	}
}
