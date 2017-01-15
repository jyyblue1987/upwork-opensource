<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">


<section id="speciliser-section" class="speciliser-area">
    <div class="container">
        <div class="row">
            <ul class="oBigDataNavBarContainer">
                <li class="oDataNavBarTab current">
                    <a href="#">
                        <span class="oDataNavTitle">
                          Work In Progress
                        </span>
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
                        
                        <span class="oDataNavData "> $<?=$progressAmount;?> </span>
                    </a>
                </li>
                <li class="oDataNavBarTab ">
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
                            $progressAmount +=(  $working_hour *$amount);
                       }
                       
                       
                      
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
                        
                        
                        
                       ?>
                    <a href="#">
                        
                        <span class="oDataNavTitle"> Pending </span><br>
                        <span class="oDataNavDat">$<?=$progressAmount;?> </span>
                    </a>
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
                       ?>
                    <a href="#">
                        <span class="oDataNavTitle">Available </span><br>
                        <span class="oDataNavData "> <?php echo "$".$available; ?> </span>
                    </a>
                </li>


            </ul>

            <div class="cols">
                <div class="col col2of3">
                    <h1 id="pageTitle" class="oHInline">Transaction History</h1>
                </div>
            </div>
            <!--end transection history -->

           <div id="accountingHistoryFilter" class="oFilterBar" data-url="https://www.upwork.com/earnings-history/7128977">
                <form action="" method="get" id="searchpaymentfilter">
                    
                <div class="oRight nowrap">
                    <a id="zipLink" class="oDownloadPDFLink" href="">Get PDF</a>
                    <a id="csvLink" class="oDownloadCSVLink" href="">Get CSV</a>
                </div>
                
                <div class="jsRange ib inlineBlock">
                    <label class="oLabelInline oLabelDatePicker" for="from1">
                        From
                         <?php
                        if(isset($_GET['startDate']) && $_GET['startDate']!=""){
                           $startDate = date('F j, Y',strtotime($_GET['startDate']));?>
                            <input type="text" id="datepicker" class="form-control datepicker"  name="startDate" value="<?=$startDate;?>"  > 
                      <?php  }else{ ?>
                         <input type="text" id="datepicker" class="form-control datepicker"  name="startDate" placeholder="<?=date('F j, Y');?>" >
                         <?php } ?> 
                    </label>
                    <label class="oLabelInline oLabelDatePicker" for="to1">To
                   <?php
                        if(isset($_GET['endDate']) && $_GET['endDate']!=""){
                           $endDate = date('F j, Y',strtotime($_GET['endDate']));?>
                              <input id="datepickerend" class="form-control datepicker"  name="endDate" value="<?=$endDate;?>"  > 
                      <?php  }else{ ?>
                         <input type="text" id="datepickerend" class="form-control datepicker"  name="endDate" placeholder="<?=date('F j, Y');?>" >
                         <?php } ?> 
                    </label>
                </div>
                <div class="ib" id="jsFilterSelectArea">

                    <select name="trxTypes" id="trxTypes">
                        <option value="ALL" label="All Transactions" selected="selected">All Transactions</option>
                        <option value="DEBIT" label="Debits">Debits</option>
                        <option value="CRED" label="Credits">Credits</option>
                        <option value="HOURLY" label="Hourly">Hourly</option>
                        <option value="FIXED" label="Fixed-price">Fixed Price</option>
                        <option value="WITHDRAW" label="Withdrawals">Withdrawals</option>
                    </select>
                    <select name="employers" id="employers">
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

            <table class="oTable" id="trxTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Client</th>
                        <th class="txtRight nowrap">Amount</th>
                        <th class="txtRight">Ref ID</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                  $grossstotal = 0;
                  if(!empty($list_payments)){
                    foreach ($list_payments as $payment){ ?>
                      
                    
                    <tr class="">
                        <td class="nowrap"><?=date('l, F j, Y',strtotime($payment->payment_create));?></td>
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
                              <td>Invoice for Contract ID: <?php echo $payment->contact_id.' - '.$total_work_cweek.'hrs @$ '.$payment->offer_bid_amount.'/hr' ?></td>
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
                  }
                ?></tbody>
            </table>
            <div class="cols">
                <table class="col1of3 oTableLite oRight txtRight">
                    <caption>
                        <strong>Statement Period</strong>
                        <p> <?php
                          if(!empty($list_payments)){
                            $myfirst_elementt = reset($list_payments);?>
                          <?php  $myLastElement = end($list_payments); ?> 
                              <?=date('F j, Y',strtotime($myfirst_elementt->payment_create));?>- <?=date('F j, Y',strtotime($myLastElement->payment_create));?>
                              
                        
                        <?php } ?></p>
                    </caption>
                    <tbody>
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