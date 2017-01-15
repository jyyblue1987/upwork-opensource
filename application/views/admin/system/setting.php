
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">System Setting</h1>




      <div class="page-content">
            <div class="row">
              <div class="col-md-6">
                <!-- Panel Standard Mode -->
                <div class="panel">
                  <div class="panel-heading">
                    <h3 class="panel-title">Change Password</h3>
                  </div>
                  <div class="panel-body">



                <form class="form-horizontal cmxform" id="validateForm" method="post" action="<?php echo site_url("administrator/system/change"); ?>" autocomplete="off">

   			  	<?php
   			if(isset($error)){

   					?> <button type="button" class="btn btn-block btn-danger"><?php echo $errormsg; ?></button>
   				  	<?php

   			}
   				  ?>

   				  <div class="col-sm-12">
                     <label class="control-label" for="inputText" style="float:left;">On/ Off switches</label>
                          <ul class="list-unstyled list-inline" style="float: right;">
                     <li class="margin-right-25 margin-bottom-25"><input type="checkbox" data-plugin="switchery" name="toggle"
   <?php
   if($this->Adminforms->getdata("value","site","1")=='1'){
   echo "checked";
   }
    ?>/> </li> </ul>
                     </div>



   					  <?php
      			  echo $this->Adminforms->submit("Save Setting");
   			  ?>



                   </div>
                 </form>


                  </div>
                </div>

                </div>


                </div>




                                </div>



    </div>
  </div>
