<style type="text/css">
.change_btn-primary{background:#028cc9;color:#fff;}
.change_btn-primary:hover{background:#286090;}
</style>

<section id="big_header" style="margin-top:40px;margin-bottom:40px;height: auto;"> 
    <div class="container" >
    <div class="white-box" style="padding-top: 15px;margin-left: -8px;margin-right: 16px;border: 1px solid #ccc;">
        <div class="row"> 
            <div class="col-xs-12 col-sm-3 col-md-3 align-left">
                <?php 
                $data = array(
                    'current_active' => 'profile-settings'
                    ); 
                $this->load->view("webview/profile/freelancer-profile-left-sidebar",$data) ?>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 custom_profile_info"> 
                <div class="row title-line">
                    <div class="abc">
                        <h3>Personal Info  </h3> 
                    </div>
                    <div class="abd"> 
                        <h3 onclick="openprofileedit();" style="cursor:pointer;">Edit</h3>
                    </div>
                </div> 
                    <div class="row">   
                        <div style="margin-left: -14px;" class="col-md-12">  
        <div id="editon"  style="display:none;">
			<div class="row">
				<div class="col-xs-3">
				 	<span>First name</span>
				 </div>
				<div class="col-xs-9">
		  			<input type="text" id="infname" value="<?php echo $this->Adminforms->getdatax("fname","webuser",$id); ?>"><br>
		  
		 		</div>
		 	</div>
			<div class="row">
		 
				<div class="col-xs-3">
			 		<span>Last name</span>
			 	</div>
				<div class="col-xs-9">
			  		<input type="text" id="inlname" value="<?php echo $this->Adminforms->getdatax("lname","webuser",$id); ?>"><br>
			 	</div>
		 
		 	</div>
		 	<div class="row">
	 
				<div class="col-xs-3">
			 		<span>Username</span>
			 	</div>
				<div class="col-xs-9">
					<span style="margin-left: 11px;font-size: 17px;font-family: calibri;" id="xinfname"><?php echo $this->Adminforms->getdatax("username","webuser",$id); ?></span>
			  
			 	</div>
		 
		 	</div>
		 	<div class="row">
				<div class="col-xs-3">
				 	<span>Email</span>
				 </div>
				<div class="col-xs-9">
		  			<span style="margin-left: 11px;font-size: 17px;font-family: calibri;"><?php echo $this->Adminforms->getdatax("email","webuser",$id); ?></span>
		  
		 		</div>
		 	</div>
		 	 <?php
		        if ($this->session->userdata('type') == '1')
		        {
		            ?>
			        <div class="row">
					<div class="col-xs-3">
					 	<span>Company name</span>
					 </div>
					<div class="col-xs-9">
			  			<input type="text" id="usercompany" value="<?php echo $this->Adminforms->getdatax("company","webuser",$id); ?>"><br>
			  
			 		</div>
			 	</div>
			 	<div class="row">
					<div class="col-xs-3">
					 	<span>Title</span>
					 </div>
					<div class="col-xs-9">
			  			<input type="text" id="usertitle" value="<?php echo $this->Adminforms->getdatax("title","webuser",$id); ?>"><br>
			  
			 		</div>
			 	</div>
			 	<div class="row">
					<div class="col-xs-3">
					 	<span>Website</span>
					 </div>
					<div class="col-xs-9">
			  			<input type="text" id="usersite" value="<?php echo $this->Adminforms->getdatax("site","webuser",$id); ?>"><br>
			  
			 		</div>
			 	</div>
			 	<div class="row">
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
                                    <div class="row" >
                                        <div class="col-xs-2">
                                            <span>Picture</span>
                                        </div>
                                        <div style="margin-left: 70px;" class="col-xs-4">
                                            <?php if ($this->Adminforms->getdatax("picture", "webuser", $id) == "") { ?>
                                                <img style="border-radius: 86%;height: 100px;width: 100px;" src="<?php echo site_url("assets/user.png"); ?>" width="100px">
                                            <?php } else { ?>
                                                <img style="border-radius: 86%;height: 100px;width: 100px;" src="<?php echo site_url($this->Adminforms->getdatax("picture", "webuser", $id)); ?>" width="100px">
                                            <?php }
                                            ?>                                        
                                        </div>
                                        <div class="col-xs-4">
                                           <a style=" width: 100px;margin-top: 10px;" href="<?php echo site_url("changepic"); ?>" class="btn change_btn-primary btn-primary pull-left"> Change Picture</a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-xs-2" >
                                            <span>Name</span>
                                        </div>
                                        <div style="margin-left: 70px;" class="col-xs-4">
                                            <span style="font-size:17px;font-family: calibri;"  id="xinffname"><?php echo $this->Adminforms->getdatax("fname", "webuser", $id); ?> </span>
                                            <span style="font-size:17px;font-family: calibri;"  id="xinflname"><?php echo $this->Adminforms->getdatax("lname", "webuser", $id); ?> </span>
                                        </div>
                                        <div class="col-xs-6"> 
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="col-xs-2">
                                            <span>Username</span>
                                        </div>
                                        <div style="margin-left: 70px;" class="col-xs-4"  >
                                           <span style="font-size:17px;font-family: calibri;"> <?php echo $this->Adminforms->getdatax("username", "webuser", $id); ?> </span>
                                        </div>
                                         <div class="col-xs-6"> 
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="col-xs-2">
                                            <span>Email</span>
                                        </div>
                                        <div style="margin-left: 70px;" class="col-xs-4"  >
                                           <span style="font-size:17px;font-family: calibri;"> <?php echo $this->Adminforms->getdatax("email", "webuser", $id); ?> </span>
                                        </div>
                                         <div class="col-xs-6"> 
                                        </div>
                                    </div>
                                    <?php
                                    if ($this->session->userdata('type') == '1') {
                                        ?>
                                        <div class="row" >
                                            <div class="col-xs-2">
                                                <span>Company Name</span>
                                            </div>
                                            <div style="margin-left: 70px;" class="col-xs-4"  >
                                                <span style="font-size:14px;" id="xincompany"><?php echo $this->Adminforms->getdatax("company", "webuser", $id); ?></span>
                                            </div>
                                             <div class="col-xs-6"> 
                                        </div>
                                        </div>
                                        <div class="row" >
                                            <div class="col-xs-2">
                                                <span>Title</span>
                                            </div>
                                            <div style="margin-left: 70px;" class="col-xs-4" >
                                                <span style="font-size:14px;" id="xintitle"><?php echo $this->Adminforms->getdatax("title", "webuser", $id); ?></span>
                                            </div>
                                             <div class="col-xs-6"> 
                                        </div>
                                        </div>
                                        <div class="row" >
                                            <div class="col-xs-2">
                                                <span>Website</span>
                                            </div>
                                            <div style="margin-left: 70px;" class="col-xs-4"  >
                                                <span style="font-size:14px;" id="xinsite"><?php echo $this->Adminforms->getdatax("site", "webuser", $id); ?></span>
                                            </div>
                                             <div class="col-xs-6"> 
                                        </div>
                                        </div>
                                        <div class="row" >
                                            <div class="col-xs-2">
                                                <span>VAT ID  </span>
                                            </div>
                                            <div style="margin-left: 70px;" class="col-xs-4"  >
                                                <span style="font-size:14px;" id="xinvat"><?php echo $this->Adminforms->getdatax("resetexpire", "webuser", $id); ?></span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            
                        </div> 
                        
                    </div>     
              

                <div id="editonb" style="display:none;">
                    <div style="margin-top: 24px;margin-bottom: 30px;" class="">
                        <button style="float: left;margin-left: 173px;margin-top: -4px;" class="btn-primary big_mass_active transparent-btn big_mass_button" onclick="updatename();"> Update  </button>
                        <span style="color:#1ea7da;cursor:pointer;float:   ;margin-top: 20px;float: none;" class="btn-primary transparent-btn big_mass_button" onclick="cancelprofileedit()" style="color:#1ea7da;padding-left:20px;cursor:pointer;">Cancel</span>
                    </div>
                </div>
                <div class="fffdde">
                    <div style="margin-top: 20px;" class="row title-line">
                        <div class="abc">
                            <?php
                            if ($this->session->userdata('type') == '1') {
                                ?>
                                <h3>Company Address</h3>
                            <?php } else { ?>
                                <h3>Contact Details</h3>
                            <?php } ?>
                        </div>
                        <div class="abd">
                            <h3 onclick="openaddressedit();" style="cursor:pointer;">   Edit  </h3>
                        </div>
                    </div>
                    
                    <div class="abf"  id="editcancelabe" style="margin-left: -14px;">
                        <div  class="row">
                            <div class="col-xs-2">
                                <span>  Address</span>	
                            </div>
                            <div style="margin-left: 70px;" class="col-xs-8">
                                <span style="font-size:17px;font-family: calibri;" id="adress"><?php echo $this->Adminforms->getdataaddress("address", "webuseraddresses", $id); ?> </span>
                            </div>
                        </div>
                        <div  class="row">
                            <div class="col-xs-2">
                                <span> </span>	
                            </div>
                            <div style="margin-left: 70px;" class="col-xs-8">
                                <span style="font-size:17px;font-family: calibri;" id="adress"><?php echo $this->Adminforms->getdataaddress("address1", "webuseraddresses", $id); ?> </span>
                            </div>
                        </div>
                        <div  class="row">
                            <div class="col-xs-2">
                                <span></span>	
                            </div>
                            <div style="margin-left: 70px;" class="col-xs-8">
                                <span style="font-size:17px;font-family: calibri;" id="city"><?php echo $this->Adminforms->getdataaddress("city", "webuseraddresses", $id); ?> </span>
                            </div>
                        </div>

                        <div  class="row">

                            <div class="col-xs-2">
                                <span>  </span>	
                            </div>
                            <div style="margin-left: 70px;" class="col-xs-8">
                                <span style="font-size:17px;font-family: calibri;" id="state"><?php echo $this->Adminforms->getdataaddress("state", "webuseraddresses", $id) . ', ' . $this->Adminforms->getdataaddress("zipcode", "webuseraddresses", $id); ?> </span>
                            </div>

                        </div>

                        <div  class="row">

                            <div class="col-xs-2">
                                <span> </span>	
                            </div>
                            <div style="margin-left: 70px;" class="col-xs-8">
                                <span style="font-size:17px;font-family: calibri;" id="country"><?php echo $webuserCountry ?> </span>
                            </div>

                        </div>

                        <div  class="row">

                            <div class="col-xs-2">
                                <span>  Phone</span>	
                            </div>
                            <div style="margin-left: 70px;" class="col-xs-8">
                                <span style="font-size:17px;font-family: calibri;" id="phone"><?php echo $this->Adminforms->getdataaddress("phone_number", "webuseraddresses", $id); ?> </span>
                            </div>

                        </div>

                        <div  class="row">

                            <div class="col-xs-2">
                                <span>  Time zone</span>	
                            </div>
                            <div style="margin-left: 70px;" class="col-xs-8">
                                <span style="font-size:17px;font-family: calibri;" id="timezone"><?php echo !empty($timezone) ? '(' . $timezone['gmt'] . ') - ' . $timezone['name'] : '-' ?> </span>
                            </div>

                        </div>
                    </div>
<form name="" action="#" class="" method="POST">
                        <div class="abe" id="editonabe" style="display: none;margin-left: -14px;">
                            <div class="row">
                                <label class="col-md-3 col-xs-12">Address</label>
                                <div class="col-md-8 col-xs-12">
                                    <input placeholder="Type your address" style="width: 357px;" value="<?php if (isset($webuserContactDetails) && is_array($webuserContactDetails) && !empty($webuserContactDetails)) echo $webuserContactDetails['address'] ?>" required="" name="address1" type="text" class="form-control"/>
                                    <input placeholder="Type your address" value="<?php if (isset($webuserContactDetails) && is_array($webuserContactDetails) && !empty($webuserContactDetails)) echo $webuserContactDetails['address1'] ?>" name="address2" type="text2" class="form-control"/>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-xs-12">City / Town</label>
                                <div class="col-md-8 col-xs-12">
                                    <input placeholder="Type your city name" value="<?php if (isset($webuserContactDetails) && is_array($webuserContactDetails) && !empty($webuserContactDetails)) echo $webuserContactDetails['city'] ?>" required="" name="city" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-xs-12">State / Province</label>
                                <div class="col-md-8 col-xs-12">
                                    <input placeholder="Type your state name" value="<?php if (isset($webuserContactDetails) && is_array($webuserContactDetails) && !empty($webuserContactDetails)) echo $webuserContactDetails['state'] ?>" required="" name="state" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-xs-12">Zip / Postal Code</label>
                                <div class="col-md-8 col-xs-12">
                                    <input placeholder="Example: 10001" value="<?php if (isset($webuserContactDetails) && is_array($webuserContactDetails) && !empty($webuserContactDetails)) echo $webuserContactDetails['zipcode'] ?>" style="width: 130px;" name="zipcode" class="form-control"/>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-xs-12">Country</label>
                                <div class="col-md-8 col-xs-12">
                                    <select style="width: 250px;font-size: 16px;font-family: calibri;" style="width: 250px;" name="country" class="select form-control">
                                        <option value="">Select Country</option>
                                        <?php
                                        if (isset($countryList) && is_array($countryList) && !empty($countryList)) {
                                            foreach ($countryList as $country) {
                                                if ($country['country_id'] == $this->session->userdata('webuser_country')) {
                                                    $selected = "selected = selected";
                                                } else {
                                                    $selected = "";
                                                }
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-xs-12">Phone</label>
                                <div class="col-md-8 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input style="width: 85px;" value="" name="countryCode" class="form-control"/>
                                        </div>
                                        <div class="col-md-8 no-paging">
                                            <input style="width: 229px;" value="<?php if (isset($webuserContactDetails) && is_array($webuserContactDetails) && !empty($webuserContactDetails)) echo $webuserContactDetails['phone_number'] ?>" name="phone" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-xs-12">Time zone</label>
                                <div style="width: 365px;" class="col-md-8 col-xs-12">
                                    <?php $this->load->view("webview/includes/all-time-zone-gmt") ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 sys-message"></div>
                                <div style="margin-top: 20px;margin-bottom: 18px;" class="col-md-8 align-right">
                                    <input style="float: left;margin-left: 95px;" class="btn-primary big_mass_active transparent-btn big_mass_button" id="update-address" value="Update" type="submit"/>
                                    <button style="float: left;" class="btn-primary transparent-btn big_mass_button">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>  
        </div>
    </div>
    </div>


</section><!-- big_header-->


<script type="text/javascript">

 <?php if($profile==1)
    {
       ?>
         $("#editcancel").hide();
         $("#editon").show();
         $("#editonb").show();
        <?php  
    }
    else if($profile==2)
    {?>
        $("#editcancelabe").hide();
        $("#editonabe").show();
        <?php 
    }
?>

    $('#update-address').click(function (e) {
        e.preventDefault();
        $(this).val("Wait...").attr("disabled", true);
        $.ajax({
            url: "<?php echo base_url() ?>profile/update-contact-details",
            data: $('form').serialize(),
            dataType: "json",
            type: "post",
            success: function (response) {
                if (response.status == "success") {
                    $('.sys-message').html(response.msg).css({'color': 'green'});
                } else {
                    $('.sys-message').html(response.msg).css({'color': 'red'});
                }
                $("#update-address").val("Update").attr("disabled", false);
            },
            error: function (status, error, textStatus) {
                console.log(error);
                $("#update-address").val("Update").attr("disabled", false);
            }
        });
    });
    function faqselect(num) {
        if ($("#faq" + num).hasClass("faqopen")) {

            $("#faq" + num).removeClass("faqopen");
            $("#faqicon" + num).removeClass("fa-angle-down");
            $("#faqicon" + num).addClass("fa-angle-right");
            $("#faqa" + num).slideUp("fast");

        } else {
            $("#faq" + num).addClass("faqopen");
            $("#faqicon" + num).removeClass("fa-angle-right");
            $("#faqicon" + num).addClass("fa-angle-down");
            $("#faqa" + num).slideDown("fast");
        }

    }

    function openaddressedit() {

        $("#editcancelabe").hide();
        $("#editonabe").show();


    }
    function canceladdressedit() {
        $("#editcancelabe").show();
        $("#editonabe").hide();

    }
    function openprofileedit() {

        $("#editcancel").hide();
        $("#editon").show();
        $("#editonb").show();

    }
    function cancelprofileedit() {

        $("#editon").hide();
        $("#editonb").hide();
        $("#editcancel").show();

    }


    function updatename() {
        var fname = $("#infname").val();
        var lname = $("#inlname").val();
        if ($('#usercompany').is(':visible'))
        {
            var usercompany = $("#usercompany").val();
            var usertitle = $("#usertitle").val();
            var uservat = $("#uservat").val();
            var usersite = $("#usersite").val();
            jQuery.ajax({
                type: "POST",
                url: siteurl + "json/api/type/regapi/page/updatename",
                data: 'fname=' + fname + '&lname=' + lname + '&usercompany=' + usercompany + '&usertitle=' + usertitle + '&usersite=' + usersite + '&uservat=' + uservat + '&v_check=' + 1,
                success: function (_d) {
                    if (_d.status == "success")

                    {
                        $("#xinfname").html(fname);
                        $("#xinlname").html(lname);
                        $("#xincompany").html(usercompany);
                        $("#xintitle").html(usertitle);
                        $("#xinvat").html(uservat);
                        $("#xinsite").html(usersite);
                        cancelprofileedit();

                    } else {

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
                url: siteurl + "json/api/type/regapi/page/updatename",
                data: 'fname=' + fname + '&lname=' + lname + '&v_check=' + 2,
                success: function (_d) {
                    if (_d.status == "success") {
                        $("#xinffname").html(fname);
                        $("#xinflname").html(lname);
                        cancelprofileedit();

                    } else {

                        alert("Something Went Wrong");

                    }

                }
            }).fail(function (_d) {

            });

        }
    }

</script>