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
                        <h2 class="">Player Registration</h2>
                        <p>Enter your details below to register.</p>
                        <form method="post" class="register">
                            <?php $this->load->view('front/layout/alert'); ?>
                            <input type="hidden" class="form-control" name="mobile" value="<?php echo $this->input->get('mobile'); ?>">
                            <input type="hidden" class="form-control" name="otp" value="<?php echo $this->input->get('otp'); ?>">
                            <div class="mb-20">
                                <?php
                                    if($this->input->post('full_name'))
                                        $name = $this->input->post('full_name');
                                ?>
                                <input type="text" class="inpt" name="full_name" placeholder="Name" value="<?php echo $name; ?>">
                                <?php echo form_error('full_name'); ?>
                            </div>
                            <div class="mb-20">
                                <input type="text" class="inpt" name="email" placeholder="Email" value="<?php echo $this->input->post('email'); ?>">
                                <?php echo form_error('email'); ?>
                            </div>
                            <div class="mb-20">
                                <input type="password" class="inpt" name="password" placeholder="Create Password" value="<?php echo $this->input->post('password'); ?>">
                                <?php echo form_error('password'); ?>
                            </div>
                            <div class="mb-20">
                                <input type="password" class="inpt" name="retype_password" placeholder="Confirm Password" value="<?php echo $this->input->post('retype_password'); ?>">
                                <?php echo form_error('retype_password'); ?>
                            </div>
                            <div class="btn-search">
                                <button class="btn btn-simple">Enter →</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('front/layout/foot'); ?>
</body>
</html>