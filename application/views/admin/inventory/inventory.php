
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         inventory
          </h1>
          <ol class="breadcrumb">
			<li>
			<a href="" data-toggle="modal" data-target="#printFormModal">
				<button class="btn btn-primary"><span class="fa fa-print"><font color=#ffffff> Cetak</font></span> </button>
			</a>
			<!-- <a href="" data-toggle="modal" data-target="#printFormPcsModal">
				<button class="btn btn-primary"><span class="fa fa-print"><font color=#ffffff> Cetak/Buku</font></span> </button>
			</a> -->
		  	<a href="<?php echo base_url('index.php/inventory/inventory_add');?>">
					<button class="btn btn-primary"><span class="fa fa-plus"><font color=#ffffff> Tambah</font></span> </button></a>
			</li>
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> inventory</li>
          </ol>
        </section>

		<!-- Modal -->
		<!-- <div class="modal fade" id="printFormPcsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Pilih Inventory</h4>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url('index.php/inventory/multipleprint');?>" method="post" id="multiple-print-book-barcode">
				<input type="hidden" name="csrf_form" id="csrf_form" value="<?= $this->session->userdata('csrf_form'); ?>">
					<select class="" name="inventory" id="inventories" data-placeholder="Pilih Inventory"
                        style="width: 100%" required>
						<option value="">Pilih Buku</option>
						<?php
							foreach($inventory as $mn){
						?>
							<option value="<?= $mn->id_inventory; ?>"><?= $mn->judul_inventory.' - '.$mn->nama_category_inventory ?></option>
						<?php
							}
						?>
                    </select>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Cetak</button>
				</form>
			</div>
			</div>
		</div>
		</div> -->
		
		<!-- END MODAL -->
			
       <!-- Modal -->
		<div class="modal fade" id="printFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Pilih Inventory</h4>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url('index.php/inventory/multipleprint');?>" method="post" id="multiple-print-book-barcode">
				<input type="hidden" name="csrf_form" id="csrf_form" value="<?= $this->session->userdata('csrf_form'); ?>">
					<select class="select2inventory" name="inventories[]" id="inventories" data-placeholder="Pilih Inventory"
                        style="width: 100%" multiple="multiple" required>
						<option></option>
						<?php
							foreach($inventory as $mn){
						?>
							<option value="<?= $mn->id_inventory; ?>"><?= $mn->judul_inventory.' - '.$mn->nama_category_inventory ?></option>
						<?php
							}
						?>
                    </select>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Cetak</button>
				</form>
			</div>
			</div>
		</div>
		</div>
		
		<!-- END MODAL -->
            
        <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data inventory</h3>
					
					<?= $this->session->flashdata('result') ?>
				  <p>
				 
			<?php 
				if(!isset($_GET['search_inv'])) {
				$search_inv="";
				}
				else {
				$search_inv=$_GET['search_inv'];
				}
			?>
			<?php
			if ($search_inv<>''){
			?>
				<p>Hasil pencarian dengan keyword : <i><?php echo"$search_inv";?></i>
			<?php
			}
			?>
                  <div class="box-tools">
				   <form action='<?php echo base_url('index.php/inventory');?>' method='get'>
                   <div class="input-group">
                     <input type="text" name="search_inv" value='<?php echo$this->session->userdata('search_inv'); ?>' class="form-control input-sm pull-right" style="width: 150px;" placeholder="search_inv"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						<?php 
						
						if ($this->session->userdata('search_inv')!=''){
						?>
						<a href='<?php echo base_url('index.php/inventory?ref=all');?>'><i class="btn btn-sm btn-default"><i class="fa fa-remove"></i></i></a>
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
                      <th style=width:25%>Barcode</th>
                      <th style=width:10%>ISBN</th>
                      <th style=width:20%>Judul inventory</th>
                      <th style=width:10%>Kategori</th>
                      <th style=width:5%>Status</th>
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
				foreach($inventory as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$nodar</td>
					<td style='vertical-align:middle'><img src='".base_url('index.php/barcode/gambar/'.$mn->barcode_inventory.'?height=80&width=1')."'></td>
					<td style='vertical-align:middle'>$mn->ISBN</td>
					<td style='vertical-align:middle'>$mn->judul_inventory</td>
					<td style='vertical-align:middle'>$mn->nama_category_inventory</td>
					<td align ='center' style='vertical-align:middle'>$mn->status_inventory</td>
					
					<td align='center' style='vertical-align:middle'>
					
	
					<a href=\"".base_url('index.php/inventory/inventory_cek?id='.$mn->id_inventory)."\">
					<button class=\"btn btn-primary\"><i class='glyphicon glyphicon-ok'></i></button></a>
					
					<a href=\"".base_url('index.php/inventory/inventory_edit?id='.$mn->id_inventory)."\">
					<button class=\"btn btn-primary\"><i class='glyphicon glyphicon-edit'></i></button></a>
					
					<a href=\"".base_url('index.php/inventory/inventory_delete?id='.$mn->id_inventory)."\">
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
      


	<script>
	$(document).ready(function() {
		// ketika tombol detail ditekan
		$('.print_kartu').on("click", function(){
		// ambil nilai id dari link print
		var no_daftar= this.id;
		$("#MyModalBody").html('<iframe src="<?php echo base_url();?>index.php/pdf/kartu/'+no_daftar+'" frameborder="no" width="570" height="400"></iframe>');
		});	
	});
	
	</script>		
