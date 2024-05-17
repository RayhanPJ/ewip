
<!-- Main Container -->
<main id="main-container">

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Form Unloading Timah - <?php echo $this->session->userdata('username'); ?></h2>
    <a class="btn btn-alt-primary" href="<?php echo base_url('whfg/index') ?>"><i class="fa fa-plus mr-5"></i>Refresh</a>
    <a class="btn btn-alt-danger" href="<?php echo base_url('login/logout') ?>"><i class="fa fa-plus mr-5"></i>Keluar</a>
    <div class="row">
        <div class="col-md-12">
            <!-- Default Elements -->
            <div class="block">
                <div class="block-content">
                    <div style="text-align:center;">
                        <video id="previewKamera" style="width: 300px;height: 300px;"></video>
                        <br>
                        <select id="pilihKamera" style="max-width:400px"></select>
                    </div>
                                    
                    <script>
                        let selectedDeviceId = null;
                        const codeReader = new ZXing.BrowserMultiFormatReader();
                        const sourceSelect = $("#pilihKamera");
                
                        $(document).on('change','#pilihKamera',function(){
                            selectedDeviceId = $(this).val();
                            if(codeReader){
                                codeReader.reset()
                                initScanner()
                            }
                        })
                
                        function initScanner() {
                            codeReader
                            .listVideoInputDevices()
                            .then(videoInputDevices => {
                                videoInputDevices.forEach(device =>
                                    console.log(`${device.label}, ${device.deviceId}`)
                                );
                
                                if(videoInputDevices.length > 0){
                                    
                                    if(selectedDeviceId == null){
                                        if(videoInputDevices.length > 1){
                                            selectedDeviceId = videoInputDevices[1].deviceId
                                        } else {
                                            selectedDeviceId = videoInputDevices[0].deviceId
                                        }
                                    }
                                    
                                    
                                    if (videoInputDevices.length >= 1) {
                                        sourceSelect.html('');
                                        videoInputDevices.forEach((element) => {
                                            const sourceOption = document.createElement('option')
                                            sourceOption.text = element.label
                                            sourceOption.value = element.deviceId
                                            if(element.deviceId == selectedDeviceId){
                                                sourceOption.selected = 'selected';
                                            }
                                            sourceSelect.append(sourceOption)
                                        })
                                
                                    }
                
                                    codeReader
                                        .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                                        .then(result => {
                
                                                //hasil scan
                                                console.log(result.text)
                                                $("#barcode").val(result.text);
                                                $(document).ready(function(){ 
                                                    $('#tombol-submit')[0].click(function(){
                                                    }); 
                                                });

                                                if(codeReader){
                                                    codeReader.reset()
                                                }
                                        })
                                        .catch(err => console.error(err));
                                    
                                } else {
                                    alert("Camera not found!")
                                }
                            })
                            .catch(err => console.error(err));
                        }                
                
                        if (navigator.mediaDevices) {
                            initScanner()
                        } else {
                            alert('Cannot access camera.');
                        }
                    </script>
                    <!-- END JS -->
                    
                    <form action="<?php echo base_url('whfg_timah/getDataDn') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-12" for="whto">Receipt Transaction</label></label>
                            <div class="col-md-9">
                                <div class="input-group control-group">
                                    <input name="no_dn" class="form-control" id="barcode" placeholder="No DN" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="btn btn-danger" type="submit" value="Submit" id="tombol-submit" />
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- END Page Content -->

</main>
<!-- END Main Container -->
