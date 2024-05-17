
            <!-- Main Container -->
            <main id="main-container">

                <!-- Hero -->
                <div class="bg-image bg-image-bottom" style="background-image: url('<?php echo base_url(); ?>assets/media/photos/photo34@2x.jpg');">
                    <div class="bg-primary-dark-op">
                        <div class="content content-top text-center overflow-hidden">
                            <div class="pt-50 pb-20">
                                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">Dashboard</h1>
                                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Welcome to your custom panel!</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Hero -->

                <div class="row gutters-tiny invisible" data-toggle="appear">
                        <!-- Row #4 -->
                        <div class="col-md-6">
                            <a class="block block-link-shadow overflow-hidden" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <i class="si si-briefcase fa-2x text-body-bg-dark"></i>
                                    <div class="row py-20">
                                        <div class="col-12 text-center border-r">
                                            <div class="invisible" data-toggle="appear" data-class="animated fadeInLeft">
                                                <div class="font-size-h3 font-w600"></div>
                                                <div class="font-size-sm font-w600 text-uppercase text-muted"> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a class="block block-link-shadow overflow-hidden" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="text-right">
                                        <i class="si si-users fa-2x text-body-bg-dark"></i>
                                    </div>
                                    <div class="row py-20">
                                        <div class="col-6 text-right border-r">
                                            <div class="invisible" data-toggle="appear" data-class="animated fadeInLeft">
                                                    <div class="font-size-h3 font-w600 text-info"></div>
                                                <div class="font-size-sm font-w600 text-uppercase text-muted"> </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="invisible" data-toggle="appear" data-class="animated fadeInRight">
                                                <div class="font-size-h3 font-w600 text-success"></div>
                                                <div class="font-size-sm font-w600 text-uppercase text-muted"> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- END Row #4 -->
                    </div>
                    <div class="row gutters-tiny invisible" data-toggle="appear">
                        <?php if ($this->session->userdata('seksi') == 'assy') { ?>
                            <div class="col-6 col-md-4 col-xl-2">
                                <a class="block block-link-shadow text-center" href="<?php echo base_url('dashboard/assembly/'.$this->session->userdata('line')) ?>">
                                    <div class="block-content">
                                        <p class="mt-5">
                                            <i class="si si-bar-chart fa-3x"></i>
                                        </p>
                                        <p class="font-w600">Andon System</p>
                                    </div>
                                </a>
                            </div>
                        <?php } elseif ($this->session->userdata('seksi') == 'grid_casting') { ?>
                            <div class="col-6 col-md-4 col-xl-2">
                                <a class="block block-link-shadow text-center" href="<?php echo base_url('produksi1/casting/'.$this->session->userdata('line')) ?>">
                                    <div class="block-content">
                                        <p class="mt-5">
                                            <i class="si si-bar-chart fa-3x"></i>
                                        </p>
                                        <p class="font-w600">Andon System</p>
                                    </div>
                                </a>
                            </div>
                        <?php } elseif ($this->session->userdata('seksi') == 'mtn') { ?>
                            <div class="col-6 col-md-4 col-xl-2">
                                <a class="block block-link-shadow text-center" href="<?php echo base_url('dashboard/form_perbaikan_mtn/') ?>">
                                    <div class="block-content">
                                        <p class="mt-5">
                                            <i class="si si-settings fa-3x"></i>
                                        </p>
                                        <p class="font-w600">Form Perbaikan Maintenance</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-4 col-xl-2">
                                <a class="block block-link-shadow text-center" href="<?php echo base_url('dashboard/analyticAndonMtn/') ?>">
                                    <div class="block-content">
                                        <p class="mt-5">
                                            <i class="si si-settings fa-3x"></i>
                                        </p>
                                        <p class="font-w600">Summary Andon Maintenance</p>
                                    </div>
                                </a>
                            </div>
                        <?php } elseif ($this->session->userdata('seksi') == 'tool') { ?>
                            <div class="col-6 col-md-4 col-xl-2">
                                <a class="block block-link-shadow text-center" href="<?php echo base_url('dashboard/form_perbaikan_tool/') ?>">
                                    <div class="block-content">
                                        <p class="mt-5">
                                            <i class="si si-settings fa-3x"></i>
                                        </p>
                                        <p class="font-w600">Form Perbaikan Tooling</p>
                                    </div>
                                </a>
                            </div>
                        <?php } elseif ($this->session->userdata('seksi') == 'wh') { ?>
                            <div class="col-6 col-md-4 col-xl-2">
                                <a class="block block-link-shadow text-center" href="<?php echo base_url('dashboard/andon_warehouse/') ?>">
                                    <div class="block-content">
                                        <p class="mt-5">
                                            <i class="si si-settings fa-3x"></i>
                                        </p>
                                        <p class="font-w600">Andon Warehouse</p>
                                    </div>
                                </a>
                            </div>
                        <?php } elseif ($this->session->userdata('seksi') == 'admin' OR $this->session->userdata('seksi') == 'mis') { ?>
                            <div class="col-6 col-md-4 col-xl-2">
                                <a class="block block-link-shadow text-center" href="<?php echo base_url('dashboard/grid') ?>">
                                    <div class="block-content ribbon ribbon-bookmark ribbon-success ribbon-left">
                                        <div class="ribbon-box"></div>
                                        <p class="mt-5">
                                            <i class="si si-bar-chart fa-3x"></i>
                                        </p>
                                        <p class="font-w600">GRID</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-4 col-xl-2">
                                <a class="block block-link-shadow text-center" href="<?php echo base_url('dashboard/assembly') ?>">
                                    <div class="block-content ribbon ribbon-bookmark ribbon-success ribbon-left">
                                        <div class="ribbon-box"></div>
                                        <p class="mt-5">
                                            <i class="si si-bar-chart fa-3x"></i>
                                        </p>
                                        <p class="font-w600">ASSEMBLY</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-4 col-xl-2">
                                <a class="block block-link-shadow text-center" href="<?php echo base_url('dashboard/powerhouse') ?>">
                                    <div class="block-content ribbon ribbon-bookmark ribbon-primary ribbon-left">
                                        <div class="ribbon-box"></div>
                                        <p class="mt-5">
                                            <i class="si si-bar-chart fa-3x"></i>
                                        </p>
                                        <p class="font-w600">POWERHOUSE</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-4 col-xl-2">
                                <a class="block block-link-shadow text-center" href="<?php echo base_url('dashboard/oee/') ?>">
                                    <div class="block-content">
                                        <p class="mt-5">
                                            <i class="si si-bar-chart fa-3x"></i>
                                        </p>
                                        <p class="font-w600">OEE</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-4 col-xl-2">
                                <a class="block block-link-shadow text-center" href="<?php echo base_url('dashboard/trend_energy') ?>">
                                    <div class="block-content">
                                        <p class="mt-5">
                                            <i class="si si-bar-chart fa-3x"></i>
                                        </p>
                                        <p class="font-w600">Trend Energy</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-4 col-xl-2">
                                <a class="block block-link-shadow text-center" href="<?php echo base_url('dashboard/trend_achievement') ?>">
                                    <div class="block-content">
                                        <p class="mt-5">
                                            <i class="si si-bar-chart fa-3x"></i>
                                        </p>
                                        <p class="font-w600">Trend Achievement</p>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                        
                    </div>

            </main>
            <!-- END Main Container -->
