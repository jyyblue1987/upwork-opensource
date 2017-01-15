<?php
class Token extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function check($permission)
    {

	if($this->Adminlogincheck->checkper($permission['token'])){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }
	  function load($permission,$mod)
    {


	$page=$this->uri->uri_to_assoc();

		$title=$this->Adminforms->getdata("name","usersubpage",$permission['token']);

	if(isset($_GET['q'])){
$q=$_GET['q'];
	}else{
$q=false;
	}

	$qdata=array(
		"db"=>"instagramtoken",
		"pkey"=>"id",
		"all"=>array("id","name","owner","username","picture","media","follows","followedby"),
		"q"=>$q,
		"search"=>array(
		   "id","name","username"
		),
		"whr"=>array(
		   "status"=>"1",
		),
		"order"=>array(
		   "owner","ASC",
		),
	);


		$result=$this->Adminforms->listpage($qdata);








			$data = array(
               'title' => $title,
               'permission' => $permission,
               'loadpage' => $page['loadpage'],
               'subpage' => $page['subpage'],
               'result' => $result,
               'qdata' => $qdata,
          );

		$this->Admintheme->loadview($page['loadpage']."/".$page['subpage'],$data);



    }



}

?>
