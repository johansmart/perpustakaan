<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jenis_denda_lainnya extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_jenis_denda_lainnya');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->jenis_denda_lainnya();
	}
	public function jenis_denda_lainnya()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('jenis_denda_lainnya/jenis_denda_lainnya');
		$config['total_rows']      = $this->m_jenis_denda_lainnya->jumlah_jenis_denda_lainnya();
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
		
	    $data['jenis_denda_lainnya'] 	   		   = $this->m_jenis_denda_lainnya->jenis_denda_lainnya($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_jenis_denda_lainnya'] = $this->m_jenis_denda_lainnya->jumlah_jenis_denda_lainnya();
		
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/jenis_denda_lainnya/jenis_denda_lainnya',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
		

	public function jenis_denda_lainnyaadd(){
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/jenis_denda_lainnya/jenis_denda_lainnyaadd');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function jenis_denda_lainnyaadd_proses(){
		$post_jenis_denda_lainnya=$this->input->post('jenis_denda_lainnya');

		if($post_jenis_denda_lainnya=="")
		{
			echo "
				<script>
				alert('isikan nama jenis_denda_lainnya');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			$this->load->model('m_jenis_denda_lainnya');
			$query = $this->m_jenis_denda_lainnya->ceknamajenis_denda_lainnya($this->input->post('jenis_denda_lainnya'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Nama jenis_denda_lainnya telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_jenis_denda_lainnya');
				$query = $this->m_jenis_denda_lainnya->jenis_denda_lainnya_add($this->input->post('jenis_denda_lainnya'));
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/jenis_denda_lainnya"); ?>'
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
	
	public function jenis_denda_lainnya_edit(){
		$this->load->model('m_jenis_denda_lainnya');
		$query['jenis_denda_lainnya'] = $this->m_jenis_denda_lainnya->jenis_denda_lainnya_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/jenis_denda_lainnya/jenis_denda_lainnyaedit',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function jenis_denda_lainnya_edit_proses(){
		$post_nama_jenis_denda_lainnya=$this->input->post('jenis_denda_lainnya');
		$post_nama_jenis_denda_lainnya_awal=$this->input->post('jenis_denda_lainnya_awal');
		$post_id=$this->input->post('id');

		if($post_nama_jenis_denda_lainnya=="")
		{
			echo "
				<script>
				alert('isikan nama jenis_denda_lainnya');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			
			$this->load->model('m_jenis_denda_lainnya');
			$query = $this->m_jenis_denda_lainnya->cekjenis_denda_lainnya_edit($this->input->post('jenis_denda_lainnya'),$this->input->post('jenis_denda_lainnya_awal'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('nama jenis_denda_lainnya telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_jenis_denda_lainnya');
				$query = $this->m_jenis_denda_lainnya->jenis_denda_lainnya_edit_proses();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/jenis_denda_lainnya"); ?>'
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
	public function jenis_denda_lainnya_delete(){
		$this->load->model('m_jenis_denda_lainnya');
		$query = $this->m_jenis_denda_lainnya->jenis_denda_lainnya_delete($this->input->get('id'));
			
		$this->index();
		
	}
	
}

?>