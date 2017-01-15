<?php
$this->load->view("webview/includes/autocomplete-skills");
$formData = $this->session->userdata(ACTION_DATA);
$this->session->unset_userdata(ACTION_DATA);
?> 
<section id="big_header" style="margin-top: 50px; margin-bottom: 50px; height: auto;">
    <div class="container white-box"> 
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
            <div class="col-xs-12 col-sm-9 col-md-9">
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
                        <span>Picture</span>
                    </div>
                    <div class="col-xs-4">
                        <?php if ($this->Adminforms->getdatax("picture", "webuser", $id) == "") { ?>
                            <img src="<?php echo site_url("assets/user.png"); ?>" width="100px">
                        <?php } else { ?>
                            <img src="<?php echo site_url($this->Adminforms->getdatax("picture", "webuser", $id)); ?>" width="100px">
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
                                    <span>Tagline (mandatory)</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-9">
                                    <input type="text" required="" name="tagline" id="tagline" value="<?php echo set_value("tagline", isset($formData['tagline']) ? $formData['tagline'] : '' ) ?>" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <span>Hourly Rate (mandatory)</span>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-4">My Hourly Rate:</div>
                            <div class="col-md-8">
                                $ <input type="number" name="hourlyRate" id="hourly_rate" value="<?php echo set_value("hourlyRate", isset($formData['hourly_rate']) ? $formData['hourly_rate'] : '') ?>" required=""/> /hr
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">What winjob will charge clients: (After WinJob Fees 10%)</div>
                            <div class="col-md-8">
                                $ <input type="text" name="winjobFee" id="winjob_fee" value="<?php echo set_value("winjobFee", isset($formData['hourly_rate']) ? $formData['hourly_rate'] + $formData['hourly_rate'] * WINJOB_FEE : '') ?>" /> /hr
                            </div>
                        </div>
                        <div class="margin-top"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <span>Work Experience</span>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-8">

                                    <select id="" name="experienceYear" class="form-control" required="">
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
                                <label>Years</label>
                            </div>
                            <div class="col-md-2">
                                <select id="" name="experienceMonth" class="form-control">
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
                            <label>Months</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span>Skills</span><br />
                            <h4>List your skills and expertise you have to offer to clients (<small>use comma separated value</small>)</h4>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="skills" id="" value="<?php echo set_value("skills", isset($formData['skills']) ? $formData['skills'] : '') ?>" class="form-control autocomplete" />
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
                            <textarea rows="6" cols="" name="overview" id="overview" class="form-control"><?php echo set_value("overview", isset($formData['overview']) ? $formData['overview'] : '') ?></textarea>
                        </div>
                    </div>
                    <div class="row" id="update-bp-bts">
                        <div class="col-md-7 sys-message">
                        </div>
                        <div class="col-md-5 align-right">
                            <input class="btn btn-primary form-btn" id="submit-basic-info" type="submit" value="Save"/>
                            <input class="btn btn-primary form-btn" type="button" value="Cancel" onclick="location.href = '<?php echo site_url("/profile/basic"); ?>'"/>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</section>
<!-- big_header-->


<script type="text/javascript">
    $("#submit-basic-info").click(function (e) {
        e.preventDefault();
        $(this).val("Wait...").attr("disabled", true);
        $.ajax({
            url: "<?php echo base_url() ?>profile/update-basic-profile",
            data: $('form').serialize(),
            dataType: "json",
            type: "post",
            success: function (response) {
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
