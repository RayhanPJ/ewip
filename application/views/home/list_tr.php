<?php if ($this->session->userdata('modul') == 'generate') { ?>
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Record</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <a onclick="clicked();" class="btn btn-primary" href="<?php echo base_url('sparepart/generateBaan') ?>">Upload to Baan</a>
            </div>
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table id="example">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>No Order</th>
                                <th>Part Number</th>
                                <th>Desc</th>
                                <th>WH From</th>
                                <th>WH To</th>
                                <th>Qty</th>
                                <th>USER</th>
                                <th>Status Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; foreach ($data as $d) { ?>
                            <tr>
                                <td class="text-center"><?php echo $count; ?></td>
                                <td ><?php echo $d->orno ?></td>
                                <td ><?php echo $d->part_number ?></td>
                                <td ><?php $desc = $this->homemodel->getDataPN($d->part_number); foreach ($desc as $d2) {
                                    echo $d2->DESCS;
                                }  ?></td>
                                <td ><?php echo $d->whfrom ?></td>
                                <td ><?php echo $d->whto ?></td>
                                <td ><?php echo $d->qty ?></td>
                                <td ><?php echo $d->user ?></td>
                                <td ><?php if ($d->status_tr == 1) {
                                    echo 'TR';
                                } else {
                                    echo 'Pinjam';
                                } ?></td>
                                <!-- <td ><button class="btn btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('<?php echo $d->id; ?>')">Edit</button> | <a href="<?php echo base_url('sparepart/delete_tr/'.$d->id); ?>" class="btn btn-danger">Hapus</a></td> -->
                                <td ><a href="<?php echo base_url('sparepart/delete_tr/'.$d->id); ?>" class="btn btn-danger">Hapus</a></td>
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
            "scrollX": true,
            "columnDefs": [
      { "width": "10%", "targets": 0 },
      { "width": "10%", "targets": 1 },
      { "width": "15%", "targets": 2 },
      { "width": "15%", "targets": 3 },
      { "width": "15%", "targets": 4 },
      { "width": "10%", "targets": 5 },
      { "width": "10%", "targets": 6 },
      { "width": "10%", "targets": 7 },
      { "width": "10%", "targets": 8 },
    ],
        } );
    } );
    function edit(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('sparepart/getDetailData/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                
                document.getElementById("order_number").value = data.orno;
                document.getElementById("part_number").value = data.part_number;
                document.getElementById("qty").value = data.qty;
                document.getElementById("id").value = data.id;
                if (data.status_tr == 1) {
                    var status_tr = 'TR';
                } else {
                    var status_tr = 'Pinjam';
                }
                document.getElementById("status_tr").value = status_tr;
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url;

        // ajax adding data to database
        $.ajax({
            url : "<?php echo site_url('sparepart/save_update')?>",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    window.location.href = "<?php echo base_url('sparepart/list_tr'); ?>";
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 

            }
        });
    }
    </script>

    <script type="text/javascript">
        function clicked() {
        if (confirm('Anda Sudah Yakin?')) {
            yourformelement.submit();
        } else {
            return false;
        }
        }

    </script>

    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <!-- <h3 class="modal-title">Edit Form</h3> -->
                </div>
                <div class="modal-body form">
                    <form action="<?php echo base_url('sparepart/save_update'); ?>" id="form" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Order Number</label>
                                <div class="col-md-9">
                                    <input name="id" id="id" class="form-control" type="hidden" readonly>
                                    <input name="order_number" id="order_number" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Part Number</label>
                                <div class="col-md-9">
                                    <input name="part_number" id="part_number" disabled class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">QTY</label>
                                <div class="col-md-9">
                                    <input name="qty" id="qty" class="form-control" type="text">
                                    <input name="param" value="generate" class="form-control" type="hidden">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Status TR</label>
                                <div class="col-md-9">
                                    <input name="status_tr" readonly id="status_tr" class="form-control" type="text">
                                    <select class="form-control" name="status_tr_update">
                                        <option value="">-----</option>
                                        <option value="1">TR</option>
                                        <option value="2">Pinjam</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php } elseif ($this->session->userdata('modul') == 'pinjam') { ?>
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Record</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <!-- <a onclick="clicked();" class="btn btn-primary" href="<?php echo base_url('sparepart/generateBaan') ?>">Upload to Baan</a> -->
            </div>
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table id="example">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>No Order</th>
                                <th >Part Number</th>
                                <th >WH From</th>
                                <th >WH To</th>
                                <th >Qty</th>
                                <th >PIC</th>
                                <th >Status Transaksi</th>
                                <th >Action</th>
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
                                <td ><?php echo $d->npk ?></td>
                                <td ><?php if ($d->status_tr == 1) {
                                    echo 'TR';
                                } else {
                                    echo 'Pinjam';
                                } ?></td>
                                <td ><button class="btn btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('<?php echo $d->id; ?>')">Approve</button></td>
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
    function edit(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('sparepart/getDetailData/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                
                document.getElementById("order_number").value = data.orno;
                document.getElementById("part_number").value = data.part_number;
                document.getElementById("qty").value = data.qty;
                document.getElementById("status_tr").value = data.status_tr;
                document.getElementById("npk").value = data.npk;
                document.getElementById("id").value = data.id;
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url;

        // ajax adding data to database
        $.ajax({
            url : "<?php echo site_url('sparepart/save_update2')?>",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    window.location.href = "<?php echo base_url('sparepart/list_transaski'); ?>";
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 

            }
        });
    }
    </script>

    <script type="text/javascript">
        function clicked() {
        if (confirm('Anda Sudah Yakin?')) {
            yourformelement.submit();
        } else {
            return false;
        }
        }

    </script>

    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <!-- <h3 class="modal-title">Edit Form</h3> -->
                </div>
                <div class="modal-body form">
                    <form action="<?php echo base_url('sparepart/save_update2'); ?>" id="form" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Order Number</label>
                                <div class="col-md-9">
                                    <input name="id" id="id" class="form-control" type="hidden" readonly>
                                    <input name="order_number" id="order_number" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Part Number</label>
                                <div class="col-md-9">
                                    <input name="part_number" id="part_number" disabled class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">NPK</label>
                                <div class="col-md-9">
                                    <input name="npk" id="npk" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Status Transaksi</label>
                                <div class="col-md-9">
                                    <select name="status_tr" class="form-control">
                                        <option id="status_tr"></option>
                                        <option value="1">TR</option>
                                        <option value="2">Pinjam</option>
                                    </select>
                                    <input name="qty" id="qty" class="form-control" type="hidden">
                                    <input name="param" value="pinjam" class="form-control" type="hidden">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php } ?>