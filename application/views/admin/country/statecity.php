

  <div class="page animsition">
    <div class="page-header">
	
		  
	  
	  <h1><?php  echo $this->Adminforms->getdetdata("country_name","country","country_id",$_GET['id']); ?></h1>
		  
		  
      <div class="row">
        <div class="col-md-6">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Add State</h3>
            </div>
            <div class="panel-body">
			
            <form class="form-horizontal" id="exampleStandardForm" method="post" action="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/addstatesb/?id='.$_GET['id']); ?>"  enctype="multipart/form-data" autocomplete="off">
              <?php
	
	$db="states";
	$inputarr=array("name");

	foreach($inputarr as $val){
	echo $this->Adminforms->inputtext(ucfirst($val),$db."_".$val,"Enter ".ucfirst($val),"",1);
	}
			  echo $this->Adminforms->submit("Add State");

			  ?>
              </form>
            </div>
          </div>
		  
          </div>
		  

		  
		  
		  
		  
          </div>
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  	  
	  
	  
    <div class="page-header">
      <h1 class="page-title">Active States</h1>
      <div class="page-header-actions">
        <ol class="breadcrumb">
          <li><a href="javascript:void(0)">Home</a></li>
          <li><a href="javascript:void(0)"><?php echo $loadpage; ?></a></li>
          <li class="active"><?php echo $title; ?></li>
        </ol>
      </div>
    </div>
	
    <div class="page-content">
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body container-fluid">
          <div class="row row-lg">
          
			
				
				<div class="col-sm-12">
				
				<div class="bootstrap-table"><div class="fixed-table-toolbar">
				
				
				  
                  
				  
				  
				  <div class="fixed-table-container" style="padding-bottom: 0px;">
				  
				  <div class="fixed-table-header" style="display: none;"><table></table></div>
				  
				  <div class="fixed-table-body"><div class="fixed-table-loading" style="top: 37px; display: none;">Loading, please wait...</div><table id="exampleTableToolbar" data-mobile-responsive="true" class="table table-hover">
     

				   <thead>
                      <tr>
					  <th style=""><div class="th-inner ">ID</div><div class="fht-cell"></div></th>
					  <th style=""><div class="th-inner ">Name</div><div class="fht-cell"></div></th>
                    </thead>
                  <tbody>
				  
				            <?php 

   if($activestates['showing'] > 0)
   {
		   
foreach ($activestates['data'] as  $value) {
	
	  ?>
				  <tr data-index="0">
				  
				  <td style=""><h2><b><?php echo $value[$qdata['db']."_name"]; ?></b></h2></td>
				  <td style="">
				  		
				  
				    <div class="pull-right search">
						  <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/deletestateb?country='.$_GET['id'].'&id='.$value[$qdata['db']."_id"]); ?>">
                          <button type="button" class="btn btn-danger" data-toggle="tooltip"
                          data-original-title="Delete State">Delete</button>
                          </a>
					</div>
				  
				   <form method="POST" action="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/editstatesb?country='.$_GET['id'].'&id='.$value[$qdata['db']."_id"]); ?>" id="search">
				  
				  <div class="columns columns-right btn-group pull-right"><button class="btn btn-default btn-primary" type="button" name="Search" title="Search"  onclick="document.getElementById('search').submit();"><i class="icon fa-edit" aria-hidden="true"></i></button></ul></div></div>
				  
				  <div class="pull-right search"><input class="form-control input-outline" name="name" type="text" value="<?php echo $value[$qdata['db']."_name"]; ?>"></div></div>
				  
				  </form>
				
				  
				  
				  </td>
				  
                  </tr>
		
				  <tr data-index="0">
				  
				  <td style="">Add City</td>
				  <td style="">
				  		
				 	  
					<form method="POST" action="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/addcityunder?country='.$_GET['id'].'&states='.$value[$qdata['db']."_id"]); ?>" id="search">
							  <div class="pull-left search"><input class="form-control input-outline" name="name" type="text" placeholder="City name" value=""></div>
							  <div class="columns columns-left btn-group pull-left"><button class="btn btn-default btn-primary" type="button" name="Search" title="Search"  onclick="document.getElementById('search').submit();"><i class="icon fa-plus" aria-hidden="true"></i></button></ul></div>
					</form>
				  
				  </td>
				  
                  </tr>
		
				  <tr data-index="0" style="background:green;color:white;">
				  
				  <td style="">	

Active Cities				  
		</td>
				  <td style="">
				  

				  <table id="exampleTableToolbar" data-mobile-responsive="true" class="table table-hover">
     

				   <thead>
                      <tr>
					  <th style=""><div class="th-inner ">Name</div><div class="fht-cell"></div></th>
                    </thead>
                  <tbody>
				  
				            <?php 

   if(count($value['active']) > 0)
   {
		   
foreach ($value['active'] as  $valueactive) {
	$arrdata=(array) $valueactive;

	  ?>
				  <tr data-index="0">
				  
				  <td style="">
				  
				  <div style="float:left;"><?php echo $arrdata[$qdata['subdb']."_name"]; ?></div>
				  
				    <div class="pull-right search">
						  <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/deletecityb?country='.$_GET['id'].'&id='.$arrdata[$qdata['subdb']."_id"]); ?>">
                          <button type="button" class="btn btn-danger" data-toggle="tooltip"
                          data-original-title="Delete State">Delete</button>
                          </a>
					</div>
				  
				   <form method="POST" action="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/editcityb?country='.$_GET['id'].'&id='.$arrdata[$qdata['subdb']."_id"]); ?>" id="search">
				  
				  <div class="columns columns-right btn-group pull-right"><button class="btn btn-default btn-primary" type="button" name="Search" title="Search"  onclick="document.getElementById('search').submit();"><i class="icon fa-edit" aria-hidden="true"></i></button></ul></div></div>
				  
				  <div class="pull-right search"><input class="form-control input-outline" name="name" type="text" placeholder="Search" value="<?php echo $arrdata[$qdata['subdb']."_name"]; ?>"></div></div>
				  
				  </form>
				
				  
				  
				  </td>
				  
                  </tr>
				 
                    <?php 
}


		   
	   }
	   

					?>
				 
				  
				  </tbody></table>
				  
				  
				  
				  
				  
				  </td>
				  
                  </tr>
				  <tr data-index="0" style="background:red;color:white;">
				  
				  <td style="">	

Inactive Cities				  
		</td>
				  <td style="">

				 <table id="exampleTableToolbar" data-mobile-responsive="true" class="table table-hover">
     

				   <thead>
                      <tr>
					  <th style=""><div class="th-inner ">Name</div><div class="fht-cell"></div></th>
                    </thead>
                  <tbody>
				  
				            <?php 

   if(count($value['inactive']) > 0)
   {
		   
foreach ($value['inactive'] as  $valueactive) {
	$arrdata=(array) $valueactive;

	  ?>
				  <tr data-index="0">
				  
				  <td style="">
				  
				  <div style="float:left;"><?php echo $arrdata[$qdata['subdb']."_name"]; ?></div>
				  
				    <div class="pull-right search">
						  <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/delcityb?country='.$_GET['id'].'&id='.$arrdata[$qdata['subdb']."_id"]); ?>">
                          <button type="button" class="btn btn-danger" data-toggle="tooltip"
                          data-original-title="Delete City">Delete</button>
                          </a>
					</div>
				    <div class="pull-right search">
						  <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/restorecityb?country='.$_GET['id'].'&id='.$arrdata[$qdata['subdb']."_id"]); ?>">
                          <button type="button" class="btn btn-success" data-toggle="tooltip"
                          data-original-title="Restore City">Restore</button>
                          </a>
					</div>
				
				  
				  
				  </td>
				  
                  </tr>
				 
                    <?php 
}


		   
	   }
	   

					?>
				 
				  
				  </tbody></table>
				  
				  
				  </td>
				  
                  </tr>
				  
				  
				 
                    <?php 
}


		   
	   }
	   

					?>
				 
				  
				  </tbody></table></div><div class="fixed-table-footer" style="display: none;"><table><tbody><tr></tr></tbody></table></div><div class="fixed-table-pagination" style="display: none;"></div></div>
				  
				  
				  

				  
				  
				  </div>
				
		
				
				
				
              <!-- End Example Basic -->
            </div>
            </div>
            </div>
            </div>
            </div>
			
			
		  
          </div>
		  
		  
		  
		  
    <div class="page-header">
      <h1 class="page-title">Inactive States</h1>
     
    </div>
	
	
    <div class="page-content">
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body container-fluid">
          <div class="row row-lg">
          
			
				
				<div class="col-sm-12">
				
				<div class="bootstrap-table"><div class="fixed-table-toolbar">
				
				
				  
                  
				  
				  
				  <div class="fixed-table-container" style="padding-bottom: 0px;">
				  
				  <div class="fixed-table-header" style="display: none;"><table></table></div>
				  
				  <div class="fixed-table-body"><div class="fixed-table-loading" style="top: 37px; display: none;">Loading, please wait...</div><table id="exampleTableToolbar" data-mobile-responsive="true" class="table table-hover">
     

				   <thead>
                      <tr>
					  <th style=""><div class="th-inner ">ID</div><div class="fht-cell"></div>
					  <th style=""><div class="th-inner ">Name</div><div class="fht-cell"></div>
					  <th style=""><div class="th-inner ">Action</div><div class="fht-cell"></div>
                    </thead>
                  <tbody>
				  
				            <?php 

   if($inactivestates['showing'] > 0)
   {
		   
foreach ($inactivestates['data'] as  $value) {
	$arrdata=(array) $value;
	  ?>
				  <tr data-index="0">
				  
				  <td style=""><?php echo $arrdata[$qdata['db']."_id"]; ?></td>
				  <td style=""><b><?php echo $arrdata[$qdata['db']."_name"]; ?></b></td>
				  <td style="">
				  
				  
						  <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/restorestateb?country='.$_GET['id'].'&id='.$arrdata[$qdata['db']."_id"]); ?>">
                          <button type="button" class="btn btn-success" data-toggle="tooltip"
                          data-original-title="Restore State">Restore</button>
                          </a>
					
						  <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/delstateb?country='.$_GET['id'].'&id='.$arrdata[$qdata['db']."_id"]); ?>">
                          <button type="button" class="btn btn-danger" data-toggle="tooltip"
                          data-original-title="Delete State">Delete</button>
                          </a>
					
				  
				  
				  
				  </td>
				  
                  </tr>
				 
                    <?php 
}


		   
	   }
	   

					?>
				 
				  
				  </tbody></table></div><div class="fixed-table-footer" style="display: none;"><table><tbody><tr></tr></tbody></table></div><div class="fixed-table-pagination" style="display: none;"></div></div>
				  
				  
				  

				  
				  
				  </div>
				
		
				
				
				
              <!-- End Example Basic -->
            </div>
            </div>
            </div>
            </div>
            </div>
			
			
		  
          </div>
		  
		  
		  
		  
		  
		  
		  
          </div>
          </div>
		  
		  