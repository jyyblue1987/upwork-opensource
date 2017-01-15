   <div class="main_area_div white-box">
   
   <div class="row"> 
	    <div class="col-md-5">
		   <div class="main_area_div_sub_div_page3">
		     <h1>Login</h1>
			 
			 		<h4 class="text-left" style="margin:20px 15px;">Dont Have an account? <a href="<?php echo site_url("signup/") ?>">Sign up</a></h4>
		<?php if(isset($_GET['error'])){ ?>
		<h4 class="text-left text-danger" style="margin:20px 15px;">Wrong Username or Password</h4>
		<?php } ?>
		<?php if(isset($_GET['emailverify'])){ ?>
		<h5 class="text-left text-danger" style="margin:20px 15px;">Email Not Verified </br></br>
			<?php if(isset($_GET['username'])){ ?>
		<a class="" href="<?php echo site_url("resendlink?username=").$_GET['username']; ?>">Resend </a>Verification Link To <?php echo $newemail; ?>
		<?php } ?>
		</h5>
		<?php } ?>
			<?php if(isset($_GET['reset'])){ ?>
		<h4 class="text-left text-success" style="margin:20px 15px;">Password Changed Successfuly</h4>
		<?php } ?>
		
		
		
		   <form id="basicb" method="post" action="<?php echo site_url("logincheck"); ?>">

														
                        <div class="col-md-12 ">
                 <input type="text" class="form-control" name="username" value="" id="username" placeholder="User name">
                          </div>
              
                    <div class="col-md-12 ">
                        <input type="password" value="" name="password" class="form-control" id="password" placeholder="password">
	
                    </div>


						  <div class="col-md-6 col-sm-12 boxsiz">
					<div class="checkbox-custom checkbox-primary">
                          <input type="checkbox" name="check2" id="check2">
                          <label for="check2">Remember Me</label>
                        </div>
                        </div>
          
						  <div class="col-md-6 col-sm-12 boxsiz">
					<div class="checkbox-custom checkbox-primary text-right">
                          <a href="<?php echo site_url("resetpass"); ?>">Forgot Password ?</a>
                        </div>
                        </div>
	<br><br>
                    <div class="col-md-12"><input type="submit" value="Sign In" id="next" class="btn btn-success"></div>
					
			 <div class="clear" style="
    margin-bottom: 9px;"></div>
                </form>
				
				
			
		   </div> 
		   
		   
		 </div>
		   
	    <div class="col-sm-12 col-md-2">
		<div class="main_area_div_sub_div2_main">
		    <div class="main_area_div_sub_divx2">
		      <div></div>  
			  <div><p>OR</p></div>
			  <div></div>
		   </div>
		   
		</div>
		</div>
		 
	    <div class="col-sm-12 col-md-5">
		     <div class="main_area_div_sub_div3 text-left">
		       <h1>Login with your social networks</h1>
			 <a href="https://www.facebook.com/"  target="_blank"> <button class="btn btn-success  btn-social btn-facebook" >
			  <i class="fa fa-facebook"></i>Login With Facebook</button></a>
			  <div class="clear"></div>
			 <a href="https://www.linkedin.com/"  target="_blank">  <button class="btn btn-success  btn-social btn-Linkedin" >
			  <i class="fa fa-linkedin-square"></i>Login With Linkedin</button></a> 
			  <div class="clear"></div>
			  <a href="https://plus.google.com/collections/featured"  target="_blank">  <button class="btn btn-success  btn-social btn-google" >
			  <i class="fa fa-google-plus-square"></i>Login With  Google+</button></a>
			
		    </div> 
		</div>
	 </div><!-- row-->
   </div>
  
  