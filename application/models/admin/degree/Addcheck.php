<?php
class Addcheck extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


	  function check($permission)
    {

	if($this->Adminlogincheck->checkper($permission['add'])){

		return true;

		}else{

				redirect(site_url());
				exit();
		}



    }
	  function load($permission,$mod)
    {



	$page=$this->uri->uri_to_assoc();

	$db="degree";
	$inputarr=array("name", "index");

	foreach($inputarr as $val){

		$temp=$db."_".$val;
		if(isset($_POST[$temp])){
		$$temp=$_POST[$temp];
		}else{
		redirect(site_url());
		}

	}
	$tempname=$db.'_name';





		 $this->db->select($db.'_id');
 $this->db->from($db);
 $this->db->where($db.'_name', $$tempname);

   $query = $this -> db -> get();

   if($query -> num_rows() > 0)
   {
		redirect(site_url('administrator/userpage/loadpage/'.$page['loadpage'].'/subpage/add/error/55/'));
				exit();
   }



	foreach($inputarr as $val){
		$temp=$db."_".$val;
		$data[$temp] = $$temp;
	}

		$data[$db."_"."status"] = 1;


$this->db->insert($db, $data);
$id=$this->db->insert_id();

				redirect(site_url('administrator/userpage/loadpage/'.$page['loadpage'].'/subpage/lists'));

    }
}

?>
