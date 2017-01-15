

  <div class="page animsition">
    <div class="page-header">






      <div class="row">
        <div class="col-md-6">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $title; ?></h3>
            </div>
            <div class="panel-body">

					<?php
			if(isset($errormsg)){
			if($errormsg=="na"){
			}else{
					?>
                  <button type="button" class="btn btn-large btn-block btn-danger example"><?php echo $errormsg; ?></button>
				  	<?php

			}
			}
				  ?>
            <form class="form-horizontal" id="exampleStandardForm" method="post" action="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/editcheck?id='.$_GET['id']); ?>"  enctype="multipart/form-data" autocomplete="off">
              <?php



	$db= $qdata['db'];
	$inputarr=array("name", "index");

	foreach($inputarr as $val){

	   $tempq=$db."_".$val;
	$tempval=$result[$tempq];
	echo $this->Adminforms->inputtext(ucfirst($val),$db."_".$val,"Enter ".ucfirst($val),htmlentities($tempval),1);
	}

?>




          


<?php 
			  echo $this->Adminforms->submit($title);

			  ?>
              </form>
            </div>
          </div>

          </div>







          </div>

          </div>







          </div>
