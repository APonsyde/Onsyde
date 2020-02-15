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
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="ti-menu"></span>
                            </button>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                       <div class="input-group md-form form-sm form-2 pl-0">
                                          <input class="form-control my-0 py-1 amber-border" type="text" placeholder="Find Your Turf" aria-label="Search">
                                          <div class="input-group-append app">
                                            <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fa fa-search text-grey"
                                                aria-hidden="true"></i></span>
                                          </div>
                                        </div>
                                    </li>
                                    <li class="nav-item login">
                                        <a class="nav-link" href="login.html" data-toggle="modal" data-target="#exampleModal">Login</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>