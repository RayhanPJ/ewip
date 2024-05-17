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
                    <h3 class="block-title">Default Elements</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                    <div class="block-content">
                    <form action="<?php echo base_url('sparepart/doInsertTr') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-12">Static</label>
                            <div class="col-md-9">
                                <div class="form-control-plaintext">Form TR</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="pn">PIC</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nama" placeholder="Nama..">
                                <div class="form-text text-muted">PIC</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="whto">Warehouse To</label>
                            <div class="col-md-9">
                                <select class="form-control" id="whto" name="whto">
                                    <option value="K-AGG">K-AGG</option>
                                    <option value="K-AMB">K-AMB</option>
                                    <option value="K-AMB2">K-AMB2</option>
                                    <option value="K-CAS">K-CAS</option>
                                    <option value="K-CHG">K-CHG</option>
                                    <option value="K-CHG2">K-CHG2</option>
                                    <option value="K-CUR">K-CUR</option>
                                    <option value="K-CUR2">K-CUR2</option>
                                    <option value="K-EMA">K-EMA</option>
                                    <option value="K-ENG">K-ENG</option>
                                    <option value="K-FGX">K-FGX</option>
                                    <option value="K-FOR">K-FOR</option>
                                    <option value="K-FOR2">K-FOR2</option>
                                    <option value="K-KRB">K-KRB</option>
                                    <option value="K-LMR">K-LMR</option>
                                    <option value="K-MTN">K-MTN</option>
                                    <option value="K-MTX">K-MTX</option>
                                    <option value="K-NFU">K-NFU</option>
                                    <option value="K-PAS">K-PAS</option>
                                    <option value="K-PAS2">K-PAS2</option>
                                    <option value="K-RCH">K-RCH</option>
                                    <option value="K-SPT">K-SPT</option>
                                </select>
                                <div class="form-text text-muted">Warehouse To</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="whfr">Warehouse From</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="K-SPT" id="whfr" name="whfrom" readonly placeholder="Text..">
                                <div class="form-text text-muted">Warehouse From</div>
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
            </div>
            <!-- END Default Elements -->
        </div>
    </div>
</div>
<!-- END Page Content -->

</main>
<!-- END Main Container -->