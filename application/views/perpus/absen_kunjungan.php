
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Absen Kunjungan
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Absen Kunjungan</li>
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
					  <h3 class="box-title">Scan your barcode card</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					<div class="box-body">
						<center>
						<?php echo"<img src='".base_url('assets/contohkta/contohktadepan.png')."' height=200>"; ?>
						</center>
						<div class='clearfix'>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">barcode</label>
							<form id='form_send' method='post'>
							<div class='input-group'>
									<input type='text' name='barcode' onkeyup='myFunction()' id='barcode_member' class='form-control' required=''  value='' id='exampleInputEmail1' placeholder='barcode'>
								<div class='input-group-addon' id='send'>
									<i class='fa fa-search' ></i>
								</div>
							</div>
				
						</div>
							</form>
						  
					</div><!-- /.box -->

				</div><!--/.col (left) -->
            </div><!--/.col (left) -->
			
            <!-- right column -->
            <div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Kunjungan hari ini [ <?php $today=date('D d F Y '); echo"$today";?> ]</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                   <div class="box-body">
                    <div class="form-group" id='isi_list'>
                     <?php
					 
					$this->load->model('m_kunjungan');
					 $kunjungan=$this->m_kunjungan->list_kunjungannow();
			
					$no = 0;
					echo" <table class='table table-hover'>
                    <tr>
                      <th align='left' style=width:5%>No</th>
                      <th align='left' style=width:15%>ID Member</th>
                      <th align='left' style=width:15%>Nama Member</th>
                    </tr>";
						foreach($kunjungan as $mn){
						$no++;
					
						echo"<td align='center' style='vertical-align:middle'>$no</td>
						<td style='vertical-align:middle'>$mn->no_identitas_member
						<td style='vertical-align:middle'>$mn->nama_member
						</td></tr>";
						}
					echo"</table>";
					
					 ?>
					
					</div><!-- /.box -->
                </div><!-- /.box-body -->
				<?php
				
				$jumlah_kunjungan = $this->m_kunjungan->jumlah_list_kunjungan();
				echo"<div id='jumlah'><h4 class='box-title' > jumlah kunjungan hari ini : <b> $jumlah_kunjungan </b>member </h4> <br></div>";
				echo"<a href='".base_url('index.php/perpus/kunjungan')."' class='btn btn-primary' ><b>Selengkapnya</b></a>";
				?>
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
		  
	  
      </div><!-- /.content-wrapper -->
      

	
<!-- jQuery 2.1.4 -->
	 <script src="<?php echo base_url('assets/temp/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
	      <!-- jQuery 2.1.4 -->
		  
	

<script type="text/javascript">

$(document).ready(function(){
   	$("#send").click(function(){
    	var formdata = new FormData();      
            $.each($('#form_send').serializeArray(), function(a, b){
            formdata.append(b.name, b.value);
            });

			$.ajax({
                url: '<?php echo base_url('index.php/perpus/absen_proses');?>',
            	data : formdata,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response)
				{
                	if(response.hasil == 'berhasil')
					{
						$("#barcode_member").val('');
						$("#barcode_member").focus();
						$("#jumlah").html(response.jumlah);
						$("#isi_list").html(response.isi_list);
						
                	}
					else{
                		
                	}
                }
            });

		});

});


function myFunction() {

  	var formdata = new FormData();      
            $.each($('#form_send').serializeArray(), function(a, b){
            formdata.append(b.name, b.value);
            });

			$.ajax({
			
			
                url: '<?php echo base_url('index.php/perpus/absen_proses');?>',
            	data : formdata,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: "json",
                success: function(response)
				{
                	if(response.hasil == 'berhasil')
					{
						$("#barcode_member").val('');
						$("#barcode_member").focus();
						$("#jumlah").html(response.jumlah);
						$("#isi_list").html(response.isi_list);
						
                	}
					else{
                		
                	}
                }
            });

}

	

</script>
	