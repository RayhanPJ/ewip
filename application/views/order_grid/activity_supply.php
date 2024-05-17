<?php 
    // echo json_encode($data).'<br>';
    $open = array_filter($data, function ($var) {                                    
        return ($var['status_supply'] == 'Open' OR $var['status_supply'] == 'Progress');
    });

    $close = array_filter($data, function ($var) {                                    
        return ($var['status_supply'] == 'Close');
    });

    $arrOpen = array_values($open);
    $arrClose = array_values($close);

    // var_dump($arrClose);die();

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
            <option value="1">Sesi 1 (07.00 - 10.30)</option>
            <option value="2">Sesi 2 (10.30 - 16.30)</option>
            <option value="3">Sesi 3 (16.30 - 20.00)</option>
            <option value="4">Sesi 4 (20.00 - 00.30)</option>
            <option value="5">Sesi 5 (00.30 - 03.00)</option>
            <option value="6">Sesi 6 (03.00 - 07.00)</option>
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
                    if ($data[$count]['status'] == 'Open' OR $data[$count]['status'] == 'Progress' || empty($data[$count+1]['status'])) {
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
                    <!-- <a href="#" class="btn btn-lg btn-warning" style="pointer-events: none;cursor: default;"><?=$next?></a> -->
                    <button class="btn btn-lg btn-warning" onclick="linkPage(<?=$next?>)"><?=$next?></button>
                <?php
                }

                $index = count($arrClose) + count($arrOpen);
                
                for ($k=$index+1; $k <= 10; $k++) { ?>
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
                    <h2 style="text-align:center;">Activity Supply To -> <?=$data[$count]['line']?></h2>
                    
                    <hr>    
                    <form action="<?=base_url()?>order_grid/confirmSupply" method="POST">
                        <table class="table-supply-plate" style="margin: 0 auto;">
                            <tr>
                                <td>Type Grid</td>
                                <td> : </td>
                                <td><?=$data[$count]['type_grid']?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Pnl</td>
                                <td> : </td>
                                <td><?=$data[$count]['jumlah_order_plan']?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Rak</td>
                                <td> : </td>
                                <td><?=$data[$count]['jumlah_rak']?></td>
                            </tr>
                            <tr>
                                <td>Create Order</td>
                                <td> : </td>
                                <td><?=date('H:i', strtotime($data[$count]['tanggal_order']))?></td>
                            </tr>
                            <tr>
                                <?php
                                    $tanggal_sesi = date('Y-m-d', strtotime($data[$count]['tanggal_order']));

                                    // switch ($data[$count]['sesi']) {
                                    //     case 1:
                                    //         $jadwal = 'Shift 1<br>(07.30 - 09.00)';
                                    //         break;
                                    //     case 2:
                                    //         $jadwal = 'Shift 1<br>(11.00 - 13.30)';
                                    //         break;
                                    //     case 3:
                                    //         $jadwal = 'Shift 2<br>(16.30 - 18.00)';
                                    //         break;
                                    //     case 4:
                                    //         $jadwal = 'Shift 2<br>(21.30 - 22.00)';
                                    //         break;
                                    //     case 5:
                                    //         $jadwal = 'Shift 3<br>(00.30 - 02.00)';
                                    //         break;
                                    //     case 6:
                                    //         $jadwal = 'Shift 3<br>(05.00 - 06.30)';
                                    //         break;
                                    //     default:
                                    //         # code...
                                    //         break;
                                    // }

                                    switch ($data[$count]['sesi']) {
                                        case 1:
                                            $jadwal = 'Shift 1 (07.00 - 10.30)';
                                            break;
                                        case 2:
                                            $jadwal = 'Shift 1 (10.30 - 16.30)';
                                            break;
                                        case 3:
                                            $jadwal = 'Shift 2 (16.30 - 20.00)';
                                            break;
                                        case 4:
                                            $jadwal = 'Shift 2 (20.00 - 00.30)';
                                            break;
                                        case 5:
                                            $jadwal = 'Shift 3 (00.30 - 03.00)';
                                            break;
                                        case 6:
                                            $jadwal = 'Shift 3 (03.00 - 07.00)';
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                ?>
                                <td>Session Delivery</td>
                                <td> : </td>
                                <td><?=$jadwal?></td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top">Rak</td>
                                <td style="vertical-align:top"> : </td>
                                <td>
                                    
                                    <?php 
                                        $data_detail = $this->OrderGridModel->getDetailOrder($data[$count]['id_order_grid']);
                                        // var_dump($data[$count]['jumlah_order_plan']);
                                        if (!empty($data_detail)) {
                                            $barcode = $data_detail;
                                        } else {
                                            $barcode[0]['rak'] = '';
                                            $barcode[1]['rak'] = '';
                                            $barcode[2]['rak'] = '';
                                            $barcode[3]['rak'] = '';
                                            $barcode[4]['rak'] = '';
                                            $barcode[5]['rak'] = '';
                                        }

                                        for ($i=0; $i < $data[$count]['jumlah_rak']; $i++) { 
                                            $barc = str_replace(',', '.', $barcode[$i]['rak']); 
                                            ?>
                                            <div class="input-group" style="margin-bottom: 10px;">
                                                <input type="text" class="form-control supply-input" id="barcode_<?=$i?>" name="barcode[]" onchange="scanQr(<?=$i?>)" value="<?=$barc?>">
                                            </div>
                                        <?php } ?>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top">Qty</td>
                                <td style="vertical-align:top"> : </td>
                                <td>
                                    
                                    <?php 
                                        $data_detail = $this->OrderGridModel->getDetailOrder($data[$count]['id_order_grid']);
                                        // var_dump($data[$count]['jumlah_order_plan']);
                                        if (!empty($data_detail)) {
                                            $qty_supply = $data_detail;
                                        } else {
                                            $qty_supply[0]['qty_rak'] = '';
                                            $qty_supply[1]['qty_rak'] = '';
                                            $qty_supply[2]['qty_rak'] = '';
                                            $qty_supply[3]['qty_rak'] = '';
                                            $qty_supply[4]['qty_rak'] = '';
                                            $qty_supply[5]['qty_rak'] = '';
                                        }

                                        for ($i=0; $i < $data[$count]['jumlah_rak']; $i++) { 
                                            $qty_actq = str_replace(',', '.', $qty_supply[$i]['qty_rak']); 
                                            ?>
                                            <div class="input-group" style="margin-bottom: 10px;">
                                                <input type="number" class="form-control supply-input" id="actual_supply_<?=$i?>" name="actual_supply[]" value="<?=$qty_actq?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        pnl
                                                    </span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    
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
                                    if ($data[$count]['status_supply'] == 'Progress' || $data[$count]['status_supply'] == 'Close') {
                                        $disabled = 'disabled';
                                    } else {
                                        $disabled = '';
                                    }

                                    if ($data[$count]['status'] == 'Open' OR $data[$count]['status'] == 'Progress' || empty($data[$count+1]['status'])) {
                                        $disabledNext = 'disabled';
                                    } else {
                                        $disabledNext = '';
                                    }

                                    if ($data[$count]['status_supply'] == 'Progress') {
                                        $disabledScan = '';
                                    } else {
                                        $disabledScan = 'disabled';
                                    }

                                    $linkBtnNext = $count + 2;
                                ?>
                                <td style="text-align:left;"></td>
                                <td style="text-align:center;"></td>
                                <td style="text-align:right;"></td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-4" style="text-align:left;">
                                <input type="submit" name="action_supply" class="btn btn-lg btn-success" value="Submit" <?=$disabled?>>
                            </div>
                            <div class="col-4" style="text-align:center;">
                                <!-- <input type="submit" name="action_supply" id="btn_scan_gedung" class="btn btn-lg btn-info" value="Scan QR code gedung" onclick="return confirm('Apakah plate sudah dikirim?')" <?=$disabledScan?>> -->
                                <!-- <input type="submit" name="action_supply" id="btn_scan_gedung" class="btn btn-lg btn-info" value="Scan QR code gedung" <?=$disabledScan?> style="display:none;"> -->
                                <!-- <button type="button" class="btn btn-lg btn-info" data-toggle="modal" data-target="#modal_confirm" <?=$disabledScan?>>Scan QR code gedung</button> -->
                            </div>
                            <div class="col-4" style="text-align:right;">
                                <button type="button" onclick="linkPage(<?=$linkBtnNext?>)" class="btn btn-lg btn-primary" style="float:right;" <?=$disabledNext?>>Next</button>
                            </div>
                        </div>
                        <input type="text" name="id_order_grid" value="<?=$data[$count]['id_order_grid']?>" readonly>
                    </form>
                    <?php } ?>     
                </div>
            </div>
        </div>

        <!-- Add Order Modal -->
        <div class="modal" id="modal_confirm" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Scan QR Code Gedung</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- <div class="block-content">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <input type="text" class="form-control" id="qr_code" name="qr_code" placeholder="Scan QR Code" onchange="scanGedung()" autofocus>
                                        </div>
                                    </div>
                                </div>                            
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            
                        </div>
                    </div>
            </div>
        </div>

    </div>
</div>
<!-- END Page Content -->
</main>
<!-- END Main Container -->

<script>
    $("#filter_delivery").val("<?=$sesi_now?>");

    $(document).ready(function() {
        $('#modal_confirm').on('shown.bs.modal', function() {
            $('#qr_code').trigger('focus');
        });
    });

    function filterByDate() {
        var tanggal = $('#filterTanggal').val()
        window.location.replace('<?=base_url(); ?>order_grid/activity_supply/'+tanggal);
    }

    function filterByDelivery() {
        var tanggal = $('#filterTanggal').val()
        var sesi = $('#filter_delivery').val()
        window.location.replace('<?=base_url(); ?>order_grid/activity_supply/'+tanggal+'/'+sesi);
    }

    function linkPage(i) {
        var tanggal = $('#filterTanggal').val()
        var sesi = $('#filter_delivery').val()
        window.location.replace('<?=base_url(); ?>order_grid/activity_supply/'+tanggal+'/'+sesi+'/'+i);
    }

    function scanQr(index) {
        console.log($("#barcode_"+index).val());
        var barc = $("#barcode_"+index).val();
        document.addEventListener('keyup', function(event) {
            if (event.keyCode == 9) {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url(); ?>order_grid/checkQtyBarcode",
                    async: true,
                    dataType: 'json',
                    data:{
                        barc : barc
                    },
                    success: function(data)
                    {
                        console.log(data);
                        if (data === undefined || data.length == 0) {
                            alert('Data Tidak Ditemukan');
                            $("#barcode_"+index).val('');
                            $("#barcode_"+index).focus();
                            $("#actual_supply_"+index).val('');
                        } else {
                            let sum = 0;

                            data.forEach(item => {
                                sum += item.qty;
                            });

                            $("#actual_supply_"+index).val(sum);
                        }
                    }
                });
            }
        });
    }

    function scanGedung() {
        document.addEventListener('keyup', function(event) {
            if (event.keyCode == 9) {
                $('#modal_confirm').modal('hide');
                $('#btn_scan_gedung').click();
            }
        });
    }
</script>