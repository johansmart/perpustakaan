<?php
class M_pengarang extends CI_Model{
	public function list_pengarang(){
		
		return $this->db->query("select * from tbl_pengarang order by id_pengarang asc ")->result();
	}
	public function pengarang($limit,$start){
		
		return $this->db->query("select * from tbl_pengarang order by id_pengarang asc limit $start, $limit")->result();
	}
	
	
	public function jumlah_pengarang(){
		return $this->db->query("select * from tbl_pengarang order by id_pengarang asc ")->num_rows();
	}
	public function select_pengarang(){
		
		return $this->db->query("select * from tbl_pengarang order by nama_pengarang asc ")->result();
	}
	
	function ceknamapengarang($pengarang){
		$sql = "select * from tbl_pengarang where nama_pengarang= ".$this->db->escape($pengarang)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function pengarang_add(){
		$pengarang = $this->input->post('pengarang');
		
		$sql = "insert into tbl_pengarang(nama_pengarang) values('$pengarang')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function pengarang_edit($id){
		$sql = "select * from tbl_pengarang where id_pengarang = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekpengarang_edit($pengarang,$pengarang_awal){
		$sql = "select * from tbl_pengarang where nama_pengarang = ".$this->db->escape($pengarang)." and nama_pengarang <> ".$this->db->escape($pengarang_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function pengarang_edit_proses(){
		$post_nama_pengarang=$this->input->post('pengarang');
		$post_nama_pengarang_awal=$this->input->post('pengarang_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_pengarang set 
		nama_pengarang='$post_nama_pengarang'
		where id_pengarang='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function pengarang_delete($id){
		$sql = "delete from tbl_pengarang where id_pengarang= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>