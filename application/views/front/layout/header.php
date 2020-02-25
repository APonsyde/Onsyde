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
                                <input class="form-control my-0 amber-border" type="text" placeholder="Find Your Turf" aria-label="Search">
                                <div class="input-group-append app">
                                    <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fa fa-search text-grey"
                                        aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <ul class="navbar-nav hide">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="<?php echo site_url('manager'); ?>">Are you a Turf Manager?</a>
                                    </li>
                                    <li class="nav-item dropdown greenborder">
                                        <a class="nav-link" href="<?php echo site_url('player'); ?>"  aria-haspopup="true" aria-expanded="false"> Player Login </a>
                                        <!-- <div class="dropdown-menu">
                                            <a class="dropdown-item" href="blog.html">Blog Listing</a>
                                            <a class="dropdown-item" href="blog-two.html">Blog Layout Two</a>
                                            <a class="dropdown-item" href="blog-detail.html">Blog Detail</a>
                                        </div> -->
                                    </li>
                                </ul>
                                <ul class="navbar-nav align-center">
                                <li class="nav-item dropdown">
                                        <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="profilepic"> </span> XYZ <span class="ti-angle-down"></span></a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="blog.html">Blog Listing</a>
                                            <a class="dropdown-item" href="blog-two.html">Blog Layout Two</a>
                                            <a class="dropdown-item" href="blog-detail.html">Blog Detail</a>
                                        </div>
                                    </li>
                                    <!-- <li class="nav-item active">
                                        <a class="nav-link" href="<?php echo site_url('manager'); ?>"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Yohan Dalvi <span class="ti-angle-down"></span></a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="blog.html">Blog Listing</a>
                                            <a class="dropdown-item" href="blog-two.html">Blog Layout Two</a>
                                            <a class="dropdown-item" href="blog-detail.html">Blog Detail</a>
                                        </div>
                                    </li> -->

                                </ul>
                                <!-- <a class="burger" type="button">
                                    <span class="ti-menu"></span>
                                </a> -->
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="links">
                <ul>
                    <li><a href="<?php echo site_url('about-us'); ?>">About Us</a></li>
                    <li><a href="<?php echo site_url('contact-us'); ?>">Contact</a></li>
                    <?php if($this->session->userdata('admin_id')) { ?>
                        <hr>
                        <li><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
                        <li><a href="<?php echo site_url('admin/turf/listing'); ?>">Turfs</a></li>
                        <li><a href="<?php echo site_url('admin/manager/listing'); ?>">Managers</a></li>
                        <li><a href="<?php echo site_url('admin/player/listing'); ?>">Players</a></li>
                        <li><a href="<?php echo site_url('admin/content/blogs'); ?>">Blogs</a></li>
                        <li><a href="<?php echo site_url('admin/content/podcasts'); ?>">Podcasts</a></li>
                        <li><a href="<?php echo site_url('admin/logout'); ?>">Logout</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('manager_id')) { ?>
                        <hr>
                        <li><a href="<?php echo site_url('manager/dashboard'); ?>">Dashboard</a></li>
                        <li><a href="<?php echo site_url('manager/booking/create'); ?>">+ New Booking</a></li>
                        <li><a href="<?php echo site_url('manager/bookings'); ?>">Bookings</a></li>
                        <li><a href="<?php echo site_url('manager/turf/create'); ?>">Add new Turf</a></li>
                        <li><a href="<?php echo site_url('manager/turf/listing'); ?>">List all Turfs</a></li>
                        <li><a href="<?php echo site_url('manager/logout'); ?>">Logout</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('player_id')) { ?>
                        <hr>
                        <li><a href="<?php echo site_url('bookings'); ?>">Bookings</a></li>
                        <li><a href="<?php echo site_url('player/logout'); ?>">Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>