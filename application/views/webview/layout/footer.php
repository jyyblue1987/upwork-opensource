 
  
  </div>
</section>
<!-- End main_Div-->
<div class="clear"> </div>
<section class="big_footer">
<div class="container">
    <div class="row">
	 <div class="col-sm-6 col-md-6 col-lg-3">
	    <div class="footer-menu">  
			 <ul>
			 <li><p><b>Winjob</b></p></li>
			 <li><a href="<?php echo site_url("aboutus"); ?>">About us</a></li>
			 <li><a href="<?php echo site_url("contact"); ?>">Contact us</a></li>
                         <li><a href="<?php echo site_url("press"); ?>">Press</a></li>
			 <li><a href="<?php echo site_url("enterprise-solution"); ?>">Enterprise Solution</a></li>
			 <li><a href="<?php echo site_url("feedback"); ?>">Feedback</a></li>
			</ul>
		</div>
	 </div>
  <div class="col-sm-6 col-md-6 col-lg-3">
	       <div class="footer-menu">  
			 <ul>
			  <li><p><b>Contact Support</b></p></li>
			 <li><a href="<?php echo site_url("employer-help"); ?>">Help & Support</a></li>
                         <li><a href="<?php echo site_url("trust-safety"); ?>">Trust and Safety</a></li>
			 <li><a href="<?php echo site_url("make-better"); ?>">Help Make Winjob better</a></li>
			</ul>
		 </div>
	 </div>
	 <div class="clear1"></div>
	<div class="col-sm-6 col-md-6 col-lg-3">
	      <div class="footer-menu">  
			 <ul>
			 <li><p><b>Information</b></p></li>
			  <li><a href="<?php echo site_url("fees-charges"); ?>">Fee and Charges</a></li>
			  <li><a href="<?php echo site_url("cancellation-refund"); ?>">Cancellations & Refunds</a></li>
			  <li><a href="<?php echo site_url("terms"); ?>">Terms & Conditions</a></li>
			  <li><a href="<?php echo site_url("privacy"); ?>">Privacy Policy</a></li>
			  <li><a href="<?php echo site_url("desktop-app"); ?>">Desktop App</a></li>
			</ul>
		 </div>
	 </div>

	<div class="col-sm-6 col-md-6 col-lg-3">
	      <div class="footer-menu">  
			
			<ul>
			<li><p><b>Knowledgebase</b></p></li>
				<li><a href="<?php echo site_url("how-to-join"); ?>">How to Join us?</a></li>
				<li><a href="<?php echo site_url("create-ticket"); ?>">How to create support tickets?</a></li>
				<li><a href="<?php echo site_url("getwork-done"); ?>">How to get your work done?</a></li>
				<li><a href="<?php echo site_url("add-fund"); ?>">How to add fund?</a></li>
			</ul>
		 </div>
	 </div>
	</div>
</div>






<!-- End big_footer---->
<div class="footer">
  <div class="container">
     <div class="row">
	    <div class="col-sm-6 col-md-6"><h1><b>WINJOB</b></h1></div>
	    <div class="col-sm-6 col-md-6"><p>© 2016 WINJOB</p></div>
	 </div>
  </div>
</div>
<!-- End footer---->
</section>
<script>
 var global_url_array = {
     'freelance-jobs': 'jobs/jobs_no_auth',
     'find-jobs': 'jobs/find'
 };
 
 function get_target_path(){
    var url = window.location.href;
    for(var key in global_url_array){
         if(url.indexOf(key) > -1){
             return global_url_array[key];
        }
    }

    return global_url_array['find-jobs'];
 }
 
 function base_url() {
    var base_url = '<?php echo base_url(); ?>';
    return base_url;
}
 </script>
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
</body>
</html>


		
