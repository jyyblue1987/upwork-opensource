<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css" />

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.rateyo.css"/>

<style>
.message_lists{
    max-height: 250px;
    overflow-y: scroll;
    overflow-x: hidden;
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
.offer_job_details a {
font-size: 17px;
color: #37A000;
font-weight: 800;
margin-top: 10px;
margin-left: -24px;
}
.offer_st_img img {
    border-radius:50%;
    height: 75px;
    width: 75px;
    margin-left: 20px;
    }
.cancel_offer_btn {
	margin-left: 9px;
}
.offer_sms_btn {
	margin-left: 40px;
}
.view_pro_btn a{
    margin-left: 20px;
    font-weight: 700;
    font-size: 17px;
    }
.aplicant_name {
        font-size: 16px;
        font-family: "Calibri";
        color: #1CA7DB
}
.aplicant_country {
    color: #494949;
    font-size: 15px;
    font-family: "Calibri";
    }
	.custom-application_drop_down ul {
	left: -101px;
}
body {
        font-family: "Calibri" !important;
        src: url(./fonts/Calibri.ttf);
    }
</style>
<section id="big_header" style="margin-top: 32px; margin-bottom: 60px; height: auto;">

    <div class="container">
    <div class="row"> 
      <div style="margin-top: -6px;margin-bottom: -5px;" class="main_job_titie">
           <b> <?= $job_type." - ".$job_title; ?><br/><br/></b> 
      </div>
      </div>
        <div class="row "> 

              <div class="col-md-12 nopadding" >
                <ul class="client-job-activity-current">
                     <li><a href='<?= site_url('jobs/applications/' . $jobId) ?>'>Application (<?= $applicants ?>)</a></li>
                     <li><a href='<?= site_url('jobs/interviews/' . $jobId) ?>'>Interview (<?=$interviews?>)</a> </li>
                     <li><a class="active-link" href='<?= site_url('offered?job_id=' . $jobId) ?>'>Offers (<?=$offers;?>) </a>  </li>
                     <li><a href='<?= site_url('hired?job_id=' . $jobId) ?>'>Hires (<?=$hires;?>)</a> </li>
                     <li><a href='<?= site_url('declined?job_id=' . $jobId) ?>'>Rejected (<?=$rejects;?>)</a></li>
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
            <div style="padding:30px;"></div>
		<?php foreach($records as $value){ ?>
		
		
		<div class="row" style="margin:0px;"> 
			<div class="col-md-12  white-box candidate-list" style="padding: 20px;height:155px">
				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-5">
								<div style="margin-bottom: 17px;" class="offer_st_img">
								    <img src="<?= site_url($value['pic']); ?>" width="90" height="68">
								</div>
							</div>
							<div class="col-md-7 nopadding" style="padding-left: 20px !important">
								<div style="margin-bottom: 10px;" class="aplicant_name">
								    <?php echo ucfirst($value['fname']) . " " . ucfirst($value['lname']) ?>
								</div>
								<div>
								<i style="font-size: 15px;" class="fa fa-map-marker"></i> 
								<b><?= $value['country'] ?></b>
								</div>
							</div>
						</div>

					</div>

					<div class="col-md-4 text-center">
						
					</div>

					<div class="col-md-4">
						<div class="row">
						<div class="col-md-4 col-md-offset-2">
						<div class="offer_sms_btn">
						    <input type="button" class="btn btn-primary form-btn"  onclick="loadmessage(<?=$value['bid_id'] ?>,<?= $value['user_id'] ?>,<?=$value['job_id']?>)" value="Message"> 
						</div>
					</div>
							<div class="col-md-4 text-right">
								<div class="cancel_offer_btn">
								    <a href="<?php echo base_url();?>canceloffer?bid_id=<?=base64_encode($value['bid_id'])?>&job_id=<?=base64_encode($value['job_id'])?>" class="btn btn-primary form-btn my-btn">Cancel Offer</a>
								</div>
							</div>

							<div class="col-md-2">
								<div class="dropdown">
									<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a href="#">Message</a></li>
										<li><a href="#">Change Rate</a></li>
										<li><a href="#">Change limit</a></li>
										<li><a href="#">View contact</a></li>
										<li><a href="#">End contact</a></li>

									</ul>
								</div>
							</div>
						</div>


					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
					  <div class="view_pro_btn">
					      <a href="<?php echo base_url()."applicants?user_id=".base64_encode($value['user_id'])."&job_id=".base64_encode($value['job_id'])."&bid_id=".base64_encode($value['bid_id']);?>">View Profile</a>
					  </div>
					</div>
					<div class="col-md-8">
						
						<div class="offer_job_details">
						<!--<a href="<?php echo base_url() ?>jobs/<?php echo str_replace(' ', '-', $message->title) ?>/<?php echo base64_encode($message->job_id);?>">-->
						
						<?php if($value['hire_title'] !=""){
							$job_title = $value['hire_title'];
						}else{
							$job_title = $value['title'];
						}?>
						<a href="<?php echo base_url();?>canceloffer?bid_id=<?=base64_encode($value['bid_id'])?>&job_id=<?=base64_encode($value['job_id'])?>">Job Details </a>- <b><span style="font-family:'calibri';font-size:17px;"><?=$job_title;?></span></b>
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