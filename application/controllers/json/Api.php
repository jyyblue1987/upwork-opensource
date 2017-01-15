<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {


public function type()
{
    		$this->output->set_header("Access-Control-Allow-Origin: *");
		$this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
		$this->output->set_status_header(200);
		header('Content-Type: application/json');


		$page=$this->uri->uri_to_assoc();
			if(isset($page['page'])){
				$callpage=$page['page'];
			}else{
			echo "Bad request";
			exit();
			}
	$mod=$page['type'];
$this->load->model('api/'.$mod.'/'.$callpage);
$this->$callpage->load();

	}


}

