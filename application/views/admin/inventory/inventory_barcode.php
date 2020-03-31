<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory Barcode</title>
    <!-- Bootstrap 3.3.4 -->
    <script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.1.1.min.js'; ?>"></script>
		<!--<![endif]-->
		<script src="<?php echo base_url().'assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/bootstrap/js/bootstrap.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/blockUI/jquery.blockUI.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/iCheck/jquery.icheck.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/moment/min/moment.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/bootbox/bootbox.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/jquery.scrollTo/jquery.scrollTo.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/jquery.appear/jquery.appear.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/jquery-cookie/jquery.cookie.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/velocity/jquery.velocity.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/TouchSwipe/jquery.touchSwipe.min.js'; ?>"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		<script src="<?php echo base_url().'assets/plugins/owl-carousel/owl-carousel/owl.carousel.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/jquery-mockjax/jquery.mockjax.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/toastr/toastr.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/bootstrap-modal/js/bootstrap-modal.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/bootstrap-select/bootstrap-select.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/jquery-validation/dist/jquery.validate.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/DataTables/media/js/jquery.dataTables.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/DataTables/media/js/DT_bootstrap.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/truncate/jquery.truncate.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/summernote/dist/summernote.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/bootstrap-daterangepicker/daterangepicker.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/js/subview.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/js/subview-examples.js'; ?>"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script type="text/javascript" src="<?php echo base_url().'assets/plugins/select2/select2.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/tableExport/tableExport.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/tableExport/jquery.base64.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/tableExport/html2canvas.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/tableExport/jquery.base64.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/tableExport/jspdf/libs/sprintf.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/tableExport/jspdf/jspdf.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/tableExport/jspdf/libs/base64.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/js/table-export.js'; ?>"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE JAVASCRIPTS  -->
		<script src="<?php echo base_url().'assets/js/main.js'; ?>"></script>
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				SVExamples.init();
				TableExport.init();
			});
		</script>

</head>
<style type="text/css">
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 0cm;
        height: 257mm;
    }

    .bg-light-blue {
        background: #82C0E4 !important;
        -webkit-print-color-adjust: exact;
        }

    .bg-navy-blue {
        background: #4F9ECC !important;
        -webkit-print-color-adjust: exact;
    }

    .text-white{
        color: #ffffff !important;
        -webkit-print-color-adjust: exact;
    }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            /* page-break-after: always; */
        }

        .bg-light-blue {
            background: #82C0E4 !important;
            -webkit-print-color-adjust: exact;
        }

        .bg-navy-blue {
            background: #4F9ECC !important;
            -webkit-print-color-adjust: exact;
        }

        .text-white{
            color: #ffffff !important;
            -webkit-print-color-adjust: exact;
        }
    }

    table{
        border-radius:0.3cm;
        padding:0.1cm;
        margin:0.2cm;
        display:inline-table;
    }

    td{
        text-align:center;
    }

    div{
        padding:0cm 0.01cm;
    }

    h3{
        text-align:center;
    }

    img{
        width:4.7cm;
    }
</style>
<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
            <h3>Daftar Barcode Buku</h3>
            <?php
                $sumvalue = count($inventories);
                $no = 1;
                foreach ($inventories as $key => $inventory) {
                    if ($no > 1) {
                        echo 
                        '</div>
                        </div>
                        <div class="page">
                            <div class="subpage">
                        ';
                    }elseif ($no > $sumvalue) {
                        break;
                    }
            ?>
            <h5><?= $no++.'. '.$inventory['judul_inventory'] ?></h5>
                <?php 
                    for ($i=0; $i < $inventory['jumlahcetak']; $i++) { 
                        if ($i % 15 == 0) {
                            if ($i > 1) {
                                echo 
                                '</div>
                                </div>
                                <div class="page">
                                    <div class="subpage">
                                    <h5>'.$inventory['judul_inventory'].' (Lanjutan)</h5>
                                ';
                            }
                        }
                ?>
                <table border="1" class="dataTable">
                <tr>
                    
                    <td>
                        <div>
                            <p style="font-size:7pt;"><?= $inventory['judul_inventory'] ?></p>
                            <img src="<?= base_url('index.php/barcode/gambar/'.$inventory['barcode_inventory'].'?height=80&width=1') ?>" alt="barcode">
                            <p style="font-weight:500;font-size:10pt;margin-block-end:0.2cm;">ISBN : <?= $inventory['ISBN'] ?> </p>
                        </div>
                    </td>
                </tr>
                </table>
                <?php
                    }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>