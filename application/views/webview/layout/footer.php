 
  
  </div>
</section>
<!-- End main_Div-->
<div class="clear"> </div>
<section class="big_footer">
<div id="find-jobs_container" class="container">
    <div class="row">
	 <div class="col-sm-6 col-md-6 col-lg-3">
	    <div class="footer-menu">  
			 <ul>
			 <li><p><b>Winjob</b></p></li>
			 <li><a href="<?php echo site_url("aboutus"); ?>">About us</a></li>
			 <li><a href="<?php echo site_url("contact"); ?>">Contact us</a></li>
                         <li><a href="<?php echo site_url("press"); ?>">Press</a></li>
			 <li><a href="<?php echo site_url("enterprise_solution"); ?>">Enterprise Solution</a></li>
			 <li><a href="<?php echo site_url("feedback_footer"); ?>">Feedback</a></li>
			</ul>
		</div>
	 </div>
  <div class="col-sm-6 col-md-6 col-lg-3">
	       <div class="footer-menu">  
			 <ul>
			  <li><p><b>Contact Support</b></p></li>
			 <li><a href="<?php echo site_url("help"); ?>">Help & Support</a></li>
                         <li><a href="<?php echo site_url("trust_safety"); ?>">Trust and Safety</a></li>
			 <li><a href="<?php echo site_url("make_better"); ?>">Help Make Winjob better</a></li>
			</ul>
		 </div>
	 </div>
	 <div class="clear1"></div>
	<div class="col-sm-6 col-md-6 col-lg-3">
	      <div class="footer-menu">  
			 <ul>
			 <li><p><b>Information</b></p></li>
			  <li><a href="<?php echo site_url("fees_charges"); ?>">Fee and Charges</a></li>
			  <li><a href="<?php echo site_url("cancellation_refunds"); ?>">Cancellations & Refunds</a></li>
			  <li><a href="<?php echo site_url("terms"); ?>">Terms & Conditions</a></li>
			  <li><a href="<?php echo site_url("privacy"); ?>">Privacy Policy</a></li>
			  <li><a href="<?php echo site_url("desktop_app"); ?>">Desktop App</a></li>
			</ul>
		 </div>
	 </div>

	<div class="col-sm-6 col-md-6 col-lg-3">
	      <div class="footer-menu">  
			
			<ul>
			<li><p><b>Knowledgebase</b></p></li>
				<li><a href="<?php echo site_url("how_to_join"); ?>">How to Join us?</a></li>
				<li><a href="<?php echo site_url("create_ticket"); ?>">How to create support tickets?</a></li>
				<li><a href="<?php echo site_url("getwork_done"); ?>">How to get your work done?</a></li>
				<li><a href="<?php echo site_url("add_fund"); ?>">How to add fund?</a></li>
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
</body>
</html>


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
		
