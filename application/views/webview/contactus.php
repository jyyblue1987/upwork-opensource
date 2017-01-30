<?php if(!empty($sent) && $sent && !empty($ticketID)) {?>
    <h1 class="text-center">Thanks for your message!</h1>
    <h3 class="text-center">Your ticketID is <strong><?php echo $ticketID?></strong></h3>
<?php } ?>

<div style="background: #fff;margin-top: 40px;margin-bottom: 40px;border: 1px solid #ccc;border-radius: 3px;padding: 0px 13px;" class="row">
    <div class="col-md-12 col-sm-12">
        <header>Contact</header>
    </div>
    <div style="clear:both"></div>
    <div class="col-md-7 col-sm-12">
        <div class="leftside">
<!--            <form>-->

            <?php if(!empty($error)){ ?><p style="color:red;"><?php echo $error; ?></p><?php }?>

            <?php echo form_open_multipart(site_url("contactcheck"),array('id' => 'contactus_form'));?>
                <div class="form-group">
                    <label for="Name">First Name:</label>
                    <input type="Name" class="form-control" id="Name" name="fname" value="<?php echo $this->session->userdata['fname']; ?>">
                </div>
                <div class="form-group">
                    <label for="Last">Last Name:</label>
                    <input type="LastName" class="form-control" id="Last" name="lname" value="<?php echo $this->session->userdata['lname']; ?>">
                </div>
                <div class="form-group">
                    <label for="Email">Email:</label>
                    <input type="Email" class="form-control" id="Email" name="email" value="<?php echo $this->session->userdata['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="Subject">Subject</label>
                    <select class="sub_menu" name="subject">
                        <option value="General">General</option>
                        <option value="Registration">Registration</option>
                        <option value="Account Suspend">Account Suspend</option>
                        <option value="Project">Project</option>
                        <option value="Payment">Payment</option>
                        <option value="Dispute">Dispute</option>
                        <option value="Employer">Employer</option>
                        <option value="Freelancer">Freelancer</option>
                        <option value="Complain/Feedback">Complain/Feedback</option>
                        <option value="Close Account">Close Account</option>

                    </select>

                </div>
                <div style="margin-bottom: 40px;" class="form-group">
                    <label for="Message">Message:</label>
                    <textarea class="form-control" id="Message" placeholder="Message" name="body"></textarea>
                </div>
                <div class="form-group" id="attachFile">
                    <label style="float: left;margin-right: 5px;" for="Input">Attach File
                        <div class="addplus">
                            <a href="" id="addUserFile">
                                [Add File]
                            </a>
                        </div>
                    </label>
                    <div>
					<input type="file" class="file_upload" name="userfiles[]" id="" value="">  <div class="trst_icn"> </div>
					</div>
                </div>

                <div class="form-group">
                    <span id="captcha"><?php echo $captcha['image']; ?></span>
                    <a href='#' class ='refresh'><img id = 'ref_symbol' src ="<?php echo base_url(); ?>assets/img/refresh.png"></a>
                </div>
                <div class="form-group">
                    <label for="Security">Security Code:</label>
                    <input style="width: 39%;" type="Security" name="captcha" class="form-control" id="Security">
                </div>
                <button type="submit" class="btn-primary big_mass_active transparent-btn big_mass_button">Save</button>
                <button style="margin-bottom: 30px;" type="submit" class="btn-primary transparent-btn big_mass_button">Cancel</button>
            </form>
        </div>
    </div>
    <div style="margin-left: 67px;font-family: calibri;" class="col-md-4 col-sm-12">
        <div class="rightside">
            <div class="col-md-8 col-sm-12 headingone">
                <h1>Our addresses</h1>
            </div>
            <div style="clear:both"></div>
            <h3>winjob International Office:</h3>
            <address>
                Winjob LLC<br/>
                14037 NE 181ST ST APT C305<br/>
                Newyork, nw 10021<br/>
                Phone 1213-825-1158<br/>
                Fax: 1213-261-9884
            </address>
            <div class="clear:both"></div>
            <h3>winjob International Office:</h3>
            <address>
                Winjob LLC<br/>
                14037 NE 181ST ST APT C305<br/>
                Newyork, nw 10021<br/>
                Phone 1213-825-1158<br/>
                Fax: 1213-261-9884
            </address>
        </div>
    </div>
</div>
