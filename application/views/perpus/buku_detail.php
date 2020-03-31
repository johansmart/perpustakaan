
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         inventory
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 
            <li class="active">inventory</li>
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
                  <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
				<?php
				if(count($inventory )>0)
				{
				foreach($inventory as $inventory)
				{
					if ( ($inventory->status_inventory )== '1' )
					{
					$nama_status="aktif";
					}
					else 
					{
					$nama_status="non aktif";
					}
				$inisial_barcode="MEZ-INV-";
					  echo"
					 
					<input  readonly type='hidden' name='id_inventory' class='form-control'  value='".$inventory->id_inventory."' id='exampleInputEmail1' required='' placeholder='no id inventory'>
                    <input  readonly type='hidden' name='barcode2' class='form-control'  value='".$inventory->barcode_inventory."' id='exampleInputEmail1' required='' placeholder='no id inventory'>
					<input  readonly type='hidden' name='isbn2' class='form-control'  value='".$inventory->ISBN."' id='exampleInputEmail1' required='' placeholder='no id inventory'>
					";
					$kode="".$inventory->barcode_inventory."";
					?>
					<img src="<?php echo"".base_url('index.php/barcode/gambar/'.$kode.'?height=80&width=1').""; ?>">
					<?php
					echo"
					<br><br>
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Barcode inventory</label> format : $inisial_barcode
                      <input  readonly type='text' name='barcode' class='form-control'  value='".$inventory->barcode_inventory."' id='exampleInputEmail1' required='' placeholder='no id barcode inventory'>
					</div>";
					
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>Kategori inventory</label>
					  <input  readonly type='text' name='category_inventory' class='form-control'  value='".$inventory->nama_category_inventory."' id='exampleInputEmail1' required='' placeholder='no id barcode inventory'>
				
                  
					</div>";
					//kategory end
					
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Judul inventory</label>
                      <input  readonly type='text' name='judul' class='form-control'  value='".$inventory->judul_inventory."' id='exampleInputEmail1' required='' placeholder='nama'>
					</div>
					";
					
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>ISBN</label>
                      <input  readonly type='text' name='isbn' class='form-control'  value='".$inventory->ISBN."' id='exampleInputEmail1' required='' placeholder='isbn'>
					</div>
					";
					
					//pengarang
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>pengarang inventory</label>
					     <input  readonly type='text' name='pengarang'  class='form-control'  value='".$inventory->nama_pengarang."' id='exampleInputEmail1' required='' placeholder='isbn'>
				
                   
					</div>";
					//pengarang end
					
					//penerbit
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>penerbit inventory</label>
					   <input  readonly type='text' name='penerbit'  class='form-control'  value='".$inventory->nama_penerbit."' id='exampleInputEmail1' required='' placeholder='isbn'>
				
                   
					</div>";
					//penerbit end
					
					//kota
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>Kota</label>
					   <input  readonly type='text' name='kota'  class='form-control'  value='".$inventory->nama_kota."' id='exampleInputEmail1' required='' placeholder='isbn'>
				
					</div>";
					//kota end
					
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Tahun</label>
                      <input  readonly type='number' name='tahun' class='form-control'  value='".$inventory->tahun."' id='exampleInputEmail1' required='' placeholder='tahun'>
					</div>
					";
					
					//letak_rak
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>letak_rak inventory</label>
					   <input  readonly type='text' name='letak_rak'  class='form-control'  value='".$inventory->nama_letak_rak."' id='exampleInputEmail1' required='' placeholder='isbn'>
				
                   
					</div>";
					//letak_rak end 
					
					//bahasa
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>Bahasa inventory</label>  
					<input  readonly type='text' name='bahasa'  class='form-control'  value='".$inventory->nama_bahasa."' id='exampleInputEmail1' required='' placeholder='isbn'>
				
					</div>";
					//bahasa end 
					
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Jumlah halaman</label>
                      <input  readonly type='number' name='halaman' class='form-control'  value='".$inventory->jumlah_halaman_inventory."' id='exampleInputEmail1' required='' placeholder='halaman'>
					</div>
					";
					
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Detail</label>
					  <blockquote>
                    ".$inventory->detail_inventory."  </blockquote>
					</div>
					";
					
					//klasifikasi
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>klasifikasi inventory</label>
					   <input  readonly type='text'  name='klasifikasi'  class='form-control'  value='".$inventory->nama_klasifikasi."' id='exampleInputEmail1' required='' placeholder='isbn'>
				
                    
					</div>";
					//klasifikasi end
					
					
					
					
					echo"
					
				
                  <div class='box-footer'>
					<a href='javascript:history.back()' class='btn btn-primary' title='batal atau kembali'><b>Kembali</b></a>
			
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
 
<!-- jQuery 2.1.4 -->


<script type="text/javascript">
	$(function() {
		$("#refresh_kota").click(function(){
			var urlnya = this.href;
			var isi2 = urlnya.split('=');
			var isi = isi2[1];
			$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/kota/kota_refresh",
            
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response)
                    {
						$("#isi_kota").html(response.isi_kota);
					
					}
					else 
					{
					alert("sorry, cannot refresh");
					}
                	 
                }
            });

			
			return false;
		});
		
		$("#refresh_category").click(function(){
			var urlnya = this.href;
			var isi2 = urlnya.split('=');
			var isi = isi2[1];
			$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/category_inventory/category_inventory_refresh",
            
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response)
                    {
						$("#isi_category_inventory").html(response.isi_category_inventory);
					
					}
					else 
					{
					alert("sorry, cannot refresh");
					}
                	 
                }
            });

			
			return false;
		});
		
		$("#refresh_bahasa").click(function(){
			var urlnya = this.href;
			var isi2 = urlnya.split('=');
			var isi = isi2[1];
			$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/bahasa/bahasa_refresh",
            
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response)
                    {
						$("#isi_bahasa").html(response.isi_bahasa);
					
					}
					else 
					{
					alert("sorry, cannot refresh");
					}
                	 
                }
            });

			
			return false;
		});
		
		$("#refresh_pengarang").click(function(){
			var urlnya = this.href;
			var isi2 = urlnya.split('=');
			var isi = isi2[1];
			$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/pengarang/pengarang_refresh",
            
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response)
                    {
						$("#isi_pengarang").html(response.isi_pengarang);
					
					}
					else 
					{
					alert("sorry, cannot refresh");
					}
                	 
                }
            });

			
			return false;
		});
		$("#refresh_penerbit").click(function(){
			var urlnya = this.href;
			var isi2 = urlnya.split('=');
			var isi = isi2[1];
			$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/penerbit/penerbit_refresh",
            
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response)
                    {
						$("#isi_penerbit").html(response.isi_penerbit);
					
					}
					else 
					{
					alert("sorry, cannot refresh");
					}
                	 
                }
            });

			
			return false;
		});
		
		$("#refresh_letak_rak").click(function(){
			var urlnya = this.href;
			var isi2 = urlnya.split('=');
			var isi = isi2[1];
			$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/letak_rak/letak_rak_refresh",
            
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response)
                    {
						$("#isi_letak_rak").html(response.isi_letak_rak);
					
					}
					else 
					{
					alert("sorry, cannot refresh");
					}
                	 
                }
            });

			
			return false;
		});
		
		$("#refresh_klasifikasi").click(function(){
			var urlnya = this.href;
			var isi2 = urlnya.split('=');
			var isi = isi2[1];
			$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/klasifikasi/klasifikasi_refresh",
            
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response)
                    {
						$("#isi_klasifikasi").html(response.isi_klasifikasi);
					
					}
					else 
					{
					alert("sorry, cannot refresh");
					}
                	 
                }
            });

			
			return false;
		});
		
	});

</script>

	
	
	
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