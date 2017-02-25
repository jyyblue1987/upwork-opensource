<section id="big_header" style="margin-bottom:50px;height: auto; margin-top: 50px; height: auto;"> 
    <div class="container white-box" >
        <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <?php //$this->load->view("webview/includes/system-message"); ?>
                <?php $this->load->view("webview/includes/error_message"); ?>
            </div> 
            <div class="col-xs-12 col-sm-3 col-md-3 align-left">
                <?php 
                $data = array(
                    'current_active' => 'basic_bio'
                );
                $current_active = 'basic_bio';
                $this->load->view("webview/profile/freelancer-profile-left-sidebar",$data) ?>
                <?php //$this->load->view("webview/includes/error_message"); ?>
            </div>

            <div class="col-xs-12 col-sm-9 col-md-9">

                <div class="row title-line">
                    <div class="abc">
                        <h3>Portfolios</h3>
                    </div>
                    <div class="abd"> 
                        <?php if (isset($portfolios) && is_array($portfolios) && sizeof($portfolios) > 0) { ?>
                            <a accesskey="0" href="#" class="btn btn-default pull-right edit-portfolio"> + Add More </a>
                        <?php } else { ?>
                            <a accesskey="0" href="#" class="btn btn-default pull-right edit-portfolio"> + Add Portfolio </a>
                        <?php } ?>
                    </div>
                </div>   
                <div class="row"> 


                    <?php
                    if (isset($portfolios) && is_array($portfolios) && sizeof($portfolios) > 0) {
                        $count = 0;
                        foreach ($portfolios as $portfolio) {
                            if ($count % 3 == 0) {
                                ?>
                                <div class="clearfix"></div>
                                <?php
                            }
                            ?>
                            <div class="col-md-4 col-sm-4 col-xs-12 padding-left-off" id="div-<?php echo $count ?>">
                                <div class="col-md-12 col-xs-12 protfilimg padding-left-off">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <a href="#" class="edit-portfolio" alt="<?php echo $count ?>" accesskey="<?php echo base64_encode($portfolio['id']) ?>">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>

                                        <a href="#" class="remove-portfolio" alt="<?php echo $count ?>" accesskey="<?php echo base64_encode($portfolio['id']) ?>">
                                            <i class="glyphicon glyphicon-remove"></i>
                                        </a>
                                    </div>
                                    <?php
                                    if (strlen($portfolio['thumnail_image']) > 10) {
                                        ?>
                                        <img class="img-responsive" src="<?php echo base_url() ?>uploads/portfolio/<?php echo $portfolio['thumnail_image']; ?>"/>
                                    <?php } else { ?>
                                        <img class="img-responsive" src="<?php echo base_url() ?>assets/profile/img/noimage.jpg"/>
                                    <?php } ?>
                                    <h4>
                                        <?php
                                        if (strlen($portfolio['project_url']) > 0) {
                                            ?>
                                            <a target="_blank" href="<?php echo $portfolio['project_url'] ?>" title="click to view live site">
                                                <?php echo $portfolio['project_title'] ?>
                                            </a>
                                        <?php } else echo $portfolio['project_title'] ?>
                                    </h4>  
                                </div>
                            </div>
                            <?php
                            $count ++;
                        }
                    }else {
                        echo "<span>No portfolio was added</span>";
                    }
                    ?>
                </div>
                <div class="row title-line">
                    <div class="abc">
                        <h3>Experience</h3>
                    </div>
                    <div class="abd"> 
                        <a href="" class="btn btn-default edit-exp"> + Add Experience </a>

                    </div>
                </div>   
                <?php $cntexp = count($experience);
                foreach ($experience as $val) {
                    ?>
                    <div class="mainprotfilio-mid-button">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="exp-showcase">  
                                    <div style="padding-right:10px;">
                                        <a class="pull-right" style="color:grey;"href="#" id ="<?php echo $val->id; ?>" onclick="editClickedExp(this.id)" ><i class="fa fa-pencil" aria-hidden="true"></i></a> </div>
                                    <div><h4 style="color:grey;font-size: 21px;"><?php echo $val->title; ?> </h4></div> 
                                    <div><h4 style="color:grey;"><?php echo $val->company; ?></h4></div>
                                    <div style="color:grey;">
                                        <?php echo DatetimeHelper::getMonthByNum($val->month1); ?>-<?php echo $val->year1; ?>
                                        <? if ((int)$val->year2 === 0) {
                                            echo ' - Till present';
                                        }
                                        else {
                                            echo 'To ' . DatetimeHelper::getMonthByNum($val->month2) . ' - ' . $val->year2;
                                            ;
                                        } ?>
                                        | <?php echo $val->location; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mainprotfilio-mid-ph">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="lsatphrap">
                                        <p><?php echo $val->description; ?></p>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>

                        <?php
                        if ($val != end($experience)) {
                            ?>
                            <hr />
                            <?php
                        }
                        ?>

                    </div>
<?php } ?>
                <div class="margin-top"></div>

                <div class="row title-line">
                    <div class="abc">
                        <h3>Education</h3>
                    </div>
                    <div class="abd"> 
                        <a href="" class="btn btn-default edit-edu"> + Add Education </a>

                    </div>
                </div>  
                <?php
                foreach ($educations as $education) {
                    ?> 
                    <div class="protfilheadtwo"> 
                        <div style="padding-right: 10px;">
                            <a class="pull-right" style="color:grey;"href="#" id ="<?php echo $education->id; ?>" onclick="editClickedEdu(this.id)" ><i class="fa fa-pencil" aria-hidden="true"></i></a> </div>
                        <p><?= $education->school ?></p>
                        <h2><?= $education->degree ?></h2>
                        <h3><?= $education->dates_attend_from ?> – <?= $education->dates_attend_to ?></h3>
                        <h4><?= $education->field_of_study ?></h4>
                        <h5><?= $education->activities ?></h5>
                        <h6><?= $education->description ?></h6>
                        <?php
                        if ($education != end($educations)) {
                            ?>
                            <hr />
                            <?php
                        }
                        ?>
                    </div>  

                    <?php
                }
                ?>

            </div>

        </div>
    </div>
</section>
<?php
$this->load->view("webview/profile/portfolio-modal"); 
$this->load->view("webview/profile/exp-modal");
$this->load->view("webview/profile/edu-modal");
$this->load->view("webview/includes/footer-common-script");
?>
<!-- big_header-->
<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/internal/profile.js"></script>
<script type="text/javascript">
    
    function submitPortfolio(params) {
        //e.preventDefault();
        $(params).val("Wait...").attr("disabled", true);
        $("#updatePorfolio").submit();
    }
    ;
    function afterUpload(msg) {
        $("#submit-portfolio").val("Submit").attr("disabled", false);
        if (msg.length > 0 && msg == "success") {
            $('.inpt,.slt,.txtar').val("");
            $('.sys-message').html("Your portfolio has been successfully updated").css({'color': 'green'});
            window.location.reload(true);
        } else {
            if (msg != "") {
                $('.sys-message').html(msg).css({'color': 'red'});
                $("#submit-portfolio").val("Submit").attr("disabled", false);
            }
        }
    }
    function uploadDatapath(param) {
        $(".sys-msg").empty(); // To remove the previous error message
        var file = param.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
        {
            $('#previewing').attr('src', '<?php echo base_url() ?>assets/profile/img/noimage.jpg');
            $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
            return false;
        } else
        {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(param.files[0]);
        }
    }
    ;
    function imageIsLoaded(e) {
        $("#file-upload").css("color", "green");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '130px');
    }
    ;

    function closeModal() {
        $('.inpt,.slt,.txtar').val("");
        $('#edit-portfolio').modal('hide');
    }
    ;
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
