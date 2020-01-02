<?php $this->load->view('admin/layout/alert'); ?>
<div class="bg-body-light border-b">
	<div class="content py-5 text-center">
		<nav class="breadcrumb bg-body-light mb-0">
			<a class="breadcrumb-item" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
			<a class="breadcrumb-item" href="<?php echo site_url('sport/listing'); ?>">Sports</a>
			<span class="breadcrumb-item active">Edit</span>
		</nav>
	</div>
</div>
<h2 class="content-heading">Sport - Edit</h2>
<form method="post">
	<div class="row gutters-tiny">
		<div class="col-md-4">
			<div class="list-group">
				<a href="<?php echo site_url('sport/edit/'.$sport['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Info</h5>
					</div>
					<p class="mb-1">Personal, contact info and status related to Sport.</p>
				</a>
				<a href="<?php echo site_url('sport/sport_skill_set/'.$sport['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Skill Sets</h5>
                    </div>
                    <p class="mb-1">Manage Sport Skill Sets.</p>
                </a>
                <a href="<?php echo site_url('sport/images/'.$sport['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Sport Icon</h5>
					</div>
					<p class="mb-1">Upload icon for the Sport.</p>
				</a>
				<a href="<?php echo site_url('sport/rules/'.$sport['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start ">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Sport Rules</h5>
                    </div>
                    <p class="mb-1">Add rules for the Sport.</p>
                </a>
			</div>
		</div>
		<div class="col-md-8">
			<div class="row gutters-tiny">
				<div class="col-md-12">
					<div class="block block-rounded block-themed">
						<div class="block-header">
							<h3 class="block-title">Basic Info</h3>
							<div class="block-options">
								<button type="submit" class="btn btn-sm btn-alt-primary">
									<i class="fa fa-save mr-5"></i>Save
								</button>
							</div>
						</div>
						<div class="block-content block-content-full">
							<div class="form-group row">
								<div class="col-md-12">
									<label class="form-control-label">Sport Name <span class="text-danger">*</span></label>
									<input type="text" name="sport_name" placeholder="Sport Name" value="<?php echo ($this->input->post('sport_name')) ? $this->input->post('sport_name') : $sport['sport_name']; ?>" class="form-control">
									<?php echo form_error('sport_name'); ?>
									<br>
								</div>
							</div>
						</div>
							<div class="block block-rounded block-themed">
								<div class="block-header">
									<h3 class="block-title">Status</h3>
									<div class="block-options">
										<button type="submit" class="btn btn-sm btn-alt-primary">
											<i class="fa fa-save mr-5"></i>Save
										</button>
									</div>
								</div>
								<div class="block-content block-content-full">
									<div class="form-group row">
										<label class="col-12">Active</label>
										<div class="col-12">
											<label class="css-control css-control-primary css-radio">
												<input type="radio" class="css-control-input" id="sport-active" name="inactive" value="0" <?php echo ($this->input->post('inactive') == "0" || $sport['inactive'] == "0") ? "checked" : ""; ?>>
												<span class="css-control-indicator"></span> Yes
											</label>
											<label class="css-control css-control-secondary css-radio">
												<input type="radio" class="css-control-input" id="sport-inactive" name="inactive" value="1" <?php echo ($this->input->post('inactive') == "1" || $sport['inactive'] == "1") ? "checked" : ""; ?>>
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
		</form>