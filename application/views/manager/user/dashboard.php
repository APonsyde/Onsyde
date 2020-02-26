<div class="booking manager-dashboard">
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
				<h3><?php echo $turf['name']; ?></h3>
				<div class="flexpanel justify-between">
					<h6><img src="<?php echo base_url('resources/front/images/pin.svg'); ?>" alt="logo" class="calendar"><?php echo $turf['address']; ?></h6>
				</div>
				<?php 
				$total_slots = 0;
				foreach ($turf['slots'] as $key => $slot) {
					if($slot['price']) {
						$total_slots++;
					}
				}
				$total_booked = $total_slots ? ceil((count($turf['booked_slots'])/$total_slots)*100) : 0;
				?>
				<div class="flexpanel totalbooking align-center">
					<a class="slotbtn" href="<?php echo site_url('manager/turf/messaging/'.$turf['id']) ?>">Manage Slot Messaging</a>
					<span><?php echo $total_booked; ?>% booked</span>
				</div>
				<div class="timeslots">
					<ul class="flexpanel wrp">
						<?php foreach ($turf['slots'] as $key => $slot) { ?>
	    					<?php
	    						$booked = false;
	    						$unavailable = false;
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
	    					<li class="<?php echo ($booked) ? 'booked' : (($unavailable) ? 'unavailable' : ''); ?>"><?php echo $slot['time']; ?></li>
	    				<?php } ?>
					</ul>
				</div>
				<ul class="detail flexpanel">
					<li class="btn-tab-booking act" data-tab="tab-r-<?php echo $turf['id']; ?>"><a href="javascript:void(0);">Recent Bookings</a></li>
					<li class="btn-tab-booking" data-tab="tab-c-<?php echo $turf['id']; ?>"><a href="javascript:void(0);">Cancelled Bookings</a></li>
					<li class="view"><a href="<?php echo site_url('manager/bookings?turf_id='.$turf['id']) ?>" class="float-right">View</a></li>
				</ul>
				<div class="tab-content act pad-50 tab-r-<?php echo $turf['id']; ?>">
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
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-content pad-50 hide tab-c-<?php echo $turf['id']; ?>">
					<div style="overflow-x:auto;" class="tble">
						<table>
							<tbody>
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
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</div>


<script type="text/javascript">
    $(document).ready(function() {
    	$(".btn-tab-booking").click(function() {
    		var _this = $(this);
    		var bclass = _this.attr('data-tab');
    		_this.parents(".slots").find(".btn-tab-booking").removeClass("act");
    		_this.addClass("act");
    		_this.parents(".slots").find(".tab-content").addClass("hide");
    		$("."+bclass).removeClass("hide");
    		$("."+bclass).addClass("act");
    	});
    });
</script>