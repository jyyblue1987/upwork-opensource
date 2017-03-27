<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">


<section style="background: #fff;border-radius: 4px;margin: 40px 0px;padding: 30px;border: 1px solid #ccc;padding-top: 25px;" id="speciliser-section" class="speciliser-area">
    <div class="">
        <div class="row custom_freelancer_balance_tebel">

            <div class="cols">
                <div class="col col2of3">
                    <h1 style="font-size: 22px;font-family: calibri;margin-top: -25px;color: #494949;margin-bottom: 9px;" id="pageTitle" class="oHInline">Transaction History</h1>
                </div>
            </div>
            <!--end transection history -->

            <div id="accountingHistoryFilter" class="oFilterBar custom_filter_bar" data-url="https://www.deshilancer.com/earnings-history/7128977">
                <form action="" method="get" id="searchpaymentfilter">
                
                <div style="float: left;" class="jsRange ib inlineBlock">
                    <div class="cal">
					<label class="oLabelInline oLabelDatePicker" for="from1">
                        From</label>
                        <?php
                        if(isset($_GET['startDate']) && $_GET['startDate']!=""){
                           $startDate = date('F j, Y',strtotime($_GET['startDate']));?>
                            <input style="margin-right: 18px;" type="text" id="datepicker" class="form-control datepicker"  name="startDate" value="<?=$startDate;?>"  > 
                      <?php  }else{ ?>
                         <input style="margin-right: 18px;" type="text" id="datepicker" class="form-control datepicker"  name="startDate" placeholder="<?=date('F j, Y');?>" >
                         <?php } ?> 
                    
					</div>
                    <div class="cal">
                    <label class="oLabelInline oLabelDatePicker" for="to1">To</label>
                    <?php
                        if(isset($_GET['endDate']) && $_GET['endDate']!=""){
                           $endDate = date('F j, Y',strtotime($_GET['endDate']));?>
                              <input style="margin-right: 15px;" id="datepickerend" class="form-control datepicker"  name="endDate" value="<?=$endDate;?>"  > 
                      <?php  }else{ ?>
                         <input style="margin-right: 15px;" type="text" id="datepickerend" class="form-control datepicker"  name="endDate" placeholder="<?=date('F j, Y');?>" >
                         <?php } ?> 
                    
                    
					</div>
                </div>
                <?php
?>
                <div class="ib" id="jsFilterSelectArea">

                    <select name="trxTypes" id="trxTypes">
                        <option value="ALL" label="All Transactions" selected="selected">All Transactions</option>
                        <option value="CREDITES" label="Credits">Debits</option>
                        <option value="HOURLY" label="Hourly">Hourly</option>
                        <option value="FIXED" label="Fixed-price">Fixed-price</option>
                     
                       
                    </select>
                    <select style="margin-right: 15px;" name="employers" id="employers">
                        <option value="">All Frelancers</option>
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
                        <th>Freelancer</th>
                        <th style="padding-right: 9px;" class="txtRight nowrap">Amount </th>
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
                        <?php  if($payment->job_type  =="fixed"){ ?>
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
                             <td><?php if($payment->des == ''){echo $payment->title.' '.$paid_status;}else{echo $payment->title.' - '.$payment->des;} ?></td>
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
									 $total_work_cweek = 0;
									   if(!empty($job_done)){
										   foreach($job_done as $work){
											   $total_work_cweek +=$work->total_hour;
										   }
										     
									   }
                             
                             
                             
                             
                             ?>
                              <td>Hourly Price</td>
                              <td>Paid Invoice for Contract ID: <?php echo $payment->contact_id.' - '.$total_work_cweek.'hrs @$ '.$payment->offer_bid_amount.'/hr' ?></td>
                        <?php  } ?>
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
                  
                ?>
               
                </tbody>
            </table>
            <div class="cols">
                <table style="width: 266px;height: 152px;" class="col1of3 oTableLite oRight txtRight">
                    <caption>
                        <strong style="padding-left: 153px;">Statement Period</strong>
                        <p style="margin-bottom: 10px;float: right;"> <?php  if(!empty($list_payments)){
                            $myfirst_elementt = reset($list_payments);?>
                          <?php  $myLastElement = end($list_payments); ?> 
                              <?=date('M j, Y',strtotime($myfirst_elementt->payment_create));?>- <?=date('M j, Y',strtotime($myLastElement->payment_create));?>
                              <?php } ?>
                        </p>

                    </caption>
                    <tbody style="float: right;position: absolute;right: 205px;">
                        <tr>
                            <td><strong>Beginning Balance</strong>
                            </td>
                            <td><strong>$<?=floatval($grossstotal);?></strong>
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
                        <!--<tr>
                            <td>Total Change</td>
                            <td>$0.00</td>
                        </tr>-->
                        <tr>
                            <td><strong>Ending Balance</strong>
                            </td>
                            <td><strong>$<?=floatval($grossstotal);?></strong>
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