<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('admin/layout/head'); ?>
</head>
<body class="vertical-layout">    
    <div id="infobar-settings-sidebar" class="infobar-settings-sidebar">
        <div class="infobar-settings-sidebar-head d-flex w-100 justify-content-between">
            <h4>Settings</h4><a href="javascript:void(0)" id="infobar-settings-close" class="infobar-settings-close"><img src="<?php echo base_url('resources/theme/images/svg-icon/close.svg'); ?>" class="img-fluid menu-hamburger-close" alt="close"></a>
        </div>
        <div class="infobar-settings-sidebar-body">
            <div class="custom-mode-setting">
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">New Bookings</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-first" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Enable SMS</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-fourth" checked /></div>
                </div>
            </div>
        </div>
    </div>
    <div class="infobar-settings-sidebar-overlay"></div>
    <div id="containerbar">
        <div class="leftbar">
            <div class="sidebar">
                <div class="logobar">
                    <a href="<?php echo site_url('admin/dashboard'); ?>" class="logo logo-large"><img src="<?php echo base_url('resources/theme/images/logo.png'); ?>" class="img-fluid" alt="logo"></a>
                    <a href="<?php echo site_url('admin/dashboard'); ?>" class="logo logo-small"><img src="<?php echo base_url('resources/theme/images/small_logo.svg'); ?>" class="img-fluid" alt="logo"></a>
                </div>
                <div class="navigationbar">
                    <ul class="vertical-menu">
                        <li class="<?php echo (isset($tab) && $tab == 'dashboard') ? 'active' : ''; ?>">
                            <a href="<?php echo site_url('manager/dashboard'); ?>">
                              <img src="<?php echo base_url('resources/theme/images/svg-icon/dashboard.svg'); ?>" class="img-fluid" alt="dashboard"><span>Dashboard</span>
                            </a>
                        </li>
                        <li class="<?php echo (isset($tab) && $tab == 'turfs') ? 'active' : ''; ?>">
                            <a href="<?php echo site_url('admin/turf/listing'); ?>">
                              <img src="<?php echo base_url('resources/theme/images/svg-icon/layouts.svg'); ?>" class="img-fluid" alt="dashboard"><span>Turfs</span>
                            </a>
                        </li>
                        <li class="<?php echo (isset($tab) && $tab == 'managers') ? 'active' : ''; ?>">
                            <a href="<?php echo site_url('admin/manager/listing'); ?>">
                              <img src="<?php echo base_url('resources/theme/images/svg-icon/user.svg'); ?>" class="img-fluid" alt="dashboard"><span>Managers</span>
                            </a>
                        </li>
                        <li class="<?php echo (isset($tab) && $tab == 'players') ? 'active' : ''; ?>">
                            <a href="<?php echo site_url('admin/player/listing'); ?>">
                              <img src="<?php echo base_url('resources/theme/images/svg-icon/user.svg'); ?>" class="img-fluid" alt="dashboard"><span>Players</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="rightbar">
            <div class="topbar-mobile">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="mobile-logobar">
                            <a href="<?php echo site_url('admin/dashboard'); ?>" class="mobile-logo"><img src="<?php echo base_url('resources/theme/images/logo.png'); ?>" class="img-fluid" alt="logo"></a>
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
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger" href="javascript:void();">
                                            <img src="<?php echo base_url('resources/theme/images/svg-icon/collapse.svg'); ?>" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                            <img src="<?php echo base_url('resources/theme/images/svg-icon/close.svg'); ?>" class="img-fluid menu-hamburger-close" alt="close">
                                         </a>
                                     </div>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="topbar">
                <div class="row align-items-center">
                    <div class="col-md-12 align-self-center">
                        <div class="togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger" href="javascript:void();">
                                           <img src="<?php echo base_url('resources/theme/images/svg-icon/collapse.svg'); ?>" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                           <img src="<?php echo base_url('resources/theme/images/svg-icon/close.svg'); ?>" class="img-fluid menu-hamburger-close" alt="close">
                                         </a>
                                     </div>
                                </li>
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
                        <div class="infobar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="settingbar">
                                        <a href="javascript:void(0)" id="infobar-settings-open" class="infobar-icon">
                                            <img src="<?php echo base_url('resources/theme/images/svg-icon/settings.svg'); ?>" class="img-fluid" alt="settings">
                                        </a>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="profilebar">
                                        <div class="dropdown">
                                          <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('resources/theme/images/users/profile.svg'); ?>" class="img-fluid" alt="profile"><span class="feather icon-chevron-down live-icon"></span></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                                <div class="dropdown-item">
                                                    <div class="profilename">
                                                      <h5><?php echo $this->admin['username']; ?></h5>
                                                    </div>
                                                </div>
                                                <div class="userbox">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="media dropdown-item">
                                                            <a href="<?php echo site_url('admin/profile'); ?>" class="profile-icon"><img src="<?php echo base_url('resources/theme/images/svg-icon/user.svg'); ?>" class="img-fluid" alt="user">Profile</a>
                                                        </li>                                                    
                                                        <li class="media dropdown-item">
                                                            <a href="<?php echo site_url('admin/logout'); ?>" class="profile-icon"><img src="<?php echo base_url('resources/theme/images/svg-icon/logout.svg'); ?>" class="img-fluid" alt="logout">Logout</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> 
            </div>