<?php if(empty($turfs)) { ?>
	<div class="booking manager-dashboard noturf">
        <h3 class="text-center">No Turf Available!</h3>
        <div class="slots">
            <div class="flexpanel totalbooking align-center justify-center">
                <a class="slotbtn add" href="<?php echo site_url('manager/turf/create'); ?>">Add New Turf</a>
            </div>
        </div>
    </div>
<?php } else { ?>
	<?php $today = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d'); ?>
	<div class="booking manager-dashboard pad-bot-0">
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
		</form>
    	<?php foreach ($turfs as $key => $turf) { ?>
    		<form method="post">
    			<input type="hidden" name="date" value="<?php echo $this->input->get('date'); ?>">
    			<input type="hidden" name="turf_id" value="<?php echo $turf['id']; ?>">
    			<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="slots <?php echo ($key % 2 == 0) ? '' : 'bggrey'; ?>">
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

	<script>
		$(function() {
			var start = moment('<?php echo $today; ?>');
			$('.datepicker').daterangepicker({
				startDate: start,
				singleDatePicker: true,
				autoApply: true,
				minDate: moment(),
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