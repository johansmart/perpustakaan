 <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
         
         
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo base_url("index.php/admin/"); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              
            </li>
			<li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-user"></i>
                <span>Admin</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("index.php/admin/useradmin_add"); ?>"><i class="fa fa-circle-o"></i>Tambah data admin</a></li>
				 <li><a href="<?php echo base_url("index.php/admin/user_admin"); ?>"><i class="fa fa-circle-o"></i>Data admin</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-file"></i>
                <span>Master Inventory - Buku</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo base_url("index.php/inventory"); ?>"><i class="fa fa-circle-o"></i>Inventory - Buku</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i>--</a></li>
				<li><a href="<?php echo base_url("index.php/category_inventory"); ?>"><i class="fa fa-circle-o"></i>Category buku</a></li>
				<li><a href="<?php echo base_url("index.php/bahasa"); ?>"><i class="fa fa-circle-o"></i>Bahasa</a></li>
				<li><a href="<?php echo base_url("index.php/penerbit"); ?>"><i class="fa fa-circle-o"></i>Penerbit</a></li>
				<li><a href="<?php echo base_url("index.php/pengarang"); ?>"><i class="fa fa-circle-o"></i>Pengarang</a></li>
				<li><a href="<?php echo base_url("index.php/letak_rak"); ?>"><i class="fa fa-circle-o"></i>Letak Rak</a></li>
				<li><a href="<?php echo base_url("index.php/klasifikasi"); ?>"><i class="fa fa-circle-o"></i>Klasifikasi</a></li>
				
              </ul>
            </li>
			 
			 <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-user"></i>
                <span>Master Member</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo base_url("index.php/member"); ?>"><i class="fa fa-circle-o"></i>Member</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i>--</a></li>
				<li><a href="<?php echo base_url("index.php/jenis_member"); ?>"><i class="fa fa-circle-o"></i>Jenis Member</a></li>
				
              </ul>
            </li>
			
			 <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-list-alt"></i>
                <span>Transaksi</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo base_url("index.php/peminjaman"); ?>"><i class="fa fa-circle-o"></i>Peminjaman</a></li>
				<li><a href="<?php echo base_url("index.php/pengembalian"); ?>"><i class="fa fa-circle-o"></i>Pengembalian</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i>--</a></li>
				<li><a href="<?php echo base_url("index.php/inventory_in"); ?>"><i class="fa fa-circle-o"></i>Inventory Buku In</a></li>
				<li><a href="<?php echo base_url("index.php/inventory_out"); ?>"><i class="fa fa-circle-o"></i>Inventory Buku Out</a></li>
				
              </ul>
            </li>
			
			 <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-th-large"></i>
                <span>Master Lainnya</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
			  <!--
				<li><a href="<?php echo base_url("index.php/guru"); ?>"><i class="fa fa-circle-o"></i>Guru</a></li>
				<li><a href="<?php echo base_url("index.php/agama"); ?>"><i class="fa fa-circle-o"></i>Agama</a></li>
				<li><a href="<?php echo base_url("index.php/mata_pelajaran"); ?>"><i class="fa fa-circle-o"></i>Mata Pelajaran</a></li>
				<li><a href="<?php echo base_url("index.php/propinsi"); ?>"><i class="fa fa-circle-o"></i>Propinsi</a></li>
				-->
				<li><a href="<?php echo base_url("index.php/kota"); ?>"><i class="fa fa-circle-o"></i>Kota</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i>--</a></li>
				<li><a href="<?php echo base_url("index.php/jenis_in"); ?>"><i class="fa fa-circle-o"></i>Jenis Inventory In</a></li>
				<li><a href="<?php echo base_url("index.php/jenis_out"); ?>"><i class="fa fa-circle-o"></i>Jenis Inventory Out</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i>--</a></li>
				<li><a href="<?php echo base_url("index.php/jenis_denda_lainnya"); ?>"><i class="fa fa-circle-o"></i>Jenis Denda Lainnya</a></li>
				
              </ul>
            </li>
			
			<li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-list-alt"></i>
                <span>Laporan</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo base_url("index.php/laporan_inventory"); ?>"><i class="fa fa-circle-o"></i>Lap. Inventory buku</a></li>
				<li><a href="<?php echo base_url("index.php/laporan_inventory_in"); ?>"><i class="fa fa-circle-o"></i>Lap. Inventory buku In </a></li>
				<li><a href="<?php echo base_url("index.php/laporan_inventory_out"); ?>"><i class="fa fa-circle-o"></i>Lap. Inventory buku Out</a></li>
				<li><a href="<?php echo base_url("index.php/laporan_member"); ?>"><i class="fa fa-circle-o"></i>Lap. Member</a></li>
				<li><a href="<?php echo base_url("index.php/laporan_peminjaman"); ?>"><i class="fa fa-circle-o"></i>Lap. Peminjaman</a></li>
				<li><a href="<?php echo base_url("index.php/laporan_pengembalian"); ?>"><i class="fa fa-circle-o"></i>Lap. Pengembalian</a></li>
				<li><a href="<?php echo base_url("index.php/laporan_denda"); ?>"><i class="fa fa-circle-o"></i>Lap. Denda</a></li>
				<li><a href="<?php echo base_url("index.php/laporan_kunjungan"); ?>"><i class="fa fa-circle-o"></i>Lap. Absen Kunjungan</a></li>
				
              </ul>
            </li>
			
			
			 <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-certificate"></i>
                <span>Setting</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo base_url("index.php/setting"); ?>"><i class="fa fa-circle-o"></i>Setting umum</a></li>
				
              </ul>
            </li>
			
			
		
			
           
        </section>
        <!-- /.sidebar -->
      </aside>