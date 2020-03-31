<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_member');
		$this->load->model('m_jenis_member');
		$this->load->library('form_validation');
		$inisial_barcode="";
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->member();
	}
	public function member()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('member/member');
		if ($this->input->get('search')==''){
			$cari_member=$this->session->set_userdata('search',$this->session->userdata('search'));
		}
		else
		{
			$cari_member=$this->input->get('search');
			$cari_member=$this->session->set_userdata('search',$this->input->get('search'));
		}
		
		if ($this->input->get('ref')=='all'){
		$this->session->set_userdata('search','');
		$cari_member='';
		}
		
		$config['total_rows']      = $this->m_member->jumlah_list_member();
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
		
	    $data['member'] 	   		   = $this->m_member->list_member($per_page,$page,$cari_member);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$csrf =  base64_encode(openssl_random_pseudo_bytes(32));
		$this->session->set_userdata('csrf_form',$csrf);
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_member'] = $this->m_member->jumlah_list_member();
		$data['csrf_form'] = $csrf;
		
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/member/member',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}

	public function multiplePrint()
	{
		if ($this->input->post('csrf_form')) {
			if ($this->input->post('csrf_form') == $this->session->userdata('csrf_form')) {
				$this->form_validation->set_rules('csrf_form', 'Csrf_form', 'required|xss_clean');
				$this->form_validation->set_rules('members', 'Members', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE)
				{
					show_404();
				}
				else
				{
					$member = array();
					$member = $this->input->post('members');
					$allmember = $this->db->get('tbl_member')->result_array();
					$membercity = $this->db->get('tbl_kota')->result_array();
					$summember = count($member);
					$getmember = array_filter($allmember, function ($v) use ($member)
					{
						return in_array($v['id_member'], $member);
							
					});
	
					if ($getmember != null) {
						foreach ($getmember as $key => $value) {
							foreach ($membercity as $key2 => $value2) {
								if ($value['tempat_lahir_member'] == $value2['id_kota']) {
									$getmember[$key]['nama_kota'] = $value2['nama_kota'];
								}
							}
						}
						$data = array(
							'members' => $getmember
						);	
						$this->load->view('admin/member/member_card',$data);
					}else{
						$this->session->set_flashdata('result',
						'<div class="alert alert-danger" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							Member is not found.
						</div>'
						);
						redirect('member');
					}
				}
			}else {
				redirect(base_url('index.php/page'),"refresh");
			}
		}else {
			redirect(base_url('index.php/page'),"refresh");
		}
	}
	
	public function member_add(){
			
		$query['jenis_member'] = $this->m_jenis_member->list_jenis_member();
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/member/member_add',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function member_add_proses(){
		
		
		$post_id_admin=$this->session->userdata('mzags-2k15-lmg-ind-user-admin-01-id');
		
		$post_id=$this->input->post('id');
		
		$inisial_barcode="";
		//$post_barcode=$this->input->post('barcode');
		$post_barcode=$inisial_barcode.$post_id;
		
		$post_nama=$this->input->post('nama');
		$post_tempat_lahir=$this->input->post('tempat_lahir');
		$post_jk=$this->input->post('jk');
		$post_status=$this->input->post('status');
		$post_tanggal_lahir=$this->input->post('tgl');
		$post_jenis_member=$this->input->post('jenis_member');
		$post_exp=$this->input->post('exp');
			
		//file image
		$file = $_FILES['file']['name'];
		$nm=str_replace(' ', '_', $file);
		$kode = rand(1, 123456789);
		$file_name =  $kode.$nm;
		$error0=$_FILES['file']['error'];
		$size = $_FILES['file']['size'];
		$file_type = $_FILES['file']['type'];
		$source = $_FILES['file']['tmp_name'];
		$direktori = "assets/images/member/$file_name";
		
				
		//$this->uploadfoto($file,$file_name,$size,$file_type,$direktori);
		if($file == null){
			?>
			 <script language="JavaScript"> 
			 alert('Pilihlah File Image. Upload Foto'); 
			 document.location='javascript:history.back(1)'; 
			 </script>
			<?php 
		}
		elseif  ($file_type  !=  'image/gif'  &&  $file_type  !=  'image/jpg' &&  $file_type  !=  'image/pjpeg'  
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
			$query = $this->m_member->cekid_member($post_id);
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('No id (identitas) telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
			
				$moveResult = move_uploaded_file($source, $direktori);	
				if ($moveResult == true) {
				
					$this->load->model('m_member');
					$query = $this->m_member->member_add($post_id,$post_barcode,$post_nama,$post_tempat_lahir,$post_tanggal_lahir,$post_jk,$post_status,$post_exp,$post_jenis_member,$file_name);
					if($query)
					{
						?>
						<script>
						alert('sukses');
						window.location.href='<?php  echo base_url("index.php/member"); ?>'
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
	public function member_cek(){
		$data['member'] = $this->m_member->member_edit($this->input->get('id'));
		$data['jenis_member'] = $this->m_jenis_member->list_jenis_member();
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/member/member_cek',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	
	public function member_edit(){
		$data['member'] = $this->m_member->member_edit($this->input->get('id'));
		$data['jenis_member'] = $this->m_jenis_member->list_jenis_member();
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/member/member_edit',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
	public function member_edit_proses(){
		
		$post_id_member=$this->input->post('id_member');
		$post_id=$this->input->post('id');
		$post_id2=$this->input->post('id2');
		//$post_barcode=$this->input->post('barcode');
		$inisial_barcode="";
		$post_barcode=$inisial_barcode.$post_id;
		
		$post_nama=$this->input->post('nama');
		$post_tempat_lahir=$this->input->post('tempat_lahir');
		$post_jk=$this->input->post('jk');
		$post_status=$this->input->post('status');
		$post_tanggal_lahir=$this->input->post('tgl');
		$post_jenis_member=$this->input->post('jenis_member');
		$post_exp=$this->input->post('exp');
		//file image
		$file = $_FILES['file']['name'];
		$nm=str_replace(' ', '_', $file);
		$kode = rand(1, 123456789);
		$file_name =  $kode.$nm;
		$error0=$_FILES['file']['error'];
		$size = $_FILES['file']['size'];
		$file_type = $_FILES['file']['type'];
		$source = $_FILES['file']['tmp_name'];
		$direktori = "assets/images/member/$file_name";
		
				
		//$this->uploadfoto($file,$file_name,$size,$file_type,$direktori);
		//cek
	$query = $this->m_member->cekid_member2($post_id,$post_id2);
	if($query->num_rows > 0)
	{
	echo "
	<script>
	alert('No id (identitas) telah digunakan');
	window.location.href='javascript:history.back(1);'
	</script>";
	}
	else
	{
		if($file != null){
			
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
				$moveResult = move_uploaded_file($source, $direktori);	
				if ($moveResult == true) 
				{
				$query = $this->m_member->member_edit_prosesphoto($post_id_member,$post_id,$post_barcode,$post_nama,$post_tempat_lahir,$post_tanggal_lahir,$post_jk,$post_status,$post_exp,$post_jenis_member,$file_name);
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
		else
		{
		$query = $this->m_member->member_edit_proses($post_id_member,$post_id,$post_barcode,$post_nama,$post_tempat_lahir,$post_tanggal_lahir,$post_jk,$post_status,$post_exp,$post_jenis_member);
		}
			
			if($query)
			{
				?>
				<script>
				alert('sukses');
				window.location.href='<?php  echo base_url("index.php/member"); ?>'
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
	
	
	
	public function member_delete(){
			$this->load->model('m_member');
			$query = $this->m_member->member_delete($this->input->get('id'));
			
		$this->index();
		
	}
	
	public function member_preview(){
		$data['member'] = $this->m_member->member_edit($this->input->get('id'));
		$data['jenis_member'] = $this->m_jenis_member->list_jenis_member();
			
		$this->load->view('admin/member/member_preview',$data);
	
	}
	public function member_previewbelakang(){
		$data['member'] = $this->m_member->member_edit($this->input->get('id'));
		$data['jenis_member'] = $this->m_jenis_member->list_jenis_member();
			
		$this->load->view('admin/member/member_previewbelakang',$data);
	
	}
	
	
	//ajax
	public function member_cekbarcode(){
		
		if($this->input->get('barcode_member')==""){
			$data["hasil"] = "cek";
			$data["ket"] = "<div id='cekmember' class='alert alert-danger' role='alert'>Isikan barcode dengan angka</div>";
			echo json_encode($data);
		}
		else{
		
			$this->load->model('m_member');
			$datai = $this->m_member->member_cekbarcode($this->input->get('barcode_member'));
			
			if($datai->num_rows > 0)
			{
				$data["hasil"] = "gagal";
				$data["ket"] = "<div id='cekmember' class='alert alert-danger' role='alert'>ID Barcode sudah digunakan</div>";
			}
			else
			{
				$data["hasil"] = "berhasil";
				$data["ket"] = "<div id='cekmember' class='alert alert-danger' role='alert'></div>";
			}
			echo json_encode($data);
		
		}
		
	}
	
	public function member_cekbarcodeedit(){
		
		if($this->input->get('barcode_member')==""){
			$data["hasil"] = "cek";
			$data["ket"] = "<div id='cekmember' class='alert alert-danger' role='alert'>Isikan barcode dengan angka</div>";
			echo json_encode($data);
		}
		else{
		
			$this->load->model('m_member');
			$datai = $this->m_member->member_cekbarcodeedit($this->input->get('barcode_member0'),$this->input->get('barcode_member'));
			
			if($datai->num_rows > 0)
			{
				$data["hasil"] = "gagal";
				$data["ket"] = "<div id='cekmember' class='alert alert-danger' role='alert'>ID Barcode sudah digunakan</div>";
			}
			else
			{
				$data["hasil"] = "berhasil";
				$data["ket"] = "<div id='cekmember' class='alert alert-danger' role='alert'></div>";
			}
			echo json_encode($data);
		
		}
		
	}
}

?>