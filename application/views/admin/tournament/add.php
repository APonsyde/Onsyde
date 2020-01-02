<?php $this->load->view('admin/layout/alert'); ?>
<div class="bg-body-light border-b">
	<div class="content py-5 text-center">
		<nav class="breadcrumb bg-body-light mb-0">
			<a class="breadcrumb-item" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
			<a class="breadcrumb-item" href="<?php echo site_url('tournament/listing'); ?>">Tournament</a>
			<span class="breadcrumb-item active">Add</span>
		</nav>
	</div>
</div>
<h2 class="content-heading">Tournament - Add</h2>
<form method="post">
	<div class="row gutters-tiny">
		<div class="col-md-4">
			<div class="list-group">
				<a href="<?php echo site_url('tournament/add'); ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Info</h5>
					</div>
					<p class="mb-1">Name, ground, sports of tournament.</p>
				</a>
				<a class="list-group-item list-group-item-action flex-column align-items-start disable">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Tournament Detailing</h5>
					</div>
					<p class="mb-1">Detailing, rules of tournament.</p>
				</a>
				<a class="list-group-item list-group-item-action flex-column align-items-start disable">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Tournament Image</h5>
					</div>
					<p class="mb-1">Upload image for the tournament.</p>
				</a>
				<a class="list-group-item list-group-item-action flex-column align-items-start disable">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Tournament Teams</h5>
                </div>
                <p class="mb-1">Team listing of tournament.</p>
            </a>
            <a class="list-group-item list-group-item-action flex-column align-items-start disable">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Tournament Individual Players</h5>
                </div>
                <p class="mb-1">Reserved Players listing of tournament.</p>
            </a>
			</div>
		</div>
		<div class="col-md-8">
			<div class="row gutters-tiny">
				<div class="col-md-12">
					<div class="block block-rounded block-themed">
						<div class="block-header bg-gd-primary">
							<h3 class="block-title">Basic Info</h3>
							<div class="block-options">
								<button type="submit" class="btn btn-sm btn-alt-primary">
									<i class="fa fa-save mr-5"></i>Add
								</button>
							</div>
						</div>
						<div class="block-content block-content-full">
							<div class="form-group row">
								<div class="col-md-12">
									<label class="form-control-label">Tournament Name <span class="text-danger">*</span></label>
									<input type="text" name="tournament_name" placeholder="Tournament Name" value="<?php echo $this->input->post('tournament_name') ?>" class="form-control">
									<?php echo form_error('tournament_name'); ?>
									<br>
								</div>
								<div class="col-md-12">
									<label class="form-control-label">Ground <span class="text-danger">*</span></label>
									<select class="form-control js-select2" name="ground_id" style="width: 100%;" data-placeholder="-- Choose --">
										<option value="">-- Choose --</option>
										<?php foreach ($grounds as $key => $ground) { ?>
											<option value="<?php echo $ground['id']; ?>"><?php echo $ground['ground_name']; ?></option>
										<?php } ?>
									</select>
									<br>
									<?php echo form_error('ground'); ?>
									<br>
								</div>
								<div class="col-md-12">
									<label class="form-control-label">Sport <span class="text-danger">*</span></label>
									<select class="form-control js-select2" name="sports_id" style="width: 100%;" data-placeholder="-- Choose --">
										<option value="">-- Choose --</option>
										<?php foreach ($sports as $key => $sport) { ?>
											<option value="<?php echo $sport['id']; ?>"><?php echo $sport['sport_name']; ?></option>
										<?php } ?>
									</select>
									<br>
									<?php echo form_error('sport'); ?>
									<br>
								</div>
								<br>
								<div class="col-md-12">
									<label class="form-control-label">Total Team<span class="text-danger">*</span></label>
									<input type="text" name="total_team" placeholder="Total team" value="<?php echo $this->input->post('total_team') ?>" class="form-control">
									<?php echo form_error('total_team'); ?>
									<br>
								</div> 
								<br>
								<div class="col-md-12">
									<label class="form-control-label">Per person in team<span class="text-danger">*</span></label>
									<input type="text" name="person_per_team" placeholder="Person per team" value="<?php echo $this->input->post('person_per_team') ?>" class="form-control">
									<?php echo form_error('person_per_team'); ?>
									<br>
								</div>
								<br>
									<div class="col-md-6">
										<div class="form-group">
											<label class="form-control-label">From Date <span class="text-danger">*</span></label>
											<input type="date" placeholder="Valid From Date" name="valid_from_date" value="<?php echo $this->input->post('valid_from_date') ?>" class="form-control">
											<?php echo form_error('valid_from_date'); ?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="form-control-label">To Date <span class="text-danger">*</span></label>
											<input type="date" placeholder="Valid To Date" name="valid_to_date" value="<?php echo $this->input->post('valid_to_date') ?>" class="form-control">
											<?php echo form_error('valid_to_date'); ?>
										</div>
									</div>
									<div class="col-md-12">
									<label class="form-control-label"> Type <span class="text-danger">*</span></label>
									<br>
									<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" id="tournament-open" name="open" value="0" checked>
											<span class="css-control-indicator"></span> Open
										</label>
										<label class="css-control css-control-secondary css-radio">
											<input type="radio" class="css-control-input" id="tournament-closed" name="open" value="1">
											<span class="css-control-indicator"></span> Closed
										</label>
									<br>
								</div> 
							</div>
						</div>
						<div class="block block-rounded block-themed">
							<div class="block-header bg-gd-primary">
								<h3 class="block-title">Status</h3>
								<div class="block-options">
									<button type="submit" class="btn btn-sm btn-alt-primary">
										<i class="fa fa-save mr-5"></i>Add
									</button>
								</div>
							</div>
							<div class="block-content block-content-full">
								<div class="form-group row">
									<label class="col-12">Active</label>
									<div class="col-12">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" id="tournament-active" name="inactive" value="0" checked>
											<span class="css-control-indicator"></span> Yes
										</label>
										<label class="css-control css-control-secondary css-radio">
											<input type="radio" class="css-control-input" id="tournament-inactive" name="inactive" value="1">
											<span class="css-control-indicator"></span> No
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
