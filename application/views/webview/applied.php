<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css" />

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.rateyo.css"/>

<section id="big_header" style="margin-top: 50px; margin-bottom: 50px; height: auto;">

    <div class="container">
        <div class="row">
            <?php
            $jobId = $jobId;
if($interview_count){	$interview = $interview_count;} else {	$interview = 0;}
if($hire_count){	$hire = $hire_count;} else {	$hire = 0;}
if($Offer_count){	$totalOffer = $Offer_count;} else {	$totalOffer = 0;}
if($reject_count){ $totalrejact = $reject_count; } else { $totalrejact = 0; }

$appliedLink=site_url('jobs/applied/' . base64_encode($jobId));
$interviewsLink=site_url('jobs/interviews/' . base64_encode($jobId));
$offerLink=site_url('offer?job_id=' . base64_encode($jobId));
$hireLink=site_url('hires?job_id=' . base64_encode($jobId));
$rejectLink=site_url('reject?job_id=' . base64_encode($jobId));

// total number of job
$this->db->where(array('job_id' => $jobId,'bid_reject'=>0, 'status!=1' => null));
$this->db->from('job_bids');
$totalApplication = $this->db->count_all_results();

            ?>
            
            <div class="col-md-10 nopadding" >
                <div>
                 <ul class="client-job-activity-current">
                     <li><a class="active-link" href='<?php echo $appliedLink; ?>'>Interview(<?php echo $totalApplication?>)</a> </li>
                     <li><a href='<?php echo $interviewsLink; ?>'>Interview (<?=$interview?>)</a> </li>
                     <li><a href='<?php echo $offerLink; ?>'>Offers (<?=$totalOffer;?>) </a>  </li>
                     <li><a href='<?php echo $hireLink; ?>'>Hires (<?=$hire;?>)</a> </li>
                     <li><a href='<?php echo $rejectLink; ?>'>Rejected (<?=$totalrejact;?>)</a></li>
                     <li><a class="last-element"><button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
												<span class="caret"></span>
											</button></a></li>
                 </ul>
                </div>
            </div>
            <div style="padding:50px;"></div>
            <?php
            foreach ($records as $value) {
                
                $this->db->select('*');
                $this->db->from('job_accepted');
                $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
                $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
                $this->db->where('job_accepted.fuser_id',$value->user_id);
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
                <div class="col-md-12 bordered white-box candidate-list">                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="decline" style="position:absolute;right: 26px;">
                                <a href="javascript:void(0)" style="color:#35a535;font-size: 26px;" id="endpost" onclick="Confirmdecline(<?php echo $value->id;?>);">X</a></div>
                           
                            <div class="row margin-top-1">
                                <div class="col-md-1 margin-left-3">
                                    <?php
                                   
                                    $pic = $this->Adminforms->getdatax("picture", "webuser", $value->user_id);
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
                                <div class="col-md-8 text-left margin-left-1" style="margin-top:-4px;">
                                    <label class="blue-text"><a href="<?php echo base_url() ?>Interview?user_id=<?=base64_encode($value->user_id)?>&job_id=<?=base64_encode($value->job_id)?>&bid_id=<?=base64_encode($value->id)?>"><?php echo ucfirst($value->webuser_fname) . " " . ucfirst($value->webuser_lname) ?></a></label> 
                                    <br/> 
                                    <?php
                                    $profile=array();
                                    $this->db->where('webuser_id', $value->webuser_id);
                                    $q = $this->db->get('webuser_basic_profile');
                                    if ($q->num_rows() > 0) {
                                        $profile = $q->row();
                                        echo ucfirst($profile->tagline);
                                    }
                                    ?>

                                    <div class="row margin-top-2">
                                        <div class="col-md-2">$<?php
                                            echo round($value->bid_amount, 2);
                                            if ($jobDetails->job_type == 'hourly')
                                              echo '/hr';
                                            ?></div>

                                        <div class="col-md-3 ">
                                            
                                          <?php if($total_feedbackScore !=0 && $total_budget!=0){
                                                $totalscore = ($total_feedbackScore / $total_budget);
                                                $rating_feedback = ($totalscore/5)*100;
                                               ?>
                                               <span class="rating-badge"><?=round($totalscore, 2);?></span>
                                              <div title="Rated <?=$totalscore;?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em;margin-top:-5px;">
                                               <span style="width:<?=$rating_feedback;?>% ;margin-top:-5px;">
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

                                        <div class="col-md-2">
                                            <?php
                                            $this->db->select('*');
                                           $this->db->from('job_workdairy');
                                           $this->db->where('fuser_id',$value->user_id);
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
                                           $this->db->where('user_id',$value->user_id);
                                           $this->db->where('jobstatus',1);
                                           $querydone = $this->db->get();
                                         $jobends = $querydone->num_rows();
                                          echo $jobends." jobs";   
                                        ?>
                                        </div>

                                        <div class="col-md-3">
                                            <img src="<?php echo base_url() ?>assets/pin_marker.png"
                                                 width="16" /> <?php
                                                 $this->db->where('country_id', $value->webuser_country);
                                                 $q = $this->db->get('country');
                                                 if ($q->num_rows() > 0)
                                                 {
                                                     $country = $q->row();
                                                     echo ucfirst($country->country_name);
                                                 }
                                                 ?>
                                        </div> 
                                    </div>

                                    <div class="row margin-top-1">
                                        <div class="col-md-12 text-justify"><?php 
                                        echo substr($value->cover_latter, 0, 100); ?></div>
                                    </div>

                                    <div class="row margin-top-1">
                                        <div class="col-md-3"><span class="gray-text">Tag & Skills</span></div>
                                        <div class="col-md-9 skills">                                            
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

                                <div class="col-md-2 margin-top-5 text-right msg-buttons">
                                    <!--<a href="javascript:void(0)" onclick="loadmessage(<?=$value->id?>,<?=$value->user_id?>,<?=$value->job_id?>)">Message</a>-->
                                    <div><a class="btn btn-primary" href="<?php echo base_url() ?>interview?user_id=<?=base64_encode($value->user_id)?>&job_id=<?=base64_encode($value->job_id)?>&bid_id=<?=base64_encode($value->id)?>">Message</a>  
                                    </div>
                                    <div><a class="btn btn-primary" href="<?php if ($jobDetails->job_type == 'hourly') { echo "http://www.deshilancer.com/jobs/confirm_hired_hourly?user_id=".base64_encode($value->user_id)."&job_id=".base64_encode($value->job_id);} else { echo "http://www.deshilancer.com/jobs/confirm_hired_fixed?user_id=".base64_encode($value->user_id)."&job_id=".base64_encode($value->job_id);} ?>">Hire Me</a>
                               </div>
                                     </div>
                            </div>
                        </div>

                    </div>
                </div>  
            <?php } ?>

        </div>

    </div>

</section>

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
<!-- Latest compiled and minified JavaScript -->
<script>
     function Confirmdecline(id) {

	var x = confirm("Are you sure!  want to Decline the User?");
	
	if (x){
		$.post("<?php echo site_url('jobs/bid_decline');?>", { form : id },  function(data) {
			if(data.success){
				$('.result-msg').html('You have successfully Decline the Post');
					window.location = "<?php echo base_url();?>jobs/applied/<?=base64_encode($value->job_id)?>";
					
			} else{
					alert('Opps!! Something went wrong.');
			}
		   
		}, 'json');
	}
}
</script>

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
<style>
.message_lists{
    max-height: 250px;
    overflow-y: scroll;
    overflow-x: hidden;
}

span.rating-badge {
  background: #eba705 none repeat scroll 0 0;
  border-radius: 7px;
  color: #fff;
  padding: 4px;
}
</style>
