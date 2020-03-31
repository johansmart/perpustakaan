
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<?= $this->session->flashdata('result'); ?>
          <h1>
         member
          </h1>
          <ol class="breadcrumb">
			<li>
				<a href="" data-toggle="modal" data-target="#myModal">
					<button class="btn btn-primary"><span class="fa fa-print"><font color=#ffffff> Cetak</font></span> </button></a>
		  	<a href="<?php echo base_url('index.php/member/member_add');?>">
					<button class="btn btn-primary"><span class="fa fa-plus"><font color=#ffffff> Tambah</font></span> </button></a>
			</li>
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> member</li>
          </ol>
		</section>
		
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Pilih Member</h4>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url('index.php/member/multipleprint');?>" method="post" id="multiple-print-member-barcode">
				<input type="hidden" name="csrf_form" id="csrf_form" value="<?= $csrf_form; ?>">
					<select class="select2" name="members[]" id="members" data-placeholder="Pilih Member"
                        style="width: 100%" multiple="multiple" required>
						<option></option>
						<?php
						foreach($member as $mn){
							echo '<option value="'.$mn->id_member.'">'.$mn->nama_member.' - '. $mn->nama_jenis_member .'</option>';
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
			
       
            
   
					
               
            
        <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data member</h3>
				   
				  <p>
				 
			<?php 
				if(!isset($_GET['search'])) {
				$search="";
				}
				else {
				$search=$_GET['search'];
				}
			?>
			<?php
			if ($search<>''){
			?>
				<p>Hasil pencarian dengan keyword : <i><?php echo"$search";?></i>
			<?php
			}
			?>
                  <div class="box-tools">
				   <form action='<?php echo base_url('index.php/member');?>' method='get'>
                   <div class="input-group">
                     <input type="text" name="search" value='<?php echo$this->session->userdata('search'); ?>' class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						<?php 
						
						if ($this->session->userdata('search')!=''){
						?>
						<a href='<?php echo base_url('index.php/member?ref=all');?>'><i class="btn btn-sm btn-default"><i class="fa fa-remove"></i></i></a>
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
                      <th style=width:20%>Nama member</th>
                      <th style=width:10%>Jenis</th>
                      <th style=width:10%>Status</th>
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
				foreach($member as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$nodar</td>
					<td style='vertical-align:middle'><img src='".base_url('index.php/barcode/gambar/'.$mn->barcode_member.'?height=80&width=1')."'></td>
					<td style='vertical-align:middle'>$mn->nama_member</td>
					<td style='vertical-align:middle'>$mn->nama_jenis_member</td>
					<td align ='center' style='vertical-align:middle'>$mn->status_member</td>
					
					<td align='center' style='vertical-align:middle'>
		
		
					<a href=\"".base_url('index.php/member/member_cek?id='.$mn->id_member)."\">
					<button class=\"btn btn-primary\"><i class='glyphicon glyphicon-ok'></i></button></a>
					
					<a href=\"".base_url('index.php/member/member_edit?id='.$mn->id_member)."\">
					<button class=\"btn btn-primary\"><i class='glyphicon glyphicon-edit'></i></button></a>
					
					<a href=\"".base_url('index.php/member/member_delete?id='.$mn->id_member)."\">
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
