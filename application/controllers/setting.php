<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_setting');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index(){
	$this->setting_umum();
	}
	
	public function setting_umum(){
	
	$data['setting'] = $this->m_setting->setting_umum();
	$data['information'] = $this->m_setting->readLibrary();
	// var_dump($data['information']);
	// die;
			
	$this->load->view('template_admin/include/config');
	$this->load->view('template_admin/include/head');
	$this->load->view('template_admin/include/header');
	$this->load->view('template_admin/include/sidebar');
	$this->load->view('admin/setting_umum/setting_umum',$data);
	$this->load->view('template_admin/include/footer');
	$this->load->view('template_admin/include/tabpanes');
	
	}
	
	public function setting_umum_proses()
	{
		$post_denda=htmlspecialchars($this->input->post('denda'));
		$post_max_peminjaman_perhari=htmlspecialchars($this->input->post('max_peminjaman_perhari'));
		$post_max_tempo_peminjaman=htmlspecialchars($this->input->post('max_tempo_peminjaman'));
		$post_max_peminjaman=htmlspecialchars($this->input->post('max_peminjaman'));
				
		$this->load->model('m_setting');
		$query = $this->m_setting->setting_umum_proses($post_denda,$post_max_peminjaman_perhari,$post_max_tempo_peminjaman,$post_max_peminjaman);
				
			if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/setting/setting_umum"); ?>'
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

	public function inputLibraryInfo()
	{
		$this->form_validation->set_rules('libraryid','Libraryid','required|xss_clean');
		$this->form_validation->set_rules('libraryname','Libraryname','required|xss_clean');
		$this->form_validation->set_rules('address','Address','required|xss_clean');
		$this->form_validation->set_rules('handphone','Handphone','required|xss_clean');
		$this->form_validation->set_rules('profile','Profile','required|xss_clean');
		$this->form_validation->set_rules('librarylogo','Librarylogo');
		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('libraryid');
			if (!empty($_FILES['librarylogo']['name'])) {
				$config['upload_path'] = './assets/images/logo/';
				$config['allowed_types'] = 'jpg|jpeg|png|svg';
				$config['max_size'] = '100000';
				$config['remove_spaces'] = TRUE;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('librarylogo')) {
					$file = $this->upload->data();
					$logo = $file['file_name'];
				}else{
					$this->session->set_flashdata('result',
						'<div class="alert alert-danger" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							File cannot uploaded by system.
						</div>'
					);
					redirect('setting');
				}
			}else{
				$infolibrary = $this->m_setting->readlibrary();
				$infolibrary = array_filter($infolibrary, function ($v) use ($id)
				{
					return $v['id'] == $id;
				});
				foreach ($infolibrary as $key => $value) {
					$logo = $value['logo'];
				}
			}
			$data = array(
				'nama' => $this->input->post('libraryname'),
				'alamat' => $this->input->post('address'),
				'logo' => $logo,
				'profile' => $this->input->post('profile'),
				'telepon' => $this->input->post('handphone')
			);
			$input = $this->m_setting->inputlibraryinfo($data,$id);
			if ($input > 0) {
				$this->session->set_flashdata('result',
					`<div class="alert alert-success" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						Library's information updated.
					</div>`
				);
				redirect('setting');
			}else{
				$this->session->set_flashdata('result',
				`<div class="alert alert-danger" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					Form input cannot accepted by system.
				</div>`
				);
				redirect('setting');
			}
		}else{
			$this->session->set_flashdata('result',
				`<div class="alert alert-danger" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					Form input cannot accepted by system.
				</div>`
			);
			redirect('setting');
		}
	}
	

	
	
}

?>