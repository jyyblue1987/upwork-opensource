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

<?php  
//var_dump($webUserInfo);die();
  $this->db->select('*');
                $this->db->from('job_accepted');
                $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
                $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
                $this->db->where('job_accepted.fuser_id',$webUserInfo['webuser_id']);
                $query=$this->db->get();
                $accepted_jobs = $query->result();
                $total_feedbackScore=0 ;
                $total_budget=0 ;
             if(!empty($accepted_jobs)){
                foreach($accepted_jobs as $job_data){
                    $this->db->select('*');
                    $this->db->from('job_feedback');
                    $this->db->where('job_feedback.feedback_userid',$job_data->fuser_id);
                    $this->db->where('job_feedback.sender_id !=',$job_data->fuser_id);
                    $this->db->where('job_feedback.feedback_job_id',$job_data->job_id);
                    $query=$this->db->get();
                    $jobfeedback= $query->row();
                    
                    if($job_data->jobstatus == 1){
                        if(!empty($jobfeedback)){
                            if($job_data->job_type == "fixed"){
                                $total_price_fixed=$job_data->fixedpay_amount;
                                $total_feedbackScore += ($jobfeedback->feedback_score *$total_price_fixed);
                                $total_budget += $total_price_fixed;
                            }else{
                                $this->db->select('*');
                                $this->db->from('job_workdairy');
                                $this->db->where('fuser_id',$job_data->fuser_id);
                                $this->db->where('jobid',$job_data->job_id);
                                $query_done = $this->db->get();
                                $job_done = $query_done->result();
                                $total_work = 0;
                                foreach($job_done as $work){
                                    $total_work +=$work->total_hour;
                                }
                                
                                if($job_data->offer_bid_amount) {
                                $amount = $job_data->offer_bid_amount;
                                } else {$amount =  $job_data->bid_amount;} 
                                 $total_price= $total_work *$amount;
                                $total_budget += $total_price ;
                                $total_feedbackScore += ($jobfeedback->feedback_score *$total_price);
                            }
                        }
                    }
                }
             }

$slag = strtolower(str_replace(' ', '-', $webUserInfo['webuser_fname'] .'-'. $webUserInfo['webuser_lname']));?>
<body> 
    <div style="clear:both"></div>
    <div class="container">
        <div id="top-content">
            <div class="row margin-top-4">
                <div class="">
                    <div class="row">
                        <div class="col-md-9">
                            <div style="border-bottom: 0;" class="header_border">
                                <div class="col-md-2 col-sm-4"style="width: 140px">
                        <div style="padding-top: 13px;" class="topleftside">
                            <div style="margin-left: 10px;" class="user_view_img">
                                <img class=""  src="<?php echo base_url().$webUserInfo['webuser_picture']; ?>"/>
                            <div style="clear:both"></div>
                            
                             <p><div style="margin-top:1px;" class="review_ratting review_ratting_left">
                                               <?php
                        if ($total_budget != 0) {
                            $totalscore = ($total_feedbackScore / $total_budget);
                            $rating_feedback = ($totalscore / 5) * 100;
                        } else {
                            $totalscore = null;
                            $rating_feedback = null;
                        }
                        ?>
                        <span style="margin-left: 5px;font-size: 10px;" class="rating-badge"><?=number_format((float)$totalscore,1,'.','');?></span>
                        <div title="Rated <?= $totalscore; ?> out of 5" class="star-rating rating_value" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left: 21%;margin-top: -4%;position: absolute;">
                            <span style="width:<?= $rating_feedback; ?>%;font-size: 19px !important;left: 10px;">
                                <strong itemprop="ratingValue"><?= $totalscore; ?></strong> out of 5
                            </span>
                        </div>
                                         </div></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-4">
                    <div class="topmiddle" style="padding-left: 5px;margin-right: -40px;">
                      <!--  <h2><?php echo $this->session->userdata("username") ?></h2>-->
					  <div style="overflow: hidden;">
						<h4 class="pull-left" style="text-transform: uppercase;" "font-size:18px"> <?php echo $webUserInfo['webuser_fname'] .'&nbsp'. $webUserInfo['webuser_lname'];?></h4>
						
						<h4 class="pull-right" style="padding-top:">$<?php if(($job_info[0]->job_type) == 'fixed'){ echo $job_info[0]->bid_amount; } else {echo $job_info[0]->bid_amount."/hr";} ?></h4>
					  </div>
					  
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i>
&nbsp;<?php echo $webUserInfo['webuser_country_name'] ?> </p>
                        <h3 style="color:#494949;padding-top: 10px;"><?php echo $basicDetails["tagline"] ?></h3>
                        <div class="col-md-12 col-sm-12">
                        <div style="padding-bottom: 55px;" class="buttonside">
                                <?php
                                $skills = $basicDetails['skills'];
                                if(strlen($skills) > 0){
                                    ?>
                                <ul style="margin-top: -27px;">
                                    <br/>
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
                        </div>
                    </div>
                </div>
                <div style="clear:both"></div>
                            </div>
                        </div>
                 
                        <div class="col-md-3">
                           <div class="side_header">
                                <div class="topriht align-center">
						<?php if($ststus->isactive==1){ ?>
							<?php if($job_info[0]->hired == 0){ ?>
								<?php if(($job_info[0]->job_type) == 'fixed'){?>
										<a href="<?php echo base_url() ?>jobs/confirm_hired_fixed?user_id=<?=$_GET['user_id'];?>&job_id=<?=$_GET['job_id'];?>">
								<?php	} else {?>
										<a href="<?php echo base_url() ?>jobs/confirm_hired_hourly?user_id=<?=$_GET['user_id'];?>&job_id=<?=$_GET['job_id'];?>">
								<?php	} ?>
									
									 <button id="buttonsecond">Hire Me&nbsp;&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></button>
								</a>
							<?php	} ?>
						<?php } ?>
                        <br/>
						
                        
						<a href="<?php echo base_url() ?>profile/profile_freelancer?user=<?php echo base64_encode($webUserInfo['webuser_id']);?>&name=<?=$slag;?>" ><button class="btn" id="view-profile-btn">View Profile</button></a>
						
                        <br/>
                        <div style="margin-bottom: 11px;" class="col-md-12 col-sm-12 decline-line">
                            <i class="fa fa-times-circle" aria-hidden="true"></i> 
                            <small><a href="javascript:void(0)" onclick="Confirmdecline(<?php echo $job_info[0]->id;?>);">Decline Candidate </a></small>
                        </div>
                    </div>
                           </div>
                        </div>
                    </div>
            </div>
            <div class="middle">
                <div class="container">
                    <div class="midlmain">
                        <div class="row">
                            <div class="col-md-9 col-sm-9" style=""> 
								<div class="col-lg-12 col-md-12 col-sm-12 chat-screen">
								<div style="height: 430px;background: #fff;" class="mass_box">
									<div class="chat-details-topbar">
										<h3><?=$webUserInfo['webuser_fname']?>  <?=$webUserInfo['webuser_lname']?></h3>
										<h5><?=$job_info[0]->title?></h5>
<!--										<p></p>-->
									</div>
									<div class="chat-details ">
										<ul id="scroll-ul">
										<?php
										//$chat_details = array_reverse($chat_details);
										$group_time = false;
										$current_date = strtotime(date("d-m-Y"));
										$date ='';$temp_date ='';
										
										if(!empty($messages)){
										foreach($messages as $chat_data) {
										
										if(($chat_data->webuser_picture) == "") { 
											$src = site_url("assets/user.png");
										 } else { 
											$src = base_url().$chat_data->webuser_picture;
										 } 
										
										$temp_date = date("d-m-Y", strtotime($chat_data->created));
										if($date != strtotime($temp_date)){
											$date = strtotime($temp_date);
											$group_time = true;
										}
										else {
											$group_time = false;
										}
										
										if($group_time){
											
										?>
										<li><span class="group-date"><?php if($date == $current_date) { echo "Today";} else { echo date("l, F j, Y", $date);}?></span></li>
										
										<?php } ?>
											<li style="padding:20px">							
												<span class="name"><img src="<?=$src?>"><?=$chat_data->webuser_fname?> <?=$chat_data->webuser_lname?></span> <span class="chat-date"><?=date("g:i a", strtotime($chat_data->created))?></span>
												<span id="scroll" class="details"><?=$chat_data->message_conversation?></span>
											</li>
										<?php } }?>

										</ul>
									</div>
									<div class="chat-bar">
										<form id="chat_form" action="">
										<input type="hidden" id="bid_id" name="bid_id" value="<?=$job_info[0]->id?>">
										<input type="hidden" name="job_id" id="job_id" value="<?=$job_info[0]->job_id?>">
										<input type="hidden" name="user_id" id="user_id" value="<?=$job_info[0]->user_id?>">
										<div  class="chat_border"style="width:80%;float: left;height: 100px;">
				<textarea name="chat-input" id="chat-input" rows="4"></textarea>
                                    <div class="attach_icon"></div>
										</div>
										<div class="sms_send_btn" style="width:20%;float: left;height: 100px;"><a href="javascript:void(0);" id="submit">SEND</a></div>
										</form>
										<span id="error_span" style="color:red;padding: 0 0 0 15px;display:none;"></span>
										<span id="success_span" style="color:green;padding: 0 0 0 15px;display:none;"></span>
									</div>
									
								</div>
								</div>
								<div class="col-md-12 col-sm-12 white-box bordered_cl" style="margin-top:20px;margin-bottom:40px;border: 1px solid #ddd;" >
                                    <div style="padding: 0 15px;" class="cover_box">
                                        <p class="cover-letter">Cover Letter<br/></p>
                                    <p class="cover-letter-text" style="margin-left: 14px !important;">
                                        <?=$job_info[0]->cover_latter?>
                                    </p>
									<br/>
                                    </div>
                                </div>
								
								  
                                
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div style="margin-top: -35px !important;" class="buttonsidefoure">
                              

                                    <h2 style="margin: 0;padding: 0;margin-left: 12px;padding-bottom: 20px;"><b>Work History</b></h2>
									
                                    <ul class="main_side_nav_bar custom_li">
										<li>
											<div class="review_ratting review_ratting_right">
												<?php if($total_feedbackScore !=0 && $total_budget!=0){
												$totalscore = ($total_feedbackScore / $total_budget);
												$rating_feedback = ($totalscore/5)*100;
												?>
												
												<span style="font-size: 10px;margin-left: 4px;margin-right: 3px;" class="rating-badge"><?=number_format((float)$totalscore,1,'.','');?></span>
												
												<div title="Rated <?=$totalscore;?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em;margin-top:-5px;width:105px; color:#DEDEDE;">
													<span style="width:<?=$rating_feedback;?>% ;margin-top:-3px;">
													   <strong itemprop="ratingValue"><?=$totalscore;?></strong> out of 5
													</span>
												</div>
												<?php  }else{ ?>
												<span class="rating-badge">0.0</span>
												<div title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em; margin-top:-5px;">
												<span style="width:0% ;margin-top:0px;">
												   <strong itemprop="ratingValue">0</strong> out of 5
												</span>
												</div>
												<?php   } ?>
											</div>
										</li>

										<li style="margin-top: -30px;margin-left: 8px;" class="main_hourly_rate">
											<div>
												<a href="">
													<i style="font-size: 17px;" class="fa fa-credit-card-alt" aria-hidden="true"></i>
													&nbsp;$<?php echo $basicDetails["hourly_rate"] + $basicDetails["hourly_rate"]*WINJOB_FEE ?> <span>/hr</span>
												</a>
											</div>
										</li>

										<li>
											<a href=""><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
											<?php
											$this->db->select('*');
											$this->db->from('job_workdairy');
											$this->db->where('fuser_id',$webUserInfo['webuser_id']);
											$query_done = $this->db->get();
											$job_done = $query_done->result();
											$total_work = 0;
											if(!empty($job_done)){
											   foreach($job_done as $work){
												   $total_work +=$work->total_hour;
											   }
											   echo $total_work;
												   $hourstatus =    "  Hours Worked ";
											}else{
											   $hourstatus =  "0.00  Hours Worked";
											}
											?>
											<span>
											   <?php echo $hourstatus; ?>
											   </span></a>
										</li>
										
										<li>
											<a href=""><i class="fa fa-suitcase" aria-hidden="true"></i>&nbsp;
											<?php
											$this->db->select('*');
											$this->db->from('job_bids');
											$this->db->where('user_id',$webUserInfo['webuser_id']);
											$this->db->where('jobstatus',1);
											$querydone = $this->db->get();
											$jobends = $querydone->num_rows();
											echo $jobends." ";   
											?>  <span>  Jobs Completed </span></a>
										</li>
										<li>
											<a href=""><i style="margin-right: 5px;" class="fa fa-tree" aria-hidden="true"></i>&nbsp;<?php echo $basicDetails["work_experience_year"] ?> <span> Years Experience</span></a>
										</li>
										<li style="margin-bottom: -10px;">
											<a style="font-size: 18px;" href=""><i style="margin-right: 4px;" class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?php echo $webUserInfo['webuser_country_name'] ?>
											<span></span></a>
										</li>
                                     </ul>
                                </div>	
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
//  $this->load->view("webview/includes/footer"); 
    $this->load->view("webview/includes/footer-common-script"); 
    ?>
</body>
</html>
<style>
    
		.row.chat-box { min-height: 400px; border: 1px solid; padding: 16px;}
		.chat-screen {
            border: 1px solid #ccc; 
            padding: 0;
            min-height: 410px;
            width: 754px;
    }
		.chat-details-topbar { 
                    min-height: 75px; position: absolute; top: 0; background: #fff; width: 675px; z-index: 99; border-bottom: 1px solid #ccc;
                    padding: 4px 5px 0px 13px;
            width: 750px;
                    
                }
    .white-box.bordered_cl {
	width: 754px;
}
		.chat-details { width: 100%; z-index: 1; bottom: 0;
                                margin-top: -20px;
/*                               min-height: 190px; height: 190px; */
                               position: absolute; background: #fff; overflow-x: hidden; overflow-y: scroll;top: 100px;
                max-height: 246px;
                }
		.chat-details ul li { list-style-type: none; padding: 10px 0;}
		.chat-details ul li span img { width: 50px; border-radius: 50%; margin: 0 15px 0 0;}
		.chat-details-topbar h3 { padding: 6px 10px; font-weight: bold;
                padding-top: 10px;
                }
		.chat-details-topbar h5 { padding: 0 10px;}
		.chat-details-topbar p { padding: 24px 0 0px 10px; margin: 0;  color: #757575;}
		.chat-details ul li span.details { display: block; margin-left: 67px;  font-size: 14px;  color: #757474;}
		textarea#chat-input { 
                        width: 568px;
    height: 40px;
    margin: 0 0 0 15px;
    margin-top: 25px;
    border: 2px solid #1ca7db;
                }
		.active { border: 2px solid #1ca7db;  color: #1ca7db;}
		.chat-sidebar a { color: #000;}
		.chat-bar { 
                    width: 100%;
    z-index: 1;
    bottom: 0;
    min-height: 80px;
    height: 80px;
    position: absolute;
    background: #fff;
    top: 325px;
    border-top: 1px solid #1ca7db;
                 }
   
		form#chat_form a {
	display: inline-block;
	background: #1ca7db;
	color: #fff;
	text-align: center;
	font-size: 18px;
	padding: 5px 21px;
	margin: 18px 6px;
	text-decoration: none;
	width: 120px;
	height: 40px;
}
    .cover_box p {
	/* margin-top: 65px; */
	padding-top: 0px;
}
.textarea {
	max-height: 300px;
	overflow-x: hidden;
	overflow-wrap: break-word;
	resize: horizontal;
	height: 645px;
	overflow-y: visible;
}
    .textarea:focus{
        outline-style: solid;
        outline-width: 2px;
    }
		span.chat-date { font-size: 13px; padding: 0 0 0 15px; color: #949494;}
		span.group-date { display: block; text-align: center; font-size: 16px; color: #7d7b7b;}
		span.name { text-transform: capitalize;}
		span.text1 {text-transform: capitalize;}
		</style>
<script>
 function Confirmdecline(id) {

	var x = confirm("Are you sure!  want to Decline the User?");
	
	if (x){
		$.post("<?php echo site_url('jobs/bid_decline');?>", { form : id },  function(data) {
			if(data.success){
				$('.result-msg').html('You have successfully Decline the Post');
					window.location = "<?php echo base_url();?>jobs/applied/<?=base64_encode($job_info[0]->job_id)?>";
					
			} else{
					alert('Opps!! Something went wrong.');
			}
		   
		}, 'json');
	}
}
</script>

<script src="../src/autosize.js"></script>
<script>
		autosize(document.querySelectorAll('textarea'));
	</script>
<script>
$(document).ready(function(){
	$('.chat-details').animate({scrollTop: $('.chat-details').prop("scrollHeight")}, 1);
});


$('#submit').click(function(){
	var f_id = $('#user_id').val();
	var j_id = $('#job_id').val();
	var b_id = $('#bid_id').val();
	var messsage = $('#chat-input').val();
	if(messsage == ""){
		$('#error_span').html('Please enter your message');	
		$("#error_span").show().delay(5000).fadeOut();
		return false;
	}
	$.post('<?php echo base_url() ?>Interview/insert_message', { freelancer_id: f_id, job_id: j_id, bid_id: b_id, messsage: messsage },  function(data) {
		
			if(data != '') {
					$('#scroll-ul').append(data);
					$('#chat_form')[0].reset();	
					$('.chat-details').animate({scrollTop: $('.chat-details').prop("scrollHeight")}, 1);
					$('#success_span').html('Message send successfully.');
					$("#success_span").show().delay(5000).fadeOut();
			} else {
		
			}
		}, 'json'); 
	
});

</script>
<style>
    .user_view_img img {
	border-radius: 50%;
	height: 100px;
	width: 100px;
	margin-left: 10px;
}  
    .chat_border {
        position: relative;
        display: inline-block;
        margin-top: -7px;
    }
    .attach_icon{
        height: 20px;
        width: 20px;
    }
.main_hourly_rate a {
	margin-top: 15px;
}
.attach_icon::before {
	position: absolute;
	content: "\f233";
	top: 37px;
	right: 35px;
	font-size: 12px;
	height: 20px;
	width: 12px;
	z-index: 9999;
}
span.rating-badge {
	background: #F77D0E  none repeat scroll 0 0;
	border-radius: 2px;
	color: #fff;
	padding: 2px 4px 2px 5px;
	font-size: 12px;
}
.review_ratting_left .star-rating::before {
	font-size: 19px !important;
	left: 10px;
}
.review_ratting_right .star-rating::before {
	top: -2px;
}

.mass_box .chat-details-topbar {
	width: 690px;
	margin: 0 30px;
	border-top:3px solid #DDD;
	border-left:3px solid #ddd;
	border-right:3px solid #ddd;
	margin-top: 25px;
}
.mass_box .chat-details {
	width: 690px;
	margin: 0 30px;
	border-left:3px solid #ddd;
	border-right:3px solid #ddd;
}
.mass_box .chat-bar{width: 690px;margin: 0 30px;
	border-left:3px solid #ddd;
	border-bottom:3px solid #DDD;
	border-right:3px solid #ddd;}
.mass_box textarea#chat-input{width: 520px;}

.buttonsidefoure ul.custom_li li {
	overflow: hidden;
	margin: -24px 11px;
}
    
    
    
    
</style>