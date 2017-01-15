<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"></style>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<div class="page animsition">
    <div class="page-header">





        <div class="page-header">
            <h1 class="page-title"><?php echo $title; ?></h1>
            <div class="page-header-actions">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <?php echo $loadpage; ?>
                        </a>
                    </li>
                    <li class="active">
                        <?php echo $title; ?>
                    </li>
                </ol>
            </div>
        </div>

        <div class="page-content">
            <!-- Panel -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <!--<h2><?php echo $title; ?></h2>-->
                <div class="first">
                    <h3><?php echo $title; ?></h3>
                    <h4> Search by user name   </h4>
                    <div class="btn-toolbar" role="toolbar" aria-label="...">
                        <div class="btn-group" role="group" aria-label="...">A</div>
                        <div class="btn-group" role="group" aria-label="...">B</div>
                        <div class="btn-group" role="group" aria-label="...">C</div>
                        <div class="btn-group" role="group" aria-label="...">D</div>
                        <div class="btn-group" role="group" aria-label="...">E</div>
                        <div class="btn-group" role="group" aria-label="...">F</div>
                        <div class="btn-group" role="group" aria-label="...">G</div>
                        <div class="btn-group" role="group" aria-label="...">H</div>
                        <div class="btn-group" role="group" aria-label="...">I</div>
                        <div class="btn-group" role="group" aria-label="...">J</div>
                        <div class="btn-group" role="group" aria-label="...">K</div>
                        <div class="btn-group" role="group" aria-label="...">L</div>
                        <div class="btn-group" role="group" aria-label="...">M</div>
                        <div class="btn-group" role="group" aria-label="...">N</div>
                        <div class="btn-group" role="group" aria-label="...">O</div>
                        <div class="btn-group" role="group" aria-label="...">P</div>
                        <div class="btn-group" role="group" aria-label="...">Q</div>
                        <div class="btn-group" role="group" aria-label="...">R</div>
                        <div class="btn-group" role="group" aria-label="...">S</div>
                        <div class="btn-group" role="group" aria-label="...">T</div>
                        <div class="btn-group" role="group" aria-label="...">U</div>
                        <div class="btn-group" role="group" aria-label="...">V</div>
                        <div class="btn-group" role="group" aria-label="...">W</div>
                        <div class="btn-group" role="group" aria-label="...">X</div>
                        <div class="btn-group" role="group" aria-label="...">Y</div>
                        <div class="btn-group" role="group" aria-label="...">Z</div>



                    </div>

                </div>
<p class="result-msg" style="text-align: center;color: green;font-size: 20px;display: none;"></p>
                <div class="secound">
                    <div class="fab">
                        <div class="selector" id="uniform-user_type" style="width: 100px;">
                            <select id="user_type" name="user_type" class="form-control">
                                <option value="">ID</option>
                                <option value="3"> Username</option>
                                <option value="2">Email</option>
                            </select>
                        </div>
                    </div>
                    <div class="fad">
                        <i class="fa fa-minus" aria-hidden="true"></i>
                    </div>
                    <div class="fae">
                    </div>
                    <div class="faf"> SEARCH </div>
                </div>
                <div class="third">
                    <div class="fabb"> Date</div>
                    <div class="fad"> To </div>
                    <div class="fabb"> Date </div>
                    <div class="faff"> SEARCH </div>
                </div>

                <div class="table" >

                    <table class="table table-bordered" id="example">
                        <thead>
                            <tr>
                                <th><img src="/assets/adminassets/images/box.png">
                                </th>
                                <th>ID</th>
                                <th> Logo</th>
                                <th> Username/Email </th>
                                <th> Name </th>
                                <th> Adress </th>
                                <th> Billing </th>
                                <th> Join Date </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            foreach($result as $row){?>
                            <tr>
                                <th><img src="/assets/adminassets/images/box.png">
                                </th>
                                <td>
                                    <?=$i;?>
                                <?php //$row->webuser_id ?>
                                </td>
                                <td>
                                    <?php  if(isset($row->webuser_picture) && $row->webuser_picture !=""){ ?>
									<img src="<?php echo base_url().$row->webuser_picture ?>" width="64" height="64" />
								<?php }else{ ?>
									 <img src="/assets/adminassets/images/man.png">
								<?php  } ?>
                                    
                                   
                                </td>
                                <td>  <?=$row->webuser_username; ?><br>
                                <?=$row->webuser_email; ?>
                                </td>
                                <td> <?=$row->webuser_fname ?> <?=$row->webuser_lname ?></td>
                                <td>
                                    
                                <?php
                                $this->db->select('*');
                                $this->db->from('webuseraddresses');
                                $this->db->where('webuseraddresses.webuser_id', $row->webuser_id);
                                $query = $this->db->get();
                                $result_addresss = $query->row();
                                if(!empty($result_addresss)){
                                    if($result_addresss->address!=""){ echo $result_addresss->address."<br>"; }
                                    if($result_addresss->address1!=""){ echo $result_addresss->address1."<br>"; }
                                    if($result_addresss->city!=""){ echo $result_addresss->city."<br>"; }
                                    if($result_addresss->state!=""){ echo $result_addresss->state."<br>"; }
                                    if($result_addresss->zipcode!=""){ echo $result_addresss->zipcode."<br>"; }
                                    if($result_addresss->country!=""){ echo $result_addresss->country; }
                                 }
                                ?>
                                
                                </td>
                                <td>Paypal</td>
                                <td> <?php  echo date('d/m/Y',strtotime($row->created));?></td>
                                <td>
                                    
                                     <a href="javascript:void(0);" onclick="javascript:changestatus('<?=$row->webuser_id;?>')" title=" <?=($row->isactive=='1')?'Active':'Suspend';?> ">
                                            <?=($row->isactive=='1') ? '<div class="facd"><i class="fa fa-check" aria-hidden="true"></i></div>' : ' <div class="fabn"><i class="fa fa-times" aria-hidden="true"></i> </div>';?>
                                    </a>
                                </td>
                                <td>
                                    <div class="selector" id="uniform-user_type" style="width: 100px;">
                                        <select id="user_type" name="user_type" class="form-control">
                                            <option value="">Edit</option>
                                            <option value="3">Active</option>
                                            <option value="2">Suspend</option>

                                        </select>
                                    </div>
                                    Delete
                                </td>
                            </tr>
                            
                         <?php $i++;
                         } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            bFilter: false,
        });
    } );
    
    function changestatus(id){
        
        $.post("<?php echo base_url() ?>administrator/userpage/changeactiveTosuspend", { id: id },  function(data) {

					if(data.success){
							
							$('.result-msg').html('You have successfully change The Status');
							$(".result-msg").show().delay(5000).fadeOut();
							setTimeout(function(){ window.location = "<?php echo base_url();?>administrator/userpage/loadpage/webuser/subpage/suspendclient"; }, 5000);
					}
					else{
							alert('Opps!! Something went wrong.');
					}
			   
			}, 'json');
        
    }
    
    
    
</script>
<style>
    .dataTables_length {
  display: none;
}
.dataTables_info {
  float: left;
  margin-bottom: 25px;
}
.dataTables_paginate.paging_simple_numbers {
  float: right;
  position: relative;
  top: 0;
  width: auto;
}
#example_paginate a {
  padding: 5px;
}
.facd {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border-bottom: 1px solid #929292;
  border-right: 1px solid #929292;
  border-top: 1px solid #929292;
  display: block;
  float: none;
  overflow: hidden;
  padding: 0;
}
.fa.fa-check {
  background: #1da7da none repeat scroll 0 0;
  display: block;
  float: left;
  padding: 7px;
}
</style>
