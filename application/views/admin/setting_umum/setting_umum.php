
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          setting_umum
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 
            <li class="active">setting_umum</li>
          </ol>
        </section>
		
		  
        <!-- Main content -->
        <section class="content">
          <div class="row">
          <!-- Library form -->

          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header">
                <h4 class="text-capitalize">Pengaturan Perpustakaan</h4>
                <?= $this->session->flashdata('result'); ?>
              </div>
              <div class="box-body">
                <form action="<?= base_url('index.php/setting/inputlibraryinfo') ?>" method="post" enctype="multipart/form-data">
                  <?php
                    foreach ($information as $key => $value) {
                  ?>
                  <div class="form-group">
                    <label for="libraryname">Nama Perpustakaan</label>
                    <input type="hidden" name="libraryid" value="<?= $value['id'] ?>" required>
                    <input type="text" class="form-control" id="libraryname" placeholder="Library's name" name="libraryname" value="<?= $value['nama'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="<?= $value['alamat'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="handphone">Nomor Telepon</label>
                    <input type="text" class="form-control" id="handphone" placeholder="Phone's Number" name="handphone" value="<?= $value['telepon'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="profile">Profile</label>
                    <textarea type="text" class="form-control" id="profile" placeholder="Profile" name="profile"><?= $value['profile'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="librarylogo">Logo</label>
                      <input type="file" id="librarylogo" name="librarylogo" accept=".jpg,.png,.jpeg,.svg">
                      <p class="help-block">Format : .jpg | .jpeg | .png | .svg</p>
                  </div>
                  <?php
                    }
                  ?>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- End Library form -->
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Denda (Rp.)</label>
				<?php
				if(count($setting)>0){
					foreach($setting as $setting_umum)
					{				
					  echo"
					  <form action='".base_url('index.php/setting/setting_umum_proses')."' method='post'>
					   
                      <input type='text' name='denda' class='form-control'  value='".$setting_umum->denda."' id='exampleInputEmail1' required='' placeholder='title web'>
					</div>
					<div  class='form-group'>
						<label for='exampleInputEmail1' >Max peminjaman per hari (hari)</label>
						   <input type='text' name='max_peminjaman_perhari' class='form-control'  value='".$setting_umum->max_peminjaman_perhari."' id='exampleInputEmail1'  required='' placeholder='nama web'>
					</div> 
					
					<div  class='form-group'>
						<label for='exampleInputEmail1' >max jatuh tempo (lama) peminjaman (hari)</label>
						   <input type='text' name='max_tempo_peminjaman' class='form-control' required='' value='".$setting_umum->max_tempo_peminjaman."' id='exampleInputEmail1' placeholder='keterangan footer'>
					</div> 
					
					<div  class='form-group'>
						<label for='exampleInputEmail1' >max lama peminjaman (hari)</label>
						   <input type='text' name='max_peminjaman' class='form-control' required='' value='".$setting_umum->max_peminjaman."' id='exampleInputEmail1' placeholder='keterangan footer'>
					</div> 
					
						
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class='box-footer'>
                    <button type='submit' class='btn btn-primary'>Simpan</button>
					<a href='".base_url('index.php/admin/')."' class='btn btn-primary' title='batal atau kembali'><b>Batal</b></a>
              
                  </div>
                </form>";
					}
				}
				?>
				
              </div><!-- /.box -->

            </div><!--/.col (left) -->
			
           
          </div>   <!-- /.row -->
        </section><!-- /.content -->
		  
	  
      </div><!-- /.content-wrapper -->
