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
                            <input type="hidden" class="form-control" name="mobile" value="<?php echo $this->input->get('mobile'); ?>">
                            <div class="mb-20">
                                <input type="password" class="inpt" name="password" placeholder="Password">
                                <?php echo form_error('password'); ?>
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