
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Form Order Timah</h2>
    <div class="row">
        <div class="col-md-12">
            <!-- Default Elements -->
            <div class="block">
                <div class="block-content">                    
                    <form action="<?php echo base_url('order_timah/saveProsesOrder') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
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
                            <!-- <label class="col-12" for="tanggal_order">Tanggal Order</label>
                            <div class="col-md-9">
                                <div class="input-group control-group">
                                    <input type="date" name="tanggal_order" class="form-control" id="tanggal_order" required>
                                </div>
                            </div>
                            <label class="col-12" for="shift">Shift</label>
                            <div class="col-md-9">
                                <select class="form-control" id="shift" name="shift">
                                    <option value="0" selected disabled>-- Pilih ---</option>
                                    <option value="1">Shift 1 (08.00 - 09.00)</option>
                                    <option value="2">Shift 1 (13.00 - 13.30)</option>
                                    <option value="3">Shift 2 (17.00 - 17.30)</option>
                                    <option value="4">Shift 2 (22.30 - 23.00)</option>
                                    <option value="5">Shift 3 (01.00 - 01.30)</option>
                                    <option value="6">Shift 3 (05.00 - 05.30)</option>
                                </select>
                            </div> -->
                            <label class="col-12" for="jumlah_order">Jumlah Order</label>
                            <div class="col-md-9">
                                <div class="input-group control-group">
                                    <input type="number" name="jumlah_order" class="form-control" id="jumlah_order" placeholder="Jumlah Order (satuan bundel)" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="btn btn-danger" type="submit" value="Submit" id="tombol-submit" />
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- END Page Content -->

</main>
<!-- END Main Container -->

<script>
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
</script>
