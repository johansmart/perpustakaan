<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Letak_rak extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_letak_rak');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->letak_rak();
	}
	public function letak_rak()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('letak_rak/letak_rak');
		$config['total_rows']      = $this->m_letak_rak->jumlah_letak_rak();
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
		
	    $data['letak_rak'] 	   		   = $this->m_letak_rak->letak_rak($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_letak_rak'] = $this->m_letak_rak->jumlah_letak_rak();
		
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/letak_rak/letak_rak',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
		

	public function letak_rakadd(){
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/letak_rak/letak_rakadd');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function letak_rakadd_proses(){
		$post_letak_rak=$this->input->post('letak_rak');

		if($post_letak_rak=="")
		{
			echo "
				<script>
				alert('isikan nama letak_rak');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			$this->load->model('m_letak_rak');
			$query = $this->m_letak_rak->ceknamaletak_rak($this->input->post('letak_rak'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Nama letak_rak telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_letak_rak');
				$query = $this->m_letak_rak->letak_rak_add($this->input->post('letak_rak'));
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/letak_rak"); ?>'
					</script><?php 
					
				}
				else
				{
					echo "
					<script>
					alert('Gagal');
					window.location.href='javascript:history.back(1);'
					</script>";
				}
				//$query->free_result();
			}
			
		}
		
	}
	
	public function letak_rak_edit(){
		$this->load->model('m_letak_rak');
		$query['letak_rak'] = $this->m_letak_rak->letak_rak_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/letak_rak/letak_rakedit',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function letak_rak_edit_proses(){
		$post_nama_letak_rak=$this->input->post('letak_rak');
		$post_nama_letak_rak_awal=$this->input->post('letak_rak_awal');
		$post_id=$this->input->post('id');

		if($post_nama_letak_rak=="")
		{
			echo "
				<script>
				alert('isikan nama letak_rak');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			
			$this->load->model('m_letak_rak');
			$query = $this->m_letak_rak->cekletak_rak_edit($this->input->post('letak_rak'),$this->input->post('letak_rak_awal'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('nama letak_rak telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_letak_rak');
				$query = $this->m_letak_rak->letak_rak_edit_proses();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/letak_rak"); ?>'
					</script><?php 
					
				}
				else
				{
					echo "
					<script>
					alert('Gagal');
					window.location.href='javascript:history.back(1);'
					</script>";
				}
				//$query->free_result();
			}
			
		}
		
		
	}
	public function letak_rak_delete(){
		$this->load->model('m_letak_rak');
		$query = $this->m_letak_rak->letak_rak_delete($this->input->get('id'));
			
		$this->index();
		
	}
	
	public function letak_rak_refresh(){
		$data["isi_letak_rak"] = $this->reload_letak_rak();
		echo json_encode($data);
		
	}
	function reload_letak_rak(){
		$isi_letak_rak="";
		$this->load->model('m_letak_rak');
		$letak_rak = $this->m_letak_rak->select_letak_rak();
		if(count($letak_rak)>0)
		{
			foreach($letak_rak as $letak_rak)
			{
				$isi_letak_rak .=" <option value=".$letak_rak->id_letak_rak.">".$letak_rak->nama_letak_rak."</option>";
			}
		}
		return  $isi_letak_rak;
			
	}
}

?>