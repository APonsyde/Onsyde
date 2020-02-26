<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('manager/layout/head'); ?>
</head>
<body>
    <div class="nav-menu sticky-top">
        <div class="bg transition">
            <div class="container-fluid fixed">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php echo base_url('resources/front/images/logo.png'); ?>" alt="logo"></a>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <ul class="navbar-nav align-center">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="profilepic"> </span> <?php echo $this->manager['name']; ?> <span class="ti-angle-down"></span></a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?php echo site_url('manager/profile'); ?>">Profile</a>
                                            <a class="dropdown-item" href="<?php echo site_url('manager/logout'); ?>">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="howit-work-wrap">
        <div class="flexpanel"> 
            <aside class="px-0 wid20" id="left">
                <div class="list-group fixed-top">
                    <a href="<?php echo site_url('manager/dashboard'); ?>" class="list-group-item <?php echo (isset($tab) && $tab == 'dashboard') ? 'active' : '' ?>">Dashboard</a>
                    <a href="<?php echo site_url('manager/booking/create'); ?>" class="list-group-item <?php echo (isset($tab) && $tab == 'booking_new') ? 'active' : '' ?>">+ New Booking</a>
                    <a href="<?php echo site_url('manager/bookings'); ?>" class="list-group-item <?php echo (isset($tab) && $tab == 'bookings') ? 'active' : '' ?>">Bookings</a>
                    <a href="<?php echo site_url('manager/turf/create'); ?>" class="list-group-item <?php echo (isset($tab) && $tab == 'turf_new') ? 'active' : '' ?>">Add new Turf</a>
                    <a href="<?php echo site_url('manager/turf/listing'); ?>" class="list-group-item <?php echo (isset($tab) && $tab == 'turfs') ? 'active' : '' ?>">List all Turfs</a>
                    <a href="<?php echo site_url('manager/logout'); ?>" class="list-group-item">Logout</a>
                </div>
            </aside>
            <div class="wid80">