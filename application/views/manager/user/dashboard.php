<div class="booking manager-dashboard">
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
			<div class="wid50">
				<input type="hidden" name="from_date" id="from_date" value="<?php echo $date['from_date'] ?>">
				<input type="hidden" name="to_date" id="to_date" value="<?php echo $date['to_date'] ?>">
				<div class="daterange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
				    Report :&nbsp;
				    <span></span> <i class="fa fa-caret-down"></i>
				</div>
			</div>
		</div>
	</form>
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
				<div class="row">
					<div class="col-md-3">
						<div class="card">
							<div class="card-header">
								Today's Bookings
							</div>
							<div class="card-body">
								<?php echo $turf['report']['todays_bookings']; ?>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card">
							<div class="card-header">
								Today's Earnings
							</div>
							<div class="card-body">
								Rs. <?php echo $turf['report']['todays_earnings']; ?>/-
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card">
							<div class="card-header">
								Total Bookings
							</div>
							<div class="card-body">
								<?php echo $turf['report']['custom_bookings']; ?>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card">
							<div class="card-header">
								Total Earnings
							</div>
							<div class="card-body">
								Rs. <?php echo $turf['report']['custom_earnings']; ?>/-
							</div>
						</div>
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
<script type="text/javascript">
	$(function() {
	    var start = moment('<?php echo $date['from_date']; ?>');
	    var end = moment('<?php echo $date['to_date']; ?>');
	    function cb(start, end) {
	        $('.daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	        $('#from_date').val(start.format('Y-MM-DD'));
	        $('#to_date').val(end.format('Y-MM-DD'));
	    }
	    $('.daterange').daterangepicker({
	        startDate: start,
	        endDate: end,
	        linkedCalendars: false,
	        opens: 'right',
	        ranges: {
	           'Today': [moment(), moment()],
	           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	           'This Month': [moment().startOf('month'), moment().endOf('month')],
	           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	        }
	    }, cb);
	    cb(start, end);
	    $('.daterange').on('apply.daterangepicker', function(ev, picker) {
		    $("#dayForm").submit();
		});
	});
</script>

<style>
	.drp-calendar.right {
	  display: none !important;
	}
</style>