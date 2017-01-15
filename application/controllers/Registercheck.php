<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registercheck extends CI_Controller {


    function generateRandomString($length = 16) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
//        echo "<pre>";print_r($randomString);exit;
        return $randomString;
    }
	
	
    public function index() {
		
		
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$username=$_POST['username']; 
		$email=$_POST['email'];
		$type=$_POST['type'];
		$country=$_POST['country'];
		$password=$_POST['password'];
		
		$token=self::generateRandomString(30);
		
		 $this->db->select('webuser_id');
 $this->db->from('webuser');
 $this->db->where('webuser_email', $email);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() > 0)
   {
		 
redirect(site_url('signup?email=true'));
			exit();
   }
		
		 $this->db->select('webuser_id');
 $this->db->from('webuser');
 $this->db->where('webuser_username', $username);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() > 0)
   {
redirect(site_url('signup?username=true'));
			exit();
   }	
			
	
		
	       $add_data = array(
                        'webuser_fname' => $fname,
                        'webuser_lname' => $lname,
                        'webuser_username' => $username,
                        'webuser_country' => $country,
                        'webuser_password' => md5($password),
                        'webuser_orpass' => $password,
                        'webuser_email' => $email,
                        'webuser_type' => $type,
                        'webuser_token' => $token,
                        'webuser_status' => "1",
                    );

			$resetlink=site_url()."verifyemail?token=".$token;;
$this->db->insert('webuser', $add_data); 
$id=$this->db->insert_id();


$subject ='Confirm your email to activate account';
$body = 'Hello '.$fname.' '.$lname.',<br><br> Thank you for signing up for an account on Winjob.com <br><br>Please click on the link below to verify your email address: <br> <a href="'.$resetlink.'">'.$resetlink.'</a>'
        . '<br><br>If you didn\'t sign up for this account, or you are having trouble with your account, please contact us at support@winjob.com and we will be happy to help you.'
        . '<br><br>Regards,<br>The support team at Winjob.com';



$response=$this->Sesmailer->sesemail($email,$subject,$body);


redirect(site_url('thanks'));
		

			
    }

	
	
	
}
