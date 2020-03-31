<?php
class M_klasifikasi extends CI_Model{
	public function list_klasifikasi(){
		
		return $this->db->query("select * from tbl_klasifikasi order by id_klasifikasi asc ")->result();
	}
	public function klasifikasi($limit,$start){
		
		return $this->db->query("select * from tbl_klasifikasi order by id_klasifikasi asc limit $start, $limit")->result();
	}
	
	
	public function jumlah_klasifikasi(){
		return $this->db->query("select * from tbl_klasifikasi order by id_klasifikasi asc ")->num_rows();
	}
	
	public function select_klasifikasi(){
		
		return $this->db->query("select * from tbl_klasifikasi order by nama_klasifikasi asc ")->result();
	}
	function ceknamaklasifikasi($klasifikasi){
		$sql = "select * from tbl_klasifikasi where nama_klasifikasi= ".$this->db->escape($klasifikasi)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function klasifikasi_add(){
		$klasifikasi = $this->input->post('klasifikasi');
		
		$sql = "insert into tbl_klasifikasi(nama_klasifikasi) values('$klasifikasi')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function klasifikasi_edit($id){
		$sql = "select * from tbl_klasifikasi where id_klasifikasi = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekklasifikasi_edit($klasifikasi,$klasifikasi_awal){
		$sql = "select * from tbl_klasifikasi where nama_klasifikasi = ".$this->db->escape($klasifikasi)." and nama_klasifikasi <> ".$this->db->escape($klasifikasi_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function klasifikasi_edit_proses(){
		$post_nama_klasifikasi=$this->input->post('klasifikasi');
		$post_nama_klasifikasi_awal=$this->input->post('klasifikasi_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_klasifikasi set 
		nama_klasifikasi='$post_nama_klasifikasi'
		where id_klasifikasi='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function klasifikasi_delete($id){
		$sql = "delete from tbl_klasifikasi where id_klasifikasi= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>