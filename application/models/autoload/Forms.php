<?php



class Forms extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	
function textxxx(){
	echo "dasasd";
}

function curlthis($url,$agent,$httphead,$post,$cookie,$ref=false,$follow=false,$header=false,$ssl=false,$proxy=false,$proxyauth=false,$source=false){
 
	$ch = curl_init();
	if($cookie){
	define('COOKIEFILE', dirname(__FILE__) .DIRECTORY_SEPARATOR."cookie".DIRECTORY_SEPARATOR.$cookie);
	curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIEFILE);
	curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIEFILE);
	curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);
		}
    curl_setopt($ch, CURLOPT_URL, $url);
	if($ssl){
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    }
	if($proxy){
    curl_setopt($ch,CURLOPT_PROXY,$proxy);
    }
	if($proxyauth){
	curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
    }
	if($header){
	curl_setopt($ch, CURLOPT_HEADER, true);
    }else{
	curl_setopt($ch, CURLOPT_HEADER, false);
	}
	
	if($follow){
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	}else{
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
	}
	
	if($ref){
    curl_setopt($ch, CURLOPT_REFERER, $ref);
	}
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
if($post){
$pieces = explode("&", $post);
curl_setopt($ch,CURLOPT_POST, count($pieces));
curl_setopt($ch,CURLOPT_POSTFIELDS, $post);
}
curl_setopt($ch, CURLOPT_USERAGENT, $agent); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $httphead);

    $result = curl_exec($ch);
    curl_close($ch);
		if($cookie){
$file_contents = file_get_contents(COOKIEFILE);
$file_contents = str_replace("FALSE\t0","FALSE\t9999999999999",$file_contents);
//$file_contents = str_replace("0\tPHPSESSID","9999999999999\tPHPSESSID",$file_contents);
//$file_contents = str_replace("0\treg_","9999999999999\treg_",$file_contents);
file_put_contents(COOKIEFILE,$file_contents);
}
if($source){
$result = str_replace("<", "&lt;", $result);
}
    return $result;
	
}

 function inputtext($title,$name,$placeholder,$value=false,$required=false){
	 ?>
			   <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>" <?php if($required==1){ echo "required";} ?>                  />
                  </div>
                </div>
 <?php
 }


 function inputpass($title,$name,$placeholder,$value=false,$required=false){
  ?>
        <div class="form-group">
                 <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                 <div class="col-sm-9">
                   <input type="password" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>" <?php if($required==1){ echo "required";} ?>                  />
                 </div>
               </div>
<?php
}

function newpassword(){
  ?>

       <div class="form-group">
                     <label class="col-sm-3 control-label">Password</label>
                     <div class="col-sm-9">
                       <div class="row">
                         <div class="col-sm-6">
                           <input type="password" class="form-control" name="foo_one" data-fv-notempty="true"
                           data-fv-notempty-message="Password is required and cannot be empty"
                           data-fv-identical="true" data-fv-identical-field="foo_two"
                           data-fv-identical-message="Password and its confirm are not the same"
                           />
                         </div>
                         <div class="col-sm-6">
                           <input type="password" class="form-control" name="foo_two" data-fv-notempty="true"
                           data-fv-notempty-message="Password is required and cannot be empty"
                           data-fv-identical="true" data-fv-identical-field="foo_one"
                           data-fv-identical-message="Password and its confirm are not the same"
                           />
                         </div>
                       </div>
         </div>
               </div>

<?php
}

function submit($add){
	 ?>


                <div class="text-right">
                  <button type="submit" class="btn btn-primary" id="validateButton2"><?php echo $add; ?></button>
                </div>
 <?php
 }







 function addfile($title,$name,$accept=false,$multiple=false,$required=false){
	 ?>


				 <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
                  <input type="file" id="<?php echo $name; ?>" name="<?php echo $name; ?>"   <?php if($accept){ echo 'accept="'.$accept.'"'; } ?> <?php if($multiple){ echo "multiple"; } ?> />
                  </div>
                </div>

 <?php
 }


 
}

?>
