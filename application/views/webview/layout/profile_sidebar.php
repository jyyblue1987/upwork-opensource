<ul style="margin-top: -5px;" class="price">
    <div class="heeed faqopen" id="faq1" onclick="faqselect(1);">My Account <i class="fa fa-angle-<?php echo ($open=='account')?'down':'right'?>" id="faqicon1" aria-hidden="true" style="float:right;"></i></div>
    <div class="faqa" id="faqa1" style="display: <?php echo ($open=='account')?'block':'none'?>">
        <div class="grey"><a href="<?php echo site_url("profilesetting"); ?>">Personal Info</a></div>
        <div class="grey">Contact Address</div>	
        <div class="grey">Manage Account</div>
    </div>

    <div class="heeed" id="faq2" onclick="faqselect(2);">My Profile  <i class="fa fa-angle-<?php echo ($open=='account')?'down':'right'?>" id="faqicon2" aria-hidden="true" style="float:right;"></i></div>
    <div class="faqa" id="faqa2" style="display: <?php echo ($open=='account')?'block':'none'?>;">
        <div class="grey"><a href="<?php echo site_url("/profile/basic"); ?>">Basic Profile</a></div>
        <div class="grey"><a href="<?php echo site_url("/profile/basic_bio"); ?>">Professional Bio</a></div>>
        <div class="grey"><a href="<?php echo site_url("categories/choose"); ?>">Manage Category</a></div>
        <div class="grey">View My Profile</div>
    </div>


    <div class="heeed" id="faq3" onclick="faqselect(3);">Financial Account  <i class="fa fa-angle-<?php echo ($open=='account')?'down':'right'?>" id="faqicon3" aria-hidden="true" style="float:right;"></i></div>
    <div class="faqa" id="faqa3" style="display: <?php echo ($open=='account')?'block':'none'?>;">
         <div class="grey">TAX Information</div>
         <div class="grey"><a href="<?php echo site_url("payment-methods"); ?>">Payment Methods</a></div>
	 <div class="grey">Manage Account</div>
    </div>

    <div class="heeed" id="faq4" onclick="faqselect(4);">Security Settings  <i class="fa fa-angle-<?php echo ($open=='security')?'down':'right'?>" id="faqicon4" aria-hidden="true" style="float:right;"></i></div>
    <div class="faqa" id="faqa4" style="display: <?php echo ($open=='security')?'block':'none'?>;">
        <div class="grey"><a href="<?php echo site_url("changepassword"); ?>">Change Password</a></div>
        <div class="grey"><a href="<?php echo site_url("changeemail"); ?>">Change Email</a></div>
        <div class="grey">Manage Account</div>
    </div>
</ul>

<script>
    function faqselect(num) {
        if ($("#faq" + num).hasClass("faqopen")) {

            $("#faq" + num).removeClass("faqopen");
            $("#faqicon" + num).removeClass("fa-angle-down");
            $("#faqicon" + num).addClass("fa-angle-right");
            $("#faqa" + num).slideUp("fast");

        } else {
            $("#faq" + num).addClass("faqopen");
            $("#faqicon" + num).removeClass("fa-angle-right");
            $("#faqicon" + num).addClass("fa-angle-down");
            $("#faqa" + num).slideDown("fast");
        }

    }
</script>