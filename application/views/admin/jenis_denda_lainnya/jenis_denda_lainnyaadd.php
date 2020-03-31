
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
					
					  <form action='<?php echo base_url('index.php/jenis_denda_lainnya/jenis_denda_lainnyaadd_proses');?>' method='post'>
					   
                      <input type='text' name='jenis_denda_lainnya' class='form-control'  value='' id='exampleInputEmail1' placeholder='nama jenis_denda_lainnya'>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class='box-footer'>
                    <button type='submit' class='btn btn-primary'>Simpan</button>
					<a href='<?php echo base_url('index.php/jenis_denda_lainnya/');?>' class='btn btn-primary' title='batal atau kembali'><b>Batal</b></a>
              
                  </div>
                </form>
				
              </div><!-- /.box -->

            </div><!--/.col (left) -->
			
           
          </div>   <!-- /.row -->
        </section><!-- /.content -->
		  
	  
      </div><!-- /.content-wrapper -->
