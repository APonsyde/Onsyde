<?php $this->load->view('admin/layout/alert'); ?>
<div class="bg-body-light border-b">
	<div class="content py-5 text-center">
		<nav class="breadcrumb bg-body-light mb-0">
			<a class="breadcrumb-item" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
			<a class="breadcrumb-item" href="<?php echo site_url('tournament/listing'); ?>">Tournament</a>
			<span class="breadcrumb-item active">Edit</span>
		</nav>
	</div>
</div>
<h2 class="content-heading">tournament - <?php echo $tournament['tournament_name']; ?></h2>
<form method="post">
	<div class="row gutters-tiny">
		<div class="col-md-4">
			<div class="list-group">
				<a href="<?php echo site_url('tournament/edit/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Info</h5>
					</div>
					<p class="mb-1">Name, ground, sports of tournament.</p>
				</a>
				<a href="<?php echo site_url('tournament/detailing/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Tournament Detailing</h5>
					</div>
					<p class="mb-1">Detailing, rules of tournament.</p>
				</a>
				<a href="<?php echo site_url('tournament/images/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start ">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Tournament Images</h5>
					</div>
					<p class="mb-1">Upload images for the tournament.</p>
				</a>
				<a href="<?php echo site_url('tournament/teams/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
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
						<div class="block-content block-content-full">
							<h5> Team :  
							</h2>
							<div class="table-responsive">
								<table class="table table-striped table-vcenter">
									<thead>
										<tr class="border-double">
											<th>#</th>
											<th>Player listing</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($tournament_team_players)) { ?>
											<?php foreach($tournament_team_players as  $tournament_team_player) { ?>
												<tr>
													<th scope="row"><?php echo $tournament_team_player['id']; ?></th>
													<th scope="row"><?php echo $tournament_team_player['player_id']; ?></th>
												</tr>         
											<?php } ?>
										<?php } else { ?>
											<tr>
												<td colspan="3">No Players added yet.</td>
											</tr>	
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>