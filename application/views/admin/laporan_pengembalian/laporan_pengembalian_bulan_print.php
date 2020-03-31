
				
				<?php
				$search_pengembalian_bulan=$this->session->userdata('search_pengembalian_bulan');
				if ($search_pengembalian_bulan=='01'){
				$nama_bulan="Januari";
				}
				else if ($search_pengembalian_bulan=='02'){
				$nama_bulan="Februari";
				}
				else if ($search_pengembalian_bulan=='03'){
				$nama_bulan="Maret";
				}
				else if ($search_pengembalian_bulan=='04'){
				$nama_bulan="April";
				}
				else if ($search_pengembalian_bulan=='05'){
				$nama_bulan="Mei";
				}
				else if ($search_pengembalian_bulan=='06'){
				$nama_bulan="Juni";
				}
				else if ($search_pengembalian_bulan=='07'){
				$nama_bulan="Juli";
				}
				else if ($search_pengembalian_bulan=='08'){
				$nama_bulan="Agustus";
				}
				else if ($search_pengembalian_bulan=='09'){
				$nama_bulan="September";
				}
				else if ($search_pengembalian_bulan=='10'){
				$nama_bulan="Oktober";
				}
				else if ($search_pengembalian_bulan=='11'){
				$nama_bulan="November";
				}
				else if ($search_pengembalian_bulan=='12'){
				$nama_bulan="Desember";
				}else{
					$nama_bulan = '';
				}
				
				foreach ($perpustakaan as $key => $value) {
				echo"
                  <table id='sample-table-2'  class='table table-hover' style='width:100%' >
					<tr>
					<th colspan=9 align='center'>
					". $value['nama'] ."<br>
					Laporan Pengembalian Buku <br>
					per bulan &nbsp
					$nama_bulan &nbsp
					tahun ".$this->session->userdata('search_pengembalian_tahun')." &nbsp
					<hr style='height:2px #000;'>
					<br>
					<br>
					</th>
					</tr>
                 <tr>
                        <th   align='right' style='width:7%; padding-right:15px;'>No</th>
                      <th  align='left' style=width:8%>Tanggal</th>
                      <th  align='left' style=width:12%>Nama admin</th>
                      <th  align='left' style=width:13%>Member</th>
                      <th  align='left' style=width:15%>Inventory</th>
                      <th align='right' style=width:10%>Denda telat</th>
                      <th align='right' style=width:10%>Denda lain</th>
                      <th align='left' style=width:30%>Ket Denda lain</th>
                      <th align='right' style=width:10%>total</th>
                    </tr>
					
					<tr><td colspan=9 align='center'><hr></td>
					";
				}
                
				$no = 0;
				
				foreach($pengembalian->result_array() as $mn){
				$total=$mn['denda_lainnya']+$mn['jumlah_denda_telat'];
					$no++;
					echo "<tr>";
					echo "<td align='right' style='width:10%; padding-right:15px;' style='vertical-align:middle'>$no</td>
					<td style='vertical-align:middle'>".$mn['tgl_pengembalian']."</td>
					<td style='vertical-align:middle'>".$mn['nama_lengkap_admin']."</td>
					<td style='vertical-align:middle'>".$mn['barcode_member']."</td>
					<td style='vertical-align:middle'>".$mn['barcode_inventory']."</td>
					<td align='right' style='vertical-align:middle'>".$mn['jumlah_denda_telat']."</td>
					<td align='right' style='vertical-align:middle'>".$mn['denda_lainnya']."</td>
					<td align='left' style='width:10%; padding-right:15px;padding-left:15px;'  style='vertical-align:middle'>".$mn['ket_denda_lainnya']."</td>
					<td align='right' style='vertical-align:middle'>".$total."</td>
					</tr>
					<tr><td colspan=9 align='center'><hr></td>
					<tr>";
					
					echo"
					</tr>";
					
				}
					
				$total_semua_denda=$this->m_pengembalian->jumlah_list_pengembaliantotal_bulan();
			echo"<tr><td align='right' colspan=8>Total semua Denda<td align='right'>$total_semua_denda</td></tr>";
			echo "<tr><td colspan=9 align='center'><hr></td></table>";
					
			echo "</table>";
			?>
			
					
			
			