<section class="main-block howit-work-wrap">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<h3>Turfs Available on <span class="fontgreen"><?php echo convert_db_time($this->input->get('date'), 'd M, Y'); ?></span></h3>
			</div>
		</div>
		<?php if(!empty($turfs)) { ?>
	    	<?php foreach ($turfs as $key => $turf) { ?>
	    		<form method="post">
	    			<input type="hidden" name="date" value="<?php echo $this->input->get('date'); ?>">
	    			<input type="hidden" name="turf_id" value="<?php echo $turf['id']; ?>">
	    			<div class="row justify-content-center">
						<div class="col-md-12">
							<div class="booking manager-dashboard">
								<h4><?php echo $turf['name']; ?></h4>
								<h6><img src="<?php echo base_url('resources/front/images/pin.svg'); ?>" alt="logo" class="calendar"><?php echo $turf['address']; ?></h6>
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
								<div class="slots mb-0">
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
							    							$booked = true;
							    							break;
							    						}
							    					}
						    					?>
												<li class="<?php echo ($unavailable) ? 'slot-unavailable unavailable' : 'slot-available available'; ?>" data-price="<?php echo $slot['price']; ?>" data-start-time="<?php echo $slot['time']; ?>" data-end-time="<?php echo date("h:i a", strtotime('+30 minutes', strtotime($slot['time']))); ?>" data-id="<?php echo $slot['id']; ?>">
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
											<div class="pay-btn pay fontgreen" data-title="Confirm Booking" data-text="Are you sure you want to book these slots?">
												Book Slots →
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
	    	<div class="mt-4">
				<em>No turfs available!</em>
            </div>
	    <?php } ?>
	</div>
</section>

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
			var slots = _this.parents('.slots');
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
			var title = _this.attr('data-title');
			var text = _this.attr('data-text');
			$.confirm({
			    title: title,
			    content: text,
			    buttons: {
			        confirm: function () {
			            _this.parents('form').submit();
			        },
			        cancel: function () {}
			    }
			});
		});
	});
	function calculate(slots)
	{
		var time = (slots.find(".slot-available.select").length) / 2;
		slots.find(".time").text(time);
		var price = 0;
		var startTime = null;
		var endTime = null;
		slots.find(".slot-available.select").each(function() {
			if(startTime == null)
				startTime = $(this).attr('data-start-time');
			endTime = $(this).attr('data-end-time');
			price += parseFloat($(this).attr('data-price'));
		});
		slots.find(".price").text(price);
		slots.find(".pay-btn").attr('data-text', 'You are booking slots from '+startTime+' to '+endTime+'. Are you sure you want to book these slots?');
	}
</script>