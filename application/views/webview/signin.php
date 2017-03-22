   <div class="main_area_div_signin main_area_div white-box">
  	<h1 class="text-center header-login">Login and start to work</h1>
			 
 	<h4 class="text-center" style="margin:20px 15px;margin-bottom: 28px;">Don't have an account? <a href="<?php echo site_url("signup/") ?>">Sign up</a></h4>

		<?php if(isset($_GET['error'])){ ?>
		<h4 class="text-center text-danger" style="margin:20px 15px;">Wrong Username or Password</h4>
		<?php } ?>
		<?php if(isset($_GET['emailverify'])){ ?>
		<h5 class="text-center text-danger" style="margin:20px 15px;">Email Not Verified </br></br>
			<?php if(isset($_GET['username'])){ ?>
		<a class="" href="<?php echo site_url("resendlink?username=").$_GET['username']; ?>">Resend </a>Verification Link To <?php echo $newemail; ?>
		<?php } ?>
		</h5>
		<?php } ?>
			<?php if(isset($_GET['reset'])){ ?>
		<h4 class="text-center text-success" style="margin:20px 15px;">Password Changed Successfuly</h4>
		<?php } ?>
		
		
		
		   <form style="margin-bottom: 61px;" id="basicb" method="post" action="<?php echo site_url("logincheck"); ?>">
		   		<div class="row">
					<div class="col-md-3 col-lg-4 col-sm-3 hidden-xs">
					</div>
		   			<div class="col-md-6 col-lg-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="username" value="" id="username" placeholder="Username or Email">
                        <input type="hidden" name="redirect" value="<?= isset($_GET['redirect']) ? '?redirect='.$_GET['redirect'] : '0' ?>">
		   			</div>
					<div class="col-md-3 col-lg-4 col-sm-3 hidden-xs">
					</div>
		   		</div>

		   		<div class="row">
					<div class="col-md-3 col-lg-4 col-sm-3 hidden-xs">
					</div>
		   			<div class="col-md-6 col-lg-4 col-sm-6 col-xs-12">
                            <input type="password" value="" name="password" class="form-control" id="password" placeholder="Password">
		   			</div>
					<div class="col-md-3 col-lg-4 col-sm-3 hidden-xs">
					</div>
		   		</div>

				<div class="row">
					<div class="col-md-3 col-lg-4 col-sm-3 hidden-xs">
					</div>
					<div class="col-md-6 col-lg-4 col-sm-6 col-xs-12 text-left">
						<input type="checkbox" name="check2" id="check2">
						<label for="check2">Remember Me</label>
					</div>
					<div class="col-md-3 col-lg-4 col-sm-3 hidden-xs">
					</div>
				</div>


				<div class="row">
					<div class="col-md-3 col-lg-4 col-sm-3 hidden-xs">
					</div>
					<div class="col-md-6 col-lg-4 col-sm-6 col-xs-12">
             			<input type="submit" value="Sign In" class="btn btn-success btn-block" id="next">
					</div>
					<div class="col-md-3 col-lg-4 col-sm-3 hidden-xs">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3 col-lg-4 col-sm-3 hidden-xs">
					</div>
					<div class="col-md-6 col-lg-4 col-sm-6 col-xs-12">                           
						<div style="margin-top: 11px;font-family: calibri;font-size: 18px;float: right;" class="checkbox-custom checkbox-primary text-left">
                          <div class="forgot_btn">
                              <a href="<?php echo site_url("resetpass"); ?>">Forgot Password ?</a>
                          </div>
                        </div>
					</div>
					<div class="col-md-3 col-lg-4 col-sm-3 hidden-xs">
					</div>
				</div>
                </form>						   
		 </div>

   
<style type="text/css">
#mid_contant {
margin-top: 0px;
}
</style>