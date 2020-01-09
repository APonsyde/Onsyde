<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Turfs</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('manager/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Turfs</li>
                    <li class="breadcrumb-item active" aria-current="page">List</li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <a href="<?php echo site_url('manager/turf/create'); ?>" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Create</a>
            </div>                        
        </div>
    </div>          
</div>
<div class="contentbar">
    <div class="row align-items-center">
		<div class="col-lg-4 col-xl-4">
	        <div class="card m-b-30">
            	<form id="dayForm">
		            <div class="card-body">
		                <div class="media">
							<?php $days = get_upcoming_days();?>
		                    <select class="form-control" name="date" onchange="document.getElementById('dayForm').submit();">
								<?php foreach ($days as $key => $day) { ?>
									<option value="<?php echo $key; ?>" <?php echo ($this->input->get('date') == $key) ? 'selected' : ''; ?>><?php echo $day; ?></option>
								<?php } ?>
							</select>
		                </div>
		            </div>
				</form>
	        </div>
	    </div>
    </div>
    <div class="row">
    	<?php if(!empty($turfs)) { ?>
	    	<?php foreach ($turfs as $key => $turf) { ?>
		    	<div class="col-sm-12 col-md-6">
		    		<div class="card border-light m-b-30">
		    			<div class="card-header bg-transparent border-light"><?php echo $turf['name']; ?>, <?php echo $turf['address']; ?></div>
		    			<div class="card-body p-2">
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
		    			<div class="card-footer bg-transparent border-light">
		    				<a class="btn btn-primary mr-2" href="<?php echo site_url('manager/turf/edit/'.$turf['id']); ?>">Manage Turf</a>
		    				<a class="btn btn-primary mr-2" href="<?php echo site_url('manager/turf/gallery/'.$turf['id']); ?>">Manage Gallery</a>
		    				<a class="btn btn-primary" href="<?php echo site_url('manager/turf/slots/'.$turf['id']); ?>">Manage Slots</a>
		    			</div>
		    		</div>  
		    	</div>
		    <?php } ?>
	    <?php } else { ?>
	    	<div class="col-sm-12">
		    	<div class="alert alert-danger" role="alert">
					No turfs added yet!
	            </div>
	        </div>
	    <?php } ?>
    </div>
</div>