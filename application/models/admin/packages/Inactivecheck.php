<?php
class Inactivecheck extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

  function check($permission)
    {

	if($this->Adminlogincheck->checkper($permission['inactive'])){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }

	  function load($permission,$mod)
    {
		$db="packages";
	$page=$this->uri->uri_to_assoc();

$data = array(
   $db.'_status' => 2,
);

$this->db->where($db.'_id', $_GET['id']);
$this->db->update($db, $data);
	redirect(site_url('administrator/userpage/loadpage/'.$this->uri->segment(4).'/subpage/inactive/'));

		}



}

?>
