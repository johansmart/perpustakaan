
				
				<?php
				foreach ($perpustakaan as $key => $value) {
				echo"
                  <table id='sample-table-2'  class='table table-hover' style='width:100%' >
					<tr>
					<th colspan=9 align='center'>
					". $value['nama'] ."<br>
					Laporan Kunjungan<br> per Tanggal&nbsp
					".$this->session->userdata('search_kunjungan_tanggal')."
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
				$total_semua = $this->m_kunjungan->list_kunjungan_tanggal_printtotal();
					
					echo"
					<td colspan=3 align='right'>
					<b>total semua: &nbsp</b> <td align='left'></b> $total_semua</b>
					<tr><td colspan=4 align='center'><hr></td>
					</td>";
					
			echo "</table>";
			?>
			
			
		
