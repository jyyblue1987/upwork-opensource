
	
<section id="big_header" style="margin-top:50px;margin-bottom:50px;height: auto;"> 
    <div class="container">
	
		<div class="row">
		
		<div class="col-md-6 col-md-offset-3" style="padding-top:30px;">
		  
		<h1 class="text-center">Give Us a New Password
</h1>
		<h4 class="text-center" style="margin:20px 0px;">Remember Password? <a href="<?php echo site_url("signin/") ?>">Sign in</a></h4>
		
		
		<div class="row">
   <form id="basice" method="post" action="<?php echo site_url("resetpasscheck?token=").$_GET['token']; ?>">
<input type="hidden" name="type" value="2">

             
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
          
	<br><br>
                    <div class="col-md-12"><input type="submit" value="Set Password" id="next" class="btn btn-primary pull-right"></div>
                    <!--<button type="submit" class="btn btn-primary pull-right">Next</button>-->
                </form>
		</div> 	
	 </div> 	
	 </div> 	
	 </div> 	
</section><!-- big_header-->
