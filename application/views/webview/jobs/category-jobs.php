<section id="big_header"  style=" margin-bottom: 50px; height: auto;">
    <div class="container">
        <div class="row"> 
            <div class="col-md-10 col-md-offset-0">
                <div class="row">
                    <div class="col-md-12 no-padding margin-top-search">
                        <input style="width: 737px;" type="text" name="jobsearchbykeywords" id="jobsearch" value="<?php if (isset($searchKeyword)) echo $searchKeyword; ?>" autocomplete="on" class="form-control search-field" /> 
                        <i class="fa fa-search search-btn search-btn-cat" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-2 margin-top-1 page-title"> 
            </div>
        </div>
        <div class="row" style="margin-top:32px;">

            <div class="col-md-12 nopadding">
                <div class="col-md-2"> 
                    <div class="row">
                        <div class="col-md-12">  
                            <div class="row">
                                <div style="border: 1px solid #ccc;border-radius: 3px;" class="col-md-12 white-box">
                                    <div class="row">
                                        <div class="col-md-12"><span class="" style="color:#686361">Categories</span></div>
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
                                                <div class="col-md-12 blue-text">
                                                    <label> <input <?php echo $checked; ?> type="checkbox" class="choose-job-cat" value="<?php echo $sub['subcat_id'] ?>" name="jobCat[]" />&nbsp; <?php echo $sub['subcategory_name'] ?> </label>
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
                                <div style="border: 1px solid rgb(204, 204, 204); border-radius: 3px; padding-bottom: 0px;" class="col-md-12 white-box margin-top-space">
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
                                                        <li><input type="checkbox" name="jobDuration[]" class="jduration-check" value="more_than_6_months"/> &nbsp;&nbsp; More than 6 Months</li>
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
                    </div>
                </div> 
                <div class="col-md-8"> 
                    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css">
                    <style>.page-sub-title {margin-top: 10px;}.page-jobs input {margin-top: 5px;}.load-more{ background-color: #23a8d9;color: #fff;padding: 10px;text-align: center;cursor: pointer;}.page-jobs h5{padding-right:5px}</style>
                    <section id="big_header" style="margin-bottom: 50px; height: auto;">
                        <div class="job-data white-box-feed">
                            <div class="col-md-8 col-sm-8 no-padding">
                                <label class="col-md-4 no-padding">Sort by:</label>
                                <div class="col-md-7 no-padding">
                                    <select style="margin-bottom: 7px;margin-top: -9px;" class="select form-control" name="postTime">
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
                        <div style="margin-top: -30px;" class='load-more'>Load more <img src='<?php echo base_url() ?>assets/img/version1/loader.gif' class="form-loader" style="display:none"></div>
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
                    <div style="border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;border-left: 1px solid #ccc;border-radius: 0px 0px 4px 4px;padding: ;" class="row white-box text-center">

                        <div class="col-md-12">
                            <label class="blue-text"><?php echo $this->session->userdata("fname") . " " . $this->session->userdata("lname"); ?></label><br> 
                            <a href="profile/my-freelancer-profile" class="view-profile">View Profile</a>

                        </div>
                    </div>   

                    <div class="row">
                        <div class="col-md-12 margin-top-space proposal-box">
                            <div style="border: 1px solid #ccc;border-radius: 3px;" class='row white-box'>
                                <div class="row ">
                                    <div class="col-md-7 no-padding">
                                        <a style="font-size: 13px;" href="<?php echo base_url() ?>Active_interview"><label class="blue-text">Active Interview</label></a>
                                    </div>
                                    <div style="font-size: 14px;" class="col-md-2 text-center gray-text proposal-digit">
                                        <label class="blue-text"><?= $no_of_interview ?></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div style="font-size: 14px;" class="col-md-7 gray-text no-padding">
                                        <a href="<?php echo base_url() ?>jobs/bids_list" style="color:#686361">
                                            <label class="blue-text">Proposal Sent</label>
                                        </a>
                                    </div>
                                    <div class="col-md-2 text-center gray-text proposal-digit">
                                        <label class="blue-text"><?= $proposals; ?></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div style="font-size: 14px;" class="col-md-7 gray-text no-padding">
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
                        <div style="border: 1px solid #ccc;border-radius: 3px;" class="col-md-12 white-box margin-top-space">
                            <div class='row'>
                                <div class="col-md-12 text-center gray-text">
                                    <span style="font-size: 14px; margin: 0px 0px 0px -13px;" class="gray-text">Profile completeness</span>
                                    <div style="margin-top: 10px;" class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?= $profilecompleteness['profileprogress']; ?>%">
<?= $profilecompleteness['profileprogress']; ?>%
                                        </div>
                                    </div>
                                </div>
<?php if ($profilecompleteness['addpicture'] != 1) { ?>
                                    <div class="col-md-12 element">
                                        <a href="<?php echo base_url(); ?>profile-settings">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                            Picture
                                        </a>
                                    </div>
<?php } ?>
<?php if ($profilecompleteness['addcat'] != 1) { ?>
                                    <div class="col-md-12 element">
                                        <a href="<?php echo base_url(); ?>categories/choose">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                            Categories
                                        </a>
                                    </div>
<?php } ?>
<?php if ($profilecompleteness['addportfolio'] != 1) { ?>
                                    <div class="col-md-12 element">
                                        <a href="<?php echo base_url(); ?>profile/basic_bio">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                            Portfolios
                                        </a>
                                    </div>
<?php } ?>	
<?php if ($profilecompleteness['addexp'] != 1) { ?>
                                    <div class="col-md-12 element">
                                        <a href="<?php echo base_url(); ?>profile/basic_bio">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                            Experience
                                        </a>
                                    </div>
<?php } ?>
<?php if ($profilecompleteness['addedu'] != 1) { ?>
                                    <div class="col-md-12 element">
                                        <a href="<?php echo base_url(); ?>profile/basic_bio">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                            Education
                                        </a>
                                    </div>
<?php } ?>
                                <div class="col-md-12 element">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Picture
                                </div>
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
        $('#tob-duration,#tob-hours').css('height', '150px');
        $("#menu-content input[type='checkbox']").attr("checked", true);
 
//        $(".choose-job-cat").change(function () {
//             alert("dd");
//        });
    </script>
    <?php
}
?>
<!-- big_header-->


