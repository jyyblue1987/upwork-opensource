<section id="big_header"
         style="margin-top: 50px; margin-bottom: 50px; height: auto;">

    <div class="container">
        <div class="row ">
            <div class="col-md-9 white-box black-box bordered_top">

                <div class="row">
                   <div class="date_head">
                        <div class="col-md-6">Since <?php echo date(' M j, Y ', strtotime($job_status->start_date)); ?></div>
                    <div class="col-md-4 col-md-offset-2">
                      <div class="main_id">
                          <span>ID <?= $job_status->contact_id ?>
                    </span>
                      </div>
                    </div>
                   </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1 text-left">
                                <div class="st_img">
                                    <?php if ($job_status->webuser_picture != "") { ?>
                                    <img src="<?php echo base_url() . $job_status->webuser_picture ?>" width="64" height="64" />
                                <?php } else { ?>
                                    <img src="<?php echo base_url() ?>assets/img/profile_img.jpg" width="64" height="64" />
                                <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-7 text-left">
                               
                                    <h5 class="free_name"><?= $job_status->webuser_fname ?> <?= $job_status->webuser_lname ?></label>
                            
                                <br> <p class="free_name"><?= $job_status->webuser_company ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 text-center gray-text">
                        <?php if ($job_status->jobstatus == 1) { ?>
                            <label class="gray-text">Status : Ended</label>
                        <?php } else { ?>
                            <label class="gray-text">Status : Active</label>
                        <?php } ?>
                    </div>

                    <div class="col-md-3 col-md-offset-1">
                       <div class="msg_btnx hour_btn">
                           <input type="button" class="transparent-btn" value="Message" onclick="loadmessage(<?= $job_status->bid_id ?>,<?= $job_status->fuser_id ?>,<?= $job_status->job_id ?>)" />
                       </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">
                    <div class="job_title">
                            <?php
                        if ($job_status->hire_title != "") {
                            $job_title = $job_status->hire_title;
                        } else {
                            $job_title = $job_status->title;
                        }
                        ?>
<?= $job_title; ?>  <br />
                        <a href="<?php echo base_url() ?>jobs/view/<?php echo url_title($job_status->title) ?>/<?php echo base64_encode($job_status->job_id); ?>">View original job post</a>
                       </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-9 white-box remove-border-top">

                <div class="row">
                <div class="row margin-top-2 bordered_week">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-md-4 text-centered text-center"><b>Amount</b></div>
                            <div class="col-md-4 text-centered text-center"><b>Paid</b></div>
                            <div class="col-md-4 text-centered text-center"><b>Remaining</b></div>
                        </div>
                    </div>
                    <div class="row margin-top-1">
                    <div class="col-md-10  col-md-offset-1">
                        <div class="row nav-bar">
                            <div class="col-md-4 text-center nav-bar-item">
                                <span class="bold_text">
                                    $<?= $job_status->hired_on; ?>
                                </span>
                            </div>
                            <div class="col-md-4 text-center nav-bar-item">
                                <span class="bold_text">
                                    $<?= $job_status->fixedpay_amount; ?>
                                </span>
                            </div>
                            <div class="col-md-4  text-center nav-bar-item">
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


                <div class="row margin-top margin-top-5">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                         
                          <div class="fix_view">
                                <div class="col-md-8 text-centered text-left">Description</div>
                            <div class="col-md-2 text-centered text-right">Amount</div>
                            <div class="col-md-2 text-centered text-left">Date</div>
                          </div>
                 
                        </div>
                        <div class="u_border"></div>
                    </div>
                </div>


                <div class="row margin-top-2">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <?php
                            foreach ($payments as $payment) {
                                ?>
                                <div class="col-md-8 text-centered text-left gray-text"><?php if ($payment->payment_gross == $job_status->bid_amount) {
                                echo "Paid All";
                            } elseif ($payment->payment_gross < $job_status->bid_amount || $payment->payment_gross > $job_status->bid_amount) {
                                echo $payment->des;
                            } elseif ($payment->payment_gross == 0) {
                                echo "Paid Nothing";
                            } ?></div>
                                <div class="col-md-2 text-centered text-right gray-text">$<?= $payment->payment_gross; ?></div>
                                <div class="col-md-2 text-centered text-center gray-text"><?php echo date(' M j, Y ', strtotime($payment->payment_create)); ?></div>
    <?php
}
?>
                        </div>
                    </div>
                </div>


                <div class="row margin-top-5 margin-bottom-2">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-md-4 text-left">
                            
                               <div class="client_milestone">
                                     <input type="button" class="btn my_btn" value="Add Milestone" id ="2" onclick="editClickedMilestone(this.id)" />
                               </div>
                            
                            </div>
                            <div class="col-md-4 text-centered text-center"><input type="button" class="btn my_btn" value="Payment"  id ="2" onclick="editClickedPayment(this.id)" /></div>
                            <div class="col-md-4 text-centered text-right">

                            <div class="client_end_btn">
                                <?php if ($job_status->jobstatus == 1) { ?>
                                    <a href="<?php echo base_url() ?>feedback/fixed_client?fmJob=<?php echo base64_encode($job_status->job_id); ?>&fuser=<?php echo base64_encode($job_status->fuser_id); ?>">
                             <input type="button" class="btn my_btn" value="End Contract" />
                                    </a>
<?php } else { ?>
                                    <a href="<?php echo base_url() ?>endhourlyfixed/fixed_client?fmJob=<?php echo base64_encode($job_status->job_id); ?>&fuser=<?php echo base64_encode($job_status->fuser_id); ?>">
                                        <input type="button" class="btn my_btn" value="End Contract" />
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="hidemessagepopup();">&times;</button>
                <h4 class="modal-title">Message</h4>
                <div class="col-lg-12 col-md-12 col-sm-12 chat-screen">
                    <div class="chat-details-topbar">
                        <h3><?= $job_status->webuser_fname ?> <?= $job_status->webuser_lname ?></h3>
                        <h5><?= $job_title; ?> </h5>

                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="message_lists chat-details form-group" ></div>
                <form name="message" action="" method="post" id="conversion_message">
                    <textarea name="usermsg"  id="usermsg"></textarea>
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
       // jQuery.noConflict();
        var key = $(this).attr('accesskey');
        var buser_id_value = "<?php echo $job_status->buser_id; ?>";
        var fuser_id_value = "<?php echo $job_status->fuser_id; ?>";
        var job_id_value = "<?php echo $job_status->job_id; ?>";
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

                }
                else {
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
<style>
    .message_lists{
        max-height: 250px;
        overflow-y: scroll;
        overflow-x: hidden;
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
        overflow: hidden;
    }
</style>
<script>

</script>
