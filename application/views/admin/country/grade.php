

  <div class="page animsition">
    <div class="page-header">
	
		  
	  
	  <h1><?php  echo $this->Adminforms->getdetdata("country_name","country","country_id",$_GET['id']); ?></h1>
		  
		  
      <div class="row">
        <div class="col-md-6">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Add grade</h3>
            </div>
            <div class="panel-body">
			
            <form class="form-horizontal" id="exampleStandardForm" method="post" action="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/addgrade/?id='.$_GET['id']); ?>"  enctype="multipart/form-data" autocomplete="off">
              <?php
	
	$db="grade";
	$inputarr=array("name");

	foreach($inputarr as $val){
	echo $this->Adminforms->inputtext(ucfirst($val),$db."_".$val,"Enter ".ucfirst($val),"",1);
	}
			  echo $this->Adminforms->submit("Add grade");

			  ?>
              </form>
            </div>
          </div>
		  
          </div>
		  

		  
		  
		  
		  
          </div>
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  	  
	  
	  
    <div class="page-header">
      <h1 class="page-title">Active grade</h1>
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
					  <th style=""><div class="th-inner ">ID</div><div class="fht-cell"></div>
					  <th style=""><div class="th-inner ">Name</div><div class="fht-cell"></div>
                    </thead>
                  <tbody>
				  
				            <?php 

   if($activegrade['showing'] > 0)
   {
		   
foreach ($activegrade['data'] as  $value) {
	$arrdata=(array) $value;
	  ?>
				  <tr data-index="0">
				  
				  <td style=""><?php echo $arrdata[$qdata['db']."_id"]; ?></td>
				  <td style="">
				  
				  <div style="float:left;"><b><?php echo $arrdata[$qdata['db']."_name"]; ?></b></div>
				  
				    <div class="pull-right search">
						  <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/deletegrade?country='.$_GET['id'].'&id='.$arrdata[$qdata['db']."_id"]); ?>">
                          <button type="button" class="btn btn-danger" data-toggle="tooltip"
                          data-original-title="Delete grade">Delete</button>
                          </a>
					</div>
				  
				   <form method="POST" action="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/editgrade?country='.$_GET['id'].'&id='.$arrdata[$qdata['db']."_id"]); ?>" id="search">
				  
				  <div class="columns columns-right btn-group pull-right"><button class="btn btn-default btn-primary" type="button" name="Search" title="Search"  onclick="document.getElementById('search').submit();"><i class="icon fa-edit" aria-hidden="true"></i></button></ul></div></div>
				  
				  <div class="pull-right search"><input class="form-control input-outline" name="name" type="text" placeholder="Search" value="<?php echo $arrdata[$qdata['db']."_name"]; ?>"></div></div>
				  
				  </form>
				
				  
				  
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
      <h1 class="page-title">Inactive grade</h1>
     
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

   if($inactivegrade['showing'] > 0)
   {
		   
foreach ($inactivegrade['data'] as  $value) {
	$arrdata=(array) $value;
	  ?>
				  <tr data-index="0">
				  
				  <td style=""><?php echo $arrdata[$qdata['db']."_id"]; ?></td>
				  <td style=""><b><?php echo $arrdata[$qdata['db']."_name"]; ?></b></td>
				  <td style="">
				  
				  
						  <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/restoregrade?country='.$_GET['id'].'&id='.$arrdata[$qdata['db']."_id"]); ?>">
                          <button type="button" class="btn btn-success" data-toggle="tooltip"
                          data-original-title="Restore grade">Restore</button>
                          </a>
						  <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/delgrade?country='.$_GET['id'].'&id='.$arrdata[$qdata['db']."_id"]); ?>">
                          <button type="button" class="btn btn-danger" data-toggle="tooltip"
                          data-original-title="Delete grade">Delete</button>
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
		  
		  