
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         Laporan peminjaman
          </h1>
		  <ul class="nav nav-tabs">
			  <li role="presentation"  ><a href="<?php echo base_url('index.php/laporan_peminjaman/'); ?>">Hari ini</a></li>
			  <li role="presentation" ><a href="<?php echo base_url('index.php/laporan_peminjaman/tanggal'); ?>">Tanggal</a></li>
			  <li role="presentation" ><a href="<?php echo base_url('index.php/laporan_peminjaman/bulan'); ?>">Bulan</a></li>
			  <li role="presentation" class="active"><a href="<?php echo base_url('index.php/laporan_peminjaman/tahun'); ?>">Tahun</a></li>
			</ul>
            
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Laporan peminjaman</li>
          </ol>
        </section>
			
			
			
   
					
               
            
        <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                 <h3 class="box-title">Laporan peminjaman per tahun </h3><p>
				<a href='<?php echo base_url('index.php/laporan_peminjaman/peminjaman_list_tahun_print');?>' target='_blank'  ><button class='btn btn-primary'> 
				 Print preview</button>
				 </a>
				  <p>
				 
			<?php 
				if(!isset($_GET['search_peminjaman_tahun'])) {
				$search_peminjaman_tahun="";
				}
				else {
				$search_peminjaman_tahun=$_GET['search_peminjaman_tahun'];
				}
			?>
			<?php
			if ($search_peminjaman_tahun<>''){
			?>
				<p>Hasil pencarian dengan keyword : <i><?php echo"$search_peminjaman_tahun";?></i>
			<?php
			}
			?>
                  <div class="box-tools">
				   <form action='<?php echo base_url('index.php/laporan_peminjaman/peminjaman_list_tahun');?>' method='get'>
                   <div class="input-group">
				   
                     <input type="number" name="search_peminjaman_tahun" value='<?php echo$this->session->userdata('search_peminjaman_tahun'); ?>' class="form-control input-sm pull-right" style="width: 150px;" placeholder="search"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						<?php 
						
						if ($this->session->userdata('search_peminjaman_tahun')!=''){
						?>
						<a href='<?php echo base_url('index.php/laporan_peminjaman/peminjaman_list_tahun?ref=all');?>'><i class="btn btn-sm btn-default"><i class="fa fa-remove"></i></i></a>
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
                        <th   align='right' style='width:5%; padding-right:15px;'>No</th>
                      <th  align='left' style=width:15%>Nama admin</th>
                      <th  align='left' style=width:15%>Member</th>
                      <th  align='left' style=width:30%>Inventory</th>
                      <th  align='left' style=width:14%>Tanggal</th>
                      <th align='left' style=width:14%>Jatuh Tempo</th>
                      <th align='right' style=width:5%>Status</th>
                    </tr>
                   <?php 
				$no = 0;
				if($dari < 1){ 
					$nodar = 1;
				}
				else{
					$nodar = $dari;
				} 
				foreach($peminjaman as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$nodar</td>
					<td style='vertical-align:middle'>$mn->nama_lengkap_admin</td>
					<td style='vertical-align:middle'>$mn->barcode_member</td>
					<td style='vertical-align:middle'>$mn->barcode_inventory</td>
					<td style='vertical-align:middle'>$mn->tgl_peminjaman</td>
					<td style='vertical-align:middle'>$mn->tgl_tempo_peminjaman</td>
					<td style='vertical-align:middle'>$mn->status_peminjaman</td>
					
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
			if(($dari < 0) && ($total >0)){ $dari = 1;} else {$dari = 0;} echo $dari." - ".$keee." dari "; echo $jumlah_peminjaman." data";
			?>
			</div>
			
			
			
             

            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
