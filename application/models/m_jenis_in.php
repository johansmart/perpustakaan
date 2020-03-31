<?php
class M_jenis_in extends CI_Model{
	public function list_jenis_in(){
		
		return $this->db->query("select * from tbl_jenis_in order by id_jenis_in asc ")->result();
	}
	public function jenis_in($limit,$start){
		
		return $this->db->query("select * from tbl_jenis_in order by id_jenis_in asc limit $start, $limit")->result();
	}
	
	
	public function jumlah_jenis_in(){
		return $this->db->query("select * from tbl_jenis_in order by id_jenis_in asc ")->num_rows();
	}
	
		public function select_jenis_in(){
		
		return $this->db->query("select * from tbl_jenis_in order by nama_jenis_in asc ")->result();
	}
	function ceknamajenis_in($jenis_in){
		$sql = "select * from tbl_jenis_in where nama_jenis_in= ".$this->db->escape($jenis_in)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_in_add(){
		$jenis_in = $this->input->post('jenis_in');
		
		$sql = "insert into tbl_jenis_in(nama_jenis_in) values('$jenis_in')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_in_edit($id){
		$sql = "select * from tbl_jenis_in where id_jenis_in = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekjenis_in_edit($jenis_in,$jenis_in_awal){
		$sql = "select * from tbl_jenis_in where nama_jenis_in = ".$this->db->escape($jenis_in)." and nama_jenis_in <> ".$this->db->escape($jenis_in_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_in_edit_proses(){
		$post_nama_jenis_in=$this->input->post('jenis_in');
		$post_nama_jenis_in_awal=$this->input->post('jenis_in_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_jenis_in set 
		nama_jenis_in='$post_nama_jenis_in'
		where id_jenis_in='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_in_delete($id){
		$sql = "delete from tbl_jenis_in where id_jenis_in= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>