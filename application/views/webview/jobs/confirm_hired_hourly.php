<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css">
<style>
.active { background-color: #ffffff!important; color: #343434;}
span.limit_total { font-size: 13px;}
</style>
<section id="big_header" style="margin-top: 40px; margin-bottom: 40px; height: auto;">

	<div class="container">
		
		<div style="border:1px solid #ccc;margin-right: 15px;" class="row white-box-feed confirm_hire">
			<div class="col-md-9">
				<form style="margin-bottom: 0;" action="<?php echo base_url() ?>Jobs/confirm_hired" method="POST">
					<div class='success' style="color: red; "></div>
					<div class="row">
						<div class="col-md-12">
							<h4 style="font-family: calibri;font-size: 22px;"><b>Confirm Hire</b></h4>
						</div>
	
					</div>
	
					<div class="row">
						<div class="col-md-12"><h4 class="confirm_hire_title">Job Title :</h4></div>
						<div class="col-md-12">
							<div class="hire_job_title">
							    <h4 class="main_title custom_confirm_hire_j_title"><?=$job_details[0]->title?></h4>
							</div>
						</div>
					</div>
	
	
					<div class="row ">
						<div class="col-md-12">
							<h4 style="font-size:22px;font-family: calibri;margin-bottom: 15px;"><b>Contact Details</b></h4>
						</div>
					</div>
	
					<div class="row">
						<div class="col-md-12"><h4 class="confirm_hire_title">Title (Optional) :</h4></div>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-8">
									<div class="input_title">
									    <input type="text" name="title" class="form-control border-field" placeholder="Job title (optional)" />
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
						<div class="col-md-12"><h4 style="margin-top: 5px;" class="confirm_hire_title">Job Type :</h4></div>
						<div class="col-md-12">
							<?php
							 $perHrs = '';
								if ($job_details[0]->job_type == 'hourly'){
									$perHrs = '/hr';
								}
							   ?>
							<strong style="font-size:17px;font-weight: 400;font-family: calibri;">Hourly</strong>
						</div>
	
					</div>
	
					<div class="row margin-top-1">
						<div class="col-md-12"><h4 class="confirm_hire_title">Hourly Rate :</h4></div>
						<div class="col-md-12">
							<?php
							if($bid_details[0]->offer_bid_amount !=''){
								$bid_amount = $bid_details[0]->offer_bid_amount;
							}else{
								$bid_amount = $bid_details[0]->bid_amount;
							}?>
							<strong id="bid_amount_perhour" style="font-size:17px;font-weight: 400;font-family: calibri;">$<?=$bid_amount?>/hr</strong>
							
							<?php
							//$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
							//print_r($bid_details);
							//print_r($job_details);
							//print_r($user_details);
							
							?>
							<!-- <a href="#" aria-hidden="true" data-toggle="modal" data-target="myModal2"><i class="fa fa-pencil-square-o blue-text"></i></a> -->					
							<a href="#" data-toggle="modal" data-target="#myModal2"><i style="margin-left: 10px;" class="fa fa-pencil-square-o blue-text"></i></a>
						</div>
	
					</div>
	
					<div class="row margin-top-1">
						<div class="col-md-12"><h4 style="margin-bottom: 25px;" class="confirm_hire_title">Weekly limit :</h4></div>
						<div class="col-md-12">
							<div class="col-md-2 nopadding">
								<input type="hidden" id="bid_amount_result" value="<?=$bid_amount?>">
								<input style="float: left;margin-right: 10px;" type="radio" checked name="limit" id="weekly_limit" value="" />
								<p style="margin-bottom: 0;margin-top: -2px;font-size: 17px;font-family: calibri;">Limit to:</p>
							</div>
							<div style="margin-top: -2px !important;" id="weekly_limit_field" class="col-md-10 nopadding" >
								<div style="margin-top: -8px !important;width: 80px;" class="col-md-2 nopadding" >
									<input type="text" id="weekly_limit_input" class="form-control" />
								</div>
								<div style="font-size: 17px;font-family: calibri;" class="col-md-10">hrs/week<span class="limit_total_check" style="display:none;"> = $<span class="limit_total">0.00</span> mas/week</span>
								</div>
								<p class="weekly_limit_error" style="color:red;display:block;"></p>
								<input type="hidden" id="weekly_limit_amount" name="weekly_limit_amount">
							</div>
					</div>
					</div>
	
	
					<div class="row margin-top-1">
						<div class="col-md-12 text-left"></div>
						<div class="col-md-12">
							<div class="col-md-2 nopadding" style="font-size:13px">
								<input style="float: left;margin-right: 10px;" type="radio"  name="limit" value="0" />
								<p style="margin-bottom: 0;font-size: 17px;margin-top: -2px;font-family: calibri;">No Limit</p>
							</div>
						</div>
					</div>
	
					<div class="row margin-top-1">
						<div class="col-md-12 text-left"></div>
						<div class="col-md-12" style="font-size:13px;margin-top: 8px;">
							<input style="float: left;margin-right: 10px;" type="checkbox" name="allow_freelancer" value="1" /> <p style="margin-bottom: 3px;margin-top: -2px;font-size: 17px;font-family: calibri;">Allow freelancer to log time manually</p>
						</div>
	
					</div>
	
	
					<div class="row margin-top-1">
						<div class="col-md-12 text-left"><h4 class="confirm_hire_title" style="margin-bottom: 6px;">Job Duration :</h4></div>
						<div class="col-md-12" style="font-size:13px">
							<strong style="font-size:17px;font-weight: 400;font-family: calibri;"><?php echo str_replace('_', '-', $job_details[0]->job_duration) ?></b></strong>
						</div>
	
					</div>
	
					<div class="row margin-top-1">
						<div class="col-md-12"><h4 class="confirm_hire_title">Start Date :</h4></div>
						<div class="col-md-12">
							<div class="srart_duration">
							    <input style="width: 195px;" value="<?php echo date('d/m/Y');?>" id="datetimepicker" name="start_date" type="text" class="form-control" required>
							       
							</div>
						</div>
						<div class="col-md-5"></div>
						<p class="date_error" style="color:red;display:none;"></p>
					</div>
	
					<div class="row margin-top-1">
						<div style="margin-top: -7px;" class="col-md-12 text-left"><h4 class="confirm_hire_title">Message to freelancer :</h4></div>
						<div class="col-md-12">
							<textarea class="form-control" name="message" rows="6" cols="30" required></textarea>
						</div>
	
					</div>
	
					<div style="margin-top: 15px;" class="row">
						<div class="col-md-12">
							<input type="hidden" name="applier_id" id="applier_id" value="<?=base64_decode($applier_id)?>">
							<input type="hidden" name="job_id" id="job_id" value="<?=base64_decode($job_id)?>">
							<input type="hidden" name="payer_email" id="payer_email" value="<?=$user_details[0]->webuser_email;?>">
							<input type="hidden" name="default_title" id="default_title" value="<?=$job_details[0]->title?>">
							<input style="float: left;margin-right: 10px;" type="checkbox" id="tearms" name="tearms" required/> <p>I understand and agree to the Winjob <a href="">user Agreement</a> and <a href="">policy</a></p>
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
			</div>
		</div>
	</div>
</section>

</div>

</section>
<!-- big_header-->

<div id="myModal2" class="modal fade" role="dialog">
			<div class="modal-dialog custom_job_apply55">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="cus_confirm_hired_hourly_pop">
						<a data-dismiss="modal" href=""><i class="fa fa-times"></i></a>
						<div class="modal-header" style="border: none;">
							<h4 class="modal-title">Offer Terms</h4>
							<button type="button" class="close" data-dismiss="modal"> </button>
						</div>
						  <div style="border: 0;" class="modal-body">
							<form method="post" id='jobApply'>
								<input type="hidden" name='bid_id' value='<?php echo $bid_details[0]->id; ?>'/>
								<input type="hidden" name='proposal' value='1'/>
								<div style="margin-top: 15px;" class="row">
									<div class="col-md-12">
										<div style="margin-bottom: 20px;" class="row">
											<div class="col-md-3 col-md-offset-3 page-label">
												<label style="font-family: calibri;font-size: 17px;">Your Offer</label>
											</div>

											<div style="margin-left: -45px;" class="col-md-4">
												<div style="font-family: calibri;font-size: 17px;" class="col-md-1">$</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name='bid_amount' id='bid_amount' value='<?php echo round($bid_amount, 2); ?>' style="float: left;width: 80px;margin-left: -9px;margin-top: -10px;margin-right: 5px;" /> <label style=" margin-left: 2px;margin-top: 1px;position: absolute;"><?php echo $perHrs ?></label>
												</div>
											</div>
										</div>

										<div style="margin-bottom: 20px;" class="row">
											<div class="col-md-3 col-md-offset-3 page-label">
												<label style="font-family: calibri;font-size: 17px;">10% Winjob Fee</label>
											</div>

											<div style="margin-left: -45px;" class="col-md-4">
												<div style="font-size: 17px;font-family: calibri;" class="col-md-1">$</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name='bid_fee' id='bid_fee' disabled style="float: left;width: 80px;margin-left: -9px;margin-top: -10px;margin-right: 5px;" /> <label style=" margin-left: 2px;margin-top: 1px;position: absolute;"><?php echo $perHrs ?></label>
												</div>
											</div>
										</div>

										<div style="margin-bottom: 20px;" class="row">
											<div class="col-md-3 col-md-offset-3 page-label">
												<label style="float: left;margin-bottom: 20px;">Freelancer Earnings</label>
											</div>

											<div style="margin-left: -45px;" class="col-md-4">
												<div class="col-md-1">$</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name='bid_earning' id='bid_earning' disabled style="float: left;width: 80px;margin-left: -9px;margin-top: -10px;margin-right: 5px;" />
													<label style=" margin-left: 2px;margin-top: 1px;position: absolute;"><?php echo $perHrs ?></label>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="modal-footer" style="text-align: center; border-top: none">
									
									<input style="float: left;margin-left: 312px" type="submit" class="btn-primary big_mass_active transparent-btn big_mass_button" id="bid_value_change" value="Done" />
									<input type="button" style="float: left;" class="btn-primary transparent-btn big_mass_button" value="Cancel" data-dismiss="modal" />
									<img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
								</div>
							</form>
						</div>

					</div>
                </div>
			</div>

		</div>
		
		
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>

<script>
    if($(this).attr('id') == 'weekly_limit') {
		$('#weekly_limit_field').removeClass('hidden');
	}else {
		// $('#weekly_limit_field').addClass('hidden');
	}
$('input[name="limit"]').on('click', function(){

	if($(this).attr('id') == 'weekly_limit') {
		$('#weekly_limit_field').removeClass('hidden');
	}else {
		$('#weekly_limit_field').addClass('hidden');
	}
});	
	
	
	
jQuery('#datetimepicker').datetimepicker({
   timepicker:false,
 format:'d/m/Y'
});

 $('#weekly_limit_input').on('keyup', function() {
	 
	 if(isNaN($('#weekly_limit_input').val()) === true) {
			$('.weekly_limit_error').html('Enter Numbers Only');
			$(".weekly_limit_error").show().delay(5000).fadeOut(); 
			return false;
		}
		$('.limit_total_check').show();	
		var bid_amount = parseInt($('#bid_amount_result').val());
		var week_limit = parseInt($('#weekly_limit_input').val());
		var total = bid_amount * week_limit;
		if(total > 0){
			$('.limit_total').html(total.toFixed(2));
			$('#weekly_limit_amount').val(total.toFixed(2));
			
		} else {
			$('.limit_total').html("0.00");
		}
     $('#weekly_limit').val($('#weekly_limit_input').val());
    });

</script>		
		
		
<script>


$(document).ready(function() {
	
	
  $('#confirm_hire').on('click', function(e) {
		e.preventDefault
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

function setFee() {
    var myRate = $('#bid_amount').val();
    if (parseInt(myRate) > 0) {
		$('#bid_amount_perhour').html('$'+myRate+'/hr');
		 $('#bid_amount_result').val(parseInt(myRate));
        $('#bid_fee').val(parseInt(myRate) / 10);
        $('#bid_earning').val(parseInt(myRate) - (parseInt(myRate) / 10));
    } else {
        $('#bid_fee').val('');
        $('#bid_earning').val('');
    }
}
function successResp(rs)
{
    var data = JSON.parse(rs);
    if (data.code == '0')
    {

        $('input:submit').removeAttr('disabled');
    }
    else
    {
        if(data.amt=='1')
        {
            $('#bid_amount_read').text($('#bid_amount').val());
            $('#bid_earning_read').text($('#bid_earning').val());
        }
        $(data.modal).find('.close').click();
    }
    $('.form-loader').hide();
    $('.form-msg').html(data.msg);
    $('.form-msg').show();
    $('.form-msg').fadeOut(10000);
}
$(document).ready(function () {
    setFee();
    $('#bid_amount').keyup(function () {
        setFee();
    });
    $('#jobApply').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        resetForm: 'true',
        fields: {
            bid_amount: {
                validators: {
                    notEmpty: {
                        message: '&nbsp;'
                    }
                }
            }
        }
    }).on('success.field.fv', function (e, data) {
        e.preventDefault();
        data.fv.disableSubmitButtons(false);

    }).on('err.field.fv', function (e, data) {
        data.fv.disableSubmitButtons(false);
    });
    var options = {
        beforeSubmit: function () {
            if (!$('#jobApply').data('formValidation').isValid())
            {
                return false;
            }
            else
            {
                $('.form-loader').show();
                $('input:submit').removeAttr('disabled');
            }
        },
        success: function (rs) {
            successResp(rs);
        }
    };
    var options1 = {
        beforeSubmit: function () {
            $('.form-loader').show();
        },
        success: function (rs) {
            successResp(rs);
        }
    };
// bind form using 'ajaxForm'
    $('#jobApply').ajaxForm(options);
    $('#jobWithDraw').ajaxForm(options1);


});
</script>