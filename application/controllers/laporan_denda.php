<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_denda extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_pengembalian');
	 	
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->hari_ini();
	}
	public function denda_list_hari_ini_print(){
		$data['denda']=$this->m_pengembalian->list_denda_hari_ini_print();
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$this->load->view('admin/laporan_denda/laporan_denda_hari_ini_print',$data);
	}	
	public function hari_ini(){
	$this->session->set_userdata('search_denda','');
	$this->denda_list_hari_ini();
	}
	public function denda_list_hari_ini()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_denda/denda_list_hari_ini');
		if ($this->input->get('search_denda')==''){
			$cari_kunjungan=$this->session->set_userdata('search_denda',$this->session->userdata('search_denda'));
		}
		else
		{
			$cari_kunjungan=$this->input->get('search_denda');
			$cari_kunjungan=$this->session->set_userdata('search_denda',$this->input->get('search_denda'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_denda','');
		$cari_kunjungan='';
		}
		
		$config['total_rows']      = $this->m_pengembalian->jumlah_list_denda();
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
		
	    $data['denda'] 	   		   = $this->m_pengembalian->list_denda($per_page,$page,$cari_kunjungan);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_denda'] = $this->m_pengembalian->jumlah_list_denda();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_denda/laporan_denda_hari_ini',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	
	//tanggal
	public function tanggal(){
		$this->session->set_userdata('search_denda_tanggal','');
		$this->denda_list_tanggal();
	} 
	
	public function denda_list_tanggal_print(){
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$data['denda']=$this->m_pengembalian->list_denda_tanggal_print();
		$this->load->view('admin/laporan_denda/laporan_denda_tanggal_print',$data);
	}	
	
	public function denda_list_tanggal()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_denda/denda_list_tanggal');
		if ($this->input->get('search_denda_tanggal')==''){
			$cari_kunjungan=$this->session->set_userdata('search_denda_tanggal',$this->session->userdata('search_denda_tanggal'));
		}
		else
		{
			$cari_kunjungan=$this->input->get('search_denda_tanggal');
			$cari_kunjungan=$this->session->set_userdata('search_denda_tanggal',$this->input->get('search_denda_tanggal'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_denda_tanggal','');
		$cari_kunjungan='';
		}
		
		$config['total_rows']      = $this->m_pengembalian->jumlah_list_denda_tanggal();
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
		
	    $data['denda'] 	   		   = $this->m_pengembalian->list_denda_tanggal($per_page,$page,$cari_kunjungan);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_denda'] = $this->m_pengembalian->jumlah_list_denda_tanggal();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_denda/laporan_denda_tanggal',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	//end tanggal
	
	
		//bulan
	public function bulan(){
		$this->session->set_userdata('search_denda_bulan','');
		$this->denda_list_bulan();
	} 
	
	public function denda_list_bulan_print(){
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$data['denda']=$this->m_pengembalian->list_denda_bulan_print();
		$this->load->view('admin/laporan_denda/laporan_denda_bulan_print',$data);
	}	
	
	public function denda_list_bulan()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_denda/denda_list_bulan');
		if ($this->input->get('search_denda_bulan')=="" || $this->input->get('search_denda_tahun')==""){
		
			//$cari_kunjungan_bulan=$this->session->set_userdata('search_denda_bulan',$this->input->get('search_denda_bulan'));
			//$cari_kunjungan_tahun=$this->session->set_userdata('search_denda_tahun',$this->input->get('search_denda_tahun'));
			
			$cari_kunjungan_bulan=$this->session->set_userdata('search_denda_bulan',$this->session->userdata('search_denda_bulan'));
			$cari_kunjungan_tahun=$this->session->set_userdata('search_denda_tahun',$this->session->userdata('search_denda_tahun'));
		}
		else
		{
			$cari_kunjungan_bulan=$this->input->get('search_denda_bulan');
			//$cari_kunjungan_bulan=$this->session->set_userdata('search_denda_bulan',$this->session->userdata('search_denda_bulan'));
			//$cari_kunjungan_tahun=$this->session->set_userdata('search_denda_tahun',$this->session->userdata('search_denda_tahun'));
			$cari_kunjungan_bulan=$this->session->set_userdata('search_denda_bulan',$this->input->get('search_denda_bulan'));
			$cari_kunjungan_tahun=$this->session->set_userdata('search_denda_tahun',$this->input->get('search_denda_tahun'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_denda_bulan','');
		$this->session->set_userdata('search_denda_tahun','');
		$cari_kunjungan_bulan='';
		$cari_kunjungan_tahun='';
		}
		
		$config['total_rows']      = $this->m_pengembalian->jumlah_list_denda_bulan();
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
		
	    $data['denda'] 	   		   = $this->m_pengembalian->list_denda_bulan($per_page,$page,$cari_kunjungan_tahun);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_denda'] = $this->m_pengembalian->jumlah_list_denda_bulan();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_denda/laporan_denda_bulan',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	//end bulan
	//tahun
	public function tahun(){
		$this->session->set_userdata('search_denda_tahun','');
		$this->denda_list_tahun();
	} 
	
	public function denda_list_tahun_print(){
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$data['denda']=$this->m_pengembalian->list_denda_tahun_print();
		$this->load->view('admin/laporan_denda/laporan_denda_tahun_print',$data);
	}	
	
	public function denda_list_tahun()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_denda/denda_list_tahun');
		if ($this->input->get('search_denda_tahun')==''){
			$cari_kunjungan=$this->session->set_userdata('search_denda_tahun',$this->session->userdata('search_denda_tahun'));
		}
		else
		{
			$cari_kunjungan=$this->input->get('search_denda_tahun');
			$cari_kunjungan=$this->session->set_userdata('search_denda_tahun',$this->input->get('search_denda_tahun'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_denda_tahun','');
		$cari_kunjungan='';
		}
		
		$config['total_rows']      = $this->m_pengembalian->jumlah_list_denda_tahun();
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
		
	    $data['denda'] 	   		   = $this->m_pengembalian->list_denda_tahun($per_page,$page,$cari_kunjungan);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_denda'] = $this->m_pengembalian->jumlah_list_denda_tahun();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_denda/laporan_denda_tahun',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	//end tahun
	
	
}

?>