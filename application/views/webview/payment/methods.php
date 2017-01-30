 
<?php
//    $this->load->view("webview/includes/header"); 
$paypal = "";
$skrill = "";
$payoneer = "";
if (isset($data) && is_array($data)) {
    foreach ($data as $d) {
        if (strcmp($d['payment_method_name'], "paypal") == 0) {
            $paypal = $d['account_id'];
        } else if (strcmp($d['payment_method_name'], "skrill") == 0) {
            $skrill = $d['account_id'];
        } else if (strcmp($d['payment_method_name'], "payoneer") == 0) {
            $payoneer = $d['account_id'];
        }
    }
}
?>
<div style="clear:both"></div>
<section id="big_header" style="margin-bottom:50px;height: auto;" >
    <div class="row white-box" style="margin-top: 50px;margin-bottom: 50px;">
        <div class="col-md-3 nopadding">
            <?php 
                $data = array(
                    'current_active' => 'methods'
                ); 
                $this->load->view("webview/profile/freelancer-profile-left-sidebar",$data) ?>
        </div>
        <div class="col-md-9 nopadding">
            <div class="row custom_methods_menu_border" style="margin: 0px">
                    <div class="col-md-2"> Methods </div>
                    <div class="col-md-4"> Withdraw Fee </div>
                    <div class="col-md-2">
                        Actions
                    </div>

                    <div class="col-md-4">
                        Active Account
                    </div>
                </div>
            <div class=" payment-section">
                

                <div class="row margin-top-7">
                    <div class="col-md-2">
                        <img class="paypal-img" src="<?php echo base_url() ?>assets/img/paypal_logo.png" width="110" />
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 red">$1 USD Per withdrawal.</div>
                            <div class="col-md-12">Additional activationa and maintenance fees charged by PayPal </div>
                            <div class="col-md-12">
                                <a href="#">Dont have a PayPal Account?</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 action-bubble" style="margin-top: 20px">
                        <?php
                        if (strlen($paypal) > 0) {
                            ?>
                        <button disabled type="button" class="btn btn-primary new-account" accesskey="paypal">
                            Account Active
                        </button>
                        <?php
                        }else{
                        ?>
                        <button type="button" class="btn btn-primary new-account" accesskey="paypal">
                            Add New Paypal
                        </button>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="col-md-4 margin-top-2 paypal-account align-right" accesskey="paypal">
                        <?php
                        if (strlen($paypal) > 0) {
                            ?>
                            <span class="paypal-email"><?php echo $paypal; ?></span> 
                            <button class="form-btn btn-primary btn" onclick="removeAccount(this);" accesskey="paypal">Remove</button>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <hr/>
            <div class=" payment-section">
                <div class="row margin-top">
                    <div class="col-md-2">
                        <img class="skrill-img" src="<?php echo base_url() ?>assets/img/skrill_logo.gif" width="110" />
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 red">$1 USD Per withdrawal.</div>
                            <div class="col-md-12">Additional activationa and maintenance fees charged by Skrill </div>
                            <div class="col-md-12">
                                <a href="#">Dont have a Skrill Account?</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 action-bubble" style="margin-top: 20px">
                        
                        <?php
                        if (strlen($skrill) > 0) {
                            ?>
                        <button disabled type="button" class="btn btn-primary new-account" accesskey="skrill">
                            Account Active
                        </button>
                        <?php
                        }else{
                        ?>
                        <button type="button" class="btn btn-primary new-account" accesskey="skrill">
                            Add New Skrill
                        </button>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="col-md-4 margin-top-2 skrill-account align-right" accesskey="skrill">
                        <?php
                        if (strlen($skrill) > 0) {
                            ?>
                            <span class="skrill-email"><?php echo $skrill; ?></span> 
                            <button class="form-btn btn-primary btn remove-btn" onclick="removeAccount(this);" accesskey="skrill">Remove</button>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <hr/>
            <div class=" payment-section">
                <div class="row margin-top">
                    <div class="col-md-2">
                        <img class="payoneer-img" src="<?php echo base_url() ?>assets/img/payoneer-logo.png" width="110" />
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 red">$2 USD Per withdrawal.</div>
                            <div class="col-md-12">Additional activationa and maintenance fees charged by Payoneer </div>
                            <div class="col-md-12">
                                <a href="#">Dont have a Payoneer Account?</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 action-bubble" style="margin-top: 20px">
                       
                         <?php
                        if (strlen($payoneer) > 0) {
                            ?>
                         <button disabled type="button" class="btn btn-primary new-account" accesskey="payoneer">
                            Account Active
                        </button>
                        <?php
                        }else{
                        ?>
                         <button type="button" class="btn btn-primary new-account" accesskey="payoneer">
                            Add New Payoneer
                        </button>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="col-md-4 margin-top-2 payoneer-account align-right" accesskey="payoneer">
                        <?php
                        if (strlen($payoneer) > 0) {
                            ?>
                            <span class="payoneer-email"><?php echo $payoneer; ?></span> 
                            <button class="form-btn btn-primary btn remove-btn" onclick="removeAccount(this);" accesskey="payoneer">Remove</button>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!--modal-->

<div class="modal fade payment-method" tabindex="-1" role="dialog" aria-labelledby="paymentMethodMOdal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="payment_modal-content">
            <?php $this->load->view("webview/payment/paypal"); ?>
        </div>
    </div>
</div>
<?php
//  $this->load->view("webview/includes/footer"); 
$this->load->view("webview/includes/footer-common-script");
?>


<!-- big_header-->
<script type="text/javascript">
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
    function removeAccount(obj) {
        var key = $(obj).attr('accesskey');
        if (confirm("Are you sure?")) {
            val = $('.' + key + '-email').html().trim();
            obj.value = "processing...";
            $.ajax({
                url: "<?php echo site_url('payment-methods/remove') ?>",
                type: "post",
                dataType: "html",
                data: ({accNo: val, type: key}),
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.status == "success") {
                        alert("Your account successfully removed");
                        $('.' + key + '-account').html("");
                    } else {
                        alert(json.msg);
                        obj.value = "Remove";
                    }
                }, error: function (error, textStatus, error) {
                    alert(error);
                    obj.value = "Remove";
                }
            });
        }
    }

    $('.new-account').click(function () {
        var key = $(this).attr('accesskey');
        var img = $('.' + key + '-img').attr('src');
        $('.payemnt-method-name').html(key);
        $('.payment-method-logo').attr('src', img);
        $('.add-account').attr('accesskey', key);
        $('.payment-method').modal('show');
    });
    $('.add-account').click(function () {
        var email = $('.account-email').html().trim();
        $(this).val("Processing...");
        var key = $(this).attr('accesskey');
        $('.' + key + '-email').html(email);
        $('.' + key + '-account').removeClass('hidden').addClass('show');
        $.ajax({
            url: "<?php echo site_url('payment-methods/add-account') ?>",
            type: "post",
            dataType: "html",
            data: ({accNo: email, type: key}),
            success: function (response) {
                var json = $.parseJSON(response);
                if (json.status == "success") {
                    alert("Your account successfully added");
                    var html = '<span class="' + key + '-email">' + email + '</span>' +
                            '<button class="form-btn btn-primary btn remove-btn" onclick="removeAccount(this)" accesskey="' + key + '">Remove</button>';
                    $('.' + key + '-account').html(html);
                    $('.payment-method').modal('hide');
                    $('.add-account').val("Add Account");
                } else {
                    alert(json.msg);
                    $('.add-account').val("Add Account");
                }
            }, error: function (error, textStatus, error) {
                alert(error);
                $('.add-account').val("Add Account");
            }
        });
    });

</script>