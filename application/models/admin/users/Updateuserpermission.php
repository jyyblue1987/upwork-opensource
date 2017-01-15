<?php 
class Updateuserpermission extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function check()
    {
		if($this->session->userdata('type')=="1"){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }	
	  function load()
    {
  $id=$_GET['id'];
				  
		$this->db->delete('usersubpageaccess', array('user' => $id)); 
		$this->db->delete('userpageaccess', array('user' => $id)); 
		$this->db->delete('usersectionaccess', array('user' => $id)); 
		  
foreach ($_POST as $key => $val) {
if(preg_match("/lm/",$key)) {
$u = explode("lm",$key);
$nam = $u[0];
$val = $u[1];


 $this->db->select('*');
 $this->db->from('user'.$nam);
 $this->db->where('id', $val);
 $query = $this -> db -> get();




foreach ($query->result() as $value) {

if($nam=="page"){
$name=$value->page;
$section=$value->section;

$data = array(
   'user' => $id ,
   'section' => $section ,
   $nam => $val
);
$dbx='user'.$nam.'access';
$this->db->insert($dbx, $data); 



}elseif($nam=="subpage"){
$name=$value->subpage;
$page=$value->page;

$data = array(
   'user' => $id ,
   'page' => $page ,
   $nam => $val
);

$dbx='user'.$nam.'access';
$this->db->insert($dbx, $data); 


}elseif($nam=="section"){

$data = array(
   'user' => $id ,
   $nam => $val
);

$dbx='user'.$nam.'access';
$this->db->insert($dbx, $data); 


}


}
}
}
		

			redirect(site_url('administrator/users/loadpage/permission?id='.$_GET['id']));
		
		}

	
	
	
}

?>