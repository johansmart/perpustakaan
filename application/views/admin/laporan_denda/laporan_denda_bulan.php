
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         Laporan Denda
          </h1>
		  <ul class="nav nav-tabs">
			  <li role="presentation"  ><a href="<?php echo base_url('index.php/laporan_denda/'); ?>">Hari ini</a></li>
			  <li role="presentation" ><a href="<?php echo base_url('index.php/laporan_denda/tanggal'); ?>">Tanggal</a></li>
			  <li role="presentation" class="active"><a href="<?php echo base_url('index.php/laporan_denda/bulan'); ?>">Bulan</a></li>
			  <li role="presentation" ><a href="<?php echo base_url('index.php/laporan_denda/tahun'); ?>">Tahun</a></li>
			</ul>
            
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Laporan Denda</li>
          </ol>
        </section>
			
			
			
   
				
				
            
         <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                 <h3 class="box-title">Laporan Denda per bulan </h3><p>
				<a href='<?php echo base_url('index.php/laporan_denda/denda_list_bulan_print');?>' target='_blank' ><button class='btn btn-primary'> 
				 Print preview</button>
				 </a>
				  <p>
				 
			<?php 
				if(!isset($_GET['search_denda_bulan'])&&!isset($_GET['search_denda_tahun'])) {
				$search_denda_bulan="";
				$search_denda_tahun="";
				}
				else {
				$search_denda_bulan=$_GET['search_denda_bulan'];
				$search_denda_tahun=$_GET['search_denda_tahun'];
				}
				
					$search_denda_bulan=$this->session->userdata('search_denda_bulan');
				if ($search_denda_bulan=='01'){
				$nama_bulan="Januari";
				}
				else if ($search_denda_bulan=='02'){
				$nama_bulan="Februari";
				}
				else if ($search_denda_bulan=='03'){
				$nama_bulan="Maret";
				}
				else if ($search_denda_bulan=='04'){
				$nama_bulan="April";
				}
				else if ($search_denda_bulan=='05'){
				$nama_bulan="Mei";
				}
				else if ($search_denda_bulan=='06'){
				$nama_bulan="Juni";
				}
				else if ($search_denda_bulan=='07'){
				$nama_bulan="Juli";
				}
				else if ($search_denda_bulan=='08'){
				$nama_bulan="Agustus";
				}
				else if ($search_denda_bulan=='09'){
				$nama_bulan="September";
				}
				else if ($search_denda_bulan=='10'){
				$nama_bulan="Oktober";
				}
				else if ($search_denda_bulan=='11'){
				$nama_bulan="November";
				}
				else if ($search_denda_bulan=='12'){
				$nama_bulan="Desember";
				}
			?>
			<?php
			if ($search_denda_bulan<>''){
			?>
				<p>Hasil pencarian dengan keyword : <i><?php echo"$nama_bulan
				 ".$this->session->userdata('search_denda_tahun')."";?></i>
			<?php
			}
			?>
                  <div class="box-tools">
				   <form action='<?php echo base_url('index.php/laporan_denda/denda_list_bulan');?>' method='get'>
                   <div class="input-group">
					
					<select name='search_denda_bulan' class='select' style='width:150px;'>
						
					<?php
						if(isset($_GET['search_denda_bulan'])&&isset($_GET['search_denda_tahun'])) {
					echo"	<option value='$search_denda_bulan'>$nama_bulan";
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
                     <input type="text" name="search_denda_tahun" value='<?php echo$this->session->userdata('search_denda_tahun'); ?>' class="form-control input-sm pull-right" style="width: 150px;" placeholder="tahun"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						<?php 
						
						if ($this->session->userdata('search_denda_bulan')!=''){
						?>
						<a href='<?php echo base_url('index.php/laporan_denda/denda_list_bulan?ref=all');?>'><i class="btn btn-sm btn-default"><i class="fa fa-remove"></i></i></a>
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
                       <th   align='right' style='width:10%; padding-right:15px;'>No</th>
                      <th  align='left' style=width:10%>Tanggal</th>
                      <th  align='left' style=width:10%>Nama admin</th>
                      <th  align='left' style=width:10%>No identitas member</th>
                      <th  align='left' style=width:15%>Nama member</th>
                      <th align='right' style=width:10%>Denda telat</th>
                      <th align='right' style=width:10%>Denda lain</th>
                      <th align='right' style=width:10%>total</th>
                    </tr>
                   <?php 
				$no = 0;
				if($dari < 1){ 
					$nodar = 1;
				}
				else{
					$nodar = $dari;
				} 
				foreach($denda as $mn){
				$total=$mn->denda_lainnya+$mn->jumlah_denda_telat;
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$nodar</td>
					<td style='vertical-align:middle'>$mn->tgl_pengembalian</td>
					<td style='vertical-align:middle'>$mn->nama_lengkap_admin</td>
					<td style='vertical-align:middle'>$mn->no_identitas_member</td>
					<td style='vertical-align:middle'>$mn->nama_member</td>
					<td align='right' style='vertical-align:middle'>$mn->jumlah_denda_telat</td>
					<td align='right' style='vertical-align:middle'>$mn->denda_lainnya</td>
					<td align='right' style='vertical-align:middle'>$total</td>
					
					</td>";
					echo "</tr>";
					$nodar++;
				}
			$total_semua_denda=$this->m_pengembalian->jumlah_list_dendatotal_bulan();
			echo"<tr><td align='right' colspan=7>Total semua<td align='right'>$total_semua_denda</td></tr>";
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
			if(($dari < 0) && ($total >0)){ $dari = 1;} else {$dari = 0;} echo $dari." - ".$keee." dari "; echo $jumlah_denda." data";
			?>
			</div>
			
			
			
             

            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
