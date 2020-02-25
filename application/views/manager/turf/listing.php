<section class="wid80 howit-work-wrap">
	
				<div class="booking manager-dashboard pad-bot-0">
	            	<form id="dayForm">
						<div class="flexpanel justify-between align-center">
							<?php $days = get_upcoming_days();?>
		                    <select class="date" name="date" onchange="document.getElementById('dayForm').submit();">
								<?php foreach ($days as $key => $day) { ?>
									<option value="<?php echo $key; ?>" <?php echo ($this->input->get('date') == $key) ? 'selected' : ''; ?>><?php echo $day; ?></option>
								<?php } ?>
							</select>
						</div>
					</form>
					<?php if(!empty($turfs)) { ?>
				    	<?php foreach ($turfs as $key => $turf) { ?>
				    		<form method="post">
				    			<input type="hidden" name="date" value="<?php echo $this->input->get('date'); ?>">
				    			<input type="hidden" name="turf_id" value="<?php echo $turf['id']; ?>">
				    			<div class="row justify-content-center">
									<div class="col-md-12">
										<div class="slots">
											<h4><?php echo $turf['name']; ?></h4>
											<h6><i class="fas fa-map-marker-alt"></i><?php echo $turf['address']; ?></h6>
											<div class="slots">
												<div class="timeslots">
													<ul class="flexpanel wrp">
														<?php foreach ($turf['slots'] as $key => $slot) { ?>
									    					<?php
									    						$unavailable = false;
									    						$booked = false;
									    						if($slot['price'] <= 0) {
									    							$unavailable = true;
									    						}
										    					foreach ($turf['booked_slots'] as $key => $booked_slot) {
										    						if($booked_slot['id'] == $slot['id']) {
										    							$booked = true;
										    							break;
										    						}
										    					}
									    					?>
															<li class="<?php echo ($booked) ? 'tabgreen' : (($unavailable) ? 'tabgrey' : ''); ?>" data-price="<?php echo $slot['price']; ?>"  data-id="<?php echo $slot['id']; ?>">
																<?php echo $slot['time']; ?>
								    							<input type="checkbox" class="d-none" name="slot[]" value="<?php echo $slot['id']; ?>">
															</li>
														<?php } ?>
													</ul>
												</div>
												<div class="bookslot">
													<a class="btn btn-primary mt-4 mr-2" href="<?php echo site_url('manager/turf/edit/'.$turf['id']); ?>">Manage Turf</a>
								    				<a class="btn btn-primary mt-4 mr-2" href="<?php echo site_url('manager/turf/gallery/'.$turf['id']); ?>">Manage Gallery</a>
								    				<a class="btn btn-primary mt-4 mr-2" href="<?php echo site_url('manager/turf/slots/'.$turf['id']); ?>">Manage Slots</a>
								    				<a class="btn btn-primary mt-4" href="<?php echo site_url('manager/turf/messaging/'.$turf['id']); ?>">Slot Messaging</a>
												</div>
											</div>
										</div>
									</div>
								</div>
				    		</form>
			    		<?php } ?>
					<?php } else { ?>
				    	<div class="col-sm-12">
					    	<div class="alert alert-danger" role="alert">
								No turfs available!
				            </div>
				        </div>
				    <?php } ?>
				</div>
			
</section>