
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         member
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 
            <li class="active">member</li>
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
				if(count($member )>0)
				{
				foreach($member as $member)
				{
					if ( ($member->status_member )== '1' )
					{
					$nama_status="aktif";
					}
					else 
					{
					$nama_status="non aktif";
					}
				
				
					  echo"
					  <form enctype='multipart/form-data'  action='".base_url('index.php/member/member_edit_proses')."' method='post'>
					
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>No ID member</label>
					  <input type='hidden' name='id_member' class='form-control'  value='".$member->id_member."' id='exampleInputEmail1' required='' placeholder='no id member'>
                      <input type='hidden' name='id2' class='form-control'  value='".$member->no_identitas_member."' id='barcode_member0'  placeholder='no id member'>
					 <input type='text' name='id' class='form-control'  value='".$member->no_identitas_member."' id='barcode_member' onkeyup=' Function_member()' required='' placeholder='no id member'>
					<div id='cekmember'></div>
					</div>";
					$kode="".$member->barcode_member."";
					echo" <label for='exampleInputEmail1'>Barcode</label><br>";
					?>
					
					<img src="<?php echo"".base_url('index.php/barcode/gambar/'.$kode.'?height=80&width=1').""; ?>">
					<?php
					echo"
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Nama member</label>
                      <input type='text' name='nama' class='form-control'  value='".$member->nama_member."' id='exampleInputEmail1' required='' placeholder='nama'>
					</div>
					
					
					<div class='form-group'>
					<label for='exampleInputEmail1'>Jenis Kelamin</label>
                    <select name='jk' class='form-control'  style='width:100%;'>
					<option>".$member->jenis_kelamin_member."</option>
					<option>L</option>
					<option>P</option>
					</select>
					</div>";
                   
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>Tempat Lahir</label>
                    <select name='tempat_lahir' class='select'  style='width:100%;' id='isi_kota'>
						<option value=".$member->id_kota.">".$member->nama_kota."</option>
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
					<a href='' id ='refresh'><img src='".base_url('assets/images/refresh.png')."'>refresh</a>
					<br> *) jika nama kota belum ada, klik
					<a href='".base_url('index.php/kota/kotaadd')."' target='_blank'>Tambah data kota</a>
					<br><br>
					</div>";
					
					echo"
					 <div class='form-group'>
                    <label>Tanggal lahir</label>
                    <div class='input-group'>
                      <div class='input-group-addon'>
                        <i class='fa fa-calendar'></i>
                      </div>
                      <input type='text' name='tgl' id='tanggal' value='".$member->tanggal_lahir_member."' class='form-control'  style='height:35px;' placeholder='yyyy/mm/dd'  required='' />
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

					";
					
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>Jenis member</label>
                    <select name='jenis_member' class='select'  style='width:100%;'>
					<option value=".$member->id_jenis_member.">".$member->nama_jenis_member."</option>
					";
					$this->load->model('m_jenis_member');
					$jenis_member = $this->m_jenis_member->select_jenis_member();
					if(count($jenis_member)>0)
					{
					foreach($jenis_member as $jenis_member)
						{
						 echo" <option value=".$jenis_member->id_jenis_member." >".$jenis_member->nama_jenis_member."</option>";
						}
					}
						
						
                    echo"</select></div><br>
					";
					
					echo"<div class='form-group'>
						<label for='exampleInputEmail1'>Status member</label>
							<select name='status' class='form-control'  style='width:100%;'>
							  <option value=".$member->status_member.">$nama_status</option>
							  <option value='1'>aktif</option>
							   <option value='0'>non aktif</option>
							</select>
					</div>
					 <div class='form-group'>
                    <label>Exp Card member</label>
                    <div class='input-group'>
                      <div class='input-group-addon'>
                        <i class='fa fa-calendar'></i>
                      </div>
                      <input type='text' name='exp' id='tanggal2'  value='".$member->exp_card_member."' class='form-control'  style='height:35px;' placeholder='yyyy/mm/dd'  required='' />
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
				  <br>
				  <div class='form-group'>	
						<label for='exampleInputEmail1'>
						Foto sekarang
						</label>
						<br>
						<img src='".base_url('assets/images/member/'.$member->photo_member.'')."' width=200 height=300>
					<div><br>
					
				  <div class='form-group'>	
						<label for='exampleInputEmail1'>
						upload foto/image  baru
						</label>
						<input type='file' name='file' accept='image/*' />  
					<div><br>
				
                  <div class='box-footer'>
                    <button type='submit' class='btn btn-primary'>Simpan</button>
					<a href='".base_url('index.php/member/')."' class='btn btn-primary' title='batal atau kembali'><b>Batal</b></a>
              
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
		$("#refresh").click(function(){
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
	});

	
function Function_member() {

    var bm0 = document.getElementById("barcode_member0");
    var bm = document.getElementById("barcode_member");
    
	$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/member/member_cekbarcodeedit?barcode_member0="+bm0.value+"&barcode_member="+bm.value,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response.hasil=='berhasil')
                    {
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

</script>

	
	
	