<!-- Page Content -->
<div class="content">
    <h2 class="content-heading">History Data Record</h2>

    <!-- Dynamic Table Full -->
    <div class="block">
        <div class="block-header block-header-default">
            <!-- <a onclick="clicked();" class="btn btn-primary" href="<?php echo base_url('welcome/generateBaan') ?>">Upload to Baan</a> -->
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>No Order</th>
                            <th >Part Number</th>
                            <th >WH From</th>
                            <th >WH To</th>
                            <th >Qty</th>
                            <!-- <th >Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1; foreach ($data as $d) { ?>
                        <tr>
                            <td class="text-center"><?php echo $count; ?></td>
                            <td ><?php echo $d->orno ?></td>
                            <td ><?php echo $d->part_number ?></td>
                            <td ><?php echo $d->whfrom ?></td>
                            <td ><?php echo $d->whto ?></td>
                            <td ><?php echo $d->qty ?></td>
                            <!-- <td ><button class="btn btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('<?php echo $d->id; ?>')">Edit</button> | <button class="btn btn-danger">Hapus</button></td> -->
                        </tr>
                    <?php $count++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
<div>

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "scrollX": true
    } );
} );
</script>