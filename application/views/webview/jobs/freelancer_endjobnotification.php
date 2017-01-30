<?php
function time_elapsed_string($ptime){
    $etime = time() - $ptime;
    if ($etime < 1) {
        return '0 seconds';
    }
    $a = array(365 * 24 * 60 * 60 => 'year',
        30 * 24 * 60 * 60 => 'month',
        24 * 60 * 60 => 'day',
        60 * 60 => 'hour',
        60 => 'minute',
        1 => 'second'
    );
    $a_plural = array('year' => 'years',
        'month' => 'months',
        'day' => 'days',
        'hour' => 'hours',
        'minute' => 'minutes',
        'second' => 'seconds'
    );

    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}
?>



<section id="big_header" class="custom_end_job" style="margin-top: 40px; margin-bottom: 40px; height: auto;">
	<div class="container white-box-feed">
		<div class="row">
            <div class="col-md-9 bottom-blue-border padding-2">
                <span><b>Ended Jobs</b></span>
            </div>
			 <div style="background: rgb(240, 240, 240) none repeat scroll 0% 0%; padding: 10px 0px; width: 779px;" class="col-md-9 text-center bordered-alert margin-top">
				<?php
				if(!empty($job_end_data)) {
					echo count($job_end_data) ." Jobs Ended ";
				}
				?>				
			 </div>
        </div>
		
		
		<div class="row margin-top-3 margin-top-15">
            <div class="col-md-2">
                <label>Ended Date</label>
            </div>

            <div style="margin-left: -38px;" class="col-md-8">
                <label>Job Title</label>
            </div>
        </div>
		<?php if(empty($job_end_data)) {?>
        <div class="row">
            <div class="col-md-9 text-center margin-left-6 bordered margin-top">
                No Jobs Ended Yet
            </div>
        </div>
<?php } else {?>

        <div class="row">
            <div class="col-md-9 margin-top-15">
                <?php foreach($job_end_data as $value) {
					if($value->hire_title !=""){
						$job_title = $value->hire_title;
					}else{
						$job_title = $value->title;
					}
					?>
				
                <div class="row">
                    <div class="col-md-12 custom_bids_list_border">
                        <div class="row">
                            <div class="col-md-2"><?php echo date('M d, Y',  strtotime($value->end_date));?></div>
                            <div class="col-md-10 blue-text">
								<?php	if($value->job_type == "hourly"){?>
								<a href="<?php echo base_url() ?>feedback/hourly_freelancer?fmJob=<?php echo base64_encode($value->job_id);?>&buser=<?php echo base64_encode($value->feedback_clientid);?>">
								<?php }else{ ?>
								<a href="<?php echo base_url() ?>feedback/fixed_freelancer?fmJob=<?php echo base64_encode($value->job_id);?>&buser=<?php echo base64_encode($value->feedback_clientid);?>">
								<?php } ?>
                                    <?php echo ucfirst($job_title); ?>
                                </a>
                            </div>
                        </div>

                        <div class="row margin-top-1">
                            <div class="col-md-2"><?php 
                             $timeDate = strtotime($value->end_date);
                            $dateInLocal = date("Y-m-d H:i:s", $timeDate);
                            echo time_elapsed_string(strtotime($dateInLocal)); ?></div>
                            <div class="col-md-10 ">
                                 <?php echo ucfirst($value->webuser_company); ?>
                            </div>
                        </div>

                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
<?php } ?>
		
	</div>

</section>
</div>

</section>
<style>
	.row.margin-left-4 .notification_endjob li {
  background: #ddd none repeat scroll 0 0;
  display: inline-flex;
  margin-top: 5px;
  padding: 14px;
  width: 100%;
}
</style>