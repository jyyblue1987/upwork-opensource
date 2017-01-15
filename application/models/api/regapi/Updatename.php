<?php 
class Updatename extends CI_Model {



	function load()
    	{
		

	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$v_check=$_POST['v_check'];
	
	if($v_check== 1)
	{	
		$usercompany=$_POST['usercompany'];
		$usertitle=$_POST['usertitle'];
		$uservat=$_POST['uservat'];
		$usersite=$_POST['usersite'];
	
		
		$data = array(
		   'webuser_fname' => $fname,
		   'webuser_lname' => $lname,
		   'webuser_company' => $usercompany,
		   'webuser_title' => $usertitle,
		   'webuser_resetexpire' => $uservat,
		   'webuser_site' => $usersite,
		);
	}
	else
	{
		$data = array(
		   'webuser_fname' => $fname,
		   'webuser_lname' => $lname,
		);
	}
	$this->db->where('webuser_id', $this->session->userdata('id'));
	$this->db->update('webuser', $data);

		
			echo json_encode(array("status"=>"success"));	
	
	
    }	
	
	
	
}

?>