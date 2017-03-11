<section id="main-content">
    <div class="container main-area white-box" style="margin-top:40px;margin-bottom:40px;height: 403px;border: 1px solid #ccc;width: 970px !important;">
        
        <div class="row">
            <div class="midle-min">
                <div class="col-md-3 col-sm-3 ">
                    <div class="">
                         <?php 
                $data = array(
                    'current_active' => 'changepassword'
                ); 
                $this->load->view("webview/profile/freelancer-profile-left-sidebar",$data) ?>
                    </div>
                </div>
                <div style="padding-left: 33px;" class="col-md-9 col-sm-9 ">
				<div class="row title-line">
                    <div class="abc">
                        <h3 style="padding-bottom:19px;">Change Password </h3> 
                    </div> 
                </div> 
                    <div class='form-msg'></div>
                    <form id="pwdchange" method="post" action="<?php echo site_url("changepassword/update"); ?>">

                        <div style="margin-left: -30px;" class=" row">
                            <label style="font-size: 17px;font-family: calibri;" for="example-text-input"  class="col-xs-3 col-form-label"  >Old Password</label>
                            <div class="col-xs-6">
                                <input style="border-radius: 4px;" placeholder="Type your old password" class="form-control"  type="password" value="" name="old_password">
                            </div>
                        </div>
                        <div style="margin-left: -30px;" class=" row">
                            <label style="font-size: 17px;font-family: calibri;" for="example-email-input"  class="col-xs-3 col-form-label" >New Password</label>
                            <div class="col-xs-6">
                                <input style="border-radius: 4px;" placeholder="Type a new password" class="form-control"  type="password" value="" name="password" >
                                <small id='email'></small>
                            </div>                             
                        </div>
                        <div style="margin-left: -30px;" class=" row">
                            <label style="font-size: 17px;font-family: calibri;" for="example-url-input"  class="col-xs-3 col-form-label">Confirm Password</label>
                            <div class="col-xs-6">
                                <input placeholder="Confirm your password" style="border-radius: 4px;" class="form-control"  type="password"  value="" name="confirm_password">
                            </div>
                        </div>
                        <div style="padding-top: 20px;" class="totalbutton">
                            <div style="margin-left: -30px;" class="row">
                                <div class="col-xs-3">

                                </div>
                                <div class="col-xs-6">
                                    
                                    <button style="float: left;" type="submit" class="btn-primary big_mass_active transparent-btn big_mass_button">Update</button>
									<button style="float: left;" type="reset" class="btn-primary transparent-btn big_mass_button">Cancel</button>
                                    <img src='<?= site_url() ?>assets/img/version1/loader.gif' class="form-loader" style="display:none">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div style="clear:both"></div>
</section> 

<script type="text/javascript"> 
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
 </script>
