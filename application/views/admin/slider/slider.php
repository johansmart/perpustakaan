
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
        slider
          </h1>
          <ol class="breadcrumb">
			<li>
		  	<a href="<?php echo base_url('index.php/slider/slider_add');?>">
					<button class="btn btn-primary"><span class="fa fa-plus"><font color=#ffffff> Tambah</font></span> </button></a>
			</li>
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> slider</li>
          </ol>
        </section>
			
       
            
   
					
               
            
        <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data slider</h3>
				   
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
				   <form action='<?php echo base_url('index.php/slider');?>' method='get'>
                   <div class="input-group">
                     <input type="text" name="search" value='<?php echo$this->session->userdata('search'); ?>' class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						<?php 
						
						if ($this->session->userdata('search')!=''){
						?>
						<a href='<?php echo base_url('index.php/slider?ref=all');?>'><i class="btn btn-sm btn-default"><i class="fa fa-remove"></i></i></a>
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
                      <th style=width:10%>Image slider</th>
                      <th style=width:15%>Nama slider</th>
                      <th style=width:15%>Status</th>
                      <th style=width:10%>Action</th>
                    </tr>
                   <?php 
				$no = 0;
				if($dari < 1){ 
					$nodar = 1;
				}
				else{
					$nodar = $dari;
				} 
				foreach($slider as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$nodar</td>
					<td style='vertical-align:middle'><img src=".base_url('assets/images/slider/'.$mn->image_slider.'')." width=150 ></td>
					<td style='vertical-align:middle'>$mn->nama_slider</td>
					<td style='vertical-align:middle'>$mn->status_slider</td>
					<td align='center' style='vertical-align:middle'>
					<a href=\"".base_url('index.php/slider/slider_edit?id='.$mn->id_slider)."\">
					<button class=\"btn btn-primary\"><i class='glyphicon glyphicon-edit'></i></button>
					<a href=\"".base_url('index.php/slider/slider_delete?id='.$mn->id_slider)."\">
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
      
