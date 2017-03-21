
	
<section id="big_header" style="margin-top:50px;margin-bottom:50px;height: auto;"> 
    <div class="container">
	  
		<h1 class="text-center"><?php echo $message; ?></h1>
		<br>
		<div class="text-center">
		<a class="btn btn-success"  href="<?php echo site_url("signin/").(isset($_GET['redirect']) ? '?redirect='.$_GET['redirect'] : '' ) ?>">Sign In</a>
		</div>
		
</section><!-- big_header-->
