<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Removeaccount extends CI_Controller {

	public function index()
	{
		
		echo  $_GET['id'];
		
	$data = array(
	   'instagramtoken_owner' => "na",
	);

	$this->db->where('instagramtoken_id', $_GET['id']);
	$this->db->update('instagramtoken', $data);

	
redirect(site_url('dashboard'));
		

	}
}
