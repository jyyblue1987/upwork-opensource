
	
<section id="big_header" style="margin-top:50px;margin-bottom:50px;height: auto;"> 
    <div class="container">
	
		<div class="row">
		
		<div class="col-md-6 col-md-offset-3" style="padding-top:30px;">
		  
		<h1 class="text-center">Create a New Account
</h1>
		<h4 class="text-center" style="margin:20px 0px;">Allready Have an Account? <a href="<?php echo site_url("signin/") ?>">Sign In</a></h4>
			<?php if(isset($_GET['email'])){ ?>
		<h4 class="text-center text-danger" style="margin:20px 0px;">Email Allready Exists</h4>
		<?php } ?>
			<?php if(isset($_GET['username'])){ ?>
		<h4 class="text-center text-danger" style="margin:20px 0px;">Username Allready Exists</h4>
		<?php } ?>
		
		<div class="row">
   <form id="basic" method="post" action="<?php echo site_url("registercheck"); ?>">
<input type="hidden" name="type" value="1">

                        <div class="col-md-12 form-group">
                            <label for="exampleInputEmail1">FIRST NAME <span class="red">*</span></label>
                                                            <input type="text" name="fname" value="" class="form-control" id="firstname" autocomplete="false">
                                                        </div>
                        <div class="col-md-12 form-group">
                            <label for="exampleInputEmail1">LAST NAME <span class="red">*</span></label>
                                                            <input type="text" class="form-control" name="lname" value="" id="lastname">
                                                        </div>
											<?php			
														
			  echo $this->Adminforms->selectdbnewx("Country","country","Select Country","country","id","name","index","asc","",true,array("all","All Country"));
			  
?>
														
                        <div class="col-md-12 form-group">
                            <label for="exampleInputEmail1">USERNAME <span class="red">*</span></label>
                                                            <input type="text" class="form-control" name="username" value="" id="username">
                                                        </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">EMAIL ADDRESS <span class="red">*</span></label>
                                                            <input type="email" class="form-control" id="emaila" value="" placeholder="Email" name="email">
                                                        </div>
                    </div>

                    <div class="col-md-12 form-group ">
                        <label>Password</label>
                        <input type="password" value="" name="password" class="form-control" id="password">
						<div id="pswd_info">
    <h4>Password must meet the following requirements:</h4>
    <ul>
        <li id="letter" class="invalid">At least <strong>one letter</strong></li>
        <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
        <li id="number" class="invalid">At least <strong>one number</strong></li>
        <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
    </ul>
</div>
                    </div>


                    <div class="col-md-12 form-group ">
                        <label>Confirm Password</label>
                        <input type="password" value="" name="confirm_password" class="form-control" id="confirm_password">
						

<div id="pswd_infob">
    <ul>
        <li id="vefyx" class="invalid">Verify Password</li>
    </ul>
</div>
                    </div>
                    <div class="col-md-12 form-group ">
                        <label>captcha</label>
						<div id="captchaContainer" data-sitekey="6LfBjhMTAAAAALXyw2s8Q5re9o5mKPj1mKrM1QXW"></div>

						

                    </div>
						  <div class="col-md-12 col-sm-12 boxsiz">
					<div class="checkbox-custom checkbox-primary">
                          <input type="checkbox" name="check1" id="check1">
                          <label for="check1">Accept <a href="<?php echo site_url("termsandconditions/") ?>">Terms of Service</a></label>
                        </div>
                        </div>
          
	<br><br>
                    <div class="col-md-12"><input type="submit" value="Create Account" id="next" class="btn btn-primary pull-right"></div>
                    <!--<button type="submit" class="btn btn-primary pull-right">Next</button>-->
                </form>
		</div> 	
	 </div> 	
	 </div> 	
	 </div> 	
</section><!-- big_header-->
