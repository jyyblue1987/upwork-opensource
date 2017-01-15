

  <div class="page animsition">
    <div class="page-header">






    <div class="page-header">
      <h1 class="page-title"><?php echo $title; ?></h1>
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

				<div class="bootstrap-table"><div class="fixed-table-toolbar"><div class="bars pull-left"><div class="btn-group hidden-xs" id="exampleToolbar" role="group">


				  <?php	if($this->Adminlogincheck->checkper($permission['add'])){	?>

				   <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/add'); ?>"> <button type="button" class="btn btn-outline btn-default">
                      <i class="icon fa-plus" aria-hidden="true"></i>
                    </button></a>

						  <?php } ?>

				  <?php	if($this->Adminlogincheck->checkper($permission['inactive'])){	?>
                   <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/inactivelist'); ?>"><button type="button" class="btn btn-outline btn-default">
                      <i class="icon fa-trash" aria-hidden="true"></i>
                    </button></a>

						  <?php } ?>

                  </div></div>



				  	  <form method="GET" action="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/'.$subpage.''); ?>" id="search">

				  <div class="columns columns-right btn-group pull-right"><button class="btn btn-default btn-primary" type="button" name="Search" title="Search"  onclick="document.getElementById('search').submit();"><i class="icon fa-search" aria-hidden="true"></i></button></ul></div></div>

				  <div class="pull-right search"><input class="form-control input-outline" name="q" type="text" placeholder="Search"></div></div>

				  </form>
				  <div class="fixed-table-container" style="padding-bottom: 0px;">

				  <div class="fixed-table-header" style="display: none;"><table></table></div>

				  <div class="fixed-table-body"><div class="fixed-table-loading" style="top: 37px; display: none;">Loading, please wait...</div><table id="exampleTableToolbar" data-mobile-responsive="true" class="table table-hover">
                   <caption class="text-left"><?php



				if(isset($_GET['q'])){
					echo "Showing <code>".$result['showing']."</code> results for <code>".$_GET['q']."</code>";
				}

				  ?></caption>

				   <thead>
                      <tr>
					  <th style=""><div class="th-inner ">ID</div><div class="fht-cell"></div>
            <th style=""><div class="th-inner ">index</div><div class="fht-cell"></div>
					  <th style=""><div class="th-inner ">Name</div><div class="fht-cell"></div>
					  <th style=""><div class="th-inner ">Action</div><div class="fht-cell"></div></th>
                    </thead>
                  <tbody>

				            <?php

   if($result['showing'] > 0)
   {

foreach ($result['data'] as  $value) {
	$arrdata=(array) $value;
	  ?>
				  <tr data-index="0">

				  <td style=""><?php echo $arrdata[$qdata['db']."_id"]; ?></td>
				  <td style=""><?php echo $arrdata[$qdata['db']."_index"]; ?></td>
				  <td style=""><b><?php echo $arrdata[$qdata['db']."_name"]; ?></b></td>
				  <td style="">

                        <?php	if($this->Adminlogincheck->checkper($permission['manage'])){

                    	  ?>
                    						  <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/manage?id='.$arrdata[$qdata['db']."_id"]); ?>">
                                              <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                              data-original-title="Manage">Manage</button>
                                              </a>
                    						  <?php
            
                    						  } ?>

						  <?php	if($this->Adminlogincheck->checkper($permission['edit'])){	?><a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/edit?id='.$arrdata[$qdata['db']."_id"]); ?>">
                          <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                          data-original-title="Edit">
                            <i class="icon fa-edit" aria-hidden="true"></i>
                          </button>
                          </a>
						  <?php } ?>
						  <?php	if($this->Adminlogincheck->checkper($permission['inactive'])){	?>
						  <a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/inactivecheck?id='.$arrdata[$qdata['db']."_id"]); ?>">
                          <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                          data-original-title="Delete">
                            <i class="icon fa-close" aria-hidden="true"></i>
                          </button>
                          </a>
						  <?php } ?>



				  </td>

                  </tr>

                    <?php
}



	   }


					?>


				  </tbody></table></div><div class="fixed-table-footer" style="display: none;"><table><tbody><tr></tr></tbody></table></div><div class="fixed-table-pagination" style="display: none;"></div></div>



				  		<div class="fixed-table-pagination" style="display: block;"><div class="pull-left pagination-detail">



				<span class="pagination-info">Showing <code><?php echo $result['start']; ?></code> to <code><?php echo $result['to']; ?></code> of <code><?php echo $result['num']; ?></code> rows</span></div>
				  <?php
					   if(isset($_GET['q'])){
					$qapend="&q=".$_GET['q'];
					   }else{
						   $qapend="";
					   }
					   ?>
				<div class="pull-right pagination"><ul class="pagination pagination-outline">
				<li class="page-first"><a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/'.$subpage.'?start=0'.$qapend); ?>">«</a></li>
				<li class="page-pre"><a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/'.$subpage.'?start='.$result['prev'].$qapend); ?>">‹</a>
				</li><li class="page-number disabled"><a href="javascript:void(0)">...</a></li>
				<li class="page-next"><a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/'.$subpage.'?start='.$result['next'].$qapend); ?>">›</a></li>
				<li class="page-last"><a href="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/'.$subpage.'?start='.$result['last'].$qapend); ?>">»</a></li>
				</ul></div></div>



				  </div>





              <!-- End Example Basic -->
            </div>
            </div>
            </div>
            </div>
            </div>



            </div>
            </div>
