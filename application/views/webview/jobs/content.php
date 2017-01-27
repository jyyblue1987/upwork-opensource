<?php

if (count($records) > 0)
{
    ?>
    
     <?php
    foreach ($records as $key => $value)
    {
   
    /* find client payment set status start */
                 
            $this->db->select('*');            
            $this->db->from('billingmethodlist');
            $this->db->where('billingmethodlist.belongsTo', $value->webuser_id);
            $this->db->where('billingmethodlist.isDeleted', "0");
            $query = $this->db->get();   
            $paymentSet=0;
                if (is_object($query)) {
                    $paymentSet = $query->num_rows();
                }
                
            /* find client payment set status end */ 

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
            <div style="margin-bottom: 5px;" class="col-md-12 col-md-offset-0 page-jobs ">
                <h1 style="margin-bottom: 12px;"><a style="font-family: 'Calibri';font-size: 22px;" href="<?php echo site_url("jobs/view/". url_title($value->title).'/'.  base64_encode($value->id)); ?>"><?php echo ucfirst($value->title) ?></a></h1>
					<div class="custom_find_job">
						<h5><b><?php echo ucfirst($value->job_type) ?></b></h5>
						<h5><b>-</b></h5>
						<h5 style="margin-right: 10px;"><b><?php
						if ($value->job_type=='hourly')
						{
							echo $value->hours_per_week . " Hours/wk";
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


						$timeDate = strtotime($value->job_created);
								$dateInLocal = date("Y-m-d H:i:s", $timeDate);
								

						echo date('M d y', strtotime($dateInLocal)) ?></h5>
						<h5><b><?php echo $Proposals_count; ?></b> quotes</h5>
					</div>
            </div>
            <div style="margin-bottom: -3px;" class="col-md-12 col-md-offset-0 page-jobs ">
                <h6 style="color: #494949;font-size: 15px;"><?php echo ucfirst($value->job_description) ?></h6>
            </div>
            <div class="col-md-12 col-md-offset-0 page-jobs " style=" margin-bottom: 2px;">

                <h6 style="float:left;font-size: 14px;margin: 0;margin-top: 3px;margin-right: -8px;" class="page-sub-title">Skills</h6>
				
				<div class="custom_user_skills custom_user_skills_find">
                <?php
                if (isset($value->skills) && !empty($value->skills))
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
                        <li style="width: 25%; padding: 0px 0px 0px 35px;">
						<i style="margin-right: 3px;margin-left: -4px; font-size: 25px; color: rgb(2, 143, 204); position: absolute; top: 8px; margin-top: 0px; left: 22px;" class="fa fa-check-circle"></i>Verified
						</li>
                        <?php   
                        }
                        else 
                        {
                            ?>
                        <li style="width: 25%; padding: 0px 0px 0px 30px;">
						<i style="margin-right: 3px;margin-left: -4px; font-size: 25px; color: rgb(187, 187, 187); position: absolute; top: 8px; margin-top: 0px; left: 22px;" class="fa fa-check-circle"></i>Unverified
						</li>
                        <?php 
                            
                        }                                               
?>
                       
                        <li style="width:25%;padding:0 12px">$600000 Spent</li>
                        <li style="width:25%;padding:0px 12px">
                            <?php if($total_feedbackScore !=0 && $total_budget!=0){
                                $totalscore = ($total_feedbackScore / $total_budget);
                                $rating_feedback = ($totalscore/5)*100;
                               ?>
                               <span style="font-size: 10px;background: #F77D0E;padding: 2px 5px;border-radius: 2px;" class="rating-badge"><?=number_format((float)$totalscore,1,'.','');?></span>
							   
                              <div title="Rated <?=$totalscore;?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="top:-5px;height: 1.2em;">
                               <span style="width:<?=$rating_feedback;?>%">
                                   <strong itemprop="ratingValue"><?=$totalscore;?></strong> out of 5
                               </span>
                               </div>
                           <?php  }else{ ?>
						   
                             <span style="font-size: 10px;background: #F77D0E;padding: 2px 5px;border-radius: 2px;" class="rating-badge">0.0</span>
                               <div title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="top:-5px;height: 1.2em;">
							   
                               <span style="width:0%">
                                   <strong itemprop="ratingValue">0</strong> out of 5
                               </span>
                               </div>
                          <?php   } ?>
                        </li>
                        <li style="width:25%;padding:0px 12px;overflow:hidden;">
                            <?php
                            $this->db->where('country_id', $value->webuser_country);
                            $q = $this->db->get('country');
                            $record = $q->row();
                            echo ucfirst($record->country_name);
                            ?></li>
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
            <p>No data to load.</p>
    <?php
}?>

 
 
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
}
</style>