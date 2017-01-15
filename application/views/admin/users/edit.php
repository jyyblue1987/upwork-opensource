


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
            <form class="form-horizontal" id="exampleStandardForm" method="post" action="<?php echo site_url("administrator/users/loadpage/editcheck?id=".$_GET['id']); ?>"  enctype="multipart/form-data" autocomplete="off">
               <?php

			  echo $this->Adminforms->inputtext("Full name","name","Enter Full name",$this->Adminforms->getdata("name","user",$_GET['id']),1);
			  echo $this->Adminforms->inputtext("Username","username","Enter Username",$this->Adminforms->getdata("username","user",$_GET['id']),1);
			  echo $this->Adminforms->inputtext("Email","email","Email",$this->Adminforms->getdata("email","user",$_GET['id']),1);
			  echo $this->Adminforms->inputpass("New Password","foo_one","Password");
			  echo $this->Adminforms->addfile("Picture","fileToUpload","image/*");
			  echo $this->Adminforms->selectdbnew("Select Country","country","Select Country","country","id","name","index","asc",$this->Adminforms->getdata("country","user",$_GET['id']),true,array("all","All Country"));
			  echo $this->Adminforms->submit($header);

			  ?>
              </form>
            </div>
          </div>

          </div>







          </div>


					</div>


					</div>
