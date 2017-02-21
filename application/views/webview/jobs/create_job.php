<link rel="stylesheet" href="<?php echo site_url("assets/css/chosen.css"); ?>">
<script src="<?php echo site_url("assets/js/chosen.jquery.js"); ?>"></script>
<section id="big_header" style="margin-top: 40px; margin-bottom: 40px; height: auto;">
    <div style="border:1px solid #ccc;" class="container white-box-feed">
        <div class="row">
            <div style="margin-bottom: 15px;" class="col-md-7 col-md-offset-0 page-title">
                <h1 style="color:black">Create your job</h1> <br/>
                <h5 style="margin-top: -14px;" class="page-sub-title">Post a project for free and start getting receiving proposals within minutes</h5>
            </div>
        </div>
        <div class="row">
            <div class='form-msg'></div>
            <form class="custom_job_post_form" id="jobCreate" method="post" action="" enctype="multipart/form-data">
                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Title</h4>
                        </div>
                        <div class="col-md-12">
                           <div class="edit_title">
                                <input type="text" value="" name="title" class="form-control" id="title">
                           </div>
                        </div>
                    </div>
				
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Select Category</h4>
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
                                        <optgroup label="<?php echo $category->category_name; ?>" data-id = "<?php echo $category->cat_id;?>">
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

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Required Skills</h4>
                        </div>
                        <div class="col-md-12">
                          <div class="edit_title">
                               <div class="input_skills">
                                 
                             <select class="choose-skills" name="skills[]"  data-placeholder="Skills" style="width:100%;" multiple>
                                <?php foreach($skillList as $skill){
                                  ?>
                                <option value="<?php echo $skill->skill_name; ?>"><?php echo $skill->skill_name; ?></option> 
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
                           <div class="edit_title">
                               <textarea name="job_description" id="job_description"
                                      class="form-control" rows="5"></textarea>
                           </div>
                        </div>
                     </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Attach File</h4>
                        </div>
                        <div class="col-md-12">
                          <div style="margin-bottom: 20px;margin-top: -2px;margin-left: -8px;" class="edit_title">
                              <div class="upload_file">
                                <input type="file" value="" name="userfile" class="upload"
                                   id="user_file">
                           </div>
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="margin-bottom: 0;" class="main_title">Job Type</h4>
                        </div>
                        <div class="col-md-12" style="margin-top: 14px;">
                           <div class="edit_title">
                               <div class="row" style="margin-left: 3px;">
                                <div class="col-md-12 radio">
                                    <input type="radio" value="hourly" name="job_type"
                                           checked="checked"><h4>Hourly - Pay by the hour verify with the work diary</h4>
                                </div> 
                            </div>

                            <div class="row" style="margin-left: 3px;">
                                <div class="col-md-12 radio">
                                    <input type="radio" value="fixed" name="job_type" ><h4>Fixed - Pay by the project requires Detailed specifications</h4>
                                </div> 
                            </div>
                           </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Experience Level</h4>
                        </div>
                        <div style="margin-left: 19px;" class="col-md-12 radio">
                           <div class="edit_title">
                            <input type="radio" name="experience_level" id="experience_level" value="Entry level" checked/>
                            <h4 style="margin-bottom: 0;">Entry Level $</h4>
							<br />

                            <input type="radio" name="experience_level" id="experience_level" value="Entermediate" />
                            <h4 style="margin-bottom: 0;">Intermediate $$</h4>
							<br />

                            <input type="radio" name="experience_level" id="experience_level" value="Experienced" />
                            <h4>Experienced $$$</h4>
                           </div>
                        </div>
                    </div>

                    <div id="fixed-control" class="row hidden">
                        <div class="col-md-12">
                            <h4 class="main_title">Budget $</h4>
                        </div>
                        <div class="col-md-12">
                           <div class="edit_title">
                                <input style="width: 80px;" type="text" name="budget" id="budget" value="" class="" />
                           </div>
                        </div>
                    </div>

                    <div  id="hourly-control" class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Hours Per week</h4>
                        </div>
                        <div class="col-md-5">
                           <div class="edit_title">
                               <select class="form-control" name="hours_per_week">
                                <option value="not_sure">Not Sure</option>
                                <option value="1-9">1-9 hours</option>
                                <option value="10-19">10-19 hours</option>
                                <option value="20-29">20-29 hours</option>
                                <option value="30-39">30-39 hours</option>
                                <option value="40_plus">More than 40 hours</option>
                            </select>
                           </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="main_title">Job Duration</h4>
                        </div>
                        <div class="col-md-5">
                           <div class="edit_title">
                                <select class="form-control" name="job_duration">
                                <option value="not_sure">Not Sure</option>
                                <option value="more_than_6_months">More than 6 months</option>
                                <option value="3_6_months">3 - 6 months</option>
                                <option value="1_3_months">1 - 3 months</option>
                                <option value="less_than_1_months">Less than 1 month</option>
                                <option value="less_than_1_week">Less than 1 Week</option>
                            </select>
                           </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 text-left">
                           <div class="create_job_btn">
                                <input type="hidden" name="submitbtn" value="1" id='buttonVal'/>
                            <input type="submit" value="Publish" class="btn my_btn publish_btn" id='submitBtn'>
                            <input type="submit" value="Preview" class="btn my_btn preview_btn" id='previewBtn'>
                            <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
                           </div>
                        </div>  

                    </div>					
                </div>
				
				
				<div class="col-md-3">
					<div class="custom_post_job_right_cont">
						<div class="title">
							<i class="fa fa-comments pull-left"></i>
							<h4>Client Tips</h4>
						</div>
						<div class="content">
							<ol>
								<li>Post your Project for Free.</li>
								<li>Receive Proposals from skilled and trusted Freelancers, by adding descriptions and skills required.</li>
								<li>Receive Proposals from skilled and trusted Freelancers, by adding descriptions and skills required.</li>
								<li>Award your project to Freelancers based on their proposal, proᶠle and feedback.</li>
							</ol>
						</div>
					</div>
					
					<div class="custom_post_job_right_cont">
						<div class="title">
							<i class="fa fa-briefcase pull-left"></i>
							<h4>Post Project</h4>
						</div>
						<div class="content">
							<p>Quickly post your project and set your budget. The project will be available for biding on truelancer instantly.</p>
						</div>
					</div>
					
					<div class="custom_post_job_right_cont">
						<div class="title">
							<i class="fa fa-check-square-o pull-left"></i>
							<h4>Shortlist and Compare Freelancers</h4>
						</div>
						<div class="content">
							<p>First shortlist, compare and select bids on price, ratings and online presence. Each freelancer has there own proᶠle that shows what past users have said about there work.</p>
						</div>
					</div>
					
					<div class="custom_post_job_right_cont">
						<div class="title">
							<i class="fa fa-money pull-left"></i>
							<h4>Release Payments</h4>
						</div>
						<div class="content">
							<p>We only release payment when 100% satisᶠed with the work provided. Love the work or get your money back.</p>
						</div>
					</div>
					
					<div class="custom_post_job_right_cont">
						<div class="title">
							<i class="fa fa-question-circle pull-left"></i>
							<h4>Does it cost to post a project?</h4>
						</div>
						<div class="content">
							<p>No, it free of cost. You only pay to Freelancer the amount for the Work Done.</p>
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
margin-left: 0px;
margin-top: 5px;
}
.edit_title {
	margin-left: -70px;
}
.main_title {
	margin-left: 0;
}
.custom_job_post_form .edit_title {
	margin-left: 0;
}
.row .form-group {
    margin-left: 0;
}
.white-box-feed{padding-left:40px;}
</style>