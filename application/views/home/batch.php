
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Form Transaksi - <?php echo $this->session->userdata('pic'); ?></h2>
    <a class="btn btn-alt-primary" href="<?php echo base_url('wip') ?>"><i class="fa fa-plus mr-5"></i>Refresh</a>
    <a class="btn btn-alt-danger" href="<?php echo base_url('login/logout') ?>"><i class="fa fa-plus mr-5"></i>Keluar</a>
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
                <div class="block-content">
                    <form action="<?php echo base_url('wip/addDataBarcode') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-12" for="whto">Warehouse To</label>
                            <div class="col-md-9">
                                <select required class="form-control" id="whto" onChange="changeWh()" name="whto">
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
                        <div class="form-group row">
                            <label class="col-12">Scan Barcode</label>
                            <div class="col-md-9">
                                <div class="input-group control-group after-add-more2">

                                </div>
                                <div class="input-group control-group">
                                    <input name="barcode[]" class="form-control" id="barcode" onChange="myFunction()" placeholder="Scan Barcode" required>
                                    . <div class="input-group-btn"> 
                                        <button class="btn btn-success add-more2" id="add" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="btn btn-danger" type="submit" value="Submit" />
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- END Default Elements -->
        </div>

        <div class="col-lg-12">
            <div class="alert alert-primary alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5><p id="demo"></p></h5>
                <h5><p id="qty"></p></h5>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->

<div class="copy2" style="display: none;">
    <div class="control-group input-group" style="margin-top:10px">
    <input name="barcode[]" id="barcode2" onChange="myFunction()" class="form-control" placeholder="Scan Barcode">
        <button class="btn btn-danger remove" id="remove" type="button"><i class="glyphicon glyphicon-remove"></i> X</button>
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
    // function clicked() {
    //    if (confirm('Anda Sudah Yakin?')) {
    //        yourformelement.submit();
    //    } else {
    //        return false;
    //    }
    // }

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
    url : "https://portal2.incoe.astra.co.id/e-wip/wip/cekBarcodeIdBack?pn="+x,
    method : "GET",
    data : "",
    dataType : 'json',
    success: function(data){

            if (data.results == '') {
                $.ajax({
                url : "https://portal2.incoe.astra.co.id/e-wip/wip/getBarcodeId?pn="+x,
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

                        document.getElementById("qty").innerHTML = "Qty : "+qty;

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
    url : "https://portal2.incoe.astra.co.id/e-wip/wip/getDataPN?pn="+item,
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


<script type="text/javascript">


    $(document).ready(function() {

    $(".add-more2").click(function(){ 
        var html = $(".copy2").html();
        $(".after-add-more2").after(html);
    });


    $("body").on("click",".remove",function(){ 
        $(this).parents(".control-group").remove();
    });


    });

    function close_window() {
        if (confirm("Close Window?")) {
            close();
        }
    }

    function changeWh() {
        var input = document.getElementById('barcode');
        input.focus();
        input.select();
    }

    // $('#barcode').keydown(function(e) {
    //     var code = e.keyCode || e.which;

    //     if (code === 9) {  
    //         e.preventDefault();
    //         document.getElementById("add").click();
    //         document.getElementById("barcode").focus();
    //     }
    // });

    // var map = {}; // You could also use an array
    // onkeydown = onkeyup = function(e){
    //     e = e || event; // to deal with IE
    //     map[e.keyCode] = e.type == 'keydown';
    //     var code = e.keyCode || e.which;

    //     if (code == 9) {  
    //         e.preventDefault();
    //         document.getElementById("add").click();
    //         // document.getElementById("remove").click();
    //         document.getElementById("barcode").focus();
    //     }
    // }

    document.addEventListener('keydown', (event) => {
        if (event.keyCode == 9) {  
            event.preventDefault();
            document.getElementById("add").click();
            document.getElementById("barcode2").focus();
        }
    });

</script>