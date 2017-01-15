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
               'title' => "Inactive Users",
               'header' => "Inactive Users"
        );

          	$page=$this->uri->uri_to_assoc();



                          						$this->Admintheme->loadview("users/".$page['loadpage'],$data);
    }



}

?>
