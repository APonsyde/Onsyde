<?php if(empty($turfs)) { ?>
	<div class="booking manager-dashboard noturf">
        <h3 class="text-center">No Turf Available!</h3>
        <div class="slots">
                <p class="text-center">LOreum ipsum LOreum ipsum LOreum ipsumLOreum ipsumLOreum ipsumLOreum ipsum </p>
            <div class="flexpanel totalbooking align-center justify-center">
                <a class="slotbtn add" href="http://localhost/onsyde/manager/turf/messaging/1">Add New Turf</a>
            </div>
        </div>
    </div>
<?php } else { ?>
	<div class="booking manager-dashboard pad-bot-0">
    	<form id="dayForm">
			<div class="flexpanel justify-between align-center mb-3">
				<div class="wid50">
					<?php $days = get_upcoming_days();?>
					<img src="<?php echo base_url('resources/front/images/calendar.svg'); ?>" alt="logo" class="calendar">
	                <select class="date" name="date" onchange="document.getElementById('dayForm').submit();">
						<?php foreach ($days as $key => $day) { ?>
							<option value="<?php echo $key; ?>" <?php echo ($this->input->get('date') == $key) ? 'selected' : ''; ?>><?php echo $day; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</form>
    	<?php foreach ($turfs as $key => $turf) { ?>
    		<form method="post">
    			<input type="hidden" name="date" value="<?php echo $this->input->get('date'); ?>">
    			<input type="hidden" name="turf_id" value="<?php echo $turf['id']; ?>">
    			<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="slots">
							<h4><?php echo $turf['name']; ?></h4>
							<h6><img src="<?php echo base_url('resources/front/images/pin.svg'); ?>" alt="logo" class="calendar"><?php echo $turf['address']; ?></h6>
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
					    					?>
											<li class="<?php echo ($unavailable) ? 'unavailable' : ''; ?>" data-price="<?php echo $slot['price']; ?>"  data-id="<?php echo $slot['id']; ?>">
												<?php echo $slot['time']; ?>
				    							<input type="checkbox" class="d-none" name="slot[]" value="<?php echo $slot['id']; ?>">
											</li>
										<?php } ?>
									</ul>
								</div>
								<div class="bookslot">
									<a class="slotbtn add mt-3" href="<?php echo site_url('manager/turf/edit/'.$turf['id']); ?>">Manage Turf</a>
				    				<a class="slotbtn add mt-3" href="<?php echo site_url('manager/turf/gallery/'.$turf['id']); ?>">Manage Gallery</a>
				    				<a class="slotbtn add mt-3" href="<?php echo site_url('manager/turf/slots/'.$turf['id']); ?>">Manage Slots</a>
				    				<a class="slotbtn add mt-3" href="<?php echo site_url('manager/turf/messaging/'.$turf['id']); ?>">Slot Messaging</a>
								</div>
							</div>
						</div>
					</div>
				</div>
    		</form>
		<?php } ?>
	</div>
<?php } ?>