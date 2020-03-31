<?php
class M_kota extends CI_Model{
	public function list_kota(){
		
		return $this->db->query("select * from tbl_kota order by id_kota asc ")->result();
	}
	public function kota($limit,$start){
		
		return $this->db->query("select * from tbl_kota order by id_kota asc limit $start, $limit")->result();
	}
	public function select_kota(){
		
		return $this->db->query("select * from tbl_kota order by nama_kota asc ")->result();
	}
	
	public function jumlah_kota(){
		return $this->db->query("select * from tbl_kota order by id_kota asc ")->num_rows();
	}
	
	
	function ceknamakota($kota){
		$sql = "select * from tbl_kota where nama_kota= ".$this->db->escape($kota)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function kota_add(){
		$kota = $this->input->post('kota');
		
		$sql = "insert into tbl_kota(nama_kota) values('$kota')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function kota_edit($id){
		$sql = "select * from tbl_kota where id_kota = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekkota_edit($kota,$kota_awal){
		$sql = "select * from tbl_kota where nama_kota = ".$this->db->escape($kota)." and nama_kota <> ".$this->db->escape($kota_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function kota_edit_proses(){
		$post_nama_kota=$this->input->post('kota');
		$post_nama_kota_awal=$this->input->post('kota_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_kota set 
		nama_kota='$post_nama_kota'
		where id_kota='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function kota_delete($id){
		$sql = "delete from tbl_kota where id_kota= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>