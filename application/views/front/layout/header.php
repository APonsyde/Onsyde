<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('front/layout/head'); ?>
</head>
<body>
    <div class="nav-menu sticky-top">
        <div class="bg transition">
            <div class="container-fluid fixed">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php echo base_url('resources/front/images/logo.png'); ?>" alt="logo"></a>
                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 amber-border" type="text" placeholder="Find Your Turf" aria-label="Search">
                                <div class="input-group-append app">
                                    <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fa fa-search text-grey"
                                        aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="<?php echo site_url('manager'); ?>">Are you a Turf Manager?</a>
                                    </li>
                                    <li class="nav-item dropdown greenborder">
                                        <a class="nav-link" href="<?php echo site_url('player'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Player Login </a>
                                    </li>
                                </ul>
                                <a class="burger" type="button">
                                    <span class="ti-menu"></span>
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="links">
                <ul>
                    <li><a href="<?php echo site_url('about-us'); ?>">About Us</a></li>
                    <li><a href="<?php echo site_url('contact-us'); ?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>