<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Data Transaksi - <?php echo $tgl_transaksi; ?></h2> 
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
                    <?php if ($this->session->userdata('level') == 1) { ?>
                        <a class='btn btn-success' href="<?php echo base_url('wip/getDataActqNull'); ?>">Validasi QTY</a> |
                    <?php } else {

                    } ?><a class='btn btn-primary' href="<?php echo base_url('wip/generateBaan'); ?>">Upload</a> | <button type="button" class="btn btn-alt-danger" data-toggle="modal" data-target="#modal-popout3"><i class="fa fa-plus mr-5"></i>Backdate</button> | <p>Belum Upload : <?php echo $belumUpload; ?></p> | <p>Gagal Upload : <?php echo $gagalUpload; ?></p>
                </div>
                <div class="block-content block-content-full">
                    <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table id="example" width='100%'>
                        <thead>
                            <tr>
                                <th ></th>
                                <th>PN</th>
                                <th >Barcode</th>
                                <th>ACTQ</th>
                                <th>WH From</th>
                                <th>WH To</th>
                                <th>User</th>
                                <th>Status Barcode</th>
                                <th>Action</th>
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
                                    <td><?php echo $d->users; ?></td>
                                    <td><?php if ($d->generate_baan == 0) {
                                        echo 'Belum di upload';
                                    } elseif ($d->generate_baan == 2) {
                                        echo 'Gagal di upload';
                                    } elseif ($d->generate_baan == 1) {
                                        echo 'Sudah di upload';
                                    } ?></td>
                                    <?php if ($param == 'list_tr') { ?>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal-popout<?php echo $d->barc; ?>">Update</button> | <a href="<?php echo base_url('wip/delete/'.$d->barc) ?>" class="btn btn-w">Delete</a>
                                        </td>
                                    <?php } else { ?>
                                        <td>
                                            <button class="btn btn-warning"></button>
                                        </td>
                                    <?php } ?>
                                    
                                </tr>
                                <div class="modal" id="modal-popout<?php echo $d->barc; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-popout<?php echo $d->barc; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="block block-themed block-transparent mb-0">
                                                <div class="block-header bg-primary-dark">
                                                    <h3 class="block-title">Update Data</h3>
                                                    <div class="block-options">
                                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                            <i class="si si-close"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="block-content">
                                                    
                                                        <div class="block block-rounded block-themed">
                                                            <div class="block-header bg-gd-primary">
                                                                <h3 class="block-title">Form Update</h3>                                  
                                                            </div>
                                                            <div class="block-content block-content-full">
                                                                <div class="col-md-12">
                                                                    <!-- Simple Wizard -->
                                                                    <div class="js-wizard-simple block">
                                                                        <!-- Step Tabs -->
                                                                        <ul class="nav nav-tabs nav-tabs-block nav-fill" role="tablist">
                                                                            <li class="nav-item">
                                                                                <a class="nav-link active" href="#wizard-step_quality1" data-toggle="tab">Form</a>
                                                                            </li>
                                                                        </ul>
                                                                        <!-- END Step Tabs -->

                                                                        <!-- Form -->
                                                                        <!-- <form class="quantity_lost" method="post"> -->
                                                                        <form action="<?php echo base_url('wip/updateDataWip') ?>" method="post">
                                                                            <!-- Steps Content -->
                                                                            <div class="block-content block-content-full tab-content" style="min-height: 265px;">
                                                                                <!-- Step 1 -->
                                                                                <div class="tab-pane active" id="wizard-simple-step_quality1" role="tabpanel">
                                                                                    <!-- <div class="form-group">
                                                                                        <label for="wizard-simple-firstname">PIC WH</label>
                                                                                        <input class="form-control" require type="text" id="wizard-simple-location" name="pic" placeholder="PIC WH...">
                                                                                    </div> -->
                                                                                    <div class="form-group">
                                                                                        <label for="wizard-simple-firstname">QTY Sebelum</label>
                                                                                        <input class="form-control" readonly type="text" value="<?php echo $d->actq; ?>" name="actq_sebelum" placeholder="Jumlah Barang...">
                                                                                        <input class="form-control" readonly type="hidden" value="<?php echo $d->barc; ?>" name="barc">
                                                                                        <input class="form-control" readonly type="hidden" value="<?php echo $d->tagn; ?>" name="tagn">
                                                                                    </div>
                                                                                    <!-- <div class="form-group">
                                                                                        <label for="wizard-simple-firstname">QTY Sesudah</label>
                                                                                        <input class="form-control" type="text" name="actq_sesudah" placeholder="Jumlah Barang...">
                                                                                    </div> -->
                                                                                    <div class="form-group">
                                                                                        <label for="wizard-simple-firstname">WH Tujuan</label>
                                                                                        <select required class="form-control" id="whto" name="whto">
                                                                                            <option <?php if ($d->cwart == 'K-AMB') {
                                                                                                echo 'selected';
                                                                                            } ?> value="K-AMB">A</option>
                                                                                            <option <?php if ($d->cwart == 'K-FOR') {
                                                                                                echo 'selected';
                                                                                            } ?> value="K-FOR">C</option>
                                                                                            <option <?php if ($d->cwart == 'K-AVR') {
                                                                                                echo 'selected';
                                                                                            } ?> value="K-AVR">D</option>
                                                                                            <option <?php if ($d->cwart == 'K-FOR2') {
                                                                                                echo 'selected';
                                                                                            } ?> value="K-FOR2">F</option>
                                                                                            <option <?php if ($d->cwart == 'K-AMB2') {
                                                                                                echo 'selected';
                                                                                            } ?> value="K-AMB2">G</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                

                                                                            </div>
                                                                            <!-- END Steps Content -->

                                                                            <button id="tombol-simpan" class="btn btn-sm btn-alt-primary">
                                                                                <i class="fa fa-save mr-5"></i>Simpan
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
                            <?php $count++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full -->

            <!-- Dynamic Table Full -->
            <div class="block">
                <div class="block-content block-content-full">
                    <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table width="100%" id="example2">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th style="width: 20%;">WH To</th>
                                <th style="width: 20%;">Part Number</th>
                                <th style="width: 20%;">Item</th>
                                <th style="width: 10%;">Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1; foreach ($result as $r) { ?>
                                <tr>
                                    <td style="width: 10%;"><?php echo $count; ?></td>
                                    <td style="width: 20%;"><?php echo $r->cwart; ?></td>
                                    <td style="width: 40%;"><?php echo $r->item; ?></td>
                                    <td style="width: 10%;"><?php echo $r->scan; ?></td>
                                    <td style="width: 10%;"><?php echo $r->qty; ?></td>
                                </tr>
                            <?php $count++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full -->
        </div>
    </div>
</div>
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