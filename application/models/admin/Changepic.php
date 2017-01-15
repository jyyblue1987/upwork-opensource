<?php

class Changepic extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }



    	  function check()
        {


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
    	$target_url = FCPATH."assets/profile/".$this->session->userdata('id').".jpg";

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
      		return "33";

    	}else{
    		return "44";
    	}



       }



}

?>
