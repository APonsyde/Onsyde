<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Players</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Players</li>
                    <li class="breadcrumb-item active" aria-current="page">List</li>
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
                                    <th scope="col" width="20%">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Account</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($players)) { ?>
                                    <?php foreach($players as $player) { ?>
                                        <tr>
                                            <td><?php echo $player['full_name']; ?></td>
                                            <td><?php echo ($player['email']) ? $player['email'] : '-'; ?></td>
                                            <td><a href="tel:+91<?php echo $player['mobile']; ?>">+91<?php echo $player['mobile']; ?></a></td>
                                            <td>
                                                <?php if($player['inactive']) { ?>
                                                    <span class="badge badge-danger">Inactive</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-success">Active</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="<?php echo site_url('admin/player/view/'.$player['id']); ?>">View</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <th scope="row" colspan="5">No players registered yet!</th>
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