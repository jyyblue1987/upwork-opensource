<tr>
    <td height="60"  colspan="2" style="padding: 0 43px 0 43px; font-size: 12px; color: #00354f;"> 
        <?= $para1; ?>
    </td>
</tr>
<tr>
    <td colspan="2"  align="center" height="75">
              <div style=" line-height: 160%; margin: 5px 5px 5px 5px; text-align: left; padding: 1px 50px 30px 30px; font-family: Helvetica,sans-serif; font-size: 13px; color: #00354f;">
            <div style="border-top: 1px solid #e6e6e6; margin-bottom: 10px;">&nbsp;</div>
                  <table style="min-height: 150px; width: 100%;">
                    <tr>
                        <td>
                            <table style="float:left; font-size: 12px; width: 100%; margin-bottom: 10px;">
                                <tr>
                                    <td colspan="2">Client: <strong><?= $client; ?></strong> </td>
                                </tr>
                                <tr>
                                    <td>
                                        Company:
                                        <strong><?= $company; ?> </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" height="20">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>No: <?= $invoice_no; ?></td>
                                </tr>
                                <tr>
                                    <td><?= $date; ?></td>
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

                </table>
        </div>
    </td>
</tr>

