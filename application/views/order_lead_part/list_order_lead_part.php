<?php
// var_dump($data); die();
?>
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">List Order Lead Part</h2>
    <?php echo $this->session->userdata('username'); ?>
    <div class="col-md-12">
        <button type="button" class="btn btn-alt-primary" data-toggle="modal" data-target="#modal-normal"><i class="fa fa-plus mr-5"></i>Input Order</button>
        &nbsp;
        <input type="date" name="" id="filterTanggal" value="<?=$date?>" onchange="filterByDate()">
        <br>

        <!-- Add Order Modal -->
        <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="<?php echo base_url('order_lead_part/saveOrderLeadPart') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Order Lead Part</h3>
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
                                    
                                    <label class="col-12" for="jenis_lead_part">Jenis Lead Part</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="jenis_lead_part" name="jenis_lead_part" required>
                                            <option value="" selected disabled>-- Pilih ---</option>
                                            <option value="Lead Stick">Lead Stick</option>
                                            <option value="Connector">Connector</option>
                                            <option value="Pole">Pole</option>
                                        </select>
                                    </div>

                                    <label class="col-12">Lead Part</label>

                                    <label class="col-12" for="type_lead_part">Type Lead Part</label>
                                    <div class="col-md-9" id="type_lead_part_section">
                                        <select class="form-control" id="type_lead_part" name="type_lead_part" required>
                                            <option value="" selected disabled>-- Pilih ---</option>
                                        </select>
                                    </div>
                                    
                                    <label class="col-12" for="jumlah_order">Qty</label>
                                    <div class="col-md-9">
                                        <div class="input-group control-group">
                                            <input type="number" class="form-control" id="qty" name="qty" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    box
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <label class="col-12" for="sesi">Session Delivery</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="sesi" name="sesi" required>
                                            <option value="" selected disabled>-- Pilih ---</option>
                                            <?php if ($this->session->userdata('username') == 'formation_c' OR $this->session->userdata('username') == 'formation_f') { ?>
                                                <option value="1">Sesi 1 (09.00 - 10.00)</option>
                                                <option value="2">Sesi 2 (13.30 - 14.30)</option>
                                                <option value="3">Sesi 3 (18.30 - 19.30)</option>
                                                <option value="4">Sesi 4 (22.00 - 23.00)</option>
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
                                <th>Jenis Lead Part</th>
                                <th>Type Lead Part</th>
                                <th>Create Order</th>
                                <th>Jadwal</th>
                                <th>Plan (box)</th>
                                <th>Actual (box)</th>
                                <!-- <th>Box</th> -->
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
                                    <td><?=$d['jenis_lead_part']?></td>
                                    <td><?=$d['type_lead_part']?></td>
                                    <td><?=date('H:i', strtotime($d['tanggal_order']))?></td>
                                    <?php

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
                                    ?>
                                    <td><?=$jadwal?></td>
                                    <td><?=$d['jumlah_box']?></td>
                                    <td><?=$qty_actual = ($d['qty_supply'] == null) ? '-' : $d['qty_supply']?></td>
                                    <!-- <td><?=$d['jumlah_box']?></td> -->
                                    <td><?=$d['status']?></td>
                                    <td><?=$closed_order = ($d['closed_supply'] == null) ? '-' : date('H:i', strtotime($d['closed_supply']))?></td>
                                    <td>
                                        <?php if ($this->session->userdata('level') == 9) { ?>
                                            -
                                        <?php } else {
                                                    if ($d['status'] == 'Open' || $d['status'] == 'Close') { ?>
                                                        -
                                                    <?php } elseif ($d['status'] == 'Draft') { ?>
                                                        <a href="#modalEdit" class="btn btn-info btn_edit" data-id="<?=$d['id_order_lead_part']?>" data-toggle="modal">
                                                            Edit
                                                        </a>
                                                        <a href="<?=base_url('order_lead_part/deleteOrderLeadPart?id='.$d['id_order_lead_part'])?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">
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

<!-- Edit Order Modal -->
<div class="modal" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo base_url('order_lead_part/editOrderLeadPart') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Order Lead Part</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <input type="text" name="id_order_lead_part_edit" id="id_order_lead_part_edit">
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
                            
                            <label class="col-12" for="jenis_lead_part_edit">Jenis Lead Part</label>
                            <div class="col-md-9">
                                <select class="form-control" id="jenis_lead_part_edit" name="jenis_lead_part_edit" required>
                                    <option value="" selected disabled>-- Pilih ---</option>
                                    <option value="Lead Stick">Lead Stick</option>
                                    <option value="Connector">Connector</option>
                                    <option value="Pole">Pole</option>
                                </select>
                            </div>

                            <label class="col-12" for="type_lead_part_edit">Type Lead Part</label>
                            <div class="col-md-9" id="type_lead_part_section_edit">
                                <select class="form-control" id="type_lead_part_edit" name="type_lead_part_edit" required>
                                    <option value="" selected disabled>-- Pilih ---</option>
                                </select>
                            </div>
                            
                            <label class="col-12" for="qty_edit">Qty</label>
                            <div class="col-md-9">
                                <div class="input-group control-group">
                                    <input type="number" class="form-control" id="qty_edit" name="qty_edit" onkeyup="qtyPnlEdit()" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            box
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <label class="col-12" for="sesi_edit">Session Delivery</label>
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

<div class="modal" id="loading-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true" style="z-index: 1100;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color:white;">
            <div class="modal-body text-center">
                <div class="spinner-border text-dark" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5 class="mt-2 text-dark">Loading...</h5>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".btn_edit", function () {
            var id_order_lead_part = $(this).data('id');
            $("#id_order_lead_part_edit").val( id_order_lead_part );

            $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?=base_url(); ?>order_lead_part/getListOrderLeadPartById",
            data:{
                id_order_lead_part:id_order_lead_part
            },
            success: function(data)
            {
                $("#line_edit").val( data[0].line );
                $("#jenis_lead_part_edit").val( data[0].jenis_lead_part );
                $("#qty_edit").val( data[0].jumlah_basket );
                $("#sesi_edit").val( data[0].sesi );
                var id_plate = data[0].id_plate;
                $("#type_lead_part_section_edit").html(' ');
                // alert(jenis_lead_part);
                $.ajax({
                    type: "POST",
                    url: "<?=base_url(); ?>order_lead_part/getTypeLeadPartEdit",
                    data:{
                        jenis_lead_part:data[0].jenis_lead_part
                    },
                    success: function(data)
                    {
                        $("#type_lead_part_section_edit").html(data);
                $("#type_lead_part_edit").val( id_plate );
                console.log(id_plate);
                        
                        
                    }
                });

            }
        });
        });
    });

    function filterByDate() {
        var date = $('#filterTanggal').val()
        window.location.replace('<?=base_url(); ?>order_lead_part/list_order/'+date);
    }

    $('#jenis_lead_part').on('change', function () {
        var jenis_lead_part = this.value;
        $('#loading-modal').modal('show');
        let arrtype_lead_part = [];
        $.ajax({
            type: "POST",
            url: "<?=base_url(); ?>order_lead_part/getTypeLeadPart/lead_part",
            data:{
                jenis_lead_part:jenis_lead_part
            },
            success: function(data)
            {
                $("#type_lead_part_section").html(data);
                $('#loading-modal').modal('hide');
            }
        });
    });

    $('#jenis_lead_part_edit').on('change', function () {
        var jenis_lead_part = this.value;
        $("#type_lead_part_section_edit").html(' ');

        $.ajax({
            type: "POST",
            url: "<?=base_url(); ?>order_lead_part/getTypeLeadPartEdit",
            data:{
                jenis_lead_part:jenis_lead_part
            },
            success: function(data)
            {
                $("#type_lead_part_section_edit").html(data);
            }
        });
    });
</script>