<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('manager/layout/head'); ?>
</head>
<body class="vertical-layout">
    <div id="containerbar" class="containerbar authenticate-bg">
        <div class="container">
            <div class="auth-box login-box">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="auth-box-right">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-head">
                                            <a href="<?php echo site_url(); ?>" class="logo"><img src="<?php echo base_url('resources/theme/images/logo.png'); ?>" class="img-fluid" alt="logo"></a>
                                        </div>                                        
                                        <h4 class="text-primary my-4">Player - Sign Up !</h4>
                                        <?php $this->load->view('front/layout/alert'); ?>
                                        <input type="hidden" class="form-control" name="mobile" value="<?php echo $this->input->get('mobile'); ?>">
                                        <input type="hidden" class="form-control" name="otp" value="<?php echo $this->input->get('otp'); ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="full_name" placeholder="Name" value="<?php echo $this->input->post('full_name'); ?>">
                                            <?php echo form_error('full_name'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="email" placeholder="Email address" value="<?php echo $this->input->post('email'); ?>">
                                            <?php echo form_error('email'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $this->input->post('password'); ?>">
                                            <?php echo form_error('password'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="retype_password" placeholder="Retype password" value="<?php echo $this->input->post('retype_password'); ?>">
                                            <?php echo form_error('retype_password'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-lg btn-block font-18">Register</button>
                                    <p class="mb-0 mt-3">Go back to home? <a href="<?php echo site_url(); ?>">Home</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('manager/layout/foot'); ?>
</body>
</html>