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
                        <h2 class="">Turf Manager Login</h2>
                        <p>Enter your mobile number below to register.</p>
                            <form method="post" class="register">
                            <div class="mb-20">
                                <input type="text" class="inpt" name="mobile" placeholder="Mobile Number">
                                <?php echo form_error('mobile'); ?>
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