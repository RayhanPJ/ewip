
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
                    <form action="<?php echo base_url('order_timah/prosesEditOrder') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <input type="hidden" name="id_order" value="<?=$id_order?>">
                            <?php if ($this->session->userdata('level') == 1) { ?>
                                <label class="col-12" for="subseksi">Subseksi</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="subseksi" name="subseksi">
                                        <option value="0" selected disabled>-- Pilih ---</option>
                                        <?php foreach($subseksi as $ss) {
                                                $selected = ($data[0]["id_subseksi"] == $ss['id_subseksi']) ? "selected" : "";?>
                                        <option value="<?=$ss['id_subseksi']?>" <?=$selected?>><?=$ss['nama_subseksi']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <label class="col-12" for="part_number">Part Number</label>
                                <div class="col-md-9" id="partnumber_section">
                                    <select class="form-control" id="part_number" name="part_number">
                                        <option value="0" selected disabled>-- Pilih ---</option>
                                        <?php $part_number = $this->OrderTimahModel->getPartNumber($data[0]["id_subseksi"]);
                                        foreach($part_number as $pn) {
                                            $selected = ($data[0]["id_part"] == $pn['id_part']) ? "selected" : "";?>
                                            <option value="<?=$pn['id_part']?>" <?=$selected?>><?=$pn['ingot_number']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php }
                            ?>

                            <?php if ($this->session->userdata('level') == 6 and $this->session->userdata('seksi') == null) { ?>
                                <label class="col-12" for="subseksi">Subseksi</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="subseksi" name="subseksi">
                                        <option value="0" selected disabled>-- Pilih ---</option>
                                        <?php foreach($subseksi as $ss) {
                                            $selected = ($data[0]["id_subseksi"] == $ss['id_subseksi']) ? "selected" : "";?>
                                        <option value="<?=$ss['id_subseksi']?>" <?=$selected?>><?=$ss['nama_subseksi']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <label class="col-12" for="part_number">Part Number</label>
                                <div class="col-md-9" id="partnumber_section">
                                    <select class="form-control" id="part_number" name="part_number">
                                        <option value="0" selected disabled>-- Pilih ---</option>
                                        <?php $part_number = $this->OrderTimahModel->getPartNumber($data[0]["id_subseksi"]);
                                        foreach($part_number as $pn) {
                                            $selected = ($data[0]["id_part"] == $pn['id_part']) ? "selected" : "";?>
                                            <option value="<?=$pn['id_part']?>" <?=$selected?>><?=$pn['ingot_number']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } elseif ($this->session->userdata('level') == 6 and $this->session->userdata('seksi') != null) { ?>
                                <input type="hidden" id="subseksi" name="subseksi" value="<?=$data[0]["id_subseksi"]?>">
                                
                                <label class="col-12" for="part_number">Part Number</label>
                                <div class="col-md-9" id="partnumber_section">
                                    <select class="form-control" id="part_number" name="part_number">
                                        <option value="0" selected disabled>-- Pilih ---</option>
                                        <?php $part_number = $this->OrderTimahModel->getPartNumber($data[0]["id_subseksi"]);
                                        foreach($part_number as $pn) {
                                            $selected = ($data[0]["id_part"] == $pn['id_part']) ? "selected" : "";?>
                                            <option value="<?=$pn['id_part']?>" <?=$selected?>><?=$pn['ingot_number']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php }
                            ?>
                            <label class="col-12" for="whto">Jumlah Order</label>
                            <div class="col-md-9">
                                <div class="input-group control-group">
                                    <input type="number" min="1" max="2" name="jumlah_order" class="form-control" id="jumlah_order" value="<?=$data[0]["jumlah_order_plan"]?>" placeholder="Jumlah Order (satuan bundel)" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="btn btn-primary" type="submit" value="Update" id="tombol-submit" onclick="return confirm('Apakah anda yakin?')"/>
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