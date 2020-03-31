<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bahasa extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_bahasa');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->bahasa();
	}
	public function bahasa()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('bahasa/bahasa');
		$config['total_rows']      = $this->m_bahasa->jumlah_bahasa();
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
		
	    $data['bahasa'] 	   		   = $this->m_bahasa->bahasa($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_bahasa'] = $this->m_bahasa->jumlah_bahasa();
		
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/bahasa/bahasa',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
		

	public function bahasaadd(){
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/bahasa/bahasaadd');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function bahasaadd_proses(){
		$post_bahasa=$this->input->post('bahasa');

		if($post_bahasa=="")
		{
			echo "
				<script>
				alert('isikan nama bahasa');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			$this->load->model('m_bahasa');
			$query = $this->m_bahasa->ceknamabahasa($this->input->post('bahasa'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Nama bahasa telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_bahasa');
				$query = $this->m_bahasa->bahasa_add($this->input->post('bahasa'));
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/bahasa"); ?>'
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
	
	public function bahasa_edit(){
		$this->load->model('m_bahasa');
		$query['bahasa'] = $this->m_bahasa->bahasa_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/bahasa/bahasaedit',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function bahasa_edit_proses(){
		$post_nama_bahasa=$this->input->post('bahasa');
		$post_nama_bahasa_awal=$this->input->post('bahasa_awal');
		$post_id=$this->input->post('id');

		if($post_nama_bahasa=="")
		{
			echo "
				<script>
				alert('isikan nama bahasa');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			
			$this->load->model('m_bahasa');
			$query = $this->m_bahasa->cekbahasa_edit($this->input->post('bahasa'),$this->input->post('bahasa_awal'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('nama bahasa telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_bahasa');
				$query = $this->m_bahasa->bahasa_edit_proses();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/bahasa"); ?>'
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
	public function bahasa_delete(){
		$this->load->model('m_bahasa');
		$query = $this->m_bahasa->bahasa_delete($this->input->get('id'));
			
		$this->index();
		
	}
	
	public function bahasa_refresh(){
		$data["isi_bahasa"] = $this->reload_bahasa();
		echo json_encode($data);
		
	}
	function reload_bahasa(){
		$isi_bahasa="";
		$this->load->model('m_bahasa');
		$bahasa = $this->m_bahasa->select_bahasa();
		if(count($bahasa)>0)
		{
			foreach($bahasa as $bahasa)
			{
				$isi_bahasa .=" <option value=".$bahasa->id_bahasa.">".$bahasa->nama_bahasa."</option>";
			}
		}
						
						
			
		return  $isi_bahasa;
			
	}
}

?>