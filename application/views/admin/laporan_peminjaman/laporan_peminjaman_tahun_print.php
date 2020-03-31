
				
				<?php
				foreach ($perpustakaan as $key => $value) {
				echo"
                  <table id='sample-table-2'  class='table table-hover' style='width:100%' >
					<tr>
					<th colspan=9 align='center'>
					". $value['nama'] ."<br>
					Laporan Peminjaman Buku <br>per tahun &nbsp
					".$this->session->userdata('search_peminjaman_tahun')."
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
			
			
		
