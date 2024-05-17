<?php
if ($tanggal == null) {
    $filterDate = date('Y-m-d');
} else {
    $filterDate = $tanggal;
}
?>
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Schedule Supply Timah</h2>
    <div class="col-md-12">
        <input type="date" name="" id="filterTanggal" value="<?=$filterDate;?>" onchange="filterByDate()" style="margin-bottom:10px;">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-vcenter">
                    <thead style="vertical-align : middle;text-align:center;">
                        <tr>
                            <th style="vertical-align : middle;text-align:center;" rowspan="2">Gedung</th>
                            <th style="vertical-align : middle;text-align:center;" rowspan="2">Subseksi</th>
                            <th style="vertical-align : middle;text-align:center;" rowspan="2">Part Number</th>
                            <th colspan="2" style="border-bottom: 1px solid #e4e7ed;">Shift 1</th>
                            <th colspan="2" style="border-bottom: 1px solid #e4e7ed;">Shift 2</th>
                            <th colspan="2" style="border-bottom: 1px solid #e4e7ed;">Shift 3</th>
                        </tr>
                        <tr>
                            <th>08.00 - 09.00</th>
                            <th>13.00 - 14.00</th>
                            <th>17.00 - 18.00</th>
                            <th>22.30 - 23.30</th>
                            <th>01.00 - 02.00</th>
                            <th>05.00 - 06.00</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($subseksi as $s) { ?>
                            <tr>
                            <?php $part_number = $this->OrderTimahModel->getPartNumber($s['id_subseksi']); ?>
                                <td style="text-align:center;" rowspan="<?=count($part_number)+1?>"><?=$s['lokasi']?></td>
                                <td rowspan="<?=count($part_number)+1?>"><?=$s['nama_subseksi']?></td>
                            </tr>
                                <?php foreach($part_number as $pn) { 
                                    $id_part = $pn['id_part'];?>
                                    <tr>
                                        <td><?=$pn['ingot_number']?></td>
                                        <?php for ($i=1; $i <= 6; $i++) {
                                            $jumlah_order = $this->OrderTimahModel->getSchedule($pn['id_part'],$filterDate,$i);
                                            if (!empty($jumlah_order[0]['jumlah_order_plan']) && !empty($jumlah_order[0]['jumlah_order_actual'])) {
                                                $bundlePlan = $jumlah_order[0]['jumlah_order_plan'];
                                                $bundleActual = ' ('.$jumlah_order[0]['jumlah_order_actual'].')';
                                            } elseif (!empty($jumlah_order[0]['jumlah_order_plan']) && empty($jumlah_order[0]['jumlah_order_actual'])) {
                                                $bundlePlan = $jumlah_order[0]['jumlah_order_plan'];
                                                $bundleActual = '';
                                            } elseif (empty($jumlah_order[0]['jumlah_order_plan']) && empty($jumlah_order[0]['jumlah_order_actual'])) {
                                                $bundlePlan = '';
                                                $bundleActual = '';
                                            }?>
                                        <?php if ($jumlah_order[0]['jumlah_order_plan'] == NULL) {
                                            $status = '';
                                            $fontcolor = '';
                                        } elseif ($jumlah_order[0]['jumlah_order_actual'] < $jumlah_order[0]['jumlah_order_plan'] AND $jumlah_order[0]['jumlah_order_plan'] > 0) {
                                            $status = 'orange';
                                            $fontcolor = 'color:white';
                                        } elseif ($jumlah_order[0]['jumlah_order_actual'] == $jumlah_order[0]['jumlah_order_plan'] OR $jumlah_order[0]['jumlah_order_actual'] >= $jumlah_order[0]['jumlah_order_plan']) {
                                            $status = 'green';
                                            $fontcolor = 'color:white';
                                        } ?>
                                        <td bgcolor="<?php echo $status; ?>" style="text-align:center;<?php echo $fontcolor; ?>"><?=$bundlePlan.$bundleActual?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                        <?php } ?>
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
    function filterByDate() {
        var tanggal = $('#filterTanggal').val()
        window.location.replace('<?=base_url(); ?>order_timah/schedule/'+tanggal);
    }
</script>