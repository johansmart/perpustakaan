
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         Laporan member
          </h1>
		    <ul class="nav nav-tabs">
			  <li role="presentation" class="active" ><a href="<?php echo base_url('index.php/laporan_member/'); ?>">Data Member</a></li>
			  <li role="presentation" ><a href="<?php echo base_url('index.php/laporan_member/memberaktivitas'); ?>">Aktivitas Member</a></li>
			</ul>
          <ol class="breadcrumb">
			<li>
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> member</li>
          </ol>
        </section>
			
       
            
   
					
               
            
        <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data member</h3>
				  <p>
				   <a href='<?php echo base_url('index.php/laporan_member/member_print');?>' target='_blank' ><button class='btn btn-primary'> 
				 Print preview</button>
				 </a>
				  <p>
				 
			<?php 
				if(($this->session->userdata('search_mmbr')=='')) {
				$search_mmbr="";
				}
				else {
				$search_mmbr=$this->session->userdata('search_mmbr');
				}
			?>
			<?php
			if ($search_mmbr<>''){
			?>
				<p>Hasil pencarian dengan keyword : <i><?php echo"$search_mmbr";?></i>
			<?php
			}
			?>
                  <div class="box-tools">
				   <form action='<?php echo base_url('index.php/laporan_member');?>' method='get'>
                   <div class="input-group">
                     <input type="text" name="search_mmbr" value='<?php echo$this->session->userdata('search_mmbr'); ?>' class="form-control input-sm pull-right" style="width: 150px;" placeholder="search_mmbr"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						<?php 
						
						if ($this->session->userdata('search_mmbr')!=''){
						?>
						<a href='<?php echo base_url('index.php/laporan_member?ref=all');?>'><i class="btn btn-sm btn-default"><i class="fa fa-remove"></i></i></a>
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
                      <th style=width:20%>Barcode</th>
                      <th style=width:10%>No Identitas</th>
                      <th style=width:20%>Nama member</th>
                      <th style=width:10%>Jenis</th>
                      <th style=width:5%>JK</th>
                      <th style=width:25%>TTL</th>
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
					<td style='vertical-align:middle'>$mn->no_identitas_member</td>
					<td style='vertical-align:middle'>$mn->nama_member</td>
					<td style='vertical-align:middle'>$mn->nama_jenis_member</td>
					<td style='vertical-align:middle'>$mn->jenis_kelamin_member</td>
					<td align ='left' style='vertical-align:middle'>$mn->nama_kota, $mn->tanggal_lahir_member</td>
					
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
