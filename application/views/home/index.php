
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Form Transaksi</h2>
    <br>
    <?php if ($this->session->flashdata('pesan') == NULL) {
        # code...
    } else { ?>
        <?php if ($this->session->flashdata('pesan') == 'Berhasil di Scan') { ?>
            <div class="alert alert-primary alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="alert-heading font-size-h4 font-w400">Notifikasi</h3>
                <p class="mb-0"><?php echo $this->session->flashdata('pesan'); ?></p>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="alert-heading font-size-h4 font-w400">Warning</h3>
                <p class="mb-0"><?php echo $this->session->flashdata('pesan'); ?></p>
            </div>
        <?php } ?>
    <?php } ?>
    <div class="row">
        <div class="col-md-12">
            <!-- Default Elements -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">E-WIP</h3>
                    <!-- <button type="button" class="btn btn-alt-danger" data-toggle="modal" data-target="#modal-popout"><i class="fa fa-plus mr-5"></i>Set User</button> -->
                    <a class="btn btn-alt-primary" href="<?php echo base_url('wip') ?>"><i class="fa fa-plus mr-5"></i>Refresh</a>
                    <a class="btn btn-alt-danger" href="<?php echo base_url('login/logout') ?>"><i class="fa fa-plus mr-5"></i>Keluar</a>
                    <br>
                </div>
                <div class="block-content">
                    <form action="<?php echo base_url('wip/doInsertData') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-12">Static</label>
                            <div class="col-md-9">
                                <div class="form-control-plaintext">Form Barcode</div>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label class="col-12">PIC WIP</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pic" value="<?php echo $this->session->userdata('pic'); ?>" readonly placeholder="Nama WH..">
                                <div class="form-text text-muted">User</div>
                            </div>
                        </div> -->
                        <!-- <div class="form-group row">
                            <label class="col-12">User</label>
                            <div class="col-md-9">
                                <input readonly type="text" required class="form-control" name="user" value="<?php echo $this->session->userdata('username'); ?>" placeholder="Nama User..">
                                <div class="form-text text-muted">User</div>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label class="col-12" for="barcode">Barcode ID</label>
                            <div class="col-md-9">
                                <input required type="text" class="form-control" id="barcode" onChange="myFunction()" name="barcode" placeholder="Scan Disini..">
                                <div class="form-text text-muted">Part Number</div>
                            </div>
                        </div>
                        <h5><p id="demo"></p></h5>
                        <br>
                        <div class="form-group row">
                            <label class="col-12" for="whto">Warehouse To</label>
                            <div class="col-md-9">
                                <select required class="form-control" id="whto" name="whto">
                                    <option value=""></option>
                                    <option <?php if ($this->session->userdata('whto') == 'K-AMB') {
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    } ?> value="K-AMB">A</option>
                                    <option <?php if ($this->session->userdata('whto') == 'K-FOR') {
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    } ?> value="K-FOR">C</option>
                                    <option <?php if ($this->session->userdata('whto') == 'K-AVR') {
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    } ?> value="K-AVR">D</option>
                                    <option <?php if ($this->session->userdata('whto') == 'K-FOR2') {
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    } ?> value="K-FOR2">F</option>
                                    <option <?php if ($this->session->userdata('whto') == 'K-AMB2') {
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    } ?> value="K-AMB2">G</option>
                                </select>
                                <div class="form-text text-muted">Warehouse To</div>
                            </div>
                        </div>
                        <h5><p id="stok"></p></h5>
                        <div class="form-group row">
                            <label class="col-12" for="qty">QTY</label>
                            <div class="col-md-9">
                                <input required readonly type="text" class="form-control" id="qty" name="qty" placeholder="Jumlah Barang..">
                                <div class="form-text text-muted">Quantity Barang</div>
                            </div>
                        </div>
                        
                        
                        <!-- <div class="form-group row">
                            <label class="col-12" for="whfr">Warehouse From</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="K-SPT" id="whfr" name="whfrom" readonly placeholder="Text..">
                                <div class="form-text text-muted">Warehouse From</div>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="btn btn-danger" type="submit" onclick="clicked();" value="Submit" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Default Elements -->
        </div>
    </div>
</div>
<!-- END Page Content -->

<div class="modal" id="modal-popout" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Setting User</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    
                        <div class="block block-rounded block-themed">
                            <div class="block-header bg-gd-primary">
                                <h3 class="block-title">Form Setting User</h3>                                  
                            </div>
                            <div class="block-content block-content-full">
                                <div class="col-md-12">
                                    <!-- Simple Wizard -->
                                    <div class="js-wizard-simple block">
                                        <!-- Step Tabs -->
                                        <ul class="nav nav-tabs nav-tabs-block nav-fill" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#wizard-step_quality1" data-toggle="tab">Form</a>
                                            </li>
                                        </ul>
                                        <!-- END Step Tabs -->

                                        <!-- Form -->
                                        <!-- <form class="quantity_lost" method="post"> -->
                                        <form action="<?php echo base_url('wip/input') ?>" method="post">
                                            <!-- Steps Content -->
                                            <div class="block-content block-content-full tab-content" style="min-height: 265px;">
                                                <!-- Step 1 -->
                                                <div class="tab-pane active" id="wizard-simple-step_quality1" role="tabpanel">
                                                    <!-- <div class="form-group">
                                                        <label for="wizard-simple-firstname">PIC WH</label>
                                                        <input class="form-control" require type="text" id="wizard-simple-location" name="pic" placeholder="PIC WH...">
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label for="wizard-simple-firstname">User</label>
                                                        <input class="form-control" require type="text" id="wizard-simple-location" name="user" placeholder="Nama User...">
                                                    </div>
                                                </div>
                                                

                                            </div>
                                            <!-- END Steps Content -->

                                            <button id="tombol-simpan" class="btn btn-sm btn-alt-primary">
                                                <i class="fa fa-save mr-5"></i>Simpan
                                            </button>

                                        </form>
                                        <!-- END Form -->
                                    </div>
                                    <!-- END Simple Wizard -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="submit" id="btnSave" type="submit" class="btn btn-sm btn-alt-primary">
                                <i class="fa fa-save mr-5"></i>Created Ticket
                            </button> -->
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

</main>
<!-- END Main Container -->

<script type="text/javascript">
	$(document).ready(function(){

    var input = document.getElementById('barcode');
    input.focus();
    input.select();

    });

</script>

<script type="text/javascript">
    function clicked() {
       if (confirm('Anda Sudah Yakin?')) {
           yourformelement.submit();
       } else {
           return false;
       }
    }

</script>

<script>
    $(".readonly").keydown(function(e){
        e.preventDefault();
    });
</script>



<script>
function myFunction() {
  var x = document.getElementById("barcode").value;

  $.ajax({
    url : "http://10.19.16.22/e-wip/wip/cekBarcodeId?pn="+x,
    method : "GET",
    data : "",
    dataType : 'json',
    success: function(data){

            if (data.results == '') {
                $.ajax({
                url : "http://10.19.16.22/e-wip/wip/getBarcodeId?pn="+x,
                method : "GET",
                data : "",
                dataType : 'json',
                success: function(data){

                        var qty = [];
                        var item = [];

                        data.results.map(value => {
                            qty.push(value.ACTQ);
                            item.push(value.ITEM);
                        });

                        document.getElementById("qty").value = qty;

                        myFunction2(item);

                    },
                    cache: false
                });
            } else {
                document.getElementById("demo").innerHTML = 'Barcode Sudah Pernah di Scan';
            }

        },
        cache: false
    });

}


function myFunction2(item) {
  $.ajax({
    url : "http://10.19.16.22/e-wip/wip/getDataPN?pn="+item,
    method : "GET",
    data : "",
    dataType : 'json',
    success: function(data){

            console.log(data.results[0]);

            var desc = [];

            data.results.map(value => {
                desc.push(value.T$DSCA);
            });

            document.getElementById("demo").innerHTML = item;

        },
        cache: false
    });
}
</script>
