<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Bill Peminjaman</title>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url('assets/temp/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
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
            page-break-after: always;
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
    p{
        margin-block-end:0cm;
        margin-block-start:0cm;
        font-size:9pt;
    }

    table{
        width:100%;
        margin:0.2cm 0cm;
        color:rgb(0,0,0);
    }

    table.content,
    table.content td{
        border: 1px solid rgba(0,0,0,0.5);
        border-collapse: collapse;
        font-size:9pt;
    }

    table.content td{
        padding: 1px 5px;
    }
</style>
<body>
    <div class="page">
        <div class="subpage">
            <?php
                foreach ($perpustakaan as $key2 => $value2) {
            ?>
            <!-- HEADER -->
            <table style="width:70%;margin:0 auto">
                <tr>
                    <td style="width:50%;padding:0.1cm 0cm">
                        <p><b class="text-uppercase"><?= $value2->nama ?></b></p>
                    </td>
                    <td style="width:20%;">
                        <p class="text-capitalize">nama anggota</p>
                    </td>
                    <td style="width:2%;">
                        <p>:</p>
                    </td>
                    <td style="width:23%;">
                    <?php
                        foreach ($peminjaman as $key => $value) {
                    ?>
                        <p><?= $value->nama_member ?></p>
                    <?php
                    break;
                        }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" style="padding:0.1cm 0cm"><p class="text-capitalize" style=""><?= $value2->alamat ?></p></td>
                    <td><p class="text-capitalize">no. anggota</p></td>
                    <td><p>:</p></td>
                    <?php
                        foreach ($peminjaman as $key => $value) {
                    ?>
                    <td><p><?= $value->no_identitas_member ?></p></td>
                    <?php
                    break;
                        }
                    ?>
                </tr>
                <tr>
                    <td><p class="text-capitalize">jabatan</p></td>
                    <td><p>:</p></td>
                    <?php
                        foreach ($peminjaman as $key => $value) {
                    ?>
                    <td><p><?= $value->jenis_member ?></p></td>
                    <?php
                    break;
                        }
                    ?>
                </tr>
                <tr>
                    <td style="width:10% !important;padding:0.1cm 0cm"><p class="text-capitalize">Telp: <?= $value2->telepon; ?></p></td>
                </tr>
            </table>
            <!-- END HEADER -->

            <!-- TITLE -->
            <table style="width:100%">
            <?php
                foreach ($peminjaman as $key => $value) {
            ?>
                <tr>
                    <td style="width:14%"><p>No. Transaksi :</p></td>
                    <td style="width:20%"><p><?= $value->id_transaksi_peminjaman ?></p></td>
                    <td style="text-align:center;width:48%"><p><b class="text-uppercase">bukti peminjaman buku</b></p></td>
                    <td style="width:10%"><p>Tanggal :</p></td>
                    <td style="width:10%"><p><?= date("d/M/Y") ?></p></td>
                </tr>
            <?php
                break;
                }
            ?>
            </table>
            <!-- END TITLE -->

            <!-- CONTENT -->
            <table class="content" style="width:100%">
                <tr>
                    <td style="text-align:center;width:8%;padding-top:10px;">No.</td>
                    <td style="width:20%;padding-top:10px;">Kode Buku</td>
                    <td style="width:42%;padding-top:10px;">Judul Buku</td>
                    <td style="text-align:right;width:15%;padding-top:10px;">Tgl Pinjam</td>
                    <td style="text-align:right;width:15%;padding-top:10px;">Tgl Kembali</td>
                </tr>
                <?php
                $no = 1;
                    foreach ($peminjaman as $key => $value) {
                ?>
                <tr>
                    <td style="text-align:center;"><?= $no++ ?></td>
                    <td><?= $value->barcode_inventory ?></td>
                    <td><?= $value->judul_inventory ?></td>
                    <td style="text-align:right;"><?= date("d/M/Y", strtotime($value->tgl_peminjaman)) ?></td>
                    <td style="text-align:right;"><?= date("d/M/Y", strtotime($value->tgl_tempo_peminjaman)) ?></td>
                </tr>
                <?php
                    }
                }
                ?>
                <tr>
                    <td style="border:none"></td>
                    <td style="border:none"></td>
                    <td style="border:none"></td>
                    <td style="border:none;text-align:center;padding-top:10px;padding-bottom:50px;" colspan="2">Petugas,</td>
                </tr>
                <?php
                    foreach ($peminjaman as $value) {
                ?>
                <tr>
                    <td style="border:none"></td>
                    <td style="border:none"></td>
                    <td style="border:none"></td>
                    <td style="border:none;text-align:center;padding-top:10px;" colspan="2"><?= "( ".$value->nama_lengkap_admin." )" ?></td>
                </tr>
                <?php
                break;
                    }
                ?>
            </table>
            <!-- END CONTENT -->
        </div>
    </div>    
</body>
</html>