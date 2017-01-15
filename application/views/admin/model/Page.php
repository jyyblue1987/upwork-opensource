<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {


		public function loadpage()
		{

		// $this->output->set_header("Access-Control-Allow-Origin: *");
		// $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
		// $this->output->set_status_header(200);


		$page=$this->uri->uri_to_assoc();
			if(isset($page['subpage'])){
				$callpage=$page['subpage'];
			}else{
				$callpage="loadmain";
			}
	$mod=$page['loadpage'];

echo $mod;

exit();



$this->load->model('admin/'.$mod.'/'.$callpage);




	}


}
