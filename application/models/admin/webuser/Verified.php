<?php
class Verified extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function check($permission)
    {

	if($this->Adminlogincheck->checkper($permission['verified'])){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }
	  function load($permission,$mod)
    {


	$page=$this->uri->uri_to_assoc();

		$title=$this->Adminforms->getdata("name","usersubpage",$permission['verified']);

	if(isset($_GET['q'])){
$q=$_GET['q'];
	}else{
$q=false;
	}

	$qdata=array(
		"db"=>"webuser",
		"pkey"=>"id",
		"all"=>array("id","fname","lname","username","username","type","email"),
		"q"=>$q,
		"search"=>array(
		   "id","fname","lfname","username","email"
		),
		"whr"=>array(
		   "status"=>"2",
		),
		"order"=>array(
		   "id","ASC",
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
