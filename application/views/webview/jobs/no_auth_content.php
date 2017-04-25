<style>span.rating-badge {
        background: #eba705 none repeat scroll 0 0;
        border-radius: 7px;
        color: #fff;
        padding: 4px;
    }
    .custom_find_job h5{}
    .custom_find_job_bottom li {
        border: 0;
        margin-bottom: 9px;
        width: auto !important;
        padding: 0;
        margin-right: 30px;
        font-size: 18px;
        font-family: calibri;
        color: rgb(98, 98, 98);
    }
    
    .custom_find_job_bottom li:last-child{
        margin-right: 0px;
    }
    .custom_find_job_bottom li i{
        margin-right: 5px;
        font-size: 19px;
    }
    .star-rating span, #feedbackbutton h4 span {
        font-size: 19px !important;
    }
    
    .star-rating::before {
        font-size: 19px;
    }

    #place_bid{
        float: right;
        background-color: #007DC1;
        padding: 8px;
        border-radius: 3px;
        font-size: 12px;
        color: #fff;
        text-decoration: none;
    }

    #place_bid a:hover{
        float: right;
        background-color: #007DC1;
        padding: 8px;
        border-radius: 3px;
        font-size: 12px;
        color: #fff;
        text-decoration: none;
    }
    a.morelink {
        text-decoration:none;
        outline: none;
    }
    .morecontent span {
        display: none;
        font-family: calibri;
        font-size: 16px;
        color: #494949;
    }
    span.rating-badge {
        background: #F77D0E none repeat scroll 0 0;
        border-radius: 2px;
        color: #fff;
        padding: 2px 4px 2px 5px;
        font-size: 12px;
        float: left;
    }
</style>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<?php
if (count($records) > 0) {
    foreach ($records as $key => $value) {
        ?>
        <div style="margin-top: 0px;" class="row" id="all-jobs">
            <div style="margin-bottom: 5px;" class="col-md-12 col-md-offset-0 page-jobs ">
                <h3 style="margin-bottom: 12px;">
                    <a style="font-family: 'Calibri';font-size: 22px;color: rgb(2, 143, 204);" href="<?php echo site_url("jobs/" . url_title($value->title) . '/' . base64_encode($value->id)); ?>"><?php echo ucfirst($value->title) ?>
                    </a>
                    <a href="#" class="btn btn-info btn-lg place_bid" id="place_bid" data-job-id="<?= $value->id; ?>" data-title="<?= $value->title ?>" data-toggle="modal" data-target="#myModal">Place Bid</a></h3>
                <div class="custom_find_job">
                    <h5><b><?php echo ucfirst($value->job_type) ?></b></h5>
                    <h5><b>-</b></h5>
                    <h5 style="margin-right: 10px;"><b>
                            <?php
                            if ($value->job_type == 'hourly') {
                                echo $value->hrs_per_week . " hours/wk";
                            } else {
                                echo '$' . round($value->budget, 2);
                            }
                            ?>
                        </b></h5>

                    <h5 style="margin-right: 10px;"><?php
                        echo ucfirst($value->experience_level);
                            if (trim($value->experience_level) == 'Entry level')
                                echo " ($)";
                            else if (trim($value->experience_level) == 'Entermediate')
                                echo " ($$)";
                            else
                                echo " ($$$)";
                            ?>
                    </h5> 
                    <h5 style="margin-right: 10px;">Posted: <?php echo $value->job_created; ?></h5>
                    <h5><b><?php echo $value->bids; ?></b> quotes</h5>
                </div>
            </div>
            <div style="margin-bottom: -3px;" class="col-md-12 col-md-offset-0 page-jobs ">
                <h6 class="more" style="color: #494949;"><?php echo ucfirst($value->job_description) ?></h6>
            </div>
            <?php if ($value->userfile != "") { ?>
                <div class="col-md-12 col-md-offset-0 page-jobs no-pad" style=" margin-bottom: 10px;">
                    <h6 style="float:left;font-size: 14px;margin: 0;margin-top: 3px;margin-right: -8px;" class="page-sub-title more">Attachment</h6>
                    <div class="attachments">
                        <br>
                        <?php
                        $attachments = explode(",", $value->userfile);
                        foreach ($attachments AS $attachment) {
                            echo '<a href="' . site_url() . 'jobs/download?dir=' . $value->user_id . '/' . $value->tid . '&file=' . str_replace('"', '', $attachment) . ' ">' . str_replace('"', '', $attachment) . '</a><br>';
                        }
                        ?>
                    </div>
                </div>
        <?php } ?>
            <div class="col-md-12 col-md-offset-0 page-jobs " style=" margin-bottom: 2px;">

                <h6 style="float:left;font-size: 14px;margin: 0;margin-top: 3px;margin-right: -8px;" class="page-sub-title">Skills</h6>

                <div class="custom_user_skills custom_user_skills_find">
                    <?php
                    if (isset($value->skills) && !empty($value->skills)) {
                        foreach ($value->skills AS $skills) {
                            echo "<span style='font-family: Calibri; font-size: 10.5px; padding-right: 5px;'>" . ucwords($skills['skill_name']) . "</span> ";
                        }
                    }
                    ?>
                    <br>
                </div>
            </div>
            <div class="col-md-12">
                <nav>
                    <ul class="job-navigation custom_find_job_bottom">

                        <?php
                        if ($value->is_active == 1 && $value->payment_set) {
                            ?>
                            <li>
                                <i style="color: rgb(2, 143, 204);" class="fa fa-check-circle"></i>Verified
                            </li>
                            <?php
                        } else {
                            ?>
                            <li>
                                <i style="color: rgb(187, 187, 187);" class="fa fa-check-circle"></i>Unverified
                            </li>
                            <?php
                        }
                        ?>

                        <li><b>$<?php echo round($value->total_spent, 0); ?></b> Spent</li>
                        <li style="padding-top: 5px;margin-bottom: 4px;">
                        <?php if ($value->rating != 0) { ?>
                                <span class="rating-badge"><?= number_format((float) $value->rating, 1, '.', ''); ?></span>
                                <div title="Rated <?= $value->rating; ?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em; margin-top:-5px; color:#DEDEDE; width: <?= $value->rating - 1 ?>em">
                                    <span style="width:<?= (( $value->rating / 5) * 100) ?>% ; margin-top:0px;">
                                        <strong itemprop="ratingValue"><?= $value->rating; ?></strong> out of 5
                                    </span>
                                </div>
                            <?php } else { ?>
                                <span style="font-size: 10px;background: #F77D0E;padding: 2px 5px;border-radius: 2px;margin-right: 1px;" class="rating-badge">0.0</span>
                                <div title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="top:-5px;height: 1.2em;">
                                    <span style="width:0%">
                                        <strong itemprop="ratingValue">0</strong> out of 5
                                    </span>
                                </div>
                            <?php } ?>
                        </li>
                        <li>
                            <i style="font-size: 16px;margin-right: 2px;" class="fa fa-map-marker"></i>
                            <?= $value->country ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="line custon_line"></div>
        <br/>
        <?php
    }
} else {
    ?>
    <h3 style="text-align: center; padding-bottom: 35px;" class="no-result-container">No Results Found</h3>
    <?php }
?>
<script type="text/javascript" src="<?= site_url() ?>assets/js/internal/popup_register.js"></script>
<script type="text/javascript" src="<?= site_url() ?>assets/js/dynamic_shorten.js"></script>
<script type="text/javascript" src="<?= site_url() ?>assets/js/internal/show_moretext.js"></script>