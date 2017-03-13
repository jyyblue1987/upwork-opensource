<form method="post" id="hr_fullMilestone" action="<?php echo site_url("pay/full_milestone"); ?>">
<div style="margin-left: 25px;margin-bottom: 30px;" class="row">
    <h4 style="margin-top: 20px;margin-bottom: 25px;font-size: 17px;font-weight: bold;margin-left: 15px;">Make full payment</h4>
	<div style="font-size: 17px;" class="col-md-3" style="font-size: 23px;">Pay Amount <span style="margin-left: 15px;font-size: 17px;font-family: calibri;">$</span></div>
    <div class="col-md-6"><input style="margin-left: -40px;margin-top: -5px;font-size: 16px;font-family: calibri;width: 80px;" class="form-control" type="text" name="amount" value="<?php if(isset($remaining)) echo $remaining;?>" /></div>
    </div>
    <input name="job_id" type="hidden" value="<?php if(isset($job_id)) echo $job_id; ?>" />
    <input name="fuser_id" type="hidden" value="<?php if(isset($fuser_id)) echo $fuser_id; ?>" />
    <input name="buser_id" type="hidden" value="<?php if(isset($buser_id)) echo $buser_id; ?>" />

<button style="float: left;margin-left: 148px;" id="hr_btnpay" class="btn-primary big_mass_active transparent-btn big_mass_button">Pay Now</button>
<a  style="float: left;" class="btn-primary big_mass_active transparent-btn big_mass_button" class="close" data-dismiss="modal">cancel</a>
</form>
<strong id="hr_msg"></strong>