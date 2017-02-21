 
<div class="columns" >
    <ul class="price">
        <div class="heeed" id="faq1" onclick="faqselect(1);">My Account <i class="fa <?php echo (strcmp($open, "account") == 0) ? 'fa-angle-down' : 'fa-angle-right' ?>" id="faqicon1" aria-hidden="true" style="float:right;"></i></div>
        <div class="faqa" id="faqa1" style="display: <?php echo (strcmp($open, "account") == 0) ? 'block' : 'none' ?>">

            <div class="grey <?php if($current_active == 'profile-settings') echo 'active_setting'; ?>">
                <a class="<?php echo (strcmp($openSub, "profile-basic") == 0) ? 'active-anchor' : '' ?>" href="<?php echo site_url("profile-settings"); ?>">
                    Personal Info
                </a> 
            </div>
            <?php
            if ($this->session->userdata('type') == "2") {
                ?>
                <div class="grey <?php if($current_active == 'manageaccount') echo 'active_setting'; ?>">
                    <a class="<?php echo (strcmp($openSub, "profile-basic") == 0) ? 'active-anchor' : '' ?>" href="<?php echo site_url("profile/manageaccount"); ?>">
                        Manage Account
                    </a> 
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        if ($this->session->userdata('type') == "2") {
            ?>
            <div class="heeed" id="faq2" onclick="faqselect(2);">My Profile  <i class="fa <?php echo (strcmp($open, "profile") == 0) ? 'fa-angle-down' : 'fa-angle-right' ?>" id="faqicon2" aria-hidden="true" style="float:right;"></i></div>
            <div class="faqa" id="faqa2" style="display: <?php echo (strcmp($open, "profile") == 0) ? 'block' : 'none' ?>">
                <div class="grey <?php if($current_active == 'basic') echo 'active_setting'; ?>">
                    <a class="<?php echo (strcmp($openSub, "profile-basic") == 0) ? 'active-anchor' : '' ?>" href="<?php echo site_url("/profile/basic"); ?>">Basic Profile</a>
                </div>
                <div class="grey <?php if($current_active == 'basic_bio') echo 'active_setting'; ?>">
                    <a class="<?php echo (strcmp($openSub, "profile-bio") == 0) ? 'active-anchor' : '' ?>" href="<?php echo site_url("/profile/basic_bio"); ?>">Professional Bio</a>
                </div>
                <div class="grey <?php if($current_active == 'choose') echo 'active_setting'; ?>">
                    <a href="<?php echo site_url("categories/choose"); ?>">Manage Category</a>
                </div>
                <div class="grey ">
                    <a href="<?php echo site_url("/profile/{$username}"); ?>">View My Profile</a>
					
                </div>
            </div>
<?php } ?>
        <div class="heeed" id="faq3" onclick="faqselect(3);">Financial Account  <i class="fa <?php echo (strcmp($open, "finance") == 0) ? 'fa-angle-down' : 'fa-angle-right' ?>" id="faqicon3" aria-hidden="true" style="float:right;"></i></div>
        <div class="faqa" id="faqa3" style="display: <?php echo (strcmp($open, "finance") == 0) ? 'block' : 'none' ?>">
<?php
if (strcmp($this->session->userdata('type'), "2") == 0) {
    ?>
                <div class="grey <?php if($current_active == 'tax-information') echo 'active_setting'; ?>">
                    <a href="<?php echo site_url('payment/tax-information') ?>">
                        Tax Information
                    </a>
                </div>
                <div class="grey <?php if($current_active == 'methods') echo 'active_setting'; ?>">
                    <a href="<?php echo site_url('payment/methods') ?>">Payment Methods</a>
                </div> 
<?php } else { ?>
                <div class="grey <?php if($current_active == 'billing') echo 'active_setting'; ?>"><a href="<?php echo site_url("pay/billing"); ?>">Billing Methods</a></div> 
            <?php } ?>
        </div>
        <div class="heeed" id="faq4" onclick="faqselect(4);">Security Settings  <i class="fa <?php echo (strcmp($open, "security") == 0) ? 'fa-angle-down' : 'fa-angle-right' ?>" id="faqicon4" aria-hidden="true" style="float:right;"></i></div>
        <div class="faqa" id="faqa4" style="display: <?php echo (strcmp($open, "security") == 0) ? 'block' : 'none' ?>">
            <div class="grey <?php if($current_active == 'changepassword') echo 'active_setting'; ?>"><a href="<?php echo site_url("changepassword"); ?>">Change Password</a></div>
            <div class="grey <?php if($current_active == 'changeemail') echo 'active_setting'; ?>"><a href="<?php echo site_url("changeemail"); ?>">Change Email</a></div>        
        </div>
    </ul>
</div>