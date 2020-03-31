
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          jenis_denda_lainnya
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 <li><a href="<?php echo base_url('index.php/jenis_denda_lainnya');?>"></i> jenis_denda_lainnya</a></li>
            <li class="active">Tambah</li>
          </ol>
        </section>
			
       
            
  
		  
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tambah jenis_denda_lainnya</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">jenis_denda_lainnya</label>
						<?php
						if(count($jenis_denda_lainnya->result_array())>0){
						foreach($jenis_denda_lainnya->result_array() as $ktg)
						{
				  
						?>
					  <form action='<?php echo base_url('index.php/jenis_denda_lainnya/jenis_denda_lainnya_edit_proses');?>' method='post'>
					   <?php
						echo'<input type="text"  name="id" value="'.$ktg['id_jenis_denda_lainnya'].'" hidden>';
						echo'<input type="text"  name="jenis_denda_lainnya_awal" value="'.$ktg['nama_jenis_denda_lainnya'].'" hidden>';
						
						?>
                      <input type='text' name='jenis_denda_lainnya' class='form-control'  value="<?php echo"".$ktg['nama_jenis_denda_lainnya'].""; ?>" id='exampleInputEmail1' placeholder='nama jenis_denda_lainnya'>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class='box-footer'>
                    <button type='submit' class='btn btn-primary'>Simpan</button>
					<a href='<?php echo base_url('index.php/jenis_denda_lainnya/');?>' class='btn btn-primary' title='batal atau kembali'><b>Batal</b></a>
					<?php
					}
					}
					?>
                  </div>
                </form>
				
              </div><!-- /.box -->

            </div><!--/.col (left) -->
			
           
          </div>   <!-- /.row -->
        </section><!-- /.content -->
		  
	  
      </div><!-- /.content-wrapper -->
