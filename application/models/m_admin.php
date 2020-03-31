<?php
class M_admin extends CI_Model{


	public function admin($limit,$start){
		return $this->db->query("select * from admin order by id_admin asc limit $start, $limit")->result();
	}
	public function jumlah_admin(){
		return $this->db->query("select * from admin order by id_admin asc ")->num_rows();
	}
	public function ubahpaging($url){
		$pagi = $this->input->post('paginge');
		$this->db->query("update set_paging set paging = ".$this->db->escape($pagi)."");
		redirect($url);
	}
	
	//useradmin
	public function tabel_admin($limit,$start){
		return $this->db->query("select * from admin order by id_admin asc limit $start, $limit")->result();
	}
	public function jumlah_tabel_admin(){
		return $this->db->get('admin')->num_rows();
	}
	
	
	function useradmin_add(){
	$post_email=$this->input->post('email');
		$post_username=$this->input->post('unama');
		$post_pass=$this->input->post('pass');
		$post_pass2=$this->input->post('pass2');
		$post_nama=$this->input->post('nama');
		$post_status=$this->input->post('status');
		$post_jenis=$this->input->post('jenis');
		$pass_md=md5($post_pass2);
		$sql = "insert into admin 
		(email_admin,
		username_admin,
		password_admin,
		nama_lengkap_admin,
		jenis_admin,
		status_admin) values
		(".$this->db->escape($post_email).",
		".$this->db->escape($post_username).",
		".$this->db->escape($pass_md).",
		".$this->db->escape($post_nama).",
		".$this->db->escape($post_jenis).",
		".$this->db->escape($post_status).")";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekusername($username){
		$sql = "select * from admin where username_admin = ".$this->db->escape($this->input->post('unama'))."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function useradmin_edit($id){
		$sql = "select * from admin where id_admin = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function useradmin_edit_proses(){
		$post_id=$this->input->post('id');
		$post_username=$this->input->post('unama');
		$post_username_lama=$this->input->post('unama_awal');
		$post_nama=$this->input->post('nama');
		$post_pass=$this->input->post('pass');
		$post_pass2=$this->input->post('pass2');
		$post_status=$this->input->post('status');
		$post_jenis=$this->input->post('jenis');
		
		$passbaru_md=md5($post_pass2);
		$sql = "update admin set 
		username_admin=".$this->db->escape($post_username).",
		password_admin=".$this->db->escape($passbaru_md).",
		nama_lengkap_admin=".$this->db->escape($post_nama).",
		jenis_admin=".$this->db->escape($post_jenis).",
		status_admin=".$this->db->escape($post_status)." 
		where id_admin=".$this->db->escape($post_id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekusername_edit($unama,$unama_awal){
		$sql = "select * from admin where 
		username_admin = ".$this->db->escape($this->db->escape($unama))." and 
		username_admin <> ".$this->db->escape($this->db->escape($unama_awal))."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function useradmin_delete($id){
		$sql = "delete from admin where id_admin = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	
	//profile
	function user_profile($id){
		$sql = "select * from admin where id_admin =".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function profile_edit_proses(){
		$post_id=$this->input->post('id');
		$post_username=$this->input->post('unama');
		$post_username_lama=$this->input->post('unama_awal');
		$post_nama=$this->input->post('nama');
		$post_status=$this->input->post('status');
		$post_jenis=$this->input->post('jenis');
		
		$sql = "update admin set 
		username_admin=".$this->db->escape($post_username).",
		nama_lengkap_admin=".$this->db->escape($post_nama).",
		jenis_admin=".$this->db->escape($post_jenis).",
		status_admin=".$this->db->escape($post_status)." 
		where id_admin=".$this->db->escape($post_id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	//gantipassword
	function cekpassword($post_id, $post_pass_lama){
	$pass_lama=md5($post_pass_lama);
		$sql = "select * from admin where id_admin = ".$this->db->escape($post_id)." and password_admin = ".$this->db->escape($pass_lama)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function gantipassword(){
	
		$post_id=$this->input->post('id');
		$post_pass_lama=$this->input->post('pass_lama');
		$post_pass=$this->input->post('pass');
		$post_pass2=$this->input->post('pass2');
		
		$passbaru_md=md5($post_pass2);
		$sql = "update admin set password_admin = ".$this->db->escape($passbaru_md)." where id_admin=".$this->db->escape($post_id)." ";
		$qsql = $this->db->query($sql);
		return $qsql;
		
		
	}
	
	//ajax 
	function cekuseradmin_email($email){
		$sql = "select * from admin where email_admin = ".$this->db->escape($email)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekuseradmin_username($username){
		$sql = "select * from admin where username_admin = ".$this->db->escape($username)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekuseradmin_usernameedit($username0,$username){
		$sql = "select * from admin where 
		username_admin = ".$this->db->escape($username)." and 
		username_admin <> ".$this->db->escape($username0)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
}
?>