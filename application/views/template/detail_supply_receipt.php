
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Detail Supply VS Receipt</h2>
    
    <div class="col-md-12">
        <input type="date" name="" id="filterTanggal" value="<?=$filterDate;?>" onchange="filterByDate()">

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <div class="table-responsive">
                    <table id="list-order" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Type</th>
                                <th>Barcode</th>
                                <th>Qty Supply</th>
                                <th>Qty Receipt</th>
                                <th>Tujuan / Line</th>
                                <th>User Supply</th>
                                <!-- <th>User Receipt</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; foreach ($data as $d) { ?>
                                <tr>
                                    <td><?=$count; ?></td>
                                    <td><?=$d['item']?></td>
                                    <td><?=$d['barcode']?></td>
                                    <td><?=$d['qty_supply']?></td>
                                    <td><?=$d['QTY_RECEIPT']?></td>
                                    <td><?=$d['tujuan']?></td>
                                    <td><?=$d['user_supply']?></td>
                                    <!-- <td><?=$d['user_receipt']?></td> -->
                                </tr>
                            <?php $count++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
</div>
<!-- END Page Content -->
</main>
<!-- END Main Container -->
<script>
    $(document).ready(function() {
        
    });

    function filterByDate() {
        var tanggal = $('#filterTanggal').val()
        window.location.replace('<?=base_url(); ?>api/detail_supply_receipt/'+tanggal);
    }
</script>