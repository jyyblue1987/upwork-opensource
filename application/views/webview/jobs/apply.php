<style type="text/css">
#buttonfirst {
    background: #eba705 none repeat scroll 0 0;
    border: medium none;
    border-radius: 5px;
    color: #fff;
    float: left;
    font-family: "Arial";
    font-size: 17.5px;
    margin-top: 2px;
    padding: 5px 7px;
}
</style>

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

<?php

/* find client payment set status start */

$this->db->select('*');
$this->db->from('billingmethodlist');
$this->db->where('billingmethodlist.belongsTo', $value->webuser_id);
// $this->db->where('billingmethodlist.paymentMethod', "stripe");
$this->db->where('billingmethodlist.isDeleted', "0");
$query = $this->db->get();
$paymentSet = 0;
if (is_object($query)) {
    $paymentSet = $query->num_rows();
}
/* find client payment set status end */


/* find total spent by client start */
$client_id=$value->webuser_id;
$query_spent = $this->db->query("SELECT SUM(payment_gross) as total_spent FROM `payments` INNER JOIN `webuser` ON `webuser`.`webuser_id` = `payments`.`user_id` INNER JOIN `jobs` ON `jobs`.`id` = `payments`.`job_id` INNER JOIN `job_accepted` ON `job_accepted`.`job_id` = `payments`.`job_id` INNER JOIN `job_bids` ON `job_bids`.`job_id` = `payments`.`job_id` WHERE `job_accepted`.`fuser_id` = `payments`.`user_id` AND
    `job_bids`.`user_id` = `payments`.`user_id` AND `payments`.`buser_id` = $client_id");
$row_spent = $query_spent->row();
$total_spent=$row_spent->total_spent;
/* find total soent by client end */




$total_feedbackScore=0 ;
$total_budget=0 ;
foreach($accepted_jobs as $job_data){
	$this->db->select('*');
	$this->db->from('job_feedback');
	$this->db->where('job_feedback.feedback_userid',$job_data->fuser_id);
	$this->db->where('job_feedback.sender_id !=',$job_data->fuser_id);
	$this->db->where('job_feedback.feedback_job_id',$job_data->job_id);
	$query=$this->db->get();
	$jobfeedback= $query->row();
	
	if($job_data->jobstatus == 1){
		if(!empty($jobfeedback)){
			if($job_data->job_type == "fixed"){
				$total_price_fixed=$job_data->fixedpay_amount;
				$total_feedbackScore += ($jobfeedback->feedback_score *$total_price_fixed);
				$total_budget += $total_price_fixed;
			}else{
				$this->db->select('*');
				$this->db->from('job_workdairy');
				$this->db->where('fuser_id',$job_data->fuser_id);
				$this->db->where('jobid',$job_data->job_id);
				$query_done = $this->db->get();
				$job_done = $query_done->result();
				$total_work = 0;
				foreach($job_done as $work){
					$total_work +=$work->total_hour;
				}
				
				if($job_data->offer_bid_amount) {
				$amount = $job_data->offer_bid_amount;
				} else {$amount =  $job_data->bid_amount;} 
				 $total_price= $total_work *$amount;
				$total_budget += $total_price ;
				$total_feedbackScore += ($jobfeedback->feedback_score *$total_price);
			}
		}
	}
}
?>

<section id="big_header" style="margin-top: 40px; margin-bottom: 40px; height: auto;">

    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-0 white-box" style="padding: 20px 30px;border: 1px solid #ccc;">
                <div class='form-msg'></div>
                <div class="row">
                    <div class="col-md-10 page-label">
                        <h1 class="job-title cos_job-title"><?php echo ucfirst($value->title) ?></h1>
                    </div>
					
					<div class="col-md-2 page-label">                        
                        <span style="margin-top: -15px;" class="pull-right"><?php 
                         $timeDate = strtotime($value->job_created);
                            $dateInLocal = date("Y-m-d H:i:s", $timeDate);
                        echo time_elapsed_string(strtotime($dateInLocal)); ?></span>
                    </div>
					
                </div>
<div class="jobdes-bordered-wrapper">
                <div class="row jobdes-bordered page-label">
                    <div class="col-md-3 text-center">
                        <label style="font-family: calibri;font-size: 17px;">Job Type</label> <br /> <span><?php echo ucfirst($value->job_type) ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label style="font-family: calibri;font-size: 17px;">
                            <?php
                            if ($value->job_type == 'hourly')
                            {
                                echo "Hourly Per week";
                            } else
                            {
                                echo '$';
                            }
                            ?>
                        </label><br /><span><?php
                            if ($value->job_type == 'hourly')
                            {
                                echo $value->hours_per_week;
                            } else
                            {
                                echo '$' . round($value->budget, 2);
                            }
                            ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label style="font-family: calibri;font-size: 17px;">Job Duration</label><br /> <span><?php echo str_replace('_', '-', $value->job_duration) ?></span>
                    </div>

                    <div class="col-md-3 last-div text-center page-label">
                        <label style="font-family: calibri;font-size: 17px;">Experience Level</label><br /> <span><?php echo ucfirst($value->experience_level); ?></span>
                    </div>
                </div>
</div>

                <div style="margin-top: 15px;" class="row margin-top">
                    <div class="col-md-2">
                        <label style="font-family: calibri;font-size: 16px;">Job Category</label>
                    </div>
                    <div style="margin-top: 4px;" class="col-md-10">
						<?php 
                       
						$this->db->select('*');
						$this->db->from('job_subcategories'); 
						$this->db->where('subcat_id',$value->category);
						$query_done = $this->db->get();
                        $result= $query_done->row();
                        echo $result->subcategory_name;
						?>
                    </div>
                </div>

                <div class="row margin-top page-label">
                    <div class="col-md-2">
                        <label>Skills</label>
                    </div>

                    <div style="margin-top: -2px;" class="col-md-10 skills page-label">
						<div class="custom_user_skills">
							<?php
							if (isset($value->skills) && !empty($value->skills))
							{
								$skills = explode(' ', $value->skills);
								foreach ($skills as $skill)
									echo "<span> $skill</span> ";
							}
							?>
						</div>
                    </div>
                </div>

                <div class="row margin-top page-label">
                    <div class="col-md-9">
                        <label>Detail</label>
                    </div>

                    <div style="font-family: calibri; font-size: 16px; margin-bottom: 17px; margin-top: 8px;" class="col-md-12 text-justify page-label"><?php echo ucfirst($value->job_description) ?></div>
                </div>
<div class="jobdes-bordered-wrapper">
                <div class="row jobdes-bordered page-label">
                   
                    <div class="col-md-4 text-center">
 <?php 
 
 
$this->db->select('*');
$this->db->from('job_bids');
$this->db->where(array('job_id'=>$value->job_id,'bid_reject'=>0, 'status!=1'=>null));
$query =$this->db->get();
$Proposals_count = $query->num_rows();
//var_dump($value->id);var_dump($Proposals_count);die();

$jobfeedback= $query->result();
?>
                        <label style="font-family: calibri;font-size: 17px;">Proposals</label> <br /> <span>
                       <?=$Proposals_count;?>
                        </span>
                    </div>

                    <div class="col-md-4 text-center page-label">
 <?php 
$this->db->select('*');
$this->db->from('job_conversation');
$this->db->where('job_conversation.sender_id', $value->user_id);
$this->db->join('job_bids', 'job_bids.id=job_conversation.bid_id', 'inner');
$this->db->where('job_conversation.job_id', $value->job_id);
$this->db->where('job_bids.bid_reject', 0);
$this->db->group_by('bid_id'); 
$query=$this->db->get();
$interview_count = $query->num_rows();
?>
                        <label style="font-family: calibri;font-size: 17px;">Interviewing</label><br /> <span><?=$interview_count;?> </span>
                    </div>

                    <div class=" last-div col-md-4 text-center page-label">
<?php
$this->db->select('*');
$this->db->from('job_accepted');
$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
$this->db->where('job_accepted.buser_id',$value->user_id);
$this->db->where('job_accepted.job_id',$value->job_id);
$this->db->where('job_bids.hired', '0' );
$this->db->where('job_bids.jobstatus', '0' );
$query=$this->db->get();
$hire_count = $query->num_rows();
?>
                        <label style="font-family: calibri;font-size: 17px;">Hired</label><br /> <span>
                            <?php echo $hire_count;?>
                        </span>
                    </div>
                </div>
    </div>
			
            <form method="post" id='jobApply'>
                <input type="hidden" name='job_id' id='jobId' value='<?php echo $value->job_id; ?>'/>
                <input type="hidden" name='job_title' id='job_title' value='<?php echo $value->title; ?>'/>
                <div class="col-md-12 white-box col-md-offset-0" style="padding:35px 20px 20px;padding-left: 0;padding-right: 0;">

                    <div class="row">
                        <div class="col-md-12 page-label">
                            <h1 style='font-family: "calibri"; font-size: 25px; margin-bottom: 22px;'>Proposed Terms</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 col-md-offset-4 page-label">
                                    <label style="font-family: calibri;font-size: 17px;">Your Bid</label>
                                </div>

                                <div style="margin-left: -35px;" class="col-md-4">
                                    <div style="font-size: 17px;" class="col-md-1">$</div>
                                    <div class="col-md-9">
                                        <?php
                                        $bidAmt = '';
                                        $perHrs='';
                                        if ($value->job_type == 'hourly')
                                        {
                                            if ($value->hourly_rate)
                                            {
                                                $bidAmt = $value->hourly_rate;
                                            } else
                                                $rateMsg = 1;
                                            $perHrs='/hr';
                                        }
                                        ?>
                                        <input type="text" class="form-control" name='bid_amount' id='bid_amount' value='<?php echo $bidAmt; ?>' style="float: left;width: 80px;font-size: 17px;margin-left: -5px;margin-bottom: 18px;border-radius: 4px;"/><label style=' margin-left: 2px;margin-top: 6px;position: absolute;'><?php echo $perHrs?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-md-offset-4 page-label">
                                    <label style="font-family: calibri;font-size: 17px;">10% Winjob Fee</label>
                                </div>

                                <div style="margin-left: -35px;" class="col-md-4">
                                    <div style="font-size: 17px;" class="col-md-1">$</div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name='bid_fee' id='bid_fee' disabled style="float: left;width: 80px;font-size: 17px;margin-left: -5px;margin-bottom: 18px;border-radius: 4px;" /><label style=' margin-left: 2px;margin-top: 6px;position: absolute;'><?php echo $perHrs?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-md-offset-4 page-label" >
                                    <label style="font-family: calibri;font-size: 17px;">Your Earnings</label>
                                </div>

                                <div style="margin-left: -35px;" class="col-md-4">
                                    <div style="font-size: 17px;" class="col-md-1">$</div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name='bid_earning' id='bid_earning' disabled style="float: left;width: 80px;font-size: 17px;margin-left: -5px;margin-bottom: 18px;border-radius: 4px;"/><label style=' margin-left: 2px;margin-top: 6px;position: absolute;'><?php echo $perHrs?></label>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($rateMsg))
                            {
                                ?>
                                <div class="row page-label" style="float: left;margin-left: 239px;">
                                    <label>Your hourly rate is not defined, Click <a href='<?php echo site_url('profile/basic'); ?>'>here</a> to update.</label>
                                </div>
<?php } ?>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>

                    </div>
                    <?php if ($value->job_type != 'hourly') { ?>
                    <div style="margin-top: 15px;" class="row">
                        <div class="col-md-12 page-label">
                            <label>Job Duration</label>
                        </div>

                        <div class="col-md-4">
                            <select class="form-control" name='job_duration' id='job_duration'>
                                <option value="not_sure">Not Sure</option>
                                <option value="Less than 1 week">Less than 1 week</option>
                                <option value="Less than 1 month">Less than 1 month</option>
                                <option value="1-3 months">1-3 months</option>
                                <option value="3-6 months">3-6 months</option>
                                <option value="More than 6 months">More than 6 months</option>
                            </select>
                        </div>
                    </div>
                    <?php } ?>

                    <div style="margin-top: 23px;" class="row">
                        <div class="col-md-9 page-label">
                            <p class="apply_job_custom_cover-letter">Cover Letter</p>
                        </div>

                        <div class="col-md-12 text-justify">
                            <textarea style='font-size: 17px;line-height: 26px;font-family: "Calibri";' rows="8" class="form-control" name='cover_latter' id='cover_latter'></textarea>
                        </div>
                    </div>

                    <div style="margin-top: 25px; padding: 0px 15px;" class="row page-label">
                        <div class="col-md-12">
                            <label style="margin-bottom: 10px;margin-left: -15px;">Attachment (Optional)</label>
                        </div>

                        <div class="col-md-12 job-attachment">
                            <div class="dropzone" id="my-dropzone" name="job_attachement">
                                <div class="fallback">
                                    <input name="job_attachement" type="file" multiple />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row margin-top">
                        <div style="margin-left: 15px;" class="col-md-10">
                            <input style="float: left;margin-left: -15px;" type="submit" class="btn-primary big_mass_active transparent-btn big_mass_button" value="Submit a Proposal" id='submit-all'/>
                            <input style="float: left;" type="button" class="transparent-btn big_mass_button" value="cancel" onclick="window.history.go(-1);"/>
                            <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
                        </div>
                    </div> 

                </div>
            </form>
            </div>
			
			
            <div style="margin-left: -2px;margin-top: 20px;" class="col-md-3" >
                <div class="row client-activity">
                    <div style="padding: 0 30px 9px;border-radius: 4px;width: 210px;" class="col-md-10 col-md-offset-2 right-section ">
                        <div class="row margin-top-2">
                            <div class="col-md-12">
                                
                                <?php
if ($value->isactive && $paymentSet) {
    ?>
										<i style="margin-top: -10px; margin-left: -4px; font-size: 25px; color: rgb(2, 143, 204);position: absolute;top: 8px;" class="fa fa-check-circle"></i>
                                        <?php
                                    } else {
                                        ?>
                                        <i style="margin-top: -10px; margin-left: -4px; font-size: 25px; color: rgb(187, 187, 187);position: absolute;top: 8px;" class="fa fa-minus-circle"></i>
                                        <?php
                                    }
                                    ?>
                                <label style="margin-left: 25px;"><?php echo ucfirst($value->webuser_fname) ?></label>
                                
                                
                            </div>
                        </div>
                        <div style="margin-top: 10px;margin-left: -19px;" class="row margin-top-2 border-bottom">
                            <div class="col-md-8 ">
								<?php if($total_feedbackScore !=0 && $total_budget!=0){
                                $totalscore = ($total_feedbackScore / $total_budget);
                                $rating_feedback = ($totalscore/5)*100;
                               ?>
                                <button style="font-size: 10px;background:#F77D0E;padding: 2px 4px;border-radius: 2px;" id="buttonfirst"><?=number_format((float)$totalscore,1,'.','');?></button>
								<div title="Rated <?=$totalscore;?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="right: -8%;margin-top: -3%;position: absolute;">
								<span style="width:<?=$rating_feedback;?>%">
									<strong itemprop="ratingValue"><?=$totalscore;?></strong> out of 5
								</span>
								</div>
							<?php  }else{ ?>
                             <button style="font-size: 10px;background:#F77D0E;padding: 2px 4px;border-radius: 2px;"  id="buttonfirst">0.0</button>
								<div style="right: -8%;margin-top: -3%;position: absolute;" title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="right: -45%;margin-top: 2%;position: absolute;">
								<span style="width:0%">
									<strong itemprop="ratingValue">0</strong> out of 5
								</span>
								</div>
                          <?php   } ?>
                               
                            </div>
                        </div>
                        <div style="margin-top: 14px;margin-left: -19px;" class="row margin-top-2 border-bottom">
                            <div class="col-md-12">
                                <label style="font-family: Calibri;font-size: 20.26px;color: #494949;margin-top: -29px;">
                                   <?php if(!empty($record_sidebar)){
                                        echo count($record_sidebar);
                                    }else{
                                        echo "0";
                                    } ?>
								<span style="font-size: 14px;color: #494949;font-family: calibri;">Jobs Posted</span>
								</label>
                            </div>
                        </div>
                        <div style="margin-top: 4px;margin-left: -19px;" class="row margin-top-2 border-bottom">
                            <div class="col-md-12">
                                <label style="font-family: Calibri;font-size: 20.26px;color: #494949;margin-top: -29px;">
								<?=count($hire);?> 
								<span style="font-size: 14px;color: #494949;font-family: calibri;">Hired</span>
								</label>
                            </div>
                        </div>
                        <div style="margin-top: 2px;margin-left: -19px;" class="row margin-top-2 border-bottom">
                            <div class="col-md-12">
                                <label style="font-family: Calibri;font-size: 20.26px;color: #494949;margin-top: -29px;">
								<?php $total_work = 0;
                                    if(!empty($workedhours)){
                                        foreach($workedhours as $work){
                                            $total_work +=$work->total_hour;
                                        }
                                        echo $total_work." <span style='font-size: 14px;color: #494949;font-family: calibri;'>Hours</span>";
                                    }else{
                                        echo " 0 <span style='font-size: 14px;color: #494949;font-family: calibri;'>Hours Worked</span>";
                                    }?>
								</label>
                            </div>
                        </div>

                        <div style="margin-top: 4px;margin-left: -19px;" class="row margin-top-2 border-bottom">
                            <div class="col-md-12">
                                <label style="font-family: Calibri;font-size: 20.26px;color: #494949;margin-top: -29px;">
								$<?php echo round($total_spent,0);?>
								<span style="font-size: 14px;color: #494949;font-family: calibri;">Spent</span>
								</label>
                            </div>
                        </div>
                        <div class="row margin-top-2 border-bottom">
                            <div style="font-family: Calibri;font-size: 18px;margin-left: 12px;margin-top: -15px;margin-bottom: 5px;">
								
								<i class="fa fa-map-marker"></i>
								
								<label style="font-family: Calibri;font-size: 20.26px;color: #494949;margin-top: -29px;">
								<span style="font-size: 14px;color: #494949;font-family: calibri;"><?php
                                $this->db->where('country_id', $value->webuser_country);
                                $q = $this->db->get('country');
                                $record = $q->row();
                                echo ucfirst($record->country_name);
                                ?></span>
								</label>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

</section>