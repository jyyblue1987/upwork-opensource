<?php
class System extends CI_Controller {

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

									if($this->session->userdata('type')=="1"){
									$data = array(
														 'title' => "System Setting",
						          );

						$this->Admintheme->loadview("system/setting",$data);
								}
								}



								public function change()
								{
							if($this->session->userdata('type')=="1"){

												$value = ($_POST['toggle'] == "on" ? 1 : 2);

							if($this->session->userdata('type')=="1"){

							$data = array(
							   'value' => $value,
							);

							$this->db->where('id', 1);
							$this->db->update('site', $data);

								redirect(site_url('administrator/system/setting'));
									}
									}else{
											redirect(site_url());
									}

								}



}
