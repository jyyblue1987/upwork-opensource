<section id="big_header" style="margin:50px 0;height: auto;">

    <div class="container white-box main-area">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 align-left">
                <?php
                $data = array(
                    'current_active' => 'tax-information'
                );
                $this->load->view("webview/profile/freelancer-profile-left-sidebar", $data)
                ?>
            </div>

            <div class="tax-details col-xs-12 col-sm-9 col-md-9">
                <?php
                if (isset($webUserTaxdetails) && is_array($webUserTaxdetails) && sizeof($webUserTaxdetails) > 0) {
                    $class = "hidden";
                    ?>
                    <div class="row title-line">
                        <div class="abc">
                            <h4 style="padding-bottom:17px;"> Tax Details </h4> 
                        </div> 
                        <div class="abd"> 
                            <label class="edit-tax" accesskey="hidden" style="cursor: pointer">Edit</label>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group">
                            <label class="col-xs-4"> Legal Name </label>
                            <div class="col-xs-8">
                                <span id="adress"><?php echo $webUserTaxdetails['legal_name'] ?> </span>
                            </div>
                        </div>
                        <br/>
                        
                        
                        <?php
                        if($webUserTaxdetails['tax_no'] == ''){
                            ?>
                        <div class="form-group">
                            <label class="col-xs-4"> Do you have Tax/Pan </label>
                            <div class="col-xs-8">
                                <span id="adress"><?php echo 'No' ?> </span>
                            </div>
                        </div>
                        
                        <?php
                        } else{
                        ?>
                        <div class="form-group">
                            <label class="col-xs-4"> Tax No </label>
                            <div class="col-xs-8">
                                <span id="adress"><?php echo $webUserTaxdetails['tax_no'] ?> </span>
                            </div>
                        </div>
                        
                        <?php
                        } 
                        ?>
                        
                        <br/>
                        
                        <div class="form-group">
                            <label class="col-xs-4"> Address </label>
                            <div class="col-xs-8">
                                <span id="adress"><?php echo $webUserTaxdetails['address'] . "<br/>" . $webUserTaxdetails['address_line1'] ?> </span>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label class="col-xs-4">  </label>
                            <div class="col-xs-8">
                                <span id="adress"><?php echo $webUserTaxdetails['city'] ?> </span>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label class="col-xs-4">  </label>
                            <div class="col-xs-8">
                                <span id="adress"><?php echo $webUserTaxdetails['state'].', '.$webUserTaxdetails['zip'] ?> </span>
                            </div>
                        </div>
                        <br/> 
                        <br/>
                        <div class="form-group">
                            <label class="col-xs-4">Tax Country </label>
                            <div class="col-xs-8">
                                <span id="adress"><?php  
                                echo $countryList[$webUserTaxdetails['country']]['country_name']  ?> </span>
                            </div>
                        </div>
                        
                    </div>
                    <?php
                } else {
                    $class = "show";
                }
                ?>  
            </div>
            <div class="col-md-9 <?php echo $class ?>" id="tax-area">
                <div class="row title-line">
                    <div class="abc">
                        <h4 style="padding-bottom:17px;"> This information will be used in the Invoice generated for the Services. </h4> 
                    </div>  
                </div>   
                <div id="editableform">
                    <form action="#" name="" method="post" id="tax-form">


                        <div class=" row">
                            <label for="" id="olemail" class="col-xs-3 col-form-label">Legal Name</label>
                            <div class="col-xs-6">
                                <input class="form-control" name="legalName" type="text" value="<?php if (isset($webUserTaxdetails['legal_name'])) echo $webUserTaxdetails['legal_name']; ?>" placeholder="Type your legel name" required=""/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-offset-6 col-sm-10">
                                <div class="Remember">
                                    <label>
                                        <p>Personal/Business Legal Name</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class=" row do-u-tax" style="margin-bottom:12px;">
                            <label for="" id="olemail" class="col-xs-3 col-form-label">Do you have Tax/Pan</label>
                            <?php
                            //  var_dump($country_name);die();
                            if (strcmp($country_name, "United States") != 0) {
                                ?>
                                <div class="col-xs-6">
                                    <button type="button" id="butyes" class="btn btn-danger">Yes</button>
                                    <button type="button" id="butno"class="btn btn-primary">No</button>
                                </div>
                                <?php
                            }
                            ?>

                        </div>


                        <div class="row tax-plan tax-no">
                            <label for="" id="olemail" class="col-xs-3 col-form-label">Tax No</label>
                            <div class="col-xs-6">
                                <input name="taxno" id="taxno" required="" class="form-control" type="text" value="<?php if (isset($webUserTaxdetails['tax_no'])) echo $webUserTaxdetails['tax_no']; ?>" placeholder="Type your tAX number" />
                            </div>
                        </div>
                        <div class="col-sm-offset-6 col-sm-10 tax-no">
                            <div class="Remember">
                                <label>
                                    <p>Your tax id no,pan no,vat no</p>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" id="olemail" class="col-xs-3 col-form-label">Country</label>
                            <div class="col-xs-6">
                                <?php
                                if (isset($countryList) && is_array($countryList)) {
                                    ?>
                                    <select name="country" class="select form-control select-country">
                                        <option value="">Select Country</option>
                                    <?php
                                    if (isset($countryList) && is_array($countryList) && !empty($countryList)) {
                                        foreach ($countryList as $country) {
                                            if ($country['country_id'] == $this->session->userdata('webuser_country')) {
                                                $selected = "selected = selected";
                                            } else {
                                                $selected = "";
                                            }
                                            ?>
                                                <option <?php echo $selected ?> value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                        <?php
                                    }
                                    ?>
                            </div>
                        </div>
                        <div class=" row">
                            <label for="" id="olemail" class="col-xs-3 col-form-label">Address</label>
                            <div class="col-xs-6">
                                <input class="form-control" type="text" value="<?php if (isset($webUserTaxdetails['address'])) echo $webUserTaxdetails['address']; ?>" name="taxAddress"/>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-xs-3"></div>
                            <div class="col-xs-6">
                                <input class="form-control" type="text"  value="<?php if (isset($webUserTaxdetails['address_line1'])) echo $webUserTaxdetails['address_line1']; ?>" name="taxAddressLine2" />
                            </div>
                        </div>
                        <div class=" row">
                            <label for="" id="olemail" class="col-xs-3 col-form-label">City / Town</label>
                            <div class="col-xs-3">
                                <input class="form-control" type="text"  value="<?php if (isset($webUserTaxdetails['city'])) echo $webUserTaxdetails['city']; ?>" name="city" required=""/>
                            </div>
                        </div>
                        <div class=" row">
                            <label for="" id="olemail" class="col-xs-3 col-form-label">State / Province</label>
                            <div class="col-xs-3">
                                <input class="form-control" type="text"  value="<?php if (isset($webUserTaxdetails['state'])) echo $webUserTaxdetails['state']; ?>" name="state" required=""/>
                            </div>
                        </div>
                        <div class=" row">
                            <label for="" id="olemail" class="col-xs-3 col-form-label">Zip / Postal Code</label>
                            <div class="col-xs-3">
                                <input class="form-control" type="number" value="<?php if (isset($webUserTaxdetails['zip'])) echo $webUserTaxdetails['zip']; ?>" name="zipcode" required=""/>
                            </div>
                        </div>

                        <div class=" row">
                            <div class="col-xs-3"></div>
                            <div class="col-xs-4">
                                <button type="button" id="update-tax" onclick="saveTax();" class="btn btn-danger">Update</button>
                                <?php $tax_url = site_url('payment/tax-information');;?>
                                <button type="button" class="btn btn-primary" onclick="location.href = '<?php echo $tax_url ?>'">Cancel</button>
                            </div>
                            <div class="col-xs-5 sys-message"></div>
                        </div>
                    </form>
                </div>  
            </div>


        </div>
    </div>
    <div style="clear:both"></div>

</section>
<?php
$this->load->view("webview/includes/footer-common-script");
?>
<script type="text/javascript">
    var country_val = $(".select-country").val();
    if (country_val == "9") {
        $(".do-u-tax").hide();
    } else {
        $(".tax-no").show();
        $(".do-u-tax").show();
    }
    $(".select-country").change(function () {
        var country_val = $(".select-country").val();
        if (country_val == "9") {
            $(".do-u-tax").hide();
        } else {
            $(".tax-no").show();
            $(".do-u-tax").show();
        }
    });

    $('.edit-tax').click(function () {
        var k = $(this).attr('accesskey');
        if (k == "hidden") {
            $('.tax-details').removeClass('show').addClass('hidden');
            $('#tax-area').addClass('show').removeClass('hidden');
            $(this).attr('accesskey', 'show');
        } else {
            $('.tax-details').removeClass('hidden').addClass('show');
            $('#tax-area').addClass('hidden').removeClass('show');
            $(this).attr('accesskey', 'hidden');
        }
    });
    $('#butyes').click(function () {
        $(this).css('background', '#21a7d9');
        $('#butno').css('background', '#fff');
        $('.tax-plan').addClass('show').removeClass('hidden');
        $('input[name="taxno"]').attr("required", true);
    });
    $('#butno').click(function () {
        $('#taxno').val('');
        $(this).css('background', '#21a7d9');
        $('#butyes').css({'background': '#fff', 'color': '#b6b3b3'});
        $('.tax-plan').addClass('hidden');
        $('input[name="taxno"]').removeAttr("required");
    });

    function saveTax() {
        $('#update-tax').html("processing...");
        $.ajax({
            url: "<?php echo site_url('payment/tax-information-save') ?>",
            type: "post",
            dataType: "html",
            data: $('#tax-form').serialize(),
            success: function (response) {
                var json = $.parseJSON(response);
                if (json.status == "success") {
                    $('.sys-message').html("your information succesfully saved").css('color', 'green');
                    $('#update-tax').html("update");
                } else {
                    $('.sys-message').html(json.msg).css('color', 'red');
                    $('#update-tax').html("update");
                }
            }, error: function (error, textStatus, error) {
                console.log(error);
                $('#update-tax').html("update");
            }
        });
    }

</script>
<script type="text/javascript">
    function faqselect(num) {
        if ($("#faq" + num).hasClass("faqopen")) {

            $("#faq" + num).removeClass("faqopen");
            $("#faqicon" + num).removeClass("fa-angle-down");
            $("#faqicon" + num).addClass("fa-angle-right");
            $("#faqa" + num).slideUp("fast");

        } else {
            $("#faq" + num).addClass("faqopen");
            $("#faqicon" + num).removeClass("fa-angle-right");
            $("#faqicon" + num).addClass("fa-angle-down");
            $("#faqa" + num).slideDown("fast");
        }

    }
</script>
<!-- big_header-->
