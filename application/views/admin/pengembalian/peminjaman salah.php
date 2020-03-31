
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Peminjaman
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 <li><a href="<?php echo base_url('index.php/admin/Peminjaman');?>"></i> Peminjaman</a></li>
            <li class="active">Peminjaman</li>
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
                  <h3 class="box-title">Peminjaman</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
					  <form enctype='multipart/form-data' id='form_send' action='".base_url('index.php/inventory_in/inventory_inadd_proses')."' method='post'>
					<?php
					echo"
						<div class='form-group'>
                      <label for='exampleInputEmail1'>Barcode member</label>
						<div class='input-group'>
							
						<input type='text' name='barcode_member'   id='barcode_member'  class='form-control'  value=''  required='' placeholder='barcode_member'>
							<div class='input-group-addon' id='bar_m'>
							<i class='fa fa-search' ></i>
							</div>
						</div>
					</div>
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>No identitas</label>
                       <div id='identitas'>
					  <input readonly type='text' id='identitas' name='identitas' class='form-control'  value=''  required='' placeholder='id'>
						</div>
					</div>
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Nama</label>
					   <div id='nama'>
                      <input  readonly type='text' id='nama' name='nama' class='form-control'  value=''  required='' placeholder='nama'>
					  </div>
					</div>
					";
					?>
                   
                   
                  </div><!-- /.box-body -->

               
               
				
              </div><!-- /.box -->

            </div><!--/.col (left) -->
			
            <!-- right column -->
            <div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                     <?php
					 echo"<div class='form-group'>
                      <label for='exampleInputEmail1'>Barcode Iventory - buku</label>
						<div class='input-group'>
							
						<input type='text' name='barcode_inventory'   id='barcode_inventory'  class='form-control'  value=''  required='' placeholder='barcode_inventory'>
							<div class='input-group-addon' id='bar_inv'>
							<i class='fa fa-search' ></i>
							</div>
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
					
					 ";
					 ?>
					 
              </div><!-- /.box -->
                </div><!-- /.box-body -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
		  
	  
	   <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
					 <?php
					
					$today=date("Y/m/d");
						echo"
					 <div class='form-group'>
                    <label>Tanggal peminjaman </label>
                    <div class='input-group'>
                      <div class='input-group-addon'>
                        <i class='fa fa-calendar'></i>
                      </div>
					   <input readonly type='text'  name='tgl0' value='$today'  class='form-control'  style='height:35px;' placeholder='yyyy/mm/dd'  required='' />
                   
                      <input type='hidden' id='tanggal' name='tgl'  value='$today' class='form-control'  style='height:35px;' placeholder='yyyy/mm/dd'  required='' />
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

					";
					$this->load->model('m_setting');
					$this->db->where("id_setting", 1);
					$get_setting = $this->db->get("tbl_setting");
					$maxtempo = $get_setting->row()->max_tempo_peminjaman;
			
					 $tanggal_now = date('Y/m/d');
					 $tambah_tanggal = mktime(0,0,0,date('m')+0,date('d')+$maxtempo,date('Y')+0); // angka 2,7,1 yang dicetak tebal bisa dirubah rubah
					 $tambah = date('Y/m/d',$tambah_tanggal);
					echo"
					 <div class='form-group'>
                    <label>Tanggal jatuh tempo</label>
                    <div class='input-group'>
                      <div class='input-group-addon'>
                        <i class='fa fa-calendar'></i>
                      </div>
                      <input type='text' id='tanggal2' name='tgl2' id='tanggal' value='$tambah' class='form-control'  style='height:35px;' placeholder='yyyy/mm/dd'  required='' />
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

					";
					
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Jumlah </label>
					     <input  type='hidden' id='jumlah' name='jumlah' class='form-control'  value='1' id='exampleInputEmail1' required='' placeholder='jumlah'>
				
                      <input readonly type='number' id='jumlah2' name='jumlah' class='form-control'  value='1' id='exampleInputEmail1' required='' placeholder='jumlah'>
					</div>
					";
				
					
					
					
					
					echo"
                  <div class='box-footer'>
                    <button type='button' id='send' class='btn btn-primary'>Simpan</button>
					<a href='".base_url('index.php/inventory_in/')."' class='btn btn-primary' title='batal atau kembali'><b>Batal</b></a>
              
                  </div>
                </form>";
					
					?>
                   
                   
                  </div><!-- /.box-body -->

               
               
				
              </div><!-- /.box -->

            </div><!--/.col (left) -->
			
      </div><!-- /.content-wrapper -->
      

<!-- jQuery 2.1.4 -->


<script type="text/javascript">

		$("#bar_m").click(function(){
		
			$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/peminjaman/member_get?barcode_member="+$("#barcode_member").val(),
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response.hasil=='berhasil')
                    {
						$("#identitas").html(response.identitas);
						$("#nama").html(response.nama);
					
					}
					else if (response.hasil=='cek')
                    {
						
					alert(response.ket);
					
					}
					else 
					{
					alert("sorry, barcode tidak terdaftar");
					}
                	 
                }
            });

			
			return false;
		});
			$("#bar_inv").click(function(){
		
			$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/inventory/inventory_get?barcode="+$("#barcode_inventory").val(),
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
                url: '<?php echo base_url('index.php/inventory_in/inventory_inadd_proses');?>',
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