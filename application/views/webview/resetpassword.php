<style type="text/css">
.help-block{display: block;
margin-left: 36px;
font-size: 16px;
font-family: calibri;}
</style>

<section id="big_header" style="margin-top:40px;margin-bottom:40px;height: auto;border: 1px solid #ccc;background: #fff;"> 
    <div class="container">
	
		<div class="row">
		
		<div class="col-md-6 col-md-offset-3" style="padding-top:30px;margin-left: 195px;">
		  
		<h1 style="font-size: 31px;font-family: calibri;margin-left: 72px;" class="text-center">Give us a new password
</h1>
		<h4 class="text-center" style="margin:20px 0px;margin-top: 0;margin-left: 72px;">Remember Password? <a href="<?php echo site_url("signin/") ?>">Sign in</a></h4>
		
		
		<div class="row">
   <form id="basice" method="post" action="<?php echo site_url("resetpasscheck?token=").$_GET['token']; ?>">
<input type="hidden" name="type" value="2">

             
                    <div class="col-md-12 form-group ">
                        <label style="margin-left:35px;">Password</label>
                        <input placeholder="New Password" style="border-radius: 4px;width: 400px;margin-left: 35px;" type="password" value="" name="password" class="form-control" id="password">
						<div style="margin-left: 35px;" id="pswd_info">
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
                        <label style="margin-left:35px;">Confirm Password</label>
                        <input placeholder="Confirm Password" style="border-radius: 4px;width: 400px;margin-left: 35px;" type="password" value="" name="confirm_password" class="form-control" id="confirm_password">
                    </div>
          
	<br><br>
                    <div style="margin-left: 4px;margin-bottom: 115px; " class="col-md-12"><input style="width: 400px;color: #fff;margin-left: 35px;" type="submit" value="Set Password" id="next" class="btn btn-success pull-right"></div>
                    <!--<button type="submit" class="btn btn-primary pull-right">Next</button>-->
                </form>
		</div> 	
	 </div> 	
	 </div> 	
	 </div> 	
</section><!-- big_header-->
