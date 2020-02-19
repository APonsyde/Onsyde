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
                        <h2 class="">Admin Login</h2>
                        <?php $this->load->view('manager/layout/alert'); ?>
                        <form method="post" class="register">
                            <div class="mb-20">
                                <input type="text" class="inpt" name="username" placeholder="Enter your username">
                                <?php echo form_error('username'); ?>
                            </div>
                            <div class="mb-20">
                                <input type="password" class="inpt" name="password" placeholder="Enter the password">
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