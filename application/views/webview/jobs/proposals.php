<style type="text/css">
#buttonfirst {
    background: #eba705 none repeat scroll 0 0;
    border: medium none;
    border-radius: 5px;
    color: #fff;
    float: left;
    font-family: "Arial";
    font-size: 17.5px;
    margin-top: 2px;
    padding: 5px 7px;
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

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/pages/proposals.css" />
<section id="big_header">
    <div class="no-pad-mob pad-large">
        <div class="row">
            <div class="col-md-9 col-md-offset-0 white-box job-cont">
                <div class="row">
                    <div class="col-md-10 page-label">
                        <h1 class="job-title cos_job-title"><?php echo $value->get_title() ?></h1>
                    </div>
			<div class="col-md-2 page-label">
                        <span class="pull-right"><?php echo $time ?></span>
                    </div>
                </div>
				
			<div class="jobdes-bordered-wrapper">
                <div class="row jobdes-bordered page-label">
                    <div class="col-md-3 text-center">
                        <label style="font-family: calibri;font-size: 17px;">Job Type</label> <br /> <span><?php echo ucfirst($value->get_jobtype()) ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label class="lab-res">
                            <?= $value->get_jobtype() == 'hourly' ? "Hourly Per week" : 'Budget $'; ?>
                        </label><br /><span>
                            <?= $value->get_jobtype() == 'hourly' ? $value->get_hrs_perweek() : '$' . round($value->get_budget(), 2); ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label style="font-family: calibri;font-size: 17px;">Job Duration</label><br /> <span><?php echo $value->get_duration() ?></span>
                    </div>

                    <div class="col-md-3 last-div text-center page-label">
                        <label style="font-family: calibri;font-size: 17px;">Experience Level</label><br /> <span><?php echo $value->get_exp(); ?></span>
                    </div>
                </div>
</div>

                <div class="row margin-top page-label">
                    <div class="col-md-2">
                        <label style="font-family: calibri;font-size: 16px;">Job Category</label>
                    </div>
                    <div style="margin-top: 4px;" class="col-md-10">
                       <?php echo $value->get_subcategory(); ?>
                    </div>
                </div>
					
				<div class="row margin-top page-label">
                    <div class="col-md-2">
                        <label>Skills</label>
                    </div>

                    <div class="col-md-10 skills page-label margin-top-neg-2">
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

                <div class="row margin-top page-label">
                    <div class="col-md-9">
                        <label>Detail</label>
                    </div>
                    <div style="font-family: calibri; font-size: 16px; margin-bottom: 17px; margin-top: 8px;" class="col-md-12 text-justify page-label"><?php echo $value->get_jobdesc()?></div>

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
                        <label style="font-family: calibri;font-size: 17px;">Proposals</label> <br /> <span><?=$applicants;?></span>
                    </div>

                    <div class="col-md-4 text-center page-label">
                        <label style="font-family: calibri;font-size: 17px;">Interviewing</label><br /> <span><?=$interviews;?></span>
                    </div>

                    <div class="col-md-4 last-div text-center page-label">
                        <label style="font-family: calibri;font-size: 17px;">Hired</label><br /> <span>
                            <?php echo $hires;?>
                        </span>
                    </div>
                </div>
                </div>
            
            <div class="col-md-12 no-pad" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; ">
                <div class='form-msg'></div>            
               
                    <div style="border: 1px solid rgb(204, 204, 204); border-radius: 4px;margin-top: 20px;" class="col-md-12">
                        <div class="row">
                            <?php
                            if($status=='1'){?>
                                    <div class="alert custom-alert-warning">
                                            <strong>Warning!</strong> You have withdraw with this job.
                                    </div>
                                    <?php }else{
                                    }
                            ?>
                            <div style="text-align: center;" class="col-md-12 col-centered custom_sp no-pad">
								<div class="row">
                                    <div class="col-md-12">
                                        <label style="margin-bottom: -3px;">Submitted Proposal</label>
                                    </div>
                                </div>

                                <div class="row margin-top-2">
                                    <div class="col-md-12">
                                        <label>Your proposed terms</label>
                                    </div>
                                </div>

                                <div class="row margin-top-2">
                                    <div class="col-md-12">
                                        <label>Rate : </label>
                                    <?php
                                    $perHrs = '';
                                    if ($value->get_jobtype() == 'hourly')
                                    {
                                        $perHrs = '/hr';
                                    }
                                    ?>
                                        <label>$<amt id='bid_earning_read'><?php echo round($bid_earning, 2); ?></amt><?php echo $perHrs ?></label> ($<amt id='bid_amount_read'><?php echo round($bid_amount, 2); ?></amt><?php echo $perHrs ?> charge to client)
                                    </div>

                                </div>
                                <?php if($status!='1')
                                {?>
                                <div class="row margin-top-2">
                                    <div class="col-md-12">
                                        <input type="button" class="btn btn-primary form-btn" value="Propose Different Terms" data-toggle="modal" data-target="#myModal2"/>
                                    </div>
                                </div>

                                <div class="row margin-top-2">
                                    <div class="col-md-12 text-center">
                                        <a href="#" data-toggle="modal" data-target="#myModal">Withdraw Proposal</a>
                                    </div>
                                </div>
 <?php }?>
                            </div>
                        </div>
                    </div>
              

                <div class="row no-pad">
                    <div class="col-md-11 no-pad-mob">
                        <div class="row">
                            <div style="margin-top: 30px;" class="col-md-11 no-pad-mob margin-top-2">
                                <p class="custom_cover-letter">Cover Letter</p>
                            </div>
                        </div>

                        <div class="row margin-top-2">
                            <div class="col-md-11 margin-left-2 no-pad-mob">
                                <p style="margin-bottom: 32px;" style="margin-bottom: 10px; color: rgb(73, 73, 73);" class="custom_cover-letter-text"><?php echo ucfirst($cover_letter) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php if($f_attachments[0] != ""){ ?>
                    <div class="row margin-top page-label margin-top-5">
                    <div class="col-md-9">
                        <label class="lab-details" style="font-size: 15px;">Attachments</label>
                    </div>
                    <div class="col-md-12 text-justify page-label div-details">
                    <?php 
                        $attachments = explode(",", $f_attachments[0]);
                            foreach($attachments AS $attachment){
                                echo '<a href="'.site_url().'jobs/download?dir='.$user_id.'/'.$tid.'&file='.str_replace('"','', $attachment).' ">'.str_replace('"','', $attachment).'</a><br>'; 
                            }
                    ?>
                </div>
                </div>
                    <?php } ?>
                </div>
            </div>

            </div>
            <div class="col-md-3 no-pad">
                <div class="row client-activity">
                    <div class="col-md-10 col-md-offset-2 right-section">
                        <p class="margin-top-2">
                                
                                <?php
                                        if ($emp->is_active() == 1 && $payment_set) {
                                            ?>
                                            <i style="font-size: 25px; color: rgb(2, 143, 204);" class="fa fa-check-circle"></i>
                                        <?php
                                    } else {
                                        ?>
                                        <i style="font-size: 25px; color: rgb(187, 187, 187);" class="fa fa-minus-circle"></i>
                                        <?php
                                    }
                                    ?>
                                <label><?php echo ucfirst($emp->get_fname()) ?></label>
                         </p>
                        <div style="margin-top: 10px;margin-bottom: 10px;" class="row margin-top-2 border-bottom">
                            <div class="col-md-8 ">
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
                               
                        <p>
                                <label style="font-family: Calibri;font-size: 18px;color: #494949;">
                                   <?php echo $jobs_posted;  ?>
                                    <span style="font-size: 14px;color: #494949;font-family: calibri;">Jobs Posted</span>
                                    </label>
                        </p>
                        <p>
                                <label style="font-family: Calibri;font-size: 18px;color: #494949;">
                                <?= $total_hired ;?> 
                                <span style="font-size: 14px;color: #494949;font-family: calibri;">Hired</span>
                                </label>
                        </p>
                        <p>
                                <label style="font-family: Calibri;font-size: 18px;color: #494949;">
				<?php echo $workedhours; ?> Hours Worked
				</label>
                        </p>
                        <p>
                                <label style="font-family: Calibri;font-size: 18px;color: #494949;">
                                $<?php echo round($total_spent,0);?>
                                <span style="font-size: 14px;color: #494949;font-family: calibri;">Spent</span>
                                </label>
                        </p>
                        <p>
                            <i class="fa fa-map-marker"></i>
                            <label style="font-family: Calibri;font-size: 18px;color: #494949;">
                            <span style="font-size: 14px;color: #494949;font-family: calibri;">
                                <?= ucfirst($country) ?></span>
			</label>
                        </p>
                        </div>
                </div>
            </div>
           
    </div>
        </div>
    </div>


                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div style="border-bottom: 50px;padding-left:30px;padding-right:30px;padding-top: 50px;text-align: center;" class="modal-content">
                            <div class="modal-header" style="border-bottom: 0;padding-top: 20px;border-radius: 4px 4px 0 0;">
                                <button style="position: absolute;top: 35px;right: 29px;font-size: 30px;" type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                <h4 style="margin-top: 0px;" class="modal-title">Withdraw Proposal</h4>
                            </div>
                            <div style="border-radius: 0 0 4px 4px;margin-bottom: 50px;" class="modal-body">
                                <p style="margin-left: 15px;font-size: 17px;font-family: calibri;margin-bottom: 20px;">Are you sure you want to withdraw this proposal?</p>
                            <div class="modal-footer" style="text-align: left; border-top: none">
                                <form method="post" id='jobWithDraw'>
                                    <input type="hidden" name='bid_id' value='<?php echo $value->id; ?>'/>
                                    <input type="hidden" name='withdraw' value='1'/>
                                    <input style="float: left;margin-left: 200px;" type="submit" class="btn-primary big_mass_active transparent-btn big_mass_button form-btn" value="Withdraw Proposal" />
                                    <input style="float: left;" type="button" class="btn-primary transparent-btn big_mass_button" value="Cancel" data-dismiss="modal" />
                                    <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
                                </form>
                            </div>
                            </div>
                        </div>

                    </div>
                </div>



                <div id="myModal2" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div style="padding-top: 50px;padding-bottom: 50px;padding-left: 30px;padding-right: 30px;" class="modal-content">
                            <div class="modal-header" style="border-bottom: 0;padding-top: 20px;border-radius: 4px 4px 0px 0px;">
                                <button style="position: absolute;top: 35px;right: 29px;font-size: 30px;" type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                <h4 class="modal-title">Proposed Terms</h4>
                            </div>
                            <div style="border-radius: 0 0 4px 4px;" class="modal-body">
                                <form method="post" id='jobApply'>
                                    <input type="hidden" name='bid_id' value='<?php echo $value->id; ?>'/>
                                    <input type="hidden" name='proposal' value='1'/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="margin-bottom: 20px;margin-top: 15px;" class="row">
                                                <div class="col-md-3 col-md-offset-3 page-label">
                                                    <label>Your Bid</label>
                                                </div>

                                                <div style="margin-left: -60px;" class="col-md-6">
                                                    <div class="col-md-1">$</div>
                                                    <div class="col-md-5">
                                                        <input style="font-size: 16px;font-family: calibri;float: left;width: 80px;margin-left: -9px;margin-top: -10px;margin-right: 5px;" type="text" class="form-control" name='bid_amount' id='bid_amount' value='<?php echo round($value->bid_amount, 2); ?>' style="float: left;width: 75px"/><label style=' margin-left: 2px;margin-top: 6px;position: absolute;'><?php echo $perHrs ?></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="margin-bottom: 20px;" class="row">
                                                <div class="col-md-3 col-md-offset-3 page-label">
                                                    <label>10% Winjob Fee</label>
                                                </div>

                                                <div style="margin-left: -60px;" class="col-md-6">
                                                    <div class="col-md-1">$</div>
                                                    <div class="col-md-5">
                                                        <input style="font-size: 16px;font-family: calibri;float: left;width: 80px;margin-left: -9px;margin-top: -10px;margin-right: 5px;" type="text" class="form-control" name='bid_fee' id='bid_fee' disabled style="float: left;width: 75px" /><label style=' margin-left: 2px;margin-top: 6px;position: absolute;'><?php echo $perHrs ?></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="margin-bottom: 20px;" class="row">
                                                <div class="col-md-3 col-md-offset-3 page-label">
                                                    <label>Your Earnings</label>
                                                </div>

                                                <div style="margin-left: -60px;" class="col-md-6">
                                                    <div class="col-md-1">$</div>
                                                    <div class="col-md-5">
                                                        <input style="font-size: 16px;font-family: calibri;float: left;width: 80px;margin-left: -9px;margin-top: -10px;margin-right: 5px;" type="text" class="form-control" name='bid_earning' id='bid_earning' disabled style="float: left;width: 75px"/><label style=' margin-left: 2px;margin-top: 6px;position: absolute;'><?php echo $perHrs ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer" style="text-align: center; border-top: none">
                                        <input style="float: left;margin-left: 320px" type="submit" class="btn-primary big_mass_active transparent-btn big_mass_button" value="Done" />
                                        <input style="float: left;" type="button" class="btn-primary transparent-btn big_mass_button" value="Cancel" data-dismiss="modal" />
                                        <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-md-3"></div>
            </div>
        </div>
</section>