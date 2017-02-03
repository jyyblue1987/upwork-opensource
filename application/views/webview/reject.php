<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css" />

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.rateyo.css"/>

<style>
.message_lists{
    max-height: 250px;
    overflow-y: scroll;
    overflow-x: hidden;
}
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
.hire_cover_letter span {
	font-size: 15px;
	font-weight: normal;
}
span.rating-badge {
	background: #F77D0E  none repeat scroll 0 0;
	border-radius: 2px;
	color: #fff;
	padding: 2px 4px 2px 5px;
	font-size: 12px;
}
.hire_decline {
	position: absolute;
	top: -52px;
	right: -55px;
}
.review_ratting {
	margin-left: 49px;
}
.client-job-activity-current li, .last-element {
	padding-top: 20px;
	padding-bottom: 21px;
}
.drop_btn {
	padding: 15px 60px 65px 40px;
	background: white;
	border: 2px solid #e0e0e0;
	font-weight: 900;
	font-size: 18px;
}
.drop_btn ul li a {
	padding: 10px;
	margin: 0px;
	font-size: 15px;
}
.drop_btn ul li {
	padding: 2px;
	margin: 0px;
} 
.drop_btn ul li a{
    border: none; 
    border-right: none;
    list-style: none;
    }
	
body {
    font-family: "calibri" !important;
}
</style>
<section id="big_header" style="margin-top: 40px; margin-bottom: 65px; height: auto;">

    <div class="container">
     <div class="row"> 
       <div style="margin-top: -8px;margin-bottom: -5px;" class="main_job_titie">
           <b><?php   echo ucfirst($jobDetails->job_type)." - ".ucfirst($jobDetails->title); ?><br/><br/></b>
       </div>
     </div>
      <div class="row ">
<?php
$jobId = base64_decode($_GET['job_id']);
if($interview_count){	$interview = $interview_count;} else {	$interview = 0;}
if($hire_count){	$hire = $hire_count;} else {	$hire = 0;}
if($Application_count){	$totalApplication = $Application_count;} else {	$totalApplication = 0;}
if($Offer_count){	$totalOffer = $Offer_count;} else {	$totalOffer = 0;}
if(!empty($messages)){	$totalrejact = count($messages);} else {	$totalrejact = 0;}
$appliedLink=site_url('jobs/applied/' . base64_encode($jobId));
$interviewsLink=site_url('jobs/interviews/' . base64_encode($jobId));
$offerLink=site_url('offer?job_id=' . base64_encode($jobId));
$hireLink=site_url('hires?job_id=' . base64_encode($jobId));
$rejectLink=site_url('reject?job_id=' . base64_encode($jobId));

?>
			
			
               <div class="col-md-12 nopadding" >
                <ul class="client-job-activity-current" style="position:relative;">
                     <li><a href='<?php echo $appliedLink; ?>'>Application (<?php echo $totalApplication?>)</a> </li>
                     <li><a href='<?php echo $interviewsLink; ?>'>Interview (<?=$interview?>)</a> </li>
                     <li><a href='<?php echo $offerLink; ?>'>Offers (<?=$totalOffer;?>) </a>  </li>
                     <li><a href='<?php echo $hireLink; ?>'>Hires (<?=$hire;?>)</a> </li>
                     <li><a class="active-link" href='<?php echo $rejectLink; ?>'>Rejected (<?=$totalrejact;?>)</a></li>
                    
					<li class="drop_btn">
					 
						<div class="dropdown hour_btnx custom-application_drop_down">
							<button style="margin-left: -14px;" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
							job action	<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="#">View Job Posting</a></li>
								<li><a href="#">Edit Job Posting</a></li>
								<li><a href="#">Remove Job Posting</a></li>

							</ul>
						</div>
					</li>
                 </ul>
            </div>
            <div style="padding:40px;"></div>

       
		 <?php
            foreach ($messages as $value) {
				
                $this->db->select('*');
                $this->db->from('job_accepted');
                $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
                $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
                $this->db->where('job_accepted.fuser_id',$value->freelancer_id);
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
                <div class="col-md-12 white-box candidate-list">                
                    <div class="row">
                        <div class="col-md-12">
                           <div class="row margin-top-1">
                                <div style="margin-left: 5px;margin-right: 13px;" class="col-md-1">
                                   <div class="st_img">
                                        <?php
                                   
                                    $pic = $this->Adminforms->getdatax("picture", "webuser", $value->freelancer_id);
                                    if ($pic == "") {
                                        ?>
                                        <img src="<?php echo site_url("assets/user.png"); ?>" width="64" height="64" >
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo site_url($pic); ?>" width="64" height="64" >
                                        <?php
                                    }
                                    ?>
                                   </div>
                                </div>
                                <div class="col-md-8 text-left margin-left-1" style="margin-top:-4px;">
                                    <div class="aplicant_identity">
                                        <label class="aplicant_name"><a href="<?php echo base_url() ?>interview?user_id=<?=base64_encode($value->freelancer_id)?>&job_id=<?=base64_encode($value->job_id)?>&bid_id=<?=base64_encode($value->bid_id)?>"><?php echo ucfirst($value->webuser_fname) . " " . ucfirst($value->webuser_lname) ?></a></label> 
                                    <br/> 
                                    <b>
                                        <span>
                                            <?php
                                    $profile=array();
                                    $this->db->where('webuser_id', $value->webuser_id);
                                    $q = $this->db->get('webuser_basic_profile');
                                    if ($q->num_rows() > 0) {
                                        $profile = $q->row();
                                        echo ucfirst($profile->tagline);
                                    }
                                    ?>
                                        </span>
                                    </b>
                                    </div>

                                    <div class="row margin-top-2">
                                        <div class="col-md-1" style="font-size:16px;">
                                           <b>$<?php
                                            echo round($value->bid_amount, 2);
                                            if ($jobDetails->job_type == 'hourly')
                                              echo '/hr';
                                            ?></b></div>

                                        <div class="col-md-4 ">
                                          <div class="review_ratting">
                                              <?php if($total_feedbackScore !=0 && $total_budget!=0){
                                                $totalscore = ($total_feedbackScore / $total_budget);
                                                $rating_feedback = ($totalscore/5)*100;
                                               ?>
                                               <span class="rating-badge"><?=number_format((float)$totalscore,1,'.','');?></span>
                                              <div title="Rated <?=$totalscore;?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em;margin-top:-5px;width:105px; color:#DEDEDE;">
                                               <span style="width:<?=$rating_feedback;?>% ;margin-top:0px;">
                                                   <strong itemprop="ratingValue"><?=$totalscore;?></strong> out of 5
                                               </span>
                                               </div>
                                           <?php  }else{ ?>
                                             <span class="rating-badge">0.0</span>
                                               <div title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em; margin-top:-5px;">
                                               <span style="width:0% ;margin-top:-5px;">
                                                   <strong itemprop="ratingValue">0</strong> out of 5
                                               </span>
                                               </div>
                                          <?php   } ?>
                                         </div>
                                        </div>

                                        <div class="col-md-2 text-right" style="font-size:16px;">
                                            <b><?php
                                            $this->db->select('*');
                                           $this->db->from('job_workdairy');
                                           $this->db->where('fuser_id',$value->freelancer_id);
                                           $query_done = $this->db->get();
                                           $job_done = $query_done->result();
                                             $total_work = 0;
                                               if(!empty($job_done)){
                                                   foreach($job_done as $work){
                                                       $total_work +=$work->total_hour;
                                                   }
                                                   echo $total_work."  hrs";
                                               }else{
                                                   echo "0.00 hrs";
                                               }
                                        ?></b>
                                        
                                        </div>

                                        <div class="col-md-2 text-right" style="font-size:16px;">
                                         <b>  <?php
                                            $this->db->select('*');
                                           $this->db->from('job_bids');
                                           $this->db->where('user_id',$value->freelancer_id);
                                           $this->db->where('jobstatus',1);
                                           $querydone = $this->db->get();
                                         $jobends = $querydone->num_rows();
                                          echo $jobends." ";   
                                        ?></b>jobs
                                        </div>

                                        <div class="col-md-3 text-right">
												<i style="font-size: 15px;" class="fa fa-map-marker"></i> 
												 
												 <b> <?php
                                                 $this->db->where('country_id', $value->webuser_country);
                                                 $q = $this->db->get('country');
                                                 if ($q->num_rows() > 0)
                                                 {
                                                     $country = $q->row();
                                                     echo ucfirst($country->country_name);
                                                 }
                                                 ?></b>
                                        </div> 
                                    </div>

                                    <div class="row margin-top-3">
                                        <div class="col-md-12 text-justify">
                                         <div class="hire_cover_letter">
                                             <span>
                                                 <?php 
                                        echo substr($value->cover_latter, 0, 100);?>
                                             </span>
                                         </div>
                                        </div>
                                    </div>

                                    <div class="row margin-top-1">
                                        <div class="col-md-1">
                                        <span class="gray-text" style="font-size:14px;">Skills</span></div>
                                        <div class="col-md-11 text-left skills">                                            
                                            <div class="user_skills">
                                                <?php
                                            if (isset($profile->skills) && !empty($profile->skills))
                                            {
                                                $skills = explode(',', $profile->skills);
                                                foreach ($skills as $skill)
                                                   echo "<span>$skill</span>";
                                            }
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="col-md-2 margin-top-5 text-right msg-buttons">
                                    <!--<a href="javascript:void(0)" onclick="loadmessage(<?=$value->id?>,<?=$value->user_id?>,<?=$value->job_id?>)">Message</a>-->
                                    <div class="hire_decline"><?php if($value->bid_reject == '1'){echo 'Declined By You';}else{echo 'Declined By Freelancer';} ?></div>  
                                  <div class="hire_sms_btn"><a class="btn btn-primary form-btn" href="<?php echo base_url() ?>interview?user_id=<?=base64_encode($value->user_id)?>&job_id=<?=base64_encode($value->job_id)?>&bid_id=<?=base64_encode($value->id)?>">Message</a>  
                                    </div>
   <div class="hire_me_btn">
		<?php if($ststus->isactive==1){ ?>
		<a class="btn btn-primary form-btn" href="<?php if ($jobDetails->job_type == 'hourly') { echo site_url("jobs/confirm_hired_hourly?user_id=".base64_encode($value->user_id)."&job_id=".base64_encode($value->job_id));} else { echo site_url("jobs/confirm_hired_fixed?user_id=".base64_encode($value->user_id)."&job_id=".base64_encode($value->job_id));} ?>">Hire Me</a><?php } ?>

                               </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>  
            <?php } ?>
    </div>

</section>


<!-- big_header-->


<!-- Modal -->
<div id="message_convertionModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="hidemessagepopup()">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <div class="message_lists" ></div>
        
       
        <form name="message" action="" method="post" id="conversion_message">
             <textarea name="usermsg"  id="usermsg"></textarea>
               <input name="job_id" type="hidden" id="job_id"  value="" />
               <input name="bid_id" type="hidden" id="bid_id"  value=""  />
               <input name="sender_id" type="hidden" id="sender_id"  value="<?php echo $this->session->userdata('id');?>"  />
               <input name="receiver_id" type="hidden" id="receiver_id"  value=""  />
             <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
         </form>
        </div>
    </div>
 </div>
</div>

<script>
    function loadmessage( b_id, u_id, j_id ){
        
		var modal = document.getElementById('message_convertionModal');
        $.post("<?php echo site_url('jobconvrsation/message_from_superhero');?>", { job_bid_id:b_id, user_id : u_id, job_id : j_id },  function(data) {
			$('.message_lists').html(data.html);
            $('#job_id').val( j_id );
            $('#bid_id').val( b_id );
            $('#receiver_id').val( u_id );
            // $('#message_convertionModal').modal('show');
			modal.style.display = "block";
           // $('.message_lists').animate({scrollTop: $('.message_lists').prop("scrollHeight")}, 500);
            autoloading();
		}, 'json');
       
    }
	 function hidemessagepopup(){
        var modal = document.getElementById('message_convertionModal');
        modal.style.display = "none";
    }
	 
    $("#conversion_message").on("submit", function(e) {
          e.preventDefault();
          var $form = $("#conversion_message");
          if ( $('#usermsg').val().trim().length > 0 ) {
                $.post("<?php echo site_url('jobconvrsation/add_conversetion');?>", { form: $form.serialize() },  function(data) {
                    if(data.success){
                        $form[0].reset();
                        loadmessage( $('#bid_id').val(), $('#receiver_id').val(), $('#job_id').val() );
                         
                    }
                    else{
                        alert('Opps!! Something went wrong.')
                    }
                   
                }, 'json');
          }
         
    });
    
      function loadmessage_auto( ){
        
        var auto_job_id = $('#job_id').val();
        var auto_bid_id = $('#bid_id').val();
        var auto_receiver_id = $('#receiver_id').val();
        
		var modal = document.getElementById('message_convertionModal');
        $.post("<?php echo site_url('jobconvrsation/message_from_superhero');?>", { job_bid_id:auto_bid_id, user_id : auto_receiver_id, job_id : auto_job_id },  function(data) {
			$('.message_lists').html(data.html);
           
            //$('.message_lists').animate({scrollTop: $('.message_lists').prop("scrollHeight")}, 500);
		}, 'json');
    }
    
    function autoloading() {
        //alert('hi');
        var auto_job_id = $('#job_id').val();
        var auto_bid_id = $('#bid_id').val();
        var auto_receiver_id = $('#receiver_id').val();
       
        if (auto_job_id) { auto_job_id = auto_job_id;}else{auto_job_id = 0}
        if (auto_bid_id) { auto_bid_id = auto_bid_id;}else{auto_bid_id = 0}
        if (auto_receiver_id) { auto_receiver_id = auto_receiver_id;}else{auto_receiver_id = 0}
       
        if (auto_job_id && auto_bid_id && auto_receiver_id) {
            setInterval('loadmessage_auto()', 5000);
        }
    }
  autoloading();
</script>