<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Booking - #<?php echo $booking['booking_key']; ?></h4>
        </div>
    </div>          
</div>
<div class="contentbar">                
    <div class="row">
        <div class="col-lg-12">
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
	                            		<td></td>
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
			                            			<button class="btn btn-primary">Reinvite</button>
			                            		<?php } ?>
		                            			<button class="btn btn-primary">Remove</button>
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
	                            		<td></td>
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
	                            		<td></td>
	                            	</tr>
	                        	</thead>
	                            <tbody>
	                            	<?php foreach ($recent_players as $key => $recent_player) { ?>
		                            	<tr>
		                            		<td><?php echo $recent_player['name']; ?></td>
		                            		<td><?php echo $recent_player['mobile']; ?></td>
		                            		<td><button class="btn btn-primary">Invite</button></td>
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