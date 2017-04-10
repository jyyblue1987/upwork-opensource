<?php 
define('DS', $this->session->userdata('type'));
define('US', $this->session->userdata('id'));

class pagess{
public $name;
public $id;
function __construct($name,$id,$title,$icon){
$this->name=$name;
$this->id=$id;
$this->title=$title;
$this->icon=$icon;
}
}
class sectionss{
public $name;
public $id;
function __construct($name,$id){
$this->name=$name;
$this->id=$id;
}
}
class permissionss{
	
	  function checkperm($u,$p,$db)
    {
$db->select('id');
 $db->from('userpageaccess');
 $db->where('user', $u);
 $db->where('page', $p);
 
   $query = $db-> get();
 
   if($query -> num_rows() == 1)
   {
	   return "11";	
}else{
			return "22";
		}

    }
	  function checkpersec($u,$p,$db)
    {
$db->select('id');
 $db->from('usersectionaccess');
 $db->where('user', $u);
 $db->where('section', $p);
 
   $query = $db-> get();
 
   if($query -> num_rows() == 1)
   {
	   return "11";	
}else{
			return "22";
		}

    }
	  function checkper($u,$p,$db)
    {

 $db->select('id');
 $db->from('usersubpageaccess');
 $db->where('user', $u);
 $db->where('subpage', $p);

   $query = $db->get();

   if($query -> num_rows() == 1)
   {
				return "11";
}else{
			return "22";
		}


    }
function pagea($id,$pid,$db){

	
				 $db->select('id');
 $db->from('userpageaccess');
 $db->where('user', $id);
 $db->where('page', $pid);
 
   $query = $db-> get();
 
   if($query -> num_rows() > 0)
   {
echo "checked=\"checked\"";

return true;
}else{
return false;
}
}
function spagea($id,$pid,$db){

	
				 $db->select('id');
 $db->from('usersubpageaccess');
 $db->where('user', $id);
 $db->where('subpage', $pid);
 
   $query = $db-> get();
 
   if($query -> num_rows() > 0)
   {
	   
echo "checked=\"checked\"";
}
}
function getname($id,$db){
	
	 $db->select('name');
 $db->from('user');
 $db->where('id', $id);
 $query = $db-> get();
 
 $return=$query->result()[0];
return $return->name;
}

function subpage($id,$db,$sid){

	
	 $db->select('id,subpage,name,icon');
 $db->from('usersubpage');

 $db->where('page', $id);
 $db->where('menu', "1");

 $db->order_by("ind", "asc"); 
 
 $postarr=array();
 $query = $db-> get();
 
   if($query -> num_rows() > 0)
   {
	   
	   
		   
foreach ($query->result() as $value) {
	 
					  if(DS=='1'){
$mypost=new pagess($value->subpage,$value->id,$value->name,$value->icon);
array_push($postarr,$mypost);
			  }else{
				    $ds=US;
					
				   
			     if(self::checkper($ds,$value->id,$db)=="11"){
$mypost=new pagess($value->subpage,$value->id,$value->name,$value->icon);
array_push($postarr,$mypost);

			  }else{
				  
			  }
			  }
	   
}
	   }
	   
	
return $postarr;
}
function page($s,$db){
	
 $db->select('id,page,name,icon');
 $db->from('userpage');
 
 $db->where('section', $s);
 $db->order_by("ind", "asc"); 
 $query = $db->get();
 
 $postarr=array();
   if($query -> num_rows() > 0)
   {
	      
				   
foreach ($query->result() as $value) {
	
	  if(DS=='1'){
$mypost=new pagess($value->page,$value->id,$value->name,$value->icon);
array_push($postarr,$mypost);
			  }else{
				
 $ds=US;
	  	
			     if(self::checkperm($ds,$value->id,$db)=="11"){
					 
$mypost=new pagess($value->page,$value->id,$value->name,$value->icon);
array_push($postarr,$mypost);
			  }else{
				  
			  }
			  }
			  


}
}
return $postarr;

 
 }
function section($db){
	
 $db->select('id,name');
 $db->from('usersection');
 $db->order_by("ind", "asc"); 
 $query = $db->get();
 
 $postarr=array();
   if($query -> num_rows() > 0)
   {
	      
				   
foreach ($query->result() as $value) {
	
	  if(DS=='1'){
$mypost=new sectionss($value->name,$value->id);
array_push($postarr,$mypost);
			  }else{
				
 $ds=US;
	  	
			     if(self::checkpersec($ds,$value->id,$db)=="11"){
					 
$mypost=new sectionss($value->name,$value->id);
array_push($postarr,$mypost);
			  }else{
				  
			  }
			  }
			  


}
}
return $postarr;

 
 }


}

$per=new permissionss;


?>

  <div class="site-menubar">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu">
            <li class="site-menu-category"></li>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?php echo site_url("administrator/"); ?>">
                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
              </a>
            </li>

	  
			<?php

if(($this->session->userdata('type')=="1") || ($this->session->userdata('type')=="2")){
	
	
	  	  $id=$this->session->userdata('id');
		
$sx=$per->section($this->db);

		  foreach($sx as $lstx){

			?>
            <li class="site-menu-category"><?php echo $lstx->name; ?></li>
			
				  <?php 
				
	  
$s=$per->page($lstx->id,$this->db);

		  foreach($s as $lst){
echo '
<li class="site-menu-item has-sub ';
if($this->uri->segment(4)==$lst->name){ echo "active open"; } 
echo '">
<a href="javascript:void(0);" data-slug="tables">
<i class="site-menu-icon '.$lst->icon.'" aria-hidden="true"></i>
 <span class="site-menu-title">'.$lst->title.'</span>
 
 <span class="site-menu-arrow"></span></a>
 
 <ul class="site-menu-sub">
 
 ';
$p=$per->subpage($lst->id,$this->db,$this->session->userdata('id'));

foreach($p as $pst){
echo ' 
<li class="site-menu-item';

if(in_array($pst->name, array('withdaw-processed', 'withdaw-pending'))){ 
    if($this->uri->segment(6)==$pst->name){ echo " active"; }  
    echo '">
        <a class="animsition-link" href="'.site_url('administrator/userpage/loadpage/fundmangement/subpage/'.$pst->name.'/').'" data-slug="tables-basic">
        <i class="site-menu-icon  '.$pst->icon.'" aria-hidden="true"></i>
        <span class="site-menu-title">'.$pst->title.'</span></a>
       </li>';
}else{
    if($this->uri->segment(6)==$pst->name){ echo " active"; } 
    echo '">
        <a class="animsition-link" href="'.site_url('administrator/userpage/loadpage/'.$lst->name.'/subpage/'.$pst->name.'/').'" data-slug="tables-basic">
        <i class="site-menu-icon  '.$pst->icon.'" aria-hidden="true"></i>
        <span class="site-menu-title">'.$pst->title.'</span></a>
       </li>';
}
}
echo "

</ul></li>";
}

}

  
		  }
			?>			





                  <?php
      if($this->session->userdata('type')=="1"){
      			?>


            <li class="site-menu-category">System</li>







          <li class="site-menu-item has-sub <?php
if($this->uri->segment(2)=="users"){ echo "active open"; } 
				?>">
            <a href="javascript:void(0)">
              <i class="site-menu-icon md-palette" aria-hidden="true"></i>
              <span class="site-menu-title">System users</span>
              <span class="site-menu-arrow"></span>
            </a>
            <ul class="site-menu-sub">

              <li class="site-menu-item <?php if(($this->uri->segment(4)=="lists")&&($this->uri->segment(2)=="users")){ echo "active"; }  ?>">
                <a class="animsition-link" href="<?php echo site_url("administrator/users/loadpage/lists/"); ?>">
                  <span class="site-menu-title">users lists</span>
                </a>
              </li>
              <li class="site-menu-item <?php if(($this->uri->segment(4)=="add")&&($this->uri->segment(2)=="users")){ echo "active"; }  ?>">
                <a class="animsition-link" href="<?php echo site_url("administrator/users/loadpage/add/"); ?>">
                  <span class="site-menu-title">Add users</span>
                </a>
              </li>
              <li class="site-menu-item <?php if(($this->uri->segment(4)=="inactive")&&($this->uri->segment(2)=="users")){ echo "active"; }  ?>">
                <a class="animsition-link" href="<?php echo site_url("administrator/users/loadpage/inactive/"); ?>">
                  <span class="site-menu-title">Inactive users</span>
                </a>
              </li>

            </ul>
          </li>

          <li class="site-menu-item has-sub <?php
if($this->uri->segment(2)=="admins"){ echo "active open"; } 
				?>">
            <a href="javascript:void(0)">
              <i class="site-menu-icon md-palette" aria-hidden="true"></i>
              <span class="site-menu-title">System Admins</span>
              <span class="site-menu-arrow"></span>
            </a>
            <ul class="site-menu-sub">

              <li class="site-menu-item <?php if(($this->uri->segment(4)=="lists")&&($this->uri->segment(2)=="admins")){ echo "active"; }  ?>">
                <a class="animsition-link" href="<?php echo site_url("administrator/admins/loadpage/lists/"); ?>">
                  <span class="site-menu-title">Admin lists</span>
                </a>
              </li>
              <li class="site-menu-item <?php if(($this->uri->segment(4)=="add")&&($this->uri->segment(2)=="admins")){ echo "active"; }  ?>">
                <a class="animsition-link" href="<?php echo site_url("administrator/admins/loadpage/add/"); ?>">
                  <span class="site-menu-title">Add admin</span>
                </a>
              </li>
              <li class="site-menu-item <?php if(($this->uri->segment(4)=="inactive")&&($this->uri->segment(2)=="admins")){ echo "active"; }  ?>">
                <a class="animsition-link" href="<?php echo site_url("administrator/admins/loadpage/inactive/"); ?>">
                  <span class="site-menu-title">Inactive admin</span>
                </a>
              </li>

            </ul>
          </li>



            <li class="site-menu-item <?php
if($this->uri->segment(2)=="system"){ echo "active open"; } 
				?>">
              <a class="animsition-link" href="<?php echo site_url("administrator/system/setting/"); ?>">
                <i class="icon fa-gear" aria-hidden="true"></i>
                <span class="site-menu-title">System Setting</span>
                <div class="site-menu-label">
                  <span class="label label-danger label-round">Restricted</span>
                </div>
              </a>
            </li>
            <li class="site-menu-item <?php
if($this->uri->segment(2)=="nav"){ echo "active open"; } 
				?>">
              <a class="animsition-link" href="<?php echo site_url("administrator/nav/section/"); ?>">
                <i class="icon fa-gear" aria-hidden="true"></i>
                <span class="site-menu-title ">System Navigation</span>
                <div class="site-menu-label">
                  <span class="label label-danger label-round">Restricted</span>
                </div>
              </a>
            </li>
            <?php
      }
        ?>

          </ul>

        </div>
      </div>
    </div>
    <div class="site-menubar-footer">
      <a href="<?php echo site_url("administrator/user/setting/"); ?>" class="fold-show" data-placement="top" data-toggle="tooltip"
      data-original-title="Settings">
        <span class="icon md-settings" aria-hidden="true"></span>
      </a>
      <a href="javascript: void(0);" data-placement="top"  >

      </a>
      <a href="<?php echo site_url("administrator/login/logout/"); ?>" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
        <span class="icon md-power" aria-hidden="true"></span>
      </a>
    </div>
  </div>
