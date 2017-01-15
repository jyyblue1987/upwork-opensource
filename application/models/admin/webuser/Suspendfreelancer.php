<?php
class Suspendfreelancer extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	  function check($permission) {

		if($this->Adminlogincheck->checkper($permission['suspendfreelancer'])){
			return true;
		}else{
			redirect(site_url());
			exit();
		}
    }
	  function load($permission,$mod){


		$page=$this->uri->uri_to_assoc();
		$title=$this->Adminforms->getdata("name","usersubpage",$permission['suspendfreelancer']);

		if(isset($_GET['q'])){
			$q=$_GET['q'];
		}else{
			$q=false;
		}

			$this->db->select('*');
			$this->db->from('webuser');
			$this->db->where('webuser.webuser_type', '2');
			$this->db->where('webuser.isactive', 0);
			$this->db->where('webuser.isdelete',0);
			$query = $this->db->get();
			$result = $query->result();


			
			$data = array( 'title' => $title, 'permission' => $permission, 'loadpage' => $page['loadpage'], 'subpage' => $page['subpage'],'result' => $result,  );
			$this->Admintheme->loadview($page['loadpage']."/".$page['subpage'],$data);



    }



}

?>
