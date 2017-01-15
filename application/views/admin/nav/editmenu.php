
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Edit Menu</h1>

	      <div class="page-header">


      <div class="row">
        <div class="col-md-6">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Edit Menu</h3>
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
            <form class="form-horizontal" id="exampleStandardForm" method="post" action="<?php echo site_url("administrator/nav/editmenucheck?id=".$_GET['id']."&section=".$_GET['section']); ?>" autocomplete="off">

        <?php

         echo $this->Adminforms->inputtext("Page","page","Enter Page",$this->Adminforms->getdata("page","userpage",$_GET['id']),1);
          echo $this->Adminforms->inputtext("Name","name","Enter Name",$this->Adminforms->getdata("name","userpage",$_GET['id']),1);
 echo $this->Adminforms->inputtext("Icon","icon","Icon",$this->Adminforms->getdata("icon","userpage",$_GET['id']),1);
 echo $this->Adminforms->inputtext("Index","index","Index",$this->Adminforms->getdata("ind","userpage",$_GET['id']),1);
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
