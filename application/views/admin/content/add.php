<div class="booking manager-dashboard">
    <div class="">
        <?php if(trim($tab, 's') == 'blog') { ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $this->input->post('title'); ?>">
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Description</label>
                        <textarea id="summernote" class="form-control" name="description" placeholder="Description"><?php echo $this->input->post('description'); ?></textarea>
                        <?php echo form_error('description'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Image</label>
                        <br clear="all">
                        <input type="file" name="image">
                        <?php echo form_error('image'); ?>
                    </div>
                </div>
                <div class="flexpanel justify-between">
                    <button class="greyBtn green">Add</button>
                    <a href="<?php echo site_url('admin/content/blogs'); ?>" class="back">Back →</a>
                </div>
            </form>
        <?php } else { ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $this->input->post('title'); ?>">
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>URL</label>
                        <input type="text" class="form-control" name="url" placeholder="URL" value="<?php echo $this->input->post('url'); ?>">
                        <?php echo form_error('url'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Image</label>
                        <br clear="all">
                        <input type="file" name="image">
                        <?php echo form_error('image'); ?>
                    </div>
                </div>
                <div class="flexpanel justify-between">
                    <button class="greyBtn green">Add</button>
                    <a href="<?php echo site_url('admin/content/podcasts'); ?>" class="back">Back →</a>
                </div>
            </form>
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            tabsize: 2,
            height: 400,
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
            ]
          });
    });
</script>