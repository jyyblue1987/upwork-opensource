<section id="big_header"	style="margin-top: 50px; margin-bottom: 50px; height: auto;">

	<div class="container">
		<div class="row margin-left-4">
			
			<ul class="notification_endjob">
				<?php foreach($job_end_data as $data) {
					if($data->hire_title !=""){
						$job_title = $data->hire_title;
					}else{
						$job_title = $data->title;
					}
					if($data->job_type == "hourly"){?>
					<li>
						<div class="col-md-8 margin-left-10">
							<a href="<?php echo base_url() ?>feedback/hourly_client?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->feedback_userid);?>"> <b><?=$job_title?></b></a>
							
						</div>
					</li>
					<?php } else { ?>
					<li>
						<div class="col-md-8 margin-left-10">
								<a href="<?php echo base_url() ?>feedback/fixed_client?fmJob=<?php echo base64_encode($data->job_id);?>&fuser=<?php echo base64_encode($data->feedback_userid);?>"> <b><?=$job_title?></b></a>
							</div>
					</li>
					<?php }  }?>
			</ul>
			

		</div>
	</div>

</section>
</div>

</section>


<style>
	.row.margin-left-4 .notification_endjob li {
  background: #ddd none repeat scroll 0 0;
  display: inline-flex;
  margin-top: 5px;
  padding: 14px;
  width: 100%;
}
</style>
