<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<!-- <div class="content"> -->
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Data Transaksi - <?php echo date('Y-m-d'); ?></h2> 
    <br>
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
                                <th>No</th>
                                <th>PO</th>
                                <th>Bussines Partner</th>
                                <th>Supplier</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1; foreach ($data as $d) { ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $d->PO; ?></td>
                                    <td><?php echo $d->BP; ?></td>
                                    <td><?php echo $d->NAMA; ?></td>
                                    <th><a href="<?php echo base_url('whfg_timah/whfg_receipt/'.$d->PO.'/'.$d->BP); ?>">Detail</a></th>
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

</div>


</main>
<!-- END Main Container -->