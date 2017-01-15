<?php if($this->session->flashdata('action_msg_error')) {?>
<br/><div class="alert alert-danger"><?php echo $this->session->flashdata('action_msg_error')?></div>
<?php } ?>

<?php if($this->session->flashdata('action_msg_success')) {?>
<br/><div class="alert alert-success"><?php echo $this->session->flashdata('action_msg_success')?></div>
<?php } ?>