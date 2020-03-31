<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
       $this->load->helper('form');
		$this->load->database();
		$this->load->library(array('pagination','session'));
		
	}
	public function index()
	{
	$this->load->view('public/file_template_public/header');
	$this->load->view('public/file_template_public/menu_atas');
	$this->load->view('public/file_template_public/main_head_home');
	$this->load->view('public/file_template_public/slider');
	$this->load->view('public/file_template_public/menu_header_bottom');
	$this->load->view('public/index');
	$this->load->view('public/file_template_public/menu_footer');
	$this->load->view('public/file_template_public/footer');
	}
	
}
