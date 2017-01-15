<link rel="stylesheet" href="<?php echo base_url()?>assets/css/rating.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.rateyo.css"/>
	
<section id="big_header" style="margin-top: 44px; margin-bottom: 50px; height: auto;">
    <div class="container">
        <div class="row ">
            <div class="row">
                <div class="col-md-10 padding-left-off margin-bottom-3">
                    <form id="freelacer-search" action="<?php echo site_url('profile/find-freelancer')?>" method="post">
                        <div class="col-md-12">
                            <input type="text" name="keywords" class="form-control search-field" value="<?php echo $searchWord ?>"/> 
                            <i aria-hidden="true" class="fa fa-search search-btn search-freelancer"></i>
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
                    <div class="col-md-12 bordered white-box candidate-list">
                        <div class="row margin-top-1">
                            <div class="col-md-1 margin-left-3">
                                <img src="<?php echo base_url().$fp->webuser_picture?>" width="64" height="64" />
                            </div>
                            <div class="col-md-8 text-left margin-left-1" style="margin-top:-4px;">
                                <label class="blue-text"><?php echo $fp->webuser_fname." ".$fp->webuser_lname ?></label> <br/> 
                                <?php echo $fp->tagline ?>
                                <div class="row margin-top-2">
                                    
                                    <div class="col-md-1">$<?php echo $fp->hourly_rate; 
                                    ?>/hr</div>
                                    <div class="col-md-4 rating">
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
                                                   echo $total_work." Hrs ";
                                               }else{
                                                   echo "0.00 Hrs";
                                               }
                                        ?>
                                    </div>
                                    <div class="col-md-2">
                                    <?php
                                            $this->db->select('*');
                                           $this->db->from('job_bids');
                                           $this->db->where('user_id',$fp->webuser_id);
                                           $this->db->where('jobstatus',1);
                                           $querydone = $this->db->get();
                                         $jobends = $querydone->num_rows();
                                          echo $jobends." jobs";   
                                        ?>
                                    </div>
                                    <div class="col-md-3">
                                            <img src="<?php echo base_url()?>assets/pin_marker.png" width="16" /> <?php echo $fp->country_name ?>
                                    </div>
                                </div>
                                <div class="row margin-top-1">
                                    <div class="col-md-12 text-justify">
                                        <?php
                                         echo substr($fp->overview, 0, 200); 
                                         ?>
                                    </div>
                                </div>
                                <div class="row margin-top-1">
                                    <div class="col-md-3"><span class="gray-text">Tag & Skills</span></div>
                                    <div class="col-md-9 skills">
                                       <?php
                                       if(strlen($fp->skills) > 0){
                                           $temp = explode(",", $fp->skills);
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
                            <div class="col-md-2 margin-top-5 text-right msg-buttons">
                                <div><a class ="btn btn-primary" href="<?php echo site_url('jobs/send_invitation/'.$fp->webuser_id); ?>">Invite to job</a> </div> 
                                <div><a class ="btn btn-primary" href="">Hire Me</a></div>
                                  
                                 
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
$('.search-freelancer').click(function(){
    var val = $('input[name="keywords"]').val();
    if(val != "" && val.length > 0){
        $('#freelacer-search').submit();
    }else{
        alert("Leave a search word");
    }
});
</script>
