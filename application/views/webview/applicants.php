<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, user-scalable=no">
        <?php $this->load->view("webview/includes/common-head"); ?>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/profile/css/style.css"/>
        <link rel='stylesheet' media='screen and (max-width: 600px)' href='<?php echo base_url() ?>assets/profile/css/mobile-style.css' />
        <link rel='stylesheet' media='screen and (min-width: 600px)' href='<?php echo base_url() ?>assets/profile/css/desktop-style.css' />
        <link rel='stylesheet' media='screen and (min-width: 601px) and (max-width: 900px)' href='<?php echo base_url() ?>assets/profile/css/tablet-style.css' />
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/header.css"/>

        <style>
            .user_view_img img {
                border-radius: 50%;
                height: 100px;
                width: 100px;
                margin-left: 10px;
            }
            .chat_border {
                position: relative;
                display: inline-block;
                margin-top: -7px;
            }
            .attach_icon{
                height: 20px;
                width: 20px;
            }
            .main_hourly_rate a {
                margin-top: 15px;
            }
            span.rating-badge {
                background: #F77D0E none repeat scroll 0 0;
                border-radius: 2px;
                color: #fff;
                padding: 2px 4px 2px 5px;
                font-size: 12px;
            }
            .review_ratting_left .star-rating::before {
                font-size: 19px !important;
                left: 10px;
            }
            .review_ratting_right .star-rating::before {
                top: -2px;
            }

            .mass_box .chat-details-topbar {
                width: 690px;
                margin: 0 30px;
                border-top:1px solid #ccc;
                border-left:1px solid #ccc;
                border-right:1px solid #ccc;
                margin-top: 25px;
            }
            .mass_box .chat-details {
                width: 690px;
                margin: 0 30px;
                border-left:1px solid #ccc;
                border-right:1px solid #ccc;
            }
            .mass_box .chat-bar{width: 690px;margin: 0 30px;
                                border-left:1px solid #ccc;
                                border-bottom:1px solid #ccc;
                                border-right:1px solid #ccc;
            }
            .mass_box textarea#chat-input{
                width: 520px;
            }

            .buttonsidefoure ul.custom_li li {
                overflow: hidden;
                margin: -24px 11px;
            }

            .attach_icon {
                position: absolute;
                right: 5%;
                font-size: 26px;
                top: 51%;
                color: #a2a2a2;
                transform: rotate(90deg);
            }
            .show_files{
                position: absolute;
                left: 5%;
                top: 3%;
            }
            .show_files span{
                font-size: 12px;
            }
            .show_files .delete_item{
                margin-left: 5px;
            }
            .user_skills span {
                background: #ccc none repeat scroll 0 0;
                border: 1px solid #ccc;
                border-radius: 3px;
                color: #494949;
                display: inline-block;
                font-size: 12px;
                margin-bottom: 4px;
                padding: 1px 5px 1px 5px;
                margin-right: 2px;
            }
            .user_skills span:hover {
                background: #008329;
                color: #fff;
            }

            .row.chat-box { min-height: 400px; border: 1px solid; padding: 16px;}
            .chat-screen {
                border: 1px solid #ccc; 
                padding: 0;
                min-height: 410px;
                width: 754px;
            }
            .chat-details-topbar { 
                min-height: 75px; position: absolute; top: 0; background: #fff; width: 675px; z-index: 99; border-bottom: 1px solid #ccc;
                padding: 4px 5px 0px 13px;
                width: 750px;

            }
            .white-box.bordered_cl {
                width: 754px;
            }
            .chat-details { width: 100%; z-index: 1; bottom: 0;
                            margin-top: -20px;
                            position: absolute; background: #fff; overflow-x: hidden; overflow-y: scroll;top: 100px;
                            max-height: 246px;
            }
            .chat-details ul li { list-style-type: none; padding: 10px 0;}
            .chat-details ul li span img { width: 50px; border-radius: 50%; margin: 0 15px 0 0;}
            .chat-details-topbar h3 { padding: 6px 10px; font-weight: bold;
                                      padding-top: 10px;
            }
            .chat-details-topbar h5 { padding: 0 10px;}
            .chat-details-topbar p { padding: 24px 0 0px 10px; margin: 0;  color: #757575;}
            .chat-details ul li span.details { display: block; margin-left: 67px;  font-size: 14px;  color: #757474;}
            textarea#chat-input { 
                width: 568px;
                height: 40px;
                margin: 0 0 0 15px;
                margin-top: 25px;
                border: 2px solid #1ca7db;
            }
            .active { 
                border: 2px solid #1ca7db;  
                color: #1ca7db;
            }
            .chat-sidebar a { color: #000;}
            .chat-bar { 
                width: 100%;
                z-index: 1;
                bottom: 0;
                min-height: 80px;
                height: 80px;
                position: absolute;
                background: #fff;
                top: 325px;
                border-top: 1px solid #ccc;
            }

            form#chat_form a {
                display: inline-block;
                background: #1ca7db;
                color: #fff;
                text-align: center;
                font-size: 18px;
                padding: 5px 21px;
                margin: 18px 6px;
                text-decoration: none;
                width: 120px;
                height: 40px;
            }
            .cover_box p {
                padding-top: 0px;
            }
            .textarea {
                max-height: 300px;
                overflow-x: hidden;
                overflow-wrap: break-word;
                resize: horizontal;
                height: 645px;
                overflow-y: visible;
            }
            .textarea:focus{
                outline-style: solid;
                outline-width: 2px;
            }
            span.chat-date { font-size: 13px; padding: 0 0 0 15px; color: #949494;}
            span.group-date { display: block; text-align: center; font-size: 16px; color: #7d7b7b;}
            span.name { text-transform: capitalize;}
            span.text1 {text-transform: capitalize;}

            .buttonsidefoure ul li a {
                font-size: 16px;
            }

            .uploaded_files .item { float: left; margin-right: 5px; }
            .fa-times{ background: none; color: #000; }
        </style>


    </head>
    <body> 
        <div style="clear:both"></div>
        <div class="container">
            <div id="top-content">
                <div class="row margin-top-4">
                    <div class="">
                        <div class="row">
                            <div class="col-md-9">
                                <div style="border-bottom: 0;" class="header_border">
                                    <div class="col-md-2 col-sm-4"style="width: 140px">
                                        <div style="padding-top: 13px;" class="topleftside">
                                            <div style="margin-left: 10px;" class="user_view_img">
                                                <?= ($cropped_img == "") ? '<img src="' . site_url() . 'assets/user.png"/>' : '<img src="' . $cropped_img . '"/>' ?>
                                                <div style="clear:both"></div>
                                                <div style="margin-top:1px;" class="review_ratting">
                                                    <?php if ($rating != 0) { ?>
                                                        <span class="rating-badge"><?= number_format((float) $rating, 1, '.', ''); ?></span>
                                                        <div title="Rated <?= $rating; ?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em; margin-top:-5px; color:#DEDEDE; width: 4em">
                                                            <span style="width:<?= (( $rating / 5) * 100) ?>% ; margin-top:0px;">
                                                                <strong itemprop="ratingValue"><?= $rating; ?></strong> out of 5
                                                            </span>
                                                        </div>
                                                    <?php } else { ?>
                                                        <span class="rating-badge">0.0</span>
                                                        <div title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em; margin-top:-5px;">
                                                            <span style="width:0% ;margin-top:-5px;">
                                                                <strong itemprop="ratingValue">0</strong> out of 5
                                                            </span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-4">
                                        <div class="topmiddle" style="padding-left: 5px;margin-right: -40px;">
                                            <div style="overflow: hidden;">
                                                <h4 class="pull-left" style="text-transform: uppercase; font-size:18px"> <?= $fname . ' ' . $lname; ?></h4>
                                                <h4 class="pull-right" style="padding-top:">$
                                                    <?php
                                                    if (($job_info['job_type']) == 'fixed') {
                                                        echo $job_info['bid_amount'];
                                                    } else {
                                                        echo $job_info['bid_amount'] . "/hr";
                                                    }
                                                    ?>
                                                </h4>
                                            </div>
                                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?= $country ?> </p>
                                            <h3 style="color:#494949;padding-top: 10px;"><?= $tagline ?></h3>
                                            <div class="col-md-12 col-sm-12">
                                                <div style="padding-bottom: 55px;" class="buttonside">
                                                    <div class="user_skills">
                                                        <?php
                                                        foreach ($skills AS $skills) {
                                                            echo '<span>' . $skills["skill_name"] . '</span>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <div style="clear:both"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="side_header">
                                    <div class="topriht align-center">
                                            <?php if ($status == TRUE) { ?>
                                                <?php if ($$job_info['hired'] == 0) { ?>
                                                        <?php if (($job_type) == 'fixed') { ?>
                                                            <a href="<?php echo base_url() ?>jobs/confirm_hired_fixed?user_id=<?= $_GET['user_id']; ?>&job_id=<?= $_GET['job_id']; ?>">
                                                        <?php } else { ?>
                                                            <a href="<?php echo base_url() ?>jobs/confirm_hired_hourly?user_id=<?= $_GET['user_id']; ?>&job_id=<?= $_GET['job_id']; ?>">
                                                        <?php } ?>
                                                        <button id="buttonsecond">Hire Me&nbsp;&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></button>
                                                    </a>
                                                <?php } ?>
                                            <?php } ?>
                                            <br/>

                                            <a href="<?php echo base_url() ?>profile/profile_freelancer?user=<?php echo $_GET['user_id']; ?>&name=<?= $slag; ?>" ><button class="btn" id="view-profile-btn">View Profile</button></a>
                                            <br/>
                                            <?php if ($job_info['job_progres_status'] == 0 && !($job_info['withdrawn'] == 1 || $job_info['bid_reject'] == 1)) { ?>
                                                <div style="margin-bottom: 11px;" class="col-md-12 col-sm-12 decline-line">
                                                    <i class="fa fa-times-circle" aria-hidden="true"></i> 
                                                    <small><a href="javascript:void(0)" onclick="Confirmdecline(<?php echo $job_info['bid_id']; ?>);">Decline Candidate </a></small>
                                                </div>
                                            <?php
                                            } else if ($job_info['withdrawn'] == 1 || $job_info['bid_reject'] == 1) {
                                                if ($job_info['withdrawn_by'] == 1) {
                                                    echo "<small>Declined by Freelancer </small>";
                                                } else if ($job_info['withdrawn_by'] == 2) {
                                                    echo "<small>Declined by You </small>";
                                                }
                                            } else {
                                                ?>
                                                <div style="margin-bottom: 11px;" class="col-md-12 col-sm-12 decline-line">
                                                    <i class="fa fa-times-circle" aria-hidden="true"></i> 
                                                    <small><a href="javascript:void(0)" onclick="Confirmdecline(<?php echo $job_info['bid_id']; ?>);">Decline Candidate </a></small>
                                                </div>
                                            <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="middle">
                        <div class="container">
                            <div class="midlmain">
                                <div class="row">
                                    <div class="col-md-9 col-sm-9" style=""> 
                                        <div class="col-lg-12 col-md-12 col-sm-12 chat-screen">
                                            <div style="height: 430px;background: #fff;" class="mass_box">
                                                <div class="chat-details-topbar">
                                                    <h3><?= $fname ?>  <?= $lname ?></h3>
                                                    <h5><?= ucwords($job_info['title']) ?></h5>
                                                </div>
                                                <div class="chat-details ">
                                                    <ul id="scroll-ul">
                                                    <?php
                                                    $group_time = false;
                                                    $current_date = strtotime(date("d-m-Y"));
                                                    $date = '';
                                                    $temp_date = '';

                                                    if (!empty($conversation)) {
                                                        foreach ($conversation['data'] as $chat_data) {

                                                            if (!empty($timezone)) {
                                                                $date2 = new DateTime(date('Y-m-d h:i:s', strtotime($chat_data->conversation_date)), new DateTimezone('UTC'));
                                                                $date2->setTimezone(new \DateTimezone($timezone['gmt']));

                                                                $time = $date2->format('g:i A');
                                                            } else {
                                                                $time = date('g:i A', strtotime($chat_data->conversation_date));
                                                            }

                                                            if (($chat_data->cropped_image) == "") {
                                                                $src = site_url("assets/user.png");
                                                            } else {
                                                                $src = $chat_data->cropped_image;
                                                            }

                                                            $temp_date = date("d-m-Y", strtotime($chat_data->conversation_date));
                                                            if ($date != strtotime($temp_date)) {
                                                                $date = strtotime($temp_date);
                                                                $group_time = true;
                                                            } else {
                                                                $group_time = false;
                                                            }

                                                            if ($group_time) { ?>
                                                                <li><span class="group-date"><?php if ($date == $current_date) {
                                                            echo "Today";
                                                        } else {
                                                            echo date("l, F j, Y", $date);
                                                        } ?></span></li>

                                                    <?php } ?>
                                                                <li style="padding:20px">							
                                                                    <span class="name"><img src="<?= $src ?>"><?= $chat_data->webuser_fname ?> <?= $chat_data->webuser_lname ?></span> <span class="chat-date"><?= $time ?></span>
                                                                    <span id="scroll" class="details"><?= $chat_data->message_conversation ?></span>
                                                    <?php if (count($chat_data->images_array) > 0): ?>
                                                                        <?php foreach ($chat_data->images_array as $key => $image): ?>
                                                                            <div class = "chat_image">
                                                                                <a href = "<?= base_url('uploads') . "/" . $image->name ?>" download target = "blank"><?= $image->name ?></a>
                                                                            </div>
                                                    <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </li>
                                                                <?php }
                                                            } ?>
                                                    </ul>
                                                </div>
                                                <div style="border: 1px solid #ccc; height: 100px; " class="chat-bar">
                                                    <form id="chat_form" action="">
                                                        <input type="hidden" id="bid_id" name="bid_id" value="<?= $job_info['bid_id'] ?>">
                                                        <input type="hidden" name="job_id" id="job_id" value="<?= $job_info['job_id'] ?>">
                                                        <input type="hidden" name="user_id" id="user_id" value="<?= $job_info['user_id'] ?>">
                                                        <input type="hidden" name="receiver_id" id="receiver_id" value="<?= $freelancer_id ?>">
                                                        <div  class="chat_border" style="width:80%;float: left; position: relative;">
                                                            <input type = "hidden" name = "removed_files" value = "" id = "removed_files">
                                                            <input type="file" name="fileupload[]" class = "hidden" value="fileupload" id="fileupload" multiple>
                                                            <textarea style="border-radius: 4px; resize: none; padding-right: 24px;" name="chat-input" id="chat-input" rows="4"></textarea>
                                                            <div class="attach_icon">
                                                                <i style="cursor: pointer;" class="fa fa-paperclip" aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        <div class="sms_send_btn ccc_sms_send_btn" style="width:20%;float: left;height: 100px;"><a href="javascript:void(0);" id="submit">SEND</a></div>
                                                    </form>
                                                    <div style="width:77%;min-height: 42px;position: relative; top: 12px;">
                                                        <div class="uploaded_files" style='left: 3%'></div>
                                                    </div>
                                                    <span id="error_span" style="color:red;padding: 0 0 0 15px;display:none;"></span>
                                                    <span id="success_span" style="color:green;padding: 0 0 0 15px;display:none;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 white-box bordered_cl" style="margin-top:20px;margin-bottom:40px;border: 1px solid #ddd;" >
                                            <div style="padding: 0 15px;" class="cover_box">
                                                <p class="cover-letter">Cover Letter<br/></p>
                                                <p class="cover-letter-text" style="margin-left: 14px !important;">
                                                    <?= $job_info['cover_latter'] ?>
                                                </p>
                                                <br/>
                                            </div>
                                            <?php if ($f_attachments) { ?>                                          
                                                <div class="col-md-9">
                                                    <label class="lab-details" style="font-size: 18px; margin-left: 23px;">Attachments</label>
                                                </div>
                                                <div class="col-md-12 text-justify page-label div-details" style="margin-left: 23px;">
                                                    <?php
                                                    foreach ($f_attachments AS $attachment) {
                                                        echo '<a href="' . site_url() . 'jobs/download?dir=' . $f_id . '/' . $f_attachments[0]['tid'] . '&file=' . str_replace('"', '', $attachment) . ' ">' . str_replace('"', '', $attachment) . '</a><br>';
                                                    }
                                                    ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <div style="margin-top: -35px !important;border-radius: 4px;" class="buttonsidefoure">
                                            <h2 style="margin: 0;padding: 0;margin-left: 12px;padding-bottom: 20px;"><b>Work History</b></h2>
                                            <ul class="main_side_nav_bar custom_li">
                                                <li>
                                                    <div class="review_ratting">
                                                        <?php if ($rating != 0) { ?>
                                                            <span style="font-size: 10px;margin-left: 4px;margin-right: 3px;" class="rating-badge"><?= number_format((float) $rating, 1, '.', ''); ?></span>
                                                            <div title="Rated <?= $rating; ?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em;margin-top:-5px;width:105px; color:#DEDEDE; width: 4em">
                                                                <span style="width:<?= (( $rating / 5) * 100); ?>%">
                                                                    <strong itemprop="ratingValue"><?= number_format((float) $rating, 1, '.', ''); ?></strong> out of 5
                                                                </span>
                                                            </div>
                                                        <?php } else { ?>
                                                            <span class="rating-badge">0.0</span>
                                                            <div title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em; margin-top:-5px;">
                                                                <span style="width:0% ;margin-top:0px;">
                                                                    <strong itemprop="ratingValue">0</strong> out of 5
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </li>
                                                <li style="margin-top: -30px;margin-left: 8px;" class="main_hourly_rate">
                                                    <div>
                                                        <a href="">
                                                            <i style="font-size: 17px;" class="fa fa-credit-card-alt" aria-hidden="true"></i>
                                                            &nbsp;$<?php echo $hourly_rate + $hourly_rate * WINJOB_FEE ?> <span>/hr</span>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href=""><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                                                        <?php
                                                        if ($total_work) {
                                                            echo $total_work . "<span class='cc_normal_txt'>hrs</span>";
                                                        } else {
                                                            echo "0.00 <span class='cc_normal_txt'>hrs</span>";
                                                        }
                                                        ?>
                                                    </a>
                                                </li>
                                                <li><a href=""><i class="fa fa-suitcase" aria-hidden="true"></i>&nbsp;<?php echo $ended_jobs; ?> <span>  Jobs Completed </span></a>
                                                </li>
                                                <li>
                                                    <a href=""><i style="margin-right: 5px;" class="fa fa-tree" aria-hidden="true"></i>&nbsp;<?php echo $exp ?> <span> Years Experience</span></a>
                                                </li>
                                                <li style="margin-bottom: -10px;">
                                                    <a style="font-size: 18px;" href=""><i style="margin-right: 4px;" class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;
                                                        <span><?php echo $country ?></span></a>
                                                </li>
                                            </ul>
                                        </div>	
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    function Confirmdecline(id) {
        var x = confirm("Are you sure!  want to Decline the User?");
        if (x) {
            $.post("<?php echo site_url('jobs/bid_decline'); ?>", {form: id}, function (data) {
                if (data.success) {
                    $('.result-msg').html('You have successfully Decline the Post');
                    window.location = "<?php echo base_url(); ?>declined?job_id=<?= $job_id ?>";
                } else {
                    alert('Opps!! Something went wrong.');
                }
                }, 'json');
            }
        }
</script>

<script src="../src/autosize.js"></script>
<script>
    autosize(document.querySelectorAll('textarea'));
</script>
<script>
    $(document).on("click", ".attach_icon", function () {
        $('#fileupload').trigger('click');
    });
    $(document).on("change", "#fileupload", function () {
        var filename = $('#fileupload').prop("files");
        var names = $.map(filename, function (val) {
            return val.name;
        });
        $('.uploaded_files').addClass('show_files');
        $.each(names, function (index, value) {
            $('.uploaded_files').append('<div class = "item"><span class = "item_name">' + value + '</span><span class = "delete_item"><i class="fa fa-times" aria-hidden="true"></i></span></div>')
        });
    });

    var removed_files = [];
    $(document).on("click", ".delete_item", function () {
        var img_name = $(this).prev().html();
        $(this).parent().remove();
        removed_files.push(img_name);
        $('#removed_files').val(removed_files);
    });

    $(document).ready(function () {
        $('.chat-details').animate({scrollTop: $('.chat-details').prop("scrollHeight")}, 1);
    });


    $('#submit').click(function () {
        var f_id = $('#user_id').val();
        var j_id = $('#job_id').val();
        var b_id = $('#bid_id').val();
        var messsage = $('#chat-input').val();
        if (messsage == "") {
            $('#error_span').html('Please enter your message');
            $("#error_span").show().delay(5000).fadeOut();
            return false;
        }

        var form_data = new FormData($('#chat_form')[0]);
        $.ajax({
            url: '<?php echo base_url() ?>Applicants/insert_message',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (data) {
                $('#scroll-ul').append(data);
                $('#chat_form')[0].reset();
                $('.chat-details').animate({scrollTop: $('.chat-details').prop("scrollHeight")}, 1);
                $('#success_span').html('Message send successfully.');
                $("#success_span").show().delay(5000).fadeOut();
            }
        });
    });

</script>
