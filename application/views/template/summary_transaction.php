<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Summary Transaction Plate Administration KPRO1 - KPRO2</h2>
    
    <div class="col-md-12">
        <input type="date" name="" id="date_start" value="<?=$date_start?>">
        s/d
        <input type="date" name="" id="date_end" value="<?=$date_end?>">
        <button class="btn btn-primary" onclick="filterByDate()">Filter</button>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <div class="table-responsive">
                    <table id="summary_transaction" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Item</th>
                                <th>Plan Request</th>
                                <th>Supply Scan WIP (ID)</th>
                                <th>Transfer Without (ID)</th>
                                <th>Receipt Assy</th>
                                <th>GAP</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; foreach ($data as $d) { ?>
                                <tr>
                                    <td><?=$count; ?></td>
                                    <td style="width: 250px;"><?=$d['item']?></td>
                                    <td><?=$d['jumlah_order_plan']?></td>
                                    <td><?=$d['qty_supply']?></td>
                                    <td><?=$d['qty_tr_manual']?></td>
                                    <td><?=$d['qty_receipt']?></td>
                                    <td><?=($d['qty_supply'] + $d['qty_tr_manual']) - $d['qty_receipt']?></td>
                                    <td>
                                        <?php if ($d['qty_receipt'] > ($d['qty_supply'] + $d['qty_tr_manual'])) { ?>
                                            <span class="badge badge-danger">Double Receipt</span>
                                        <?php } elseif ($d['qty_receipt'] < ($d['qty_supply'] + $d['qty_tr_manual'])) { ?>
                                            <span class="badge badge-warning">Unreceipt</span>
                                        <?php } else { ?>
                                            <span class="badge badge-success">Transsaksi Normal</span>
                                        <?php } ?>
                                    </td>
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
        var date_start = $('#date_start').val()
        var date_end = $('#date_end').val()

        // create validation if date_start > date_stop
        if (new Date(date_start) > new Date(date_end)) {
            alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir')
            return false
        }
        
        window.location.replace('<?=base_url(); ?>api/summary_transaction/'+date_start+'/'+date_end);
    }
</script>