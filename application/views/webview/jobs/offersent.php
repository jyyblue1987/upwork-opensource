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
</style><?php if($offer_count){	$totalOffer = $offer_count;} else {	$totalOffer = 0;}?>
<section id="big_header"
	style="margin-top: 30px; margin-bottom: 40px; height: auto;">

	<div class="container">
		<div class="row ">
			<div class="col-md-3">

				<div class="row">
					<div class="col-md-10 nopadding">
						<nav class="staff-navbar os_navbar">
							<ul style="margin-top: 6px;">
								<li><a href="<?php echo site_url('jobs/my-freelancers') ?>"><i style="margin-right: 5px;" class="fa fa-briefcase"></i><b>My Hired</b> </a></li>
								<li><a href="<?php echo site_url('jobs/past-hires') ?>"><i style="margin-right: 5px;" class="fa fa-undo"></i><b>Past Hires</b></a></li>
								<li><a class="active" href="<?php echo site_url('jobs/offers-sent') ?>"><i style="margin-right: 5px;" class="fa fa-gift"></i><b>Offers Sent</b> </a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>

			<div class="col-md-9">
			<div class="os_custom_body">
				<div class="row">
					<div style="margin-left: -2px !important; margin-bottom: 0px; padding-top: 7px; padding-bottom: 0px;width: 737px;margin-top: 10px;height: 40px;" class="col-md-12 bordered-alert text-center ack-box">
					<?php if($offer_count){ ?>
					<h4>! You have sent <?=$offer_count;?> offers</h4>
					</div>
					<?php } else{?>
						<h4>! You have not sent any offers</h4>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="border-box custom_empty_freelancer_box">
							</div>
						</div>
					</div>
					
					<?php } ?>
				</div>
				
				
				<?php foreach($messages as $message){
					$username =$message->webuser_fname . '&nbsp;'.$message->webuser_lname;
		$title = $message->hire_title;
		
		//print_r($message);
					?>
				
				<div style="margin-left: -19px !important;" class="row margin-top-2">
					<div class="col-md-12 white-box os_white_box" style="padding: 20px;">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-5">
										<?php if($message->webuser_picture !=""){ ?>
										<div style="margin-left: -10px;margin-top: -2px;margin-bottom: 10px;" class="st_img">
										    <img src="<?php echo base_url().$message->webuser_picture; ?>" width="90" height="68">
										</div>
										<?php }else{?>
											<img src="<?php echo base_url()?>assets/img/profile_img.jpg"
											width="90" height="68" />
										<?php } ?>
										
									</div>
									<div class="col-md-7 nopadding" style="padding-left: 2px !important">
										<div class="user_name">
										  <h5 style="margin-bottom: 0;"><?=$message->webuser_fname?> <?=$message->webuser_lname?><br></h5>
                                            <span><?=$message->country_name?></span>
										</div>
									</div>
								</div>

							</div>

							<div class="col-md-4 text-center">
							
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="os_massage_butt">
                                   <div class="msg_btnx hour_btn">
                                      <!--	<input type="button" class="btn btn-primary transparent-btn"  onclick="loadmessage(<?=$message->bid_id?>,<?=$message->user_id?>,<?=$message->job_id?>)" value="Message">-->
								<input type="button" class="btn btn-primary form-btn"  onclick="loadmessage(<?=$message->bid_id?>,<?=$message->webuser_id?>,<?=$message->job_id?>,'<?=$username?>','<?=$title?>')" value="Message"> 
                                   </div>
								      </div>
							          <div class="os_cancel_butt">
							            <div class="cancel_btn">
								    <a href="<?php echo base_url();?>canceloffer?bid_id=<?=base64_encode($message->bid_id)?>&job_id=<?=base64_encode($message->job_id)?>" class="btn btn-primary form-btn">Cancel Offer</a>
								      </div> 
							          </div>

									<div class="os_drop_butt">
										<div class="dropdown">
											<button class="btn btn-default dropdown-toggle" type="button"
												data-toggle="dropdown">
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu">
<!--											<li><a href="#">Message</a></li>
												<li><a href="#">Give bonus</a></li>-->
												<li><a href="#">View offer</a></li>
<!--											<li><a href="#">View contact</a></li>-->
<!--											<li><a href="#">End contact</a></li>-->
											</ul>
										</div>
									</div>
								</div>


							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<div style="margin-top: 0px;" class="pro_view">
								    <a style="font-size: 14px;color: #3DB0DD;" href="<?php echo base_url()."applicants?user_id=".base64_encode($message->webuser_id)."&job_id=".base64_encode($message->job_id)."&bid_id=".base64_encode($message->bid_id);?>">View Profile</a>
								</div>
							</div>
						
							<div style="margin-top: 0px;margin-left: -33px;" class="col-md-10">
								<div class="job_detais">
								    <?php if($message->hire_title !=""){
									$job_title = $message->hire_title;
								}else{
									$job_title = $message->title;
								}?>
								<a href="<?php echo base_url();?>canceloffer?bid_id=<?=base64_encode($message->bid_id)?>&job_id=<?=base64_encode($message->job_id)?>">Job Details - </a>
								<b><?=$job_title;?></b>
								</div>
							</div>
						</div>


					</div>
				</div>
					<?php } ?>

			</div>
			</div>
		</div>
	</div>

</section>


<!-- big_header-->


<!-- Modal -->
<div id="message_convertionModal" class="modal">
  <div class="modal-dialog cccc_massage_box">
    <div style="padding: 30px;padding-bottom: 60px;" class="modal-content">
		<button type="button" class="close" data-dismiss="modal" onclick="hidemessagepopup();">&times;</button>
		<h4 class="modal-title">Message</h4>
		  <div class="modal-header">
				<div class="col-lg-12 col-md-12 col-sm-12 chat-screen">
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

<script>
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