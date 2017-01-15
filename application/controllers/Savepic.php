<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savepic extends CI_Controller {


	public function index()
	{

		if($this->Adminlogincheck->checkx()){

			
$picture=$_POST['picture'];
			
	
	$data = array(
	   'webuser_picture' => $picture,
	);

	$this->db->where('webuser_id', $this->session->userdata('id'));
	$this->db->update('webuser', $data);

			
		redirect(site_url("profilesetting"));
				

		}else{
		redirect(site_url("signin"));
		}


	}
}
