<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rating.css">
<style>
    .page-sub-title 
    {
        margin-top: 10px;
    }
    .page-jobs input 
    {
        margin-top: 5px;
    }
    
    .load-more
    {
        background-color: #23a8d9; 
        color: #fff; 
        padding: 10px; 
        text-align: center; 
        cursor: pointer; 
        margin-top: -32px;
    }
    .page-jobs h5
    {
        padding-right:5px
    }
</style>
<section id="big_header"  style="height: auto;">
    <div class="container" style="margin-top: -50px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-0">
                <div class="row">
                    <div class="col-md-12 no-padding margin-top-search" style="padding: 0px;">
                        <form action="<?= site_url() ?>freelance-jobs" method="GET" id="job-search-form">
                            <input type="text" placeholder="Find job" name="q" id="jobsearch" value="<?= isset($_GET['q']) ? $_GET['q'] : ''  ?>"  class="form-control search-field" />
                            <i class="fa fa-search search-btn search-btn-home custom_btn" aria-hidden="true"></i>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div style="border: 1px solid #ccc; border-radius: 3px;padding-bottom: 0;padding-top: 0; margin-right: 20px; margin-top: 0px;" class="col-md-12 borderedx white-box margin-top-space">
                                <div class="row">
                                    <div class="nav-side-menu">
                                         <div class="menu-list">
                                            <ul id="menu-content" class="menu-content out cus_left_m_list">
                                                <li style="padding: 5px 15px 5px 15px; font-family: calibri; font-size: 16px; font-weight: bold; color: #686361;">
                                                CATEGORIES
                                                <?php foreach($categories AS $category){ ?>
                                                <li style="padding: 5px 15px 5px 15px; font-family: calibri; font-size: 14px; font-weight: bold; color: #686361;" data-toggle="collapse" data-target="#category<?= $category->cat_id ?>" class="collapsed">
                                                <?= $category->category_name; ?><input type="hidden" value="<?= $category->cat_id ?>" name="jobCat[]"> <span class="arrow"></span>
                                                </li>
                                                <?php
                                                $query = $this->db->get_where('job_subcategories', array('cat_id' => $category->cat_id));
                                                ?>
                                                    <ul style="padding-top: 12px;margin-bottom: -8px;" class="sub-menu collapse" id="category<?= $category->cat_id ?>">
                                                        <?php foreach($query->result() AS $s){ ?>
                                                        <li style="position:relative; margin-left: 10px;"><input type="checkbox" class="choose-job-cat" value="<?= $s->subcat_id ?>" name="subCat[]"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;"><?= $s->subcategory_name ?></span></li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <div class="row">
                            <div style="border: 1px solid #ccc;border-radius: 3px;padding-bottom: 0;padding-top: 0;" class="col-md-12 borderedx white-box margin-top-space">
                                <div class="row">
                                    <div class="nav-side-menu">
                                         <div class="menu-list">
                                            <ul id="menu-content" class="menu-content out cus_left_m_list">
                                                <li style="padding: 5px 15px 5px 15px; font-family: calibri;font-size: 14px;font-weight: bold;color: #686361;" data-toggle="collapse" data-target="#tob-type" class="collapsed">
                                                 JOB TYPE <span class="arrow"></span>
                                                </li>
                                                <ul style="padding-top: 12px;margin-bottom: -8px;" class="sub-menu collapse in" id="tob-type">
                                                    <li style="position:relative; margin-left: 10px;"><input type="checkbox" name="jobType[]" class="jtype-check" value="hourly"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">Hourly price</span></li>
                                                    <li style="position:relative; margin-left: 10px;"><input type="checkbox" name="jobType[]" class="jtype-check" value="fixed"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">Fixed price</span></li>
                                               </ul>

                                                <li style="padding: 5px 15px 5px 15px; font-family: calibri;font-size: 14px;font-weight: bold;color: #686361;" data-toggle="collapse" data-target="#tob-duration" class="collapsed">
                                                 JOB DURATION <span class="arrow"></span>
                                                </li>
                                                <ul style="padding-top: 12px;margin-bottom: -8px;" class="sub-menu collapse in" id="tob-duration">
                                                    <li style="position:relative; margin-left: 10px;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="More_than_6_months"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">More than 6 months</li>
                                                    <li style="position:relative; margin-left: 10px;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="3_6_months"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">3 - 6 months</span></li>
                                                    <li style="position:relative; margin-left: 10px;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="1_3_months"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">1 - 3 months</span></li>
                                                    <li style="position:relative; margin-left: 10px;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="less_than_1_months"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">Less than 1 month</span></li>
                                                    <li style="position:relative; margin-left: 10px;"><input type="checkbox" name="jobDuration[]" class="jduration-check" value="less_than_1_week"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">Less than 1 week</span></li>
                                               </ul>
                                                <li style="padding: 5px 15px 5px 15px; font-family: calibri;font-size: 14px;font-weight: bold;color: #686361;" data-toggle="collapse" data-target="#tob-hours" class="collapsed">
                                                 HOURS PER WEEK <span class="arrow"></span>
                                                </li>
                                                <ul style="padding-top: 12px;margin-bottom: 10px;" class="sub-menu collapse in" id="tob-hours">
                                                    <li style="position:relative; margin-left: 10px;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="1-9"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">1 - 9 hours</span></li>
                                                    <li style="position:relative; margin-left: 10px;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="10-19"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">10 - 19 hours</span></li>
                                                    <li style="position:relative; margin-left: 10px;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="20-29"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">20 - 29 hours</span></li>
                                                    <li style="position:relative; margin-left: 10px;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="30-39"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">30 - 39 hours</span></li>
                                                    <li style="position:relative; margin-left: 10px;"><input type="checkbox" name="jobHours[]" class="jhours-check" value="40_plus"/> &nbsp;<span style="color: #686361;position: absolute;top: -2px;">More than 40  hours</span></li>
                                               </ul>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                       </div>
                    <div class="col-md-8">
                        <section id="big_header" style="height: auto;">
                            <div style="margin-top: -35px; border: 1px solid #ccc;padding-top: 25px; padding-left: 20px; padding-bottom: 0;" class="job-data white-box-feed">
                                <div class="col-md-8 col-sm-8 no-padding" align="center">
                                    <label class="col-md-4 no-padding">Sort by:</label>
                                    <div class="col-md-7 no-padding">
                                        <select style="margin-bottom: 10px;margin-top: -10px;" class="select form-control" name="postTime">
                                            <option value="1">Newest</option>
                                            <option value="0">Oldest</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 no-padding jobs-found">
                                Total <?php if (!empty($records)) {
                                            echo count($records);
                                        } ?> jobs found
                                </div>
                                <div class="clearfix"></div>
                                <div style="margin-left: -5px;" class="line custon_line"></div>
                                <br/>
                                <div class="row white-box" id="all-jobs">
                                <?php include 'no_auth_content.php'; ?>
                                </div>

                            </div>
                            <div class='load-more'>Load more <img src='<?php echo site_url() ?>assets/img/version1/loader.gif' class="form-loader" style="display:none"></div>
                        </section>

                    </div>

                </div>
            </div>
        </div>

    </div>

</section>
