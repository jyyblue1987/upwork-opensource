<link rel="stylesheet" href="<?php echo base_url()?>assets/css/rating.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.rateyo.css"/>

<style type="text/css">
.user_skills span {
    background: #ccc none repeat scroll 0 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    color: #494949;
    display: inline-block;
    font-size: 12px;
    margin-bottom: 4px;
    padding: 1px 5px 1px 5px;
    margin-right: 2px;
}
.user_skills span:hover {
background: #008329;
color: #fff;
}
span.rating-badge {
    background: #F77D0E none repeat scroll 0 0;
    border-radius: 2px;
    color: #fff;
    padding: 2px 4px 2px 5px;
    font-size: 12px;
}
.hire_cover_letter span {
    font-size: 15px;
    font-weight: normal;
}
.candidate-list {
    margin-top: -5px;
    margin-bottom: 20px;
}
</style>

<section id="big_header" style="margin-top: 40px; margin-bottom: 20px; height: auto;">
    <div class="container">
        <div class="row ">
            <div class="row">
                <div style="width: 101%;" class="col-md-12 padding-left-off margin-bottom-3">
                    <form id="freelacer-search" action="<?php echo site_url('freelancers-search')?>" method="GET">
                        <div class="col-md-10">
                            <input style="width: 91.5%;" type="text" name="q" class="form-control search-field" value="<?php echo $searchWord ?>" id="jobsearch"/> 
                            <i aria-hidden="true" class="fa custom_btn fa-search search-btn search-freelancer"></i>
                        </div>
						
                        <div class="col-md-2">
							<a style="margin-left: -27px; background-color: rgb(2, 143, 204); width: 143px; height: 35px; padding-top: 12px;" class="btn btn-primary job_btn custom_btn" href="<?php echo site_url('post-job'); ?>">Post a job</a>
						</div>
                    </form>
                </div>
            </div>
            <div class="col-md-12 ">
                <?php
                if(isset($freelancers) && is_array($freelancers) && sizeof($freelancers) > 0){
                    foreach ($freelancers as $fp) {
                         
                        $this->db->select('*');
                $this->db->from('job_accepted');
                $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
                $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
                $this->db->where('job_accepted.fuser_id',$fp->webuser_id);
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
                <div class="row ">
                    <div style="width: 97.1%;" class="col-md-12 white-box candidate-list">
                        <div class="row margin-top-1">
                            <div style="margin-left: 5px;" class="col-md-1 st_img">
                                <img src="<?php echo $fp->webuser_picture == "" ? base_url().'assets/user.png' : base_url().$fp->webuser_picture?>" width="64" height="64" />
                            </div>
                            <div class="col-md-8 text-left margin-left-1 aplicant_name" style="margin-top:-4px;">
                                <a href="<?= site_url().'freelancer/'.$fp->webuser_username ?>"><label class="blue-text"><?php echo $fp->webuser_fname." ".$fp->webuser_lname ?></label></a> <br/> 
                                <span style="color: #494949;"><b><?php echo $fp->tagline ?></b></span>
                                <div class="row margin-top-2">
                                    
                                    <div class="col-md-1"><b>$<?php echo $fp->hourly_rate; 
                                    ?></b>/hr</div>
                                    <div class="col-md-4 review_ratting">
                                        <?php if($total_feedbackScore !=0 && $total_budget!=0){
                                               
                                                $totalscore = ($total_feedbackScore / $total_budget);
                                                $rating_feedback = ($totalscore/5)*100;
                                               ?>
                                               <span class="rating-badge"><?=number_format((float)$totalscore,1,'.','');?></span>
                                              <div title="Rated <?=$totalscore;?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em; margin-top:-5px;">
                                               <span style="width:<?=$rating_feedback;?>%">
                                                   <strong itemprop="ratingValue"><?=$totalscore;?></strong> out of 5
                                               </span>
                                               </div>
                                           <?php  }else{ ?>
                                             <span class="rating-badge">0.0</span>
                                               <div title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em; margin-top:-5px;">
                                               <span style="width:0%">
                                                   <strong itemprop="ratingValue">0</strong> out of 5
                                               </span>
                                               </div>
                                          <?php   } ?> 
                                    </div>
                                    <div class="col-md-2">
                                     <?php
                                           $this->db->select('*');
                                           $this->db->from('job_workdairy');
                                           $this->db->where('fuser_id',$fp->webuser_id);
                                           $query_done = $this->db->get();
                                           $job_done = $query_done->result();
                                             $total_work = 0;
                                               if(!empty($job_done)){
                                                   foreach($job_done as $work){
                                                       $total_work +=$work->total_hour;
                                                   }
                                                   echo $total_work." <span class='cc_normal_txt'>Hrs</span>";
                                               }else{
                                                   echo "<b>0.00 <span class='cc_normal_txt'>Hrs</span></b>";
                                               }
                                        ?>
                                    </div>
                                    <div class="col-md-2">
                                    
									<b><?php
                                            $this->db->select('*');
                                           $this->db->from('job_bids');
                                           $this->db->where('user_id',$fp->webuser_id);
                                           $this->db->where('jobstatus',1);
                                           $querydone = $this->db->get();
                                         $jobends = $querydone->num_rows();
                                          echo $jobends."</b> jobs";   
                                        ?>
                                    </div>
                                    <div class="col-md-3">
                                        <i style="font-size: 15px;" class="fa fa-map-marker"></i> 
											
										<b><?php echo $fp->country_name ?></b>
                                    </div>
                                </div>
                                <div class="row margin-top-1">
                                    <div class="col-md-12 text-justify">
                                        <div class="hire_cover_letter">
											<span><?php echo substr($fp->overview, 0, 200); ?></span>
										 </div>
                                    </div>
                                </div>
                                <div class="row margin-top-1">
                                    <div class="col-md-1"><span style="font-size:14px;" class="gray-text">Skills</span></div>
                                    <div class="col-md-11 skills">
                                       <div class="user_skills">
									   <?php
                                       if(strlen($fp->wuser_skills) > 0){
                                           $temp = explode(",", $fp->wuser_skills);
                                           foreach ($temp as $t) {
                                        ?>
                                        <span><?php echo $t ?></span>
                                        <?php
                                           }
                                       }else{
                                       ?>
                                        <?php 
                                       }
                                       ?>
									   </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 margin-top-5 custom_invite text-right msg-buttons">
                                <div class="hire_sms_btn">
									<a class ="btn btn-primary form-btn" href="<?php echo site_url('jobs/send_invitation/'.$fp->webuser_id); ?>">Invite to job</a>
								</div>
								
                                <div class="hire_me_btn">
									<a class ="btn btn-primary form-btn" href="">Hire Me</a>
								</div>                                 
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }else{
                ?>
                <div class="row">
                    <div class="col-md-12">
                        No Match Found
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
</div>

</section>
<!-- big_header-->
<script type="text/javascript">
$('.search-freelancer').click(function () {
        var keywords = $('#jobsearch').val();
        if (keywords.length > 0) {
            $('#freelacer-search').submit();
        }
    });
</script>
