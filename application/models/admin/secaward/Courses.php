<?php 
class Courses extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function check($permission)
    {
	if($this->Adminlogincheck->checkper($permission['courses'])){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }	
	  function load($permission,$mod)
    {

	
	
	
	
	$page=$this->uri->uri_to_assoc();
	

	
		$title=$this->Adminforms->getdata("name","usersubpage",$permission['courses']);
		
		
		
	$qdata=array(
		"db"=>"scourses",
		"pkey"=>"id",
		"all"=>array("id","name"),
		"search"=>array(
		   "id","name"
		),
		"whr"=>array(
		   "secaward"=>$_GET['id'],
		   "status"=>"1",
		),
		"order"=>array(
		   "name","ASC",
		),
	);
		

	$activecourses=$this->Adminforms->listpagesub($qdata);
	
	$qdata["whr"]["status"]=2;
		
	$inactivecourses=$this->Adminforms->listpagesub($qdata);
		
			$data = array(
               'title' => $title,
               'permission' => $permission,
               'loadpage' => $page['loadpage'],
               'subpage' => $page['subpage'],
               'activecourses' => $activecourses,
               'inactivecourses' => $inactivecourses,
               'qdata' => $qdata,
          );

		$this->Admintheme->loadview($page['loadpage']."/".$page['subpage'],$data);

	
	
	
    }	
	
	
	
}

?>