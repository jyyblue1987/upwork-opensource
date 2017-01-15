<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changepasscheck extends CI_Controller {

	public function index()
	{


		if($this->Adminlogincheck->checkx()){

			
		
		$oldpassword=$_POST['old_password'];
		
	   $mkt=$_SERVER["REQUEST_TIME"];
	   
		 $this->db->select('*');
		 $this->db->from('webuser');
		 $this->db->where('webuser_password', md5($oldpassword));
		 $this->db->where('webuser_id', $this->session->userdata('id'));
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() > 0)
   {
	   
	   
	$stud=$query->result()[0];
	
		$password=$_POST['password'];
		
	$data = array(
	   'webuser_password' => md5($password),
	);

	$this->db->where('webuser_id', $this->session->userdata('id'));
	$this->db->update('webuser', $data);

	
redirect(site_url('changepassword?changed=true'));
		

	
	
	
   }else{
redirect(site_url('changepassword?error=true'));
   }

		}else{
		redirect(site_url("dashboard"));
		}
		
	}
}
