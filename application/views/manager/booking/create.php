<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">New Booking</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('manager/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Bookings</li>
                    <li class="breadcrumb-item active" aria-current="page">New</li>
                </ol>
            </div>
        </div>
    </div>          
</div>
<div class="contentbar">
	<?php $this->load->view('front/layout/alert'); ?>
	<div class="card m-b-30">
        <div class="card-header">
            <h5 class="card-title">Player details -</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
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
            </div>
        </div>
    </div>
	<div class="card m-b-30">
        <div class="card-header">
            <h5 class="card-title">Showing available turfs for</h5>
        </div>
        <div class="card-body">
            <form id="dayForm">
                <div class="form-group">
                    <?php $days = get_upcoming_days();?>
                    <select class="form-control" name="date" onchange="document.getElementById('dayForm').submit();">
						<?php foreach ($days as $key => $day) { ?>
							<option value="<?php echo $key; ?>" <?php echo ($this->input->get('date') == $key) ? 'selected' : ''; ?>><?php echo $day; ?></option>
						<?php } ?>
					</select>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
    	<?php if(!empty($turfs)) { ?>
	    	<?php foreach ($turfs as $key => $turf) { ?>
	    		<form method="post">
	    			<input type="hidden" name="date" value="<?php echo $this->input->get('date'); ?>">
	    			<input type="hidden" name="turf_id" value="<?php echo $turf['id']; ?>">
			    	<div class="col-sm-12 gallery-filter">
			    		<div class="card border-light m-b-30">
			    			<div class="card-body p-2">
			    				<div class="row">
				    				<div class="col-md-6">
					    				<?php foreach ($turf['slots'] as $key => $slot) { ?>
					    					<?php
					    						$booked = false;
						    					foreach ($turf['booked_slots'] as $key => $booked_slot) { 
						    						if($booked_slot['id'] == $slot['id']) {
						    							$booked = true;
						    							break;
						    						}
						    					}
					    					?>
					    					<span class="badge badge-pill badge-<?php echo ($booked) ? 'danger' : 'dark'; ?> <?php echo ($booked) ? 'slot-unavailable' : 'slot-available'; ?>" data-price="<?php echo $slot['price']; ?>"  data-id="<?php echo $slot['id']; ?>">
					    						<?php echo $slot['time']; ?> -
					    						<?php echo date("h:i a", strtotime('+30 minutes', strtotime($slot['time']))); ?>
					    						<input type="checkbox" class="d-none" name="slot[]" value="<?php echo $slot['id']; ?>">
					    					</span>
			    						<?php } ?>
				    				</div>
				    				<div class="col-md-6">
				    					<?php if(!empty($turf['images'])) { ?>
					    					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			                                    <ol class="carousel-indicators">
			                                    	<?php foreach ($turf['images'] as $key => $image) { ?>
				                                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key; ?>" class="<?php echo ($key == 0) ? 'active' : ''; ?>"></li>
				                                    <?php } ?>
			                                    </ol>
			                                    <div class="carousel-inner">
			                                    	<?php foreach ($turf['images'] as $key => $image) { ?>
				                                        <div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>">
				                                            <img src="<?php echo base_url('uploads/turfs/'.$turf['id'].'/gallery/'.$image['name']); ?>" class="d-block w-100" alt="First slide">
				                                        </div>
				                                    <?php } ?>
			                                    </div>
			                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			                                        <span class="sr-only">Previous</span>
			                                    </a>
			                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
			                                        <span class="sr-only">Next</span>
			                                    </a>
			                                </div>
			                            <?php } ?>
				    				</div>
			    				</div>
			    			</div>
			    			<div class="card-footer bg-transparent border-light">
			    				<span>Rs. <span class="price">0</span> / <span class="time">0</span> hr</span>
			    				<button class="btn btn-success ml-3">Confirm Booking</button>
			    				<a href="<?php echo site_url('manager/bookings'); ?>" class="btn btn-danger ml-3">Cancel Booking</a>
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
			var start = $(".slot-available.select").length;
			if(start == 0) {
				_this.addClass('select');
			} else if(start >= 2) {
				$(".slot-available").removeClass('select');
				_this.addClass('select');
			} else {
				if(_this.hasClass('select')) {
					_this.removeClass('select');
				} else {
					_this.addClass('current');
					var startIndex = 0;
					var endIndex = 0;
					$(".slot-available").each(function() {
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
						_this.prevUntil($(".slot-available.select")).addClass('selectable');
					} else {
						_this.nextUntil($(".slot-available.select")).addClass('selectable');
					}

					if($(".slot-unavailable.selectable").length) {
						$(".selectable").removeClass('selectable');
					} else {
						$(".selectable").removeClass('selectable');
						if(startIndex < endIndex) {
							_this.prevUntil($(".slot-available.select")).addClass('select');
						} else {
							_this.nextUntil($(".slot-available.select")).addClass('select');
						}
						_this.addClass('select');
					}
				}
			}
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
<?php } ?>
<script>
	function calculate()
	{
		var time = ($(".slot-available.select").length) / 2;
		$(".time").text(time);

		var price = 0;
		$(".slot-available.select").each(function() {
			price += parseFloat($(this).attr('data-price'));
		});
		$(".price").text(price);
	}
</script>