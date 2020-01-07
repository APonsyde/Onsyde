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
    <div class="row">
    	<?php if(!empty($turfs)) { ?>
	    	<?php foreach ($turfs as $key => $turf) { ?>
		    	<div class="col-sm-12 col-md-6">
		    		<div class="card border-light m-b-30">
		    			<div class="card-header bg-transparent border-light"><?php echo $turf['name']; ?>, <?php echo $turf['address']; ?></div>
		    			<div class="card-body p-2">
		    				<?php foreach ($turf['slots'] as $key => $slot) { ?>
		    					<span class="badge badge-pill badge-info"><?php echo $slot['time']; ?></span>
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