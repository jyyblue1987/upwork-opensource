<link rel="stylesheet" href="<?php echo site_url("assets/css/chosen.css"); ?>">
<style>
    input[type=file] {
        display:block;
        top: 0;
        left: 0;
        height:0;
        width:0;
        opacity: 0;
        filter: alpha(opacity=0);
        font-size: 8pt;
        z-index: 1;
        visibility: hidden;
        margin-left: -40px;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/pages/edit-jobs.css" />
<script src="<?php echo site_url("assets/js/chosen.jquery.js"); ?>"></script>
<section id="big_header">
    <div  class="container white-box-feed pad-left-right">
        <div class="row">
            <div class="col-md-7 col-md-offset-0 page-title">
                <h1 class="black">Update your job</h1> <br/>
                <h5 class="page-sub-title">Post a project for free and start getting receiving proposals within minutes</h5>
            </div>
        </div>
        <div class="row">
            <div class='form-msg'></div>
            <form class="custom_job_post_form" id="jobEdit" method="post" action="" enctype="multipart/form-data">
                <div class="col-md-9 form-group no-pad-mob">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Title</h4>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  name="title" class="form-control" id="title" value='<?php echo $value->get_title();?>'>
                            <input type="hidden"  name="id" class="form-control"  value='<?php echo $value->get_jobid();?>'>
                        </div>
                    </div>

                    <div class="row marg-top-15">
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
                                                        <option value="<?php echo $subcat->subcat_id ?>" <?php if($value->get_category() ==$subcat->subcat_id) echo 'selected="selected"'?>><?php echo $subcat->subcategory_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            </optgroup>
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
                                    <select class="choose-skills" name="skills[]"  data-placeholder="Skills" multiple>
                                        <?php foreach($value->get_skills() as $item){
                                          ?>
                                        <option value="<?php echo $item; ?>" selected><?php echo $item; ?></option> 
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
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Job Description</h4>
                        </div>
                        <div class="col-md-12">
                            <textarea name="job_description" id="job_description" class="form-control" rows="5"><?php echo $value->get_jobdesc();?></textarea>
                        </div>
                    </div>

                    <div class="row marg-top-15">
                        <div class="col-md-12">
                            <h4 class="main_title">Attach File</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="upload_file">
                                    <input type="file" name="files" id="files" />
                                    <input type="button" id="uploader" value="Add files" class="btn my_btn marg-left-0" />
                                    <div id="file_lists" class="marg-0">
                                        <ul id="lists" class="list-none">
                                            <?php 
                                                foreach($value->get_attachments() AS $attachment){
                                                    echo '<li>'.$attachment.'<img src="'.site_url().'assets/img/delete_icon.gif" data-formDiscard="'.$value->get_employerid().'/'.$value->get_tid().'" class="remove_attachment"></li>'; 
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="requestor" value="<?= $value->get_employerid() ?>" />
                                    <input type="hidden" name="tid" value="<?= $value->get_tid() == 0 ? time() : $value->get_tid() ?>" />
                                    <input type="hidden" name="attachments" id="attachments" />
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Job Type</h4>
                        </div>
                        <div class="col-md-9 job-type">
                            <div class="row">
                                <div class="col-md-12 radio">
                                    <input type="radio" value="hourly" name="job_type"   <?php if($value->get_jobtype() =='hourly') echo 'checked="checked"' ?> ><h4>Hourly - Pay by the hour verify with the work diary</h4>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-md-12 radio">
                                    <input type="radio" value="fixed" name="job_type"
                                             <?php if($value->get_jobtype() =='fixed') echo 'checked="checked"' ?> ><h4>Fixed - Pay by the project requires Detailed specifications</h4>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row marg-top-15">
                        <div class="col-md-12">
                            <h4 class="main_title">Experience Level</h4>
                        </div>
                        <div class="col-md-12 radio left-19">
							<div class="edit_title">
								<input type="radio" name="experience_level" id="experience_level" value="Entry level" <?php if($value->get_exp() =='Entry level') echo 'checked="checked"' ?> />
								<h4 class="bot-0">Entry Level $</h4>
								<br />

								<input type="radio" name="experience_level" id="experience_level" value="Entermediate" <?php if($value->get_exp() =='Entermediate') echo 'checked="checked"' ?> />
								<h4 class="bot-0">Intermediate $$</h4>
								<br />

								<input type="radio" name="experience_level" id="experience_level" value="Experienced" <?php if($value->get_exp() =='Experienced') echo 'checked="checked"' ?> />
								<h4>Experienced $$$</h4>
							</div>
                        </div>
                    </div>
					
                    <div class="row <?php if($value->get_jobtype() !='fixed') echo 'hidden' ?>" id="fixed-control">
                        <div class="col-md-12">
                            <h4 class="main_title">Budget$</h4>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="budget" id="budget" value="<?php echo round($value->get_budget(),2);?>" class="width-80" />
                        </div>
                    </div>
					
                    <div class="row <?php if($value->get_jobtype()=='fixed') echo 'hidden' ?>" id="hourly-control">
                        <div class="col-md-12">
                            <h4 class="main_title">Hours Per week</h4>
                        </div>
                        <div class="col-md-5">
                            <select class="form-control" name="hours_per_week">
                                <option value="not_sure" <?php if($value->get_hrs_perweek() =='not_sure') echo 'selected="selected"'?>>Not Sure</option>
                                <option value="1-9" <?php if($value->get_hrs_perweek() =='1-9') echo 'selected="selected"'?>>1-9</option>
                                <option value="10-19" <?php if($value->get_hrs_perweek() =='10-19') echo 'selected="selected"'?>>10-19 hours</option>
                                <option value="20-29" <?php if($value->get_hrs_perweek() =='20-29') echo 'selected="selected"'?>>20-29 hours</option>
                                <option value="30-39" <?php if($value->get_hrs_perweek() =='30-39') echo 'selected="selected"'?>>30-39 hours</option>
                                <option value="40_plus" <?php if($value->get_hrs_perweek() =='40_plus') echo 'selected="selected"'?>>More than 40 hours</option>
                            </select>
                        </div>
                    </div>
                    <div class="row marg-top-15">
                        <div class="col-md-12">
                            <h4 class="main_title">Job Duration</h4>
                        </div>
                        <div class="col-md-5">
                            <select class="form-control" name="job_duration">
                                <option value="not_sure" <?php if($value->get_duration() =='not_sure') echo 'selected="selected"'?>>Not Sure</option>
                                <option value="more_than_6_months" <?php if($value->get_duration() =='more_than_6_months') echo 'selected="selected"'?>>More than 6 months</option>
                                <option value="3_6_months" <?php if($value->get_duration() =='3_6_months') echo 'selected="selected"'?>>3 - 6 months</option>
                                <option value="1_3_months" <?php if($value->get_duration() =='1_3_months') echo 'selected="selected"'?>>1 - 3 months</option>
                                <option value="less_than_1_months" <?php if($value->get_duration() =='less_than_1_months') echo 'selected="selected"'?>>Less than 1 month</option>
                                <option value="less_than_1_week" <?php if($value->get_duration() =='less_than_1_week') echo 'selected="selected"'?>>Less than 1 week</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br> <br>
                <div class="col-md-12 form-group">
                    <input type="submit" value="Update" class="btn-primary big_mass_active transparent-btn big_mass_button pull-left" id='submitBtn'>
                    <input type="submit" value="Cancel" class="btn-primary transparent-btn big_mass_button pull-left" id='previewBtn'>
                    <img src='<?= site_url(); ?>assets/img/version1/loader.gif' class="form-loader" style="display:none">
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
<script>
    var formSubmitted = false;
    $(document).ready(function() {
       clearForms();
        $('.remove_attachment').click(function(evt) {
            var _this = $(this);
            var formDiscard = _this.data('formdiscard');
            var file = $('#delete_file').val();
            m = confirm("Are you sure you want to delete this post?");  
            if( m == true ) {
               $.post("<?= base_url() . 'jobs/removefile' ?>", "file=" + file + "&tid="+formDiscard);
               $(this).parent().remove()
            } else {
               return false;
            }
        });

        $('#uploader').click(function() {
            $('input[type=file]').trigger('click');
        });

        $('input[type=file]').change(function() {
            var formdata = false;
            if (accepted_file($(this).val())) {
                console.log(this.files[0]);
                formdata = new FormData();
                formdata.append("files", this.files[0]);
                formdata.append("uid", <?= $value->get_employerid() ?>);
                formdata.append("ident", <?= $value->get_tid() == 0 ? time() : $value->get_tid() ?>);
            } else {
                alert('Executable files are NOT allowed!');
                return false;
            }
            console.log(formdata);
            if (formdata) {
                $.ajax({
                    url: "<?= base_url() ?>jobs/upload",
                    type: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        console.log(res);
                        switch (res) {
                            case "0":
                                alert('There was an error uploading the file, please try again!');
                                break;
                            case "1":
                                alert('You have already added that file!');
                                break;
                            case "-1":
                                alert('File size should NOT be greater than 15MB!');
                                break;
                            default:
                                var fileWrapper = $("<li>");
                                var removeButton = $("<img src=\"<?= base_url() ?>assets/img/delete_icon.gif\" alt=\"Remove\" title=\"Remove\" style=\"margin-left: 5px;\" />");
                                removeButton.click(function() {
                                    if (confirm("Are you sure you want to delete: \n" + $(this).parent().text() + " ?")) {
                                        $.post("<?= base_url() . 'jobs/removefile' ?>", "file=" + $.trim($(this).parent().text()) + "&tid=<?= $value->get_employerid() ?>/<?= $value->get_tid() == 0 ? time() : $value->get_tid() ?>");
                                        $(this).parent().remove();
                                    }
                                });
                                fileWrapper.html(res);
                                fileWrapper.append(removeButton);
                                $('#lists').append(fileWrapper);
                                break;
                        }
                    }
                });
            }
        });

        $('#jobEdit').submit(function() {
            var f = '"';
            $('#lists').children().each(function() {
                f = f + $.trim($(this).text()) + '","';
            });
            $('#attachments').val(f.substring(0, f.length - 2));
            formSubmitted = true;
        });
    });
    function form_valid(f) {
        formSubmitted = f;
    }

    function accepted_file(filename) {
        var ext = filename.split('.').pop().toLowerCase();
        if (ext !== 'exe') {
            return true;
        } else
            return false;
    }

    function clearForms()
    {
        var i;
        for (i = 0; (i < document.forms.length); i++) {
            document.forms[i].reset();
        }
    }
</script>