<section id="big_header"
         style="margin-top: 50px; margin-bottom: 50px; height: auto;">

    <div class="container">
        <form method="post" action="<?php echo site_url('jobs/send_invitation'); ?>">
        <div class="row margin-left-4">
            <div class="col-md-9">


                <div class="row margin-top">
                    <div class="col-md-3 text-right">Inviting</div>
                    <div class="col-md-9">

                        <div class="row">
                            <div class="col-md-2">
                                <?php
                                   
                                    $pic = $this->Adminforms->getdatax("picture", "webuser", $user_id);
                                    if ($pic == "") {
                                        ?>
                                        <img src="<?php echo site_url("assets/user.png"); ?>" width="64" height="64" >
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo site_url($pic); ?>" width="64" height="64" >
                                        <?php
                                    }
                                    ?>
                            </div>
                            <div class="col-md-10">
                                 <?php
                            $this->db->select('*');
                            $this->db->from('webuser');  
                            $this->db->where('webuser.webuser_id',$user_id);
                            $query = $this->db->get();
                            $webuserResult = $query->row();
                            //var_dump($webuserResult);die();
                            ?>
                                <label class="blue-text"><em><?php echo $webuserResult->webuser_fname.' '.$webuserResult->webuser_lname; ?></em></label> <br />
                                <label class="gray_text"><em><?php
                                    $profile=array();
                                    $this->db->where('webuser_id', $user_id);
                                    $q = $this->db->get('webuser_basic_profile');
                                    if ($q->num_rows() > 0) {
                                        $profile = $q->row();
                                        echo ucfirst($profile->tagline);
                                    }
                                    ?></em></label>
                            </div>
                        </div>

                        <div class="row margin-top-1">
                            <div class="col-md-12">
                                <span>Already know this freelancer? <a href="">Hire Now</a></span>
                            </div>
                        </div>

                    </div>
                </div>




                <div class="row margin-top-1">
                    <div class="col-md-3 text-right">Message</div>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="6" cols="30" name="message"></textarea>
                        <input type="hidden" name="fuser_id" value="<?php echo $user_id; ?>">
                    </div>
                    
                </div>

                <div class="row margin-top-1">
                    <div class="col-md-3 text-right">Choose a job</div>
                    <div class="col-md-6">
                        <div class="row"> 
                            <?php
                            $sender_id = $this->session->userdata('id'); 
                            $this->db->select('*');
                            $this->db->from('jobs');  
                            $this->db->where('jobs.status', '1');
                            $this->db->where('jobs.user_id', $sender_id);
                            $query = $this->db->get();
                            $result = $query->result();
                            ?>
                            <div class="col-md-7">
                                <select class="form-control" name="job_id">
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



                    </div>

                </div>


                <div class="row hidden margin-top-1 margin-left-3" id="job_form">
                    <div class="col-md-12">
                        <?php $this->load->view('webview/jobs/job_form', ['class' => 'text-right', 'mode' => 'invitation']); ?>
                    </div>

                </div> 
                <div class="row margin-top">
                    <div class="col-md-3 text-right"></div>
                    <div class="col-md-6">
                        <input type="submit" value="Send Invitation"
                               class="btn btn-primary form-btn" /> <input type="button"
                               value="Cancel" class="btn btn-default form-btn-default" />
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

    $('#new_job').on('click', function () {
        $('#job_form').removeClass('hidden');
    });

    $('#existing_job').on('click', function () {
        $('#job_form').addClass('hidden');
    });
</script>