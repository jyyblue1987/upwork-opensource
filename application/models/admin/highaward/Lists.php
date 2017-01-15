<?php
class Lists extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function check($permission)
    {

	if($this->Adminlogincheck->checkper($permission['lists'])){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }
	  function load($permission,$mod)
    {


	$page=$this->uri->uri_to_assoc();

		$title=$this->Adminforms->getdata("name","usersubpage",$permission['lists']);

	if(isset($_GET['q'])){
$q=$_GET['q'];
	}else{
$q=false;
	}

	$qdata=array(
		"db"=>"highaward",
		"pkey"=>"id",
		"all"=>array("id","name","index"),
		"q"=>$q,
		"search"=>array(
		   "id","name"
		),
		"whr"=>array(
		   "status"=>"1",
		),
		"order"=>array(
		   "index","ASC",
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
