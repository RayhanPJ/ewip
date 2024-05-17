<?php $hasil = json_encode($data); ?>
<script>
    let datas = <?php echo $hasil; ?>; // Tambahkan "echo" di sini
    console.log(datas);
</script>

<body onload="window.print()">
    <!-- Page Content -->
    <?php foreach ($data as $d) { ?>
        <div style="text-align: center;"  class="content">
            <!-- Bootstrap Design -->
            <h2 class="content-heading">RAW MATERIAL TIMAH</h2>
            <p>*****************************************************</p>
            <!-- <br> -->
            <p><?php echo $d->item; ?></p>
            <!-- <br> -->
            <h1 class="content-heading">QTY : <?php echo floatval($d->actq); ?> Kg</h1>
            <p>*****************************************************</p>
            <table style="text-align: center; margin-left: auto; margin-right: auto;" class="tg">
                <thead>
                    <tr>
                        <th class="tg-0lax">Supplier <br> <?php echo $d->cwarf; ?></th>
                        <th class="tg-0lax">No DN <br> <?php echo $d->no_dn; ?></th>
                        <th class="tg-0lax">Line <br> <?php echo $d->line; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tg-0lax">Data Received <br> <?php echo date('Y-m-d') ?></td>
                        <td class="tg-0lax">No Lot <br> <?php echo $d->tagn; ?></td>
                        <td class="tg-0lax">Location <br> <?php echo $d->locations; ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <p>*****************************************************</p>
            <br>
            <!-- <img height="100" width="100"src="<?php echo base_url('assets/img_qr/'.$d->qr_code);?>" alt="<?=str_replace('.png','',$d->qr_code)?>"> -->
        <img height="100" width="100" src="https://portal2.incoe.astra.co.id:3006/generateqr?qr=<?=str_replace('.png','',$d->qr_code)?>" alt="<?=str_replace('.png','',$d->qr_code)?>">
            <br>
            <h1><p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $d->year.'.'.$d->peri.'.'.$d->code_barc; ?>
            </p></h1>
            <br>
            <a class="btn btn-success" href="<?php echo base_url('whfg_timah/getDataDn/'.$d->no_dn) ?>">Back</a>
        </div>
    <?php } ?>
    <!-- END Page Content -->
</body>