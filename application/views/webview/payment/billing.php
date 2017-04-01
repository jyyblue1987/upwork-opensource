<div style="clear:both"></div><!--end--header bottm-->
<section id="mid_content">
    <div class="container white-box" style="margin-top: 40px;margin-bottom: 40px;padding:10px; border:1px solid #ccc;width: 970px !important;min-height: 403px;">

        <div class="row  ">  
            <div class="col-xs-12 col-sm-3 col-md-3 ">
               <?php 
                $data = array(
                    'current_active' => 'billing'
                ); 
                $this->load->view("webview/profile/freelancer-profile-left-sidebar",$data) ?>
                <?php //$this->load->view("webview/includes/error_message"); ?>
            </div>
            <div style="padding-left: 30px;" class="col-xs-12 col-sm-9 col-md-9 align-left ">
                 
                <div style="margin-bottom: 32px;" class="row title-line">
                    <div class="abc" style="padding-bottom: 10px;">
                        <h3 style="margin-bottom: -1px;">Billing &amp; Payment Processing</h3>
                    </div> 
                    <div class="abd" style="padding:7px;padding-right: 0;"> 
                         <a style="border: 1px;" class="btn btn-default cus_add_billing_method" href="<?php echo site_url("pay/add-card"); ?>">Add Billing Method </a> 
                    </div>
                </div> 
                <div class="row">
                    <div class="oMain">

                        <div class="jsPaymentListWidget">
                            
                            <?php
                            if (isset($_GET['addCard']) && $_GET['addCard'] == "success") {
                                echo '<div style="margin-top:10px;" class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Credit Card successfully added.</div>';
                            } elseif (isset($_GET['addPP']) && $_GET['addPP'] == "success") {
                                echo '<div style="margin-top:10px;" class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>PayPal successfully Connected.</div>';
                            } elseif (isset($_GET['delete']) && $_GET['delete'] == "true") {
                                echo '<div style="margin-top:10px;" class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Deleted successfully.</div>';
                            } elseif (isset($_GET['delete']) && $_GET['delete'] == "false") {
                                echo '<div style="margin-top:10px;" class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Cannot delete primary payment method.</div>';
                            } elseif (isset($_GET['primary']) && $_GET['primary'] == "changed") {
                                echo '<div style="margin-top:-10px;margin-right: 19px;padding: 9px 10px;" class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Primary payment method has been updated.</div>';
                            }
                            ?>
                            <table style="width: 97.5%;" class="oTable">
                                <thead>
                                    <tr>
                                        <th style="font-size: 18px;font-family: calibri;padding-bottom: 10px;" class="col1of5">Billing Method</th>
                                        <th style="font-size: 18px;font-family: calibri;padding-bottom: 10px;"> AutoPay Status</th>
                                        <th style="font-size: 18px;font-family: calibri;padding-bottom: 10px;" class="txtCenter">Actions</th>
                                    </tr></thead>
                                <tbody>

                                    <?php
//print_r($paypals);
//echo "\n\n";
                                    foreach ((array) $cards as $card) {
                                        ?>
                                        <tr>
                                            
                                            <td style="font-size: 17px;font-family: calibri;" class="col1of5"><strong style="font-size: 17px;font-family: calibri;font-weight: bold;">MasterCard</strong> ending in <?php echo $card->cardNumber; ?>
                                            </td>
                                            <td style="font-size: 17px;font-family: calibri;" class="nowrap">
                                                <?php
                                                if ($card->isPrimary == '1') {
                                                    echo "Primary";
                                                } else {
                                                    ?>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-minus"></i> <i class="fa fa-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <form action="makePrimary" method="post" style="margin-bottom:0px;">
                                                                <input type="hidden" value="yes" name="makePrimary" />
                                                                <input type="hidden" value="card" name="method" />
                                                                <input type="hidden" value="<?php echo $card->attachedTo; ?>" name="id" />
                                                                <button class="dropdown-item btn btn-link" href="#">Make Primary</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    //echo '<i class="fa fa-minus"></i> <i class="fa fa-chevron-down"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td class="txtCenter">
                                                <form style="margin:0px;display:inline;" method="post" action="methods_card">
                                                    <input type="hidden" name="scid" value="<?php echo $card->stripeCustomerID; ?>">
                                                    <input type="hidden" name="fname" value="<?php echo $card->fname ?>" />
                                                    <input type="hidden" name="lname" value="<?php echo $card->lname ?>" />
                                                    <input type="hidden" name="cardNumber" value="<?php echo $card->cardNumber ?>" />
                                                    <input type="hidden" name="address" value="<?php echo $card->address ?>" />
                                                    <input type="hidden" name="address2" value="<?php echo $card->address2 ?>" />
                                                    <input type="hidden" name="zip" value="<?php echo $card->zip ?>" />
                                                    <input type="hidden" name="city" value="<?php echo $card->city ?>" />
                                                    <input type="hidden" name="country" value="<?php echo $card->country ?>" />
                                                    <input type="hidden" name="edit" value="yes">
                                                    <button style="font-size: 17px;font-family: calibri;" class="btn btn-link" type="submit">Edit</button>
                                                </form>
                                                |
                                                <form style="margin:0px;display:inline;margin-left: 14px;margin-right: -28px;" method="post" action="removePaymentMethod">
                                                    <input type="hidden" name="remove" value="yes">
                                                    <input type="hidden" name="type" value="card">
                                                    <input type="hidden" name="id" value="<?php echo $card->attachedTo; ?>" />
                                                    <button style="font-size: 17px;font-family: calibri;" class="btn btn-link" type="submit">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    foreach ((array) $paypals as $paypal) {
                                        ?>
                                        <tr>
                                           
                                            <td style="font-size: 17px;font-family: calibri;"><strong style="font-size: 17px;font-family: calibri;font-weight: bold;">Paypal</strong> - <?php echo $paypal->pp_email; ?></td>
                                            <td class="nowrap">
                                                <?php
                                                if ($paypal->isPrimary == '1') {
                                                    echo "Primary";
                                                } else {
                                                    ?>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-minus"></i> <i class="fa fa-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <form action="makePrimary" method="post" style="margin-bottom:0px;">
                                                                <input type="hidden" value="yes" name="makePrimary" />
                                                                <input type="hidden" value="paypal" name="method" />
                                                                <input type="hidden" value="<?php echo $paypal->attachedTo; ?>" name="id" />
                                                                <button class="dropdown-item btn btn-link" href="#">Make Primary</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    //echo '<i class="fa fa-minus"></i> <i class="fa fa-chevron-down"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td class="txtCenter">
                                                <form style="margin:0px;display:inline;" method="post" action="removePaymentMethod">
                                                    <input type="hidden" name="remove" value="yes">
                                                    <input type="hidden" name="type" value="paypal">
                                                    <input type="hidden" name="id" value="<?php echo $paypal->attachedTo; ?>" />
                                                    <button style="font-size: 17px;font-family: calibri;" class="btn btn-link" type="submit">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <!--<tbody>
                                <tr>
                                    <td class="col1of5"><div class="oLogoCreditCard"></div></td>
                                    <td><strong>Paypal</strong>- paypal@gmail.com
                                </td>
                                        <td class="nowrap"> <i class="fa fa-minus" aria-hidden="true"></i> <i class="fa fa-angle-down" aria-hidden="true"></i>
                                
                                </td>
                                    <td class="txtCenter"> <a class="jsEditPayment" href="#">Edit | Remove</a>                                              </td>
                                </tr>
                                </tbody>-->
                            </table>
                            <div class="jsChangePrimaryText oHidden"></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>
<div style="clear:both"></div>
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