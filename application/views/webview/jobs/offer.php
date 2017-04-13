

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css" />

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.rateyo.css"/>

<section id="big_header"
         style="margin-top: 70px; margin-bottom: 50px; height: auto;">

    <div class="container">
        <div class="row "> 
<?php
$jobId = base64_decode($_GET['job_id']);
if($interview_count){	$interview = $interview_count;} else {	$interview = 0;}
if($hire_count){	$hire = $hire_count;} else {	$hire = 0;}
if($Application_count){	$totalApplication = $Application_count;} else {	$totalApplication = 0;}
if($Offer_count){	$totalOffer = $Offer_count;} else {	$totalOffer = 0;}
if($reject_count){ $totalrejact = $reject_count; } else { $totalrejact = 0; }

$appliedLink=site_url('jobs/applications/' . base64_encode($jobId));
$interviewsLink=site_url('jobs/interviews/' . base64_encode($jobId));
$offerLink=site_url('offer?job_id=' . base64_encode($jobId));
$hireLink=site_url('hires?job_id=' . base64_encode($jobId));
$rejectLink=site_url('reject?job_id=' . base64_encode($jobId));

?>
			
			
              <div class="col-md-10 nopadding" >
                <ul class="client-job-activity-current">
                     <li><a  href='<?php echo $appliedLink; ?>'>Application (<?php echo $totalApplication?>)</a> </li>
                     <li><a href='<?php echo $interviewsLink; ?>'>Interview (<?=$interview?>)</a> </li>
                     <li><a class="active-link" href='<?php echo $offerLink; ?>'>Offers (<?=$totalOffer;?>) </a>  </li>
                     <li><a href='<?php echo $hireLink; ?>'>Hires (<?=$hire;?>)</a> </li>
                     <li><a href='<?php echo $rejectLink; ?>'>Rejected (<?=$totalrejact;?>)</a></li>
                     <li><a class="last-element"><button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
												<span class="caret"></span>
											</button></a></li>
                                                                                        
                 </ul>
            </div>
            <div style="padding:44px;"></div>
		<?php foreach($messages as $message){ ?>
		
		
		<div class="row" style="margin:0px;"> 
			<div class="col-md-12 bordered white-box candidate-list" style="padding: 20px;">
				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-5">
								<img src="<?php echo base_url().$message->webuser_picture; ?>" width="90" height="68">
							</div>
							<div class="col-md-7 nopadding" style="padding-left: 25px !important">
								<?=$message->webuser_fname?> <?=$message->webuser_lname?> <br> <img src="<?php echo base_url();?>assets/pin_marker.png" width="15">
								<?=$message->country_name?>
							</div>
						</div>

					</div>

					<div class="col-md-4 text-center">
						<input type="button" class="btn btn-primary transparent-btn"  onclick="loadmessage(<?=$message->bid_id?>,<?=$message->user_id?>,<?=$message->job_id?>)" value="Message"> 
					</div>

					<div class="col-md-4">
						<div class="row">
							<div class="col-md-8 text-left">
								<a href="<?php echo base_url();?>canceloffer?bid_id=<?=base64_encode($message->bid_id)?>&job_id=<?=base64_encode($message->job_id)?>" class="btn btn-primary form-btn">Cancel Offer</a>
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
					<div class="col-md-10 margin-left-10">
						<hr>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2"><a href="<?php echo base_url()."interview?user_id=".base64_encode($message->webuser_id)."&job_id=".base64_encode($message->job_id)."&bid_id=".base64_encode($message->bid_id);?>">View Profile</a></div>
					<div class="col-md-8">
						
						
						<!--<a href="<?php echo base_url() ?>jobs/<?php echo str_replace(' ', '-', $message->title) ?>/<?php echo base64_encode($message->job_id);?>">-->
						
						<?php if($message->hire_title !=""){
							$job_title = $message->hire_title;
						}else{
							$job_title = $message->title;
						}?>
						<a href="<?php echo base_url();?>canceloffer?bid_id=<?=base64_encode($message->bid_id)?>&job_id=<?=base64_encode($message->job_id)?>"><?=$job_title;?> </a>
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
<style>
.message_lists{
    max-height: 250px;
    overflow-y: scroll;
    overflow-x: hidden;
}

</style>



 