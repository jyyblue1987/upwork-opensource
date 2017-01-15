<section id="big_header" style="margin-top: 50px; margin-bottom: 50px; height: auto;">
    <div class="container"> 
        <div class="row">
            <div class="col-md-7 col-md-offset-0 page-title">
                <h1>Preview and Post</h1>
                <br />
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
                        <div class="col-md-9"><?php echo ucfirst($data['title']);?></div>
                    </div>


                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Select Category</label>
                        </div>
                        <div class="col-md-9"><?php 
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
                            if(isset($data['skills']) && !empty($data['skills']))
                            {
                            $skills=  explode(' ', $data['skills']);
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
                        <div class="col-md-9">
                            <?php echo $data['job_description'];?>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Upload File</label>
                        </div>
                        <div class="col-md-9"><a href='<?php echo $data['path']; ?>' target="_blank">Click to view</a></div>
                    </div>
                </div>

                <div class="col-md-9 form-group">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Job Type</label>
                        </div>
                        <div class="col-md-9 page-label">
                            <div class="row">
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
                        <div class="col-md-9"><?php echo ucfirst($data['experience_level'])?></div>
                    </div>
                </div>

                <div class="col-md-9 form-group" id="hourly-control">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Hours Per week</label>
                        </div>
                        <div class="col-md-9"><?php 
                        echo ucfirst($data['hours_per_week'])?></div>
                    </div>
                </div>

                <div class="col-md-9 form-group ">
                    <div class="row">
                        <div class="col-md-3 page-label">
                            <label>Job Duration</label>
                        </div>
                        <div class="col-md-9"><?php echo str_replace('_',' ',$data['job_duration'])?></div>
                    </div>
                </div>

                <br> <br>

                <div class="col-md-12 form-group">
                    <input type="hidden" name="submitbtn" value="1" id='buttonVal'/>
                    <input type="submit" value="Publish"   class="btn btn-primary form-btn"> 
                    <input type="button" value="Cancel"  class="btn btn-primary form-btn" onclick="window.history.go(-1);">
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
