
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Edit Section</h1>

	      <div class="page-header">


      <div class="row">
        <div class="col-md-6">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Edit Section</h3>
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
            <form class="form-horizontal" id="exampleStandardForm" method="post" action="<?php echo site_url("administrator/nav/editsectioncheck?id=".$_GET['id']); ?>" autocomplete="off">

        <?php

 echo $this->Adminforms->inputtext("Name","name","Enter Name",$this->Adminforms->getdata("name","usersection",$_GET['id']),1);
 echo $this->Adminforms->inputtext("Index","index","Index",$this->Adminforms->getdata("ind","usersection",$_GET['id']),1);
 echo $this->Adminforms->submit("Change");

 ?>





              </form>
            </div>
          </div>

          </div>







          </div>




                </div>
              </div>
            </div>
