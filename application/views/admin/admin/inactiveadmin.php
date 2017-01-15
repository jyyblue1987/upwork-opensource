
  <div class="page animsition">
    <div class="page-header"><?php
		$pp=10;


 $this->db->select('id');
 $this->db->from('user');
 $this->db->where('type', "1");
 $this->db->where('status', "2");
 if(isset($_GET['q'])){
$q=$_GET['q'];
 $this->db->where("(name LIKE '%$q%' OR username LIKE '%$q%' OR email LIKE '%$q%')", null,false);
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
      <h1 class="page-title"><?php echo $header; ?></h1>
      <div class="page-header-actions">
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url(); ?>">Home</a></li>
          <li><a href="javascript:void(0)">System</a></li>
          <li class="active"><?php echo $header; ?></li>
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

                   <a href="<?php echo site_url('administrator/admins/loadpage/lists/'); ?>"><button type="button" class="btn btn-outline btn-default">
                      <i class="icon fa-user" aria-hidden="true"></i>
                    </button></a>

                  </div></div>



				  	  <form method="GET" action="<?php echo site_url('administrator/admins/loadpage/inactiveadmin'); ?>" id="search">

				  <div class="columns columns-right btn-group pull-right"><button class="btn btn-default btn-primary" type="button" name="Search" title="Search"  onclick="document.getElementById('search').submit();"><i class="icon wb-search" aria-hidden="true"></i></button></ul></div></div>

				  <div class="pull-right search"><input class="form-control input-outline" name="q" type="text" placeholder="Search"></div></div>

				  </form>
				  <div class="fixed-table-container" style="padding-bottom: 0px;">

				  <div class="fixed-table-header" style="display: none;"><table></table></div>

				  <div class="fixed-table-body"><div class="fixed-table-loading" style="top: 37px; display: none;">Loading, please wait...</div><table id="exampleTableToolbar" data-mobile-responsive="true" class="table table-hover">
             <caption class="text-left">  <?php



			    $this->db->select('id, name, username, email, type, status');
 $this->db->from('user');
 if(isset($_GET['q'])){
$q=$_GET['q'];
 $this->db->where("(name LIKE '%$q%' OR username LIKE '%$q%' OR email LIKE '%$q%')", null,false);
 }
 $this->db->where('type', "1");
 $this->db->where('status', "2");

 $this->db->limit($pp,$start);
 $query = $this -> db -> get();


				if(isset($_GET['q'])){
					echo "Showing <code>".$query -> num_rows()."</code> results for <code>".$_GET['q']."</code>";
				}

?>			</caption>

				   <thead>
                      <tr>
					  <th style=""><div class="th-inner ">Name</div><div class="fht-cell"></div></th>
					  <th style=""><div class="th-inner ">Username</div><div class="fht-cell"></div></th>
					  <th style=""><div class="th-inner ">Email</div><div class="fht-cell"></div></th>
					  <th style=""><div class="th-inner ">Action</div><div class="fht-cell"></div></th></tr>
                    </thead>
                  <tbody>

				            <?php


   if($query -> num_rows() > 0)
   {

foreach ($query->result() as $value) {

	  ?>
				  <tr data-index="0">

				  <td style=""><?php echo $value->name; ?></td>
				  <td style=""><?php echo $value->username; ?></td>
				  <td style=""><?php echo $value->email; ?></td>
				  <td style="">





						  <a href="<?php echo site_url('administrator/admins/loadpage/active?id='.$value->id); ?>">
                          <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                          data-original-title="Delete">
                            <i class="icon fa-close" aria-hidden="true"></i>
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
				<li class="page-first"><a href="<?php echo site_url('administrator/admins/loadpage/inactiveadmin?start=0'.$qapend); ?>">«</a></li>
				<li class="page-pre"><a href="<?php echo site_url('administrator/admins/loadpage/inactiveadmin?start='.$prev.$qapend); ?>">‹</a>
				</li><li class="page-number disabled"><a href="javascript:void(0)">...</a></li>
				<li class="page-next"><a href="<?php echo site_url('administrator/admins/loadpage/inactiveadmin?start='.$next.$qapend); ?>">›</a></li>
				<li class="page-last"><a href="<?php echo site_url('administrator/admins/loadpage/inactiveadmin?start='.$last.$qapend); ?>">»</a></li>
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
