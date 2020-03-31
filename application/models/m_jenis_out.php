<?php
class M_jenis_out extends CI_Model{
	public function list_jenis_out(){
		
		return $this->db->query("select * from tbl_jenis_out order by id_jenis_out asc ")->result();
	}
	public function jenis_out($limit,$start){
		
		return $this->db->query("select * from tbl_jenis_out order by id_jenis_out asc limit $start, $limit")->result();
	}
	
	
	public function jumlah_jenis_out(){
		return $this->db->query("select * from tbl_jenis_out order by id_jenis_out asc ")->num_rows();
	}
	
		public function select_jenis_out(){
		
		return $this->db->query("select * from tbl_jenis_out order by nama_jenis_out asc ")->result();
	}
	function ceknamajenis_out($jenis_out){
		$sql = "select * from tbl_jenis_out where nama_jenis_out= ".$this->db->escape($jenis_out)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_out_add(){
		$jenis_out = $this->input->post('jenis_out');
		
		$sql = "insert into tbl_jenis_out(nama_jenis_out) values('$jenis_out')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_out_edit($id){
		$sql = "select * from tbl_jenis_out where id_jenis_out = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekjenis_out_edit($jenis_out,$jenis_out_awal){
		$sql = "select * from tbl_jenis_out where nama_jenis_out = ".$this->db->escape($jenis_out)." and nama_jenis_out <> ".$this->db->escape($jenis_out_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_out_edit_proses(){
		$post_nama_jenis_out=$this->input->post('jenis_out');
		$post_nama_jenis_out_awal=$this->input->post('jenis_out_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_jenis_out set 
		nama_jenis_out='$post_nama_jenis_out'
		where id_jenis_out='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function jenis_out_delete($id){
		$sql = "delete from tbl_jenis_out where id_jenis_out= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>