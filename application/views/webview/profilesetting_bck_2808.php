	
<section id="big_header" style="margin-bottom:50px;height: auto;"> 
    <div class="container" style="border-left:2px solid #e6e7e7;border-right:2px solid #e6e7e7;border-bottom:2px solid #e6e7e7;">
	<div class="row"> 
    <div class="col-xs-12 col-sm-5 col-md-5">
	
   
  
   <div class="left">
   <h1> Personal Setting   </h1>
   </div>
    <div class="line1">  </div>
    <div class="margin">
	
	 </div>
   
   	<div class="columns" style="
    margin: 50px;">
  <ul class="price">
    <div class="heeed faqopen" id="faq1" onclick="faqselect(1);">My Account <i class="fa fa-angle-down" id="faqicon1" aria-hidden="true" style="float:right;"></i></div>
	<div class="faqa" id="faqa1" style="display: block;">
    		<div class="grey">Personal Info</div>
    		<?php 
    		 if ($this->session->userdata('type') != '1')
		        {
		            ?>
	 	<div class="grey">Contact Address</div>	
	 	  <?php
		        }
		            ?>
	  	<div class="grey">Manage Account</div>
	  </div>
	  
	  <div class="heeed" id="faq2" onclick="faqselect(2);">My Profile  <i class="fa fa-angle-right" id="faqicon2" aria-hidden="true" style="float:right;"></i></div>
	  	<div class="faqa" id="faqa2" style="display: none;">
                    <div class="grey"><a href="<?php echo site_url("/profile/basic"); ?>">Basic Profile</a></div>
	 <div class="grey"><a href="<?php echo site_url("/profile/basic_bio"); ?>">Professional Bio</a></div>
	   <div class="grey"><a href="<?php echo site_url("categories/choose"); ?>">Manage Category</a></div>
          <div class="grey"><a href="<?php echo site_url("/profile/my-freelancer-profile"); ?>">View My Profile</a></div>
	  </div>
	  
	  
	  <div class="heeed" id="faq3" onclick="faqselect(3);">Financial Account  <i class="fa fa-angle-right" id="faqicon3" aria-hidden="true" style="float:right;"></i></div>
	  	<div class="faqa" id="faqa3" style="display: none;">
    <div class="grey">TAX Information</div>
	 <div class="grey"><a href="<?php echo site_url("payment-methods"); ?>">Payment Methods</a></div>
	  <div class="grey">Manage Account</div>
	  </div>
	  
	  <div class="heeed" id="faq4" onclick="faqselect(4);">Security Settings  <i class="fa fa-angle-right" id="faqicon4" aria-hidden="true" style="float:right;"></i></div>
	  	<div class="faqa" id="faqa4" style="display: none;">
    <div class="grey"><a href="<?php echo site_url("changepassword"); ?>">Change Password</a></div>
        <div class="grey"><a href="<?php echo site_url("changeemail"); ?>">Change Email</a></div>        
	  <div class="grey">Manage Account</div>
	  </div>
	  
  
  </ul>
</div>

   </div>
   
    <div class="col-xs-12 col-sm-7 col-md-7">
	<div class="main">
	<div class="left1">
	<h2>My Account &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i>
	 </h2>
	</div>
  
  
   
	<div class="left2">
	<h3>Personal Info  </h3>
	</div>
 
  
   
    
	<div class="left3">
	<h4 onclick="openprofileedit();" style="cursor:pointer;">Edit</h4>
	</div>
	</div>
	<div class="margin2">
	
	</div>
	
	<div class="fffaa">
	<div class="fas">
	<h2>Picture </h2>
	</div>
	<div class="img">
	<?php if($this->Adminforms->getdatax("picture","webuser",$id)==""){ ?>
	<img src="<?php echo site_url("assets/user.png"); ?>" width="100px">
	<?php }else{ ?>
	<img src="<?php echo site_url($this->Adminforms->getdatax("picture","webuser",$id)); ?>" width="100px">
	<?php	
	} ?>
	</div>
	
	
	<div class="but1">
	<a href="<?php echo site_url("changepic"); ?>" class="btn btn-primary"> Change   </a>
	
	</div>
	</div>
	
	<div class="fffdd">
		<div id="editon"  style="display:none;">
			<div class="row" style="margin:5px auto;">
				<div class="col-xs-3">
				 	<span>First name</span>
				 </div>
				<div class="col-xs-9">
		  			<input type="text" id="infname" value="<?php echo $this->Adminforms->getdatax("fname","webuser",$id); ?>"><br>
		  
		 		</div>
		 	</div>
			<div class="row" style="margin:5px auto;">
		 
				<div class="col-xs-3">
			 		<span>Last name</span>
			 	</div>
				<div class="col-xs-9">
			  		<input type="text" id="inlname" value="<?php echo $this->Adminforms->getdatax("lname","webuser",$id); ?>"><br>
			 	</div>
		 
		 	</div>
		 	<div class="row" style="margin:5px auto;">
	 
				<div class="col-xs-3">
			 		<span>Username</span>
			 	</div>
				<div class="col-xs-9">
					<span id="xinfname"><?php echo $this->Adminforms->getdatax("username","webuser",$id); ?></span>
			  
			 	</div>
		 
		 	</div>
		 	<div class="row" style="margin:5px auto;">
				<div class="col-xs-3">
				 	<span>Email</span>
				 </div>
				<div class="col-xs-9">
		  			<?php echo $this->Adminforms->getdatax("email","webuser",$id); ?>
		  
		 		</div>
		 	</div>
		 	 <?php
		        if ($this->session->userdata('type') == '1')
		        {
		            ?>
			        <div class="row" style="margin:5px auto;">
					<div class="col-xs-3">
					 	<span>Company name</span>
					 </div>
					<div class="col-xs-9">
			  			<input type="text" id="usercompany" value="<?php echo $this->Adminforms->getdatax("company","webuser",$id); ?>"><br>
			  
			 		</div>
			 	</div>
			 	<div class="row" style="margin:5px auto;">
					<div class="col-xs-3">
					 	<span>Title</span>
					 </div>
					<div class="col-xs-9">
			  			<input type="text" id="usertitle" value="<?php echo $this->Adminforms->getdatax("title","webuser",$id); ?>"><br>
			  
			 		</div>
			 	</div>
			 	<div class="row" style="margin:5px auto;">
					<div class="col-xs-3">
					 	<span>Website</span>
					 </div>
					<div class="col-xs-9">
			  			<input type="text" id="usersite" value="<?php echo $this->Adminforms->getdatax("site","webuser",$id); ?>"><br>
			  
			 		</div>
			 	</div>
			 	<div class="row" style="margin:5px auto;">
					<div class="col-xs-3">
					 	<span>VAT ID</span>
					 </div>
					<div class="col-xs-9">
			  			<input type="text" id="uservat" value="<?php echo $this->Adminforms->getdatax("resetexpire","webuser",$id); ?>"><br>
			  
			 		</div>
			 	</div>    
		        <?php
		        }
		            ?>
		            
	 	</div>
 
 
		<div id="editcancel">
			<div class="row" style="margin:5px auto;">
		 
				<div class="col-xs-3">
					 <span>Name</span>
				 </div>
				<div class="col-xs-9">
					<span id="xinffname"><?php echo $this->Adminforms->getdatax("fname","webuser",$id); ?> </span>
					<span id="xinflname"><?php echo $this->Adminforms->getdatax("lname","webuser",$id); ?> </span>
			 	</div>
		 	</div>
		 	<div class="row" style="margin:5px auto;">
	 
				<div class="col-xs-3">
			 		<span>Username</span>
			 	</div>
				<div class="col-xs-9">
					<?php echo $this->Adminforms->getdatax("username","webuser",$id); ?>
			  
			 	</div>
		 
		 	</div>
	 
	 
			<div class="row" style="margin:5px auto;">
	 
				<div class="col-xs-3">
	 				<span>Email</span>
	 			</div>
				<div class="col-xs-9">
					<?php echo $this->Adminforms->getdatax("email","webuser",$id); ?>
	 			</div>
	 
	 		</div>
	 		 <?php
	 		 if ($this->session->userdata('type') == '1')
		        {
		            ?>
			        <div class="row" style="margin:5px auto;">
		 
					<div class="col-xs-3">
		 				<span>Company Name</span>
		 			</div>
					<div class="col-xs-9">
						<span id="xincompany"><?php echo $this->Adminforms->getdatax("company","webuser",$id); ?></span>
		  
		 			</div>
		 
		 		</div>
		 		<div class="row" style="margin:5px auto;">
		 
					<div class="col-xs-3">
		 				<span>Title   </span>
		 			</div>
					<div class="col-xs-9">
						<span id="xintitle"><?php echo $this->Adminforms->getdatax("title","webuser",$id); ?></span>
		  
		 			</div>
		 
		 		</div>
		 		<div class="row" style="margin:5px auto;">
		 
					<div class="col-xs-3">
		 				<span>Website</span>
		 			</div>
					<div class="col-xs-9">
						<span id="xinsite"><?php echo $this->Adminforms->getdatax("site","webuser",$id); ?></span>
		  
		 			</div>
		 
		 		</div>
		 		<div class="row" style="margin:5px auto;">
		 
					<div class="col-xs-3">
		 				<span>VAT ID  </span>
		 			</div>
					<div class="col-xs-9">
						<span id="xinvat"><?php echo $this->Adminforms->getdatax("resetexpire","webuser",$id); ?></span>
		  
		 			</div>
		 
		 		</div>
		        <?php
		        }
		        ?>
		</div>
 
		
 
	</div>
	<div id="editonb" style="display:none;">
		<div class="but2">
			<button onclick="updatename();"> Update  </button>
			<span  onclick="cancelprofileedit()" style="color:#1ea7da;padding-left:20px;cursor:pointer;">Cancel</span>
		</div>
	</div>
	
	
</div>
	<div class="mide">
	
	</div>
	
	 <div class="col-xs-12 col-sm-7 col-md-7">
	<div class="fffdde">
	<div class="row">
	<div class="abc">
	<h2>   Company Address   </h2>
	
	</div>
	<div class="abd">
	<h3 onclick="openaddressedit();" style="cursor:pointer;">   Edit  </h3>
	</div>
	</div>
	<div class="abe"  id="editonabe" style="display: none;" >

	<div class="row" style="margin:5px auto;">
 
		<div class="col-xs-4">
		 	<span>  Address</span>	
		 </div>
		 <div class="col-xs-8">
		  	<input type="text" id="address-first" name="firstname" value=""><br>
		  	<input type="text" id="address-second" name="lastname" value="" style="margin-top:0px;">
	  	</div>
	</div>
 
	<div class="row" style="margin:5px auto;">
		<div class="col-xs-4">
			<span>  City / Town</span>	
		</div>
		<div class="col-xs-8">
	 
		  	<input type="text" id="city-town" name="firstname" value="">  	
	  	</div>
	</div>
		
		
	 
	<div class="row" style="margin:5px auto;">
		<div class="col-xs-4">
 			<span> State / Province</span>	
 		</div>
 		<div class="col-xs-8">
	 	 	<input type="text" id="state-province" name="firstname" value="">
	   	</div>
	</div>
		
		
	<div class="row" style="margin:5px auto;">
		<div class="col-xs-4">
 			<span> Zip / Postal Code</span>	
 		</div>
 		<div class="col-xs-8">
	  		<input type="text" id="zip-postalcode" name="firstname" value="">
	   	</div>	
	   </div>
	
	
	<div class="row" style="margin:5px auto;">
		<div class="col-xs-4">
 			<span> Country</span>	
 		</div>
 		<div class="col-xs-8">
                    <select name="counry" class="select form-control">
                        <option value="">Select Country</option>
                    <?php
                       if(isset($countryList) && is_array($countryList) && !empty($countryList)){
                           foreach ($countryList as $country) {
                               if($country['country_id'] == $this->session->userdata('webuser_country')){
                                   $selected = "selected = selected";
                               }else{
                                   $selected = "";
                               }
                             ?>
                        <option <?php echo $selected?> value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                        <?php
                           }
                       }
                    ?>
                    </select>
	   	</div>
	</div>
	
  

	<div class="row" style="margin:5px auto;">
		<div class="col-xs-4">
 			<span> Phone</span>	
 		</div>
 		<div class="col-xs-8">
  			<input type="text" id="phonecode" name="lastname" value="" style="width:70px;margin-top:0px;margin-right:25px;">

  			<input type="text" id="phonenumber" name="lastname" value="" style="width:240px;margin-top:0px;margin-left:0px;">	   	
  		</div>
	</div>

	<div class="row" style="margin:5px auto;">
		<div class="col-xs-4">
 			<span> Time zone</span>	
 		</div>
 		<div class="col-xs-8">
  			<input type="text" id="time-zone" name="firstname" value="" style="color:#22a7d9;">     	
  		</div>
	</div>
 
 <div class="but2">
	<button onclick="updatecontactaddress()" style="margin-top:20px;"> Update  </button>
<span onclick="canceladdressedit()" style="color:#1ea7da;padding-left:20px;cursor:pointer;">Cancel </span>
	</div>
	
	
	</div>
	<div class="abf"  id="editcancelabe" style="" >
	
	<div style="margin:5px auto;" class="row">
 
		<div class="col-xs-4">
			 <span>  Address</span>	
		</div>
		<div class="col-xs-8">
			<span id="adress"><?php echo $this->Adminforms->getdataaddress("address","webuseraddresses",$id).$this->Adminforms->getdataaddress("address1","webuseraddresses",$id); ?> </span>
		</div>
	
	</div>
	

	

	
	<div style="margin:5px auto;" class="row">
 
		<div class="col-xs-4">
			 <span></span>	
		</div>
		<div class="col-xs-8">
			<span id="city"><?php echo $this->Adminforms->getdataaddress("city","webuseraddresses",$id); ?> </span>
		</div>
	
	</div>
	
	<div style="margin:5px auto;" class="row">
 
		<div class="col-xs-4">
			 <span>  </span>	
		</div>
		<div class="col-xs-8">
			<span id="state"><?php echo $this->Adminforms->getdataaddress("state","webuseraddresses",$id).' '.$this->Adminforms->getdataaddress("zipcode","webuseraddresses",$id); ?> </span>
		</div>
	
	</div>
	
	<div style="margin:5px auto;" class="row">
 
		<div class="col-xs-4">
			 <span> </span>	
		</div>
		<div class="col-xs-8">
			<span id="country"><?php echo $this->Adminforms->getdataaddress("country","webuseraddresses",$id); ?> </span>
		</div>
	
	</div>
	
	<div style="margin:5px auto;" class="row">
 
		<div class="col-xs-4">
			 <span>  Phone</span>	
		</div>
		<div class="col-xs-8">
			<span id="phone"><?php echo $this->Adminforms->getdataaddress("phone_number","webuseraddresses",$id); ?> </span>
		</div>
	
	</div>
	
	<div style="margin:5px auto;" class="row">
 
		<div class="col-xs-4">
			 <span>  Time zone</span>	
		</div>
		<div class="col-xs-8">
			<span id="timezone"><?php echo $this->Adminforms->getdataaddress("timezone","webuseraddresses",$id); ?> </span>
		</div>
	
	</div>
	</div>
	
	
	
	</div>
	</div>
	
	
	
 </div>
  </div>
	  
		
</section><!-- big_header-->


<script>

function faqselect(num){
	if($("#faq"+num).hasClass("faqopen")){
		
	$("#faq"+num).removeClass("faqopen");
	$("#faqicon"+num).removeClass("fa-angle-down");
	$("#faqicon"+num).addClass("fa-angle-right");
    $("#faqa"+num).slideUp( "fast" );
		
	}else{
	$("#faq"+num).addClass("faqopen");
	$("#faqicon"+num).removeClass("fa-angle-right");
	$("#faqicon"+num).addClass("fa-angle-down");
    $("#faqa"+num).slideDown( "fast" );
	}
	
}

function openaddressedit(){
	
	$("#editcancelabe").hide();
	$("#editonabe").show();

	
}
function canceladdressedit(){
	$("#editcancelabe").show();
	$("#editonabe").hide();
	
}
function openprofileedit(){
	
	$("#editcancel").hide();
	$("#editon").show();
	$("#editonb").show();
	
}
function cancelprofileedit(){
	
	$("#editon").hide();
	$("#editonb").hide();
	$("#editcancel").show();
	
}


function updatename(){
	var fname=$("#infname").val();
	var lname=$("#inlname").val();
	if($('#usercompany').is(':visible'))
	{
		var usercompany=$("#usercompany").val();
		var usertitle=$("#usertitle").val();
		var uservat=$("#uservat").val();
		var usersite=$("#usersite").val();
		jQuery.ajax({
                type: "POST",
                url: siteurl+"json/api/type/regapi/page/updatename",
                data: 'fname=' + fname + '&lname=' + lname+ '&usercompany=' + usercompany+ '&usertitle=' + usertitle+ '&usersite=' + usersite+ '&uservat=' + uservat+ '&v_check=' + 1,
                success: function (_d) {
			if(_d.status=="success")
			
			{
				$("#xinfname").html(fname);
				$("#xinlname").html(lname);
				$("#xincompany").html(usercompany);	
				$("#xintitle").html(usertitle);
				$("#xinvat").html(uservat);	
				$("#xinsite").html(usersite);				
				cancelprofileedit();
	
			}else{
					
				alert("Something Went Wrong");
					
			}
				
                }
    		}).fail(function (_d) {
           
    		});
	}
	else
	{

	

jQuery.ajax({
                type: "POST",
                url: siteurl+"json/api/type/regapi/page/updatename",
                data: 'fname=' + fname + '&lname=' + lname + '&v_check=' + 2,
                success: function (_d) {
			if(_d.status=="success"){
				$("#xinffname").html(fname);
				$("#xinflname").html(lname);			
				cancelprofileedit();
	
			}else{
					
		alert("Something Went Wrong");
					
				}
				
                }
    }).fail(function (_d) {
           
    });
	
	}
}

function updatecontactaddress(){
	var addressfirst = $("#address-first").val();
	var addresssecond = $("#address-second").val();
	var citytown = $("#city-town").val();
	var stateprovince = $("#state-province").val();
	var zippostalcode = $("#zip-postalcode").val();
	var country = $('#country_sel').val();
	var phonecode = $("#phonecode").val();
	var phonenumber = $("#phonenumber").val();
	var timezone = $("#time-zone").val();


jQuery.ajax({
                type: "POST",
                url: siteurl+"json/api/type/regapi/page/updatecontactaddress",
                data: 'addressfirst=' + addressfirst + '&addresssecond=' + addresssecond + '&citytown=' + citytown + '&stateprovince=' + stateprovince + '&zippostalcode=' + zippostalcode + '&country=' + country + '&phonecode=' + phonecode + '&phonenumber=' + phonenumber + '&timezone=' + timezone,
                success: function (_d) {
				if(_d.status=="success"){
					$("#adress").html(addressfirst+addresssecond);
					$("#city").html(citytown );
					$("#state").html(stateprovince+', ' + zippostalcode  );
					$("#phone").html(phonecode+phonenumber );
					$("#country").html(country);
					$("#timezone").html(timezone);
					canceladdressedit();	
				}else{
					
alert("Something Went Wrong");
					
				}
				
                }
    }).fail(function (_d) {
           
    });
	
	
}
</script>
