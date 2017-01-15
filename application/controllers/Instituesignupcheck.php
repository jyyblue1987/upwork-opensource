<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instituesignupcheck extends CI_Controller {

    function upload_on_amazon_st($imagepath, $imagename) {
        $path = $imagepath; 
        $bucket = 'files.winjob.com';
        $this->load->library('S3');
        $awsAccessKey = 'AKIAIR7ZR5NasdasQ44KPJPNA';
        $awsSecretKey = 'ddfM/s2SCHEmkKKadsasddf7MYLvNfg9kpAl5asdassasdjeeOH2oby';
        $s3 = new S3($awsAccessKey, $awsSecretKey);
        $actual_image_name = $imagename;
        if ($s3->putObjectFile($path, $bucket, $actual_image_name, S3::ACL_PUBLIC_READ)) {
            $image = 'http://' . $bucket . '.s3.amazonaws.com/' . $actual_image_name;
            return $image;
        } else {
            return 'failed';
        }
    }

    public function resize($path = '', $file_name = '',$amazonname, $folders) {
        foreach ($folders as $key => $val) {
            $this->load->library('image_lib');
            $configSize['image_library'] = 'gd2';
            $configSize['source_image'] = $path . '/' . $file_name;
            $configSize['new_image'] = $path . '/' . $key . '/';
            $configSize['maintain_ratio'] = FALSE;
            $configSize['width'] = $val[0];
            $configSize['height'] = $val[1];
            $this->image_lib->initialize($configSize);
            $this->image_lib->resize();
            $this->image_lib->clear();
            $image_path = $configSize['new_image'] . $file_name;
            $image_name = 'logo/' . $key . '/' . $amazonname;
            $temp = $this->upload_on_amazon_st($image_path, $image_name);
            unlink($image_path);
        }
        $file_path = $path . '/' . $file_name;
        unlink($file_path);
    }
	
	function generatexRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}

    function set_upload_options($path = '') {
        $config = array();
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048'; //2mb
        $config['min_width'] = '600';
        $config['overwrite'] = FALSE;
        return $config;
    }

	
	
    public function index() {
	
	$logokey=self::generatexRandomString(50).'.jpg';
	$target_dir = FCPATH."uploads/logo/";
	$target_file = $target_dir . basename($_FILES["photo"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
	
	
	$widtha=500;
	$widthb=200;
	$widthc=60;
	
	if($check[0]<$widtha){
	$widtha=$check[0];
	}
	if($check[0]<$widthb){
	$widthb=$check[0];
	}
	if($check[0]<$widthc){
	$widthc=$check[0];
	}
		
	$heighta=($check[1]/$check[0])*$widtha;
	$heightb=($check[1]/$check[0])*$widthb;
	$heightc=($check[1]/$check[0])*$widthc;
	
	
    if($check !== false) {
		if ($_FILES["photo"]["size"] > 2097152) {
            echo json_encode(array('status' => "error", 'message' => "invalid_image"));
			exit();
	}else{
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
				echo json_encode(array('status' => "error", 'message' => "invalid_image"));
				exit();
	}else{

		  if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
			  
			  $image_name="logo/".$logokey;
			   $this->resize($target_dir, basename($_FILES["photo"]["name"]),$logokey, $folders = array('big' => array($widtha,$heighta), 'small' => array($widthb, $heightb), 'thumb' => array($widthc, $heightc)));
			 
		
		$startdate=array();
		$model=array();
		$offer=array();
		foreach ($_POST as $key => $val) {
if(preg_match("/admissionlm/",$key)) {
$u = explode("admissionlm",$key);

$month = $u[1];
if($val=="true"){
	array_push($startdate,$month);

		
}

}
if(preg_match("/modelslm/",$key)) {
$u = explode("modelslm",$key);

$modal = $u[1];
if($val=="true"){
	array_push($model,$modal);
}

}
if(preg_match("/offerslm/",$key)) {
$u = explode("offerslm",$key);

$offers = $u[1];
if($val=="true"){
	array_push($offer,$offers);
}

}
}

			  
        if (isset($_POST['institue_name'])){
		$institutename=$_POST['institue_name'];
		}else{
            echo json_encode(array('status' => "error", 'message' => "invalid_institue_name"));
			exit();
        }
		
        if (isset($_POST['institue_postal'])){
		$instituepostal=$_POST['institue_postal'];
		}else{
            echo json_encode(array('status' => "error", 'message' => "invalid_institue_postal"));
			exit();
        }
        if (isset($_POST['institue_officialemail'])){
		$instituteofficialemail=$_POST['institue_officialemail'];
		}else{
            echo json_encode(array('status' => "error", 'message' => "invalid_institue_officialemail"));
			exit();
        }
	
        if (isset($_POST['country'])){
			
			
			$country=$_POST['country'];
			$ocountrytype=$_POST['ocountrytype'];
			
			if($country=="other"){
			$ostates=$_POST['ostates'];
			$ocity=$_POST['ocity'];
			$state="other";
			$onlycity="other";
			$ocountry=$_POST['ocountry'];
			}else{
			$ocountry="";
			$ostates="";
			$ocity="";
			
		if($ocountrytype=="statescity"){
			$statescity=$_POST['statescity'];
			$state=$statescity;
			if($state=="other"){
			$onlycity="other";
			$ostates=$_POST['ostates'];
			$ocity=$_POST['ocity'];
			}else{
			$onlycity=$_POST['onlycity'];
			if($onlycity=="other"){
			$ocity=$_POST['ocity'];
			}
			}
			
		}elseif($ocountrytype=="onlystates"){
			$onlystates=$_POST['onlystates'];
			$onlycity="";
			$state=$onlystates;
			if($state=="other"){
			$ostates=$_POST['ostates'];
			}
		}else{
			$state="";
			$onlycity=$_POST['onlycity'];
			if($onlycity=="other"){
			$ocity=$_POST['ocity'];
				
			}
		}
				
			}
		
$data = array(
   'institutes_name' => $institutename ,
   'institutes_address' => $instituepostal ,
   'institutes_email' => $instituteofficialemail ,
   'institutes_city' => $onlycity ,
   'institutes_ocity' => $ocity ,
   'institutes_states' => $state,
   'institutes_ostates' => $ostates,
   'institutes_country' => $country,
   'institutes_ocountry' => $ocountry,
   'institutes_ocountrytype' => $ocountrytype,
   'institutes_logo' => $logokey,
   'institutes_package' => 1,
   'institutes_status' => 2
);


$this->db->insert("institutes", $data);
$instituteid=$this->db->insert_id();


	
foreach ($startdate as &$value) {
	
 $data = array(
   'startdate_institute' => $instituteid ,
   'startdate_month' => $value ,
);

$this->db->insert("startdate", $data);
	
}	
		
foreach ($model as &$value) {
	
 $data = array(
   'modaldb_institute' => $instituteid ,
   'modaldb_degree' => $value ,
);

$this->db->insert("modaldb", $data);
	
}	
		
		
foreach ($offer as &$value) {
	
 $data = array(
   'offerdb_institute' => $instituteid ,
   'offerdb_degree' => $value ,
);

$this->db->insert("offerdb", $data);
	
}	
		
	
		
	
if($_POST['otheroffer']){
	$otheroffer= $_POST['otherofferdata'];
	
	 $data = array(
   'otherofferdb_institute' => $instituteid ,
   'otherofferdb_name' => $otheroffer ,
);

$this->db->insert("otherofferdb", $data);
	
}	
if($_POST['othermodel']){
	$othermodel= $_POST['othermodeldata'];
	
	 $data = array(
   'othermodaldb_institute' => $instituteid ,
   'othermodaldb_name' => $othermodel ,
);

$this->db->insert("othermodaldb", $data);



}


	$title=$_POST['title'];
	if($title=="other"){
	$otitle=$_POST['otitle'];
	$fullname=$otitle;
	}else{
	$otitle="";
	$fullname=$title;
	}
	
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$jobtitle=$_POST['institue_jobtitle'];
	$countrycode=$_POST['institue_dialingcode'];
	$phone=$_POST['institue_telephone'];
	$address=$_POST['institue_address'];
	$originalpassword=$_POST['password'];
	$password=md5($originalpassword);
	$loginkey=self::generatexRandomString(20);
	$fullname.=" ".$fname." ".$lname;
	$type=1;
	$status=2;
	
	
 $data = array(
   'members_title' => $title ,
   'members_otitle' => $otitle ,
   'members_firstname' => $fname ,
   'members_lastname' => $lname ,
   'members_fullname' => $fullname ,
   'members_email' => $othermodel ,
   'members_password' => $othermodel ,
   'members_originalpass' => $othermodel ,
   'members_type' => $othermodel ,
   'members_parent' => $othermodel ,
   'members_jobtitle' => $othermodel ,
   'members_countrycode' => $othermodel ,
   'members_phone' => $othermodel ,
   'members_address' => $othermodel ,
   'members_status' => $status
);

$this->db->insert("members", $data);



	
		
					
		
		
		

		}else{
            echo json_encode(array('status' => "error", 'message' => "invalid_country"));
			exit();
        }
		
	
	
	
	
	
	
	
	
	
	
				
				
				
		}else{
				echo json_encode(array('status' => "error", 'message' => "invalid_image"));
				exit();
		}
	}
	}
    }else{
            echo json_encode(array('status' => "error", 'message' => "invalid_image"));
			exit();
    }
	
	

			
    }

	
	
	
}
