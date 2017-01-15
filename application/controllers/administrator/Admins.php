<?php
class Admins extends CI_Controller {

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

		public function loadpage()
		{

if($this->session->userdata('type')=="1"){
		$page=$this->uri->uri_to_assoc();
			if(isset($page['loadpage'])){
				$callpage=$page['loadpage'];
			}else{
				$callpage="loadmain";
			}


	$permission=array('list'=>'34', 'add'=> '35', 'edit'=> '36', 'inactive'=> '37');

	$this->load->model('admin/admin/'.$callpage);

	$this->$callpage->check($permission);
	$this->$callpage->load($permission);


		}else{
				redirect(site_url());
		}

	}


}
