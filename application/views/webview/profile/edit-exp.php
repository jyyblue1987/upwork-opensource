<form id="form" action="<?=base_url()?>profile/add_experience/<?php if(isset($exp_id))echo $exp_id; ?>    <?php if(isset($page_from)) echo '/'.$page_from; ?>" method="post" name="experience">
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
                    <option <?php if(isset($experience->month1) && $experience->month1 == "1") echo 'selected'; ?> value="01">January</option>
                    <option <?php if(isset($experience->month1) && $experience->month1 == "2") echo 'selected'; ?> value="02">February</option>
                    <option <?php if(isset($experience->month1) && $experience->month1 == "3") echo 'selected'; ?> value="03">March</option>
                    <option <?php if(isset($experience->month1) && $experience->month1 == "4") echo 'selected'; ?> value="04">April</option>
                    <option <?php if(isset($experience->month1) && $experience->month1 == "5") echo 'selected'; ?> value="05">May</option>
                    <option <?php if(isset($experience->month1) && $experience->month1 == "6") echo 'selected'; ?> value="06">June</option>
                    <option <?php if(isset($experience->month1) && $experience->month1 == "7") echo 'selected'; ?> value="07">July</option>
                    <option <?php if(isset($experience->month1) && $experience->month1 == "8") echo 'selected'; ?> value="08">August</option>
                    <option <?php if(isset($experience->month1) && $experience->month1 == "9") echo 'selected'; ?> value="09">September</option>
                    <option <?php if(isset($experience->month1) && $experience->month1 == "10") echo 'selected'; ?> value="10">October</option>
                    <option <?php if(isset($experience->month1) && $experience->month1 == "11") echo 'selected'; ?> value="11">November</option>
                    <option <?php if(isset($experience->month1) && $experience->month1 == "12") echo 'selected'; ?> value="12">December</option>
                </select>
            </div>
            <div class="col-md-2">
                    <input type="text" class="form-control" name="inputs[year1]" value="<?php if(isset($experience->year1)) echo $experience->year1; ?>" placeholder="Year" />
            </div>
            <div class="col-md-2">
                <select name="inputs[month2]" class="form-control">
                    <option value="">--Month--</option>
                    <option <?php if(isset($experience->month2) && $experience->month1 == "1") echo 'selected'; ?> value="01">January</option>
                    <option <?php if(isset($experience->month2) && $experience->month1 == "2") echo 'selected'; ?>value="02">February</option>
                    <option <?php if(isset($experience->month2) && $experience->month1 == "3") echo 'selected'; ?>value="03">March</option>
                    <option <?php if(isset($experience->month2) && $experience->month1 == "4") echo 'selected'; ?>value="04">April</option>
                    <option <?php if(isset($experience->month2) && $experience->month1 == "5") echo 'selected'; ?>value="05">May</option>
                    <option <?php if(isset($experience->month2) && $experience->month1 == "6") echo 'selected'; ?>value="06">June</option>
                    <option <?php if(isset($experience->month2) && $experience->month1 == "7") echo 'selected'; ?>value="07">July</option>
                    <option <?php if(isset($experience->month2) && $experience->month1 == "8") echo 'selected'; ?>value="08">August</option>
                    <option <?php if(isset($experience->month2) && $experience->month1 == "9") echo 'selected'; ?>value="09">September</option>
                    <option <?php if(isset($experience->month2) && $experience->month1 == "10") echo 'selected'; ?>value="10">October</option>
                    <option <?php if(isset($experience->month2) && $experience->month1 == "11") echo 'selected'; ?>value="11">November</option>
                    <option <?php if(isset($experience->month2) && $experience->month1 == "12") echo 'selected'; ?>value="12">December</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="inputs[year2]" value="<?php if(isset($experience->year2)) echo $experience->year2; ?>" placeholder="Year" />
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
                    <input type="submit" name="" id="" value="Save" class="form-btn" />
                </span>
                    
                <span>
                    <input type="submit" name="" id="" value="Cancel" class="form-btn" />
                </span>

                <span>
                    <a href="<?php echo site_url("profile/remove-exp/{$exp_id}")?>">
                        Remove this experience
                    </a>
                </span>
            </div>
        </div>
    </div>
</form>