<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jenis_out extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_jenis_out');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->jenis_out();
	}
	public function jenis_out()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('jenis_out/jenis_out');
		$config['total_rows']      = $this->m_jenis_out->jumlah_jenis_out();
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
		
	    $data['jenis_out'] 	   		   = $this->m_jenis_out->jenis_out($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_jenis_out'] = $this->m_jenis_out->jumlah_jenis_out();
		
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/jenis_out/jenis_out',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
		

	public function jenis_outadd(){
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/jenis_out/jenis_outadd');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function jenis_outadd_proses(){
		$post_jenis_out=$this->input->post('jenis_out');

		if($post_jenis_out=="")
		{
			echo "
				<script>
				alert('isikan nama jenis_out');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			$this->load->model('m_jenis_out');
			$query = $this->m_jenis_out->ceknamajenis_out($this->input->post('jenis_out'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Nama jenis_out telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_jenis_out');
				$query = $this->m_jenis_out->jenis_out_add($this->input->post('jenis_out'));
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/jenis_out"); ?>'
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
	
	public function jenis_out_edit(){
		$this->load->model('m_jenis_out');
		$query['jenis_out'] = $this->m_jenis_out->jenis_out_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/jenis_out/jenis_outedit',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function jenis_out_edit_proses(){
		$post_nama_jenis_out=$this->input->post('jenis_out');
		$post_nama_jenis_out_awal=$this->input->post('jenis_out_awal');
		$post_id=$this->input->post('id');

		if($post_nama_jenis_out=="")
		{
			echo "
				<script>
				alert('isikan nama jenis_out');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			
			$this->load->model('m_jenis_out');
			$query = $this->m_jenis_out->cekjenis_out_edit($this->input->post('jenis_out'),$this->input->post('jenis_out_awal'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('nama jenis_out telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_jenis_out');
				$query = $this->m_jenis_out->jenis_out_edit_proses();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/jenis_out"); ?>'
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
	public function jenis_out_delete(){
		$this->load->model('m_jenis_out');
		$query = $this->m_jenis_out->jenis_out_delete($this->input->get('id'));
			
		$this->index();
		
	}
	public function jenis_out_refresh(){
		$data["isi_jenis_out"] = $this->reload_jenis_out();
		echo json_encode($data);
		
	}
	function reload_jenis_out(){
		$isi_jenis_out="";
		$this->load->model('m_jenis_out');
		$jenis_out = $this->m_jenis_out->select_jenis_out();
		if(count($jenis_out)>0)
		{
			foreach($jenis_out as $jenis_out)
			{
				$isi_jenis_out .=" <option value=".$jenis_out->id_jenis_out.">".$jenis_out->nama_jenis_out."</option>";
			}
		}
		return  $isi_jenis_out;
			
	}
}

?>