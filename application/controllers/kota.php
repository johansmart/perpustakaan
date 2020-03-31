<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kota extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_kota');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->kota();
	}
	public function kota()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('kota/kota');
		$config['total_rows']      = $this->m_kota->jumlah_kota();
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
		
	    $data['kota'] 	   		   = $this->m_kota->kota($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_kota'] = $this->m_kota->jumlah_kota();
		
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/kota/kota',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
		

	public function kotaadd(){
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/kota/kotaadd');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function kotaadd_proses(){
		$post_kota=$this->input->post('kota');

		if($post_kota=="")
		{
			echo "
				<script>
				alert('isikan nama kota');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			$this->load->model('m_kota');
			$query = $this->m_kota->ceknamakota($this->input->post('kota'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Nama kota telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_kota');
				$query = $this->m_kota->kota_add($this->input->post('kota'));
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/kota"); ?>'
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
	
	public function kota_edit(){
		$this->load->model('m_kota');
		$query['kota'] = $this->m_kota->kota_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/kota/kotaedit',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function kota_edit_proses(){
		$post_nama_kota=$this->input->post('kota');
		$post_nama_kota_awal=$this->input->post('kota_awal');
		$post_id=$this->input->post('id');

		if($post_nama_kota=="")
		{
			echo "
				<script>
				alert('isikan nama kota');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			
			$this->load->model('m_kota');
			$query = $this->m_kota->cekkota_edit($this->input->post('kota'),$this->input->post('kota_awal'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('nama kota telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_kota');
				$query = $this->m_kota->kota_edit_proses();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/kota"); ?>'
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
	public function kota_delete(){
		$this->load->model('m_kota');
		$query = $this->m_kota->kota_delete($this->input->get('id'));
			
		$this->index();
		
	}
	public function kota_refresh(){
		$data["isi_kota"] = $this->reload_kota();
		echo json_encode($data);
		
	}
	function reload_kota(){
		$isi_kota="";
		$this->load->model('m_kota');
		$kota = $this->m_kota->select_kota();
		if(count($kota)>0)
		{
			foreach($kota as $kota)
			{
				$isi_kota .=" <option value=".$kota->id_kota.">".$kota->nama_kota."</option>";
			}
		}
						
						
			
		return  $isi_kota;
			
	}
	
	
}

?>