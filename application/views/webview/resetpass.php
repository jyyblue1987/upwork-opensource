
	
<section id="big_header" style="margin-top:50px;margin-bottom:50px;height: auto;"> 
    <div class="container">
	
		<div class="row">
		
		<div class="col-md-6 col-md-offset-3" style="padding-top:30px;">
		  
		<h1 class="text-center">Reset Password
</h1>
		<h4 class="text-center" style="margin:20px 0px;">Dont Have an account? <a href="<?php echo site_url("signup/") ?>">Sign up</a></h4>
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
                                                            <input type="email" class="form-control" name="email" value="" id="email">
                          </div>
              
          

          
						  <div class="col-md-12 col-sm-12 boxsiz">
					<div class="checkbox-custom checkbox-primary text-left">
                          <a href="<?php echo site_url("signin"); ?>">Remember Password ?</a>
                        </div>
                        </div>
	<br><br>
                    <div class="col-md-12"><input type="submit" value="Send Reset Link" id="next" class="btn btn-primary pull-right"></div>
                    <!--<button type="submit" class="btn btn-primary pull-right">Next</button>-->
                </form>
		</div> 	
	 </div> 	
	 </div> 	
	 </div> 	
</section><!-- big_header-->
