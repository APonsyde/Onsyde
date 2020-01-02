	<?php $this->load->view('admin/layout/alert'); ?>
	<div class="bg-body-light border-b">
		<div class="content py-5 text-center">
			<nav class="breadcrumb bg-body-light mb-0">
				<a class="breadcrumb-item" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
				<a class="breadcrumb-item" href="<?php echo site_url('player/listing'); ?>">Players</a>
				<span class="breadcrumb-item active">Edit</span>
			</nav>
		</div>
	</div>
	<h2 class="content-heading">Player - <?php echo $player['full_name']; ?></h2>
	<div class="row gutters-tiny">
		<div class="col-md-4">
			<div class="list-group">
				<a href="<?php echo site_url('player/edit/'.$player['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Info</h5>
					</div>
					<p class="mb-1">Personal, contact info and status related to player.</p>
				</a> 
				<a href="<?php echo site_url('player/sport/'.$player['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Add Sport</h5>
					</div>
					<p class="mb-1">Add, edit or delete sport interest.</p>
				</a>
			</div>
		</div>
		<div class="col-md-8">
			<form method="post">
				<input type="hidden" name="type" value="add">
				<div class="row gutters-tiny">
					<div class="col-md-12">
						<div class="block block-rounded block-themed">
							<div class="block-header">
								<h3 class="block-title">Basic Sports Info</h3>
								<div class="block-options">
									<button type="submit" class="btn btn-sm btn-alt-primary">
										<i class="fa fa-save mr-5"></i>Add
									</button>
								</div>
							</div>
							<div class="block-content block-content-full">
								<div class="col-md-12">
									<div class="form-group">
										<label class="form-control-label">Add Sport <span class="text-danger">*</span></label>
										<select class="form-control js-select2" name="sports_id" style="width: 100%;" data-placeholder="-- Choose --" onchange="changeValue(this);">
											<option value="">-- Choose --</option>
											<?php foreach ($sports as $key => $sport) { ?>
												<option value="<?php echo $sport['id']; ?>"><?php echo $sport['sport_name']; ?></option>
											<?php } ?>
										</select>
										<br>
										<?php echo form_error('sports_id'); ?>
									</div>
								</div> 
								<?php foreach ($sports as $key => $sport) { ?>
									<?php
									$show = 'd-none';
									if($this->input->post('sports_id') == $sport['id']) {
										$show = '';
									}
									?>
									<div class="col-md-12 <?php echo $show; ?> sport-skills sport-skills-<?php echo $sport['id']; ?>">
										<div class="form-group">
											<label class="form-control-label">Skills </label>
											<?php foreach ($sport['skills'] as $key => $skill) { ?>
												<br>
												<input type="checkbox" name="skills[]" value="<?php echo $skill['id'] ?>">&nbsp;&nbsp;<?php echo $skill['skill_set_name'] ?>
											<?php } ?>
											<?php echo form_error('sport'); ?>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</form>
			<form method="post">
				<input type="hidden" name="type" value="edit">
				<div class="row gutters-tiny">
					<div class="col-md-12">
						<div class="block block-rounded block-themed">
							<div class="block-header">
								<h3 class="block-title">Saved sports and skill set listings</h3>
								<div class="block-options">
									<button type="submit" class="btn btn-sm btn-alt-primary">
										<i class="fa fa-save mr-5"></i>Update
									</button>
								</div>
							</div>
							<div class="block-content block-content-full ">
								<div class="col-md-14 ">
									<table class="table table-bordered table-striped table-vcenter js-dataTable-full dataTable no-footer">
										<thead>
											<?php foreach ($player_sports as $key => $player_sport) { ?>
												<tr class="border-double">
													<th> Sports and Skill Sets</th>
													<th class="text-left "> Action </th>
												</tr>
											</thead>
											<tr>
												<td> 
													<label class="form-control-label font-weight-bold" style="width: 100%;"><?php echo $player_sport['sport']; ?></label>
													<?php foreach ($player_sport['skills'] as $key => $skill) { ?>
														<?php $checked = ''; ?>
														<?php foreach ($player_sport_skill as $key => $pss) { ?>
															<?php if($pss['sport_skill_set_id'] == $skill['id']) { ?>
																<?php $checked = 'checked'; ?>
															<?php } ?>
														<?php } ?>
														<input type="checkbox" name="player_sport_skills[<?php echo $player_sport['id'] ?>][]" value="<?php echo $skill['id'] ?>" <?php echo $checked; ?>>&nbsp;&nbsp;<?php echo $skill['skill_set_name'] ?>
														<br>
													<?php } ?>
												</td>
												<td>
													<a class="float-left btn-sm btn btn-alt-danger delete-confirm" href="<?php echo site_url('player/delete-sport/'.$player_sport['id']); ?>">
														<i class="fa fa-trash fa"></i>
														Delete
													</a>
												</td>
											</tr>
										<?php } ?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</form>
<script>
	function changeValue(field) {
		$("div.sport-skills").addClass("d-none");
		$("div.sport-skills-"+field.value).removeClass("d-none");
	}
</script>