<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Blogs</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Content</li>
                    <li class="breadcrumb-item active" aria-current="page">Blogs</li>
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
                <form enctype="multipart/form-data" method="get" id="list-form">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Status :</label>
                                    <select name="inactive" class="form-control" onchange="$('#list-form').submit();">
                                        <option value="">-- All --</option>
                                        <option value="0" <?php echo (strlen($this->input->get('inactive')) && $this->input->get('inactive') == 0) ? 'selected' : ''; ?>>Enabled</option>
                                        <option value="1" <?php echo ($this->input->get('inactive') == 1) ? 'selected' : ''; ?>>Disabled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%">#</th>
                                    <th scope="col" width="70%">Title</th>
                                    <th scope="col" width="10%">Status</th>
                                    <th scope="col" width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($blogs)) { ?>
                                    <?php foreach($blogs as $blog) { ?>
                                        <tr>
                                            <td><?php echo $blog['id']; ?></td>
                                            <td><?php echo $blog['title']; ?></td>
                                            <td>
                                                <?php if($blog['inactive']) { ?>
                                                    <span class="badge badge-danger">Disabled</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-success">Enabled</span>
                                                <?php } ?>
                                            </td>
                                            <td><a class="btn btn-dark" href="<?php echo site_url('admin/content/edit/blog/'.$blog['id']); ?>">Edit</a></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <th scope="row" colspan="4">No blogs added yet!</th>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>