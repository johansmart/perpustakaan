<?php 
include "include/config.php";
include "include/head.php";
include "include/header.php";
include "include/sidebar.php";
?>

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
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
              <div class="small-box bg-gray">
                <div class="inner">
                  <h3>10</h3>
                  <p>Admin</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			
			
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>10</h3>
                  <p>Menu</p>
                </div>
                <div class="icon">
                 <i class="fa fa-files-o"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>10</h3>
                  <p>Member</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>10</h3>
                  <p>Saran</p>
                </div>
                <div class="icon">
                  <i class="glyphicon glyphicon-comment"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			
          <!-- <div class="col-lg-3 col-xs-6">
              <!-- small box -->
            <!--  <div class="small-box bg-red">
                <div class="inner">
                  <h3>10 member</h3>
                  <p>Visitors</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
			<!-- ./col -->
			
			
			
			
			
			
			
			
			<!-- /.selesai -->
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            
       
            
        <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pesanan Baru</h3><p>
				  
			
                  <div class="box-tools">
				   <form action='index.php' method='get'>
                   <div class="input-group">
                      <input type="text" name="search" value='cari' class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						<?php 
						if ($search<>''){
						?>
						<a href='index.php'><i class="btn btn-sm btn-default"><i class="fa fa-remove"></i></i></a>
						<?php 
						}
						?>
					  </div>
                    </div>
                  </div>
					  </form>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th style=width:5%>No</th>
                      <th style=width:10%>Id pesanan</th>
                      <th style=width:10%>Tanggal</th>
                      <th style=width:15%>Nama</th>
                      <th style=width:10%>Total</th>
                      <th style=width:10%>No hp</th>
                      <th style=width:15%>Alamat</th>
                      <th style=width:15%>Kota</th>
                      <th style=width:10%>Status</th>
                      <th style=width:10%>Action</th>
                    </tr>
                    <tr>
						<td>1
						<td>id
						<td>tanggal
						<td>nama
						<td>total
						<td>no hp
						<td>alamat
						<td>kota
						<td>status
						<td>action
                    <tr>
						<td>1
						<td>id
						<td>tanggal
						<td>nama
						<td>total
						<td>no hp
						<td>alamat
						<td>kota
						<td>status
						<td>action
                    <tr>
						<td>1
						<td>id
						<td>tanggal
						<td>nama
						<td>total
						<td>no hp
						<td>alamat
						<td>kota
						<td>status
						<td>action
						
					</table>
              </div><!-- /.box -->
				<center>
				<ul class='pagination'>
				<li><a href="http://localhost/ci_sistempakarv2/index.php/admin/dashboard/">&lt;</a>
				<li><a href="http://localhost/ci_sistempakarv2/index.php/admin/dashboard/">1</a>
				</li>
				<li class='disabled'>
				<li class='active'><a href='#'>2<span class='sr-only'></span></a></li>
				</ul>
				</center>
				</center>
			
			</div>
			<div class="col-lg-8 form-inline">
			
			
			<form class="form-group" method="post" action="">
				<select name ="paginge" class="form-control" style="width:70px" onchange="this.form.submit()">
					<option  value = "5">5</option>
					<option value = "10">10</option>
					<option  value = "25">25</option>
					<option  value = "50">50</option>
					<option  value = "100">100</option>
					<option  value = "200">200</option>
				</select>
			</form>

			
			Menampilkan 5 dari 1 data
			
			</div>
			
			
			
             

            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
<?php 
include "include/footer.php";
include "include/tabpanes.php";
?>