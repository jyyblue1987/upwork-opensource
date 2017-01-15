
<?php
class Addcheck extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


	  function check($permission)
    {

	if($this->Adminlogincheck->checkper($permission['add'])){

		return true;

		}else{

				redirect(site_url());
				exit();
		}



    }
	  function load($permission,$mod)
    {



	$page=$this->uri->uri_to_assoc();

	$db="packages";
	$inputarr=array("name", "unlimiteduser", "user", "pricequter", "priceyear", "priceyearupgrade", "index");

	foreach($inputarr as $val){

		$temp=$db."_".$val;
		if(isset($_POST[$temp])){
		$$temp=$_POST[$temp];
		}else{
			
		redirect(site_url());
		}

	}


	foreach($inputarr as $val){
		$temp=$db."_".$val;
		$data[$temp] = $$temp;
	}

		$data[$db."_"."status"] = 1;


$this->db->insert($db, $data);
$id=$this->db->insert_id();



foreach ($_POST as $key => $val) {
if(preg_match("/lm/",$key)) {
$u = explode("lm",$key);
$nam = $u[0];
$val = $u[1];

if($nam=="level"){
$datal=array();
		$datal[$db."level_"."package"] = $id;
    $datal[$db."level_"."level"] = $val;


$this->db->insert($db."level", $datal);
$levelid=$this->db->insert_id();

}elseif($nam=="model"){
$datal=array();

		$datal[$db."model_"."package"] = $id;
    $datal[$db."model_"."model"] = $val;


$this->db->insert($db."model", $datal);
$modelid=$this->db->insert_id();

}
}
}


				redirect(site_url('administrator/userpage/loadpage/'.$page['loadpage'].'/subpage/lists'));

    }
}

?>
