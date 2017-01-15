<?php
class Editcheck extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	  function check()
    {
		if($this->session->userdata('type')=="1"){
		return true;
		}else{
				redirect(site_url());
				exit();
		}
    }
	  function load()
    {


		$id=$_GET['id'];
		$name=$_POST['name'];
		$username=$_POST['username'];
		$country=$_POST['country'];

		$email=$_POST['email'];
		$password=md5($_POST['foo_one']);
		$type='2';
		$status='1';

		if($name==""){
				redirect(site_url('administrator/users/loadpage/edit/error/22/?id='.$id));
				exit();
		}
		if($username==""){
				redirect(site_url('administrator/users/loadpage/edit/error/33/?id='.$id));
				exit();
		}
		if($email==""){
				redirect(site_url('administrator/users/loadpage/edit/error/44/?id='.$id));
				exit();
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				redirect(site_url('administrator/users/loadpage/edit/error/44/?id='.$id));
				exit();
		}



 $this->db->select('id');
 $this->db->from('user');
 $this->db->where('email', $email);
 $this->db->where('id !=', $id);

 $query = $this -> db -> get();



   if($query -> num_rows() > 0)
   {


				redirect(site_url('administrator/users/loadpage/edit/error/55/?id='.$id));
				exit();



   }


 $this->db->select('id');
 $this->db->from('user');
 $this->db->where('username', $username);
 $this->db->where('id !=', $id);
   $query = $this -> db -> get();

   if($query -> num_rows() > 0)
   {


   redirect(site_url('administrator/users/loadpage/edit/error/66/?id='.$id));
				exit();


   }







$data = array(
   'name' => $name ,
   'username' => $username ,
   'country' => $country,
   'email' => $email
);

$this->db->where('id', $id);
$this->db->update('user', $data);



if($_POST['foo_one']==""){

		}else{

$data = array(
   'password' => $password
);

$this->db->where('id', $id);
$this->db->update('user', $data);


		}







$target_dir = FCPATH."assets/profile/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if (empty($_FILES['fileToUpload']['tmp_name'])){
	$uploadOk = 0;
	}else{
	$uploadOk = 1;
	}

	if ($_FILES["fileToUpload"]["size"] > 5000000) {
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$uploadOk = 0;
	}

	if($uploadOk==1){
	$target_url = FCPATH."assets/profile/".$id.".jpg";

	 if((strtolower( $imageFileType)=="jpeg") || (strtolower( $imageFileType)=="jpg")){
  $image = imagecreatefromjpeg($_FILES['fileToUpload']['tmp_name']);
     }elseif(strtolower( $imageFileType)=="png"){
  $image = imagecreatefrompng($_FILES['fileToUpload']['tmp_name']);

	 }elseif(strtolower( $imageFileType)=="gif"){
  $image = imagecreatefromgif($_FILES['fileToUpload']['tmp_name']);
    }


  $filename = $target_url;
  $width = imagesx($image);
  $height = imagesy($image);
  $thumb_width = 50;
  $thumb_height = 50;
  $original_aspect = $width / $height;
  $thumb_aspect = $thumb_width / $thumb_height;
  if ( $original_aspect >= $thumb_aspect ) {
     $new_height = $thumb_height;
     $new_width = $width / ($height / $thumb_height);
  }
  else {
       $new_width = $thumb_width;
     $new_height = $height / ($width / $thumb_width);
  }
  $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
  imagecopyresampled($thumb,
         $image,
         0 - ($new_width - $thumb_width) / 2,
         0 - ($new_height - $thumb_height) / 2,
         0, 0,
         $new_width, $new_height,
         $width, $height);
  imagejpeg($thumb, $filename, 80);


	}else{

	}




redirect(site_url('administrator/users/loadpage/lists'));

    }
}

?>
