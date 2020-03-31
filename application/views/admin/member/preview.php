
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            member
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 <li><a href="<?php echo base_url('index.php/admin/member');?>"></i> member</a></li>
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
                  <h3 class="box-title">Update member</h3>
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
				
				$inisial_barcode="MEZ-01-";
					  echo"
					  <form action='".base_url('index.php/member/member_edit_proses')."' method='post'>
					
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>No ID member</label>
					  <input readonly type='hidden' name='id_member' class='form-control'  value='".$member->id_member."' id='exampleInputEmail1' required='' placeholder='no id member'>
                      <input readonly type='text' name='id' class='form-control'  value='".$member->no_identitas_member."' id='exampleInputEmail1' required='' placeholder='no id member'>
					</div>
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>ID Barcode</label>
					 
                      <input readonly type='text' name='barcode' class='form-control'  value='".$member->barcode_member."' id='exampleInputEmail1' required='' placeholder='$inisial_barcode - id barcode'>
					<br><br>";
					$kode="".$member->barcode_member."";
					?>
					
					<img src="<?php echo"".base_url('index.php/barcode/gambar/'.$kode.'?height=80&width=1').""; ?>">
					<?php
					echo"</div>
					
					<div class='form-group'>
                      <label for='exampleInputEmail1'>Nama member</label>
                      <input readonly type='text' name='nama' class='form-control'  value='".$member->nama_member."' id='exampleInputEmail1' required='' placeholder='nama'>
					</div>
					
					
					<div class='form-group'>
					<label for='exampleInputEmail1'>Jenis Kelamin</label>
                    <select name='jk' class='form-control'  style='width:100%;' readonly>
					<option>".$member->jenis_kelamin_member."</option>
					<option>L</option>
					<option>P</option>
					</select>
					</div>";
                   
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>Tempat Lahir</label>
                    <select name='tempat_lahir' class='select'  style='width:100%;' id='isi_kota' disabled>
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
                      <input readonly type='text' name='tgl' value='".$member->tanggal_lahir_member."' class='form-control'  style='height:35px;' placeholder='yyyy/mm/dd'  required='' />
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

					";
					
					echo"<div class='form-group'>
					<label for='exampleInputEmail1'>Jenis member</label>
                    <select name='jenis_member' class='select'  style='width:100%;' disabled>
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
							<select name='status' class='form-control'  style='width:100%;' disabled>
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
                      <input readonly type='text' name='exp'   value='".$member->exp_card_member."' class='form-control'  style='height:35px;' placeholder='yyyy/mm/dd'  required='' />
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
				  <br>
				 <div class='form-group'>	
						<label for='exampleInputEmail1'>
						Foto sekarang
						</label>
						<img src='".base_url('assets/images/member/'.$member->photo_member.'')."'>
					<div><br>
                  <div class='box-footer'>
                    <button type='submit' class='btn btn-primary'>Cetak</button>
					<a href='".base_url('index.php/member/member_preview?id='.$member->id_member.'')."'
					class='btn btn-primary' ><b>Preview Cetak</b></a>
              
                  </div>
                </form>";
				}
				}
				?>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
			
            <!-- right column -->
            <div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Card</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                   <div class="box-body">
                    <div class="form-group">
                     
						<?php
					$this->load->view('admin/member/member_preview');
					?>
              </div><!-- /.box -->
                </div><!-- /.box-body -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
		  
	  
      </div><!-- /.content-wrapper -->
      
