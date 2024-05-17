<br><br>
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Data Transaksi</h2> 
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr style="align-items: center; display: flex; justify-content: center;">
                                <th>Line 4</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- <?php 
                            $getLine4 = $this->ProdControl->getWoForklift(4); 
                            foreach ($getLine4 as $d4) { ?>
                            <tr style="align-items: center; display: flex; justify-content: center;">
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $d4->no_wo; ?>"><?php echo $d4->no_wo;?></button></td>
                            </tr>

                            <div class="modal fade" id="exampleModal<?php echo $d4->no_wo; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $d4->no_wo; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel<?php echo $d4->no_wo; ?>">No WO : <?php echo $d4->no_wo; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            No WO : <?php echo $d4->no_wo; ?>
                                            <br>
                                            PN WO : <?php echo $d4->pn; ?>
                                            <br>
                                            Qty WO: <?php echo $d4->qty; ?>
                                            <br>
                                            <?php echo 'Assembly Line : '.$d4->id_line; ?>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a class="btn btn-success" href="<?php echo base_url('whfg/index') ?>">Scan</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </tbody> -->
                    </table>
                </div>
                <div class="col-md-3">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr style="align-items: center; display: flex; justify-content: center;">
                                <th>Line 5</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $getLine5 = $this->ProdControl->getWoForklift(5); 
                            foreach ($getLine5 as $d5) { ?>
                            <tr style="align-items: center; display: flex; justify-content: center;">
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $d5->no_wo; ?>"><?php echo $d5->no_wo;?></button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $d5->no_wo; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $d5->no_wo; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel<?php echo $d5->no_wo; ?>">No WO : <?php echo $d5->no_wo; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            No WO : <?php echo $d5->no_wo; ?>
                                            <br>
                                            PN WO : <?php echo $d5->pn; ?>
                                            <br>
                                            Qty WO: <?php echo $d5->qty; ?>
                                            <br>
                                            <?php echo 'Assembly Line : '.$d5->id_line; ?>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a class="btn btn-success" href="<?php echo base_url('whfg/index') ?>">Scan</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr style="align-items: center; display: flex; justify-content: center;">
                                <th>Line 6</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $getLine6 = $this->ProdControl->getWoForklift(6); 
                            foreach ($getLine6 as $d6) { ?>
                            <tr style="align-items: center; display: flex; justify-content: center;">
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $d6->no_wo; ?>"><?php echo $d6->no_wo;?></button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $d6->no_wo; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $d6->no_wo; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel<?php echo $d6->no_wo; ?>">No WO : <?php echo $d6->no_wo; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            No WO : <?php echo $d6->no_wo; ?>
                                            <br>
                                            PN WO : <?php echo $d6->pn; ?>
                                            <br>
                                            Qty WO: <?php echo $d6->qty; ?>
                                            <br>
                                            <?php echo 'Assembly Line : '.$d6->id_line; ?>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a class="btn btn-success" href="<?php echo base_url('whfg/index') ?>">Scan</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr style="align-items: center; display: flex; justify-content: center;">
                                <th>Line 7</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- <?php 
                            $getLine7 = $this->ProdControl->getWoForklift(7); 
                            foreach ($getLine7 as $d7) { ?>
                            <tr style="align-items: center; display: flex; justify-content: center;">
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $d7->no_wo; ?>"><?php echo $d7->no_wo;?></button></td>
                            </tr>                            
                            <div class="modal fade" id="exampleModal<?php echo $d7->no_wo; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $d7->no_wo; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel<?php echo $d7->no_wo; ?>">No WO : <?php echo $d7->no_wo; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            No WO : <?php echo $d7->no_wo; ?>
                                            <br>
                                            PN WO : <?php echo $d7->pn; ?>
                                            <br>
                                            Qty WO: <?php echo $d7->qty; ?>
                                            <br>
                                            <?php echo 'Assembly Line : '.$d7->id_line; ?>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a class="btn btn-success" href="<?php echo base_url('whfg/index') ?>">Scan</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </tbody> -->
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full -->
        </div>
<!-- END Page Content -->

    


</main>
<!-- END Main Container -->