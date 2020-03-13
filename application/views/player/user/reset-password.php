<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('front/layout/head'); ?>
</head>
<body>
    <section class="loginPage">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-4 ml-auto mr-auto center-screen">
                    <a class="logo">
                        <img src="<?php echo base_url('resources/theme/images/logo.png'); ?>">
                    </a>
                    <div class="titile-block">
                        <h2 class="">Verify Password</h2>
                        <p>Enter the password.</p>
                        <form method="post" class="register">
                            <div class="mb-20">
                                <input type="number" class="inpt" name="otp" placeholder="Enter the OTP sent to you" value="<?php echo $this->input->post('otp'); ?>">
                                <?php echo form_error('otp'); ?>
                            </div>
                            <div class="mb-20">
                                <input type="password" class="inpt" name="password" placeholder="Enter new password" value="<?php echo $this->input->post('password'); ?>">
                                <?php echo form_error('password'); ?>
                            </div>
                            <div class="mb-20">
                                <input type="password" class="inpt" name="retype_password" placeholder="Retype new password" value="<?php echo $this->input->post('retype_password'); ?>">
                                <?php echo form_error('retype_password'); ?>
                            </div>
                            <div class="btn-search">
                                <button class="btn btn-simple">Update →</button>
                            </div>
                            <p class="mb-0 mt-3">Remember password? <a href="<?php echo site_url('player'); ?>">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('front/layout/foot'); ?>
</body>
</html>