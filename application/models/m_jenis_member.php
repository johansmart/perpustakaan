<?php
class M_jenis_member extends CI_Model{
	public function list_jenis_member(){
		
		return $this->db->query("select * from tbl_jenis_member order by id_jenis_member asc ")->result();
	}
	public function jenis_member($limit,$start){
		
		return $this->db->query("select * from tbl_jenis_member order by id_jenis_member asc limit $start, $limit")->result();
	}
	
	public function select_jenis_member(){
		
		return $this->db->query("select * from tbl_jenis_member order by id_jenis_member asc ")->result();
	}
	
	public function jumlah_jenis_member(){
		return $this->db->query("select * from tbl_jenis_member order by id_jenis_member asc ")->num_rows();
	}
	
	
	function ceknamajenis_member($jenis_member){
		$sql = "select * from tbl_jenis_member where nama_jenis_member= ".$this->db->escape($jenis_member)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_member_add(){
		$jenis_member = $this->input->post('jenis_member');
		
		$sql = "insert into tbl_jenis_member(nama_jenis_member) values('$jenis_member')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_member_edit($id){
		$sql = "select * from tbl_jenis_member where id_jenis_member = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekjenis_member_edit($jenis_member,$jenis_member_awal){
		$sql = "select * from tbl_jenis_member where nama_jenis_member = ".$this->db->escape($jenis_member)." and nama_jenis_member <> ".$this->db->escape($jenis_member_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_member_edit_proses(){
		$post_nama_jenis_member=$this->input->post('jenis_member');
		$post_nama_jenis_member_awal=$this->input->post('jenis_member_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_jenis_member set 
		nama_jenis_member='$post_nama_jenis_member'
		where id_jenis_member='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_member_delete($id){
		$sql = "delete from tbl_jenis_member where id_jenis_member= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>