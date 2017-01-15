<?php 
class Countrylist extends CI_Model {



	  function load()
    {
		

	
 $this->db->select('*');
 $this->db->from('country');
 $this->db->order_by("country_name", "asc"); 
 
 $query = $this -> db -> get();
 



                echo json_encode(array('country_list' => $query->result()));
				
				
	
	
    }	
	
	
	
}

?>