<?php 
    // echo json_encode($data).'<br>';
    $number = 1;
    $arrOpen = [];
    $arrClose = [];
    foreach ($data as $values) {
      if($values['status'] == 'Open') {
        $arrOpen[] = $number;
        $number++;
      }
      if($values['status'] == 'Close') {
        $arrClose[] = $number;
        $number++;
      }
    }
    $index = count($arrClose) + count($arrOpen);

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
            <?php if ($this->session->userdata('username') == 'formation_c' OR $this->session->userdata('username') == 'formation_f') { ?>
                <option value="1">Sesi 1 (09.00 - 10.00)</option>
                <option value="2">Sesi 2 (13.30 - 14.30)</option>
                <option value="3">Sesi 3 (18.30 - 19.30)</option>
                <option value="4">Sesi 4 (22.00 - 23.00)</option>
                <option value="5">Sesi 5 (02.00 - 03.00)</option>
                <option value="6">Sesi 6 (06.03 - 07.30)</option>
            <?php } else { ?>
                <option value="1">Sesi 1 (07.30 - 09.00)</option>
                <option value="2">Sesi 2 (11.00 - 13.30)</option>
                <option value="3">Sesi 3 (16.30 - 18.00)</option>
                <option value="4">Sesi 4 (21.30 - 22.00)</option>
                <option value="5">Sesi 5 (00.30 - 02.00)</option>
                <option value="6">Sesi 6 (05.00 - 06.30)</option>
            <?php } ?>
            <!-- <option value="1">Sesi 1 (07.00 - 10.30)</option>
            <option value="2">Sesi 2 (10.30 - 16.30)</option>
            <option value="3">Sesi 3 (16.30 - 20.00)</option>
            <option value="4">Sesi 4 (20.00 - 00.30)</option>
            <option value="5">Sesi 5 (00.30 - 03.00)</option>
            <option value="6">Sesi 6 (03.00 - 07.00)</option> -->
        </select>
        <br>
        <br>
        <div style="display: flex;justify-content: space-around;">
            <?php 
                for($i = 1; $i <= $index; $i++) {
                    if(in_array($i, $arrOpen)) { ?>
                        <button class="btn btn-lg btn-warning" onclick="linkPage(<?=$i?>)"><?=$i?></button>
                    <?php
                    } else if(in_array($i, $arrClose)) { ?>
                        <button class="btn btn-lg btn-success" onclick="linkPage(<?=$i?>)"><?=$i?></button>
                    <?php
                    }
                }
                for ($k=$index+1; $k <= (floor($index/10) == 0 ? 10 : $index); $k++) { ?>
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
                    <h2 style="text-align:center;">Activity Supply To -> Line <?=$data[$count]['line']?></h2>
                    
                    <hr>    
                    <form action="<?=base_url()?>order_lead_part/confirmSupply" method="POST">
                        <table class="table-supply-plate" style="margin: 0 auto;">
                            <tr>
                                <td>Jenis Plate</td>
                                <td> : </td>
                                <td><?=$data[$count]['jenis_lead_part']?></td>
                            </tr>
                            <tr>
                                <td>Type Plate</td>
                                <td> : </td>
                                <td><?=$data[$count]['type_lead_part']?></td>
                            </tr>
                            <!-- <tr>
                                <td>Jumlah Pnl</td>
                                <td> : </td>
                                <td><?=$data[$count]['jumlah_order_plan']?></td>
                            </tr> -->
                            <tr>
                                <td>Jumlah Box</td>
                                <td> : </td>
                                <td><?=$data[$count]['jumlah_box']?></td>
                            </tr>
                            <tr>
                                <td>Create Order</td>
                                <td> : </td>
                                <td><?=date('H:i', strtotime($data[$count]['tanggal_order']))?></td>
                            </tr>
                            <tr>
                                <?php
                                    $tanggal_sesi = date('Y-m-d', strtotime($data[$count]['tanggal_order']));

                                    switch ($data[$count]['sesi']) {
                                        case 1:
                                            $jadwal = 'Shift 1<br>(07.30 - 09.00)';
                                            break;
                                        case 2:
                                            $jadwal = 'Shift 1<br>(11.00 - 13.30)';
                                            break;
                                        case 3:
                                            $jadwal = 'Shift 2<br>(16.30 - 18.00)';
                                            break;
                                        case 4:
                                            $jadwal = 'Shift 2<br>(21.30 - 22.00)';
                                            break;
                                        case 5:
                                            $jadwal = 'Shift 3<br>(00.30 - 02.00)';
                                            break;
                                        case 6:
                                            $jadwal = 'Shift 3<br>(05.00 - 06.30)';
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }

                                    // switch ($data[$count]['sesi']) {
                                    //     case 1:
                                    //         $jadwal = 'Shift 1 (07.00 - 10.30)';
                                    //         break;
                                    //     case 2:
                                    //         $jadwal = 'Shift 1 (10.30 - 16.30)';
                                    //         break;
                                    //     case 3:
                                    //         $jadwal = 'Shift 2 (16.30 - 20.00)';
                                    //         break;
                                    //     case 4:
                                    //         $jadwal = 'Shift 2 (20.00 - 00.30)';
                                    //         break;
                                    //     case 5:
                                    //         $jadwal = 'Shift 3 (00.30 - 03.00)';
                                    //         break;
                                    //     case 6:
                                    //         $jadwal = 'Shift 3 (03.00 - 07.00)';
                                    //         break;
                                    //     default:
                                    //         # code...
                                    //         break;
                                    // }
                                ?>
                                <td>Session Delivery</td>
                                <td> : </td>
                                <td><?=$jadwal?></td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top">QR Code <button type="button" class="btn btn-primary" onclick="add_barcode()" <?= $data[$count]['status_supply'] != 'Open' ? 'disabled' : '' ?>><i class="fa fa-plus"></i></button>
                                <td style="vertical-align:top"> : </td>
                                <td id="barcodeParent">
                                    
                                    <?php 
                                        $data_detail = $this->OrderLeadPartModel->getDetailOrder($data[$count]['id_order_lead_part']);
                                        // var_dump($data[$count]['jumlah_order_plan']);
                                        if (!empty($data_detail)) {
                                            $barcode = $data_detail;
                                        } else {
                                            $barcode[0]['barcode'] = '';
                                        //     $barcode[1]['barcode'] = '';
                                        //     $barcode[2]['barcode'] = '';
                                        //     $barcode[3]['barcode'] = '';
                                        //     $barcode[4]['barcode'] = '';
                                        //     $barcode[5]['barcode'] = '';
                                        //     $barcode[6]['barcode'] = '';
                                        //     $barcode[7]['barcode'] = '';
                                        //     $barcode[8]['barcode'] = '';
                                        //     $barcode[9]['barcode'] = '';
                                        //     $barcode[10]['barcode'] = '';
                                        }

                                        // // for ($i=0; $i < $data[$count]['jumlah_box']; $i++) { 
                                        $count_barcode = (!empty($data_detail)) ? count($data_detail) : 1;
                                        for ($i=0; $i < $count_barcode; $i++) {
                                            $barc = str_replace(',', '.', $barcode[$i]['barcode']); 
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
                                <td id="supplyParent">
                                    
                                    <?php 
                                        $data_detail = $this->OrderLeadPartModel->getDetailOrder($data[$count]['id_order_lead_part']);
                                        // var_dump($data[$count]['jumlah_order_plan']);
                                        if (!empty($data_detail)) {
                                            $qty_supply = $data_detail;
                                        } else {
                                            $qty_supply[0]['qty_order_lead_part'] = '';
                                            // $qty_supply[1]['qty_order_lead_part'] = '';
                                            // $qty_supply[2]['qty_order_lead_part'] = '';
                                            // $qty_supply[3]['qty_order_lead_part'] = '';
                                            // $qty_supply[4]['qty_order_lead_part'] = '';
                                            // $qty_supply[5]['qty_order_lead_part'] = '';
                                            // $qty_supply[6]['qty_order_lead_part'] = '';
                                            // $qty_supply[7]['qty_order_lead_part'] = '';
                                            // $qty_supply[8]['qty_order_lead_part'] = '';
                                            // $qty_supply[9]['qty_order_lead_part'] = '';
                                            // $qty_supply[10]['qty_order_lead_part'] = '';
                                        }

                                        // for ($i=0; $i < $data[$count]['jumlah_box']; $i++) { 
                                        $count_qty = (!empty($data_detail)) ? count($data_detail) : 1;
                                        for ($i=0; $i < $count_qty; $i++) { 
                                            $qty_actq = str_replace(',', '.', $qty_supply[$i]['qty_order_lead_part']); 
                                            ?>
                                            <div class="input-group" style="margin-bottom: 10px;">
                                                <input type="number" class="form-control supply-input" id="actual_supply_<?=$i?>" name="actual_supply[]" value="<?=$qty_actq?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        box
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

                                    if ($data[$count]['status'] == 'Open' || empty($data[$count+1]['status'])) {
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
                                <input type="submit" name="action_supply" id="btn_scan_gedung" class="btn btn-lg btn-info" value="Scan QR code gedung" onclick="return confirm('Apakah lead part sudah dikirim?')" <?=$disabledScan?>>
                                <!-- <input type="submit" name="action_supply" id="btn_scan_gedung" class="btn btn-lg btn-info" value="Scan QR code gedung" <?=$disabledScan?> style="display:none;">
                                <button type="button" class="btn btn-lg btn-info" data-toggle="modal" data-target="#modal_confirm" <?=$disabledScan?>>Scan QR code gedung</button> -->
                            </div>
                            <div class="col-4" style="text-align:right;">
                                <button type="button" onclick="linkPage(<?=$linkBtnNext?>)" class="btn btn-lg btn-primary" style="float:right;" <?=$disabledNext?>>Next</button>
                            </div>
                        </div>
                        <input type="text" name="id_order_lead_part" value="<?=$data[$count]['id_order_lead_part']?>" readonly>
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
                            <div class="block-content">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <input type="text" class="form-control" id="qr_code" name="qr_code" placeholder="Scan QR Code" onchange="scanGedung()" autofocus>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
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

<div class="modal" id="loading-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color:rgba(0, 0, 0, 0.01);">
      <div class="modal-body text-center">
        <div class="spinner-border text-light" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <h5 class="mt-2 text-light">Loading...</h5>
      </div>
    </div>
  </div>
</div>

<script>
    $("#filter_delivery").val("<?=$sesi_now?>");
    let arrQr = [];

    $(document).ready(function() {
        $('#modal_confirm').on('shown.bs.modal', function() {
            $('#qr_code').trigger('focus');
        });

        $("#barcode_0").focus();
    });

    function filterByDate() {
        var tanggal = $('#filterTanggal').val()
        window.location.replace('<?=base_url(); ?>order_lead_part/activity_supply_formation/'+tanggal);
    }

    function filterByDelivery() {
        var tanggal = $('#filterTanggal').val()
        var sesi = $('#filter_delivery').val()
        window.location.replace('<?=base_url(); ?>order_lead_part/activity_supply_formation/'+tanggal+'/'+sesi);
    }

    function linkPage(i) {
        var tanggal = $('#filterTanggal').val()
        var sesi = $('#filter_delivery').val()
        window.location.replace('<?=base_url(); ?>order_lead_part/activity_supply_formation/'+tanggal+'/'+sesi+'/'+i);
    }

    function scanQr(index) {
        console.log($("#barcode_"+index).val());
        let barc = $("#barcode_"+index).val();
        let alertshown = false;
        $('#loading-modal').modal('show');
        document.addEventListener('keyup', function(event) {
            if (event.keyCode == 9) {
                if(arrQr.includes(barc) == true) {
                    if(alertshown == false) {
                        console.log(arrQr);
                        alertshown = true;
                        window.alert('Barcode sudah di scan');
                        $("#barcode_"+index).val('');
                        $('#loading-modal').modal('hide');
                        $("#barcode_"+index).focus();
                    }
                } else {
                    if(alertshown == false) {
                        arrQr[index] = barc;
                        alertshown = true;
                        $.ajax({
                            type: "POST",
                            url: "<?=base_url(); ?>order_lead_part/checkQtyBarcode",
                            async: true,
                            dataType: 'json',
                            data:{
                                barc : barc
                            },
                            success: function(data)
                            {
                                console.log(data);
                                $('#loading-modal').modal('hide');
                                if(data['status'] == 'Barcode dapat digunakan') {
                                    if (data['barcode'] === undefined || data['barcode'].length == 0) {
                                        console.log('Data Tidak Ditemukan');
                                        $("#actual_supply_"+index).val('');
                                        $("#barcode_"+index).focus();
                                    } else {
                                        console.log(data['barcode'][0].QTY);
                                        console.log(data['barcode'][0].BARC);
                                        $("#barcode_"+index).val(data['barcode'][0].BARC)
                                        $("#actual_supply_"+index).val(data['barcode'][0].QTY);
                                        $("#barcode_"+(index+1)).focus();
                                    }
                                } else {
                                    window.alert(data['status']);
                                    $("#barcode_"+index).val('');
                                    $("#actual_supply_"+index).val('');
                                    $("#barcode_"+index).focus();
                                }
                            }
                        });
                    }
                }
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

    var totalInputs = document.querySelectorAll('.supply-input').length;

    function add_barcode() {
        // Create new barcode input
        var newBarcodeInput = document.createElement('div');
        newBarcodeInput.className = 'input-group';
        newBarcodeInput.style.marginBottom = '10px';
        newBarcodeInput.innerHTML = '<input type="text" class="form-control supply-input" id="barcode_' + totalInputs + '" name="barcode[]" onchange="scanQr(' + totalInputs + ')" value="">';

        // Append new barcode input to parent
        var barcodeParent = document.querySelector('#barcodeParent'); // replace with actual parent element's ID
        barcodeParent.appendChild(newBarcodeInput);

        // Create new actual supply input
        var newSupplyInput = document.createElement('div');
        newSupplyInput.className = 'input-group';
        newSupplyInput.style.marginBottom = '10px';
        newSupplyInput.innerHTML = '<input type="number" class="form-control supply-input" id="actual_supply_' + totalInputs + '" name="actual_supply[]" value="" required><div class="input-group-append"><span class="input-group-text">box</span></div>';

        // Append new actual supply input to parent
        var supplyParent = document.querySelector('#supplyParent'); // replace with actual parent element's ID
        supplyParent.appendChild(newSupplyInput);

        // Increment totalInputs
        totalInputs++;
    }
</script>