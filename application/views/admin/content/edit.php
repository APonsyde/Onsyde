<div class="booking manager-dashboard">
    <div class="">
        <?php if(trim($tab, 's') == 'blog') { ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo ($this->input->post('title')) ? $this->input->post('title') : $blog['title']; ?>">
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Description</label>
                        <textarea class="form-control" id="summernote" name="description" placeholder="Description"><?php echo ($this->input->post('description')) ? $this->input->post('description') : $blog['description']; ?></textarea>
                        <?php echo form_error('description'); ?>
                    </div>
                </div>
                <div class="mt-1 mb-3">
                    <img class="img-fluid options-item" width="500px" src="<?php echo show_image(base_url('uploads/blogs/images/'.$blog['image'])); ?>" alt="">
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
                    <button class="greyBtn green">Save</button>
                    <a href="<?php echo site_url('admin/content/blogs'); ?>" class="back">Back →</a>
                </div>
            </form>
        <?php } else { ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo ($this->input->post('title')) ? $this->input->post('title') : $podcast['title']; ?>">
                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>URL</label>
                        <input type="text" class="form-control" name="url" placeholder="URL" value="<?php echo ($this->input->post('title')) ? $this->input->post('title') : $podcast['url']; ?>">
                        <?php echo form_error('url'); ?>
                    </div>
                </div>
                <div class="mt-1 mb-3">
                    <img class="img-fluid options-item" width="100px" src="<?php echo show_image(base_url('uploads/podcasts/images/'.$podcast['image'])); ?>" alt="">
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
                    <button class="greyBtn green">Save</button>
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