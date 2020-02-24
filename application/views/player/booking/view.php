<section class="main-block howit-work-wrap">
    <div class="container-fluid">
        <div class="row justify-content-center">
        	<div class="col-md-12">
        		<h4 class="page-title mb-3">Booking - #<?php echo $booking['booking_key']; ?></h4>
                <?php if(!empty($invited_players)) { ?>
		        	<div class="card m-b-30">
		                <div class="card-header">
		                	Invited Players
		                </div>
		                <div class="card-body">
		                    <div class="table-responsive">
		                        <table class="table">
		                        	<thead>
		                        		<tr>
		                        			<td></td>
		                            		<td>Name</td>
		                            		<td>Mobile</td>
		                            		<td width="20%"></td>
		                            	</tr>
		                        	</thead>
		                            <tbody>
		                            	<?php foreach ($invited_players as $key => $invited_player) { ?>
			                            	<tr>
			                            		<td>
			                            			<?php
			                            				if($invited_player['status'] == 'accepted')
			                            					$status = 'check';
			                            				elseif($invited_player['status'] == 'rejected')
			                            					$status = 'times';
			                            				else
			                            					$status = 'reply';
			                            			?>
			                            			<i class="fa fa-<?php echo $status; ?>"></i>
			                            		</td>
			                            		<td><?php echo $invited_player['name']; ?></td>
			                            		<td><?php echo $invited_player['mobile']; ?></td>
			                            		<td>
			                            			<?php if($invited_player['status'] == 'invited') { ?>
				                            			<a class="btn btn-primary" href="<?php echo site_url('booking/invite-resend/'.$invited_player['id']); ?>">Reinvite</a>
				                            		<?php } ?>
			                            			<a class="btn btn-primary" href="<?php echo site_url('booking/invite-remove/'.$invited_player['id']); ?>">Remove</a>
			                            		</td>
			                            	</tr>
			                            <?php } ?>
		                            </tbody>
		                        </table>
		                    </div>
		                </div>
		            </div>
		        <?php } ?>
	            <div class="card m-b-30">
	                <div class="card-header">
	                	Invite New Players
	                </div>
	                <div class="card-body">
	                	<form method="post">
		                    <div class="table-responsive">
		                        <table class="table">
		                        	<thead>
		                        		<tr>
		                            		<td>Name</td>
		                            		<td>Mobile</td>
		                            		<td width="20%"></td>
		                            	</tr>
		                        	</thead>
		                            <tbody>
		                            	<tr>
		                            		<td><input placeholder="name" name="name" type="text" class="form-control"></td>
		                            		<td><input placeholder="mobile" name="mobile" type="number" class="form-control"></td>
		                            		<td><button class="btn btn-primary">Invite</button></td>
		                            	</tr>
		                            </tbody>
		                        </table>
		                    </div>
		                </form>
	                </div>
	            </div>
	        	<?php if(!empty($recent_players)) { ?>
		            <div class="card m-b-30">
		                <div class="card-header">
		                	Recent Players
		                </div>
		                <div class="card-body">
		                    <div class="table-responsive">
		                        <table class="table">
		                        	<thead>
		                        		<tr>
		                            		<td>Name</td>
		                            		<td>Mobile</td>
		                            		<td width="20%"></td>
		                            	</tr>
		                        	</thead>
		                            <tbody>
		                            	<?php foreach ($recent_players as $key => $recent_player) { ?>
			                            	<tr>
			                            		<td><?php echo $recent_player['name']; ?></td>
			                            		<td><?php echo $recent_player['mobile']; ?></td>
			                            		<td><a class="btn btn-primary" href="<?php echo site_url('booking/invite-add/'.$recent_player['id'].'/'.$booking['id']); ?>">Invite</a></td>
			                            	</tr>
			                            <?php } ?>
		                            </tbody>
		                        </table>
		                    </div>
		                </div>
		            </div>
		        <?php } ?>
            </div>
        </div>
    </div>
</section>