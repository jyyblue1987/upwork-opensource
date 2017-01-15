<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tos extends CI_Controller {

	public function index()
	{
$data=array(
 "title" => "Terms of Services"
);

             $this->load->view('webview/layout/tos.php',$data, false);

	}
}
