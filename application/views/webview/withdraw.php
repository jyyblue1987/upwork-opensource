<?php
 
$paypal = "";
$skrill = "";
$payoneer = "";
if (isset($paymentData) && is_array($paymentData)) {
    foreach ($paymentData as $d) {
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
<section id="mid_content" class="withdraw">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 white-box-feed" style="margin-top:50px; margin-bottom:50px;">
                <p class="result-msg" style="text-align: center;color: green;font-size: 20px;display: none;"></p>
                <form id="withdraw_from">
                    <div class="wrapper-top">
                        <div id="alert-msg" class="header-title" style="color:red;"> 
                        </div>
                        <div class="header-title"> Use the page to withdraw funds from your account.For withdrawal options and processing time <a href="#">click here</a>
                        </div>
                        <h5>Withdrawal Method</h5>
                        <select class="custom-select selectoption form-control" id="payment_type" name="payment_type">
                            <option value="">- Select -</option>
                            <?php
                            if (strlen($paypal) > 0) {
                                ?>
                                <option value="1">Paypal</option>
                                <?php
                            }
                            ?>
                            <?php
                            if (strlen($skrill) > 0) {
                                ?>
                                <option value="2">Skrill</option>
                                <?php
                            }
                            ?>    
                             <?php
                            if (strlen($payoneer) > 0) {
                                ?>
                                <option value="3">Payoneer</option>
                                <?php
                            }
                            ?> 
                           
                        </select>
                    </div>
                    <table class="table table-condensed" id="maintable">
                        <tbody>
                            <tr class="abailone">
                                <td>Abailable Balance</td>
                                <td>US $</td>
                                <td>
                                    <?php
                                    $available = 0.00;
                                    foreach ($job_available_hourly as $job) {

                                        $bid = $job->bid_id;
                                        $working_hour = $job->total_hour;
                                        $this->db->select('*');
                                        $this->db->from('job_bids');
                                        $this->db->where('id', $bid);
                                        $query = $this->db->get();
                                        $job_status = $query->row();
                                        if ($job_status->offer_bid_amount != "") {
                                            $amount = $job_status->offer_bid_amount;
                                        } else {
                                            $amount = $job_status->bid_amount;
                                        }

                                        $available += ( $working_hour * $amount);
                                    }

                                    $bidids = array();
                                    foreach ($job_available_fixed as $job_fixed) {
                                        $available += $job_fixed->fixedpay_amount;
                                        $bidids[] = $job_fixed->bid_id;
                                    }
                                    $bidids = implode(",", $bidids);

                                    $this->db->select('*');
                                    $this->db->from('job_hire_end');
                                    $this->db->where_in('bid_id', $bidids);
                                    $query = $this->db->get();
                                    $job_end = $query->result();
                                    foreach ($job_end as $jobend) {
                                        $available += $jobend->fixedpay_amount;
                                    }

                                    $withdraw = 0;
                                    foreach ($withdraws as $val) {
                                        $withdraw += ($val->amount + $val->processingfees);
                                    }
                                    $available = $available - $withdraw;
                                    ?>
                                    <span id="available_bal"><?= $available; ?></span>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="abailbanfle">
                                <td> Withdra Balance</td>
                                <td>US $</td>
                                <td style=" min-width: 382px;">
                                    <input type="text" value="" name="bal_withdraw" id="bal_withdraw" placeholder="">
                                    <span id="erreo"></span>
                                </td>
                            </tr>
                            <tr class="abailone">
                                <td>Processing Fee</td>
                                <td> US $</td>
                                <td>
                                    <span id="processfees">0.00</span>
                                    <input type="hidden" value="" name="bal_processfees" id="bal_processfees" placeholder="">
                                </td>
                            </tr>
                            <tr class="abailone">
                                <td>New Balance</td>
                                <td> US $ </td>
                                <td> <span id="new_available">0.00</span></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-xs-12 col-sm-3">
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <button type="submit" class="btn btn-primary" id="Withdrawbutton">Withdraw</button>
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <button type="submit" class="btn btn-default" id="cencelbutton">Cancel</button>
                        </div>
                        <div class="clear:both"></div>
                    </div>
                </form>
                <div class="clear:both"></div>
                <div class="col-md-12 col-sm-12 nopadding">
                    <div class="last ">
                        <h3>Withdrawal Requested</h3>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 latimptable nopadding">
                    <div class="lasttable">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="bacvolor">
                                    <td>Requested at</td>
                                    <td>Amount</td>
                                    <td>Transaction Type</td>
                                    <td>Status </td>
                                    <td>Processing Data</td>
                                </tr>
                            </tbody>


                        </table>

                        <article class="text-center">
                            You have no Pending withdrawal request
                        </article>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<div style="clear:both"></div>
<style>
    .withdraw .abailone span {
        color: #858484;
        font-family: "Open Sans";
        font-size: 14px;
        font-weight: 700;
    }
</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
    $("#payment_type").on('change', function (e) {
        e.preventDefault();
        var paymentType = $("#payment_type").val();
        var withdraw = $("#bal_withdraw").val();
        calculatewithdraw(paymentType, withdraw);
    });
    $("#bal_withdraw").keyup(function (e) { 
        e.preventDefault();
        
        var paymentType = $("#payment_type").val();
        var withdraw = $("#bal_withdraw").val();
        if (!$.isNumeric(withdraw)) {
            $("#erreo").text("Please enter Numeric value");
            ;
            return false;
        }
        calculatewithdraw(paymentType, withdraw);
    });
    $("#bal_withdraw").on('click', function (e) {
        e.preventDefault();
        var paymentType = $("#payment_type").val();
        var withdraw = $("#bal_withdraw").val();
        if (!$.isNumeric(withdraw)) {
            $("#erreo").text("Please enter Numeric value");
            return false;
        }
        calculatewithdraw(paymentType, withdraw);
    });
    $("#Withdrawbutton").on('click', function (e) {
        e.preventDefault();
        var tax_status = "<?php echo $tax_status;?>";
        var tax_url = "<?php echo site_url('payment/tax-information') ?>";
        var alert_msg = "!Please submit your tax information to complete withdrawal   or  Before withdrawing funds, all freelancers must provide their  tax information.<a href='"+ tax_url +"'> Add Tax Info</a>";
       
        if (tax_status == '0') { 
            $("#alert-msg").html(alert_msg);
            return false;
        }
        var paymentType = $("#payment_type").val();
        var withdraw = $("#bal_withdraw").val();
        if (!$.isNumeric(withdraw)) {
            $("#erreo").text("Please enter Numeric value");
            return false;
        }
        calculatewithdraw(paymentType, withdraw);
        var $form = $("#withdraw_from");

        $.post("<?php echo site_url('withdraw/withdrawamount'); ?>", {form: $form.serialize()}, function (data) {
            if (data.success) {
                $form[0].reset();
                $('.form-loader').hide();
                $('.result-msg').html(data.message);
                $(".result-msg").show().delay(5000).fadeOut();
                var total = $('#total_work_time').val();
            } else {
                $('.result-msg').html(data.message);
                $(".result-msg").show().delay(5000).fadeOut();
                alert('Opps!! Something went wrong.');
            }
        }, 'json');





    });

    function  calculatewithdraw(paymentType, withdraw) {
        var availablebal = parseFloat("<?= $available; ?>");

        if (paymentType == 1) {
            var result = parseFloat(availablebal - (parseFloat(withdraw) + 1));
            $("#processfees").text("1.00");
            $("#new_available").text(result);
            $("#bal_processfees").val("1");

        }
        if (paymentType == 2) {
            var result = parseFloat(availablebal - (parseFloat(withdraw) + 1));
            $("#processfees").text("1.00");
            $("#new_available").text(result);
            $("#bal_processfees").val("1");
        }
        if (paymentType == 3) {
            var result = parseFloat(availablebal - (parseFloat(withdraw) + 2));
            $("#processfees").text("2.00");
            $("#new_available").text(result);
            $("#bal_processfees").val("2");
        }

    }

</script>