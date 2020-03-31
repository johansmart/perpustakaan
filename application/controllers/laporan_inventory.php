<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_inventory extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_member');
		$this->load->model('m_setting');
	 	
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->inventory();
	}
	public function inventory()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_inventory/inventory');
		if ($this->input->get('lap_search_inv_in')==''){
			$cari_inventory=$this->session->set_userdata('lap_search_inv_in',$this->session->userdata('lap_search_inv_in'));
		}
		else
		{
			$cari_inventory=$this->input->get('lap_search_inv_in');
			$cari_inventory=$this->session->set_userdata('lap_search_inv_in',$this->input->get('lap_search_inv_in'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('lap_search_inv_in','');
		$cari_inventory='';
		}
		
		$config['total_rows']      = $this->m_inventory->laporan_jumlah_list_inventory();
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
		
	    $data['inventory'] 	   		   = $this->m_inventory->laporan_list_inventory($per_page,$page,$cari_inventory);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_inventory'] = $this->m_inventory->laporan_jumlah_list_inventory();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_inventory/laporan_inventory',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function inventory_print(){
		$data['inventory']=$this->m_inventory->laporanlist_inventoryprint();
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$this->load->view('admin/laporan_inventory/laporan_inventory_print',$data);
	}
	public function inventory_stat()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_inventory/inventory_stat');
		if ($this->input->get('lap_search_inv_in')==''){
			$cari_inventory=$this->session->set_userdata('lap_search_inv_in',$this->session->userdata('lap_search_inv_in'));
		}
		else
		{
			$cari_inventory=$this->input->get('lap_search_inv_in');
			$cari_inventory=$this->session->set_userdata('lap_search_inv_in',$this->input->get('lap_search_inv_in'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('lap_search_inv_in','');
		$cari_inventory='';
		}
		
		$config['total_rows']      = $this->m_inventory->laporan_jumlah_list_inventory();
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
		
	    $data['inventory'] 	   		   = $this->m_inventory->laporan_list_inventory($per_page,$page,$cari_inventory);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_inventory'] = $this->m_inventory->laporan_jumlah_list_inventory();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_inventory/laporan_inventory_stat',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function inventory_stat_print(){
		$data['inventory']=$this->m_inventory->laporanlist_inventoryprint();
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$this->load->view('admin/laporan_inventory/laporan_inventory_stat_print',$data);
	}
	
}

?>