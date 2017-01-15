
<div style="clear:both"></div><!--end--header bottm-->
<section id="main-content">
	<div class="container main-area">
		<div class="row">
			<div class="midle-min">

			  <div class="col-sm-6 col-md-6 col-lg-4">
			   <div class="fast">
					   <a href="<?php echo site_url("pay/methods_card"); ?>"> <img src="<?php echo site_url("assets/img/img1.png"); ?>" alt="" /></a>

				</div>

				 </div>

				 <div class="col-sm-6 col-md-6 col-lg-4">
				 <div class="secend">
	    <a href="<?php echo site_url("pay/methods_paypal"); ?>"><img src="<?php echo site_url("assets/img/img2.png"); ?>" alt="" /></a>
				 </div>
				 </div>

				 <div class="col-sm-6 col-md-6 col-lg-4">
				  <div class="tard">
	   <a href="<?php echo site_url("jobs-home"); ?>"> <img src="<?php echo site_url("assets/img/img3.png"); ?>" alt="" /></a>
					</div>
				 </div>


				 <div style="clear:both"></div>
			</div>
		</div>
		<section id="buttonsome">
		<div class="row">
						<div class="col-xs-12 col-md-7 col-md-offset-4">
							<form action="addPP" method="POST">
								<input type="hidden" name="paypal_agreement" value="yes" />
								<button type="submit" id="butcancel" class="btn btn-danger">Add PayPal</button>
								<button type="button" id="butupdat"class="btn btn-primary">Cancel</button>
							</form>
						  </div>
		</div>
		</section>

	</div>
	<div style="clear:both"></div>
</section>
