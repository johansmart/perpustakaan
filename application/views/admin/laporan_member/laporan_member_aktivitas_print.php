
				
			<?php
				foreach ($perpustakaan as $key => $value) {
				echo"
                  <table id='sample-table-2'  class='table table-hover' style='width:100%' >
					<tr>
					<th colspan=9 align='center'>
					". $value['nama'] ."<br>
					Laporan Data Member<br>
					".$this->session->userdata('search_mmbr')." &nbsp
					<hr style='height:2px #000;'>
					<br>
					<br>
					</th>
					</tr>
                   <tr>
                      <th style=width:5%>No</th>
                      <th align ='left' style=width:15%>No Identitas</th>
                      <th align ='left' style=width:30%>Nama member</th>
                      <th align ='left' style=width:10%>Jenis</th>
                      <th align ='right' style=width:10%>Kunjungan</th>
                      <th align ='right' style=width:10%>Peminjaman</th>
                      <th align ='right' style=width:10%>Pengembalian</th>
                      <th align ='right' style=width:10%>selisih</th>
                    </tr>
					
					<tr><td colspan=8 align='center'><hr></td>
					";
				}
                   
				$no = 0;
				
				foreach($member as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$no</td>
					<td align ='left' style='vertical-align:middle'>$mn->no_identitas_member</td>
					<td align ='left' style='vertical-align:middle'>$mn->nama_member</td>
					<td align ='left' style='vertical-align:middle'>$mn->nama_jenis_member</td>";
					
					$jumlah_absen = $this->db->query("select count(*) as jum_abs from tbl_kunjungan where id_member=".$mn->id_member." ")->row()->jum_abs;
					echo"
					<td align ='right' style='vertical-align:middle'>$jumlah_absen</td>";
					
					$jumlah_pinjam = $this->db->query("select count(*) as jum_pjm from tbl_peminjaman where id_member=".$mn->id_member." ")->row()->jum_pjm;
					echo"
					<td align ='right' style='vertical-align:middle'>$jumlah_pinjam</td>";
					
					$jumlah_kembali = $this->db->query("select count(*) as jum_kmbl from tbl_pengembalian where id_member=".$mn->id_member." ")->row()->jum_kmbl;
					echo"
					<td align ='right' style='vertical-align:middle'>$jumlah_kembali</td>";
					$selisih=$jumlah_pinjam-$jumlah_kembali;
					echo"
					<td align ='right' style='vertical-align:middle'>$selisih</td>";
					
					
					echo"</td>";
					echo "</tr>";
					
				}
				
					echo"<tr><td colspan=8 align='center'><hr></td>
					</td>";
					
			echo "</table>";
			?>
			
			
		
