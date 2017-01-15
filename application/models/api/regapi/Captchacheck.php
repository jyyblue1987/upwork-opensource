<?php 
class Captchacheck extends CI_Model {



  function load() {
		

    $captcha=$_GET['captcha'];
			
   if( strcasecmp($_SESSION['captchaWord'], $captcha) == 0 )
   {
       echo json_encode(array("valid"=>true));
   } else{
        echo json_encode(array("valid"=>false));
   }

  }
	
	
	
}

?>