<p class="result-msg"></p>
<section id="big_header" class="custom_home">
    <?php 
    if ($this->session->userdata('type') == '1') {
        if(!empty($clientend)) { ?>
        <div class="row marg-neg">
            <div class="bordered-alert text-center ack-box top-alert">
                <h4 class="h4negtop">! You have  <a href="<?php echo base_url() ?>jobs/client_endjobnotification" class="show_notification"> <?= count($clientend) ?> ended contract - waiting for feedback</a></h4>
            </div>
        </div>
        <?php }

        if ($status == 0) { ?>
            <div class="row marg-alert">
                <div class="col-md-10 bordered-alert text-center ack-box mid-alert">
                    <h4 class="h4negtop-red">! Your Account has been Suspended</h4>
                </div>
            </div>
        <?php }
        
    } else if ($this->session->userdata('type') == '2'){
        if (!empty($freelancerend)) { ?>
            <div class="row ">
                <div class="col-md-10 bordered-alert text-center ack-box top-alert">
                    <h4 class="h4negtop">! You have  <a href="<?php echo base_url() ?>jobs/freelancer_endjobnotification" class="show_notification"> <?= count($freelancerend) ?> ended contract - waiting for feedback</a>                                        
                    </h4>
                </div>
            </div>
        <?php }
        
        if ($status == 0) { ?>
            <div class="row marg-alert">
                <div class="col-md-10 bordered-alert text-center ack-box mid-alert">
                    <h4 class="h4negtop-red">! Your Account has been Suspended</h4>
                </div>
            </div>
        <?php }
    } ?>

    <div class="search-top">
        <div class="row marg-top-20">
            <form id="freelacer-search" action="<?= site_url() ?>freelancers-search" method="GET">
                <div class="col-md-10 col-lg-10 col-sm-10 col-xs-12 no-pad search-cont">
                    <input type="text" name="q" class="form-control search-field" placeholder="Find freelancers" id="jobsearch" value=""/> 
                    <i aria-hidden="true" class="fa fa-search search-btn search-freelancer custom_btn"></i>
                </div>
                <div class="col-md-2 col-lg-2 col-sm-2 col-xs-12 no-pad pad-top-xs">
                    <a class="btn btn-block btn-primary post-job" href="<?php echo site_url('post-job'); ?>">
                        Post a job
                    </a>
                </div>
            </form>

        </div>
    </div>

        <div class="row">
        <?php if ($this->session->flashdata('msg')) { ?>
            <div class="alert alert-success"><?= $this->session->flashdata('msg') ?></div>
        <?php } ?>
        <?php foreach ($records as $value) { ?>
            <div class="marg-neg">
                <div class="bordered-client white-box">
                    <div class="row"> 
                        <div class="col-md-7 col-sm-6 col-xs-6">
                            <div class="job-activity-title margin-10">
                                <label class="jobTitle">
                                    <a href="<?= site_url('jobs/applications/' . $value['job_id']) ?>"><?= $value['job_type'] . " - " . $value['title'] ?></a></label>

                                <p class="hidden-lg hidden-md"><?= $value['job_created'] ?><br></p>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-6 no-pad">
                            <div class="row"> 
                                <div class="col-md-4 col-sm-4 col-xs-12 nopadding">

                                    <label class="gray-text">
                                        <a href='<?= site_url('jobs/' . url_title($value['title']) . '/' . $value['job_id']); ?>' class="co">View Job Posting <span class='glyphicon custom_client_icon glyphicon-info-sign co'></span></a>
                                    </label>
                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-12 nopadding">
                                    <label class="gray-text">
                                        <span class="hidden-xs hidden-sm margin-10-left">&nbsp;</span>
                                        <a href='<?= site_url('edit-jobs/' . $value['job_id']); ?>' class="co">Edit Posting <span class='glyphicon custom_client_icon glyphicon-edit co'></span>
                                        </a>
                                    </label>
                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-12 nopadding">
                                    <label class="gray-text"> 
                                        <a href="javascript:void(0)" id="endpost" onclick="Confirmremove(<?= base64_decode($value['job_id']) ?>);" class="co">
                                            Remove Posting
                                            <span class='glyphicon custom_client_icon glyphicon-remove co'></span>
                                        </a>
                                    </label>
                                </div>                    
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-3 hidden-xs hidden-sm">
                            <div><?= $value['job_created'] ?></div>
                        </div>


                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <ul class="client-job-activity pull-right" >
                                <li>
                                    <a href="<?= site_url('jobs/applications/' . $value['job_id']) ?>">Applications (<?= $value['applicants'] ?>)</a> 
                                </li>
                                <li>
                                    <a href="<?= site_url('jobs/interviews/' . $value['job_id']) ?>">Interviews (<?= $value['interviews'] ?>)</a>  
                                </li>
                                <li>
                                    <a href="<?= site_url('offered?job_id=' . $value['job_id']) ?>">Offered (<?= $value['offers']; ?>)</a>  
                                </li>
                                <li>
                                    <a href="<?= site_url('hired?job_id=' . $value['job_id']) ?>">Hired (<?= $value['hires']; ?>)</a>   
                                </li> 
                                <li>
                                    <a href="<?= site_url('declined?job_id=' . $value['job_id']) ?>" class="last-link">Declined (<?= $value['rejects']; ?>)</a>  
                                </li>

                            </ul>
                        </div>
                    </div>

                </div> 
            </div>
            <br/>
<?php } ?>
    </div>
</section>
<script type="text/javascript">
    $('.search-freelancer').click(function () {
        var keywords = $('#jobsearch').val();
        if (keywords.length > 0) {
            $('#freelacer-search').submit();
        }
    });

    function Confirmremove(id) {

        var x = confirm("Are you sure you want to Remove the post?");

        if (x) {
            $.post("<?php echo site_url('jobs/removepost'); ?>", {form: id}, function (data) {
                if (data.success) {
                    $('.result-msg').html('You have successfully Remove the Post');
                    $(".result-msg").show().delay(5000).fadeOut();
                    $('html, body').animate({scrollTop: $(".result-msg").offset().top}, 2000);
                    setTimeout(function () {
                        window.location = "<?php echo base_url(); ?>jobs-home";
                    }, 5000);

                } else {
                    alert('Opps!! Something went wrong.');
                }

            }, 'json');
        }
    }
</script>