

  <div class="page animsition">
    <div class="page-header">





		    <form class="form-horizontal" id="exampleStandardForm" method="post" action="<?php echo site_url('administrator/userpage/loadpage/'.$loadpage.'/subpage/addcheck/'); ?>"  enctype="multipart/form-data" autocomplete="off">

      <div class="row">




        <div class="col-md-6">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Package</h3>
            </div>
            <div class="panel-body">


<?php


	echo $this->Adminforms->inputtext("Package Name","packages_name","Enter Name","",1);
	echo $this->Adminforms->inputtext("Package Index","packages_index","Enter Index","",1);
	

	

?>




       


            </div>
          </div>

          </div>



		  
        <div class="col-md-6">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">User count</h3>
            </div>
            <div class="panel-body">

					<?php
			$limun = array(
   array('1','Limited'),
   array('2','Unlimited'),
);
 echo $this->Adminforms->selectgrpb("User count","packages_unlimiteduser",$limun,"",true,"User count","showhidesysuser(this.value);");
			  	?><div id="sysuserq"><?php 
			  
	echo $this->Adminforms->inputtextnr("User count","packages_user","Enter quantity","",1,"");

	?></div>
	
	
	

            </div>
          </div>

          </div>

		  
		  

        <div class="col-md-6">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $title; ?></h3>
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
              <?php

	echo $this->Adminforms->inputpricenr("Monthly payment","packages_pricequter","Monthly payment","",1);
echo $this->Adminforms->inputpricenr("Yearly payment","packages_priceyear","Yearly payment","",1);
echo $this->Adminforms->inputpricenr("Yearly paymentupgrade","packages_priceyearupgrade","Yearly payment Upgrade","",1);





			  echo $this->Adminforms->submit($title);

			  ?>
            </div>
          </div>

          </div>







          </div>


              </form>

          </div>







          </div>
		  
		  
		  <script>
		  
		  function showhideinvite(val){
			  if(val==2){
				  $("#inviteq").hide();
			  }else{
				  $("#inviteq").show();
				  
			  }
		  }
		  function showhidecountry(val){
			  if(val==2){
				  $("#countryq").hide();
			  }else{
				  $("#countryq").show();
				  
			  }
		  }
		  function showhidesysuser(val){
			  if(val==2){
				  $("#sysuserq").hide();
			  }else{
				  $("#sysuserq").show();
				  
			  }
		  }
		  function showhidenews(val){
			  if(val==1){
				  $("#newslaterq").hide();
			  }else{
				  $("#newslaterq").show();
				  
			  }
		  }
		  function showhidecusin(val){
			  if(val==2){
				  $("#cusinq").show();
			  }else{
				  $("#cusinq").hide();
				  
			  }
		  }
		  function countrefundinq(){
			  unlimitedinvite=$("select#packages_unlimitedinvite").val();
			  cost=0;
			  if(unlimitedinvite==2){
				   cost=0;
					  	  $("input#packages_refundinviteq").val(cost);
				  counttotal();
				  
				   	  return;
				  
			  }else{
				  
				  if(Number($("input#packages_inviteq").val())==0){
				toastr["error"]("write total invites (quaterly)");
	  return;
				  }
				  if(Number($("input#packages_invitepriceq").val())==0){
				toastr["error"]("write total invite cost(monthly)");
	  return;
				  }
				  
			  cost=Number($("input#packages_invitepriceq").val())/Number($("input#packages_inviteq").val());
				  $("input#packages_refundinviteq").val(cost.toFixed(2));
				  counttotal();
				  
				  
				  
			  }
		  }
		  function countrefundiny(){
			  unlimitedinvite=$("select#packages_unlimitedinvite").val();
			  cost=0;
			  if(unlimitedinvite==2){
				   cost=0;
					  	  $("input#packages_refundinvitey").val(cost);
				  counttotal();
				  
				   	  return;
			  }else{
		
				  if(Number($("input#packages_invitey").val())==0){
				toastr["error"]("write total invites (yearly)");
	  return;
				  }
				  if(Number($("input#packages_invitepricey").val())==0){
				toastr["error"]("write total invite cost(yearly)");
	  return;
				  }
				  
			  cost=Number($("input#packages_invitepricey").val())/Number($("input#packages_invitey").val());
				  $("input#packages_refundinvitey").val(cost.toFixed(2));
				  
				  counttotal();
				  
			  }
		  }
		  
		  
		  
		  
		  	  
		  function showhidefeature(val){
			  if(val==2){
				  $("#featureq").hide();
			  }else{
				  $("#featureq").show();
				  
			  }
		  }
		  function countfrefundinq(){
			  unlimitedfeature=$("select#packages_unlimitedfeature").val();
			  
			  cost=0;
			  if(unlimitedfeature==2){
				   cost=0;
					  	  $("input#packages_refundfeatureq").val(cost);
				  counttotal();
				  
				   	  return;
			  }else{
				  
				  if(Number($("input#packages_featureq").val())==0){
				toastr["error"]("write total features (quaterly)");
	  return;
				  }
				  if(Number($("input#packages_featurepriceq").val())==0){
				toastr["error"]("write total feature cost(monthly)");
	  return;
				  }
				  
			  cost=Number($("input#packages_featurepriceq").val())/Number($("input#packages_featureq").val());
				  $("input#packages_refundfeatureq").val(cost.toFixed(2));
				  
				  counttotal();
				  
				  
				  
			  }
		  }
		  function countfrefundiny(){
			  unlimitedfeature=$("select#packages_unlimitedfeature").val();
			  cost=0;
			  if(unlimitedfeature==2){
				   cost=0;	
					  	  $("input#packages_refundfeaturey").val(cost);
				  counttotal();
				  
				   return;
			  }else{
		
				  if(Number($("input#packages_featurey").val())==0){
				toastr["error"]("write total features (yearly)");
	  return;
				  }
				  if(Number($("input#packages_featurepricey").val())==0){
				toastr["error"]("write total feature cost(yearly)");
	  return;
				  }
			  cost=Number($("input#packages_featurepricey").val())/Number($("input#packages_featurey").val());
				  
				  $("input#packages_refundfeaturey").val(cost.toFixed(2));
				  counttotal();
				  
				  
				  
			  }
		  }
		  function countserviceq(){
			  cost=Number($("input#packages_serviceq").val())/92;
				  $("input#packages_refundperdayq").val(cost.toFixed(2));
				  counttotal();
				  
				  
		  }
		  function countservicey(){
			  cost=Number($("input#packages_servicey").val())/365;
				  $("input#packages_refundperdayy").val(cost.toFixed(2));
				  
				  counttotal();
				  
		  }
		  
		  
		  function counttotal(){
			  counttotalq=Number($("input#packages_invitepriceq").val())+Number($("input#packages_featurepriceq").val())+Number($("input#packages_serviceq").val());
			  counttotaly=Number($("input#packages_invitepricey").val())+Number($("input#packages_featurepricey").val())+Number($("input#packages_servicey").val());
			  counttotalyu=counttotalq*3;
			  
				  $("input#packages_pricequter").val(counttotalq.toFixed(2));
				  $("input#packages_priceyearupgrade").val(counttotalyu.toFixed(2));
				  $("input#packages_priceyear").val(counttotaly.toFixed(2));
				  
				  
		  }
		  
		  </script>
