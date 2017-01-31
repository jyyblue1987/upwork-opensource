	
<section class="fg_pass" id="big_header" style="margin-top:40px;margin-bottom:40px;height: auto;border: 1px solid #ccc;background: #fff;padding-bottom: 122px;"> 
    <div class="container">
	
		<div class="row">
		
		<div class="col-md-6 col-md-offset-3" style="padding-top:50px;">
		  
		<h1 style="font-size: 31px;font-family: calibri;" class="text-center">Reset Password
</h1>
		<h4 style="margin:20px 0px;margin-top: 0;" class="text-center">Don't Have an account? <a href="<?php echo site_url("signup/") ?>">Sign up</a></h4>
		<?php if(isset($_GET['error'])){ ?>
		<h4 class="text-center text-danger" style="margin:20px 0px;">Email Not Found</h4>
		<?php } ?>
		<?php if(isset($_GET['wrong'])){ ?>
		<h4 class="text-center text-danger" style="margin:20px 0px;">Link Not Valid</h4>
		<?php } ?>
		<?php if(isset($_GET['expired'])){ ?>
		<h4 class="text-center text-danger" style="margin:20px 0px;">Session Expired</h4>
		<?php } ?>
		
		<div class="row">
   <form id="basicc" method="post" action="<?php echo site_url("resetcheck"); ?>">

														
                        <div class="col-md-12 form-group">
                            <label for="exampleInputEmail1">Email <span class="red">*</span></label>
                                <input style="width: 400px;" type="email" class="form-control" name="email" placeholder="Email" value="" id="email">
                          </div>
	<br><br>
                    <div class="col-md-12"><input type="submit" value="Send Reset Link" id="next" class="pull-right btn btn-success sign_btn"></div>
                    <!--<button type="submit" class="btn btn-primary pull-right">Next</button>-->
                </form>
		</div> 	
	 </div> 	
	 </div> 	
	 </div> 	
</section><!-- big_header-->
<style type="text/css">
#mid_contant {
margin-top: 0px;
}
</style>