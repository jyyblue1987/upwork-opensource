<?php
function time_elapsed_string($ptime)
{
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
<section id="big_header" class="custom_archive_list" style="margin-top: 40px; margin-bottom: 40px; height: auto;">
    <div class="container white-box-feed">
        <?php if ($this->session->flashdata('msg'))
        { ?>
            <div class="row alert alert-success"><?php echo $this->session->flashdata('msg'); ?></div>
<?php } ?>
        <div class="row">
            <div class="col-md-9 bottom-blue-border  padding-2">
                <span style="margin-right: 50px;"><a href="<?php echo site_url('jobs/bids_list'); ?>"><b>My Bids</b></a></span>&nbsp <span><a href="<?php echo site_url('jobs/archived_bids_list'); ?>"><b>Archived</b></a></span>
            </div>
        </div>
            <div class="row margin-top-1" >
			<div class="col-md-9 bordered-alert text-center ack-box" style="background: rgb(240, 240, 240) none repeat scroll 0% 0%; padding: 10px 0px; width: 779px;">
				 <h4>! You have withdrawn 1 proposals</h4>
			 </div>
		</div>
        <div class="row margin-top-3 margin-top-15">
            <div class="col-md-2 ">
                <label>Withdrawn Date</label>
            </div>

            <div style="margin-left: -38px;" class="col-md-8">
                <label>Job Title</label>
            </div>
        </div>
<?php if(empty($records)) {?>
        <div class="row">
            <div style="text-align: center;margin-top: 10px;" class="col-md-9 custom_bids_list_border">
                No Bids Available
            </div>
        </div>
<?php } else {?>

        <div class="row">
            <div class="col-md-9 margin-top-15">
                <?php foreach($records as $value) { ?>
                <div class="row">
                    <div class="col-md-12 custom_bids_list_border">
                        <div class="row">
                            <div class="col-md-2"><?php echo date('M d, Y',  strtotime($value->created));?></div>
                            <div class="col-md-10 blue-text">
                                <a href='<?php echo site_url("jobs/withdraw_system/".  base64_encode($value->id))?>'>
                                    <?php echo ucfirst($value->title); ?>
                                </a>
                            </div>
                        </div>

                        <div class="row margin-top-1">
                            <div class="col-md-2"><?php echo time_elapsed_string(strtotime($value->created)); ?></div>
                            <div class="col-md-10 ">
                                <?php echo ucfirst($value->company); ?><br/>
                                <?php // added by jahid start  ?>
                                <?php if($value->withdrawn_by=='1'){?>
                                Withdrawn By You
                             <?php }else{
                                 echo 'Withdrawn By Client';
                             } 
                             ?>
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