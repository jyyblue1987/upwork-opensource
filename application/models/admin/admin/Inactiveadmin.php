<?php
class Inactiveadmin extends CI_Model {

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
               'title' => "Inactive system admin List",
               'header' => "Inactive system admin list"
        );

          	$page=$this->uri->uri_to_assoc();



                          						$this->Admintheme->loadview("admin/".$page['loadpage'],$data);
    }



}

?>
