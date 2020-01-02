<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <?php $this->load->view('admin/layout/head'); ?>
</head>
<body>
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed side-trans-enabled">
        <nav id="sidebar">
            <div class="sidebar-content">
                <div class="content-header content-header-fullrow px-15">
                    <div class="content-header-section sidebar-mini-visible-b">
                        <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                            <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                        </span>
                    </div>
                    <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <div class="content-header-item">
                            <a class="link-effect font-w700" href="<?php echo site_url('admin/dashboard'); ?>">
                                <i class="si si-fire text-primary"></i>
                                <span class="font-size-xl text-dual-primary-dark"><?php echo PROJECT_NAME; ?></span>
                            </a>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li>
                            <a class="<?php echo ($tab == 'dashboard') ? 'active' : ''; ?>" href="<?php echo site_url('admin/dashboard'); ?>"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                        </li>
                        <li class="<?php echo ($tab == 'sport' || $tab == 'ground') ? 'open' : ''; ?>">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Master</span></a>
                            <ul>
                                <li>
                                    <a class="<?php echo ($tab == 'sport') ? 'active' : ''; ?>" href="<?php echo site_url('sport/listing'); ?>">Sports </a>
                                </li>
                                <li>
                                    <a class="<?php echo ($tab == 'ground') ? 'active' : ''; ?>" href="<?php echo site_url('ground/listing'); ?>">Grounds </a>
                                </li>
                                <li>
                                   <!--  <a class="<?php //echo ($tab == 'turf') ? 'active' : ''; ?>" href="<?php //echo site_url('turf/listing'); ?>"> Turf </a> -->
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo site_url('tournament/listing'); ?>"><i class="si si-layers"></i><span class="sidebar-mini-hide">Tournament</span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('player/listing'); ?>"><i class="si si-user"></i><span class="sidebar-mini-hide">Players</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <header id="page-header">
            <div class="content-header">
                <div class="content-header-section">
                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-navicon"></i>
                    </button>
                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="header_search_on">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <div class="content-header-section">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user d-sm-none"></i>
                            <span class="d-none d-sm-inline-block">Admin</span>
                            <i class="fa fa-angle-down ml-5"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                            <a class="dropdown-item mb-0" href="<?php echo site_url('admin/logout') ?>">
                                <i class="si si-logout mr-5"></i> Sign Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="page-header-search" class="overlay-header">
                <div class="content-header content-header-fullrow">
                    <form action="<?php echo site_url('product/listing'); ?>">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-secondary" data-toggle="layout" data-action="header_search_off">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <input type="text" name="search" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="page-header-loader" class="overlay-header bg-primary">
                <div class="content-header content-header-fullrow text-center">
                    <div class="content-header-item">
                        <i class="fa fa-sun-o fa-spin text-white"></i>
                    </div>
                </div>
            </div>
        </header>
        <main id="main-container">
            <div class="content">