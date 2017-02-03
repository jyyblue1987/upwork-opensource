<div class="payment_modal-content">
<section id="big_header" style="margin-top: 50px; margin-bottom: 50px; height: auto; font-family: Calibri;padding: 0 45px;">

	<div class="pop_method_cancel"><a href="" data-dismiss="modal"><i class="fa fa-times"></i></a></div>
	<div>
		<div class="row">
			<div class="col-md-12 pop_method_border">
				<div class="row">
					<div class="col-md-12 margin-left-2">
                        <h2 style="font-size: 25px;">Add a verified payment method : <span class="payemnt-method-name" style="text-transform: capitalize;font-size: 25px"></span></h2>
					</div>

				</div>
			</div>
		</div>
		<div class="row">
			<div style="padding-right: 30px;" class="col-md-12 pop_method_border">

				<div class="row">
					<div style="font-size: 16px;margin-top: 16px;margin-bottom: -5px;" class="col-md-12 margin-left-2">
						Transfer funds to your Paypal account for $1 USD per withdraw,
						plus any fees charged by Paypal, <a href="#">Learn more about
							Paypal Withdrawals</a>
					</div>
				</div>

				<div style="font-size: 16px;" class="row margin-top-2">
					<div style="margin-bottom: 10px;" class="col-md-12 margin-left-2">
						<label>Dont have a Paypal Account?</label> <a href="http://paypal.com">Visit PayPal</a>
					</div>
				</div>

				<div class="row margin-top-1">
					<div class="col-md-3 margin-left-2">
						<label style="color: #333;font-size: 16px;">Paypal Email Address</label>
					</div>

					<div class="col-md-8">
                                            <span style="font-size: 16px;" class="account-email"><?php echo $this->session->userdata('email'); ?></span><br /> 
                                                <p style="color:red;font-size: 16px;">Not your Paypal Email address?</p>
					</div>
				</div>


				<div class="row margin-top-2">
					<div class="col-md-3 margin-left-2">
						<div style="border-radius: 3px;" class="pop_method_border method-logo">
                                                    <img class="payment-method-logo" src="<?php echo base_url()?>assets/img/paypal_logo.png" width="64" />
						</div>
					</div>

					<div style="font-size: 16px;" class="col-md-8 margin-top-2">
						This Payment method will become active in 3 days
					</div>
				</div>
				
				
				<div class="row margin-top-4">
					<div class="col-md-3">
					</div>
					
					<div style="margin-left: 20px;margin-bottom: 30px;" class="col-md-5">
						<input style="float: left;" type="button" class="btn-primary big_mass_active transparent-btn big_mass_button add-account" value="Add Account" />
						<input style="float: left;" type="button" class="btn-primary transparent-btn big_mass_button" value="Cancel"  data-dismiss="modal"/>
					</div>

				</div>
				


			</div>
		</div>
	</div>

</section>
</div>

</div>

</section>
<!-- big_header-->

