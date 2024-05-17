<br><br>
<br><br>

<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Edit Data Transaksi</h2> 
    <br>
    <?php if ($this->session->flashdata('pesan') == NULL) {
        # code...
    } else { ?>
        <div class="alert alert-danger alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="alert-heading font-size-h4 font-w400">Peringatan !</h3>
            <p class="mb-0"><?php echo $this->session->flashdata('pesan'); ?></p>
        </div>
    <?php } ?>
        <div class="col-md-12">
            <!-- Dynamic Table Full -->
            <div class="block">
                <div class="block-header block-header-default">
                    <a class='btn btn-primary' href="<?php echo base_url('whkom/batch'); ?>">Scan</a>
                </div>
                <div class="block-content block-content-full">
                    <?php foreach ($data as $d) { ?>
                        <form action="<?php echo base_url('whkom/edit_do') ?>" method="POST">
                            <!-- Steps Content -->
                            <div class="block-content block-content-full tab-content" style="min-height: 265px;">
                                <!-- Step 1 -->
                                <div class="tab-pane active" id="wizard-simple-step_quality1" role="tabpanel">
                                    <div class="form-group">
                                        <label for="wizard-simple-location">NO R</label>
                                        <input type="text" class="form-control" readonly name="tagn" value="<?php echo $d->tagn; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="wizard-simple-location">Barcode</label>
                                        <input type="text" class="form-control" readonly value="<?php echo $d->barc; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="wizard-simple-location">Item</label>
                                        <input type="text" class="form-control" readonly name="item" value="<?php echo $d->item; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="wizard-simple-location">Qty</label>
                                        <input type="text" class="form-control" name="actq" value="<?php echo $d->actq; ?>">
                                        <input type="hidden" class="form-control" name="barc" value="<?php echo $d->barc; ?>">
                                    </div>
                                </div>
                                <!-- END Step 1 -->

                            </div>
                            <!-- END Steps Content -->

                            <button id="tombol-simpan" class="btn btn-sm btn-alt-primary">
                                <i class="fa fa-save mr-5"></i>Update
                            </button>

                        </form>
                    <?php } ?>
                </div>
            </div>
            <!-- END Dynamic Table Full -->
        </div>
<!-- END Page Content -->

    


</main>
<!-- END Main Container -->