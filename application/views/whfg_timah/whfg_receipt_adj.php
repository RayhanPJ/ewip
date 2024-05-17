<?php
$uniqueLine = [];
$uniqueLoc = [];

foreach ($data3 as $v) {
    $line = $v->line;

    if (!in_array($line, $uniqueLine)) {
        $uniqueLine[] = $line;
    } else {
        continue;
    }
}
foreach ($data3 as $v) {
    $loc = $v->locations;
    if (!in_array($loc, $uniqueLoc)) {
        $uniqueLoc[] = $loc;
    } else {
        continue;
    }
}

// var_dump();die;
?>

<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
        <h2 class="content-heading">Form Unloading Timah - <?php echo $this->session->userdata('username'); ?></h2>
        <a class="btn btn-alt-danger" href="<?php echo base_url('login/logout') ?>"><i class="fa fa-plus mr-5"></i>Keluar</a>
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
                        <form action="<?php echo base_url('whfg_timah/addDataTimahAdj'); ?>" method="post">
                            <div class="form-group row">
                                <label class="col-12" for="whto">Receipt Transaction</label></label>
                                <div class="col-md-9">
                                    <div class="input-group control-group after-add-more2">
                                        <div class="input-group control-group">
                                            <select class="form-control" name="noDn">
                                                <option value="<?php echo $this->session->userdata('no_dn'); ?>"><?php echo $this->session->userdata('no_dn'); ?></option>
                                            </select>
                                        </div>
                                        <div class="input-group control-group">
                                            <select class="form-control" name="line_dn">
                                                <?php foreach ($data as $d) { $po = $d->PO; $pono = $d->PONO; $nodn = $d->NODN; $item = $d->ITEM; $qty = $d->QTY; ?>

                                                <?php } ?>
                                                <option value="<?php echo $this->session->userdata('po').'|'.$this->session->userdata('pono').'|'.$this->session->userdata('nodn').'|'.$this->session->userdata('pn') ?>"><?php echo $this->session->userdata('pn'); ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-LEAL-PBCASNX-0007-10-2600' ?>"><?php echo 'M-LEAL-PBCASNX-0007-10-2600'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-LEAL-PBCASNX-0007-03-2600' ?>"><?php echo 'M-LEAL-PBCASNX-0007-03-2600'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-LEAL-PBSBXXX-0170-00-2600' ?>"><?php echo 'M-LEAL-PBSBXXX-0170-00-2600'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-LEAL-PBCASNX-0008-14-2600' ?>"><?php echo 'M-LEAL-PBCASNX-0008-14-2600'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-MOAL-CAXXXXX-0100-00-2600' ?>"><?php echo 'M-MOAL-CAXXXXX-0100-00-2600'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-PULE-9997XXX-0000-00-2600' ?>"><?php echo 'M-PULE-9997XXX-0000-00-2600'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-LEAL-PBSBXXX-0280-00-2600' ?>"><?php echo 'M-LEAL-PBSBXXX-0280-00-2600'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-LEAL-PBSBXXX-0275-00-2600' ?>"><?php echo 'M-LEAL-PBSBXXX-0275-00-2600'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-LEAL-PBSBXXX-0460-00-2600' ?>"><?php echo 'M-LEAL-PBSBXXX-0460-00-2600'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-MOAL-CAXXXXX-0100-00-0700' ?>"><?php echo 'M-MOAL-CAXXXXX-0100-00-0700'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-PULE-9999XXX-0000-00-2600' ?>"><?php echo 'M-PULE-9999XXX-0000-00-2600'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-LEAL-PBSNXXX-0210-00-2600' ?>"><?php echo 'M-LEAL-PBSNXXX-0210-00-2600'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-LEAL-PBSNXXX-0210-00-0700' ?>"><?php echo 'M-LEAL-PBSNXXX-0210-00-0700'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-LEAL-PBCAXXX-0100-00-0700' ?>"><?php echo 'M-LEAL-PBCAXXX-0100-00-0700'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|M-MOAL-CAXXXXX-0060-00-0700' ?>"><?php echo 'M-MOAL-CAXXXXX-0060-00-0700'; ?></option>
                                                <option value="<?php echo $po.'|'.$pono.'|'.$nodn.'|'.trim($item) ?>"><?php echo $item.' | '.$qty ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="input-group control-group">
                                        <?php $qtyLead = $this->ProdControl->lastQtyLead();

                                        foreach ($qtyLead as $ql) {
                                            $qty = $ql->lead_weight;
                                        }
                                        ?>
                                        <input type="hidden" name="qty_lead" id="qty_lead" class="form-control">
                                        <input disabled class="form-control" id="qty_lead_view" placeholder="Data Received" required>
                                        <!-- <input disabled class="form-control" value="<?php echo $qty; ?>" placeholder="Data Received" required> -->
                                    </div>
                                    <label class="col-12" for="whto">Qty Adjustment</label></label>
                                    <div class="input-group control-group">
                                        <input class="form-control" name="qty_adj" placeholder="Data Received">
                                        <!-- <input disabled class="form-control" value="<?php echo $qty; ?>" placeholder="Data Received" required> -->
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <label for="rack" class="form-label">Line</label>
                                            <select class="form-control" id="rack" placeholder="rack" name="rack" require>
                                                <?php foreach ($uniqueLine as $v) : ?>
                                                    <option value="<?= $v; ?>" <?=($v == $last_line) ? 'selected':''?>><?= $v; ?></option>
                                                <?php endforeach ?>
                                            </select>

                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="location" class="form-label">Location</label>
                                            <select class="form-control" id="locations" placeholder="Locations" name="locations" require>
                                            </select>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="sub_location" class="form-label">Sub Location</label>
                                            <select class="form-control" id="sub_locations" placeholder="Sub Locations" name="sub_locations" require>
                                            </select>

                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div hidden class="mb-3">
                                        <label for="id" class="form-label">Id</label>
                                        <select class="form-control" id="id" placeholder="ID" name="id" require>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="btn btn-danger" type="submit" value="Submit" id="btn-submit" />
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
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
                                <th>Location</th>
                                <th>Sub Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_qty = 0; $count = 1; foreach ($data3 as $d) { ?>
                                <?php if ($d->barc != null) : ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $d->no_dn; ?></td>
                                        <td><?php echo $d->item; ?></td>
                                        <td><?php echo $d->tagn; ?></td>
                                        <td><?php echo $d->actq; ?></td>
                                        <td><?php echo $d->locations; ?></td>
                                        <td><?php echo $d->sub_locations; ?></td>
                                    </tr>
                                <?php endif ?>
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

<script>
    const rackSelect = document.getElementById("rack");
    const locSelect = document.getElementById("locations");
    const subLocSelect = document.getElementById("sub_locations");
    const idSelect = document.getElementById("id");
    const uniqueLocs = <?php echo json_encode($uniqueLoc); ?>;
    const items = <?php echo json_encode($data3); ?>;
    // console.log(items);

    function filterLocationsByRack() {
        const selectedRack = rackSelect.value;
        const filteredLocs = uniqueLocs.filter(loc => loc.startsWith(selectedRack));
        const filteredLocsWithEmptySubLocs = filteredLocs.filter(loc => {
            const subLocs = items.filter(item => item.locations === loc && (item.barc === "" || item.barc === null));
            return subLocs;
        });

        // New implementation starts here
        const ids = filteredLocsWithEmptySubLocs.map(loc => {
            const item = items.find(item => item.locations === loc && (item.barc === "" || item.barc === null));
            return item ? item.id : null;
        });
        const uniqueIds = [...new Set(ids)];
        const filteredItems = items.filter(item => uniqueIds.includes(item.id));
        const locationsToPrint = [...new Set(filteredItems.map(item => item.locations))];
        // New implementation ends here

        clearOptions(locSelect);
        addOptions(locSelect, locationsToPrint);
        triggerChangeEvent(locSelect);
    }


    function filterSubLocationsByLocation() {
        const selectedLoc = locSelect.value;
        const filteredSubLocs = items.filter(item => item.locations === selectedLoc && (item.barc === "" || item.barc === null));

        // Menampilkan ID item jika tidak memiliki QR code
        filteredSubLocs.forEach(item => {
            if (item.barc === "" || item.barc === null) {
                return item.id;
            }
        });

        clearOptions(subLocSelect);
        addOptions(subLocSelect, filteredSubLocs.map(item => item.sub_locations));
        triggerChangeEvent(subLocSelect);
    }

    function filterIdsBySubLocationAndLocation() {
        const selectedSubLoc = parseInt(subLocSelect.value);
        const selectedLoc = locSelect.value;
        const filteredIds = items.filter(item => item.sub_locations === selectedSubLoc && item.locations === selectedLoc && (item.barc === "" || item.barc === null));

        // Add logic to display item.id if code_qr is empty or null and sort the ids in ascending order
        const sortedIdsToDisplay = filteredIds.filter(item => item.barc === "" || item.barc === null)
            .sort((a, b) => a.id - b.id)
            .map(item => item.id);

        clearOptions(idSelect);
        addOptions(idSelect, sortedIdsToDisplay);
        triggerChangeEvent(idSelect);

        // Select the first ID option by default
        if (sortedIdsToDisplay.length > 0) {
            idSelect.value = sortedIdsToDisplay[0];
            // Trigger change event for id select to display the selected item data
            triggerChangeEvent(idSelect);
        }
    }

    function clearOptions(selectElement) {
        selectElement.innerHTML = "";
    }

    function addOptions(selectElement, options) {
        var value1 = '<?=$last_line?>';
        var value2 = '<?=$last_locations?>';
        var value3 = '<?=$last_sub_locations?>';

        options.forEach(option => {
            const optionElement = document.createElement("option");
            optionElement.value = option;
            optionElement.text = option;

            if (option === value1) {
                optionElement.selected = true;
            } else if (option === value2) {
                optionElement.selected = true;
            } else if (option === value3) {
                optionElement.selected = true;
            }

            selectElement.add(optionElement);
        });
    }

    function triggerChangeEvent(selectElement) {
        const event = new Event('change');
        selectElement.dispatchEvent(event);
    }

    rackSelect.addEventListener("change", filterLocationsByRack);
    locSelect.addEventListener("change", filterSubLocationsByLocation);
    subLocSelect.addEventListener("change", filterIdsBySubLocationAndLocation);
    idSelect.addEventListener("change", function() {
        // Ambil data item berdasarkan id
        const selectedItem = items.find(item => item.id === parseInt(idSelect.value));
        console.log(selectedItem.id);
    });


    // Trigger change event for rack select when the page first loads
    triggerChangeEvent(rackSelect);
</script>

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

    $(document).ready(function() {
        setInterval(getFeed, 2500);
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
    });

    // VALIDASI RANGE CLICK BUTTON
    var button = document.getElementById("btn-submit");
    var isButtonClicked = false;
    button.addEventListener("click", function() {
        if (!isButtonClicked) {
            isButtonClicked = true;
            setTimeout(function() {
                isButtonClicked = false;
                button.disabled = false;
            }, 30000);
        } else {
            alert("Tunggu 30 detik supaya tidak duplikat");
        }
    });
</script>