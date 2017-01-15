<?php
class User extends CI_Controller {

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

					public function setting()
					{

									if($this->Adminlogincheck->check()){
						$data = array(
											 'title' => "User Setting",
			          );

			$this->Admintheme->loadview("user/setting",$data);
					}
					}


		



			public function changepass()
{

			if($this->Adminlogincheck->check()){
		//echo $this->session->userdata('user');

$this->load->model('admin/Changepassword');
$check=$this->Changepassword->check();

				$data = array(
									 'title' => "User Setting",
									 'response' => $check
	          );

	$this->Admintheme->loadview("user/setting",$data);

	}else{
			redirect(site_url("administrator"));
	}
}




	public function changepic()
	{
				if($this->Adminlogincheck->check()){


$this->load->model('admin/Changepic');
$check=$this->Changepic->check();


				$data = array(
								'title' => "User Setting",
               'response' => $check
          );

						$this->Admintheme->loadview("user/setting",$data);

		}else{
				redirect(site_url());
		}
	}



}
