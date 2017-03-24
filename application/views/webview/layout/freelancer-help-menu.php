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
			<p class="full-nav"><a href="../employer-help">Employer Help</a></p>
			<p class="full-nav actived"><a href="../freelancer-help">Freelancer Help</a></p>
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
								<li><a href="editing-account" class="<?=$page == 'editing-account' ? 'actived' : ''?>">Editing Your Account</a></li>
							</ul>
							<?}?>
						</li>
						<li class="main-nav"><a href="understanding-profile" class="<?=$type == 'second' ? 'actived' : ''?>">Managing Your Profile</a>
							<?if($type == "second"){?>
							<ul class="sub-nav">
								<li><a href="understanding-profile" class="<?=$page == 'understanding-profile' ? 'actived' : ''?>">Understanding Your Profile</a></li>
								<li><a href="adding-portfolio-services" class="<?=$page == 'adding-portfolio-services' ? 'actived' : ''?>">Adding Portfolios and Services</a></li>
								<li><a href="taking-skill-tests" class="<?=$page == 'taking-skill-tests' ? 'actived' : ''?>">Taking Skill Tests</a></li>
								<li><a href="purchasing-membership" class="<?=$page == 'purchasing-membership' ? 'actived' : ''?>">Purchasing a Membership</a></li>
							</ul>
							<?}?>
						</li>
						<li class="main-nav"><a href="searching-jobs" class="<?=$type == 'third' ? 'actived' : ''?>">Finding Jobs</a>
							<?if($type == "third"){?>
							<ul class="sub-nav">
								<li><a href="searching-jobs" class="<?=$page == 'searching-jobs' ? 'actived' : ''?>">Searching for Jobs</li>
								<li><a href="receiving-invitations" class="<?=$page == 'receiving-invitations' ? 'actived' : ''?>">Receiving Invitations</a></li>
								<li><a href="receiving-job-matches" class="<?=$page == 'receiving-job-matches' ? 'actived' : ''?>">Receiving Job Matches List</a></li>
								<li><a href="adding-jobs-to-wishlist" class="<?=$page == 'adding-jobs-to-wishlist' ? 'actived' : ''?>">Adding Jobs to Your Watch List</a></li>
								<li><a href="submitting-quotes" class="<?=$page == 'submitting-quotes' ? 'actived' : ''?>">Submitting Quotes</a></li>
								<li><a href="understanding-quotes-terms" class="<?=$page == 'understanding-quotes-terms' ? 'actived' : ''?>">Understanding Quote Terms</a></li>
							</ul>
							<?}?>
						</li>
						<li class="main-nav"><a href="communicating-with-employers" class="<?=$type == 'fourth' ? 'actived' : ''?>">Using the Workroom</a>
							<?if($type == "fourth"){?>
							<ul class="sub-nav">
								<li><a href="communicating-with-employers" class="<?=$page == 'communicating-with-employers' ? 'actived' : ''?>">Communicating with Employers</a></li>
								<li><a href="sending-agreement" class="<?=$page == 'sending-agreement' ? 'actived' : ''?>">Sending an Agreement</a></li>
								<li><a href="adding-files-to-workroom" class="<?=$page == 'adding-files-to-workroom' ? 'actived' : ''?>">Adding Files to the Workroom</a></li>
								<li><a href="using-timetracker" class="<?=$page == 'using-timetracker' ? 'actived' : ''?>">Using Time Tracker</a></li>
								<li><a href="managing-team" class="<?=$page == 'managing-team' ? 'actived' : ''?>">Managing Your Team</a></li>
							</ul>
							<?}?>
						</li>
						<li class="main-nav"><a href="understanding-payment" class="<?=$type == 'fifth' ? 'actived' : ''?>">Getting Paid</a>
							<?if($type == "fifth"){?>
							<ul class="sub-nav">
								<li><a href="understanding-payment" class="<?=$page == 'understanding-payment' ? 'actived' : ''?>">Understanding Payment on Winjobs.com</a></li>
								<li><a href="sending-invoices" class="<?=$page == 'sending-invoices' ? 'actived' : ''?>">Sending Invoices</a></li>
								<li><a href="payment-schedule" class="<?=$page == 'payment-schedule' ? 'actived' : ''?>">Our Payment Schedules</a></li>
								<li><a href="verified-payment-methods" class="<?=$page == 'verified-payment-methods' ? 'actived' : ''?>">Verified Payment Methods</a></li>
								<li><a href="adding-transfer-method" class="<?=$page == 'adding-transfer-method' ? 'actived' : ''?>">Adding a Transfer Method</a></li>
								<li><a href="managing-feedback" class="<?=$page == 'managing-feedback' ? 'actived' : ''?>">Verified Managing Feedback</a></li>
							</ul>
							<?}?>
						</li>	
						<li class="main-nav"><a href="issuing-safepay-refund" class="<?=$type == 'sixth' ? 'actived' : ''?>">Disputes with Employers</a>
							<?if($type == "sixth"){?>
							<ul class="sub-nav">
								<li><a href="issuing-safepay-refund" class="<?=$page == 'issuing-safepay-refund' ? 'actived' : ''?>">Issuing a SafePay Refund</a></li>
								<li><a href="issuing-invoice-refund" class="<?=$page == 'issuing-invoice-refund' ? 'actived' : ''?>">Issuing an Invoice Refund</a></li>
								<li><a href="entering-negotiation" class="<?=$page == 'entering-negotiation' ? 'actived' : ''?>">Entering Negotiation</a></li>
								<li><a href="escalating-dispute-arbitration" class="<?=$page == 'escalating-dispute-arbitration' ? 'actived' : ''?>">Escalating a Dispute to Arbitration</a></li>
							</ul>
							<?}?>
						</li>
					</ul>
				</div>
			</div>