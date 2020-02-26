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
                                <a class="greyBtn green" href="<?php echo site_url('admin/player/view/'.$player['id']); ?>">View</a>
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