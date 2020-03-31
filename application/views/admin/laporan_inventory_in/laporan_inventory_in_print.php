
				
			<?php
				foreach ($perpustakaan as $key => $value) {
				echo"
                  <table id='sample-table-2'  class='table table-hover' style='width:100%; padding:1em;' cellspacing='5' cellpadding='5' >
					<tr>
					<th colspan=13 align='center'>
					". $value['nama'] ."<br>
					Laporan Inventory Buku Masuk<br>
					".$this->session->userdata('lap_search_inv_in')." &nbsp
					<hr style='height:2px #000;'>
					<br>
					<br>
					</th>
					</tr>
                    <tr>
                       <th style=width:5%>No</th>
                      <th style=width:10%>admin</th>
                      <th style=width:20%>barcode inventory</th>
                      <th style=width:15%>Judul Inv Buku</th>
                      <th style=width:10%>Tanggal</th>
                      <th style=width:10%>Tgl Buku</th>
                      <th style=width:7%>Jumlah</th>
                      <th style=width:12%>Jenis</th>
                      <th style=width:15%>Keterangan</th>
                    </tr>
					
					<tr><td colspan=13 align='center'><hr  style='height:0.13em;color:gray'></td>
					";
				}	
                
				$no = 0;
				
				foreach($inventory_in as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$no</td>
					<td align ='center' style='vertical-align:middle'>$mn->nama_lengkap_admin</td>
					<td style='vertical-align:middle'>$mn->barcode_inventory</td>
					<td style='vertical-align:middle'> $mn->judul_inventory</td>
					<td style='vertical-align:middle'>$mn->tgl_inventory_in</td>
					<td style='vertical-align:middle'>$mn->tgl_buku_in</td>
					<td style='vertical-align:middle'>$mn->jumlah_inventory_in</td>
					<td style='vertical-align:middle'>$mn->nama_jenis_in</td>
					<td style='vertical-align:middle'>$mn->keterangan_inventory_in</td>
					
					</td>
					
					<tr><td colspan=13 align='center'><hr  style='height:0.03em;color:gray'></td>
					";
					echo "</tr>";
					
				}
				
					echo"
					</td>";
					
			echo "</table>";
			?>
			
			
		
