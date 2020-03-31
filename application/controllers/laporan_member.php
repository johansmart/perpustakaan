<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_member extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_member');
	 	
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->member();
	}
	public function member()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_member/member');
		if ($this->input->get('search_mmbr')==''){
			$cari_member=$this->session->set_userdata('search_mmbr',$this->session->userdata('search_mmbr'));
		}
		else
		{
			$cari_member=$this->input->get('search_mmbr');
			$cari_member=$this->session->set_userdata('search_mmbr',$this->input->get('search_mmbr'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_mmbr','');
		$cari_member='';
		}
		
		$config['total_rows']      = $this->m_member->laporanjumlah_list_member();
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
		
	    $data['member'] 	   		   = $this->m_member->laporanlist_member($per_page,$page,$cari_member);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_member'] = $this->m_member->laporanjumlah_list_member();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_member/laporan_member',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function member_print(){
		$data['member']=$this->m_member->laporanlist_memberprint();
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$this->load->view('admin/laporan_member/laporan_member_print',$data);
	}
	
	//aktivitas
	public function memberaktivitas()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('laporan_member/memberaktivitas');
		if ($this->input->get('search_mmbr')==''){
			$cari_member=$this->session->set_userdata('search_mmbr',$this->session->userdata('search_mmbr'));
		}
		else
		{
			$cari_member=$this->input->get('search_mmbr');
			$cari_member=$this->session->set_userdata('search_mmbr',$this->input->get('search_mmbr'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_mmbr','');
		$cari_member='';
		}
		
		$config['total_rows']      = $this->m_member->laporanjumlah_list_member();
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
		
	    $data['member'] 	   		   = $this->m_member->laporanlist_member($per_page,$page,$cari_member);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_member'] = $this->m_member->laporanjumlah_list_member();
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/laporan_member/laporan_member_aktivitas',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function memberaktivitas_print(){
		$data['member']=$this->m_member->laporanlist_memberprint();
		$this->load->model('m_setting');
		$data['perpustakaan'] = $this->m_setting->readLibrary();
		$this->load->view('admin/laporan_member/laporan_member_aktivitas_print',$data);
	}
	
}

?>