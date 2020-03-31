<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Perpus extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
	 	
 	}
	public function index()	{
		//$this->load->view('template_perpus/head');
		//$this->load->view('template_perpus/header');
		//$this->load->view('template_perpus/content');
		//$this->load->view('template_perpus/footer');
		//$this->load->view('template_perpus/inc_js');
		$this->absen();
	}
	public function buku()	{
		$this->session->set_userdata('search_inv','');
		$cari_inventory='';
		$this->inventory();
	}
	public function inventorydetail(){
		$data['inventory'] = $this->m_inventory->inventory_edit($this->input->get('id'));
		$data['category_inventory'] = $this->m_category_inventory->list_category_inventory();
			
		
		$this->load->view('template_perpus/head');
		$this->load->view('template_perpus/header');
		$this->load->view('perpus/buku_detail',$data);
		$this->load->view('template_perpus/inc_js');
		
		
	
	}
	public function inventory()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('perpus/inventory');
		if ($this->input->get('search_inv')==''){
			$cari_inventory=$this->session->set_userdata('search_inv',$this->session->userdata('search_inv'));
		}
		else
		{
			$cari_inventory=$this->input->get('search_inv');
			$cari_inventory=$this->session->set_userdata('search_inv',$this->input->get('search_inv'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_inv','');
		$cari_inventory='';
		}
		
		$config['total_rows']      = $this->m_inventory->jumlah_list_inventory();
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
		
	    $data['inventory'] 	   		   = $this->m_inventory->list_inventory($per_page,$page,$cari_inventory);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_inventory'] = $this->m_inventory->jumlah_list_inventory();
		
		$this->load->view('template_perpus/head');
		$this->load->view('template_perpus/header');
		$this->load->view('perpus/buku',$data);
		$this->load->view('template_perpus/inc_js');
	
	}
	public function absen()	{
		$this->load->view('template_perpus/head');
		$this->load->view('template_perpus/header');
		$this->load->view('perpus/absen_kunjungan');
		$this->load->view('template_perpus/inc_js');
	}
	
	public function absen_proses()	{
		$post_barcode_kunjungan=$this->input->post('barcode');
		
		if( $post_barcode_kunjungan!="")
		{
			
			$this->load->model('m_kunjungan');
			$query = $this->m_kunjungan->kunjungan_cek($post_barcode_kunjungan);
			if($query->num_rows > 0)
			{
				
			
				$this->load->model('m_member');
				$this->db->where("barcode_member", $post_barcode_kunjungan);
				$get_id_inv = $this->db->get("tbl_member");
				$id_member = $get_id_inv->row()->id_member;
				
				$this->load->model('m_kunjungan');
				$query = $this->m_kunjungan->kunjungan_cekabsensi($id_member);
				if($query->num_rows > 0)
				{
					$data["hasil"] = "gagal";
					$data["keterangan"] = "member sudah dicatat kunjungannya";
					echo json_encode($data);
				}
				else
				{
					$this->load->model('m_kunjungan');
					$query = $this->m_kunjungan->kunjungan_add($id_member);
						if($query)
						{
							$jumlah_kunjungan = $this->m_kunjungan->jumlah_list_kunjungan();
							
							$data["jumlah"] = "<div id='jumlah'><h4 class='box-title' > jumlah kunjungan hari ini : <b> ".$jumlah_kunjungan." </b>member </h4> <br></div>";
							$data["hasil"] = "berhasil";
							$data["keterangan"] = "sukses";
							$data["action"]=base_url('index.php/perpus/absen');
							$data["isi_list"] = $this->reload_list();
							echo json_encode($data);
									
									
						}
				}
			}
			else
			{
					$data["hasil"] = "gagal";
					$data["keterangan"] = "kunjungan tidak terdaftar";
					echo json_encode($data);
			}
		}
			
	}

	
		function reload_list(){
		$isi_list ="";
			
		$kunjungan=$this->m_kunjungan->list_kunjungannow();
			
				$no = 0;
				$isi_list .=" <table class='table table-hover'>
                    <tr>
                      <th align='left' style=width:5%>No</th>
                      <th align='left' style=width:15%>No Id Member</th>
                      <th align='left' style=width:15%>Nama Member</th>
                    </tr>";
				foreach($kunjungan as $mn){
					$no++;
					
					$isi_list .="<td align='center' style='vertical-align:middle'>$no</td>
					<td style='vertical-align:middle'>$mn->no_identitas_member
					<td style='vertical-align:middle'>$mn->nama_member
					</td></tr>";
					}
					
				
					
			return  $isi_list;
			
	}
	
	public function kunjungan()	{
	$this->session->set_userdata('search_kunjungan','');
	$this->kunjungan_list();
	}
	public function kunjungan_list()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('perpus/kunjungan_list');
		if ($this->input->get('search_kunjungan')==''){
			$cari_kunjungan=$this->session->set_userdata('search_kunjungan',$this->session->userdata('search_kunjungan'));
		}
		else
		{
			$cari_kunjungan=$this->input->get('search_kunjungan');
			$cari_kunjungan=$this->session->set_userdata('search_kunjungan',$this->input->get('search_kunjungan'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_kunjungan','');
		$cari_kunjungan='';
		}
		
		$config['total_rows']      = $this->m_kunjungan->jumlah_list_kunjungan();
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
		
	    $data['kunjungan'] 	   		   = $this->m_kunjungan->list_kunjungan($per_page,$page,$cari_kunjungan);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_kunjungan'] = $this->m_kunjungan->jumlah_list_kunjungan();
		
		$this->load->view('template_perpus/head');
		$this->load->view('template_perpus/header');
		$this->load->view('perpus/kunjungan',$data);
		$this->load->view('template_perpus/inc_js');
	
	}
	
}

?>