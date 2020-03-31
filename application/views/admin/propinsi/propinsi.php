
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            propinsi
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">propinsi</li>
          </ol>
        </section>
			
       
            
        <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Tabel propinsi</h3>
                  <div class="box-tools"> 
					<a href="<?php echo base_url('index.php/propinsi/propinsiadd');?>">
					<button class="btn btn-primary"><span class="fa fa-plus"><font color=#ffffff> Tambah</font></span> </button></a>
					
					<div class="input-group">
					
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr >
                      <th  style=width:15%>No</th>
                      <th  style=width:70%>Nama</th>
                      <th  style=width:15%>Action</th>
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
					foreach($propinsi as $ktg){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$nodar</td>
					<td style='vertical-align:middle'>$ktg->nama_propinsi</td>
					
					<td align='center' style='vertical-align:middle'>
					<a href=\"".base_url('index.php/propinsi/propinsi_edit?id='.$ktg->id_propinsi)."\">
					<button class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-pencil\"></span></button></a>
					<a href=\"".base_url('index.php/propinsi/propinsi_delete?id='.$ktg->id_propinsi)."\">
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
      
