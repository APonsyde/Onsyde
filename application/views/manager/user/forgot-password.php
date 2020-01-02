<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="<?php echo site_url(); ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Forgot Password</strong></div>
        </div>
    </div>
</div>  
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php $this->load->view('front/layout/alert'); ?>
                <h2 class="h3 mb-3 text-black text-uppercase">Forgot Password</h2>
                <form method="post">
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="text-black">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="" value="<?php echo $this->input->post('email'); ?>">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" name="type" value="Reset Password">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>