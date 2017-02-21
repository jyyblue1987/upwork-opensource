<div class="container white-box" style="margin-top: 40px;margin-bottom: 40px;border: 1px solid #ccc;width: 970px !important;">

    <div class="col-md-3 nopadding">
           <?php 
                $data = array(
                    'current_active' => 'manageaccount'
                ); 
                $this->load->view("webview/profile/freelancer-profile-left-sidebar",$data) ?>
        </div>
        <div style="padding-left: 27px !important;" class="col-md-9 nopadding">
    <div style="margin-bottom: 20px;" class="row title-line">
                    <div class="abc" style="padding-bottom: 10px;">
                        <h3>Manage Account</h3> 
                    </div> 
                </div>  
<h4 style="margin-left: -13px;font-size: 17px;font-family: calibri;">To delete or deactivate your account, please contact <span style="color:green;"><a href="#">Customer Support</a></span></h4>

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