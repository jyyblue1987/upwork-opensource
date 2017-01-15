<div class="container white-box" style="margin-top: 50px;">

    <div class="col-md-3 nopadding">
           <?php 
                $data = array(
                    'current_active' => 'manageaccount'
                ); 
                $this->load->view("webview/profile/freelancer-profile-left-sidebar",$data) ?>
        </div>
        <div class="col-md-9 nopadding">
    <div class="row title-line">
                    <div class="abc" style="padding-bottom: 10px;">
                        <h3>Manage Account</h3> 
                    </div> 
                </div>  
<h4>To delete or deactivate your account, please contact <span style="color:green;"><a href="#">Customer Support</a></span></h4>

</div>
</div>
<script>
     function faqselect(num){
        if($("#faq"+num).hasClass("faqopen")){
            $("#faq"+num).removeClass("faqopen");
            $("#faqicon"+num).removeClass("fa-angle-down");
            $("#faqicon"+num).addClass("fa-angle-right");
            $("#faqa"+num).slideUp( "fast" );

        }else{
            $("#faq"+num).addClass("faqopen");
            $("#faqicon"+num).removeClass("fa-angle-right");
            $("#faqicon"+num).addClass("fa-angle-down");
            $("#faqa"+num).slideDown( "fast" );
        }

    }
    </script>