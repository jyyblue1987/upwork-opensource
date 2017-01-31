   <div class="main_area_div_signin main_area_div white-box">
   
   <div class="row"> 
	    <div class="col-md-12 text-center">
		   <div class="main_area_div_sub_div_page3">
		      <div class="sign_heading">
		          <h1>Login and start to work</h1>
		      </div>
			 
			 		<div class="sing_up_text">
			 		    <h4 class="" style="margin:20px 15px;margin-bottom: 28px;">Don't Have an account? <a href="<?php echo site_url("signup/") ?>">Sign up</a></h4>
			 		</div>
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

														
                        <div class="col-md-9 col-md-offset-3 ">
                        <div class="user_login">
                            <input type="text" class="form-control" name="username" value="" id="username" placeholder="Username or Email">
                        </div>
                          </div>
              
                    <div class="col-md-9 col-md-offset-3 ">
                        <div class="user_password">
                            <input type="password" value="" name="password" class="form-control" id="password" placeholder="Password">
                        </div>
	
                    </div>


						  <div style="margin-top: -10px;margin-bottom: 10px;" class="col-md-9 col-md-offset-3 col-sm-12 boxsiz text-left">
					<div class="checkbox-custom checkbox-primary">
                          <input type="checkbox" name="check2" id="check2">
                          <label for="check2">Remember Me</label>
                        </div>
                        </div>
                
	
                     <div class="row">
                         <div class="col-md-6 col-md-offset-3 text-left">
                    <div class="signin_btn">
             <input type="submit" value="Sign In" id="next" class="btn btn-success sign_btn">
                    </div>
                      </div>
                       <div class="col-md-6 col-md-offset-3 text-left ">
                           <div style="margin-right: 35px;margin-top: 11px;font-family: calibri;font-size: 18px;float: right;" class="checkbox-custom checkbox-primary text-left">
                          <div class="forgot_btn">
                              <a href="<?php echo site_url("resetpass"); ?>">Forgot Password ?</a>
                          </div>
                        </div>
                       </div>
                    
                     </div>
                </form>				
			
		   </div> 
		   
		   
		 </div>
		</div><!-- row-->
   </div>

   
<style type="text/css">
#mid_contant {
margin-top: 0px;
}
</style>