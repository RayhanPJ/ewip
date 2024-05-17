<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">List Order Plate</h2>
    
    <div class="col-md-12">
        <!-- <button type="button" class="btn btn-alt-primary" data-toggle="modal" data-target="#modal-large"><i class="fa fa-plus mr-5"></i>Display Order</button> -->
        <button type="button" class="btn btn-alt-primary" onclick="displayOrder()"><i class="fa fa-plus mr-5"></i>Display Order</button>
        <select name="filter_line" id="filter_line" onchange="filterByLine()">
            <option value="" <?=$ket = ($line == null) ? 'selected' : ''?>>All</option>
            <option value="1" <?=$ket = ($line == 1) ? 'selected' : ''?>>Line 1</option>
            <option value="2" <?=$ket = ($line == 2) ? 'selected' : ''?>>Line 2</option>
            <option value="3" <?=$ket = ($line == 3) ? 'selected' : ''?>>Line 3</option>
        </select>
        <!-- <input type="date" name="" id="filterTanggal" value="<?=$filterDate;?>" onchange="filterByDate()"> -->

        <!-- List Order Modal -->
        <div class="modal" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">List Order</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                            
                        <!-- Block Tabs Default Style -->
                        <div class="block">
                            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tabs-positif">Positif</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tabs-negatif">Negatif</a>
                                </li>
                            </ul>
                            <div class="block-content tab-content">
                                <!-- ORDER POSITIF -->
                                <div class="tab-pane active" id="tabs-positif" role="tabpanel">
                                    <form action="<?=base_url()?>order_plate/saveOrderPlatePositif" method="post">
                                        <div class="block-content">
                                            <h3 style="text-align: center;">Plate Positif</h3>
                                            <table class="table table-bordered table-striped table-vcenter">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="3" style="vertical-align : middle;text-align:center">Line</th>
                                                        <th rowspan="3" style="vertical-align : middle;text-align:center">Type Plate</th>
                                                        <th rowspan="3" style="vertical-align : middle;text-align:center">Qty WO (Pnl)</th>
                                                        <th colspan="2" style="vertical-align : middle;text-align:center">Sisa plate (Pnl)</th>
                                                        <th colspan="2" style="vertical-align : middle;text-align:center">Order</th>
                                                    </tr>
                                                    <tr>
                                                        <td>After</td>
                                                        <td>Before</td>
                                                        <td>Pnl</td>
                                                        <td>Rak/Basket</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="display_order_positif">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </form>      
                                </div>
                                <!-- ORDER NEGATIF -->
                                <div class="tab-pane" id="tabs-negatif" role="tabpanel">
                                    <form action="<?=base_url()?>order_plate/saveOrderPlateNegatif" method="post">
                                        <div class="block-content">
                                            <h3 style="text-align: center;">Plate Negatif</h3>
                                            <table class="table table-bordered table-striped table-vcenter">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="3" style="vertical-align : middle;text-align:center">Line</th>
                                                        <th rowspan="3" style="vertical-align : middle;text-align:center">Type Plate</th>
                                                        <th rowspan="3" style="vertical-align : middle;text-align:center">Qty WO (Pnl)</th>
                                                        <th colspan="2" style="vertical-align : middle;text-align:center">Sisa plate (Pnl)</th>
                                                        <th colspan="2" style="vertical-align : middle;text-align:center">Order</th>
                                                    </tr>
                                                    <tr>
                                                        <td>After</td>
                                                        <td>Before</td>
                                                        <td>Pnl</td>
                                                        <td>Rak/Basket</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="display_order_negatif">
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- END Block Tabs Default Style -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END List Order Modal -->
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <div class="table-responsive">
                    <table id="list-wo" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th rowspan="3" style="vertical-align : middle;text-align:center;border: 1px solid #e4e7ed;">No</th>
                                <th rowspan="3" style="vertical-align : middle;text-align:center;border: 1px solid #e4e7ed;">Line</th>
                                <th rowspan="3" style="vertical-align : middle;text-align:center;border: 1px solid #e4e7ed;">No WO</th>
                            </tr>
                            <tr>
                                <th colspan="6" style="text-align:center;">Order Plate</th>
                                <!-- <th rowspan="3" style="vertical-align : middle;text-align:center;border: 1px solid #e4e7ed;">Action</th> -->
                            </tr>
                            <tr>
                                <th style="text-align:center;border: 1px solid #e4e7ed;">Positif</th>
                                <th style="text-align:center;border: 1px solid #e4e7ed;">Qty</th>
                                <th style="text-align:center;border: 1px solid #e4e7ed;">Order</th>
                                <th style="text-align:center;border: 1px solid #e4e7ed;">Negatif</th>
                                <th style="text-align:center;border: 1px solid #e4e7ed;">Qty</th>
                                <th style="text-align:center;border: 1px solid #e4e7ed;">Order</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                foreach ($data as $d) { ?>
                                    <tr>
                                        <td>
                                            <?=$i?>
                                        </td>
                                        <td>
                                            <?=$d['LINE']?>
                                            <input type="hidden" id="line_<?=$i?>" value="<?=$d['LINE']?>">
                                        </td>
                                        <td>
                                            <?=$d['NO_WO']?>
                                            <input type="hidden" id="no_wo_<?=$i?>" value="<?=$d['NO_WO']?>">
                                            <input type="hidden" id="part_number_<?=$i?>" value="<?=trim($d['PART_NUMBER'])?>">
                                        </td>
                                        <?php
                                            $part_number = $this->OrderPlateModel->getListPartNumber(trim($d['PART_NUMBER']));
                                            $j = 1;
                                            foreach ($part_number as $pn) { 
                                                $k = $i.$j;
                                                $qty = (int)$pn['lot_size'] * (int)$d['LOT_QTY'];
                                                $jenisPlate = ($j == 1) ? 'Positif' : 'Negatif';
                                                $checkRow = $this->OrderPlateModel->getCheckDraft($d['NO_WO'], $pn['pn_plate']);
                                                $checkDisable = $this->OrderPlateModel->getCheckDraftOrder($d['NO_WO'], $pn['pn_plate']);
                                                // var_dump($checkRow);
                                                $checked = ($checkRow > 0) ? 'checked' : '' ;
                                                $disabled = ($checkDisable > 0) ? 'disabled' : '' ; ?>
                                                <td>
                                                    <?=substr($pn['pn_plate'],3,-2)?>
                                                    <input type="hidden" id="pn_plate_<?=$k?>" value="<?=$pn['pn_plate']?>">
                                                </td>
                                                <td style="text-align:center;">
                                                    <?=$qty?>
                                                    <input type="hidden" id="qty_plate_<?=$k?>" value="<?=$qty?>">
                                                    <input type="hidden" id="jenis_plate_<?=$k?>" value="<?=$jenisPlate?>">
                                                </td>
                                                <td style="text-align:center;">
                                                    <input type="checkbox" name="" id="order_<?=$k?>" onchange="checkWO(<?=$k?>,<?=$i?>)" <?=$checked.' '.$disabled?>>
                                                </td>
                                        <?php  $j++;  } ?>
                                    </tr>
                            <?php  $i++;  }
                            ?>
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
    var arr = [];
    function checkWO(k, i) {
        var line = $('#line_'+i).val();
        var no_wo = $('#no_wo_'+i).val();
        var part_number = $('#part_number_'+i).val();
        var jenis_plate = $('#jenis_plate_'+k).val();
        var pn_plate = $('#pn_plate_'+k).val();
        var qty_plate = $('#qty_plate_'+k).val();
        
        if ($('#order_'+k).is(":checked")) {            
            $.ajax({
                type: "POST",
                url: "<?=base_url(); ?>order_plate/saveDraftOrderPlate",
                async: true,
                dataType: 'json',
                data:{
                    line: line,
                    no_wo : no_wo,
                    part_number : part_number,
                    jenis_plate : jenis_plate,
                    type_plate : pn_plate,
                    qty_wo : qty_plate
                },
                success: function(data)
                {
                    console.log(data);
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "<?=base_url(); ?>order_plate/deleteDraftOrderPlate",
                async: true,
                dataType: 'json',
                data:{
                    no_wo : no_wo,
                    type_plate : pn_plate
                },
                success: function(data)
                {
                    console.log(data);
                }
            });
        }
    }

    function displayOrder() {
        
        var url = window.location.pathname;
        url = url.split('/');
        var line = url[4];

        if (typeof line == 'undefined') {
            line = '';
        }

        // GET DATA DRAFT PLATE POSITIF
        $.ajax({
            type: "GET",
            url: "<?=base_url(); ?>order_plate/draftOrderPlatePositif/"+line,
            async: true,
            dataType: 'json',
            success: function(data)
            {
                // console.log(data);
                var html = '';
                for (let i = 0; i < data.length; i++) {
                    html += `<tr>
                                <td>
                                    <span id="line_${i}">${data[i].line}</span>
                                    <input type="hidden" name="line_plate_positif[]" id="line_plate_positif_${i}" value="${data[i].line}">
                                </td>
                                <td>
                                    <span id="type_plate_pos_${i}">${data[i].type_plate.slice(3,-2)}</span>
                                    <input type="hidden" name="type_plate_positif[]" id="type_plate_positif_${i}" value="${data[i].type_plate}">
                                </td>
                                <td>
                                    <span id="qty_wo_pos_${i}">${data[i].qty_wo}</span>
                                    <input type="hidden" name="qty_wo_positif[]" id="qty_wo_positif_${i}" value="${data[i].qty_wo}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="sisa_positif_after[]" id="sisa_pos_after_${i}" onkeyup="sisaPositif(${i})" required>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="sisa_positif_before[]" id="sisa_pos_before_${i}" onkeyup="sisaPositif(${i})" required>
                                </td>
                                <td>
                                    <span id="qty_pos_order_${i}">0</span>
                                    <input type="hidden" name="qty_order_positif[]" id="qty_order_positif_${i}" value="">
                                </td>
                                <td>
                                    <span id="basket_pos_order_${i}">0</span>
                                    <input type="hidden" name="basket_order_positif[]" id="basket_order_positif_${i}" value="">
                                    <input type="hidden" name="qty_per_basket[]" id="qty_per_basket_${i}" value="">
                                </td>
                            </tr>`;
                }
                $('#display_order_positif').html(html);
            }
        });

        // GET DATA DRAFT PLATE NEGATIF
        $.ajax({
            type: "GET",
            url: "<?=base_url(); ?>order_plate/draftOrderPlateNegatif/"+line,
            async: true,
            dataType: 'json',
            success: function(data)
            {
                // console.log(data);
                var html = '';
                for (let i = 0; i < data.length; i++) {
                    html += `<tr>
                                <td>
                                    <span id="line_${i}">${data[i].line}</span>
                                    <input type="hidden" name="line_plate_negatif[]" id="line_plate_negatif${i}" value="${data[i].line}">
                                </td>
                                <td>
                                    <span id="type_plate_neg_${i}">${data[i].type_plate.slice(3,-2)}</span>
                                    <input type="hidden" name="type_plate_negatif[]" id="type_plate_negatif_${i}" value="${data[i].type_plate}">
                                </td>
                                <td>
                                    <span id="qty_wo_neg_${i}">${data[i].qty_wo}</span>
                                    <input type="hidden" name="qty_wo_negatif[]" id="qty_wo_negatif${i}" value="${data[i].qty_wo}">
                                </td>
                                <td>
                                    <input type="number" name="sisa_neg_after_${i}" id="sisa_neg_after_${i}" onkeyup="sisaNegatif(${i})">
                                </td>
                                <td>
                                    <input type="number" name="sisa_neg_before_${i}" id="sisa_neg_before_${i}" onkeyup="sisaNegatif(${i})">
                                </td>
                                <td>
                                    <span id="qty_neg_order_${i}">0</span>
                                    <input type="hidden" name="qty_order_negatif[]" id="qty_order_negatif_${i}" value="">
                                </td>
                                <td>
                                    <span id="basket_neg_order_${i}">0</span>
                                    <input type="hidden" name="basket_order_negatif[]" id="basket_order_negatif_${i}" value="">
                                    <input type="hidden" name="qty_per_basket_negatif[]" id="qty_per_basket_negatif_${i}" value="">
                                </td>
                            `;
                }
                $('#display_order_negatif').html(html);
            }
        });

        $('#modal-large').modal('show');
    }

    function sisaPositif(i) {
        var qty_wo = $("#qty_wo_pos_"+i).text();
        var type_plate = $("#type_plate_pos_"+i).text();
        var sisa_pos_after = $("#sisa_pos_after_"+i).val();
        var sisa_pos_before = $("#sisa_pos_before_"+i).val();
        var hasil = qty_wo - sisa_pos_after - sisa_pos_before;
        $("#qty_pos_order_"+i).text(hasil);
        $("#qty_order_positif_"+i).val(hasil);
        // console.log(hasil);
        // console.log(type_plate.split("-",1));
        var size_basket;
        
        if (type_plate.includes("FOPL")) {
            if (type_plate.includes("CG80")) {
                size_basket = (hasil / 1190);
                $("#basket_pos_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_positif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_"+i).val(1190);
            } else if (type_plate.includes("CG82")) {
                size_basket = (hasil / 1330);
                $("#basket_pos_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_positif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_"+i).val(1330);
            } else if (type_plate.includes("CG85") || type_plate.includes("CM84")) {
                size_basket = (hasil / 1512);
                $("#basket_pos_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_positif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_"+i).val(1512);
            } else if (type_plate.includes("CG87")) {
                size_basket = (hasil / 1640);
                $("#basket_pos_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_positif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_"+i).val(1640);
            } else if (type_plate.includes("CM87")) {
                size_basket = (hasil / 1615);
                $("#basket_pos_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_positif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_"+i).val(1615);
            }
        } else if (type_plate.includes("UNPL")) {
            if (type_plate.includes("CG80") || type_plate.includes("YG79HD") || type_plate.includes("YG80")) {
                size_basket = (hasil / 2160);
                $("#basket_pos_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_positif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_"+i).val(2160);
            } else if (type_plate.includes("CG82") || type_plate.includes("YG82")) {
                size_basket = (hasil / 2400);
                $("#basket_pos_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_positif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_"+i).val(2400);
            } else if (type_plate.includes("CG85") || type_plate.includes("YG85")) {
                size_basket = (hasil / 2760);
                $("#basket_pos_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_positif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_"+i).val(2760);
            } else if (type_plate.includes("CM87") || type_plate.includes("CG87") || type_plate.includes("YG87")) {
                size_basket = (hasil / 3180);
                $("#basket_pos_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_positif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_"+i).val(3180);
            } else if (type_plate.includes("CM84") || type_plate.includes("YM84")) {
                size_basket = (hasil / 2700);
                $("#basket_pos_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_positif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_"+i).val(2700);
            } else if (type_plate.includes("WG83") || type_plate.includes("WG87")) {
                size_basket = (hasil / 1050);
                $("#basket_pos_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_positif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_"+i).val(2700);
            } else if (type_plate.includes("WM84") || type_plate.includes("WM85")) {
                size_basket = (hasil / 1260);
                $("#basket_pos_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_positif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_"+i).val(2700);
            }
        }
    }

    function sisaNegatif(i) {
        var qty_wo = $("#qty_wo_neg_"+i).text();
        var type_plate = $("#type_plate_neg_"+i).text();
        var sisa_neg_after = $("#sisa_neg_after_"+i).val();
        var sisa_neg_before = $("#sisa_neg_before_"+i).val();
        var hasil = qty_wo - sisa_neg_after - sisa_neg_before;
        $("#qty_neg_order_"+i).text(hasil);
        $("#qty_order_negatif_"+i).val(hasil);
        console.log(type_plate);
        var size_basket;
        
        if (type_plate.includes("FOPL")) {
            if (type_plate.includes("CG80")) {
                size_basket = (hasil / 1190);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(1190);
            } else if (type_plate.includes("CG82")) {
                size_basket = (hasil / 1330);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(1330);
            } else if (type_plate.includes("CG85")) {
                size_basket = (hasil / 1475);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(1475);
            } else if (type_plate.includes("CG87")) {
                size_basket = (hasil / 1640);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(1640);
            } else if (type_plate.includes("CM84")) {
                size_basket = (hasil / 1512);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(1512);
            } else if (type_plate.includes("CM87")) {
                size_basket = (hasil / 1615);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(1615);
            }
        } else if (type_plate.includes("UNPL")) {
            if (type_plate.includes("CG80") || type_plate.includes("YG79HD") || type_plate.includes("YG80")) {
                size_basket = (hasil / 2160);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(2160);
            } else if (type_plate.includes("CG82") || type_plate.includes("YG82")) {
                size_basket = (hasil / 2400);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(2400);
            } else if (type_plate.includes("CG85") || type_plate.includes("YG85")) {
                size_basket = (hasil / 2760);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(2760);
            } else if (type_plate.includes("CM87") || type_plate.includes("CG87") || type_plate.includes("YG87")) {
                size_basket = (hasil / 3180);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(3180);
            } else if (type_plate.includes("CM84") || type_plate.includes("YM84")) {
                size_basket = (hasil / 2700);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(2700);
            } else if (type_plate.includes("WG83") || type_plate.includes("WG87")) {
                size_basket = (hasil / 1050);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(2700);
            } else if (type_plate.includes("WM84") || type_plate.includes("WM85")) {
                size_basket = (hasil / 1260);
                $("#basket_neg_order_"+i).text(size_basket.toFixed(2));
                $("#basket_order_negatif_"+i).val(size_basket.toFixed(2));
                $("#qty_per_basket_negatif_"+i).val(2700);
            }
        }
    }

    function filterByLine() {
        var line = $('#filter_line').val()
        window.location.replace('<?=base_url(); ?>order_plate/list_wo/'+line);
    }
</script>