
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         kunjungan
          </h1>
		  <ul class="nav nav-tabs">
			  <li role="presentation" class="active" ><a href="<?php echo base_url('index.php/laporan_kunjungan/'); ?>">Hari ini</a></li>
			  <li role="presentation" ><a href="<?php echo base_url('index.php/laporan_kunjungan/tanggal'); ?>">Tanggal</a></li>
			  <li role="presentation" ><a href="<?php echo base_url('index.php/laporan_kunjungan/bulan'); ?>">Bulan</a></li>
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
                 <h3 class="box-title">Kunjungan hari ini [ <?php $today=date('D d F Y '); echo"$today";?> ]</h3><p>
				<a href='<?php echo base_url('index.php/laporan_kunjungan/kunjungan_list_hari_ini_print');?>'  ><button class='btn btn-primary'> 
				 Print preview</button>
				 </a>
				   
				  <p>
				 
			<?php 
				if(!isset($_GET['search_kunjungan'])) {
				$search_kunjungan="";
				}
				else {
				$search_kunjungan=$_GET['search_kunjungan'];
				}
			?>
			<?php
			if ($search_kunjungan<>''){
			?>
				<p>Hasil pencarian dengan keyword : <i><?php echo"$search_kunjungan";?></i>
			<?php
			}
			?>
                  <div class="box-tools">
				   <form action='<?php echo base_url('index.php/laporan_kunjungan/kunjungan_list_hari_ini');?>' method='get'>
                   <div class="input-group">
                     <input type="text" name="search_kunjungan" value='<?php echo$this->session->userdata('search_kunjungan'); ?>' class="form-control input-sm pull-right" style="width: 150px;" placeholder="search"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						<?php 
						
						if ($this->session->userdata('search_kunjungan')!=''){
						?>
						<a href='<?php echo base_url('index.php/laporan_kunjungan?ref=all');?>'><i class="btn btn-sm btn-default"><i class="fa fa-remove"></i></i></a>
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
      
