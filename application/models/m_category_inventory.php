<?php
class M_category_inventory extends CI_Model{
	public function list_category_inventory(){
		
		return $this->db->query("select * from tbl_category_inventory order by id_category_inventory asc ")->result();
	}
	public function category_inventory($limit,$start){
		
		return $this->db->query("select * from tbl_category_inventory order by id_category_inventory asc limit $start, $limit")->result();
	}
	public function select_category_inventory(){
		
		return $this->db->query("select * from tbl_category_inventory order by nama_category_inventory asc ")->result();
	}
	
	public function jumlah_category_inventory(){
		return $this->db->query("select * from tbl_category_inventory order by id_category_inventory asc ")->num_rows();
	}
	
	
	function ceknamacategory_inventory($category_inventory){
		$sql = "select * from tbl_category_inventory where nama_category_inventory= ".$this->db->escape($category_inventory)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function category_inventory_add(){
		$category_inventory = $this->input->post('category_inventory');
		
		$sql = "insert into tbl_category_inventory(nama_category_inventory) values('$category_inventory')";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function category_inventory_edit($id){
		$sql = "select * from tbl_category_inventory where id_category_inventory = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekcategory_inventory_edit($category_inventory,$category_inventory_awal){
		$sql = "select * from tbl_category_inventory where nama_category_inventory = ".$this->db->escape($category_inventory)." and nama_category_inventory <> ".$this->db->escape($category_inventory_awal)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function category_inventory_edit_proses(){
		$post_nama_category_inventory=$this->input->post('category_inventory');
		$post_nama_category_inventory_awal=$this->input->post('category_inventory_awal');
		$post_id=$this->input->post('id');
		
		$sql = "update tbl_category_inventory set 
		nama_category_inventory='$post_nama_category_inventory'
		where id_category_inventory='$post_id'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function category_inventory_delete($id){
		$sql = "delete from tbl_category_inventory where id_category_inventory= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>