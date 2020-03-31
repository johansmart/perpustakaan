<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mata_pelajaran extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_mata_pelajaran');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->mata_pelajaran();
	}
	public function mata_pelajaran()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('mata_pelajaran/mata_pelajaran');
		$config['total_rows']      = $this->m_mata_pelajaran->jumlah_mata_pelajaran();
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
		
	    $data['mata_pelajaran'] 	   		   = $this->m_mata_pelajaran->mata_pelajaran($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_mata_pelajaran'] = $this->m_mata_pelajaran->jumlah_mata_pelajaran();
		
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/mata_pelajaran/mata_pelajaran',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
		

	public function mata_pelajaranadd(){
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/mata_pelajaran/mata_pelajaranadd');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function mata_pelajaranadd_proses(){
		$post_mata_pelajaran=$this->input->post('mata_pelajaran');

		if($post_mata_pelajaran=="")
		{
			echo "
				<script>
				alert('isikan nama mata_pelajaran');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			$this->load->model('m_mata_pelajaran');
			$query = $this->m_mata_pelajaran->ceknamamata_pelajaran($this->input->post('mata_pelajaran'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Nama mata_pelajaran telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_mata_pelajaran');
				$query = $this->m_mata_pelajaran->mata_pelajaran_add($this->input->post('mata_pelajaran'));
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/mata_pelajaran"); ?>'
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
	
	public function mata_pelajaran_edit(){
		$this->load->model('m_mata_pelajaran');
		$query['mata_pelajaran'] = $this->m_mata_pelajaran->mata_pelajaran_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/mata_pelajaran/mata_pelajaranedit',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function mata_pelajaran_edit_proses(){
		$post_nama_mata_pelajaran=$this->input->post('mata_pelajaran');
		$post_nama_mata_pelajaran_awal=$this->input->post('mata_pelajaran_awal');
		$post_id=$this->input->post('id');

		if($post_nama_mata_pelajaran=="")
		{
			echo "
				<script>
				alert('isikan nama mata_pelajaran');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			
			$this->load->model('m_mata_pelajaran');
			$query = $this->m_mata_pelajaran->cekmata_pelajaran_edit($this->input->post('mata_pelajaran'),$this->input->post('mata_pelajaran_awal'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('nama mata_pelajaran telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_mata_pelajaran');
				$query = $this->m_mata_pelajaran->mata_pelajaran_edit_proses();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/mata_pelajaran"); ?>'
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
	public function mata_pelajaran_delete(){
		$this->load->model('m_mata_pelajaran');
		$query = $this->m_mata_pelajaran->mata_pelajaran_delete($this->input->get('id'));
			
		$this->index();
		
	}
	
}

?>