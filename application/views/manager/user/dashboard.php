<section class="main-block howit-work-wrap">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="booking manager-dashboard">
					<div class="flexpanel justify-between align-center">
						<?php $days = get_upcoming_days();?>
						<select class="date">
							<?php foreach ($days as $key => $day) { ?>
								<option value="<?php echo $key; ?>" <?php echo ($this->input->get('date') == $key) ? 'selected' : ''; ?>><?php echo $day; ?></option>
							<?php } ?>
						</select>
					</div>
					<?php if(!empty($turfs)) { ?>
		    			<?php foreach ($turfs as $key => $turf) { ?>
							<div class="slots">
								<div class="flexpanel justify-between">
									<h6><i class="fas fa-map-marker-alt"></i><?php echo $turf['name']; ?>, <?php echo $turf['address']; ?></h6>
									<a href="<?php echo site_url('manager/turf/messaging/'.$turf['id']) ?>">Manage Slot Messaging</a>
								</div>
								<div class="timeslots">
									<ul class="flexpanel wrp">
										<?php foreach ($turf['slots'] as $key => $slot) { ?>
					    					<?php
					    						$unavailable = false;
					    						if($slot['price'] <= 0) {
					    							// $unavailable = true;
					    						}
						    					foreach ($turf['booked_slots'] as $key => $booked_slot) { 
						    						if($booked_slot['id'] == $slot['id']) {
						    							$unavailable = true;
						    							break;
						    						}
						    					}
					    					?>
					    					<li class="<?php echo ($unavailable) ? 'tabgreen' : ''; ?>"><?php echo $slot['time']; ?></li>
					    				<?php } ?>
									</ul>
								</div>
								<?php 
				    				$total_booked = (count($turf['slots'])) ? ceil((count($turf['booked_slots'])/count($turf['slots']))*100) : 0;
			    				?>
								<h6 class="pt-3">Total bookings : <?php echo $total_booked; ?>% booked</h6>
								<div class="flexpanel mar-40">
									<div style="overflow-x:auto;" class="tble">
										<table>
											<tbody>
												<tr>
													<th>Recent Bookings</th>
													<th>&nbsp;</th>
													<th>&nbsp;</th>
													<th class="view"><a href="<?php echo site_url('manager/bookings?turf_id='.$turf['id']) ?>" class="float-right">View</a></th>
												</tr>  
												<tr>
													<th width="30%">Time Slot</th>
													<th>Customer</th>
													<th>Contact</th>
													<th>Booking Date</th>
												</tr>
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
											</tbody></table>
										</div>
										<div style="overflow-x:auto;" class="tble">
											<table>
												<tbody>
													<tr>
														<th>Cancelled Bookings</th>
														<th>&nbsp;</th>
														<th>&nbsp;</th>
														<th class="view"><a href="<?php echo site_url('manager/bookings?turf_id='.$turf['id'].'&status='.TURF_STATUS_CANCELLED) ?>" class="float-right">View</a></th>
													</tr>  
													<tr>
														<th width="30%">Time Slot</th>
														<th>Customer</th>
														<th>Contact</th>
														<th>Booking Date</th>
													</tr>
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
												</tbody></table>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>