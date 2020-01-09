<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Find your next game.</h4>
        </div>
    </div>          
</div>
<div class="contentbar">
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
		    	<div class="col-sm-12">
		    		<div class="card border-light m-b-30">
		    			<div class="card-header bg-transparent border-light"><?php echo $turf['name']; ?>, <?php echo $turf['address']; ?></div>
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
				    					<span class="badge badge-pill badge-<?php echo ($booked) ? 'dark' : 'info'; ?>"><?php echo $slot['time']; ?></span>
		    						<?php } ?>
			    				</div>
		    				</div>
		    			</div>
		    			<div class="card-footer bg-transparent border-light">
		    				<span>Rs. 0/0 hr</span>
		    				<a class="btn btn-primary ml-3" href="<?php echo site_url('manager/turf/edit/'.$turf['id']); ?>">Book Slots</a>
		    			</div>
		    		</div>  
		    	</div>

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