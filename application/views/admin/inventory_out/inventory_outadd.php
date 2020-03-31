
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         inventory_out
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 
            <li class="active">inventory_out</li>
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
					  <form enctype='multipart/form-data' id='form_send' action='".base_url('index.php/inventory_out/inventory_outadd_proses')."' method='post'>
					
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Barcode inventory_out</label> format : $inisial_barcode
						<div class='input-group'>
							
						<input type='text' name='barcode'   id='barcode_input' onkeyup='myFunction()' class='form-control'  value=''  required='' placeholder='no id barcode inventory_out'>
							<div class='input-group-addon' id='barcode'>
							<i class='fa fa-search' ></i>
							</div>
						</div>
					</div>
					
					<hr style='border-top: dotted 1px;' />
					<div class='form-group'>
                       <div id='id'>
					
						</div>
					</div>
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Judul inventory</label>
					   <div id='judul'>
                      <input  readonly type='text' id='judul' name='judul' class='form-control'  value=''  required='' placeholder='judul'>
					  </div>
					</div>
					<div class='form-group'>
                      <label for='exampleInputEmail1'>ISBN</label>
					  <div id='isbn'>
                      <input readonly type='text' id='isbn' name='isbn' class='form-control'  value=''  required='' placeholder='judul'>
					  </div>
					</div>
					<hr style='border-top: dotted 1px;' />
					";
					
					
						echo"
					 <div class='form-group'>
                    <label>Tanggal </label>
                    <div class='input-group'>
                      <div class='input-group-addon'>
                        <i class='fa fa-calendar'></i>
                      </div>
                      <input type='text' id='tanggal' name='tgl' id='tanggal' class='form-control'  style='height:35px;' placeholder='yyyy/mm/dd'  required='' />
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

					";
					
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Jumlah inventory masuk</label>
                      <input type='number' id='jumlah' name='jumlah' class='form-control'  value='' id='exampleInputEmail1' required='' placeholder='jumlah'>
					</div>
					";
					//jenis in
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>jenis_out inventory_out</label>
                    <select name='jenis_out' class='select'  style='width:100%;' id='isi_jenis_out'>
					
					";
					$this->load->model('m_jenis_out');
					$jenis_out = $this->m_jenis_out->select_jenis_out();
					if(count($jenis_out)>0)
					{
					foreach($jenis_out as $jenis_out)
						{
						 echo" <option value=".$jenis_out->id_jenis_out." >".$jenis_out->nama_jenis_out."</option>";
						}
					}	
					echo"</select><br>
					<br>
					<a href='' id ='refresh_jenis_out'><img src='".base_url('assets/images/refresh.png')."'>refresh</a>
					<br> *) jika nama jenis_out belum ada, klik
					<a href='".base_url('index.php/jenis_out/jenis_outadd')."' target='_blank'>Tambah data jenis_out</a>
					<br><br>
					</div>";
					// end 
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>keterangan</label>
                    <textarea  name='ket' rows='10' cols='80' ></textarea>
					</div>
					";
					
					
					
					echo"
                  <div class='box-footer'>
                    <button type='button' id='send' class='btn btn-primary'>Simpan</button>
					<a href='".base_url('index.php/inventory_out/')."' class='btn btn-primary' title='batal atau kembali'><b>Batal</b></a>
              
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

		$("#refresh_jenis_out").click(function(){
			var urlnya = this.href;
			var isi2 = urlnya.split('=');
			var isi = isi2[1];
			$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/jenis_out/jenis_out_refresh",
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response)
                    {
						$("#isi_jenis_out").html(response.isi_jenis_out);
					
					}
					else 
					{
					alert("sorry, cannot refresh");
					}
                	 
                }
            });

			
			return false;
		});
		
		$("#barcode").click(function(){
		
			$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/inventory/inventory_get?barcode="+$("#barcode_input").val(),
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response.hasil=='berhasil')
                    {
						$("#id").html(response.id);
						$("#judul").html(response.judul);
						$("#isbn").html(response.ISBN);
					
					}
					else 
					{
					alert("sorry, barcode tidak terdaftar");
					}
                	 
                }
            });

			
			return false;
		});
		
		
		$("#send").click(function(){
			
			var formdata = new FormData();      
            $.each($('#form_send').serializeArray(), function(a, b){
            formdata.append(b.name, b.value);
            });

			$.ajax({
                url: '<?php echo base_url('index.php/inventory_out/inventory_outadd_proses');?>',
            	data : formdata,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response){
                	if(response.hasil == 'berhasil'){
                		$("#form_send")[0].reset();
                		$("#barcode_input").focus();
                		alert(response.keterangan);
						window.location = response.action;
						
                	}
                	else if(response.hasil == 'barcode'){
                		$("#barcode_input").focus();
                		alert(response.keterangan);
                	}
					else if(response.hasil == 'jumlah'){
                		$("#jumlah").focus();
                		alert(response.keterangan);
                	}
					else if(response.hasil == 'tanggal'){
                		$("#tanggal").focus();
                		alert(response.keterangan);
                	}
					else{
                		alert("gagal");
                	}
                }
            });

		});

		
	});

function myFunction() {

    var x = document.getElementById("barcode_input");
    
   $.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/inventory/inventory_get?barcode="+x.value,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response.hasil=='berhasil')
                    {
						$("#id").html(response.id);
						$("#judul").html(response.judul);
						$("#isbn").html(response.ISBN);
					
					}
					else 
					{
					alert("sorry, barcode tidak terdaftar");
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