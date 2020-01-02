<?php $this->load->view('admin/layout/alert'); ?>
<div class="bg-body-light border-b">
	<div class="content py-5 text-center">
		<nav class="breadcrumb bg-body-light mb-0">
			<a class="breadcrumb-item" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
			<a class="breadcrumb-item" href="<?php echo site_url('tournament/listing'); ?>">Tournament</a>
			<span class="breadcrumb-item active">Edit</span>
		</nav>
	</div>
</div>
<h2 class="content-heading">tournament - <?php echo $tournament['tournament_name']; ?></h2>
<div class="row gutters-tiny">
	<div class="col-md-4">
		<div class="list-group">
			<a href="<?php echo site_url('tournament/edit/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1">Info</h5>
				</div>
				<p class="mb-1">Name, ground, sports of tournament.</p>
			</a>
			<a href="<?php echo site_url('tournament/detailing/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1">Tournament Detailing</h5>
				</div>
				<p class="mb-1">Detailing, rules of tournament.</p>
			</a>
			<a href="<?php echo site_url('tournament/images/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1">Tournament Images</h5>
				</div>
				<p class="mb-1">Upload images for the tournament.</p>
			</a>
            <a href="<?php echo site_url('tournament/teams/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Tournament Teams</h5>
                </div>
                <p class="mb-1">Team listing of tournament.</p>
            </a>
            <a href="<?php echo site_url('tournament/players/'.$tournament['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Tournament Individual Players</h5>
                </div>
                <p class="mb-1">Reserved Players listing of tournament.</p>
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
                                <a href="<?php echo site_url('tournament/listing'); ?>" class="btn btn-sm btn-alt-primary">
                                    <i class="fa fa-save mr-5"></i>Save
                                </a>
                            </div>
                    </div>
                    <div class="block-content block-content-full">
                        <form id="dropzone" action="<?php echo site_url('upload/tournament/'.$tournament['id']); ?>"></form>
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
                                <a href="<?php echo site_url('tournament/listing'); ?>" class="btn btn-sm btn-alt-primary">
                                    <i class="fa fa-save mr-5"></i>Save
                                </a>
                            </div>
                    </div>
                    <div class="block-content block-content-full p-1">
                        <div class="gutters-tiny items-push">
                            <div class="js-draggable-items mb-0">
                                <div class="draggable-column">
                                    <?php if(!empty($tournament_images)) { ?>
                                        <?php foreach($tournament_images as $tournament_image) { ?>
                                            <div class="block draggable-item mb-1" id="data-<?php echo $tournament_image['id']; ?>">
                                                <div class="col-md-12 p-10 border">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <!-- <a class="btn btn-sm btn-rounded btn-alt-primary draggable-handler" href="javascript:void(0)">
                                                                <i class="si si-cursor-move"></i>
                                                            </a> -->
                                                            <!-- <a class="btn btn-sm btn-rounded btn-alt-secondary" href="<?php echo site_url('image/crop?back='.site_url('tournament/images/'.$tournament_image['tournament_id']).'&image='.show_image(base_url('uploads/tournaments/images/'.$tournament_image['image']), ['thumbnail' => '500_500'])); ?>"> -->
                                                                <!-- <i class="si si-crop"></i> -->
                                                            </a>
                                                            <a class="btn btn-sm btn-rounded btn-alt-danger delete-confirm" href="<?php echo site_url('upload/delete?id='.$tournament_image['id'].'&table=tournament_images&folder=uploads/tournaments/images'); ?>">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <img class="img-fluid options-item" width="400" src="<?php echo show_image(base_url('uploads/tournaments/images/'.$tournament_image['image']), ['thumbnail' => '500_500']); ?>" alt="">
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
                    url: SITE_URL+"sort?table=tournament_images",
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
