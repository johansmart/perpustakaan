<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            slider
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 <li><a href="<?php echo base_url('index.php/slider');?>"></i> slider</a></li>
            <li class="active">Tambah slider</li>
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
                  <h3 class="box-title">Tambah slider</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body">
					 <?php
					if(count($slider)>0){
						foreach($slider as $slider)
						{
					  echo "
					<form    enctype='multipart/form-data' action='".base_url('index.php/slider/slider_edit_proses')."' method='post'>
			
					
					<div class='form-group'>
					<label for='exampleInputEmail1'>Nama</label>
					  <input type='hidden' class='form-control' name='id' value='".$slider->id_slider."' placeholder='nama slider' >
					  <input type='text' class='form-control' name='nama' value='".$slider->nama_slider."' placeholder='nama slider' >
					</div>
					
					<div class='form-group'>
					<label for='exampleInputEmail1'>Keterangan</label>
					  <input type='text' class='form-control' name='keterangan'  value='".$slider->ket_slider."'  placeholder='keterangan slider' >
					</div>
					
					<div class='form-group'>
						<label for='exampleInputEmail1'>Status </label>
							<select name='status' class='form-control'  style='width:100%;'>
								<option>".$slider->status_slider."</option>
							   <option>publish</option>
							   <option>no</option>
							</select>
					</div>
				  
				   <div class='form-group'>
					<label for='exampleInputEmail1' >image lama</label>
					<hr>
					<img src=".base_url('assets/images/slider/'.$slider->image_slider.'')." width=150 >
					<hr>
				  </div>
				  
				<div class='form-group'>
                <label for='exampleInputEmail1'>
                   upload foto/image baru
                </label>
                
                    <input type='file' name='file' accept='image/*' />  
                
           
				
				
				
				  <div><br><p>
						<button type ='submit' class='btn btn-success'><span class='glyphicon glyphicon-floppy-disk'> Simpan </span></button>
						<a href='".base_url('index.php/slider')."' class='btn btn-default' > kembali </a>
						
					</div>
					</form>
									
					"; 
					}
					}
		 ?>
              </div><!-- /.box -->
            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      

<!-- jQuery 2.1.4 -->
	 <script src="<?php echo base_url('assets/temp/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
	      <!-- jQuery 2.1.4 -->
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('assets/temp/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>