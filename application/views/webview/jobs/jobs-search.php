<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css">
<section id="big_header">
<?php if ($offers != 0) { ?>
            <div class="row margin-top-1">
                <div class="bordered-alert text-center ack-box">
                    <h4 class="h4">! You have  <a href="<?php echo site_url("my-offers"); ?>" class="show_notification"><?= $offers ?> pending offer- Accept to start working</a></h4>
                </div>
            </div>
<?php }

        if ($this->session->userdata('type') == '1') { ?>
			<?php if(!empty($clientend)) { ?>
			<div class="row margin-top-1">
				<div class="bordered-alert text-center ack-box ended">
					<h4 class="h4">! You have  <a href="<?php echo base_url() ?>jobs/client_endjobnotification" class="show_notification" > <?=count($clientend)?> ended contract - waiting for feedback</a>
					</h4>
				</div>
			</div>
			<?php } ?>
			<?php if($status == 0){ ?>
				<div class="row ">
					<div class="bordered-alert text-center ack-box finance" >
						<h4 class="h4red">! Your financial Account has been Suspended.</h4>
					</div>
				</div>
			<?php } ?>
		<?php  } else if ($this->session->userdata('type') == '2'){  ?>
			<?php  if(!empty($freelancerend)) { ?>
			<div class="row margin-top-1">
				<div class="bordered-alert text-center ack-box feedback_">
					<h4 style="margin-top: -5px;">! You have  <a href="<?php echo base_url() ?>jobs/freelancer_endjobnotification" class="show_notification"> <?=count($freelancerend)?> ended contract - waiting for feedback</a>
					</h4>
				</div>
			</div>
			<?php } ?>
			<?php if($status == 0){ ?>
				<div class="row ">
					<div class="bordered-alert text-center ack-box suspended">
						<h4 class="h4red">! Your financial Account has been Suspended.</h4>
					</div>
				</div>
			<?php } ?>
		<?php } ?>


        <div class="search-form">
            <div class="row">
                <form action="<?= site_url() ?>jobs-search" method="GET" id="job-search-form">
                    <div class="col-md-10 col-lg-10 col-sm-12 col-xs-12 no-pad search-cont">
                            <input type="text" placeholder="Find job" name="q" id="jobsearch" value="<?= isset($_GET['q']) ? $_GET['q'] : ''  ?>" class="form-control search-field"/>
                            <i aria-hidden="true" class="fa fa-search search-btn-home custom_btn"></i>
                    </div>
                    <div class="col-md-2 col-lg-2 col-sm-2 col-xs-12 no-pad">
                    </div>
                </form>
            </div>
        </div>

                <div class="row">
                    <div class="col-md-2 no-pad-xs mar-bot-20" >
                        <div class="row">
                            <div  class="col-md-12 borderedx white-box divtop">
                                <div class="row">
                                    <div  class="col-md-12 catcont"><span class="text-center catspan" >CATEGORIES</span></div>
                                    <?php
                                    if (isset($subCateList) && sizeof($subCateList) > 0 && $subCateList != "") {
                                        foreach ($subCateList as $sub) {
                                            ?>
                                            <div  class="col-md-12 blue-text catscont">
                                                <label> <a href="<?php echo site_url('jobs-search/' . $sub['subcat_id']) ?>"> <?php echo $sub['subcategory_name'] ?> </a> </label>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="col-md-12 blue-text addcat" >
                                            <label> <a href="<?php echo site_url("categories/choose") ?>"> <b><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Category </b></a> </label>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="col-md-12 blue-text">
                                            <label> <a href="<?php echo site_url("categories/choose") ?>"> No Category Selected </a> </label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>

                       <div class="row">
                            <div  class="col-md-12 borderedx white-box margin-top-space catbot">
                                <div class="row">
                                    <div class="nav-side-menu">
                                         <div class="menu-list">
                                            <ul id="menu-content" class="menu-content out cus_left_m_list">
                                                <li data-toggle="collapse" data-target="#tob-type" class="collapsed catli">
                                                 Job Type <span class="arrow"></span>
                                                </li>
                                                <ul class="sub-menu collapse ulcat" id="tob-type">
                                                    <li class="posrel"><input type="checkbox" name="jobType[]" class="jtype-check" value="hourly"/> &nbsp;<span class="spanbot">Hourly price</span></li>
                                                    <li class="posrel"><input type="checkbox" name="jobType[]" class="jtype-check" value="fixed"/> &nbsp;<span class="spanbot">Fixed price</span></li>
                                               </ul>

                                                <li data-toggle="collapse" data-target="#tob-duration" class="collapsed catli">
                                                 Job Duration <span class="arrow"></span>
                                                </li>
                                                <ul class="sub-menu collapse ulcat" id="tob-duration">
                                                    <li class="posrel"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="More_than_6_months"/> &nbsp;<span class="spanbot">More than 6 months</li>
                                                    <li class="posrel"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="3_6_months"/> &nbsp;<span class="spanbot">3 - 6 months</span></li>
                                                    <li class="posrel"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="1_3_months"/> &nbsp;<span class="spanbot">1 - 3 months</span></li>
                                                    <li class="posrel"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="less_than_1_months"/> &nbsp;<span class="spanbot">Less than 1 month</span></li>
                                                    <li class="posrel"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="less_than_1_week"/> &nbsp;<span class="spanbot">Less than 1 week</span></li>
                                               </ul>
                                                <li data-toggle="collapse" data-target="#tob-hours" class="collapsed catli">
                                                 Hours Per Week <span class="arrow"></span>
                                                </li>
                                                <ul class="sub-menu collapse lastul" id="tob-hours">
                                                    <li class="posrel"><input type="checkbox" name="jobHours[]" class="jhours-check" value="1-9"/> &nbsp;<span class="spanbot">1 - 9 hours</span></li>
                                                    <li class="posrel"><input type="checkbox" name="jobHours[]" class="jhours-check" value="10-19"/> &nbsp;<span class="spanbot">10 - 19 hours</span></li>
                                                    <li class="posrel"><input type="checkbox" name="jobHours[]" class="jhours-check" value="20-29"/> &nbsp;<span class="spanbot">20 - 29 hours</span></li>
                                                    <li class="posrel"><input type="checkbox" name="jobHours[]" class="jhours-check" value="30-39"/> &nbsp;<span class="spanbot">30 - 39 hours</span></li>
                                                    <li class="posrel"><input type="checkbox" name="jobHours[]" class="jhours-check" value="40_plus"/> &nbsp;<span class="spanbot">More than 40  hours</span></li>
                                               </ul>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                       </div>
                    <div class="col-md-8 no-pad no-pad-xs margin-top-xs mar-bot-20">
                        <style></style>

                        <section id="big_header" style="height: auto;">
                            <div class="job-data white-box-feed">
                                <div  class="job-searching col-md-3 col-sm-3 no-padding job-feed-title">My Job Feed</div>
                                <div class="clearfix"></div>
                                <div class="line custon_line"></div>
                                <br/>
                                <div class="white-box" id="all-jobs">
                                    <?php include 'content.php'; ?>
                                </div>

                            </div>
                            <div class='load-more'>Load more <img src='<?php echo site_url() ?>assets/img/version1/loader.gif' class="form-loader" style="display:none"></div>
                        </section>

                    </div>
                    <div class="col-md-2">
                        <div class="row side">
                            <div class="col-md-12 col-sm-12 col-xs-12 white-box text-center side-content">
                                <?php
                                if (! empty($croppedImage)) {
                                    ?>
                                    <img src="<?php echo $croppedImage ?>" class="profile-pic" />
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() ?>assets/user.png" class="profile-pic" />
                                    <?php
                                }
                                ?>
                            </div>

                        </div>
                        <div  class="row white-box text-center side-content margin-top-space">
                            <div class="col-md-12">
                                <label class="blue-text side-menu-j"><?php echo $this->session->userdata("fname") . " " . $this->session->userdata("lname"); ?></label><br>
                                <a class="side-menu-j" href="<?php echo site_url('profile/'.$this->session->userdata("username")); ?>" class="view-profile">View Profile</a>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 margin-top-space proposal-boxn no-pad no-pad-xs">
                                <div  class='white-box side-menu-j-cont'>
                                        <div class="no-padding no-pad side-mar-bot">
                                            <a class="side-menu-j" href="<?php echo base_url() ?>my-interviews">Active Interview <p style="float: right;margin: 0;"><?= $int ?></p></a>
                                        </div>
                                    
                                        <div class="no-padding no-pad side-mar-bot">
                                            <a class="side-menu-j" href="<?php echo base_url() ?>my-offers">Active Offer <p style="float: right;margin: 0;"><?= $offers ?></p></a>
                                        </div>

                                        <div class="gray-text no-padding side-mar-bot">
                                            <a class="side-menu-j"  href="<?php echo base_url() ?>jobs/my-bids">Proposal Sent <p style="float: right;margin: 0;"><?= $proposals; ?></p></a>
                                        </div>

                                        <div class="gray-text no-padding">
                                            <label class="side-menu-j">Proposal Limit</label>  <p class="side-pro"><?= 30 - $proposals?></p> <label class="side-menu-j">(Monthly)</label>
                                        </div>

                                </div>

                            </div>
                        </div>
                        
                        <div class="row account-progress">
                            <div class="col-md-12 white-box margin-top-space side-cont-bot">
                                <div class='row'>
                                    <div class="col-md-12 text-center gray-text no-pad">
                                        <span class="gray-text side-cont-bot-span">Profile Completeness</span>

                                        <div class="progress side-cont-prog">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$profilecompleteness['pcompleteness'];?>%">
                                                <?=$profilecompleteness['pcompleteness'];?>%
                                            </div>
                                        </div>
                                    </div>
									<?php if($profilecompleteness['profilecompleteness']['addpicture'] !=1){ ?>
										  <div class="col-md-12 element">
											 <a href="<?php echo base_url();?>profile-settings">
												<i class="fa fa-plus-circle" aria-hidden="true"></i> Add
												Picture
											 </a>
										</div>
									<?php } ?>
									<?php if($profilecompleteness['profilecompleteness']['addcat'] !=1){ ?>
										<div class="col-md-12 element">
											<a href="<?php echo base_url();?>categories/choose">
												<i class="fa fa-plus-circle" aria-hidden="true"></i> Add
												Categories
											</a>
										</div>
									<?php } ?>
									<?php if($profilecompleteness['profilecompleteness']['addportfolio'] !=1){ ?>
										<div class="col-md-12 element">
											<a href="<?php echo base_url();?>profile/basic_bio">
												<i class="fa fa-plus-circle" aria-hidden="true"></i> Add
												Portfolios
											</a>
										</div>
									<?php } ?>
									<?php if($profilecompleteness['profilecompleteness']['addexp'] !=1){ ?>
										<div class="col-md-12 element">
											<a href="<?php echo base_url();?>profile/basic_bio">
												<i class="fa fa-plus-circle" aria-hidden="true"></i> Add
												Experience
											</a>
										</div>
									<?php } ?>
									<?php if($profilecompleteness['profilecompleteness']['addedu'] !=1){ ?>
										<div class="col-md-12 element">
											<a href="<?php echo base_url();?>profile/basic_bio">
												<i class="fa fa-plus-circle" aria-hidden="true"></i> Add
												Education
											</a>
										</div>
									<?php } ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <!--            <div class="col-md-3 job-summery-box">-->
        <!--<button type="submit" class="btn btn-primary pull-right">Next</button>-->
</section>

</div>

</section>
<!-- big_header-->

