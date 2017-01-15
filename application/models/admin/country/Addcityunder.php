<?php 
class Addcityunder extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function check($permission)
    {
	if($this->Adminlogincheck->checkper($permission['manage'])){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }	
	  function load($permission,$mod)
    {

	
	
	

	$page=$this->uri->uri_to_assoc();
	
	$country=$_GET['country'];
	$states=$_GET['states'];
	$name=$_POST['name'];
	
	$db="city";

	

	
		$data[$db."_"."name"] = $name;
		$data[$db."_"."country"] = $country;
		$data[$db."_"."states"] = $states;
		$data[$db."_"."status"] = 1;
	

$this->db->insert($db, $data); 
$dbid=$this->db->insert_id();
	
		redirect(site_url('administrator/userpage/loadpage/'.$page['loadpage'].'/subpage/statecity?id='.$country));

	
    }	
	
	
	
}

?>