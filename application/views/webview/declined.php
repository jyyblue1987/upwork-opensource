<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css" />

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.rateyo.css"/>

<style>
body {
    color: #333;
    font-family: "calibri" !important;
    font-size: 14px;
    line-height: 1.42857;
    src: url(../fonts/Calibri.ttf);
}   
.message_lists{
    max-height: 250px;
    overflow-y: scroll;
    overflow-x: hidden;
}

span.rating-badge {
  background: #F77D0E none repeat scroll 0 0;
  border-radius: 2px;
  color: #fff;
  padding: 2px 4px 2px 5px;
  font-size: 12px;
}
.hire_cover_letter span {
	font-size: 15px;
	font-weight: normal;
}
    .decline {
        margin-bottom: 20px;
    }
.review_ratting {
	margin-left: 49px;
}
.user_skills span {
    background: #ccc none repeat scroll 0 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    color: #494949;
    display: inline-block;
    font-size: 12px;
    margin-bottom: 4px;
    padding: 1px 5px 1px 5px;
    margin-right: 2px;
}
.user_skills span:hover {
background: #008329;
color: #fff;
}
.client-job-activity-current li, .last-element {
	padding-top: 20px;
	padding-bottom: 21px;
}
.drop_btn {
	padding: 15px 60px 65px 40px;
	background: white;
	border: 2px solid #e0e0e0;
	font-weight: 900;
	font-size: 18px;
}
.drop_btn ul li a {
	padding: 10px;
	margin: 0px;
	font-size: 15px;
}
.drop_btn ul li {
	padding: 2px;
	margin: 0px;
} 
.drop_btn ul li a{
    border: none; 
    border-right: none;
    list-style: none;
    }
</style>
<section id="big_header" style="margin-top: 32px; margin-bottom: 60px; height: auto;">

    <div class="container">
        <div class="row"> 
          <div class="main_job_titie">
            <b>  <?= $job_type." - ".$job_title; ?></b><br/><br/> 
          </div>
       </div>
        <div class="row">
            <div class="col-md-12 nopadding" >
                <div>
                 <ul class="client-job-activity-current">
                     <li><a href='<?= site_url('jobs/applications/' . $jobId) ?>'>Application (<?= $applicants ?>)</a></li>
                     <li><a href='<?= site_url('jobs/interviews/' . $jobId) ?>'>Interview (<?=$interviews?>)</a> </li>
                     <li><a href='<?= site_url('offered?job_id=' . $jobId) ?>'>Offers (<?=$offers;?>) </a>  </li>
                     <li><a href='<?= site_url('hired?job_id=' . $jobId) ?>'>Hires (<?=$hires;?>)</a> </li>
                     <li><a class="active-link" href='<?= site_url('declined?job_id=' . $jobId) ?>'>Rejected (<?=$rejects;?>)</a></li>
                    <li class="drop_btn">
						<div class="dropdown hour_btnx custom-application_drop_down">
							<button style="margin-left: -14px;" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
							job action <span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="#">View Job Posting</a></li>
								<li><a href="#">Edit Job Posting</a></li>
								<li><a href="#">Remove Job Posting</a></li>

							</ul>
						
						</div>
					</li>
                 </ul>
                </div>
            </div>
            <div style="padding:40px;"></div>
            <?php
            foreach ($records as $value) { ?>
                <div class="col-md-12 white-box candidate-list">                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="decline" style="position:absolute;right: 23px;top: -10px;">
                                <div class="hire_decline"><?php if($value['bid_reject'] == '1'){echo 'Declined By You';}else{echo 'Declined By Freelancer';} ?></div>  
                            </div>
                           
                            <div class="row margin-top-1">
                                <div style="margin-left: 5px;margin-right: 13px;" class="col-md-1">
                                   <div class="st_img">
                                        <?php
                                   
                                
                                    if ($value['pic'] == "") {
                                        ?>
                                        <img src="<?php echo site_url($value['pic']); ?>" width="64" height="64" >
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo site_url($value['pic']); ?>" width="64" height="64" >
                                        <?php
                                    }
                                    ?>
                                   </div>
                                </div>
                                <div class="col-md-8 text-left margin-left-1" style="margin-top:-4px;">
                                   <div class="aplicant_identity">
                                        <label class="aplicant_name"><a href="<?php echo base_url() ?>applicants?user_id=<?=base64_encode($value['user_id'])?>&job_id=<?=base64_encode($value['job_id'])?>&bid_id=<?=base64_encode($value['bid_id']).'/declined'?>"><?php echo ucfirst($value['fname']) . " " . ucfirst($value['lname']) ?></a></label> 
                                    <br/> 
                                    <span>
                                        <b>
                                        <?= $value['tagline']; ?>

                                    </b>
                                    </span>
                                   </div>
                                    <div class="row margin-top-2">
                                        <div class="col-md-1" style="font-size:16px;">
                                           <b>$<?php
                                            echo round($value['bid_amount'], 2);
                                            if ($job_type == 'hourly')
                                              echo '<span class="cc_normal_txt">/hr</span>';
                                            ?></b>
                                        </div>

                                        <div class="col-md-4">
                                          <div class="review_ratting">
                                              <?php if($value['feedback_score'] !=0 && $value['budget']!=0){
                                                $totalscore = ($value['feedback_score'] / $value['budget']);
                                                $rating_feedback = ($totalscore/5)*100;
                                               ?>
                                               <span class="rating-badge"><?= number_format((float)$value['rating'], 1, '.', ''); ?> </span>
                                              <div title="Rated <?=$value['rating'];?> out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em;margin-top:-5px;color:#DEDEDE; width: 4em">
                                               <span style="width:<?= (( $value['rating'] / 5) * 100) ?>% ; margin-top:0px;">
                                                   <strong itemprop="ratingValue"><?= $value['rating'];?></strong> out of 5
                                               </span>
                                               </div>
                                           <?php  }else{ ?>
                                             <span class="rating-badge">0.0</span>
                                               <div title="Rated 0 out of 5" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating" style="left:0;height: 1.2em; margin-top:px;">
                                               <span style="width:0% ;margin-top:-5px;">
                                                   <strong itemprop="ratingValue">0.0</strong> out of 5
                                               </span>
                                               </div>
                                          <?php   } ?>
                                         </div> 
                                         
                                        </div>

                                        <div class="col-md-2 text-right"  style="font-size:16px;">
                                            <b><?php

                                               if($value['total_work']){
                                                   echo $value['total_work']."<span class='cc_normal_txt'>hrs</span>";
                                               }else{
                                                   echo "0.00 <span class='cc_normal_txt'>hrs</span>";
                                               }
                                        ?></b> 
                                        
                                        </div>

                                        <div class="col-md-2 text-right" style="font-size:16px;">
                                           <b><?php
                                            
                                          echo $value['ended_jobs'];
                                        ?></b>jobs
                                        </div>

                                        <div class="col-md-3 text-right">
                                            <i style="font-size: 15px;" class="fa fa-map-marker"></i> 
												 
											 <b> <?= $value['country'];
											 ?></b>
                                        </div> 
                                    </div>

                                    <div class="row margin-top-1">
                                        <div class="col-md-12 text-justify">
                                          <div class="hire_cover_letter">
                                              <span>
                                                  <?php 
                                        echo substr($value['letter'], 0, 100); ?>
                                              </span>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="row margin-top-1">
                                        <div class="col-md-1">
                                        <span class="gray-text" style="font-size:14px;">Skills</span></div>
                                        <div class="col-md-11 text-left skills">
                                            
                                       <div class="user_skills">
                                            <?php foreach($value['skills'] AS $skills){
                                                echo '<span>'.$skills["skill_name"].'</span>';
                                            }

                                            ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 margin-top-5 text-right msg-buttons">
                                    <!--<a href="javascript:void(0)" onclick="loadmessage(<?=$value['bid_id']?>,<?=$value['user_id']?>,<?=$value['job_id']?>)">Message</a>-->
                                    <div class="hire_sms_btn"><a class="btn btn-primary form-btn" href="<?php echo base_url() ?>applicants?user_id=<?=base64_encode($value['user_id'])?>&job_id=<?=base64_encode($value['job_id'])?>&bid_id=<?=base64_encode($value['bid_id']).'/declined'?>">Message</a>  
                                    </div>

                                   <div class="hire_me_btn">

                                   
			    <a class="btn btn-primary form-btn" href="<?php echo base_url() ?>jobs/offers?user_id=<?=base64_encode($value['user_id'])?>&job_id=<?=base64_encode($value['job_id']); ?>">Hire Me</a>                              
			  
                                  
                                  
                                                                 
                               </div>
                                     </div>
                            </div>
                        </div>

                    </div>
                </div>  
            <?php } ?>

        </div>

    </div>

</section>

</div>

</section>
<!-- big_header-->



                  
<!-- Modal -->
<div id="message_convertionModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="hidemessagepopup()">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <div class="message_lists" ></div>
        
       
        <form name="message" action="" method="post" id="conversion_message">
             <textarea name="usermsg"  id="usermsg"></textarea>
               <input name="job_id" type="hidden" id="job_id"  value="" />
               <input name="bid_id" type="hidden" id="bid_id"  value=""  />
               <input name="sender_id" type="hidden" id="sender_id"  value="<?php echo $this->session->userdata('id');?>"  />
               <input name="receiver_id" type="hidden" id="receiver_id"  value=""  />
             <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
         </form>
        </div>
    </div>
 </div>
</div>

<script>
    function loadmessage( b_id, u_id, j_id ){
        
		var modal = document.getElementById('message_convertionModal');
        $.post("<?php echo site_url('jobconvrsation/message_from_superhero');?>", { job_bid_id:b_id, user_id : u_id, job_id : j_id },  function(data) {
			$('.message_lists').html(data.html);
            $('#job_id').val( j_id );
            $('#bid_id').val( b_id );
            $('#receiver_id').val( u_id );
            // $('#message_convertionModal').modal('show');
			modal.style.display = "block";
           // $('.message_lists').animate({scrollTop: $('.message_lists').prop("scrollHeight")}, 500);
            autoloading();
		}, 'json');
       
    }
    function hidemessagepopup(){
        var modal = document.getElementById('message_convertionModal');
        modal.style.display = "none";
    }
    
    $("#conversion_message").on("submit", function(e) {
          e.preventDefault();
          var $form = $("#conversion_message");
          if ( $('#usermsg').val().trim().length > 0 ) {
                $.post("<?php echo site_url('jobconvrsation/add_conversetion');?>", { form: $form.serialize() },  function(data) {
                    if(data.success){
                        $form[0].reset();
                        loadmessage( $('#bid_id').val(), $('#receiver_id').val(), $('#job_id').val() );
                         
                    }
                    else{
                        alert('Opps!! Something went wrong.')
                    }
                   
                }, 'json');
          }
         
    });
    
      function loadmessage_auto( ){
        
        var auto_job_id = $('#job_id').val();
        var auto_bid_id = $('#bid_id').val();
        var auto_receiver_id = $('#receiver_id').val();
        
		var modal = document.getElementById('message_convertionModal');
        $.post("<?php echo site_url('jobconvrsation/message_from_superhero');?>", { job_bid_id:auto_bid_id, user_id : auto_receiver_id, job_id : auto_job_id },  function(data) {
			$('.message_lists').html(data.html);
           
            //$('.message_lists').animate({scrollTop: $('.message_lists').prop("scrollHeight")}, 500);
		}, 'json');
    }
    
    function autoloading() {
        //alert('hi');
        var auto_job_id = $('#job_id').val();
        var auto_bid_id = $('#bid_id').val();
        var auto_receiver_id = $('#receiver_id').val();
       
        if (auto_job_id) { auto_job_id = auto_job_id;}else{auto_job_id = 0}
        if (auto_bid_id) { auto_bid_id = auto_bid_id;}else{auto_bid_id = 0}
        if (auto_receiver_id) { auto_receiver_id = auto_receiver_id;}else{auto_receiver_id = 0}
       
        if (auto_job_id && auto_bid_id && auto_receiver_id) {
            setInterval('loadmessage_auto()', 5000);
        }
    }
  autoloading();
  
    
</script>
