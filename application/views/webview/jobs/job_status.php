<?php
 function time_elapsed_string($_ptime)
{
    $ptime = strtotime($_ptime);
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array(365 * 24 * 60 * 60 => 'year',
        30 * 24 * 60 * 60 => 'month',
        24 * 60 * 60 => 'day',
        60 * 60 => 'hour',
        60 => 'minute',
        1 => 'second'
    );
    $a_plural = array('year' => 'years',
        'month' => 'months',
        'day' => 'days',
        'hour' => 'hours',
        'minute' => 'minutes',
        'second' => 'seconds'
    );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}

$Conversation = new Conversation();
$notification = $Conversation->index();
$notification_details = $Conversation->details();
$job_alert_count = $Conversation->job_alert();


$freelancerend = $Conversation->freelancerend();
$clientend = $Conversation->clientend();
?>
<p class="result-msg"></p>
<section id="big_header" class="custom_home" >
        <?php   if ($this->session->userdata('type') == '1') { ?>
				<? if(!empty($clientend)) { ?>				
                    <div class="row marg-neg ">
                        <div class="bordered-alert text-center ack-box top-alert">
                            <h4 class="h4negtop">! You have  <a href="<?php echo base_url() ?>jobs/client_endjobnotification" class="show_notification"> <?=count($clientend)?> ended contract - waiting for feedback</a>
                                         
                            </h4>
                        </div>
                    </div>                                                                        
					<? } ?>
					<?php if($ststus->isactive==0){ ?>
                    <div class="row marg-alert">
                        <div class="col-md-10 bordered-alert text-center ack-box mid-alert">
                            <h4 class="h4negtop-red">! Your Account has been Suspended</h4>
                        </div>
                    </div>
					<?php } ?>
					
						
				<?php  } else if ($this->session->userdata('type') == '2'){  ?>
					<?php  if(!empty($freelancerend)) { ?>
                         <div class="row ">
                            <div class="col-md-10 bordered-alert text-center ack-box top-alert">
                                <h4 class="h4negtop">! You have  <a href="<?php echo base_url() ?>jobs/freelancer_endjobnotification" class="show_notification"> <?=count($freelancerend)?> ended contract - waiting for feedback</a>                                        
                                </h4>
                            </div>
                        </div> 								
						<?php } ?>
						<?php if($ststus->isactive==0){ ?>
                    <div class="row marg-alert">
                        <div class="col-md-10 bordered-alert text-center ack-box mid-alert">
                            <h4 class="h4negtop-red">! Your Account has been Suspended</h4>
                        </div>
                    </div>
						<?php } ?>
				<?php }  ?>
				
				
        <div class="search-top">
                <div class="row">
                    <form id="freelacer-search" action="profile/find-freelancer" method="post">
                        <div class="col-md-10 col-lg-10 col-sm-10 col-xs-12 no-pad search-cont">
                            <input type="text" name="keywords" class="form-control search-field" placeholder="Find freelancers" value=""/> 
                            <i aria-hidden="true" class="fa fa-search search-btn search-freelancer custom_btn"></i>
                        </div>
                        <div class="col-md-2 col-lg-2 col-sm-2 col-xs-12 no-pad">
                        <a style="" class="btn btn-block btn-primary post-job" href="<?php echo site_url('post-job'); ?>">
                            Post a job
                            </a>
                    </div>
                    </form>
                    
                </div>
        </div>

        

        <div class="row">            
                <?php if ($this->session->flashdata('msg')) {
                    ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('msg'); ?></div>
                <?php } ?>
                <?php
                foreach ($records as $value) {

                    $jobId = $value->id;
                    $sender_id = $this->session->userdata(USER_ID);
                    //total number of interview
                    $this->db->select('*');
                    $this->db->from('job_conversation');
                    $this->db->where('job_conversation.sender_id', $sender_id);
                    $this->db->join('job_bids', 'job_bids.id=job_conversation.bid_id', 'inner');
                    $this->db->where('job_conversation.job_id', $jobId);
                    $this->db->where('job_bids.bid_reject', 0);
                    // added by jahid start 
                  $this->db->where('job_bids.job_progres_status', 1);
                  $this->db->where(array('job_bids.withdrawn' => NULL)); 
                  // added by jahid end 
             
                    $this->db->group_by('bid_id');
                    $query = $this->db->get();
                    $interview_count = $query->num_rows();
                    //$this->db->last_query();			
                    if ($interview_count) {
                        $interview = $interview_count;
                    } else {
                        $interview = 0;
                    }

                    $this->db->select('*');
                    $this->db->from('job_accepted');
                    $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
                    $this->db->where('job_accepted.buser_id', $sender_id);
                    $this->db->where('job_accepted.job_id', $jobId);
                    $this->db->where('job_bids.hired', '0');
                    $this->db->where('job_bids.jobstatus', '0');
                   // added by jahid start 
                  $this->db->where('job_bids.job_progres_status', 3);
                  $this->db->where(array('job_bids.withdrawn' => NULL)); 
                  // added by jahid end
                    $query = $this->db->get();
                    $hire_count = $query->num_rows();
                    if ($hire_count) {
                        $hire = $hire_count;
                    } else {
                        $hire = 0;
                    }

                    // total number of job
                    $this->db->select('*');
                    $this->db->from('job_bids');
                    $this->db->where(array('job_id' => $jobId, 'bid_reject' => 0, 'status!=1' => null));
                    
                    // added by jahid start 
                  $this->db->where('job_progres_status', 0);
                  $this->db->where(array('withdrawn' => NULL)); 
                  // added by jahid end
                    
                    $query_totalApplication = $this->db->get();
                    $Application_count = $query_totalApplication->num_rows();
                    if ($Application_count) {
                        $totalApplication = $Application_count;
                    } else {
                        $totalApplication = 0;
                    }

                    $this->db->select('*');
                    $this->db->from('job_bids');
                    $this->db->where(array('job_id' => $jobId, 'hired' => '1'));
                    
                   // added by jahid start 
                  $this->db->where('job_progres_status', 2);
                  $this->db->where(array('withdrawn' => NULL)); 
                  // added by jahid end
                    
                    $query_totaloffer = $this->db->get();
                    $Offer_count = $query_totaloffer->num_rows();
                    if ($Offer_count) {
                        $totalOffer = $Offer_count;
                    } else {
                        $totalOffer = 0;
                    }


                    $this->db->select('*');
                    $this->db->from('job_bids');
                    $this->db->where(array('job_id' => $jobId));
                    $this->db->where('hired', '0');
                     // added by jahid start                                     
                  $this->db->where("(withdrawn=1 OR bid_reject=1 OR withdrawn IS NULL)", NULL, FALSE);
                    // added by jahid end
                  
                    $query_totalreject = $this->db->get();
                    $reject_count = $query_totalreject->num_rows();
                    if ($reject_count) {
                        $totalrejact = $reject_count;
                    } else {
                        $totalrejact = 0;
                    }

                    
                    $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
                    $this->db->order_by("jobs.id", "desc");
                    $query = $this->db->get_where('jobs', array('id' => $jobId));
                    $recordJobs = $query->row();
                    
                    $appliedLink = '';
                    if ($totalApplication > 0){
                        $appliedLink = site_url('jobs/applied/' . base64_encode($value->id));
                    }else{
                        // added by jahid start 
                        $appliedLink = site_url('jobs/applied/' . base64_encode($value->id));
                        // added by jahid end 
                    }
                    $interviewsLink = site_url('jobs/interviews/' . base64_encode($value->id));
                    $offerLink = site_url('offer?job_id=' . base64_encode($value->id));
                    $hireLink = site_url('hires?job_id=' . base64_encode($value->id));
                    $rejectLink = site_url('reject?job_id=' . base64_encode($value->id));
                    ?>
                
        <div class="marg-neg"> 
            <div class="bordered-client white-box">
                <div class="row"> 
                    <div class="col-md-7 col-sm-6 col-xs-6">
                        <div class="job-activity-title margin-10">
                            <label class="jobTitle">
                                <a href="<?php echo $appliedLink; ?>"><?php echo ucfirst($value->job_type)." - ".ucfirst($value->title) ?></a></label>

                                <p class="hidden-lg hidden-md"><?php echo time_elapsed_string($value->job_created); ?><br></p>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-6 no-pad">
                        <div class="row"> 
                            <div class="col-md-4 col-sm-4 col-xs-12 nopadding">

                                <label class="gray-text">
                                    <a href='<?php echo site_url('jobs/view/' . url_title($value->title) . '/' . base64_encode($value->id));?>' class="co">View Job Posting <span class='glyphicon custom_client_icon glyphicon-info-sign co'></span></a>
                                </label>
                            </div>
							
                            <div class="col-md-4 col-sm-4 col-xs-12 nopadding">
                                <label class="gray-text">
                                <span class="hidden-xs hidden-sm margin-10-left">&nbsp;</span>
                                    <a href='<?php echo site_url('jobs/edit/' . base64_encode($value->id));?>'style="color: #37A000">Edit Posting <span class='glyphicon custom_client_icon glyphicon-edit co'></span>
                                    </a>
                                </label>
                            </div>
							
                            <div class="col-md-4 col-sm-4 col-xs-12 nopadding">
								<label class="gray-text"> 
                                    <a href="javascript:void(0)" id="endpost" onclick="Confirmremove(<?php echo $value->id; ?>);" class="co">
                                        Remove Posting
                                        <span class='glyphicon custom_client_icon glyphicon-remove co'></span>
                                    </a>
                                </label>
							</div>                    
                        </div>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-3 hidden-xs hidden-sm">
                        <div>
							<?php echo time_elapsed_string($value->job_created); ?>
						</div>
                    </div>
                    
                    
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <ul class="client-job-activity pull-right" >
                            <li>
                                <a href="<?php echo $appliedLink; ?>">Application (<?php echo $totalApplication ?>)</a> 
                            </li>
                            <li>
                                <a href="<?php echo $interviewsLink; ?>">Interviews (<?= $interview ?>)</a>  
                            </li>
                            <li>
                                <a href="<?php echo $offerLink; ?>">Offers (<?= $totalOffer; ?>)</a>  
                            </li>
                            <li>
                                <a href="<?php echo $hireLink; ?>">Hires (<?= $hire; ?>)</a>   
                            </li> 
                            <li>
                                <a href="<?php echo $rejectLink; ?>" class="last-link">Rejected (<?= $totalrejact; ?>)</a>  
                            </li>

                        </ul>
                    </div>
                </div>

            </div> 
        </div>
                    
                    


                    <br/>
                <?php } ?>
        </div>
</section>
<script type="text/javascript">
    $('.search-freelancer').click(function () {
        var val = $('input[name="keywords"]').val();
        if (val != "" && val.length > 0) {
            $('#freelacer-search').submit();
        } else {
            alert("Leave a search word");
        }
    });




    function Confirmremove(id) {

        var x = confirm("Are you sure you want to Remove the post?");

        if (x) {
            $.post("<?php echo site_url('jobs/removepost'); ?>", {form: id}, function (data) {
                if (data.success) {
                    $('.result-msg').html('You have successfully Remove the Post');
                    $(".result-msg").show().delay(5000).fadeOut();
                    $('html, body').animate({scrollTop: $(".result-msg").offset().top}, 2000);
                    setTimeout(function () {
                        window.location = "<?php echo base_url(); ?>jobs-home";
                    }, 5000);

                } else {
                    alert('Opps!! Something went wrong.');
                }

            }, 'json');
        }
    }
</script>
