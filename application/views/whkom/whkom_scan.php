
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Form Transaksi WH Komp - <?php echo $this->session->userdata('username'); ?></h2>
    <a class="btn btn-alt-primary" href="<?php echo base_url('whkom/batch') ?>"><i class="fa fa-plus mr-5"></i>Refresh</a>
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
                    <form action="<?php echo base_url('whkom/addDataBarcodeNew') ?>" method="post" enctype="multipart/form-data">
                        <!-- <div class="form-group row">
                            <label class="col-12" for="whto">Warehouse To</label>
                            <div class="col-md-9">
                                <select required class="form-control" id="whto" name="whto">
                                    <option value=""></option>
                                    <option <?php if ($this->session->userdata('whto') == 'K-AMB') {
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    } ?> value="K-AMB">AMB</option>
                                    <option <?php if ($this->session->userdata('whto') == 'K-AMB2') {
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    } ?> value="K-AMB2">AMB2</option>
                                </select>
                                <div class="form-text text-muted">Warehouse To</div>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label class="col-12" for="whto">Scan Barcode</label></label>
                            <div class="col-md-9">
                                <div class="input-group control-group after-add-more2">

                                </div>
                                <div class="input-group control-group">
                                    <input name="barcode[]" class="form-control" id="barcode" onChange="myFunction()" placeholder="Scan Barcode" required>
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
    <div class="row">
        <div class="col-md-12">
            <!-- Dynamic Table Full -->
            <div class="block">
                <div class="block-header block-header-default">
                
                </div>
                <div class="block-content block-content-full">
                    <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-full"> -->
                    <table width="100%" id="example3">
                        <thead>
                            <tr>
                                <th ></th>
                                <th>PN</th>
                                <th >Barcode</th>
                                <th>ACTQ</th>
                                <th>WH From</th>
                                <th>WH To</th>
                                <th>Tanggal Supply</th>
                                <!-- <th>User</th>
                                <th>Status Barcode</th>
                                <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1; foreach ($data as $d) { ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $d->item; ?></td>
                                    <td><?php echo $d->barc; ?></td>
                                    <td><?php echo $d->actq; ?></td>
                                    <td><?php echo $d->cwarf; ?></td>
                                    <td><?php echo $d->cwart; ?></td>
                                    <!-- <td><?php echo $d->users; ?></td> -->
                                    <!-- <td><?php if ($d->generate_baan == 0) {
                                        echo 'Belum di upload';
                                    } elseif ($d->generate_baan == 2) {
                                        echo 'Gagal di upload';
                                    } elseif ($d->generate_baan == 1) {
                                        echo 'Sudah di upload';
                                    } ?></td> -->
                                    <!-- <td>
                                        <?php if ($d->generate_baan == 0 AND $d->status_whkom == 1) { ?>
                                            <a href="<?php echo base_url('whkom/delete/'.$d->barc) ?>" class="btn btn-danger">Delete</a>
                                            <a href="<?php echo base_url('whkom/edit/'.$d->barc) ?>" class="btn btn-warning">Edit</a>
                                        <?php } else if ($d->generate_baan == 1) {
                                            echo "-";
                                        } ?>
                                    </td> -->
                                    <td><?=date('Y-m-d H:i', strtotime($d->created_at))?></td>
                                </tr>
                            <?php $count++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full -->
        </div>
    </div>
</div>
<!-- END Page Content -->

<div class="copy2" style="display: none;">
    <div class="control-group input-group" style="margin-top:10px">
    <input name="barcode[]" id="barcode2" onChange="myFunction20()" class="form-control" placeholder="Scan Barcode">
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
  var barc = x.split("-");
  $.ajax({
    url : "http://10.19.16.11/e-wip/whkom/cekBarcodeId?pn="+x,
    method : "GET",
    data : "",
    dataType : 'json',
    success: function(data){

            if (data.results == '') {
                $.ajax({
                url : "http://10.19.16.11/e-wip/whkom/getBarcodeId?pono="+barc[0]+"&pos="+barc[1],
                method : "GET",
                data : "",
                dataType : 'json',
                success: function(data){
                    // alert('belum');

                        var qty = [];
                        var item = [];

                        data.results.map(value => {
                            qty.push(value.QTY);
                            item.push(value.ITEM);
                        });

                        document.getElementById("qty").innerHTML = "Qty : "+qty;
                        document.getElementById("demo2[]").innerHTML = '<button class="btn btn-success remove" id="remove" type="button"><i class="glyphicon glyphicon-remove"></i> V</button>';

                        myFunction2(item);

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

function myFunction20() {
  var x = document.getElementById("barcode2").value;
  var barc = x.split("-");
  $.ajax({
    url : "http://10.19.16.11/e-wip/whkom/cekBarcodeId?pn="+x,
    method : "GET",
    data : "",
    dataType : 'json',
    success: function(data){

            if (data.results == '') {
                $.ajax({
                url : "http://10.19.16.11/e-wip/whkom/getBarcodeId?pono="+barc[0]+"&pos="+barc[1],
                method : "GET",
                data : "",
                dataType : 'json',
                success: function(data){
                    // alert('belum');

                        var qty = [];
                        var item = [];

                        data.results.map(value => {
                            qty.push(value.QTY);
                            item.push(value.ITEM);
                        });

                        document.getElementById("qty").innerHTML = "Qty : "+qty;
                        document.getElementById("demo2[]").innerHTML = '<button class="btn btn-success remove" id="remove" type="button"><i class="glyphicon glyphicon-remove"></i> V</button>';

                        myFunction2(item);

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


function myFunction2(item) {
  $.ajax({
    url : "http://10.19.16.11/e-wip/wip/getDataPN?pn="+item,
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
            setTimeout(delayFunc, 1000);
        }
    });

    function delayFunc() {
        document.getElementById("add").click();
        document.getElementById("barcode2").focus();
    }

</script>