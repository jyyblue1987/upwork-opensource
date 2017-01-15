<?php
class Login extends CI_Controller {

	public function index()
	{
        $text=$this->siteconfig->text();
	$data = array(
               'text' => $text,
               'title' => "Login | ".$text['title'],
               'message' => 'Locked',
               'color' => 'fffff'
          );
	$this->load->view('admin/login/login.php',$data, false);
	}

	public function error()
	{


        $text=$this->siteconfig->text();

		$usename=$this->uri->uri_to_assoc();

		if(isset($usename['user'])){
			$username=$usename['user'];
		}else{
			$username="";
		}
		if(isset($usename['type'])){
			if($usename['type']=="offline"){
				$errormsg="Our website is temporary inaccessible.";
			}
			if($usename['type']=="inactive"){
				$errormsg="Your account is disabled. Contact us.";
			}
		}else{
			$errormsg="Wrong Username/Password";
		}

	$data = array(
               'text' => $text,
               'title' => "Error Sigining In | ".$text['title'],
               'errormsg' => $errormsg,
               'color' => 'ff0000',
               'username' => $username
          );


	$this->load->view('admin/login/login.php',$data, false);
	}
	public function check()
	{


		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			echo $this->input->post('email');
			if ($_POST['email']=="")
		{
				redirect(site_url("administrator/login/error/true"));

		}else{
				redirect(site_url("administrator/login/error/true/user/".urlencode($_POST['email'])));
		}
		}
		else
		{
$email=$_POST['email'];
$password=md5($_POST['password']);



 $this->db->select('id, name, username, email, type,status');
 $this->db->from('user');
 $this->db->where("(email='$email' OR username LIKE '$email')", null,false);
 $this->db->where('password', $password);
 $this->db->limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
	   $return=$query->result()[0];

	   if($return->status==1){
$lastlogin = microtime(true);

$data = array(
   'lastlogin' => $lastlogin ,
);

$this->db->where('id', $return->id);
$this->db->update('user', $data);

if(isset($_POST['remember_me'])){
$remember = $_POST['remember_me'];
}else{
$remember = "off";
}

		 if($remember=="on")
    {
            $cookie = $this->input->cookie('ci_session'); // we get the cookie
            $this->input->set_cookie('ci_session', $cookie, '35580000'); // and add one year to it's expiration

    }

	$this->session->set_userdata('logged', "1");
	$this->session->set_userdata('id', $return->id);
	$this->session->set_userdata('username', $return->username);
	$this->session->set_userdata('name', $return->name);
	$this->session->set_userdata('email', $return->email);
	$this->session->set_userdata('type', $return->type);
	$this->session->set_userdata('remember_me', $remember);

		redirect(site_url("administrator"));
	   }else{
		redirect(site_url("administrator/login/error/true/type/inactive"));
	   }
   }
   else
   {
		$this->session->sess_destroy();
		redirect(site_url("administrator/login/error/true/user/".urlencode($_POST['email'])));
   }


		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url("administrator"));
	}
	public function forget()
	{

        $text=$this->siteconfig->text();
	$data = array(
               'text' => $text,
               'title' => "Forget password | ".$text['title'],
               'message' => 'Locked',
               'color' => 'fffff'
          );
	$this->load->view('admin/login/forget.php',$data, false);

	}


	public function forgetcheck()
	{


$email=$_POST['email'];

 $this->db->select('id,email,name');
 $this->db->from('user');
 $this->db->where("(email='$email' OR username LIKE '$email')", null,false);
 $this->db->limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
	   $mkt=$_SERVER["REQUEST_TIME"];
	   $emkt=$mkt+10800;

	   $return=$query->result()[0];
	   $test=$mkt."xx".$return->id;
	   $token=md5($mkt);

	   $resetlink=site_url("administrator/login/reset/?token=".$token);

$data = array(
   'token' => $token,
   'user' => $return->id,
   'status' => "1",
   'ctime' => $mkt,
   'etime' => $emkt
);

$this->db->insert('adminresettoken', $data);
$id=$this->db->insert_id();


			$text=$this->siteconfig->text();

$subject = $text['title'].' password reset';
$body = 'Hello '.$return->name.',<br><br> To reset your password visit this link <a href="'.$resetlink.'">'.$resetlink.'</a>';

$response=$this->Sesmailer->sesemail($return->email,$subject,$body);


if (!$response) {


        $text=$this->siteconfig->text();
	$data = array(
               'text' => $text,
               'title' => "Forget password | ".$text['title'],
               'errormsg' => "Error Sending Email . Please try again or contact us.",
               'message' => 'Locked',
               'color' => 'fffff'
          );
	$this->load->view('admin/login/forget.php',$data, false);


}else {


        $text=$this->siteconfig->text();
	$data = array(
               'text' => $text,
               'title' => "Forget password | ".$text['title'],
               'sentemail' => $return->email,
               'message' => 'Locked',
               'color' => 'fffff'
          );
	$this->load->view('admin/login/forget.php',$data, false);

}





   }else{

        $text=$this->siteconfig->text();
	$data = array(
               'text' => $text,
               'title' => "Forget password | ".$text['title'],
               'errormsg' => "Email or username not found",
               'message' => 'Locked',
               'color' => 'fffff'
          );
	$this->load->view('admin/login/forget.php',$data, false);


   }

	}

	public function reset()
	{
		if(isset($_GET['token'])){
			$token=$_GET['token'];

 $this->db->select('user,etime');
 $this->db->from('adminresettoken');
 $this->db->where('token', $token);
 $this->db->where('status', "1");
 $this->db->limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {

	   $mkt=$_SERVER["REQUEST_TIME"];

	   $return=$query->result()[0];
	   if($return->etime > $mkt){

			 			 		         $text=$this->siteconfig->text();
			 			 		 	$data = array(
			 			 		                'text' => $text,
			 			 		                'title' => "Reset password | ".$text['title'],
               'token' => $token,
               'message' => 'Locked',
               'color' => 'fffff'
          );
	$this->load->view('admin/login/resetpassword.php',$data, false);


	   }else{

			 		         $text=$this->siteconfig->text();
			 		 	$data = array(
			 		                'text' => $text,
			 		                'title' => "Forget password | ".$text['title'],
               'message' => 'Locked',
               'color' => 'fffff'
          );
	$this->load->view('admin/login/forget.php',$data, false);

	   }

   }else{



		 		         $text=$this->siteconfig->text();
		 		 	$data = array(
		 		                'text' => $text,
		 		                'title' => "Forget password | ".$text['title'],
               'etok' => "Invalid/expired password reset request",
               'message' => 'Locked',
               'color' => 'fffff'
          );
	$this->load->view('admin/login/forget.php',$data, false);

   }
		}else{

				redirect(site_url("login/forget"));

		}
	}
	public function resetcheck()
	{

			if(isset($_GET['token'])){
				$token=$_GET['token'];

 $this->db->select('user,etime');
 $this->db->from('adminresettoken');
 $this->db->where('token', $token);
 $this->db->where('status', "1");
 $this->db->limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {

	   $mkt=$_SERVER["REQUEST_TIME"];

	   $return=$query->result()[0];
	   if($return->etime > $mkt){




$password=$_POST['password'];
$pass=md5($_POST['password']);
$vpassword=$_POST['vpassword'];

if(strlen($password)>5){
if($password==$vpassword){


$data = array(
   'password' => $pass
);

$this->db->where('id', $return->user);
$this->db->update('user', $data);


$this->db->where('token', $token);
$this->db->delete('adminresettoken');

   $text=$this->siteconfig->text();
				$data = array(
											'text' => $text,
               'title' => "Sign In | ".$text['title'],
               'sentemail' => "Password successfully reseted.",
               'color' => 'ff0000'
          );


	$this->load->view('admin/login/login.php',$data, false);

}else{


				 		         $text=$this->siteconfig->text();
				 		 	$data = array(
				 		                'text' => $text,
				 		                'title' => "Reset password | ".$text['title'],
               'token' => $token,
               'errormsg' => "Both password doesnt match",
               'message' => 'Locked',
               'color' => 'fffff'
          );
	$this->load->view('admin/login/resetpassword.php',$data, false);

}
}else{




			 		         $text=$this->siteconfig->text();
			 		 	$data = array(
			 		                'text' => $text,
			 		                'title' => "Reset password | ".$text['title'],
               'token' => $token,
               'errormsg' => "Invalid password . Minimum 6 characters.",
               'message' => 'Locked',
               'color' => 'fffff'
          );
	$this->load->view('admin/login/resetpassword.php',$data, false);

}















	   }else{



			$data = array(
               'title' => "Forget Password | ".$text['title'],
               'etok' => "Invalid/expired password reset request",
               'message' => 'Locked',
               'color' => 'fffff'
          );
	$this->load->view('admin/login/forget.php',$data, false);

	   }

   }else{
	 			 			 		         $text=$this->siteconfig->text();

			$data = array(
               'title' => "Forget Password | ".$text['title'],
               'etok' => "Invalid/expired password reset request",
               'message' => 'Locked',
               'color' => 'fffff'
          );
	$this->load->view('admin/login/forget.php',$data, false);

   }
		}else{

				redirect(site_url("admin/login/forget"));

		}
	}

}
