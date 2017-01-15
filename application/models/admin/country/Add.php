<?php
class Add extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function check($permission)
    {


	if($this->Adminlogincheck->checkper($permission['add'])){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }
	  function load($permission,$mod)
    {





	$page=$this->uri->uri_to_assoc();

			if(isset($page['error'])){
			$error=$page['error'];
		}else{
			$error="na";
		}

				if($error=="22"){
					$errormsg= "Invalid Name";
				}elseif($error=="55"){
					$errormsg= "Name allready exists";
				}else{
					$errormsg= "na";
				}



		$title=$this->Adminforms->getdata("name","usersubpage",$permission['add']);

			$data = array(
               'title' => $title,
               'db' => "country",
               'permission' => $permission,
               'loadpage' => $page['loadpage'],
               'subpage' => $page['subpage'],
               'errormsg' => $errormsg,
          );

		$this->Admintheme->loadview($page['loadpage']."/".$page['subpage'],$data);




    }



}

?>
