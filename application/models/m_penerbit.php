<?php
class M_penerbit extends CI_Model{
	public function list_penerbit(){
		
		return $this->db->query("select * from tbl_penerbit order by id_penerbit asc ")->result();
	}
	public function penerbit($limit,$start){
		
		return $this->db->query("select * from tbl_penerbit order by id_penerbit asc limit $start, $limit")->result();
	}
	
	
	public function jumlah_penerbit(){
		return $this->db->query("select * from tbl_penerbit order by id_penerbit asc ")->num_rows();
	}
	public function select_penerbit(){
		
		return $this->db->query("select * from tbl_penerbit order by nama_penerbit asc ")->result();
	}
	
	function ceknamapenerbit($penerbit){
		$sql = "select * from tbl_penerbit where nama_penerbit= ".$this->db->escape($penerbit)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function penerbit_add(){
		$penerbit = $this->input->post('penerbit');
		
		$sql = "insert into tbl_penerbit(nama_penerbit) values('$penerbit')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function penerbit_edit($id){
		$sql = "select * from tbl_penerbit where id_penerbit = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekpenerbit_edit($penerbit,$penerbit_awal){
		$sql = "select * from tbl_penerbit where nama_penerbit = ".$this->db->escape($penerbit)." and nama_penerbit <> ".$this->db->escape($penerbit_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function penerbit_edit_proses(){
		$post_nama_penerbit=$this->input->post('penerbit');
		$post_nama_penerbit_awal=$this->input->post('penerbit_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_penerbit set 
		nama_penerbit='$post_nama_penerbit'
		where id_penerbit='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function penerbit_delete($id){
		$sql = "delete from tbl_penerbit where id_penerbit= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>