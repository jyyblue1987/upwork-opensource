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


<style>
.withdraw .abailone span {
color: #000;
font-family: "calibri";
font-size: 17px;
font-weight: bold;
}
.disabled-input{
    cursor: not-allowed !important;
    background-color: #EEE;
    color: #9E9999;
}
.disabled {
    opacity: .5;
    cursor: not-allowed !important;
}
</style>
<section id="mid_content" class="withdraw">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 white-box-feed" style="margin-top:40px; margin-bottom:40px;border: 1px solid #ccc;width: 970px;padding-top: 0;">
                <p class="result-msg" style="text-align: center;color: green;font-size: 20px;display: none;"></p>
                <form id="withdraw_from">
                    <div class="wrapper-top">
                        <div id="alert-msg" class="header-title" style="color:red;">
                        </div>
                        <div style="font-size: 21px;font-family: calibri;" class="header-title"> Use the page to withdraw funds from your account.For withdrawal options and processing time <a href="#">click here</a>
                        </div>
                        <h5 style="font-size: 17px;font-family: calibri;font-weight: bold;">Withdrawal Method</h5>
                        <select style="font-size: 17px;font-family: calibri;margin-bottom: 30px;" class="custom-select selectoption form-control" id="payment_type" name="payment_type">
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
                    <table style="width: 800px;" class="table table-condensed" id="maintable">
                        <tbody style="border-top: 2px solid transparent;">
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
                                    $payment_fixed_avail_amount=$payment_fixed_avail[0]->payment_gross;
                                    $payment_hourly_avail_amount=$payment_hourly_avail[0]->payment_gross;
                                    $available=$payment_fixed_avail_amount+$payment_fixed_avail_amount-$withdraw;
                                    ?>
                                    <span id="available_bal"><?= $available; ?></span>
                                </td>
                            </tr>
                        </tbody>
                        <tbody style="border-top: 1px solid #ccc;">
                            <tr class="abailbanfle">
                                <td> Withdraw Balance</td>
                                <td>US $</td>
                                <td style=" min-width: 382px;">
                                    <input style="font-size: 17px;font-family: calibri;width: 80px;margin-right: 3px;" type="text" value="" name="bal_withdraw" id="bal_withdraw" placeholder="">
                                    <span style="font-size: 17px;font-family: calibri;" id="erreo"></span>
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
                    <div style="margin-left: -40px;" class="row">
                        <div class="col-xs-12 col-sm-3">
                        </div>
                        <div style="margin-left: 37px;" class="col-xs-12 col-sm-2">
                            <button type="submit" class=" btn-primary big_mass_active transparent-btn big_mass_button" id="Withdrawbutton">Withdraw</button>
                        </div>
                        <div style="margin-left: -60px;" class="col-xs-12 col-sm-2">
                            <button type="submit" class=" btn-primary transparent-btn big_mass_button" id="cancelbutton">Cancel</button>
                        </div>
                        <div class="clear:both"></div>
                    </div>
                </form>
                <div class="clear:both"></div>
                <div class="col-md-12 col-sm-12 nopadding">
                    <div class="last ">
                        <h3 style="font-size: 19px;font-family: calibri;font-weight: bold;">Withdrawal Requested</h3>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 latimptable nopadding">
                    <div class="lasttable">
                        <table class="table table-bordered" id="withdraw-table">
                            <thead>
                                <tr class="bacvolor cus_bottom_menu">
                                    <th>Requested at</th>
                                    <th>Amount</th>
                                    <th>Transaction Type</th>
                                    <th>Status </th>
                                    <th>Processing Data</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($record as $value) : ?>
                                <tr>
                                    <td>
                                        <?= $value['email'] ?>
                                    </td>
                                    <td>
                                        <?="$ ". $value['amount'] ?>
                                    </td>
                                    <td>
                                        <?= $value['payment_type'] ?>
                                    </td>
                                    <td>
                                        <?= ucwords($value['status']) ?>
                                    </td>
                                    <td>
                                    <?= empty($value['operation_date']) ? '' : $value['operation_date']; ?>
                                    </td>
                                </tr>
                               <?php
                               endforeach; ?>
                            </tbody>


                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<div style="clear:both"></div>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>

    $(document).ready(function(){
        $('#bal_withdraw').prop('disabled',true).addClass('disabled-input');
        $('#Withdrawbutton').prop('disabled',true).addClass('disabled');
    });

    $('#payment_type').on("change", function(){

        if(this.value != ""){
            $('#bal_withdraw').prop('disabled',false).removeClass('disabled-input');
            $('#Withdrawbutton').prop('disabled',false).removeClass('disabled');
        }else{
            $('#bal_withdraw').prop('disabled',true).addClass('disabled-input');
            $('#Withdrawbutton').prop('disabled',true).addClass('disabled');
        }

    });

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
            $("#erreo").text("Numeric value only");
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
            $("#erreo").text("Numeric value only");
            return false;
        }
        calculatewithdraw(paymentType, withdraw);
    });


    $("#cancelbutton").on('click', function (e) {
        var $form = $("#withdraw_from");
        $form[0].reset();
        $("#processfees").text("0.00");
        $("#new_available").text("0.00");
        if(!$('#bal_withdraw').hasClass('disabled-input')){

            $('#bal_withdraw').prop('disabled',false).addClass('disabled-input');
            $('#Withdrawbutton').prop('disabled',false).addClass('disabled');
        }

        return false;

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

        $.ajax({
            url:"<?php echo site_url('withdraw/withdrawamount'); ?>",
            type: "post",
            dataType: "html",
            data: ({form: $form.serialize()}),
            success: function (data) {
                var rows = "";
                var json = $.parseJSON(data);
                if (json.success) {
                    $form[0].reset();
                    $('.form-loader').hide();
                    $('.result-msg').html(json.message);
                    $(".result-msg").show().delay(5000).fadeIn();
                    var total = $('#total_work_time').val();

                    if(json.record['operation_date'] == null)
                        json.record['operation_date'] = '';

                    rows = "<tr><td>";
                    rows += json.record['email']+"</td> <td> $ ";
                    rows += json.record['amount']+"</td> <td>";
                    rows += json.record['payment_type']+"</td> <td>";
                    rows += json.record['status']+"</td> <td>";
                    rows += json.record['operation_date']+"</td>";
                    rows += "</tr>";

                    $('#withdraw-table > tbody:last-child').append(rows);
                    if($('#payment_type').val() == ""){
                        $('#bal_withdraw').prop('disabled',false).removeClass('disabled-input');
                        $('#Withdrawbutton').prop('disabled',false).removeClass('disabled');
                    }else{
                        $('#bal_withdraw').prop('disabled',true).addClass('disabled-input');
                        $('#Withdrawbutton').prop('disabled',true).addClass('disabled');
                    }

                }
                else {
                    $('.result-msg').html(json.message);
                    $(".result-msg").show().delay(5000).fadeOut();
                    alert('Opps!! Something went wrong.');
                }
            },
            error: function () {
                console.log('error');
            }
        });


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
