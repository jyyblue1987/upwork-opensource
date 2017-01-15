<?php 
class Onlycity extends CI_Model {

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
		"db"=>"city",
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
		

	$activecity=$this->Adminforms->listpagesub($qdata);
	
	$qdata["whr"]["status"]=2;
		
	$inactivecity=$this->Adminforms->listpagesub($qdata);
		
			$data = array(
               'title' => $title,
               'permission' => $permission,
               'loadpage' => $page['loadpage'],
               'subpage' => $page['subpage'],
               'activecity' => $activecity,
               'inactivecity' => $inactivecity,
               'qdata' => $qdata,
          );

		$this->Admintheme->loadview($page['loadpage']."/".$page['subpage'],$data);

	
	
	
    }	
	
	
	
}

?>