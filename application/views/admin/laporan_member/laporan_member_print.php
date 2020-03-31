
				
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
                      <th  align ='left' style=width:20%>Barcode</th>
                      <th  align ='left' style=width:10%>No Identitas</th>
                      <th  align ='left' style=width:20%>Nama member</th>
                      <th  align ='left' style=width:10%>Jenis</th>
                      <th  align ='left' style=width:5%>JK</th>
                      <th  align ='left' style=width:25%>TTL</th>
                    </tr>
					
					<tr><td colspan=7 align='center'><hr></td>
					";
				}
                   
				$no = 0;
				
				foreach($member as $mn){
					$no++;
					echo "<tr>";
					echo "<td align='center' style='vertical-align:middle'>$no</td>
					<td style='vertical-align:middle'><img src='".base_url('index.php/barcode/gambar/'.$mn->barcode_member.'?height=80&width=1')."'></td>
					<td style='vertical-align:middle'>$mn->no_identitas_member</td>
					<td style='vertical-align:middle'>$mn->nama_member</td>
					<td style='vertical-align:middle'>$mn->nama_jenis_member</td>
					<td style='vertical-align:middle'>$mn->jenis_kelamin_member</td>
					<td align ='left' style='vertical-align:middle'>$mn->nama_kota, $mn->tanggal_lahir_member</td>
					
					</td>";
					echo "</tr>";
					
				}
				
					echo"<tr><td colspan=7 align='center'><hr></td>
					</td>";
					
			echo "</table>";
			?>
			
			
		
