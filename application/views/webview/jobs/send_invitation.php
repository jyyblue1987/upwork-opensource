<section id="big_header"
         style="margin-top: 50px; margin-bottom: 50px; height: auto;">

    <div class="container">
        <form method="post" action="<?php echo site_url('jobs/send_invitation'); ?>">
        <div class="row margin-left-4">
            <div class="col-md-9 send-invitation-container">
                <div class="row part-profile">
                    <div class="col-md-12">
                        <div class="row">
                            <div class = "pull-left st_img">
                                <?php
                                    $pic = $this->Adminforms->getdatax("picture", "webuser", $user_id);
                                    if ($pic == "") {
                                        ?>
                                        <img src="<?php echo site_url("assets/user.png"); ?>" width="64" height="64">
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo site_url($pic); ?>" width="64" height="64">
                                        <?php
                                    }
                                    ?>
                            </div>
                            <div class="col-md-10 col-sm-9">
                                 <?php
									$this->db->select('*');
									$this->db->from('webuser');  
									$this->db->where('webuser.webuser_id',$user_id);
									$query = $this->db->get();
									$webuserResult = $query->row();
									//var_dump($webuserResult);die();
								?>
                                <label class="blue-text"><?php echo $webuserResult->webuser_fname.' '.$webuserResult->webuser_lname; ?></label> <br />
                                <label class="gray_text"><?php
                                    $profile=array();
                                    $this->db->where('webuser_id', $user_id);
                                    $q = $this->db->get('webuser_basic_profile');
                                    if ($q->num_rows() > 0) {
                                        $profile = $q->row();
                                        echo ucfirst($profile->tagline);
                                    }
                                    ?>
								</label>
                            </div>
                        </div>

                        <div class="row margin-top-25">
                            <div class="col-md-12">
                                <span><strong>Already know this freelancer?</strong> <a href="">Hire Now</a></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row margin-top">
                    <div class="col-md-12 text-left"> <strong>Choose a job : </strong></div>
					
					<div class="col-md-12">
						<div class = "row">
							<div class = "col-md-4">
								<div class="radio">
									<label><input type="radio" name="optradio-jobselect" checked value = '1'>Choose an Existing Job</label>
								</div>
							</div>
							<div class = "col-md-8">
								<?php
									$sender_id = $this->session->userdata('id'); 
									$this->db->select('*');
									$this->db->from('jobs');  
									$this->db->where('jobs.status', '1');
									$this->db->where('jobs.user_id', $sender_id);
									$this->db->order_by("jobs.created", "desc");
									$query = $this->db->get();
									$result = $query->result();
								?>
								
										<select id = "job_id" class="form-control" name="job_id" style = "marging:0px;">
											<?php
											   foreach ($result as $job){
											?>
											<option value="<?php echo $job->id; ?>"><?php echo $job->title; ?></option> 
											<?php
											   }
											?>
										</select>
									
							</div>
							
						</div>
						<div class = "row">
							<div class = "col-md-12">
								<div class="radio">
								  <label><input type="radio" name="optradio-jobselect" value = '2'>Create a new Job</label>
								</div>
							</div>
						</div>
					</div>
                </div>
				
				<div class="row hidden margin-top-1 margin-left-3 custom_job_post_form"" id="job_form">
                     <?php $this->load->view('webview/jobs/job_form', ['class' => 'text-left', 'mode' => 'invitation']); ?>
                </div> 
				
				<div class="row margin-top-1">
                    <div class="col-md-12"><strong>Message to Freelancer </strong></div>
                    <div class="col-md-12 margin-top-15">
                        <textarea class="form-control" rows="6" cols="30" name="message"></textarea>
                        <input type="hidden" name="fuser_id" value="<?php echo $user_id; ?>">
                    </div>
                    
                </div>
               
                <div class="row margin-top-25">
                    <div class="col-md-6">
                        <input type="submit" value="Send Invite" class="btn btn-primary form-btn invite-btn" /> 
						<input type="button" value="Cancel" class="btn btn-default form-btn-default invite-btn" />
                    </div>
                </div>

            </div>
        </div>
        </form>
    </div>

</section>

</div>

</section>
<!-- big_header-->

<script>
	
	$("input[name = 'optradio-jobselect']").click(function(){
		if($("input[name='optradio-jobselect']:checked").val() == '1'){
			$('#job_form').addClass('hidden');
			$('#job_id').removeClass('hidden');
		}
		else{
			 $('#job_form').removeClass('hidden');
			 $('#job_id').addClass('hidden');
		}
	});

    $('#new_job').on('click', function () {
        $('#job_form').removeClass('hidden');
    });

    $('#existing_job').on('click', function (){
        $('#job_form').addClass('hidden');
    });
	
	
	
	
</script>