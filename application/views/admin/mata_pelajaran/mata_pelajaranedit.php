
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          mata_pelajaran
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 <li><a href="<?php echo base_url('index.php/mata_pelajaran');?>"></i> mata_pelajaran</a></li>
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
                  <h3 class="box-title">Tambah mata_pelajaran</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">mata_pelajaran</label>
						<?php
						if(count($mata_pelajaran->result_array())>0){
						foreach($mata_pelajaran->result_array() as $ktg)
						{
				  
						?>
					  <form action='<?php echo base_url('index.php/mata_pelajaran/mata_pelajaran_edit_proses');?>' method='post'>
					   <?php
						echo'<input type="text"  name="id" value="'.$ktg['id_mata_pelajaran'].'" hidden>';
						echo'<input type="text"  name="mata_pelajaran_awal" value="'.$ktg['nama_mata_pelajaran'].'" hidden>';
						
						?>
                      <input type='text' name='mata_pelajaran' class='form-control'  value="<?php echo"".$ktg['nama_mata_pelajaran'].""; ?>" id='exampleInputEmail1' placeholder='nama mata_pelajaran'>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class='box-footer'>
                    <button type='submit' class='btn btn-primary'>Simpan</button>
					<a href='<?php echo base_url('index.php/mata_pelajaran/');?>' class='btn btn-primary' title='batal atau kembali'><b>Batal</b></a>
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
