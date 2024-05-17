
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Form Unloading Timah - <?php echo $this->session->userdata('username'); ?></h2>
    <!-- <a class="btn btn-alt-danger" href="<?php echo base_url('login/logout') ?>"><i class="fa fa-plus mr-5"></i>Keluar</a> -->
    <a class="btn btn-alt-danger" href="<?php echo base_url('whfg_timah/getDataDn/'.$this->session->userdata('no_dn')) ?>"><i class="fa fa-plus mr-5"></i>Refresh</a>
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
                    <!-- <form action="<?php echo base_url('whfg_timah/addDataTimah'); ?>" method="post"> -->
                    <form>
                        <div class="form-group row">
                            <label class="col-12" for="whto">Receipt Transaction</label></label>
                            <div class="col-md-9">
                                <div class="input-group control-group after-add-more2">
                                    <div class="input-group control-group">
                                        <input type="text" class="form-control" placeholder="No DN" value="<?php echo $this->session->userdata('no_dn'); ?>">
                                        <select class="form-control" name="line_dn" id="line_dn">
                                            <?php foreach ($data as $d) { ?>
                                                <option value="<?php echo $d->PO.'|'.$d->PONO.'|'.$d->NODN.'|'.trim($d->ITEM) ?>"><?php echo $d->ITEM; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="input-group control-group">
                                        <?php foreach ($data as $d) { ?>
                                            <input type="text" class="form-control" placeholder="No DN" value="<?php echo $d->QTY; ?>">
                                        <?php } ?>
                                            <input type="text" class="form-control" placeholder="Aktual" id="actualQty">
                                    </div>
                                </div>
                                <div class="input-group control-group">
                                    <input type="hidden" name="qty_lead" id="qty_lead" class="form-control">
                                    <input disabled class="form-control" id="qty_lead_view" placeholder="Data Received" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <!-- <input class="btn btn-danger" type="submit" value="Submit" />  -->
                                <button type="submit" class="btn btn-primary btn-lg" id="butsave">Submit</button>
                                <input type="button" class="btn btn-warning btn-lg" value="Print" onclick="printDiv()"> 
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div style="text-align: center;"  class="col-md-12" id="GFG">
        <div style="text-align: center;"  class="content">
            <!-- Bootstrap Design -->
            <h2 class="content-heading">RAW MATERIAL TIMAH</h2>
            <p>*****************************************************</p>
            <!-- <br> -->
            <p><span id="item"></span></p>
            <!-- <br> -->
            <h2 class="content-heading">QTY : <span id="hasil_input"> KG</span></h2>
            <p>*****************************************************</p>
            <table style="text-align: center; margin-left: auto; margin-right: auto;" class="tg">
                <thead>
                    <tr>
                        <th class="tg-0lax">Supplier <br> <span id="cwarf"></span></th>
                        <th class="tg-0lax">No DN <br> <span id="no_dn"></span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tg-0lax">Data Received <br> <span id="data_received"></span></td>
                        <td class="tg-0lax">No Lot <br> <span id="tagn"></span></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <p>*****************************************************</p>
            <br>
                <span><img id="myBarc" width="150" height="150"></span>
            <br>
            <br>
        </div>
    </div>

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
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_qty = 0; $count = 1; foreach ($data2 as $d) { ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $d->no_dn; ?></td>
                                <td><?php echo $d->item; ?></td>
                                <td><?php echo $d->tagn; ?></td>
                                <td><?php echo $d->actq; ?></td>
                            </tr>
                        <?php $total_qty += $d->actq; $count++; } ?>
                            <tr>
                                <td colspan="4">Total</td>
                                <td><?php echo $total_qty; ?></td>
                            </tr>
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

<script type="text/javascript">
    function getFeed() {
        $.ajax({
            url: '<?php echo base_url('whfg_timah/getLastWeight') ?>',
            method : "GET",
            data : "",
            dataType : 'json',
            success: function(data) {
                var lead_weight = [];

                data.results.map(value => {
                    lead_weight.push(value.lead_weight);
                });
                document.getElementById("qty_lead").value = lead_weight;
                document.getElementById("qty_lead_view").value = lead_weight;
            }
        });
    }

    function getFeedTotal() {
        $.ajax({
            url: '<?php echo base_url('whfg_timah/getLastDataReceived/'.$this->session->userdata('no_dn')) ?>',
            method : "GET",
            data : "",
            dataType : 'json',
            success: function(data) {
                let actualQty = [];

                data.results.map(value => {
                    actualQty.push(value.actualQty);
                });

                var usFormat = actualQty.toLocaleString('en-US');

                document.getElementById("actualQty").value  = usFormat;
            }
            
        });
    }

    $(document).ready(function() {
        setInterval(getFeed, 2500);
        setInterval(getFeedTotal, 2500);
        $.ajax({
            url: '<?php echo base_url('whfg_timah/getLastWeight') ?>',
            method : "GET",
            data : "",
            dataType : 'json',
            success: function(data) {
                var lead_weight = [];

                data.results.map(value => {
                    lead_weight.push(value.lead_weight);
                });
                document.getElementById("qty_lead").value = lead_weight;
                document.getElementById("qty_lead_view").value = lead_weight;
            }
        });

        $.ajax({
            url: '<?php echo base_url('whfg_timah/getLastDataReceived/'.$this->session->userdata('no_dn')) ?>',
            method : "GET",
            data : "",
            dataType : 'json',
            success: function(data) {
                let actualQty = [];

                data.results.map(value => {
                    actualQty.push(value.actualQty);
                });

                var usFormat = actualQty.toLocaleString('en-US');

                document.getElementById("actualQty").value  = usFormat;
            }
            
        });
    });
</script>

<script>
$(document).ready(function() {
	$('#butsave').on('click', function() {
		var line_dn = $('#line_dn').val();
		var qty_lead = $('#qty_lead').val();
		if(line_dn!="" && qty_lead!=""){
			$("#butsave").attr("disabled", "disabled");
			$.ajax({
				url: "<?php echo base_url("whfg_timah/addDataTimah");?>",
				type: "POST",
				data: {
					type: 1,
					line_dn: line_dn,
					qty_lead: qty_lead,
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$("#butsave").removeAttr("disabled");
						$('#fupForm').find('input:text').val('');
						$("#success").show();
						$('#success').html('Data added successfully !'); 
                        
                        $.ajax({
                            url: '<?php echo base_url('whfg_timah/getLastDataReceived/'.$this->session->userdata('no_dn')) ?>',
                            method : "GET",
                            data : "",
                            dataType : 'json',
                            success: function(data) {
                                var item = [];
                                var hasil_input = [];
                                var cwarf = [];
                                var no_dn = [];
                                var data_received = [];
                                var tagn = [];
                                var barc = [];
                                var actualQty = [];

                                data.results.map(value => {
                                    item.push(value.item);
                                    hasil_input.push(value.actq);
                                    cwarf.push(value.cwarf);
                                    no_dn.push(value.no_dn);
                                    data_received.push(value.created_at);
                                    tagn.push(value.tagn);
                                    barc.push(value.barc);
                                    actualQty.push(value.actualQty);
                                });

                                var usFormat = actualQty.toLocaleString('en-US');

                                document.getElementById("item").innerText  = item;
                                document.getElementById("hasil_input").innerText  = hasil_input;
                                document.getElementById("cwarf").innerText  = cwarf;
                                document.getElementById("no_dn").innerText  = no_dn;
                                document.getElementById("data_received").innerText  = data_received;
                                document.getElementById("tagn").innerText  = tagn;
                                document.getElementById("actualQty").value  = usFormat;
                                document.getElementById("myBarc").src = 'https://portal2.incoe.astra.co.id/e-wip/assets/img_qr/'+barc+'.png';
                            }
                            
                        });
                        
					}
					else if(dataResult.statusCode==201){
					   alert("Tunggu 1 menit supaya tidak duplikat");
					}
					
				}
			});
		}
		else{
			alert('Isi inputan yang kosong !');
		}
	});
});
</script>


<script>
    function printDiv() {
        var divContents = document.getElementById("GFG").innerHTML;
        var a = window.open('', '', 'height=500, width=500');
        a.document.write(divContents);
        a.document.close();
        a.print();
    }
</script>
