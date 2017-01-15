<?php
class Manage extends CI_Model {

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
		"db"=>"department",
		"pkey"=>"id",
		"all"=>array("id","name"),
		"search"=>array(
		   "id","name"
		),
		"whr"=>array(
		   "degree"=>$_GET['id'],
		   "status"=>"1",
		),
		"order"=>array(
		   "name","ASC",
		),
		"subdb"=>"courses",
		"selectin"=>array("id","name"),
		"wherein"=>"department",
		"whereeq"=>"id",
	);


	$activestates=$this->Adminforms->listpagesubnew($qdata);

	$qdata["whr"]["status"]=2;

	$inactivestates=$this->Adminforms->listpagesubnew($qdata);

			$data = array(
               'title' => $title,
               'permission' => $permission,
               'loadpage' => $page['loadpage'],
               'subpage' => $page['subpage'],
               'activestates' => $activestates,
               'inactivestates' => $inactivestates,
               'qdata' => $qdata,
          );

		$this->Admintheme->loadview($page['loadpage']."/".$page['subpage'],$data);




    }



}

?>
