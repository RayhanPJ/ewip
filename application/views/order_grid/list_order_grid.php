<?php
// var_dump($data); die();
?>
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">List Order Grid</h2>
    <?php echo $this->session->userdata('username'); ?>
    <div class="col-md-12">
        <button type="button" class="btn btn-alt-primary" data-toggle="modal" data-target="#modal-normal"><i class="fa fa-plus mr-5"></i>Input Order</button>
        &nbsp;
        <input type="date" name="" id="filterTanggal" value="<?=$date?>" onchange="filterByDate()">
        <br>

        <!-- Add Order Modal -->
        <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="<?php echo base_url('order_grid/saveOrderGrid') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Order Grid</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="form-group row">
                                    <label class="col-12" for="line">Line</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="line" name="line">
                                            <option value="" selected disabled>-- Pilih ---</option>
                                            <option value="Pasting B (Mesin 2)">Pasting B (Mesin 2)</option>
                                            <option value="Pasting B (Mesin 3)">Pasting B (Mesin 3)</option>
                                            <option value="Pasting E (Mesin 4)">Pasting E (Mesin 4)</option>
                                            <option value="Pasting E (Mesin 5)">Pasting E (Mesin 5)</option>
                                            <option value="Pasting E (Mesin 6)">Pasting E (Mesin 6)</option>
                                        </select>
                                    </div>

                                    <label class="col-12" for="type_grid">Type Grid</label>
                                    <div class="col-md-9" id="type_grid_section">
                                        <select class="form-control" id="type_grid" name="type_grid" required>
                                            <option value="" selected disabled>-- Pilih ---</option>
                                            <?php foreach ($type_grid as $tg) { ?>
                                                <option value="<?=$tg['type_grid']?>"><?=$tg['type_grid']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <label class="col-12" for="jumlah_order">Qty</label>
                                    <div class="col-md-9">
                                        <div class="input-group control-group">
                                            <input type="number" class="form-control" id="qty_pnl" name="qty_pnl" onkeyup="qtyPnl()" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    Pnl
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group control-group">
                                            <input type="number" class="form-control" id="qty" name="qty" required readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    Rak
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <label class="col-12" for="sesi">Session Delivery</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="sesi" name="sesi" required>
                                            <option value="" selected disabled>-- Pilih ---</option>
                                            <option value="1">Sesi 1 (07.30 - 10.30)</option>
                                            <option value="2">Sesi 2 (10.30 - 16.30)</option>
                                            <option value="3">Sesi 3 (16.30 - 20.00)</option>
                                            <option value="4">Sesi 4 (20.00 - 00.30)</option>
                                            <option value="5">Sesi 5 (00.30 - 03.00)</option>
                                            <option value="6">Sesi 6 (03.00 - 07.30)</option>
                                        </select>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <input type="submit" name="action" class="btn btn-alt-secondary" value="Draft"> -->
                            <input type="submit" name="action" class="btn btn-primary" value="Submit"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Add Order Modal -->

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <div class="table-responsive">
                    <table id="list-order" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gedung</th>
                                <th>Type Grid</th>
                                <th>Create Order</th>
                                <th>Jadwal</th>
                                <th>Plan (pnl)</th>
                                <th>Actual (pnl)</th>
                                <th>Rak</th>
                                <th>Status</th>
                                <th>Close Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($data as $d) { ?>
                                <tr>
                                    <td><?=$no?></td>
                                    <td><?='Pasting '.$d['line']?></td>
                                    <td><?=$d['type_grid']?></td>
                                    <td><?=date('H:i', strtotime($d['tanggal_order']))?></td>
                                    <?php
                                        // if ($d['sesi'] == 1) {
                                        //     $jadwal = 'Shift 1';
                                        // } elseif ($d['sesi'] == 5) {
                                        //     $jadwal = 'Shift 2';
                                        // } elseif ($d['sesi'] == 9) {
                                        //     $jadwal = 'Shift 3';
                                        // }

                                        // $jumlah_basket = ceil($d['jumlah_order_plan'] / $d['qty_per_basket']); 

                                        // if ($this->session->userdata('username') == 'formation_c' OR $this->session->userdata('username') == 'formation_f') {
                                        //     switch ($d['sesi']) {
                                        //         case 1:
                                        //             $jadwal = 'Shift 1<br>(09.00 - 10.30)';
                                        //             break;
                                        //         case 2:
                                        //             $jadwal = 'Shift 1<br>(13.30 - 14.30)';
                                        //             break;
                                        //         case 3:
                                        //             $jadwal = 'Shift 2<br>(18.30 - 19.30)';
                                        //             break;
                                        //         case 4:
                                        //             $jadwal = 'Shift 2<br>(22.00 - 23.00)';
                                        //             break;
                                        //         case 5:
                                        //             $jadwal = 'Shift 3<br>(02.00 - 03.00)';
                                        //             break;
                                        //         case 6:
                                        //             $jadwal = 'Shift 3<br>(06.30 - 07.30)';
                                        //             break;
                                        //         default:
                                        //             # code...
                                        //             break;
                                        //     }
                                        // } else {
                                        //     switch ($d['sesi']) {
                                        //         case 1:
                                        //             $jadwal = 'Shift 1<br>(07.30 - 09.00)';
                                        //             break;
                                        //         case 2:
                                        //             $jadwal = 'Shift 1<br>(11.00 - 13.30)';
                                        //             break;
                                        //         case 3:
                                        //             $jadwal = 'Shift 2<br>(16.30 - 18.00)';
                                        //             break;
                                        //         case 4:
                                        //             $jadwal = 'Shift 2<br>(21.30 - 22.00)';
                                        //             break;
                                        //         case 5:
                                        //             $jadwal = 'Shift 3<br>(00.30 - 02.00)';
                                        //             break;
                                        //         case 6:
                                        //             $jadwal = 'Shift 3<br>(05.00 - 06.30)';
                                        //             break;
                                        //         default:
                                        //             # code...
                                        //             break;
                                        //     }
                                        // }

                                        switch ($d['sesi']) {
                                            case 1:
                                                $jadwal = 'Shift 1<br>(07.30 - 10.30)';
                                                break;
                                            case 2:
                                                $jadwal = 'Shift 1<br>(10.30 - 16.30)';
                                                break;
                                            case 3:
                                                $jadwal = 'Shift 2<br>(16.30 - 20.00)';
                                                break;
                                            case 4:
                                                $jadwal = 'Shift 2<br>(20.00 - 00.30)';
                                                break;
                                            case 5:
                                                $jadwal = 'Shift 3<br>(00.30 - 03.00)';
                                                break;
                                            case 6:
                                                $jadwal = 'Shift 3<br>(03.00 - 07.30)';
                                                break;
                                            default:
                                                # code...
                                                break;
                                        }
                                    ?>
                                    <td><?=$jadwal?></td>
                                    <td><?=$d['jumlah_order_plan']?></td>
                                    <td><?=$qty_actual = ($d['qty_supply'] == null) ? '-' : $d['qty_supply']?></td>
                                    <td><?=$d['jumlah_rak']?></td>
                                    <td><?=$d['status']?></td>
                                    <td><?=$closed_order = ($d['closed_supply'] == null) ? '-' : date('H:i', strtotime($d['closed_supply']))?></td>
                                    <td>
                                        <?php if ($this->session->userdata('level') == 9) { ?>
                                            -
                                        <?php } else {
                                                    if ($d['status'] == 'Close') { ?>
                                                        -
                                                    <?php } elseif ($d['status'] == 'Open') { ?>
                                                        <a href="#modalEdit" class="btn btn-info btn_edit" data-id="<?=$d['id_order_grid']?>" data-toggle="modal">
                                                            Edit
                                                        </a>
                                                        <a href="<?=base_url('order_grid/deleteOrderPlate?id='.$d['id_order_grid'])?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">
                                                            Delete
                                                        </a>
                                                    <?php } 
                                                } ?>
                                    </td>
                                </tr>
                            <?php $no++; } ?>
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

<!-- Konfirmasi Modal -->
<!-- <div class="modal" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?= base_url() . 'order_grid/updateKonfirmasiSupply'?>" method="POST" enctype="multipart/form-data">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Konfirmasi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id_order_grid_konfirmasi" name="id_order_grid_konfirmasi">
                            <label for="konfirmasi_qty_actual">Qty Actual</label>
                            
                                <div class="input-group">
                                <?php for ($i=0; $i < $jumlah_basket; $i++) { ?>
                                    <input type="number" class="form-control grid-supply-input" id="konfirmasi_qty_actual" name="konfirmasi_qty_actual[]" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            pnl
                                        </span>
                                    </div>
                                    &nbsp;&nbsp;
                                    <?php } ?>
                                </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- END Konfirmasi Modal -->

<!-- Edit Order Modal -->
<div class="modal" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo base_url('order_grid/editOrderGrid') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Order Timah</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <input type="text" name="id_order_grid_edit" id="id_order_grid_edit">
                        <div class="form-group row">
                            <label class="col-12" for="line">Line</label>
                            <div class="col-md-9">
                                <select class="form-control" id="line_edit" name="line_edit">
                                    <option value="" selected disabled>-- Pilih ---</option>
                                    <option value="Pasting B (Mesin 2)">Pasting B (Mesin 2)</option>
                                    <option value="Pasting B (Mesin 3)">Pasting B (Mesin 3)</option>
                                    <option value="Pasting E (Mesin 4)">Pasting E (Mesin 4)</option>
                                    <option value="Pasting E (Mesin 5)">Pasting E (Mesin 5)</option>
                                    <option value="Pasting E (Mesin 6)">Pasting E (Mesin 6)</option>
                                </select>
                            </div>

                            <label class="col-12" for="type_grid">Type Plate</label>
                            <div class="col-md-9" id="type_grid_section_edit">
                                <select class="form-control" id="type_grid_edit" name="type_grid_edit" required>
                                    <option value="" selected disabled>-- Pilih ---</option>
                                    <?php foreach ($type_grid as $tg) { ?>
                                        <option value="<?=$tg['type_grid']?>"><?=$tg['type_grid']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <label class="col-12" for="jumlah_order">Qty</label>
                            <div class="col-md-9">
                                <div class="input-group control-group">
                                    <input type="number" class="form-control" id="qty_pnl_edit" name="qty_pnl_edit" onkeyup="qtyPnlEdit()" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            Pnl
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group control-group">
                                    <input type="number" class="form-control" id="qty_edit" name="qty_edit" required readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            Rak
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <label class="col-12" for="sesi">Session Delivery</label>
                            <div class="col-md-9">
                                <select class="form-control" id="sesi_edit" name="sesi_edit" required>
                                    <option value="" selected disabled>-- Pilih ---</option>
                                    <option value="1">Sesi 1 (07.30 - 10.30)</option>
                                    <option value="2">Sesi 2 (10.30 - 16.30)</option>
                                    <option value="3">Sesi 3 (16.30 - 20.00)</option>
                                    <option value="4">Sesi 4 (20.00 - 00.30)</option>
                                    <option value="5">Sesi 5 (00.30 - 03.00)</option>
                                    <option value="6">Sesi 6 (03.00 - 07.30)</option>
                                </select>
                            </div>

                        </div>                            
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <input type="submit" name="action_edit" class="btn btn-alt-secondary" value="Draft"> -->
                    <input type="submit" name="action_edit" class="btn btn-primary" value="Submit"/>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END Edit Order Modal -->

<script type="text/javascript">
    $(document).ready(function() {

        $(document).on("click", ".btn_konfirmasi", function () {
            var id_order_grid = $(this).data('id');
            $("#id_order_grid_konfirmasi").val( id_order_grid );
        });

        $(document).on("click", ".btn_edit", function () {
            var id_order_grid = $(this).data('id');
            $("#id_order_grid_edit").val( id_order_grid );

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?=base_url(); ?>order_grid/getListOrderGridById",
                data:{
                    id_order_grid:id_order_grid
                },
                success: function(data)
                {
                    $("#line_edit").val( data[0].line );
                    $("#qty_edit").val( data[0].jumlah_rak );
                    $("#qty_pnl_edit").val( data[0].jumlah_order_plan );
                    $("#sesi_edit").val( data[0].sesi );
                    $("#type_grid_edit").val( data[0].type_grid );
                }
        });
        });
    });

    function filterByDate() {
        var date = $('#filterTanggal').val()
        window.location.replace('<?=base_url(); ?>order_grid/list_order/'+date);
    }

    $('#jenis_grid').on('change', function () {
        var jenis_grid = this.value;
        $("#type_grid_section_neg").html(' ');
        $("#type_grid_section_pos").html(' ');

        $.ajax({
            type: "POST",
            url: "<?=base_url(); ?>order_grid/getTypePlate/negatif",
            data:{
                jenis_grid:jenis_grid
            },
            success: function(data)
            {
                $("#type_grid_section_neg").html(data);
            }
        });

        $.ajax({
            type: "POST",
            url: "<?=base_url(); ?>order_grid/getTypePlate/positif",
            data:{
                jenis_grid:jenis_grid
            },
            success: function(data)
            {
                $("#type_grid_section_pos").html(data);
            }
        });
    });

    $('#jenis_grid_edit').on('change', function () {
        var jenis_grid = this.value;
        $("#type_grid_section_edit").html(' ');

        $.ajax({
            type: "POST",
            url: "<?=base_url(); ?>order_grid/getTypePlateEdit",
            data:{
                jenis_grid:jenis_grid
            },
            success: function(data)
            {
                $("#type_grid_section_edit").html(data);
            }
        });
    });

    function qtyPnl() {
        var jumlah_qty = $('#qty_pnl').val();
        var type_grid = $('#type_grid').val();

        console.log(type_grid);

        $.ajax({
            type: "POST",
            dataType : "json",
            url: "<?=base_url(); ?>order_grid/getQtyGrid",
            data:{
                type_grid:type_grid
            },
            success: function(data)
            {
                console.log(data[0].lot_size);
                $total_pnl = Math.ceil(jumlah_qty / data[0].lot_size);
                $('#qty').val($total_pnl);
            }
        });
    }

    function qtyPnlEdit() {
        var jumlah_qty = $('#qty_pnl_edit').val();
        var type_grid = $('#type_grid_edit').val();

        $.ajax({
            type: "POST",
            dataType : "json",
            url: "<?=base_url(); ?>order_grid/getQtyGrid",
            data:{
                type_grid:type_grid
            },
            success: function(data)
            {
                console.log(data[0].lot_size);
                $total_pnl = Math.ceil(jumlah_qty / data[0].lot_size);
                $('#qty_edit').val($total_pnl);
            }
        });
    }
</script>