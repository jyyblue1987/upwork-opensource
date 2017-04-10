<?php
class Withdawlrequest extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('withdraw_model');
        $this->load->model('payment_methods_model');
    }

	  function check($permission) {

		if($this->Adminlogincheck->checkper($permission['withdawlrequest'])){
			return true;
		}else{
			redirect(site_url());
			exit();
		}
    }
	  function load($permission,$mod){


		$page=$this->uri->uri_to_assoc();
		$title=$this->Adminforms->getdata("name","usersubpage",$permission['withdawlrequest']);

		if(isset($_GET['q'])){
			$q=$_GET['q'];
		}else{
			$q=false;
		}

			$this->db->select('*');
			$this->db->from('webuser');
			$this->db->where('webuser.webuser_type', '1');
			$this->db->where('webuser.isactive', 1);
			$this->db->where('webuser.isdelete',0);
			$query = $this->db->get();
			$result = $query->result();

			$record = $this->withdraw_model->get_by_all_user('pending');
			foreach ($record as $key => $value)
			{
				$data = $this->payment_methods_model->get_email_by_user_and_method($value['webuser_id'], strtolower($value['payment_type']));

				$record[$key]['email_payment'] = $data->account_id;
			}

			$data = array(
				'title' => $title,
				'permission' => $permission,
				'loadpage' => $page['loadpage'],
				'subpage' => $page['subpage'],
				'result' => $result,
				'record' => $record
			);

			$this->Admintheme->loadview($page['loadpage']."/".$page['subpage'],$data);



    }



}

?>
