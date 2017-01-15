<?php
//Alert message block
if(@$_SESSION['success_message']!=''){ ?>
	<div class="alert alert-success alert-dismissable">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		<?=$_SESSION['success_message']?>
	</div>
<?php $_SESSION['success_message']='';
} 
if(@$_SESSION['global_error']!=''){ ?>
	<div class="alert alert-danger alert-dismissable">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		<?=$_SESSION['global_error']?>
	</div>
<?php 
$_SESSION['global_error']='';
} 
//Alert message block end
?>