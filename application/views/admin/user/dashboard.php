<?php if(empty($turfs)) { ?>
	<div class="booking manager-dashboard noturf">
	    <h3 class="text-center">No Turf Available!</h3>
	</div>
<?php } else { ?>
	<?php $today = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d'); ?>
	<div class="booking manager-dashboard dash">
		<form id="dayForm">
			<div class="flexpanel justify-between align-center mb-3">
				<div class="wid50">
					<input type="hidden" name="date" id="date" value="<?php echo $today; ?>">
					<div class="datepicker" style="background: #fff; cursor: pointer; padding: 5px 10px; width: 100%">
						<img src="<?php echo base_url('resources/front/images/calendar.svg'); ?>" alt="logo" class="calendar">
					    <span></span> <i class="fa fa-caret-down"></i>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-4">
					<label>Filter by turf:</label>
					<select class="select2" name="turfs[]" multiple="multiple">
						<?php foreach ($all_turfs as $turf) { ?>
							<option value="<?php echo $turf['id']; ?>" <?php echo (!empty($this->input->get('turfs')) && in_array($turf['id'], $this->input->get('turfs'))) ? 'selected' : ''; ?>><?php echo $turf['name']; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-4">
					<label>Filter by manager:</label>
					<select class="select2" name="managers[]" multiple="multiple">
						<?php foreach ($all_managers as $manager) { ?>
							<?php if($manager['company_name']) { ?>
								<option value="<?php echo $manager['id']; ?>" <?php echo (!empty($this->input->get('managers')) && in_array($manager['id'], $this->input->get('managers'))) ? 'selected' : ''; ?>><?php echo $manager['company_name']; ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
				<div class="col-4">
					<label>&nbsp;</label><br clear="all">
					<button class="greyBtn green mr-3">Search</button>
					<button type="button" onclick="window.location.href='<?php echo site_url('admin/dashboard'); ?>'" class="greyBtn">Clear</button>
				</div>
			</div>
		</form>
		<?php foreach ($turfs as $key => $turf) { ?>
			<div class="slots <?php echo ($key % 2 == 0) ? '' : 'bggrey'; ?>">
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
					<span><?php echo $total_booked; ?>% booked</span>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="card mb-0 mt-4">
							<div class="card-header">
								Today's Bookings
							</div>
							<div class="card-body">
								<?php echo $turf['report']['todays_bookings']; ?> slots
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card mb-0 mt-4">
							<div class="card-header">
								Today's Earnings
							</div>
							<div class="card-body">
								<?php echo CURRENCY_SYMBOL; ?> <?php echo $turf['report']['todays_earnings']; ?>/-
							</div>
						</div>
					</div>
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
					<li class="btn-tab-booking act" data-tab="tab-r-<?php echo $turf['id']; ?>"><a href="javascript:void(0);">Bookings</a></li>
					<li class="btn-tab-booking" data-tab="tab-c-<?php echo $turf['id']; ?>"><a href="javascript:void(0);">Cancelled Bookings</a></li>
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
									<th>Amount</th>
								</tr>
								<?php if(!empty($turf['recent_bookings'])) { ?>
                                    <?php foreach($turf['recent_bookings'] as $booking) { ?>
                                        <tr>
                                            <td><?php echo $booking['time_slot']; ?></td>
                                            <td class=""><?php echo $booking['player']; ?></td>
                                            <td class=""><a href="tel:<?php echo $booking['player_mobile']; ?>"><?php echo $booking['player_mobile']; ?></a></td>
                                            <td><?php echo convert_db_time($booking['booking_date'], "jS M, Y"); ?></td>
                                            <td><?php echo CURRENCY_SYMBOL; ?> <?php echo $booking['amount']; ?>/-</td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <th scope="row" colspan="5">No bookings done yet!</th>
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
									<th>Amount</th>
								</tr>
								<?php if(!empty($turf['cancelled_bookings'])) { ?>
                                    <?php foreach($turf['cancelled_bookings'] as $booking) { ?>
                                        <tr>
                                            <td><?php echo $booking['time_slot']; ?></td>
                                            <td class="text-center"><?php echo $booking['player']; ?></td>
                                            <td class="text-center"><a href="tel:<?php echo $booking['player_mobile']; ?>"><?php echo $booking['player_mobile']; ?></a></td>
                                            <td class="text-right"><?php echo convert_db_time($booking['booking_date'], "jS M, Y"); ?></td>
                                            <td><?php echo CURRENCY_SYMBOL; ?> <?php echo $booking['amount']; ?>/-</td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <th scope="row" colspan="5">No bookings cancelled yet!</th>
                                    </tr>
                                <?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
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
	    	$('.select2').select2();
	    });
	</script>
	<script>
		$(function() {
			var start = moment('<?php echo $today; ?>');
			$('.datepicker').daterangepicker({
				startDate: start,
				singleDatePicker: true,
				autoApply: true,
				locale: {
			      	format: 'Y-MM-DD'
			    }
			}, cb);
		    cb(start);
		    function cb(start) {
		        $('.datepicker span').html(start.format('MMMM D, YYYY'));
		        $('#date').val(start.format('Y-MM-DD'));
		    }
		    $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
			    $("#dayForm").submit();
			});
		});
	</script>
<?php } ?>