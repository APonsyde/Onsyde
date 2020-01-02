<?php if($this->session->flashdata('success_message')) { ?>
	<div class="alert alert-success mb-4">
		<?php echo $this->session->flashdata('success_message'); ?>
	</div>
<?php } ?>
<?php if($this->session->flashdata('error_message')) { ?>
	<div class="alert alert-danger mb-4">
		<?php echo $this->session->flashdata('error_message'); ?>
	</div>
<?php } ?>
<?php if($this->session->flashdata('info_message')) { ?>
	<div class="alert alert-info mb-4">
		<?php echo $this->session->flashdata('info_message'); ?>
	</div>
<?php } ?>
<?php if($this->session->flashdata('warning_message')) { ?>
	<div class="alert alert-warning mb-4">
		<?php echo $this->session->flashdata('warning_message'); ?>
	</div>
<?php } ?>