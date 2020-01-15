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
                                    <div class="logobar p-1 m-0">
                                        <a href="<?php echo site_url(); ?>" class="logo logo-large"><img src="<?php echo base_url('resources/theme/images/logo.png'); ?>" class="img-fluid" alt="logo"></a>
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
                                        <a href="<?php echo site_url('find-a-turf/individual'); ?>">
                                            Find a Turf
                                        </a>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="profilebar" style="position: relative; top: 7px;">
                                        <div class="dropdown">
                                          <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('resources/theme/images/users/profile.svg'); ?>" class="img-fluid" alt="profile"><span class="feather icon-chevron-down live-icon"></span></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                                <?php if($this->player['id']) { ?>
                                                    <div class="dropdown-item">
                                                        <div class="profilename">
                                                          <h5><?php echo $this->player['name']; ?></h5>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="userbox">
                                                    <ul class="list-unstyled mb-0">
                                                        <?php if($this->player['id']) { ?>
                                                            <li class="media dropdown-item">
                                                                <a href="<?php echo site_url('player/bookings'); ?>" class="profile-icon"><img src="<?php echo base_url('resources/theme/images/svg-icon/layouts.svg'); ?>" class="img-fluid" alt="user">My Bookings</a>
                                                            </li>
                                                            <li class="media dropdown-item">
                                                                <a href="<?php echo site_url('player/profile'); ?>" class="profile-icon"><img src="<?php echo base_url('resources/theme/images/svg-icon/user.svg'); ?>" class="img-fluid" alt="user">Profile</a>
                                                            </li>
                                                            <li class="media dropdown-item">
                                                                <a href="<?php echo site_url('player/logout'); ?>" class="profile-icon"><img src="<?php echo base_url('resources/theme/images/svg-icon/logout.svg'); ?>" class="img-fluid" alt="logout">Logout</a>
                                                            </li>
                                                        <?php } else { ?>
                                                            <li class="media dropdown-item">
                                                                <a href="<?php echo site_url('player') ?>" class="profile-icon"><img src="<?php echo base_url('resources/theme/images/svg-icon/user.svg'); ?>" class="img-fluid" alt="user">Login</a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
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