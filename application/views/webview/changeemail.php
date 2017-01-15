<section id="main-content">
    <div class="container main-area white-box" style="margin-top:50px;margin-bottom:50px;height: auto;"> 
        <div class="row">
            <div class="midle-min">
                <div class="col-md-3 col-sm-3">
                    <div class="">
                          <?php 
                $data = array(
                    'current_active' => 'changeemail'
                ); 
                $this->load->view("webview/profile/freelancer-profile-left-sidebar",$data) ?>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 ">
				<div class="row title-line">
                    <div class="abc">
                        <h3 style="padding-bottom:10px;">Change Email </h3> 
                    </div> 
                </div> 
                    <div class='form-msg'></div>
                    <form id="emailchange" method="post" action="<?php echo site_url("changeemail/updateEmail"); ?>">

                        <div class="row">
                            <label for="example-text-input"  class="col-xs-2 col-form-label"  >Old Email</label>
                            <div class="col-xs-6">
                                <input class="form-control"  type="email" value="" name="old_email">
                            </div>
                        </div>
                        <div class="row">
                            <label for="example-email-input"  class="col-xs-2 col-form-label" >New Email</label>
                            <div class="col-xs-6">
                                <input class="form-control"  type="email" value="" name="email" onblur="validate('email', this.value)">
                                <small id='email'></small>
                            </div>                             
                        </div>
                        <div class="row">
                            <label for="example-url-input"  class="col-xs-2 col-form-label">Confirm Password</label>
                            <div class="col-xs-6">
                                <input class="form-control"  type="password"  value="" name="password">
                            </div>
                        </div>
                        <div class="totalbutton">
                            <div class="row">
                                <div class="col-xs-2">

                                </div>
                                <div class="col-xs-6">
								<button type="submit" id="butupdat"class="btn btn-primary">Update</button>
                                    <button type="reset" id="butcancel" class="btn btn-danger">Cancel</button>
                                    
                                    <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
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
