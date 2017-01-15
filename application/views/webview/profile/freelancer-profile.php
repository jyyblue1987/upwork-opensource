<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<?php
$total_feedbackScore = 0;
$total_budget = 0;
foreach ($accepted_jobs as $job_data) {
    $this->db->select('*');
    $this->db->from('job_feedback');
    $this->db->where('job_feedback.feedback_userid', $job_data->fuser_id);
    $this->db->where('job_feedback.sender_id !=', $job_data->fuser_id);
    $this->db->where('job_feedback.feedback_job_id', $job_data->job_id);
    $query = $this->db->get();
    $jobfeedback = $query->row();

    if ($job_data->jobstatus == 1) {
        if (!empty($jobfeedback)) {
            if ($job_data->job_type == "fixed") {
                $total_price_fixed = $job_data->fixedpay_amount;
                $total_feedbackScore += ($jobfeedback->feedback_score * $total_price_fixed);
                $total_budget += $total_price_fixed;
            } else {
                $this->db->select('*');
                $this->db->from('job_workdairy');
                $this->db->where('fuser_id', $job_data->fuser_id);
                $this->db->where('jobid', $job_data->job_id);
                $query_done = $this->db->get();
                $job_done = $query_done->result();
                $total_work = 0;
                foreach ($job_done as $work) {
                    $total_work += $work->total_hour;
                }

                if ($job_data->offer_bid_amount) {
                    $amount = $job_data->offer_bid_amount;
                } else {
                    $amount = $job_data->bid_amount;
                }
                $total_price = $total_work * $amount;
                $total_budget += $total_price;
                $total_feedbackScore += ($jobfeedback->feedback_score * $total_price);
            }
        }
    }
}
?>
 
<div style="clear:both"></div>
<div class="container">
    <div id="top-content">
        <div class="row">
            <div class="mainwork">
             <div class="row">
                 <div class="col-md-9 margin-top-4">
                 <div class="header_border">
                     <div class="row">
                          <div class="col-md-2 col-sm-4" style="width: 140px">
                    <div class="topleftside">
                        <div class="user_view_img">
                            <img class="" width="120" src="<?php echo base_url() . $webUserInfo['webuser_picture']; ?>"/>
                        </div>
                        <div style="clear:both"></div>
                        <div class="review_ratting">
                                              <?php
                        if ($total_budget != 0) {
                            $totalscore = ($total_feedbackScore / $total_budget);
                            $rating_feedback = ($totalscore / 5) * 100;
                        } else {
                            $totalscore = null;
                            $rating_feedback = null;
                        }
                        ?>
                        <span class="rating-badge"><?=number_format((float)$totalscore,1,'.','');?></span>
                        <div title="Rated <?= $totalscore; ?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left: 39%;margin-top: 3%;position: absolute;">
                            <span style="width:<?= $rating_feedback; ?>%">
                                <strong itemprop="ratingValue"><?= $totalscore; ?></strong> out of 5
                            </span>
                        </div>
                                         </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 nopadding">
                    <div class="topmiddle">
                        <h4><?php echo $webUserInfo['webuser_fname'] . " " . $webUserInfo['webuser_lname'] ?></h4>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?php echo $webUserInfo['webuser_country_name'] ?></p>
                        <h3><?php echo $basicDetails["tagline"] ?></h3>
                        <div class="buttonside">
<?php
$skills = $basicDetails['skills'];
if (strlen($skills) > 0) {
    ?>
                                            <ul>
                                            <?php
                                            $skillSplit = explode(",", $skills);
                                            if (sizeof($skillSplit) > 0) {
                                                for ($i = 0; $i < sizeof($skillSplit); $i++) {
                                                    ?>
                                                        <li><a href=""><?php echo $skillSplit[$i]; ?></a></li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                                <?php
                                            }
                                            ?>

                                        <div style="clear:both"></div>
                                    </div>
                                    
                    </div>
                    
                </div>
                <div class="col-md-5 col-sm-4 text-right">
                    <div class="topriht">
                       <h4>$<?php echo $basicDetails["hourly_rate"] + $basicDetails["hourly_rate"] * WINJOB_FEE ?> USD/hr</h4>                         <!--	<a href="<?php echo base_url() ?>Active_interview">
                        <button id="buttonsecond">Hire Me &nbsp;&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></button>
                                                        </a>-->
                    
                    </div>
                </div>
                <div style="clear:both"></div>
                    <div class="top_border"></div>
                     <div class="buttonsidetwo">
                                        <h2>Overview</h2>
                                        <p><?php echo $basicDetails['overview'] ?></p>
                                    </div>
                     </div>
                    
                 </div>
              </div>
              <div class="col-md-3">
                 
                                        <div class="buttonsidefoure">
                                            <h2>Work History</h2>
                                            <ul class="main_side_nav_bar">
                                                <li>
                                                
                                                      <div class="review_ratting">
                                              <?php if($total_feedbackScore !=0 && $total_budget!=0){
                                                $totalscore = ($total_feedbackScore / $total_budget);
                                                $rating_feedback = ($totalscore/5)*100;
                                               ?>
                                               <span class="rating-badge"><?=number_format((float)$totalscore,1,'.','');?></span>
                                              <div title="Rated <?=$totalscore;?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em;margin-top:-5px;width:105px; color:#DEDEDE;">
                                               <span style="width:<?=$rating_feedback;?>% ;margin-top:0px;">
                                                   <strong itemprop="ratingValue"><?=$totalscore;?></strong> out of 5
                                               </span>
                                               </div>
                                           <?php  }else{ ?>
                                             <span class="rating-badge">0.0</span>
                                               <div title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em; margin-top:-5px;">
                                               <span style="width:0% ;margin-top:-5px;">
                                                   <strong itemprop="ratingValue">0</strong> out of 5
                                               </span>
                                               </div>
                                          <?php   } ?>
                                         </div>
                                                   
                                                </li>
                                                <li><a href="">&nbsp;$<?php echo $basicDetails["hourly_rate"] + $basicDetails["hourly_rate"] * WINJOB_FEE ?> <span>/hour</span></a></li>
                                                <li>
                                                    <a href="">
                                                        <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                                                        <?php
                                                        if (isset($job_data)) {
                                                            $this->db->select('*');
                                                            $this->db->from('job_workdairy');
                                                            $this->db->where('fuser_id', $job_data->fuser_id);
                                                            $query_done_hour = $this->db->get();
                                                            $workdone_done = $query_done_hour->result();
                                                        } else {
                                                            $workdone_done = null;
                                                        }


                                                        $total_hourwork = 0;
                                                        if (!empty($workdone_done)) {
                                                            foreach ($workdone_done as $workdone) {
                                                                $total_hourwork += $workdone->total_hour;
                                                            }
                                                            echo $total_hourwork . " <span>Hours Worked</span>";
                                                        } else {
                                                            echo "No Worked Yet";
                                                        }
                                                        ?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url() ?>endjobs">
                                                        <i class="fa fa-suitcase" aria-hidden="true"></i>&nbsp;
                                                        <?php
                                                        $jobdone = 0;
                                                        if (!empty($accepted_jobs)) {

                                                            foreach ($accepted_jobs as $count) {
                                                                if ($count->jobstatus == 1) {
                                                                    $jobdone++;
                                                                }
                                                            }

                                                            echo $jobdone . " <span>Jobs Completed</span>";
                                                        } else {
                                                            echo " <span>No Jobs Completed Yet</span>";
                                                        }
                                                        ?>
                                                    </a>
                                                </li>
                                                <li><a href=""><i class="fa fa-tree" aria-hidden="true"></i>&nbsp;<?php echo $basicDetails["work_experience_year"] ?><span>Years Experience</span></a></li>
                                                <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?php echo $webUserInfo['webuser_country_name'] ?>
                                                        <span></span></a></li>
                                            </ul>
                                        </div>	
                                
              </div>
             </div>
            </div>
            <div class="middle">
                <div class="container">
                    <div class="midlmain">
                        <div class="row">
                            <div class="col-md-9 col-sm-9">
                                <div class="divison">
                
                                  

                                    
<?php
if (!empty($accepted_jobs)) {
    foreach ($accepted_jobs as $job_data) {
        $this->db->select('*');
        $this->db->from('job_feedback');
        $this->db->where('job_feedback.feedback_userid', $job_data->fuser_id);
        $this->db->where('job_feedback.sender_id !=', $job_data->fuser_id);
        $this->db->where('job_feedback.feedback_job_id', $job_data->job_id);
        $query = $this->db->get();
        $jobfeedback = $query->row();
        ?>
                                           <div class="history_section">
                                                <div class="buttonsidethree">
                                               <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="buttonsidethreeleft">
                                                    <h2>Job History</h2>
                                                </div>
                                            </div>
                                        </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="buttonsidethreeleft">
                                            <p> <?= $job_data->hire_title ?></p>
                                                <h3><?php echo date(' F j, Y ', strtotime($job_data->start_date)); ?>
                                                                <?php if ($job_data->jobstatus == 1) {
                                                                    echo " - " . date(' F j, Y ', strtotime($job_data->end_date));
                                                                } ?>
                                                            </h3>
                                                            <p style="color: #bebebe; font-style: italic;">
                                                                <?php
                                                                if ($job_data->jobstatus == 1) {
                                                                    if (!empty($jobfeedback)) {
                                                                        echo $jobfeedback->feedback_comment;
                                                                        $rating_result = ($jobfeedback->feedback_score / 5) * 100;
                                                                    }
                                                                } else {
                                                                    echo "Job in progress";
                                                                }
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                         <?php if ($job_data->job_type == "fixed") { ?>
                                        <div class="buttonsidethreeright pull-right " style="padding:0;">
                                          <?php } else { if ($job_data->jobstatus == 1) {
                                                                    ?>
                                        <div class="buttonsidethreeright " style="padding:0;"> <?php } else { ?>
                                         <div class="buttonsidethreeright pull-right " style="padding:0;">
                                                                        <?php }
                                                                    } ?>


        <?php
        if ($job_data->job_type == "fixed") {
            if ($job_data->jobstatus == 1) {
                if (!empty($jobfeedback)) {
                    ?>

                                                                                <div title="Rated <?= $jobfeedback->feedback_score; ?> out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                                                    <span style="width:<?= $rating_result; ?>%">
                                                                                        <strong itemprop="ratingValue"><?= $jobfeedback->feedback_score; ?></strong> out of 5
                                                                                    </span>
                                                                                </div>
                                                                                <span class="rate"><?= $jobfeedback->feedback_score; ?></span>
                                                                            <?php } else { ?>
                                                                                <div title="Rated 0 out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                                                    <span style="width:0%">
                                                                                        <strong itemprop="ratingValue">0</strong> out of 5
                                                                                    </span>
                                                                                </div>
                                                                                <span class="rate">0.00</span>
                                                                            <?php }
                                                                        } ?>

                                            <!--<h6>$<?= $job_data->bid_amount ?></h6>-->

                                                                        <h3>Paid $<?= $total_price_fixed = $job_data->fixedpay_amount ?></h3>
                                                                        <h4></h4>
        <?php
        } else {
            if ($job_data->jobstatus == 1) {
                if (!empty($jobfeedback)) {
                    ?>
                                                                                <div title="Rated <?= $jobfeedback->feedback_score; ?> out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                                                    <span style="width:<?= $rating_result; ?>%">
                                                                                        <strong itemprop="ratingValue"><?= $jobfeedback->feedback_score; ?></strong> out of 5
                                                                                    </span>
                                                                                </div>
                                                                                <span class="rate"><?= $jobfeedback->feedback_score; ?></span>

                                                                                <?php } else { ?>
                                                                                <div title="Rated 0 out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                                                    <span style="width:0%">
                                                                                        <strong itemprop="ratingValue">0</strong> out of 5
                                                                                    </span>
                                                                                </div>
                                                                                <span class="rate">0.00</span>
                                                                                <?php }
                                                                            } ?>

                                                                        <h6>
                                                                            <?php
                                                                            $this->db->select('*');
                                                                            $this->db->from('job_workdairy');
                                                                            $this->db->where('fuser_id', $job_data->fuser_id);
                                                                            $this->db->where('jobid', $job_data->job_id);
                                                                            $query_done = $this->db->get();
                                                                            $job_done = $query_done->result();
                                                                            $total_work = 0;
                                                                            if (!empty($job_done)) {
                                                                                foreach ($job_done as $work) {
                                                                                    $total_work += $work->total_hour;
                                                                                }
                                                                                echo $total_work . " hours";
                                                                            } else {
                                                                                echo "0.00 hours";
                                                                            }
                                                                            ?>

                                                                        </h6>
                                                                        <h3>
            <?php
            if ($job_data->offer_bid_amount) {
                $amount = $job_data->offer_bid_amount;
            } else {
                $amount = $job_data->bid_amount;
            }
            ?>
            <?php $total_price = $total_work * $amount; ?>
                                                              $<?= $total_price; ?> 
                                                                        </h3>
                                                                        <h4></h4>
                                                          <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

    <?php }
} else { ?>

                                                <div class="">
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
                                    </div>
                                           </div>
                                    <div class="col-md-4 col-sm-4">
                                        
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
                </div>
                <div class="main_portfolio">
                    <div class="protfilio">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="protfilhead">
                                    <h1>Portfolio</h1>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="proftilbutt">
                                    <button id="buttontrei"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; &nbsp;Add education</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mainprotfilio">
                    <div class="container">
                        <div class="row">
<?php
if (isset($portfolios) && is_array($portfolios) && sizeof($portfolios) > 0) {
    $count = 0;
    foreach ($portfolios as $portfolio) {
        if ($count % 4 == 0) {
            ?>
                                        <div class="clearfix"></div>
            <?php
        }
        ?>
                                    <div class="col-md-3 col-sm-3 col-xs-12" id="div-<?php echo $count ?>">
                                        <div class="col-md-12 col-xs-12 protfilimg">
                                            <div class="port_img">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                <a href="#" class="edit-portfolio" alt="<?php echo $count ?>" accesskey="<?php echo base64_encode($portfolio['id']) ?>">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>

                                                <a href="#" class="remove-portfolio" alt="<?php echo $count ?>" accesskey="<?php echo base64_encode($portfolio['id']) ?>">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                </a>
                                            </div>
                                                    <?php
                                                    if (strlen($portfolio['thumnail_image']) > 10) {
                                                        ?>
                                                <img class="img-responsive" src="<?php echo base_url() ?>uploads/portfolio/<?php echo $portfolio['thumnail_image']; ?>"/>
        <?php } else { ?>
                                                <img class="img-responsive" src="<?php echo base_url() ?>assets/profile/img/noimage.jpg"/>
                                    <?php } ?>
                                            <h1>
                                    <?php
                                    if (strlen($portfolio['project_url']) > 0) {
                                        ?>
                                                    <a target="_blank" href="<?php echo $portfolio['project_url'] ?>" title="click to view live site">
                                        <?php echo $portfolio['project_title'] ?>
                                                    </a>
        <?php } else echo $portfolio['project_title'] ?>
                                            </h1>
                                            </div>  
                                        </div>
                                    </div>
        <?php
        $count ++;
    }
}else {
    echo "No portfolio was added";
}
?>
                        </div>
                    </div>
                </div>
                <div class="mainprotfilio-mid">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="protilo-left">
                                    <h2>Experience</h2>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="protilo-right">
                                    <button id="buttontrei"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; &nbsp;Add education</button>
                                </div>
                            </div>
                        </div>
                    </div>
<?php $cntexp = count($experience);
foreach ($experience as $val) { ?>
                        <div class="mainprotfilio-mid-button">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="exp-showcase">  
                                            <div><b><a style="color:#grey; "href="#" id ="<?php echo $val->id; ?>" onclick="editClickedExp(this.id)" ><i class="fa fa-pencil" aria-hidden="true"></i></a> </b></div>
                                            <div><h4><a style="color:#000;" href=""><?php echo $val->title; ?></a> </h4></div> 
                                            <div class="company_name"><h4><a style="color:#494949;"href=""><span><?php echo $val->company; ?></span></a></h4></div>
                                            <div class="address_bar"><a  style="color:grey;" href="" class=""><span><?php echo $val->month1; ?>-<?php echo $val->year1; ?> To <?php echo $val->month2; ?>-<?php echo $val->year2; ?><!--2010Â â€“ Present (6 years 7 months)-->| <?php echo $val->location; ?></span></a></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mainprotfilio-mid-ph">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="feedback_comment">
                                            <p><?php echo $val->description; ?> </p>
                                        </div>	
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div><hr /></div>
<?php } ?>
                </div>
                <div class="protfilio-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="protfilheadtwo">
                                    <h1>Education</h1> 
                                </div>
                                <?php
                                foreach ($educations as $education) {
                                    ?> 
                                    <div class="education_head"> 
                                        <p><?= $education->school ?></p>
                                        <h2><?= $education->degree ?></h2>
                                        <h3><?= $education->dates_attend_from ?> – <?= $education->dates_attend_to ?></h3>
                                        <h4><?= $education->field_of_study ?></h4>
                                        <h5><?= $education->activities ?></h5>
                                        <h6><?= $education->description ?></h6>
                                    </div>  

    <?php
}
?>
                            </div> 

                            <div class="col-md-6 col-sm-6">
                                <div class="proftilbutttwo">
                                    <button id="buttontrei"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; &nbsp;Add education</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
<?php
$this->load->view("webview/profile/portfolio-modal");
$this->load->view("webview/profile/exp-modal");
// $this->load->view("webview/includes/footer"); 
$this->load->view("webview/includes/footer-common-script");
?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.remove-portfolio').click(function (e) {
                    e.preventDefault();
                    var key = $(this).attr('accesskey');
                    var div = $(this).attr('alt');
                    var con = confirm("Are you sure to remove?");
                    if (con) {
                        $.ajax({
                            url: "<?php echo base_url() ?>profile/remove-portfolio",
                            data: ({key: key}),
                            dataType: "json",
                            type: "post",
                            success: function (response) {
                                if (response.status == "success") {
                                    $('#div-' + div).remove();
                                } else {
                                    alert(response.msg);
                                }
                            },
                            error: function (status, error, textStatus) {
                                alert(error);
                            }
                        });
                    }
                });

                $('.edit-portfolio').click(function (e) {
                    e.preventDefault();
                    var key = $(this).attr('accesskey');
                    $.ajax({
                        url: "<?php echo base_url() ?>profile/edit-portfolio",
                        data: ({key: key}),
                        dataType: "html",
                        type: "post",
                        success: function (response) {
                            $('#portfolio-details-modal').html(response.trim());
                            $('#edit-portfolio').modal('show');
                        },
                        error: function (status, error, textStatus) {
                            alert(error);
                        }
                    });
                    $('#edit-portfolio').modal('show');
                });
            });
            function submitPortfolio(e) {
                e.preventDefault();
                $(this).val("Wait...").attr("disabled", true);
                $("#updatePorfolio").submit();
            }
            ;
            function afterUpload(msg) {
                $("#submit-portfolio").val("Submit").attr("disabled", false);
                if (msg.length > 0 && msg == "success") {
                    $('.sys-message').html("Your portfolio has been successfully updated").css({'color': 'green'});
                } else {
                    if (msg != "Invalid input found.") {
                        $('.sys-message').html(msg).css({'color': 'red'});
                    }
                }
            }
            function editClickedExp(clicked_id) {
                var key = $(this).attr('accesskey');
                $.ajax({
                    url: "<?php echo base_url() ?>profile/editExpProfile/" + clicked_id,
                    data: ({key: key}),
                    dataType: "html",
                    type: "post",
                    success: function (response) {
                        $('#exp-details-modal').html(response.trim());
                        $('#edit-exp').modal('show');
                    },
                    error: function (status, error, textStatus) {
                        alert(error);
                    }
                });
                $('#edit-exp').modal('show');
            }

            function uploadDatapath(param) {
                $(".sys-msg").empty(); // To remove the previous error message
                var file = param.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
                {
                    $('#previewing').attr('src', '<?php echo base_url() ?>assets/profile/img/noimage.jpg');
                    $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                    return false;
                } else
                {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(param.files[0]);
                }
            }
            ;
            function imageIsLoaded(e) {
                $("#file-upload").css("color", "green");
                $('#image_preview').css("display", "block");
                $('#previewing').attr('src', e.target.result);
                $('#previewing').attr('width', '250px');
                $('#previewing').attr('height', '130px');
            }
            ;
            function closeModal() {
                $('#edit-portfolio').modal('hide');
            }
            ;
        </script>
    </div>
</div>
<style>

.buttonsidefoure {
	margin-top:40px !important;
	margin-bottom:  !important;
	background: white;
	max-width: 370px;
	margin-right: -5px;
	margin-left: 20px;
	border: 1px solid #ccc;
	padding: 10px;
	height: 100%;
	padding-bottom: 20px;
}
.buttonsidefoure ul li {
	padding: 13px 0px 0px 5px;
}
.buttonsidefoure h2 {
	font-size: 21.26px;
	margin: -8px 30px 15px 7px;
	color: #494949;
	font-family:'Calibri';
	src: url(../fonts/Calibri.ttf);
	display: block;
	padding: 15px 0 0 0;
    font-weight:800;
}
.buttonsidefoure ul li a {
	text-decoration: none;
	color: #494949;
	font-family: 'Calibri';
	src: url(../fonts/Calibri.ttf);
	font-size: 16.26px;
	display: block;
	font-weight: bold;
}
span.rating-badge {
	background: #F77D0E none repeat scroll 0 0;
	border-radius: 2px;
	color: #fff;
	padding: 2px 4px 2px 5px;
	font-size: 12px;
}
.review_ratting {
  margin-bottom: 20px;
}
.user_view_img {
	margin-left: 15px;
}
.topmiddle {
	margin-left: 30px;
}
.user_view_img img {
	border-radius: 50%;
	height: 100px;
	width: 100px;
	margin: 10px 0px 6px 10px;
    }
span.rating-badge {
	background: #F77D0E none repeat scroll 0 0;
	border-radius: 2px;
	color: #fff;
	padding: 2px 4px 2px 5px;
	font-size: 12px;
}
</style>