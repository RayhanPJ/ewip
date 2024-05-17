
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Form Unloading Timah - <?php echo $this->session->userdata('username'); ?></h2>
    <a class="btn btn-alt-primary" href="<?php echo base_url('whfg/index') ?>"><i class="fa fa-plus mr-5"></i>Refresh</a>
    <a class="btn btn-alt-danger" href="<?php echo base_url('login/logout') ?>"><i class="fa fa-plus mr-5"></i>Keluar</a>
    <div class="row">
        <div class="col-md-12">
            <!-- Default Elements -->
            <div class="block">
                <div class="block-content">
                    <form action="<?php echo base_url('whfg_timah/getDataDn') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-12" for="whto">Receipt Transaction</label></label>
                            <div class="col-md-9">
                                <div class="input-group control-group">
                                    <input name="no_dn" class="form-control" id="barcode" placeholder="No DN" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="btn btn-danger" type="submit" value="Submit" />
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- END Page Content -->

</main>
<!-- END Main Container -->
