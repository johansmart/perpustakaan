
				
				<?php
				$search_kunjungan_bulan=$this->session->userdata('search_kunjungan_bulan');
				if ($search_kunjungan_bulan=='01'){
				$nama_bulan="Januari";
				}
				else if ($search_kunjungan_bulan=='02'){
				$nama_bulan="Februari";
				}
				else if ($search_kunjungan_bulan=='03'){
				$nama_bulan="Maret";
				}
				else if ($search_kunjungan_bulan=='04'){
				$nama_bulan="April";
				}
				else if ($search_kunjungan_bulan=='05'){
				$nama_bulan="Mei";
				}
				else if ($search_kunjungan_bulan=='06'){
				$nama_bulan="Juni";
				}
				else if ($search_kunjungan_bulan=='07'){
				$nama_bulan="Juli";
				}
				else if ($search_kunjungan_bulan=='08'){
				$nama_bulan="Agustus";
				}
				else if ($search_kunjungan_bulan=='09'){
				$nama_bulan="September";
				}
				else if ($search_kunjungan_bulan=='10'){
				$nama_bulan="Oktober";
				}
				else if ($search_kunjungan_bulan=='11'){
				$nama_bulan="November";
				}
				else if ($search_kunjungan_bulan=='12'){
				$nama_bulan="Desember";
				}else {
					$nama_bulan = '';
				}

				foreach ($perpustakaan as $key => $value) {
				echo"
                  <table id='sample-table-2'  class='table table-hover' style='width:100%' >
					<tr>
					<th colspan=9 align='center'>
					". $value['nama'] ."<br>
					Laporan Kunjungan <br>
					per bulan &nbsp
					$nama_bulan &nbsp
					tahun ".$this->session->userdata('search_kunjungan_tahun')." &nbsp
					<hr style='height:2px #000;'>
					<br>
					<br>
					</th>
					</tr>
                    <tr>
					  <th align='left' style=width:10%>No</th>
                      <th align='left' style=width:15%>Tanggal</th>
                      <th align='left' style=width:30%>Identitas Member</th>
                      <th align='left' style=width:45%>Nama Member</th>
                    </tr>
					
					<tr><td colspan=4 align='center'><hr></td>
					";
				}	
                   
				$no = 0;
				
				foreach($kunjungan->result_array() as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$no</td>
					<td style='vertical-align:middle'>".$mn['tgl_kunjungan']."</td>
					<td style='vertical-align:middle'>".$mn['no_identitas_member']."</td>
					<td style='vertical-align:middle'>".$mn['nama_member']."
					</tr>
					<tr><td colspan=4 align='center'><hr></td>
					<tr>";
					
					echo"
					</tr>";
					
				}
				$this->load->model('m_kunjungan');
				$total_semua = $this->m_kunjungan->list_kunjungan_bulan_printtotal();
					
					echo"
					<td colspan=3 align='right'>
					<b>total semua: &nbsp</b> <td align='left'></b> $total_semua</b>
					<tr><td colspan=4 align='center'><hr></td>
					</td>";
					
			echo "</table>";
			?>
			
			
		
