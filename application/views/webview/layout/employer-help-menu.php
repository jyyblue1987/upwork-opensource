   <div class="main_area_div_signin main_area_div white-box help-home-details">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
				<h2>Winjob Help</h2>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<input type="text" class="form-control" placeholder="How can we help?">
			</div>
		</div>
		<div class="full">
			<p class="full-nav actived"><a href="../employer-help">Employer Help</a></p>
			<p class="full-nav"><a href="../freelancer-help">Freelancer Help</a></p>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="help-side-nax">
					<ul class="ul-side-nav">
						<li class="main-nav">
							<a href="registering-account" class="<?=$type == 'first' ? 'actived' : ''?>">Getting Started
							<?if($type == "first"){?>
							<ul class="sub-nav">
								<li><a href="registering-account" class="<?=$page == 'registering-account' ? 'actived' : ''?>">Registering an Account</a></li>
								<li><a href="costs-to-use" class="<?=$page == 'costs-to-use' ? 'actived' : ''?>">Costs to Use Winjob.com</a></li>
								<li><a href="understanding-account-settings" class="<?=$page == 'understanding-account-settings' ? 'actived' : ''?>">Understanding Account Settings</a></li>
								<li><a href="verified-payments" class="<?=$page == 'verified-payments' ? 'actived' : ''?>">Verified Payments</a></li>
							</ul>
							<?}?>
						</li>
						<li class="main-nav"><a href="posting-jobs" class="<?=$type == 'second' ? 'actived' : ''?>">Posting Jobs</a>
							<?if($type == "second"){?>
							<ul class="sub-nav">
								<li><a href="posting-jobs" class="<?=$page == 'posting-jobs' ? 'actived' : ''?>">How to Post a Job</a></li>
								<li><a href="jobs-description" class="<?=$page == 'jobs-description' ? 'actived' : ''?>">Your Jobs Description</a></li>
								<li><a href="featuring-jobs" class="<?=$page == 'featuring-jobs' ? 'actived' : ''?>">Featuring Your Job</a></li>
								<li><a href="job-status" class="<?=$page == 'job-status' ? 'actived' : ''?>">Your Job Status</a></li>
								<li><a href="posting-restrictions" class="<?=$page == 'posting-restrictions' ? 'actived' : ''?>">Posting Restrictions</a></li>
							</ul>
							<?}?>
						</li>
						<li class="main-nav"><a href="finding-freelancers" class="<?=$type == 'third' ? 'actived' : ''?>">Hiring in Winjobs</a>
							<?if($type == "third"){?>
							<ul class="sub-nav">
								<li><a href="finding-freelancers" class="<?=$page == 'finding-freelancers' ? 'actived' : ''?>">Finding a Freelancer</li>
								<li><a href="viewing-quotes" class="<?=$page == 'viewing-quotes' ? 'actived' : ''?>">Viewing Quotes</a></li>
								<li><a href="awarding-job" class="<?=$page == 'awarding-job' ? 'actived' : ''?>">Awarding a Job</a></li>
								<li><a href="deciding-agreement" class="<?=$page == 'deciding-agreement' ? 'actived' : ''?>">Deciding on An Agreement</a></li>
							</ul>
							<?}?>
						</li>
						<li class="main-nav"><a href="communicating-with-freelancers" class="<?=$type == 'fourth' ? 'actived' : ''?>">Managing Your Job</a>
							<?if($type == "fourth"){?>
							<ul class="sub-nav">
								<li><a href="communicating-with-freelancers" class="<?=$page == 'communicating-with-freelancers' ? 'actived' : ''?>">Communicating with freelancers</a></li>
								<li><a href="understanding-workroom" class="<?=$page == 'understanding-workroom' ? 'actived' : ''?>">Understanding the Workroom</a></li>
								<li><a href="adding-files" class="<?=$page == 'adding-files' ? 'actived' : ''?>">Adding Files to the Workroom</a></li>
								<li><a href="managing-team" class="<?=$page == 'managing-team' ? 'actived' : ''?>">Managing Your Team</a></li>
								<li><a href="understanding-time-tracker" class="<?=$page == 'understanding-time-tracker' ? 'actived' : ''?>">Understanding Time Tracker</a></li>
							</ul>
							<?}?>
						</li>
						<li class="main-nav"><a href="understanding-invoce-safepay" class="<?=$type == 'fifth' ? 'actived' : ''?>">Paying a Freelancer</a>
							<?if($type == "fifth"){?>
							<ul class="sub-nav">
								<li><a href="understanding-invoce-safepay" class="<?=$page == 'understanding-invoce-safepay' ? 'actived' : ''?>">Understanding Invoices and SafePay</a></li>
								<li><a href="paying-invoice" class="<?=$page == 'paying-invoice' ? 'actived' : ''?>">Paying an Invoice</a></li>
								<li><a href="adding-funds" class="<?=$page == 'adding-funds' ? 'actived' : ''?>">Adding Funds to SafePay</a></li>
								<li><a href="understanding-autopay" class="<?=$page == 'understanding-autopay' ? 'actived' : ''?>">Understanding Auto-Pay</a></li>
								<li><a href="managing-feedback" class="<?=$page == 'managing-feedback' ? 'actived' : ''?>">Managing Feedback</a></li>
								<li><a href="adding-payment-methods" class="<?=$page == 'adding-payment-methods' ? 'actived' : ''?>">Adding and Verifying Payment Methods</a></li>
								<li><a href="our-service" class="<?=$page == 'our-service' ? 'actived' : ''?>">Our 1099 Service</a></li>
							</ul>
							<?}?>
						</li>
						<li class="main-nav"><a href="requesting-safepay-refund" class="<?=$type == 'sixth' ? 'actived' : ''?>">Disputes with Freelancers</a>
							<?if($type == "sixth"){?>
							<ul class="sub-nav">
								<li><a href="requesting-safepay-refund" class="<?=$page == 'requesting-safepay-refund' ? 'actived' : ''?>">Requesting a SafePay Refund</a></li>
								<li><a href="requesting-invoice-refund" class="<?=$page == 'requesting-invoice-refund' ? 'actived' : ''?>">Requesting an Invoice Refund</a></li>
								<li><a href="entering-negotiation" class="<?=$page == 'entering-negotiation' ? 'actived' : ''?>">Entering Negotiation</a></li>
								<li><a href="escalating-dispute" class="<?=$page == 'escalating-dispute' ? 'actived' : ''?>">Escalating a Dispute to Arbitration</a></li>
							</ul>
							<?}?>
						</li>	
					</ul>
				</div>
			</div>