<section id="big_header"
	style="margin-top: 50px; margin-bottom: 50px; height: auto;">

	<div class="container">
		<div class="row">
			<div class="col-md-9 white-box black-box bordered_top">
				<div class="row">
					<div class="date_head">
					    <div class="col-md-6">Since <?php  echo date(' M j, Y ', strtotime($job_status->start_date)); ?></div>
					<div class="col-md-4 col-md-offset-2"><span>ID <?=$job_status->contact_id ?></span></div>
					</div>
				</div>

				

				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-4 col-md-offset-1 text-left">
								<div class="st_img">
								    <?php  if($job_status->webuser_picture !=""){ ?>
									<img src="<?php echo base_url().$job_status->webuser_picture ?>" width="64" height="64" />
								<?php }else{ ?>
									<img src="<?php echo base_url()?>assets/img/profile_img.jpg" width="64" height="64" />
								<?php  } ?>
								</div>
							</div>
							<div class="col-md-7 text-left ">
								<h5 class="free_name"><?=$job_status->webuser_fname ?> <?=$job_status->webuser_lname ?></h5>
							
								<p class="free_name"> <?=$job_status->webuser_company ?></p>
							</div>
						</div>
					</div>

					<div class="col-md-4 text-center gray-text">
						<div class="status_bar">
						    	
						<?php if($ststus->isactive==0){ ?>
							<label class="gray-text">Status : <span style="color:#ff0000;" >Hold</span></label>
						<?php }else if($job_status->jobstatus ==1){?>
							<label class="gray-text">Status : Ended</label>
						<?php }else{ ?>
							<label class="gray-text">Status : Active</label>
						<?php	} ?>
						</div>
					</div>
					<div class="col-md-3 col-md-offset-1 ">
						<div class="msg_btnx hour_btn">
						    <input type="button" class="transparent-btn" value="Message" onclick="loadmessage(<?=$job_status->bid_id?>,<?=$job_status->fuser_id?>,<?=$job_status->job_id?>)" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-md-offset-1">
						<div class="job_title">
						   <span> <?php if($job_status->hire_title !=""){
							$job_title = $job_status->hire_title;
						}else{
							$job_title = $job_status->title;
						}?>
						<?=$job_title;?></span><br />
						<a href="<?php echo base_url() ?>jobs/view/<?php echo url_title($job_status->title) ?>/<?php echo base64_encode($job_status->job_id);?>">View original job post</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-change"></div>
		<div class="row">
			<div class="col-md-9 white-box remove-border-top ">

				<div class="row">
					
				</div>

				<div class="row margin-top-2">
					<div class="col-md-12 bordered_week">
						<div class="row nav-bar">
							<div class="col-md-4 blue-text text-center nav-bar-item">
								<label class="gray-text"><b>This Week</b></label>
								<?php
                                                                date_default_timezone_set("UTC"); 
                                            $today = strtotime('today'); 
                                            $today = date('y-m-d',$today);
                                            $this_week_start = strtotime('monday this week');
                                             $this_week_start = date('y-m-d',$this_week_start);
                                          //  var_dump($today);var_dump($this_week_start);die();
                                            
                                            
                                            $this_week_end = strtotime('+1 week sunday');
                                             $this_week_end = date('y-m-d',$this_week_end);

                                            $last_week_start = strtotime('previous monday');
                                             $last_week_start = date('y-m-d',$last_week_start);
                                            $last_week_end = strtotime('previous sunday');
                                             $last_week_end = date('y-m-d',$last_week_end);
                                             //   var_dump($last_week_start);var_dump($last_week_end);die();
									$this->db->select('*');
								   $this->db->from('job_workdairy');
								   $this->db->where('fuser_id',$job_status->fuser_id);
								   $this->db->where('jobid',$job_status->job_id);
								   $this->db->where('working_date >=', $this_week_start);
								 $this->db->where('working_date <=', $today);
								   $query_done = $this->db->get();
								   $job_done = $query_done->result();
									 $total_work_cweek = 0;
									   if(!empty($job_done)){
										   foreach($job_done as $work){
											   $total_work_cweek +=$work->total_hour;
										   }
										    $total_work_cweek." hrs this week";
									   }
								?>
							<span class="bold_text"><br/><?=$total_work_cweek;?> Hrs <br /></span>
								<label class="gray-text hours_text">
									<?php if($job_status->offer_bid_amount) {
									$amount = $job_status->offer_bid_amount;
									} else {$amount =  $job_status->bid_amount;} ?>
									$<?php echo $weekly_amount = $amount * $total_work_cweek;?>
								</label>
								
								
								
							</div>
							<div class="col-md-4 blue-text text-center nav-bar-item">
								<label class="gray-text">Last Week</label>
							<?php	$this->db->select('*');
								   $this->db->from('job_workdairy');
								   $this->db->where('fuser_id',$job_status->fuser_id);
								   $this->db->where('jobid',$job_status->job_id);
								   $this->db->where('working_date >=', $last_week_start);
								 $this->db->where('working_date <=', $last_week_end);
								   $query_done_prev = $this->db->get();
								   $job_done_prev = $query_done_prev->result();
									 $total_work_prevweek = 0;
									   if(!empty($job_done_prev)){
										   foreach($job_done_prev as $work_prev){
											   $total_work_prevweek +=$work_prev->total_hour;
										   }
										    $total_work_prevweek." hrs this week";
									   }
								?>
                             <span class="bold_text"><br/><?=$total_work_prevweek;?> Hrs <br/></span>
								<label class="gray-text hours_text">
									<?php if($job_status->offer_bid_amount) {
									$amount = $job_status->offer_bid_amount;
									} else {$amount =  $job_status->bid_amount;} ?>
									$<?php echo $prevweekly_amount = $amount * $total_work_prevweek;?>
								</label>
								
							</div>
							<div class="col-md-4 blue-text text-center nav-bar-item">
                                                            
                                                   <?php	$this->db->select('*');
								   $this->db->from('job_workdairy');
								   $this->db->where('fuser_id',$job_status->fuser_id);
								   $this->db->where('jobid',$job_status->job_id); 
								   $query_done = $this->db->get();
								   $job_done = $query_done->result();
									 $total_work = 0;
									   if(!empty($job_done)){
										   foreach($job_done as $work){
											   $total_work +=$work->total_hour;
										   }
										   
									   }
                                                                          // var_dump($job_done);die();
								?>         
								<label class="gray-text">Total</label> <br /> <label
									class="gray-text bold_text"><?=$total_work ;?> Hrs</label> <br /> <label
									class="gray-text hours_text">$<?=$total_work*$amount;?></label>
							</div>
						</div>
					</div>

				</div>


				<div class="row margin-top">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">

							<div class="col-md-12 text-center">
								<a href="<?php echo base_url() ?>jobs/workdairy_client?fmJob=<?php echo base64_encode($job_status->job_id);?>&fuser=<?php echo base64_encode($job_status->fuser_id);?>">
                                    <input type="button" class="btn btn-primary form-btn" value="View Work Diary" />
								</a>
								
							</div>

						</div>
					</div>
				</div>

				<div class="row margin-top-1">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<hr>
						</div>
					</div>
				</div>

				<div class="row margin-top-1 margin-bottom-2">
					<div class="col-md-10 col-md-offset-1 text-left">
						<div class="row">
							<div class="col-md-8 text-centered text-left">
								<div class="row">
								    <div class="col-md-4">
								        <div class="week_font">
								   <span> Hourly Rate <br /><br/> Weekly Limit </span>
								</div>
								    </div>
								    <div class="col-md-8">
								        <div class="p-btn">
								             <span>
								       <b> $<?php if($job_status->offer_bid_amount) {echo $job_status->offer_bid_amount;} else {echo $job_status->bid_amount;} ?></b> /hr <br /> <br/><b><?=$job_status->weekly_limit ?></b> Hrs/Week  
								   </span>     
                                    <div class="hour_pause_btn">
                                        <input type="button" class="btn btn-primary form-btn pause-btn"
									value="Pause" />
                                    </div>
								        </div>
								    </div>
				
								</div>
							</div>
							<div class="col-md-4 text-centered text-left gray-text">
								<div class="p-btn">
								  
								    </div>
								<div class="col-md-4 text-right gray-text">
								
							</div>
							
						</div>
					</div>
				</div>


				<div class="row margin-top-1">
					<div class="col-md-12">
						<div class="row margin-top-3"> 
							<div class="col-md-6 text-centered text-center"></div>
							<div class="col-md-6 text-right">
							    <div class="hour_end_btn">
								    <?php if($job_status->jobstatus ==1){?>
									<a href="<?php echo base_url() ?>feedback/hourly_client?fmJob=<?php echo base64_encode($job_status->job_id);?>&fuser=<?php echo base64_encode($job_status->fuser_id);?>">
									<input type="button" class="btn my_btn" value="End Contract" />
								</a>
								<?php }else{ ?>
									<a href="<?php echo base_url() ?>endhourlyfixed/hourly_client?fmJob=<?php echo base64_encode($job_status->job_id);?>&fuser=<?php echo base64_encode($job_status->fuser_id);?>">
									<input type="button" class="btn  my_btn" value="End Contract" />
								</a>
								<?php	} ?>
								
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
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
			 <button type="button" class="close" data-dismiss="modal" onclick="hidemessagepopup();">&times;</button>
			<h4 class="modal-title">Message</h4>
			<div class="col-lg-12 col-md-12 col-sm-12 chat-screen">
				<div class="chat-details-topbar">
					<h3><?=$job_status->webuser_fname ?> <?=$job_status->webuser_lname ?></h3>
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
#conversion_message > input {
  background: rgb(28, 167, 219) none repeat scroll 0 0;
  float: right;
  font-size: 21px;
  height: 50px;
  margin-top: 4%;
  vertical-align: middle;
  width: 19%;
}
#conversion_message textarea {
  float: left;
  height: 100px;
  width: 80%;
}
.modal-body {
  overflow: hidden;
}
</style>

