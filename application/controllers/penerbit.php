<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penerbit extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_penerbit');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->penerbit();
	}
	public function penerbit()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('penerbit/penerbit');
		$config['total_rows']      = $this->m_penerbit->jumlah_penerbit();
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
		
	    $data['penerbit'] 	   		   = $this->m_penerbit->penerbit($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_penerbit'] = $this->m_penerbit->jumlah_penerbit();
		
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/penerbit/penerbit',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
		

	public function penerbitadd(){
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/penerbit/penerbitadd');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function penerbitadd_proses(){
		$post_penerbit=$this->input->post('penerbit');

		if($post_penerbit=="")
		{
			echo "
				<script>
				alert('isikan nama penerbit');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			$this->load->model('m_penerbit');
			$query = $this->m_penerbit->ceknamapenerbit($this->input->post('penerbit'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Nama penerbit telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_penerbit');
				$query = $this->m_penerbit->penerbit_add($this->input->post('penerbit'));
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/penerbit"); ?>'
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
	
	public function penerbit_edit(){
		$this->load->model('m_penerbit');
		$query['penerbit'] = $this->m_penerbit->penerbit_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/penerbit/penerbitedit',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function penerbit_edit_proses(){
		$post_nama_penerbit=$this->input->post('penerbit');
		$post_nama_penerbit_awal=$this->input->post('penerbit_awal');
		$post_id=$this->input->post('id');

		if($post_nama_penerbit=="")
		{
			echo "
				<script>
				alert('isikan nama penerbit');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			
			$this->load->model('m_penerbit');
			$query = $this->m_penerbit->cekpenerbit_edit($this->input->post('penerbit'),$this->input->post('penerbit_awal'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('nama penerbit telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_penerbit');
				$query = $this->m_penerbit->penerbit_edit_proses();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/penerbit"); ?>'
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
	public function penerbit_delete(){
		$this->load->model('m_penerbit');
		$query = $this->m_penerbit->penerbit_delete($this->input->get('id'));
			
		$this->index();
		
	}
	public function penerbit_refresh(){
		$data["isi_penerbit"] = $this->reload_penerbit();
		echo json_encode($data);
		
	}
	function reload_penerbit(){
		$isi_penerbit="";
		$this->load->model('m_penerbit');
		$penerbit = $this->m_penerbit->select_penerbit();
		if(count($penerbit)>0)
		{
			foreach($penerbit as $penerbit)
			{
				$isi_penerbit .=" <option value=".$penerbit->id_penerbit.">".$penerbit->nama_penerbit."</option>";
			}
		}
		return  $isi_penerbit;
			
	}
}

?>