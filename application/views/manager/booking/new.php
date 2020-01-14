<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">New Booking</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('manager/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Bookings</li>
                    <li class="breadcrumb-item active" aria-current="page">New</li>
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
                    <form method="post">
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
                        <hr>
                        <?php if($this->input->post('mobile')) { ?>
                            <button type="submit" class="btn btn-outline-success">Submit</button>
                        <?php } else{  ?>
                            <button type="submit" class="btn btn-outline-primary">Check</button>
                        <?php } ?>
                        <a href="<?php echo site_url('manager/bookings'); ?>" class="btn btn-outline-danger float-right">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>