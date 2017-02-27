<style type="text/css">
.form-group label{
    font-size: 17px;
    font-family: 'Calibri';
    font-weight: 800;
}
.confirm_title{margin-left: 37px;}
</style>

<section id="big_header" style="margin-top: 40px; margin-bottom: 40px; height: auto;border: 1px solid #ccc;background: #fff;border-radius: 4px;margin-left: 14px;width: 957px;">
    <div class="container"> 
        <div class="row">
            <div class="col-md-7 col-md-offset-0 page-title">
                <h4 class="confirm_title">Preview and Post</h4>
            </div>
        </div>
        <div class="row">

            <form id="basicg" method="post"
                  action="<?php echo site_url("jobs/savePostSession"); ?>">

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Title</label>
                        </div>
                        <div style="font-size:16px;font-weight: bold;" class="col-md-9"><?php echo ucfirst($data['title']);?></div>
                    </div>


                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Job Category</label>
                        </div>
                        <div style="font-size:16px;" class="col-md-9"><?php 
                        $this->db->where('subcat_id', $data['category']);
                        $q = $this->db->get('job_subcategories');
                        $record = $q->row();
                        echo ucfirst($record->subcategory_name);?></div>
                    </div>
                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Required Skills</label>
                        </div>
                        <div class="col-md-9 skills">
                            <?php
                            if (isset($data['skills']) && !empty($data['skills'])) {
                                $skills =  is_string($data['skills']) ? explode(' ', $data['skills']) : $data['skills'];

                                foreach ($skills as $skill)
                                    echo "<span>$skill</span> ";
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Job Description</label>
                        </div>
                        <div style="font-size:16px;line-height: 25px;" class="col-md-9">
                            <?php echo $data['job_description'];?>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Attach File</label>
                        </div>
                        <div style="font-size:16px;" class="col-md-9"><a href='<?php echo $data['path']; ?>' target="_blank">Click to view</a></div>
                    </div>
                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Job Type</label>
                        </div>
                        <div class="col-md-9 page-label">
                            <div style="font-size:16px;font-weight: bold;" class="row">
                                <div class="col-md-3"><?php echo ucfirst($data['job_type'])?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Experience Level</label>
                        </div>
                        <div style="font-size:16px;" class="col-md-9"><?php echo ucfirst($data['experience_level'])?></div>
                    </div>
                </div>

                <div class="col-md-9 form-group" id="hourly-control">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Hours Per week</label>
                        </div>
                        <div style="font-size:16px;" class="col-md-9"><?php 
                        echo ucfirst($data['hours_per_week'])?></div>
                    </div>
                </div>

                <div class="col-md-9 form-group ">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Job Duration</label>
                        </div>
                        <div style="font-size:16px;" class="col-md-9"><?php echo str_replace('_',' ',$data['job_duration'])?></div>
                    </div>
                </div>

                <br> <br>

                <div style="margin-bottom: 30px;" class="col-md-12 form-group">
                    <input type="hidden" name="submitbtn" value="1" id='buttonVal'/>
                    <input style="margin-left: 188px;" style="margin-left: 0px;" type="submit" value="Publish"   class="btn btn-primary form-btn big_mass_active"> 
                    <input style="margin-left: 30px;" type="button" value="Cancel"  class="btn btn-primary form-btn" onclick="window.history.go(-1);">
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
</script>
