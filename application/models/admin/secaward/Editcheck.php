<?php
class Editcheck extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function check($permission)
    {
	if($this->Adminlogincheck->checkper($permission['edit'])){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }
	  function load()
    {


	$id=$_GET['id'];
	$page=$this->uri->uri_to_assoc();

	$db="secaward";
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
 $this->db->where($db.'_id !=', $id);

   $query = $this -> db -> get();

   if($query -> num_rows() > 0)
   {
				redirect(site_url('administrator/userpage/loadpage/'.$page['loadpage'].'/subpage/edit/error/55/?id='.$id));
				exit();
   }



	foreach($inputarr as $val){
		$temp=$db."_".$val;
		$data[$temp] = $$temp;
	}



$this->db->where($db.'_id', $id);
$this->db->update($db, $data);




redirect(site_url('administrator/userpage/loadpage/'.$page['loadpage'].'/subpage/lists/'));

    }
}

?>
