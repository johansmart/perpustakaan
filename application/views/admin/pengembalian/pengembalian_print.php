
				 
				<div class="box-body table-responsive no-padding">
				<?php
				echo"
				<div id='isi_list'>
                  <table class='table table-hover'>
					<tr>
					<th colspan=9 align='center'>
					PERPUSTAKAAN MEZAGUS<br>
					BUKTI pengembalian<br>
					id transaksi : ".$this->input->get('id_trans')."<br>
					<br>
					</th>
					</tr>
					<tr><td colspan=9 align='center'><hr></td>
                    <tr>
					  <th align='left' style=width:5%>No</th>
                      <th align='left' style=width:10%>Admin</th>
                      <th align='left' style=width:15%>Member</th>
                      <th align='left' style=width:15%>Inventory</th>
                      <th align='left' style=width:10%>Telat</th>
                      <th align='left' style=width:10%>Denda</th>
                      <th align='left' style=width:10%>Denda Lain</th>
                      <th align='left' style=width:15%>ket</th>
                      <th align='left' style=width:10%>Total</th>
                    </tr>
					
					<tr><td colspan=9 align='center'><hr></td>
					";
					
                   
				$no = 0;
				
				foreach($pengembalian as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$no</td>
					<td style='vertical-align:middle'>$mn->nama_lengkap_admin</td>
					<td style='vertical-align:middle'>$mn->barcode_member
					</td>
					<td style='vertical-align:middle'>$mn->barcode_inventory</td>
					<td style='vertical-align:middle'>$mn->selisih</td>
					<td style='vertical-align:middle'>$mn->jumlah_denda_telat</td>
					<td style='vertical-align:middle'>$mn->denda_lainnya</td>
					<td align ='center' style='vertical-align:middle'>$mn->ket_denda_lainnya</td>
					<td style='vertical-align:middle'>$mn->total</td>
					</tr>
					<tr><td colspan=9 align='center'><hr></td>
					<tr>";
					
					echo"
					</tr>";
					
				}
				$total_semua = $this->m_pengembalian->pengembalian_printtotal($this->input->get('id_trans'));
					foreach($total_semua as $total_semua){
					echo"
					<td colspan=8 align='center'>
					total semua <td> $total_semua->total_semua
					<tr><td colspan=9 align='center'><hr></td>
					</td>";
					}
			echo "</table></div>";
			?>