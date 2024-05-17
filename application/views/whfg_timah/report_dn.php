

<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Report DN - <?php echo $this->session->userdata('username'); ?></h2>
    <br>
    
    <div class="col-md-12">
    <input type="month" value="<?=date('Y-m', strtotime($month))?>" id="month" name="month" onchange="filter_bulan()">
    <br>
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table id="report_dn" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <!-- <th>No</th> -->
                            <th>Tanggal</th>
                            <th>No DN</th>
                            <th>Supplier</th>
                            <th>Item</th>
                            <th>Berat Supplier</th>
                            <th>Berat Aktual</th>
                            <th>Selisih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; foreach ($data as $d) { 
                            $getDataBaan = $this->ProdControl->getLineDn(strtoupper($d->no_dn));
                            foreach($getDataBaan as $gt) {
                                $berat_supplier = $gt->QTY;
                            }
                        ?>
                            <tr>
                                <!-- <td><?php echo $count; ?></td> -->
                                <td><?php echo date('d-m-Y',strtotime($d->tanggal)); ?></td>
                                <td><?php echo $d->no_dn; ?></td>
                                <td><?= ($d->no_dn == 'KSP015487A') ? 'IMPORT' : $d->supplier; ?></td>
                                <td><?= $d->item; ?></td>
                                <td><?= ($d->no_dn == 'KSP015487A') ? 0 : $berat_supplier; ?></td>
                                <td><?php echo number_format($d->berat_aktual); ?></td>
                                <td><?= ($d->no_dn == 'KSP015487A') ? 0 : number_format($d->berat_aktual - $berat_supplier, 1, '.', ''); ?></td>
                            </tr>
                        <?php $count++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>

</div>
<!-- END Page Content -->


</main>
<!-- END Main Container -->

<script>
    function filter_bulan(){
        var bulan = $('#month').val();
        var urlnya = window.location.pathname;
        urlnya = urlnya.split('/');

        window.location.replace(window.location.origin+'/e-wip/whfg_timah/report_dn/'+bulan);
    }
</script>