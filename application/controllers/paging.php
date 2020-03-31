<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paging extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_paging');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/page'),"refresh");
		}
 	}
	public function index()	{
		$this->ubahpaging();
	}
	public function ubahpaging(){
	$url=$this->input->get('url');
		$this->m_admin->ubahpaging($url);
	}
}

?>