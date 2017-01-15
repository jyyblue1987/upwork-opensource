

  <div class="page animsition">
    <div class="page-header">
      <?php



     class page{
     public $name;
     public $id;
     function __construct($name,$id,$title){
     $this->name=$name;
     $this->id=$id;
     $this->title=$title;
     }
     }
	 
     class section{
     public $name;
     public $id;
     function __construct($id,$title){
     $this->id=$id;
     $this->title=$title;
     }
     }
     class userpermission{
     function sectiona($id,$pid,$db){


	 $db->select('id');
      $db->from('usersectionaccess');
      $db->where('user', $id);
      $db->where('section', $pid);
      $query = $db->get();
     if($query -> num_rows() > 0)
     {
     echo "checked=\"checked\"";
     return true;
     }else{
     return false;
     }
     }
     function pagea($id,$pid,$db){
      $db->select('id');
      $db->from('userpageaccess');
      $db->where('user', $id);
      $db->where('page', $pid);
      $query = $db->get();
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
      $query = $db->get();
     if($query -> num_rows() > 0)
     {
     echo "checked=\"checked\"";
     }
     }


     function getname($id,$db){
      $db->select('name');
      $db->from('user');
      $db->where('id', $id);
      $db->limit(1);
      $query = $this -> db -> get();
      $rowx=$query->result();
     return $rowx->name;
     }

     function subpage($id,$db){



      $db->select('id,subpage,name');
      $db->from('usersubpage');

      $db->where('page', $id);
      $db->order_by("ind", "asc");

      $query = $db->get();



     $postarr=array();
     foreach ($query->result() as $value) {
     $mypost=new page($value->subpage,$value->id,$value->name);
     array_push($postarr,$mypost);
     }


     return $postarr;
     }
     function page($id,$db){

      $db->select('id,page,name');
      $db->from('userpage');
      $db->where('section', $id);
      $db->order_by("ind", "asc");

      $query = $db->get();


     $postarr=array();
     foreach ($query->result() as $value) {
     $mypost=new page($value->page,$value->id,$value->name);
     array_push($postarr,$mypost);
     }

     return $postarr;

     }

     function section($db){

      $db->select('id,name');
      $db->from('usersection');
      $db->order_by("ind", "asc");

      $query = $db->get();


     $postarr=array();
     foreach ($query->result() as $value) {
     $mypost=new section($value->id,$value->name);
     array_push($postarr,$mypost);
     }

     return $postarr;

     }


     }

     $per=new userpermission;


     ?>




     	     <div class="panel">
             <div class="panel-body container-fluid">
               <div class="row row-lg">


     			  <form class="form-horizontal cmxform" id="validateForm" method="post" action="<?php echo site_url("administrator/users/loadpage/updateuserpermission?id=".$_GET['id']); ?>" autocomplete="off">

     			  <div class="col-lg-12">
                   <!-- Example Table Selectable -->
                   <div class="example-wrap">
                     <h4 class="example-title">User Permissions of <?php echo $this->Adminforms->getdata("name","user",$_GET['id']); ?></h4>
                     <div class="example">






     				 <?php
     		  $id=$_GET['id'];
			  
			  
     $sec=$per->section($this->db);

     		  foreach($sec as $slst){
				  
     echo '  <div>';
					
                                 
			  echo  '<div style="width:50px;height: 40px;float:left;"><span class="checkbox-custom checkbox-primary"><input  name="sectionlm'.$slst->id.'" onclick="openhide('.$slst->id.');"  type="checkbox" class="checkallx" ';
     							$nextsec=$per->sectiona($id,$slst->id,$this->db);
     							echo '/>';
				echo  ' <label> </label></span>	</div>	
				<div style="float:left;height: 40px;line-height: 30px;">
                             <b>'.$slst->title.'</b>
                             </div>	
				<div style="clear:both;"></div>	
                           
						 <section id="tbody'.$slst->id.'" style="margin-left:50px;';
						 
	  if($nextsec==true){

     			  }else{
     		 echo 'display:none;';
     			  }
			echo '">';
							 
							 
							 
							 
     $s=$per->page($slst->id,$this->db);

     		  foreach($s as $lst){

     echo '  <table class="table table-hover" data-selectable="selectable" data-row-selectable="true">
                         <thead>
                           <tr>
                             <th class="width-50">
                               <span class="checkbox-custom checkbox-primary">
                                 <input  name="pagelm'.$lst->id.'"  type="checkbox" class="checkall" ';
     							$nextd=$per->pagea($id,$lst->id,$this->db);
     							echo '/>
                                 <label></label>
                               </span>
                             </th>
                             <th>
                               <br><b>'.$lst->title."</b>  - <span><a style=\"color:#006ac1;font-size:10px;cursor:pointer;text-decoration:none;\" onclick=\"selectall(".$lst->id.")\"> Mark All </a> | <a style=\"color:#006ac1;font-size:10px;cursor:pointer;text-decoration:none;\"  onclick=\"unselectall(".$lst->id.")\" > Unmark All </a> </span>
                             </th>
                           </tr>
                         </thead>
                   <tbody";
				   echo ' id="spages'.$lst->id.'"';
     			  if($nextd==true){

     			  }else{
     				  echo ' class="hidemesoon"';
     			  }
     			  echo ">";


     $p=$per->subpage($lst->id,$this->db);










     foreach($p as $pst){
     echo '<td>
                               <span class="checkbox-custom checkbox-primary">
                          <input name="subpagelm'.$pst->id.'" type="checkbox"';
     $per->spagea($id,$pst->id,$this->db);
     echo ' />  <label for="row-619"></label>
                               </span>
                             </td>
                             <td>'.$pst->title.'</td>
                             </tr>';
     }
     echo "
                         </tbody>
                     </table>
     ";
     }
							 
							 
							 
							 
							 
				    echo "
					
					</section>
					</div>
     ";
						 
				  
			  }
     		  ?>

                     </div>
                   </div>

     			  <?php
     				  echo $this->Adminforms->submitform();

     			?></form>
                   <!-- End Example Table Selectable -->
                 </div>
               </div>
             </div>
             </div>



            </div>
            </div>

















            <script type="text/javascript">
            if(jQuery('.checkall').length > 0) {
            		jQuery('.checkall').click(function(){
            			var parentTable = jQuery(this).parents('table');
            			var ch = parentTable.find('tbody input[type=checkbox]');
            			var chb = parentTable.find('tbody');
            			if(jQuery(this).is(':checked')) {

            				//check all rows in table

            				chb.each(function(){

            					jQuery(this).show();
            				});


            			} else {

            				//uncheck all rows in table
            				ch.each(function(){
            					jQuery(this).attr('checked',false);
            					jQuery(this).parent().removeClass('checked');	//used for the custom checkbox style
            					jQuery(this).parents('tr').removeClass('selected');
            				});
            				chb.each(function(){

            					jQuery(this).hide();
            				});


            			}
            		});
            	}
				
				function openhide(idof){
					if(jQuery("section#tbody"+idof).css("display") == "none"){
            					jQuery("section#tbody"+idof).show();
					}else{
            					jQuery("section#tbody"+idof).hide();
					}
				}

            $('#cancelus').click(function() {
                window.location.href = './';
                return false;
            });
            $().ready(function() {
            $('.hidemesoon').hide();
            });

			
			function selectall(sval){
				
            			var ch = $('tbody#spages'+sval+' input[type=checkbox]');
					ch.each(function(){
            					jQuery(this).attr('checked',true);
            					jQuery(this).parent().addClass('checked');	//used for the custom checkbox style
            					jQuery(this).parents('tr').addClass('selected'); // to highlight row as selected
            				});
            	
			}
			function unselectall(sval){
				
            			var ch = $('tbody#spages'+sval+' input[type=checkbox]');
					ch.each(function(){
            					jQuery(this).attr('checked',false);
            					jQuery(this).parent().removeClass('checked');	//used for the custom checkbox style
            					jQuery(this).parents('tr').removeClass('selected'); // to highlight row as selected
            				});
            	
			}
            if(jQuery('.selectall').length > 0) {
            		jQuery('.selectall').click(function(){
            			var parentTable = jQuery(this).parents('table');
            			var ch = parentTable.find('tbody input[type=checkbox]');
            			var chb = parentTable.find('tbody');
            		ch.each(function(){
            					jQuery(this).attr('checked',true);
            					jQuery(this).parent().addClass('checked');	//used for the custom checkbox style
            					jQuery(this).parents('tr').addClass('selected'); // to highlight row as selected
            				});
            		});
            	}
            	if(jQuery('.unselectall').length > 0) {
            		jQuery('.unselectall').click(function(){
            			var parentTable = jQuery(this).parents('table');
            			var ch = parentTable.find('tbody input[type=checkbox]');
            			var chb = parentTable.find('tbody');
            		ch.each(function(){
            					jQuery(this).attr('checked',false);
            					jQuery(this).parent().removeClass('checked');	//used for the custom checkbox style
            					jQuery(this).parents('tr').removeClass('selected');
            				});
            		});
            	}
            </script>
            <?php
            /*******

            	ch.each(function(){
            					jQuery(this).attr('checked',true);
            					jQuery(this).parent().addClass('checked');	//used for the custom checkbox style
            					jQuery(this).parents('tr').addClass('selected'); // to highlight row as selected
            				});

            *****/
            ?>
