<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
	 	
 	}
	public function index()	{
		$this->load->view('404');
	}
	public function javascript()	{
		$this->load->view('disabled_javascript');
	}

	
}

?>