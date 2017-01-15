<?php 
class Editcityb extends CI_Model {

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
	
		$db="city";
		
	
	$data = array(
	   $db.'_name' => $_POST['name'],
	);

$this->db->where($db.'_id', $_GET['id']);
$this->db->update($db, $data); 

	redirect(site_url('administrator/userpage/loadpage/'.$this->uri->segment(4).'/subpage/statecity/?id='.$_GET['country']));
	
	
	
	}
	
	
	
}

?>