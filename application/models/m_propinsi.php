<?php
class M_propinsi extends CI_Model{
	public function list_propinsi(){
		
		return $this->db->query("select * from tbl_propinsi order by id_propinsi asc ")->result();
	}
	public function propinsi($limit,$start){
		
		return $this->db->query("select * from tbl_propinsi order by id_propinsi asc limit $start, $limit")->result();
	}
	
	
	public function jumlah_propinsi(){
		return $this->db->query("select * from tbl_propinsi order by id_propinsi asc ")->num_rows();
	}
	
	
	function ceknamapropinsi($propinsi){
		$sql = "select * from tbl_propinsi where nama_propinsi= ".$this->db->escape($propinsi)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function propinsi_add(){
		$propinsi = $this->input->post('propinsi');
		
		$sql = "insert into tbl_propinsi(nama_propinsi) values('$propinsi')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function propinsi_edit($id){
		$sql = "select * from tbl_propinsi where id_propinsi = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekpropinsi_edit($propinsi,$propinsi_awal){
		$sql = "select * from tbl_propinsi where nama_propinsi = ".$this->db->escape($propinsi)." and nama_propinsi <> ".$this->db->escape($propinsi_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function propinsi_edit_proses(){
		$post_nama_propinsi=$this->input->post('propinsi');
		$post_nama_propinsi_awal=$this->input->post('propinsi_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_propinsi set 
		nama_propinsi='$post_nama_propinsi'
		where id_propinsi='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function propinsi_delete($id){
		$sql = "delete from tbl_propinsi where id_propinsi= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>