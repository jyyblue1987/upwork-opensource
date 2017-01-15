<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifyemail extends CI_Controller {

	public function index()
	{
		
		
			
		 $this->db->select('webuser_id');
 $this->db->from('webuser');
 $this->db->where('webuser_token', $_GET['token']);
 $this->db->where('webuser_status', "1");
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() > 0)
   {
		
	$data=array(
		"webuser_status" => "2"
	);

 $this->db->where('webuser_token', $_GET['token']);
 $this->db->where('webuser_status', "1");
$this->db->update('webuser', $data); 


	$data = array(
               'title' => "Thanks for verification",
				       'page' => "thank",
				       'message' => "Thanks for verification",
							 'js' =>array(),
							 'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/owl.carousel.min.js","assets/js/homepage.js"),
							 'css' =>array("assets/css/layerslider.css","assets/css/owl.carousel.css","assets/css/owl.theme.css"),
          );
            	$this->Admintheme->webview("thank",$data);

				
   }else{
	   	
	$data = array(
               'title' => "Thanks for verification",
				       'page' => "thank",
				       'message' => "Allready Verified / Invalid Link",
							 'js' =>array(),
							 'jsf' =>array("assets/js/layerslider.transitions.js","assets/js/layerslider.kreaturamedia.jquery.js","assets/js/owl.carousel.min.js","assets/js/homepage.js"),
							 'css' =>array("assets/css/layerslider.css","assets/css/owl.carousel.css","assets/css/owl.theme.css"),
          );
            	$this->Admintheme->webview("thank",$data);

   }	
		

	}
}
