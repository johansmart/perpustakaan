<?php
class M_letak_rak extends CI_Model{
	public function list_letak_rak(){
		
		return $this->db->query("select * from tbl_letak_rak order by id_letak_rak asc ")->result();
	}
	public function letak_rak($limit,$start){
		
		return $this->db->query("select * from tbl_letak_rak order by id_letak_rak asc limit $start, $limit")->result();
	}
	
	
	public function jumlah_letak_rak(){
		return $this->db->query("select * from tbl_letak_rak order by id_letak_rak asc ")->num_rows();
	}
	public function select_letak_rak(){
		
		return $this->db->query("select * from tbl_letak_rak order by nama_letak_rak asc ")->result();
	}
	
	function ceknamaletak_rak($letak_rak){
		$sql = "select * from tbl_letak_rak where nama_letak_rak= ".$this->db->escape($letak_rak)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function letak_rak_add(){
		$letak_rak = $this->input->post('letak_rak');
		
		$sql = "insert into tbl_letak_rak(nama_letak_rak) values('$letak_rak')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function letak_rak_edit($id){
		$sql = "select * from tbl_letak_rak where id_letak_rak = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekletak_rak_edit($letak_rak,$letak_rak_awal){
		$sql = "select * from tbl_letak_rak where nama_letak_rak = ".$this->db->escape($letak_rak)." and nama_letak_rak <> ".$this->db->escape($letak_rak_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function letak_rak_edit_proses(){
		$post_nama_letak_rak=$this->input->post('letak_rak');
		$post_nama_letak_rak_awal=$this->input->post('letak_rak_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_letak_rak set 
		nama_letak_rak='$post_nama_letak_rak'
		where id_letak_rak='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function letak_rak_delete($id){
		$sql = "delete from tbl_letak_rak where id_letak_rak= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>