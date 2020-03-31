
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          category_inventory
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 <li><a href="<?php echo base_url('index.php/category_inventory');?>"></i> category_inventory</a></li>
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
                  <h3 class="box-title">Tambah category_inventory</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">category_inventory</label>
						<?php
						if(count($category_inventory->result_array())>0){
						foreach($category_inventory->result_array() as $ktg)
						{
				  
						?>
					  <form action='<?php echo base_url('index.php/category_inventory/category_inventory_edit_proses');?>' method='post'>
					   <?php
						echo'<input type="text"  name="id" value="'.$ktg['id_category_inventory'].'" hidden>';
						echo'<input type="text"  name="category_inventory_awal" value="'.$ktg['nama_category_inventory'].'" hidden>';
						
						?>
                      <input type='text' name='category_inventory' class='form-control'  value="<?php echo"".$ktg['nama_category_inventory'].""; ?>" id='exampleInputEmail1' placeholder='nama category_inventory'>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class='box-footer'>
                    <button type='submit' class='btn btn-primary'>Simpan</button>
					<a href='<?php echo base_url('index.php/category_inventory/');?>' class='btn btn-primary' title='batal atau kembali'><b>Batal</b></a>
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
