<?php
$this->load->view("webview/includes/autocomplete-skills");
$formData = $this->session->userdata(ACTION_DATA);
$this->session->unset_userdata(ACTION_DATA);
?> 
<link rel="stylesheet" href="<?php echo site_url("assets/css/chosen.css"); ?>">
<style>
    .search-field {
        border: none;
        height: auto;
    }
</style>
<script src="<?php echo site_url("assets/js/chosen.jquery.js"); ?>"></script>
<section id="big_header" style="margin-top: 40px; margin-bottom: 40px; height: auto;width: 970px !important;">
    <div style="width: 970px !important;border: 1px solid #ccc;border-radius: 4px;padding-right: 15px;" class="container white-box"> 
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <?php $this->load->view("webview/includes/system-message"); ?>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 align-left">
                <?php 
                $data = array(
                    'current_active' => 'basic'
                ); 
                $this->load->view("webview/profile/freelancer-profile-left-sidebar",$data) ?>
            </div>
            <div style="padding-left: 36px;" class="col-xs-12 col-sm-9 col-md-9">
                <div class="row title-line">
                    <div class="abc">
                        <h3>Personal Info  </h3> 
                    </div>
                    <div class="abd"> 
                        <h3 onclick="openprofileedit();" style="cursor:pointer;">Edit</h3>
                    </div>
                </div>  

                <div class="row" >
                    <div class="col-xs-2">
                        <h4 class="custom_personal_info_title">Picture</h4>
                    </div>
                    <div class="col-xs-4">
                        <?php if ($this->Adminforms->getdatax("picture", "webuser", $id) == "") { ?>
                            <img style="border-radius: 60%;" src="<?php echo site_url("assets/user.png"); ?>" width="100px">
                        <?php } else { ?>
                            <img style="border-radius: 60%;" src="<?php echo site_url($this->Adminforms->getdatax("picture", "webuser", $id)); ?>" width="100px">
                        <?php }
                        ?>                                        
                    </div>
                    <div class="col-xs-6">
                        <a style=" width: 100px;margin-top: 10px;" href="<?php echo site_url("changepic"); ?>" class="btn btn-primary pull-left"> Change   </a>
                    </div>
                </div>

                <?php
                // $attributes = array('class' => 'form-horizontal basic-profile-form','name'=>'basic-profile-form','onsubmit'=>'return updateProfile()');
                // echo form_open('#', $attributes);
                ?>
                <form method="post" action="#" class="form-horizontal basic-profile-form" name="basic-profile-form">
                    <div class="fffdd">
                        <div id="editcancel">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="custom_personal_info_title">Tagline</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input style="margin-bottom: 20px;" type="text" required="" name="tagline" id="tagline" value="<?php echo set_value("tagline", isset($formData['tagline']) ? $formData['tagline'] : '' ) ?>" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                            </div>
                        </div>
                        <br/>
                        <div style="font-size: 17px;font-family: calibri;margin-bottom: 15px;" class="row">
                            <div class="col-md-5"><h4 class="custom_personal_info_title">My Hourly Rate:</h4></div>
                            <div class="col-md-6">
                                <span style="float: left;margin-right: 10px;font-size: 17px;font-family: calibri;">$</span> <input style="width: 80px;float: left;margin-right: 10px;font-size: 17px;font-family: calibri;" class="form-control" type="" name="hourlyRate" id="hourly_rate" value="<?php echo set_value("hourlyRate", isset($formData['hourly_rate']) ? $formData['hourly_rate'] : '') ?>" required=""/> /hr
                            </div>
                        </div>
                        <div style="font-size: 17px;font-family: calibri;" class="row">
                            <div class="col-md-5">What winjob will charge clients: <br />(After WinJob Fees 10%)</div>
                            <div class="col-md-6">
                                <span style="float: left;margin-right: 10px;font-size: 17px;font-family: calibri;">$</span> <input style="width: 80px;float: left;margin-right: 10px;font-size: 17px;font-family: calibri;border-radius: 4px;" class="form-control" type="text" name="winjobFee" id="winjob_fee" value="<?php echo set_value("winjobFee", isset($formData['hourly_rate']) ? $formData['hourly_rate'] + $formData['hourly_rate'] * WINJOB_FEE : '') ?>" /> /hr
                            </div>
                        </div>
                        <div style="margin-top: 45px;"></div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="custom_personal_info_title">Work Experience</h4>
                            </div>
                            <div style="margin-left: -45px;" class="col-md-4">
                                <div class="col-md-8">

                                    <select style="width: 80px;font-size: 17px;font-family: calibri;" id="" name="experienceYear" class="form-control" required="">
                                        <?php
                                        for ($i = 1; $i <= 20; $i++) {
                                            if ($this->session->userdata("experienceYear") == $i) {
                                                $selected = "selected=selected";
                                            } else {
                                                $selected = "";
                                            }
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $i ?>">
                                                <?php echo $i ?>
                                            </option>
                                            <?php
                                        }
                                        $this->session->unset_userdata("experienceYear");
                                        ?>
                                    </select>
                                </div>
                                <label style="font-size: 17px;font-family: calibri;font-weight: normal;margin-left: -27px;">Years</label>
                            </div>
                            <div style="margin-left: -85px;" class="col-md-2">
                                <select style="width: 80px;font-size: 17px;font-family: calibri;" id="" name="experienceMonth" class="form-control">
                                    <?php
                                    for ($i = 1; $i < 12; $i++) {
                                        if ($this->session->userdata("experienceMonth") == $i) {
                                            $selected = "selected=selected";
                                        } else {
                                            $selected = "";
                                        }
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php
                                    }
                                    $this->session->unset_userdata("experienceMonth");
                                    ?>
                                </select>
                            </div>
                            <label style="font-size: 17px;font-family: calibri;font-weight: normal;margin-left: -15px;">Months</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="custom_personal_info_title">Skills</h4>
                        </div>
                        <div class="col-md-12">
                            <!-- Added by Armen start -->
                            <select class="choose-skills" name="skills[]"  data-placeholder="List your skills and expertise you have to offer to clients" style="width: 100%;height: 35px;font-size: 16px;" multiple>
                                <?php foreach($formData['user_skills'] as $item){
                                  ?>
                                <option value="<?php echo $item['skill_name']; ?>" selected><?php echo $item["skill_name"]; ?></option> 
                                <?php 
                                }?>
                                <?php foreach($formData['skillList'] as $key => $skill){
                                  ?>
                                <option value="<?php echo $skill->skill_name; ?>" <?php echo (in_array($skill->skill_name, $formData['repeated'])) ?  'disabled' : '' ;?>><?php echo $skill->skill_name; ?></option> 
                                <?php 
                                }?>
                                
                            </select>
                            <!-- Added by Armen end -->
                            <!-- <input type="text" name="skills" id="" value="<?php echo set_value("skills", isset($formData['skills']) ? $formData['skills'] : '') ?>" class="form-control autocomplete" /> -->
                        </div>
                    </div>
                    <div class="margin-top"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="custom_personal_info_title">Overview</h4>
                        </div>
                        <div class="col-md-12">
                            <textarea style="font-size: 16px;" placeholder="Add your few sentences about your background, what you offer, and why clients should hire you" rows="6" cols="" name="overview" id="overview" class="form-control"><?php echo set_value("overview", isset($formData['overview']) ? $formData['overview'] : '') ?></textarea>
                        </div>
                    </div>
                    <div class="row" id="update-bp-bts">
                        <div class="col-md-7 sys-message">
                        </div>
                        <div style="margin-top: 20px;" class="col-md-5 align-right">
                            <input style="margin-right: 0;" class="btn-primary big_mass_active transparent-btn big_mass_button" id="submit-basic-info" type="submit" value="Save"/>
                            <input class="btn-primary transparent-btn big_mass_button" type="button" value="Cancel" onclick="location.href = '<?php echo site_url("/profile/basic"); ?>'"/>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</section>
<!-- big_header-->
<script type="text/javascript">
    // Added by Armen start
    $(".choose-skills").chosen(); 
    $('.chosen-drop').hide();
    $(".chosen-container").bind('keyup',function(e) {
        $('.chosen-drop').show();
    });
    // added by Armen end
    $("#submit-basic-info").click(function (e) {
        e.preventDefault();
        $(this).val("Wait...").attr("disabled", true);
        $.ajax({
            url: "<?php echo base_url() ?>profile/update-basic-profile",
            data: $('form').serialize(),
            dataType: "json",
            type: "post",
            success: function (response) {
                if (response.status == 'error') {
                    if (document.location.href == response.url) {
                        document.location.reload();
                    }

                    document.location.href = response.url;
                }
                if (response.status == "success") {
                    $('.sys-message').html(response.msg).css({'color': 'green'});
                } else {
                    $('.sys-message').html(response.msg).css({'color': 'red'});
                }
                $("#submit-basic-info").val("Submit").attr("disabled", false);
            },
            error: function (status, error, textStatus) {
                alert(error);
                $("#submit-basic-info").val("Submit").attr("disabled", false);
            }
        });
    });

    $('#hourly_rate').keyup(function () {
        var myRate = $(this).val();
        if (parseInt(myRate) > 0) {
            $('#winjob_fee').val(parseInt(myRate) + parseInt(myRate) * .1);
        } else {
            $('#hourly_rate').val("");
        }
    });
    $('#winjob_fee').click(function () {
        var myRate = $('#hourly_rate').val();
        if (parseInt(myRate) > 0) {
            $(this).val(parseInt(myRate) + parseInt(myRate) * .1);
        } else {
            $('#hourly_rate').val("");
        }
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
        $('#update-bp-bts').removeClass('hidden');
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
