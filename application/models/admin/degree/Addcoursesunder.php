<?php
class Addcoursesunder extends CI_Model {

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

	$degree=$_GET['degree'];
	$department=$_GET['department'];
	$name=$_POST['name'];

	$db="courses";




		$data[$db."_"."name"] = $name;
		$data[$db."_"."degree"] = $degree;
		$data[$db."_"."department"] = $department;
		$data[$db."_"."status"] = 1;


$this->db->insert($db, $data);
$dbid=$this->db->insert_id();

		redirect(site_url('administrator/userpage/loadpage/'.$page['loadpage'].'/subpage/manage?id='.$degree));


    }



}

?>
