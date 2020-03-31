
				 
				<div class="box-body table-responsive no-padding">
				<?php
				echo"
				<div id='isi_list'>
                  <table class='table table-hover'>
					<tr>
					<th colspan=6 align='center'>
					PERPUSTAKAAN MEZAGUS<br>
					BUKTI PEMINJAMAN<br>
					id transaksi : ".$this->input->get('id_trans')."<br>
					<br>
					</th>
					</tr>
					<tr><td colspan=6 align='center'><hr></td>
                    <tr>
                      <th style=width:5%>No</th>
                      <th align='left'  style=width:10%>Admin</th>
                      <th align='left'  style=width:15%>Member</th>
                      <th align='left'  style=width:15%>Inventory</th>
                      <th align='left'  style=width:10%>Tanggal</th>
                      <th align='left'  style=width:10%>Jatuh tempo</th>
                    </tr>
					
					<tr><td colspan=6 align='center'><hr></td>
					";
					
                   
				$no = 0;
				
				foreach($peminjaman as $mn){
				$id_pinjam=$mn->id_peminjaman;
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:top'>$no</td>
					<td style='vertical-align:top'>$mn->nama_lengkap_admin</td>
					<td style='vertical-align:top'>$mn->barcode_member <br>$mn->nama_member
					</td>
					<td style='vertical-align:top'>$mn->barcode_inventory<br>$mn->judul_inventory</td>
					<td style='vertical-align:top'>$mn->tgl_peminjaman</td>
					<td style='vertical-align:top'>$mn->tgl_tempo_peminjaman</td>
					</tr>
					<tr><td colspan=6 align='center'><hr></td>
					</tr>";
					
				}
			echo "</table></div>";
			?>