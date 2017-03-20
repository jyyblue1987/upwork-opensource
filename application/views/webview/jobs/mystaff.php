<style>
.message_lists{
    max-height: 230px;
    min-height: 230px;
    overflow-y: scroll;
    overflow-x: hidden;
}
.m_list.scroll-ul > li {
  display: block;
  margin: 10px 0 36px 5px;
  overflow: hidden;
  width: 100%;
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
  width: 76%;
}
.modal-body {
  overflow: hidden;padding-bottom: 20px !important;
}
</style>

<section id="big_header" class="my_staff" style="margin-top: 32px; margin-bottom: 40px; height: auto;">

	<div class="container">
		<div class="row ">
			<div class="col-md-3">


				<!--<div class="row">

					<div class="col-md-10 borderedx nopadding white-box"
						style="padding: 3px 15px !important">
						<div class="search-icon blue-text">
							<i class="fa fa-search" aria-hidden="true"></i>
						</div>

						<div class="search-txt-field">
							<input type="text" class="" value=""
								placeholder="Search for freelancers..." />
						</div>
					</div>

				</div>-->

				<div class="row">
					<div class="col-md-10 nopadding">
						<nav class="staff-navbar freelancer-navbar ms_navbar ">
							<ul>
								<li><a class="active" href="<?php echo site_url('jobs/my-freelancers') ?>"><i class="fa fa-briefcase" aria-hidden="true"></i> <b>My Hired</b></a></li>
								<li><a href="<?php echo site_url('jobs/past-hires') ?>"><i class="fa fa-undo" aria-hidden="true"></i> <b>Past Hires</b></a></li>
								<li><a href="<?php echo site_url('jobs/offers-sent') ?>"><i class="fa fa-gift" aria-hidden="true"></i> <b>Offers Sent</b></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>

		
			<div class="col-md-9">
				<div class="row">
					
					    <!--<div class="col-md-12 bordered-alert text-center ack-box hirefeebar">-->
                        <div class="col-md-12 bordered-alert text-center hirefeebar">
							<?php if(!empty($all_data)) { ?>
								<h4>! You have hired <?=count($all_data)?> freelancers in this team</h4>
							<?php } else{?>
								<h4>! You have no hired freelancers in this team</h4>
						</div>
					
						<div class="row">
						    <div class="col-md-12">
						        <div class="border-box empty_freelancer_box">
						    
								</div>
						    </div>
						</div>
					<?php } ?>
				</div>
				<?php 
				if(!empty($all_data)) {
				foreach($all_data as $data) {
					$username =$data->webuser_fname . '&nbsp;'.$data->webuser_lname;
		$title = $data->hire_title;
				if($data->job_type == "hourly"){
				?>

				<!--<div class="row margin-top-2">-->
                                <div class="row margintop-2 ms_white_box">
					<!--<div class="col-md-12 bordered white-box" style="padding: 20px">-->
                    <div class="col-md-12 freelancer-job white-box" style="padding: 20px">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-5" style="padding-left:-20px">
										<div class="st_img freelancer_img">
										    <img src="<?php echo base_url()?><?=$data->webuser_picture?>" width="85" height="68" />
										</div>
									</div>
									<div class="col-md-7 nopadding" style="padding-left: -15px !important">
										<div class="user_name" style="padding-left:2px">
								       <h5 style="margin-bottom:0"><?=$data->webuser_fname?> <?=$data->webuser_lname?><br/></h5>
										<span><?=$data->country_name?></span>
										</div>
									</div>
								</div>

							</div>

							<!--<div class="col-md-4">
								<?php echo $data->weekly_limit;?> hrs this week <br /> @ <?php if($data->offer_bid_amount) {echo $data->offer_bid_amount;} else {echo $data->bid_amount;} ?>/hr = $300

								<hr>
							</div>-->
							<div class="col-md-4 text-center hour_info">
				
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
								   $this->db->select('*');
								   $this->db->from('job_workdairy');
								   $this->db->where('fuser_id',$data->fuser_id);
								   $this->db->where('jobid',$data->job_id);
                                                                    $this->db->where('working_date >=', $this_week_start);
								 $this->db->where('working_date <=', $today);
								   $query_done = $this->db->get();
								   $job_done = $query_done->result();
									 $total_work = 0;
									   if(!empty($job_done)){
										   foreach($job_done as $work){
											   $total_work +=$work->total_hour;
										   }
										   echo $total_work." hrs this week";
									   }else{
										   echo "<b>0.00</b> hrs this week";
									   }
								?>
								   
							
								<?php //echo $data->weekly_limit;?>
								 <br />
								@ <b><?php if($data->offer_bid_amount) {
									echo $amount = $data->offer_bid_amount;
                                } else {echo $amount =  $data->bid_amount;} ?></b>/hr =<b> $<?php echo $amount * $total_work;?></b>
                                <br />
                                <p style="margin:0 !important;">This contract has been hold</p>
                           	<hr>
                            
							</div>
                            
							<div class="col-md-4">
								<div class="row">
									<div class="ms_hr_massage_butt">
									<div class="mystaff_msg_btnx hour_btn message_btn">
									    <input type="button" class="btn btn-primary form-btn"  onclick="loadmessage(<?=$data->bid_id?>,<?=$data->user_id?>,<?=$data->fuser_id?>,'<?=$username?>','<?=$title?>')" value="Message">
										
										<!--<a href="<?php echo base_url() ?>interview?user_id=<?=base64_encode($data->fuser_id)?>&job_id=<?=base64_encode($data->job_id)?>&bid_id=<?=base64_encode($data->bid_id)?>">
											<input type="button" class="btn btn-primary transparent-btn" value="Message" />
										</a>-->
									</div>
									
									</div>
                               
                                   
									<div class="ms_hr_work_diary">
                                  <div class="mystaff_work_diary hour_btn work_diary_btn">
                                   <a href="<?php echo base_url() ?>jobs/workdairy_client?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->fuser_id);?>">
								<input style="margin-right: -1px;" type="button" class="btn btn-primary form-btn" value="Work Diary" /></a>
									</div>
									    
									</div>
										<div class="ms_hr_drop_butt">
										    <div class="dropdown hour_btnx dropdown_btn">
											<button class="btn btn-default dropdown-toggle" type="button"
												data-toggle="dropdown">
												<span class="caret"></span>
											</button>
											<ul style="left: -156px;" class="dropdown-menu">
												<li><a href="#">View contact</a></li>
												<li><a href="#">View Profile</a></li>
												<li><a href="#">End contract</a></li>

											</ul>
										</div>
										</div>
								
								</div>
								
							</div>

						</div>


						<div class="row">
							<div class="col-md-12">
							<div class="job_detais" style="margin-top: -10px;">
							   <a href="<?php echo base_url() ?>jobs/hourly_client_view?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->fuser_id);?>"> Job Details</a>  -
                                <span><b><?=$data->hire_title?></b></span>
							</div>
							</div>
						</div>
					</div>


				</div>
				
				<?php } else { ?>
				
				<!--<div class="row margin-top-2">-->
                                <div class="row margintop-2 ms_white_box2">
					<!--<div class="col-md-12 borderedx white-box" style="padding: 20px">-->
                                        <div class="col-md-12 freelancer-job white-box" style="padding: 20px">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-5" style="padding-left: -20px">
										<div class="st_img freelancer_img">
										    <img src="<?php echo base_url()?><?=$data->webuser_picture?>" width="85" height="68" />
										</div>
									</div>
									<div class="col-md-7 nopadding" style="padding-left: -15px !important">
										<div class="user_name" style="padding-left:2px">
										<h5 style="margin-bottom:0"><?=$data->webuser_fname?> <?=$data->webuser_lname?><br /> </h5>
									<span><?=$data->country_name?></span>
										</div>
									</div>
								</div>

							</div>

				       <div class="pay_btn">
				          <div class="col-md-4 text-center">
	                       <span><b>$<?=$data->fixedpay_amount?></b> Paid of $<?=$data->hired_on?>
                                <br />
                                <p style="margin:0 !important;">This contract has been hold</p>
                               </span>
                               
	                            
							</div>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="ms_massage_butt">
										<div class="mystaff_msg_btn hour_btn fixed_message_btn">
										    <input type="button" class="btn btn-primary form-btn"  onclick="loadmessage(<?=$data->bid_id?>,<?=$data->fuser_id?>,<?=$data->job_id?>,'<?=$username?>','<?=$title?>')" value="Message">
											
										<!--<a href="<?php echo base_url() ?>interview?user_id=<?=base64_encode($data->fuser_id)?>&job_id=<?=base64_encode($data->job_id)?>&bid_id=<?=base64_encode($data->bid_id)?>">
											<input type="button" class="btn btn-primary transparent-btn" value="Message" />
											</a>-->
										</div>
											
									</div>
									<div class="ms_pay_butt">
									    <div class="mystaff_pay_btnx payment_btn">
									        <input type="button" class="btn btn-primary form-btn my-btn"
											value="Payment" id ="2" onclick="editClickedPayment(this.id)" />
									    </div>
									</div>

									<div class="ms_drop_butt">
										<div class="dropdown hour_btnx dropdown_btn">
											<button class="btn btn-default dropdown-toggle" type="button"
												data-toggle="dropdown">
												<span class="caret"></span>
											</button>
											<ul style="left: -156px;" class="dropdown-menu">

												<li><a href="#">Give milestone</a></li>
												<li><a href="#">View contact</a></li>
												<li><a href="#">View Profile</a></li>
												<li><a href="#">End contract</a></li>

											</ul>
										</div>
									</div>
								</div>

								<div class="row margin-top-2">
									<div class="col-md-8 text-left">
							
									</div>

									<div class="col-md-2 text-center"></div>

								</div>

							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
							    <div class="job_detais" style="margin-top: -10px;">
							   <a href="<?php echo base_url() ?>jobs/fixed_client_view?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->fuser_id);?>"> Job Details</a>  -  <span><b><?=$data->hire_title?></b></span>
							</div>
							</div>
							<div class="col-md-6">
								
							</div>
						</div>
					</div>


				</div>
				
				<?php } ?>

				
				<?php } } ?>	
				
          </div>
		</div>
	</div>

</section>

</div>

</section>
<!-- big_header-->
<!-- Modal -->
<div id="message_convertionModal" class="modal custom_modal">
  <div class="modal-dialog cccc_massage_box">
    <div style="padding: 30px;padding-bottom: 60px;" class="modal-content">
	<button type="button" class="close" data-dismiss="modal" onclick="hidemessagepopup();">&times;</button>
	<h4 class="modal-title">Message</h4>
      <div class="modal-header">
			
			<div class="chat-screen">
				<div class="chat-details-topbar">
					<h3 class="user_name"></h3>
					<h5 class="job_title"></h5>
									
				</div>
			</div>
      </div>
      <div class="modal-body">
		<div class="message_lists chat-details form-group" ></div>
        <form style="position:relative;" name="message" action="" method="post" id="conversion_message">
             <textarea name="usermsg"  id="usermsg"></textarea>
				<div style="position: absolute;right: 23%;font-size: 26px;top: 35%;color:#a2a2a2;transform: rotate(90deg);" class="attach_icon">
				<i style="cursor: pointer;" class="fa fa-paperclip" aria-hidden="true"></i>
				</div>
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
<?php 
 // $this->load->view("webview/jobs/payment-modal");
 // $this->load->view("webview/includes/footer-common-script");
 ?>
    
<script>
     function editClickedPayment(clicked_id){ 
        jQuery.noConflict();
        var key = $(this).attr('accesskey');
        $.ajax({
            url:"<?php echo base_url() ?>pay/full_milestone/"+clicked_id,
            data:({key:key}),
            dataType : "html",
            type :"post",
            success:function(response){
                $('#payment-details-modal').html(response.trim());
               
                $('#edit-payment').modal('show');
            },
            error: function(status,error,textStatus){
                alert(error);
            }
        });
        $('#edit-payment').modal('show');
    }
    function loadmessage( b_id, u_id, j_id, u_name, j_title){
			$('.user_name').html(u_name);
			$('.job_title').html(j_title);

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