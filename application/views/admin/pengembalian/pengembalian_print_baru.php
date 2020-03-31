<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Bill Pengembalian</title>
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
            // var_dump($perpustakaan);
            // die;
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
                    <?php
                        foreach ($pengembalian as $key => $value) {
                    ?>
                    <td style="width:23%;">
                        <p><?= $value->nama_member ?></p>
                    </td>
                    <?php
                        break;
                        }
                    }
                    ?>
                </tr>
                <tr>
                    <td rowspan="2" style="padding:0.1cm 0cm"><p class="text-capitalize" style=""><?= $value2->alamat ?></p></td>
                    <td><p class="text-capitalize">no. anggota</p></td>
                    <td><p>:</p></td>
                    <?php
                        foreach ($pengembalian as $key => $value) {
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
                        foreach ($pengembalian as $key => $value) {
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
                    foreach ($pengembalian as $key => $value) {
                ?>
                <tr>
                    <td style="width:14%"><p>No. Transaksi :</p></td>
                    <td style="width:18%"><p><?= $value->id_transaksi_pengembalian ?></p></td>
                    <td style="text-align:center;width:48%"><p><b class="text-uppercase">bukti pengembalian buku</b></p></td>
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
                    <td style="text-align:center;width:5%;padding-top:10px;">No.</td>
                    <td style="width:12%;padding-top:10px;">Kode Buku</td>
                    <td style="width:25%;padding-top:10px;">Judul Buku</td>
                    <td style="text-align:right;width:10%;padding-top:10px;">Tgl Pinjam</td>
                    <td style="text-align:right;width:10%;padding-top:10px;">Tgl Kembali</td>
                    <td style="text-align:right;width:18%;padding-top:10px;">Tgl Dikembalikan</td>
                    <td style="text-align:right;width:10%;padding-top:10px;">Terlambat</td>
                    <td style="text-align:right;width:10%;padding-top:10px;">Denda</td>
                </tr>
                <?php
                    foreach ($pengembalian as $key => $value) {
                ?>
                <tr>
                    <td style="text-align:center;">1</td>
                    <td><?= $value->barcode_inventory ?></td>
                    <td><?= $value->judul_inventory ?></td>
                    <td style="text-align:right;"><?= date("d/M/Y", strtotime($value->tgl_peminjaman)) ?></td>
                    <td style="text-align:right;"><?= date("d/M/Y", strtotime($value->tgl_tempo)) ?></td>
                    <td style="text-align:right;"><?= date("d/M/Y", strtotime($value->tgl_pengembalian)) ?></td>
                    <td style="text-align:right;"><?= $value->selisih ?> hari</td>
                    <td style="text-align:right;">Rp<?= number_format(($value->jumlah_denda_telat+$value->total_denda_lain), 2, ',', '.') ?> </td>
                </tr>
                <?php
                    }
                ?>
                <tr>
                    <td style="border:none"></td>
                    <td style="border:none"></td>
                    <td style="border:none"></td>
                    <td style="border:none"></td>
                    <td style="border:none"></td>
                    <td style="border:none"></td>
                    <td style="border:none;text-align:center;padding-top:10px;padding-bottom:50px;" colspan="2">Petugas,</td>
                </tr>
                <?php
                    foreach ($pengembalian as $key => $value) {
                ?>
                <tr>
                    <td style="border:none"></td>
                    <td style="border:none"></td>
                    <td style="border:none"></td>
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