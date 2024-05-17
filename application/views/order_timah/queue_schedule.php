<?php
if ($tanggal == null) {
    $filterDate = date('Y-m-d');
} else {
    $filterDate = $tanggal;
}

// var_dump($data);
?>
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Heijunka Timah</h2>
    <div class="col-md-12">
        <input type="date" name="" id="filterTanggal" value="<?=$filterDate;?>" onchange="filterByDate()" style="margin-bottom:10px;">
        <select name="filter_delivery" id="filter_delivery" onchange="filterByDelivery()">
            <option value="" selected disabled>Plan Delivery</option>
            <option value="1">07.45 - 09.00</option>
            <option value="2">13.00 - 14.00</option>
            <option value="3">17.00 - 19.00</option>
            <option value="4">22.30 - 23.30</option>
            <option value="5">01.00 - 02.00</option>
            <option value="6">05.00 - 06.00</option>
        </select>
        <div style="float:right;">
            <svg width="30" height="30">
                <rect width="30" height="30" style="fill:green;" />
            </svg>
            <span>Close Order</span>
            &nbsp;&nbsp;
            <svg width="30" height="30">
                <rect width="30" height="30" style="fill:orange;" />
            </svg>
            <span>Open Order</span>
        </div>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-vcenter">
                    <thead style="vertical-align : middle;text-align:center;">
                        <tr>
                            <th style="vertical-align : middle;text-align:center;" rowspan="3">Gedung</th>
                            <th style="vertical-align : middle;text-align:center;" rowspan="3">Subseksi</th>
                            <th style="vertical-align : middle;text-align:center;" rowspan="3">Part Number</th>
                            <?php
                                $time_now = date('H:i');
                                // $time_now = '14:00';

                                if ($sesi_now == '1') {
                                    $shift = '1';
                                    $plan_delivery = '07.45 - 09.00';
                                } elseif ($sesi_now == '2') {
                                    $shift = '1';
                                    $plan_delivery = '13.00 - 14.00';
                                } elseif ($sesi_now == '3') {
                                    $shift = '2';
                                    $plan_delivery = '17.00 - 19.00';
                                } elseif ($sesi_now == '4') {
                                    $shift = '2';
                                    $plan_delivery = '22.30 - 23.30';
                                } elseif ($sesi_now == '5') {
                                    $shift = '3';
                                    $plan_delivery = '01.00 - 02.00';
                                } elseif ($sesi_now == '6') {
                                    $shift = '3';
                                    $plan_delivery = '05.00 - 06.00';
                                }
                            ?>
                            <th colspan="20" style="border-bottom: 1px solid #e4e7ed;">Shift <?=$shift?></th>
                        </tr>
                        <tr>
                            <th colspan="20" style="border-bottom: 1px solid #e4e7ed;"><?=$plan_delivery?></th>
                        </tr>
                        <tr>
                            <?php 
                                for ($i=1; $i <= 20; $i++) { ?>
                                <th><?=$i?></th>
                            <?php        
                                }
                            ?>
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
                                        <td><?=substr($pn['ingot_number'], 3)?></td>
                                        <?php for ($i=0; $i < 20; $i++) {
                                            if (!empty($data[$i])) {
                                                if ($data[$i]['ingot_number'] == $pn['ingot_number'] && $data[$i]['id_subseksi'] == $pn['id_subseksi']) {
                                                    $bundlePlan = $data[$i]['jumlah_order_plan'];
                                                    if ($data[$i]['status'] == 'Close') {
                                                        $color = "green";
                                                    } elseif ($data[$i]['status'] == 'Open') {
                                                        $color = "orange";
                                                    }                                                    
                                                } else {
                                                    $bundlePlan = '';
                                                    $color = "";
                                                }
                                            } else {
                                                $bundlePlan = '';
                                                $color = "";
                                            }
                                        ?>
                                        <td bgcolor="<?=$color?>" style="text-align:center;color:white"><?=$bundlePlan?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                        <?php } ?>
                        <tr>
                            <th style="vertical-align : middle;text-align:center;" colspan="3">Total</th>
                            <?php
                            $total = 0;
                            for ($i=0; $i < 20; $i++) {
                                if (!empty($data[$i])) {
                                    $qtyPlan = $data[$i]['jumlah_order_plan'];
                                    $total += $qtyPlan;
                                } else {
                                    $qtyPlan = 0;
                                }
                            ?>
                            <th style="text-align:center;"><?=$qtyPlan?></th>
                            <?php } ?>
                        </tr>
                        <tr>
                            <th style="vertical-align : middle;text-align:center;" colspan="3">Total Per Sesi</th>
                            <th style="vertical-align : middle;text-align:center;" colspan="20"><?=$total?></th>
                        </tr>
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
    $("#filter_delivery").val("<?=$sesi_now?>");

    function filterByDate() {
        var tanggal = $('#filterTanggal').val()
        window.location.replace('<?=base_url(); ?>order_timah/queue_schedule/'+tanggal);
    }

    function filterByDelivery() {
        var tanggal = $('#filterTanggal').val()
        var sesi = $('#filter_delivery').val()
        window.location.replace('<?=base_url(); ?>order_timah/queue_schedule/'+tanggal+'/'+sesi);

    }
</script>