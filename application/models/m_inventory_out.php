<?php
class M_inventory_out extends CI_Model{
	public function inventory_out($limit,$start){
		
		return $this->db->query("select * from tbl_inventory_out, tbl_jenis_out, tbl_inventory,admin
		where
			( admin.id_admin=tbl_inventory_out.id_admin and
		tbl_inventory.id_inventory=tbl_inventory_out.id_inventory and
		tbl_jenis_out.id_jenis_out=tbl_inventory_out.id_jenis_out 
		and  tbl_inventory_out.status_inventory_out=1 )
		and 
		(
		tbl_inventory_out.tgl_buku_out like '%".mysql_real_escape_string($this->session->userdata('search_inv_out'))."%' or
		tbl_inventory_out.tgl_inventory_out like '%".mysql_real_escape_string($this->session->userdata('search_inv_out'))."%' or 
		tbl_jenis_out.nama_jenis_out like '%".mysql_real_escape_string($this->session->userdata('search_inv_out'))."%' or
		tbl_inventory.barcode_inventory like '%".mysql_real_escape_string($this->session->userdata('search_inv_out'))."%' or
		tbl_inventory.judul_inventory like '%".mysql_real_escape_string($this->session->userdata('search_inv_out'))."%' 
		)
		order by tbl_inventory_out.id_inventory_out desc limit $start, $limit")->result();
	}
	
	
	public function jumlah_inventory_out(){
		return $this->db->query("select * from tbl_inventory_out, tbl_jenis_out, tbl_inventory,admin
		where
			( admin.id_admin=tbl_inventory_out.id_admin and
		tbl_inventory.id_inventory=tbl_inventory_out.id_inventory and
		tbl_jenis_out.id_jenis_out=tbl_inventory_out.id_jenis_out 
		and  tbl_inventory_out.status_inventory_out=1 )
		and 
		(
		tbl_inventory_out.tgl_buku_out like '%".mysql_real_escape_string($this->session->userdata('search_inv_out'))."%' or
		tbl_inventory_out.tgl_inventory_out like '%".mysql_real_escape_string($this->session->userdata('search_inv_out'))."%' or 
		tbl_jenis_out.nama_jenis_out like '%".mysql_real_escape_string($this->session->userdata('search_inv_out'))."%' or
		tbl_inventory.barcode_inventory like '%".mysql_real_escape_string($this->session->userdata('search_inv_out'))."%' or
		tbl_inventory.judul_inventory like '%".mysql_real_escape_string($this->session->userdata('search_inv_out'))."%' 
		)
		order by tbl_inventory_out.id_inventory_out desc")->num_rows();
	}
	
	public function inventory_out_add(){
		$post_barcode=$this->input->post('barcode');
		$post_id=$this->input->post('id');
		$post_tgl=$this->input->post('tgl');
		$post_jumlah=$this->input->post('jumlah');
		$post_jenis_out=$this->input->post('jenis_out');
		$post_keterangan=$this->input->post('ket');
		$id_admin=$this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id');
		
		$sql = "insert into  tbl_inventory_out
		(
		id_inventory,
		tgl_inventory_out,
		jumlah_inventory_out,
		id_jenis_out,
		keterangan_inventory_out,
		tgl_buku_out,
		id_admin,
		status_inventory_out
		) values
		(".$this->db->escape($post_id).",
		".$this->db->escape($post_tgl).",
		".$this->db->escape($post_jumlah).",
		".$this->db->escape($post_jenis_out).",
		".$this->db->escape($post_keterangan).",
		now(),
		".$this->db->escape($id_admin).",
		1)";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	function inventory_out_update_delete($id,$admin){
		$sql = "update tbl_inventory_out set status_inventory_out=0, id_admin_hapus_out=".$this->db->escape($admin)." where id_inventory_out = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	public function inventory_out_edit($id){
		
		return $this->db->query("select * from tbl_inventory_out, tbl_jenis_out, tbl_inventory,admin
		where
		admin.id_admin=tbl_inventory_out.id_admin and
		tbl_inventory.id_inventory=tbl_inventory_out.id_inventory and
		tbl_jenis_out.id_jenis_out=tbl_inventory_out.id_jenis_out 
		and  tbl_inventory_out.status_inventory_out=1 and tbl_inventory_out.id_inventory_out=".$this->db->escape($id)."
		order by tbl_inventory_out.id_inventory_out desc")->result();
	}
	
	public function inventory_out_edit_proses(){
		$post_id_inventory_out=$this->input->post('id_inventory_out');
		$post_barcode=$this->input->post('barcode');
		$post_id=$this->input->post('id');
		$post_tgl=$this->input->post('tgl');
		$post_jumlah=$this->input->post('jumlah');
		$post_jenis_out=$this->input->post('jenis_out');
		$post_keterangan=$this->input->post('ket');
		$id_admin=$this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id');
		
		$sql = "update tbl_inventory_out set
		
		id_inventory=".$this->db->escape($post_id).",
		tgl_inventory_out=".$this->db->escape($post_tgl).",
		jumlah_inventory_out=".$this->db->escape($post_jumlah).",
		id_jenis_out=".$this->db->escape($post_jenis_out).",
		keterangan_inventory_out=".$this->db->escape($post_keterangan).",
		tgl_buku_out=now(),
		id_admin=".$this->db->escape($id_admin).",
		status_inventory_out=1
		where id_inventory_out=".$this->db->escape($post_id_inventory_out)."
		";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	//laporan
	
	public function laporan_inventory_out($limit,$start){
		
		return $this->db->query("select * from tbl_inventory_out, tbl_jenis_out, tbl_inventory,admin
		where
			( admin.id_admin=tbl_inventory_out.id_admin and
		tbl_inventory.id_inventory=tbl_inventory_out.id_inventory and
		tbl_jenis_out.id_jenis_out=tbl_inventory_out.id_jenis_out 
		and  tbl_inventory_out.status_inventory_out=1 )
		and 
		(
		tbl_inventory_out.tgl_buku_out like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' or
		tbl_inventory_out.tgl_inventory_out like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' or 
		tbl_jenis_out.nama_jenis_out like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' or
		tbl_inventory.barcode_inventory like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' or
		tbl_inventory.judul_inventory like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' 
		)
		order by tbl_inventory_out.id_inventory_out desc limit $start, $limit")->result();
	}
	
	
	public function laporan_jumlah_inventory_out(){
		return $this->db->query("select * from tbl_inventory_out, tbl_jenis_out, tbl_inventory,admin
		where
			( admin.id_admin=tbl_inventory_out.id_admin and
		tbl_inventory.id_inventory=tbl_inventory_out.id_inventory and
		tbl_jenis_out.id_jenis_out=tbl_inventory_out.id_jenis_out 
		and  tbl_inventory_out.status_inventory_out=1 )
		and 
		(
		tbl_inventory_out.tgl_buku_out like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' or
		tbl_inventory_out.tgl_inventory_out like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' or 
		tbl_jenis_out.nama_jenis_out like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' or
		tbl_inventory.barcode_inventory like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' or
		tbl_inventory.judul_inventory like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' 
		)
		order by tbl_inventory_out.id_inventory_out desc")->num_rows();
	}
	public function laporanlist_inventory_outprint(){
		
		return $this->db->query("select * from tbl_inventory_out, tbl_jenis_out, tbl_inventory,admin
		where
			( admin.id_admin=tbl_inventory_out.id_admin and
		tbl_inventory.id_inventory=tbl_inventory_out.id_inventory and
		tbl_jenis_out.id_jenis_out=tbl_inventory_out.id_jenis_out 
		and  tbl_inventory_out.status_inventory_out=1 )
		and 
		(
		tbl_inventory_out.tgl_buku_out like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' or
		tbl_inventory_out.tgl_inventory_out like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' or 
		tbl_jenis_out.nama_jenis_out like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' or
		tbl_inventory.barcode_inventory like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' or
		tbl_inventory.judul_inventory like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_out'))."%' 
		)
		order by tbl_inventory_out.id_inventory_out desc")->result();
	}
	
	
}
?>