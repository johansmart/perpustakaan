<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member Card</title>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url('assets/temp/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	  <link href="<?php echo base_url('assets/temp/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/temp/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
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
        padding: 1cm;
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

    .member-card-multiple{
        border-radius:0.2cm;
    }

    .top-column{
        padding-top:0.5cm;
        padding-bottom:0.2cm;
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
</style>
<body style="font-family:Arial Bold, Arial,'Times New Roman';">
    <div class="book">
        <div class="page">
            <div class="subpage">
                <h3 style="text-align:center;margin-block-start:0px">Daftar Member</h3>
                <?php
                    $no = 1;
                    foreach ($members as $key => $member) {
                        $jenis_kelamin = $member['jenis_kelamin_member'] == 'L' ? 'Laki-laki' : 'Perempuan';
                        if ($no % 5 == 0) {
                            echo 
                            '</div>
                        </div>
                        <div class="page">
                            <div class="subpage">
                            ';
                        }
                ?>
                <h4><?= $no++.'. '.$member['nama_member'] ?></h4>
                <div class="row" style="width:240px;height:149px;border-radius:0.3cm;overflow:hidden;padding:0px;margin:0.2cm;display:inline-block">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="position:absolute;width:240px;height:149px;border-radius:0.3cm;overflow:hidden;padding:0px;z-index:3">
                            <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;padding-left:0.5cm;padding-right:0.5cm;">
                                <div class="col-lg-1 col-md-1 col-sm-1" style="text-align:right">
                                    &nbsp
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1" style="text-align:left;padding-top:0.2cm;padding-left:0.1cm">
                                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="logo-member" style="width:0.5cm;text-align:right">
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7" style="text-align:center;padding:0cm;margin-left:0cm;padding-left:0.3cm">
                                    <h5 class="text-uppercase text-white" style="font-size:3pt;margin-block-end:0cm">kartu tanda anggota</h5>
                                    <h4 class="text-white text-uppercase" style="font-size:6pt;margin-block-start:0.05cm;margin-block-end:0cm;margin-block-start:0cm">perpustakaan megazus</h4>
                                    <p class="text-white" style="font-size:3pt;">Jl. Lurus Dusun Grogol Lamongan</p>
                                </div>
                            </div>
                            <table style="margin-left:0.6cm;font-size:6pt;width:210px;">
                                <tr>
                                    <td style="width:26%;">No. Identitas</td>
                                    <td style="width:3%;">:</td>
                                    <td style="width:50%;"><?= $member['no_identitas_member'] ?></td>
                                    <td rowspan="8">
                                        <img src="<?= base_url('assets/images/member/'.$member['photo_member'].'') ?>" alt="" width="43" height="57">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:60px">Nama</td>
                                    <td style="width:8px">:</td>
                                    <td><?= $member['nama_member'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width:60px">JK</td>
                                    <td style="width:8px">:</td>
                                    <td><?= $jenis_kelamin ?></td>
                                </tr>
                                <tr>
                                    <td style="width:60px">TTL</td>
                                    <td style="width:8px">:</td>
                                    <td><?= $member['tanggal_lahir_member'] ?></td>
                                </tr>
                            </table>
                            <img src="<?= base_url('index.php/barcode/gambar/'.$member['barcode_member'].'?height=23&width=1') ?>" alt="" style="margin-left:0.7cm;margin-top:0.1cm">
                            <div style="font-size:5pt;position:absolute;right:0.2cm;bottom:0.7cm;width:1.2cm;text-align:center;">
                                <span>exp. card</span>
                                <span><?= $member['exp_card_member'] ?></span>
                            </div>
                        </div>
                    <div class="col-lg-12 col-md-12 col-sm-12" style="width:240px;height:149px;border-radius:0.3cm;overflow:hidden;padding:0px">
                        <img src="<?= base_url('assets/images/uk_kta_depan_2.png') ?>" alt="" style="width:241px;height:150px;">
                    </div>
                </div>
                <div class="row" style="width:240px;height:149px;border-radius:0.3cm;overflow:hidden;padding:0px;margin:0.2cm;display:inline-block">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="position:absolute;width:240px;height:149px;border-radius:0.3cm;overflow:hidden;padding:0px;z-index:3">
                        <div><h5 class="text-white" style="margin-block-start:0.1cm;text-align:center">PERHATIAN</h5></div>
                        <table class="text-white" style="font-size:5pt">
                            <tr><td colspan='3'><br></td></tr>
                            <tr><td class="text-white" valign='baseline' style='padding-left:2em'>1.<td class="text-white" colspan='3' valign='baseline' style='padding-right:1em'>Kartu ini adalah kartu tanda anggota perpustakaan mezagus</td></tr>
                            <tr><td class="text-white" valign='baseline' style='padding-left:2em'>2.<td class="text-white" colspan='3' valign='baseline' style='padding-right:1em'>Kartu ini berlaku selama menjadi member</td></tr>
                            <tr><td class="text-white" valign='baseline' style='padding-left:2em'>3.<td class="text-white" colspan='3' valign='baseline' style='padding-right:1em'>Apabila kartu ini hilang, harap segera melapor ke perpustakaan mezagus</td></tr>
                            <tr><td class="text-white" valign='baseline' style='padding-left:2em'>4.<td class="text-white" colspan='3' valign='baseline' style='padding-right:1em'>Apabila menemukan kartu ini harap segera mengembalikan ke perpustakaan mezagus</td></tr>
                            <tr><td class="text-white" colspan='3'><br></td></tr>
                            <tr><td class="text-white" colspan='3'><br></td></tr>
                        </table>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12" style="width:240px;height:149px;border-radius:0.3cm;overflow:hidden;padding:0px">
                        <img src="<?= base_url('assets/images/uk_kta_belakang.png') ?>" alt="" style="width:241px;height:150px;">
                    </div>
                </div>

                <?php
                    }
                ?>
                
            </div>    
        </div>

    </div>

</body>
</html>