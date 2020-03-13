<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('manager/layout/head'); ?>
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
                        <h2 class="">Forgot Password?</h2>
                        <p>Enter your number.</p>
                        <form method="post" class="register">
                            <input type="hidden" class="form-control" name="mobile" value="<?php echo $this->input->get('mobile'); ?>">
                            <div class="mb-20">
                                <input type="text" class="inpt" name="mobile" placeholder="Enter your mobile number">
                                <?php echo form_error('mobile'); ?>
                            </div>
                            <div class="btn-search">
                                <button class="btn btn-simple">Enter →</button>
                            </div>
                            <p class="mb-0 mt-3">Remember password? <a href="<?php echo site_url('manager'); ?>">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('manager/layout/foot'); ?>
</body>
</html>