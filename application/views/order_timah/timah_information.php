
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Timah Information</h2>
    
    <br>
    
    <div class="row">
        <div class="col-md-12">
            <!-- Default Elements -->
            <div class="block">
                <div class="block-content">
                    <!-- <form action="<?php echo base_url('order_timah/checkDetailBarcode') ?>" method="post" enctype="multipart/form-data"> -->
                        <div class="form-group row">
                            <label class="col-12">Scan Barcode</label></label>
                            <div class="col-md-9">
                                <div class="input-group control-group">
                                    <input name="barcode" id="barcode" class="form-control" id="barcode" onChange="scanQr()" placeholder="Scan Barcode" autofocus required>
                                    &nbsp;&nbsp;&nbsp;
                                    <!-- <input class="btn btn-danger" type="submit" value="Submit" /> -->
                                    <button class="btn btn-danger" onClick="inputQr()">Submit</button>
                                </div>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
            <!-- END Default Elements -->
        </div>

        <div class="col-lg-12">
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Dynamic Table Full -->
            <div class="block">
                <div class="block-content block-content-full">
                    <table width="100%" id="item" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Item</th>
                                <th>Supplier</th>
                                <th>No DN</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody id="body-item">
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan='5' style="horizontal-align : middle;text-align:center;">TOTAL</th>
                                <th style="text-align:right;"><span id="total">0</span></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full -->
            <div style="display:flex;justify-content: flex-end;">
                <button class="btn btn-primary" onClick="clearTable()">Clear</button>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- QR Exist Modal -->
<div class="modal" id="modal-qr-exist" tabindex="-1" role="dialog" aria-labelledby="modal-small" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Notification</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close" onClick="clickAutofocus()">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <h5>QR Code sudah di scan</h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal" onClick="clickAutofocus()">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Small Modal -->

<!-- Item Exist Modal -->
<div class="modal" id="modal-item-exist" tabindex="-1" role="dialog" aria-labelledby="modal-small" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Notification</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close" onClick="clickAutofocus()">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <h5>Item berbeda, perbaharui item scan?</h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal" onClick="clickAutofocus()">Close</button>
                <button type="button" class="btn btn-alt-success" data-dismiss="modal" onClick="clearTable()">
                    <i class="fa fa-check"></i> OK
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END Small Modal -->

<script>
    var arrBarc = [];
    var total = 0;
    var no = 1;
    var arrItem = [];

    function clickAutofocus(){
        setTimeout(function(){ 
            $("#barcode").focus();
        },0)        
    }

    function clearTable() {
        $("#body-item").empty();
        $("#barcode").val('');
        arrBarc = [];
        arrItem = [];
        total = 0;
        no = 1;
        
        $("#total").text(total);
        clickAutofocus();
        // location.reload();
    }

    function scanQr() {
        var barcode = $("#barcode").val();
        
        document.addEventListener('keyup', function(event) {
            if (event.keyCode == 9) {
                inputQr();
            }
        });
    }

    function inputQr() {
        var barcode = $("#barcode").val();
        
        $("#barcode").val('');
        $.ajax({
            type: "POST",
            url: "<?=base_url(); ?>order_timah/checkDetailBarcode",
            async: true,
            dataType: 'json',
            data:{
                barcode : barcode
            },
            success: function(data)
            {
                if (data === undefined || data.length == 0) {
                    $("#barcode").val('');
                    $("#barcode").focus();
                } else { 
                    if (arrItem.length === 0 || arrItem.includes(data[0].item)) {
                        arrItem.push(data[0].item)
                        if(arrBarc.includes(barcode)) {
                            console.log(arrBarc);
                            $('#modal-qr-exist').modal('show');
                            $("#barcode").focus();
                        } else {
                            arrBarc.push(barcode)
                            console.log(arrBarc);
                            $("#item tbody").append(`
                                <tr>
                                    <td>${no++}</td>
                                    <td>${data[0].barc}</td>
                                    <td>${data[0].item}</td>
                                    <td>${data[0].cwarf}</td>
                                    <td>${data[0].no_dn}</td>
                                    <td style="text-align:right;">${data[0].actq}</td>
                                </tr>
                            `);

                            total += data[0].actq;
                            $("#total").text(total);
                            $("#barcode").focus();
                        }
                    } else {
                        $('#modal-item-exist').modal('show');
                        $("#barcode").focus();
                    }
                }
            }
        });
    }
</script>