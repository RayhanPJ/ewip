<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>E-Wip</title>

        <meta name="description" content="Production Control  &amp; PT. Century Batteries Indonesia">
        <meta name="author" content="Rinta Setyo Nugroho">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Production Control  &amp; PT. Century Batteries Indonesia">
        <meta property="og:site_name" content="Production Control">
        <meta property="og:description" content="Production Control  &amp; PT. Century Batteries Indonesia">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/media/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url(); ?>assets/media/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/media/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->

        <!-- Fonts and Codebase framework -->
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700"> -->
        <link rel="stylesheet" id="css-main" href="<?php echo base_url(); ?>assets/css/codebase.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/plugins/jquery-auto-complete/jquery.auto-complete.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/buttons.dataTables.min.css">

        

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="<?php echo base_url(); ?>assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->

        <style>
            #grid {
                background: url('<?php echo base_url() ?>image/layout_grid.png') no-repeat;
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 80%;
            }
        </style>
        <style type="text/css">
            .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
            }
            .preloader .loading {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            font: 14px arial;
            }
            </style>

            <style>
            #projectsvg {
                position: relative;
                width: 85%;
                padding-bottom: 69%;
                vertical-align: middle;
                overflow: hidden;
                margin-left: auto;
                margin-right: auto;
            }
            #projectsvg svg {
                display: inline-block;
                position: absolute;
                font-size: 36px;
            }
            #projectsvg svg image{
                min-width:2420px;
                min-height:1080px;
            }
            line{
            z-index: -888;
            stroke-opacity:0.7;
            stroke-dasharray:15; stroke-dashoffset:10;stroke-width:4;
            animation: dash 200s linear ;
            
            }
            @keyframes dash {
            to {
                stroke-dashoffset: 5000;
            }
            }
        </style>
        <style>
            table.table-supply td {
                padding-bottom: 10px;
                padding-left: 25px;
                font-size:24px;
            }

            .supply-input-timah {
                font-size: 2.142857rem;
                width: 145px;
            }

            .supply-input {
                font-size: 24px;
                width: 600px;
            }

            .satuan-supply {
                height: 40px;
                font-size: 20px;
            }

            table.table-supply-plate td {
                padding-bottom: 10px;
                padding-left: 25px;
                font-size:21px;
                white-space: nowrap;
            }
            .plate-supply-input {
                font-size: 21px;
                width: 100px;
            }
        </style>
        <script src="<?php echo base_url('assets/js'); ?>/highcharts.js"></script>
        <script src="<?php echo base_url('assets/js'); ?>/exporting.js"></script>
        <script src="<?php echo base_url('assets/js'); ?>/export-data.js"></script>
        <script src="<?php echo base_url('assets/js'); ?>/scan-qr.min.js"></script>
        <script src="<?php echo base_url('assets/js'); ?>/moment.js"></script>
    </head>
    <body>

        <div id="page-container" class="sidebar-mini sidebar-o sidebar-inverse enable-page-overlay side-scroll page-header-fixed page-header-glass page-header-inverse main-content-boxed">
            <!-- Side Overlay-->
            <aside id="side-overlay">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow">
                    <div class="content-header-section align-parent">
                        <!-- Close Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Side Overlay -->

                        <!-- User Info -->
                        <div class="content-header-item">
                            <a class="img-link mr-5" href="be_pages_generic_profile.html">
                                <img class="img-avatar img-avatar32" src="<?php echo base_url(); ?>assets/media/avatars/avatar15.jpg" alt="">
                            </a>
                            <a class="align-middle link-effect text-primary-dark font-w600" href="be_pages_generic_profile.html"><?php echo $this->session->userdata('username') ?></a>
                        </div>
                        <!-- END User Info -->
                    </div>
                </div>
                <!-- END Side Header -->

                <!-- Side Content -->
                <div class="content-side">
                    <!-- Search -->
                    <div class="block pull-t pull-r-l">
                        <div class="block-content block-content-full block-content-sm bg-body-light">
                            <form action="be_pages_generic_search.html" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="side-overlay-search" name="side-overlay-search" placeholder="Search..">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary px-10">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END Search -->

                    <!-- Mini Stats -->
                    <!-- <div class="block pull-r-l">
                        <div class="block-content block-content-full block-content-sm bg-body-light">
                            <div class="row">
                                <div class="col-4">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Clients</div>
                                    <div class="font-size-h4">460</div>
                                </div>
                                <div class="col-4">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Sales</div>
                                    <div class="font-size-h4">728</div>
                                </div>
                                <div class="col-4">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Earnings</div>
                                    <div class="font-size-h4">$7,860</div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- END Mini Stats -->

                    <!-- Friends -->
                    <!-- <div class="block pull-r-l">
                        <div class="block-header bg-body-light">
                            <h3 class="block-title"><i class="fa fa-fw fa-users font-size-default mr-5"></i>Friends</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <ul class="nav-users push">
                                <li>
                                    <a href="be_pages_generic_profile.html">
                                        <img class="img-avatar" src="<?php echo base_url(); ?>assets/media/avatars/avatar1.jpg" alt="">
                                        <i class="fa fa-circle text-success"></i> Betty Kelley
                                        <div class="font-w400 font-size-xs text-muted">Photographer</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="be_pages_generic_profile.html">
                                        <img class="img-avatar" src="<?php echo base_url(); ?>assets/media/avatars/avatar12.jpg" alt="">
                                        <i class="fa fa-circle text-success"></i> Jose Wagner
                                        <div class="font-w400 font-size-xs text-muted">Web Designer</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="be_pages_generic_profile.html">
                                        <img class="img-avatar" src="<?php echo base_url(); ?>assets/media/avatars/avatar4.jpg" alt="">
                                        <i class="fa fa-circle text-warning"></i> Alice Moore
                                        <div class="font-w400 font-size-xs text-muted">UI Designer</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="be_pages_generic_profile.html">
                                        <img class="img-avatar" src="<?php echo base_url(); ?>assets/media/avatars/avatar11.jpg" alt="">
                                        <i class="fa fa-circle text-danger"></i> Jesse Fisher
                                        <div class="font-w400 font-size-xs text-muted">Copywriter</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                    <!-- END Friends -->

                    <!-- Activity -->
                    <!-- <div class="block pull-r-l">
                        <div class="block-header bg-body-light">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-clock-o font-size-default mr-5"></i>Activity
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <ul class="list list-activity">
                                <li>
                                    <i class="si si-wallet text-success"></i>
                                    <div class="font-w600">+$29 New sale</div>
                                    <div>
                                        <a href="javascript:void(0)">Admin Template</a>
                                    </div>
                                    <div class="font-size-xs text-muted">5 min ago</div>
                                </li>
                                <li>
                                    <i class="si si-close text-danger"></i>
                                    <div class="font-w600">Project removed</div>
                                    <div>
                                        <a href="javascript:void(0)">Best Icon Set</a>
                                    </div>
                                    <div class="font-size-xs text-muted">26 min ago</div>
                                </li>
                                <li>
                                    <i class="si si-pencil text-info"></i>
                                    <div class="font-w600">You edited the file</div>
                                    <div>
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-file-text-o"></i> Docs.doc
                                        </a>
                                    </div>
                                    <div class="font-size-xs text-muted">3 hours ago</div>
                                </li>
                                <li>
                                    <i class="si si-plus text-success"></i>
                                    <div class="font-w600">New user</div>
                                    <div>
                                        <a href="javascript:void(0)">StudioWeb - View Profile</a>
                                    </div>
                                    <div class="font-size-xs text-muted">5 hours ago</div>
                                </li>
                                <li>
                                    <i class="si si-wrench text-warning"></i>
                                    <div class="font-w600">App v5.5 is available</div>
                                    <div>
                                        <a href="javascript:void(0)">Update now</a>
                                    </div>
                                    <div class="font-size-xs text-muted">8 hours ago</div>
                                </li>
                                <li>
                                    <i class="si si-user-follow text-pulse"></i>
                                    <div class="font-w600">+1 Friend Request</div>
                                    <div>
                                        <a href="javascript:void(0)">Accept</a>
                                    </div>
                                    <div class="font-size-xs text-muted">1 day ago</div>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                    <!-- END Activity -->

                    <!-- Profile -->
                    <!-- <div class="block pull-r-l">
                        <div class="block-header bg-body-light">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-pencil font-size-default mr-5"></i>Profile
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form action="be_pages_dashboard.html" method="post" onsubmit="return false;">
                                <div class="form-group mb-15">
                                    <label for="side-overlay-profile-name">Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="side-overlay-profile-name" name="side-overlay-profile-name" placeholder="Your name.." value="John Smith">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-15">
                                    <label for="side-overlay-profile-email">Email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="side-overlay-profile-email" name="side-overlay-profile-email" placeholder="Your email.." value="john.smith@example.com">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-15">
                                    <label for="side-overlay-profile-password">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="side-overlay-profile-password" name="side-overlay-profile-password" placeholder="New Password..">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-asterisk"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-15">
                                    <label for="side-overlay-profile-password-confirm">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="side-overlay-profile-password-confirm" name="side-overlay-profile-password-confirm" placeholder="Confirm New Password..">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-asterisk"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-block btn-alt-primary">
                                            <i class="fa fa-refresh mr-5"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> -->
                    <!-- END Profile -->

                    <!-- Settings -->
                    <!-- <div class="block pull-r-l">
                        <div class="block-header bg-body-light">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-wrench font-size-default mr-5"></i>Settings
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row gutters-tiny">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" class="custom-control-input" id="side-overlay-settings-status" name="side-overlay-settings-status" value="1" checked>
                                        <label class="custom-control-label" for="side-overlay-settings-status">Online Status</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" class="custom-control-input" id="side-overlay-settings-public-profile" name="side-overlay-settings-public-profile" value="1">
                                        <label class="custom-control-label" for="side-overlay-settings-public-profile">Public Profile</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" class="custom-control-input" id="side-overlay-settings-notifications" name="side-overlay-settings-notifications" value="1" checked>
                                        <label class="custom-control-label" for="side-overlay-settings-notifications">Notifications</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" class="custom-control-input" id="side-overlay-settings-updates" name="side-overlay-settings-updates" value="1">
                                        <label class="custom-control-label" for="side-overlay-settings-updates">Auto updates</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" class="custom-control-input" id="side-overlay-settings-api-access" name="side-overlay-settings-api-access" value="1" checked>
                                        <label class="custom-control-label" for="side-overlay-settings-api-access">API Access</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" class="custom-control-input" id="side-overlay-settings-limit-requests" name="side-overlay-settings-limit-requests" value="1">
                                        <label class="custom-control-label" for="side-overlay-settings-limit-requests">API Requests</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- END Settings -->
                </div>
                <!-- END Side Content -->
            </aside>
            <!-- END Side Overlay -->

            <!-- Sidebar -->
            <!--
                Helper classes

                Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
                Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                    If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

                Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
                Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
                    - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
            -->
            <nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow px-15">
                        <!-- Mini Mode -->
                        <div class="content-header-section sidebar-mini-visible-b">
                            <!-- Logo -->
                            <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                <span class="text-dual-primary-dark">E</span><span class="text-primary">S</span>
                            </span>
                            <!-- END Logo -->
                        </div>
                        <!-- END Mini Mode -->

                        <!-- Normal Mode -->
                        <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="index.html">
                                    <i class="si si-fire text-primary"></i>
                                    <span class="font-size-xl text-dual-primary-dark">E</span><span class="font-size-xl text-primary">WIP</span>
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                        <!-- END Normal Mode -->
                    </div>
                    <!-- END Side Header -->

                    <!-- Side User -->
                    <div class="content-side content-side-full content-side-user px-10 align-parent">
                        <!-- Visible only in mini mode -->
                        <div class="sidebar-mini-visible-b align-v animated fadeIn">
                            <img class="img-avatar img-avatar32" src="<?php echo base_url(); ?>assets/media/avatars/avatar15.jpg" alt="">
                        </div>
                        <!-- END Visible only in mini mode -->

                        <!-- Visible only in normal mode -->
                        <div class="sidebar-mini-hidden-b text-center">
                            <a class="img-link" href="be_pages_generic_profile.html">
                                <img class="img-avatar" src="<?php echo base_url(); ?>assets/media/avatars/avatar15.jpg" alt="">
                            </a>
                            <ul class="list-inline mt-10">
                                <li class="list-inline-item">
                                    <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="be_pages_generic_profile.html"><?php echo $this->session->userdata('username') ?></a>
                                </li>
                                <li class="list-inline-item">
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                                        <i class="si si-drop"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="link-effect text-dual-primary-dark" href="<?php echo base_url('login/logout'); ?>">
                                        <i class="si si-logout"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END Visible only in normal mode -->
                    </div>
                    <!-- END Side User -->

                    <!-- Side Navigation -->
                    <?php if ($this->session->userdata('level') == 2) { ?>
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <li>
                                    <a href="<?php echo base_url('wip/batch') ?>"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li>
                                
                                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">User Interface</span></li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Menu</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('wip') ?>">TR</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('wip/list_tr') ?>">Generate TR</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('wip/history') ?>">History TR</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    <?php } elseif ($this->session->userdata('level') == 3 OR $this->session->userdata('level') == 4) { ?>
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <li>
                                    <a href="<?php echo base_url('whkom/batch') ?>"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li>
                                
                                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">User Interface</span></li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">TR WHKOM</span></a>
                                    <ul>
                                        <?php if ($this->session->userdata('level') == 3) { ?>
                                            <li>
                                                <a href="<?php echo base_url('whkom/batch') ?>">WH Scan</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('whkom/update_transaksi') ?>">Edit Qty</a>
                                            </li>
                                        <?php } elseif ($this->session->userdata('level') == 4) { ?>
                                            <li>
                                                <a href="<?php echo base_url('whkom/batch_prod') ?>">Prod Scan</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('whfg/chg_scan') ?>">CHG Scan</a>
                                            </li>
                                        <?php } ?>
                                        <li>
                                            <a href="<?php echo base_url('whkom/list_tr') ?>">List TR</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whkom/dashboard') ?>">Dashboard KAS</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whkom/dashboard_kab') ?>">Dashboard KAB</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whkom/dashboard_klc') ?>">Dashboard CHG</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whkom/dashboard_kav') ?>">Dashboard MCB</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php if ($this->session->userdata('level') == 3) { ?>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Unloading Timah</span></a>
                                        <ul>
                                            <li>
                                                <!-- <a href="<?php echo 'https://portal2.incoe.astra.co.id/e-wip-infor/whfg_timah/index'; ?>">WH Scan</a> -->
                                                <a href="<?php echo 'https://portal2.incoe.astra.co.id/e-wip-infor/whfg_timah/index'; ?>">WH Scan</a>
                                            </li>
                                            <li>
                                                <!-- <a href="<?php echo 'https://portal2.incoe.astra.co.id/e-wip-infor/whfg_timah/index'; ?>">WH Scan</a> -->
                                                <a href="<?php echo 'https://portal2.incoe.astra.co.id/e-wip-infor/order_timah/timahInformation'; ?>">STO Bundle</a>
                                            </li>
                                            <li>
                                            <a href="http://10.19.16.30/#/views/DataIncomingTimah-Infor/DBIncomingTimah?:iid=1" target="_blank">Dashboard Incoming</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">TR WHFG</span></a>
                                        <ul>
                                            <li>
                                                <a href="<?php echo base_url('whfg/wh_scan') ?>">WHFG Scan</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('whfg/list_tr') ?>">List TR</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('whfg/forklift_monitoring') ?>">Monitoring</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- ADD MENU ORDER TIMAH -->
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Order Timah</span></a>
                                        <ul>
                                            <li>
                                                <a href="<?php echo base_url('order_timah/queue_schedule') ?>">Schedule</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- END OF MENU ORDER TIMAH -->
                                <?php } elseif ($this->session->userdata('level') == 4) { ?>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">TR WHFG</span></a>
                                        <ul>
                                            <li>
                                                <a href="<?php echo base_url('whfg/index') ?>">Forklift Scan</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('whfg/list_tr') ?>">List TR</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('whfg/forklift_monitoring') ?>">Monitoring</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } elseif ($this->session->userdata('level') == 1) { ?>
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <li>
                                    <a href="<?php echo base_url('wip/batch') ?>"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li>
                                
                                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">User Interface</span></li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">E-WIP</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('wip') ?>">TR</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('wip/list_tr') ?>">Generate TR</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('wip/history') ?>">History TR</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">TR WHKOM</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('whkom/batch') ?>">WH Scan</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whkom/batch_prod') ?>">Prod Scan</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whkom/list_tr') ?>">List TR</a>
                                        </li>
                                        <li>
                                                <a href="<?php echo base_url('whkom/update_transaksi') ?>">Edit Qty</a>
                                            </li>
                                        <li>
                                            <a href="<?php echo base_url('whkom/dashboard') ?>">Dashboard KAS</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whkom/dashboard_kab') ?>">Dashboard KAB</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whkom/dashboard_klc') ?>">Dashboard CHG</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whkom/dashboard_kav') ?>">Dashboard MCB</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Unloading Timah</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo 'https://portal2.incoe.astra.co.id/e-wip-infor/whfg_timah/adj'; ?>">Adjustment</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo 'https://portal2.incoe.astra.co.id/e-wip-infor/whfg_timah/index'; ?>">WH Scan</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whfg_timah/list_receipt') ?>">List Receipt</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whfg_timah/report_dn') ?>">Report DN</a>
                                        </li>
                                        <li>
                                            <!-- <a href="<?php echo 'https://portal2.incoe.astra.co.id/e-wip-infor/whfg_timah/index'; ?>">WH Scan</a> -->
                                            <a href="<?php echo 'https://portal2.incoe.astra.co.id/e-wip-infor/order_timah/timahInformation'; ?>">STO Bundle</a>
                                        </li>
                                        <li>
                                        <a href="http://10.19.16.30/#/views/DataIncomingTimah-Infor/DBIncomingTimah?:iid=1" target="_blank">Dashboard Incoming</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="https://portal2.incoe.astra.co.id/e-wip-infor/Store_Timah/"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Store Timah</span></a>
                                </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">TR WHFG</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('whfg/index') ?>">Forklift Scan</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whfg/wh_scan') ?>">WHFG Scan</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whfg/chg_scan') ?>">CHG Scan</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whfg/list_tr') ?>">List TR</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whfg/forklift_monitoring') ?>">Monitoring</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- ADD MENU ORDER TIMAH -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Order Timah</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('order_timah/') ?>">List Order</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_timah/queue_schedule') ?>">Schedule</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_timah/activity_supply') ?>">Supply</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_timah/timahInformation') ?>">Timah Information</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('STO_timah') ?>">STO Timah</a>
                                        </li>
                                        <li>
                                            <a href="http://10.19.16.30/#/views/StoreTimah-Infor/StoreTimah?:iid=1" target="_blank">Dashboard Store</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- END OF MENU ORDER TIMAH -->


                                <!-- ADD MENU ORDER GRID -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Order Grid</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('order_grid/list_order') ?>">List Grid</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_grid/activity_supply') ?>">Supply</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- END OF MENU ORDER GRID -->

                                <!-- ADD MENU ORDER PLATE -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Order Plate</span></a>
                                    <ul>
                                        <!-- <li>
                                            <a href="<?php echo base_url('order_plate/menu_report') ?>">Report</a>
                                        </li> -->
                                        <!-- <li>
                                            <a href="<?php echo base_url('order_plate/list_wo') ?>">List WO</a>
                                        </li> -->
                                        <li>
                                            <a href="<?php echo base_url('order_plate/list_order') ?>">List Order</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('api/summary_transaction') ?>">Summary Transaction Plate</a>
                                        </li> 
                                        <li>
                                            <a href="<?php echo base_url('api/summary_supply_receipt') ?>">Summary Supply Vs Receipt</a>
                                        </li>   
                                        <li>
                                            <a href="<?php echo base_url('api/detail_supply_receipt') ?>">Detail Supply Vs Receipt</a>
                                        </li>   
                                        <!-- <li>
                                            <a href="<?php echo base_url('order_plate/queue_schedule') ?>">Schedule</a>
                                        </li> -->
                                        <li>
                                            <a href="<?php echo base_url('order_plate/activity_supply') ?>">Supply Assembling</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_plate/activity_supply_assy_a') ?>">Supply Assembling A</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_plate/activity_supply_assy_g') ?>">Supply Assembling G</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_plate/activity_supply_formation') ?>">Supply Formation</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_plate/activity_supply_formation_c') ?>">Supply Formation C</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_plate/activity_supply_formation_f') ?>">Supply Formation F</a>
                                        </li>
                                        <li>
                                            <a href="https://portal3.incoe.astra.co.id/production_control_v2/interlock_aging">Supply Aging</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- END OF MENU ORDER PLATE -->
                                
                                <!-- ADD MENU ORDER LEAD PART -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Order Lead Part</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('order_lead_part/list_order') ?>">List Order</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_lead_part/activity_supply') ?>">Supply Assembling</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_lead_part/activity_supply_assy_a') ?>">Supply Assembling A</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_lead_part/activity_supply_assy_g') ?>">Supply Assembling G</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_lead_part/activity_supply_formation') ?>">Supply Formation</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_lead_part/activity_supply_formation_c') ?>">Supply Formation C</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_lead_part/activity_supply_formation_f') ?>">Supply Formation F</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- END OF MENU ORDER LEAD PART -->

                                <!-- ADD MENU ANDON FORKLIFT -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Andon Forklift</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('AndonForklift/list_andon') ?>">List Andon</a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- END OF MENU ANDON FORKLIFT -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Perpindahan Rak</span></a>
                                    <ul>                            
                                        <li>
                                            <a href="http://10.19.16.29:8091/summary">List Perpindahan Rak</a>
                                        </li>
                                        <li>
                                            <a href="http://10.19.16.29:8091/input_pasting">Input Perpindahan Rak</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Proses</span></a>
                                    <ul>                            
                                        <li>
                                            <a href="http://portal3.incoe.astra.co.id/production_control_v2/curing">Curing</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    <?php } elseif ($this->session->userdata('level') == 5) { ?>
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <li>
                                    <a href="<?php echo base_url('wip/batch') ?>"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li>
                                
                                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">User Interface</span></li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">TR WHFG</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('whfg/index') ?>">Forklift Scan</a>
                                        </li>
                                        <!-- <li>
                                            <a href="<?php echo base_url('whfg/chg_scan') ?>">CHG Scan</a>
                                        </li> -->
                                        <li>
                                            <a href="<?php echo base_url('whfg/list_tr') ?>">List TR</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whfg/forklift_monitoring') ?>">Monitoring</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    <?php } elseif ($this->session->userdata('level') == 6) { ?>
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <!-- <li>
                                    <a href="<?php echo base_url('wip/batch') ?>"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li> -->
                                
                                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">User Interface</span></li>

                                <?php if ($this->session->userdata('username') == 'admin_pasting') { ?>
                                <!-- ADD MENU ORDER GRID -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Order Grid</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('order_grid/list_order') ?>">List Grid</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_grid/activity_supply') ?>">Supply</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- END OF MENU ORDER GRID -->
                                <?php } ?>

                                <?php if ($this->session->userdata('username') != 'admin_formation') { ?>
                                <!-- ADD MENU ORDER TIMAH -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Order Timah</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('order_timah/') ?>">List Order</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_timah/queue_schedule') ?>">Schedule</a>
                                        </li>
                                        <!-- <li>
                                            <a href="<?php echo base_url('order_timah/activity_supply') ?>">Supply</a>
                                        </li> -->
                                    </ul>
                                </li>
                                <?php } ?>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Order Plate</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('order_plate/list_order') ?>">List Order</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- END OF MENU ORDER TIMAH -->
                            </ul>
                        </div>
                    <?php } elseif ($this->session->userdata('level') == 7) { ?>
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <!-- <li>
                                    <a href="<?php echo base_url('wip/batch') ?>"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li> -->
                                
                                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">User Interface</span></li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Unloading Timah</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo 'https://portal2.incoe.astra.co.id/e-wip-infor/whfg_timah/adj'; ?>">Adjustment</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo 'https://portal2.incoe.astra.co.id/e-wip-infor/whfg_timah/index'; ?>">WH Scan</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('whfg_timah/list_receipt') ?>">List Receipt</a>
                                        </li>
                                        <li>
                                            <!-- <a href="<?php echo 'https://portal2.incoe.astra.co.id/e-wip-infor/whfg_timah/index'; ?>">WH Scan</a> -->
                                            <a href="<?php echo 'https://portal2.incoe.astra.co.id/e-wip-infor/order_timah/timahInformation'; ?>">STO Bundle</a>
                                        </li>
                                        <li>
                                            <a href="http://10.19.16.30/#/views/DataIncomingTimah-Infor/DBIncomingTimah?:iid=1" target="_blank">Dashboard Incoming</a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <!-- ADD MENU ORDER TIMAH -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Supply Timah</span></a>
                                    <ul>
                                        <!-- <li>
                                            <a href="<?php echo base_url('order_timah/') ?>">List Order</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_timah/queue_schedule') ?>">Schedule</a>
                                        </li> -->
                                        <li>
                                            <a href="<?php echo base_url('order_timah/activity_supply') ?>">Supply</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- END OF MENU ORDER TIMAH -->
                            </ul>
                        </div>
                    <?php } elseif ($this->session->userdata('level') == 8  || $this->session->userdata('level') == 9) { ?>
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <!-- <li>
                                    <a href="<?php echo base_url('wip/batch') ?>"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li> -->
                                
                                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">User Interface</span></li>

                                <!-- ADD MENU ORDER GRID -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Order Grid</span></a>
                                    <ul>
                                        <!-- <li>
                                            <a href="<?php echo base_url('order_grid/list_order') ?>">List Grid</a>
                                        </li> -->
                                        <li>
                                            <a href="<?php echo base_url('order_grid/activity_supply') ?>">Supply</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- END OF MENU ORDER GRID -->

                                 <!-- ADD MENU ORDER PLATE -->
                                 <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Order Plate</span></a>
                                    <ul>
                                        <!-- <li>
                                            <a href="<?php echo base_url('order_plate/menu_report') ?>">Report</a>
                                        </li> -->
                                        <?php if ($this->session->userdata('level') == 8) { ?>
                                            <!-- <li>
                                                <a href="<?php echo base_url('order_plate/list_wo') ?>">List WO</a>
                                            </li> -->
                                            <li>
                                                <a href="<?php echo base_url('order_plate/list_order') ?>">List Order</a>
                                            </li>
                                        <?php } ?>
                                        
                                        <!-- <li>
                                            <a href="<?php echo base_url('order_plate/queue_schedule') ?>">Schedule</a>
                                        </li> -->
                                        <!-- <li>
                                            <a href="<?php echo base_url('order_plate/activity_supply') ?>">Supply Assembling</a>
                                        </li> -->
                                        <li>
                                            <a href="<?php echo base_url('order_plate/activity_supply_assy_a') ?>">Supply Assembling A</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_plate/activity_supply_assy_g') ?>">Supply Assembling G</a>
                                        </li>
                                        <!-- <li>
                                            <a href="<?php echo base_url('order_plate/activity_supply_formation') ?>">Supply Formation</a>
                                        </li> -->
                                        <li>
                                            <a href="<?php echo base_url('order_plate/activity_supply_formation_c') ?>">Supply Formation C</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('order_plate/activity_supply_formation_f') ?>">Supply Formation F</a>
                                        </li>
                                        <li>
                                            <a href="https://portal3.incoe.astra.co.id/production_control_v2/interlock_aging">Supply Aging</a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- ADD MENU ANDON FORKLIFT -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Andon Forklift</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('AndonForklift/list_andon') ?>">List Andon</a>
                                        </li>
                                    </ul>
                                </li>
                          
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Perpindahan Rak</span></a>
                                    <ul>                            
                                        <li>
                                            <a href="http://10.19.16.29:8091/summary">List Perpindahan Rak</a>
                                        </li>
                                        <li>
                                            <a href="http://10.19.16.29:8091/input_rak">Input Perpindahan Rak</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Proses</span></a>
                                    <ul>                            
                                        <li>
                                            <a href="https://portal3.incoe.astra.co.id/production_control_v2/curing">Curing</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- END OF MENU ORDER PLATE -->
                                <?php if ($this->session->userdata('username') == 'mcb') { ?>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Order Timah</span></a>
                                        <ul>
                                            <li>
                                                <a href="<?php echo base_url('order_timah/') ?>">List Order</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('order_timah/queue_schedule') ?>">Schedule</a>
                                            </li>
                                            <!-- <li>
                                                <a href="<?php echo base_url('order_timah/activity_supply') ?>">Supply</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('order_timah/timahInformation') ?>">Timah Information</a>
                                            </li> -->
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } elseif ($this->session->userdata('level') == 10) { ?>
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <!-- <li>
                                    <a href="<?php echo base_url('wip/batch') ?>"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li> -->
                                
                                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">User Interface</span></li>
                                
                                <!-- ADD MENU ANDON FORKLIFT -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Andon Forklift</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('AndonForklift/list_andon') ?>">List Andon</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                    <!-- END Side Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                        <!-- END Toggle Sidebar -->

                        <!-- Open Search Section -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="header_search_on">
                            <i class="fa fa-search"></i>
                        </button>
                        <!-- END Open Search Section -->

                        <!-- Layout Options (used just for demonstration) -->
                        
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="content-header-section">
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block"><?php echo $this->session->userdata('username') ?></span>
                                <i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                                <h5 class="h6 text-center py-10 mb-5 border-b text-uppercase">User</h5>
                                <!-- <a class="dropdown-item" href="be_pages_generic_profile.html">
                                    <i class="si si-user mr-5"></i> Profile
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="be_pages_generic_inbox.html">
                                    <span><i class="si si-envelope-open mr-5"></i> Inbox</span>
                                    <span class="badge badge-primary">3</span>
                                </a>
                                <a class="dropdown-item" href="be_pages_generic_invoice.html">
                                    <i class="si si-note mr-5"></i> Invoices
                                </a>
                                <div class="dropdown-divider"></div> -->

                                <!-- Toggle Side Overlay -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <!-- <a class="dropdown-item" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_toggle">
                                    <i class="si si-wrench mr-5"></i> Settings
                                </a> -->
                                <!-- END Side Overlay -->

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('login/logout') ?>">
                                    <i class="si si-logout mr-5"></i> Sign Out
                                </a>
                            </div>
                        </div>
                        <!-- END User Dropdown -->

                        <!-- Notifications -->
                        <!-- <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-flag"></i>
                                <span class="badge badge-primary badge-pill">5</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-300" aria-labelledby="page-header-notifications">
                                <h5 class="h6 text-center py-10 mb-0 border-b text-uppercase">Notifications</h5>
                                <ul class="list-unstyled my-20">
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-check text-success"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">You’ve upgraded to a VIP account successfully!</p>
                                                <div class="text-muted font-size-sm font-italic">15 min ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">Please check your payment info since we can’t validate them!</p>
                                                <div class="text-muted font-size-sm font-italic">50 min ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-times text-danger"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">Web server stopped responding and it was automatically restarted!</p>
                                                <div class="text-muted font-size-sm font-italic">4 hours ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">Please consider upgrading your plan. You are running out of space.</p>
                                                <div class="text-muted font-size-sm font-italic">16 hours ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-plus text-primary"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">New purchases! +$250</p>
                                                <div class="text-muted font-size-sm font-italic">1 day ago</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center mb-0" href="javascript:void(0)">
                                    <i class="fa fa-flag mr-5"></i> View All
                                </a>
                            </div>
                        </div> -->
                        <!-- END Notifications -->

                        <!-- Toggle Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="side_overlay_toggle">
                            <i class="fa fa-tasks"></i>
                        </button>
                        <!-- END Toggle Side Overlay -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                
            </header>
            <!-- END Header -->