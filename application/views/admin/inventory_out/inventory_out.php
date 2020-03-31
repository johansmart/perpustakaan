
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         inventory_out
          </h1>
          <ol class="breadcrumb">
			<li>
		  	<a href="<?php echo base_url('index.php/inventory_out/inventory_outadd');?>">
					<button class="btn btn-primary"><span class="fa fa-plus"><font color=#ffffff> Tambah</font></span> </button></a>
			</li>
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> inventory_out</li>
          </ol>
        </section>
			
       
            
   
					
               
            
        <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data inventory_out</h3>
				   
				  <p>
				 
			<?php 
				if(!isset($_GET['search_inv_out'])) {
				$search_inv_out="";
				}
				else {
				$search_inv_out=$_GET['search_inv_out'];
				}
			?>
			<?php
			if ($search_inv_out<>''){
			?>
				<p>Hasil pencarian dengan keyword : <i><?php echo"$search_inv_out";?></i>
			<?php
			}
			?>
                  <div class="box-tools">
				   <form action='<?php echo base_url('index.php/inventory_out');?>' method='get'>
                   <div class="input-group">
                     <input type="text" name="search_inv_out" value='<?php echo$this->session->userdata('search_inv_out'); ?>' class="form-control input-sm pull-right" style="width: 150px;" placeholder="search_inv_out"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						<?php 
						
						if ($this->session->userdata('search_inv_out')!=''){
						?>
						<a href='<?php echo base_url('index.php/inventory_out?ref=all');?>'><i class="btn btn-sm btn-default"><i class="fa fa-remove"></i></i></a>
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
                      <th style=width:5%>id inv.</th>
                      <th style=width:20%>barcode inventory</th>
                      <th style=width:15%>nama inv.</th>
                      <th style=width:5%>tgl inv in</th>
                      <th style=width:5%>jumlah in</th>
                      <th style=width:10%>jenis in</th>
                      <th style=width:5%>tgl buku</th>
                      <th style=width:10%>admin</th>
                      <th style=width:15%>Action</th>
                    </tr>
                   <?php 
				$no = 0;
				if($dari < 1){ 
					$nodar = 1;
				}
				else{
					$nodar = $dari;
				} 
				foreach($inventory_out as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$nodar</td>
					<td style='vertical-align:middle'> $mn->id_inventory</td>
					<td style='vertical-align:middle'><img src='".base_url('index.php/barcode/gambar/'.$mn->barcode_inventory.'?height=80&width=1')."'></td>
					<td style='vertical-align:middle'> $mn->judul_inventory</td>
					<td style='vertical-align:middle'>$mn->tgl_inventory_out</td>
					<td style='vertical-align:middle'>$mn->jumlah_inventory_out</td>
					<td style='vertical-align:middle'>$mn->nama_jenis_out</td>
					<td style='vertical-align:middle'>$mn->tgl_buku_out</td>
					<td align ='center' style='vertical-align:middle'>$mn->nama_lengkap_admin</td>
					
					<td align='center' style='vertical-align:middle'>
					
		
					<a href=\"".base_url('index.php/inventory_out/inventory_out_cek?id='.$mn->id_inventory_out)."\">
					<button class=\"btn btn-primary\"><i class='glyphicon glyphicon-ok'></i></button></a>
					
					<a href=\"".base_url('index.php/inventory_out/inventory_out_edit?id='.$mn->id_inventory_out)."\">
					<button class=\"btn btn-primary\"><i class='glyphicon glyphicon-edit'></i></button></a>
					
					<a href=\"".base_url('index.php/inventory_out/inventory_out_delete?id='.$mn->id_inventory_out)."\">
					<button class=\"btn btn-danger\" onclick=\"return confirm('Yakin ingin menghapus?');\">
					<span class=\"glyphicon glyphicon-remove\"></span></button></a>
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
      
