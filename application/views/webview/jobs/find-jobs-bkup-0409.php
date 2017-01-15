<?php //include 'content.php';   ?>
<section id="big_header"  style="margin-top: 50px; margin-bottom: 50px; height: auto;">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-2 margin-top-1 page-title">
                        <label>Find Job</label>
                    </div>
                    <div class="col-md-10 col-md-offset-0">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="" id="" value=""  class="form-control search-field" /> 
                                <i class="fa fa-search search-btn" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 margin-top-5 margin-left-4">
                        <div class="row">
                            <div class="col-md-12 blue-text">
                                <h3>Save your Searches</h3>
                            </div>
                            <div class="col-md-12 gray-text">
                                <label>How to add a saved Search</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9 bordered">
                                <div class="row">
                                    <div class="col-md-12"><span class="" style="color:#333">Categories Of Interest</span></div>
                                    <?php
                                    if(isset($subCateList) && sizeof($subCateList) > 0 && $subCateList != ""){
                                        foreach($subCateList as $sub){
                                    ?>
                                    <div class="col-md-12 blue-text">
                                        <label> <a href="#"> <?php echo $sub['subcategory_name'] ?> </a> </label>
                                    </div>
                                    <?php
                                        }
                                         ?>
                                    <div class="col-md-12" style="padding-top: 20px;">
                                        <label> <a style="color:#333" href="<?php echo site_url("categories/choose") ?>"> <b>Add Category </b></a> </label>
                                    </div>
                                    <?php
                                    }else{
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
                            <div class="col-md-9 margin-top-4 bordered">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Job Type</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" /> By Hours <br/>
                                        <input type="checkbox" /> Fixed Cost
                                    </div>

                                    <div class="col-md-12 margin-top-2">
                                        <label>Job Duration</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" /> More than 6 Months <br/>
                                        <input type="checkbox" /> 3 - 6 Months <br/>
                                        <input type="checkbox" /> 1 - 3 Months <br/>
                                        <input type="checkbox" /> Less than 1 Months <br/>
                                        <input type="checkbox" /> Less than 1 Week <br/>
                                    </div>

                                    <div class="col-md-12 margin-top-2">
                                        <label>Hours Per Week</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" /> 1 - 9 Hours <br/>
                                        <input type="checkbox" /> 10 - 19 Hours <br/>
                                        <input type="checkbox" /> 20 - 29 Hours <br/>
                                        <input type="checkbox" /> 30 - 39 Hours <br/>
                                        <input type="checkbox" /> More than 40  Hours<br/>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-7">
                        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css">
                        <style>.page-sub-title {margin-top: 10px;}.page-jobs input {margin-top: 5px;}.load-more{ background-color: #23a8d9;color: #fff;padding: 10px;text-align: center;cursor: pointer;}.page-jobs h5{padding-right:5px}</style>
                        <section id="big_header" style="margin-top: 50px; margin-bottom: 50px; height: auto;">
                            <div class="job-data">
                                <p>My Job Feed</p>
                                <div class="line"></div>
                                <br/>
                                <?php include 'content.php'; ?>
                            </div>
                            <div class='load-more'>Load more <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none"></div>
                        </section>

                    </div>                    
                </div>
            </div>            
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-6 padding-left-off">
                         <?php
                        if(strlen($this->session->userdata("webuser_picture")) > 0){
                       ?>
                            <img src="<?php echo base_url().$this->session->userdata("webuser_picture") ?>" width="120" />
                        <?php
                        }else{
                       ?>
                            <img src="<?php echo base_url() ?>assets/img/profile_img.jpg" width="120" />
                        <?php
                        }
                        ?>
                    </div>

                    <div class="col-md-6">
                        <label class="blue-text"><?php echo $this->session->userdata("fname")." ".$this->session->userdata("lname"); ?></label><br> 
                        <a href="profile/my-freelancer-profile" class="view-profile">View Profile</a>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 bordered margin-top">
                        <div class='row'>
                            <div class="col-md-7">
                                <a href="<?php echo base_url() ?>Active_interview"><span>Active Interview</span></a>
                            </div>
                            <div class="col-md-5 text-center gray-text">
                                <label>0</label>
                            </div>
                            <div class="col-md-7 gray-text">
                                <label>Proposal Sent</label>
                            </div>
                            <div class="col-md-5 text-center gray-text">
                                <label>0</label>
                            </div>
                            <div class="col-md-7 gray-text">
                                <label>Proposal Limit (Monthly)</label>
                            </div>
                            <div class="col-md-5 text-center gray-text">
                                <label>0</label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 bordered margin-top">
                        <div class='row'>
                            <div class="col-md-12 text-center gray-text">
                                <span class="gray-text">Your Profile is 45% complete</span>
                            </div>

                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="60"
                                     aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    <span class="sr-only">60% Complete</span>
                                </div>
                            </div>

                            <div class="col-md-4 text-center">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                Portfolio
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Verify
                                Contact
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                Education
                            </div>

                            <div class="col-md-4 text-center margin-top-1">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                Categories
                            </div>
                            <div class="col-md-4 text-center margin-top-1">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                Experience
                            </div>
                            <div class="col-md-4 text-center margin-top-1">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Picture
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>


        <!--<button type="submit" class="btn btn-primary pull-right">Next</button>-->

    </div>

</section>

</div>

</section>
<!-- big_header-->

