<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Peminjaman extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('m_peminjaman');
		$inisial_barcode="MEZ-01-";
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->peminjaman();
	}
	public function peminjaman()	{
		$this->load->library('pagination');
		$config['base_url'] = site_url('peminjaman/peminjaman');
		if ($this->input->get('search_inv')==''){
			$cari_peminjaman=$this->session->set_userdata('search_inv',$this->session->userdata('search_inv'));
		}
		else
		{
			$cari_peminjaman=$this->input->get('search_inv');
			$cari_peminjaman=$this->session->set_userdata('search_inv',$this->input->get('search_inv'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_inv','');
		$cari_peminjaman='';
		}
		
		$config['total_rows']      = $this->m_peminjaman->jumlah_list_peminjamanhariini();
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
		
	    $data['peminjaman'] 	   		   = $this->m_peminjaman->list_peminjamanhariini($per_page,$page,$cari_peminjaman);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_peminjaman'] = $this->m_peminjaman->jumlah_list_peminjamanhariini();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/peminjaman/peminjaman',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	
	public function peminjaman_add(){
		
		
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/peminjaman/peminjaman_add');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function peminjaman_add_proses(){
		
		
		$id_admin=$this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id');
		$post_barcode_member=$this->input->post('barcode_member');
		$post_barcode_inventory=$this->input->post('barcode_inventory');
		$post_id=$this->input->post('id');
		$post_id_member=$this->input->post('id_member');
		$post_tgl=$this->input->post('tgl');
		$post_tgl2=$this->input->post('tgl2');
		$post_jumlah=$this->input->post('jumlah');
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
			
			$this->session->set_userdata('mzgs-perpus-member-pinjam', $post_barcode_member);
		
			if( $post_barcode_inventory=="" || $post_barcode_member=="")
			{
				$data["hasil"] = "barcode";
				$data["keterangan"] = "isikan barcode member dan inventory ";
				echo json_encode($data);
			}
			elseif($post_jumlah=="" )
			{
				$data["hasil"] = "jumlah";
				$data["keterangan"] = "isikan jumlah";
				echo json_encode($data);
			}
			elseif($post_tgl=="" || $post_tgl2=="" )
			{
				$data["hasil"] = "tanggal";
				$data["keterangan"] = "isikan tanggal";
				echo json_encode($data);
			}
			else 
			{
				$query_cek = $this->m_peminjaman->peminjaman_cek($id_member,$id_inventory);
				if($query_cek->num_rows > 0)
				{
					$data["hasil"] = "cek";
					$data["keterangan"] = "member telah meminjam buku yang sama dan belum mengembalikan";
					echo json_encode($data);
				}
				else
				{
					$this->load->model('m_setting');
					$this->db->where("id_setting", 1);
					$get_setting = $this->db->get("tbl_setting");
					$maxpinjam = $get_setting->row()->max_peminjaman_perhari;
					
					$query_cekmax = $this->m_peminjaman->peminjaman_cekmax($id_member,$post_tgl);
					if($query_cekmax->num_rows > $maxpinjam)
					{
						$data["hasil"] = "max";
						$data["keterangan"] = "member mencapai batas maksimal peminjaman per hari";
						echo json_encode($data);
					}
					else
					{
						$query = $this->m_peminjaman->peminjaman_add($id_admin,$id_member,$id_inventory,$post_jumlah,$post_tgl,$post_tgl2,$post_id_transaksi);
						
						if($query)
						{
							$data["hasil"] = "berhasil";
							$data["keterangan"] = "sukses";
							$data["action"]=base_url('index.php/peminjaman');
							$data["isi_list"] = $this->reload_list();
							echo json_encode($data);
							
							
						}
						else
						{
							$data["hasil"] = "gagal";
							echo json_encode($data);
						}
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
	public function peminjaman_cek(){
		$data['peminjaman'] = $this->m_peminjaman->peminjaman_edit($this->input->get('id'));
		$data['category_peminjaman'] = $this->m_category_peminjaman->list_category_peminjaman();
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/peminjaman/peminjaman_cek',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	
	public function peminjaman_edit(){
		$data['peminjaman'] = $this->m_peminjaman->peminjaman_edit($this->input->get('id'));
		$data['category_peminjaman'] = $this->m_category_peminjaman->list_category_peminjaman();
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/peminjaman/peminjaman_edit',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function peminjaman_print(){
		$data['peminjaman'] = $this->m_peminjaman->peminjaman_print($this->input->get('id_trans'));
		$this->load->view('admin/peminjaman/peminjaman_print',$data);
	}

	public function peminjaman_print_baru()
	{
		$data['peminjaman'] = $this->m_peminjaman->peminjaman_print($this->input->get('id_trans'));
		$jenismember = $this->db->get('tbl_jenis_member')->result();
		foreach ($data['peminjaman'] as $key => $value) {
			foreach ($jenismember as $key2 => $value2) {
				if ($value->id_jenis_member == $value2->id_jenis_member) {
					$data['peminjaman'][$key]->jenis_member = $value2->nama_jenis_member;
				}
			}
		}
		$data['perpustakaan'] = $this->db->get('r_config')->result();
		$this->load->view('admin/peminjaman/peminjaman_print_baru',$data);
	}
	
	public function peminjaman_finish(){
		$this->session->set_userdata('mzgs-perpus-member-pinjam', '');
		$this->session->set_userdata('mzgs-perpus-transaksi-pinjam', '');
		$this->peminjaman_add();
	}
	
	public function peminjaman_delete(){
			$this->load->model('m_peminjaman');
			$query = $this->m_peminjaman->peminjaman_delete($this->input->get('id'));
			if ($query){
				$this->peminjaman_add();
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
	
	function reload_list(){
		$isi_list ="";
			
		$peminjaman=$this->m_peminjaman->list_peminjamanadd($this->session->userdata('mzgs-perpus-transaksi-pinjam'));
			
				$no = 0;
				$isi_list .=" <table class='table table-hover'>
                    <tr>
                      <th style=width:5%>No</th>
                      <th style=width:10%>Admin</th>
                      <th style=width:15%>Member</th>
                      <th style=width:15%>Inventory</th>
                      <th style=width:10%>Tanggal</th>
                      <th style=width:10%>Jatuh tempo</th>
                      <th style=width:5%>Status</th>
                      <th style=width:15%>Action</th>
                    </tr>";
				foreach($peminjaman as $mn){
				$id_pinjam=$mn->id_peminjaman;
					$no++;
					
					$isi_list .="<tr><td align='center' style='vertical-align:middle'>$no</td>
					<td style='vertical-align:middle'>$mn->nama_lengkap_admin</td>
					<td style='vertical-align:middle'>$mn->barcode_member
					</td>
					<td style='vertical-align:middle'>$mn->barcode_inventory</td>
					<td style='vertical-align:middle'>$mn->tgl_peminjaman</td>
					<td style='vertical-align:middle'>$mn->tgl_tempo_peminjaman</td>
					<td align ='center' style='vertical-align:middle'>$mn->status_peminjaman</td>
					
					<td align='center' style='vertical-align:middle'>
		
					
						<a id='hapus' href=\"".base_url('index.php/peminjaman/peminjaman_delete?id='.$mn->id_peminjaman)."\">
					<button class=\"btn btn-danger\" onclick=\"return confirm('Yakin ingin menghapus?');\">
					<span class=\"glyphicon glyphicon-remove\"></span></button></a>
					</td></tr>";
				}
					
			return  $isi_list;
			
	}

}

?>