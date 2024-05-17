
            <!-- Footer -->
            <footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">
                    <div class="float-right">
                        Crafted with <i class="fa fa-heart text-pulse"></i> by <a class="font-w600" href="#" target="_blank">PT. Century Batteries Indonesia</a>
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="#" target="_blank">E-WIP 1.0</a> &copy; <span class="js-year-copy">2021</span>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!--
            Codebase JS Core

            Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
            to handle those dependencies through webpack. Please check out <?php echo base_url(); ?>assets/_es6/main/bootstrap.js for more info.

            If you like, you could also include them separately directly from the <?php echo base_url(); ?>assets/js/core folder in the following
            order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

            <?php echo base_url(); ?>assets/js/core/jquery.min.js
            <?php echo base_url(); ?>assets/js/core/bootstrap.bundle.min.js
            <?php echo base_url(); ?>assets/js/core/simplebar.min.js
            <?php echo base_url(); ?>assets/js/core/jquery-scrollLock.min.js
            <?php echo base_url(); ?>assets/js/core/jquery.appear.min.js
            <?php echo base_url(); ?>assets/js/core/jquery.countTo.min.js
            <?php echo base_url(); ?>assets/js/core/js.cookie.min.js
        -->
        <script src="<?php echo base_url(); ?>assets/js/codebase.core.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <!--
            Codebase JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at <?php echo base_url(); ?>assets/_es6/main/app.js
        -->
        <script src="<?php echo base_url(); ?>assets/js/codebase.app.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/chartjs/Chart.bundle.min.js"></script>

        <!-- Page JS Code -->
        <script src="<?php echo base_url(); ?>assets/js/pages/be_pages_dashboard.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page JS Code -->
        <script src="<?php echo base_url(); ?>assets/js/pages/be_tables_datatables.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/buttons.html5.min.js"></script>

        <!-- Page JS Helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins) -->
        <script>jQuery(function(){ Codebase.helpers(['datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider', 'tags-inputs']); });</script>

        <script type="text/javascript" defer="defer">
        $(document).ready(function() {
            $("table[id^='TABLE']").DataTable( {
                "scrollY": "300px",
                "scrollCollapse": true,
                "searching": true,
                "paging": true
            } );

            $('#list-order').DataTable().destroy();
            $('#list-order').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            } );

            $('#report_dn').DataTable().destroy();
            $('#report_dn').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
                "pageLength": 50
            } );

            $('#data_item').DataTable().destroy();
            $('#data_item').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
                "pageLength": 50
            } );

            $('#data_summary').DataTable().destroy();
            $('#data_summary').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
                "pageLength": 50
            } );

            $('#summary_transaction').DataTable().destroy();
            $('#summary_transaction').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
                "pageLength": 50
            } );

            $('#data_line').DataTable().destroy();
            $('#data_line').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
                "pageLength": 50
            } );
        } );
        </script>

        <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    "scrollX": true
                } );
            } );
        </script>

        <script>
            $(document).ready(function() {
                $('#example2').DataTable( {
                    "scrollX": true
                } );
            } );
        </script>

        <script>
            $(document).ready(function() {
                $('#example3').DataTable( {
                    "scrollX": true,
                    // "scrollY": "300px",
                    "scrollCollapse": true,
                    "searching": true,
                    "paging": false
                } );
            } );
        </script>

        <script>
            $(".readonly").on('keydown paste focus mousedown', function(e){
                if(e.keyCode != 9) // ignore tab
                    e.preventDefault();
            });
        </script>

    </body>
</html>