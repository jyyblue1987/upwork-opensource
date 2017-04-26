<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function index()
	{

		$data = array(
               'title' => "Contact Us",
				       'page' => "contact",
							 'js' =>array('contactus.js'),
							 'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/owl.carousel.min.js","assets/js/homepage.js"),
							 'css' =>array("assets/css/layerslider.css","assets/css/owl.carousel.css","assets/css/owl.theme.css"),
        );

		//$this->Admintheme->webview("contact",$data);
		// added by Sergey start

		if ($_GET['error']) {
			$data['error'] = $_GET['error'];
		}

		if ($_GET['sent'] && $_GET['ticketID']) {
			$data['sent'] = $_GET['sent'];
			$data['ticketID'] = $_GET['ticketID'];
		}

		$data['captcha'] = $this->get_captcha();
		$this->Admintheme->custom_webview("contactus",$data);
		// added by Sergey end


	}

	//added by Sergey start

	public function captcha_refresh(){
		$captcha = $this->get_captcha();
		echo $captcha['image'];

	}

	private function get_captcha() {
		// loading captcha helper
		$this->load->helper('captcha');
		$random_number = substr(number_format(time() * rand(),0,'',''),0,3);
		// setting up captcha config
		$vals = array(
			'word' => '',
			'img_path' => './temp/captcha/',
			'font_path'	=>  base_url() . 'system/fonts/texb.ttf',
			'img_url' => base_url().'temp/captcha/',
			'img_width' => 200,
			'img_height' => 40,
			'word_length'   => 3,
			'font_size'     => 16,
			'expiration' => 7200,
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'colors'        => array(
				'background' => array(227, 218, 237),
				'border' => array(255, 255, 255),
				'text' => array(74, 138, 225),
				'grid' => array(129, 191, 254)
			)
		);
		$captcha = create_captcha($vals);
		$_SESSION['captchaWord'] = $captcha['word'];
		return $captcha;
	}

	// added by Sergey end
}
