
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">System Section</h1>

<?php
		$pp=10;


 $this->db->select('id');
 $this->db->from('usersection');
 if(isset($_GET['q'])){
$q=$_GET['q'];
 $this->db->like('name', $q);
 }
 $query = $this -> db -> get();
 $num=$query->num_rows();
	$last=$num-$pp;
				if($last<1){
				$last=0;
				}
				if(isset($_GET['start'])){
				if($_GET['start']>0){
				$start=$_GET['start'];
				}else{
				$start=0;
				}}else{
				$start=0;
				}
				if($start>$num){
				$start=0;
				}
				$next=$start+$pp;
				$to=$start+$pp;

				$prev=$start-$pp;
				if($next<$num){
				}else{
				$next=0;
				$to=$num;
				}
				if($prev<1){
				$prev=0;
				}


?>



	      <div class="page-header">


      <div class="row">
        <div class="col-md-6">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Add Section</h3>
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
            <form class="form-horizontal" id="exampleStandardForm" method="post" action="<?php echo site_url("administrator/nav/addsection"); ?>" autocomplete="off">
                    <?php
			  echo $this->Adminforms->inputtext("Name","name","Enter Name","",1);
			  echo $this->Adminforms->inputtext("Index","index","Index","",1);
			  echo $this->Adminforms->submit("Add Section");
			  ?>


              </form>
            </div>
          </div>

          </div>







          </div>





      <h1 class="page-title">User Section List</h1>
    </div>

    <div class="page-content">
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body container-fluid">
          <div class="row row-lg">



				<div class="col-sm-12">

				<div class="bootstrap-table"><div class="fixed-table-toolbar">



				  	  <form method="GET" action="<?php echo site_url('administrator/nav/section'); ?>" id="search">

				  <div class="columns columns-right btn-group pull-right"><button class="btn btn-default btn-primary" type="button" name="Search" title="Search"  onclick="document.getElementById('search').submit();"><i class="icon wb-search" aria-hidden="true"></i></button></ul></div></div>

				  <div class="pull-right search"><input class="form-control input-outline" name="q" type="text" placeholder="Search"></div></div>

				  </form>
				  <div class="fixed-table-container" style="padding-bottom: 0px;">

				  <div class="fixed-table-header" style="display: none;"><table></table></div>

				  <div class="fixed-table-body"><div class="fixed-table-loading" style="top: 37px; display: none;">Loading, please wait...</div><table id="exampleTableToolbar" data-mobile-responsive="true" class="table table-hover">
                    <thead>
                      <tr>

					  <th style=""><div class="th-inner ">ID</div><div class="fht-cell"></div></th>
					  <th style=""><div class="th-inner ">Index</div><div class="fht-cell"></div></th>
					  <th style=""><div class="th-inner ">Name</div><div class="fht-cell"></div></th>
					  <th style=""><div class="th-inner ">Actions</div><div class="fht-cell"></div></th></tr>
                    </thead>
                  <tbody>

				            <?php

 $this->db->select('id,page,name,ind,icon');
 $this->db->from('usersection');
 if(isset($_GET['q'])){
$q=$_GET['q'];
 $this->db->like('name', $q);
 }
 $this->db->order_by("ind", "asc");

 $this->db->limit($pp,$start);
 $query = $this -> db -> get();

   if($query -> num_rows() > 0)
   {

foreach ($query->result() as $value) {

	  ?>
				  <tr data-index="0">





				  <td style=""><?php echo $value->id; ?></td>
				  <td style=""><?php echo $value->ind; ?></td>
				  <td style=""><?php echo $value->name; ?></td>
				  <td style="">





						<a href="<?php echo site_url('administrator/nav/editsection?id='.$value->id); ?>">
                          <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                          data-original-title="Edit">
                            <i class="icon fa-edit" aria-hidden="true"></i>
                          </button>
                          </a>
						  <a href="<?php echo site_url('administrator/nav/menu?id='.$value->id); ?>">
                          <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                          data-original-title="Menus">
                            <i class="icon fa-list" aria-hidden="true"></i>
                          </button>
                          </a>



				  </td>

                  </tr>

                    <?php
}



	   }


					?>


				  </tbody></table></div><div class="fixed-table-footer" style="display: none;"><table><tbody><tr></tr></tbody></table></div><div class="fixed-table-pagination" style="display: none;"></div></div>



				  		<div class="fixed-table-pagination" style="display: block;"><div class="pull-left pagination-detail">



				<span class="pagination-info">Showing <code><?php echo $start; ?></code> to <code><?php echo $to; ?></code> of <code><?php echo $num; ?></code> rows</span></div>
				  <?php
					   if(isset($_GET['q'])){
					$qapend="&q=".$_GET['q'];
					   }else{
						   $qapend="";
					   }
					   ?>
				<div class="pull-right pagination"><ul class="pagination pagination-outline">
				<li class="page-first"><a href="<?php echo site_url('administrator/nav/section?start=0'.$qapend); ?>">«</a></li>
				<li class="page-pre"><a href="<?php echo site_url('administrator/nav/section?start='.$prev.$qapend); ?>">‹</a>
				</li><li class="page-number disabled"><a href="javascript:void(0)">...</a></li>
				<li class="page-next"><a href="<?php echo site_url('administrator/nav/section?start='.$next.$qapend); ?>">›</a></li>
				<li class="page-last"><a href="<?php echo site_url('administrator/nav/section?start='.$last.$qapend); ?>">»</a></li>
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
