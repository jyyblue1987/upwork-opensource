<?php 
class Locationloader extends CI_Model {



	  function load()
    {
		

                echo json_encode(array('country_list' => $this->Adminforms->countryjson()));
				
				
	
	
    }	
	
	
	
}

?>