<?php
function time_elapsed_string($ptime){
    $etime = time() - $ptime;

    if ($etime < 1)
    {
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

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}
?>


<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css" />

<section id="big_header"
         style="margin-top: 50px; margin-bottom: 50px; height: auto;">

    <div class="container white-box-feed">
        <?php if ($this->session->flashdata('msg'))
        { ?>
            <div class="row alert alert-success"><?php echo $this->session->flashdata('msg'); ?></div>
<?php } ?>
        <div class="row">
            <div class="col-md-9 bottom-blue-border padding-2">
                <span>My Offers</span>
            </div>
            <div class="col-md-9 text-center  bordered-alert margin-top" style="padding:10px; background:#f0f0f0;">
               <?php
			if(!empty($active_offer)){
			$aoffer = 0;
			foreach($active_offer as $offer){
				$aoffer++;
			}
			if($aoffer != 1){
				echo $aoffer." Offers Available";
			} else {
				echo "No Offers Available";
			}
                        }else{
                            echo "No Offers Available";
                        }
			?>
            </div>
        </div>
        <div class="row margin-top-3">
            <div class="col-md-2 ">
                <label>Applied Date</label>
            </div>

            <div class="col-md-8">
                <label>Job Title</label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9  margin-top">
                <?php foreach($active_offer as $offer){?>
                <div class="row">
                    <div class="col-md-12 bordered">
                        <div class="row">
                            <div class="col-md-2"><?php  echo date(' F j, Y ', strtotime($offer->bid_created)); ?></div>
                            <div class="col-md-10 blue-text">
                                <a href="<?php echo base_url() ?>jobs/accept_hourly?fmJob=<?php echo base64_encode($offer->job_id);?>"> 
                                 <?php echo $offer->title;?> 
                                 </a>
                            </div>
                        </div>

                         <div class="row margin-top-1">
                            <div class="col-md-2"><?php 
                            $timeDate = strtotime($offer->bid_created);
                            $dateInLocal = date("Y-m-d H:i:s", $timeDate);
                            
                            echo time_elapsed_string(strtotime($dateInLocal)); ?></div>
                            <div class="col-md-10 ">
                               <?php echo $offer->webuser_company;?>
                            </div>
                        </div>

                    </div>
                </div>
               <?php } ?>
            </div>
        </div>
            
        <div class="row"  style="margin-top: 80px;">
            <div class="col-md-9 bottom-blue-border  padding-2">
                
                <span><a href="<?php echo site_url('Active_interview'); ?>">Active Interview</a></span>&nbsp <span><a href="<?php echo site_url('Active_interview/declined_interview'); ?>">Declined Interview</a></span>

            </div>
            <div class="col-md-9 text-center  bordered-alert margin-top" style="padding:10px; background:#f0f0f0;">
			<?php
			if(!empty($active_interview)){
			$a = 1;
			foreach($active_interview as $interview){
				if($interview->jbid_id !=""){
					continue;
				}
				$a++;
			}
			if($a != 1){
				echo $a." Interview Available";
			} else {
				echo "No Interview Available";
			}
			}
			?> 
            </div>
        </div>
        <div class="row margin-top-3">
            <div class="col-md-2 ">
                <label>Applied Date</label>
            </div>

            <div class="col-md-8">
                <label>Job Title</label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9  margin-top">
                <?php foreach($active_interview as $interview){
                  
                    
                    if($interview->jbid_id !=""){
                    ?>
                <div class="row">
                    <div class="col-md-12 bordered">
                        <div class="row">
                            <div class="col-md-2"><?php  echo date(' F j, Y ', strtotime($interview->bid_created)); ?></div>
                            <div class="col-md-10 blue-text">
                                <a href="<?php echo base_url() ?>Freelancerinvite?fmJob=<?php echo base64_encode($interview->job_id);?>"> <?php echo $interview->title;?></a>
                            </div>
                        </div>

                        <div class="row margin-top-1">
                            <div class="col-md-2"><?php echo time_elapsed_string(strtotime($interview->bid_created)); ?></div>
                            <div class="col-md-10 ">
                               <?php echo $interview->webuser_company;?>
                            </div>
                        </div>

                    </div>
                </div>
                  <?php } } ?>
           
            </div>
        </div>

    </div>

</section>

</div>

</section>
<!-- big_header-->

<!-- <hr> -->

</div>

</section>

<script src="<?php echo base_url() ?>assets/js/dropzone.js"></script>
<script>

</script>