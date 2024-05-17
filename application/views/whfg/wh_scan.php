
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Form Transaksi Warehouse - <?php echo $this->session->userdata('username'); ?></h2>
    <a class="btn btn-alt-primary" href="<?php echo base_url('whfg/wh_scan') ?>"><i class="fa fa-plus mr-5"></i>Refresh</a>
    <!-- <a class="btn btn-alt-success" href="<?php echo base_url('whkom/upload_scan') ?>"><i class="fa fa-plus mr-5"></i>Upload Scan</a> -->
    <a class="btn btn-alt-danger" href="<?php echo base_url('login/logout') ?>"><i class="fa fa-plus mr-5"></i>Keluar</a>
    <br>
    <?php if ($this->session->flashdata('pesan') == NULL) {
        # code...
    } else { ?>
        <?php if ($this->session->flashdata('pesan') == 'Berhasil di Scan' OR $this->session->flashdata('pesan') == 'Barcode Berhasil di Upload') { ?>
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
                    <form action="<?php echo base_url('whfg/wtaBarcode') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-12" for="whto">Scan Barcode</label></label>
                            <div class="col-md-9">
                                <div class="input-group control-group after-add-more2">

                                </div>
                                <div class="input-group control-group">
                                    <input name="barcode[]" class="form-control" id="barcode" onChange="funCheckBcd()" placeholder="Scan Barcode" required>
                                    . <div class="input-group-btn"> 
                                        <button class="btn btn-remove add-more2" id="add" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                        <label id="demo2[]">                                       
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
    <input name="barcode[]" id="barcode2" onChange="funCheckBcd2()" class="form-control" placeholder="Scan Barcode">
        <button class="btn btn-remove remove" id="remove" type="button"><i class="glyphicon glyphicon-remove"></i> X</button>
        <label id="demo2[]">      
        <p></p>
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

<script>
    $(".readonly").keydown(function(e){
        e.preventDefault();
    });
</script>


<script>
    function myFunction() 
    {
        var barc = document.getElementById("barcode").value;
        $.ajax({
            url : "https://portal2.incoe.astra.co.id/e-wip-infor/whfg/cekBarcodeId?barc="+barc,
            method : "GET",
            data : "",
            dataType : 'json',
            success: function(data){
                if (data.results == '') {
                    $.ajax({
                    url : "https://portal2.incoe.astra.co.id/e-wip-infor/whfg/getBarcodeId?barc="+barc,
                    method : "GET",
                    data : "",
                    dataType : 'json',
                    success: function(data2)
                        {                            
                            var qty = [];
                            var item = [];

                            data2.results.map(value => {
                                qty.push(value.QTY);
                                item.push(value.ITEM);
                            });

                            document.getElementById("qty").innerHTML = "Qty : "+qty+" | Item : "+item;
                        },
                        cache: false
                    });
                } else {
                    // alert('pernah');
                    document.getElementById("demo2[]").innerHTML = '<button class="btn btn-danger remove" id="remove" type="button"><i class="glyphicon glyphicon-remove"></i> X</button>';
                }

            },
            cache: false
        });

    }

    function funCheckBcd() 
    {
        var barc = document.getElementById("barcode").value;
        $.ajax({
        url : "https://portal2.incoe.astra.co.id/e-wip-infor/whfg/getBarcodeIdCheck?barc="+barc,
        method : "GET",
        data : "",
        dataType : 'json',
        success: function(data)
            {
                if (data.results != '') {
                    alert('Barcode sudah pernah discan : '+barc);
                }
            },
            cache: false
        });
    }

    function funCheckBcd2() 
    {
        var barc = document.getElementById("barcode").value;
        $.ajax({
        url : "https://portal2.incoe.astra.co.id/e-wip-infor/whfg/getBarcodeIdCheck?barc="+barc,
        method : "GET",
        data : "",
        dataType : 'json',
        success: function(data)
            {
                if (data.results != '') {
                    alert('Barcode sudah pernah discan : '+barc);
                }
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

    document.addEventListener('keydown', (event) => {
        if (event.keyCode == 9) {  
            event.preventDefault();
            setTimeout(delayFunc, 1000);
        }
    });

    function delayFunc() {
        document.getElementById("add").click();
        document.getElementById("barcode2").focus();
    }

</script>