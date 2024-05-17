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
                                <th></th>
                                <th>PN</th>
                                <th>Barcode</th>
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
                                    <td><a href="<?php echo base_url('whkom/edit/'.$d->barc); ?>" target="_blank">Update</a></td>
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

</main>
<!-- END Main Container -->