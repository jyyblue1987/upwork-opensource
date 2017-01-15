<?php
class Expired extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function check($permission)
    {

	if($this->Adminlogincheck->checkper($permission['expired'])){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }
	  function load($permission,$mod)
    {


echo "Under Construction";

    }



}

?>
