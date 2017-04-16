<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css" />

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.rateyo.css"/>

<section id="big_header"
	style="margin-top: 50px; margin-bottom: 50px; height: auto;">

	<div class="container"> 
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

            $appliedLink = site_url('jobs/applications/' . base64_encode($jobId));
            $interviewsLink = site_url('jobs/interviews/' . base64_encode($jobId));
            $offerLink = site_url('offered?job_id=' . base64_encode($jobId));
            $hireLink = site_url('hires?job_id=' . base64_encode($jobId));
            $rejectLink = site_url('reject?job_id=' . base64_encode($jobId));

// total number of job
            $this->db->where(array('job_id' => $jobId, 'bid_reject' => 0, 'status!=1' => null,'job_progres_status'=>0,'withdrawn'=>NULL));
            $this->db->from('job_bids');
            $totalApplication = $this->db->count_all_results();
            ?>
                    <div class="col-md-10 nopadding">
                <ul class="client-job-activity-current">
                    <li><a href='<?php echo $appliedLink; ?>'>Application (<?php echo $totalApplication ?>)</a> </li>
                    <li><a href='<?php echo $interviewsLink; ?>'>Interview (<?= $interview ?>)</a> </li>
                    <li><a href='<?php echo $offerLink; ?>'>Offers (<?= $totalOffer; ?>) </a>  </li>
                    <li><a class="active-link" href='<?php echo $hireLink; ?>'>Hires (<?= $hire; ?>)</a> </li>
                    <li><a href='<?php echo $rejectLink; ?>'>Rejected (<?= $totalrejact; ?>)</a></li>
                    <li><a class="last-element"><button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button></a></li>
                </ul>
            </div>
			<div class="col-md-12">
				<?php 
				if(!empty($acccept_jobList)) {
				foreach($acccept_jobList as $data) { 
				
				if($data->job_type == "hourly"){
				?>

				<div class="row margin-top-5">
					<div class="col-md-12 bordered" style="padding: 20px">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-5">
										<img src="<?php echo base_url()?><?=$data->webuser_picture?>" width="90" height="68" />
									</div>
									<div class="col-md-7 nopadding" style="padding-left: 25px !important">
										<?=$data->webuser_fname?> <?=$data->webuser_lname?> <br /> <img
											src="<?php echo base_url()?>assets/pin_marker.png" width="15" />
										<?=$data->country_name?>
									</div>
								</div>

							</div>

							<div class="col-md-4">
								<?php echo $data->weekly_limit;?> hrs this week <br /> @ <?php if($data->offer_bid_amount) {echo $data->offer_bid_amount;} else {echo $data->bid_amount;} ?>/hr = $300

								<hr>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="col-md-8 text-left">
										<input type="button" class="btn btn-primary transparent-btn"
											value="Message" />
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
										<input type="button" class="btn btn-primary form-btn"
											value="View Work Diary" />
									</div>

								</div>

							</div>
						</div>

						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-8 margin-left-10">
								<a href="<?php echo base_url() ?>jobs/hourly_client_view?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->fuser_id);?>"> <b><?=$data->hire_title?></b></a>
							</div>
						</div>
					</div>


				</div>
				
				<?php } else { ?>
				
				<div class="row margin-top-5">
					<div class="col-md-12 bordered" style="padding: 20px">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-5">
										<img src="<?php echo base_url()?><?=$data->webuser_picture?>" width="90" height="68" />
									</div>
									<div class="col-md-7 nopadding" style="padding-left: 25px !important">
										<?=$data->webuser_fname?> <?=$data->webuser_lname?> <br /> <img
											src="<?php echo base_url()?>assets/pin_marker.png" width="15" />
										<?=$data->country_name?>
									</div>
								</div>

							</div>

							<div class="col-md-4">
								Paid $<?=$data->fixedpay_amount?> of budget $<?=$data->bid_amount?> <br />
								<br />

								<hr>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="col-md-8 text-left">
										<input type="button" class="btn btn-primary transparent-btn"
											value="Message" />
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
										<input type="button" class="btn btn-primary form-btn"
											value="Payment" />
									</div>

									<div class="col-md-12 text-center"></div>

								</div>

							</div>
						</div>

						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-8 margin-left-10">
								<a href="<?php echo base_url() ?>jobs/fixed_client_view?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->fuser_id);?>"> <b><?=$data->hire_title?></b></a>
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