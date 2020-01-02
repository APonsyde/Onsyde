<!doctype html>
<html lang="en" class="no-focus">
<head>
    <?php $this->load->view('admin/layout/head'); ?>
</head>
<body>
    <div id="page-container" class="main-content-boxed">
        <main id="main-container">
            <div class="bg-image" style="background-image: url('<?php echo base_url('resources/admin/media/photos/photo34@2x.jpg'); ?>');">
                <div class="row mx-0 bg-black-op">
                    <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                        <div class="p-30 invisible" data-toggle="appear">
                            <p class="font-size-h3 font-w600 text-white">
                                Get Inspired and Create.
                            </p>
                            <p class="font-italic text-white-op">
                                Copyright &copy; <span class="js-year-copy">2017</span>
                            </p>
                        </div>
                    </div>
                    <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">
                        <div class="content content-full">
                            <div class="px-30 py-10">
                                <a class="link-effect font-w700" href="<?php echo site_url('admin'); ?>">
                                    <i class="si si-fire"></i>
                                    <span class="font-size-xl text-primary-dark"><?php echo PROJECT_NAME; ?></span>
                                </a>
                                <h1 class="h3 font-w700 mt-50 mb-10">Admin - Login</h1>
                            </div>
                            <form class="js-validation-signin px-30" method="post">
                                <?php $this->load->view('admin/layout/alert'); ?>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <input type="text" class="form-control" id="login-username" name="username">
                                            <label for="login-username">Username</label>
                                            <?php echo form_error('username'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <input type="password" class="form-control" id="login-password" name="password">
                                            <label for="login-password">Password</label>
                                            <?php echo form_error('password'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                                        <i class="si si-login mr-10"></i> Sign In
                                    </button>
                                    <div class="mt-30">
                                        <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="<?php echo site_url('admin/forgot-password'); ?>">
                                            <i class="fa fa-warning mr-5"></i> Forgot Password
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php $this->load->view('admin/layout/foot'); ?>
</body>
</html>