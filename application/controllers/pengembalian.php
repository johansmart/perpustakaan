<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pengembalian extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_pengembalian');
		$inisial_barcode="MEZ-01-";
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->pengembalian();
	}
	public function pengembalian()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('pengembalian/pengembalian');
		if ($this->input->get('search_inv')==''){
			$cari_pengembalian=$this->session->set_userdata('search_inv',$this->session->userdata('search_inv'));
		}
		else
		{
			$cari_pengembalian=$this->input->get('search_inv');
			$cari_pengembalian=$this->session->set_userdata('search_inv',$this->input->get('search_inv'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_inv','');
		$cari_pengembalian='';
		}
		
		$config['total_rows']      = $this->m_pengembalian->jumlah_list_pengembalianhariini();
		$config['per_page']        = $per_page = $this->db->query('select paging from set_paging')->row()->paging;
		$config['uri_segment']     = 3;
		$config['full_tag_open']   = "<ul class='pagination'>";
		$config['full_tag_close']  ="</ul>";
		$config['num_tag_open']    = '<li>';
		$config['num_tag_close']   = '</li>';
		$config['cur_tag_open']    = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close']   = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open']   = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open']   = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open']  = "<li>";
		$config['first_tagl_close']= "</li>";
		$config['last_tag_open']   = "<li>";
		$config['last_tagl_close'] = "</li>";
		$this->pagination->initialize($config);
		$data['paging']            = $this->pagination->create_links();
		$page 			   		   = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
	    $data['pengembalian'] 	   		   = $this->m_pengembalian->list_pengembalianhariini($per_page,$page,$cari_pengembalian);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_pengembalian'] = $this->m_pengembalian->jumlah_list_pengembalianhariini();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/pengembalian/pengembalian',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	
	public function pengembalian_add(){
		
		
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/pengembalian/pengembalian_add');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function pengembalian_add_proses(){
		
		$post_tgl_tempo="";
		$id_admin=$this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id');
		$post_barcode_member=$this->input->post('barcode_member');
		$post_barcode_inventory=$this->input->post('barcode_inventory');
		$post_id_transaksi=$this->input->post('id_transaksi');
		$post_denda_lain=$this->input->post('denda_lain');
		$post_ket_denda=$this->input->post('ket_denda');
		$post_jumlah_denda_lain=$this->input->post('jumlah_denda_lain');
		$post_tgl=$this->input->post('tgl');
		$post_id_transaksi=$this->input->post('id_transaksi');
		
		
		
		if( $post_barcode_inventory!="" && $post_barcode_member!="")
		{
		
			$this->load->model('m_inventory');
			$this->db->where("barcode_inventory", $post_barcode_inventory);
			$get_id_inv = $this->db->get("tbl_inventory");
			$id_inventory = $get_id_inv->row()->id_inventory;
			
			$this->load->model('m_member');
			$this->db->where("barcode_member", $post_barcode_member);
			$get_id_inv = $this->db->get("tbl_member");
			$id_member = $get_id_inv->row()->id_member;
			
			$this->session->set_userdata('mzgs-perpus-member-kembali', $post_barcode_member);
			
			//hitung telat
			$this->load->model('m_peminjaman');
			$datai = $this->m_peminjaman->inventory_get2($post_barcode_inventory,$post_barcode_member);
			if($datai->num_rows > 0)
			{
				
				foreach($datai->result() as $inv)
				{
					$this->load->model('m_setting');
					$this->db->where("id_setting", 1);
					$get_setting = $this->db->get("tbl_setting");
					$jumdendahari = $get_setting->row()->denda;
					
					$date1=date("Y-m-d");
					$date2=$inv->tgl_tempo_peminjaman;
					$selisih2 = strtotime($date1) -  strtotime($date2);
					$selisih = $selisih2/(60*60*24);
					
					if ($selisih<0){
					$post_tgl_tempo=$inv->tgl_tempo_peminjaman;
					$post_denda_hari=$jumdendahari;
					$post_selisih=0;
					$post_jumlah_denda_telat=0;
					$post_id_transaksi_pinjam=$inv->id_transaksi_peminjaman;
					}
					else{
					$denda_telat=$selisih*$jumdendahari;
					
					$post_tgl_tempo=$date2;
					$post_denda_hari=$jumdendahari;
					$post_selisih=$selisih;
					$post_jumlah_denda_telat=$denda_telat;
					$post_id_transaksi_pinjam=$inv->id_transaksi_peminjaman;
					}
				//	$data["hasil"] = "barcode";
				//	$data["keterangan"] = $post_id_transaksi_pinjam;
				//	echo json_encode($data);
					
				}
			}
			//end hitung
			if( $post_barcode_inventory=="" || $post_barcode_member=="")
			{
				$data["hasil"] = "barcode";
				$data["keterangan"] = "isikan barcode member dan inventory ";
				echo json_encode($data);
			}
			
			elseif($post_tgl_tempo=="")
			{
				$data["hasil"] = "tanggal";
				$data["keterangan"] = "isikan tanggal";
				echo json_encode($data);
			}
			else if($post_denda_lain != '0')
			{
				if ($post_jumlah_denda_lain=='' || $post_ket_denda=='')
				{
					$data["hasil"] = "denda";
					$data["keterangan"] = "<div id='cekdenda' class='alert alert-danger' role='alert'>
					Apabila ada denda lain, silahkan isikan juga :<br>
					- keterangan denda <br>
					- jumlah denda lain. <br><br>
					<b>Jika tidak ada denda lain, pilih - pada jenis denda lain. </b>
					</div>";
					$data["keteranganalert"] = "
					Apabila ada denda lain, silahkan isikan juga : keterangan denda dan jumlah denda lain. Jika tidak ada denda lain, pilih - pada jenis denda lain. "
					;
					echo json_encode($data);
				}
				else 
				{
					$query_cek = $this->m_pengembalian->pengembalian_cek($id_member,$id_inventory,$post_id_transaksi_pinjam);
					if($query_cek->num_rows > 0)
					{
						$data["hasil"] = "cek";
						$data["keterangan"] = "buku telah di kembalikan";
						echo json_encode($data);
					}
					else
					{
						$query = $this->m_pengembalian->pengembalian_add($id_member,$id_admin,$id_inventory,$post_tgl_tempo,$post_tgl,$post_selisih,$post_denda_hari,$post_jumlah_denda_telat,$post_denda_lain,$post_ket_denda,$post_jumlah_denda_lain,$post_id_transaksi);
						
						if($query)
						{
							$query2 = $this->m_pengembalian->peminjaman_edit($id_member,$id_inventory,$post_id_transaksi_pinjam);
					
							$data["hasil"] = "berhasil";
							$data["keterangan"] = "sukses";
							$data["action"]=base_url('index.php/pengembalian');
							$data["isi_list"] = $this->reload_list();
							echo json_encode($data);
							
							
						}
						else
						{
							$data["hasil"] = "gagal";
							echo json_encode($data);
						}
					
					}
					//$query->free_result();
			
			
				}
			}
			
			else 
				{
					$query_cek = $this->m_pengembalian->pengembalian_cek($id_member,$id_inventory,$post_id_transaksi_pinjam);
					if($query_cek->num_rows > 0)
					{
						$data["hasil"] = "cek";
						$data["keterangan"] = "buku telah di kembalikan";
						echo json_encode($data);
					}
					else
					{
						$query = $this->m_pengembalian->pengembalian_add($id_member,$id_admin,$id_inventory,$post_tgl_tempo,$post_tgl,$post_selisih,$post_denda_hari,$post_jumlah_denda_telat,$post_denda_lain,$post_ket_denda,$post_jumlah_denda_lain,$post_id_transaksi);
						
						if($query)
						{
							$query2 = $this->m_pengembalian->peminjaman_edit($id_member,$id_inventory,$post_id_transaksi_pinjam);
					
							$data["hasil"] = "berhasil";
							$data["keterangan"] = "sukses";
							$data["action"]=base_url('index.php/pengembalian');
							$data["isi_list"] = $this->reload_list();
							echo json_encode($data);
							
							
						}
						else
						{
							$data["hasil"] = "gagal";
							echo json_encode($data);
						}
					
					}
					//$query->free_result();
			
			
				}
			
		}
		else {
			$data["hasil"] = "barcode";
			$data["keterangan"] = "isikan barcode member dan inventory ";
			echo json_encode($data);
		}
			
	
	}
	public function pengembalian_cek(){
		$data['pengembalian'] = $this->m_pengembalian->pengembalian_edit($this->input->get('id'));
		$data['category_pengembalian'] = $this->m_category_pengembalian->list_category_pengembalian();
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/pengembalian/pengembalian_cek',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	
	public function pengembalian_edit(){
		$data['pengembalian'] = $this->m_pengembalian->pengembalian_edit($this->input->get('id'));
		$data['category_pengembalian'] = $this->m_category_pengembalian->list_category_pengembalian();
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/pengembalian/pengembalian_edit',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function pengembalian_print(){
		$data['pengembalian'] = $this->m_pengembalian->pengembalian_print($this->input->get('id_trans'));
		$this->load->view('admin/pengembalian/pengembalian_print',$data);
	}

	public function pengembalian_print_baru()
	{
		$data['pengembalian'] = $this->m_pengembalian->pengembalian_print($this->input->get('id_trans'));
		$member = $this->db->get('tbl_member')->result();
		$inventory = $this->db->get('tbl_inventory')->result();
		$peminjaman = $this->db->get('tbl_peminjaman')->result();
		foreach ($data['pengembalian'] as $key => $value) {
			foreach ($member as $key2 => $value2) {
				if ($value->id_member === $value2->id_member) {
					$data['pengembalian'][$key]->nama_member = $value2->nama_member;
					$data['pengembalian'][$key]->id_jenis_member = $value2->id_jenis_member;
					$data['pengembalian'][$key]->no_identitas_member = $value2->no_identitas_member;
				}
			}
		}
		foreach ($data['pengembalian'] as $key => $value) {
			foreach ($inventory as $key2 => $value2) {
				if ($value->id_inventory === $value2->id_inventory) {
					$data['pengembalian'][$key]->judul_inventory = $value2->judul_inventory;
				}
			}
		}

		foreach ($data['pengembalian'] as $key => $value) {
			foreach ($peminjaman as $key2 => $value2) {
				if (($value->id_inventory === $value2->id_inventory) && ($value->id_member === $value2->id_member)) {
					$data['pengembalian'][$key]->tgl_peminjaman = $value2->tgl_peminjaman;
				}
			}
		}

		// var_dump($data['pengembalian']);
		// die;
		$jenismember = $this->db->get('tbl_jenis_member')->result();
		foreach ($data['pengembalian'] as $key => $value) {
			foreach ($jenismember as $key2 => $value2) {
				if ($value->id_jenis_member == $value2->id_jenis_member) {
					$data['pengembalian'][$key]->jenis_member = $value2->nama_jenis_member;
				}
			}
		}
		$data['perpustakaan'] = $this->db->get('r_config')->result();
		$this->load->view('admin/pengembalian/pengembalian_print_baru',$data);
	}
	
	public function pengembalian_finish(){
		$this->session->set_userdata('mzgs-perpus-member-kembali', '');
		$this->session->set_userdata('mzgs-perpus-transaksi-kembali', '');
		$this->pengembalian_add();
	}
	
	public function pengembalian_delete(){
		
			$this->load->model('m_pengembalian');
			$query = $this->m_pengembalian->pengembalian_batal($this->input->get('id_member'),$this->input->get('id_inventory'),$this->input->get('tgl_tempo'));
			$query = $this->m_pengembalian->pengembalian_delete($this->input->get('id'));
			if ($query){
				$this->pengembalian_add();
			}
			else {
				echo "
				<script>
				alert('login gagal');
				window.location.href='javascript:history.back(1);'
				</script>";
			}
		
	}
	
	
	
	public function member_get(){
		
		if($this->input->get('barcode_member')==""){
			$data["hasil"] = "cek";
			$data["ket"] = "<div id='cekmember' class='alert alert-danger' role='alert'>id barcode tidak terdaftar</div>";
			echo json_encode($data);
		}
		else{
		
			$this->load->model('m_member');
			$datai = $this->m_member->member_get($this->input->get('barcode_member'));
			
			if($datai->num_rows > 0)
			{
				foreach($datai->result() as $inv)
				{
					$data["hasil"] = "berhasil";
					$data["ket"] = "berhasil get member";
					$data["identitas"] ="<input readonly type='text' name='identitas2' class='form-control'  value='".$inv->no_identitas_member."'  required='' placeholder='id'>
					<input type='hidden' name='id_member' class='form-control'  value='".$inv->id_member."'  required='' placeholder='id'>";
					$data["nama"] ="<input readonly type='text' name='nama' class='form-control'  value='".$inv->nama_member."'  required='' placeholder='nama'>";
					
				}
			}
			else
			{
				$data["hasil"] = "gagal";
				$data["ket"] = "<div id='cekmember' class='alert alert-danger' role='alert'>id barcode tidak terdaftar</div>";
			}
			echo json_encode($data);
		
		}
		
	}
	
	public function cekdenda(){
		
		
		
	}
	
	
	function reload_list(){
		$isi_list ="";
			
		$pengembalian=$this->m_pengembalian->list_pengembalianadd($this->session->userdata('mzgs-perpus-transaksi-kembali'));
			
				$no = 0;
				$isi_list .=" <table class='table table-hover'>
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
                      <th align='left' style=width:5%>Aksi</th>
                    </tr>";
				foreach($pengembalian as $mn){
					$no++;
					
					$isi_list .="<td align='center' style='vertical-align:middle'>$no</td>
					<td style='vertical-align:middle'>$mn->nama_lengkap_admin</td>
					<td style='vertical-align:middle'>$mn->barcode_member
					</td>
					<td style='vertical-align:middle'>$mn->barcode_inventory</td>
					<td style='vertical-align:middle'>$mn->selisih</td>
					<td style='vertical-align:middle'>$mn->jumlah_denda_telat</td>
					<td style='vertical-align:middle'>$mn->denda_lainnya</td>
					<td align ='center' style='vertical-align:middle'>$mn->ket_denda_lainnya</td>
					<td style='vertical-align:middle'>$mn->total</td>
					<td style='vertical-align:middle'>
					<a id='hapus' href=\"".base_url('index.php/pengembalian/pengembalian_delete?id='.$mn->id_pengembalian.'&id_member='.$mn->id_member.'&id_inventory='.$mn->id_inventory.'&tgl_tempo='.$mn->tgl_tempo.'')."\">
					<button class=\"btn btn-danger\" onclick=\"return confirm('Yakin ingin menghapus?');\">
					<span class=\"glyphicon glyphicon-remove\"></span></button></a>
					</tr>
					<tr><td colspan=10 align='center'><hr></td>
					<tr></tr>";
					}
					$total_semua = $this->m_pengembalian->pengembalian_printtotal($this->session->userdata('mzgs-perpus-transaksi-kembali'));
					foreach($total_semua as $total_semua)
					{
					$isi_list .="
					<td colspan=8 align='center'>
					total semua <td> $total_semua->total_semua
					<tr><td colspan=10 align='center'><hr></td>
					</td>";
					}
					$isi_list .="</table></div>";
				
					
			return  $isi_list;
			
	}
	
	public function inventory_get2(){
		
		$this->load->model('m_peminjaman');
		$datai = $this->m_peminjaman->inventory_get2($this->input->get('barcode'),$this->input->get('barcode_member'));
		if($datai->num_rows > 0)
		{
			foreach($datai->result() as $inv)
			{
				$data["hasil"] = "berhasil";
				$data["ket"] = "berhasil get inventory";
				$data["id"] ="<input readonly type='hidden' id='id2_inventory_get' name='id2' class='form-control'  value='".$inv->id_inventory."'  required='' placeholder='id'>
				<input type='hidden' name='id' id='id_inventory_get' class='form-control'  value='".$inv->id_inventory."'  required='' placeholder='id'>";
				$data["judul"] ="<input readonly type='text' name='judul' id='judul_inventory_get'  class='form-control'  value='".$inv->judul_inventory."'  required='' placeholder='id'>";
				$data["ISBN"] =" <input readonly type='text' name='isbn' id='isbn_inventory_get'  class='form-control'  value='".$inv->ISBN."'  required='' placeholder='id'>";
				$data["tempo"] =" <div class='input-group-addon'>
                        <i class='fa fa-calendar'></i>
                      </div><input type='text' id='tanggal2' name='tgl2'  value='".$inv->tgl_tempo_peminjaman."' class='form-control'  style='height:35px;' placeholder='yyyy/mm/dd'  required='' />
                 ";
				 
				$this->load->model('m_setting');
				$this->db->where("id_setting", 1);
				$get_setting = $this->db->get("tbl_setting");
				$jumdendahari = $get_setting->row()->denda;
				
				$data["denda_hari"] =" <input  type='hidden' id='denda' name='denda' value='".$jumdendahari."' class='form-control'  id='exampleInputEmail1' required='' placeholder='denda'>
                      <input readonly type='number' id='denda2' name='denda2' value='".$jumdendahari."' class='form-control'   id='exampleInputEmail1' required='' placeholder='denda'>
					     ";
				$date1=date("Y-m-d");
				$date2=$inv->tgl_tempo_peminjaman;
				$selisih2 = strtotime($date1) -  strtotime($date2);
				$selisih1 = $selisih2/(60*60*24);
				if($selisih1<0){
				$selisih=0;
				$denda_telat=0;
				}
				else{
				$selisih=$selisih1;
				$denda_telat=$selisih*$jumdendahari;
				}
				//$selisih=$this->db->query('select datediff('.$date1.', '.$date2.') as selisih')->row()->selisih;
				$data["telat"] ="   <input  type='hidden' id='telat' name='telat' class='form-control'  value='".$selisih."' id='exampleInputEmail1' required='' placeholder='telat'>
                      <input readonly type='text' id='telat2' name='telat' class='form-control'  value='".$selisih."' id='exampleInputEmail1' required='' placeholder='telat'>
				    ";
				
				$data["denda_telat"] ="    <input  type='hidden' id='denda_telat' value='$denda_telat' name='denda_telat' class='form-control'   id='exampleInputEmail1' required='' placeholder='denda'>
                      <input readonly type='number' id='denda_telat2' value='$denda_telat' name='denda_telat2' class='form-control'  id='exampleInputEmail1' required='' placeholder='denda'>
				 ";
				
				
				
			}
		}
		else
		{
			$data["hasil"] = "gagal";
			$data["ket"] = "<div id='cekinv' class='alert alert-danger' role='alert'>data tidak tersedia</div>";
		}
		echo json_encode($data);
		
	}
	
	function dateDiff2($dformat, $endDate, $beginDate){
    $date_parts1=explode($dformat, $beginDate);
	$date_parts2=explode($dformat, $endDate);
	
	$start_date=gregoriantojd($date_parts1[1],$date_parts1[2],$date_parts1[0]);
	$end_date=gregoriantojd($date_parts1[1],$date_parts1[2],$date_parts1[0]);
	
	return $end_date - $start_date;
	}
	
	 function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }

    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }

    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Set default diff to 0
      $diffs[$interval] = 0;
      // Create temp time from time1 and interval
      $ttime = strtotime("+1 " . $interval, $time1);
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
 $time1 = $ttime;
 $diffs[$interval]++;
 // Create new temp time from time1 and interval
 $ttime = strtotime("+1 " . $interval, $time1);
      }
    }

    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
 break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
 // Add s if value is not 1
 if ($value != 1) {
   $interval .= "s";
 }
 // Add value and interval to times array
 $times[] = $value . " " . $interval;
 $count++;
      }
    }

    // Return string with times
    return implode(", ", $times);
  }
}

?>