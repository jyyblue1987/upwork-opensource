<style>
    .load-more
    {
        background-color: #23a8d9; 
        color: #fff; 
        padding: 10px; 
        text-align: center; 
        cursor: pointer; 
        margin-top: -32px;
    }
    .page-jobs h5
    {
        padding-right:5px
    }
</style>
<section id="big_header"  style="height: auto;">
    <div class="container">
        <div class="row"> 
            <div class="col-md-10 col-md-offset-0">
                <div class="row">
                    <div class="col-md-12 no-padding margin-top-search">
                        <form action="<?= site_url() ?>jobs-search" method="GET" id="job-search-form">
                            <input style="width: 737px;" type="text" name="q" id="jobsearch" value="<?php if (isset($searchKeyword)) echo $searchKeyword; ?>" autocomplete="on" class="form-control search-field" /> 
                            <i class="fa fa-search search-btn search-btn-home" aria-hidden="true"></i>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2 margin-top-1 page-title">
            </div>
        </div>
        <div class="row">

            <div class="col-md-12 nopadding">
                <div class="col-md-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div style="border: 1px solid #ccc;border-radius: 3px;" class="col-md-12 white-box">
                                    <div class="row">
                                        <div style="margin-top: 5px;margin-bottom: 10px;" class="col-md-12"><span class="" style="color:#686361;font-weight: bold;font-size: 17px;font-family: calibri;text-transform: uppercase;">Categories</span></div>
                                        <div class="col-md-12 blue-text">
                                            <label> <input type="checkbox" value="0" <?php if ($checkAll) echo "checked=checked" ?> name="jobCat[]" class="choose-job-cat" />&nbsp; All Categories </label>
                                        </div>
                                        <?php
                                        if (isset($subCateList) && sizeof($subCateList) > 0 && $subCateList != "") {
                                            foreach ($subCateList as $sub) {
                                                if ($jobCatSelected == $sub['subcat_id']) {
                                                    $checked = "checked=checked";
                                                } else {
                                                    $checked = "";
                                                }
                                                ?>
                                                <div style="margin-top: 10px;" class="col-md-12 blue-text">
                                                    <label> <input <?php echo $checked; ?> type="checkbox" class="choose-job-cat" value="<?php echo $sub['subcat_id'] ?>" name="jobCat[]" />&nbsp; <?php echo $sub['subcategory_name'] ?> </label>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="col-md-12" style="padding-top: 20px;margin-bottom: 5px;">
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
                                <div style="border: 1px solid rgb(204, 204, 204); border-radius: 3px; padding-bottom: 0px;" class="col-md-12 white-box margin-top-space">
                                    <div class="row">
                                        <div class="nav-side-menu">
                                            <div class="menu-list">
                                                <ul id="menu-content" class="menu-content out">
                                                    <li style="padding-top: 5px;padding-bottom: 5px;font-family: calibri;font-size: 17px;font-weight: bold;color: #686361;" data-toggle="collapse" data-target="#tob-type" class="collapsed">
                                                        Job Type <span class="arrow"></span>
                                                    </li>
                                                    <ul style="margin-top: 12px;" class="sub-menu collapse" id="tob-type">
                                                        <li style="position:relative;"><input type="checkbox" name="jobType[]" class="jtype-check" value="hourly"/> &nbsp; <span style="color: #686361;position: absolute;top: -2px;">By Hours</span></li>
                                                        <li style="position:relative;" style="position:relative;"><input type="checkbox" name="jobType[]" class="jtype-check" value="fixed"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">Fixed Cost</span></li>
                                                    </ul>

                                                    <li style="padding-top: 5px;padding-bottom: 5px;font-family: calibri;font-size: 17px;font-weight: bold;color: #686361;" data-toggle="collapse" data-target="#tob-duration" class="collapsed">
                                                        Job Duration <span class="arrow"></span>
                                                    </li>
                                                    <ul style="margin-top: 12px;" class="sub-menu collapse" id="tob-duration">
                                                        <li style="position:relative;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="more_than_6_months"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;"> More than 6 Months</span></li>
                                                        <li style="position:relative;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="3_6_months"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;"> 3 - 6 Months</span></li>
                                                        <li style="position:relative;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="1_3_months"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;"> 1 - 3 Months</span></li>
                                                        <li style="position:relative;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="less_than_1_months"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;"> Less than 1 Months</span></li>
                                                        <li style="position:relative;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="less_than_1_week"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;"> Less than 1 Week</span></li>
                                                    </ul>
                                                    <li style="padding-top: 5px;padding-bottom: 5px;font-family: calibri;font-size: 17px;font-weight: bold;color: #686361;" data-toggle="collapse" data-target="#tob-hours" class="collapsed">
                                                 Hours Per Week <span class="arrow"></span>
                                                </li>
                                                    <ul style="margin-bottom: 7px;" class="sub-menu collapse" id="tob-hours">
                                                        <li style="position:relative;margin-top: 11px;" style="position:relative;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="1-9"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;"> 1 - 9 Hours</span></li>
                                                        <li style="position:relative;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="10-19"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;"> 10 - 19 Hours</span></li>
                                                        <li style="position:relative;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="20-29"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;"> 20 - 29 Hours</span></li>
                                                        <li style="position:relative;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="30-39"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;"> 30 - 39 Hours</span></li>
                                                        <li style="position:relative;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="40_plus"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;"> More than 40  Hours</span></li>
                                                    </ul>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div> 
                    </div>
                </div> 
                <div class="col-md-8"> 
                    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css">
                    <section id="big_header" style="height: auto;">
                        <div style="padding-bottom: 0; margin-top: -35px;" class="job-data white-box-feed">
                            
                            <div class="col-md-8 col-sm-8 no-padding">
                                <label class="col-md-4 no-padding">Sort by:</label>
                                <div class="col-md-7 no-padding">
                                    <select style="margin-bottom: 10px;margin-top: -10px;" class="select form-control" name="postTime">
                                        <option value="1">Newest</option>
                                        <option value="0">Oldest</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 no-padding jobs-found">
                                Total <?php if (!empty($records)) {
                                            echo count($records);
                                        } ?> jobs found
                            </div>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <div class="line custon_line"></div>
                            <br/>
                            <div class="row white-box" id="all-jobs">  
                                <?php include 'content.php'; ?>
                            </div>
                        </div>
                        <!-- Load more for keyword search -->
                        <div style="margin-top: -30px;" class='load-more'>Load more <img src='<?php echo site_url() ?>assets/img/version1/loader.gif' class="form-loader" style="display:none"></div>
                    </section>

                </div>  
                <div class="col-md-2"> 

                    <div class="row">
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
                    <div style="border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;border-left: 1px solid #ccc;border-radius: 0px 0px 4px 4px;padding-bottom: 13px;" class="row white-box text-center">

                        <div class="col-md-12">
                            <label class="blue-text"><?php echo $this->session->userdata("fname") . " " . $this->session->userdata("lname"); ?></label><br> 
                            <a style="color: #3bafdb;font-size: 16px;font-family: calibri;font-weight: bold;" href="<?php echo site_url('profile/'.$this->session->userdata("username")); ?>" class="view-profile">View Profile</a>

                        </div>
                    </div>   

                    <div class="row">
                        <div class="col-md-12 margin-top-space proposal-box">
                            <div style="border: 1px solid #ccc;border-radius: 3px;padding-bottom: 20px;" class='row white-box'>
                                <div class="row ">
                                    <div style="margin-bottom: 8px;" class="col-md-9 no-padding">
                                        <a style="color: #3bafdb;font-size: 16px;font-family: calibri;font-weight: bold;" href="<?php echo base_url() ?>my-interviews">Active Interview<p style="float: right;margin: 0;"><?= $int ?></p></a>
                                    </div>
                                </div>
                                
                                <div class="row ">
                                    <div style="margin-bottom: 8px;" class="col-md-9 no-padding">
                                        <a style="color: #3bafdb;font-size: 16px;font-family: calibri;font-weight: bold;" href="<?php echo base_url() ?>my-offers">Active Offer<p style="float: right;margin: 0;"><?= $offers ?></p></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div style="margin-bottom: 8px;" class="col-md-9 gray-text no-padding">
                                        <a href="<?php echo base_url() ?>jobs/my-bids" style="color: #3bafdb;font-size: 16px;font-family: calibri;font-weight: bold;"> Proposal Sent <p style="float: right;margin: 0;"><?= $proposals; ?></p>
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div style="font-size: 14px;" class="col-md-9 gray-text no-padding">
                                        <label style="color: #3bafdb;font-size: 16px;font-family: calibri;" class="blue-text">Proposal Limit</label>  <p style="font-size: 16px;font-family: calibri;float: right;margin: 0;color: #1CA7DB;font-weight: bold;"><?= 30 - $proposals?></p> <label style="font-size: 16px;font-family: calibri;color: #3bafdb;" class="blue-text">(Monthly)</label>
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

            <!--            <div class="col-md-3 job-summery-box">
                            
                        </div>-->


        </div>
    </div>
</section>
</div>
</section>
<?php
if ($checkAll) {
    ?>
    <script>
        $("#tob-type,#tob-duration,#tob-hours").addClass('in');
        $('#tob-type').css('height', '60px');
        $('#tob-duration,#tob-hours').css('height', '160px');
        $("#menu-content input[type='checkbox']").attr("checked", true);
 
//        $(".choose-job-cat").change(function () {
//             alert("dd");
//        });
    </script>
    <?php
}
?>
<!-- big_header-->


