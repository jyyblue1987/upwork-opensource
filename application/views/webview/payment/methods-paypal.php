<div style="clear:both"></div><!--end--header bottm-->
<section id="main-content" class="custom_mpayment_paypal">
	<div class="container main-area">
		<div class="row">
			<div class="midle-min">

				 <div class="col-sm-6 col-md-6 col-lg-6">
					<a href="<?php echo site_url("pay/methods_paypal"); ?>">
					<i class="fa fa-cc-paypal "></i>
					<i class="fa fa-check active_icon"></i>
					</a>
				 </div>

				<div class="col-sm-6 col-md-6 col-lg-6">
					<a class="pull-right" href="<?php echo site_url("pay/methods_card"); ?>">
					<i class="fa fa-credit-card"></i>
					</a>
				</div>
				 
				 <div style="clear:both"></div>
			</div>
		</div>
		
		<section id="buttonsome">
			
			<h2 style="margin-bottom: 35px; margin-left: 25px; margin-top: 40px;">Add a Verified PayPal Account <i class="fa fa-paypal "></i></h2>
			
			<div class="row">
				<div style="margin-left: 62px; margin-bottom: 5px;" class="col-xs-12 col-md-12">
					<form style="float: left;" action="addPP" method="POST">
						<input type="hidden" name="paypal_agreement" value="yes" />
						<button style="margin-left: -38px;border:1px;" type="submit" class="btn-primary transparent-btn big_mass_button left_btn">Add PayPal</button>
						<button type="button" class="btn-primary transparent-btn big_mass_button">Cancel</button>
					</form>
				  </div>
			</div>
		</section>

	</div>
	<div style="clear:both"></div>
</section>
<style type="text/css">
#mid_contant{min-height: 375px;}
</style>
