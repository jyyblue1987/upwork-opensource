<?php
class Edit extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	   function check($permission)
    {
	if($this->Adminlogincheck->checkper($permission['edit'])){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }

	  function load($permission,$mod)
    {
	$page=$this->uri->uri_to_assoc();

		$title=$this->Adminforms->getdata("name","usersubpage",$permission['edit']);



	
		  $qdata=array(
      		"db"=>"degree",
      		"pkey"=>"id",
      		"all"=>array("id","name"),
      		"whr"=>array(
      		   "status"=>"1",
      		),
      		"order"=>array(
      		   "index","ASC",
      		),
      	);


      		$degree= $this->Adminforms->getdblist($qdata);



			
			
	$qdata=array(
		"db"=>"docfolders",
		"all"=>array("id","name","index"),
		"whr"=>array(
		   "status"=>"1",
   		  "id"=>$_GET['id'],
		),
	);
	
	
	


		$result=$this->Adminforms->editpage($qdata);




			$data = array(
               'title' => $title,
               'degree' => $degree,
               'permission' => $permission,
               'loadpage' => $page['loadpage'],
               'subpage' => $page['subpage'],
               'result' => (array) $result,
               'qdata' =>  $qdata,
          );

		$this->Admintheme->loadview($page['loadpage']."/".$page['subpage'],$data);



    }



}

?>
