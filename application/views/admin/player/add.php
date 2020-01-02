	<?php $this->load->view('admin/layout/alert'); ?>
	<div class="bg-body-light border-b">
		<div class="content py-5 text-center">
			<nav class="breadcrumb bg-body-light mb-0">
				<a class="breadcrumb-item" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
				<a class="breadcrumb-item" href="<?php echo site_url('player/listing'); ?>">Players</a>
				<span class="breadcrumb-item active">Add</span>
			</nav>
		</div> 
	</div>
	<h2 class="content-heading">Player - Add</h2>
	<form method="post">
		<div class="row gutters-tiny">
			<div class="col-md-4">
				<div class="list-group">
					<a href="<?php echo site_url('player/add'); ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
						<div class="d-flex w-100 justify-content-between">
							<h5 class="mb-1">Info</h5>
						</div>
						<p class="mb-1">Personal, contact info and status related to player.</p>
					</a>
					<a  class="list-group-item list-group-item-action flex-column align-items-start">
						<div class="d-flex w-100 justify-content-between disabled">
							<h5 class="mb-1">Sports</h5>
						</div>
						<p class="mb-1">Personal, contact info and status related to player.</p>
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
									<div class="col-md-4">
										<label class="form-control-label">First Name <span class="text-danger">*</span></label>
										<input type="text" name="first_name" placeholder="First Name" value="<?php echo $this->input->post('first_name') ?>" class="form-control">
										<?php echo form_error('first_name'); ?>
									</div>
									<div class="col-md-4">
										<label class="form-control-label">Last Name <span class="text-danger">*</span></label>
										<input type="text" name="last_name" placeholder="Last Name" value="<?php echo $this->input->post('last_name') ?>" class="form-control">
										<?php echo form_error('last_name'); ?>
									</div>
									<div class="col-md-4">
										<label class="form-control-label">User Name </label>
										<input type="text" name="username" placeholder="User Name" value="<?php echo $this->input->post('username') ?>" class="form-control">
										<?php echo form_error('username'); ?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12">
										<label class="form-control-label">Date Of Birth</label>
										<input type="date" name="date_of_birth" placeholder="Date Of Birth" value="<?php echo $this->input->post('date_of_birth') ?>" class="form-control">
										<?php echo form_error('date_of_birth'); ?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12">
										<label class="form-control-label">Gender</label>
										<select class="form-control js-select2" name="gender" style="width: 100%;" data-placeholder="-- Choose --">
											<option value="">-- Choose --</option>
											<option value="male" <?php echo ($this->input->post('gender') == "male") ? "selected" : ""; ?>>Male</option>
											<option value="female" <?php echo ($this->input->post('gender') == "female") ? "selected" : ""; ?>>Female</option>
											<option value="other" <?php echo ($this->input->post('gender') == "other") ? "selected" : ""; ?>>Other</option>
										</select>
										<?php echo form_error('gender'); ?>
									</div>
								</div>
							</div>
							<div class="block block-rounded block-themed">
								<div class="block-header bg-gd-primary">
									<h3 class="block-title">Contact</h3>
									<div class="block-options">
										<button type="submit" class="btn btn-sm btn-alt-primary">
											<i class="fa fa-save mr-5"></i>Add
										</button>
									</div>
								</div>
								<div class="block-content block-content-full">
									<div class="form-group row">
										<div class="col-12">
											<label class="form-control-label">Email <span class="text-danger">*</span></label>
											<input type="text" name="email" placeholder="Email" value="<?php echo $this->input->post('email') ?>" class="form-control">
											<?php echo form_error('email'); ?>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12">
											<label class="form-control-label">Mobile</label>
											<input type="text" name="mobile" placeholder="Mobile" value="<?php echo $this->input->post('mobile') ?>" class="form-control">
											<?php echo form_error('mobile'); ?>
										</div>
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
												<input type="radio" class="css-control-input" id="player-active" name="inactive" value="0" checked>
												<span class="css-control-indicator"></span> Yes
											</label>
											<label class="css-control css-control-secondary css-radio">
												<input type="radio" class="css-control-input" id="player-inactive" name="inactive" value="1">
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