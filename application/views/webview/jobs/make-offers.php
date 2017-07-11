<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css">
<link rel="stylesheet" href="/assets/css/pages/make-offers.css">
	
	<section id="big_header">
		<div style="border:1px solid #ccc;margin-right: 15px;" class="row white-box-feed confirm_hire">
			<div class="col-md-9">
				<div class='success' style="color: red; "></div>
				
				<div class="row part-profile">
                    <div class="col-md-12">
                        <div class="row">
                            <div class = "pull-left st_img">
                                <?php
                                    $pic = $this->Adminforms->getdatax("picture", "webuser", $user_id);
                                    if ($pic == "") {
                                        ?>
                                        <img src="<?php echo site_url("assets/user.png"); ?>" width="64" height="64">
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo site_url($pic); ?>" width="64" height="64">
                                        <?php
                                    }
                                    ?>
                            </div>
                            <div class="col-md-10 col-sm-9">
                                <?php
									$this->db->select('*');
									$this->db->from('webuser');  
									$this->db->where('webuser.webuser_id',$user_id);
									$query = $this->db->get();
									$webuserResult = $query->row();
									//var_dump($webuserResult);die();
								?>
                                <label class="blue-text"><?php echo $webuserResult->webuser_fname.' '.$webuserResult->webuser_lname; ?></label> <br />
                                <label class="gray_text"><?php
                                    $profile=array();
                                    $this->db->where('webuser_id', $user_id);
                                    $q = $this->db->get('webuser_basic_profile');
                                    if ($q->num_rows() > 0) {
                                        $profile = $q->row();
                                        echo ucfirst($profile->tagline);
                                    }
                                    ?>
								</label>
                            </div>
                        </div>
                    </div>
                </div>

				<div class="row margin-top">
                    <div class="col-md-12 text-left"> <strong>Choose a job : </strong></div>
					
					<div class="col-md-12">
						<div class = "row">
							<div class = "col-md-4">
								<div class="radio">
									<label><input type="radio" name="optradio-jobselect" checked value = '1'>Choose an Existing Job</label>
								</div>
							</div>
							<div class = "col-md-8">
								<?php
									$sender_id = $this->session->userdata('id'); 
									$this->db->select('*');
									$this->db->from('jobs');  
									$this->db->where('jobs.status', '1');
									$this->db->where('jobs.user_id', $sender_id);
									$this->db->order_by("jobs.created", "desc");
									$query = $this->db->get();
									$result = $query->result();
								?>
								
										<select id = "job_id" class="form-control" name="job_id" style = "marging:0px;">
											<?php
											   foreach ($result as $job){
											?>
											<option value="<?php echo $job->id; ?>"><?php echo $job->title; ?></option> 
											<?php
											   }
											?>
										</select>
									
							</div>
							
						</div>
						<div class = "row">
							<div class = "col-md-12">
								<div class="radio">
								  <label><input type="radio" name="optradio-jobselect" value = '2'>Create a new Job</label>
								</div>
							</div>
						</div>
					</div>
                </div>
				
				<div class="row hidden margin-top-1 margin-left-3" id="job_form">
                     <?php $this->load->view('webview/jobs/job_form', ['class' => 'text-left', 'mode' => 'invitation']); ?>
                </div> 	
					
				<div class="row ">
					<div class="col-md-12"><h4 class="confirm_hire_title">Job Title :</h4></div>
					<div class="col-md-12">
						<div class="hire_job_title">
							<h4 class="main_title custom_confirm_hire_j_title">Hello world</h4>
						</div>
					</div>
					
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
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12"><h4 style="margin-top: 5px;" class="confirm_hire_title">Job Type :</h4></div>
					<div class="col-md-12">
						<strong style="font-size:17px;font-weight: 400;font-family: calibri;">Hourly</strong>
					</div>
				</div>
				
				<div class="row margin-top-1">
					<div class="col-md-12"><h4 class="confirm_hire_title">Hourly Rate :</h4></div>
					<div class="col-md-12">
						<strong id="bid_amount_perhour" style="font-size:17px;font-weight: 400;font-family: calibri;">$15/hr</strong>
						
						
						<!-- <a href="#" aria-hidden="true" data-toggle="modal" data-target="myModal2"><i class="fa fa-pencil-square-o blue-text"></i></a> -->					
						<a href="#" data-toggle="modal" data-target="#myModal2"><i style="margin-left: 10px;" class="fa fa-pencil-square-o blue-text"></i></a>
					</div>
				</div>
				
				
				<div class="row margin-top-1">
					<div class="col-md-12"><h4 style="margin-bottom: 25px;" class="confirm_hire_title">Weekly limit :</h4></div>
						<div class="col-md-12">
							<div class="col-md-2 nopadding">
								<input type="hidden" id="bid_amount_result" value="15">
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
						<strong style="font-size:17px;font-weight: 400;font-family: calibri;">Not Sure</strong>
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
						<input style="float: left;margin-right: 10px;" type="checkbox" id="tearms" name="tearms" required/> <p>I understand and agree to the Winjob <a href="">user Agreement</a> and <a href="">policy</a></p>
						<p class="tarms_conditions" style="color:red;display:none;"></p>
					</div>

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
								<input type="hidden" name='bid_id' value='1234'/>
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
													<input type="text" class="form-control" name='bid_amount' id='bid_amount' value='12' style="float: left;width: 80px;margin-left: -9px;margin-top: -10px;margin-right: 5px;" /> <label style=" margin-left: 2px;margin-top: 1px;position: absolute;">/hr</label>
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
													<input type="text" class="form-control" name='bid_fee' id='bid_fee' disabled style="float: left;width: 80px;margin-left: -9px;margin-top: -10px;margin-right: 5px;" /> <label style=" margin-left: 2px;margin-top: 1px;position: absolute;">/hr</label>
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
													<label style=" margin-left: 2px;margin-top: 1px;position: absolute;">/hr</label>
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
	jQuery('#datetimepicker').datetimepicker({
	   timepicker:false,
	 format:'d/m/Y'
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

	$(document).ready(function () {
		setFee();
		$('#bid_amount').keyup(function () {
			setFee();
		});
		
		$("input[name = 'optradio-jobselect']").click(function(){
			if($("input[name='optradio-jobselect']:checked").val() == '1'){ //existing job
				
				$('#job_form').addClass('hidden');
				$('#job_id').removeClass('hidden');
			}
			else{ // new job
				 $('#job_form').removeClass('hidden');
				$('#job_id').addClass('hidden');
			}
		});
	});
	
</script>