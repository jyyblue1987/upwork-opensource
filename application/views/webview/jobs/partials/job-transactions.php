<div class="row margin-top margin-top-3">
    <div class="col-md-10 col-md-offset-1">
        <div class="row">
            <div class="fix_view">
                <div class="col-md-7 text-centered text-left">Description</div>
                <div class="col-md-2 text-centered text-right">Amount</div>
                <div class="col-md-3 text-centered text-center">Date</div>
            </div>
        </div>
        <div class="u_border"></div>
    </div>
</div>

<div class="row margin-top-2">
    <div class="col-md-10 col-md-offset-1">
        <div class="row">
        <?php foreach ($payments as $payment) { ?>
            <div style="font-size: 14px;" class="col-md-7 text-centered text-left gray-text"><?php
            if ($payment->payment_gross == $job_status->bid_amount) {
                echo "Paid All";
            } elseif ($payment->payment_gross < $job_status->bid_amount || $payment->payment_gross > $job_status->bid_amount) {
                echo $payment->des;
            } elseif ($payment->payment_gross == 0) {
                echo "Paid Nothing";
            }
            ?>
            </div>
            <div style="font-size: 14px;" class="col-md-2 text-centered text-right gray-text">$<?= $payment->payment_gross; ?></div>
            <div style="font-size: 14px;" class="col-md-3 text-centered text-center gray-text"><?php echo date(' M j, Y ', strtotime($payment->payment_create)); ?></div>
        <?php } ?>
        </div>
    </div>
</div>