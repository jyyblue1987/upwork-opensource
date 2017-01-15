
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">My Setting</h1>




      <div class="page-content">
            <div class="row">
              <div class="col-md-6">
                <!-- Panel Standard Mode -->
                <div class="panel">
                  <div class="panel-heading">
                    <h3 class="panel-title">Change Password</h3>
                  </div>
                  <div class="panel-body">
      			  	<?php
      			if(isset($response)){
      				if($response==11){
      					?>
                        <button type="button" class="btn btn-large btn-block btn-success example">Password Changed Successfully</button>
      				<?php }
      				?>
      				<?php if($response==22){
      					?>
                        <button type="button" class="btn btn-large btn-block btn-danger example">Something Went wrong</button>
      				  	<?php }

      			}
      				  ?>
                  <form class="form-horizontal" id="exampleStandardForm" method="post" action="<?php echo site_url("administrator/user/changepass"); ?>" autocomplete="off">
                     <?php

              echo $this->Forms->inputpass("Old Password","oldpassword","Old Password","",1);
              echo $this->Forms->inputpass("New Password","newpassword","New Password","",1);
      			  echo $this->Forms->submit("Change Password");

      			   ?>

                    </form>
                  </div>
                </div>

                </div>







      		  <div class="col-sm-6">
                <!-- Panel Floating Lables -->
                <div class="panel">
                  <div class="panel-heading">
                    <h3 class="panel-title">Change Profile picture</h3>
                  </div>
                  <div class="panel-body container-fluid">

      			<?php
      			if(isset($response)){
      				if($response==33){
      					?>
                        <button type="button" class="btn btn-large btn-block btn-success">Profile picture changed successfully</button>
      				<?php }
      				?>
      				<?php if($response==44){
      					?>
                        <button type="button" class="btn btn-large btn-block btn-danger">Something Went wrong</button>
      				  	<?php }

      			}
      				  ?>


                    <form action="<?php echo site_url("administrator/user/changepic"); ?>" method="post" enctype="multipart/form-data" autocomplete="off">


      				 <?php

      			  echo $this->Forms->addfile("Picture","fileToUpload","image/*");
      			  echo $this->Forms->submit("Change Picture");

      			   ?>
                    </form>
                  </div>
                </div>
                </div>
                </div>




                                </div>



    </div>
  </div>
