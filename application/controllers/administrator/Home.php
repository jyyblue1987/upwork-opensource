<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function index()
	{
           

		if($this->Adminlogincheck->check()){

			$data = array(
								 'title' => "Dashboard",
          );

$this->Admintheme->loadview("home/fullb",$data);


		}else{
        $text=$this->siteconfig->text();
	$data = array(
               'text' => $text,
               'title' => "Login | ".$text['title'],
               'message' => 'Locked',
               'color' => 'fffff'
          );

	$this->load->view('admin/login/login.php',$data, false);
		}


	}
}
