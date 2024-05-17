<?php 
    // echo json_encode($data).'<br>';
    $open = array_filter($data, function ($var) {                                    
        return ($var['status_supply'] == 'Open');
    });

    $close = array_filter($data, function ($var) {                                    
        return ($var['status_supply'] == 'Close');
    });

    $arrOpen = array_values($open);
    $arrClose = array_values($close);

    // var_dump($data);

    $page = $count + 1;
?>

<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <!-- <h2 class="content-heading">Activity Supply</h2> -->
    <!-- <div style="text-align:center;">
        <button class="btn btn-success"></button>&nbsp;<span style="font-size:16px;">Sudah di supply</span>&nbsp;&nbsp;
        <button class="btn btn-warning"></button>&nbsp;<span style="font-size:16px;">Orderan masuk</span>&nbsp;&nbsp;
        <button class="btn btn-primary"></button>&nbsp;<span style="font-size:16px;">Belum/tidak ada orderan</span>&nbsp;&nbsp;
    </div> -->
    <br>
    <br>
    
    <div class="col-md-12">
        <input type="date" name="" id="filterTanggal" value="<?=$tanggal?>" onchange="filterByDelivery()" style="margin-bottom:10px;">
        <select name="filter_delivery" id="filter_delivery" onchange="filterByDelivery()">
            <option value="" selected disabled>Plan Delivery</option>
            <option value="1">07.45 - 09.00</option>
            <option value="2">13.00 - 14.00</option>
            <option value="3">17.00 - 19.00</option>
            <option value="4">22.30 - 23.30</option>
            <option value="5">01.00 - 02.00</option>
            <option value="6">05.00 - 06.00</option>
        </select>
        <br>
        <br>
        <div style="display: flex;justify-content: space-around;">
            <?php 
                if (!empty($arrClose)) {
                    for ($i=0; $i < count($arrClose); $i++) {
                        $close = $i + 1; ?>
                        <button class="btn btn-lg btn-success" onclick="linkPage(<?=$close?>)"><?=$close?></button>
                <?php
                    }
                }

                if (!empty($data)){
                    if ($data[$count]['status'] == 'Open' || empty($data[$count+1]['status'])) {
                        $pointer = "pointer-events: none;cursor: default;";
                    } else {
                        $pointer = '';
                    }                    
                }

                if (!empty($close)) {
                    $queue_now = $close + 1; 
                    if (empty($data[$queue_now-1])) {
                        echo "";
                    } else { ?>
                        <button style="<?=$pointer?>" class="btn btn-lg btn-warning" onclick="linkPage(<?=$queue_now?>)"><?=$queue_now?></button>
                    <?php
                    }
                    ?>
                <?php
                } elseif (!empty($arrOpen)) { 
                    $queue_now = 1; ?>
                    <button class="btn btn-lg btn-warning" onclick="linkPage(<?=$queue_now?>)"><?=$queue_now?></button>
                <?php
                } else {
                    $queue_now = 0; 
                }?>

                <?php
                for ($j=1; $j < count($arrOpen); $j++) {
                    $next = $queue_now + $j; ?>
                    <a href="#" class="btn btn-lg btn-warning" style="pointer-events: none;cursor: default;"><?=$next?></a>
                <?php
                }

                $index = count($arrClose) + count($arrOpen);
                
                for ($k=$index+1; $k <= 16; $k++) { ?>
                    <a href="#" class="btn btn-lg btn-primary" style="pointer-events: none;cursor: default;"><?=$k?></a>
                <?php
                }
            ?>
           
        </div>
        
        <br>
        <div class="block">
            <div class="block-content block-content-full">
                <div>
                    <?php
                    if (empty($data)) { ?>
                        <h2 style="text-align:center;">Belum Ada Order Masuk</h2>
                    <?php } else { ?>

                    <h4 style="text-align:center; color:red; font-size:45px"><?=$page?></h4>
                    <h2 style="text-align:center;">Activity Supply To -> <?=$data[$count]['nama_subseksi']. ' ('.$data[$count]['jumlah_order_plan'].' Bundle)'?></h2>
                    
                    <hr>    
                    <form action="<?=base_url()?>order_timah/confirmSupply" method="POST">
                        <table class="table-supply" style="margin: 0 auto;">
                            <tr>
                                <td>Supply To</td>
                                <td> : </td>
                                <td><?=$data[$count]['nama_subseksi']?></td>
                            </tr>
                            <tr>
                                <td>Jenis Ingot</td>
                                <td> : </td>
                                <td><?=substr($data[$count]['ingot_number'], 0)?> (<?=$data[$count]['keterangan']?>)</td>
                            </tr>
                            <tr>
                                <td>Pick Up Location</td>
                                <td> : </td>
                                <td>WH - RAW MATERIAL</td>
                            </tr>
                            <tr>
                                <td>Delivery Location</td>
                                <td> : </td>
                                <td><?=$data[$count]['lokasi'].' ('.$data[$count]['nama_subseksi'].')'?></td>
                            </tr>
                            <tr>
                                <td>Created Order</td>
                                <td> : </td>
                                <td><?=date("H:i", strtotime($data[$count]['tanggal_order']))?></td>
                            </tr>
                            <tr>
                                <?php
                                    $tanggal_sesi = date('Y-m-d', strtotime($data[$count]['tanggal_order']));

                                    if($data[$count]['sesi'] == 1) {
                                        $sesi = '07.45 - 09.00';
                                    } elseif($data[$count]['sesi'] == 2) {
                                        $sesi = '13.00 - 14.00';
                                    } elseif($data[$count]['sesi'] == '3') {
                                        $sesi = '17.00 - 19.00';
                                    } elseif($data[$count]['sesi'] == '4') {
                                        $sesi = '22.30 - 23.30';
                                    } elseif($data[$count]['sesi'] == '5') {
                                        $sesi = '01.00 - 02.00';
                                    } elseif($data[$count]['sesi'] == '6') {
                                        $sesi = '05.00 - 06.00';
                                    }
                                ?>
                                <td>Plan Delivery</td>
                                <td> : </td>
                                <td><?=$sesi?></td>
                            </tr>
                            <tr>
                                <td>Qr Code</td>
                                <td>:</td>
                                <td>
                                    <div class="input-group">
                                        <?php 
                                            $data_detail = $this->OrderTimahModel->getDetailOrder($data[$count]['id_order']);
                                            if (!empty($data_detail)) {
                                                $barcode = $data_detail;
                                            } else {
                                                $barcode[0]['barcode'] = '';
                                                $barcode[1]['barcode'] = '';
                                            }
                                            for ($i=0; $i < $data[$count]['jumlah_order_plan']; $i++) { 
                                                $barc = str_replace(',', '.', $barcode[$i]['barcode']);
                                            ?>
                                                <input type="text" class="form-control-lg supply-input-timah" id="barcode_<?=$i?>" name="barcode[]" onchange="scanQr(<?=$i?>)" value="<?=$barc?>" autofocus style="width: 200px;" required>
                                                <button type="button" class="btn btn-info btn-lg" onclick="scanBtnQr(<?=$i?>)" style="margin-left: 10px;"><i class="fa fa-check"></i></button>
                                                &nbsp;                                                
                                        <?php   }
                                        ?>
                                    </div>
                                    <div class="input-group">
                                        
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Qty</td>
                                <td> : </td>
                                <td>
                                    <div class="input-group">
                                        <?php 
                                            $data_detail = $this->OrderTimahModel->getDetailOrder($data[$count]['id_order']);
                                            // var_dump($data[$count]['jumlah_order_plan']);
                                            if (!empty($data_detail)) {
                                                $qty_supply = $data_detail;
                                            } else {
                                                $qty_supply[0]['qty_bundle'] = '';
                                                $qty_supply[1]['qty_bundle'] = '';
                                            }
                                            for ($i=0; $i < $data[$count]['jumlah_order_plan']; $i++) { 
                                                $qty_actq = str_replace(',', '.', $qty_supply[$i]['qty_bundle']);     
                                                // var_dump($qty_actq);
                                            ?>
                                                <!-- <input min="0" max="1300" type="number" step="0.01" class="form-control-lg supply-input-timah" id="actual_supply" name="actual_supply[]" value="<?=$qty_actq?>" placeholder="" required> -->
                                                <input required type="text" class="form-control-lg supply-input-timah" id="actual_supply_<?=$i?>" name="actual_supply[]" onchange="scanQr(<?=$i?>)" value="<?=$qty_actq?>" readonly required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text satuan-supply">
                                                        Kg
                                                    </span>
                                                </div>
                                                &nbsp;                                                
                                        <?php   }
                                        ?>
                                    </div>
                                    <div class="input-group">
                                        
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <?php
                                    if ($data[$count]['status_supply'] == 'Close') {
                                        $disabled = 'disabled';
                                    } else {
                                        $disabled = '';
                                    }

                                    if ($data[$count]['status'] == 'Open' || empty($data[$count+1]['status'])) {
                                        $disabledNext = 'disabled';
                                    } else {
                                        $disabledNext = '';
                                    }

                                    $linkBtnNext = $count + 2;
                                ?>
                                <td style="text-align:left;"><button type="submit" class="btn btn-lg btn-success" <?=$disabled?>>Submit</button></td>
                                <td></td>
                                <td style="text-align:right;"><button type="button" onclick="linkPage(<?=$linkBtnNext?>)" class="btn btn-lg btn-primary" style="float:right;" <?=$disabledNext?>>Next</button></td>
                            </tr>
                        </table>
                        <input type="hidden" name="id_order" value="<?=$data[$count]['id_order']?>">
                        <input type="text" disabled value="<?=$data[$count]['id_order']?>">
                    </form>   
                    <?php } ?>                 
                </div>
            </div>
        </div>

    </div>
</div>
<!-- END Page Content -->
</main>
<!-- END Main Container -->

<script>
    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });

    $("#filter_delivery").val("<?=$sesi_now?>");

    function checkConfirm() {
        getListOrder()
        setTimeout(checkConfirm,60000);
    }

    $(document).ready(function() {
        checkConfirm();
        getListOrder();
    });

    function filterByDate() {
        var tanggal = $('#filterTanggal').val()
        window.location.replace('<?=base_url(); ?>order_timah/activity_supply/'+tanggal);
    }

    function filterByDelivery() {
        var tanggal = $('#filterTanggal').val()
        var sesi = $('#filter_delivery').val()
        window.location.replace('<?=base_url(); ?>order_timah/activity_supply/'+tanggal+'/'+sesi);
    }

    function linkPage(i) {
        var tanggal = $('#filterTanggal').val()
        var sesi = $('#filter_delivery').val()
        window.location.replace('<?=base_url(); ?>order_timah/activity_supply/'+tanggal+'/'+sesi+'/'+i);
    }

    function getListOrder() {
        var tanggal = $('#filterTanggal').val()
        $.ajax({
            type: "GET",
            url: "<?=base_url(); ?>order_timah/checkConfirm/"+tanggal,
            async: true,
			dataType: 'json',
            success: function(data)
            {
                // console.log(data);
                var i;               

                for (i = data.length - 1; i >= 0; i--) {
                    if (data[i]['status_supply'] == 'Close') {
                        var date1 = moment(data[i]['closed_supply']).format('YYYY-MM-DD HH:mm:ss');
                        var date2 = moment().format('YYYY-MM-DD HH:mm:ss');
                        var diff = moment.duration(moment(date2).diff(moment(date1)));
                        var minutes = parseInt(diff.asMinutes());
                        // console.log(minutes);                        

                        if (data[i]['status'] == 'Open' && minutes > 2) {
                            $.ajax({
                                type: "POST",
                                url: "<?=base_url(); ?>order_timah/autoConfirm",
                                async: true,
                                dataType: 'json',
                                data:{
                                    id_order:data[i]['id_order'],
                                },
                                success: function(data)
                                {
                                    console.log("Auto Confirm");
                                }
                            });
                            console.log(data[i]['id_order']);
                            console.log('auto');
                            window.location.reload();
                        }
                    }
                }
            }
        });
    }

    function scanQr(index) {
        console.log($("#barcode_"+index).val());
        var barc = $("#barcode_"+index).val();
        document.addEventListener('keyup', function(event) {
            if (event.keyCode == 9) {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url(); ?>order_timah/checkQtyBarcode",
                    async: true,
                    dataType: 'json',
                    data:{
                        barc : barc
                    },
                    success: function(data)
                    {
                        console.log(data);
                        if (data === undefined || data.length == 0) {
                            console.log('Data Tidak Ditemukan');
                            $("#actual_supply_"+index).val('');
                        } else {
                            console.log(data[0].actq);
                            console.log(data[0].barc);
                            $("#barcode_"+index).val(data[0].barc)
                            $("#actual_supply_"+index).val(data[0].actq);
                            var index2 = index + 1;
                            console.log(index2);
                            $("#barcode_"+index2).focus();
                        }
                    }
                });
            }
        });
    }

    function scanBtnQr(index) {
        console.log($("#barcode_"+index).val());
        var barc = $("#barcode_"+index).val();
       
                $.ajax({
                    type: "POST",
                    url: "<?=base_url(); ?>order_timah/checkQtyBarcode",
                    async: true,
                    dataType: 'json',
                    data:{
                        barc : barc
                    },
                    success: function(data)
                    {
                        console.log(data);
                        if (data === undefined || data.length == 0) {
                            console.log('Data Tidak Ditemukan');
                            $("#actual_supply_"+index).val('');
                        } else {
                            console.log(data[0].actq);
                            console.log(data[0].barc);
                            $("#barcode_"+index).val(data[0].barc)
                            $("#actual_supply_"+index).val(data[0].actq);
                        }
                    }
                });
    }
</script>