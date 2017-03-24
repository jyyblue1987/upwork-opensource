<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
<?php
date_default_timezone_set("UTC");

$fuser_id = $_GET['fuser'];
?>
<div class="row work_dairy">
    <div id="wrapper">
        <div class="mian-head">
            <header class="work_diary_header" style="text-transform: capitalize;">Work diary: <?= $job_details->title; ?></header>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="main-headtwo">
                        <form class="custom_workdairy_freelancer" style="margin-bottom: 12px;" action="" method="get" id="searchfilter">
                            <div style="margin-bottom: 15px;width: 238px;margin-right: 20px;" class="col-md-3 col-sm-3">
                                <input type="hidden" id="fmJob" class="form-control"  name="fmJob" value="<?= base64_encode($job_details->job_id); ?>" >
                                <select class="form-control" id="userchanges" name="fuser">
                                    <?php
                                    foreach ($userlist as $list) {
                                        $list_user_id = base64_encode($list->webuser_id);
                                        ?>
                                        <option value="<?= $list_user_id ?>" <?php if ($list_user_id == $fuser_id) {
                                        echo "selected";
                                    } ?> ><?= $list->webuser_fname; ?> <?= $list->webuser_lname; ?></option>
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


                            <!--<div class="col-md-3 col-sm-3">
                                    <h3><?php echo date('l, F j, Y '); ?></h3>
                            </div>-->



                            <?php
                            $total_work = 0;
                            if (!empty($job_done)) {
                                foreach ($job_done as $work) {
                                    $total_work +=$work->total_hour;
                                }
                            }
                            ?>												
                            <div style="margin-left: -73px;" class="col-md-3 col-sm-3">
                                <h3 style="float: right;font-family: calobri;font-weight: bold;margin-top: 2px;"><span>Total active time:</span>
                                    <span class="show_totlaworktime"><?= $total_work; ?></span>
                                </h3>
                            </div>
                            <div style="margin-left: 49px;" class="col-md-3 col-sm-3">
                                <!--<button id="top-bottom">Request Manual Hour</button>-->
                            </div>
                        </form>
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

<script>


    $(document).ready(function () {
        $("#datepicker").datepicker({
            onSelect: function () {
                $("#searchfilter").submit();
            }
        });

        $("#userchanges").change(function () {
            $("#searchfilter").submit();
            //window.location = "<?php echo base_url(); ?>jobs/workdairy_client?fmJob=<?= base64_encode($job_details->job_id); ?>&fuser="+this.value;
        });
    });
</script>