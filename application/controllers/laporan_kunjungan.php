<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_kunjungan extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_kunjungan');
	 	
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->hari_ini();
	}
	public function kunjungan_list_hari_ini_print(){
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$data['kunjungan']=$this->m_kunjungan->list_kunjungan_hari_ini_print();
		$this->load->view('admin/laporan_kunjungan/laporan_kunjungan_hari_ini_print',$data);
	}	
	public function hari_ini(){
	$this->session->set_userdata('search_kunjungan','');
	$this->kunjungan_list_hari_ini();
	}
	public function kunjungan_list_hari_ini()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_kunjungan/kunjungan_list_hari_ini');
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
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_kunjungan/laporan_kunjungan_hari_ini',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	
	//laporan tanggal
	public function tanggal()	{
	$this->session->set_userdata('search_kunjungan_tanggal','');
	$this->kunjungan_list_tanggal();
	}
	public function kunjungan_list_tanggal_print(){
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$data['kunjungan']=$this->m_kunjungan->list_kunjungan_tanggal_print();
		$this->load->view('admin/laporan_kunjungan/laporan_kunjungan_tanggal_print',$data);
	}	
	
	public function kunjungan_list_tanggal()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_kunjungan/kunjungan_list_tanggal');
		if ($this->input->get('search_kunjungan_tanggal')==''){
			$cari_kunjungan=$this->session->set_userdata('search_kunjungan_tanggal',$this->session->userdata('search_kunjungan_tanggal'));
		}
		else
		{
			$cari_kunjungan=$this->input->get('search_kunjungan_tanggal');
			$cari_kunjungan=$this->session->set_userdata('search_kunjungan_tanggal',$this->input->get('search_kunjungan_tanggal'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_kunjungan_tanggal','');
		$cari_kunjungan='';
		}
		
		$config['total_rows']      = $this->m_kunjungan->jumlah_list_kunjungan_tanggal();
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
		
	    $data['kunjungan'] 	   		   = $this->m_kunjungan->list_kunjungan_tanggal($per_page,$page,$cari_kunjungan);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_kunjungan'] = $this->m_kunjungan->jumlah_list_kunjungan_tanggal();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_kunjungan/laporan_kunjungan_tanggal',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	//end lap tanggal
	
	
	//laporan bulan
	public function bulan()	{
	$this->session->set_userdata('search_kunjungan_bulan','');
	$this->kunjungan_list_bulan();
	}
	public function kunjungan_list_bulan_print(){
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$data['kunjungan']=$this->m_kunjungan->list_kunjungan_bulan_print();
		$this->load->view('admin/laporan_kunjungan/laporan_kunjungan_bulan_print',$data);
	}	
	
	public function kunjungan_list_bulan()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_kunjungan/kunjungan_list_bulan');
		if ($this->input->get('search_kunjungan_bulan')=="" || $this->input->get('search_kunjungan_tahun')==""){
		
			//$cari_kunjungan_bulan=$this->session->set_userdata('search_kunjungan_bulan',$this->input->get('search_kunjungan_bulan'));
			//$cari_kunjungan_tahun=$this->session->set_userdata('search_kunjungan_tahun',$this->input->get('search_kunjungan_tahun'));
			
			$cari_kunjungan_bulan=$this->session->set_userdata('search_kunjungan_bulan',$this->session->userdata('search_kunjungan_bulan'));
			$cari_kunjungan_tahun=$this->session->set_userdata('search_kunjungan_tahun',$this->session->userdata('search_kunjungan_tahun'));
		}
		else
		{
			$cari_kunjungan_bulan=$this->input->get('search_kunjungan_bulan');
			//$cari_kunjungan_bulan=$this->session->set_userdata('search_kunjungan_bulan',$this->session->userdata('search_kunjungan_bulan'));
			//$cari_kunjungan_tahun=$this->session->set_userdata('search_kunjungan_tahun',$this->session->userdata('search_kunjungan_tahun'));
			$cari_kunjungan_bulan=$this->session->set_userdata('search_kunjungan_bulan',$this->input->get('search_kunjungan_bulan'));
			$cari_kunjungan_tahun=$this->session->set_userdata('search_kunjungan_tahun',$this->input->get('search_kunjungan_tahun'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_kunjungan_bulan','');
		$this->session->set_userdata('search_kunjungan_tahun','');
		$cari_kunjungan='';
		}
		
		$config['total_rows']      = $this->m_kunjungan->jumlah_list_kunjungan_bulan();
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
		
	    $data['kunjungan'] 	   		   = $this->m_kunjungan->list_kunjungan_bulan($per_page,$page,$cari_kunjungan_bulan,$cari_kunjungan_tahun);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_kunjungan'] = $this->m_kunjungan->jumlah_list_kunjungan_bulan();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_kunjungan/laporan_kunjungan_bulan',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	//end lap bulan
	
	
		//laporan tahun
	public function tahun()	{
	$this->session->set_userdata('search_kunjungan_tahun','');
	$this->kunjungan_list_tahun();
	}
	public function kunjungan_list_tahun_print(){
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$data['kunjungan']=$this->m_kunjungan->list_kunjungan_tahun_print();
		$this->load->view('admin/laporan_kunjungan/laporan_kunjungan_tahun_print',$data);
	}	
	
	public function kunjungan_list_tahun()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_kunjungan/kunjungan_list_tahun');
		if ($this->input->get('search_kunjungan_tahun')==''){
			$cari_kunjungan=$this->session->set_userdata('search_kunjungan_tahun',$this->session->userdata('search_kunjungan_tahun'));
		}
		else
		{
			$cari_kunjungan=$this->input->get('search_kunjungan_tahun');
			$cari_kunjungan=$this->session->set_userdata('search_kunjungan_tahun',$this->input->get('search_kunjungan_tahun'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_kunjungan_tahun','');
		$cari_kunjungan='';
		}
		
		$config['total_rows']      = $this->m_kunjungan->jumlah_list_kunjungan_tahun();
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
		
	    $data['kunjungan'] 	   		   = $this->m_kunjungan->list_kunjungan_tahun($per_page,$page,$cari_kunjungan);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_kunjungan'] = $this->m_kunjungan->jumlah_list_kunjungan_tahun();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_kunjungan/laporan_kunjungan_tahun',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	//end lap tahun
	
}

?>