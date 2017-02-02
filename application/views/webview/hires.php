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
	margin-left: 20px;
}
.hire_page_sms_btn {
	margin-left: 50px;
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
<section id="big_header"
	style="margin-top: 40px; margin-bottom: 65px; height: auto;">

	<div class="container"> 
	<div class="row">
               
     <div style="margin-top: -6px;margin-bottom: -30px;" class="main_job_titie">
         <b><?php echo ucfirst($job_details[0]->job_type)." - ".ucfirst($job_details[0]->title); ?><br/><br/></b>
     </div>
               </div>
                <div class="row"> 
<?php
            $jobId = $jobId;
            if ($interview_count) {
                $interview = $interview_count;
            } else {
                $interview = 0;
            }
            if ($hire_count) {
                $hire = $hire_count;
            } else {
                $hire = 0;
            }
            if ($Offer_count) {
                $totalOffer = $Offer_count;
            } else {
                $totalOffer = 0;
            }
            if ($reject_count) {
                $totalrejact = $reject_count;
            } else {
                $totalrejact = 0;
            }

            $appliedLink = site_url('jobs/applied/' . base64_encode($jobId));
            $interviewsLink = site_url('jobs/interviews/' . base64_encode($jobId));
            $offerLink = site_url('offer?job_id=' . base64_encode($jobId));
            $hireLink = site_url('hires?job_id=' . base64_encode($jobId));
            $rejectLink = site_url('reject?job_id=' . base64_encode($jobId));

// total number of job
            $this->db->where(array('job_id' => $jobId, 'bid_reject' => 0, 'status!=1' => null,'job_progres_status'=>0,'withdrawn'=>NULL));
            $this->db->from('job_bids');
            $totalApplication = $this->db->count_all_results();
            ?>
                    <div class="col-md-12 nopadding">
                <ul class="client-job-activity-current">
                    <li><a href='<?php echo $appliedLink; ?>'>Application (<?php echo $totalApplication ?>)</a> </li>
                    <li><a href='<?php echo $interviewsLink; ?>'>Interview (<?= $interview ?>)</a> </li>
                    <li><a href='<?php echo $offerLink; ?>'>Offers (<?= $totalOffer; ?>) </a>  </li>
                    <li><a class="active-link" href='<?php echo $hireLink; ?>'>Hires (<?= $hire; ?>)</a> </li>
                    <li><a href='<?php echo $rejectLink; ?>'>Rejected (<?= $totalrejact; ?>)</a></li>
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
				if(!empty($acccept_jobList)) {
				foreach($acccept_jobList as $data) { 
				
				if($data->job_type == "hourly"){
				?>

				<div class="row">
					<div class="col-md-12 candidate-list" style="padding: 20px">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-5" style="padding-left: 25px !important">
									<div class="st_img">
									  <img src="<?php echo base_url()?><?=$data->webuser_picture?>" width="90" height="68" />  
									</div>
									</div>
									<div class="col-md-7 nopadding" style="padding-left: 10px !important">
									<div class="aplicant_name">
									    	<?=$data->webuser_fname?> <?=$data->webuser_lname?>
									</div> <br />
                                        <div class="aplicant_country">
                                            <i style="font-size: 15px;" class="fa fa-map-marker"></i> 
											
											<?=$data->country_name?>
                                        </div> 
									</div>
								</div>

							</div>

							<div class="col-md-4 text-center">
								<div class="custom_hire_job-title">
								 <b><?php echo $data->weekly_limit;?></b> hrs this week <br /> @ <b> <?php if($data->offer_bid_amount) {echo $data->offer_bid_amount;} else {echo $data->bid_amount;} ?></b>/hr = <b>$300</b>
								 <p style="margin:0 !important;">The conduct has been hold</p>
								</div>

								<hr>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="col-md-4 col-md-offset-2">
										<div class="hire_page_sms_btn">
										    <input type="button" class="btn btn-primary form-btn"
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
							    <a href="<?php echo base_url() ?>jobs/hourly_client_view?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->fuser_id);?>"> Job Details </a> - <b> <?=$data->hire_title?></b>
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
										    <img src="<?php echo base_url()?><?=$data->webuser_picture?>" width="90" height="68" />
										</div>
									</div>
									<div class="col-md-7 nopadding" style="padding-left: 10px !important">
										<div class="aplicant_name">
										    <?=$data->webuser_fname?> <?=$data->webuser_lname?> 
										</div><br />
										 <div class="aplicant_country">
										    <i style="font-size: 15px;" class="fa fa-map-marker"></i>
											
											<?=$data->country_name?>
										 </div>
									</div>
								</div>

							</div>

							<div class="col-md-4 text-center">
								<div class="custom_hire_job-title">
								    Paid <b> $<?=$data->fixedpay_amount?></b> of budget <b>$<?=$data->bid_amount?></b>
									<p style="margin:0 !important;">The conduct has been hold</p>

								<hr>
								</div>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="col-md-4 col-md-offset-2">
									<div class="hire_page_sms_btn">
									    <input type="button" class="btn btn-primary form-btn"
											value="Message" />
									</div>
									</div>
									<div class="col-md-4">
										<div class="hire_pay_btn hire_work_btn">
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
							    <a href="<?php echo base_url() ?>jobs/fixed_client_view?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->fuser_id);?>">Job Details </a> - <b> <?=$data->hire_title?></b>
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

</div>

</section>
<!-- big_header-->











<?php /*

<section id="big_header" style="margin-top: 50px; margin-bottom: 50px; height: auto;">
    <div class="container">
        <div class="row">
			<?php 
				if(!empty($acccept_jobList)) {
				foreach($acccept_jobList as $data) {
					
					if($data->job_type == "hourly"){
						
					 	
			?>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" style="margin-top: 20px;">
				<div class="col-md-4 col-sm-4 col-xs-4"> <span><b>Offer Win to:</b></span>
				<a href="<?php echo base_url()."interview?user_id=".base64_encode($data->webuser_id)."&job_id=".base64_encode($data->job_id)."&bid_id=".base64_encode($data->bid_id);?>">
				<span class="employer-name"> <?=$data->webuser_fname?> <?=$data->webuser_lname?></span>
				</a>
				</div>
                <div class="col-md-4 col-sm-4 col-xs-4 align-center"> Status : Active </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <button class="btn message-btn pull-right">Message</button>
                </div>
            </div>
            <div class="col-md-3 col-xs-3"></div>
            <div class="col-md-9 col-sm-9 col-xs-9" style="padding: 0 25px;margin-bottom:60px;">
                <div class="col-md-12 col-sm-12 col-xs-12 job-details-box">
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <h4 style="color: #1ca7db"><a href="<?php echo base_url() ?>jobs/hourly_client_view?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->fuser_id);?>"> <b><?=$data->hire_title?></b></a> </h4>
                        <p>
                            <br/>
                            <br/> 0.00 of <?php echo $data->weekly_limit;?> hrs this week
                            <br/> @ <?php if($data->offer_bid_amount) {echo $data->offer_bid_amount;} else {echo $data->bid_amount;} ?>/hr=$300 </p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3"><a href="<?php echo base_url() ?>jobs/hourly_client_view?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->fuser_id);?>"> <span class="font1">Job Details</span></a>
                        <br/>
                        <button class="btn workdiary-btn">View Work Diary</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-3"></div>
			<?php } else { ?>
			
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" style="margin-top: 20px;">
                <div class="col-md-4 col-sm-4 col-xs-4"> <span><b>Hired By:</b></span>
				<a href="<?php echo base_url()."interview?user_id=".base64_encode($data->webuser_id)."&job_id=".base64_encode($data->job_id)."&bid_id=".base64_encode($data->bid_id);?>">
				<span class="employer-name"> <?=$data->webuser_fname?> <?=$data->webuser_lname?></span>
				</a>
				</div>
                <div class="col-md-4 col-sm-4 col-xs-4 align-center"> Status : Active </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <button class="btn message-btn pull-right">Message</button>
                </div>
            </div>
            <div class="col-md-3 col-xs-3"></div>
            <div class="col-md-9 col-sm-9 col-xs-9" style="padding: 0 25px;margin-bottom:60px;">
                <div class="col-md-12 col-sm-12 col-xs-12 job-details-box">
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <h4 style="color: #1ca7db"><a href="<?php echo base_url() ?>jobs/fixed_client_view?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->fuser_id);?>"> <b><?=$data->hire_title?></b></a></h4>
                        <p>
                            <br/>
                            <br/> Paid $<?=$data->fixedpay_amount?> of budget $<?=$data->bid_amount?> </p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3"> <a href="<?php echo base_url() ?>jobs/fixed_client_view?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->fuser_id);?>"><span class="font1">Job Details</span></a>
                        <br/>
                        <button class="btn workdiary-btn">Request Payment</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-3"></div>
			
			<?php } } } ?>
			
			
        </div>
    </div>
</section>
</div>
</section> */ ?>

