<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="<?php echo site_url(); ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Reset Password</strong></div>
        </div>
    </div>
</div>  
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php $this->load->view('front/layout/alert'); ?>
                <h2 class="h3 mb-3 text-black text-uppercase">Reset Password</h2>
                <form method="post">
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="text-black">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" placeholder="" value="<?php echo $this->input->post('password'); ?>">
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="text-black">Retype Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="retype_password" placeholder="" value="<?php echo $this->input->post('retype_password'); ?>">
                                <?php echo form_error('retype_password'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" name="type" value="Update Password">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>