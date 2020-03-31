<?php
class M_bahasa extends CI_Model{
	public function list_bahasa(){
		
		return $this->db->query("select * from tbl_bahasa order by id_bahasa asc ")->result();
	}
	public function bahasa($limit,$start){
		
		return $this->db->query("select * from tbl_bahasa order by id_bahasa asc limit $start, $limit")->result();
	}
	
	
	public function jumlah_bahasa(){
		return $this->db->query("select * from tbl_bahasa order by id_bahasa asc ")->num_rows();
	}
	public function select_bahasa(){
		
		return $this->db->query("select * from tbl_bahasa order by nama_bahasa asc ")->result();
	}
	
	function ceknamabahasa($bahasa){
		$sql = "select * from tbl_bahasa where nama_bahasa= ".$this->db->escape($bahasa)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function bahasa_add(){
		$bahasa = $this->input->post('bahasa');
		
		$sql = "insert into tbl_bahasa(nama_bahasa) values('$bahasa')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function bahasa_edit($id){
		$sql = "select * from tbl_bahasa where id_bahasa = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekbahasa_edit($bahasa,$bahasa_awal){
		$sql = "select * from tbl_bahasa where nama_bahasa = ".$this->db->escape($bahasa)." and nama_bahasa <> ".$this->db->escape($bahasa_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function bahasa_edit_proses(){
		$post_nama_bahasa=$this->input->post('bahasa');
		$post_nama_bahasa_awal=$this->input->post('bahasa_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_bahasa set 
		nama_bahasa='$post_nama_bahasa'
		where id_bahasa='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function bahasa_delete($id){
		$sql = "delete from tbl_bahasa where id_bahasa= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>