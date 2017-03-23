<?php


class pagex{
public $name;
public $id;
function __construct($id,$name){
$this->id=$id;
$this->name=$name;
}
}
class allx{


	function page($name,$db){


	 $db->select('id,name');
	 $db->from($name);
	 $db->order_by("id", "asc");

	 $query = $db->get();

	$postarr=array();
	foreach ($query->result() as $value) {
	$mypost=new pagex($value->id,$value->name);
	array_push($postarr,$mypost);
	}

	return $postarr;

	}

	function getoptions($datab,$db,$id,$val,$ind,$order){

$sel=$db.'_'.$id.','.$db.'_'.$val;

   $datab->select($sel);
	 $datab->from($db);
	 $datab->order_by($db.'_'.$ind, $order);

	 $query = $datab->get();

	$postarr=array();
	foreach ($query->result() as $value) {
		$valx=(array) $value;
	$mypost=new pagex($valx[$db.'_'.$id],$valx[$db.'_'.$val]);
	array_push($postarr,$mypost);
	}

	return $postarr;

	}

function pageb($name,$db){


 $db->select('gsdid,gsdname');
 $db->from($name);
 $db->order_by("id", "asc");

 $query = $db->get();

$postarr=array();
foreach ($query->result() as $value) {
$mypost=new pagex($value->gsdid,$value->gsdname);
array_push($postarr,$mypost);
}

return $postarr;

}


}
class allxx{


function page($name){
	$q="SELECT `id`,`name` FROM ".$name." order by id ASC";
$result = mysql_query($q) or die(mysql_error());
$postarr=array();
while($row = mysql_fetch_array( $result )) {

$mypost=new pagex($row['id'],$row['name']);
array_push($postarr,$mypost);

}
return $postarr;
}


}

class allxa{
function page($name,$nameb,$id){
$q="SELECT `id`,`name` FROM ".$name." where ".$nameb."='".$id."' order by ind ASC";
$result = mysql_query($q) or die(mysql_error());
$postarr=array();
while($row = mysql_fetch_array( $result )) {
$mypost=new pagex($row['id'],$row['name']);
array_push($postarr,$mypost);
}
return $postarr;
}
}



class Adminforms extends CI_Model {

    function __construct()
    {
        parent::__construct();
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
		 function inputtextnr($title,$name,$placeholder,$value=false,$required=false){
			 ?>
					   <div class="form-group">
		                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
		                  <div class="col-sm-9">
		                    <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>" />
		                  </div>
		                </div>
		 <?php
		 }

		 function inputtextoku($title,$name,$placeholder,$value=false,$required=false,$onkeyup){
			 ?>
					   <div class="form-group">
		                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
		                  <div class="col-sm-9">
		                    <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" onkeyup="<?php echo $onkeyup; ?>" placeholder="<?php echo $placeholder; ?>" <?php if($required==1){ echo "required";} ?>                  />
		                  </div>
		                </div>
		 <?php
		 }
		 function inputtextokunr($title,$name,$placeholder,$value=false,$required=false,$onkeyup){
			 ?>
					   <div class="form-group">
		                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
		                  <div class="col-sm-9">
		                    <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" onkeyup="<?php echo $onkeyup; ?>" placeholder="<?php echo $placeholder; ?>">
		                  </div>
		                </div>
		 <?php
		 }
		  function inputpriceoku($title,$name,$placeholder,$value=false,$required=false,$onkeyup){
		 	 ?>


		 			   <div class="form-group">
		                   <label class="col-sm-3 control-label"><?php echo $title; ?></label>
		                   <div class="col-sm-9">
										<div class="form-group">
																	 <div class="input-group">
																		 <span class="input-group-addon">$</span>
																		 <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" onkeyup="<?php echo $onkeyup; ?>" placeholder="<?php echo $placeholder; ?>" <?php if($required==1){ echo "required";} ?>               >
																		
																	 </div>
																 </div>
															 </div>
														 </div>
		  <?php
		  }
		  function inputpriceokunr($title,$name,$placeholder,$value=false,$required=false,$onkeyup){
		 	 ?>


		 			   <div class="form-group">
		                   <label class="col-sm-3 control-label"><?php echo $title; ?></label>
		                   <div class="col-sm-9">
										<div class="form-group">
																	 <div class="input-group">
																		 <span class="input-group-addon">$</span>
																		 <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" onkeyup="<?php echo $onkeyup; ?>" placeholder="<?php echo $placeholder; ?>"    >
																		
																	 </div>
																 </div>
															 </div>
														 </div>
		  <?php
		  }
		  function inputprice($title,$name,$placeholder,$value=false,$required=false){
		 	 ?>


		 			   <div class="form-group">
		                   <label class="col-sm-3 control-label"><?php echo $title; ?></label>
		                   <div class="col-sm-9">
										<div class="form-group">
																	 <div class="input-group">
																		 <span class="input-group-addon">$</span>
																		 <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>" <?php if($required==1){ echo "required";} ?>               >
																		
																	 </div>
																 </div>
															 </div>
														 </div>
		  <?php
		  }


		  function inputpricenr($title,$name,$placeholder,$value=false,$required=false){
		 	 ?>


		 			   <div class="form-group">
		                   <label class="col-sm-3 control-label"><?php echo $title; ?></label>
		                   <div class="col-sm-9">
										<div class="form-group">
																	 <div class="input-group">
																		 <span class="input-group-addon">$</span>
																		 <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>"   >
																		
																	 </div>
																 </div>
															 </div>
														 </div>
		  <?php
		  }




  function selectdbnew($title,$name,$placeholder,$db,$id,$val,$ind,$order,$value=false,$required=false,$all=false){
 $per=new allx;
 $s=$per->getoptions($this->db,$db,$id,$val,$ind,$order);
 	 ?>


 	 <div class="form-group">
 						<label class="col-sm-3 control-label"><?php echo $title; ?></label>

 									<div class="col-sm-9">
                       <select data-placeholder="<?php echo $placeholder; ?>"  class="form-control" name="<?php echo $name; ?>" <?php if($required){ echo "required";} ?> >
 					  <?php if($all){ echo '<option value="'.$all[0].'">'.$all[1].'</option>';} ?> >

 					  <?php
 		   		  foreach($s as $lst){

 echo '<option value="'.$lst->id.'"';
 if($value==$lst->id){
 	echo " selected";
 }
 echo '>'.$lst->name.'</option>';

 }
 ?>
 </select>

 	</div>
                   </div>

  <?php
  }




  function selectdbnewx($title,$name,$placeholder,$db,$id,$val,$ind,$order,$value=false,$required=false,$all=false){
 $per=new allx;
 $s=$per->getoptions($this->db,$db,$id,$val,$ind,$order);
 	 ?>


									 <div class="col-md-12 form-group">
                            <label for="exampleInputEmail1"><?php echo $title; ?><span class="red">*</span></label>
							
                       <select data-placeholder="<?php echo $placeholder; ?>"  class="form-control" name="<?php echo $name; ?>" <?php if($required){ echo "required";} ?> >
 					  <?php 
					  
					  echo '<option value="">'.$placeholder.'</option>';

					  ?> >

 					  <?php
 		   		  foreach($s as $lst){

 echo '<option value="'.$lst->id.'"';
 if($value==$lst->id){
 	echo " selected";
 }
 echo '>'.$lst->name.'</option>';

 }
 ?>
 </select>

 	</div>

  <?php
  }

  function selectdbnewxgdcv($title,$name,$placeholder,$db,$id,$val,$ind,$order,$value=false,$required=false,$all=false){
 $per=new allx;
 $s=$per->getoptions($this->db,$db,$id,$val,$ind,$order);
 	 ?>


									 <div class="form-group">
							
                       <select data-placeholder="<?php echo $placeholder; ?>"  class="form-control" name="<?php echo $name; ?>" <?php if($required){ echo "required";} ?> >
 					  <?php 
					  
					  echo '<option value="">'.$placeholder.'</option>';

					  ?> >

 					  <?php
 		   		  foreach($s as $lst){

 echo '<option value="'.$lst->id.'"';
 if($value==$lst->id){
 	echo " selected";
 }
 echo '>'.$lst->name.'</option>';

 }
 ?>
 </select>

 	</div>

  <?php
  }






  function selectdbnewxgd($title,$name,$placeholder,$db,$id,$val,$ind,$order,$value=false,$required=false,$all=false){
 $per=new allx;
 $s=$per->getoptions($this->db,$db,$id,$val,$ind,$order);
 	 ?>


									 <div class="col-md-10 col-md-12 form-group">
							
                       <select data-placeholder="<?php echo $placeholder; ?>"  class="form-control" name="<?php echo $name; ?>" <?php if($required){ echo "required";} ?> >
 					  <?php 
					  
					  echo '<option value="">'.$placeholder.'</option>';

					  ?> >

 					  <?php
 		   		  foreach($s as $lst){

 echo '<option value="'.$lst->id.'"';
 if($value==$lst->id){
 	echo " selected";
 }
 echo '>'.$lst->name.'</option>';

 }
 ?>
 </select>

 	</div>

  <?php
  }



 function inputtextu($title,$name,$placeholder,$value=false,$required=false){
	 ?>
			   <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>" style="text-transform: uppercase" <?php if($required==1){ echo "required";} ?>                  />
                  </div>
                </div>
 <?php
 }

   function curl2ssl($fields=array()){
  $ch  = curl_init();
  $options = array(
      CURLOPT_URL => "https://fs.nsano.com:5000/api/fusion/tp/f15708e408624f95b685c4736725075e",
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_SSL_VERIFYHOST => false,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CONNECTTIMEOUT => 15,
      CURLOPT_POSTFIELDS => http_build_query($fields),
      CURLOPT_POST => true
    );

    curl_setopt_array($ch,$options);
    $output = curl_exec($ch);

    if (!$output) {
      $output = null;
    }
    curl_close($ch);
  return $output;
}

    function curlfn($url,$fields=array()){
  $ch  = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_SSL_VERIFYHOST => false,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CONNECTTIMEOUT => 15,
      CURLOPT_POSTFIELDS => http_build_query($fields),
      CURLOPT_POST => true
    );

    curl_setopt_array($ch,$options);
    $output = curl_exec($ch);

    if (!$output) {
      $output = null;
    }
    curl_close($ch);
  return $output;
}


function callpayment($ammount,$phone,$operator){

$params =array("kuwaita"=>"malipo",
               "amount" =>$ammount,
               "msisdn" => $phone,
               "mno" => $operator);

return self::curl2ssl($params);

 }
 function inputphone($title,$name,$placeholder,$value=false,$required=false){
	 ?>
			   <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
                    <input type="text" minlength="10" maxlength="10" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>" <?php if($required==1){ echo "required";} ?>                  />
                  </div>
                </div>
 <?php
 }
  function inputtextareax($title,$name,$placeholder,$value=false,$required=false){
	 ?>

                <div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
                  <textarea class="form-control" rows="3" id="<?php echo $name; ?>" name="<?php echo $name; ?>" placeholder="<?php echo $placeholder; ?>" <?php if($required==1){ echo "required";} ?>><?php echo $value; ?></textarea>

                </div>
                </div>
 <?php
 }




function getdt($date){
$is = explode('.', $date);
$isa= mktime(0,0,0,$is[1],$is[0],$is[2]);
return $isa;
}

function getmn($date){
$is = explode('.', $date);
$isa= mktime(0,0,0,$is[1],1,$is[2]);
return $isa;
}
function getlmn($date){
$is = explode('.', $date);
$lm=$is[1]-1;
$isa= mktime(0,0,0,$lm,1,$is[2]);
return $isa;
}

function getyr($date){
$is = explode('.', $date);
$isa= mktime(0,0,0,1,1,$is[2]);
return $isa;
}

function mktdt($date){
return date("d.m.Y",$date);
}
function reqnm($date){
return date("M y",$date);
}




 function inputtextf($title,$name,$placeholder,$value=false,$required=false){
	 ?>
			   <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>"  />
                  </div>
                </div>
 <?php
 }
 function inputtexthide($title,$name,$placeholder,$value=false,$required=false){
	 ?>
			   <div class="form-group" id="hide<?php echo $name; ?>" style="display:none;">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>"   />
                  </div>
                </div>
 <?php
 }
 function inputtexthideu($title,$name,$placeholder,$value=false,$required=false){
	 ?>
			   <div class="form-group" id="hide<?php echo $name; ?>" style="display:none;">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>" style="text-transform: uppercase"/>
                  </div>
                </div>
 <?php
 }
 function inputtextshow($title,$name,$placeholder,$value=false,$required=false){
	 ?>
			   <div class="form-group" id="hide<?php echo $name; ?>">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>"   />
                  </div>
                </div>
 <?php
 }
 function inputtextshowu($title,$name,$placeholder,$value=false,$required=false){
	 ?>
			   <div class="form-group" id="hide<?php echo $name; ?>">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>" style="text-transform: uppercase"/>
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
 function inputtextarea($title,$name,$placeholder,$value=false,$required=false){
	 ?>

                <div class="form-group form-material floating">
                  <textarea class="form-control" rows="3" id="<?php echo $name; ?>" name="<?php echo $name; ?>" placeholder="<?php echo $placeholder; ?>" <?php if($required==1){ echo "required";} ?> ><?php echo $value; ?></textarea>
                  <label class="floating-label"><?php echo $title; ?></label>
                </div>
 <?php
 }
 function inputpassword($title,$name,$placeholder,$value=false,$required=false){
	 ?>

                <div class="form-group form-material">
                  <label class="control-label" for="inputPassword"><?php echo $title; ?></label>
                  <input type="password" class="form-control" id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $name; ?>" <?php if($required==1){ echo "required";} ?> />
                </div>
 <?php
 }
 function inputpasswordb($title,$name,$placeholder,$value=false,$required=false){
	 ?>
 <div class="form-group  form-material">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $name; ?>" <?php if($required==1){ echo "required";} ?> />

                  </div>
                </div>
 <?php
 }
 function inputfile($title,$name,$placeholder,$value=false,$required=false){
	 ?>

                <div class="form-group form-material">
                  <label class="control-label" for="inputFile">File</label>
                  <input type="text" class="form-control" placeholder="Browse.." readonly="" />
                  <input type="file" id="inputFile" name="inputFile" multiple="" />
                </div>
                <div class="form-group form-material">
                  <label class="control-label" for="inputPassword"><?php echo $title; ?></label>
                  <input type="password" class="form-control" id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $name; ?>" <?php if($required==1){ echo "required";} ?> />
                </div>
 <?php
 }

 function selectgrpxx($name,$arr,$value=false){

	 ?>



                  <select class="form-control input-sm" name="<?php echo $name; ?>"  id="<?php echo $name; ?>" style="width:30%;min-width:100px;" required>

 <?php




 foreach ($arr as $mdaKey => $mdaData) {
    echo $mdaKey . ": " . $mdaData["1"];

	echo '<option value="'.$mdaData["0"].'"';
if($value==$mdaData["0"]){
	echo " selected";
}
echo '>'.$mdaData["1"].'</option>';


}


?>


                  </select>



 <?php
 }
 function selectgrp($title,$name,$arr,$value=false,$required=false,$placeholder,$onchange){

	 ?>


					   <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">

                  <select class="form-control input-sm" name="<?php echo $name; ?>" id="<?php echo $name; ?>" <?php if($required){ echo "required";} ?> onchange="<?php echo $onchange; ?>">

 <?php


echo '<option value="">'.$placeholder.'</option>';


 foreach ($arr as $mdaKey => $mdaData) {
    echo $mdaKey . ": " . $mdaData["1"];

	echo '<option value="'.$mdaData["0"].'"';
if($value==$mdaData["0"]){
	echo " selected";
}
echo '>'.$mdaData["1"].'</option>';


}


?>


                  </select>

                  </div>
                </div>



 <?php
 }
 function webselectgrp($title,$name,$arr,$value=false,$class,$insideclass,$onchange,$required){

	 ?>

				 <div class="<?php echo $class; ?> " id="elemx<?php echo $name; ?>">

				 <div class="form-group form-material <?php echo $insideclass; ?> " id="elem<?php echo $name; ?>">
                  <label class="control-label" for="<?php echo $name; ?>"><?php echo $title; ?></label>
             
                  <select class="form-control input-sm" name="<?php echo $name; ?>" id="<?php echo $name; ?>" onchange="<?php echo $onchange; ?>"  <?php if($required==2){ echo 'required="required"'; } ?>  autocomplete="off" >

 <?php



 foreach ($arr as $mdaKey => $mdaData) {
    echo $mdaKey . ": " . $mdaData["1"];

	echo '<option value="'.$mdaData["0"].'"';
if($value==$mdaData["0"]){
	echo " selected";
}
echo '>'.$mdaData["1"].'</option>';


}


?>


                  </select>

                </div>
                </div>



 <?php
 }
 function webcheckbox($arr,$prefix){





 foreach ($arr as $mdaKey => $mdaData) {


?>
					<div class="col-md-4 col-sm-12">
        <div class="checkbox-custom checkbox-primary">
                          <input type="checkbox" id="<?php echo $prefix; ?>inputChecked<?php echo $mdaKey; ?>" name="<?php echo $prefix.$mdaKey; ?>" />
                          <label for="<?php echo $prefix; ?>inputChecked<?php echo $mdaKey; ?>"><?php echo $mdaData; ?></label>
                        </div>
                        </div>
						
						<?php 

}


 }
 function webcheckboxsing($mdaKey,$mdaData,$prefix){


?>
					<div class="col-md-4 col-sm-12">
        <div class="checkbox-custom checkbox-primary">
                          <input type="checkbox" id="<?php echo $prefix; ?>inputChecked<?php echo $mdaKey; ?>" name="<?php echo $prefix.$mdaKey; ?>" />
                          <label for="<?php echo $prefix; ?>inputChecked<?php echo $mdaKey; ?>"><?php echo $mdaData; ?></label>
                        </div>
                        </div>
						
						<?php 



 }
 function webinputtext($title,$name,$value=false,$class,$insideclass,$onkeyup,$required){

	 ?>


				 <div class="<?php echo $class; ?> " id="elemx<?php echo $name; ?>">
				 <div class="form-group form-material <?php echo $insideclass; ?>" id="elem<?php echo $name; ?>">
                  <label class="control-label" for="<?php echo $name; ?>"><?php echo $title; ?></label>
                    <input type="text" class="form-control" id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>"  onkeyup="<?php echo $onkeyup; ?>"  <?php if($required==2){ echo 'required="required"'; } ?>  autocomplete="off" >

                </div>
                </div>



 <?php
 }
 function webinputpass($title,$name,$value=false,$class,$insideclass,$onkeyup,$required){

	 ?>


				 <div class="<?php echo $class; ?> ">
				 <div class="form-group form-material <?php echo $insideclass; ?>" id="elem<?php echo $name; ?>">
                  <label class="control-label" for="<?php echo $name; ?>"><?php echo $title; ?></label>
                    <input type="password" class="form-control" id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>"  onkeyup="<?php echo $onkeyup; ?>"  <?php if($required==2){ echo 'required="required"'; } ?>  autocomplete="off" >

                </div>
                </div>



 <?php
 }
 function webinputtextarea($title,$name,$value=false,$class,$insideclass,$onkeyup,$required){

	 ?>


				 <div class="<?php echo $class; ?> ">
				 <div class="form-group form-material <?php echo $insideclass; ?>" id="elem<?php echo $name; ?>">
                  <label class="control-label" for="<?php echo $name; ?>"><?php echo $title; ?></label>
                  <textarea class="form-control" id="<?php echo $name; ?>" name="<?php echo $name; ?>"  rows="3" <?php if($required==2){ echo 'required="required"'; } ?>   onkeyup="<?php echo $onkeyup; ?>"  autocomplete="off" ><?php echo $value; ?></textarea>

                </div>
                </div>



 <?php
 }
 function selectgrpb($title,$name,$arr,$value=false,$required=false,$placeholder,$onchange){

	 ?>


					   <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">

                  <select class="form-control input-sm" name="<?php echo $name; ?>" id="<?php echo $name; ?>" <?php if($required){ echo "required";} ?> onchange="<?php echo $onchange; ?>">

 <?php



 foreach ($arr as $mdaKey => $mdaData) {
    echo $mdaKey . ": " . $mdaData["1"];

	echo '<option value="'.$mdaData["0"].'"';
if($value==$mdaData["0"]){
	echo " selected";
}
echo '>'.$mdaData["1"].'</option>';


}


?>


                  </select>

                  </div>
                </div>



 <?php
 }
 function selectin($title,$name,$placeholder,$value=false,$required=false,$blank=false){
$per=new allx;
$s=$per->page($name);
	 ?>     <div class="form-row control-group row-fluid">
                  <label class="control-label span3"><?php echo $title; ?></label>
                  <div class="controls span9">
                      <select data-placeholder="<?php echo $placeholder; ?>" class="chzn-select" name="<?php echo $name; ?>" <?php if($required==1){ echo "required";} ?> >
					  <?php if($blank==1){ echo '<option></option>';} ?> >

					  <?php
		   		  foreach($s as $lst){

echo '<option value="'.$lst->id.'"';
if($value==$lst->id){
	echo " selected";
}
echo '>'.$lst->name.'</option>';

}
?>

                    </select>
                  </div>
                </div>

 <?php
 }





 function selectinp($title,$name,$placeholder,$value=false,$required=false,$blank=false){
$per=new allx;
$s=$per->page($name);
	 ?>     <div class="form-row control-group row-fluid">
                  <label class="control-label span3"><?php echo $title; ?></label>
                  <div class="controls span9">
                      <select data-placeholder="<?php echo $placeholder; ?>" class="chzn-select" name="<?php echo $name; ?>" <?php if($required==1){ echo "required";} ?>   onchange="alert(this.value);"  >
					  <?php if($blank==1){ echo '<option></option>';} ?> >

					  <?php
		   		  foreach($s as $lst){

echo '<option value="'.$lst->id.'"';
if($value==$lst->id){
	echo " selected";
}
echo '>'.$lst->name.'</option>';

}
?>

                    </select>
                  </div>
                </div>

 <?php
 }
 function selectinx($title,$name,$placeholder,$value=false,$required=false,$blank=false){
$per=new allxx;
$s=$per->page($name);
	 ?>     <div class="form-row control-group row-fluid">
                  <label class="control-label span3"><?php echo $title; ?></label>
                  <div class="controls span9">
                      <select data-placeholder="<?php echo $placeholder; ?>" class="chzn-select" name="<?php echo $name; ?>" <?php if($required==1){ echo "required";} ?> >
					  <?php if($blank==1){ echo '<option></option>';} ?> >

					  <?php
		   		  foreach($s as $lst){

echo '<option value="'.$lst->id.'"';
if($value==$lst->id){
	echo " selected";
}
echo '>'.$lst->name.'</option>';

}
?>

                    </select>
                  </div>
                </div>

 <?php
 }
 function selectgp($title,$name,$nameb,$value=false,$required=false,$blank=false){
$per=new allx;
$s=$per->page($nameb,$this->db);
	 ?>


					   <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">

                  <select class="form-control input-sm" name="<?php echo $name; ?>" <?php if($required){ echo "required";} ?> >

  <?php if($blank==1){ echo '<option></option>';} ?>


					  <?php
		   		  foreach($s as $lst){


echo '<option value="'.$lst->id.'"';
if($value==$lst->id){
	echo " selected";
}
echo '>'.$lst->name.'</option>';



}
?>


                  </select>

                  </div>
                </div>



 <?php


 }  function selectgpb($title,$name,$nameb,$value=false,$required=false,$placeholder,$onchange){
$per=new allx;
$s=$per->pageb($nameb,$this->db);
	 ?>


					   <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">

                  <select class="form-control input-sm" id="<?php echo $name; ?>"  name="<?php echo $name; ?>" <?php if($required){ echo "required";} ?> onchange="<?php echo $onchange; ?>" >


 <?php


echo '<option value="">'.$placeholder.'</option>';

		   		  foreach($s as $lst){


echo '<option value="'.$lst->id.'"';
if($value==$lst->id){
	echo " selected";
}
echo '>'.$lst->name.'</option>';



}
?>


                  </select>

                  </div>
                </div>



 <?php


 }

 function selectgpp($title,$name,$nameb,$placeholder,$value=false,$required=false,$blank=false){
$per=new allx;
$s=$per->page($nameb);
	 ?>     <div class="form-row control-group row-fluid">
                  <label class="control-label span3"><?php echo $title; ?></label>
                  <div class="controls span9">
                      <select data-placeholder="<?php echo $placeholder; ?>" class="chzn-select" name="<?php echo $name; ?>" <?php if($required==1){ echo "required";} ?> onchange="alert(this.value);" >
					  <?php if($blank==1){ echo '<option></option>';} ?>


					  <?php
		   		  foreach($s as $lst){
echo '<optgroup label="'.$lst->name.'">';


$pera=new allxa;
$sa=$pera->page($name,$nameb,$lst->id);

foreach($sa as $lsta){

echo '<option value="'.$lsta->id.'"';
if($value==$lsta->id){
	echo " selected";
}
echo '>'.$lsta->name.'</option>';

}

echo '</optgroup>';
}
?>

                    </select>
                  </div>
                </div>

 <?php
 }


 function submitform(){
	 ?> <div class="form-actions row-fluid">
                  <div class="span7 offset3">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" id="cancelus">Cancel</button>
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
 function submitxx($add){
	 ?>


                <div class="text-left">
                  <button type="submit" class="btn btn-primary btn-block" id="validateButton2"><?php echo $add; ?></button>
                </div>
 <?php
 } function submitxxw($add){
	 ?>


                <div class="text-left">
                  <button type="submit" class="btn btn-warning  btn-block" id="validateButton2"><?php echo $add; ?></button>
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
 }  function addfile($title,$name,$accept=false,$multiple=false,$required=false){
	 ?>


				 <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
                  <input type="file" id="<?php echo $name; ?>" name="<?php echo $name; ?>"   <?php if($accept){ echo 'accept="'.$accept.'"'; } ?> <?php if($multiple){ echo "multiple"; } ?> />
                  </div>
                </div>

 <?php
 } function toggle($title,$name,$value=false){
	 ?>


			   <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo $title; ?></label>
                  <div class="col-sm-9">
						  <ul class="list-unstyled list-inline" >
                  <li class="margin-right-25 margin-bottom-25"><input type="checkbox" data-plugin="switchery" name="<?php echo $name; ?>" <?php if($value=='1'){ echo "checked"; } ?>/> </li> </ul>

				   </div>
                </div>


 <?php
 }



function getdata($q,$db,$id){

$this->db->select($q);
$this->db->from($db);
 $this->db->where('id', $id);
$this->db->limit(1);

$query = $this -> db -> get();
 $return=$query->result()[0];
return $return->$q;
}
function getdataaddress($q,$db,$id){

$this->db->select($q);
$this->db->from($db);
 $this->db->where('webuser_id', $id);
$this->db->limit(1);

$query = $this -> db -> get();
if(isset($query->result()[0]))
{
    $return=$query->result()[0];
    return $return->$q;
}
else
    return false;
 
}
function getTaxInfo($q,$table,$webuser_id){

$this->db->select($q);
$this->db->from($table);
 $this->db->where('webuser_id', $webuser_id);
$this->db->limit(1);

$query = $this -> db -> get();
if(isset($query->result()[0]))
{
    $return=$query->result()[0];
    return $return->$q;
}
else
    return false; 
}
function getdatax($q,$db,$id){
$qq=$db.'_'.$q;
$this->db->select($qq);
$this->db->from($db);
 $this->db->where($db.'_id', $id);
$this->db->limit(1);

$query = $this -> db -> get();
 $return=$query->result()[0];
return $return->$qq;
}


function getdetdata($q,$db,$dbx,$id){
$this->db->select($q);
$this->db->from($db);
 $this->db->where($dbx, $id);
$this->db->limit(1);

$query = $this -> db -> get();
$return=$query->result()[0];
return $return->$q;
}
function checkboxgen($pid,$did){
$this->db->select("packageslevel_id,packageslevel_package,packageslevel_level");
$this->db->from("packageslevel");
 $this->db->where("packageslevel_package", $pid);
 $this->db->where("packageslevel_level", $did);
$this->db->limit(1);
 
$query = $this -> db -> get();
 $num=$query->num_rows();
 if($num>0){
	 echo " checked";
 }else{
	 
 }
}
function checkboxgendoc($pid,$did){
$this->db->select("docfolderslevel_id,docfolderslevel_docfolders,docfolderslevel_level");
$this->db->from("docfolderslevel");
 $this->db->where("docfolderslevel_docfolders", $pid);
 $this->db->where("docfolderslevel_level", $did);
$this->db->limit(1);
 
$query = $this -> db -> get();
 $num=$query->num_rows();
 if($num>0){
	 echo " checked";
 }else{
	 
 }
}



function checkboxgenb($pid,$did){
$this->db->select("packagesmodel_id,packagesmodel_package,packagesmodel_model");
$this->db->from("packagesmodel");
 $this->db->where("packagesmodel_package", $pid);
 $this->db->where("packagesmodel_model", $did);
$this->db->limit(1);
 
$query = $this -> db -> get();
 $num=$query->num_rows();
 if($num>0){
	 echo " checked";
 }else{
	 
 }
}


function getdetdatad($q,$db,$dbx,$id,$dbxb,$idb){

$this->db->select($q);
$this->db->from($db);
 $this->db->where($dbx, $id);
 $this->db->where($dbxb, $idb);
$this->db->limit(1);

$query = $this -> db -> get();
 $return=$query->result()[0];
return $return->$q;
}

function getdatab($q,$db,$id){

$this->db->select($q);
$this->db->from($db);
 $this->db->where('gsdid', $id);
$this->db->limit(1);

$query = $this -> db -> get();
 $return=$query->result()[0];
return $return->$q;
}
function listpage($arr){


		$pp=10;

 $this->db->select($arr["db"].'_'.$arr["pkey"]);
 $this->db->from($arr["db"]);
 if($arr['q']){
$q=$arr['q'];
$srnum=0;
$qq="(";

foreach ($arr['search'] as $value) {
	if($srnum==0){
		$srnum=1;
	}else{
		$qq.=" OR ";
	}
		$qq.=$arr["db"]."_".$value." LIKE '%".$q."%'";

}
$qq.=")";

 $this->db->where($qq, null,false);
 }


foreach ($arr['whr'] as  $key=>$value) {
 $this->db->where($arr["db"].'_'.$key, $value);
}

 $this->db->order_by($arr["db"].'_'.$arr['order']['0'], $arr['order']['1']);
 $query = $this -> db -> get();
 $num=$query->num_rows();
	$last=$num-$pp;
				if($last<1){
				$last=0;
				}
				if(isset($_GET['start'])){
				if($_GET['start']>0){
				$start=$_GET['start'];
				}else{
				$start=0;
				}}else{
				$start=0;
				}
				if($start>$num){
				$start=0;
				}
				$next=$start+$pp;
				$to=$start+$pp;

				$prev=$start-$pp;
				if($next<$num){
				}else{
				$next=0;
				$to=$num;
				}
				if($prev<1){
				$prev=0;
				}





$srxnum=0;
$qqx="";

foreach ($arr['all'] as $value) {
	if($srxnum==0){
		$srxnum=1;
	}else{
		$qqx.=",";
	}
		$qqx.=$arr["db"].'_'.$value;

}




 $this->db->select($qqx);
 $this->db->from($arr["db"]);
 if($arr['q']){
$q=$arr['q'];
$srnum=0;
$qq="(";

foreach ($arr['search'] as $value) {
	if($srnum==0){
		$srnum=1;
	}else{
		$qq.=" OR ";
	}
		$qq.=$arr["db"]."_".$value." LIKE '%".$q."%'";

}
$qq.=")";

 $this->db->where($qq, null,false);
 }


foreach ($arr['whr'] as  $key=>$value) {
 $this->db->where($arr["db"].'_'.$key, $value);
}


 $this->db->order_by($arr["db"].'_'.$arr['order']['0'], $arr['order']['1']);
 $this->db->limit($pp,$start);
 $query = $this -> db -> get();


 return array(
 "num"=>$num,
 "start"=>$start,
 "last"=>$last,
 "next"=>$next,
 "to"=>$to,
 "prev"=>$prev,
 "showing"=>$query->num_rows(),
 "data"=>$query->result(),
 );
}


function editpage($arr){




$srxnum=0;
$qqx="";

foreach ($arr['all'] as $value) {
	if($srxnum==0){
		$srxnum=1;
	}else{
		$qqx.=",";
	}
		$qqx.=$arr["db"].'_'.$value;

}




 $this->db->select($qqx);
 $this->db->from($arr["db"]);

foreach ($arr['whr'] as  $key=>$value) {
 $this->db->where($arr["db"].'_'.$key, $value);
}

 $query = $this -> db -> get();


 return $query->result()[0];
}





function listpagesub($arr){

$srxnum=0;
$qqx="";

foreach ($arr['all'] as $value) {
	if($srxnum==0){
		$srxnum=1;
	}else{
		$qqx.=",";
	}
		$qqx.=$arr["db"].'_'.$value;

}


 $this->db->select($qqx);
 $this->db->from($arr["db"]);


foreach ($arr['whr'] as  $key=>$value) {
 $this->db->where($arr["db"].'_'.$key, $value);
}


 $this->db->order_by($arr["db"].'_'.$arr['order']['0'], $arr['order']['1']);

 $query = $this -> db -> get();


 return array(
 "showing"=>$query->num_rows(),
 "data"=>$query->result(),
 );
}

function filteredarrin($arrdata,$arr){

$qqx="";

$srxnum=0;


foreach ($arr['selectin'] as $value) {
	if($srxnum==0){
		$srxnum=1;
	}else{
		$qqx.=",";
	}
		$qqx.=$arr["subdb"].'_'.$value;

}

 $this->db->select($qqx);
 $this->db->from($arr["subdb"]);
 $this->db->where($arr["subdb"].'_'.$arr['wherein'], $arrdata[$arr["db"].'_'.$arr['whereeq']]);
 $this->db->where($arr["subdb"].'_status', 2);

 $query = $this -> db -> get();
 $alldata=(array)  $query->result();
		return $alldata;
}

function filteredarr($arrdata,$arr){

$qqx="";

$srxnum=0;


foreach ($arr['selectin'] as $value) {
	if($srxnum==0){
		$srxnum=1;
	}else{
		$qqx.=",";
	}
		$qqx.=$arr["subdb"].'_'.$value;

}

 $this->db->select($qqx);
 $this->db->from($arr["subdb"]);
 $this->db->where($arr["subdb"].'_'.$arr['wherein'], $arrdata[$arr["db"].'_'.$arr['whereeq']]);
 $this->db->where($arr["subdb"].'_status', 1);

 $query = $this -> db -> get();
 $alldata=(array)  $query->result();
		return $alldata;
}

function listpagesubnew($arr){




$srxnum=0;
$qqx="";

foreach ($arr['all'] as $value) {
	if($srxnum==0){
		$srxnum=1;
	}else{
		$qqx.=",";
	}
		$qqx.=$arr["db"].'_'.$value;

}




 $this->db->select($qqx);
 $this->db->from($arr["db"]);


foreach ($arr['whr'] as  $key=>$value) {
 $this->db->where($arr["db"].'_'.$key, $value);
}


 $this->db->order_by($arr["db"].'_'.$arr['order']['0'], $arr['order']['1']);

 $query = $this -> db -> get();
 $alldata= (array) $query->result();

 $willreturn=array();

foreach($alldata as  $key=>$value) {
	$arrdataval=(array) $value;
	$arrdataval["active"]=self::filteredarr($arrdataval,$arr);
	$arrdataval["inactive"]=self::filteredarrin($arrdataval,$arr);
	$willreturn[$key]=$arrdataval;
}


 return array(
 "showing"=>$query->num_rows(),
 "data"=>$willreturn,
 );
}







function getdblist($arr){





$srxnum=0;
$qqx="";

foreach ($arr['all'] as $value) {
	if($srxnum==0){
		$srxnum=1;
	}else{
		$qqx.=",";
	}
		$qqx.=$arr["db"].'_'.$value;

}




 $this->db->select($qqx);
 $this->db->from($arr["db"]);

foreach ($arr['whr'] as  $key=>$value) {
 $this->db->where($arr["db"].'_'.$key, $value);
}


 $this->db->order_by($arr["db"].'_'.$arr['order']['0'], $arr['order']['1']);

 $query = $this -> db -> get();


 return  $query->result();
}



function getdblistwiths($arr){





$srxnum=0;
$qqx="";

foreach ($arr['all'] as $value) {
	if($srxnum==0){
		$srxnum=1;
	}else{
		$qqx.=",";
	}
		$qqx.=$arr["db"].'_'.$value;

}




 $this->db->select($qqx);
 $this->db->from($arr["db"]);

foreach ($arr['whr'] as  $key=>$value) {
 $this->db->where($arr["db"].'_'.$key, $value);
}


 $this->db->order_by($arr["db"].'_'.$arr['order']['0'], $arr['order']['1']);

 $query = $this -> db -> get();


 return  $query->result();
}

function countryjson(){
	
	
	
	
 $this->db->select('country_id,country_name,country_sub');
 $this->db->from('country');
 $this->db->order_by("country_name", "asc"); 
 
 $query = $this -> db -> get();
 $result = $query->result();
 
 
 $country=array();
foreach($result as $value){
	$temp=array(
		"id"=>$value->country_id,
		"name"=>$value->country_name,
	);
	
	if($value->country_sub==1){
		$temp['type']="states";
		$temp['data']=array();
		
		
	$qdata=array(
		"db"=>"states",
		"pkey"=>"id",
		"all"=>array("id","name"),
		"whr"=>array(
		   "country"=>$value->country_id,
		   "status"=>"1",
		),
		"order"=>array(
		   "name","ASC",
		),
	);
      		$states= self::getdblist($qdata);
		
foreach($states as $statesv){	
$anothertemp=array(
		"id"=>$statesv->states_id,
		"name"=>$statesv->states_name
		);
	array_push($temp['data'],$anothertemp);
}
			
			
	}elseif($value->country_sub==2){
		$temp['type']="city";
		$temp['data']=array();
		
		
	$qdata=array(
		"db"=>"city",
		"pkey"=>"id",
		"all"=>array("id","name"),
		"whr"=>array(
		   "country"=>$value->country_id,
		   "status"=>"1",
		),
		"order"=>array(
		   "name","ASC",
		),
	);
      		$states= self::getdblist($qdata);
		
foreach($states as $statesv){	
$anothertemp=array(
		"id"=>$statesv->city_id,
		"name"=>$statesv->city_name
		);
	array_push($temp['data'],$anothertemp);
}
			
	}elseif($value->country_sub==3){
	
		$temp['type']="statescity";
		$temp['data']=array();
		
		
		
		
		
		
		
	$qdata=array(
		"db"=>"states",
		"pkey"=>"id",
		"all"=>array("id","name"),
		"whr"=>array(
		   "country"=>$value->country_id,
		   "status"=>"1",
		),
		"order"=>array(
		   "name","ASC",
		),
	);
      		$states= self::getdblist($qdata);
		
foreach($states as $statesv){	
$anothertemp=array(
		"id"=>$statesv->states_id,
		"name"=>$statesv->states_name
		);
	$anothertemp['data']=array();
		
	$qdatax=array(
		"db"=>"city",
		"pkey"=>"id",
		"all"=>array("id","name"),
		"whr"=>array(
		   "states"=>$statesv->states_id,
		   "status"=>"1",
		),
		"order"=>array(
		   "name","ASC",
		),
	);
      		$city= self::getdblist($qdatax);
		
foreach($city as $statesvx){	
$anothertempx=array(
		"id"=>$statesvx->city_id,
		"name"=>$statesvx->city_name
		);
	array_push($anothertemp['data'],$anothertempx);
}
		
	array_push($temp['data'],$anothertemp);
}
			
			
			
			
		
	}
	
	
	
	array_push($country,$temp);
}

return $country;

}





}

?>
