<br><br>
<br><br>

<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Form Transaksi</h2>
    <div class="row">
        <div class="col-md-12">
            <!-- Default Elements -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Scan Barcode</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="<?php echo base_url('wip/cekBarcode') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-12">Static</label>
                            <div class="col-md-9">
                                <div class="form-control-plaintext">Form TR</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="pn">Barcode</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="pn" name="barcode" placeholder="Scan Disini..">
                                <div class="form-text text-muted">Barcode</div>
                            </div>
                        </div>
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

</main>
<!-- END Main Container -->

<script type="text/javascript">
	$(document).ready(function(){

    var input = document.getElementById('pn');
    input.focus();
    input.select();

    });

</script>
