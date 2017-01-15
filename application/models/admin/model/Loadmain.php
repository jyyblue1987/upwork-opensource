<?php 
class Loadmain extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function check($permission)
    {
		
				redirect(site_url());
				exit();
		
    }	
	  function load($permission,$mod)
    {
    }	
	
	
	
}

?>