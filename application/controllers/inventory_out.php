<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inventory_out extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_inventory_out');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->inventory_out();
	}
	public function inventory_out()	{
		$this->load->library('pagination');
		if ($this->input->get('search_inv_out')==''){
			$cari_inventory=$this->session->set_userdata('search_inv_out',$this->session->userdata('search_inv_out'));
		}
		else
		{
			$cari_inventory=$this->input->get('search_inv_out');
			$cari_inventory=$this->session->set_userdata('search_inv_out',$this->input->get('search_inv_out'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_inv_out','');
		$cari_inventory='';
		}
		$config['base_url']        = site_url('inventory_out/inventory_out');
		$config['total_rows']      = $this->m_inventory_out->jumlah_inventory_out();
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
		
	    $data['inventory_out'] 	   		   = $this->m_inventory_out->inventory_out($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_inventory_out'] = $this->m_inventory_out->jumlah_inventory_out();
		
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/inventory_out/inventory_out',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
		

	public function inventory_outadd(){
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/inventory_out/inventory_outadd');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function inventory_outadd_proses(){
		$post_barcode=$this->input->post('barcode');
		$post_id=$this->input->post('id');
		$post_tgl=$this->input->post('tgl');
		$post_jumlah=$this->input->post('jumlah');
		$post_jenis_in=$this->input->post('jenis_in');
		$post_keterangan=$this->input->post('ket');
		$id_admin=$this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id');
		
		if($post_id=="" || $post_barcode=="")
		{
			$data["hasil"] = "barcode";
			$data["keterangan"] = "isikan barcode ";
			echo json_encode($data);
		}
		elseif($post_jumlah=="" )
		{
			$data["hasil"] = "jumlah";
			$data["keterangan"] = "isikan jumlah";
			echo json_encode($data);
		}
		elseif($post_tgl=="" )
		{
			$data["hasil"] = "tanggal";
			$data["keterangan"] = "isikan tanggal";
			echo json_encode($data);
		}
		else 
		{
				
				$query = $this->m_inventory_out->inventory_out_add();
				
				if($query)
				{
					$data["hasil"] = "berhasil";
					$data["keterangan"] = "sukses";
					$data["action"]=base_url('index.php/inventory_out');
					echo json_encode($data);
					
					
				}
				else
				{
					$data["hasil"] = "gagal";
				}
				//$query->free_result();
			
			
		}
		
	}
	public function inventory_out_cek(){
		$data['inventory'] = $this->m_inventory_out->inventory_out_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/inventory_out/inventory_outcek',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function inventory_out_edit(){
		$data['inventory'] = $this->m_inventory_out->inventory_out_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/inventory_out/inventory_outedit',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function inventory_out_edit_proses(){
		
		$post_id_inventory_out=$this->input->post('id_inventory_out');
		$post_barcode=$this->input->post('barcode');
		$post_id=$this->input->post('id');
		$post_tgl=$this->input->post('tgl');
		$post_jumlah=$this->input->post('jumlah');
		$post_jenis_in=$this->input->post('jenis_in');
		$post_keterangan=$this->input->post('ket');
		$id_admin=$this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id');
		
		if($post_id=="" || $post_barcode=="")
		{
			$data["hasil"] = "barcode";
			$data["keterangan"] = "isikan barcode ";
			echo json_encode($data);
		}
		elseif($post_jumlah=="" )
		{
			$data["hasil"] = "jumlah";
			$data["keterangan"] = "isikan jumlah";
			echo json_encode($data);
		}
		elseif($post_tgl=="" )
		{
			$data["hasil"] = "tanggal";
			$data["keterangan"] = "isikan tanggal";
			echo json_encode($data);
		}
		else 
		{
				
				$query = $this->m_inventory_out->inventory_out_edit_proses();
				
				if($query)
				{
					$data["hasil"] = "berhasil";
					$data["keterangan"] = "sukses";
					$data["action"]=base_url('index.php/inventory_out');
					echo json_encode($data);
					
					
				}
				else
				{
					$data["hasil"] = "gagal";
				}
				//$query->free_result();
			
			
		}
	}
	public function inventory_out_delete(){
		$this->load->model('m_inventory_out');
		$query1 = $this->m_inventory_out->inventory_out_update_delete($this->input->get('id'),$this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id'));
		//$query = $this->m_inventory_out->inventory_out_delete($this->input->get('id'));
			
		$this->index();
		
	}
	
	
}

?>