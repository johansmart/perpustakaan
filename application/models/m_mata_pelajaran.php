<?php
class M_mata_pelajaran extends CI_Model{
	public function list_mata_pelajaran(){
		
		return $this->db->query("select * from tbl_mata_pelajaran order by id_mata_pelajaran asc ")->result();
	}
	public function mata_pelajaran($limit,$start){
		
		return $this->db->query("select * from tbl_mata_pelajaran order by id_mata_pelajaran asc limit $start, $limit")->result();
	}
	
	
	public function jumlah_mata_pelajaran(){
		return $this->db->query("select * from tbl_mata_pelajaran order by id_mata_pelajaran asc ")->num_rows();
	}
	
	
	function ceknamamata_pelajaran($mata_pelajaran){
		$sql = "select * from tbl_mata_pelajaran where nama_mata_pelajaran= ".$this->db->escape($mata_pelajaran)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function mata_pelajaran_add(){
		$mata_pelajaran = $this->input->post('mata_pelajaran');
		
		$sql = "insert into tbl_mata_pelajaran(nama_mata_pelajaran) values('$mata_pelajaran')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function mata_pelajaran_edit($id){
		$sql = "select * from tbl_mata_pelajaran where id_mata_pelajaran = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekmata_pelajaran_edit($mata_pelajaran,$mata_pelajaran_awal){
		$sql = "select * from tbl_mata_pelajaran where nama_mata_pelajaran = ".$this->db->escape($mata_pelajaran)." and nama_mata_pelajaran <> ".$this->db->escape($mata_pelajaran_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function mata_pelajaran_edit_proses(){
		$post_nama_mata_pelajaran=$this->input->post('mata_pelajaran');
		$post_nama_mata_pelajaran_awal=$this->input->post('mata_pelajaran_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_mata_pelajaran set 
		nama_mata_pelajaran='$post_nama_mata_pelajaran'
		where id_mata_pelajaran='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function mata_pelajaran_delete($id){
		$sql = "delete from tbl_mata_pelajaran where id_mata_pelajaran= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>