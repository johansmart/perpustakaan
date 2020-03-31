<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_inventory_in extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_inventory_in');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->inventory_in();
	}
	public function inventory_in()	{
		$this->load->library('pagination');
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
		
		$config['base_url']        = site_url('laporan_inventory_in/inventory_in');
		$config['total_rows']      = $this->m_inventory_in->laporan_jumlah_inventory_in();
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
		
	    $data['inventory_in'] 	   		   = $this->m_inventory_in->laporan_inventory_in($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_inventory_in'] = $this->m_inventory_in->laporan_jumlah_inventory_in();
		
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_inventory_in/laporan_inventory_in',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	
	public function inventory_in_print(){
		$data['inventory_in']=$this->m_inventory_in->laporanlist_inventory_inprint();
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$this->load->view('admin/laporan_inventory_in/laporan_inventory_in_print',$data);
	}
		

	
	
}

?>