<div class="col-md-7 form-group">
	<div class="row">
		<div class="col-md-3 <?php echo $class?>">
			Title
		</div>
		<div class="col-md-9">
			<input type="text" value="" name="title" class="form-control"
				id="title">
		</div>
	</div>


</div>

<div class="col-md-7 form-group">
	<div class="row">
		<div class="col-md-3 <?php echo $class?>">
			Select Category
		</div>
		<div class="col-md-9">
			<select id="category" name="category" class="form-control">
						<?php
    $resultset = $this->db->get('job_categories');
    $categories = $resultset->result();
    
    if ($categories) {
        foreach ($categories as $category) {
            ?>
						        <optgroup label="<?php echo $category->category_name;?>">
						        <?php
            $subcat_resultset = $this->db->get_where('job_subcategories', [
                'cat_id' => $category->cat_id
            ]);
            $subcategory_data = $subcat_resultset->result();
            
            if ($subcategory_data) {
                foreach ($subcategory_data as $subcat) {
                    ?>
						                  <option value="<?php echo $subcat->subcat_id?>"><?php echo $subcat->subcategory_name?></option>
						              <?php
                }
            }
            ?>
						        
						        </optgroup>
						    <?php
        }
    }
    ?>
							</select>
		</div>
	</div>
</div>

<div class="col-md-7 form-group">
	<div class="row">
		<div class="col-md-3 <?php echo $class?>">
			Required Skills
		</div>
		<div class="col-md-9">
			<input type="text" value="" name="skills" class="form-control"
				id="title">
		</div>
	</div>
</div>

<div class="col-md-7 form-group">
	<div class="row">
		<div class="col-md-3 <?php echo $class?>">
			Job Description
		</div>
		<div class="col-md-9">
			<textarea name="job_description" id="job_description"
				class="form-control" rows="5"></textarea>
		</div>
	</div>
</div>

<div class="col-md-7 form-group">
	<div class="row">
		<div class="col-md-3 <?php echo $class?>">
			Upload File
		</div>
		<div class="col-md-9">
			<input type="file" value="" name="userfile" class="" id="user_file">
		</div>
	</div>
</div>

<div class="col-md-7 form-group">
	<div class="row">
		<div class="col-md-3 margin-top <?php echo $class?>">
			Job Type
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-1 radio margin-left-1">
					<input type="radio" value="hourly" name="job_type"
						class="form-control" id="title" checked="checked">
				</div>
				<div class="col-md-12 col-md-offset-1">
					<label>Hourly - Pay by the hour verify with the work diary</label>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1 radio margin-left-1">
					<input type="radio" value="fixed" name="job_type"
						class="form-control" id="title">
				</div>
				<div class="col-md-12 col-md-offset-1">
					<label>Fixed - Pay by the project requires Detailed specifications</label>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="col-md-7 form-group">
	<div class="row">
		<div class="col-md-3 <?php echo $class?>">
			Experience Level
		</div>
		<div class="col-md-9">
			<input type="radio" name="experience_level" id="experience_level"
				value="entry_levle" /> <label>Entry Level</label> <span
				class="dollar-sign">$</span> <input type="radio"
				name="experience_level" id="experience_level" value="intermediate" />
			<label>Intermediate</label> <span class="dollar-sign">$$</span> 
			
			<?php if(isset($mode) && $mode== 'invitation') {?> <br/> <?php } ?>
			 <input
				type="radio" name="experience_level" id="experience_level"
				value="experienced" /> <label>Experienced</label> <span
				class="dollar-sign">$$$</span>

		</div>
	</div>
</div>

<div class="col-md-7 form-group hidden" id="fixed-control">
	<div class="row">
		<div class="col-md-3 <?php echo $class?>">
			Budget
		</div>
		<div class="col-md-9">
			<span class="dollar-sign">$</span> <input type="text" name="budget"
				id="budget" value="" class="" />
		</div>
	</div>
</div>

<div class="col-md-7 form-group" id="hourly-control">
	<div class="row">
		<div class="col-md-3 <?php echo $class?>">
			Hours Per week
		</div>
		<div class="col-md-9">
			<select class="form-control" name="hours_per_week">
				<option value="not_sure">Not Sure</option>
				<option value="1-9">1-9</option>
				<option value="10-19">10-19</option>
				<option value="20-29">20-29</option>
				<option value="30-39">30-39</option>
				<option value="40_plus">More than 40</option>
			</select>
		</div>
	</div>
</div>

<div class="col-md-7 form-group">
	<div class="row">
		<div class="col-md-3 <?php echo $class?>">
			Job Duration
		</div>
		<div class="col-md-9">
			<select class="form-control" name="job_duration">
				<option value="not_sure">Not Sure</option>
				<option value="more_than_6_months">More than 6 Months</option>
				<option value="3_6_months">3 - 6 Months</option>
				<option value="1_3_months">1 - 3 Months</option>
				<option value="less_than_1_months">Less than 1 Month</option>
				<option value="less_than_1_week">Less than 1 Week</option>
			</select>
		</div>
	</div>
</div>