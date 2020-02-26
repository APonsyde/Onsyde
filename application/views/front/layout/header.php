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
                        <nav class="navbar navbar-expand-lg" style="min-height: 64px;">
                            <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php echo base_url('resources/front/images/logo.png'); ?>" alt="logo"></a>
                            <form action="<?php echo site_url('find-a-turf/grouped'); ?>" class="wid100">
                                <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
                                <div class="input-group md-form form-sm form-2 pl-0">
                                    <input class="form-control my-0 amber-border" type="text" name="search" placeholder="Find Your Turf" aria-label="Search">
                                    <div class="input-group-append app">
                                        <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fa fa-search text-grey"
                                            aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </form>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <?php if(!$this->session->userdata('player_id') && !$this->session->userdata('manager_id')) { ?>
                                    <ul class="navbar-nav">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="<?php echo site_url('manager'); ?>">Are you a Turf Manager?</a>
                                        </li>
                                        <li class="nav-item dropdown greenborder">
                                            <a class="nav-link" href="<?php echo site_url('player'); ?>"  aria-haspopup="true" aria-expanded="false"> Player Login </a>
                                        </li>
                                    </ul>
                                <?php } ?>
                                <?php if($this->session->userdata('player_id') || $this->session->userdata('manager_id')) { ?>
                                    <ul class="navbar-nav align-center">
                                        <?php if($this->session->userdata('player_id')) { ?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="profilepic"> </span> <?php echo $this->session->userdata('player_name'); ?> <span class="ti-angle-down"></span></a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?php echo site_url('bookings'); ?>">My Bookings</a>
                                                    <a class="dropdown-item" href="<?php echo site_url('player/profile'); ?>">Profile</a>
                                                    <a class="dropdown-item" href="<?php echo site_url('player/logout'); ?>">Logout</a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        <?php if($this->session->userdata('manager_id')) { ?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="profilepic"> </span> <?php echo $this->session->userdata('manager_name'); ?> <span class="ti-angle-down"></span></a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?php echo site_url('manager/dashboard'); ?>">Dashboard</a>
                                                    <a class="dropdown-item" href="<?php echo site_url('manager/profile'); ?>">Profile</a>
                                                    <a class="dropdown-item" href="<?php echo site_url('manager/logout'); ?>">Logout</a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>