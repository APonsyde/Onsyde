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
                            </form>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <ul class="navbar-nav align-center">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="profilepic"> </span> Admin <span class="ti-angle-down"></span></a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?php echo site_url('admin/logout'); ?>">Logout</a>
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
                    <a href="<?php echo site_url('admin/dashboard'); ?>" class="list-group-item <?php echo (isset($tab) && $tab == 'dashboard') ? 'active' : '' ?>">Dashboard</a>
                    <a href="<?php echo site_url('admin/turf/listing'); ?>" class="list-group-item <?php echo (isset($tab) && $tab == 'turfs') ? 'active' : '' ?>">Turfs</a>
                    <a href="<?php echo site_url('admin/manager/listing'); ?>" class="list-group-item <?php echo (isset($tab) && $tab == 'managers') ? 'active' : '' ?>">Managers</a>
                    <a href="<?php echo site_url('admin/player/listing'); ?>" class="list-group-item <?php echo (isset($tab) && $tab == 'players') ? 'active' : '' ?>">Players</a>
                    <a href="<?php echo site_url('admin/content/blogs'); ?>" class="list-group-item <?php echo (isset($tab) && $tab == 'blogs') ? 'active' : '' ?>">Blogs</a>
                    <a href="<?php echo site_url('admin/content/podcasts'); ?>" class="list-group-item <?php echo (isset($tab) && $tab == 'podcasts') ? 'active' : '' ?>">Podcasts</a>
                    <a href="<?php echo site_url('admin/logout'); ?>" class="list-group-item">Logout</a>
                </div>
            </aside>
            <div class="wid80">