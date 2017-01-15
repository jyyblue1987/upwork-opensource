
<section id="mid_content">
	<div class="container">
		<div class="row">
				<div class="col-md-9 col-sm-12 margin-top-4 ">
					<div id="wrapper" class="margin-bottom-3 ">
						<div class="row ">
						    <div class="col-md-9 white-box black-box bordered_top">
						        <div class="wrap-top">
						<div class="row">
							<div class="col-md-4 col-sm-4 tohead">
								<h4>Ended <?php  echo date('  M, Y ', strtotime($job->end_date)); ?> </h4>
							</div>
							<div class="col-md-4 col-sm-4 col-md-offset-4 toheadone">
								<h4> ID <?=$job->contact_id ?>  </h4>
							</div>
						</div>
						<div style="clear:both"></div>
						<div class="row">
							<div class="col-md-1 col-sm-1 col-md-offset-1 firshired">
						
							</div>
							<div style="clear:both"></div>
							<div class="col-md-5 col-sm-5 imageheading">
								<div class="image st_img">
									<?php  if($job->webuser_picture !=""){ ?>
										<img src="<?php echo base_url().$job->webuser_picture ?>" width="64" height="64" />
									<?php }else{ ?>
										<img src="<?php echo base_url()?>assets/img/man.png"/>
									<?php  } ?>
								</div>
								<h4 class="free_name"><?=$job->webuser_fname ?> <?=$job->webuser_lname ?> </h4>
								<h3><?=$job->webuser_company ?></h3>
							</div>
							<div class="col-md-3 col-sm-4 imglast">
                                <label class="gray-text">Status: Ended</label>
							</div>
							<div class="col-md-3 col-sm-2">
						<div class="feedback_client_btn">
						  <button type="button" id="massagebuton" class="transparent-btn" onclick="loadmessage(<?=$job->bid_id?>,<?=$job->fuser_id?>,<?=$job->job_id?>)"> Message</button>  
						</div>
									
									
								
							</div>
						</div>
						
						</div>
                        <div class="row">
						        <div class="col-md-12">
						        <div class="job_posting">
						           <?php if($job->hire_title !=""){
									$job_title = $job->hire_title;
								}else{
									$job_title = $job->title;
								}?>
								<span><?=$job_title;?></span><br>
								<a href="<?php echo base_url() ?>jobs/view/<?php echo url_title($job->title) ?>/<?php echo base64_encode($job->job_id);?>">View original job post</a>
						        </div>
						    </div>
						    </div>
						    </div>
						    
						</div>
						<div class="row">
						    <div class="col-md-9  white-box remove-border-top ">
						        <div class="mid-wrop ">
						<div class="row">
							<div class="col-md-10 col-sm-10 col-md-offset-1 seoranking">
								
							</div>
							<div style="clear:both"></div>
							
						</div>
						<div class="row hourlcontact">
							<div class="col-md-2 col-sm-2 col-md-offset-">
								<div class="feedback_title">
								    <h4>Since Start</h4>
								</div>
							</div>
							<div class="col-md-3 col-sm-3 col-md-offset-1">
								<?php
									$this->db->select('*');
										$this->db->from('job_workdairy');
										$this->db->where('fuser_id',$job->fuser_id);
										$this->db->where('jobid',$job->job_id);
										$query_done = $this->db->get();
										$job_done = $query_done->result();
										  $total_work = 0;
											if(!empty($job_done)){
												foreach($job_done as $work){
													$total_work +=$work->total_hour;
												}
												 $total_work." hrs this week";
											}
									 ?>
									 <?php if($job->offer_bid_amount) {
									$amount = $job->offer_bid_amount;
									} else {$amount =  $job->bid_amount;} ?>
									
								<h4 style="font-size:16px"><b><?=$total_work;?></b> Hrs, <b>$<?php echo $weekly_amount = $amount * $total_work;?></b></h4>
							</div>
							
							<div style="clear:both"></div>
							<div class="col-md-2 col-sm-2 col-md-offset-">
                                <div class="feedback_title">
                                    <h4>Hourly Rate </h4>
                                </div>
							</div>
							<div class="col-md-2 col-sm-2 col-md-offset-1">
								<?php if($job->offer_bid_amount !=""){
							$job_price = $job->offer_bid_amount;
						}else{
							$job_price = $job->bid_amount;
						}?>
								<h4 style="font-size:16px"> <b>$<?=$job_price;?></b>/hr</h4>
							</div>
							<div style="clear:both"></div>
							<div class="col-md-2 col-sm-2 col-md-offset-">
                                <div class="feedback_title">
                                    <h4>Weekly Limit </h4>
                                </div>
							</div>
							<div class="col-md-3 col-sm-3 col-md-offset-1">
								<h4 style="font-size:16px"> <b><?=$job->weekly_limit;?></b> hrs/Week</h4>
							</div>
							</div>
							</div>
							<div class="row">
							
						</div>
							<div class="row">
								<div class="col-md-3 col-sm-4 feedback">
								  <div class="main_feedback">
						        	<h4>Feedback to Freelancer</h4>
								  </div>

								</div>
								<?php if(!empty($freelancerfeedback)) { ?>
										<div class="col-md-3 col-sm-4" id="feedbackbutton">
											<button type="button" id="butcancel" class="btn btn-danger rating-badge"><?=$freelancerfeedback->feedback_score;?></button>
											<?php  $rating_result = ($freelancerfeedback->feedback_score/5)*100; ?>
											<h4>
												<div title="Rated <?=$freelancerfeedback->feedback_score;?> out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
											<span style="width:<?=$rating_result;?>%">
												<strong itemprop="ratingValue">5</strong> out of 5
											</span>
											</div>
											</h4>
											
										</div>
										<div class="col-md-12 col-sm-12 wdwarfhead wdwarfheadone">
											<h3 style="font-size:13px"><?=$freelancerfeedback->feedback_comment;?> </h3>
										</div>
								<?php }else{?>
										<div class="col-md-4 col-sm-4" id="feedbackbutton">
											<button type="button" id="butcancel" class="btn btn-danger">0.00</button>
											<h4>
												<div title="Rated 0 out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
											<span style="width:0%">
												<strong itemprop="ratingValue">0</strong> out of 5
											</span>
											</div>
											</h4>
											
										</div>
										<div class="col-md-12 col-sm-12 wdwarfhead wdwarfheadone">
											<h3>Waiting For feedback </h3>
										</div>
								<?php } ?>
								<div style="clear:both"></div>
							</div>
							
							<div class="row">
								<div class="col-md-3 col-sm-4 feedback">
								  <div class="main_feedback">
								      <h4>Feedback to Client</h4>
								  </div>
									
								</div>
								
								<?php if(!empty($clientfeedback)) { ?>
										<div class="col-md-5 col-sm-4" id="feedbackbutton">
						
											    <button type="button" id="butcancel" class="btn btn-danger"><?=$clientfeedback->feedback_score;?></button>
											<?php  $rating_result = ($clientfeedback->feedback_score/5)*100; ?>
											<h4>
												<div title="Rated <?=$clientfeedback->feedback_score;?> out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
											<span style="width:<?=$rating_result;?>%">
												<strong itemprop="ratingValue">5</strong> out of 5
											</span>
											</div>
											</h4>
										
											
										</div>
										<div class="col-md-12 col-sm-12 wdwarfhead wdwarfheadone">
											<h3 style="font-size:13px"><?=$clientfeedback->feedback_comment;?> </h3>
										</div>
								<?php }else{?>
										<div class="col-md-4 col-sm-4" id="feedbackbutton">
											<div class="col-md-12 col-sm-12 wdwarfhead wdwarfheadone">
												<a href="<?php echo base_url() ?>endhourlyfixed/hourly_client?fmJob=<?php echo base64_encode($job->job_id);?>&fuser=<?php echo base64_encode($job->fuser_id);?>">
													<input type="button" class="btn btn-primary form-btn" value="Give feedback" />
												</a>
											</div>
											
										</div>
										<div class="col-md-12 col-sm-12 wdwarfhead wdwarfheadone">
											<h3>Waiting For feedback </h3>
										</div>
								<?php } ?>
								<div style="clear:both"></div>
							</div>
						    </div>
						</div>
							
					</div>
				</div>
			</div>
	</div>
</section>


<!-- Modal -->
<div id="message_convertionModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
			 <button type="button" class="close" data-dismiss="modal" onclick="hidemessagepopup();">&times;</button>
			<h4 class="modal-title">Message</h4>
			<div class="col-lg-12 col-md-12 col-sm-12 chat-screen">
				<div class="chat-details-topbar">
					<h3><?=$job->webuser_fname ?> <?=$job->webuser_lname ?></h3>
					<h5><?=$job_title;?> </h5>
									
				</div>
			</div>
      </div>
      <div class="modal-body">
		<div class="message_lists chat-details form-group" ></div>
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
                        alert('Opps!! Something went wrong.');
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
       
        if (auto_job_id) { auto_job_id = auto_job_id;}else{auto_job_id = 0;}
        if (auto_bid_id) { auto_bid_id = auto_bid_id;}else{auto_bid_id = 0;}
        if (auto_receiver_id) { auto_receiver_id = auto_receiver_id;}else{auto_receiver_id = 0;}
       
        if (auto_job_id && auto_bid_id && auto_receiver_id) {
            setInterval('loadmessage_auto()', 5000);
        }
    }
  autoloading();
</script>
<style>
    *{
        font-family: "Calibri";
    }
.message_lists{
    max-height: 250px;
    overflow-y: scroll;
    overflow-x: hidden;
}
.m_list.scroll-ul > li {
  display: block;
  margin: 10px 0 21px 5px;
  overflow: hidden;
  width: 100%;
  border-bottom: 1px solid #dddddf;
  padding-bottom: 4px;
}
.chat-identity .img-circle {
  float: left;
  margin-right: 14px;
}
    .gray-text{
        font-size: 16px;
    }
.main_feedback h4 {
	font-weight: 800;
	font-size: 11px;
}
    .feedback_title h4{
       font-weight: 800;
	font-size: 14px; 
    }
span.rating-badge {
	background: #F77D0E none repeat scroll 0 0;
	border-radius: 2px;
	color: #fff;
	padding: 2px 4px 2px 5px;
	font-size: 12px;
}
.job_posting {
	font-size: 19px;
	font-family: "calibri";
	src: url(../fonts/Calibri.ttf);
	margin-left: 20px;
}
.job_posting a {
	color: #008200;
}
.white-box{
    background-color:white;
    border-radius: 4px;
    padding: 10px;
    width: 100%;
}
#conversion_message > input {
  background: rgb(28, 167, 219) none repeat scroll 0 0;
  float: right;
  font-size: 21px;
  height: 50px;
  margin-top: 4%;
  vertical-align: middle;
  width: 19%;
}
#butcancel {
	margin-left:-10px;
}
.main_feedback {
	margin-top: 6px;
}
#conversion_message textarea {
  float: left;
  height: 100px;
  width: 80%;
}
.feedback_title {
	margin-left: 19px;
}
.modal-body {
  overflow: hidden;
}
.feedback_client_btn {
	margin-left: 90px;
}
</style>