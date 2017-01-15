<?php
//include 'content.php';  
$Conversation = new Conversation();
$notification = $Conversation->index();
$notification_details = $Conversation->details();
$job_alert_count = $Conversation->job_alert();


$freelancerend = $Conversation->freelancerend();
$clientend = $Conversation->clientend();
?>
<section id="big_header"  style="margin-bottom: 50px; height: auto;">
    <div class="container">

<?php if ($job_alert_count) { ?>
            <div class="row margin-top-1">
                <div class="col-md-10 bordered-alert text-center ack-box" style="max-width:781px;">
                    <h4>! You have  <a href="<?php echo site_url("Active_interview"); ?>" class="show_notification" style="color: #28da28 !important;"><?= $job_alert_count ?> pending offer- Accept to start working</a>

                    </h4>
                </div>
            </div>   
<?php } 

        if ($this->session->userdata('type') == '1') { ?>
			<?php if(!empty($clientend)) { ?>			
			<div class="row margin-top-1">
				<div class="col-md-10 bordered-alert text-center ack-box" style="max-width:781px;">
					<h4>! You have  <a href="<?php echo base_url() ?>jobs/client_endjobnotification" class="show_notification" style="color: #28da28 !important;"> <?=count($clientend)?> ended contract - waiting for feedback</a>			
					</h4>
				</div>
			</div> 			 
			<?php } ?>
			<?php if($ststus->isactive==0){ ?>
				<div class="row ">
					<div class="col-md-10 bordered-alert text-center ack-box" style="max-width:781px;">
						<h4>! Your financial Account has been Suspended.</h4>
					</div>
				</div>
			<?php } ?>
		<?php  } else if ($this->session->userdata('type') == '2'){  ?>
			<?php  if(!empty($freelancerend)) { ?>
			<div class="row margin-top-1">
				<div class="col-md-10 bordered-alert text-center ack-box" style="max-width:781px;">
					<h4>! You have  <a href="<?php echo base_url() ?>jobs/freelancer_endjobnotification" class="show_notification" style="color: #28da28 !important;"> <?=count($freelancerend)?> ended contract - waiting for feedback</a>		
					</h4>
				</div>
			</div> 				
			<?php } ?>
			<?php if($ststus->isactive==0){ ?>
				<div class="row ">
					<div class="col-md-10 bordered-alert text-center ack-box" style="max-width:781px;">
						<h4>! Your financial Account has been Suspended.</h4>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
        
        
        
        <div class="row">
            <div class="col-md-10 col-md-offset-0">
                <div class="row">
                    <div class="col-md-12 no-padding margin-top-search">
                        <form action="find-jobs" method="post" id="job-search-form">
                            <input type="text" placeholder="Find job" name="jobsearchbykeywords" id="jobsearch" value=""  class="form-control search-field" /> 
                            <i class="fa fa-search search-btn search-btn-home" aria-hidden="true"></i>
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
                            <div class="col-md-12 bordered white-box">
                                <div class="row">
                                    <div class="col-md-12"><span class="text-center" style="color:#686361">CATEGORIES</span></div>
                                    <?php
                                    if (isset($subCateList) && sizeof($subCateList) > 0 && $subCateList != "") {
                                        foreach ($subCateList as $sub) {
                                            ?>
                                            <div class="col-md-12 blue-text">
                                                <label> <a href="<?php echo site_url('find-jobs/' . $sub['url_rewrite']) ?>"> <?php echo $sub['subcategory_name'] ?> </a> </label>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="col-md-12" style="padding-top: 20px;">
                                            <label> <a style="color:#686361" href="<?php echo site_url("categories/choose") ?>"> <b><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Category </b></a> </label>
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
                            <div class="col-md-12 bordered white-box margin-top-space">
                                <div class="row">
                                    <div class="nav-side-menu">
                                         <div class="menu-list">
                                            <ul id="menu-content" class="menu-content out">
                                                <li  data-toggle="collapse" data-target="#tob-type" class="collapsed">
                                                 Job Type <span class="arrow"></span>
                                                </li>
                                                <ul class="sub-menu collapse" id="tob-type">
                                                    <li><input type="checkbox" name="jobType[]" class="jtype-check" value="hourly"/> &nbsp;&nbsp; By Hours</li>
                                                    <li><input type="checkbox" name="jobType[]" class="jtype-check" value="fixed"/> &nbsp;&nbsp; Fixed Cost</li>
                                               </ul>
                                                
                                                <li  data-toggle="collapse" data-target="#tob-duration" class="collapsed">
                                                 Job Duration <span class="arrow"></span>
                                                </li>
                                                <ul class="sub-menu collapse" id="tob-duration">
                                                    <li><input type="checkbox" name="jobDuration[]" class="jduration-check" value="More_than_6_months"/> &nbsp;&nbsp; More than 6 Months</li>
                                                    <li><input type="checkbox" name="jobDuration[]" class="jduration-check" value="3_6_months"/> &nbsp;&nbsp; 3 - 6 Months</li>
                                                    <li><input type="checkbox" name="jobDuration[]" class="jduration-check" value="1_3_months"/> &nbsp;&nbsp; 1 - 3 Months</li>
                                                    <li><input type="checkbox" name="jobDuration[]" class="jduration-check" value="less_than_1_months"/> &nbsp;&nbsp; Less than 1 Months</li>
                                                    <li><input type="checkbox" name="jobDuration[]" class="jduration-check" value="less_than_1_week"/> &nbsp;&nbsp; Less than 1 Week</li>
                                               </ul>
                                                <li  data-toggle="collapse" data-target="#tob-hours" class="collapsed">
                                                 Hours Per Week <span class="arrow"></span>
                                                </li>
                                                <ul class="sub-menu collapse" id="tob-hours">
                                                    <li><input type="checkbox" name="jobHours[]" class="jhours-check" value="1-9"/> &nbsp;&nbsp; 1 - 9 Hours</li>
                                                    <li><input type="checkbox" name="jobHours[]" class="jhours-check" value="10-19"/> &nbsp;&nbsp; 10 - 19 Hours</li>
                                                    <li><input type="checkbox" name="jobHours[]" class="jhours-check" value="20-29"/> &nbsp;&nbsp; 20 - 29 Hours</li>
                                                    <li><input type="checkbox" name="jobHours[]" class="jhours-check" value="30-39"/> &nbsp;&nbsp; 30 - 39 Hours</li>
                                                    <li><input type="checkbox" name="jobHours[]" class="jhours-check" value="40_plus"/> &nbsp;&nbsp; More than 40  Hours</li>
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
                        <style>.page-sub-title {margin-top: 10px;}.page-jobs input {margin-top: 5px;}.load-more{ background-color: #23a8d9;color: #fff;padding: 10px;text-align: center;cursor: pointer;}.page-jobs h5{padding-right:5px}</style>
                        <section id="big_header" style="margin-bottom: 50px; height: auto;">
                            <div class="job-data white-box-feed">
                                <div class="job-searching col-md-3 col-sm-3 no-padding">My Job Feed</div>
                                <div class="clearfix"></div>
                                <div class="line"></div>
                                <br/>
                                <div class="row white-box" id="all-jobs">

<?php include 'content.php'; ?>
                                </div>

                            </div>
                            <div class='load-more'>Load more <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none"></div>
                        </section>

                    </div>   
                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-md-12 no-padding">
                                <?php
                                if (strlen($this->session->userdata("webuser_picture")) > 0) {
                                    ?>
                                    <img src="<?php echo base_url() . $this->session->userdata("webuser_picture") ?>" class="profile-pic" />
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() ?>assets/img/profile_img.jpg" class="profile-pic" />
                                    <?php
                                }
                                ?>
                            </div>

                        </div>
                        <div class="row white-box text-center">
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
                                <label class="blue-text"><?php echo $this->session->userdata("fname") . " " . $this->session->userdata("lname"); ?></label><br> 
                                <a href="<?php echo site_url('profile/'.$webuser->webuser_username); ?>" class="view-profile">View Profile</a>

                            </div>
                        </div>      

                        <div class="row">
                            <div class="col-md-12 margin-top-space proposal-box">
                                <div class='row white-box'>
                                    <div class="row ">
                                        <div class="col-md-7 no-padding">
                                            <a href="<?php echo base_url() ?>Active_interview"><label class="blue-text">Active Interview</label></a>
                                        </div>
                                        <div class="col-md-2 text-center gray-text proposal-digit">
                                            <label class="blue-text"><?= $no_of_interview ?></label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7 gray-text no-padding">
                                            <a href="<?php echo base_url() ?>jobs/bids_list" style="color:#686361">
                                                <label class="blue-text">Proposal Sent</label>
                                            </a>
                                        </div>
                                        <div class="col-md-2 text-center gray-text proposal-digit">
                                            <label class="blue-text"><?= $proposals; ?></label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7 gray-text no-padding">
                                            <label class="blue-text">Proposal Limit (Monthly)</label>
                                        </div>
                                        <div class="col-md-2 text-center gray-text proposal-digit">
                                            <label class="blue-text"><?= 30 - $proposals?></label>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="row account-progress">
                            <div class="col-md-12 white-box margin-top-space">
                                <div class='row'>
                                    <div class="col-md-12 text-center gray-text">
                                        <span class="gray-text">Profile completeness</span>
										
                                        <div class="progress">
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
                                    <div class="col-md-12 element">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i> ID Verification
                                    </div>
									
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

