<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>          
</div>
<div class="contentbar">
    <div class="row align-items-center">
		<div class="col-lg-4 col-xl-4">
	        <div class="card m-b-30">
            	<form id="dayForm">
		            <div class="card-body">
		                <div class="media">
							<?php $days = get_upcoming_days();?>
		                    <select class="form-control" name="date" onchange="document.getElementById('dayForm').submit();">
								<?php foreach ($days as $key => $day) { ?>
									<option value="<?php echo $key; ?>" <?php echo ($this->input->get('date') == $key) ? 'selected' : ''; ?>><?php echo $day; ?></option>
								<?php } ?>
							</select>
		                </div>
		            </div>
				</form>
	        </div>
	    </div>
    </div>
    <div class="row">
    	<?php if(!empty($turfs)) { ?>
	    	<?php foreach ($turfs as $key => $turf) { ?>
		    	<div class="col-sm-12">
		    		<div class="card border-light m-b-30">
		    			<div class="card-header bg-transparent border-light">
		    				<?php echo $turf['name']; ?>, <?php echo $turf['address']; ?>
		    				<?php 
			    				$total_booked = (count($turf['slots'])) ? ceil((count($turf['booked_slots'])/count($turf['slots']))*100) : 0;
		    				?>
		    				<span class="float-right">Total bookings : <?php echo $total_booked; ?>% booked</span>
	    				</div>
		    			<div class="card-body p-2">
		    				<?php foreach ($turf['slots'] as $key => $slot) { ?>
		    					<?php
		    						$booked = false;
			    					foreach ($turf['booked_slots'] as $key => $booked_slot) { 
			    						if($booked_slot['id'] == $slot['id']) {
			    							$booked = true;
			    							break;
			    						}
			    					}
		    					?>
		    					<span class="badge badge-pill badge-<?php echo ($booked) ? 'success' : 'dark'; ?>"><?php echo $slot['time']; ?> - <?php echo date("h:i a", strtotime('+30 minutes', strtotime($slot['time']))); ?></span>
		    				<?php } ?>
		    			</div>
		    			<div class="card-footer bg-transparent border-light">
		    				<div class="row">
			    				<div class="col-md-6">
			    					<br>
			    					<h6 class="card-title">
			    						<b>Recent Bookings</b>
			    						<a href="<?php echo site_url('manager/bookings?turf_id='.$turf['id']) ?>" class="float-right">View all</a>
			    					</h6>
			    					<div class="table-responsive">
				                        <table class="table">
				                            <thead>
				                                <tr>
				                                    <th scope="col" width="40%">Time Slot</th>
				                                    <th scope="col" class="text-center">Customer</th>
				                                    <th scope="col" class="text-center">Contact</th>
				                                    <th scope="col" class="text-right">Booking Date</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                                <?php if(!empty($turf['recent_bookings'])) { ?>
				                                    <?php foreach($turf['recent_bookings'] as $booking) { ?>
				                                        <tr>
				                                            <td><?php echo $booking['time_slot']; ?></td>
				                                            <td class="text-center"><?php echo $booking['player']; ?></td>
				                                            <td class="text-center"><a href="tel:<?php echo $booking['player_mobile']; ?>"><?php echo $booking['player_mobile']; ?></a></td>
				                                            <td class="text-right"><?php echo convert_db_time($booking['booking_date'], "jS M, Y"); ?></td>
				                                        </tr>
				                                    <?php } ?>
				                                <?php } else { ?>
				                                    <tr>
				                                        <th scope="row" colspan="4">No bookings done yet!</th>
				                                    </tr>
				                                <?php } ?>
				                            </tbody>
				                        </table>
				                    </div>
			    				</div>
			    				<div class="col-md-6">
			    					<br>
			    					<h6 class="card-title">
			    						<b>Cancelled Bookings</b>
			    						<a href="<?php echo site_url('manager/bookings?turf_id='.$turf['id'].'&status='.TURF_STATUS_CANCELLED) ?>" class="float-right">View all</a>
			    					</h6>
			    					<div class="table-responsive">
				                        <table class="table">
				                            <thead>
				                                <tr>
				                                    <th scope="col" width="40%">Time Slot</th>
				                                    <th scope="col" class="text-center">Customer</th>
				                                    <th scope="col" class="text-center">Contact</th>
				                                    <th scope="col" class="text-right">Booking Date</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                                <?php if(!empty($turf['cancelled_bookings'])) { ?>
				                                    <?php foreach($turf['cancelled_bookings'] as $booking) { ?>
				                                        <tr>
				                                            <td><?php echo $booking['time_slot']; ?></td>
				                                            <td class="text-center"><?php echo $booking['player']; ?></td>
				                                            <td class="text-center"><a href="tel:<?php echo $booking['player_mobile']; ?>"><?php echo $booking['player_mobile']; ?></a></td>
				                                            <td class="text-right"><?php echo convert_db_time($booking['booking_date'], "jS M, Y"); ?></td>
				                                        </tr>
				                                    <?php } ?>
				                                <?php } else { ?>
				                                    <tr>
				                                        <th scope="row" colspan="4">No bookings cancelled yet!</th>
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
		    <?php } ?>
	    <?php } else { ?>
	    	<div class="col-sm-12">
		    	<div class="alert alert-danger" role="alert">
					No turfs added yet!
	            </div>
	        </div>
	    <?php } ?>
    </div>
</div>