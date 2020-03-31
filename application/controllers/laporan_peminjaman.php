<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_peminjaman extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_peminjaman');
	 	
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->hari_ini();
	}
	public function peminjaman_list_hari_ini_print(){
		$data['peminjaman']=$this->m_peminjaman->list_peminjaman_hari_ini_print();
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$this->load->view('admin/laporan_peminjaman/laporan_peminjaman_hari_ini_print',$data);
	}	
	public function hari_ini(){
	$this->session->set_userdata('search_peminjaman','');
	$this->peminjaman_list_hari_ini();
	}
	public function peminjaman_list_hari_ini()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_peminjaman/peminjaman_list_hari_ini');
		if ($this->input->get('search_peminjaman')==''){
			$cari_kunjungan=$this->session->set_userdata('search_peminjaman',$this->session->userdata('search_peminjaman'));
		}
		else
		{
			$cari_kunjungan=$this->input->get('search_peminjaman');
			$cari_kunjungan=$this->session->set_userdata('search_peminjaman',$this->input->get('search_peminjaman'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_peminjaman','');
		$cari_kunjungan='';
		}
		
		$config['total_rows']      = $this->m_peminjaman->jumlah_list_peminjaman_hariini();
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
		
	    $data['peminjaman'] 	   		   = $this->m_peminjaman->list_peminjaman_hariini($per_page,$page,$cari_kunjungan);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_peminjaman'] = $this->m_peminjaman->jumlah_list_peminjaman_hariini();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_peminjaman/laporan_peminjaman_hari_ini',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	
	//tanggal
	public function tanggal(){
		$this->session->set_userdata('search_peminjaman_tanggal','');
		$this->peminjaman_list_tanggal();
	} 
	
	public function peminjaman_list_tanggal_print(){
		$data['peminjaman']=$this->m_peminjaman->list_peminjaman_tanggal_print();
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$this->load->view('admin/laporan_peminjaman/laporan_peminjaman_tanggal_print',$data);
	}	
	
	public function peminjaman_list_tanggal()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_peminjaman/peminjaman_list_tanggal');
		if ($this->input->get('search_peminjaman_tanggal')==''){
			$cari_kunjungan=$this->session->set_userdata('search_peminjaman_tanggal',$this->session->userdata('search_peminjaman_tanggal'));
		}
		else
		{
			$cari_kunjungan=$this->input->get('search_peminjaman_tanggal');
			$cari_kunjungan=$this->session->set_userdata('search_peminjaman_tanggal',$this->input->get('search_peminjaman_tanggal'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_peminjaman_tanggal','');
		$cari_kunjungan='';
		}
		
		$config['total_rows']      = $this->m_peminjaman->jumlah_list_peminjaman_tanggal();
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
		
	    $data['peminjaman'] 	   		   = $this->m_peminjaman->list_peminjaman_tanggal($per_page,$page,$cari_kunjungan);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_peminjaman'] = $this->m_peminjaman->jumlah_list_peminjaman_tanggal();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_peminjaman/laporan_peminjaman_tanggal',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	//end tanggal
	
	
		//bulan
	public function bulan(){
		$this->session->set_userdata('search_peminjaman_bulan','');
		$this->peminjaman_list_bulan();
	} 
	
	public function peminjaman_list_bulan_print(){
		$data['peminjaman']=$this->m_peminjaman->list_peminjaman_bulan_print();
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$this->load->view('admin/laporan_peminjaman/laporan_peminjaman_bulan_print',$data);
	}	
	
	public function peminjaman_list_bulan()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_peminjaman/peminjaman_list_bulan');
		if ($this->input->get('search_peminjaman_bulan')=="" || $this->input->get('search_peminjaman_tahun')==""){
		
			//$cari_kunjungan_bulan=$this->session->set_userdata('search_peminjaman_bulan',$this->input->get('search_peminjaman_bulan'));
			//$cari_kunjungan_tahun=$this->session->set_userdata('search_peminjaman_tahun',$this->input->get('search_peminjaman_tahun'));
			
			$cari_kunjungan_bulan=$this->session->set_userdata('search_peminjaman_bulan',$this->session->userdata('search_peminjaman_bulan'));
			$cari_kunjungan_tahun=$this->session->set_userdata('search_peminjaman_tahun',$this->session->userdata('search_peminjaman_tahun'));
		}
		else
		{
			$cari_kunjungan_bulan=$this->input->get('search_peminjaman_bulan');
			//$cari_kunjungan_bulan=$this->session->set_userdata('search_peminjaman_bulan',$this->session->userdata('search_peminjaman_bulan'));
			//$cari_kunjungan_tahun=$this->session->set_userdata('search_peminjaman_tahun',$this->session->userdata('search_peminjaman_tahun'));
			$cari_kunjungan_bulan=$this->session->set_userdata('search_peminjaman_bulan',$this->input->get('search_peminjaman_bulan'));
			$cari_kunjungan_tahun=$this->session->set_userdata('search_peminjaman_tahun',$this->input->get('search_peminjaman_tahun'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_peminjaman_bulan','');
		$this->session->set_userdata('search_peminjaman_tahun','');
		$cari_kunjungan_bulan='';
		$cari_kunjungan_tahun='';
		}
		
		$config['total_rows']      = $this->m_peminjaman->jumlah_list_peminjaman_bulan();
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
		
	    $data['peminjaman'] 	   		   = $this->m_peminjaman->list_peminjaman_bulan($per_page,$page,$cari_kunjungan_tahun);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_peminjaman'] = $this->m_peminjaman->jumlah_list_peminjaman_bulan();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_peminjaman/laporan_peminjaman_bulan',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	//end bulan
	//tahun
	public function tahun(){
		$this->session->set_userdata('search_peminjaman_tahun','');
		$this->peminjaman_list_tahun();
	} 
	
	public function peminjaman_list_tahun_print(){
		$data['peminjaman']=$this->m_peminjaman->list_peminjaman_tahun_print();
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$this->load->view('admin/laporan_peminjaman/laporan_peminjaman_tahun_print',$data);
	}	
	
	public function peminjaman_list_tahun()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_peminjaman/peminjaman_list_tahun');
		if ($this->input->get('search_peminjaman_tahun')==''){
			$cari_kunjungan=$this->session->set_userdata('search_peminjaman_tahun',$this->session->userdata('search_peminjaman_tahun'));
		}
		else
		{
			$cari_kunjungan=$this->input->get('search_peminjaman_tahun');
			$cari_kunjungan=$this->session->set_userdata('search_peminjaman_tahun',$this->input->get('search_peminjaman_tahun'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_peminjaman_tahun','');
		$cari_kunjungan='';
		}
		
		$config['total_rows']      = $this->m_peminjaman->jumlah_list_peminjaman_tahun();
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
		
	    $data['peminjaman'] 	   		   = $this->m_peminjaman->list_peminjaman_tahun($per_page,$page,$cari_kunjungan);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_peminjaman'] = $this->m_peminjaman->jumlah_list_peminjaman_tahun();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_peminjaman/laporan_peminjaman_tahun',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	//end tahun
	
	
}

?>