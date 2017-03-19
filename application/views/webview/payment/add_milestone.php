<form method="post" id="hr_addMilestone" action="<?php echo site_url("pay/add_milestone"); ?>">
<div style="margin-left: 25px;margin-bottom: 30px;" class="row">    
    <h4 style="margin-top: 20px;margin-bottom: 25px;font-size: 17px;font-weight: bold;margin-left: 15px;">Release Milestone funds</h4>
	<div class="col-md-3" style="font-size: 17px;">Milestone <span style="margin-left: 15px;font-size: 17px;font-family: calibri;">$</span></div>
    <div class="col-md-6"><input style="margin-left: -60px;margin-top: -5px;font-size: 16px;font-family: calibri;" class="form-control" type="text" name="amount"></div>
    </div>
    
    <input name="job_id" type="hidden" value="<?php if(isset($job_id)) echo $job_id; ?>" />
    <input name="user_id" type="hidden" value="<?php if(isset($fuser_id)) echo $fuser_id; ?>" />
    <input name="buser_id" type="hidden" value="<?php if(isset($buser_id)) echo $buser_id; ?>" />
    
<button style="float: left;margin-left: 148px;" id="hr_btnpay" class="btn-primary big_mass_active transparent-btn big_mass_button">Pay Now</button>
<a style="float: left;" class="btn-primary big_mass_active transparent-btn big_mass_button" class="close" data-dismiss="modal">cancel</a>
</form>
<strong id="hr_msg"></strong>