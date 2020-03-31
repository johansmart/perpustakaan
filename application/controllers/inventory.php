<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inventory extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_inventory');
		$this->load->model('m_category_inventory');
		$inisial_barcode="MEZ-01-";
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->inventory();
	}
	public function inventory()	{
		$this->load->library('pagination');
		$config['base_url'] = site_url('inventory/inventory');
		if ($this->input->get('search_inv')==''){
			$cari_inventory=$this->session->set_userdata('search_inv',$this->session->userdata('search_inv'));
		}
		else
		{
			$cari_inventory=$this->input->get('search_inv');
			$cari_inventory=$this->session->set_userdata('search_inv',$this->input->get('search_inv'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search_inv','');
		$cari_inventory='';
		}
		
		$config['total_rows']      = $this->m_inventory->jumlah_list_inventory();
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
		
	    $data['inventory'] 	   		   = $this->m_inventory->list_inventory($per_page,$page,$cari_inventory);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_inventory'] = $this->m_inventory->jumlah_list_inventory();
		$csrf =  base64_encode(openssl_random_pseudo_bytes(32));
		$this->session->set_userdata('csrf_form',$csrf);
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/inventory/inventory',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}

	public function multiplePrint()
	{
		$this->form_validation->set_rules('csrf_form', 'Csrf_form', 'required|xss_clean');
		$this->form_validation->set_rules('inventories[]', 'Inventories', 'required|xss_clean');
		if ($this->form_validation->run() == TRUE)
		{
			if ($this->input->post('csrf_form') == $this->session->userdata('csrf_form')) {
				$inventories = array();
				$inventories = $this->input->post('inventories');
				$allinventory = $this->db->get('tbl_inventory')->result_array();
				$suminventory = count($inventories);
				for ($i=0; $i < $suminventory; $i++) { 
					$this->form_validation->set_rules('book_'. ($i+1) .'', 'Book_'. ($i+1) .'', 'required|xss_clean|integer');
				}
				if ($this->form_validation->run() == TRUE){
					for ($i=0; $i < $suminventory; $i++) { 
						${'book'.($i+1)} = $this->input->post('book_'. ($i+1) .'');
					}
					$inventoryselected = array_filter($allinventory, function($v) use ($inventories)
					{
						return in_array($v['id_inventory'], $inventories);
					});
					if ($inventoryselected != null) {
						$no = 1;
						foreach ($inventoryselected as $key => $value) {
							$inventoryselected[$key]['jumlahcetak'] = ${'book'.($no++)};
						}
						$data = [
						'inventories' => $inventoryselected
						];
						$this->load->view('admin/inventory/inventory_barcode', $data);
					}else {
						$this->session->set_flashdata('result',
						'<div class="alert alert-danger" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							Inventory is not found.
						</div>'
						);
						redirect('inventory');
					}
				}else {
					$this->session->set_flashdata('result',
					'<div class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						Inventory is not found.
					</div>'
					);
					redirect('inventory');
				}
			}else {
				redirect(base_url('index.php/page'),"refresh");
			}
		}else {
			redirect(base_url('index.php/page'),"refresh");
		}
	}
	
	public function inventory_add(){
			
		$query['category_inventory'] = $this->m_category_inventory->list_category_inventory();
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/inventory/inventory_add',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function inventory_add_proses(){
		
		
		$post_id_admin=$this->session->userdata('mzags-2k15-lmg-ind-user-admin-01-id');
		
		
		
		$inisial_barcode="MEZ-INV-";
		//$post_barcode=$this->input->post('barcode');
		
		$post_barcode=$this->input->post('barcode');
		$post_category_inventory=$this->input->post('category_inventory');
		$post_judul=$this->input->post('judul');
		$post_isbn=$this->input->post('isbn');
		$post_pengarang=$this->input->post('pengarang');
		$post_penerbit=$this->input->post('penerbit');
		$post_kota=$this->input->post('kota');
		$post_tahun=$this->input->post('tahun');
		$post_letak_rak=$this->input->post('letak_rak');
		$post_bahasa=$this->input->post('bahasa');
		$post_halaman=$this->input->post('halaman');
		$post_detail=$this->input->post('detail');
		$post_klasifikasi=$this->input->post('klasifikasi');
		$post_status=$this->input->post('status');
		
			
		//file image
		$file = $_FILES['file']['name'];
		$nm=str_replace(' ', '_', $file);
		$kode = rand(1, 123456789);
		$file_name =  $kode.$nm;
		$error0=$_FILES['file']['error'];
		$size = $_FILES['file']['size'];
		$file_type = $_FILES['file']['type'];
		$source = $_FILES['file']['tmp_name'];
		$direktori = "assets/images/inventory/$file_name";
		
				
		//$this->uploadfoto($file,$file_name,$size,$file_type,$direktori);
	if($file == null)
	{
			$query = $this->m_inventory->cek_isbn($post_isbn);
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('No ISBN telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$query = $this->m_inventory->cek_barcode($post_barcode);
				if($query->num_rows > 0)
				{
					echo "
					<script>
					alert('No id BARCODE telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
				}
				else
				{
						$this->load->model('m_inventory');
						$query = $this->m_inventory->inventory_add1();
						if($query)
						{
							?>
							<script>
							alert('sukses');
							window.location.href='<?php  echo base_url("index.php/inventory"); ?>'
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
					
					
				} 
			}
	}
	else
	{
		if  ($file_type  !=  'image/gif'  &&  $file_type  !=  'image/jpg' &&  $file_type  !=  'image/pjpeg'  
		&& $file_type != 'image/jpeg' && $file_type != 'image/png') 
		{
			?>
			 <script language="JavaScript"> 
			 alert('File Yang Di izinkan Hanya jpg, jpeg, png, gif dan Max 2MB'); 
			 document.location='javascript:history.back(1)'; 
			 </script>
			<?php 
		}
		elseif ($size < 0){
			?>
			 <script language="JavaScript"> 
			 alert('File Yang Di izinkan Hanya jpg, jpeg, png, gif dan Max 2MB'); 
			 document.location='javascript:history.back(1)'; 
			 </script>
			<?php 
		}

		elseif ($size > 2100000)
		{
			?>
			<script language="JavaScript"> 
			alert('File Yang Di izinkan Hanya jpg, jpeg, png, gif dan Max 2MB'); 
			document.location='javascript:history.back(1)'; 
					</script>
			<?php 
			
		}
		else 
		{
			//cek
			$query = $this->m_inventory->cek_isbn($post_isbn);
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('No ISBN telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$query = $this->m_inventory->cek_barcode($post_barcode);
				if($query->num_rows > 0)
				{
					echo "
					<script>
					alert('No id BARCODE telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
				}
				else
				{
				
					$moveResult = move_uploaded_file($source, $direktori);	
					if ($moveResult == true) {
					
						$this->load->model('m_inventory');
						$query = $this->m_inventory->inventory_add2($file_name);
						if($query)
						{
							?>
							<script>
							alert('sukses');
							window.location.href='<?php  echo base_url("index.php/inventory"); ?>'
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
					}
					else 
					{
						echo "
						<script>
						alert('Gagal upload');
						window.location.href='javascript:history.back(1);'
						</script>";
					}
				}
			}
		}
	}
	}
	public function inventory_cek(){
		$data['inventory'] = $this->m_inventory->inventory_edit($this->input->get('id'));
		$data['category_inventory'] = $this->m_category_inventory->list_category_inventory();
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/inventory/inventory_cek',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	
	public function inventory_edit(){
		$data['inventory'] = $this->m_inventory->inventory_edit($this->input->get('id'));
		$data['category_inventory'] = $this->m_category_inventory->list_category_inventory();
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/inventory/inventory_edit',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function inventory_edit_proses(){
		
		
		
		$post_id_admin=$this->session->userdata('mzags-2k15-lmg-ind-user-admin-01-id');
		
		
		
		$inisial_barcode="MEZ-INV-";
		//$post_barcode=$this->input->post('barcode');
		
		$post_id_inventory=$this->input->post('id_inventory');
		$post_isbn2=$this->input->post('isbn2');
		$post_barcode2=$this->input->post('barcode2');
		
		$post_barcode=$this->input->post('barcode');
		$post_category_inventory=$this->input->post('category_inventory');
		$post_judul=$this->input->post('judul');
		$post_isbn=$this->input->post('isbn');
		$post_pengarang=$this->input->post('pengarang');
		$post_penerbit=$this->input->post('penerbit');
		$post_kota=$this->input->post('kota');
		$post_tahun=$this->input->post('tahun');
		$post_letak_rak=$this->input->post('letak_rak');
		$post_bahasa=$this->input->post('bahasa');
		$post_halaman=$this->input->post('halaman');
		$post_detail=$this->input->post('detail');
		$post_klasifikasi=$this->input->post('klasifikasi');
		$post_status=$this->input->post('status');
		
			
		//file image
		$file = $_FILES['file']['name'];
		$nm=str_replace(' ', '_', $file);
		$kode = rand(1, 123456789);
		$file_name =  $kode.$nm;
		$error0=$_FILES['file']['error'];
		$size = $_FILES['file']['size'];
		$file_type = $_FILES['file']['type'];
		$source = $_FILES['file']['tmp_name'];
		$direktori = "assets/images/inventory/$file_name";
		
				
		//$this->uploadfoto($file,$file_name,$size,$file_type,$direktori);
	if($file == null)
	{
			$query = $this->m_inventory->cek_isbn2($post_isbn,$post_isbn2);
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('No ISBN telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$query = $this->m_inventory->cek_barcode2($post_barcode,$post_barcode2);
				if($query->num_rows > 0)
				{
					echo "
					<script>
					alert('No id BARCODE telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
				}
				else
				{
						$this->load->model('m_inventory');
						$query = $this->m_inventory->inventory_edit_proses1();
						if($query)
						{
							?>
							<script>
							alert('sukses');
							window.location.href='<?php  echo base_url("index.php/inventory"); ?>'
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
					
					
				} 
			}
	}
	else
	{
		if  ($file_type  !=  'image/gif'  &&  $file_type  !=  'image/jpg' &&  $file_type  !=  'image/pjpeg'  
		&& $file_type != 'image/jpeg' && $file_type != 'image/png') 
		{
			?>
			 <script language="JavaScript"> 
			 alert('File Yang Di izinkan Hanya jpg, jpeg, png, gif dan Max 2MB'); 
			 document.location='javascript:history.back(1)'; 
			 </script>
			<?php 
		}
		elseif ($size < 0){
			?>
			 <script language="JavaScript"> 
			 alert('File Yang Di izinkan Hanya jpg, jpeg, png, gif dan Max 2MB'); 
			 document.location='javascript:history.back(1)'; 
			 </script>
			<?php 
		}

		elseif ($size > 2100000)
		{
			?>
			<script language="JavaScript"> 
			alert('File Yang Di izinkan Hanya jpg, jpeg, png, gif dan Max 2MB'); 
			document.location='javascript:history.back(1)'; 
					</script>
			<?php 
			
		}
		else 
		{
			//cek
			$query = $this->m_inventory->cek_isbn2($post_isbn,$post_isbn2);
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('No ISBN telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$query = $this->m_inventory->cek_barcode2($post_barcode,$post_barcode2);
				if($query->num_rows > 0)
				{
					echo "
					<script>
					alert('No id BARCODE telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
				}
				else
				{
				
					$moveResult = move_uploaded_file($source, $direktori);	
					if ($moveResult == true) {
					
						$this->load->model('m_inventory');
						$query = $this->m_inventory->inventory_edit_proses2($file_name);
						if($query)
						{
							?>
							<script>
							alert('sukses');
							window.location.href='<?php  echo base_url("index.php/inventory"); ?>'
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
					}
					else 
					{
						echo "
						<script>
						alert('Gagal upload');
						window.location.href='javascript:history.back(1);'
						</script>";
					}
				}
			}
		}
	}
		
	}
	
	
	
	public function inventory_delete(){
			$this->load->model('m_inventory');
			$query = $this->m_inventory->inventory_delete($this->input->get('id'));
			
		$this->index();
		
	}
	
	public function inventory_preview(){
		$data['inventory'] = $this->m_inventory->inventory_edit($this->input->get('id'));
		$data['category_inventory'] = $this->m_category_inventory->list_category_inventory();
			
		$this->load->view('admin/inventory/inventory_preview',$data);
	
	}
	public function inventory_previewbelakang(){
		$data['inventory'] = $this->m_inventory->inventory_edit($this->input->get('id'));
		$data['category_inventory'] = $this->m_category_inventory->list_category_inventory();
			
		$this->load->view('admin/inventory/inventory_previewbelakang',$data);
	
	}
	
	public function inventory_cekbarcode(){
		$datai = $this->m_inventory->inventory_cekbarcode($this->input->get('barcode'));
		if($datai->num_rows > 0)
		{
			$data["hasil"] = "gagal";
			$data["ket"] = "<div id='cekinv' class='alert alert-danger' role='alert'>Barcode sudah digunakan</div>";
			/*
			foreach($datai->result() as $inv)
			{
				$data["hasil"] = "berhasil";
				$data["ket"] = "berhasil get inventory";
				$data["id"] ="<input readonly type='hidden' id='id2_inventory_get' name='id2' class='form-control'  value='".$inv->id_inventory."'  required='' placeholder='id'>
				<input type='hidden' name='id' id='id_inventory_get' class='form-control'  value='".$inv->id_inventory."'  required='' placeholder='id'>";
				$data["judul"] ="<input readonly type='text' name='judul' id='judul_inventory_get'  class='form-control'  value='".$inv->judul_inventory."'  required='' placeholder='id'>";
				$data["ISBN"] =" <input readonly type='text' name='isbn' id='isbn_inventory_get'  class='form-control'  value='".$inv->ISBN."'  required='' placeholder='id'>";
			}
			*/
		}
		else
		{
			$data["hasil"] = "berhasil";
			$data["ket"] = "<div id='cekinv' class='alert alert-danger' role='alert'></div>";
		}
		echo json_encode($data);
		
	}
	
	
	public function inventory_cekbarcodeedit(){
		$datai = $this->m_inventory->inventory_cekbarcodeedit($this->input->get('barcode0'),$this->input->get('barcode'));
		if($datai->num_rows > 0)
		{
			$data["hasil"] = "gagal";
			$data["ket"] = "<div id='cekinv' class='alert alert-danger' role='alert'>Barcode sudah digunakan</div>";
			/*
			foreach($datai->result() as $inv)
			{
				$data["hasil"] = "berhasil";
				$data["ket"] = "berhasil get inventory";
				$data["id"] ="<input readonly type='hidden' id='id2_inventory_get' name='id2' class='form-control'  value='".$inv->id_inventory."'  required='' placeholder='id'>
				<input type='hidden' name='id' id='id_inventory_get' class='form-control'  value='".$inv->id_inventory."'  required='' placeholder='id'>";
				$data["judul"] ="<input readonly type='text' name='judul' id='judul_inventory_get'  class='form-control'  value='".$inv->judul_inventory."'  required='' placeholder='id'>";
				$data["ISBN"] =" <input readonly type='text' name='isbn' id='isbn_inventory_get'  class='form-control'  value='".$inv->ISBN."'  required='' placeholder='id'>";
			}
			*/
		}
		else
		{
			$data["hasil"] = "berhasil";
			$data["ket"] = "<div id='cekinv' class='alert alert-danger' role='alert'></div>";
		}
		echo json_encode($data);
		
	}
	
	
	public function inventory_get(){
		$datai = $this->m_inventory->inventory_get($this->input->get('barcode'));
		if($datai->num_rows > 0)
		{
			foreach($datai->result() as $inv)
			{
				$data["hasil"] = "berhasil";
				$data["ket"] = "berhasil get inventory";
				$data["id"] ="<input readonly type='hidden' id='id2_inventory_get' name='id2' class='form-control'  value='".$inv->id_inventory."'  required='' placeholder='id'>
				<input type='hidden' name='id' id='id_inventory_get' class='form-control'  value='".$inv->id_inventory."'  required='' placeholder='id'>";
				$data["judul"] ="<input readonly type='text' name='judul' id='judul_inventory_get'  class='form-control'  value='".$inv->judul_inventory."'  required='' placeholder='id'>";
				$data["ISBN"] =" <input readonly type='text' name='isbn' id='isbn_inventory_get'  class='form-control'  value='".$inv->ISBN."'  required='' placeholder='id'>";
			}
		}
		else
		{
			$data["hasil"] = "gagal";
			$data["ket"] = "<div id='cekinv' class='alert alert-danger' role='alert'>id barcode tidak terdaftar</div>";
		}
		echo json_encode($data);
		
	}
	function reload_inventory_get(){
		
			
	}
	
	public function inventory_print(){	
		$data['inventory'] = $this->m_inventory->inventory_edit($this->input->get('id'));
		$data['category_inventory'] = $this->m_category_inventory->list_category_inventory();
			
		$this->load->view('admin/inventory/inventory_preview',$data);
	
	}
}

?>