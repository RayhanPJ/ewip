<script>
    console.log(JSON.parse('<?php echo json_encode($item); ?>'));
</script>

<?php
// var_dump($item['uniqueRack']);
// die;

?>

<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <h1 class="page-title text-center">STORE RAW MATERIAL</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="responsive-table-plugin mt-3">
                                <div class="table-rep-plugin">
                                    <h4 class="page-title">List Total Raw Material</h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="text-center rounded-2">
                                                        <h5 class="d-flex align-items-center justify-content-center" style="font-size: 18px !important;">
                                                            LEGEND :
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="text-center rounded-2">
                                                        <h5 class="d-flex align-items-center justify-content-center bg-success" style="font-size: 18px !important;">
                                                            1 - 99%
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="text-center rounded-2">
                                                        <h5 class="d-flex align-items-center justify-content-center bg-danger" style="font-size: 18px !important;">
                                                            100%
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="text-center rounded-2">
                                                        <h5 class="d-flex align-items-center justify-content-center bg-warning" style="font-size: 18px !important;">
                                                            0%
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table table-striped">
                                            <thead>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php
                                                    $counter = 0; // Inisialisasi hitung iterasi
                                                    foreach ($item['uniqueRack'] as $rack) :
                                                        if ($counter % 6 === 0) {
                                                            // Mulai baris baru setelah setiap 6 iterasi
                                                            echo '</tr><tr>';
                                                        }
                                                    ?>
                                                        <td>
                                                            <div class="card bg-pattern border">
                                                                <a href="<?= base_url() ?>Store_Timah/listItem/<?= $rack; ?>">
                                                                    <div class="card-body">
                                                                        <?php if ($item['barcPercentages'][$rack] >= 1 && $item['barcPercentages'][$rack] <= 99) : ?>
                                                                            <h4 class="text-center bg-success">Line <?= $rack; ?></h4>
                                                                        <?php elseif ($item['barcPercentages'][$rack] == 100) : ?>
                                                                            <h4 class="text-center bg-danger">Line <?= $rack; ?></h4>
                                                                        <?php else : ?>
                                                                            <h4 class="text-center bg-warning">Line <?= $rack; ?></h4>
                                                                        <?php endif; ?>

                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div class="text-center colorItems rounded-2">
                                                                                    <h5 class="d-flex align-items-center justify-content-center" style="font-size: 18px !important;">
                                                                                        <?php echo isset($item['barcPercentages'][$rack]) ? number_format($item['barcPercentages'][$rack]) . '%' : '-'; ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <div class="text-center colorItems rounded-2">
                                                                                    <h5 class="d-flex align-items-center justify-content-center" style="font-size: 18px !important;">
                                                                                        <?php echo isset($item['barcCounts'][$rack]) ? $item['barcCounts'][$rack] . ' bundle' : '-'; ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="text-center colorItems rounded-2">
                                                                                    <h5 class="d-flex align-items-center justify-content-center" style="font-size: 18px !important;">
                                                                                        <?php echo isset($item['totalQtyAktual'][$rack]) ? $item['totalQtyAktual'][$rack] . ' kg' : '-'; ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <?php if ($item['uniqueItems'][$rack][0] != null) : ?>
                                                                                    <div class="text-center d-flex flex-column py-3 colorItems rounded-2">
                                                                                        <h5 class="align-items-center justify-content-center" style="font-size: 18px !important;">
                                                                                            <?php echo isset($item['uniqueItems'][$rack]) ? implode('<br>', $item['uniqueItems'][$rack]) : '-'; ?>
                                                                                        </h5>
                                                                                    </div>
                                                                                <?php else : ?>
                                                                                    <div class="text-center d-flex flex-column py-3 colorItems rounded-2">
                                                                                        <h5 class="align-items-center justify-content-center" style="font-size: 18px !important;">
                                                                                            -
                                                                                        </h5>
                                                                                    </div>
                                                                                <?php endif ?>
                                                                            </div>
                                                                        </div> <!-- end row -->
                                                                    </div>
                                                                </a>
                                                            </div> <!-- end card-->
                                                        </td>
                                                    <?php
                                                        $counter++; // Tambahkan hitung setelah setiap iterasi
                                                    endforeach;
                                                    ?>
                                                </tr>

                                                <tr>
                                                    <div class="card bg-pattern mb-5" style="margin: 0 12px;">
                                                        <a href="/admin">
                                                            <div class="card-body">
                                                                <h2 class="text-center">Total All Line</h2>
                                                                <div class="row d-flex">

                                                                    <div class="col-2">
                                                                        <div class="d-flex flex-column align-items-center justify-content-center bg-primary rounded-2" style="height: 100px;">
                                                                            <label class="text-light fs-3 mt-4" style="font-size: 18px;">Total % Store :</label>
                                                                            <h3 class="text-light fs-3" style="font-size: 24px !important;"><?php echo $barcAllPercentages ?>%</h2>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <div class="d-flex flex-column align-items-center justify-content-center bg-primary rounded-2" style="height: 100px;">
                                                                            <label class="text-light fs-3 mt-4" style="font-size: 18px;">Total Bundle :</label>
                                                                            <h3 class="text-light fs-3" style="font-size: 24px !important;"><?php echo $itemAllCounts ?> bundle</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <div class="d-flex flex-column align-items-center justify-content-center bg-primary rounded-2" style="height: 100px;">
                                                                            <label class="text-light fs-3 mt-4" style="font-size: 18px;">Total Weight:</label>
                                                                            <h3 class="text-light fs-3" style="font-size: 24px !important;"><?php echo $qtyAllCounts ?> kg</h3>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-2">
                                                                        <div class="d-flex flex-column align-items-center justify-content-center bg-danger rounded-2" style="height: 100px;">
                                                                            <label class="text-light fs-3 mt-4" style="font-size: 18px;">Total Full Line :</label>
                                                                            <h3 class="text-light fs-3" style="font-size: 24px !important;"><?php echo $totalFullLine ?></h2>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <div class="d-flex flex-column align-items-center justify-content-center bg-success rounded-2" style="height: 100px;">
                                                                            <label class="text-light fs-3 mt-4" style="font-size: 18px;">Total No Full Line :</label>
                                                                            <h3 class="text-light fs-3" style="font-size: 24px !important;"><?php echo $totalNoFullLine ?></h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <div class="d-flex flex-column align-items-center justify-content-center bg-warning rounded-2" style="height: 100px;">
                                                                            <label class="text-light fs-3 mt-4" style="font-size: 18px;">Total Empty Line :</label>
                                                                            <h3 class="text-light fs-3" style="font-size: 24px !important;"><?php echo $totalEmptyLine ?></h3>
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- end row -->

                                                            </div>
                                                        </a>
                                                    </div> <!-- end card-->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end .table-responsive -->

                                </div> <!-- end .table-rep-plugin-->
                            </div> <!-- end .responsive-table-plugin-->

                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->