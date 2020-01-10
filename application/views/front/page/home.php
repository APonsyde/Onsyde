<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Find your next game.</h4>
        </div>
    </div>          
</div>
<div class="contentbar">
	<?php $this->load->view('front/layout/alert'); ?>
	<div class="card m-b-30">
        <div class="card-header">
            <h5 class="card-title">I'm looking to play on</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo site_url('find-a-turf'); ?>">
                <div class="form-group">
                    <?php $days = get_upcoming_days();?>
                    <select class="form-control" name="date">
						<?php foreach ($days as $key => $day) { ?>
							<option value="<?php echo $key; ?>" <?php echo ($this->input->get('date') == $key) ? 'selected' : ''; ?>><?php echo $day; ?></option>
						<?php } ?>
					</select>
                </div>
				<button class="btn btn-success">FIND</button>
            </form>
        </div>
    </div>
</div>