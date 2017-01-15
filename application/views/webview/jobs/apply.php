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
<section id="big_header"
         style="margin-top: 50px; height: auto;">

    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-0 white-box" style="padding:20px">
                <div class='form-msg'></div>
                <div class="row">
                    <div class="col-md-12 page-label">
                        <h1><?php echo ucfirst($value->title) ?></h1>
                        <br /> <span class="col-md-offset-10"><?php 
                         $timeDate = strtotime($value->job_created);
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
                    <div class="col-md-3">
                        <label>Required Skills</label>
                    </div>

                    <div class="col-md-9 skills page-label">
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

                <div class="row margin-top page-label">
                    <div class="col-md-9">
                        <label>Detail</label>
                    </div>

                    <div class="col-md-12 text-justify page-label"><?php echo ucfirst($value->job_description) ?></div>
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
//var_dump($value->id);var_dump($Proposals_count);die();

$jobfeedback= $query->result();
?>
                        <label>Proposals</label> <br /> <span>
                       <?=$Proposals_count;?>
                        </span>
                    </div>

                    <div class="col-md-4 text-center page-label">
 <?php 
$this->db->select('*');
$this->db->from('job_conversation');
$this->db->where('job_conversation.sender_id', $value->user_id);
$this->db->join('job_bids', 'job_bids.id=job_conversation.bid_id', 'inner');
$this->db->where('job_conversation.job_id', $value->job_id);
$this->db->where('job_bids.bid_reject', 0);
$this->db->group_by('bid_id'); 
$query=$this->db->get();
$interview_count = $query->num_rows();
?>
                        <label>Interviewing</label><br /> <span><?=$interview_count;?> </span>
                    </div>

                    <div class=" last-div col-md-4 text-center page-label">
<?php
$this->db->select('*');
$this->db->from('job_accepted');
$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
$this->db->where('job_accepted.buser_id',$value->user_id);
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

</section>

</div>

</section>
<!-- big_header-->

<hr>

<section id="big_header"
         style="margin-top: 50px; margin-bottom: 30px; height: auto;  background-color: #f0f0f0;"  class="mid_content">

    <div class="container">
        <div class="row" style="    margin-left: 0px;
    margin-right: -30px;">
            <form method="post" id='jobApply'>
                <input type="hidden" name='job_id' id='jobId' value='<?php echo $value->job_id; ?>'/>
                <input type="hidden" name='job_title' id='job_title' value='<?php echo $value->title; ?>'/>
                <div class="col-md-9 white-box col-md-offset-0" style="padding:20px;">

                    <div class="row">
                        <div class="col-md-12 page-label">
                            <h1>Proposed Terms</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-4 page-label">
                                    <label>Your Bid</label>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-md-1">$</div>
                                    <div class="col-md-6">
                                        <?php
                                        $bidAmt = '';
                                        $perHrs='';
                                        if ($value->job_type == 'hourly')
                                        {
                                            if ($value->hourly_rate)
                                            {
                                                $bidAmt = $value->hourly_rate;
                                            } else
                                                $rateMsg = 1;
                                            $perHrs='/hr';
                                        }
                                        ?>
                                        <input type="text" class="form-control" name='bid_amount' id='bid_amount' value='<?php echo $bidAmt; ?>' style="float: left;width: 75%"/><label style=' margin-left: 2px;margin-top: 6px;position: absolute;'><?php echo $perHrs?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 col-md-offset-4 page-label">
                                    <label>10% Winjob Fee</label>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-md-1">$</div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name='bid_fee' id='bid_fee' disabled style="float: left;width: 75%" /><label style=' margin-left: 2px;margin-top: 6px;position: absolute;'><?php echo $perHrs?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 col-md-offset-4 page-label" >
                                    <label>Your Earnings</label>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-md-1">$</div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name='bid_earning' id='bid_earning' disabled style="float: left;width: 75%"/><label style=' margin-left: 2px;margin-top: 6px;position: absolute;'><?php echo $perHrs?></label>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($rateMsg))
                            {
                                ?>
                                <div class="row page-label" style="float: right;">
                                    <label>Your hourly rate is not defined, Click <a href='<?php echo site_url('profile/basic'); ?>'>here</a> to update.</label>
                                </div>
<?php } ?>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>

                    </div>
                    <?php if ($value->job_type != 'hourly') { ?>
                    <div class="row margin-top">
                        <div class="col-md-12 page-label">
                            <label>Job Duration</label>
                        </div>

                        <div class="col-md-3">
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

                    <div class="row margin-top">
                        <div class="col-md-9 page-label">
                            <label>Cover Letter</label>
                        </div>

                        <div class="col-md-12 text-justify">
                            <textarea rows="8" class="form-control" name='cover_latter' id='cover_latter'></textarea>
                        </div>
                    </div>

                    <div class="row margin-top page-label">
                        <div class="col-md-12">
                            <label>Attachment (Optional)</label>
                        </div>

                        <div class="col-md-12 job-attachment">
                            <div class="dropzone" id="my-dropzone" name="job_attachement">
                                <div class="fallback">
                                    <input name="job_attachement" type="file" multiple />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row margin-top">
                        <div class="col-md-10">
                            <input type="submit" class="btn btn-primary form-btn" value="Submit a Proposal" id='submit-all'/>
                            <input type="button" class="btn btn-primary form-btn" value="cancel" onclick="window.history.go(-1);"/>
                            <img src='/assets/img/version1/loader.gif' class="form-loader" style="display:none">
                        </div>
                    </div> 

                </div>
            </form>
            <div class="col-md-3"></div>
        </div>

    </div>

</section>