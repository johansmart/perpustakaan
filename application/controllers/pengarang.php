<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pengarang extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_pengarang');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->pengarang();
	}
	public function pengarang()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('pengarang/pengarang');
		$config['total_rows']      = $this->m_pengarang->jumlah_pengarang();
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
		
	    $data['pengarang'] 	   		   = $this->m_pengarang->pengarang($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_pengarang'] = $this->m_pengarang->jumlah_pengarang();
		
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/pengarang/pengarang',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
		

	public function pengarangadd(){
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/pengarang/pengarangadd');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function pengarangadd_proses(){
		$post_pengarang=$this->input->post('pengarang');

		if($post_pengarang=="")
		{
			echo "
				<script>
				alert('isikan nama pengarang');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			$this->load->model('m_pengarang');
			$query = $this->m_pengarang->ceknamapengarang($this->input->post('pengarang'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Nama pengarang telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_pengarang');
				$query = $this->m_pengarang->pengarang_add($this->input->post('pengarang'));
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/pengarang"); ?>'
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
	
	public function pengarang_edit(){
		$this->load->model('m_pengarang');
		$query['pengarang'] = $this->m_pengarang->pengarang_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/pengarang/pengarangedit',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function pengarang_edit_proses(){
		$post_nama_pengarang=$this->input->post('pengarang');
		$post_nama_pengarang_awal=$this->input->post('pengarang_awal');
		$post_id=$this->input->post('id');

		if($post_nama_pengarang=="")
		{
			echo "
				<script>
				alert('isikan nama pengarang');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			
			$this->load->model('m_pengarang');
			$query = $this->m_pengarang->cekpengarang_edit($this->input->post('pengarang'),$this->input->post('pengarang_awal'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('nama pengarang telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_pengarang');
				$query = $this->m_pengarang->pengarang_edit_proses();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/pengarang"); ?>'
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
	public function pengarang_delete(){
		$this->load->model('m_pengarang');
		$query = $this->m_pengarang->pengarang_delete($this->input->get('id'));
			
		$this->index();
		
	}
	public function pengarang_refresh(){
		$data["isi_pengarang"] = $this->reload_pengarang();
		echo json_encode($data);
		
	}
	function reload_pengarang(){
		$isi_pengarang="";
		$this->load->model('m_pengarang');
		$pengarang = $this->m_pengarang->select_pengarang();
		if(count($pengarang)>0)
		{
			foreach($pengarang as $pengarang)
			{
				$isi_pengarang .=" <option value=".$pengarang->id_pengarang.">".$pengarang->nama_pengarang."</option>";
			}
		}
		return  $isi_pengarang;
			
	}
}

?>