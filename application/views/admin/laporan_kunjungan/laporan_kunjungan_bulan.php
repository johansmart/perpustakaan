
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         kunjungan
          </h1>
		  <ul class="nav nav-tabs">
			  <li role="presentation"  ><a href="<?php echo base_url('index.php/laporan_kunjungan/'); ?>">Hari ini</a></li>
			  <li role="presentation" ><a href="<?php echo base_url('index.php/laporan_kunjungan/tanggal'); ?>">Tanggal</a></li>
			  <li role="presentation" class="active"><a href="<?php echo base_url('index.php/laporan_kunjungan/bulan'); ?>">Bulan</a></li>
			  <li role="presentation" ><a href="<?php echo base_url('index.php/laporan_kunjungan/tahun'); ?>">Tahun</a></li>
			</ul>
            
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> kunjungan</li>
          </ol>
        </section>
			
			
			
   
					
               
            
        <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                 <h3 class="box-title">Kunjungan per bulan </h3><p>
				<a href='<?php echo base_url('index.php/laporan_kunjungan/kunjungan_list_bulan_print');?>'  ><button class='btn btn-primary'> 
				 Print preview</button>
				 </a>
				  <p>
				 
			<?php 
				if(!isset($_GET['search_kunjungan_bulan'])&&!isset($_GET['search_kunjungan_tahun'])) {
				$search_kunjungan_bulan="";
				$search_kunjungan_tahun="";
				}
				else {
				$search_kunjungan_bulan=$_GET['search_kunjungan_bulan'];
				$search_kunjungan_tahun=$_GET['search_kunjungan_tahun'];
				}
				
					$search_kunjungan_bulan=$this->session->userdata('search_kunjungan_bulan');
				if ($search_kunjungan_bulan=='01'){
				$nama_bulan="Januari";
				}
				else if ($search_kunjungan_bulan=='02'){
				$nama_bulan="Februari";
				}
				else if ($search_kunjungan_bulan=='03'){
				$nama_bulan="Maret";
				}
				else if ($search_kunjungan_bulan=='04'){
				$nama_bulan="April";
				}
				else if ($search_kunjungan_bulan=='05'){
				$nama_bulan="Mei";
				}
				else if ($search_kunjungan_bulan=='06'){
				$nama_bulan="Juni";
				}
				else if ($search_kunjungan_bulan=='07'){
				$nama_bulan="Juli";
				}
				else if ($search_kunjungan_bulan=='08'){
				$nama_bulan="Agustus";
				}
				else if ($search_kunjungan_bulan=='09'){
				$nama_bulan="September";
				}
				else if ($search_kunjungan_bulan=='10'){
				$nama_bulan="Oktober";
				}
				else if ($search_kunjungan_bulan=='11'){
				$nama_bulan="November";
				}
				else if ($search_kunjungan_bulan=='12'){
				$nama_bulan="Desember";
				}
			?>
			<?php
			if ($search_kunjungan_bulan<>''){
			?>
				<p>Hasil pencarian dengan keyword : <i><?php echo"$nama_bulan
				 ".$this->session->userdata('search_kunjungan_tahun')."";?></i>
			<?php
			}
			?>
                  <div class="box-tools">
				   <form action='<?php echo base_url('index.php/laporan_kunjungan/kunjungan_list_bulan');?>' method='get'>
                   <div class="input-group">
					
					<select name='search_kunjungan_bulan' class='select' style='width:150px;'>
						
					<?php
						if(isset($_GET['search_kunjungan_bulan'])&&isset($_GET['search_kunjungan_tahun'])) {
					echo"	<option value='$search_kunjungan_bulan'>$nama_bulan";
					}
					else {
					}
					?>
					<option value='01'>Januari
					<option value='02'>februari
					<option value='03'>maret
					<option value='04'>april
					<option value='05'>mei
					<option value='06'>Juni
					<option value='07'>Juli
					<option value='08'>Agustus
					<option value='09'>September
					<option value='10'>Oktober
					<option value='11'>November
					<option value='12'>Desember
					</select>
					 <div class="input-group">
                     <input type="text" name="search_kunjungan_tahun" value='<?php echo$this->session->userdata('search_kunjungan_tahun'); ?>' class="form-control input-sm pull-right" style="width: 150px;" placeholder="tahun"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						<?php 
						
						if ($this->session->userdata('search_kunjungan_bulan')!=''){
						?>
						<a href='<?php echo base_url('index.php/laporan_kunjungan/kunjungan_list_bulan?ref=all');?>'><i class="btn btn-sm btn-default"><i class="fa fa-remove"></i></i></a>
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
                      <th style=width:10%>No</th>
                      <th style=width:25%>Tanggal</th>
                      <th style=width:25%>No identitas member</th>
                      <th style=width:25%>Nama member</th>
                    </tr>
                   <?php 
				$no = 0;
				if($dari < 1){ 
					$nodar = 1;
				}
				else{
					$nodar = $dari;
				} 
				foreach($kunjungan as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$nodar</td>
					<td style='vertical-align:middle'>$mn->tgl_kunjungan</td>
					<td style='vertical-align:middle'>$mn->no_identitas_member</td>
					<td style='vertical-align:middle'>$mn->nama_member</td>
					
					</td>";
					echo "</tr>";
					$nodar++;
				}
			echo "</table>";
			echo "<center>$paging</center>";
			?>
			<div class="col-lg-8 form-inline">
			
			
			<?php 
				$page_url=current_url();
				$pag = $this->db->query("select paging from set_paging")->row()->paging;?>
			<form class="form-group" method="post" action="<?php echo base_url('index.php/paging/ubahpaging?url='.$page_url.'');?>">
				<select name ="paginge" class="form-control" style="width:70px" onchange="this.form.submit()">
					<option <?php if($pag == 5){echo 'selected = \"selected\" ';}?> value = "5">5</option>
					<option <?php if($pag == 10){echo 'selected = \"selected\" ';}?> value = "10">10</option>
					<option <?php if($pag == 25){echo 'selected = \"selected\" ';}?> value = "25">25</option>
					<option <?php if($pag == 50){echo 'selected = \"selected\" ';}?> value = "50">50</option>
					<option <?php if($pag == 100){echo 'selected = \"selected\" ';}?> value = "100">100</option>
					<option <?php if($pag == 200){echo 'selected = \"selected\" ';}?> value = "200">200</option>
				</select>
			</form>

			<?php
			
			echo "Menampilkan ";
			if(($dari < 0) && ($total >0)){ $dari = 1;} else {$dari = 0;} echo $dari." - ".$keee." dari "; echo $total." data";
			?>
			</div>
			
			
			
             

            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
