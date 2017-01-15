<form method="post" id="hr_fullMilestone" action="<?php echo site_url("pay/full_milestone"); ?>">
<div class="row">
    <div class="col-md-4" style="font-size: 23px;">Pay Amount $</div>
    <div class="col-md-6"><input class="form-control" type="text" name="amount" value="<?php if(isset($remaining)) echo $remaining;?>" /></div>
    </div>
    <input name="job_id" type="hidden" value="<?php if(isset($job_id)) echo $job_id; ?>" />
    <input name="user_id" type="hidden" value="<?php if(isset($fuser_id)) echo $fuser_id; ?>" />
    <input name="buser_id" type="hidden" value="<?php if(isset($buser_id)) echo $buser_id; ?>" />

<button id="hr_btnpay" class="btn btn-primary">Pay Now</button> <a class="btn btn-primary" class="close" data-dismiss="modal">cancel</a>
</form>
<strong id="hr_msg"></strong>
<script>
// process the form
    $('#hr_fullMilestone').submit(function(event) {
      $('#hr_btnpay').prop('disabled', true);
        var response = "";
        $.ajax({
            type        : 'POST',
            url         : '<?php echo site_url("pay/full_milestone"); ?>',
            data        : $('form#hr_fullMilestone').serialize(),
            //dataType    : 'json',
            //encode      : true,
        })
            .done(function(res) {
                if(res == "done"){
                  window.location.replace("/jobs/fixed_client_view?fmJob=NTY=&fuser=MTU=");
                }else {
                  $('#hr_msg').text(res);
                  $('#hr_btnpay').prop('disabled', false);
                }
                console.log(res);
            });
        event.preventDefault();
    });
</script>
