<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resendlink extends CI_Controller {

	public function index()
	{
 if(isset($_GET['username'])){
		$username=$_GET['username'];
 }
	 $this->db->select('*');
 $this->db->from('webuser');
 $this->db->where("(webuser_email = '$username' OR webuser_username = '$username')");
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() > 0)
   {
	   
	   $stud=$query->result()[0];
	   	   if($stud->webuser_status=="1"){
		   
	$fname=$stud->webuser_fname;
	$lname=$stud->webuser_lname;
	$token=$stud->webuser_token;
	$email=$stud->webuser_email;

			$resetlink=site_url()."verifyemail?token=".$token;;
$subject ='Confirm your email to activate account';
$body = 'Hello '.$fname.' '.$lname.',<br><br> Thank you for signing up for an account on Winjob.com <br><br>Please click on the link below to verify your email address: <br> <a href="'.$resetlink.'">'.$resetlink.'</a>'
        . '<br><br>If you didn\'t sign up for this account, or you are having trouble with your account, please contact us at support@winjob.com and we will be happy to help you.'
        . '<br><br>Regards,<br>The support team at Winjob.com';


$response=$this->Sesmailer->sesemail($email,$subject,$body);



redirect(site_url('resent'));  
		   
	   }else{
		   
		
redirect(site_url('signin'));


	   }
   }else{
	   
redirect(site_url());
	
   }	
   
	}
}
