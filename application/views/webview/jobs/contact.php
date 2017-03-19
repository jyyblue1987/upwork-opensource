
	
<section id="big_header" style="margin-top:50px;margin-bottom:50px;height: auto;"> 
    <div class="container">
	
		<div class="row">
		
		<div class="col-md-6 col-md-offset-3" style="padding-top:30px;">
		  
		<h1 class="text-center">Contact Us
</h1>
	
			<?php if(isset($_GET['sent'])){ ?>
		<h4 class="text-center text-success" style="margin:20px 0px;">Message Sent successfuly</h4>
		<?php } ?>
		
		<div class="row">
   <form id="basicf" method="post" action="<?php echo site_url("contactcheck"); ?>">

				      <div class="col-md-12 form-group">
                            <label for="exampleInputEmail1">NAME <span class="red">*</span></label>
                                                            <input type="text" name="name" value="" placeholder="Full Name" class="form-control" id="firstname" autocomplete="false">
                                                        </div>
                      
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">EMAIL ADDRESS <span class="red">*</span></label>
                                                            <input type="email" class="form-control" id="email" value="" placeholder="Email" name="email">
                                                        </div>
                                        </div>
														  <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Message <span class="red">*</span></label>
                                                            <textarea class="form-control" id="body" placeholder="Message" name="body"></textarea>
                                                        </div>
                    </div>
					
	<br><br>
                    <div class="col-md-12"><input type="submit" value="Sign In" id="next" class="btn btn-primary pull-right"></div>
                    <!--<button type="submit" class="btn btn-primary pull-right">Next</button>-->
                </form>
		</div> 	
	 </div> 	
	 </div> 	
	 </div> 	
</section><!-- big_header-->
