<?php
class Edit extends CI_Model {

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

		if(isset($page['error'])){
			$error=$page['error'];
		}else{
			$error="na";
		}

				if($error=="22"){
					$errormsg= "Invalid Name";
				}elseif($error=="33"){
					$errormsg= "Invalid Username";
				}elseif($error=="44"){
					$errormsg= "Invalid Email";
				}elseif($error=="55"){
					$errormsg= "Email allready exists";
				}elseif($error=="66"){
					$errormsg= "Username allready exists";
				}else{
					$errormsg= "na";
				}

			$data = array(
               'title' => "Edit ".$this->Adminforms->getdata("name","user",$_GET['id']),
               'header' => "Edit ".$this->Adminforms->getdata("name","user",$_GET['id']),
               'errormsg' => $errormsg
          );


            	$page=$this->uri->uri_to_assoc();
            	$this->Admintheme->loadview("admin/".$page['loadpage'],$data);


    }



}

?>
