<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, user-scalable=no">
    <?php $this->load->view("webview/includes/common-head"); ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/profile/css/style.css"/>
    <link rel='stylesheet' media='screen and (max-width: 600px)' href='<?php echo base_url() ?>assets/profile/css/mobile-style.css' />
    <link rel='stylesheet' media='screen and (min-width: 600px)' href='<?php echo base_url() ?>assets/profile/css/desktop-style.css' />
    <link rel='stylesheet' media='screen and (min-width: 601px) and (max-width: 900px)' href='<?php echo base_url() ?>assets/profile/css/tablet-style.css' />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/header.css"/>
</head>
<style>
.buttonsidethree {
    margin-top: 16px;
    border-bottom: 1px solid #bebebe;
}
</style>
<body>
    
    <?php $this->load->view("webview/includes/header"); ?>
    <div style="clear:both"></div>
    <div class="container">
        <div id="top-content">
                <div class="row">
                    <div class="mainwork">
                        <div class="col-md-2 col-sm-4" style="width: 140px">
                            <div class="topleftside">
                                <img class="" width="120" src="<?php echo base_url().$webUserInfo['webuser_picture']; ?>"/>
                                <div style="clear:both"></div>
                                <button id="buttonfirst">4.9</button><p>*****</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="topmiddle">
                                <h2><?php echo $webUserInfo['webuser_fname']." ".$webUserInfo['webuser_lname'] ?></h2>
                                <p><img src="<?php echo base_url() ?>assets/profile/img/flag.png"/>&nbsp;<?php echo $webUserInfo['webuser_country_name'] ?> </p>
                                <h3 style="padding-top: 10px;"><?php echo $basicDetails["tagline"] ?></h3>
                                <h4 style="padding-top: 10px;">$<?php echo $basicDetails["hourly_rate"] + $basicDetails["hourly_rate"]*WINJOB_FEE ?> USD/hr</h4>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-4">
                            <div class="topriht">
								<a href="<?php echo base_url() ?>my-offers">
                                <button id="buttonsecond">Hire Me &nbsp;&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></button>
								</a>
                            </div>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                    <div class="middle">
                        <div class="container">
                            <div class="midlmain">
                                <div class="row">
                                    <div class="col-md-8 col-sm-8">
                                        <div class="divison">
                                            <div class="buttonside">
                                                <?php
                                                $skills = $basicDetails['skills'];
                                                if(strlen($skills) > 0){
                                                    ?>
                                                <ul>
                                                    <?php
                                                    $skillSplit = explode(",", $skills);
                                                    if(sizeof($skillSplit) > 0){
                                                       for($i = 0;$i<sizeof($skillSplit);$i++) {
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
                                            <div class="buttonsidetwo">
                                                <h2>Overview</h2>
                                                <p><?php echo $basicDetails['overview'] ?></p>
                                            </div>
											
											<div class="buttonsidethree">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<div class="buttonsidethreeleft">
															<h2>Job History</h2>
														</div>
													</div>
												</div>
											</div>
											
											
											<?php
										
											if(!empty($accepted_jobs)){ 
											foreach($accepted_jobs as $job_data){
												
												
$this->db->select('*');
$this->db->from('job_feedback');
$this->db->where('job_feedback.feedback_userid',$job_data->fuser_id);
$this->db->where('job_feedback.sender_id !=',$job_data->fuser_id);
$this->db->where('job_feedback.feedback_job_id',$job_data->job_id);
$query=$this->db->get();
$jobfeedback= $query->row();
												
												
											?>
											<div class="buttonsidethree">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<div class="buttonsidethreeleft">
															 <p><?=$job_data->hire_title?></p>
															 <h3><?php  echo date(' F j, Y ', strtotime($job_data->start_date)); ?> - <?php  echo date(' F j, Y ', strtotime($job_data->end_date)); ?></h3>
															 <p style="color: #bebebe; font-style: italic;">
																<?php if(!empty($jobfeedback)){
																	echo $jobfeedback->feedback_comment;
																
																	$rating_result = ($jobfeedback->feedback_score/5)*100;
																} ?>
															 </p>
														</div>
													</div>
													<div class="col-md-6 col-sm-6">
																<div class="buttonsidethreeright" style="padding:0;">
												
													
													<?php if($job_data->job_type == "fixed"){ ?>
															
																<?php if(!empty($jobfeedback)){ ?>
																
																	<div title="Rated <?=$jobfeedback->feedback_score;?> out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
																	<span style="width:<?=$rating_result;?>%">
																		<strong itemprop="ratingValue"><?=$jobfeedback->feedback_score;?></strong> out of 5
																	</span>
																	</div>
																	<span class="rate"><?=$jobfeedback->feedback_score;?></span>
																<?php }else{ ?>
																	<div title="Rated 0 out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
																	<span style="width:0%">
																		<strong itemprop="ratingValue">0</strong> out of 5
																	</span>
																	</div>
																	<span class="rate">0.00</span>
																<?php } ?>
																	 <h6>$<?=$job_data->bid_amount?></h6>
																	 <h3>Paid $<?=$job_data->fixedpay_amount?></h3>
																	 <h4></h4>
																
													<?php } else { ?>
														
																<?php if(!empty($jobfeedback)){ ?>
																<div title="Rated <?=$jobfeedback->feedback_score;?> out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
																<span style="width:<?=$rating_result;?>%">
																	<strong itemprop="ratingValue"><?=$jobfeedback->feedback_score;?></strong> out of 5
																</span>
																</div>
																<span class="rate"><?=$jobfeedback->feedback_score;?></span>
															<?php }else{ ?>
																<div title="Rated 0 out of 5" class="star-rating pull-left" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
																<span style="width:0%">
																	<strong itemprop="ratingValue">0</strong> out of 5
																</span>
																</div>
																<span class="rate">0.00</span>
															<?php } ?>
																
																 <h6>
																 <?php
																 $this->db->select('*');
																$this->db->from('job_workdairy');
																$this->db->where('fuser_id',$job_data->fuser_id);
																$this->db->where('jobid',$job_data->job_id);
																$query_done = $this->db->get();
																$job_done = $query_done->result();
																  $total_work = 0;
																	if(!empty($job_done)){
																		foreach($job_done as $work){
																			$total_work +=$work->total_hour;
																		}
																		echo $total_work." hours";
																	}else{
																		echo "No limit";
																	}
																?>
																 
																 </h6>
																 <h3>
																	<?php if($job_data->offer_bid_amount) {
									$amount = $job_data->offer_bid_amount;
									} else {$amount =  $job_data->bid_amount;} ?>
																	<?php $total_price= $total_work *$amount;?>
																	$<?=$total_price?> 
																 </h3>
																 <h4></h4>
															
													<?php } ?>
													</div>
													</div>
												</div>
											</div>

											<?php } } else { ?>	
												
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
                                        <div class="col-md-4 col-sm-4">
                                            <div class="buttonsidefoure">
                                                <h2>work history</h2>
                                                <ul>
                                                   <li><a href=""><i class="fa fa-asterisk" aria-hidden="true"></i>&nbsp;5.00<p>&nbsp;*****</p></a></li>
                                                   <li><a href=""><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;$<?php echo $basicDetails["hourly_rate"] + $basicDetails["hourly_rate"]*WINJOB_FEE ?> <span>hourly rate</span></a></li>
                                                   <li>
													<a href="">
														<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
														<?php
															$this->db->select('*');
															$this->db->from('job_workdairy');
															$this->db->where('fuser_id',$job_data->fuser_id);
															$query_done_hour = $this->db->get();
															$workdone_done = $query_done_hour->result();
															  $total_hourwork = 0;
																	if(!empty($workdone_done)){
																		foreach($workdone_done as $workdone){
																			$total_hourwork +=$workdone->total_hour;
																		}
																		echo $total_hourwork." <span>Total Hours Worked</span>";
																	}else{
																		echo "No Hours Worked Yet";
																	}
																?>
													</a>
												   </li>
                                                   <li>
														<a href="<?php echo base_url() ?>ended-jobs">
															<i class="fa fa-suitcase" aria-hidden="true"></i>&nbsp;
															<?php
															if(!empty($accepted_jobs)){ 
															echo count($accepted_jobs)." <span>Total Jobs Completed</span>";
															}else{
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
                                <div style="clear:both"></div>
                                </div>
                            </div>
                        </div>
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
                                    if(isset($portfolios) && is_array($portfolios) && sizeof($portfolios) > 0){
                                        $count = 0;
                                        foreach ($portfolios as $portfolio) {
                                        if($count % 4 == 0){
                                         ?>
                                    <div class="clearfix"></div>
                                    <?php
                                            }
                                   ?>
                                    <div class="col-md-3 col-sm-3 col-xs-12" id="div-<?php echo $count ?>">
                                        <div class="col-md-12 col-xs-12 protfilimg">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <a href="#" class="edit-portfolio" alt="<?php echo $count ?>" accesskey="<?php echo base64_encode($portfolio['id']) ?>">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                
                                                <a href="#" class="remove-portfolio" alt="<?php echo $count ?>" accesskey="<?php echo base64_encode($portfolio['id']) ?>">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                </a>
                                            </div>
                                            <?php
                                                if(strlen($portfolio['thumnail_image']) > 10){
                                             ?>
                                                <img class="img-responsive" src="<?php echo base_url() ?>uploads/portfolio/<?php echo $portfolio['thumnail_image']; ?>"/>
                                            <?php }else{ ?>
                                                <img class="img-responsive" src="<?php echo base_url() ?>assets/profile/img/noimage.jpg"/>
                                            <?php }?>
                                            <h1>
                                                <?php
                                                if(strlen($portfolio['project_url']) > 0){
                                                ?>
                                                <a target="_blank" href="<?php echo $portfolio['project_url'] ?>" title="click to view live site">
                                                    <?php echo $portfolio['project_title'] ?>
                                                </a>
                                                <?php } else echo $portfolio['project_title']?>
                                            </h1>  
                                        </div>
                                    </div>
                                    <?php
                                    $count ++;
                                        }
                                    }else{
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
                <div class="mainprotfilio-mid-button">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="lastbutton">
                                    <ul>
                                        <li><a href="">SEO MANAGER</a></li>
                                        <li><a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        <li><a href=""><span>Top SEO World</span></a></li>
                                        <li><a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        <li ><a href="" class="active"><span>2010 – Present (6 years 7 months)| USA</span></a></li>
                                        <li><a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mainprotfilio-mid-ph">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="lsatphrap">
                                    <p>Top rankings for more than 200 websites with pure white hat techniques. I'm using of latest updates of Panda & Penguin,Hummingbird  Algorithms.My services include detailed on page, off page and social media marketing techniques that leads to top rankings and Relevant traffic.Kindly share your chat id for fast communication. If You select me,I will not disappoint you and provide your desired results With quality work.Please let me know in case of any doubts. I look forward to hearing from you.For your kind information, I am a Professional, full time and Quality worker</p>
                                </div>	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="protfilio-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="protfilheadtwo">
                                <h1>Education</h1>
                                <p>American internation U</p>
                                <h2>B.SC, CSE, A</h2>
                                <h3>2005 – 2009</h3>
                                <h4>I have successfully completed B.SE In computer Science</h4>
                                <h5>Activities and Societies</h5>
                                <h6>Education Description</h6>
                            </div>
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
    <?php 
    $this->load->view("webview/profile/portfolio-modal");
    $this->load->view("webview/includes/footer"); 
    $this->load->view("webview/includes/footer-common-script"); 
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.remove-portfolio').click(function(e){
                e.preventDefault();
                var key = $(this).attr('accesskey');
                var div = $(this).attr('alt');
                var con = confirm("Are you sure to remove?");
                if(con){
                    $.ajax({
                        url:"<?php echo base_url() ?>profile/remove-portfolio",
                        data:({key:key}),
                        dataType : "json",
                        type :"post",
                        success:function(response){
                            if(response.status == "success"){
                                $('#div-'+div).remove();
                            }else{
                                alert(response.msg);
                            }
                        },
                        error: function(status,error,textStatus){
                            alert(error);
                        }
                    });
                }
            });
            
            $('.edit-portfolio').click(function(e){
                e.preventDefault();
                var key = $(this).attr('accesskey');
                $.ajax({
                    url:"<?php echo base_url() ?>profile/edit-portfolio",
                    data:({key:key}),
                    dataType : "html",
                    type :"post",
                    success:function(response){
                        $('#portfolio-details-modal').html(response.trim());
                        $('#edit-portfolio').modal('show');
                    },
                    error: function(status,error,textStatus){
                        alert(error);
                    }
                });
                $('#edit-portfolio').modal('show');
            });
        });
         function submitPortfolio(e){
            e.preventDefault();
            $(this).val("Wait...").attr("disabled",true);
            $("#updatePorfolio").submit();
         };
          function afterUpload(msg){
              $("#submit-portfolio").val("Submit").attr("disabled",false);
              if(msg.length > 0 && msg == "success"){
                 $('.sys-message').html("Your portfolio has been successfully updated").css({'color':'green'});
              }else{
                  if(msg != "Invalid input found."){
                      $('.sys-message').html(msg).css({'color':'red'});
                  }
              }
          }
        
        function uploadDatapath(param){
            $(".sys-msg").empty(); // To remove the previous error message
            var file = param.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
            {
            $('#previewing').attr('src','<?php echo base_url()?>assets/profile/img/noimage.jpg');
            $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
            return false;
            }
            else
            {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(param.files[0]);
            }
        };
        function imageIsLoaded(e) {
            $("#file-upload").css("color","green");
            $('#image_preview').css("display", "block");
            $('#previewing').attr('src', e.target.result);
            $('#previewing').attr('width', '250px');
            $('#previewing').attr('height', '130px');
        };
        function closeModal(){
            $('#edit-portfolio').modal('hide');
        };
    </script>
</body>
</html>