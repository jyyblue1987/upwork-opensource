<style>

    .message_lists{

        max-height: 250px;

        overflow-y: scroll;

        overflow-x: hidden;

        min-height: 250px;

    }

    .m_list.scroll-ul > li {

        display: block;

        margin: 10px 0 21px 5px;

        overflow: hidden;

        width: 100%;

        border-bottom: 1px solid #dddddf;

        padding-bottom: 4px;

    }

    .chat-identity .img-circle {

        float: left;

        margin-right: 14px;

    }

    #conversion_message > input {

        background: rgb(28, 167, 219) none repeat scroll 0 0;

        float: right;

        font-size: 21px;

        height: 50px;

        margin-top: 4%;

        vertical-align: middle;

        width: 19%;

    }

    #conversion_message textarea {

        float: left;

        height: 100px;

        width: 80%;

    }

    .modal-body {

        overflow: hidden;padding-bottom: 20px !important;

    }



    input.btn-default_activv{background:#028FFC;color:#fff;}

    input.btn-default_activv:hover{background:#286090;color:#fff;}

    input.btn-cancel{border:1px solid #CED0D4;color:#1CA7DB;background:#fff;}

    input.btn-cancel:hover{border:1px solid transparent;color:#fff;background:#286090;}

</style>

<section id="big_header" style="margin-top: 36px; margin-bottom: 40px; height: auto;margin-left: 14px;">



    <div class="container">

        <div class="row ">

            <div style="border: 1px solid #ccc;border-radius: 4px 4px 0 0px;margin: 0;" class="col-md-9 white-box black-box">



                <div class="row">

                    <div class="date_head">

                        <div class="col-md-6">Since <?php echo date(' M j, Y ', strtotime($job_status->start_date)); ?></div>

                        <div class="col-md-6">

                            <div class="main_id">

                                <span>ID <?= $job_status->contact_id ?>

                                </span>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="row">

                    <div class="col-md-5">

                        <div class="row">

                            <div style="margin-left: 20px;" class="col-md-4 col-md-offset-1 text-left">

                                <div class="st_img hourly_client_view_st_img">

                                    <img src="<?php echo app_user_img( $job_status->cropped_image ) ?>" width="64" height="64" />

                                </div>

                            </div>

                            <div style="margin-left: -24px;" class="col-md-7 text-left">



                                <h5 style="margin-top: -4px;" class="free_name"><?= $job_status->webuser_fname ?> <?= $job_status->webuser_lname ?></label>



                                    <br> <p class="free_name"><?= character_limiter($job_status->webuser_company, 68, '...') ?></p>

                            </div>

                        </div>

                    </div>



                    <div class="col-md-3 text-center gray-text">

                        <div style="margin-top: -8px;" class="status_bar">

                            <?php if ($job_status->jobstatus == 1) { ?>

                                <label class="gray-text">Status : Ended</label>

                            <?php } else { ?>

                                <label class="gray-text">Status : Active</label>

                            <?php } ?>

                        </div>

                    </div>



                    <div class="col-md-3 col-md-offset-1">

                        <div class="msg_btnx hour_btn">

                            <input type="button" class="btn-primary transparent-btn big_mass_button" value="Message" onclick="loadmessage(<?= $job_status->bid_id ?>,<?= $job_status->fuser_id ?>,<?= $job_status->job_id ?>)" />

                        </div>



                    </div>

                </div>

                <div class="col-md-12">

                    <div class="job_title client_job_title">

                        <span class="clint_view_j-title"> <?php
                            if ($job_status->hire_title != "") {

                                $job_title = $job_status->hire_title;
                            } else {

                                $job_title = $job_status->title;
                            }
                            ?>

                            <?= character_limiter($job_title, 35, '...'); ?></span><br />

                        <a href="<?php echo base_url() ?>jobs/<?php echo url_title($job_status->title) ?>/<?php echo base64_encode($job_status->job_id); ?>">View original job post</a>

                    </div>

                </div>

            </div>

        </div>

        <div class="bg-change"></div>

        <div class="row ">

            <div style="padding: 3px 10px 5px;border: 1px solid #ccc;border-top: 0;border-radius: 0 0 4px 4px;" class="col-md-9 white-box remove-border-top ">





                <div class="row">

                </div>

                <div style="margin-left: 28px;" class="row margin-top-2 bordered_week">

                    <div class="col-md-10 col-md-offset-1">

                        <div class="row">

                            <div style="padding-top: 5px; margin-right: -6px;" class="col-md-4 paid_table_title text-centered text-center"><b>Amount</b></div>

                            <div style="padding-top: 5px; border-left: 2px solid #ededed; margin-right: 10px;" class="col-md-4 text-centered text-center"><b>Paid</b></div>

                            <div style="width: 76px; padding-top: 5px; margin-left: 0px; padding-left: 83px; border-left: 2px solid rgb(237, 237, 237);" class="col-md-4 text-centered text-center"><b>Remaining</b></div>

                        </div>

                    </div>

                    <div class="row margin-top-1">

                        <div class="col-md-10  col-md-offset-1">

                            <div class="row nav-bar">

                                <div style="padding-bottom: 5px;" class="col-md-4 text-center nav-bar-item">

                                    <span class="bold_text">

                                        $<?= $job_status->hired_on; ?>

                                    </span>

                                </div>

                                <div style="padding-bottom: 5px;" class="col-md-4 text-center nav-bar-item">

                                    <span class="bold_text">

                                        $<?= $job_status->fixedpay_amount; ?>

                                    </span>

                                </div>

                                <div style="padding-bottom: 5px;" class="col-md-4  text-center nav-bar-item">

                                    <span class="bold_text">

                                        $<?php
                            $remain_budget = $job_status->bid_amount - $job_status->fixedpay_amount;

                            if ($remain_budget < 0)
                                echo '0';
                            else
                                echo $remain_budget;
                            ?>

                                    </span>

                                </div>

                            </div>

                        </div>



                    </div>

                </div>



                <div class="row margin-top-1">



                </div>

                <?php $this->load->view("webview/jobs/partials/job-transactions", compact('payments', 'job_status')); ?>
                
                <div class="row margin-top-5 margin-bottom-2">

                    <div class="col-md-10 col-md-offset-1">

                        <div class="row">

                            <div class="col-md-6">



                                <div class="">

                                    <input style="float: left;margin-left: 0;" type="button" class="btn my_btn btn-cancel" value="Add Milestone" id ="2" onclick="editClickedMilestone(this.id)" />

                                </div>



                                <input style="margin-left: 15px;" type="button" class="btn my_btn btn-cancel" value="Payment"  id ="2" onclick="editClickedPayment(this.id)" />



                            </div>



                            <div class="col-md-6">



                                <div style="float: left; position: absolute;right: 143px;" class="cancel_content_btn">

                                    <input value="Cancel" class="btn my_btn btn-cancel" type="button"> 

                                </div>



                                <div class="">

<?php if ($job_status->jobstatus == 1) { ?>

                                        <a href="<?php echo base_url() ?>feedback/fixed_client?fmJob=<?php echo base64_encode($job_status->job_id); ?>&fuser=<?php echo base64_encode($job_status->fuser_id); ?>">

                                            <input style="float: right;margin-right: 0px;" type="button" class="btn my_btn btn-default_activv" value="End Contract" />

                                        </a>

<?php } else { ?>

                                        <a href="<?php echo base_url() ?>endhourlyfixed/fixed_client?fmJob=<?php echo base64_encode($job_status->job_id); ?>&fuser=<?php echo base64_encode($job_status->fuser_id); ?>">

                                            <input style="float: right;margin-right: 0px;" type="button" class="btn my_btn btn-default_activv" value="End Contract" />

                                        </a>

<?php } ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



</section>



</div>



</section>

<!-- big_header-->



<!-- Modal -->

<div id="message_convertionModal" class="modal">

    <div class="modal-dialog cccc_massage_box">

        <div style="padding: 30px;padding-bottom: 60px;" class="modal-content">

            <button type="button" class="close" data-dismiss="modal" onclick="hidemessagepopup();">&times;</button>

            <h4 class="modal-title">Message</h4>

            <div class="modal-header">

                <div class="col-lg-12 col-md-12 col-sm-12 chat-screen">

                    <div class="chat-details-topbar">

                        <h3><?= $job_status->webuser_fname ?> <?= $job_status->webuser_lname ?></h3>

                        <h5><?= character_limiter($job_title, 35, '...');; ?> </h5>



                    </div>

                </div>

            </div>

            <div class="modal-body">

                <div class="message_lists chat-details form-group" ></div>

                <form style="position:relative;" name="message" action="" method="post" id="conversion_message">

                    <textarea style="width: 76%;" name="usermsg"  id="usermsg"></textarea>

                    <div style="position: absolute;right: 23%;font-size: 26px;top: 35%;color:#a2a2a2;transform: rotate(90deg);" class="attach_icon">

                        <i style="cursor: pointer;" class="fa fa-paperclip" aria-hidden="true"></i>

                    </div>

                    <input name="job_id" type="hidden" id="job_id"  value="" />

                    <input name="bid_id" type="hidden" id="bid_id"  value=""  />

                    <input name="sender_id" type="hidden" id="sender_id"  value="<?php echo $this->session->userdata('id'); ?>"  />

                    <input name="receiver_id" type="hidden" id="receiver_id"  value=""  />

                    <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />

                </form>

            </div>

        </div>

    </div>

</div>



<?php
$this->load->view("webview/jobs/milestone-modal");

$this->load->view("webview/jobs/payment-modal");

$this->load->view("webview/includes/footer-common-script");
?>





<script type="text/javascript">



    function editClickedMilestone(clicked_id) {

        // jQuery.noConflict();

        var key = $(this).attr('accesskey');

        var buser_id_value = "<?php echo $job_status->buser_id; ?>";

        var fuser_id_value = "<?php echo $job_status->fuser_id; ?>";

        var job_id_value = "<?php echo $job_status->job_id; ?>";

        $.ajax({
            url: "<?php echo base_url() ?>pay/add_milestone/" + clicked_id,
            data: ({key: key, buser_id: buser_id_value, fuser_id: fuser_id_value, job_id: job_id_value}),
            dataType: "html",
            type: "post",
            success: function (response) {

                $('#milestone-details-modal').html(response.trim());



                $('#edit-milestone').modal('show');

            },
            error: function (status, error, textStatus) {

                alert(error);

            }

        });

        $('#edit-milestone').modal('show');

    }

    function editClickedPayment(clicked_id) {
        (function($){
            // jQuery.noConflict();
            var key = $(this).attr('accesskey');
            var buser_id_value = "<?php echo $job_status->buser_id; ?>";
            var fuser_id_value = "<?php echo $job_status->fuser_id; ?>";
            var job_id_value   = "<?php echo $job_status->job_id; ?>";

            $.ajax({
                url: "<?php echo base_url() ?>pay/full_milestone/" + clicked_id,
                data: ({key: key, buser_id: buser_id_value, fuser_id: fuser_id_value, job_id: job_id_value}),
                dataType: "html",
                type: "post",
                success: function (response) {
                    $('#payment-details-modal').html(response.trim());
                    $('#edit-payment').modal('show');
                },
                error: function (status, error, textStatus) {
                    alert(error);
                }
            });

            $('#edit-payment').modal('show');
        })(jQuery);
    }





    function loadmessage(b_id, u_id, j_id) {



        var modal = document.getElementById('message_convertionModal');

        $.post("<?php echo site_url('jobconvrsation/message_from_superhero'); ?>", {job_bid_id: b_id, user_id: u_id, job_id: j_id}, function (data) {

            $('.message_lists').html(data.html);

            $('#job_id').val(j_id);

            $('#bid_id').val(b_id);

            $('#receiver_id').val(u_id);

            // $('#message_convertionModal').modal('show');

            modal.style.display = "block";

            // $('.message_lists').animate({scrollTop: $('.message_lists').prop("scrollHeight")}, 500);

            autoloading();

        }, 'json');



    }

    function hidemessagepopup() {

        var modal = document.getElementById('message_convertionModal');

        modal.style.display = "none";

    }



    $("#conversion_message").on("submit", function (e) {

        e.preventDefault();

        var $form = $("#conversion_message");

        if ($('#usermsg').val().trim().length > 0) {

            $.post("<?php echo site_url('jobconvrsation/add_conversetion'); ?>", {form: $form.serialize()}, function (data) {

                if (data.success) {

                    $form[0].reset();

                    loadmessage($('#bid_id').val(), $('#receiver_id').val(), $('#job_id').val());



                } else {

                    alert('Opps!! Something went wrong.');

                }



            }, 'json');

        }



    });



    function loadmessage_auto( ) {



        var auto_job_id = $('#job_id').val();

        var auto_bid_id = $('#bid_id').val();

        var auto_receiver_id = $('#receiver_id').val();



        var modal = document.getElementById('message_convertionModal');

        $.post("<?php echo site_url('jobconvrsation/message_from_superhero'); ?>", {job_bid_id: auto_bid_id, user_id: auto_receiver_id, job_id: auto_job_id}, function (data) {

            $('.message_lists').html(data.html);



            //$('.message_lists').animate({scrollTop: $('.message_lists').prop("scrollHeight")}, 500);

        }, 'json');

    }



    function autoloading() {

        //alert('hi');

        var auto_job_id = $('#job_id').val();

        var auto_bid_id = $('#bid_id').val();

        var auto_receiver_id = $('#receiver_id').val();



        if (auto_job_id) {

            auto_job_id = auto_job_id;

        } else {

            auto_job_id = 0;

        }

        if (auto_bid_id) {

            auto_bid_id = auto_bid_id;

        } else {

            auto_bid_id = 0;

        }

        if (auto_receiver_id) {

            auto_receiver_id = auto_receiver_id;

        } else {

            auto_receiver_id = 0;

        }



        if (auto_job_id && auto_bid_id && auto_receiver_id) {

            setInterval('loadmessage_auto()', 5000);

        }

    }

    autoloading();

</script>

<script>



</script>

