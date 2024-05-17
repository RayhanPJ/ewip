<?php
    if ($tanggal == null) {
        $filterDate = date('Y-m-d');
    } else {
        $filterDate = $tanggal;
    }
    
    $date_now = date('Y-m-d');
    $time_now = date('H:i');

    // $date_now = '2022-10-08';    
    // $time_now = '01:30';

    // if ($time_now >= '22:29') {
    //     $sesi_now = 4;
    // } elseif ($time_now >= '16:59') {
    //     $sesi_now = 3;
    // } elseif ($time_now >= '12:59') {
    //     $sesi_now = 2;
    // } elseif ($time_now >= '07:59') {
    //     $sesi_now = 1;
    // } elseif ($time_now >= '04:59') {
    //     $sesi_now = 6;
    // } elseif ($time_now >= '00:59') {
    //     $sesi_now = 5;
    // }

?>
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">List Order Timah</h2>
    
    <div class="col-md-12">
        <button type="button" class="btn btn-alt-primary" data-toggle="modal" data-target="#modal-normal"><i class="fa fa-plus mr-5"></i>Input Order</button>
        &nbsp;
        <input type="date" name="" id="filterTanggal" value="<?=$filterDate;?>" onchange="filterByDate()">
        &nbsp;
        <span style="color:red;">* note : ingot yang sudah dikirim tidak bisa dikembalikan</span>

        <!-- Add Order Modal -->
        <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="<?php echo base_url('order_timah/saveProsesOrder') ?>" method="post" enctype="multipart/form-data">
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
                                <div class="form-group row">
                                    <?php if ($this->session->userdata('level') == 1) { ?>
                                        <label class="col-12" for="subseksi">Subseksi</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="subseksi" name="subseksi">
                                                <option value="0" selected disabled>-- Pilih ---</option>
                                                <?php foreach($subseksi as $ss) {?>
                                                <option value="<?=$ss['id_subseksi']?>"><?=$ss['nama_subseksi']?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <label class="col-12" for="part_number">Part Number</label>
                                        <div class="col-md-9" id="partnumber_section">
                                                <select class="form-control" id="part_number" name="part_number">
                                                    <option value="0" selected disabled>-- Pilih ---</option>
                                                </select>
                                        </div>
                                    <?php }
                                    ?>

                                    <?php if ($this->session->userdata('level') == 6 and $this->session->userdata('seksi') == null) { ?>
                                        <label class="col-12" for="subseksi">Subseksi</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="subseksi" name="subseksi">
                                                <option value="0" selected disabled>-- Pilih ---</option>
                                                <?php foreach($subseksi as $ss) {?>
                                                <option value="<?=$ss['id_subseksi']?>"><?=$ss['nama_subseksi']?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <label class="col-12" for="part_number">Part Number</label>
                                        <div class="col-md-9" id="partnumber_section">
                                                <select class="form-control" id="part_number" name="part_number">
                                                    <option value="0" selected disabled>-- Pilih ---</option>
                                                </select>
                                        </div>
                                    <?php } elseif ($this->session->userdata('level') == 6 and $this->session->userdata('seksi') != null OR $this->session->userdata('level') == 8 and $this->session->userdata('seksi') != null) { ?>
                                        <label class="col-12" for="part_number">Part Number</label>
                                        <div class="col-md-9" id="partnumber_section">
                                            <select class="form-control" id="part_number" name="part_number">
                                                <option value="0" selected disabled>-- Pilih ---</option>
                                                <?php
                                                $id_subseksi = $this->session->userdata('seksi');
                                                $part_number = $this->OrderTimahModel->getPartNumber($id_subseksi);
                                                foreach ($part_number as $pn) { 
                                                    if ($pn['ingot_number'] != 'SM-LEAL-SB17') { ?>
                                                    <option value="<?=$pn['id_part']?>"><?=$pn['ingot_number']?> (<?=$pn['keterangan']?>)</option>
                                                <?php } } ?>
                                            </select>
                                            <input type="hidden" id="subseksi" name="subseksi" value="<?=$id_subseksi?>">
                                        </div>
                                    <?php }
                                    ?>
                                    
                                    <label class="col-12" for="jumlah_order">Jumlah Order</label>
                                    <div class="col-md-9">
                                        <div class="input-group control-group">
                                            <input type="number" name="jumlah_order" class="form-control" id="jumlah_order" min="1" max="25" placeholder="Jumlah Order (satuan bundel)" required>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                            <input class="btn btn-primary" type="submit" value="Submit" id="tombol-submit" />
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
                                <th>Subseksi</th>
                                <th>Part Number</th>
                                <th>Created Order</th>
                                <th>Jadwal</th>
                                <th>Plan (kg)</th>
                                <th>Actual (kg)</th>
                                <th>Status</th>
                                <th>Closed Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; foreach ($data as $d) { ?>
                                <tr>
                                    <td><?=$count; ?></td>
                                    <td><?=$d['nama_subseksi']?></td>
                                    <td><?=substr($d['ingot_number'], 2)?> (<?=$d['keterangan']?>)</td>
                                    <td style="width:5%"><?=date("H:i", strtotime($d['tanggal_order']))?></td>
                                    <?php
                                        $tanggal_sesi = date('Y-m-d', strtotime($d['tanggal_order']));

                                        if($d['sesi'] == 1) {
                                            $sesi = 'Shift 1<br>(07.45 - 09.00)';
                                        } elseif($d['sesi'] == 2) {
                                            $sesi = 'Shift 1<br>(13.00 - 14.00)';
                                        } elseif($d['sesi'] == '3') {
                                            $sesi = 'Shift 2<br>(17.00 - 19.00)';
                                        } elseif($d['sesi'] == '4') {
                                            $sesi = 'Shift 2<br>(22.30 - 23.30)';
                                        } elseif($d['sesi'] == '5') {
                                            $sesi = 'Shift 3<br>(01.00 - 02.00)';
                                        } elseif($d['sesi'] == '6') {
                                            $sesi = 'Shift 3<br>(05.00 - 06.00)';
                                        }
                                    ?>
                                    <td style="width:11%"><?=$sesi?></td>
                                    <td style="width:5%"><?=$d['jumlah_order_plan'].',000'?></td>
                                    <?php if ($d['qty_supply'] == null) {
                                        $jumlah_order_actual = 0;
                                    } else {
                                        $jumlah_order_actual = number_format($d['qty_supply'],1);
                                    }?>
                                    <td style="width:5%"><?=$jumlah_order_actual?></td>
                                    <td><?=$d['status']?></td>
                                    <?php
                                        if ($d['closed_order'] == null) {
                                            $closed_order = '-';
                                        } else {
                                            $closed_order = date("H:i", strtotime($d['closed_order']));
                                        }
                                    ?>
                                    <td style="width:5%"><?=$closed_order?></td>
                                    <td style="text-align:center;">
                                        <?php if ($d['status'] == 'Open') { 
                                            if ($d['sesi'] == 1) {
                                                $time = "08:30";
                                            } elseif ($d['sesi'] == 2) {
                                                $time = "13:30";
                                            } elseif ($d['sesi'] == 3) {
                                                $time = "18:30";
                                            } elseif ($d['sesi'] == 4) {
                                                $time = "23:00";
                                            } elseif ($d['sesi'] == 5) {
                                                $time = "01:30";
                                            } elseif ($d['sesi'] == 6) {
                                                $time = "05:30";
                                            }

                                            if ($d['status_supply'] == 'Close') { ?>
                                                <a href="#modal_konfirmasi" class=" btn btn-success item_konfirmasi" data-toggle="modal" data-id="<?=$d['id_order']?>" data-qty="<?=$d['jumlah_order_plan']?>">
                                                    Konfirmasi
                                                </a>
                                            <?php 
                                            } elseif ($time_now <= $time && $d['status_supply'] == 'Open') { ?>
                                                <!-- <a class="btn btn-warning" href="<?=base_url('order_timah/edit_order/'.$d['id_order']); ?>">Edit</a> -->
                                                <a class="btn btn-danger" href="<?php echo base_url('order_timah/delete_order/'.$d['id_order']); ?>" onclick="return confirm('Apakah anda yakin?')">Delete</a>
                                            <?php
                                            } elseif ($time_now > $time || $d['status_supply'] == 'Open') { ?>
                                                <span>-</span>
                                            <?php } ?>
                                            
                                        <?php } else {?>
                                            <span>---</span>
                                    </td>
                                </tr>
                            <?php } $count++; } ?>
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
<div class="modal" id="modal_konfirmasi" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo base_url('order_timah/updateKonfirmasi') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
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
                        <div class="form-group row">
                            <label class="col-12" for="jumlah_order">Klik submit jika sudah menerima orderan!</label>
                            <input type="hidden" name="id_order_konfirmasi" id="id_order_konfirmasi">
                            <!-- <div class="col-md-9">
                                <div class="input-group control-group">
                                    <input type="number" class="form-control" name="jumlah_order_actual" id="jumlah_order_actual" min="???" max="???" placeholder="Jumlah Order Actual (satuan bundel)" required>
                                </div>
                            </div> -->
                        </div>                           
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit" value="Submit" id="tombol-submit" />
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END Konfirmasi Modal -->

<script>

    function checkConfirm() {
        getListOrder()
        setTimeout(checkConfirm,60000);
    }

    

    $(document).ready(function() {
        checkConfirm();
        getListOrder()
        $(document).on("click", ".item_konfirmasi", function () {
            var id_order = $(this).data('id');
            var jumlah_order_plan = $(this).data('qty');

            $("#id_order_konfirmasi").val( id_order );

            $("#jumlah_order_actual").attr({
                "max" : jumlah_order_plan,
                "min" : 1
            });
        });
    });

    function filterByDate() {
        var tanggal = $('#filterTanggal').val()
        window.location.replace('<?=base_url(); ?>order_timah/list_order/'+tanggal);
    }

    $('#subseksi').on('change', function () {
        var id_subseksi = this.value;
        console.log(id_subseksi);
        $("#partnumber_section").html(' ');

        $.ajax({
            type: "POST",
            url: "<?=base_url(); ?>order_timah/getPartNumber",
            data:{
                id_subseksi:id_subseksi
            },
            success: function(data)
            {
                
                $("#partnumber_section").html(data);
            }
        });
    });

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


</script>