<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">

<style type="text/css">
.bold_text {
    color: #000;
}
</style>

<section style="background: #fff;border-radius: 4px;margin: 40px 0px;padding: 30px;border: 1px solid #ccc;padding-top: 25px;" id="speciliser-section" class="speciliser-area">
    <div class="">
        <div class="row">
            <ul class="oBigDataNavBarContainer custom_freelancer_balance_tebel">
                <li class="oDataNavBarTab">
                    <p class="remove-a">
                        <b class="oDataNavTitle">
                          Work In Progress
                        </b>
						<br />
                        <?php
                        $progressAmount = 0.00;
                        foreach($job_progress as $job){

                            $bid = $job->bid_id;
                            $working_hour = $job->total_hour;
                            $this->db->select('*');
                            $this->db->from('job_bids');
                            $this->db->where('id',$bid);
                            $query=$this->db->get();
                            $job_status = $query->row();
                            if($job_status->offer_bid_amount !=""){
                                $amount = $job_status->offer_bid_amount;
                            }else{
                                 $amount = $job_status->bid_amount;
                            }

                                $progressAmount +=(  $working_hour *$amount);

                        }
                       ?>

                        <span class="bold_text "> $<?=$progressAmount;?> </span>
                    </p>
                </li>
                <li style="border-left: 2px solid #ccc;border-right: 2px solid #ccc;" class="oDataNavBarTab">
                    <?php
                        $pendingAmount_hourly = 0.00;
                        foreach($job_pending as $job){
                            $bid = $job->bid_id;
                            $working_hour = $job->total_hour;
                            $this->db->select('*');
                            $this->db->from('job_bids');
                            $this->db->where('id',$bid);
                            $query=$this->db->get();
                            $job_status = $query->row();
                            if($job_status->offer_bid_amount !=""){
                                $amount = $job_status->offer_bid_amount;
                            }else{
                                 $amount = $job_status->bid_amount;
                            }
                            $pendingAmount_hourly +=(  $working_hour *$amount);
                       }


                      /*

                       $bidids= array();
                       foreach($job_pending_fixed as $job_fixed){
                          $progressAmount +=$job_fixed->fixedpay_amount;
                          $bidids[]=$job_fixed->bid_id;
                       }
                        $bidids = implode(",",$bidids);

                        $this->db->select('*');
                        $this->db->from('job_hire_end');
                        $this->db->where_in('bid_id',$bidids);
                        $query=$this->db->get();
                        $job_end= $query->result();
                        foreach($job_end as $jobend){
                            $progressAmount +=$jobend->fixedpay_amount;
                        }

                      */
                      $fixed_pending=$payment_fixed_pending[0]->payment_gross;
                       $pendingAmout=$pendingAmount_hourly+$fixed_pending;


                       ?>
                    <p class="remove-a">

                        <b class="oDataNavTitle"> Pending </b><br>
                        <span class="bold_text">$<?=$pendingAmout;?> </span>
                    </p>
                </li>
                <li class="oDataNavBarTab ">
                    <?php
                        $available = 0.00;
                      //  var_dump($job_available_hourly);die();
                        foreach($job_available_hourly as $job){

                            $bid = $job->bid_id;
                            $working_hour = $job->total_hour;
                            $this->db->select('*');
                            $this->db->from('job_bids');
                            $this->db->where('id',$bid);
                            $query=$this->db->get();
                            $job_status = $query->row();
                            if($job_status->offer_bid_amount !=""){
                                $amount = $job_status->offer_bid_amount;
                            }else{
                                 $amount = $job_status->bid_amount;
                            }

                                $available += ($working_hour *$amount);

                        }

                        $bidids= array();
                       foreach($job_available_fixed as $job_fixed){
                          $available +=$job_fixed->fixedpay_amount;
                          $bidids[]=$job_fixed->bid_id;
                       }
                        $bidids = implode(",",$bidids);

                        $this->db->select('*');
                        $this->db->from('job_hire_end');
                        $this->db->where_in('bid_id',$bidids);
                        $query=$this->db->get();
                        $job_end= $query->result();
                        foreach($job_end as $jobend){
                            $available +=$jobend->fixedpay_amount;
                        }
                         $withdraw = 0;
                        foreach($withdraws as $val){
                            $withdraw += ($val->amount + $val->processingfees);
                        }

                        $available = $available -$withdraw;
                        $payment_fixed_avail_amount=$payment_fixed_avail[0]->payment_gross;
                        $payment_hourly_avail_amount=$payment_hourly_avail[0]->payment_gross;
                        $available=$payment_fixed_avail_amount+$payment_fixed_avail_amount-$withdraw;

                       ?>
                    <a href="http://www.winjob.com/withdraw">
                        <b class="oDataNavTitle">Available </b><br>
                        <span class="bold_text "> <?php echo "$".$available; ?> </span>
                    </a>
                </li>


            </ul>

            <div class="cols">
                <div class="col col2of3">
                    <h1 style="font-size: 22px;font-family: calibri;margin-top: 25px;color: #494949;margin-bottom: 9px;" id="pageTitle" class="oHInline">Transaction History</h1>
                </div>
            </div>
            <!--end transection history -->

           <div id="accountingHistoryFilter" class="oFilterBar custom_filter_bar" data-url="https://www.upwork.com/earnings-history/7128977">
                <form action="" method="get" id="searchpaymentfilter">

                <div style="float: left;" class="jsRange ib inlineBlock">
                    <div class="cal">
						<label class="oLabelInline oLabelDatePicker" for="from1">From</label>

						<?php
						if(isset($_GET['startDate']) && $_GET['startDate']!=""){
						   $startDate = date('F j, Y',strtotime($_GET['startDate']));?>
							<input type="text" id="datepicker" class="form-control datepicker"  name="startDate" value="<?=$startDate;?>"  >
						<?php  }else{ ?>
						 <input style="margin-right: 18px;" type="text" id="datepicker" class="form-control datepicker"  name="startDate" placeholder="<?=date('F j, Y');?>" >
						<?php } ?>
					</div>

					<div class="cal">
                    <label class="oLabelInline oLabelDatePicker" for="to1">To </label>
					<?php
					if(isset($_GET['endDate']) && $_GET['endDate']!=""){
					   $endDate = date('F j, Y',strtotime($_GET['endDate']));?>
						  <input id="datepickerend" class="form-control datepicker"  name="endDate" value="<?=$endDate;?>"  >
					<?php  }else{ ?>
					 <input style="margin-right: 15px;" type="text" id="datepickerend" class="form-control datepicker"  name="endDate" placeholder="<?=date('F j, Y');?>" >
					<?php } ?>
					</div>

                </div>


                <div class="ib" id="jsFilterSelectArea">
                    <select name="trxTypes" id="trxTypes">
                        <option value="ALL" label="All Transactions" selected="selected">All Transactions</option>
                        <option value="CREDITES" label="Credits">Credits</option>
                        <option value="HOURLY" label="Hourly">Hourly</option>
                        <option value="FIXED" label="Fixed-price">Fixed Price</option>
                    </select>
                    <select style="margin-right: 15px;" name="employers" id="employers">
                        <option value="">All Clients</option>
                        <?php if(!empty($list_users)){
                            foreach ($list_users as $user){
                                $user_id =  base64_encode($user->user_id);
                                if(isset($_GET['employers']) && $_GET['employers']!=""){
                                    $employers = $_GET['employers']; ?>
                                           <option value="<?=$user_id?>" <?php if($user_id == $employers){ echo "selected";}?> ><?php echo $user->webuser_fname.' ' . $user->webuser_lname;?> </option>

                                    <?php  } else{ ?>
                                              <option value="<?=$user_id?>"><?php echo $user->webuser_fname.' ' . $user->webuser_lname;?> </option>

                             <?php    }
                           }
                        } ?>
                    </select>
                 <button class="oBtn oBtnSecondary oBtnInline" id="payfilter" type="submit">Go</button>
                </div>
                </form>
            </div>

            <table class="oTable custom_table_head" id="trxTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Client</th>
                        <th style="padding-right: 9px;" class="txtRight nowrap">Amount</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                  $grossstotal = 0;

                  if(!empty($list_payments)){
                    foreach ($list_payments as $payment){ ?>

                    <?php if($payment->type == 1){ ?>

                    <tr class="">
                        <td class="nowrap"><?=date('D, M j, Y',strtotime($payment->payment_create));?></td>
                        <?php  if($payment->job_type  =="fixed"){?>
                            <td>Fixed Price</td>
                             <?php if($payment->hire_end_id  !=0){
                                    $this->db->select('*');
                                    $this->db->from('job_hire_end');
                                     $this->db->where('job_hire_end.id ', $payment->hire_end_id);
                                    $details=$this->db->get();
                                    $list_details= $details->row();
                                   if( $list_details->fixed_pay_status ==0){ $paid_status = "Nothinpaid";}
                                   if( $list_details->fixed_pay_status ==1){ $paid_status = "Full paid";}
                                   if( $list_details->fixed_pay_status ==2){ $paid_status = "Mailstone paid";}
                                ?>

                                     <td><?=$payment->title;?>- <?=$paid_status;?></td>
                           <?php  }else{
                                $this->db->select('*');
                                $this->db->from('job_bids');
                                $this->db->where('job_bids.id ', $payment->bid_id);
                                $details=$this->db->get();
                                $list_details= $details->row();
                                if( $list_details->fixed_pay_status ==0){ $paid_status = "Nothinpaid";}
                                if( $list_details->fixed_pay_status ==1){ $paid_status = "Full paid";}
                                if( $list_details->fixed_pay_status ==2){ $paid_status = "Mailstone paid";}
                            ?>


                                    <td><?php if($payment->des == ''){echo $payment->title.' '.$paid_status;}else{ echo $payment->title.' - '. $payment->des;} ?></td>


                              <?php   } ?>


                       <?php  }else{


			 date_default_timezone_set("UTC");
                                            $today = strtotime('today');
                                            $today = date('y-m-d',$today);
                                            $this_week_start = strtotime('monday this week');
                                             $this_week_start = date('y-m-d',$this_week_start);
                                          //  var_dump($today);var_dump($this_week_start);die();


                                            $this_week_end = strtotime('+1 week sunday');
                                             $this_week_end = date('y-m-d',$this_week_end);

                                            $last_week_start = strtotime('previous monday');
                                             $last_week_start = date('y-m-d',$last_week_start);
                                            $last_week_end = strtotime('previous sunday');
                                             $last_week_end = date('y-m-d',$last_week_end);
									$this->db->select('*');
								   $this->db->from('job_workdairy');
								   $this->db->where('fuser_id',$payment->fuser_id);
								   $this->db->where('jobid',$payment->job_id);
								   $this->db->where('working_date >=', $this_week_start);
								 $this->db->where('working_date <=', $today);
								   $query_done = $this->db->get();
								   $job_done = $query_done->result();
                                                                  // var_dump($payment);die();
									 $total_work_cweek = 0;
									   if(!empty($job_done)){
										   foreach($job_done as $work){
											   $total_work_cweek +=$work->total_hour;
										   }

									   }
								   // var_dump($payment);die();

                           ?>

                              <td>Hourly Price</td>
                              <td>Paid Invoice for Contract ID: <?php echo $payment->contact_id.' - '.$total_work_cweek.'hrs @$ '.$payment->offer_bid_amount.'/hr' ?></td>
                        <?php  }?>
                        <td><?php echo $payment->webuser_fname.' ' . $payment->webuser_lname;?> </td>
                        <td class="txtRight">$<?php if($payment->job_type  =="fixed") echo $payment->payment_gross; else echo $total_work_cweek*$payment->offer_bid_amount; ?></small>
                        </td>
                        <td class="txtRight">
                            <?=$payment->txn_id;?>
                        </td>
                    </tr>
                   <?php
                 $grossstotal +=$payment->payment_gross;
               }
              if($payment->type == 2)
              {
                ?>
                <tr>
               <td class="nowrap"><?=date('D, M j, Y',strtotime($payment->payment_create));?></td> 
                <td>Hourly Price</td>
                <td>Invoice for Contract ID: <?php echo $payment->con_id." - ".$payment->des."/hr"; ?></td>
                <td><?php echo $payment->webuser_fname."  ". $payment->webuser_lname;?> </td>
                <td class="txtRight"><?php echo "$".$payment->amount;?></td>
                <td class="txtRight">
                                <?="";?>
                            </td>
                </tr>
              <?php 
                      $grossstotal +=$payment->amount;         
              }

                 }
                  }

                ?></tbody>
            </table>
            <div class="cols">
                <table style="width: 266px;height: 201px;" class="col1of3 oTableLite oRight txtRight">
                    <caption>
                        <strong style="padding-left: 153px;">Statement Period</strong>
                        <p style="margin-bottom: 10px;float: right;"> <?php
                          if(!empty($list_payments)){
                            $myfirst_elementt = reset($list_payments);?>
                          <?php  $myLastElement = end($list_payments); ?>
                              <?=date('M j, Y',strtotime($myfirst_elementt->payment_create));?>- <?=date('M j, Y',strtotime($myLastElement->payment_create));?>
                        <?php } ?></p>
                    </caption>
                    <tbody style="float: right;position: absolute;right: 205px;">
                        <tr>
                            <td><strong>Beginning Balance</strong>
                            </td>
                            <td><strong>$<?= round($grossstotal);?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Debits</td>
                            <td>$0.00</td>
                        </tr>
                        <tr>
                            <td>Total Credits</td>
                            <td>$0.00</td>
                        </tr>
                        <tr>
                            <td>Total Charges</td>
                            <td>$
                               <?php $charges = (($grossstotal *11)/100);
                              echo  $charges = round($charges,2);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Ending Balance</strong>
                            </td>
                            <td><strong>
                            $<?php echo $endbal= round(($grossstotal-$charges),2);
                            ?>
                            </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        //$("#datepicker").datepicker({
        //    onSelect: function() {
        //      $( "#searchpaymentfilter" ).submit();
        //    }
        //  });
          $("#datepicker").datepicker();
         $("#datepickerend").datepicker();
         $('#payfilter').on('click', function() {
           $( "#searchpaymentfilter" ).submit();
         });
      });



</script>
