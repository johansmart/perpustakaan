
				
			<?php
				foreach ($perpustakaan as $key => $value) {
				echo"
                  <table id='sample-table-2'  class='table table-hover' style='width:100%; padding:1em;' cellspacing='5' cellpadding='5' >
					<tr>
					<th colspan=13 align='center'>
					". $value['nama'] ."<br>
					Laporan Inventory Buku<br>
					".$this->session->userdata('lap_search_inv')." &nbsp
					<hr style='height:2px #000;'>
					<br>
					<br>
					</th>
					</tr>
                    <tr>
                      <th style=width:5%>No</th>
                      <th style=width:10%>ISBN</th>
                      <th style=width:20%>Judul inventory</th>
                      <th style=width:5%>Kategori</th>
                      <th style=width:5%>Bahasa</th>
                      <th style=width:5%>Halaman</th>
                      <th style=width:10%>Penerbit</th>
                      <th style=width:10%>Pengarang</th>
                      <th style=width:5%>Kota</th>
                      <th style=width:5%>Tahun</th>
                      <th style=width:5%>Letak Rak</th>
                      <th style=width:5%>Klasifikasi</th>
                      <th style=width:10%>Detail</th>
                    </tr>
					
					<tr><td colspan=13 align='center'><hr  style='height:0.13em;color:gray'></td>
					";
				}
                   
				$no = 0;
				
				foreach($inventory as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$no</td>
					<td style='vertical-align:middle'>$mn->ISBN</td>
					<td style='vertical-align:middle'>$mn->judul_inventory</td>
					<td style='vertical-align:middle'>$mn->nama_category_inventory</td>
					<td style='vertical-align:middle'>$mn->nama_bahasa</td>
					<td style='vertical-align:middle'>$mn->jumlah_halaman_inventory</td>
					<td style='vertical-align:middle'>$mn->nama_penerbit</td>
					<td style='vertical-align:middle'>$mn->nama_pengarang</td>
					<td style='vertical-align:middle'>$mn->nama_kota</td>
					<td style='vertical-align:middle'>$mn->tahun</td>
					<td style='vertical-align:middle'>$mn->nama_letak_rak</td>
					<td style='vertical-align:middle'>$mn->nama_klasifikasi</td>
					<td style='vertical-align:middle'>$mn->detail_inventory</td>
					
					
					</td>
					
					<tr><td colspan=13 align='center'><hr  style='height:0.03em;color:gray'></td>
					";
					echo "</tr>";
					
				}
				
					echo"
					</td>";
					
			echo "</table>";
			?>
			
			
		
