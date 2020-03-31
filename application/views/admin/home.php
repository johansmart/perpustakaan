

  <link href="<?php echo base_url('assets/temp/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/temp/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url('assets/temp/dist/css/skins/_all-skins.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/temp/plugins/iCheck/flat/blue.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo base_url('assets/temp/plugins/morris/morris.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url('assets/temp/plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url('assets/temp/plugins/datepicker/datepicker3.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url('assets/temp/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url('assets/temp/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>" rel="stylesheet" type="text/css" />
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
			
			
        <!-- Main content -->
        <section class="content">
		 <!-- Small boxes (Stat box) -->
          <div class="row">
		   <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
				 <?php
				 $today=date('Y-m-d');
				$jumlah_absen_hariini = $this->db->query("select count(*) as jum_absen
				from tbl_kunjungan where tgl_kunjungan='$today' ")->row()->jum_absen;
					
				  echo " <h3>$jumlah_absen_hariini</h3>";
				   ?>
                  <p>Absen Kunjungan</p>
                </div>
                <div class="icon">
				
                  <i class="glyphicon glyphicon-text-background"></i>
                </div>
                <a href="<?php echo base_url('index.php/laporan_kunjungan');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			
			
          <!-- Small boxes (Stat box) -->
         
		   <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
				 <?php
				$jumlah_pinjam_hariini = $this->db->query("select count(*) as jum_pinjam
				from tbl_peminjaman where tgl_peminjaman='$today'")->row()->jum_pinjam;
					
				  echo " <h3>$jumlah_pinjam_hariini</h3>";
				   ?>
                  <p>Peminjaman</p>
                </div>
                <div class="icon">
				
                  <i class="glyphicon glyphicon-chevron-left"></i>
                </div>
                <a href="<?php echo base_url('index.php/peminjaman');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			
			 <!-- Small boxes (Stat box) -->
          
		   <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
				 <?php
				$jumlah_kembali_hariini = $this->db->query("select count(*) as jum_kembali
				from tbl_pengembalian where tgl_pengembalian='$today' ")->row()->jum_kembali;
					
				  echo " <h3>$jumlah_kembali_hariini</h3>";
				   ?>
                  <p>Pengembalian</p>
                </div>
                <div class="icon">
				
                  <i class="glyphicon glyphicon-chevron-right"></i>
                </div>
                <a href="<?php echo base_url('index.php/pengembalian');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			
			
			
		   <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
				 <?php
				$jumlah_denda_hariini = $this->db->query("select sum(denda_lainnya+jumlah_denda_telat) as jum_denda
				from tbl_pengembalian where tgl_pengembalian='$today' ")->row()->jum_denda;
					
				  echo " <h3>$jumlah_denda_hariini</h3>";
				   ?>
                  <p>Denda</p>
                </div>
                <div class="icon">
				
                  <i class="glyphicon glyphicon-usd"></i>
                </div>
                <a href="<?php echo base_url('index.php/laporan_denda');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			
			
			
			<!-- /.selesai -->
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            
       
            
     
        </section><!-- /.content -->
		
		   <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Peminjaman</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				<?php
				$tanggal_now = date('Y/m/d');
				$tgl_kemarin = mktime(0,0,0,date('m')+0,date('d')-1,date('Y')+0); 
				$tanggal_kemarin = date('Y/m/d',$tgl_kemarin);
				$bulan_ini=date('m');
				$tahun_ini=date('Y');
				
				$jumlah_pinjam_harikemarin= $this->db->query("select count(*) as jum_pinjam
				from tbl_peminjaman where tgl_peminjaman='$tanggal_kemarin'")->row()->jum_pinjam;
				
				$jumlah_pinjam_bulanini= $this->db->query("select count(*) as jum_pinjam
				from tbl_peminjaman where month(tgl_peminjaman)='$bulan_ini' and year(tgl_peminjaman)='$tahun_ini'")->row()->jum_pinjam;
				
				$jumlah_pinjam_tahunini= $this->db->query("select count(*) as jum_pinjam
				from tbl_peminjaman where year(tgl_peminjaman)='$tahun_ini'")->row()->jum_pinjam;
				
				
				?>
                <div class="box-body">

				
				<table class="table" width=100%>
					<tr>
						<td width=45%>Peminjaman kemarin
						<td width=10%>: 
						<td align='right' width=45%><?php echo"$jumlah_pinjam_harikemarin";?>
					<tr>
						<td>Peminjaman hari ini
						<td>: 
						<td align='right'><?php echo"$jumlah_pinjam_hariini";?>
					<tr>
						<td>Peminjaman bulan ini
						<td>: 
						<td align='right'><?php echo"$jumlah_pinjam_bulanini";?>
					<tr>
						<td>Peminjaman tahun ini
						<td>: 
						<td align='right'><?php echo"$jumlah_pinjam_tahunini";?>
					
				</table>
				</div>
              </div><!-- /.box -->
			  
			  <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Pengembalian</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				<?php
				$tanggal_now = date('Y/m/d');
				$tgl_kemarin = mktime(0,0,0,date('m')+0,date('d')-1,date('Y')+0); 
				$tanggal_kemarin = date('Y/m/d',$tgl_kemarin);
				$bulan_ini=date('m');
				$tahun_ini=date('Y');
				
				$jumlah_kembali_harikemarin= $this->db->query("select count(*) as jum_kembali
				from tbl_pengembalian where tgl_pengembalian='$tanggal_kemarin'")->row()->jum_kembali;
				
				$jumlah_kembali_bulanini= $this->db->query("select count(*) as jum_kembali
				from tbl_pengembalian where month(tgl_pengembalian)='$bulan_ini' and year(tgl_pengembalian)='$tahun_ini'")->row()->jum_kembali;
				
				$jumlah_kembali_tahunini= $this->db->query("select count(*) as jum_kembali
				from tbl_pengembalian where year(tgl_pengembalian)='$tahun_ini'")->row()->jum_kembali;
				
				
				?>
                <div class="box-body">

				
				<table class="table" width=100%>
					<tr>
						<td width=45%>Pengembalian kemarin
						<td width=10%>: 
						<td align='right' width=45%><?php echo"$jumlah_kembali_harikemarin";?>
					<tr>
						<td>pengembalian hari ini
						<td>: 
						<td align='right'><?php echo"$jumlah_kembali_hariini";?>
					<tr>
						<td>pengembalian bulan ini
						<td>: 
						<td align='right'><?php echo"$jumlah_kembali_bulanini";?>
					<tr>
						<td>pengembalian tahun ini
						<td>: 
						<td align='right'><?php echo"$jumlah_kembali_tahunini";?>
					
				</table>
				</div>
              </div><!-- /.box -->
			  
			  

            </div><!--/.col (left) -->
			
            <!-- right column -->
            <div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Denda</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				<?php
				$tanggal_now = date('Y/m/d');
				$tgl_kemarin = mktime(0,0,0,date('m')+0,date('d')-1,date('Y')+0); 
				$tanggal_kemarin = date('Y/m/d',$tgl_kemarin);
				$bulan_ini=date('m');
				$tahun_ini=date('Y');
				
				$jumlah_denda_harikemarin= $this->db->query("select sum(denda_lainnya+jumlah_denda_telat) as jum_denda
				from tbl_pengembalian where tgl_pengembalian='$tanggal_kemarin'")->row()->jum_denda;
				
				$jumlah_denda_bulanini= $this->db->query("select sum(denda_lainnya+jumlah_denda_telat) as jum_denda
				from tbl_pengembalian where month(tgl_pengembalian)='$bulan_ini' and year(tgl_pengembalian)='$tahun_ini'")->row()->jum_denda;
				
				$jumlah_denda_tahunini= $this->db->query("select sum(denda_lainnya+jumlah_denda_telat) as jum_denda
				from tbl_pengembalian where year(tgl_pengembalian)='$tahun_ini'")->row()->jum_denda;
				
				
				?>
                <div class="box-body">

				
				<table class="table" width=100%>
					<tr>
						<td width=45%>Denda kemarin
						<td width=10%>: 
						<td align='right' width=45% ><?php echo"$jumlah_denda_harikemarin";?>
					<tr>
						<td>Denda hari ini
						<td>: 
						<td align='right'><?php echo"$jumlah_denda_hariini";?>
					<tr>
						<td>Denda bulan ini
						<td>: 
						<td align='right'><?php echo"$jumlah_denda_bulanini";?>
					<tr>
						<td>Denda tahun ini
						<td>: 
						<td align='right'><?php echo"$jumlah_denda_tahunini";?>
					
				</table>
				</div>
              </div><!-- /.box -->
			  
			  <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Kunjungan</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				<?php
				$tanggal_now = date('Y/m/d');
				$tgl_kemarin = mktime(0,0,0,date('m')+0,date('d')-1,date('Y')+0); 
				$tanggal_kemarin = date('Y/m/d',$tgl_kemarin);
				$bulan_ini=date('m');
				$tahun_ini=date('Y');
				
				$jumlah_kunjungan_harikemarin= $this->db->query("select count(*) as jum_absen
				from tbl_kunjungan where tgl_kunjungan='$tanggal_kemarin'")->row()->jum_absen;
				
				$jumlah_kunjungan_hariini= $this->db->query("select count(*) as jum_absen
				from tbl_kunjungan where tgl_kunjungan='$today'")->row()->jum_absen;
				
				$jumlah_kunjungan_bulanini= $this->db->query("select count(*) as jum_absen
				from tbl_kunjungan where month(tgl_kunjungan)='$bulan_ini' and year(tgl_kunjungan)='$tahun_ini'")->row()->jum_absen;
				
				$jumlah_kunjungan_tahunini= $this->db->query("select count(*) as jum_absen
				from tbl_kunjungan where year(tgl_kunjungan)='$tahun_ini'")->row()->jum_absen;
				
				
				?>
                <div class="box-body">

				
				<table class="table" width=100%>
					<tr>
						<td width=45%>Kunjungan kemarin
						<td width=10%>: 
						<td align='right' width=45% ><?php echo"$jumlah_kunjungan_harikemarin";?>
					<tr>
						<td>Kunjungan hari ini
						<td>: 
						<td align='right'><?php echo"$jumlah_kunjungan_hariini";?>
					<tr>
						<td>Kunjungan bulan ini
						<td>: 
						<td align='right'><?php echo"$jumlah_kunjungan_bulanini";?>
					<tr>
						<td>Kunjungan tahun ini
						<td>: 
						<td align='right'><?php echo"$jumlah_kunjungan_tahunini";?>
					
				</table>
				</div>
              </div><!-- /.box -->
			  
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
		  
		  
		  
      </div><!-- /.content-wrapper -->
			
			