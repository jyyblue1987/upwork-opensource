<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
<?php // print_r($job_working);?>
<?php
date_default_timezone_set("UTC");

$ujob_id = $_GET['fmJob'];
?>
<div class="row work_dairy">
    <div id="wrapper">
        <div class="mian-head">
            <header class="work_diary_header" style="text-transform: capitalize;">Work diary: <?= $job_details->title; ?>
            </header>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="main-headtwo">
                        <form class="custom_workdairy_freelancer" style="margin-bottom: 12px;" action="" method="get" id="searchfilter">
                            <div style="margin-bottom: 15px;width: 238px;margin-right: 20px;" class="col-md-3 col-sm-3">
                                <input type="hidden" id="buser" class="form-control"  name="buser" value="<?= base64_encode($job_details->offerduser_id); ?>" >
                                <select class="form-control" id="jobchanges" name="fmJob">
<?php
foreach ($job_list as $list) {
    $list_job_id = base64_encode($list->job_id);
    ?>
                                        <option value="<?= $list_job_id ?>" <?php if ($list_job_id == $ujob_id) {
                                        echo "selected";
                                    } ?> ><?= $list->title; ?></option>
<?php } ?>
                                </select> 
                            </div>

                            <div class="col-md-3 col-sm-3">
                                <?php
                                if (isset($_GET['date']) && $_GET['date'] != "") {
                                    $date = date('l, F j, Y', strtotime($_GET['date']));
                                } else {
                                    $date = date('l, F j, Y');
                                }
                                ?>

                                <input id="datepicker" class="form-control datepicker"  name="date" value="<?= $date; ?>"  >
                            </div>
                        </form>
                        <!--<div class="col-md-3 col-sm-3">
                                <h3><?php echo date('l, F j, Y '); ?></h3>
                        </div>-->
                        <div style="margin-left: -73px;" class="col-md-3 col-sm-3">
                            <h3 style="float: right;font-family: calobri;font-weight: bold;margin-top: 2px;">
                                <span>Today worked:</span>

                                <?php
                                $total_work = 0;
                                if (!empty($job_done)) {
                                    foreach ($job_done as $work) {
                                        $total_work +=$work->total_hour;
                                    }
                                }
                                ?>
                                <input id="total_work_time" type="hidden" value="<?= $total_work; ?>">
                                <span class="show_totlaworktime"><?= $total_work; ?></span>
                            </h3>
                        </div>
                        <div style="margin-left: 46px;" class="col-md-3 col-sm-3">
                            <?php if ($job_details->bid_status == 2) { ?>
                                <button data-toggle="modal"  id="top-bottom">Request Manual Hour Paused</button>
                            <?php } elseif ($ststus->isactive == 0) { ?>
                                <button data-toggle="modal"  id="top-bottom">Request Manual Hour Hold</button>
<?php } else { ?>
                                <button data-toggle="modal" data-target="#manual_time" id="top-bottom">Request Manual Hour</button>
<?php } ?>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                </div>
            </div>

        </div>
        <div style="clear:both"></div>
        <div style="min-height: 281px;" class="imgaes">
            <div class="container">
                <div class="row">
                    <?php
                    foreach ($job_working as $working) {
                        //	$startwork = 	date('Y-m-d H:i:s',strtotime($working->starting_hour)); 
                        $startwork = date('H A ', strtotime($working->starting_hour));

                        for ($hourshown = 0; $hourshown < $working->total_hour; $hourshown ++) {
                            $hourdiff = '+' . $hourshown . ' hour';
                            $currentHour = date('H A ', strtotime($hourdiff, strtotime($working->starting_hour)));

                            $presenthour = date('Y-m-d H:i:s', strtotime($hourdiff, strtotime($working->starting_hour)));
                            $nexthour = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($presenthour)));
                            $date = date('Y-m-d');
                            ?>


                            <div class="col-md-1 col-sm-1">
                                <h4 class="custom_time"><?= $currentHour; ?></h4>
                            </div>
                            <div style="margin-left: -24px;" class="col-md-11 col-sm-11">
                                <?php
                                $this->db->select('*');
                                $this->db->from('workdairy_tracker');
                                $this->db->where('fuser_id', $job_details->user_id);
                                $this->db->where('jobid', $job_details->job_id);
                                $this->db->where('working_date', $date);
                                $this->db->where('capture_time >=', $presenthour);
                                $this->db->where('capture_time <=', $nexthour);
                                $query_done_hourly = $this->db->get();
                                $job_donehourly = $query_done_hourly->result();
                                //echo  $this->db->last_query();

                                foreach ($job_donehourly as $status) {
                                    //if(strtotime($status->capture_time) <  strtotime(date('Y-m-d H:i:s'))){
                                    //	$display = "display:none;";
                                    //}
                                    ?>
                                    <div class="col-md-2 col-sm-2">
                                        <div class="imgdivison">
                                            <img src="<?php echo base_url() ?>/assets/img/BOTTOM_HEADER.png"/>
                                            <p><?php echo date('j F , Y H:i:s', strtotime($status->capture_time)); ?></p>
                                        </div>
                                    </div>

        <?php } ?>

                            </div>
                            <div class="workdairy_freelancer_last_border" style="border-top: 10px solid transparent;  clear: both;  margin-bottom: 25px;border-bottom: 1px solid #ccc;"></div>

                            <?php
                        }
                        $endWork = $nexthour;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>	
</div>				
</div>


<div id="manual_time" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <header>Send your work duration</header>
                <div class="pull-left">
                    <h4> Weekly Limit : <?= $job_details->weekly_limit; ?> Hrs.</h4>
                    <?php
                    $weekly_work = 0;
                    if (!empty($job_doneweekly)) {
                        foreach ($job_doneweekly as $weekly) {
                            $weekly_work +=$weekly->total_hour;
                        }
                    }
                    ?>
                    <h4> Total weekly Work : <?= $weekly_work; ?></h4>
                </div>
                <div class="pull-right">
                    <h4> Remain  :<?php echo ($job_details->weekly_limit - $weekly_work); ?> </h4>
                </div>
            </div>
            <div class="modal-body">
                <p class="result-msg" style="text-align: center;color: green;font-size: 20px;display: none;"></p>
                <p class="result-hour" style="text-align: center;color: green;font-size: 20px;display: none;"></p>
                <form id="hourly_workcalculetor">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Start Date:</label>
                        <div class="col-sm-8">
                            <input type="text" id="staring_hour" name="staring_hour" class="form-control" required="" placeholder="Start Time">
                            <p class="start_error"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">End Date:</label>
                        <div class="col-sm-8">
                            <input type="text" id="end_hour" name="end_hour" class="form-control" required="" placeholder="End Time">
                            <p class="end_error"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Total hour:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="total_hour" name="total_hour" placeholder="Total hour">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 col-sm-offset-2">
                            <input name="weeklywork" type="hidden" id="weeklywork"  value="<?= $weekly_work; ?>"  />
                            <input name="job_id" type="hidden" id="job_id"  value="<?= $job_details->job_id ?>"  />
                            <input name="user_id" type="hidden" id="user_id"  value="<?= $job_details->user_id ?>"  />
                            <input name="clientid" type="hidden" id="clientid"  value="<?= $job_details->offerduser_id ?>"  />
                            <input name="bid_id" type="hidden" id="bid_id"  value="<?= $job_details->bid_id ?>"  />
                            <input name="weeklylimit" type="hidden" id="weeklylimit"  value="<?= $job_details->weekly_limit ?>"  />
                            <button type="button" id="submitbutton" class="btn btn-primary">Submit</button>
                            <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="closebutton" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<script>

    jQuery('#end_hour').datetimepicker({
        format: "H:i:s ",
        showMeridian: true,
        autoclose: true,
        todayBtn: false,
        pickDate: false,
        startView: 1
    });
    jQuery('#staring_hour').datetimepicker({
        format: "H:i:s ",
        showMeridian: true,
        autoclose: true,
        todayBtn: false,
        pickDate: false,
        startView: 1
    });

    $("#total_hour").click(function (e) {
        e.preventDefault;
        var end_hour = $('#end_hour').val();
        var staring_hour = $('#staring_hour').val();
        var weeklywork = $('#weeklywork').val();
        var weeklylimit = $('#weeklylimit').val();

        var difference = Math.abs(toSeconds(staring_hour) - toSeconds(end_hour));
        var result_hour = Math.floor(difference / 3600);
        var currenttotal = parseFloat(weeklywork) + parseFloat(result_hour);
        if (currenttotal > weeklylimit) {
            $('.result-hour').html('You have cross the weekly Limit ');
            $(".result-hour").show().delay(5000).fadeOut();
        }
        $('#total_hour').val(result_hour);

    });

    function toSeconds(time_str) {
        var parts = time_str.split(':');
        return parts[0] * 3600 +
                parts[1] * 60 +
                +
                parts[2];
    }




    $(document).ready(function () {
        $("#datepicker").datepicker({
            onSelect: function () {
                $("#searchfilter").submit();
            }
        });

        $("#jobchanges").change(function () {
            $("#searchfilter").submit();
            //window.location = "<?php echo base_url(); ?>jobs/workdairy_freelancer?fmJob="+this.value+"&buser=<?= base64_encode($job_details->offerduser_id); ?>";
        });


        $('#submitbutton').on('click', function (e) {
            e.preventDefault;
            var $form = $("#hourly_workcalculetor");
            var end_hour = $('#end_hour').val();
            var staring_hour = $('#staring_hour').val();
            var weeklywork = $('#weeklywork').val();
            var weeklylimit = $('#weeklylimit').val();

            if (end_hour === "") {
                $('.end_error').html("enter some value");
                $(".end_error").show().delay(5000).fadeOut();
                return false;
            }
            if (staring_hour === "") {
                $('.start_error').html("enter some value");
                $(".start_error").show().delay(5000).fadeOut();
                return false;
            }

            var difference = Math.abs(toSeconds(staring_hour) - toSeconds(end_hour));
            var result_hour = Math.floor(difference / 3600);
            var currenttotal = parseFloat(weeklywork) + parseFloat(result_hour);
            if (currenttotal > weeklylimit) {
                $('.result-hour').html('You have cross the weekly Limit ');
                $(".result-hour").show().delay(5000).fadeOut();
                return false;
            }

            $('#total_hour').val(result_hour);
            $('.form-loader').show();

            $.post("<?php echo site_url('jobs/work_hour'); ?>", {form: $form.serialize()}, function (data) {

                if (data.success) {
                    $form[0].reset();
                    $('.form-loader').hide();
                    $('.result-msg').html(data.message);
                    $(".result-msg").show().delay(5000).fadeOut();
                    var total = $('#total_work_time').val();
                    $(".show_totlaworktime").html(parseFloat(data.todaywork) + parseFloat(total));

                    window.location = "<?php echo base_url(); ?>jobs/workdairy_freelancer?fmJob=<?= base64_encode($job_details->job_id); ?>&buser=<?= base64_encode($job_details->offerduser_id); ?>";


                                    }
                                    else {
                                        $('.result-msg').html(data.message);
                                        $(".result-msg").show().delay(5000).fadeOut();
                                        alert('Opps!! Something went wrong.');
                                    }

                                }, 'json');

                            });
                        });



</script>
<style>
    .xdsoft_datepicker.active{
        display:none !important;
    }
</style>