

  <div class="page animsition">
    <div class="page-header">

      <div class="row">
        <div class="col-md-6">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $header; ?></h3>
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
            <form class="form-horizontal" id="exampleStandardForm" method="post" action="<?php echo site_url("administrator/admins/loadpage/addcheck"); ?>"  enctype="multipart/form-data" autocomplete="off">
              <?php

			  echo $this->Adminforms->inputtext("Full name","name","Enter Full name","",1);
			  echo $this->Adminforms->inputtext("Username","username","Enter Username","",1);
			  echo $this->Adminforms->inputtext("Email","email","Email","",1);
				echo $this->Forms->inputpass(" Password","password","Password","",1);
			  echo $this->Adminforms->addfile("Picture","fileToUpload","image/*");
			  echo $this->Adminforms->submit($header);

			  ?>
              </form>
            </div>
          </div>

          </div>







					          </div>
</div>
</div>
