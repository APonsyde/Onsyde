<?php $this->load->view('admin/layout/alert'); ?>
<div class="bg-body-light border-b">
	<div class="content py-5 text-center">
		<nav class="breadcrumb bg-body-light mb-0">
			<a class="breadcrumb-item" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
			<a class="breadcrumb-item" href="<?php echo site_url('tournament/listing'); ?>">Tournament</a>
			<span class="breadcrumb-item active">Detailing</span>
		</nav>
	</div>
</div>
<h2 class="content-heading">tournament - <?php echo $tournament['tournament_name']; ?> </h2>
<form method="post" enctype="multipart/form-data">
	<div class="row gutters-tiny">
		<div class="col-md-4">
			<div class="list-group">
				<a href="<?php echo site_url('tournament/edit/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Info</h5>
					</div>
					<p class="mb-1">Name, ground, sports of tournament.</p>
				</a>
				<a href="<?php echo site_url('tournament/detailing/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Tournament Detailing</h5>
					</div>
					<p class="mb-1">Detailing, rules of tournament.</p>
				</a>
				<a href="<?php echo site_url('tournament/images/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Tournament Image</h5>
					</div>
					<p class="mb-1">Upload image for the tournament.</p>
				</a>
				<a href="<?php echo site_url('tournament/teams/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Tournament Teams</h5>
                </div>
                <p class="mb-1">Team listing of tournament.</p>
            </a>
            <a href="<?php echo site_url('tournament/players/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
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
						<div class="block-header">
							<h3 class="block-title">Add Logo and Details</h3>
							<div class="block-options">
								<button type="submit" class="btn btn-sm btn-alt-primary">
									<i class="fa fa-save mr-5"></i>Save
								</button>
							</div>
						</div>
						<div class="block-content block-content-full">
							<div class="form-group row">
								<div class="col-md-12">
									<label class="form-control-label">Tournament Detailing </label>
									<textarea class="form-control ckeditor" name="detailing" placeholder="Detailing" rows="8"><?php echo ($this->input->post('detailing')) ? $this->input->post('detailing') : $tournament['detailing']; ?></textarea>
									<?php echo form_error('detailing'); ?>
									<br>
								</div>
							</div>
						</div>
						<div class="block block-rounded block-themed">
							<div class="block-header">
								<h3 class="block-title">Rules</h3>
								<div class="block-options">
									<button type="submit" class="btn btn-sm btn-alt-primary">
										<i class="fa fa-save mr-5"></i>Save
									</button>
								</div>
							</div>
							<div class="block-content block-content-full">
								<div class="form-group row">
									<div class="col-md-12">
										<label class="form-control-label">Select rules below</label>
										<br>
										<?php $inputs = []; ?>
										<?php foreach ($rules as $rule) {
												$checked = '';
                        						$rule_str = '';
												$input = "<input type='text' name='rules[".$rule['id']."][value][]'>";
												foreach ($tournament_rules as $key => $tournament_rule) {
													if($tournament_rule['sport_rule_id'] == $rule['id']) {
														$checked = 'checked';
														$values = @json_decode($tournament_rule['value']);
						                                $rule_data = explode("{}", $rule['name']);
						                                foreach ($rule_data as $key => $rd) {
						                                    $rule_str .= $rd;
						                                    if(!empty($values[$key]))
						                                        $rule_str .= "<input type='text' name='rules[".$rule['id']."][value][]' value='".$values[$key]."'>";
						                                }
														break;
													}
												}
												$inputs[] = [
													'rule' => $rule['id'],
													'checked' => $checked,
													'value' => strlen($rule_str) ? $rule_str : str_replace("{}", $input, $rule['name'])
												];
											}
										?>
										<?php foreach ($inputs as $key => $input) { ?>
						                    <input type="checkbox" name="rules[<?php echo $input['rule'] ?>][checked]" value="1" <?php echo $input['checked']; ?>>&nbsp;&nbsp;&nbsp;<?php echo $input['value']; ?><br>
						                    <?php echo form_error('name'); ?>
						                <?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>