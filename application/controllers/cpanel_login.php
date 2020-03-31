<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cpanel_login extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
       $this->load->helper('form');
		$this->load->database();
		$this->load->library(array('pagination','session'));
       $this->load->library('session');
		$this->load->model('m_loginadmin');
	}
	public function index()
	{
		if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') != ""){
			redirect(base_url('index.php/admin/'),"refresh");
		}

		$data['error'] = "";
		if($this->input->post('username') && $this->input->post('password')){
			$this->load->model('m_loginadmin');
			$query = $this->m_loginadmin->loginadmin($this->input->post('username'), $this->input->post('password'));
			if($query->num_rows > 0){
				foreach($query->result() as $row){
					$this->session->set_userdata('mzgs-perpus-skl-1-2k15-sandi-I-id', $row->id_admin);
					$this->session->set_userdata('mzgs-perpus-skl-1-2k15-sandi-I-user', $row->username_admin);
					$this->session->set_userdata('mzgs-perpus-skl-1-2k15-sandi-I-nama', $row->nama_lengkap_admin);
					$this->session->set_userdata('mzgs-perpus-skl-1-2k15-sandi-I-jenis', $row->jenis_admin);
						break;
				}?>
				<script>
				window.location.href='<?php echo base_url("index.php/admin/"); ?>'
				</script><?php 
				
			}else{
				echo "
		<script>
		alert('login gagal');
		window.location.href='javascript:history.back(1);'
		</script>";
			}
			$query->free_result();
		}
		$this->load->view('admin/login');
	}
	
	function logout(){
		$this->session->set_userdata('mzgs-perpus-skl-1-2k15-sandi-I-id', "");
		$this->session->set_userdata('mzgs-perpus-skl-1-2k15-sandi-I-user', "");
		$this->session->set_userdata('mzgs-perpus-skl-1-2k15-sandi-I-nama', "");
		$this->session->set_userdata('mzgs-perpus-skl-1-2k15-sandi-I-jenis', "");
		$this->session->sess_destroy();
		redirect(base_url()."index.php/cpanel_login","refresh");
	}
}
