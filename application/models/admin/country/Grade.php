<?php 
class Grade extends CI_Model {

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
	

	
		$title=$this->Adminforms->getdata("name","usersubpage",$permission['manage']);
		
		
		
	$qdata=array(
		"db"=>"grade",
		"pkey"=>"id",
		"all"=>array("id","name"),
		"search"=>array(
		   "id","name"
		),
		"whr"=>array(
		   "country"=>$_GET['id'],
		   "status"=>"1",
		),
		"order"=>array(
		   "name","ASC",
		),
	);
		

	$activegrade=$this->Adminforms->listpagesub($qdata);
	
	$qdata["whr"]["status"]=2;
		
	$inactivegrade=$this->Adminforms->listpagesub($qdata);
		
			$data = array(
               'title' => $title,
               'permission' => $permission,
               'loadpage' => $page['loadpage'],
               'subpage' => $page['subpage'],
               'activegrade' => $activegrade,
               'inactivegrade' => $inactivegrade,
               'qdata' => $qdata,
          );

		$this->Admintheme->loadview($page['loadpage']."/".$page['subpage'],$data);

	
	
	
    }	
	
	
	
}

?>