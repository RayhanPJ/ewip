<?php
// var_dump($data); die();
?>
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">List Order Plate</h2>
    <?php echo $this->session->userdata('username'); ?>
    <div class="col-md-12">
        <button type="button" class="btn btn-alt-primary" data-toggle="modal" data-target="#modal-normal"><i class="fa fa-plus mr-5"></i>Input Order</button>
        &nbsp;
        <input type="date" name="" id="filterTanggal" value="<?=$date?>" onchange="filterByDate()">
        <br>

        <!-- Add Order Modal -->
        <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="<?php echo base_url('order_plate/saveOrderPlate') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Order Plate</h3>
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
                                            <?php for ($i=1; $i <= 7; $i++) {?>
                                                <option value="<?=$i?>">Line <?=$i?></option>
                                            <?php }?>
                                            <option value="MCB">MCB</option>
                                            <option value="FOR_C_Barat">Formation C Barat</option>
                                            <option value="FOR_C_Timur">Formation C Timur</option>
                                            <option value="FOR_F_Barat">Formation F Barat</option>
                                            <option value="FOR_F_Timur">Formation F Timur</option>
                                        </select>
                                    </div>
                                    
                                    <label class="col-12" for="jenis_plate">Jenis Plate</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="jenis_plate" name="jenis_plate" required>
                                            <option value="" selected disabled>-- Pilih ---</option>
                                            <!-- <option value="Unform" <?=($this->session->userdata('username') == 'formation_c' OR $this->session->userdata('username') == 'formation_f') ? 'selected': '' ?>>Unfrom</option> -->
                                            <option value="Unform">Unform</option>
                                            <option value="Form Plate">Form Plate</option>
                                        </select>
                                    </div>


                                    <label class="col-12">Positif</label>

                                    <label class="col-12" for="type_plate">Type Plate</label>
                                    <div class="col-md-9" id="type_plate_section_pos">
                                        <select class="form-control" id="type_plate" name="type_plate_pos" required>
                                            <option value="" selected disabled>-- Pilih ---</option>
                                        </select>
                                    </div>
                                    
                                    <label class="col-12" for="jumlah_order">Qty</label>
                                    <div class="col-md-9">
                                        <div class="input-group control-group">
                                            <input type="number" class="form-control" id="qty" name="qty_pos" onkeyup="qtyPnl()" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    rak/basket
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group control-group">
                                            <input type="number" class="form-control" id="qty_pnl" name="qty_pnl_pos" required readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    pnl
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <label class="col-12" for="sesi">Session Delivery</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="sesi" name="sesi_pos" required>
                                            <option value="" selected disabled>-- Pilih ---</option>
                                            <!-- <option value="1">Sesi 1 (07.30 - 10.30)</option>
                                            <option value="2">Sesi 2 (10.30 - 16.30)</option>
                                            <option value="3">Sesi 3 (16.30 - 20.00)</option>
                                            <option value="4">Sesi 4 (20.00 - 00.30)</option>
                                            <option value="5">Sesi 5 (00.30 - 03.00)</option>
                                            <option value="6">Sesi 6 (03.00 - 07.30)</option> -->
                                            <?php if ($this->session->userdata('username') == 'formation_c' OR $this->session->userdata('username') == 'formation_f') { ?>
                                                <option value="1">Sesi 1 (09.00 - 10.00)</option>
                                                <option value="2">Sesi 2 (13.30 - 14.30)</option>
                                                <option value="3">Sesi 3 (18.30 - 19.30)</option>
                                                <option value="4">Sesi 4 (22.00 - 23.00)</option>
                                                <!-- <option value="5">Sesi 5 (02.00 - 03.00)</option>
                                                <option value="6">Sesi 6 (06.03 - 07.30)</option> -->
                                            <?php } else { ?>
                                                <option value="1">Sesi 1 (07.30 - 09.00)</option>
                                                <option value="2">Sesi 2 (11.00 - 13.30)</option>
                                                <option value="3">Sesi 3 (16.30 - 18.00)</option>
                                                <option value="4">Sesi 4 (21.30 - 22.00)</option>
                                                <option value="5">Sesi 5 (00.30 - 02.00)</option>
                                                <option value="6">Sesi 6 (05.00 - 06.30)</option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <label class="col-12">Negatif</label>

                                    <label class="col-12" for="type_plate_neg">Type Plate</label>
                                    <div class="col-md-9" id="type_plate_section_neg">
                                        <select class="form-control" id="type_plate_neg" name="type_plate_neg" required>
                                            <option value="" selected disabled>-- Pilih ---</option>
                                        </select>
                                    </div>
                                    
                                    <label class="col-12" for="jumlah_order">Qty</label>
                                    <div class="col-md-9">
                                        <div class="input-group control-group">
                                            <input type="number" class="form-control" id="qty_neg" name="qty_neg" onkeyup="qtyPnlNeg()" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    rak/basket
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group control-group">
                                            <input type="number" class="form-control" id="qty_pnl_neg" name="qty_pnl_neg" required readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    pnl
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <label class="col-12" for="sesi">Session Delivery</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="sesi" name="sesi_neg" required>
                                            <option value="" selected disabled>-- Pilih ---</option>
                                            <!-- <option value="1">Sesi 1 (07.30 - 10.30)</option>
                                            <option value="2">Sesi 2 (10.30 - 16.30)</option>
                                            <option value="3">Sesi 3 (16.30 - 20.00)</option>
                                            <option value="4">Sesi 4 (20.00 - 00.30)</option>
                                            <option value="5">Sesi 5 (00.30 - 03.00)</option>
                                            <option value="6">Sesi 6 (03.00 - 07.30)</option> -->
                                            <?php if ($this->session->userdata('username') == 'formation_c' OR $this->session->userdata('username') == 'formation_f') { ?>
                                                <option value="1">Sesi 1 (09.00 - 10.00)</option>
                                                <option value="2">Sesi 2 (13.30 - 14.30)</option>
                                                <option value="3">Sesi 3 (18.30 - 19.30)</option>
                                                <option value="4">Sesi 4 (22.00 - 23.00)</option>
                                                <!-- <option value="5">Sesi 5 (02.00 - 03.00)</option>
                                                <option value="6">Sesi 6 (06.03 - 07.30)</option> -->
                                            <?php } else { ?>
                                                <option value="1">Sesi 1 (07.30 - 09.00)</option>
                                                <option value="2">Sesi 2 (11.00 - 13.30)</option>
                                                <option value="3">Sesi 3 (16.30 - 18.00)</option>
                                                <option value="4">Sesi 4 (21.30 - 22.00)</option>
                                                <option value="5">Sesi 5 (00.30 - 02.00)</option>
                                                <option value="6">Sesi 6 (05.00 - 06.30)</option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>                            
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="action" class="btn btn-alt-secondary" value="Draft">
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
                                <th>Line</th>
                                <th>Jenis Plate</th>
                                <th>Type Plate</th>
                                <th>Create Order</th>
                                <th>Jadwal</th>
                                <th>Plan (pnl)</th>
                                <th>Actual (pnl)</th>
                                <th>Rak/Basket</th>
                                <th>Status</th>
                                <th>Close Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($data as $d) { ?>
                                <tr>
                                    <td><?=$no?></td>
                                    <td><?='L-'.$d['line']?></td>
                                    <td><?=$d['jenis_plate']?></td>
                                    <td><?=$d['type_plate']?></td>
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

                                        if ($this->session->userdata('username') == 'formation_c' OR $this->session->userdata('username') == 'formation_f') {
                                            switch ($d['sesi']) {
                                                case 1:
                                                    $jadwal = 'Shift 1<br>(09.00 - 10.30)';
                                                    break;
                                                case 2:
                                                    $jadwal = 'Shift 1<br>(13.30 - 14.30)';
                                                    break;
                                                case 3:
                                                    $jadwal = 'Shift 2<br>(18.30 - 19.30)';
                                                    break;
                                                case 4:
                                                    $jadwal = 'Shift 2<br>(22.00 - 23.00)';
                                                    break;
                                                case 5:
                                                    $jadwal = 'Shift 3<br>(02.00 - 03.00)';
                                                    break;
                                                case 6:
                                                    $jadwal = 'Shift 3<br>(06.30 - 07.30)';
                                                    break;
                                                default:
                                                    # code...
                                                    break;
                                            }
                                        } else {
                                            switch ($d['sesi']) {
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
                                        }

                                        // switch ($d['sesi']) {
                                        //     case 1:
                                        //         $jadwal = 'Shift 1<br>(07.30 - 10.30)';
                                        //         break;
                                        //     case 2:
                                        //         $jadwal = 'Shift 1<br>(10.30 - 16.30)';
                                        //         break;
                                        //     case 3:
                                        //         $jadwal = 'Shift 2<br>(16.30 - 20.00)';
                                        //         break;
                                        //     case 4:
                                        //         $jadwal = 'Shift 2<br>(20.00 - 00.30)';
                                        //         break;
                                        //     case 5:
                                        //         $jadwal = 'Shift 3<br>(00.30 - 03.00)';
                                        //         break;
                                        //     case 6:
                                        //         $jadwal = 'Shift 3<br>(03.00 - 07.30)';
                                        //         break;
                                        //     default:
                                        //         # code...
                                        //         break;
                                        // }
                                    ?>
                                    <td><?=$jadwal?></td>
                                    <td><?=$d['jumlah_order_plan']?></td>
                                    <td><?=$qty_actual = ($d['qty_supply'] == null) ? '-' : $d['qty_supply']?></td>
                                    <td><?=$d['jumlah_basket']?></td>
                                    <td><?=$d['status']?></td>
                                    <td><?=$closed_order = ($d['closed_supply'] == null) ? '-' : date('H:i', strtotime($d['closed_supply']))?></td>
                                    <td>
                                        <?php if ($this->session->userdata('level') == 9) { ?>
                                            -
                                        <?php } else {
                                                    if ($d['status'] == 'Open' || $d['status'] == 'Close') { ?>
                                                        -
                                                    <?php } elseif ($d['status'] == 'Draft') { ?>
                                                        <a href="#modalEdit" class="btn btn-info btn_edit" data-id="<?=$d['id_order_plate']?>" data-toggle="modal">
                                                            Edit
                                                        </a>
                                                        <a href="<?=base_url('order_plate/deleteOrderPlate?id='.$d['id_order_plate'])?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">
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
            <form action="<?= base_url() . 'order_plate/updateKonfirmasiSupply'?>" method="POST" enctype="multipart/form-data">
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
                            <input type="hidden" class="form-control" id="id_order_plate_konfirmasi" name="id_order_plate_konfirmasi">
                            <label for="konfirmasi_qty_actual">Qty Actual</label>
                            
                                <div class="input-group">
                                <?php for ($i=0; $i < $jumlah_basket; $i++) { ?>
                                    <input type="number" class="form-control plate-supply-input" id="konfirmasi_qty_actual" name="konfirmasi_qty_actual[]" required>
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
        <form action="<?php echo base_url('order_plate/editOrderPlate') ?>" method="post" enctype="multipart/form-data">
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
                        <input type="text" name="id_order_plate_edit" id="id_order_plate_edit">
                        <div class="form-group row">
                            <label class="col-12" for="line">Line</label>
                            <div class="col-md-9">
                                <select class="form-control" id="line_edit" name="line_edit">
                                    <option value="" selected disabled>-- Pilih ---</option>
                                    <?php for ($i=1; $i <= 7; $i++) {?>
                                        <option value="<?=$i?>">Line <?=$i?></option>
                                    <?php }?>
                                </select>
                            </div>
                            
                            <label class="col-12" for="jenis_plate">Jenis Plate</label>
                            <div class="col-md-9">
                                <select class="form-control" id="jenis_plate_edit" name="jenis_plate_edit" required>
                                    <option value="" selected disabled>-- Pilih ---</option>
                                    <option value="Unform">Unfrom</option>
                                    <option value="Form Plate">Form Plate</option>
                                </select>
                            </div>

                            <label class="col-12" for="type_plate">Type Plate</label>
                            <div class="col-md-9" id="type_plate_section_edit">
                                <select class="form-control" id="type_plate_edit" name="type_plate_edit" required>
                                    <option value="" selected disabled>-- Pilih ---</option>
                                </select>
                            </div>
                            
                            <label class="col-12" for="jumlah_order">Qty</label>
                            <div class="col-md-9">
                                <div class="input-group control-group">
                                    <input type="number" class="form-control" id="qty_edit" name="qty_edit" onkeyup="qtyPnlEdit()" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            rak/basket
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group control-group">
                                    <input type="number" class="form-control" id="qty_pnl_edit" name="qty_pnl_edit" required readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            pnl
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
                    <input type="submit" name="action_edit" class="btn btn-alt-secondary" value="Draft">
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
            var id_order_plate = $(this).data('id');
            $("#id_order_plate_konfirmasi").val( id_order_plate );
        });

        $(document).on("click", ".btn_edit", function () {
            var id_order_plate = $(this).data('id');
            $("#id_order_plate_edit").val( id_order_plate );

            $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?=base_url(); ?>order_plate/getListOrderPlateById",
            data:{
                id_order_plate:id_order_plate
            },
            success: function(data)
            {
                $("#line_edit").val( data[0].line );
                $("#jenis_plate_edit").val( data[0].jenis_plate );
                $("#qty_edit").val( data[0].jumlah_basket );
                $("#qty_pnl_edit").val( data[0].jumlah_order_plan );
                $("#sesi_edit").val( data[0].sesi );
                var id_plate = data[0].id_plate;
                $("#type_plate_section_edit").html(' ');
                // alert(jenis_plate);
                $.ajax({
                    type: "POST",
                    url: "<?=base_url(); ?>order_plate/getTypePlateEdit",
                    data:{
                        jenis_plate:data[0].jenis_plate
                    },
                    success: function(data)
                    {
                        $("#type_plate_section_edit").html(data);
                $("#type_plate_edit").val( id_plate );
                console.log(id_plate);
                        
                        
                    }
                });

            }
        });
        });
    });

    function filterByDate() {
        var date = $('#filterTanggal').val()
        window.location.replace('<?=base_url(); ?>order_plate/list_order/'+date);
    }

    $('#jenis_plate').on('change', function () {
        var jenis_plate = this.value;
        $("#type_plate_section_neg").html(' ');
        $("#type_plate_section_pos").html(' ');

        $.ajax({
            type: "POST",
            url: "<?=base_url(); ?>order_plate/getTypePlate/negatif",
            data:{
                jenis_plate:jenis_plate
            },
            success: function(data)
            {
                $("#type_plate_section_neg").html(data);
            }
        });

        $.ajax({
            type: "POST",
            url: "<?=base_url(); ?>order_plate/getTypePlate/positif",
            data:{
                jenis_plate:jenis_plate
            },
            success: function(data)
            {
                $("#type_plate_section_pos").html(data);
            }
        });
    });

    $('#jenis_plate_edit').on('change', function () {
        var jenis_plate = this.value;
        $("#type_plate_section_edit").html(' ');

        $.ajax({
            type: "POST",
            url: "<?=base_url(); ?>order_plate/getTypePlateEdit",
            data:{
                jenis_plate:jenis_plate
            },
            success: function(data)
            {
                $("#type_plate_section_edit").html(data);
            }
        });
    });

    function qtyPnl() {
        var jumlah_rak = $('#qty').val();
        var id_plate = $('#type_plate').val();

        $.ajax({
            type: "POST",
            dataType : "json",
            url: "<?=base_url(); ?>order_plate/getQtyPlate",
            data:{
                id_plate:id_plate
            },
            success: function(data)
            {
                console.log(data[0].qty_per_tempat);
                $total_pnl = jumlah_rak * data[0].qty_per_tempat;
                $('#qty_pnl').val($total_pnl);
            }
        });
    }

    function qtyPnlNeg() {
        var jumlah_rak = $('#qty_neg').val();
        var id_plate = $('#type_plate_neg').val();

        $.ajax({
            type: "POST",
            dataType : "json",
            url: "<?=base_url(); ?>order_plate/getQtyPlate",
            data:{
                id_plate:id_plate
            },
            success: function(data)
            {
                console.log(data[0].qty_per_tempat);
                $total_pnl = jumlah_rak * data[0].qty_per_tempat;
                $('#qty_pnl_neg').val($total_pnl);
            }
        });
    }

    function qtyPnlEdit() {
        var jumlah_rak = $('#qty_edit').val();
        var id_plate = $('#type_plate_edit').val();

        $.ajax({
            type: "POST",
            dataType : "json",
            url: "<?=base_url(); ?>order_plate/getQtyPlate",
            data:{
                id_plate:id_plate
            },
            success: function(data)
            {
                console.log(data[0].qty_per_tempat);
                $total_pnl = jumlah_rak * data[0].qty_per_tempat;
                $('#qty_pnl_edit').val($total_pnl);
            }
        });
    }
</script>