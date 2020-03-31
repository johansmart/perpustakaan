
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         peminjaman
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 
            <li class="active">peminjaman</li>
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
				
				
				if ($this->session->userdata('mzgs-perpus-transaksi-pinjam')==""){
				$timenow=date("ymd his ");
				$kodet = rand(1, 12345);
				$id_transaksi=$timenow.$kodet;
				$this->session->set_userdata('mzgs-perpus-transaksi-pinjam', $id_transaksi);
				}
				else {
				$id_transaksi=$this->session->userdata('mzgs-perpus-transaksi-pinjam');
				}
				
				if ($this->session->userdata('mzgs-perpus-member-pinjam')==""){
				$id_memberpinjam='';
				}
				else {
				$id_memberpinjam=$this->session->userdata('mzgs-perpus-member-pinjam');
				}
				
				
				
				$inisial_barcode="MEZ-INV-01-";
					  echo"
					  <form enctype='multipart/form-data' id='form_send' action='".base_url('index.php/inventory_in/inventory_inadd_proses')."' method='post'>
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>ID transaksi</label>
						<input type='text' name='id_transaksi'   class='form-control'  value='$id_transaksi'  required='' placeholder='barcode_member'>
						
					</div>
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Barcode member</label>
						<div class='input-group'>";
						if ($this->session->userdata('mzgs-perpus-member-pinjam')==""){	
						echo"<input type='text' name='barcode_member' onkeyup='Function_member()'  id='barcode_member'  class='form-control'  value=''  required='' placeholder='barcode_member'>
							";
						}
						else{
						echo"<input readonly type='text' name='barcode_member' onkeyup='if (event.keyCode == 13) { Function_member(); }'   id='barcode_member'  class='form-control'  value='$id_memberpinjam'  required='' placeholder='barcode_member'>
							";
						}
							
							
							echo"<div class='input-group-addon' id='bar_m'>
							<i class='fa fa-search' ></i>
							</div>
						</div>
						<div id='cekmember'></div>
					</div>
					";
					echo"<div class='form-group'>
                      <label for='exampleInputEmail1'>Barcode Iventory - buku</label>
						<div class='input-group'>
							
						<input type='text' name='barcode_inventory'   id='barcode_inventory' onkeyup=' Function_inventory()'  class='form-control'  value=''  required='' placeholder='barcode_inventory'>
							<div class='input-group-addon' id='bar_inv'>
							<i class='fa fa-search' ></i>
							</div>
						</div>
						<div id='cekinv'></div>
					</div>
					";
					
					
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
				
					
					
					
					
										
				?>
				
              </div><!-- /.box -->

            </div><!--/.col (left) -->
			
           
          </div>   <!-- /.row -->   <div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Data Member</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php
					echo"
					<div class='form-group'>
                      <label for='exampleInputEmail1'>No identitas</label>
                       <div id='identitas'>
						</div>
					</div>
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Nama</label>
					   <div id='nama'>
                     </div>
					</div>
					";
					?>
              </div><!-- /.box -->
                </div><!-- /.box-body -->
				
				   <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Data buku</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php
					echo"
						<div class='form-group'>
                       <div id='id'>
					
						</div>
					</div>
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Judul inventory</label>
					   <div id='judul'>
                     </div>
					</div>
					<div class='form-group'>
                      <label for='exampleInputEmail1'>ISBN</label>
					  <div id='isbn'>
                  	  </div>
					</div>
					
					
				";
					?>
              </div><!-- /.box -->
                </div><!-- /.box-body -->
		  <?php
		  echo"
                  <div class='box-footer'>
                    <button type='button' id='send' class='btn btn-success'>Simpan</button>
					
              
                  </div>
				  
				  <div class='box-footer'>
                    <a href='".base_url('index.php/peminjaman/')."' class='btn btn-primary' ><b>Kembali</b></a>
                    <a href='".base_url('index.php/peminjaman/peminjaman_finish')."' class='btn btn-primary' ><b>Selesai</b></a>
                    <a href='".base_url('index.php/peminjaman/peminjaman_print?id_trans='.$id_transaksi.'')."' class='btn btn-primary' target='_blank' ><b>Print</b></a>
					<a href='".base_url('index.php/peminjaman/peminjaman_print_baru?id_trans='.$id_transaksi.'')."' class='btn btn-primary' target='_blank' ><b>Print baru</b></a>
					
                  </div>
				  
                </form>";

	  ?>
           
      </div><!-- /.content-wrapper --> </section><!-- right col -->
	     <section class="content">
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data peminjaman</h3>
				   
				<div class="box-body table-responsive no-padding">
				<?php
				$peminjaman=$this->m_peminjaman->list_peminjamanadd($id_transaksi);
				?>
				
				<div id='isi_list'>
                  <table class="table table-hover">
                    <tr>
                      <th style=width:5%>No</th>
                      <th style=width:10%>Admin</th>
                      <th style=width:15%>Member</th>
                      <th style=width:15%>Inventory</th>
                      <th style=width:10%>Tanggal</th>
                      <th style=width:10%>Jatuh tempo</th>
                      <th style=width:5%>Status</th>
                      <th style=width:15%>Action</th>
                    </tr>
					
                   <?php 
				$no = 0;
				
				foreach($peminjaman as $mn){
				$id_pinjam=$mn->id_peminjaman;
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$no</td>
					<td style='vertical-align:middle'>$mn->nama_lengkap_admin</td>
					<td style='vertical-align:middle'>$mn->barcode_member
					</td>
					<td style='vertical-align:middle'>$mn->barcode_inventory</td>
					<td style='vertical-align:middle'>$mn->tgl_peminjaman</td>
					<td style='vertical-align:middle'>$mn->tgl_tempo_peminjaman</td>
					<td align ='center' style='vertical-align:middle'>$mn->status_peminjaman</td>
					
					<td align='center' style='vertical-align:middle'>
		
					
					<a id='hapus' href=\"".base_url('index.php/peminjaman/peminjaman_delete?id='.$mn->id_peminjaman)."\">
					<button class=\"btn btn-danger\" onclick=\"return confirm('Yakin ingin menghapus?');\">
					<span class=\"glyphicon glyphicon-remove\"></span></button></a>
					</td></tr>";
					
				}
			echo "</table></div>";
			?>
			
  </div><!-- /.content-wrapper -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
<!-- jQuery 2.1.4 -->


<script type="text/javascript">
	$(function() {

		$("#refresh_jenis_in").click(function(){
			var urlnya = this.href;
			var isi2 = urlnya.split('=');
			var isi = isi2[1];
			$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/jenis_in/jenis_in_refresh",
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response)
                    {
						$("#isi_jenis_in").html(response.isi_jenis_in);
					
					}
					else 
					{
					alert("sorry, cannot refresh");
					}
                	 
                }
            });

			
			return false;
		});
		
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
						$("#barcode_inventory").focus();
						$("#cekmember").html("");
					
					}
					else if (response.hasil=='cek')
                    {
						
					$("#cekmember").html(response.ket);
					$("#barcode_member").focus();
					
					}
					else 
					{
					$("#cekmember").html(response.ket);
					$("#barcode_member").focus();
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
		});
		
		
		
		
		$("#send").click(function(){
			
			var formdata = new FormData();      
            $.each($('#form_send').serializeArray(), function(a, b){
            formdata.append(b.name, b.value);
            });

			$.ajax({
                url: '<?php echo base_url('index.php/peminjaman/peminjaman_add_proses');?>',
            	data : formdata,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response){
                	if(response.hasil == 'berhasil'){
						$("#barcode_inventory").val('');
                		$("#barcode_inventory").val('');
                		$("#isbn_inventory_get").val('');
                		$("#judul_inventory_get").val('');
                		$("#id2_inventory_get").val('');
                		$("#id_inventory_get").val('');
                		$("#barcode_input").focus();
						$("#isi_list").html(response.isi_list);
                		$("#barcode_inventory").focus();
						
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
					else if(response.hasil == 'cek'){
                		$("#barcode_inventory").val('');
                		$("#barcode_inventory").focus();
                		alert(response.keterangan);
                	}
					else if(response.hasil == 'max'){
                		alert(response.keterangan);
                	}
					else{
                		alert("gagal");
                	}
                }
            });

		});

		
	});


function Function_member() {

    var bm = document.getElementById("barcode_member");
    
	$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/peminjaman/member_get?barcode_member="+bm.value,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response.hasil=='berhasil')
                    {
						$("#identitas").html(response.identitas);
						$("#nama").html(response.nama);
						$("#barcode_inventory").focus();
						$("#cekmember").html("");
					
					}
					else if (response.hasil=='cek')
                    {
						
					$("#cekmember").html(response.ket);
					$("#barcode_member").focus();
					
					}
					else 
					{
					$("#cekmember").html(response.ket);
					$("#barcode_member").focus();
					}
                	 
                }
            });

			
			return false;
}


function Function_inventory() {

    var binv = document.getElementById("barcode_inventory");
    
	$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/inventory/inventory_get?barcode="+binv.value,
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