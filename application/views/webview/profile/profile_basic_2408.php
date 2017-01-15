
<section id="big_header"
         style="margin-top: 50px; margin-bottom: 50px; height: auto;">
    <div class="container"
         style="border-left: 2px solid #e6e7e7; border-right: 2px solid #e6e7e7; border-bottom: 2px solid #e6e7e7;">
        <div class="row">
            <div class="col-xs-12 col-sm-5 col-md-5">

                <div class="left">
                    <h1>My Profile</h1>
                </div>
                <div class="line1"></div>
                <div class="margin"></div>

                <div class="columns" style="margin: 50px;">
                    
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
           <div class="grey">View My Profile</div>
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
                        <h2>
                            My Profile &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </h2>
                    </div>



                    <div class="left2">
                        <h3>Personal Info</h3>
                    </div>




                    <div class="left3">
                        <h4 onclick="openprofileedit();" style="cursor: pointer;">Edit
                            Profile</h4>
                    </div>
                </div>
                <div class="margin2"></div>

                <div class="fffaa">
                    <div class="fas">
                        <h2>Picture</h2>
                    </div>
                    <div class="img">
                        <?php if ($this->Adminforms->getdatax("picture", "webuser", $id) == "")
                        { ?>
                            <img src="<?php echo site_url("assets/user.png"); ?>" width="100px">
<?php } else
{ ?>
                            <img
                                src="<?php echo site_url($this->Adminforms->getdatax("picture", "webuser", $id)); ?>"
                                width="100px">
                                <?php
                            }
                            ?>
                    </div>
                    <div class="but1">
                        <a href="<?php echo site_url("changepic"); ?>"
                           class="btn btn-primary"> Change </a>

                    </div>
                </div>

                <form>
                    <div class="fffdd">
                        <div id="editcancel">
                            <div class="row">
                                <div class="col-xs-6">
                                    <span>Tagline (Optional)</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-9">
                                    <input type="text" name="tagline" id="tagline" value=""
                                           class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <span>Hourly Rate (Optional)</span>
                            </div>
                        </div>
                        <br />

                        <div class="row">
                            <div class="col-md-4">My Hourly Rate:</div>
                            <div class="col-md-8">
                                $ <input type="text" name="hourly_rate" id="hourly_rate"
                                         value="" /> /hr
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">What winjob will charge clients: (After
                                WinJob Fees)</div>
                            <div class="col-md-8">
                                $ <input type="text" name="winjob_fee" id="winjob_fee" value="" />
                                /hr
                            </div>
                        </div>

                        <div class="margin-top"></div>

                        <div class="row">
                            <div class="col-md-4">
                                <span>Work Experience</span>
                            </div>

                            <div class="col-md-4">
                                <div class="col-md-8">
                                    <select id="" name="" class="form-control">
                                        <?php for ($i = 1; $i <= 20; $i++)
                                        { ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php } ?>
                                    </select>

                                </div>
                                <label>Years</label>
                            </div>
                            <div class="col-md-2">
                                <select id="" name="" class="form-control">
<?php for ($i = 1; $i <= 12; $i++)
{ ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php } ?>
                                </select>

                            </div>
                            <label>Months</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span>Skills</span><br />
                            <h4>List your skills and expertise you have to offer to clients</h4>
                        </div>

                        <div class="col-md-12">
                            <input type="text" name="" id="" value="" class="form-control" />
                        </div>
                    </div>

                    <div class="margin-top"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <span>Overview</span><br />
                            <h5>Add your few sentences about your background, what you offer,
                                and why clients should hire you</h5>
                        </div>

                        <div class="col-md-12">
                            <textarea rows="6" cols="" name="overview" id="overview"
                                      class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-md-offset-9">
                            <input id="next" class="btn btn-primary form-btn" type="submit" value="Save">

                            <input id="next" class="btn btn-primary form-btn" type="submit" value="Cancel">
                        </div>
                    </div>
                </form>

            </div>
            <div class="mide"></div>
        </div>
    </div>


</section>
<!-- big_header-->


<script>

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




        jQuery.ajax({
            type: "POST",
            url: siteurl + "json/api/type/regapi/page/updatename",
            data: 'fname=' + fname + '&lname=' + lname,
            success: function (_d) {

                if (_d.status == "success") {

                    $("#xinfname").html(fname);
                    $("#xinlname").html(lname);
                    cancelprofileedit();

                } else {

                    alert("Something Went Wrong");

                }

            }
        }).fail(function (_d) {

        });


    }
</script>
