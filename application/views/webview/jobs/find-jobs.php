

<?php
//include 'content.php';
$Conversation = new Conversation();
$notification = $Conversation->index();
$notification_details = $Conversation->details();
$job_alert_count = $Conversation->job_alert();


$freelancerend = $Conversation->freelancerend();
$clientend = $Conversation->clientend();
?>
<section id="big_header"  style="margin-bottom: 40px; height: auto;">
    <div class="container">

<?php if ($job_alert_count) { ?>
            <div class="row margin-top-1">
                <div class="bordered-alert text-center ack-box" style="max-width: 969px; height: 40px; margin-bottom: 0px;">
                    <h4 style="margin-top: -6px;">! You have  <a href="<?php echo site_url("Active_interview"); ?>" class="show_notification" style="color: #28da28 !important;"><?= $job_alert_count ?> pending offer- Accept to start working</a>

                    </h4>
                </div>
            </div>
<?php }

        if ($this->session->userdata('type') == '1') { ?>
			<?php if(!empty($clientend)) { ?>
			<div class="row margin-top-1">
				<div class="bordered-alert text-center ack-box" style="max-width: 969px; height: 40px; margin-bottom: 0px;">
					<h4 style="margin-top: -5px;">! You have  <a href="<?php echo base_url() ?>jobs/client_endjobnotification" class="show_notification" style="color: #28da28 !important;"> <?=count($clientend)?> ended contract - waiting for feedback</a>
					</h4>
				</div>
			</div>
			<?php } ?>
			<?php if($ststus->isactive==0){ ?>
				<div class="row ">
					<div class="bordered-alert text-center ack-box" style="max-width: 969px; height: 40px; margin-bottom: 0px; margin-top: 20px;">
						<h4 style="margin-top: -5px;color: red;">! Your financial Account has been Suspended.</h4>
					</div>
				</div>
			<?php } ?>
		<?php  } else if ($this->session->userdata('type') == '2'){  ?>
			<?php  if(!empty($freelancerend)) { ?>
			<div class="row margin-top-1">
				<div class="bordered-alert text-center ack-box" style="max-width: 969px; height: 40px; margin-bottom: 0px;">
					<h4 style="margin-top: -5px;">! You have  <a href="<?php echo base_url() ?>jobs/freelancer_endjobnotification" class="show_notification" style="color: #28da28 !important;"> <?=count($freelancerend)?> ended contract - waiting for feedback</a>
					</h4>
				</div>
			</div>
			<?php } ?>
			<?php if($ststus->isactive==0){ ?>
				<div class="row ">
					<div class="bordered-alert text-center ack-box" style="max-width: 969px; height: 40px; margin-bottom: 0px; margin-top: 20px;">
						<h4 style="margin-top: -5px;color: red;">! Your financial Account has been Suspended.</h4>
					</div>
				</div>
			<?php } ?>
		<?php } ?>



        <div class="row">
            <div class="col-md-10 col-md-offset-0">
                <div style="margin-top: -23px;" class="row">
                    <div class="col-md-12 no-padding margin-top-search">
                        <form action="find-jobs" method="post" id="job-search-form">
                            <input style="width: 735px;" type="text" placeholder="Find job" name="jobsearchbykeywords" id="jobsearch" value=""  class="form-control search-field" />
                            <i class="fa fa-search search-btn search-btn-home custom_btn" aria-hidden="true"></i>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2 margin-top-1 page-title">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <div class="row">
                            <div style="border: 1px solid #ccc;border-radius: 3px;" class="col-md-12 borderedx white-box">
                                <div class="row">
                                    <div style="margin-top: 5px;margin-bottom: 10px;" class="col-md-12"><span class="text-center" style="color:#686361;font-weight: bold;font-size: 17px;font-family: calibri;">CATEGORIES</span></div>
                                    <?php
                                    if (isset($subCateList) && sizeof($subCateList) > 0 && $subCateList != "") {
                                        foreach ($subCateList as $sub) {
                                            ?>
                                            <div style="margin-bottom: 8px;line-height: 20px;font-size: 16px;font-family: calibri;" class="col-md-12 blue-text">
                                                <label> <a href="<?php echo site_url('find-jobs/' . $sub['subcat_id']) ?>"> <?php echo $sub['subcategory_name'] ?> </a> </label>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="col-md-12 blue-text" style="padding-top: 10px;margin-bottom: 5px;">
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
                            <div style="border: 1px solid #ccc;border-radius: 3px;padding-bottom: 0;padding-top: 0;" class="col-md-12 borderedx white-box margin-top-space">
                                <div class="row">
                                    <div class="nav-side-menu">
                                         <div class="menu-list">
                                            <ul id="menu-content" class="menu-content out cus_left_m_list">
                                                <li style="padding-top: 5px;padding-bottom: 5px;font-family: calibri;font-size: 17px;font-weight: bold;color: #686361;"  data-toggle="collapse" data-target="#tob-type" class="collapsed">
                                                 Job Type <span class="arrow"></span>
                                                </li>
                                                <ul style="padding-top: 12px;margin-bottom: -8px;" class="sub-menu collapse" id="tob-type">
                                                    <li style="position:relative;"><input type="checkbox" name="jobType[]" class="jtype-check" value="hourly"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">Hourly price</span></li>
                                                    <li style="position:relative;"><input type="checkbox" name="jobType[]" class="jtype-check" value="fixed"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">Fixed price</span></li>
                                               </ul>

                                                <li style="padding-top: 5px;padding-bottom: 5px;font-family: calibri;font-size: 17px;font-weight: bold;color: #686361;" data-toggle="collapse" data-target="#tob-duration" class="collapsed">
                                                 Job Duration <span class="arrow"></span>
                                                </li>
                                                <ul style="padding-top: 12px;margin-bottom: -8px;" class="sub-menu collapse" id="tob-duration">
                                                    <li style="position:relative;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="More_than_6_months"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">More than 6 months</li>
                                                    <li style="position:relative;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="3_6_months"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">3 - 6 months</span></li>
                                                    <li style="position:relative;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="1_3_months"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">1 - 3 months</span></li>
                                                    <li style="position:relative;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="less_than_1_months"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">Less than 1 month</span></li>
                                                    <li style="position:relative;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="less_than_1_week"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">Less than 1 week</span></li>
                                               </ul>
                                                <li style="padding-top: 5px;padding-bottom: 5px;font-family: calibri;font-size: 17px;font-weight: bold;color: #686361;" data-toggle="collapse" data-target="#tob-hours" class="collapsed">
                                                 Hours Per Week <span class="arrow"></span>
                                                </li>
                                                <ul style="padding-top: 12px;margin-bottom: 10px;" class="sub-menu collapse" id="tob-hours">
                                                    <li style="position:relative;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="1-9"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">1 - 9 hours</span></li>
                                                    <li style="position:relative;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="10-19"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">10 - 19 hours</span></li>
                                                    <li style="position:relative;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="20-29"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">20 - 29 hours</span></li>
                                                    <li style="position:relative;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="30-39"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">30 - 39 hours</span></li>
                                                    <li style="position:relative;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="40_plus"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">More than 40  hours</span></li>
                                               </ul>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                       </div>
                    <div class="col-md-8">
                        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css">
                        <style>.page-sub-title {margin-top: 10px;}.page-jobs input {margin-top: 5px;}.load-more{background-color: #23a8d9; color: #fff; padding: 10px; text-align: center; cursor: pointer; margin-top: -32px;}.page-jobs h5{padding-right:5px}</style>
                        <section id="big_header" style="height: auto;">
                            <div style="border: 1px solid #ccc;padding-top: 10px;padding-bottom: 0;" class="job-data white-box-feed">
                                <div style="font-size: 22px;font-family: calibri;font-weight: 500;margin-left: -5px;" class="job-searching col-md-3 col-sm-3 no-padding">My Job Feed</div>
                                <div class="clearfix"></div>
                                <div style="margin-left: -5px;" class="line custon_line"></div>
                                <br/>
                                <div class="row white-box" id="all-jobs">

<?php include 'content.php'; ?>
                                </div>

                            </div>
                            <div class='load-more'>Load more <img src='<?php echo site_url() ?>assets/img/version1/loader.gif' class="form-loader" style="display:none"></div>
                        </section>

                    </div>
                    <div class="col-md-2">
                        <div style="border: 1px solid #F0F0F0;" class="row">
                            <div class="col-md-12 no-padding">
                                <?php
                                if (! empty($croppedImage->cropped_image)) {
                                    ?>
                                    <img src="<?php echo $croppedImage->cropped_image ?>" class="profile-pic" />
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() ?>assets/user.png" class="profile-pic" />
                                    <?php
                                }
                                ?>
                            </div>

                        </div>
                        <div style="border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;border-left: 1px solid #ccc;border-radius: 0px 0px 4px 4px;padding:" class="row white-box text-center">
                            <?php
                            $user_id = $this->session->userdata('id');
                            // var_dump($user_id);die();
                            $this->db->select('*');
                            $this->db->from('webuser');
                            $this->db->where('webuser.webuser_id',$user_id);
                            $query= $this->db->get();
                            $webuser = $query->row();
                            ?>
                            <div class="col-md-12">
                                <label  style="color: #3bafdb;font-size: 16px;font-family: calibri;font-weight: bold;" class="blue-text"><?php echo $this->session->userdata("fname") . " " . $this->session->userdata("lname"); ?></label><br>
                                <a style="color: #3bafdb;font-size: 16px;font-family: calibri;font-weight: bold;" href="<?php echo site_url('profile/'.$webuser->webuser_username); ?>" class="view-profile">View Profile</a>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 margin-top-space proposal-box">
                                <div style="border: 1px solid #ccc;border-radius: 3px;padding: 13px 0;padding-bottom: 20px;" class='row white-box'>
                                    <div class="row ">
                                        <div style="margin-bottom: 8px;" class="col-md-9 no-padding">
                                            <a style="color: #3bafdb;font-size: 16px;font-family: calibri;font-weight: bold;" href="<?php echo base_url() ?>Active_interview">Active Interview <p style="float: right;margin: 0;"><?= $no_of_interview ?></p></a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div style="margin-bottom: 8px;" style="font-size: 14px;" class="col-md-9 gray-text no-padding">
                                            <a style="color: #3bafdb;font-size: 16px;font-family: calibri;font-weight: bold;" href="<?php echo base_url() ?>jobs/bids_list" style="color:#686361">Proposal Sent <p style="float: right;margin: 0;"><?= $proposals; ?></p></a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-9 gray-text no-padding">
                                            <label  style="color: #3bafdb;font-size: 16px;font-family: calibri;" class="blue-text">Proposal Limit</label>  <p style="font-size: 16px;font-family: calibri;float: right;margin: 0;color: #1CA7DB;font-weight: bold;"><?= 30 - $proposals?></p> <label  style="color: #3bafdb;font-size: 16px;font-family: calibri;" class="blue-text">(Monthly)</label>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="row account-progress">
                            <div style="border: 1px solid #ccc;border-radius: 3px;padding-bottom: 2px;" class="col-md-12 white-box margin-top-space">
                                <div class='row'>
                                    <div class="col-md-12 text-center gray-text">
                                        <span style="font-size: 17px; margin: 0px 0px 0px -3px;font-family: calibri;font-weight: bold;" class="gray-text">Profile completeness</span>

                                        <div style="margin-top: 10px;" class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$profilecompleteness['profileprogress'];?>%">
                                                <?=$profilecompleteness['profileprogress'];?>%
                                            </div>
                                        </div>
                                    </div>
									<?php if($profilecompleteness['addpicture'] !=1){ ?>
										  <div class="col-md-12 element">
											 <a href="<?php echo base_url();?>profile-settings">
												<i class="fa fa-plus-circle" aria-hidden="true"></i> Add
												Picture
											 </a>
										</div>
									<?php } ?>
									<?php if($profilecompleteness['addcat'] !=1){ ?>
										<div class="col-md-12 element">
											<a href="<?php echo base_url();?>categories/choose">
												<i class="fa fa-plus-circle" aria-hidden="true"></i> Add
												Categories
											</a>
										</div>
									<?php } ?>
									<?php if($profilecompleteness['addportfolio'] !=1){ ?>
										<div class="col-md-12 element">
											<a href="<?php echo base_url();?>profile/basic_bio">
												<i class="fa fa-plus-circle" aria-hidden="true"></i> Add
												Portfolios
											</a>
										</div>
									<?php } ?>
									<?php if($profilecompleteness['addexp'] !=1){ ?>
										<div class="col-md-12 element">
											<a href="<?php echo base_url();?>profile/basic_bio">
												<i class="fa fa-plus-circle" aria-hidden="true"></i> Add
												Experience
											</a>
										</div>
									<?php } ?>
									<?php if($profilecompleteness['addedu'] !=1){ ?>
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
            </div>

            <!--            <div class="col-md-3 job-summery-box">-->



        </div>


        <!--<button type="submit" class="btn btn-primary pull-right">Next</button>-->

    </div>

</section>

</div>

</section>
<!-- big_header-->

