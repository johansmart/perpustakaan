<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class M_loginadmin extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	

	function loginadmin($username, $password){
		$sql = "select id_admin,username_admin, password_admin, nama_lengkap_admin,jenis_admin from admin 
		where username_admin = ".$this->db->escape($username)." and password_admin = md5(".$this->db->escape($password).")";
		$qsql = $this->db->query($sql);
		return $qsql;
	}

}