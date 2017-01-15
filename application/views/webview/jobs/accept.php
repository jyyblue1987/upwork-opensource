<?php 
 $jobId = base64_decode($_GET['fmJob']);
 $Bid_id = base64_decode($_GET['fmBiD']);
?>
<section id="big_header"
	style="margin-top: 50px; margin-bottom: 50px; height: auto;">

	<div class="container">
		<div class="row margin-left-4">
			<div class="col-md-9 bordered">
			<p class="result-msg" style="text-align: center;color: green;font-size: 20px;display: none;"></p>

			    <div class="row">
			         <div class="col-md-12"><span>View Offer</span></div>
			    </div>
				<div class="form-msg"></div>
			    <form method="post" id='offerconfirmed'>
			    <div class="row margin-top">
			         <div class="col-md-3"><label class="gray-text">Send a Message</label></div>
			         <div class="col-md-5">
			             <textarea rows="6" cols="" class="form-control" name="confo_notes" id="confo_notes"></textarea>
			         </div>
			    </div>
			    
			    
			    <div class="row margin-top-1">
			         <div class="col-md-3"><label class="gray-text">Agree to Terms</label></div>
			         <div class="col-md-9">
			             <input type="checkbox" id="tearms" /> I agree to the Winjob <a href=""> Terms and Conditions, Policies</a>
			         </div>
			    </div>
			    
			    
			    <div class="row margin-top-2">
			         <div class="col-md-3"></div>
			         <div class="col-md-9">
						<input name="client_name" type="hidden" id="client_name"  value="<?=$offerduser_details->webuser_fname ?> <?=$offerduser_details->webuser_lname ?>"  />
						<input name="user_name" type="hidden" id="user_name"  value="<?=$user_details->webuser_fname ?> <?=$user_details->webuser_lname ?>"  />
						<input name="client_email" type="hidden" id="client_email"  value="<?=$offerduser_details->webuser_email ?>"  />
						<input name="user_email" type="hidden" id="user_email"  value="<?=$user_details->webuser_email ?>"  />
						<input name="job_name" type="hidden" id="job_name"  value="<?=$offerduser_details->title ?>"  />
						<input name="client_id" type="hidden" id="client_id"  value="<?=$offerduser_details->webuser_id ?>"  />
						<input name="user_id" type="hidden" id="user_id"  value="<?=$user_details->webuser_id ?>"  />
						
						<input name="bid_id" type="hidden" id="bid_id"  value="<?=$Bid_id?>"  />
						<input name="job_id" type="hidden" id="job_id"  value="<?=$jobId?>"  />
						
						<input type="hidden" name='cnfirmed' value='0'/>
			             <input type="button" class="btn btn-primary form-btn" id="accept_offer" value="Accept Offer" />
			              <a href="<?php echo base_url() ?>jobs/accept_hourly?fmJob=<?php echo $_GET['fmJob'];?>"><input type="button" class="btn btn-primary form-btn" value="Cancel" /></a>
						   <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
			         </div>
			    </div>
				</form>
			</div>
		</div>
		
	</div>

</section>

</div>

</section>
<!-- big_header-->
<script>
	$(document).ready(function () {
		$('#accept_offer').on('click', function(e) {
			e.preventDefault;
			
			var $form = $("#offerconfirmed");
			var confo_notes = $('#confo_notes').val();
			if(confo_notes===""){
				return false;
			}
			$('#cnfirmed').val('1');
			$('.form-loader').show();
			
			if (!jQuery("#tearms").is(":checked")) {
				$('.tarms_conditions').html('Please accept the user agreement');
				$(".tarms_conditions").show().delay(5000).fadeOut(); 
				return false;
			}
			
			$.post("<?php echo site_url('Jobs/accept_offer');?>", { form: $form.serialize() },  function(data) {
				if(data.success){
					$form[0].reset();
					$('.form-loader').hide();
					$('.result-msg').html('You have successfully accept the offer');
					$(".result-msg").show().delay(5000).fadeOut();
					setTimeout(function(){ window.location = "<?php echo base_url();?>winsjob"; }, 5000);
					
				}
				else{
					alert('Opps!! Something went wrong.')
				}
			   
			}, 'json');
			
			
			
			
		});
	});
	
	

</script>

