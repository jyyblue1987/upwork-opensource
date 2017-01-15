<section id="big_header"
         style="margin-top: 50px; margin-bottom: 50px; height: auto;">

    <div class="container white-box-feed">

        <div class="row  ">  
            <div class="col-xs-12 col-sm-3 col-md-3 nopadding">
                <?php 
                $data = array(
                    'current_active' => 'choose'
                ); 
                $this->load->view("webview/profile/freelancer-profile-left-sidebar",$data) ?>
                <?php //$this->load->view("webview/includes/error_message"); ?>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 align-left nopadding">
                <div class="row  "> 
                    <div class="col-md-12 col-md-offset-0 page-title">
                        <h1 style="color:black;">Which categories best fit your skills?</h1>
                        <br />
                        <h5 class="page-sub-title">Select 10 categories that match your
                            professionali experience</h5>
                        <br/> 
                        <?php $this->load->view('webview/action_msgs'); ?> 
                    </div> 
                </div> 
                <form id="basicg" method="post"
                      action="<?php echo site_url("categories/add"); ?>">

                    <?php
                    if ($categories) {
                        $i = 0;
                        foreach ($categories as $category) {
                            $subcategories = $this->category_model->get_subcategories($category->cat_id);
                            $class = ($i > 0) ? 'margin-top' : '';
                            ?>
                            <div class="row <?php echo $class ?>">
                                <div class="col-md-12">
                                    <label><?php echo $category->category_name; ?></label>
                                </div>
                                <?php
                                if ($subcategories) {
                                    foreach ($subcategories as $subcategory) {
                                        $field_name = str_replace([' ', '-'], ['_'], strtolower($subcategory->subcategory_name));
                                        ?>
                                        <div class="col-md-3">
                                            <input type="checkbox" name="subcats[]" id="<?php echo $field_name ?>" value="<?php echo $subcategory->subcat_id ?>" 
                                                   <?php if (array_search($subcategory->subcat_id, $user_categories)) { ?> checked="checked" <?php } ?>/> 
                                                   <?php //echo '<pre>'; print_r($subcategories); echo '</pre>'; ?>
                                                   <?php echo $subcategory->subcategory_name; ?>
                                        </div>
                                    <?php }
                                }
                                ?>

                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-12 margin-top"> 
                            <button class="btn btn-primary form-btn pull-right" onClick="window.history.back();">Cancel</button>
                            <button type="submit" class="btn btn-primary form-btn pull-right" style="margin-right: 5px;">Save</button>
                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

</section>

</div>

</section>
<!-- big_header-->

<script>
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
    $('input[name="job_type"]').on('click', function () {
        console.info($(this));
        $('#hourly-control').addClass('hidden');
        $('#fixed-control').addClass('hidden');
        if ($(this).val() == 'hourly') {
            $('#hourly-control').removeClass('hidden');
        }

        if ($(this).val() == 'fixed') {
            $('#fixed-control').removeClass('hidden');
        }
    });

    $('#category').on('change', function () {
        console.info('this', $(this), $(this).find(":selected").parents('optgroup').attr('label'));
        var _parent_cat = $(this).find(":selected").parents('optgroup').attr('label');
        $(this).val().preppend(_parent_cat);
    });
</script>
