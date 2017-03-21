 <style>span.rating-badge {
  background: #eba705 none repeat scroll 0 0;
  border-radius: 7px;
  color: #fff;
  padding: 4px;
}
.custom_find_job h5{}
.custom_find_job_bottom li {
border: 0;
margin-bottom: 9px;
width: auto !important;
padding: 0;
margin-right: 30px;
font-size: 18px;
font-family: calibri;
color: rgb(98, 98, 98);
}
.custom_find_job_bottom li:last-child{margin-right: 0px;}
.custom_find_job_bottom li i{margin-right: 5px;
font-size: 19px;}
.star-rating span, #feedbackbutton h4 span {

	font-size: 19px !important;
}
.star-rating::before {
    font-size: 19px;
}
a.morelink {
	text-decoration:none;
	outline: none;
}
.morecontent span {
	display: none;
        font-family: calibri;
        font-size: 16px;
        color: #494949;
}
</style>

<?php
//die();
//date_default_timezone_set("UTC");
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

if (count($records) > 0)
{
    ?>
    
     <?php
    foreach ($records as $key => $value)
    {
   
    /* find client payment set status start */
            $this->db->select('*');            
            $this->db->from('jobs');
            $this->db->join('billingmethodlist', 'billingmethodlist.belongsTo = jobs.user_id', 'inner');
            $this->db->where('billingmethodlist.belongsTo', $value->webuser_id);
            $this->db->where('billingmethodlist.isDeleted', "0");
            $this->db->where('jobs.status', 1);
            $query = $this->db->get();   
            $paymentSet=0;
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
/* find total spent by client end */

$this->db->select('*');
$this->db->from('job_accepted');
$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
$this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
$this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
$this->db->where('job_accepted.buser_id',$value->user_id);

$query=$this->db->get();

$accepted_jobs = $query->result();
  $total_feedbackScore=0 ;
    $total_budget=0 ;
 if(!empty($accepted_jobs)){
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
 }

?>
        <div style="margin-top: -15px;" class="row" id="all-jobs">
            <div style="margin-bottom: 5px;" class="col-md-12 col-md-offset-0 page-jobs no-pad">
                <h1 style="margin-bottom: 12px;"><a style="font-family: 'Calibri';font-size: 22px;color: rgb(2, 143, 204);" href="<?php echo site_url("jobs/view/". url_title($value->title).'/'.  base64_encode($value->id)); ?>"><?php echo ucfirst($value->title) ?></a></h1>			
                <div class="custom_find_job">
						<h5><b><?php echo ucfirst($value->job_type) ?></b></h5>
						<h5><b>-</b></h5>
						<h5 style="margin-right: 10px;"><b><?php
						if ($value->job_type=='hourly')
						{
							echo $value->hours_per_week . " hours/wk";
						} else
						{
							echo '$' . round($value->budget, 2);
						}
						?></b></h5>
						
						<h5 style="margin-right: 10px;"><?php echo ucfirst($value->experience_level);
						if(trim($value->experience_level)=='Entry level')
						echo " ($)";
						else if(trim($value->experience_level)=='Entermediate')
						echo " ($$)";
						else
						echo " ($$$)";

						?></h5> 
						<?php 
						$this->db->select('*');
						$this->db->from('job_bids');
						$this->db->where(array('job_id'=>$value->id,'bid_reject'=>0, 'status!=1'=>null));
						$query =$this->db->get();
						$Proposals_count = $query->num_rows();
						$jobfeedback= $query->result();
						?>
						<h5 style="margin-right: 10px;">Posted: <?php
                       // date_default_timezone_set("Asia/Bangkok");
                        $timeDate = strtotime($value->job_created);
                        $dateInLocal = date("Y-m-d H:i:s", $timeDate);
                            
                        echo time_elapsed_string(strtotime($dateInLocal)); ?></h5>
						<h5><b><?php echo $Proposals_count; ?></b> quotes</h5>
					</div>
            </div>
            <div style="margin-bottom: -3px;" class="page-jobs ">
                <h6 class="more no-pad" style="color: #494949;"><?php echo ucfirst($value->job_description) ?></h6>
            </div>
            <div class="col-md-12 col-md-offset-0 page-jobs no-pad" style=" margin-bottom: 2px;">

                <h6 style="float:left;font-size: 14px;margin: 0;margin-top: 3px;margin-right: -8px;" class="page-sub-title">Skills</h6>
				
				<div class="custom_user_skills custom_user_skills_find">
                <?php
                if (isset($value->skills) && !empty($value->skills) && is_string($value->skills))
                {
                    $skills = explode(' ', $value->skills);
                    if(!empty($skills)){
                        foreach ($skills as $skill)
                            echo '<span>' . $skill . '</span>';
                    }
                    else{
                        foreach ($value->skills as $skill)
                            echo '<span>' . $skill . '</span>';
                    }
                }
                ?><br>
				</div>
            </div>
            <div class="col-md-12">
                <nav>
                    <ul class="job-navigation custom_find_job_bottom">
                    
                     <?php 
                        if($value->isactive && $paymentSet) 
                        {
                          ?>
                        <li>
						<i style="color: rgb(2, 143, 204);" class="fa fa-check-circle"></i>Verified
						</li>
                        <?php   
                        }
                        else 
                        {
                            ?>
                        <li>
						<i style="color: rgb(187, 187, 187);" class="fa fa-check-circle"></i>Unverified
						</li>
                        <?php 
                            
                        }                                               
?>
                       
                        <li><b>$<?php echo round($total_spent,0);?></b> Spent</li>
                        <li style="padding-top: 5px;margin-bottom: 4px;">
                            <?php if($total_feedbackScore !=0 && $total_budget!=0){
                                $totalscore = ($total_feedbackScore / $total_budget);
                                $rating_feedback = ($totalscore/5)*100;
                               ?>
                               <span style="font-size: 10px;background: #F77D0E;padding: 2px 5px;border-radius: 2px;margin-right: 1px;" class="rating-badge"><?=number_format((float)$totalscore,1,'.','');?></span>
							   
                              <div title="Rated <?=$totalscore;?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="top:-5px;height: 1.2em;">
                               <span style="width:<?=$rating_feedback;?>%">
                                   <strong itemprop="ratingValue"><?=$totalscore;?></strong> out of 5
                               </span>
                               </div>
                           <?php  }else{ ?>
						   
                             <span style="font-size: 10px;background: #F77D0E;padding: 2px 5px;border-radius: 2px;margin-right: 1px;" class="rating-badge">0.0</span>
                               <div title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="top:-5px;height: 1.2em;">
							   
                               <span style="width:0%">
                                   <strong itemprop="ratingValue">0</strong> out of 5
                               </span>
                               </div>
                          <?php   } ?>
                        </li>
                        <li>
							<i style="font-size: 16px;margin-right: 2px;" class="fa fa-map-marker"></i>
                            <?php
                            $this->db->where('country_id', $value->webuser_country);
                            $q = $this->db->get('country');
                            $record = $q->row();
                            echo ucfirst($record->country_name);
                            ?>
						</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="line custon_line"></div>
        <br/>
        <?php
    }
}
else{
    ?>
            <h3 style="text-align: center; padding-bottom: 35px;" class="no-result-container">No Results Found</h3>
    <?php
}?>
<script type="text/javascript" src="<?= site_url() ?>assets/js/dynamic_shorten.js"></script>
<script type="text/javascript" src="<?= site_url() ?>assets/js/internal/show_moretext.js"></script>