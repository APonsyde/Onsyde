<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Add</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('manager/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Content</li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </div>
        </div>
    </div>          
</div>
<div class="contentbar">
    <?php $this->load->view('front/layout/alert'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
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
                                    <textarea class="form-control" name="description" placeholder="Description"><?php echo $this->input->post('description'); ?></textarea>
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
                            <hr>
                            <button type="submit" class="btn btn-outline-success">Add</button>
                            <a href="<?php echo site_url('admin/content/blogs'); ?>" class="btn btn-outline-danger float-right">Cancel</a>
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
                            <hr>
                            <button type="submit" class="btn btn-outline-success">Add</button>
                            <a href="<?php echo site_url('admin/content/podcasts'); ?>" class="btn btn-outline-danger float-right">Cancel</a>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>