<tr>
    <td colspan="2"  align="center" height="75">
              <div style=" line-height: 160%; margin: 5px 5px 5px 5px; text-align: left; padding: 1px 50px 30px 30px; font-family: Helvetica,sans-serif; font-size: 13px; color: #00354f;">
                  <table style="min-height: 150px; width: 100%;">
                    <tr>
                        <td>
                            <table style="float:left; font-size: 12px; width: 100%; margin-bottom: 10px;">
                                <tr>
                                    <td>To: </td>
                                    <td style="text-align:right;">From: </td>
                                </tr>
                                <tr>
                                    <td><strong><?= $client; ?></strong></td>
                                    <td style="text-align:right;"><strong><?= $freelancer; ?></strong></td>
                                </tr>
                                <tr>
                                    <td><?= $address ?></td>
                                    <td style="text-align:right;"><?= $fl_address ?></td>
                                </tr>
                                <tr>
                                    <td><?= $address1.' '.$country ?></td>
                                    <td style="text-align:right;"><?= $fl_address1.' '.$fl_country; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" height="20">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>No: <?= $invoice_no; ?></td>
                                </tr>
                                <tr>
                                    <td><?= $date ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Contract: <?= $contract; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="float:left; font-size: 12px; width: 100%; border-collapse: collapse; border: 1px solid #e0e5e9;">
                                <tr>
                                    <th style="background-color: #85C1E9; padding: 5px; text-align: left;">Job Title</th>
                                    <th style="background-color: #85C1E9; padding: 5px; text-align: right;">Amount</th>
                                </tr>
                                <tr>
                                    <td style="padding: 5px; text-align: left;"><?= $job_title; ?></td>
                                    <td style="padding: 5px; text-align: right;"><?= $payment; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="float: right;">
                            <table style="float:left; font-size: 12px; width: 100%; border-collapse: collapse; border: 1px solid #e0e5e9;">
                                <tr>
                                    <th colspan="2" style="background-color: #85C1E9; padding: 5px; text-align: left;">Payment Summary</th>
                                </tr>
                                <tr>
                                    <td style="padding: 5px; text-align: left;">Total</td>
                                    <td style="padding: 5px; text-align: right;"><?= $payment; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px; text-align: left;">Paid</td>
                                    <td style="padding: 5px; text-align: right;"><?= $payment; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="float: right; font-size: 12px;">Primary billing method charged</td>
                    </tr>
                </table>
        </div>
    </td>
</tr>

