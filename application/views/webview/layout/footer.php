 
  
  </div>
</section>
<!-- End main_Div-->
<div class="clear"> </div>
<section class="big_footer">
<div id="find-jobs_container" class="container">
    <div class="row">
	 <div class="col-sm-6 col-md-6 col-lg-3">
	    <div class="footer1">  
			 <ul>
			 <li><p><b>Winjob</b></p></li>
			 <li><a href="<?php echo site_url("aboutus"); ?>">About us</a></li>
			 <li><a href="<?php echo site_url("contact"); ?>">Contact us</a></li>
			 <li>Press</li>
			 <li>Enterprise Soluation</li>
			 <li>Feedback</li>
			</ul>
		</div>
	 </div>
  <div class="col-sm-6 col-md-6 col-lg-3">
	       <div class="footer1">  
			 <ul>
			  <li><p><b>Contact Support</b></p></li>
			 <li>Help & Support</li>
			 <li>Trust and Safety</li>
			 <li>Help Make Winjob better</li>
			</ul>
		 </div>
	 </div>
	 <div class="clear1"></div>
	<div class="col-sm-6 col-md-6 col-lg-3">
	      <div class="footer1">  
			 <ul>
			 <li><p><b>Information</b></p></li>
			  <li>Fee and Charges</li>
			  <li>Cancellations & Refunds</li>
			  <li><a href="<?php echo site_url("terms"); ?>">Terms & Conditions</a></li>
			  <li><a href="<?php echo site_url("policy"); ?>">Privacy Policy</a></li>
			  <li>Desktop App</li>
			</ul>
		 </div>
	 </div>

	<div class="col-sm-6 col-md-6 col-lg-3">
	      <div class="footer1">  
			
			<ul>
			<li><p><b>Knowledgebase</b></p></li>
				<li>How to Join us?</li>
				<li>How to create support tickets?</li>
				<li>How to get your work done?</li>
				<li>How to add fund?</li>
			</ul>
		 </div>
	 </div>
	</div>
</div>






<!-- End big_footer---->
<div class="footer">
  <div id="find-jobs_container" class="container">
     <div class="row">
	    <div class="col-sm-6 col-md-6"><h1><b>WINJOB</b></h1></div>
	    <div class="col-sm-6 col-md-6"><p>© 2016 WINJOB</p></div>
	 </div>
  </div>
</div>
<!-- End footer---->
</section>

		<!--<script src="<?php //echo site_url("assets/js/jquery.js"); ?>"></script>-->
		<script src="<?php echo site_url("assets/js/bootstrap.min.js"); ?>"></script>
		<script src="<?php echo site_url("assets/js/plugins.js"); ?>"></script>        
		<script src="<?php echo site_url("assets/js/bootstrap-datepicker.js"); ?>"></script>
        <script src="<?php echo site_url("assets/js/main.js"); ?>"></script>
		<script src="<?php echo site_url("assets/range/jquery_range.js"); ?>"></script>
        <script src="<?php echo site_url("assets/range/jquery-ui.js"); ?>"> </script>
		
  
		<script src="<?php echo site_url("assets/global/vendor/formvalidation/formValidation.js"); ?>" type="text/javascript"></script>
		<script src="<?php echo site_url("assets/js/reCaptcha2.min.js"); ?>" type="text/javascript"></script>
		<script src="<?php echo site_url("assets/global/vendor/formvalidation/framework/bootstrap.js"); ?>" type="text/javascript"></script>

        <script src="<?php echo site_url("assets/js/sample.js"); ?>"> </script>

		<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.rateyo.js"></script>    <script>      $(function () {        $("#rateYo").rateYo({        	starWidth: "20px"            });      });    </script>    
  <?php
        if (isset($js))
        {
            foreach ($js as $file)
            {
        echo '<script src="' . site_url("assets/js/$file") . '"> </script>';
    }
        }
		?>
		
