
<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
        <h2 class="content-heading">Form Unloading Timah - <?php echo $this->session->userdata('username'); ?></h2>
        <a class="btn btn-alt-danger" href="<?php echo base_url('login/logout') ?>"><i class="fa fa-plus mr-5"></i>Keluar</a>
        <br>

        <div class="col-md-12">
            <!-- Dynamic Table Full -->
            <div class="block">
                <div class="block-content block-content-full">
                    <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No DN</th>
                                <th>Item</th>
                                <th>Sequential</th>
                                <th>Qty Actual</th>
                                <th>Tgl</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; foreach ($data2 as $d) { ?>
                                <?php if ($d->barc != null) : ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $d->no_dn; ?></td>
                                        <td><?php echo $d->item; ?></td>
                                        <td><?php echo $d->tagn; ?></td>
                                        <td><?php echo $d->actq; ?></td>
                                        <td><?php echo $d->created_at; ?></td>
                                        <td><?php echo $d->locations; ?></td>
                                        <td>
                                            <a target="_blank" class="btn btn-success" href="<?php echo base_url('whfg_timah/print_receipt/'.$d->barc); ?>">Print</a>
                                            <a class="btn btn-warning" href="<?php echo base_url('whfg_timah/resetData/' . $d->id); ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            <?php $count++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full -->
        </div>

    </div>
    <!-- END Page Content -->


</main>
<!-- END Main Container -->