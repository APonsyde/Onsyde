<section class="howit-work-wrap">

		<div class="flexpanel">
			
		<aside class="px-0 wid20" id="left">

				<div class="list-group fixed-top">
					<a href="#" class="list-group-item active">Link</a>
					<a href="#" class="list-group-item">Link</a>
					<a href="#" class="list-group-item">Link</a>
					<a href="#" class="list-group-item">Link</a>
					<a href="#" class="list-group-item">Link</a>
					<a href="#" class="list-group-item">Link</a>
					<a href="#" class="list-group-item">Link</a>
					<a href="#" class="list-group-item">Link</a>
					<a href="#" class="list-group-item">Link</a>
					<a href="#" class="list-group-item">Link</a>
				</div>

				</aside>

			<div class="wid80">
				<div class="booking manager-dashboard">
				<h3>Turfs Available </h3>
					<div class="flexpanel align-center">
						<?php $days = get_upcoming_days();?>
						<img src="<?php echo base_url('resources/front/images/calendar.svg'); ?>" alt="logo" class="calendar">
						<select class="date">
							<?php foreach ($days as $key => $day) { ?>
								<option value="<?php echo $key; ?>" <?php echo ($this->input->get('date') == $key) ? 'selected' : ''; ?>><?php echo $day; ?></option>
							<?php } ?>
						</select>
						<span class="ti-angle-down"></span>
					</div>
					<?php if(!empty($turfs)) { ?>
		    			<?php foreach ($turfs as $key => $turf) { ?>
							<div class="slots">
								<div class="flexpanel justify-between">
									<h6><img src="<?php echo base_url('resources/front/images/pin.svg'); ?>" alt="logo" class="calendar"><?php echo $turf['name']; ?>, <?php echo $turf['address']; ?></h6>
								
								</div>
								<!-- <h6 class="pt-3">Total bookings </h6> -->
								<div class="flexpanel totalbooking align-center">
								<a class="slotbtn" href="<?php echo site_url('manager/turf/messaging/'.$turf['id']) ?>">Manage Slot Messaging</a>
								<span>% booked</span>
						</div>
								<div class="timeslots">
									<ul class="flexpanel wrp">
										<?php $total_slots = 0; ?>
										<?php foreach ($turf['slots'] as $key => $slot) { ?>
					    					<?php
					    						$booked = false;
					    						$unavailable = false;
					    						if($slot['price'] <= 0) {
					    							$unavailable = true;
					    						} else {
					    							$total_slots++;
					    						}
						    					foreach ($turf['booked_slots'] as $key => $booked_slot) { 
						    						if($booked_slot['id'] == $slot['id']) {
						    							$booked = true;
						    							break;
						    						}
						    					}
					    					?>
					    					<li class="<?php echo ($booked) ? 'tabgreen' : (($unavailable) ? 'tabgrey' : ''); ?>"><?php echo $slot['time']; ?></li>
					    				<?php } ?>
									</ul>
								</div>
								<?php 
				    				$total_booked = $total_slots ? ceil((count($turf['booked_slots'])/$total_slots)*100) : 0;
			    				?>
								<!-- <h6 class="pt-3">Total bookings : <?php echo $total_booked; ?>% booked</h6> -->
								<ul class="detail flexpanel">
                                            <li class="tab4 act"><a href="javascript:void(0);">Recent Bookings</a></li>
											<li class="tab5"><a href="javascript:void(0);">Cancelled Bookings</a></li>
											<li class="view"><a href="<?php echo site_url('manager/bookings?turf_id='.$turf['id']) ?>" class="float-right">View</a></li>
										</ul>
										<div id="tab4" class="tab-content act pad-50">
										<div style="overflow-x:auto;" class="tble">
										<table>
											<tbody>
												
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
				                                            <td class=""><?php echo $booking['player']; ?></td>
				                                            <td class=""><a href="tel:<?php echo $booking['player_mobile']; ?>"><?php echo $booking['player_mobile']; ?></a></td>
				                                            <td><?php echo convert_db_time($booking['booking_date'], "jS M, Y"); ?></td>
				                                        </tr>
				                                    <?php } ?>
				                                <?php } else { ?>
				                                    <tr>
				                                        <th scope="row" colspan="4">No bookings done yet!</th>
				                                    </tr>
				                                <?php } ?>
											</tbody></table>
										</div>
												</div>
												<div id="tab5" class="tab-content pad-50">
										<div style="overflow-x:auto;" class="tble">
											<table>
												<tbody>
													<!-- <tr>
														<th>Cancelled Bookings</th>
														<th>&nbsp;</th>
														<th>&nbsp;</th>
														<th class="view"><a href="<?php echo site_url('manager/bookings?turf_id='.$turf['id'].'&status='.TURF_STATUS_CANCELLED) ?>" class="float-right">View</a></th>
													</tr>   -->
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
											
								<div class="flexpanel mar-40">
								
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
	
</section>