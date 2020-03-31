
				
				<?php
				$search_peminjaman_bulan=$this->session->userdata('search_peminjaman_bulan');
				if ($search_peminjaman_bulan != null) {
					if ($search_peminjaman_bulan=='01'){
					$nama_bulan="Januari";
					}
					else if ($search_peminjaman_bulan=='02'){
					$nama_bulan="Februari";
					}
					else if ($search_peminjaman_bulan=='03'){
					$nama_bulan="Maret";
					}
					else if ($search_peminjaman_bulan=='04'){
					$nama_bulan="April";
					}
					else if ($search_peminjaman_bulan=='05'){
					$nama_bulan="Mei";
					}
					else if ($search_peminjaman_bulan=='06'){
					$nama_bulan="Juni";
					}
					else if ($search_peminjaman_bulan=='07'){
					$nama_bulan="Juli";
					}
					else if ($search_peminjaman_bulan=='08'){
					$nama_bulan="Agustus";
					}
					else if ($search_peminjaman_bulan=='09'){
					$nama_bulan="September";
					}
					else if ($search_peminjaman_bulan=='10'){
					$nama_bulan="Oktober";
					}
					else if ($search_peminjaman_bulan=='11'){
					$nama_bulan="November";
					}
					else if ($search_peminjaman_bulan=='12'){
					$nama_bulan="Desember";
					}
				}else{
					$nama_bulan = '-';
				}
				foreach ($perpustakaan as $key => $value) {
				echo"
                  <table id='sample-table-2'  class='table table-hover' style='width:100%' >
					<tr>
					<th colspan=9 align='center'>
					". $value['nama'] ."<br>
					Laporan Peminjaman Buku <br>
					per bulan &nbsp
					$nama_bulan &nbsp
					tahun ".$this->session->userdata('search_peminjaman_tahun')." &nbsp
					<hr style='height:2px #000;'>
					<br>
					<br>
					</th>
					</tr>
                  <tr>
                        <th   align='right' style='width:5%; padding-right:15px;'>No</th>
                      <th  align='left' style=width:15%>Nama admin</th>
                      <th  align='left' style=width:15%>Member</th>
                      <th  align='left' style=width:30%>Inventory</th>
                      <th  align='left' style=width:14%>Tanggal</th>
                      <th align='left' style=width:14%>Jatuh Tempo</th>
                      <th align='right' style=width:5%>Status</th>
                    </tr>
					
					<tr><td colspan=7 align='center'><hr></td>
					";
				}
                   
				$no = 0;
				
			foreach($peminjaman->result_array() as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$no</td>
					<td style='vertical-align:middle'>".$mn['nama_lengkap_admin']."</td>
					<td style='vertical-align:middle'>".$mn['barcode_member']."</td>
					<td style='vertical-align:middle'>".$mn['barcode_inventory']."</td>
					<td style='vertical-align:middle'>".$mn['tgl_peminjaman']."</td>
					<td style='vertical-align:middle'>".$mn['tgl_tempo_peminjaman']."</td>
					<td align='right' style='vertical-align:middle'>".$mn['status_peminjaman']."</td>
					
					</td>
					<tr><td colspan=7 align='center'><hr></td>
					<tr>";
					
					echo"
					</tr>";
					
				}
					
			
			echo "</table>";
					
			echo "</table>";
			?>
			
			
		
