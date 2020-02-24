<section class="main-block howit-work-wrap">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="booking manager-dashboard">
                    <form enctype="multipart/form-data" method="get" id="list-form">
                        <div class="flexpanel justify-between align-center mar-40">
                            <div class="wid-50">Status:
                                <select name="inactive" class="date wid100" onchange="$('#list-form').submit();">
                                    <option value="">-- All --</option>
                                    <option value="0" <?php echo (strlen($this->input->get('inactive')) && $this->input->get('inactive') == 0) ? 'selected' : ''; ?>>Enabled</option>
                                    <option value="1" <?php echo ($this->input->get('inactive') == 1) ? 'selected' : ''; ?>>Disabled</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div style="overflow-x:auto;" class="wid100 mt-3">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" width="10%">#</th>
                                    <th scope="col" width="70%">Title</th>
                                    <th scope="col" width="10%">Status</th>
                                    <th scope="col" width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($podcasts)) { ?>
                                    <?php foreach($podcasts as $podcast) { ?>
                                        <tr>
                                            <td><?php echo $podcast['id']; ?></td>
                                            <td><?php echo $podcast['title']; ?></td>
                                            <td>
                                                <?php if($podcast['inactive']) { ?>
                                                    <span class="badge badge-danger">Disabled</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-success">Enabled</span>
                                                <?php } ?>
                                            </td>
                                            <td><a class="btn btn-dark" href="<?php echo site_url('admin/content/edit/podcast/'.$podcast['id']); ?>">Edit</a></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <th scope="row" colspan="4">No podcasts added yet!</th>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>