<?php

function time_elapsed_string($ptime)
{
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
?>

<section id="big_header" style="margin-top: 40px; margin-bottom: 40px; height: auto; border: 1px solid rgb(204, 204, 204); overflow: hidden; margin-left: 4px;">
    <div style="padding-bottom: 10px;" class="container white-box-feed">
        <div class="row">
            <div class="col-md-9 col-md-offset-0 page-title">                
                <div class="row">					
                    <div class="col-md-6 page-label">
                        <h1 class="job-title cos_job-title"><?php echo ucfirst($value->title) ?></h1>
                    </div>
					
					<div class="col-md-6 page-label">                        
                        <span style="margin-top: -15px;" class="pull-right"><?php
                             $timeDate = strtotime($value->created);
                            $dateInLocal = date("Y-m-d H:i:s", $timeDate);
                            echo time_elapsed_string(strtotime($dateInLocal)); ?></span>
                    </div>
                </div>
				
			<div class="jobdes-bordered-wrapper">
                <div class="row jobdes-bordered page-label">
                    <div class="col-md-3 text-center">
                        <label>Job Type</label> <br /> <span><?php echo ucfirst($value->job_type) ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label>
                            <?php
                            if ($value->job_type == 'hourly')
                            {
                                echo "Hourly Per week";
                            } else
                            {
                                echo '$';
                            }
                            ?>
                        </label><br /><span><?php
                            if ($value->job_type == 'hourly')
                            {
                                echo $value->hours_per_week;
                            } else
                            {
                                echo '$' . round($value->budget, 2);
                            }
                            ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label>Job Duration</label><br /> <span><?php echo str_replace('_', '-', $value->job_duration) ?></span>
                    </div>

                    <div class="col-md-3 last-div text-center page-label">
                        <label>Experience Level</label><br /> <span><?php echo ucfirst($value->experience_level); ?></span>
                    </div>
                </div>
</div>

                <div class="row margin-top page-label">
                    <div class="col-md-2">
                        <label>Skills</label>
                    </div>

                    <div class="col-md-10 skills page-label">
                    <div class="custom_user_skills">
                        <?php
                        if (isset($value->skills) && !empty($value->skills))
                        {
                            $skills = explode(' ', $value->skills);
                            foreach ($skills as $skill)
                                echo "<span> $skill</span> ";
                        }
                        ?>
                    </div>
                    </div>
                </div>

                <div class="row margin-top page-label">
                    <div class="col-md-9">
                        <label>Detail</label>
                    </div>
                    <div style="font-family: calibri; font-size: 16px; margin-bottom: 17px; margin-top: 8px;" class="col-md-12 text-justify page-label"><?php echo ucfirst($value->job_description) ?></div>

                </div>
<div class="jobdes-bordered-wrapper">
                <div class="row jobdes-bordered page-label">
                    <div class="col-md-4 text-center">
 <?php 
 $this->db->select('*');
$this->db->from('job_bids');
$this->db->where(array('job_id'=>$value->job_id,'bid_reject'=>0, 'status!=1'=>null));
$query =$this->db->get();
$Proposals_count = $query->num_rows();
$jobfeedback= $query->result();
?>
                        <label>Proposals</label> <br /> <span><?=$Proposals_count;?></span>
                    </div>

                    <div class="col-md-4 text-center page-label">
 <?php 
$this->db->select('*');
$this->db->from('job_conversation');
$this->db->where('job_conversation.sender_id', $value->clientid);
$this->db->join('job_bids', 'job_bids.id=job_conversation.bid_id', 'inner');
$this->db->where('job_conversation.job_id', $value->job_id);
$this->db->where('job_bids.bid_reject', 0);
$this->db->group_by('bid_id'); 
$query=$this->db->get();
$interview_count = $query->num_rows();
?>
                        <label>Interviewing</label><br /> <span><?=$interview_count;?></span>
                    </div>

                    <div class="col-md-4 last-div text-center page-label">
<?php
$this->db->select('*');
$this->db->from('job_accepted');
$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
$this->db->where('job_accepted.buser_id',$value->clientid);
$this->db->where('job_accepted.job_id',$value->job_id);
$this->db->where('job_bids.hired', '0' );
$this->db->where('job_bids.jobstatus', '0' );
$query=$this->db->get();
$hire_count = $query->num_rows();
?>
                        <label>Hired</label><br /> <span>
                            <?php echo $hire_count;?>
                        </span>
                    </div>

                </div>
                </div>
            </div>


        </div>

    </div>

    <div class="container">
        <div style="background: #fff;" class="row">
            <div class="col-md-9" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; padding-left: 45px;">
                <div class='form-msg'></div>            
                <div class="row">
                    <div style="border: 1px solid rgb(204, 204, 204); width: 698px;" class="col-md-12">
                        <div class="row">
								<?php
							   // print_r($value);
								
								if($value->status=='1'){?>
									<div class="alert custom-alert-warning">
										<strong>Warning!</strong> You have withdraw with this job.
									</div>
									<?php }else{
										// added by jahid start 
									 /*
									?>
								 <div class="alert alert-warning">
										<strong>Warning!</strong> The job does not exist.
									</div>
								<?php 
									*/
										// added by jahid end 
									}
								?>
                            <div style="text-align: center;" class="col-md-7 col-centered custom_sp">
								
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
                                    if ($value->job_type == 'hourly')
                                    {
                                        $perHrs = '/hr';
                                    }
                                    ?>
                                        <label>$<amt id='bid_earning_read'><?php echo round($value->bid_earning, 2); ?></amt><?php echo $perHrs ?></label> ($<amt id='bid_amount_read'><?php echo round($value->bid_amount, 2); ?></amt><?php echo $perHrs ?> charge to client)
                                    </div>

                                </div>
 <?php //if($value->status!='1')
 {?>
                                <div class="row margin-top-2">
                                    <div class="col-md-12">
                                        <input style="margin-left: 15px;" type="button" class="btn btn-primary form-btn" value="Propose Different Terms" data-toggle="modal" data-target="#myModal2"/>
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
                </div>



                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-11 margin-left-2 margin-top-2">
                                <p class="custom_cover-letter">Cover Letter</p>
                            </div>
                        </div>

                        <div class="row margin-top-2">
                            <div class="col-md-11 margin-left-2">
                                <p style="margin-bottom: 10px; color: rgb(73, 73, 73);" class="custom_cover-letter-text"><?php echo ucfirst($value->cover_latter) ?></p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header" style="border: none;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Withdraw Proposal</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to withdraw this proposal?</p>
                            </div>
                            <div class="modal-footer" style="text-align: left; border-top: none">
                                <form method="post" id='jobWithDraw'>
                                    <input type="hidden" name='bid_id' value='<?php echo $value->id; ?>'/>
                                    <input type="hidden" name='withdraw' value='1'/>
                                    <input type="submit" class="btn btn-primary form-btn" value="Withdraw Proposal" />
                                    <input type="button" class="btn btn-default form-btn-default" value="Cancel" data-dismiss="modal" />
                                    <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
                                </form>
                            </div>
                        </div>

                    </div>
                </div>






                <div id="myModal2" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header" style="border: none;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Proposed Terms</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" id='jobApply'>
                                    <input type="hidden" name='bid_id' value='<?php echo $value->id; ?>'/>
                                    <input type="hidden" name='proposal' value='1'/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3 col-md-offset-3 page-label">
                                                    <label>Your Bid</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="col-md-1">$</div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name='bid_amount' id='bid_amount' value='<?php echo round($value->bid_amount, 2); ?>' style="float: left;width: 75px"/><label style=' margin-left: 2px;margin-top: 6px;position: absolute;'><?php echo $perHrs ?></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3 col-md-offset-3 page-label">
                                                    <label>10% Winjob Fee</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="col-md-1">$</div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name='bid_fee' id='bid_fee' disabled style="float: left;width: 75px" /><label style=' margin-left: 2px;margin-top: 6px;position: absolute;'><?php echo $perHrs ?></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3 col-md-offset-3 page-label">
                                                    <label>Your Earnings</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="col-md-1">$</div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name='bid_earning' id='bid_earning' disabled style="float: left;width: 75px"/><label style=' margin-left: 2px;margin-top: 6px;position: absolute;'><?php echo $perHrs ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>







                                    </div>
                                    <div class="modal-footer" style="text-align: center; border-top: none">
                                        <input type="submit" class="btn btn-primary form-btn" value="Done" />
                                        <input type="button" class="btn btn-default form-btn-default" value="Cancel" data-dismiss="modal" />
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