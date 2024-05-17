<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<!-- <div class="content"> -->
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Data Transaksi - <?php echo date('Y-m-d'); ?></h2> 
    <br>
    <?php if ($this->session->flashdata('pesan') == NULL) {
        # code...
    } else { ?>
        <?php if ($this->session->flashdata('pesan') == 'Berhasil melakukan update') { ?>
            <div class="alert alert-primary alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="alert-heading font-size-h4 font-w400">Notifikasi</h3>
                <p class="mb-0"><?php echo $this->session->flashdata('pesan'); ?></p>
            </div>
        <?php } if ($this->session->flashdata('pesan') == 'Berhasil melakukan upload') { ?>
            <div class="alert alert-primary alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="alert-heading font-size-h4 font-w400">Notifikasi</h3>
                <p class="mb-0"><?php echo $this->session->flashdata('pesan'); ?></p>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="alert-heading font-size-h4 font-w400">Warning</h3>
                <p class="mb-0"><?php echo $this->session->flashdata('pesan'); ?></p>
            </div>
        <?php } ?>
    <?php } ?>

    <div class="row">
        <div class="col-md-12">
            <!-- Dynamic Table Full -->
            <div class="block">
                <div class="block-header block-header-default">
                
                </div>
                <div class="block-content block-content-full">
                    <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th ></th>
                                <th>PN</th>
                                <th>Barcode</th>
                                <th>ACTQ</th>
                                <th>WH From</th>
                                <th>WH To</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1; foreach ($data as $d) { ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $d->item; ?></td>
                                    <td><?php echo $d->barc; ?></td>
                                    <td><?php echo $d->actq; ?></td>
                                    <td><?php echo $d->cwarf; ?></td>
                                    <td><?php echo $d->cwart; ?></td>
                                    <th>User</th>
                                </tr>
                            <?php $count++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full -->
        </div>
    </div>
<!-- </div> -->
<!-- END Page Content -->

<div class="modal" id="modal-popout3" tabindex="-1" role="dialog" aria-labelledby="modal-popout3" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Date</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    
                        <div class="block block-rounded block-themed">
                            <div class="block-header bg-gd-primary">
                                <h3 class="block-title">Tanggal Produksi</h3>                                  
                            </div>
                            <div class="block-content block-content-full">
                                <div class="col-md-12">
                                    <!-- Simple Wizard -->
                                    <div class="js-wizard-simple block">
                                        <!-- Step Tabs -->
                                        <ul class="nav nav-tabs nav-tabs-block nav-fill" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#wizard-step_quality1" data-toggle="tab">Tanggal</a>
                                            </li>
                                        </ul>
                                        <!-- END Step Tabs -->

                                        <!-- Form -->
                                        <form action="<?php echo base_url('wip/backdateWip') ?>" method="POST">
                                            <!-- Steps Content -->
                                            <div class="block-content block-content-full tab-content" style="min-height: 265px;">
                                                <!-- Step 1 -->
                                                <div class="tab-pane active" id="wizard-simple-step_quality1" role="tabpanel">
                                                    <div class="form-group">
                                                        <label for="wizard-simple-location">Date</label>
                                                        <input type="text" class="js-datepicker form-control" id="example-datepicker3" name="tanggal_produksi" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy">
                                                    </div>
                                                </div>
                                                <!-- END Step 1 -->

                                            </div>
                                            <!-- END Steps Content -->

                                            <button id="tombol-simpan" class="btn btn-sm btn-alt-primary">
                                                <i class="fa fa-save mr-5"></i>Lihat
                                            </button>

                                        </form>
                                        <!-- END Form -->
                                    </div>
                                    <!-- END Simple Wizard -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="submit" id="btnSave" type="submit" class="btn btn-sm btn-alt-primary">
                                <i class="fa fa-save mr-5"></i>Created Ticket
                            </button> -->
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>

</div>


</main>
<!-- END Main Container -->