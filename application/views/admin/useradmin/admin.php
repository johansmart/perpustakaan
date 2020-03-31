
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Admin</li>
          </ol>
        </section>
			
       
            
        <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Tabel Admin</h3>
                  <div class="box-tools">
					<a href="<?php echo base_url('index.php/admin/useradmin_add');?>">
					<button class="btn btn-primary"><span class="fa fa-plus"><font color=#ffffff> Tambah</font></span> </button></a>
					
                    <div class="input-group">
					
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>No</th>
                      <th>Email</th>
                      <th>Username</th>
                      <th>Nama</th>
                      <th>Action</th>
                    </tr>
                    <tr>
					   <?php 
				$no = 0;
				if($dari < 1){ 
					$nodar = 1;
				}
				else{
					$nodar = $dari;
				} 
				foreach($admin as $adm){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$nodar</td>
					<td style='vertical-align:middle'>$adm->email_admin</td>
					<td style='vertical-align:middle'>$adm->username_admin</td>
					<td style='vertical-align:middle'>$adm->nama_lengkap_admin</td>
					<td style='vertical-align:middle'>$adm->jenis_admin</td>
					<td align ='center' style='vertical-align:middle'>$adm->status_admin</td>
					
					<td align='center' style='vertical-align:middle'>
					<a href=\"".base_url('index.php/admin/useradmin_edit?id='.$adm->id_admin)."\">
					<button class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-pencil\"></span></button>
					<a href=\"".base_url('index.php/admin/useradmin_delete?id='.$adm->id_admin)."\">
					<button class=\"btn btn-danger\" onclick=\"return confirm('Yakin ingin menghapus?');\"><span class=\"glyphicon glyphicon-trash\"></span></button></a>
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
			//echo current_url();
			echo "Menampilkan ";
			if(($dari < 0) && ($total >0)){ $dari = 1;} else {$dari = 0;} echo $dari." - ".$keee." dari "; echo $total." data";
			?>
			</div>
			
			
                </div><!-- /.box-body -->
              </div><!-- /.box -->

			
			
			
             

            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
