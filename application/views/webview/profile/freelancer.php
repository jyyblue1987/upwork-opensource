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
<!-- this css update by indsys tech 3 march -->

 <style type="text/css">


    
 </style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/pages/freelancer-profile.css" />
<section id="big_header">
<!-- end code of 3 march indsys tech-->
 
<div class="clear-both"></div>
<div class="">
    <div id="top-content">
            <div class="mainwork">
             <div class="row no-pad-mob">
                 <div class="col-md-9 margin-top-4 no-pad-mob">
                    <div class="header_border">
                        <div class="col-md-3 col-sm-4">
                            <div class="user_view_img">
                            <?php if(!empty($userimg->cropped_image)){ ?>
                                <img class="" width="120" src="<?php echo $userimg->cropped_image;?>"/>
                            <?php }else{ ?>
                            <img class="" width="120" src="<?php echo site_url("assets/user.png");?>"/>
                            <?php } ?>
                            </div>
                                <?php
                                if ($total_budget != 0) {
                                    $totalscore = ($total_feedbackScore / $total_budget);
                                    $rating_feedback = ($totalscore / 5) * 100;
                                } else {
                                    $totalscore = null;
                                    $rating_feedback = null;
                                }
                                ?>
                            <div class="row marg-left-lg">
                                <div class="col-md-3 col-xs-2 no-pad-mob">
                                    <span class="rating-badge"><?= $current_user_rating ?></span>
                                </div>
                                <div class="col-md-9 col-xs-10 marg-top">
                                    <div title="Rated <?= $jobfeedback->feedback_score; ?> out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                    <span style="width:<?= $rating_result; ?>%">
                                    <strong itemprop="ratingValue"><?= $jobfeedback->feedback_score; ?></strong> out of 5</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-md-9 col-sm-4 no-pad">
                                <div class="row">
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="topmiddle">
                                            <h4 class="marg-bot-0"><?php echo $webUserInfo['webuser_fname'] . " " . $webUserInfo['webuser_lname'] ?></h4>
                                            
                                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?php echo $webUserInfo['webuser_country_name'] ?> <?=$localtime?></p>
                                            <h3 class="pad-top-0"><?php echo $basicDetails["tagline"] ?></h3>
                                            <div class="buttonside marg-top--15">
                                                <?php
                                                $skills = $basicDetails['user_skills'];


                                                if (count($skills) > 0) {
                                                ?>
                                                <ul>
                                                <?php
                                                    foreach ($skills as $key => $value) {
                                                ?>
                                                    <li><a href=""><?php echo $value['skill_name']; ?></a></li>
                                                <?php
                                                    }
                                                ?>
                                                </ul>
                                                    <?php
                                                }
                                                ?>

                                                <div class="clear-both"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="topriht">
                                            <h4>$<?php echo $basicDetails["hourly_rate"] + $basicDetails["hourly_rate"] * WINJOB_FEE ?> USD/hr</h4> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="clear-both"></div>
                            <div class="top_border"></div>
                            <div class="buttonsidetwo">
                                <h2>Overview</h2>
                                <p><?php echo $basicDetails['overview'] ?></p>
                            </div>
                    </div>
                 
              </div>
              <div class="col-md-3 no-pad-mob">
                 
                                        <div class="buttonsidefoure">
                                            <h2 class="marg-5">Work History</h2>
                                            <ul class="main_side_nav_bar cus_main_side_nav_bar">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-3 col-xs-2">
                                                            <span class="rating-badge"><?= $current_user_rating ?></span>
                                                        </div>
                                                        <div class="col-md-9 col-xs-10 marg-top">
                                                            <div title="Rated <?= $jobfeedback->feedback_score; ?> out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                            <span style="width:<?= $rating_result; ?>%">
                                                            <strong itemprop="ratingValue"><?= $jobfeedback->feedback_score; ?></strong> out of 5</span>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                </li>
                                                <li>
                                                    <i class="fa fa-credit-card-alt pull-left marg-top-5"></i>
                                                    <a href="">&nbsp;$<?php echo $basicDetails["hourly_rate"] + $basicDetails["hourly_rate"] * WINJOB_FEE ?> <span>/hour</span></a>
                                                </li>
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
                                                    <a href="<?php echo base_url() ?>ended-jobs">
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
                                                <li><a href=""><i class="fa fa-tree marg-right-5" aria-hidden="true"></i>&nbsp;<?php echo $basicDetails["work_experience_year"] ?><span> Years Experience</span></a></li>
                                                
                                                <li><a href=""><i class="fa fa-map-marker marg-right-10" aria-hidden="true"></i>&nbsp;<?php echo $webUserInfo['webuser_country_name'] ?>
                                                        <span></span></a></li>
                                            </ul>
                                        </div>  
                                
              </div>
            </div>
            <div class="row">
                <div class="col-md-9 col-xs-12 col-sm-12 col-lg-9 no-pad-mob">                                
                    <div class="job-history overflow-hidden">
                                    <div class="buttonsidethree">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 no-pad-mob">
                                                <div class="buttonsidethreeleft">
                                                    <h2>Job History</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    
                                <?php
                                if (!empty($accepted_jobs)) {
                                    $accepted_jobs_count = count($accepted_jobs) - 1;
                                    foreach ($accepted_jobs as $index => $job_data) {
                                        $this->db->select('*');
                                        $this->db->from('job_feedback');
                                        $this->db->where('job_feedback.feedback_userid', $job_data->fuser_id);
                                        $this->db->where('job_feedback.sender_id !=', $job_data->fuser_id);
                                        $this->db->where('job_feedback.feedback_job_id', $job_data->job_id);
                                        $query = $this->db->get();
                                        $jobfeedback = $query->row();
                                        ?>
                                        
                                     
                                <div class="history_section  <? echo $accepted_jobs_count != $index ? "his_" : "";?> his_bord">                                
                                        <div class="row no-pad">
                                            <div class="col-md-8 col-sm-6 col-xs-12 no-pad-mob">
                                                <div class="buttonsidethreeleft">
                                                    <p> <?= $job_data->hire_title ?></p>
                                                    <h3 class="marg-bot--8"><?php echo date(' M j, Y ', strtotime($job_data->start_date)); ?>
                                                    <?php if ($job_data->jobstatus == 1) {
                                                    echo " - " . date(' M j, Y ', strtotime($job_data->end_date));
                                                    } ?>
                                                    </h3>
                                                    <p class="job-status">
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
                                            
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <?php if ($job_data->job_type == "fixed") { ?>
                                                <div class="buttonsidethreeright pull-right pad-0">
                                                    <?php } else { if ($job_data->jobstatus == 1) {
                                                    ?>
                                                    <div class="buttonsidethreeright pull-right pad-0"> <?php } else { ?>
                                                        <div class="buttonsidethreeright pull-right pad-0">
                                                            <?php }
                                                        } ?>


                                                        <?php
                                                        if ($job_data->job_type == "fixed") {?>
                                                        <!--<h6>$<?= $job_data->bid_amount ?></h6>-->

                                                            <h3 class="style">Paid $<?= $total_price_fixed = $job_data->fixedpay_amount ?></h3><br>
                                                        <?php
                                                        if ($job_data->jobstatus == 1) {
                                                        if (!empty($jobfeedback)) {
                                                        ?>

                                                        <div title="Rated <?= $jobfeedback->feedback_score; ?> out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                        
                                                        <span style="width:<?= $rating_result; ?>%">
                                                        
                                                        <strong itemprop="ratingValue"><?= $jobfeedback->feedback_score; ?></strong> out of 5</span>
                                                        
                                                        </div>
                                                        
                                                        <span class="rate"><?= $jobfeedback->feedback_score; ?></span>
                                                        
                                                        <?php } else { ?>
                                                            
                                                            <div title="Rated 0 out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                                
                                                                <span class="width-0">
                                                                    <strong itemprop="ratingValue">0</strong> out of 5
                                                                </span>
                                                                
                                                            </div>
                                                            
                                                            <span class="rate">0.00</span>
                                                                <?php }
                                                            } ?>

                                                            
                                                        <?php
                                                        } else {?>
                                                            <h6 class="text-right">
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
                                                            <h3 class="text-right marg-bot-0 marg-top-0">
                                                        <?php
                                                        if ($job_data->offer_bid_amount) {
                                                        $amount = $job_data->offer_bid_amount;
                                                        } else {
                                                        $amount = $job_data->bid_amount;
                                                        }
                                                        ?>
                                                        <?php $total_price = $total_work * $amount; ?>
                                                        $<?= $total_price; ?> 
                                                            </h3><?php
                                                        if ($job_data->jobstatus == 1) {
                                                        if (!empty($jobfeedback)) {
                                                        ?>
                                                            <div title="Rated <?= $jobfeedback->feedback_score; ?> out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                                <span style="width:<?= $rating_result; ?>%">
                                                                    <strong itemprop="ratingValue"><?= $jobfeedback->feedback_score; ?></strong> out of 5
                                                                </span>
                                                            </div>
                                                                    <span class="rate pull-right"><?= $jobfeedback->feedback_score; ?></span>

                                                                    <?php } else { ?>
                                                                    <div title="Rated 0 out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                                        <span class="width:0%">
                                                                            <strong itemprop="ratingValue">0</strong> out of 5
                                                                        </span>
                                                                    </div>
                                                                    <span class="rate">0.00</span>
                                                                    <?php }
                                                                } ?>

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
                                    <div class="col-md-3 col-sm-3">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
            </div>
            </div>
              <?php if ($this->session->userdata('type') == 2) { ?>
            <div class="row pad-left-right">
                <div class="main_portfolio col-md-9 col-sm-12 col-xs-12 no-pad-mob">
                    <div class="protfilio">
                    <div class="">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="protfilhead">
                                    <h3>Portfolio</h3>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="proftilbutt">
                                    <p class="exp-but"><a href="#" id ="buttonrei" class="color-gray"><i class="fa fa-plus" aria-hidden="true"></i></a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mainprotfilio">
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
                                        <div class="col-md-12 col-xs-12 protfilimg no-pad">
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
                        <div><hr></div>
                </div>
                <div class="mainprotfilio-mid no-pad-mob">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="protilo-left">
                                <h3>Experience</h3>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="protilo-right">
                                <p class="exp-but"><a href="#" id ="buttonrei" class="color-gray"><i class="fa fa-plus" aria-hidden="true"></i></a> </p>
                            </div>
                        </div>
                    </div>
<?php $cntexp = count($experience);
foreach ($experience as $val) { ?>
    <div class="mainprotfilio-mid-button">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 exp-showcase">
                   <p class="exp-but"><a href="#" id ="<?php echo $val->id; ?>" onclick="editClickedExp(this.id)" class="color-gray"><i class="fa fa-pencil" aria-hidden="true"></i></a> </p>
                    <p class="exp-title"><a href=""><?php echo $val->title; ?></a></p>

                    <p class="exp-company"><a href=""><?php echo $val->company; ?></a></p>
                    <p class="exp-year"><a href="">
                            <span>
                                <?= DatetimeHelper::getMonthByNum($val->month1)."-".$val->year1; ?>
                                <?php if ((int)$val->year2 === 0) {
                                    echo ' - Till present | ';
                                }
                                else {
                                    echo 'To ' . DatetimeHelper::getMonthByNum($val->month2) . ' - ' . $val->year2." | ";
                                    ;
                                } 
                                 echo $val->location; 
                                ?>
                            </span>
                        </a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="mainprotfilio-mid-ph">
        <div class="">
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
                    <div class="">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="protfilheadtwo">
                                    <h3>Education</h3> 
                                </div>
                            </div> 

                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="proftilbutttwo">
                                <p class="exp-but"><a href="#" id ="buttonrei" class="color-gray"><i class="fa fa-plus" aria-hidden="true"></i></a> </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php
                            $educ_count = count($educations) - 1;
                            foreach ($educations as $index => $education) {
                                ?> 
                                <div class="education_head"> 
                                    <p class="exp-title"><a><?= $education->school ?></a></p>
                                    <p class="exp-company"><a><?= $education->degree ?></a></p>
                                    <p class="exp-company"><a><?= $education->field_of_study ?></a></p>
                                    <p class="exp-company"><a><?= $education->activities ?></a></p>
                                    <p class="exp-year"><a><?= $education->dates_attend_from ?> – <?= $education->dates_attend_to ?></a></p>
                                    <div class="feedback_comment"><p><?= $education->description ?></p></div>
                                </div>
                                <? echo $educ_count != $index ? "<hr>" : "";?> 
                            <?php } ?>
                        </div>
                    </div>
                </div>
                </div>
                <?php } ?>
        </div>
<?php
$this->load->view("webview/profile/portfolio-modal");
$this->load->view("webview/profile/exp-modal");
$this->load->view("webview/profile/edu-modal");
// $this->load->view("webview/includes/footer"); 
$this->load->view("webview/includes/footer-common-script");
?>
        <script type="text/javascript">
            var base_url = '<?php echo base_url() ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/internal/profile.js"></script>
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
            // 2017-02-24 - changed by Kalskov Vladimir - spirit@taganlife.ru
            // @param e - event object
            // @param t - this object from click event
            function submitPortfolio(e, t) {
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
</div></section>
