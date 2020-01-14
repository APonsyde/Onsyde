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
                                        <h4 class="text-primary my-4">Admin - Log in!</h4>
                                        <?php $this->load->view('manager/layout/alert'); ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username" placeholder="Enter your username">
                                            <?php echo form_error('username'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Enter the password">
                                            <?php echo form_error('password'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-lg btn-block font-18">Log in</button>
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