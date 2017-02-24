<?php
//,'target'=>'updatePorfolio'
    $this->load->view("webview/includes/autocomplete-skills");
    $attributes = array('class' => 'form-horizontal portfolio-form','name'=>'portfolio-form','target'=>'updatePorfolio','id'=>'updatePorfolio');
    echo form_open_multipart('profile/update-portfolio', $attributes);
?>
<link rel="stylesheet" href="<?php echo site_url("assets/css/chosen.css"); ?>">
<script src="<?php echo site_url("assets/js/chosen.jquery.js"); ?>"></script>
<input name="id" value="<?php if(isset($id) && $id > 0) echo base64_encode($id); ?>" type="hidden"/>
<input name="img" value="<?php if(isset($thumnail_image) && strlen($thumnail_image) > 0) echo base64_encode($thumnail_image); ?>" type="hidden"/>
    <div class="col-md-1 col-sm-1"></div>
    <div class="col-md-11 col-sm-11">
        <div class="form-group">
        <div class="col-md-9 col-xs-12">
            <span>Project Title <small>(mandatory)</small></span>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-9 col-xs-12">
            <input required="" type="text" name="projectTitle" value="<?php if(isset($project_title) && strlen($project_title) > 0) echo $project_title; ?>" class="form-control inpt" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-9 col-xs-12">
            <span>Project Overview <small>(mandatory)</small></span>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-9 col-xs-12">
            <textarea required="" rows="6" cols="" name="projectOverview" class="form-control txtar"><?php if(isset($project_overview) && strlen($project_overview) > 0) echo $project_overview; ?></textarea>
        </div>
    </div>    
    <div class="form-group">
        <div class="col-md-9 col-xs-12">
            <span>Project Category </span>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-9 col-xs-12">
            <select name="projectCategory" class="select form-control slt">
                <option value="">Select</option>
                <?php
                if(!isset($project_overview)){
                    $project_category = 0;
                }
                if(isset($projectCateList) && !empty($projectCateList)){
                    foreach ($projectCateList as $cat) {
                        if($cat ->cat_id == $project_category){
                            $selected = "selected=selected";
                        }else{
                            $selected = "";
                        }
                ?>
                <option <?php echo $selected; ?> value="<?php echo $cat->cat_id ?>"><?php echo $cat->category_name ?></option>
                <?php
                    } 
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-9 col-xs-12">
            <span>Project Completion Date(yyyy-mm-dd)</span>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-9 col-xs-12">
            <input type="text" name="projectCompletionDate" value="<?php if(isset($completion_date) && strlen($completion_date) > 0) echo $completion_date; ?>" class="form-control datepicker inpt" onclick="datePicker()"/>
        </div>
    </div>   
    <div class="form-group">
        <div class="col-md-9 col-xs-12">
            <span>Skills <small>(use coma separated words)</small></span>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-9 col-xs-12">
            <select class="choose-skills" name="projectSkillsUsed[]"  data-placeholder="Skills" style="width:515px;" multiple>
                <?php foreach ($port_skills as $item) { ?>
                    <option value="<?php echo $item['skill_name']; ?>" selected><?php echo $item["skill_name"]; ?></option> 
                <?php } ?>

                <?php foreach($skillList as $key => $skill){
                  ?>
                <option value="<?php echo $skill->skill_name; ?>" <?php echo (in_array($skill->skill_name, $repeated)) ?  'disabled' : '' ;?>><?php echo $skill->skill_name; ?></option> 
                <?php 
                }?>
                
            </select>
            <!-- <input required="" type="text" name="projectSkillsUsed" value="<?php if(isset($skills) && strlen($skills) > 0) echo $skills ?>" class="form-control autocomplete inpt" /> -->
        </div>
    </div>    
     <div class="form-group">
        <div class="col-md-9 col-xs-12"><span>Project URL </span></div>
        <div class="clearfix"></div>
        <div class="col-md-9 col-xs-12">
            <input type="text" value="<?php if(isset($project_url) && strlen($project_url) > 0) echo $project_url; ?>" name="projectURL" value="" class="form-control inpt" />
        </div>
    </div>   
    <div class="form-group">
        <div class="col-md-6 col-xs-12">
            <div class="row">
                <div class="col-md-12"><span>Project Thumbnail Image<small>(jpeg|jpg are allowed and must be bellow 600X300)</small></span></div>
                <div class="clearfix"></div>
                <div class="col-md-12 col-xs-12">
                    <input class="form-control" type="file" onchange="uploadDatapath(this)" name="portfolioFile" id="file-upload" accept="image/*" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label class="col-md-12 align-center">Preview</label>
            <div class="col-md-12" id="image_preview">
                <img style="max-height: 250px" id="previewing" class="img-responsive" src="<?php if(isset($thumnail_image) && strlen($thumnail_image) > 0 ) echo site_url('uploads/portfolio/'.$thumnail_image); else echo site_url('assets/profile/img/noimage.jpg')?> "/>
            </div>
        </div>
    </div> 
    <div class="form-group">
        <div class="col-md-4">
            <input id="submit-portfolio" type="button" onclick="submitPortfolio(event, this)" value="Save" class="btn btn-primary" />
            <input type="button" value="Cancel" class="btn btn-default" onclick="closeModal()"/>
        </div>
        <div class="col-md-8 sys-message"> </div>
    </div>
   </form>
   <iframe id="updatePorfolio" src="<?php echo site_url("profile/update-portfolio") ?>" name="updatePorfolio" height="0" width="0" frameborder="0" scrolling="no" style="display:none"></iframe>
</div>
    <?php
    $this->load->view("webview/includes/autocomplete-skills");
    ?>
<style>
    .search-field {
        border: none;
        height: auto;
    }
</style>
<script type="text/javascript">
    // Added by Armen start
    $(".choose-skills").chosen(); 
    $('.chosen-drop').hide();
    $(".chosen-container").bind('keyup',function(e) {
        $('.chosen-drop').show();
    });
    // added by Armen end
   $(function() {
        $(".datepicker").click(function() {
            $(this).datepicker().datepicker( "show" )
        });
    });

</script>

