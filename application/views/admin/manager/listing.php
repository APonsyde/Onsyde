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
                    <th scope="col" width="20%">Company Name</th>
                    <th scope="col" width="20%">Contact Person</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Access</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($managers)) { ?>
                    <?php foreach($managers as $manager) { ?>
                        <tr>
                            <td><?php echo $manager['company_name']; ?></td>
                            <td><?php echo $manager['contact_person']; ?></td>
                            <td><?php echo ($manager['email']) ? $manager['email'] : '-'; ?></td>
                            <td><a href="tel:+91<?php echo $manager['mobile']; ?>">+91<?php echo $manager['mobile']; ?></a></td>
                            <td>
                                <?php if($manager['inactive']) { ?>
                                    <span class="badge badge-danger">Disabled</span>
                                <?php } else { ?>
                                    <span class="badge badge-success">Enabled</span>
                                <?php } ?>
                            </td>
                            <td><a class="btn btn-dark" href="<?php echo site_url('admin/manager/status/'.$manager['id']); ?>">Switch Status</a></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <th scope="row" colspan="6">No managers registered yet!</th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>