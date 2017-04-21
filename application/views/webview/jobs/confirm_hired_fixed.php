<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css">
<style>
h2.success {  width: 100%; text-align: center;  color: green;  display: none;}
.active { background-color: #ffffff!important; color: #343434;}
</style>
<section id="big_header" style="margin-top: 40px; margin-bottom: 40px; height: auto;">

	<div class="container">
		<div style="border:1px solid #ccc;margin-right: 15px;" class="row white-box-feed confirm_hire">
			<div class="col-md-9">
			<form  style="margin-bottom: 0;" action="<?php echo base_url() ?>Jobs/confirm_hired" id="hire_job" method="POST">
					<div class='success' style="color: red; "></div>
				<div class="row">
					<div class="col-md-12">
						<h4 style="font-family: calibri;font-size: 22px;"><b>Confirm Hire</b></h4>
					</div>

				</div>

				<div class="row">
					<div class="col-md-12 text-left"><h4 class="confirm_hire_title">Job Title:</h4></div>
					<div class="col-md-12">
					  <div class="hire_job_title">
							<h4 class="main_title custom_confirm_hire_j_title"><?=$job_details[0]->title?></h4>
					  </div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<h4 style="font-size:22px;font-family: calibri;margin-bottom: 15px;"><b>Contact Details</b></h4>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 text-left"><h4 class="confirm_hire_title">Title (Optional) :</h4></div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-8">
							<div class="input_title">
							    <input name="title" type="text" class="form-control border-field" placeholder="Job title (optional)" />
							</div>
							</div>
						</div>
						<div class="row margin-top-2">
							<div class="col-md-2">
								<div class="st_img">
								    <img src="<?php echo base_url().$user_details[0]->webuser_picture;?>"
									width="86" height="66" />
								</div>
							</div>
							<div style="margin-left: -23px;" class="col-md-10">
								<label class="web_user_name"><?=$user_details[0]->webuser_fname?> <?=$user_details[0]->webuser_lname?></label> <br /> <label class="user_company_name"><?=$user_details[0]->tagline?></label>
							</div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-12 text-left"><h4 style="margin-top: 5px;" class="confirm_hire_title">Job Type :</h4></div>
					<div class="col-md-12">
						<strong style="font-size:17px;font-weight: 400;font-family: calibri;">Fixed Price</strong>
					</div>

				</div>

				<div class="row margin-top-1">
					<div class="col-md-12"><h4 class="confirm_hire_title">Amount :</h4> </div>
					<div class="col-md-12">
						<strong style="font-size:17px;font-weight: 400;font-family: calibri;">$ <?=$bid_details[0]->bid_amount?>&nbsp;</strong>
						
						<a id="budget-edit"><i style="margin-left: 10px;" class="fa fa-pencil-square-o blue-text"></i></a>
                        
						<div style="width:200px;">
                            <input type="hidden" name="budget" id="budget" class="form-control" value="<?=$bid_details[0]->bid_amount?>" />

                            <input type="text" name="budget" id="budget-edit-field" class="form-control custom_amount_box" value="<?=$bid_details[0]->bid_amount?>" />
						</div>
                        
						<div class="col-md-4" style="display: inline-block">
							<input type="hidden" id="actual_budget_value" class="form-control" value="<?=$bid_details[0]->bid_amount?>" />
						</div>
						
						<div class="clearfix"></div>
						<div style="margin-top: 20px;" class="row">
							<div class="col-md-9" style="font-size:13px">
								<input style="float: left;margin-right: 10px;" checked type="radio" name="budget_type" value="1" />
								<p style="margin-bottom: 0;margin-top: -2px;font-size: 17px;font-family: calibri;">Paid All</p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-9 margin-top-1 " style="font-size:13px">
								<input style="float: left;margin-right: 10px;" type="radio" name="budget_type" value="0" />
								<p style="margin-bottom: 0;margin-top: -2px;font-size: 17px;font-family: calibri;">Paid Nothing</p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-9 margin-top-1 ">
								<div class="row">
									<div style="margin-right: -60px;" class="col-md-4">
										<input  style="float: left;margin-right: 10px;" type="radio" name="budget_type" id="milestone_radio"  value="2"/>
										<p style="margin-bottom: 0;margin-top: -2px;font-size: 17px;font-family: calibri;">Milestone</p>
									</div>


									<div class="col-md-5 hidden nopadding" id="milestone-field">
										<div style="font-size: 17px;font-family: calibri;" class="col-md-1">$</div>
										<div class="col-md-4 nopadding">
											<input style="margin-top: -13px;width: 80px;" type="text" id="milestone_input" name="milestone_input" class="form-control" />
										</div>

									</div>

								</div>

								<!-- <div class="row hidden" id="milestone-field">
									<div class="col-md-1">$</div>
									<div class="col-md-2 nopadding">
										<input type="text" class="form-control" />
									</div>

								</div> -->
							</div>
						</div>
					</div>

				</div>

				<div class="row margin-top-1">
					<div class="col-md-12 text-left"><h4 style="margin-bottom: 6px;" class="confirm_hire_title">Job Duration :</h4></div>
					<div class="col-md-12">
						<strong style="font-size:17px;font-weight: 400;font-family: calibri;"><?php echo str_replace('_', '-', $job_details[0]->job_duration) ?></strong>
					</div>

				</div>

				<div class="row margin-top-1">
					<div class="col-md-12 text-left" style="font-size:13px"><h4 class="confirm_hire_title">Start Date :</h4></div>
					<div class="col-md-12">
					<div class="srart_duration">
					  <input style="width: 195px;" value="<?php echo date('d/m/Y');?>" id="datetimepicker" name="start_date" type="text" class="form-control" >  
					</div>
					
					</div>
					<div class="col-md-5"></div>
					<p class="date_error" style="color:red;display:none;"></p>
				</div>

				<div class="row margin-top-1">
					<div style="margin-top: -7px;" class="col-md-12"><h4 class="confirm_hire_title">Message to freelancer :</h4></div>
					<div class="col-md-12">
						<textarea class="form-control" name="message" rows="6" cols="30"></textarea>
					</div>

				</div>

				<div class="row">
					<div class="col-md-12">
						<input type="hidden" name="applier_id" id="applier_id" value="<?=base64_decode($applier_id)?>">
						<input type="hidden" name="job_id" id="job_id" value="<?=base64_decode($job_id)?>">
						<input type="hidden" name="payer_email" id="payer_email" value="<?=$user_details[0]->webuser_email;?>">
						<input type="hidden" name="default_title" id="default_title" value="<?=$job_details[0]->title?>">
						<input style="float: left;margin-right: 10px;" type="checkbox" name="tearms" id="tearms" required />
                                                <p> I understand and agree to the Winjob <a href="">user Agreement</a> and <a href="">policy</a></p>
						<p class="tarms_conditions" style="color:red;display:none;"></p>
					</div>

				</div>

				<div class="row">
					<div style="margin-left: -30px;" class="col-md-12">
						<div class="confirm_hire_btn" style="margin-right: 30px">
							<input style="float: left;margin-right: -2px;" type="submit" value="Confirm hire" class="btn my_btn" /> 
						</div>
						
						<div class="cencel_content_btn" style="margin-left: -65px">
							<input type="button" value="Cancel" class="btn my_btn" />
						</div>							
					</div>
				</div>
			</form>
			<strong id="hr_msg"></strong>
			</div>
		</div>
	</div>

</section>

</div>

</section>
<!-- big_header-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>

<script>


    jQuery('#datetimepicker').datetimepicker({
        timepicker: false,
        format: 'd/m/Y'
    });




$(document).on('keyup', '#milestone_input', function() {

	if(isNaN($('#milestone_input').val())){
		$('#milestone_input').val("");
	} else {
		$('#budget').val($('#milestone_input').val());
	}


});
</script>





<script>
$('input[name="budget"]').on('click', function(){

	if($(this).attr('id') == 'milestone_radio') {
		$('#milestone-field').removeClass('hidden');
	}else {
		$('#milestone-field').addClass('hidden');
	}
});

$('#hire_job [name="budget_type"]').on('change', function() {
  var  chack = $('input[name=budget_type]:checked', '#hire_job').val();
	 var budget = $('#hire_job #budget').val();
	if(chack === '0'){
	  $('#hire_job #budget').val("0");
$("#milestone-field").addClass("hidden");
	}
	if(chack === '1'){
$("#milestone-field").addClass("hidden");
$('#budget').val($('#actual_budget_value').val());
	}
	if(chack === '2'){
	  $('#hire_job #budget').focus();
$("#milestone-field").removeClass("hidden");
	}


});


</script>

<script>
$(document).ready(function() {
    $('#budget-edit-field').hide();

    $('#budget-edit').on('click', function() {
        $('#budget').hide();
        $('#budget-edit').hide();
        $('#budget-show').hide();
        $('#budget-edit-field').show();
    });

  $('#confirm_hire').on('click', function(e) {
		e.preventDefault;
		var id = $(this).attr('id');
		var $form = $("#hire_job");
		if (!jQuery("#tearms").is(":checked")) {
			$('.tarms_conditions').html('Please accept the user agreement');
			$(".tarms_conditions").show().delay(5000).fadeOut();
			return false;
		}
		if($('#datetimepicker').val() === ""){
			$('.date_error').html('Please select start date');
			$(".date_error").show().delay(5000).fadeOut();
			return false;
		}

		$('.confirm_hire').prop('disabled', true);
		$.post("<?php echo base_url() ?>Jobs/confirm_hired", { form: $form.serialize() },  function(data) {

			if (data.success) {
               // $('.success').html(data.message);
				setTimeout(function(){ window.location = "<?php echo base_url();?>offered?job_id=<?=$job_id?>"; }, 100);
            }
			else{
				$('.success').html(data.message);
			}

		}, 'json');
  });

});
</script>
<script>
// process the form
    $('#hire_job').submit(function(event) {
      $('#hr_btnpay').prop('disabled', true);
        var response = "";
        $.ajax({
            type        : 'POST',
            url         : '<?php echo base_url() ?>Jobs/confirm_hired',
            data        : $('form#hire_job').serialize(),
            //dataType    : 'json',
            //encode      : true,
        })
            .done(function(res) {
                if(res == "done"){
                  window.location.replace("/pay/clientpay");
                }else {
                 
                  
                   //$('#hr_msg').text(res);                  
                  var result=$.parseJSON(res);
                  if(result.success==true)
                  {
                       $('.success').html(result.message);
                       setTimeout(function(){ window.location = "<?php echo base_url();?>offered?job_id=<?=$job_id?>"; }, 1000);
                  }
                  else 
                  {
                   $('.success').html("Failed payment for Insufficient funds");
                  }
		$('#hr_btnpay').prop('disabled', false);
                }
               // console.log(res);
            });
        event.preventDefault();
    });
</script>
