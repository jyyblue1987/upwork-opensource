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
            <div class="row">
                <div class="mainwork white-box">
                    <div class="col-md-2 col-sm-4"style="width: 140px">
                        <div class="topleftside">
                            <img class="" width="120px" src="<?php echo base_url().$webUserInfo['webuser_picture']; ?>"/>
                            <div style="clear:both"></div>
                            <button id="buttonfirst"><?php if($total_feedbackScore !=0 && $total_budget!=0){
                                               
                                                $totalscore = ($total_feedbackScore / $total_budget); 
                                               echo round($totalscore, 2);
                                               }
                                               ?></button><p>*****</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                    <div class="topmiddle" style="padding-left: 20px">
                      <!--  <h2><?php echo $this->session->userdata("username") ?></h2>-->
					  <h2 style="text-transform: uppercase;"> <?php echo $webUserInfo['webuser_fname'] .'&nbsp'. $webUserInfo['webuser_lname'];?></h2>
                        <p><img src="<?php echo base_url() ?>assets/profile/img/flag.png"/>&nbsp;<?php echo $webUserInfo['webuser_country_name'] ?> </p>
                        <h3 style="color:#000;font-size: 22px;"><?php echo $basicDetails["tagline"] ?></h3>
                        <div class="col-md-12 col-sm-12">
                        <div class="buttonside">
                                <?php
                                $skills = $basicDetails['skills'];
                                if(strlen($skills) > 0){
                                    ?>
                                <ul>
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
                <div class="col-md-3 col-sm-3">
                    <div class="topmiddle pull-right">
											
						<h4 style="padding-top: 38px">$<?php if(($job_info[0]->job_type) == 'fixed'){ echo $job_info[0]->bid_amount; } else {echo $job_info[0]->bid_amount."/hr";} ?></h4>
						
                    </div>
                </div>
                <div class="col-md-3 col-sm-5">
                    <div class="topriht align-center">
						<?php if($ststus->isactive==1){ ?>
							<?php if($job_info[0]->hired == 0){ ?>
                                                            <a href="<?php echo base_url() ?>jobs/offers?user_id=<?=$_GET['user_id'];?>&job_id=<?=$_GET['job_id'];?>">
                                                                <button id="buttonsecond">Hire Me&nbsp;&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></button>
                                                            </a>
							<?php } ?>
						<?php } ?>
                        <br/>
						
                        
						<a href="<?php echo base_url() ?>profile/profile_freelancer?user=<?php echo base64_encode($webUserInfo['webuser_id']);?>&name=<?=$slag;?>" ><button class="btn" id="view-profile-btn">View Profile</button></a>
						
                        <br/>
                        <div class="col-md-12 col-sm-12 decline-line">
                            <i class="fa fa-times" aria-hidden="true"></i> 
                            <small><a href="javascript:void(0)" onclick="Confirmdecline(<?php echo $job_info[0]->id;?>);">Decline Candidate </a></small>
                        </div>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
            <div class="middle">
                <div class="container">
                    <div class="midlmain">
                        <div class="row">
                            <div class="col-md-9 col-sm-9" style="padding-top: 20px"> 
								<div class="col-lg-12 col-md-12 col-sm-12 chat-screen">
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
										<div style="width:80%;float: left;height: 100px;"><textarea name="chat-input" id="chat-input"></textarea></div>
										<div style="width:20%;float: left;height: 100px;"><a href="javascript:void(0);" id="submit">SEND</a></div>
										</form>
										<span id="error_span" style="color:red;padding: 0 0 0 15px;display:none;"></span>
										<span id="success_span" style="color:green;padding: 0 0 0 15px;display:none;"></span>
									</div>
									
								</div>
								<div class="col-md-12 col-sm-12 white-box bordered" style="margin-top:20px;margin-bottom:20px;" >
                                    <p class="cover-letter">Cover Letter<br/></p>
                                    <p class="cover-letter-text" style="margin-left: 14px !important;">
                                        <?=$job_info[0]->cover_latter?>
                                    </p>
									<br/>
									<br/>
                                </div>
								
								  
                                
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="buttonsidefoure">
                                    <h2>work history</h2>
                                    <ul>
                                        <?php
                                        
                                        
                                        ?>
                                       <li><a href=""><i class="fa fa-asterisk" aria-hidden="true"></i>&nbsp;
                                               <?php if($total_feedbackScore !=0 && $total_budget!=0){
                                               
                                                $totalscore = ($total_feedbackScore / $total_budget); 
                                               echo round($totalscore, 2);
                                               }
                                               ?>
                                               <p>&nbsp;*****</p></a></li>
                                       <li><a href=""><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;$<?php echo $basicDetails["hourly_rate"] + $basicDetails["hourly_rate"]*WINJOB_FEE ?> <span>hourly rate</span></a></li>
                                       <li><a href=""><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
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
                                                       $hourstatus =    " Total Hours Worked ";
                                               }else{
                                                   $hourstatus =  "0.00 Total Hours Worked";
                                               }
                                        ?>
                                               <span>
                                                   <?php echo $hourstatus; ?>
                                                   </span></a></li>
                                       <li><a href=""><i class="fa fa-suitcase" aria-hidden="true"></i>&nbsp;
                                               <?php
                                            $this->db->select('*');
                                           $this->db->from('job_bids');
                                           $this->db->where('user_id',$webUserInfo['webuser_id']);
                                           $this->db->where('jobstatus',1);
                                           $querydone = $this->db->get();
                                         $jobends = $querydone->num_rows();
                                          echo $jobends." ";   
                                        ?>  <span> Total Jobs Completed </span></a></li>
                                       <li><a href=""><i class="fa fa-tree" aria-hidden="true"></i>&nbsp;<?php echo $basicDetails["work_experience_year"] ?><span>Years Experience</span></a></li>
                                       <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?php echo $webUserInfo['webuser_country_name'] ?>
                                       <span></span></a></li>
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
		.chat-screen { border: 2px solid #2cabda; padding: 0; min-height: 430px;}
		.chat-details-topbar { 
                    min-height: 80px; position: absolute; top: 0; background: #fff; width: 100%; z-index: 99; border-bottom: 2px solid #1ca7db;
                    padding: 4px 5px 0px 13px;
                    
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
                        width: 95%;
    height: 67px;
    margin: 0 0 0 15px;
    margin-top: 16px;
    border: 2px solid #1ca7db;
                }
		.active { border: 2px solid #1ca7db;  color: #1ca7db;}
		.chat-sidebar a { color: #000;}
		.chat-bar { 
                    width: 100%;
    z-index: 1;
    bottom: 0;
    min-height: 100px;
    height: 100px;
    position: absolute;
    background: #fff;
    top: 325px;
                 }
		form#chat_form a { 
                    display: inline-block;
    background: #1ca7db;
    color: #fff;
    text-align: center;
    font-size: 18px;
    padding: 5px 17px;
    margin: 30px 0;
    text-decoration: none;
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
					window.location = "<?php echo base_url();?>jobs/applications/<?=base64_encode($job_info[0]->job_id)?>";
					
			} else{
					alert('Opps!! Something went wrong.');
			}
		   
		}, 'json');
	}
}
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
	$.post('<?php echo base_url() ?>Applicants/insert_message', { freelancer_id: f_id, job_id: j_id, bid_id: b_id, messsage: messsage },  function(data) {
		
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