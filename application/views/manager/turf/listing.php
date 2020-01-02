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
		    			<div class="card-body">
		    				<h5 class="card-title">Light card title</h5>
		    				<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		    			</div>
		    			<div class="card-footer bg-transparent border-light">Footer</div>
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