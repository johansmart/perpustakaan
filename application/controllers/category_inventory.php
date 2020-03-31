<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_inventory extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_category_inventory');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->category_inventory();
	}
	public function category_inventory()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('category_inventory/category_inventory');
		$config['total_rows']      = $this->m_category_inventory->jumlah_category_inventory();
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
		
	    $data['category_inventory'] 	   		   = $this->m_category_inventory->category_inventory($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_category_inventory'] = $this->m_category_inventory->jumlah_category_inventory();
		
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/category_inventory/category_inventory',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
		

	public function category_inventoryadd(){
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/category_inventory/category_inventoryadd');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function category_inventoryadd_proses(){
		$post_category_inventory=$this->input->post('category_inventory');

		if($post_category_inventory=="")
		{
			echo "
				<script>
				alert('isikan nama category_inventory');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			$this->load->model('m_category_inventory');
			$query = $this->m_category_inventory->ceknamacategory_inventory($this->input->post('category_inventory'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Nama category_inventory telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_category_inventory');
				$query = $this->m_category_inventory->category_inventory_add($this->input->post('category_inventory'));
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/category_inventory"); ?>'
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
	
	public function category_inventory_edit(){
		$this->load->model('m_category_inventory');
		$query['category_inventory'] = $this->m_category_inventory->category_inventory_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/category_inventory/category_inventoryedit',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function category_inventory_edit_proses(){
		$post_nama_category_inventory=$this->input->post('category_inventory');
		$post_nama_category_inventory_awal=$this->input->post('category_inventory_awal');
		$post_id=$this->input->post('id');

		if($post_nama_category_inventory=="")
		{
			echo "
				<script>
				alert('isikan nama category_inventory');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			
			$this->load->model('m_category_inventory');
			$query = $this->m_category_inventory->cekcategory_inventory_edit($this->input->post('category_inventory'),$this->input->post('category_inventory_awal'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('nama category_inventory telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_category_inventory');
				$query = $this->m_category_inventory->category_inventory_edit_proses();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/category_inventory"); ?>'
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
	public function category_inventory_delete(){
		$this->load->model('m_category_inventory');
		$query = $this->m_category_inventory->category_inventory_delete($this->input->get('id'));
			
		$this->index();
		
	}
	
	public function category_inventory_refresh(){
		$data["isi_category_inventory"] = $this->reload_category_inventory();
		echo json_encode($data);
		
	}
	function reload_category_inventory(){
		$isi_category_inventory="";
		$this->load->model('m_category_inventory');
		$category_inventory = $this->m_category_inventory->select_category_inventory();
		if(count($category_inventory)>0)
		{
			foreach($category_inventory as $category_inventory)
			{
				$isi_category_inventory .=" <option value=".$category_inventory->id_category_inventory.">".$category_inventory->nama_category_inventory."</option>";
			}
		}
						
						
			
		return  $isi_category_inventory;
			
	}
}

?>