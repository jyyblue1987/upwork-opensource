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
      		"db"=>"model",
      		"pkey"=>"id",
      		"all"=>array("id","name"),
      		"whr"=>array(
      		   "status"=>"1",
      		),
      		"order"=>array(
      		   "index","ASC",
      		),
      	);


      		$model= $this->Adminforms->getdblist($qdata);


			
			

	$qdata=array(
		"db"=>"packages",
		"all"=>array("id","name", "unlimitedinvite", "inviteq", "invitey", "invitepriceq", "invitepricey", "extrainviteprice", "refundinviteq", "refundinvitey", "unlimitedfeature", "featureq", "featurey", "featurepriceq", "featurepricey", "extrafeatureprice", "refundfeatureq", "refundfeaturey", "serviceq", "servicey", "refundperdayq", "refundperdayy", "agentdb", "newsletter", "newsletterq", "newslettery", "newslettercost", "unlimitedcustominvite", "custominviteq", "custominvitey", "custominvitecost", "livechat", "unlimiteduser", "user", "unlimitedcountry", "country", "manager", "dayemail", "expeditedemail", "phone", "bulk", "pricequter", "priceyear", "priceyearupgrade", "index"),
		"whr"=>array(
		   "status"=>"1",
   		  "id"=>$_GET['id'],
		),
	);


		$result=$this->Adminforms->editpage($qdata);








			$data = array(
               'title' => $title,
         'degree' => $degree,
         'model' => $model,
         'db' => $qdata['db'],
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
