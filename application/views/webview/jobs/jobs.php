<style>
    label.label-side{
        font-size: 14px;
    }
    span.rating-badge {
        background: #F77D0E none repeat scroll 0 0;
        border-radius: 2px;
        color: #fff;
        padding: 2px 4px 2px 5px;
        font-size: 12px;
        float: left;
    }
    .hire_cover_letter span {
        font-size: 15px;
        font-weight: normal;
    }
    .decline {
        margin-bottom: 20px;
    }
    .review_ratting {
        margin-left: 15px;
    }
</style>
<p class="result-msg"></p>
<section id="big_header">
    <div class="container">
        <div class="row">
            <?php if ($emp->get_status() == 0) { ?>
                <div class="alert alert-warning">
                    <strong>Warning!</strong> The job does not exist.
                </div>
            <?php } ?>
            <div class="col-md-9 col-md-offset-0 white-box job-cont">
                <?php $emp->get_type() == '1' ? $marginClass = 'margin-top' : $marginClass = ''; ?>
                <?php if ($emp->get_userid() == $this->session->userdata('id')) { ?>
                    <div class="col-md-3 col-sm-6 col-xs-6" style="float: right; font-size: 11px; width: 300px;">
                        <div class="row"> 
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <label class="gray-text">
                                    <span class="hidden-xs hidden-sm margin-10-left">&nbsp;</span>
                                    <a href='<?= site_url('edit-jobs/' . base64_encode($value->get_jobid())); ?>'style="color: #37A000">Edit Posting <span class='glyphicon custom_client_icon glyphicon-edit co'></span>
                                    </a>
                                </label>
                            </div>

                            <div class="col-md-5 col-sm-4 col-xs-12">
                                <label class="gray-text"> 
                                    <a href="javascript:void(0)" id="endpost" onclick="Confirmremove(<?= base64_encode($value->get_jobid()) ?>);" class="co">
                                        Remove Posting
                                        <span class='glyphicon custom_client_icon glyphicon-remove co'></span>
                                    </a>
                                </label>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row <?php echo $marginClass; ?>">
                    <div class="col-md-10 col-xs-6 page-label">
                        <h1 class="job-title cos_job-title">
                            <?php echo $value->get_title(); ?>
                        </h1>
                    </div>
                    <div class="col-md-2 col-xs-6 page-label">
                        <span class="pull-right marg-top-neg">
                            <?php echo $time ?>
                        </span>
                    </div>
                </div>
                <div class="jobdes-bordered-wrapper">
                    <div class="row jobdes-bordered page-label">
                        <div class="col-md-3 text-center">
                            <label class="lab-res">
                                Job Type
                            </label> <br /> 
                            <span><?php echo ucfirst($value->get_jobtype()) ?></span>
                        </div>
                        <div class="col-md-3 text-center page-label">
                            <label class="lab-res">  
                                <?= $value->get_jobtype() == 'hourly' ? "Hourly Per week" : 'Budget $'; ?>
                            </label>
                            <br />
                            <span>
                                <?= $value->get_jobtype() == 'hourly' ? $value->get_hrs_perweek() : '$' . round($value->get_budget(), 2); ?>
                            </span>
                        </div>
                        <div class="col-md-3 text-center page-label">
                            <label class="lab-res">Job Duration</label><br /> <span><?php echo $value->get_duration() ?></span>
                        </div>

                        <div class="col-md-3 last-div text-center page-label">
                            <label class="lab-res">Experience Level</label><br /> <span><?php echo ucfirst($value->get_exp()); ?></span>
                        </div>

                    </div>
                </div>    
                <div class="row margin-top margin-top-15">
                    <div class="col-md-2">
                        <label class="job-cat">Job Category</label>
                    </div>
                    <div class="col-md-10 margin-top-4">
                        <?php echo $value->get_subcategory(); ?>
                    </div>
                </div>
                <div class="row req-skills margin-top page-label margin-top-1">
                    <div class="col-md-2">
                        <label class="lab-skills">Skills</label>
                    </div>

                    <div class="col-md-10 skills page-label">
                        <div class="custom_user_skills">
                            <?php
                            if (isset($skills) && !empty($skills)) {
                                foreach ($skills AS $key => $_skill) {
                                    echo "<span> " . $_skill['skill_name'] . "</span> ";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row margin-top page-label margin-top-5">
                    <div class="col-md-9">
                        <label class="lab-details">Details</label>
                    </div>
                    <div class="col-md-12 text-justify page-label div-details"><?php echo $value->get_jobdesc(); ?></div>
                </div>

                <?php if ($value->get_attachments()[0] != "") { ?>
                    <div class="row margin-top page-label margin-top-5">
                        <div class="col-md-9">
                            <label class="lab-details">Attachments</label>
                        </div>
                        <div class="col-md-12 text-justify page-label div-details">
                            <?php
                            foreach ($value->get_attachments() AS $attachment) {
                                echo '<a href="' . site_url() . 'jobs/download?dir=' . $value->get_employerid() . '/' . $value->get_tid() . '&file=' . $attachment . ' ">' . $attachment . '</a><br>';
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="jobdes-bordered-wrapper">
                    <div class="row jobdes-bordered page-label">
                        <div class="col-md-4 text-center">
                            <label class="lab-res">Proposals</label> <br /> <span>
                                <?= $applicants; ?>
                            </span>
                        </div>

                        <div class="col-md-4 text-center page-label">
                            <label class="lab-res">Interviewing</label><br /> <span><?= $interviews; ?> </span>
                        </div>

                        <div class=" last-div col-md-4 text-center page-label">
                            <label class="lab-res">Hired</label><br /> <span>
                                <?php echo $hires; ?>
                            </span>
                        </div>

                    </div> 
                </div>
                <div class="buttonsidethree">
                    <div class="row margin-top page-label">
                        <div class="col-md-6 col-sm-6">
                            <div class="buttonsidethreeleft">
                                <h2 class="job-his">Job History</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (!empty($job_history)) {
                    foreach ($job_history as $key => $job_data) {
                        ?>
                        <div class="buttonsidethree">
                            <div class="row  page-label">
                                <div class="col-md-8 col-sm-6">
                                    <div class="buttonsidethreeleft">
                                        <p class="title-job-p"><?= $job_data['title'] ?></p>
                                        <h3 class="job-det">
                                            <?php echo date(' M j, Y ', strtotime($job_data['start_date'])); ?> 

                                            <?php if ($job_data['job_status'] == 1) {
                                                echo " - " . date(' M j, Y ', strtotime($job_data['end_date']));
                                            } ?>
                                        </h3>
                                        <p class="job-comment">
                                            <?php
                                            if ($job_data['job_status'] == 1) {
                                                if (!empty($job_data['comment'])) {
                                                    echo $job_data['comment'];
                                                    ?>
                                                </p>
                                                <p class="job-feedback">
                                                <?php
                                                }
                                            } else {
                                                echo "Job in progress";
                                            }
                                            ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6  text-right pull-right">
                                        <?php if ($emp->get_status() == 1) { ?>
                                        <div class="buttonsidethreeright margin-right-none">
                                            <?php } else { ?>
                                            <div class="buttonsidethreeright pull-right pad-0-margin-0">
                                            <?php } ?>

                                            <?php
                                            if ($job_data['job_type'] == "fixed") {
                                                if ($job_data['job_status'] == 1) {
                                                    if (!empty($job_data['rating'])) {
                                                        ?>

                                                        <div title="Rated <?= $job_data['rating']; ?> out of 5" class="star-rating pull-right" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                            <span style="width:<?= $job_data['rating_result']; ?>%">
                                                                <strong itemprop="ratingValue"><?= $job_data['rating']; ?></strong> out of 5
                                                            </span>
                                                        </div>
                                                        <span class="rate pull-right"><?= $job_data['rating']; ?></span>
                                                <?php } else { ?>
                                                        <div title="Rated 0 out of 5" class="star-rating pull-right" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                            <span class="width0">
                                                                <strong itemprop="ratingValue">0</strong> out of 5
                                                            </span>
                                                        </div>
                                                        <span class="rate pull-right rate-amount">0.00</span>
                                                <?php }
                                                } ?>

                                                <h3 style='' class="paid">Paid $<?= $job_data['pay'] ?></h3>
                                                <h4></h4>

                                            <?php
                                            } else {
                                                if ($job_data['job_status'] == 1) {
                                                    if (!empty($job_data['rating'])) {
                                                        ?>
                                                        <div title="Rated <?= $job_data['rating']; ?> out of 5" class="star-rating pull-right" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                            <span style="width:<?= $job_data['rating_result']; ?>%">
                                                                <strong itemprop="ratingValue"><?= $job_data['rating']; ?></strong> out of 5
                                                            </span>
                                                        </div>
                                                        <span class="rate pull-right"><?= $job_data['rating']; ?></span>
                                                    <?php } else { ?>
                                                        <div title="Rated 0 out of 5" class="star-rating pull-right" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                            <span class="width0">
                                                                <strong itemprop="ratingValue">0</strong> out of 5
                                                            </span>
                                                        </div>
                                                        <span class="rate pull-right">0.00</span>
                                                        <?php }
                                                    } ?>

                                                <h6 class="margin-top-8">
                                                <?php echo $job_data['total_work'] . ' Hours'; ?>

                                                </h6>
                                                <h3 class="job-data">
                                                <?php echo '$' . $job_data['total_price']; ?> 
                                                </h3>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } else { ?>	
                        <div class="margin-top page-label">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="buttonsidethreeleft">
                                        Yet more Jobs to Go 
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-3 no-pad">
                    <?php
                    if ($this->session->userdata('type') == '2') {
                        if ($is_applied != 0) {
                            ?>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-2">
                                    <div class="alert alert-warning">
                                        <strong>You have already applied for this job.</strong>
                                    </div>
                                </div>
                            </div>

                    <?php } else { ?>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-2">
                                    <?php if ($f_active == 0) { ?>
                                        <a class="pad-left" href="javascript:void(0)"><button type="button" class="btn btn-primary">Proposal is in Hold</button></a>
                                    <?php } elseif ($proposals >= 30) { ?>
                                        <div class="alert alert-warning">
                                            <strong>Warning!</strong> You reach your monthly proposals limit.
                                        </div>
                            <?php } else { ?>
                                        <a style="padding-left: 0;" href="<?php echo site_url("jobs/" . url_title($value->get_title()) . '/' . base64_encode($value->get_jobid()) . '/apply'); ?>"><button type="button" class="btn btn-primary custon_send_pro send-pro">Send a Proposal</button></a>
                            <?php } ?>
                                </div>
                            </div>
                    <?php }
                } ?>
                    <div class="row client-activity">
                        <div style="" class="col-md-10 col-md-offset-2 right-section">
                            <div class="row margin-top-2">
                                <div class="col-md-12">
                                    <?php if ($emp->is_active() == 1 && $payment_set) { ?>
                                        <i style="" class="fa fa-check-circle circ-check"></i>
                                        <?php
                                    } else {
                                        ?>
                                        <i style="" class="fa fa-minus-circle circ-min"></i>
                                     <?php } ?>
                                    <label class="pad-25"><?php echo ucfirst($emp->get_fname()) ?></label>
                                </div>
                            </div>
                            <div style="" class="row margin-top-2 border-bottom right-cont">
                                <div style="margin-top:1px;" class="review_ratting">
                                <?php if ($rating != 0) { ?>
                                        <span class="rating-badge"><?= number_format((float) $rating, 1, '.', ''); ?></span>
                                        <div title="Rated <?= $rating; ?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em; margin-top:-5px; color:#DEDEDE; width: 4em">
                                            <span style="width:<?= (( $rating / 5) * 100) ?>% ; margin-top:0px;">
                                                <strong itemprop="ratingValue"><?= $rating; ?></strong> out of 5
                                            </span>
                                        </div>
                                <?php } else { ?>
                                        <span class="rating-badge">0.0</span>
                                        <div title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em; margin-top:-5px;">
                                            <span style="width:0% ;margin-top:-5px;">
                                                <strong itemprop="ratingValue">0</strong> out of 5
                                            </span>
                                        </div>
                                        <?php } ?>
                                </div>
                            </div>
                            <div style="" class="row margin-top-2 border-bottom job-posted">
                                <div class="col-md-12">
                                    <label style="" class="label-side">
                                    <?php
                                    if (!empty($jobs_posted)) {
                                        echo $jobs_posted;
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                    <span class="span-side">Jobs Posted</span></label>
                                </div>
                            </div>
                            <div class="row margin-top-2 border-bottom hired">
                                <div class="col-md-12">
                                    <label style="" class="label-side">
                                        <?= $total_hired; ?> 
                                        <span class="span-side">Hired</span>
                                    </label>
                                </div>
                            </div>
                            <div style="" class="row margin-top-2 border-bottom total-work">
                                <div class="col-md-12">
                                    <label style="" class="label-side">
                                    <?php echo $workedhours ?> Hours Worked
                                    </label>
                                </div>
                            </div>

                            <div class="row margin-top-2 border-bottom hired">
                                <div class="col-md-12">
                                    <label style="" class="label-side">
                                        $<?php echo round($total_spent, 0); ?>
                                        <span class="span-side">Spent</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row margin-top-2 border-bottom">
                                <div style="" class="maste">
                                    <i class="fa fa-map-marker"></i>			
                                    <label style="" class="label-side">
                                        <span class="span-side"><?php echo ucfirst($country) ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
