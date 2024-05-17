<?php 
    // echo json_encode($data).'<br>';
    $number = 1;
    $arrOpen = [];
    $arrClosed = [];
    $arrOnProgress = [];
    foreach ($data as $values) {
      if($values['status'] == 'Open') {
        $arrOpen[] = $number;
        $number++;
      }
      if($values['status'] == 'Closed') {
        $arrClosed[] = $number;
        $number++;
      }
      if($values['status'] == 'On Progress') {
        $arrOnProgress[] = $number;
        $number++;
      }
    }
    $index = count($arrClosed) + count($arrOpen) + count($arrOnProgress);

    $page = $count + 1;
?>

<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <br>
    <br>
    
    <div class="col-md-12">
        <input type="date" name="" id="filterTanggal" value="<?=$date?>" onchange="filterByShift()" style="margin-bottom:10px;">
        <select name="shift" id="shift" onchange="filterByShift()">
            <option value="" selected disabled>Shift</option>
            <option value="1">Shift 1</option>
            <option value="2">Shift 2</option>
            <option value="3">Shift 3</option>
        </select>
        <br>
        <br>
        <div style="display: flex;justify-content: space-around;">
            <?php 
                for($i = 1; $i <= $index; $i++) {
                    if(in_array($i, $arrOpen)) { ?>
                        <button class="btn btn-lg btn-danger" onclick="linkPage(<?=$i?>)"><?=$i?></button>
                    <?php
                    } else if(in_array($i, $arrOnProgress)) { ?>
                        <button class="btn btn-lg btn-warning" onclick="linkPage(<?=$i?>)"><?=$i?></button>
                    <?php
                    } else if(in_array($i, $arrClosed)) { ?>
                        <button class="btn btn-lg btn-success" onclick="linkPage(<?=$i?>)"><?=$i?></button>
                    <?php
                    }
                }
                for ($k=$index+1; $k <= (floor($index/10) == 0 ? 10 : floor($index/10) * 10); $k++) { ?>
                    <a href="#" class="btn btn-lg btn-primary" style="pointer-events: none;cursor: default;"><?=$k?></a>
                <?php
                }
            ?>
           
        </div>
        
        <br>
        <div class="block">
            <div class="block-content block-content-full">
                <div>
                <?php
                    if (empty($data)) { ?>
                        <h2 style="text-align:center;">Belum Ada Order Masuk</h2>
                    <?php } else { ?>

                    <h4 style="text-align:center; color:red; font-size:45px"><?=$page?></h4>
                    <h2 style="text-align:center;">Activity To -> <?=$data[$count]['location']?></h2>
                    
                    <hr>    
                    <form action="<?=base_url()?>AndonForklift/confirmAndon" method="POST">
                        <table class="table-supply-plate" style="margin: 0 auto;">
                            <tr>
                                <td>Location</td>
                                <td> : </td>
                                <td><?=$data[$count]['location']?></td>
                            </tr>
                            <tr>
                                <td>Uraian</td>
                                <td> : </td>
                                <td><?=(($data[$count]['uraian'] != '' && $data[$count]['request'] != '') ? $data[$count]['request'] . ' - ' . $data[$count]['uraian'] : $data[$count]['request'] . $data[$count]['uraian']) ?></td>
                            </tr>
                            <tr>
                                <td>Create Andon</td>
                                <td> : </td>
                                <td><?= date('Y-m-d H:i:s', strtotime($data[$count]['tanggal_andon'])) ?></td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td> : </td>
                                <td>
                                    <?php if($data[$count]['operator'] == '') { ?>
                                    <select class="form-control select2" id="operator" name="operator" style="width: 100%;" required>
                                        <option value="" selected disabled>-- Nama Operator --</option>
                                        <option value="Agung">Agung</option>
                                        <option value="Ananta">Ananta</option>
                                        <option value="Dade">Dade</option>
                                        <option value="Ficky">Ficky</option>
                                        <option value="Irfan">Irfan</option>
                                        <option value="Kiki">Kiki</option>
                                        <option value="Latif">Latif</option>
                                        <option value="Musbikin">Musbikin</option>
                                        <option value="Subhan">Subhan</option>
                                    </select>
                                    <?php } else {
                                        echo $data[$count]['operator'];
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <?php
                                    if ($data[$count]['status'] == 'Open' || $data[$count]['status'] == 'Closed') {
                                        $disabled = 'disabled';
                                    } else {
                                        $disabled = '';
                                    }

                                    if ($data[$count]['status'] == 'Open' || $data[$count]['status'] == 'On Progress' || empty($data[$count+1]['status'])) {
                                        $disabledNext = 'disabled';
                                    } else {
                                        $disabledNext = '';
                                    }

                                    if ($data[$count]['status'] == 'Open') {
                                        $disabledProgress = '';
                                    } else {
                                        $disabledProgress = 'disabled';
                                    }

                                    $linkBtnNext = $count + 2;
                                ?>
                                <td style="text-align:left;"></td>
                                <td style="text-align:center;"></td>
                                <td style="text-align:right;"></td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-4" style="text-align:left;">
                                <input type="submit" name="action" class="btn btn-lg btn-warning" value="On Progress" <?=$disabledProgress?>>
                            </div>
                            <div class="col-4" style="text-align:left;">
                                <input type="submit" name="action" class="btn btn-lg btn-success" value="Closed" <?=$disabled?>>
                            </div>
                            <div class="col-4" style="text-align:right;">
                                <button type="button" onclick="linkPage(<?=$linkBtnNext?>)" class="btn btn-lg btn-primary" style="float:right;" <?=$disabledNext?>>Next</button>
                            </div>
                        </div>
                        <input type="hidden" name="id_andon_forklift" value="<?=$data[$count]['id_andon_forklift']?>">
                    </form>
                    <?php } ?>     
                </div>
            </div>
        </div>

    </div>
</div>
<!-- END Page Content -->
</main>
<!-- END Main Container -->
<script>
    $("#shift").val("<?=$shift?>");

    function filterByDate() {
        var tanggal = $('#filterTanggal').val()
        window.location.replace('<?=base_url(); ?>AndonForklift/list_andon/'+tanggal);
    }

    function filterByShift() {
        var tanggal = $('#filterTanggal').val()
        var shift = $('#shift').val()
        window.location.replace('<?=base_url(); ?>AndonForklift/list_andon/'+tanggal+'/'+shift);
    }

    function linkPage(i) {
        var tanggal = $('#filterTanggal').val()
        var shift = $('#shift').val()
        window.location.replace('<?=base_url(); ?>AndonForklift/list_andon/'+tanggal+'/'+shift+'/'+i);
    }
</script>