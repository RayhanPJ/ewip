<?php
$uniqueLine = [];
$uniqueLoc = [];

// var_dump($item);die;

foreach ($item as $v) {
    $line = $v->line;
    if ($v->locations == $getLine) {
        if (!in_array($line, $uniqueLine)) {
            $uniqueLine[] = $line;
        } else {
            continue;
        }
    }
}
foreach ($item as $v) {
    $loc = $v->locations;
    if (!in_array($loc, $uniqueLoc)) {
        $uniqueLoc[] = $loc;
    } else {
        continue;
    }
}

?>

<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content">
        <div class="row mt-4">
            <div class="col-xl-12 col-12">
                <div class="row mt-4">
                    <div class="col-12 col-xl-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">Input Data Line <?php echo $getLine ?></h4>
                            </div>
                            <a class="d-flex justify-content-end" href="<?= base_url() ?>Store_Timah">Back to Store</a>
                            <div class="row mt-3">
                                <div class="col-2 col-xl-2">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">QR Code</h4>
                                        <input type="text" class="form-control" placeholder="Input QR-Code" id="qr" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-xl-12">
                                    <div class="box-header with-border">
                                        <form id="rack-form" action="<?= base_url() ?>Store_Timah/updateData" method="post">
                                            <div class="row mb-3">
                                                <div hidden class="col-4">
                                                    <label for="rack" class="form-label">Rack</label>
                                                    <select class="form-control" id="rack" placeholder="rack" name="rack" require>
                                                        <?php foreach ($uniqueLine as $v) : ?>
                                                            <option value="<?= $v; ?>"><?= $v; ?></option>
                                                        <?php endforeach ?>
                                                    </select>

                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                                <div hidden class="col-4">
                                                    <label for="location" class="form-label">Location</label>
                                                    <select class="form-control" id="locations" placeholder="Locations" name="locations" require>
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                                <div hidden class="col-4">
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
                                            <table class="table table-bordered table-striped" style="width:100%">
                                                <tbody id="table-body">
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="data_line" class="table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>BARCODE</th>
                                                <th>ITEM</th>
                                                <th>QTY AKTUAL</th>
                                                <th>RECEIPT TIME</th>
                                                <th>AGE(day)</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ($item as $items) {
                                                if ($items->barc != null || $items->barc != "") {
                                                    if ($items->locations == $getLine) {
                                                        // Konversi zona waktu ke "Asia/Jakarta"
                                                        $dateTime = new DateTime($items->created_at_storing, new DateTimeZone('UTC'));
                                                        $dateTime->setTimezone(new DateTimeZone('Asia/Jakarta'));

                                                        // Format tanggal menjadi "DD/MM/YYYY H:I"
                                                        $formattedDateTime = $dateTime->format('d/m/Y');
                                                        $formattedDateCreated = date('d/m/Y', strtotime($items->created_at));

                                                        // Objek DateTime dari tanggal formattedDateCreated
                                                        $dateCreated = DateTime::createFromFormat('d/m/Y', $formattedDateCreated);

                                                        // Objek DateTime dari tanggal formattedDateTime
                                                        $dateFormatted = DateTime::createFromFormat('d/m/Y', $formattedDateTime);

                                                        // Menghitung selisih antara dua tanggal
                                                        $interval = $dateCreated->diff($dateFormatted);

                                                        // Mendapatkan total selisih hari
                                                        $resultAge = $interval->days;
                                            ?>
                                                        <tr>
                                                            <!-- <td hidden class="text-center"><?php echo $items->id; ?></td> -->
                                                            <td class="text-center"><?php echo $count; ?></td>
                                                            <td><?php echo $items->barc ?></td>
                                                            <td><?php echo $items->item ?></td>
                                                            <td><?php echo $items->actq ?></td>
                                                            <td><?php echo date('d/m/Y H:i', strtotime($items->created_at)); ?></td>
                                                            <td><?php echo $resultAge ?> Day</td>
                                                            <td>
                                                                <a target="_blank" class="btn btn-success" href="<?php echo base_url('whfg_timah/print_receipt/' . $items->barc); ?>">Print</a>
                                                                <a class="btn btn-danger" href="<?php echo site_url('Store_Timah/resetData/' . $items->id); ?>">Delete</a>
                                                            </td>
                                                        </tr>
                                            <?php
                                                        $count++;
                                                    }
                                                }
                                            }
                                            ?>
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    const items = <?php echo json_encode($item); ?>;
    const whfg_timah = <?php echo json_encode($whfg_timah); ?>;
    const getLine = "<?php echo $getLine ?>";

    function filterLocationsByRack() {
        const selectedRack = rackSelect.value;
        const filteredLocs = uniqueLocs.filter(loc => loc.startsWith(selectedRack) && loc.startsWith(getLine));
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
        options.forEach(option => {
            const optionElement = document.createElement("option");
            optionElement.value = option;
            optionElement.text = option;
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
    const input = document.getElementById('qr');
    const formData = new FormData();
    let rowData = [];

    // fungsi untuk mengisi data ke dalam tabel
    function updateTableData(data) {
        const tableBody = document.getElementById('table-body');
        tableBody.innerHTML = '';

        const content = input.value;
        console.log(content);
        const filteredData = data.filter(row => row.barc.includes(content));
        console.log(filteredData);

        let status_submit = true;

        // check input barcode it is exist or not in table data_line
        const barcInTable = [...document.querySelectorAll('#data_line tbody tr td:nth-child(3)')].map(td => td.textContent);
        console.log(barcInTable);
        if (barcInTable.includes(content)) {
            status_submit = false;
        }

        // Assign the filtered data to the rowData array
        rowData = filteredData;
        filteredData.forEach(function(row) {
            const newRow = document.createElement('tr');

            const barcCell = document.createElement('td');
            const barcInput = document.createElement('input');
            barcInput.setAttribute('type', 'text');
            barcInput.setAttribute('class', 'form-control');
            barcInput.setAttribute('name', 'barc');
            barcInput.setAttribute('value', row.barc);
            barcInput.setAttribute('readonly', true);
            barcCell.appendChild(barcInput);
            newRow.appendChild(barcCell);

            const itemCell = document.createElement('td');
            const itemInput = document.createElement('input');
            itemInput.setAttribute('type', 'text');
            itemInput.setAttribute('class', 'form-control');
            itemInput.setAttribute('name', 'item[]');
            itemInput.setAttribute('value', row.item);
            itemInput.setAttribute('readonly', true);
            itemCell.appendChild(itemInput);
            newRow.appendChild(itemCell);

            const cwarfCell = document.createElement('td');
            const cwarfInput = document.createElement('input');
            cwarfInput.setAttribute('type', 'text');
            cwarfInput.setAttribute('class', 'form-control');
            cwarfInput.setAttribute('name', 'cwarf[]');
            cwarfInput.setAttribute('value', row.cwarf);
            cwarfInput.setAttribute('readonly', true);
            cwarfCell.appendChild(cwarfInput);
            newRow.appendChild(cwarfCell);

            const no_dnCell = document.createElement('td');
            const no_dnInput = document.createElement('input');
            no_dnInput.setAttribute('type', 'text');
            no_dnInput.setAttribute('class', 'form-control');
            no_dnInput.setAttribute('name', 'no_dn[]');
            no_dnInput.setAttribute('value', row.no_dn);
            no_dnInput.setAttribute('readonly', true);
            no_dnCell.appendChild(no_dnInput);
            newRow.appendChild(no_dnCell);

            const actqCell = document.createElement('td');
            const actqInput = document.createElement('input');
            actqInput.setAttribute('type', 'text');
            actqInput.setAttribute('class', 'form-control');
            actqInput.setAttribute('name', 'actq[]');
            actqInput.setAttribute('value', row.actq);
            actqInput.setAttribute('readonly', true);
            actqCell.appendChild(actqInput);
            newRow.appendChild(actqCell);

            const created_atCell = document.createElement('td');
            const created_atInput = document.createElement('input');
            created_atInput.setAttribute('type', 'text');
            created_atInput.setAttribute('class', 'form-control');
            created_atInput.setAttribute('name', 'created_at[]');
            created_atCell.setAttribute('hidden', true);
            created_atInput.setAttribute('value', row.created_at);
            created_atInput.setAttribute('readonly', true);
            created_atCell.appendChild(created_atInput);
            newRow.appendChild(created_atCell);

            const ponoCell = document.createElement('td');
            const ponoInput = document.createElement('input');
            ponoInput.setAttribute('type', 'text');
            ponoInput.setAttribute('class', 'form-control');
            ponoInput.setAttribute('name', 'pono[]');
            ponoInput.setAttribute('value', row.pono);
            ponoInput.setAttribute('readonly', true);
            ponoCell.setAttribute('hidden', true);
            ponoCell.appendChild(ponoInput);
            newRow.appendChild(ponoCell);

            const ornoCell = document.createElement('td');
            const ornoInput = document.createElement('input');
            ornoInput.setAttribute('type', 'text');
            ornoInput.setAttribute('class', 'form-control');
            ornoInput.setAttribute('name', 'orno[]');
            ornoInput.setAttribute('value', row.orno);
            ornoInput.setAttribute('readonly', true);
            ornoCell.setAttribute('hidden', true);
            ornoCell.appendChild(ornoInput);
            newRow.appendChild(ornoCell);

            const yearCell = document.createElement('td');
            const yearInput = document.createElement('input');
            yearInput.setAttribute('type', 'text');
            yearInput.setAttribute('class', 'form-control');
            yearInput.setAttribute('name', 'year[]');
            yearInput.setAttribute('value', row.year);
            yearInput.setAttribute('readonly', true);
            yearCell.setAttribute('hidden', true);
            yearCell.appendChild(yearInput);
            newRow.appendChild(yearCell);

            const periCell = document.createElement('td');
            const periInput = document.createElement('input');
            periInput.setAttribute('type', 'text');
            periInput.setAttribute('class', 'form-control');
            periInput.setAttribute('name', 'peri[]');
            periInput.setAttribute('value', row.peri);
            periInput.setAttribute('readonly', true);
            periCell.setAttribute('hidden', true);
            periCell.appendChild(periInput);
            newRow.appendChild(periCell);

            const tagnCell = document.createElement('td');
            const tagnInput = document.createElement('input');
            tagnInput.setAttribute('type', 'text');
            tagnInput.setAttribute('class', 'form-control');
            tagnInput.setAttribute('name', 'tagn[]');
            tagnInput.setAttribute('value', row.tagn);
            tagnInput.setAttribute('readonly', true);
            tagnCell.setAttribute('hidden', true);
            tagnCell.appendChild(tagnInput);
            newRow.appendChild(tagnCell);

            const dscaCell = document.createElement('td');
            const dscaInput = document.createElement('input');
            dscaInput.setAttribute('type', 'text');
            dscaInput.setAttribute('class', 'form-control');
            dscaInput.setAttribute('name', 'dsca[]');
            dscaInput.setAttribute('value', row.dsca);
            dscaInput.setAttribute('readonly', true);
            dscaCell.setAttribute('hidden', true);
            dscaCell.appendChild(dscaInput);
            newRow.appendChild(dscaCell);

            const cuniCell = document.createElement('td');
            const cuniInput = document.createElement('input');
            cuniInput.setAttribute('type', 'text');
            cuniInput.setAttribute('class', 'form-control');
            cuniInput.setAttribute('name', 'cuni[]');
            cuniInput.setAttribute('value', row.cuni);
            cuniInput.setAttribute('readonly', true);
            cuniCell.setAttribute('hidden', true);
            cuniCell.appendChild(cuniInput);
            newRow.appendChild(cuniCell);

            const admqCell = document.createElement('td');
            const admqInput = document.createElement('input');
            admqInput.setAttribute('type', 'text');
            admqInput.setAttribute('class', 'form-control');
            admqInput.setAttribute('name', 'admq[]');
            admqInput.setAttribute('value', row.admq);
            admqInput.setAttribute('readonly', true);
            admqCell.setAttribute('hidden', true);
            admqCell.appendChild(admqInput);
            newRow.appendChild(admqCell);

            const varqCell = document.createElement('td');
            const varqInput = document.createElement('input');
            varqInput.setAttribute('type', 'text');
            varqInput.setAttribute('class', 'form-control');
            varqInput.setAttribute('name', 'varq[]');
            varqInput.setAttribute('value', row.varq);
            varqInput.setAttribute('readonly', true);
            varqCell.setAttribute('hidden', true);
            varqCell.appendChild(varqInput);
            newRow.appendChild(varqCell);

            const endtCell = document.createElement('td');
            const endtInput = document.createElement('input');
            endtInput.setAttribute('type', 'text');
            endtInput.setAttribute('class', 'form-control');
            endtInput.setAttribute('name', 'endt[]');
            endtInput.setAttribute('value', row.endt);
            endtInput.setAttribute('readonly', true);
            endtCell.setAttribute('hidden', true);
            endtCell.appendChild(endtInput);
            newRow.appendChild(endtCell);

            const usersCell = document.createElement('td');
            const usersInput = document.createElement('input');
            usersInput.setAttribute('type', 'text');
            usersInput.setAttribute('class', 'form-control');
            usersInput.setAttribute('name', 'users[]');
            usersInput.setAttribute('value', row.users);
            usersInput.setAttribute('readonly', true);
            usersCell.setAttribute('hidden', true);
            usersCell.appendChild(usersInput);
            newRow.appendChild(usersCell);

            const cwartCell = document.createElement('td');
            const cwartInput = document.createElement('input');
            cwartInput.setAttribute('type', 'text');
            cwartInput.setAttribute('class', 'form-control');
            cwartInput.setAttribute('name', 'cwart[]');
            cwartInput.setAttribute('value', row.cwart);
            cwartInput.setAttribute('readonly', true);
            cwartCell.setAttribute('hidden', true);
            cwartCell.appendChild(cwartInput);
            newRow.appendChild(cwartCell);

            const apdtCell = document.createElement('td');
            const apdtInput = document.createElement('input');
            apdtInput.setAttribute('type', 'text');
            apdtInput.setAttribute('class', 'form-control');
            apdtInput.setAttribute('name', 'apdt[]');
            apdtInput.setAttribute('value', row.apdt);
            apdtInput.setAttribute('readonly', true);
            apdtCell.setAttribute('hidden', true);
            apdtCell.appendChild(apdtInput);
            newRow.appendChild(apdtCell);

            const refcntdCell = document.createElement('td');
            const refcntdInput = document.createElement('input');
            refcntdInput.setAttribute('type', 'text');
            refcntdInput.setAttribute('class', 'form-control');
            refcntdInput.setAttribute('name', 'refcntd[]');
            refcntdInput.setAttribute('value', row.refcntd);
            refcntdInput.setAttribute('readonly', true);
            refcntdCell.setAttribute('hidden', true);
            refcntdCell.appendChild(refcntdInput);
            newRow.appendChild(refcntdCell);

            const refcntuCell = document.createElement('td');
            const refcntuInput = document.createElement('input');
            refcntuInput.setAttribute('type', 'text');
            refcntuInput.setAttribute('class', 'form-control');
            refcntuInput.setAttribute('name', 'refcntu[]');
            refcntuInput.setAttribute('value', row.refcntu);
            refcntuInput.setAttribute('readonly', true);
            refcntuCell.setAttribute('hidden', true);
            refcntuCell.appendChild(refcntuInput);
            newRow.appendChild(refcntuCell);

            const status_whfg_timahCell = document.createElement('td');
            const status_whfg_timahInput = document.createElement('input');
            status_whfg_timahInput.setAttribute('type', 'text');
            status_whfg_timahInput.setAttribute('class', 'form-control');
            status_whfg_timahInput.setAttribute('name', 'status_whfg_timah[]');
            status_whfg_timahInput.setAttribute('value', row.status_whfg_timah);
            status_whfg_timahInput.setAttribute('readonly', true);
            status_whfg_timahCell.setAttribute('hidden', true);
            status_whfg_timahCell.appendChild(status_whfg_timahInput);
            newRow.appendChild(status_whfg_timahCell);

            const generate_baanCell = document.createElement('td');
            const generate_baanInput = document.createElement('input');
            generate_baanInput.setAttribute('type', 'text');
            generate_baanInput.setAttribute('class', 'form-control');
            generate_baanInput.setAttribute('name', 'generate_baan[]');
            generate_baanInput.setAttribute('value', row.generate_baan);
            generate_baanInput.setAttribute('readonly', true);
            generate_baanCell.setAttribute('hidden', true);
            generate_baanCell.appendChild(generate_baanInput);
            newRow.appendChild(generate_baanCell);

            const users_prodCell = document.createElement('td');
            const users_prodInput = document.createElement('input');
            users_prodInput.setAttribute('type', 'text');
            users_prodInput.setAttribute('class', 'form-control');
            users_prodInput.setAttribute('name', 'users_prod[]');
            users_prodInput.setAttribute('value', row.users_prod);
            users_prodInput.setAttribute('readonly', true);
            users_prodCell.setAttribute('hidden', true);
            users_prodCell.appendChild(users_prodInput);
            newRow.appendChild(users_prodCell);

            const sysqtyCell = document.createElement('td');
            const sysqtyInput = document.createElement('input');
            sysqtyInput.setAttribute('type', 'text');
            sysqtyInput.setAttribute('class', 'form-control');
            sysqtyInput.setAttribute('name', 'sysqty[]');
            sysqtyInput.setAttribute('value', row.sysqty);
            sysqtyInput.setAttribute('readonly', true);
            sysqtyCell.setAttribute('hidden', true);
            sysqtyCell.appendChild(sysqtyInput);
            newRow.appendChild(sysqtyCell);

            const qr_codeCell = document.createElement('td');
            const qr_codeInput = document.createElement('input');
            qr_codeInput.setAttribute('type', 'text');
            qr_codeInput.setAttribute('class', 'form-control');
            qr_codeInput.setAttribute('name', 'qr_code[]');
            qr_codeInput.setAttribute('value', row.qr_code);
            qr_codeInput.setAttribute('readonly', true);
            qr_codeCell.setAttribute('hidden', true);
            qr_codeCell.appendChild(qr_codeInput);
            newRow.appendChild(qr_codeCell);

            const uniq_codeCell = document.createElement('td');
            const uniq_codeInput = document.createElement('input');
            uniq_codeInput.setAttribute('type', 'text');
            uniq_codeInput.setAttribute('class', 'form-control');
            uniq_codeInput.setAttribute('name', 'uniq_code[]');
            uniq_codeInput.setAttribute('value', row.uniq_code);
            uniq_codeInput.setAttribute('readonly', true);
            uniq_codeCell.setAttribute('hidden', true);
            uniq_codeCell.appendChild(uniq_codeInput);
            newRow.appendChild(uniq_codeCell);

            const code_barcCell = document.createElement('td');
            const code_barcInput = document.createElement('input');
            code_barcInput.setAttribute('type', 'text');
            code_barcInput.setAttribute('class', 'form-control');
            code_barcInput.setAttribute('name', 'code_barc[]');
            code_barcInput.setAttribute('value', row.code_barc);
            code_barcInput.setAttribute('readonly', true);
            code_barcCell.setAttribute('hidden', true);
            code_barcCell.appendChild(code_barcInput);
            newRow.appendChild(code_barcCell);

            // Tambahkan aksi yang sesuai di sini
            const actionCell = document.createElement('td');
            const submitButton = document.createElement('button');
            submitButton.setAttribute('type', 'submit');
            submitButton.setAttribute('id', 'submit-button');
            submitButton.setAttribute('form', 'rack-form');
            submitButton.setAttribute('class', 'btn btn-success');
            submitButton.innerHTML = 'Submit';
            // check if the row has a barcod, button submit will be disabled
            if (status_submit) {
                actionCell.appendChild(submitButton);
                newRow.appendChild(actionCell);
            } 
            tableBody.appendChild(newRow);

            // Menambahkan data ke FormData
            formData.append('barc', row.barc);
        });
    }

    // // fungsi untuk menangani respons dari permintaan GET
    // function handleResponse() {
    //     if (this.readyState === 4 && this.status === 200) {
    //         const data = JSON.parse(this.responseText);
    //         console.log(data);
    //         if (data.length === 0) {
    //             // alert("Data kosong");
    //             // $('#table-body').html('');
    //             updateTableData(data);
    //         } else {
    //             updateTableData(data);
    //         }
    //     } else if (this.readyState === 4) {
    //         alert("Tidak ada koneksi");
    //     }
    // }

    // // fungsi untuk mengirimkan permintaan GET
    // function sendGetRequest(url) {
    //     const xhr = new XMLHttpRequest();
    //     xhr.open('GET', url, true);
    //     xhr.onreadystatechange = handleResponse;
    //     xhr.send();
    // }

    // // event listener untuk input
    // input.addEventListener('change', function(event) {
    //     const content = event.target.value;
    //     const url = "https://portal2.incoe.astra.co.id/e-wip/api/getDataScan/" + content;
    //     sendGetRequest(url);
    // });
    input.addEventListener('change', function(event) {
        updateTableData(whfg_timah);
    });

    // event listener for the submit button
    const submitButton = document.getElementById('submit-button');
    submitButton.addEventListener('click', function(event) {
        event.preventDefault();

        const formData = new FormData();

        // Use the rowData array to append data to FormData
        rowData.forEach(function(data, index) {
            formData.append(`barc_${index}`, data.barc);
        });

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'base_url()/Store_timah/updateData', true);
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                alert('Data berhasil dikirim');
            } else if (this.readyState === 4) {
                alert('Terjadi kesalahan saat mengirim data');
            }
        };
        xhr.send(formData);
    });
</script>