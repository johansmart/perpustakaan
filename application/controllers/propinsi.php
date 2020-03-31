<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Propinsi extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_propinsi');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->propinsi();
	}
	public function propinsi()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('propinsi/propinsi');
		$config['total_rows']      = $this->m_propinsi->jumlah_propinsi();
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
		
	    $data['propinsi'] 	   		   = $this->m_propinsi->propinsi($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_propinsi'] = $this->m_propinsi->jumlah_propinsi();
		
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/propinsi/propinsi',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
		

	public function propinsiadd(){
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/propinsi/propinsiadd');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function propinsiadd_proses(){
		$post_propinsi=$this->input->post('propinsi');

		if($post_propinsi=="")
		{
			echo "
				<script>
				alert('isikan nama propinsi');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			$this->load->model('m_propinsi');
			$query = $this->m_propinsi->ceknamapropinsi($this->input->post('propinsi'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Nama propinsi telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_propinsi');
				$query = $this->m_propinsi->propinsi_add($this->input->post('propinsi'));
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/propinsi"); ?>'
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
	
	public function propinsi_edit(){
		$this->load->model('m_propinsi');
		$query['propinsi'] = $this->m_propinsi->propinsi_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/propinsi/propinsiedit',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function propinsi_edit_proses(){
		$post_nama_propinsi=$this->input->post('propinsi');
		$post_nama_propinsi_awal=$this->input->post('propinsi_awal');
		$post_id=$this->input->post('id');

		if($post_nama_propinsi=="")
		{
			echo "
				<script>
				alert('isikan nama propinsi');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			
			$this->load->model('m_propinsi');
			$query = $this->m_propinsi->cekpropinsi_edit($this->input->post('propinsi'),$this->input->post('propinsi_awal'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('nama propinsi telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_propinsi');
				$query = $this->m_propinsi->propinsi_edit_proses();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/propinsi"); ?>'
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
	public function propinsi_delete(){
		$this->load->model('m_propinsi');
		$query = $this->m_propinsi->propinsi_delete($this->input->get('id'));
			
		$this->index();
		
	}
	
}

?>