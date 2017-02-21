<link rel="stylesheet" href="<?php echo site_url("assets/css/chosen.css"); ?>">
<script src="<?php echo site_url("assets/js/chosen.jquery.js"); ?>"></script>
<section id="big_header" style="margin-top: 40px; margin-bottom: 40px; height: auto;overflow: hidden;border-right: 1px solid #ccc;margin-left: 13px;border-radius: 4px;">
    <div  style="border:1px solid #ccc;" class="container white-box-feed">
        <div class="row">
            <div style="margin-bottom: 15px;" class="col-md-7 col-md-offset-0 page-title">
                <h1 style="color:black">Update your job</h1> <br/>
                <h5 style="margin-top: -14px;" class="page-sub-title">Post a project for free and start getting receiving proposals within minutes</h5>
            </div>
        </div>
        <div class="row">
            <div class='form-msg'></div>
            <form class="custom_job_post_form" id="jobEdit" method="post" action="" enctype="multipart/form-data">
                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Title</h4>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  name="title" class="form-control" id="title" value='<?php echo $value->title;?>'>
                            <input type="hidden"  name="id" class="form-control"  value='<?php echo $value->id;?>'>
                        </div>
                    </div>
					
                    <div style="margin-top: 15px;" class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Select Category</h4>
                        </div>
                        <div class="col-md-5">
                            <div class="edit_title">
                                <select id="category" name="category" class="form-control">
                                    <?php
                                    $resultset = $this->db->get('job_categories');
                                    $categories = $resultset->result();

                                    if ($categories)
                                    {
                                        foreach ($categories as $category)
                                        {
                                            ?>
                                            <optgroup label="<?php echo $category->category_name; ?>" >
                                                <?php
                                                $subcat_resultset = $this->db->get_where('job_subcategories', ['cat_id' => $category->cat_id]);
                                                $subcategory_data = $subcat_resultset->result();

                                                if ($subcategory_data)
                                                {
                                                    foreach ($subcategory_data as $subcat)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $subcat->subcat_id ?>" <?php if($value->category==$subcat->subcat_id) echo 'selected="selected"'?>><?php echo $subcat->subcategory_name ?></option>
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
					
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="main_title">Required Skills</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="edit_title">
                                <div class="input_skills">
                                    <select class="choose-skills" name="skills[]"  data-placeholder="Skills" style="width:100%;" multiple>
                                        <?php foreach($job_skills as $item){
                                          ?>
                                        <option value="<?php echo $item['skill_name']; ?>" selected><?php echo $item["skill_name"]; ?></option> 
                                        <?php 
                                        }?>
                                        <?php foreach($skillList as $key => $skill){
                                          ?>
                                        <option value="<?php echo $skill->skill_name; ?>" <?php echo (in_array($skill->skill_name, $repeated)) ?  'disabled' : '' ;?>><?php echo $skill->skill_name; ?></option> 
                                        <?php 
                                        }?>
                                        
                                    </select>
                                </div>
                            </div>
                            <!-- <input type="text"  name="skills" class="form-control" value='<?php echo $value->skills;?>'> -->
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Job Description</h4>
                        </div>
                        <div class="col-md-12">
                            <textarea name="job_description" id="job_description" class="form-control" rows="5"><?php echo $value->job_description;?></textarea>
                        </div>
                    </div>
					
                    <div style="margin-top: 15px;" class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Attach File</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="edit_title">
                                <input style="padding: 0;" type="file" value="" name="userfile" class="">
                                <input type="hidden" value="<?php echo $value->userfile;?>" name="oldUserFile" >
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Job Type</h4>
                        </div>
                        <div class="col-md-9" style="margin-top: 6px;margin-left: 20px;">
                            <div class="row">
                                <div class="col-md-12 radio">
                                    <input type="radio" value="hourly" name="job_type"   <?php if($value->job_type=='hourly') echo 'checked="checked"' ?> ><h4>Hourly - Pay by the hour verify with the work diary</h4>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-md-12 radio">
                                    <input type="radio" value="fixed" name="job_type"
                                             <?php if($value->job_type=='fixed') echo 'checked="checked"' ?> ><h4>Fixed - Pay by the project requires Detailed specifications</h4>
                                </div>  
                            </div>

                        </div>
                    </div>
					
                    <div style="margin-top: 15px;" class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Experience Level</h4>
                        </div>
                        <div style="margin-left: 19px;" class="col-md-12 radio">
							<div class="edit_title">
								<input type="radio" name="experience_level" id="experience_level" value="Entry level" <?php if($value->experience_level=='Entry level') echo 'checked="checked"' ?> />
								<h4 style="margin-bottom: 0;">Entry Level $</h4>
								<br />

								<input type="radio" name="experience_level" id="experience_level" value="Entermediate" <?php if($value->experience_level=='Entermediate') echo 'checked="checked"' ?> />
								<h4 style="margin-bottom: 0;">Intermediate $$</h4>
								<br />

								<input type="radio" name="experience_level" id="experience_level" value="Experienced" <?php if($value->experience_level=='Experienced') echo 'checked="checked"' ?> />
								<h4>Experienced $$$</h4>
							</div>
                        </div>
                    </div>
					
                    <div class="row <?php if($value->job_type!='fixed') echo 'hidden' ?>" id="fixed-control">
                        <div class="col-md-12">
                            <h4 class="main_title">Budget$</h4>
                        </div>
                        <div class="col-md-12">
                            <input style="width: 80px;" type="text" name="budget" id="budget" value="<?php echo round($value->budget,2);?>" class="" />
                        </div>
                    </div>
					
                    <div class="row <?php if($value->job_type=='fixed') echo 'hidden' ?>" id="hourly-control">
                        <div class="col-md-12">
                            <h4 class="main_title">Hours Per week</h4>
                        </div>
                        <div class="col-md-5">
                            <select class="form-control" name="hours_per_week">
                                <option value="not_sure" <?php if($value->hours_per_week=='not_sure') echo 'selected="selected"'?>>Not Sure</option>
                                <option value="1-9" <?php if($value->hours_per_week=='1-9') echo 'selected="selected"'?>>1-9</option>
                                <option value="10-19" <?php if($value->hours_per_week=='10-19') echo 'selected="selected"'?>>10-19 hours</option>
                                <option value="20-29" <?php if($value->hours_per_week=='20-29') echo 'selected="selected"'?>>20-29 hours</option>
                                <option value="30-39" <?php if($value->hours_per_week=='30-39') echo 'selected="selected"'?>>30-39 hours</option>
                                <option value="40_plus" <?php if($value->hours_per_week=='40_plus') echo 'selected="selected"'?>>More than 40 hours</option>
                            </select>
                        </div>
                    </div>
                    <div style="margin-top: 15px;" class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Job Duration</h4>
                        </div>
                        <div class="col-md-5">
                            <select class="form-control" name="job_duration">
                                <option value="not_sure" <?php if($value->job_duration=='not_sure') echo 'selected="selected"'?>>Not Sure</option>
                                <option value="more_than_6_months" <?php if($value->job_duration=='more_than_6_months') echo 'selected="selected"'?>>More than 6 months</option>
                                <option value="3_6_months" <?php if($value->job_duration=='3_6_months') echo 'selected="selected"'?>>3 - 6 months</option>
                                <option value="1_3_months" <?php if($value->job_duration=='1_3_months') echo 'selected="selected"'?>>1 - 3 months</option>
                                <option value="less_than_1_months" <?php if($value->job_duration=='less_than_1_months') echo 'selected="selected"'?>>Less than 1 month</option>
                                <option value="less_than_1_week" <?php if($value->job_duration=='less_than_1_week') echo 'selected="selected"'?>>Less than 1 week</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br> <br>
                <div class="col-md-12 form-group">
                    <input type="submit" value="Update" class="btn-primary big_mass_active transparent-btn big_mass_button pull-left" id='submitBtn'>
					
                    <input type="submit" value="Cancel" class="btn-primary transparent-btn big_mass_button pull-left" id='previewBtn'>
                    <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
                </div>

                <!--<button type="submit" class="btn btn-primary pull-right">Next</button>-->

            </form>

        </div>

    </div>

</section>

</div>

</section>
<!-- big_header-->
<style>
.search-field {
border: none;
height: auto;
}
.row .form-group{margin-left:0;}
.white-box-feed {
padding-left: 40px;
}
</style>
<script>
    $(".choose-skills").chosen(); 
    $('.chosen-drop').hide();
    $(".chosen-container").bind('keyup',function(e) {
        $('.chosen-drop').show();
    });
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
        $(this).val().preppend(_parent_cat);
    });
</script>
