<form id="form" action="<?=base_url()?>profile/add_experience/<?php if(isset($exp_id))echo $exp_id;
    if(isset($page_from)) echo '/'.$page_from; ?>" method="post" name="experience">
    <div class=""> 
        <div class="row">
            <div class="col-md-9">
                <label>Company</label>
                <input type="text" id="company" name="inputs[company]" value="<?php if(isset($experience->company)) echo $experience->company; ?>" class="form-control" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <label>Title</label>
                <input type="text" id="title" name="inputs[title]" value="<?php if(isset($experience->title)) echo $experience->title; ?>" class="form-control" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <label>Location</label>
                <input type="text" id="location" name="inputs[location]" value="<?php if(isset($experience->location)) echo $experience->location; ?>" class="form-control" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <label>TimePeriod</label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <select name="inputs[month1]" class="form-control">
                    <option value="">--Month--</option>
                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                        <option <?php if(isset($experience->month1) && $experience->month1 == $i) echo 'selected'; ?> value="<?php echo $i; ?>">
                            <?php echo DatetimeHelper::getMonthByNum($i); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2">
                    <input type="text" class="form-control" name="inputs[year1]" value="<?php if(isset($experience->year1)) echo $experience->year1; ?>" placeholder="Year" />
            </div>
            <div class="col-md-2 experience-till">
                <select name="inputs[month2]" class="form-control">
                    <option value="">--Month--</option>
                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                        <option <?php if(isset($experience->month2) && $experience->month2 == $i) echo 'selected'; ?> value="<?php echo $i; ?>">
                            <?php echo DatetimeHelper::getMonthByNum($i); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 experience-till">
                <input type="text" class="form-control" name="inputs[year2]" value="<?php if(!empty($experience->year2)) echo $experience->year2; ?>" placeholder="Year" />
            </div>
            <div class="col-md-4 experience-till-present">
                Till present
            </div>
        </div>

        <div class="row">
            <div class="col-md-5 col-md-offset-4">
                <label>Currently I am working here</label>
                <input type="checkbox" name="inputs[curr_working_place]"
                    <?php if(isset($experience->curr_working_place) && $experience->curr_working_place == 1) echo "checked"; ?> id="curr_working_place" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <label>Description</label>
                <textarea class="form-control" id="description" name="inputs[description]" rows="6">
                    <?php if(isset($experience->description)) echo $experience->description; ?>
                </textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <a href="">See Examples</a>
            </div>
        </div>

        <div class="margin-top"></div>
        <div class="row">
            <div class="col-md-9">
                <span>
                    <input type="submit" id="" value="Save" class="form-btn" />
                </span>
                    
                <span>
                    <input type="submit" id="" value="Cancel" class="form-btn" onclick="document.location.reload(); return false;" />
                </span>

                <?php if (isset($exp_id)) { ?>
                    <span>
                        <a href="<?php echo site_url("profile/remove-exp/{$exp_id}" . (isset($page_from) ? '/' . $page_from : ''))?>">
                            Remove this experience
                        </a>
                    </span>
                <?php } ?>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        var tillPresent = <?php echo (isset($experience->curr_working_place) && $experience->curr_working_place == 1) ? 'true' : 'false'; ?>

        $('.experience-till-present').css('display', 'none');

        if (tillPresent) {
            $('.experience-till').css('display', 'none');
            $('.experience-till-present').css('display', 'inherit');
        }

        $('input[name="inputs[curr_working_place]"]').on('change', function(e) {
            if ($(this).prop('checked') === true) {
                $('.experience-till').css('display', 'none');
                $('.experience-till-present').css('display', 'inherit');
            }
            else {
                $('.experience-till').css('display', 'inherit');
                $('.experience-till-present').css('display', 'none');
            }
        });
    })
</script>