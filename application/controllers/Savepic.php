<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savepic extends CI_Controller {


	public function index()
	{

		if($this->Adminlogincheck->checkx()){

			$picture= $_POST['picture'];
			$CroppedImage= $_POST['CroppedImage'];


			$data = array(
			'webuser_picture' => $picture,
			'cropped_image' => $CroppedImage,

			);

			$this->db->where('webuser_id', $this->session->userdata('id'));
			$this->db->update('webuser', $data);
			//echo $this->db->last_query();die;

			redirect(site_url("profilesetting"));


		}else{
			redirect(site_url("signin"));
		}


	}


		public function editimg()
	{

		if($this->Adminlogincheck->checkx()){

			$sql = "SELECT * FROM webuser WHERE webuser_id =  " . $this->session->userdata('id');
                $user =    $this->db->query($sql)->row();

			$picture= $_POST['picture'];
			$CroppedImage= $_POST['CroppedImage'];


			$data = array(
			'webuser_picture' => $picture,
			'cropped_image' => $CroppedImage,

			);

			$this->db->where('webuser_id', $this->session->userdata('id'));
			$this->db->update('webuser', $data);
			//echo $this->db->last_query();die;

			redirect(site_url("profile/".strtolower($user->webuser_fname)));


		}else{
			redirect(site_url("signin"));
		}


	}
}
