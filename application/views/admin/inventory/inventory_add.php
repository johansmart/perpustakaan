
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
				$inisial_barcode="MEZ-INV-";
					  echo"
					  <form enctype='multipart/form-data' action='".base_url('index.php/inventory/inventory_add_proses')."' method='post'>
					
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Barcode inventory</label> format : $inisial_barcode
                      <input type='text' name='barcode' class='form-control'  value='' id='barcode_inventory' onkeyup=' Function_inventory()' required='' placeholder='no id barcode inventory'>
					<div id='cekinv'></div>
					</div>";
					
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>Kategori inventory</label>
                    <select name='category_inventory' class='select'  style='width:100%;' id='isi_category_inventory'>
					
					";
					//kategory
					$this->load->model('m_category_inventory');
					$category_inventory = $this->m_category_inventory->select_category_inventory();
					if(count($category_inventory)>0)
					{
					foreach($category_inventory as $category_inventory)
						{
						 echo" <option value=".$category_inventory->id_category_inventory." >".$category_inventory->nama_category_inventory."</option>";
						}
					}	
					echo"</select><br>
					<br>
					<a href='' id ='refresh_category'><img src='".base_url('assets/images/refresh.png')."'>refresh</a>
					<br> *) jika nama category_inventory belum ada, klik
					<a href='".base_url('index.php/category_inventory/category_inventoryadd')."' target='_blank'>Tambah data category</a>
					<br><br>
					</div>";
					//kategory end
					
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Judul inventory</label>
                      <input type='text' name='judul' class='form-control'  value='' id='exampleInputEmail1' required='' placeholder='nama'>
					</div>
					";
					
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>ISBN</label>
                      <input type='text' name='isbn' class='form-control'  value='' id='exampleInputEmail1' required='' placeholder='isbn'>
					</div>
					";
					
					//pengarang
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>pengarang inventory</label>
                    <select name='pengarang' class='select'  style='width:100%;' id='isi_pengarang'>
					";
					$this->load->model('m_pengarang');
					$pengarang = $this->m_pengarang->select_pengarang();
					if(count($pengarang)>0)
					{
					foreach($pengarang as $pengarang)
						{
						 echo" <option value=".$pengarang->id_pengarang." >".$pengarang->nama_pengarang."</option>";
						}
					}	
					echo"</select><br>
					<br>
					<a href='' id ='refresh_pengarang'><img src='".base_url('assets/images/refresh.png')."'>refresh</a>
					<br> *) jika nama pengarang belum ada, klik
					<a href='".base_url('index.php/pengarang/pengarangadd')."' target='_blank'>Tambah data pengarang</a>
					<br><br>
					</div>";
					//pengarang end
					
					//penerbit
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>penerbit inventory</label>
                    <select name='penerbit' class='select'  style='width:100%;' id='isi_penerbit'>
					";
					$this->load->model('m_penerbit');
					$penerbit = $this->m_penerbit->select_penerbit();
					if(count($penerbit)>0)
					{
					foreach($penerbit as $penerbit)
						{
						 echo" <option value=".$penerbit->id_penerbit." >".$penerbit->nama_penerbit."</option>";
						}
					}	
					echo"</select><br>
					<br>
					<a href='' id ='refresh_penerbit'><img src='".base_url('assets/images/refresh.png')."'>refresh</a>
					<br> *) jika nama penerbit belum ada, klik
					<a href='".base_url('index.php/penerbit/penerbitadd')."' target='_blank'>Tambah data penerbit</a>
					<br><br>
					</div>";
					//penerbit end
					
					//kota
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>Kota</label>
                    <select name='kota' class='select'  style='width:100%;' id='isi_kota'>
					";
					$this->load->model('m_kota');
					$kota = $this->m_kota->select_kota();
					if(count($kota)>0)
					{
					foreach($kota as $kota)
						{
						 echo" <option value=".$kota->id_kota." >".$kota->nama_kota."</option>";
						}
					}
                    echo"</select><br>
					<br>
					<a href='' id ='refresh_kota'><img src='".base_url('assets/images/refresh.png')."'>refresh</a>
					<br> *) jika nama kota belum ada, klik
					<a href='".base_url('index.php/kota/kotaadd')."' target='_blank'>Tambah data kota</a>
					<br><br>
					</div>";
					//kota end
					
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Tahun</label>
                      <input type='number' name='tahun' class='form-control'  value='' id='exampleInputEmail1' required='' placeholder='tahun'>
					</div>
					";
					
					//letak_rak
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>letak_rak inventory</label>
                    <select name='letak_rak' class='select'  style='width:100%;' id='isi_letak_rak'>
					
					";
					$this->load->model('m_letak_rak');
					$letak_rak = $this->m_letak_rak->select_letak_rak();
					if(count($letak_rak)>0)
					{
					foreach($letak_rak as $letak_rak)
						{
						 echo" <option value=".$letak_rak->id_letak_rak." >".$letak_rak->nama_letak_rak."</option>";
						}
					}	
					echo"</select><br>
					<br>
					<a href='' id ='refresh_letak_rak'><img src='".base_url('assets/images/refresh.png')."'>refresh</a>
					<br> *) jika nama letak_rak belum ada, klik
					<a href='".base_url('index.php/letak_rak/letak_rakadd')."' target='_blank'>Tambah data letak_rak</a>
					<br><br>
					</div>";
					//letak_rak end 
					
					//bahasa
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>Bahasa inventory</label>
                    <select name='bahasa' class='select'  style='width:100%;' id='isi_bahasa'>
					
					";
					$this->load->model('m_bahasa');
					$bahasa = $this->m_bahasa->select_bahasa();
					if(count($bahasa)>0)
					{
					foreach($bahasa as $bahasa)
						{
						 echo" <option value=".$bahasa->id_bahasa." >".$bahasa->nama_bahasa."</option>";
						}
					}	
					echo"</select><br>
					<br>
					<a href='' id ='refresh_bahasa'><img src='".base_url('assets/images/refresh.png')."'>refresh</a>
					<br> *) jika nama bahasa belum ada, klik
					<a href='".base_url('index.php/bahasa/bahasaadd')."' target='_blank'>Tambah data bahasa</a>
					<br><br>
					</div>";
					//bahasa end 
					
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Jumlah halaman</label>
                      <input type='number' name='halaman' class='form-control'  value='' id='exampleInputEmail1' required='' placeholder='halaman'>
					</div>
					";
					
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Detail</label>
                    <textarea id='editor1' name='detail' rows='10' cols='80' required=''></textarea>
					</div>
					";
					
					//klasifikasi
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>klasifikasi inventory</label>
                    <select name='klasifikasi' class='select'  style='width:100%;' id='isi_klasifikasi'>
					";
					$this->load->model('m_klasifikasi');
					$klasifikasi = $this->m_klasifikasi->select_klasifikasi();
					if(count($klasifikasi)>0)
					{
					foreach($klasifikasi as $klasifikasi)
						{
						 echo" <option value=".$klasifikasi->id_klasifikasi." >".$klasifikasi->nama_klasifikasi."</option>";
						}
					}	
					echo"</select><br>
					<br>
					<a href='' id ='refresh_klasifikasi'><img src='".base_url('assets/images/refresh.png')."'>refresh</a>
					<br> *) jika nama klasifikasi belum ada, klik
					<a href='".base_url('index.php/klasifikasi/klasifikasiadd')."' target='_blank'>Tambah data klasifikasi</a>
					<br><br>
					</div>";
					//klasifikasi end
					
					echo"<div class='form-group'>
						<label for='exampleInputEmail1'>Status inventory</label>
							<select name='status' class='form-control'  style='width:100%;'>
							   <option value='1'>aktif</option>
							   <option value='0'>non aktif</option>
							</select>
					</div>
					
					<div class='form-group'>	
						<label for='exampleInputEmail1'>
						upload foto/image 
						</label>
						<input type='file' name='file' accept='image/*' />  
					<div><br>
				
                  <div class='box-footer'>
                    <button type='submit' class='btn btn-primary'>Simpan</button>
					<a href='".base_url('index.php/inventory/')."' class='btn btn-primary' title='batal atau kembali'><b>Batal</b></a>
              
                  </div>
                </form>";
					
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

function Function_inventory() {

    var binv = document.getElementById("barcode_inventory");
    
	$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/inventory/inventory_cekbarcode?barcode="+binv.value,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response.hasil=='berhasil')
                    {
						$("#id").html(response.id);
						$("#judul").html(response.judul);
						$("#isbn").html(response.ISBN);
						$("#barcode_inventory").focus();
					$("#cekinv").html("");
					
					}
					else 
					{
					$("#cekinv").html(response.ket);
					$("#barcode_inventory").focus();
					}
                	 
                }
            });

			
			return false;
}
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