<br><br>
<br><br>

<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Data Transaksi</h2> 
    <br>
    <?php if ($this->session->flashdata('pesan') == NULL) {
        # code...
    } else { ?>
        <div class="alert alert-danger alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="alert-heading font-size-h4 font-w400">Peringatan !</h3>
            <p class="mb-0"><?php echo $this->session->flashdata('pesan'); ?></p>
        </div>
    <?php } ?>
        <div class="col-md-12">
            <!-- Dynamic Table Full -->
            <div class="block">
                <div class="block-header block-header-default">
                    <!-- <a class='btn btn-primary' href="<?php echo base_url('whkom/batch'); ?>">Scan</a> -->
                </div>
                <div class="block-content block-content-full">
                    <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-full"> -->
                    <table width="100%" class="table table-bordered table-striped table-vcenter" id="example3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No WO</th>
                                <th>Assy Line</th>
                                <th>Status WO</th>
                                <th>Print</th>
                                <th>Preparation</th>
                                <th>Transfer Prod</th>
                                <th>Receipt Prod</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; foreach ($data as $d) {
                                $cekTotalCovn = $this->HomeModel->cekLineTrBarcode($d->PDNO);
                                if ($cekTotalCovn == NULL) {
                                    $TOTAL_STATUS = 0;
                                    $STATUS_WO1 = 0;
                                    $STATUS_WO2 = 0;
                                    $NOTE = 0;
                                    $STATUS_RECEIPT = 0;
                                    $STATUS_ORNO = 0;
                                } else {
                                    $TOTAL_STATUS = $cekTotalCovn[0]['TOTAL_STATUS'];
                                    $STATUS_WO1 = $cekTotalCovn[0]['STATUS_WO1'];
                                    $STATUS_WO2 = $cekTotalCovn[0]['STATUS_WO2'];
                                    $NOTE = $cekTotalCovn[0]['NOTE'];
                                    $STATUS_RECEIPT = $cekTotalCovn[0]['STATUS_RECEIPT'];
                                    $STATUS_ORNO = $cekTotalCovn[0]['STATUS_ORNO'];
                                }

                                // var_dump($STATUS_RECEIPT);
                            ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $d->PDNO; ?></td>
                                    <td><?php echo $d->PRCD; ?></td>
                                    <td><?php if ($d->OSTA == 5) {
                                        echo 'Released';
                                    } else if ($d->OSTA == 1) {
                                        echo 'Planned';
                                    } else if ($d->OSTA == 7) {
                                        echo 'Active';
                                    } ?></td>
                                    <td><?php if ($d->COVN == 3) {
                                        echo 'V';
                                    } else if ($d->COVN != 3) {
                                        echo '-';
                                    } ?></td>
                                    <td><?php if ($NOTE > 0 OR empty($cekTotalCovn)) {
                                        echo 'Not Completed';
                                    } else if ($TOTAL_STATUS == $STATUS_WO1 OR $NOTE == 0) {
                                        echo 'Completed';
                                    } else {
                                        echo 'Not Completed';
                                    } ?></td>
                                    <td><?php if ($STATUS_RECEIPT >= 1 OR empty($cekTotalCovn)) {
                                        echo '-';
                                    } else if ($STATUS_RECEIPT == 0) {
                                        echo 'V';
                                    } else {
                                        echo '-';
                                    } ?></td>
                                    <td><?php if ($STATUS_ORNO == 0 AND !empty($cekTotalCovn)) {
                                        echo 'Completed';
                                    } else if ($STATUS_ORNO > 0 OR empty($cekTotalCovn)) {
                                        echo 'Not Completed';
                                    } ?></td>
                                    <td><a target="_blank" href="<?php echo base_url('whkom/detail_reservasi/'.$d->PDNO); ?>">Detail</a></td>
                                </tr>
                            <?php $count++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full -->
        </div>
<!-- END Page Content -->

    


</main>
<!-- END Main Container -->


<script type="text/javascript">
  setTimeout(function(){
    location = ''
  },440000)
</script>