<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {


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

var_dump($page);

exit();

		switch ($mod) {



					case "country":
					$permission=array('lists'=> '1' , 'add'=> '2' , 'edit'=> '3' , 'inactive'=> '4' , 'manage'=> '18');
					break;
					case "degree":
					$permission=array('lists'=> '5' , 'add'=> '6' , 'edit'=> '7' , 'inactive'=> '8');
					break;
					case "category":
					$permission=array('lists'=> '9' , 'add'=> '10' , 'edit'=> '11' , 'inactive'=> '12');
					break;
					case "courses":
					$permission=array('lists'=> '13' , 'add'=> '14' , 'edit'=> '15' , 'inactive'=> '16');
					break;
					case "listapi":
					$permission=array('countrylist'=> '17');
					break;
}


$this->load->model('admin/'.$mod.'/'.$callpage);
$this->$callpage->check($permission);
$this->$callpage->load($permission,$mod);




	}


}
