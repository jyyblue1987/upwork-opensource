<link rel="stylesheet" href="<?php echo site_url("assets/css/chosen.css"); ?>">
<script src="<?php echo site_url("assets/js/chosen.jquery.js"); ?>"></script>
<section id="big_header"
         style="margin-top: 50px; margin-bottom: 50px; height: auto;">
    <div class="container white-box-feed">
        <div class="row">
            <div class="col-md-7 col-md-offset-0 page-title">
                <h1 style="color:black">Create your job</h1> <br/>
                <h5 class="page-sub-title">Post a project for free and start getting receiving proposals within minutes</h5>
            </div>
        </div>
        <div class="row">
            <div class='form-msg'></div>
            <form id="jobCreate" method="post" action="" enctype="multipart/form-data">
                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="main_title">Title</label>
                        </div>
                        <div class="col-md-9">
                           <div class="edit_title">
                                <input type="text" value="" name="title" class="form-control" id="title">
                           </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="main_title">Select Category</label>
                        </div>
                        <div class="col-md-5">
                         <div class="edit_title">
                             <select id="category" name="category" class="form-control">
                                <?php
                                $resultset = $this->db->get('job_categories');
                                $categories = $resultset->result();

                                if ($categories) {
                                    foreach ($categories as $category) {
                                        ?>
                                        <optgroup label="<?php echo $category->category_name; ?>" >
                                            <?php
                                            $subcat_resultset = $this->db->get_where('job_subcategories', ['cat_id' => $category->cat_id]);
                                            $subcategory_data = $subcat_resultset->result();

                                            if ($subcategory_data) {
                                                foreach ($subcategory_data as $subcat) {
                                                    ?>
                                                    <option value="<?php echo $subcat->subcat_id ?>"><?php echo $subcat->subcategory_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </optgroup >
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                         </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="main_title">Required Skills</label>
                        </div>
                        <div class="col-md-9">
                          <div class="edit_title">
                               <div class="input_skills">
                                 
                             <select class="choose-skills" name="skills[]"  data-placeholder="Skills" style="width:515px;" multiple>
                                <?php foreach($skillList as $skill){
                                  ?>
                                <option value="<?php echo $skill; ?>"><?php echo $skill; ?></option> 
                                <?php 
                                }?>
                                
                            </select>
                           </div>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="main_title">Job Description</label>
                        </div>
                        <div class="col-md-9">
                           <div class="edit_title">
                               <textarea name="job_description" id="job_description"
                                      class="form-control" rows="5"></textarea>
                           </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="main_title">Upload File</label>
                        </div>
                        <div class="col-md-9">
                          <div class="edit_title">
                              <div class="upload_file">
                                <input type="file" value="" name="userfile" class="upload"
                                   id="user_file" style="margin-left: 39px;">
                           </div>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3 margin-top">
                            <label class="main_title">Job Type</label>
                        </div>
                        <div class="col-md-9" style="margin-top: 16px;">
                           <div class="edit_title">
                               <div class="row" style="margin-left: 3px;">
                                <div class="col-md-12 radio">
                                    <input type="radio" value="hourly" name="job_type"
                                           checked="checked"><label>Hourly - Pay by the hour verify with the work diary</label>
                                </div> 
                            </div>

                            <div class="row" style="margin-left: 3px;">
                                <div class="col-md-12 radio">
                                    <input type="radio" value="fixed" name="job_type" ><label>Fixed - Pay by the project requires Detailed specifications</label>
                                </div> 
                            </div>
                           </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 form-group" >
                    <div class="row">
                        <div class="col-md-3">
                            <label class="main_title">Experience Level</label>
                        </div>
                        <div class="col-md-9">
                           <div class="edit_title">
                               <input type="radio" name="experience_level" id="experience_level" value="Entry level" checked/>
                            <label>Entry Level</label> <span class="dollar-sign">$</span>

                            <input type="radio" name="experience_level" id="experience_level" value="Entermediate" />
                            <label>Intermediate</label> <span class="dollar-sign">$$</span>

                            <input type="radio" name="experience_level" id="experience_level" value="Experienced" />
                            <label>Experienced</label> <span class="dollar-sign">$$$</span>
                           </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 form-group hidden" id="fixed-control">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="main_title">Budget</label>
                        </div>
                        <div class="col-md-9">
                           <div class="edit_title">
                                <span class="dollar-sign">$</span> <input type="text" name="budget" id="budget" value="" class="" />
                           </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 form-group" id="hourly-control">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="main_title">Hours Per week</label>
                        </div>
                        <div class="col-md-5">
                           <div class="edit_title">
                               <select class="form-control" name="hours_per_week">
                                <option value="not_sure">Not Sure</option>
                                <option value="1-9">1-9</option>
                                <option value="10-19">10-19</option>
                                <option value="20-29">20-29</option>
                                <option value="30-39">30-39</option>
                                <option value="40_plus">More than 40</option>
                            </select>
                           </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="main_title">Job Duration</label>
                        </div>
                        <div class="col-md-5">
                           <div class="edit_title">
                                <select class="form-control" name="job_duration">
                                <option value="not_sure">Not Sure</option>
                                <option value="more_than_6_months">More than 6 Months</option>
                                <option value="3_6_months">3 - 6 Months</option>
                                <option value="1_3_months">1 - 3 Months</option>
                                <option value="less_than_1_months">Less than 1 Month</option>
                                <option value="less_than_1_week">Less than 1 Week</option>
                            </select>
                           </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-2 ">
                        </div>   
                        <div class="col-md-10 text-left">
                           <div class="create_job_btn">
                                <input type="hidden" name="submitbtn" value="1" id='buttonVal'/>
                            <input type="submit" value="Publish" class="btn my_btn publish_btn" id='submitBtn'>
                            <input type="submit" value="Preview" class="btn my_btn preview_btn" id='previewBtn'>
                            <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
                           </div>
                        </div>  

                    </div>
                </div>

                <!--<button type="submit" class="btn btn-primary pull-right">Next</button>-->

            </form>

        </div>

    </div>

</section>

</div>

</section>
<!-- big_header-->
<script>
     $(".choose-skills").chosen(); 
    $('input[name="job_type"]').on('click', function () {
        console.info($(this));
        $('#hourly-control').addClass('hidden');
        $('#fixed-control').addClass('hidden');
        if ($(this).val() == 'hourly') {
            $('#hourly-control').removeClass('hidden');
        }

        if ($(this).val() == 'fixed') {
            $('#fixed-control').removeClass('hidden');
        }
    });

    $('#category').on('change', function () {
        console.info('this', $(this), $(this).find(":selected").parents('optgroup').attr('label'));
        var _parent_cat = $(this).find(":selected").parents('optgroup').attr('label');
       // $(this).val().prepend(_parent_cat);
                $(this).prepend(_parent_cat);
    });
</script>
<style>
    *{
        font-family: "Calibri";
    }
.search-field{
    border:none;
    height:auto;
    
    }
    
.upload[type="file"] {
	border-radius: 5px;
	padding: 10px 0px 10px 10px;
	font-family: 'Roboto-Regular';
	font-size: 15px;
}
.edit_title, .form-control {
	width: 100%;
}
.create_job_btn, .publish_btn {
	margin-right: 16px;
	margin-left: -5px;
}
.edit_title {
	margin-left: -70px;
}
.main_title {
	margin-left: -38px;
}
</style>