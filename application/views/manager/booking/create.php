<?php $today = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d'); ?>
<div class="booking manager-dashboard">
    <div class="slots">
    	<h4>Booking for player -</h4>
		<table class="table mb-5 mt-3">
            <tbody>
    			<tr>
                    <th scope="col" width="50%">Name</th>
                    <td scope="col" width="50%"><?php echo $player['full_name']; ?></td>
                </tr>
                <tr>
                    <th scope="col" width="50%">Mobile</th>
                    <td scope="col" width="50%"><?php echo $player['mobile']; ?></td>
                </tr>
    		</tbody>
    	</table>
    	<div class="flexpanel align-center">
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
		</div>
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
								<?php if(!empty($turf['images'])) { ?>
									<div id="carouselExampleControls" class="carousel bookingcarousel slide" data-ride="carousel">
										<div class="carousel-inner">
											<?php foreach ($turf['images'] as $key => $image) { ?>
												<div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>">
													<img class="d-block w-100" src="<?php echo base_url('uploads/turfs/'.$turf['id'].'/gallery/'.$image['name']); ?>" alt="slide">
												</div>
											<?php } ?>
										</div>
										<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
								<?php } else { ?>
									<div class="carousel bookingcarousel slide" data-ride="carousel">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100" src="<?php echo base_url('resources/theme/images/no-turf-image.jpg'); ?>" alt="slide">
											</div>
										</div>
									</div>
								<?php } ?>
								<div class="slots pricing">
									<div class="timeslots">
										<ul class="flexpanel wrp">
											<?php foreach ($turf['slots'] as $key => $slot) { ?>
						    					<?php
						    						$unavailable = false;
						    						if($slot['price'] <= 0) {
						    							$unavailable = true;
						    						}
							    					foreach ($turf['booked_slots'] as $key => $booked_slot) {
							    						if($booked_slot['id'] == $slot['id']) {
							    							$unavailable = true;
							    							break;
							    						}
							    					}
						    					?>
												<li class="<?php echo ($unavailable) ? 'slot-unavailable unavailable' : 'slot-available available'; ?>" data-price="<?php echo $slot['price']; ?>"  data-id="<?php echo $slot['id']; ?>">
													<?php echo $slot['time']; ?>
					    							<input type="checkbox" class="d-none" name="slot[]" value="<?php echo $slot['id']; ?>">
												</li>
											<?php } ?>
										</ul>
									</div>
									<div class="bookslot">
										<div class="flexpanel end">
											<div class="pay rs">
												<?php echo CURRENCY_SYMBOL; ?> <span class="price">0</span> / <span class="time">0</span> hr
											</div>
											<div class="pay-btn pay rs fontgreen">
												Confirm Booking →
											</div>
											<div class="pay-cancel-btn pay fontred" style="cursor: pointer;" data-href="<?php echo site_url('manager/bookings'); ?>">
												<i>Cancel Booking →</i>
											</div>
										</div>
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
</div>

<?php if($slot_selection_type == TURF_SLOT_INDIVIDUAL) { ?>
<script>
	$(document).ready(function() {
		$(document).on("click", ".slot-available", function() {
			var _this = $(this);
			_this.toggleClass('select');
			$(".slot-available").each(function() {
				$(this).find('input').prop('checked', false);
				if($(this).hasClass('select')) {
					$(this).find('input').prop('checked', true);
				}
			});
			calculate();
		})
	});
</script>
<?php } else { ?>
<script>
	$(document).ready(function() {
		$(document).on("click", ".slot-available", function() {
			var _this = $(this);
			var slots = _this.parents('.pricing');
			var start = slots.find(".slot-available.select").length;
			if(start == 0) {
				_this.addClass('select');
			} else if(start >= 2) {
				slots.find(".slot-available").removeClass('select');
				_this.addClass('select');
			} else {
				if(_this.hasClass('select')) {
					_this.removeClass('select');
				} else {
					_this.addClass('current');
					var startIndex = 0;
					var endIndex = 0;
					slots.find(".slot-available").each(function() {
						var index = $(this).index();
						if($(this).hasClass('select')) {
							startIndex = index;
						}
						if($(this).hasClass('current')) {
							endIndex = index;
						}
					});
					_this.removeClass('current');
					if(startIndex < endIndex) {
						_this.prevUntil(slots.find(".slot-available.select")).addClass('selectable');
					} else {
						_this.nextUntil(slots.find(".slot-available.select")).addClass('selectable');
					}

					if(slots.find(".slot-unavailable.selectable").length) {
						slots.find(".selectable").removeClass('selectable');
					} else {
						slots.find(".selectable").removeClass('selectable');
						if(startIndex < endIndex) {
							_this.prevUntil(slots.find(".slot-available.select")).addClass('select');
						} else {
							_this.nextUntil(slots.find(".slot-available.select")).addClass('select');
						}
						_this.addClass('select');
					}
				}
			}
			slots.find(".slot-available").each(function() {
				$(this).find('input').prop('checked', false);
				if($(this).hasClass('select')) {
					$(this).find('input').prop('checked', true);
				}
			});
			calculate(slots);
		})
	});
</script>
<?php } ?>
<script>
	$(document).ready(function() {
		$(document).on("click", ".pay-btn", function() {
			var _this = $(this);
			_this.parents('form').submit();
		});
		$(document).on("click", ".pay-cancel-btn", function() {
			var _this = $(this);
			window.location.href = _this.attr('data-href');
		});
	});
	function calculate(slots)
	{
		var time = (slots.find(".slot-available.select").length) / 2;
		slots.find(".time").text(time);

		var price = 0;
		slots.find(".slot-available.select").each(function() {
			price += parseFloat($(this).attr('data-price'));
		});
		slots.find(".price").text(price);
	}
</script>
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