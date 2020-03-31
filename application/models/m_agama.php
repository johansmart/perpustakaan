<?php
class M_agama extends CI_Model{
	public function list_agama(){
		
		return $this->db->query("select * from tbl_agama order by id_agama asc ")->result();
	}
	public function agama($limit,$start){
		
		return $this->db->query("select * from tbl_agama order by id_agama asc limit $start, $limit")->result();
	}
	
	
	public function jumlah_agama(){
		return $this->db->query("select * from tbl_agama order by id_agama asc ")->num_rows();
	}
	
	
	function ceknamaagama($agama){
		$sql = "select * from tbl_agama where nama_agama= ".$this->db->escape($agama)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function agama_add(){
		$agama = $this->input->post('agama');
		
		$sql = "insert into tbl_agama(nama_agama) values('$agama')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function agama_edit($id){
		$sql = "select * from tbl_agama where id_agama = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekagama_edit($agama,$agama_awal){
		$sql = "select * from tbl_agama where nama_agama = ".$this->db->escape($agama)." and nama_agama <> ".$this->db->escape($agama_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function agama_edit_proses(){
		$post_nama_agama=$this->input->post('agama');
		$post_nama_agama_awal=$this->input->post('agama_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_agama set 
		nama_agama='$post_nama_agama'
		where id_agama='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function agama_delete($id){
		$sql = "delete from tbl_agama where id_agama= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>