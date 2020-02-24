<section class="main-block howit-work-wrap">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="booking manager-dashboard">
                    <div class="">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control" name="mobile" placeholder="Mobile" value="<?php echo $this->input->post('mobile'); ?>">
                                    <?php echo form_error('mobile'); ?>
                                </div>
                            </div>
                            <?php if($this->input->post('mobile')) { ?>
                                <?php
                                    $name = null;
                                    if($this->input->post('full_name'))
                                        $name = $this->input->get('full_name');
                                    else if(!empty($player['full_name']))
                                        $name = $player['full_name'];
                                ?>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="full_name" placeholder="Name" value="<?php echo $name; ?>">
                                        <?php echo form_error('full_name'); ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="flexpanel justify-between">
                                <?php if($this->input->post('mobile')) { ?>
                                    <button type="submit" class="greyBtn green">Submit</button>
                                <?php } else{  ?>
                                    <button type="submit" class="greyBtn green">Check</button>
                                <?php } ?>
                                <a href="<?php echo site_url('manager/bookings'); ?>" class="redbg">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>