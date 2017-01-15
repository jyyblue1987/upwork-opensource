
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Edit Sub Menu</h1>

	      <div class="page-header">


      <div class="row">
        <div class="col-md-6">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Edit Sub Menu</h3>
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
            <form class="form-horizontal" id="exampleStandardForm" method="post" action="<?php echo site_url("administrator/nav/editsubmenucheck?id=".$_GET['id']."&page=".$_GET['page']); ?>" autocomplete="off">

        <?php

         echo $this->Adminforms->inputtext("Sub Page","subpage","Enter Sub Page",$this->Adminforms->getdata("subpage","usersubpage",$_GET['id']),1);
          echo $this->Adminforms->inputtext("Name","name","Enter Name",$this->Adminforms->getdata("name","usersubpage",$_GET['id']),1);
 echo $this->Adminforms->inputtext("Icon","icon","Icon",$this->Adminforms->getdata("icon","usersubpage",$_GET['id']),1);
 echo $this->Adminforms->inputtext("Index","index","Index",$this->Adminforms->getdata("ind","usersubpage",$_GET['id']),1);
  echo $this->Adminforms->toggle("Menu","menu",$this->Adminforms->getdata("menu","usersubpage",$_GET['id']));
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
