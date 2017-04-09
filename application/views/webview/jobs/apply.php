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
    
</style>

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

<?php
/* find client payment set status start */
$this->db->select('*');
$this->db->from('job_accepted');
$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
$this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
$this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
$this->db->where('job_accepted.buser_id',$value->webuser_id);

$query=$this->db->get();
$accepted_jobs = $query->result();
$total_feedbackScore=0 ;
$total_budget=0 ;
if (count($accepted_jobs) > 0) {
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

$this->db->select('*');
$this->db->from('billingmethodlist');
$this->db->where('billingmethodlist.belongsTo', $value->webuser_id);
// $this->db->where('billingmethodlist.paymentMethod', "stripe");
$this->db->where('billingmethodlist.isDeleted', "0");
$query = $this->db->get();
$paymentSet = 0;
if (is_object($query)) {
    $paymentSet = $query->num_rows();
}
/* find client payment set status end */


/* find total spent by client start */
$client_id=$value->webuser_id;
$query_spent = $this->db->query("SELECT SUM(payment_gross) as total_spent FROM `payments` INNER JOIN `webuser` ON `webuser`.`webuser_id` = `payments`.`user_id` INNER JOIN `jobs` ON `jobs`.`id` = `payments`.`job_id` INNER JOIN `job_accepted` ON `job_accepted`.`job_id` = `payments`.`job_id` INNER JOIN `job_bids` ON `job_bids`.`job_id` = `payments`.`job_id` WHERE `job_accepted`.`fuser_id` = `payments`.`user_id` AND
    `job_bids`.`user_id` = `payments`.`user_id` AND `payments`.`buser_id` = $client_id");
$row_spent = $query_spent->row();
$total_spent=$row_spent->total_spent;
/* find total soent by client end */

?>

<section id="big_header">

    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-0 white-box job-cont">
                <div class='form-msg'></div>
                <div class="row">
                    <div class="col-md-10 page-label">
                        <h1 class="job-title cos_job-title"><?php echo ucfirst($value->title) ?></h1>
                    </div>
                    
                    <div class="col-md-2 page-label">                        
                        <span class="pull-right marg-top-neg"><?php 
                         $timeDate = strtotime($value->job_created);
                            $dateInLocal = date("Y-m-d H:i:s", $timeDate);
                        echo time_elapsed_string(strtotime($dateInLocal)); ?></span>
                    </div>
                    
                </div>
<div class="jobdes-bordered-wrapper">
                <div class="row jobdes-bordered page-label">
                    <div class="col-md-3 text-center">
                        <label class="lab-res">Job Type</label> <br /> <span><?php echo ucfirst($value->job_type) ?></span>
                    </div>

                    <div class="col-md-3 text-center page-label">
                        <label class="lab-res">
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
                        <label class="lab-res">Job Duration</label><br /> <span><?php echo str_replace('_', '-', $value->job_duration) ?></span>
                    </div>

                    <div class="col-md-3 last-div text-center page-label">
                        <label class="lab-res">Experience Level</label><br /> <span><?php echo ucfirst($value->experience_level); ?></span>
                    </div>
                </div>
</div>

                <div class="row margin-top margin-top-15">
                    <div class="col-md-2">
                        <label class="job-cat">Job Category</label>
                    </div>
                    <div class="col-md-10 margin-top-4">
                        <?php 
                       
                        $this->db->select('*');
                        $this->db->from('job_subcategories'); 
                        $this->db->where('subcat_id',$value->category);
                        $query_done = $this->db->get();
                        $result= $query_done->row();
                        echo $result->subcategory_name;
                        ?>
                    </div>
                </div>

                <div class="row margin-top page-label">
                    <div class="col-md-2">
                        <label>Skills</label>
                    </div>

                    <div class="col-md-10 skills page-label margin-top-neg-2">
                        <div class="custom_user_skills">
                            <?php
                            if (isset($skills) && !empty($skills))
                            {
                                
                                foreach($skills AS $key => $_skills){
                                    foreach($_skills AS $skill)
                                    echo "<span style='font-family: Calibri; font-size: 10.5px; padding-right: 5px;'>".ucwords($skill)."</span> ";
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

                    <div class="col-md-12 text-justify page-label job-desc"><?php echo ucfirst($value->job_description) ?></div>
                </div>
                
                <div class="row margin-top page-label">
                    <div class="col-md-9">
                        <label>Attachment</label>
                    </div>

                    <div class="col-md-12 text-justify page-label job-desc">
                         <?php 
                    $attachments = explode(",", $value->userfile);
                    foreach($attachments AS $attachment){
                        echo '<a href="'.site_url().'jobs/download?dir='.$value->user_id.'/'.$value->tid.'&file='.str_replace('"','', $attachment).' ">'.str_replace('"','', $attachment).'</a><br>'; 
                    }
                    ?>
                    </div>
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
                        <label class="lab-res">Proposals</label> <br /> <span>
                       <?=$applicants;?>
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
                        <label class="lab-res">Interviewing</label><br /> <span><?=$interviews;?> </span>
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
                        <label class="lab-res">Hired</label><br /> <span>
                            <?php echo $hires;?>
                        </span>
                    </div>
                </div>
    </div>
            
            <form method="post" id='jobApply'>
                <input type="hidden" name='job_id' id='jobId' value='<?php echo $value->job_id; ?>'/>
                <input type="hidden" name='job_title' id='job_title' value='<?php echo $value->title; ?>'/>
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
                                            <td>                                        <?php
                                        $bidAmt = '';
                                        $perHrs='';
                                        if ($value->job_type == 'hourly')
                                        {
                                            if ($rate)
                                            {
                                                $bidAmt = $rate + $rate * WINJOB_FEE;
                                            } else
                                                $rateMsg = 1;
                                            $perHrs='/hr';
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
                    <?php if ($value->job_type != 'hourly') { ?>
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
                        

<!--                        <div class="col-md-12 job-attachment" style="display: none;">
                            <div class="dropzone" id="my-dropzone" name="job_attachement">
                                <div class="fallback">
                                    <input name="job_attachement" type="file" multiple />
                                </div>
                            </div>
                        </div>-->
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
                                
                                <?php
if ($value->isactive && $paymentSet) {
    ?>
                                        <i style="" class="fa fa-check-circle circ-check"></i>
                                        <?php
                                    } else {
                                        ?>
                                        <i style="" class="fa fa-minus-circle circ-min"></i>
                                        <?php
                                    }
                                    ?>
                                <label class="pad-25"><?php echo ucfirst($value->webuser_fname) ?></label>
                                
                                
                            </div>
                        </div>
                        <div style="" class="row margin-top-2 border-bottom right-cont">
                            <div class="col-md-8 ">
								<?php if($total_feedbackScore !=0 && $total_budget!=0){
                                $totalscore = ($total_feedbackScore / $total_budget);
                                $rating_feedback = ($totalscore/5)*100;
                               ?>
                                <button style="" class="totscore" id="buttonfirst"><?=number_format((float)$totalscore,1,'.','');?></button>
								<div title="Rated <?=$totalscore;?> out of 5" class="star-rating revrat" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
								<span style="width:<?=$rating_feedback;?>%">
									<strong itemprop="ratingValue"><?=$totalscore;?></strong> out of 5
								</span>
								</div>
							<?php  }else{ ?>
                             <button style="" class="totscore"  id="buttonfirst">0.0</button>
								<div style="" title="Rated 0 out of 5" class="star-rating revrat" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
								<span class="width0">
									<strong itemprop="ratingValue">0</strong> out of 5
								</span>
								</div>
                          <?php   } ?>
                               
                            </div>
                        </div>
                        <div style="" class="row margin-top-2 border-bottom job-posted">
                            <div class="col-md-12">
                                <label style="" class="label-side">
                                   <?php if(!empty($record_sidebar)){
                                        echo $record_sidebar;
                                    }else{
                                        echo "0";
                                    } ?>
                                <span class="span-side">Jobs Posted</span>
                                </label>
                            </div>
                        </div>
                        <div class="row margin-top-2 border-bottom hired">
                            <div class="col-md-12">
                                <label style="" class="label-side">
                                <?=$hire;?> 
                                <span class="span-side">Hired</span>
                                </label>
                            </div>
                        </div>
                        <div style="" class="row margin-top-2 border-bottom total-work">
                            <div class="col-md-12">
                                <label style="" class="label-side">
                                <?php $total_work = 0;
                                    if(!empty($workedhours)){
                                        foreach($workedhours as $work){
                                            $total_work +=$work->total_hour;
                                        }
                                        echo $total_work." <span class='total-works'>Hours</span>";
                                    }else{
                                        echo " 0 <span class='total-works'>Hours Worked</span>";
                                    }?>
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
                                <span class="span-side"><?php
                                $this->db->where('country_id', $value->webuser_country);
                                $q = $this->db->get('country');
                                $record = $q->row();
                                echo ucfirst($record->country_name);
                                ?></span>
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