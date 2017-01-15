<section id="big_header"
         style="margin-top: 50px; margin-bottom: 50px; height: auto;">
    <div class="container white-box-feed">
        <div class="row">
            <div class="col-md-7 col-md-offset-0 page-title">
                <h1>Update your job</h1> <br/>
                <h5 class="page-sub-title">Post a project for free and start getting receiving proposals within minutes</h5>
            </div>
        </div>
        <div class="row">
            <div class='form-msg'></div>
            <form id="jobEdit" method="post" action="" enctype="multipart/form-data">
                <div class="col-md-7 form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Title</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text"  name="title" class="form-control" id="title" value='<?php echo $value->title;?>'>
                            <input type="hidden"  name="id" class="form-control"  value='<?php echo $value->id;?>'>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Select Category</label>
                        </div>
                        <div class="col-md-9">
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

                <div class="col-md-7 form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Required Skills</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text"  name="skills" class="form-control" value='<?php echo $value->skills;?>'>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Job Description</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="job_description" id="job_description"
                                      class="form-control" rows="5"><?php echo $value->job_description;?></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Change File</label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" value="" name="userfile" class="">
                            <input type="hidden" value="<?php echo $value->userfile;?>" name="oldUserFile" >
                        </div>
                    </div>
                </div>

                <div class="col-md-7 form-group">
                    <div class="row">
                        <div class="col-md-3 margin-top">
                            <label>Job Type</label>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12 radio">
                                    <input type="radio" value="hourly" name="job_type"   <?php if($value->job_type=='hourly') echo 'checked="checked"' ?> ><label>Hourly - Pay by the hour verify with the work diary</label>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-md-12 radio">
                                    <input type="radio" value="fixed" name="job_type"
                                             <?php if($value->job_type=='fixed') echo 'checked="checked"' ?> ><label>Fixed - Pay by the project requires Detailed specifications</label>
                                </div>  
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-7 form-group" >
                    <div class="row">
                        <div class="col-md-3">
                            <label>Experience Level</label>
                        </div>
                        <div class="col-md-9">
                            <input type="radio" name="experience_level" id="experience_level" value="Entry level" <?php if($value->experience_level=='Entry level') echo 'checked="checked"' ?> />
                            <label>Entry Level</label> <span class="dollar-sign">$</span>

                            <input type="radio" name="experience_level" id="experience_level" value="Entermediate" <?php if($value->experience_level=='Entermediate') echo 'checked="checked"' ?> />
                            <label>Intermediate</label> <span class="dollar-sign">$$</span>

                            <input type="radio" name="experience_level" id="experience_level" value="Experienced" <?php if($value->experience_level=='Experienced') echo 'checked="checked"' ?> />
                            <label>Experienced</label> <span class="dollar-sign">$$$</span>

                        </div>
                    </div>
                </div>

                <div class="col-md-7 form-group <?php if($value->job_type!='fixed') echo 'hidden' ?>" id="fixed-control">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Budget</label>
                        </div>
                        <div class="col-md-9">
                            <span class="dollar-sign">$</span> <input type="text" name="budget" id="budget" value="<?php echo round($value->budget,2);?>" class="" />
                        </div>
                    </div>
                </div>

                <div class="col-md-7 form-group <?php if($value->job_type=='fixed') echo 'hidden' ?>" id="hourly-control">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Hours Per week</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="hours_per_week">
                                <option value="not_sure" <?php if($value->hours_per_week=='not_sure') echo 'selected="selected"'?>>Not Sure</option>
                                <option value="1-9" <?php if($value->hours_per_week=='1-9') echo 'selected="selected"'?>>1-9</option>
                                <option value="10-19" <?php if($value->hours_per_week=='10-19') echo 'selected="selected"'?>>10-19</option>
                                <option value="20-29" <?php if($value->hours_per_week=='20-29') echo 'selected="selected"'?>>20-29</option>
                                <option value="30-39" <?php if($value->hours_per_week=='30-39') echo 'selected="selected"'?>>30-39</option>
                                <option value="40_plus" <?php if($value->hours_per_week=='40_plus') echo 'selected="selected"'?>>More than 40</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Job Duration</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="job_duration">
                                <option value="not_sure" <?php if($value->job_duration=='not_sure') echo 'selected="selected"'?>>Not Sure</option>
                                <option value="more_than_6_months" <?php if($value->job_duration=='more_than_6_months') echo 'selected="selected"'?>>More than 6 Months</option>
                                <option value="3_6_months" <?php if($value->job_duration=='3_6_months') echo 'selected="selected"'?>>3 - 6 Months</option>
                                <option value="1_3_months" <?php if($value->job_duration=='1_3_months') echo 'selected="selected"'?>>1 - 3 Months</option>
                                <option value="less_than_1_months" <?php if($value->job_duration=='less_than_1_months') echo 'selected="selected"'?>>Less than 1 Month</option>
                                <option value="less_than_1_week" <?php if($value->job_duration=='less_than_1_week') echo 'selected="selected"'?>>Less than 1 Week</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br> <br>
                <div class="col-md-12 form-group">
                    <input type="submit" value="Update" class="btn btn-primary form-btn" id='submitBtn'>
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
<script>
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
