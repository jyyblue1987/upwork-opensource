<?php 
class Mailcheck extends CI_Model {



	  function load()
    {
		

$data=$_GET['email'];
			
		 $this->db->select('webuser_id');
 $this->db->from('webuser');
 $this->db->where('webuser_email', $data);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() > 0)
   {
   
echo json_encode(array("valid"=>false));
   }else{
	  
   
echo json_encode(array("valid"=>true)); 
	   
   }
		
		
				
	
	
    }	
	
	
	
}

?>