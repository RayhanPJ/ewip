<br><br>
<br><br>

<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Data Transaksi</h2> 
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
                    <!-- <a class='btn btn-primary' href="<?php echo base_url('whkom/batch'); ?>">Scan</a> -->
                </div>
                <div class="block-content block-content-full">
                    <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-full"> -->
                    <table width="100%" class="table table-bordered table-striped table-vcenter" id="example3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>R</th>
                                <th>NO WO</th>
                                <th>Line</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Barcode</th>
                                <th>Receipt</th>
                                <th>No WTA</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; foreach ($data as $d) { ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $d->PONO; ?></td>
                                    <td><?php echo $this->uri->segment(3); ?></td>
                                    <td><?php echo $d->POS; ?></td>
                                    <td><?php echo $d->ITEM; ?></td>
                                    <td><?php echo $d->QTY; ?></td>
                                    <td><?php echo $d->NOTE; ?></td>
                                    <td><?php if ($d->STATUS == 1) {
                                        echo 'V';
                                    } else {
                                        echo '-';
                                    } ?></td>
                                    <td><?php echo $d->ORNO; ?></td>
                                    <td><?php if ($d->ORNO != ' ') {
                                        echo 'Completed';
                                    } else {
                                        echo 'Not Completed';
                                    } ?></td>
                                </tr>
                            <?php $count++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full -->
        </div>
<!-- END Page Content -->

    


</main>
<!-- END Main Container -->