<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css" />

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.rateyo.css"/>

<style>
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
.hire_work_btn {
	margin-left: 18px;
}
.hire_pay_btn {
	margin-left: 31px;
}
.hire_page_sms_btn {
	margin-left: 48px;
}
.hire_paid_page_sms_btn {
	margin-left: 62px;
}
.aplicant_name {
	font-size: 16px;
	font-family: "Calibri";
	color: #1CA7DB;
}
.aplicant_country {
color: #494949;
font-size: 15px;
font-family: "Calibri";
margin-top: -15px;
}
.ratting_title {
    font-family: "Calibri";   
    }
.hire_job_details a {
	font-size: 17px;
	color: #37A000;
	font-weight: 800;
	margin-top: 10px;
	margin-left: 30px;
}
body{font-family: "calibri" !important;}
</style>
<section id="big_header" style="margin-top: 32px; margin-bottom: 60px; height: auto;">

	<div class="container"> 
	<div class="row">
               
     <div style="margin-top: -6px;margin-bottom: -5px;" class="main_job_titie">
         <b> <?= $job_type." - ".$job_title; ?><br/><br/></b> 
     </div>
               </div>
                <div class="row"> 
<?php

            ?>
                    <div class="col-md-12 nopadding">
                    <ul class="client-job-activity-current">
                    <li><a href='<?= site_url('jobs/applications/' . $jobId) ?>'>Application (<?= $applicants ?>)</a></li>
                     <li><a href='<?= site_url('jobs/interviews/' . $jobId) ?>'>Interview (<?=$interviews?>)</a> </li>
                     <li><a href='<?= site_url('offered?job_id=' . $jobId) ?>'>Offers (<?=$offers;?>) </a>  </li>
                     <li><a class="active-link" href='<?= site_url('hired?job_id=' . $jobId) ?>'>Hires (<?=$hires;?>)</a> </li>
                     <li><a href='<?= site_url('declined?job_id=' . $jobId) ?>'>Rejected (<?=$rejects;?>)</a></li>
                  <li class="drop_btn">
				  <div class="dropdown hour_btnx custom-application_drop_down">
					<button  style="margin-left: -14px;" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
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
            <div style="padding:35px;"></div>
			<div class="col-md-12">
				<?php 
				if(!empty($records)) {
				foreach($records as $value) { 
				
				if($job_type == "hourly"){
				?>

				<div class="row">
					<div class="col-md-12 candidate-list" style="padding: 20px">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-5" style="padding-left: 25px !important">
									<div class="st_img">
									  <img src="<?= site_url($value['pic']); ?>" width="90" height="68" />  
									</div>
									</div>
									<div class="col-md-7 nopadding" style="padding-left: 10px !important">
									<div class="aplicant_name">
									    	<?php echo ucfirst($value['fname']) . " " . ucfirst($value['lname']) ?>
									</div> <br />
                                        <div class="aplicant_country">
                                            <i style="font-size: 15px;" class="fa fa-map-marker"></i> 
											
											<?=$value['country']?>
                                        </div> 
									</div>
								</div>

							</div>

							<div class="col-md-4 text-center">
								<div class="custom_hire_job-title">
								 <b><?php echo $value['weekly_limit'];?></b> hrs this week <br /> @ <b> 
                                                                     <?php if($value['offer_bid_amount']) {echo $value['offer_bid_amount'];} else {echo $value['bid_amount']; } ?></b>/hr = <b>$300</b>
								 <p style="margin:0 !important;">The conduct has been hold</p>
								</div>

								<hr>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="col-md-4 col-md-offset-2">
										<div class="hire_page_sms_btn">
										    <input type="button" class="btn btn-primary form-btn" onclick="loadmessage(<?=$value['bid_id'] ?>,<?= $value['user_id'] ?>,<?=$value['job_id']?>)"
											value="Message" />
										</div>
									</div>
									<div class="col-md-4">
										<div class="hire_work_btn">
										    <input type="button" class="btn btn-primary form-btn"
											value="Work Diary" />
										</div>
									</div>

									<div class="col-md-2">
										<div class="dropdown">
											<button class="btn btn-default dropdown-toggle" type="button"
												data-toggle="dropdown">
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu">
												<li><a href="#">Message</a></li>
												<li><a href="#">Give bonus</a></li>
												<li><a href="#">View Profile</a></li>
												<li><a href="#">View contact</a></li>
												<li><a href="#">End contact</a></li>

											</ul>
										</div>
									</div>
								</div>
									

							</div>

							<div class="row margin-top-2"> </div>

						</div>
					
						<div class="row">
							<div class="col-md-4"></div>
							<div style="margin-top: -10px;" class="col-md-8 margin-left-10">
							 <div class="hire_job_details">
							    <a href="<?php echo base_url() ?>jobs/hourly_client_view?fmJob=<?php echo base64_encode($value['job_id']);?>&fuser=<?php echo base64_encode($value['fuser_id']);?>"> Job Details </a> - <b> <?=$value['hire_title']?></b>
							 </div>
				           </div>
						</div>

					</div>
				</div>

						
				</div>


			</div>
				
				<?php } else { ?>
				
				<div class="row ">
					<div class="col-md-12 candidate-list" style="padding: 20px">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-5" style="padding-left: 25px !important">
										<div class="st_img">
										    <img src="<?= site_url($value['pic']); ?>" width="90" height="68" />
										</div>
									</div>
									<div class="col-md-7 nopadding" style="padding-left: 10px !important">
										<div class="aplicant_name">
										    <?php echo ucfirst($value['fname']) . " " . ucfirst($value['lname']) ?>
										</div><br />
										 <div class="aplicant_country">
										    <i style="font-size: 15px;" class="fa fa-map-marker"></i>
											
											<?= $value['country'] ?>
										 </div>
									</div>
								</div>

							</div>

							<div class="col-md-4 text-center">
								<div class="custom_hire_job-title">
								    Paid <b> $<?=$value['fixedpay_amount']?></b> of budget <b>$<?=$value['bid_amount']?></b>
									<p style="margin:0 !important;">The conduct has been hold</p>

								<hr>
								</div>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="col-md-4 col-md-offset-2">
									<div class="hire_paid_page_sms_btn">
									    <input type="button" class="btn btn-primary form-btn"
											value="Message" />
									</div>
									</div>
									<div class="col-md-4">
										<div class="hire_pay_btn">
										    <input type="button" class="btn btn-primary form-btn my-btn"
											value="Payment" />
										</div>
									</div>

									<div class="col-md-2">
										<div class="dropdown">
											<button class="btn btn-default dropdown-toggle" type="button"
												data-toggle="dropdown">
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu">
												<li><a href="#">Message</a></li>
												<li><a href="#">Give bonus</a></li>
												<li><a href="#">View Profile</a></li>
												<li><a href="#">View contact</a></li>
												<li><a href="#">End contact</a></li>

											</ul>
										</div>
									</div>
								</div>

								<div class="row margin-top-2">
									<div class="col-md-8 text-left">
										
									</div>

									<div class="col-md-12 text-center"></div>

								</div>

							</div>
						</div>

						<div class="row">
							<div class="col-md-4"></div>
							<div style="margin-top: -2px;" class="col-md-8 margin-left-10">
							<div class="hire_job_details">
							    <a href="<?php echo base_url() ?>jobs/fixed_client_view?fmJob=<?php echo base64_encode($value['job_id']);?>&fuser=<?php echo base64_encode($value['fuser_id']);?>">Job Details </a> - <b> <?=$value['hire_title']?></b>
							</div>
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