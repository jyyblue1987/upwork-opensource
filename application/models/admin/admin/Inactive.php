<?php
class Inactive extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function check()
    {
		if($this->session->userdata('type')=="1"){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }
	  function load()
    {
$data = array(
   'status' => 2,
);

$this->db->where('id', $_GET['id']);
$this->db->update('user', $data);
	redirect(site_url('administrator/admins/loadpage/inactiveadmin/'));

		}




}

?>
