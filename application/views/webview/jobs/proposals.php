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
                        <label>Job Type</label> <br /> <span><?php echo ucfirst($value->get_jobtype()) ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label class="lab-res">
                            <?= $value->get_jobtype() == 'hourly' ? "Hourly Per week" : 'Budget $'; ?>
                        </label><br /><span>
                            <?= $value->get_jobtype() == 'hourly' ? $value->get_hrs_perweek() : '$' . round($value->get_budget(), 2); ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label>Job Duration</label><br /> <span><?php echo $value->get_duration() ?></span>
                    </div>

                    <div class="col-md-3 last-div text-center page-label">
                        <label>Experience Level</label><br /> <span><?php echo $value->get_exp(); ?></span>
                    </div>
                </div>
</div>

                <div class="row margin-top page-label">
                    <div class="col-md-2">
                        <label>Job Category</label>
                    </div>
                    <div  class="col-md-10 margin-top-4">
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
                    <div  class="col-md-12 text-justify page-label job_desc"><?php echo $value->get_jobdesc()?></div>

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
                        <label>Proposals</label> <br /> <span><?=$applicants;?></span>
                    </div>

                    <div class="col-md-4 text-center page-label">
                        <label>Interviewing</label><br /> <span><?=$interviews;?></span>
                    </div>

                    <div class="col-md-4 last-div text-center page-label">
                        <label>Hired</label><br /> <span>
                            <?php echo $hires;?>
                        </span>
                    </div>
                </div>
                </div>
            
            <div class="col-md-12 no-pad back-col" >
                <div class='form-msg'></div>            
               
                    <div  class="col-md-12 subm">
                        <div class="row">
                            <?php
                            if($status=='1'){?>
                                    <div class="alert custom-alert-warning">
                                            <strong>Warning!</strong> You have withdraw with this job.
                                    </div>
                                    <?php }else{
                                    }
                            ?>
                            <div  class="col-md-12 col-centered custom_sp no-pad text-center">
								<div class="row">
                                    <div class="col-md-12">
                                        <label  class="marg-bot--3">Submitted Proposal</label>
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
                            <div class="col-md-11 no-pad-mob margin-top-2 marg-top-30">
                                <p class="custom_cover-letter">Cover Letter</p>
                            </div>
                        </div>

                        <div class="row margin-top-2">
                            <div class="col-md-11 margin-left-2 no-pad-mob">
                                <p class="custom_cover-letter-text cover_letter"><?php echo ucfirst($cover_letter) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php if($f_attachments){ ?>
                    <div class="row margin-top page-label margin-top-5">
                    <div class="col-md-9">
                        <label class="lab-details font-15" >Attachments</label>
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
                        <p class="margin-top-1">
                                
                                <?php
                                        if ($emp->is_active() == 1 && $payment_set) {
                                            ?>
                                            <i class="fa fa-check-circle circle"></i>
                                        <?php
                                    } else {
                                        ?>
                                        <i class="fa fa-minus-circle minus-circle"></i>
                                        <?php
                                    }
                                    ?>
                                <label><?php echo ucfirst($emp->get_fname()) ?></label>
                         </p>
                        <div class="row margin-top-2 border-bottom marg-bot-10">
                            <div class="col-md-8 ">
                                <?php if ($rating != 0) { ?>
                                        <span class="rating-badge"><?= number_format((float) $rating, 1, '.', ''); ?></span>
                                        <div title="Rated <?= $rating; ?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                            <span style="width:<?= (( $rating / 5) * 100) ?>% ; margin-top:0px;">
                                                <strong itemprop="ratingValue"><?= $rating; ?></strong> out of 5
                                            </span>
                                        </div>
                                <?php } else { ?>
                                        <span class="rating-badge">0.0</span>
                                        <div title="Rated 0 out of 5" class="star-rating star-rating2" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="l">
                                            <span class="span-0">
                                                <strong itemprop="ratingValue">0</strong> out of 5
                                            </span>
                                        </div>
                                        <?php } ?>
                            </div>
                        </div>
                               
                        <p>
                                <label class="job_posted">
                                   <?php echo $jobs_posted;  ?>
                                    <span class="st">Jobs Posted</span>
                                    </label>
                        </p>
                        <p>
                                <label class="job_posted">
                                <?= $total_hired ;?> 
                                <span class="st">Hired</span>
                                </label>
                        </p>
                        <p>
                                <label class="job_posted">
                				<?= $workedhours != "" ? $workedhours : 0; ?>
                                <span class="st">Hours Worked</span>
                				</label>
                        </p>
                        <p>
                                <label class="job_posted">
                                $<?php echo round($total_spent,0);?>
                                <span class="st">Spent</span>
                                </label>
                        </p>
                        <p>
                            <i class="fa fa-map-marker"></i>
                            <label class="job_posted">
                            <span class="st">
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
                        <div class="modal-content modal-content1">
                            <div class="modal-header modal-header1">
                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                <h4 class="modal-title modal-title1">Withdraw Proposal</h4>
                            </div>
                            <div class="modal-body modal-body1">
                                <p class="sure">Are you sure you want to withdraw this proposal?</p>
                            <div class="modal-footer modal-footer1">
                                <form method="post" id='jobWithDraw'>
                                    <input type="hidden" name='bid_id' value='<?php echo $value->id; ?>'/>
                                    <input type="hidden" name='withdraw' value='1'/>
                                    <input type="submit" class="btn-primary big_mass_active transparent-btn big_mass_button form-btn formb" value="Withdraw Proposal" />
                                    <input type="button" class="btn-primary transparent-btn big_mass_button can" value="Cancel" data-dismiss="modal" />
                                    <img src='/assets/img/version1/loader.gif' class="form-loader">
                                </form>
                            </div>
                            </div>
                        </div>

                    </div>
                </div>



                <div id="myModal2" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content modal-content2">
                            <div class="modal-header modal-header2">
                                <button type="button" class="close close2" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                <h4 class="modal-title">Proposed Terms</h4>
                            </div>
                            <div class="modal-body modal-body2">
                                <form method="post" id='jobApply'>
                                    <input type="hidden" name='bid_id' value='<?php echo $value->id; ?>'/>
                                    <input type="hidden" name='proposal' value='1'/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row row2">
                                                <div class="col-md-3 col-md-offset-3 page-label">
                                                    <label>Your Bid</label>
                                                </div>

                                                <div class="col-md-6 left--6">
                                                    <div class="col-md-1">$</div>
                                                    <div class="col-md-5">
                                                        <input style="" type="text" class="form-control bid_amount" name='bid_amount' id='bid_amount' value='<?php echo round($value->bid_amount, 2); ?>' style=""/><label style='' class="perhrs"><?php echo $perHrs ?></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="" class="row marg-bot-20">
                                                <div class="col-md-3 col-md-offset-3 page-label">
                                                    <label>10% Winjob Fee</label>
                                                </div>

                                                <div style="" class="col-md-6 marg-left--6">
                                                    <div class="col-md-1">$</div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control bid_amount" name='bid_fee' id='bid_fee' disabled  />
                                                        <label class="perhrs"><?php echo $perHrs ?></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row  marg-bot-20">
                                                <div class="col-md-3 col-md-offset-3 page-label">
                                                    <label>Your Earnings</label>
                                                </div>

                                                <div class="col-md-6  marg-left--6">
                                                    <div class="col-md-1">$</div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control bid_amount" name='bid_earning' id='bid_earning' disabled/>

                                                        <label class="perhrs"><?php echo $perHrs ?></label>
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