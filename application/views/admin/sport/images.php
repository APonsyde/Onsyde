<?php $this->load->view('admin/layout/alert'); ?>
<div class="bg-body-light border-b">
	<div class="content py-5 text-center">
		<nav class="breadcrumb bg-body-light mb-0">
			<a class="breadcrumb-item" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
			<a class="breadcrumb-item" href="<?php echo site_url('sport/listing'); ?>">Sports</a>
			<span class="breadcrumb-item active">Edit</span>
		</nav>
	</div>
</div>
<h2 class="content-heading">Sport - Edit</h2>
	<div class="row gutters-tiny">
		<div class="col-md-4">
			<div class="list-group">
				<a href="<?php echo site_url('sport/edit/'.$sport['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start ">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Info</h5>
					</div>
					<p class="mb-1">Personal, contact info and status related to Sport.</p>
				</a>
				<a href="<?php echo site_url('sport/sport_skill_set/'.$sport['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Skill Sets</h5>
                    </div>
                    <p class="mb-1">Manage Sport Skill Sets.</p>
                </a>
                <a href="<?php echo site_url('sport/images/'.$sport['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Sport Icon</h5>
					</div>
					<p class="mb-1">Upload icon for the Sport.</p>
				</a>
                <a href="<?php echo site_url('sport/rules/'.$sport['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start ">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Sport Rules</h5>
                    </div>
                    <p class="mb-1">Add rules for the Sport.</p>
                </a>
			</div>
		</div>
	<div class="col-md-8">
        <div class="row gutters-tiny">
            <div class="col-md-12">
                <div class="block block-rounded block-themed">
                    <div class="block-header bg-gd-primary">
                        <h3 class="block-title">Upload</h3>
                        <div class="block-options">
                                <a href="<?php echo site_url('sport/listing'); ?>" class="btn btn-sm btn-alt-primary">
                                    <i class="fa fa-save mr-5"></i>Save
                                </a>
                            </div>
                    </div>
                    <div class="block-content block-content-full">
                        <form id="dropzone" action="<?php echo site_url('upload/sport/'.$sport['id']); ?>"></form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gutters-tiny">
            <div class="col-md-12">
                <div class="block block-rounded block-themed">
                    <div class="block-header bg-gd-primary">
                        <h3 class="block-title">Images</h3>
                        <div class="block-options">
                                <a href="<?php echo site_url('sport/listing'); ?>" class="btn btn-sm btn-alt-primary">
                                    <i class="fa fa-save mr-5"></i>Save
                                </a>
                            </div>
                    </div>
                    <div class="block-content block-content-full p-1">
                        <div class="gutters-tiny items-push">
                            <div class="js-draggable-items mb-0">
                                <div class="draggable-column">
                                    <?php if(!empty($sport_images)) { ?>
                                        <?php foreach($sport_images as $sport_image) { ?>
                                            <div class="block draggable-item mb-1" id="data-<?php echo $sport_image['id']; ?>">
                                                <div class="col-md-12 p-10 border">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <!-- <a class="btn btn-sm btn-rounded btn-alt-primary draggable-handler" href="javascript:void(0)">
                                                                <i class="si si-cursor-move"></i>
                                                            </a> -->
                                                            <!-- <a class="btn btn-sm btn-rounded btn-alt-secondary" href="<?php echo site_url('image/crop?back='.site_url('sport/images/'.$sport_image['sport_id']).'&image='.show_image(base_url('uploads/sports/images/'.$sport_image['image']), ['thumbnail' => '500_500'])); ?>"> -->
                                                                <!-- <i class="si si-crop"></i> -->
                                                            </a>
                                                            <a class="btn btn-sm btn-rounded btn-alt-danger delete-confirm" href="<?php echo site_url('upload/delete?id='.$sport_image['id'].'&table=sport_images&folder=uploads/sports/images'); ?>">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <img class="img-fluid options-item" width="400" src="<?php echo show_image(base_url('uploads/sports/images/'.$sport_image['image']), ['thumbnail' => '500_500']); ?>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    $(function() {
        var dropzone = new Dropzone("#dropzone");

        $("#dropzone").addClass("dropzone");

        dropzone.on("completemultiple", function(multiple){});

        $(".draggable-column").sortable({
            stop: function( ) {
                var order = $(".draggable-column").sortable("serialize", {key:'data[]'});
                $.ajax({
                    data: order,
                    dataType: "JSON",
                    type: "POST",
                    url: SITE_URL+"sort?table=sport_images",
                    success: function(response) {}
                })
            }
        });
    });
</script> -->
<script>
    $(function() {
        var dropzone = new Dropzone("#dropzone");

        dropzone.on("complete", function (file) {
            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                location.reload();
            }

            dropzone.removeFile(file);
        });
        $("#dropzone").addClass("dropzone");

        dropzone.on("completemultiple", function(multiple){});

        $(".draggable-column").sortable({
            stop: function( ) {
                var order = $(".draggable-column").sortable("serialize", {key:'data[]'});
                $.ajax({
                    data: order,
                    dataType: "JSON",
                    type: "POST",
                    url: SITE_URL+"sort?table=product_images",
                    success: function(response) {}
                })
            }
        });
    });
</script>
