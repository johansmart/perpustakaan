<?php
class M_jenis_denda_lainnya extends CI_Model{
	public function list_jenis_denda_lainnya(){
		
		return $this->db->query("select * from tbl_jenis_denda_lainnya order by id_jenis_denda_lainnya asc ")->result();
	}
	public function jenis_denda_lainnya($limit,$start){
		
		return $this->db->query("select * from tbl_jenis_denda_lainnya order by id_jenis_denda_lainnya asc limit $start, $limit")->result();
	}
	
	
	public function jumlah_jenis_denda_lainnya(){
		return $this->db->query("select * from tbl_jenis_denda_lainnya order by id_jenis_denda_lainnya asc ")->num_rows();
	}
	
	public function select_jenis_denda_lainnya(){
		
		return $this->db->query("select * from tbl_jenis_denda_lainnya order by nama_jenis_denda_lainnya asc ")->result();
	}
	
	
	function ceknamajenis_denda_lainnya($jenis_denda_lainnya){
		$sql = "select * from tbl_jenis_denda_lainnya where nama_jenis_denda_lainnya= ".$this->db->escape($jenis_denda_lainnya)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_denda_lainnya_add(){
		$jenis_denda_lainnya = $this->input->post('jenis_denda_lainnya');
		
		$sql = "insert into tbl_jenis_denda_lainnya(nama_jenis_denda_lainnya) values('$jenis_denda_lainnya')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_denda_lainnya_edit($id){
		$sql = "select * from tbl_jenis_denda_lainnya where id_jenis_denda_lainnya = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekjenis_denda_lainnya_edit($jenis_denda_lainnya,$jenis_denda_lainnya_awal){
		$sql = "select * from tbl_jenis_denda_lainnya where nama_jenis_denda_lainnya = ".$this->db->escape($jenis_denda_lainnya)." and nama_jenis_denda_lainnya <> ".$this->db->escape($jenis_denda_lainnya_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_denda_lainnya_edit_proses(){
		$post_nama_jenis_denda_lainnya=$this->input->post('jenis_denda_lainnya');
		$post_nama_jenis_denda_lainnya_awal=$this->input->post('jenis_denda_lainnya_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_jenis_denda_lainnya set 
		nama_jenis_denda_lainnya='$post_nama_jenis_denda_lainnya'
		where id_jenis_denda_lainnya='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_denda_lainnya_delete($id){
		$sql = "delete from tbl_jenis_denda_lainnya where id_jenis_denda_lainnya= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>