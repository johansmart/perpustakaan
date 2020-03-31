
				
			<?php
				foreach ($perpustakaan as $key => $value) {
				echo"
                  <table id='sample-table-2'  class='table table-hover' style='width:100%; padding:1em;' cellspacing='5' cellpadding='5' >
					<tr>
					<th colspan=13 align='center'>
					". $value['nama'] ."<br>
					Laporan Statistik Jumlah Inventory Buku<br>
					".$this->session->userdata('lap_search_inv')." &nbsp
					<hr style='height:2px #000;'>
					<br>
					<br>
					</th>
					</tr>
                  
                    <tr>
                      <th style=width:5%>No</th>
                      <th align='left' style=width:15%>Barcode</th>
                      <th align='left' style=width:15%>ISBN</th>
                      <th align='left' style=width:20%>Judul inventory</th>
                      <th  align='left' style=width:10%>Kategori</th>
                      <th  align='right' style=width:7%>In</th>
                      <th align='right' style=width:7%>Out</th>
                      <th  align='right' style=width:7%>Pinjam</th>
                      <th  align='right' style=width:7%>Kembali</th>
                      <th  align='right' style=width:7%>Jumlah</th>
                    </tr>
					
					<tr><td colspan=13 align='center'><hr  style='height:0.13em;color:gray'></td>
					";
				}
                   
				$no = 0;
				
				foreach($inventory as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$no</td>
					<td align='left' style='vertical-align:middle'>$mn->barcode_inventory</td>
					<td align='left' style='vertical-align:middle'>$mn->ISBN</td>
					<td align='left' style='vertical-align:middle'>$mn->judul_inventory</td>
					<td align='left' style='vertical-align:middle'>$mn->nama_category_inventory</td>";
					
					$jumlah_in = $this->db->query("select sum(jumlah_inventory_in) as jum_in from tbl_inventory_in where id_inventory=".$mn->id_inventory." ")->row()->jum_in;
					echo"
					<td align='right' style='vertical-align:middle'>$jumlah_in</td>";
					
					$jumlah_out = $this->db->query("select sum(jumlah_inventory_out) as jum_out from tbl_inventory_out where id_inventory=".$mn->id_inventory." ")->row()->jum_out;
					echo"
					<td align='right' style='vertical-align:middle'>$jumlah_out</td>";
					
					$jumlah_pinjam = $this->db->query("select count(*) as jum_pinjam from tbl_peminjaman where id_inventory=".$mn->id_inventory." ")->row()->jum_pinjam;
					echo"
					<td align='right' style='vertical-align:middle'>$jumlah_pinjam</td>";
					
					$jumlah_kembali = $this->db->query("select count(*) as jum_kembali from tbl_pengembalian where id_inventory=".$mn->id_inventory." ")->row()->jum_kembali;
					echo"
					<td  align='right' style='vertical-align:middle'>$jumlah_kembali</td>";
					
					$jumlah_total = ($jumlah_in+$jumlah_kembali)-($jumlah_out+$jumlah_pinjam);
					echo"
					<td align='right' style='vertical-align:middle'>$jumlah_total</td>";
					
					echo"</td>
					
					<tr><td colspan=13 align='center'><hr  style='height:0.03em;color:gray'></td>
					";
					echo "</tr>";
					
				}
				
					echo"
					</td>";
					
			echo "</table>";
			?>
			
			
		
