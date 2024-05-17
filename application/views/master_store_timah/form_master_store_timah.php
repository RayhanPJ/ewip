form_master_store_timah.php
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
                                <h4 class="box-title">Master Data Line</h4>
                            </div>
                            <button id="add-button" type="button" class="btn btn-primary mt-3">Add</button>
                            <form id="rack-form" action="<?= base_url() ?>master_store_timah/inputLineData/" method="post">
                                <table id="data_rak" class="table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Line</th>
                                            <th class="text-center">Locations</th>
                                            <th class="text-center">Number Items</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        <!-- Existing rows if any -->
                                    </tbody>
                                </table>
                            </form>
                            <button type="submit" form="rack-form" class="btn btn-success">Submit</button>

                            <!-- Dynamic Table Full -->
                            <div class="block">
                                <div class="block-content block-content-full">
                                    <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                                    <table id="example4" class="table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th hidden></th>
                                                <th class="text-center">NO</th>
                                                <th class="text-center">Line</th>
                                                <th class="text-center">Locations</th>
                                                <th class="text-center">Number Items</th>
                                                <th class="text-center">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1;
                                            foreach ($item as $items) {
                                                if ($items->barc == null || $items->barc == "") { ?>
                                                    <tr>
                                                        <td hidden class="text-center"><?php echo $items->id; ?></td>
                                                        <td class="text-center"><?php echo $count; ?></td>
                                                        <td class="text-center"><?php echo $items->line ?></td>
                                                        <td class="text-center"><?php echo $items->locations ?></td>
                                                        <td class="text-center"><?php echo $items->sub_locations ?></td>
                                                        <td class="text-center">
                                                            <a class="btn btn-danger" href="<?php echo site_url('master_store_timah/deleteData/' . $items->id); ?>">Delete</a>
                                                        </td>
                                                    </tr>
                                            <?php $count++;
                                                }
                                            } ?>
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

<script type="text/javascript">
    // Menyimpan data baris
    let rowData = [];

    // Fungsi untuk mengisi data ke dalam tabel
    function addDataLocation(data) {
        const tableBody = document.getElementById('table-body');
        const newRow = document.createElement('tr');


        const lineCell = document.createElement('td');
        const lineInput = document.createElement('input');
        lineInput.setAttribute('type', 'text');
        lineInput.setAttribute('class', 'form-control');
        lineInput.setAttribute('name', 'line[]');
        lineCell.appendChild(lineInput);
        newRow.appendChild(lineCell);

        const locationsCell = document.createElement('td');
        const locationsInput = document.createElement('input');
        locationsInput.setAttribute('type', 'text');
        locationsInput.setAttribute('class', 'form-control');
        locationsInput.setAttribute('name', 'locations[]');
        locationsCell.appendChild(locationsInput);
        newRow.appendChild(locationsCell);

        const number_itemsCell = document.createElement('td');
        const number_itemsInput = document.createElement('input');
        number_itemsInput.setAttribute('type', 'text');
        number_itemsInput.setAttribute('class', 'form-control');
        number_itemsInput.setAttribute('name', 'number_items[]');
        number_itemsCell.appendChild(number_itemsInput);
        newRow.appendChild(number_itemsCell);

        const actionCell = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.setAttribute('type', 'button');
        deleteButton.setAttribute('class', 'btn btn-danger');
        deleteButton.innerHTML = 'Delete';
        deleteButton.addEventListener('click', function() {
            // Hapus baris saat tombol "Delete" diklik
            tableBody.removeChild(newRow);
            rowData = rowData.filter(function(data) {
                return data.line !== lineInput.value;
            });
        });
        actionCell.appendChild(deleteButton);
        newRow.appendChild(actionCell);

        tableBody.appendChild(newRow);

        // Tambahkan data baru ke dalam variabel rowData
        // Tambahkan data baru ke dalam variabel rowData
        rowData.push({
            line: lineInput.value,
            locations: locationsInput.value,
            number_items: number_itemsInput.value,
        });

        // Reset nilai input
        lineInput.value = '';
        locationsInput.value = '';
        number_itemsInput.value = '';
    }

    // Fungsi untuk menambahkan input baru saat tombol "Add" diklik
    function addRowInput() {
        addDataLocation({});
    }

    // Event listener untuk tombol "Add"
    const addButton = document.getElementById('add-button');
    addButton.addEventListener('click', addRowInput);
</script>