<form id="form" action="<?=base_url()?>profile/add_education" method="post" name="education">
    <div class="margin-top"></div>

    <div class="row">
        <div class="col-md-9">
            <span>School</span><br /> <input type="text" class="form-control" name="school" placeholder="School" value="<?php echo empty($education['school']) ? '' : $education['school'];?>" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <span>Dates Attended</span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <select name="year3" class="form-control">
                <option value="">--Year--</option>
                <?php for ($i = 1980; $i <= 2030; $i++) { ?>
                    <option value="<?php echo $i;?>" <?php echo ((!empty($education['dates_attend_from']) && (int)$education['dates_attend_from'] === (int)$i) ? 'selected' : '')?>><?php echo $i;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-1">-</div>
        <div class="col-md-2">
            <select name="year4" class="form-control">
                <option value="">--Year--</option>
                <?php for($i=1980; $i<=2030; $i++){?>
                <option value="<?php echo $i;?>" <?php echo (!empty($education['dates_attend_to']) && (int)$education['dates_attend_to'] === (int)$i ? 'selected' : '')?>><?php echo $i;?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <span>Degree</span>
            <br />
            <input type="text" class="form-control" name="degree" placeholder="Degree" value="<?php echo empty($education['degree']) ? '' : $education['degree'];?>" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <span>Field of Study</span>
            <br />
            <input type="text" name="field_of_study" class="form-control" placeholder="Field of Study" value="<?php echo empty($education['field_of_study']) ? '' : $education['field_of_study'];?>" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <span>Grade</span>
            <br />
            <input type="text" class="form-control" name="grade" placeholder="Grade" value="<?php echo empty($education['grade']) ? '' : $education['grade'];?>" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <span>Activities and Socities</span><br />
            <textarea name="activities" rows="6" cols="" class="form-control"><?php echo empty($education['activities']) ? '' : $education['activities'];?></textarea>
            <br /> Examples : Alpha Phi Omega, Chember Chorai, Debate Team
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <span>Description</span><br />
            <textarea name="description" rows="6" cols="" class="form-control"><?php echo empty($education['description']) ? '' : $education['description'];?></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <span><a href="">See Examples</a></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <input id="next" class="btn btn-primary form-btn" type="submit" value="Save"> 
            <input id="next" class="btn btn-primary form-btn" type="submit" value="Cancel" onclick="document.location.reload(); return false;">
            <a href="<?php echo site_url("profile/remove-edu/{$edu_id}" . (isset($page_from) ? '/' . $page_from : ''))?>">
                Remove this education
            </a>
        </div>
    </div>
</form>