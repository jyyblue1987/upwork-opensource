<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetpasscheck extends CI_Controller {

	public function index()
	{


		
		$token=$_GET['token'];
		
	   $mkt=$_SERVER["REQUEST_TIME"];
	   
		 $this->db->select('*');
		 $this->db->from('webuser');
		 $this->db->where('webuser_resettoken', $token);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() > 0)
   {
	   
	   
	$stud=$query->result()[0];
	if($stud->webuser_resetexpire>$mkt){
		
		$password=$_POST['password'];
		
	$data = array(
	   'webuser_password' => md5($password),
	   'webuser_resettoken' => "",
	);

	$this->db->where('webuser_resettoken', $token);
	$this->db->update('webuser', $data);

	
redirect(site_url('signin?reset=true'));
		
	}else{
redirect(site_url('resetpass?expired=true'));
		
	}
	
	
	
	
   }else{
redirect(site_url('resetpass?wrong=true'));
   }

	}
}
