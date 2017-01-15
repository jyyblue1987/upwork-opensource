<?php
class Permission extends CI_Model {

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


  	$page=$this->uri->uri_to_assoc();

		$data = array(
               'title' => "Users Permission",
               'header' => "Users Permission",
        );

                  						$this->Admintheme->loadview("users/".$page['loadpage'],$data);

    }



}

?>
