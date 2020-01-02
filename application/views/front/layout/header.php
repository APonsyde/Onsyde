<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('front/layout/head'); ?>
</head>
<body class="vertical-layout">
    <div class="infobar-settings-sidebar-overlay"></div>
    <div id="containerbar">
        <div class="rightbar ml-0">
            <div class="topbar-mobile">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="mobile-logobar">
                            <a href="<?php echo site_url(); ?>" class="mobile-logo"><img src="<?php echo base_url('resources/theme/images/logo.png'); ?>" class="img-fluid" alt="logo"></a>
                        </div>
                        <div class="mobile-togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="topbar-toggle-icon">
                                        <a class="topbar-toggle-hamburger" href="javascript:void();">
                                            <img src="<?php echo base_url('resources/theme/images/svg-icon/horizontal.svg'); ?>" class="img-fluid menu-hamburger-horizontal" alt="horizontal">
                                            <img src="<?php echo base_url('resources/theme/images/svg-icon/verticle.svg'); ?>" class="img-fluid menu-hamburger-vertical" alt="verticle">
                                         </a>
                                     </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="topbar" style="left: 0;">
                <div class="row align-items-center">
                    <div class="col-md-12 align-self-center">
                        <div class="togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="searchbar">
                                        <form>
                                            <div class="input-group">
                                              <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                              <div class="input-group-append">
                                                <button class="btn" type="submit" id="button-addon2"><img src="<?php echo base_url('resources/theme/images/svg-icon/search.svg'); ?>" class="img-fluid" alt="search"></button>
                                              </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="infobar p-2">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item mr-3">
                                    <div class="settingbar">
                                        <a href="<?php echo site_url(); ?>">
                                            Home
                                        </a>
                                    </div>
                                </li>
                                <li class="list-inline-item mr-3">
                                    <div class="settingbar">
                                        <a href="<?php echo site_url('how-it-works'); ?>">
                                            How it Works
                                        </a>
                                    </div>
                                </li>
                                <li class="list-inline-item mr-3">
                                    <div class="settingbar">
                                        <a href="#">
                                            Find a Turf
                                        </a>
                                    </div>
                                </li>
                                <li class="list-inline-item mr-3">
                                    <div class="settingbar">
                                        <a href="#">
                                            Players
                                        </a>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="settingbar">
                                        <a class="btn btn-primary" href="<?php echo site_url('manager'); ?>">
                                            Turf Manager
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> 
            </div>