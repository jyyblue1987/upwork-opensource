<?php
class Adddepartment extends CI_Model {

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

	$id=$_GET['id'];

	$db="department";
	$inputarr=array("name");

	foreach($inputarr as $val){

		$temp=$db."_".$val;
		if(isset($_POST[$temp])){
		$$temp=$_POST[$temp];
		}else{
		redirect(site_url());
		}

	}


	foreach($inputarr as $val){
		$temp=$db."_".$val;
		$data[$temp] = $$temp;
	}

		$data[$db."_"."degree"] = $id;
		$data[$db."_"."status"] = 1;


$this->db->insert($db, $data);
$dbid=$this->db->insert_id();

		redirect(site_url('administrator/userpage/loadpage/'.$page['loadpage'].'/subpage/manage?id='.$id));


    }



}

?>
