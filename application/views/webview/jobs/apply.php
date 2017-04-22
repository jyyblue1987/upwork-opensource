<style type="text/css">
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
    ul {
        list-style-type: none;
    }
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


<section id="big_header">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-0 white-box job-cont">
                <div class='form-msg'></div>
                <div class="row">
                    <div class="col-md-10 page-label">
                        <h1 class="job-title cos_job-title"><?php echo $value->get_title() ?></h1>
                    </div>
                    
                    <div class="col-md-2 page-label">                        
                        <span class="pull-right marg-top-neg"><?php echo $time ?></span>
                    </div>
                    
                </div>
                <div class="jobdes-bordered-wrapper">
                <div class="row jobdes-bordered page-label">
                    <div class="col-md-3 text-center">
                        <label class="lab-res">Job Type</label> <br /> <span><?php echo ucfirst($value->get_jobtype()) ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label class="lab-res">
                            <?= $value->get_jobtype() == 'hourly' ? "Hourly Per week" : 'Budget $'; ?>
                        </label><br /><span>
                            <?= $value->get_jobtype() == 'hourly' ? $value->get_hrs_perweek() : '$' . round($value->get_budget(), 2); ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label class="lab-res">Job Duration</label><br /> <span><?php echo $value->get_duration() ?></span>
                    </div>

                    <div class="col-md-3 last-div text-center page-label">
                        <label class="lab-res">Experience Level</label><br /> <span><?php echo $value->get_exp() ?></span>
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

                    <div class="col-md-12 text-justify page-label job-desc"><?php echo $value->get_jobdesc()?></div>
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
                            <?php echo $hires;?>
                        </span>
                    </div>
                </div>
                </div>

            <form method="post" id='jobApply'>
                <input type="hidden" name='job_id' id='jobId' value='<?php echo $value->get_jobid(); ?>'/>
                <input type="hidden" name='job_title' id='job_title' value='<?php echo $value->get_title(); ?>'/>
                <div class="col-md-12 white-box col-md-offset-0 proposed">

                    <div class="row">
                        <div class="col-md-12 page-label">
                            <h1 style='' class="pro-text">Proposed Terms</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 col-xs-6 col-md-offset-4 page-label">
                                    <label class="lab-res">Your Bid</label>
                                </div>

                                <div class="col-md-4 col-xs-6 neg-35">

                                    <table>
                                        <tr>
                                            <td><span class="font-17">$</span> </td>
                                            <td>
                                        <?php
                                        $bidAmt = '';
                                        $perHrs='';
                                        if ($value->get_jobtype() == 'hourly')
                                        {
                                            if ($rate)
                                            {
                                                $bidAmt = $rate + $rate * WINJOB_FEE;
                                            } else
                                                $rateMsg = 1;
                                            $perHrs='/hr';
                                        }else{
                                            $bidAmt = $value->get_budget();
                                        }
                                        ?>
                                        <input type="text" class="form-control pro-input" name='bid_amount' id='bid_amount' value='<?php echo $bidAmt; ?>'/></td>
                                            <td> <b class="perh"><?php echo $perHrs?></b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-xs-6 col-md-offset-4 page-label">
                                    <label class="lab-res">10% Winjob Fee</label>
                                </div>

                                <div class="col-md-4 col-xs-6 neg-35">
                                    <table>
                                        <tr>
                                            <td><span class="font-17">$</span> </td>
                                            <td><input type="text" class="form-control pro-input" name='bid_fee' id='bid_fee' disabled/></td>
                                            <td> <b class="perh"><?php echo $perHrs?></b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-xs-6 col-md-offset-4 page-label" >
                                    <label class="lab-res">Your Earnings</label>
                                </div>

                                <div class="col-md-4 col-xs-6 neg-35">
                                    <table>
                                        <tr>
                                            <td><span class="font-17">$</span> </td>
                                            <td><input type="text" class="form-control pro-input" name='bid_earning' id='bid_earning' disabled/></td>
                                            <td> <b class="perh"><?php echo $perHrs?></b></td>
                                        </tr>
                                    </table>
                                    <div class="col-md-1 "></div>
                                    <div class="col-md-9">
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($rateMsg)){?>
                                <div class="row">
                                    <div class="row page-label col-md-offset-3 col-xs-6 col-md-4">
                                        <label>Your hourly rate is not defined, Click <a href='<?php echo site_url('profile/basic'); ?>'>here</a> to update.</label>
                                    </div>
                                </div>
                            <?php } ?>  
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>

                    </div>
                    <?php if ($value->get_jobtype() != 'hourly') { ?>
                    <div class="row margin-top-15">
                        <div class="col-md-12 page-label">
                            <label>Job Duration</label>
                        </div>

                        <div class="col-md-4">
                            <select class="form-control" name='job_duration' id='job_duration'>
                                <option value="not_sure">Not Sure</option>
                                <option value="Less than 1 week">Less than 1 week</option>
                                <option value="Less than 1 month">Less than 1 month</option>
                                <option value="1-3 months">1-3 months</option>
                                <option value="3-6 months">3-6 months</option>
                                <option value="More than 6 months">More than 6 months</option>
                            </select>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="row margin-top-15">
                        <div class="col-md-9 page-label">
                            <p class="apply_job_custom_cover-letter">Cover Letter</p>
                        </div>

                        <div class="col-md-12 text-justify">
                            <textarea rows="8" class="form-control cover-text" name='cover_latter' id='cover_latter'></textarea>
                        </div>
                    </div>

                    <div style="" class="row page-label att-cont">
                        <div class="col-md-12">
                            <label style="" class="lbl-att">Attachment (Optional)</label>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="upload_file">
                                    <input type="file" name="files" id="files" />
                                    <input type="button" id="uploader" value="Add files" style="margin-left: 0px;" class="btn my_btn" />
                                    <div id="file_lists" style="margin: 0">
                                        <ul id="lists">
                                        </ul>
                                    </div>
                                    <input type="hidden" name="requestor" value="<?= $user_id ?>" />
                                    <input type="hidden" name="tid" value="<?= $tid ?>" />
                                    <input type="hidden" name="attachments" id="attachments" />
                                </div>
                        </div>
                    </div>

                    <div class="row margin-top">
                        <div style="" class="col-md-12">
                            <div class="col-md-3 no-pad">
                            <input style="" type="submit" class="btn-primary big_mass_active transparent-btn big_mass_button btn-block submit-button" value="Submit a Proposal" id='submit-all'/>
                            </div>
                            <div class="col-md-2 col-md-offset-1 no-pad">
                            <input style="float: left;" type="button" class="transparent-btn big_mass_button btn-block cancel-button" value="cancel" onclick="window.history.go(-1);"/>
                            </div>
                            <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
                        </div>
                    </div> 

                </div>
            </form>
            </div>
            
            
            <div class="col-md-3 col-xs-12 no-pad">
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
                                        <?php
                                    }
                                    ?>
                                <label class="pad-25"><?php echo ucfirst($emp->get_fname()) ?></label>
                                
                                
                            </div>
                        </div>
                        <div style="" class="row margin-top-2 border-bottom right-cont">
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
                        <div style="" class="row margin-top-2 border-bottom job-posted">
                            <div class="col-md-12">
                                <label style="" class="label-side">
                                   <?php echo $jobs_posted;  ?>
                                <span class="span-side">Jobs Posted</span>
                                </label>
                            </div>
                        </div>
                        <div class="row margin-top-2 border-bottom hired">
                            <div class="col-md-12">
                                <label style="" class="label-side">
                                <?= $total_hired ;?> 
                                <span class="span-side">Hired</span>
                                </label>
                            </div>
                        </div>
                        <div style="" class="row margin-top-2 border-bottom total-work">
                            <div class="col-md-12">
                                <label style="" class="label-side">
                                <?= $workedhours != "" ? $workedhours : 0; ?>
                                </label>
                            </div>
                        </div>

                        <div class="row margin-top-2 border-bottom hired">
                            <div class="col-md-12">
                                <label style="" class="label-side">
                                $<?php echo round($total_spent,0);?>
                                <span class="span-side">Spent</span>
                                </label>
                            </div>
                        </div>
                        <div class="row margin-top-2 border-bottom">
                            <div style="" class="maste">
                                <i class="fa fa-map-marker"></i>
                                <label style="" class="label-side">
                                <span class="span-side"><?= ucfirst($country) ?></span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

        </div>

    </div>

</section>
<script>
    var formSubmitted = false;
    $(document).ready(function() {
        clearForms();

        $(window).unload(function(evt) {
            if (!formSubmitted) {
                $.ajax({
                    url: "<?= base_url() . 'jobs/removefile' ?>",
                    type: "POST",
                    data: "formDiscard=<?= $user_id ?>/<?= $tid ?>",
                    async: false
                });
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
                formdata.append("uid", <?= $user_id ?>);
                formdata.append("ident", <?= $tid ?>);
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
                                        $.post("<?= base_url() . 'jobs/removefile' ?>", "file=" + $.trim($(this).parent().text()) + "&tid=<?= $user_id ?>/<?= $tid ?>");
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

        $('#jobApply').submit(function() {
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