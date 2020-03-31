<?php
class M_inventory_in extends CI_Model{
	public function inventory_in($limit,$start){
		
		return $this->db->query("select * from tbl_inventory_in, tbl_jenis_in, tbl_inventory,admin
		where
			( admin.id_admin=tbl_inventory_in.id_admin and
		tbl_inventory.id_inventory=tbl_inventory_in.id_inventory and
		tbl_jenis_in.id_jenis_in=tbl_inventory_in.id_jenis_in 
		and  tbl_inventory_in.status_inventory_in=1 )
		and 
		(
		tbl_inventory_in.tgl_buku_in like '%".mysql_real_escape_string($this->session->userdata('search_inv_in'))."%' or
		tbl_inventory_in.tgl_inventory_in like '%".mysql_real_escape_string($this->session->userdata('search_inv_in'))."%' or 
		tbl_jenis_in.nama_jenis_in like '%".mysql_real_escape_string($this->session->userdata('search_inv_in'))."%' or
		tbl_inventory.barcode_inventory like '%".mysql_real_escape_string($this->session->userdata('search_inv_in'))."%' or
		tbl_inventory.judul_inventory like '%".mysql_real_escape_string($this->session->userdata('search_inv_in'))."%' 
		)
		order by tbl_inventory_in.id_inventory_in desc limit $start, $limit")->result();
	}
	
	
	public function jumlah_inventory_in(){
		return $this->db->query("select * from tbl_inventory_in, tbl_jenis_in, tbl_inventory,admin
		where
		( admin.id_admin=tbl_inventory_in.id_admin and
		tbl_inventory.id_inventory=tbl_inventory_in.id_inventory and
		tbl_jenis_in.id_jenis_in=tbl_inventory_in.id_jenis_in 
		and  tbl_inventory_in.status_inventory_in=1 )
		and 
		(
		tbl_inventory_in.tgl_buku_in like '%".mysql_real_escape_string($this->session->userdata('search_inv_in'))."%' or
		tbl_inventory_in.tgl_inventory_in like '%".mysql_real_escape_string($this->session->userdata('search_inv_in'))."%' or 
		tbl_jenis_in.nama_jenis_in like '%".mysql_real_escape_string($this->session->userdata('search_inv_in'))."%' or
		tbl_inventory.barcode_inventory like '%".mysql_real_escape_string($this->session->userdata('search_inv_in'))."%' or
		tbl_inventory.judul_inventory like '%".mysql_real_escape_string($this->session->userdata('search_inv_in'))."%' 
		)
		order by tbl_inventory_in.id_inventory_in desc")->num_rows();
	}
	
	public function inventory_in_add(){
		$post_barcode=$this->input->post('barcode');
		$post_id=$this->input->post('id');
		$post_tgl=$this->input->post('tgl');
		$post_jumlah=$this->input->post('jumlah');
		$post_jenis_in=$this->input->post('jenis_in');
		$post_keterangan=$this->input->post('ket');
		$id_admin=$this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id');
		
		$sql = "insert into  tbl_inventory_in
		(
		id_inventory,
		tgl_inventory_in,
		jumlah_inventory_in,
		id_jenis_in,
		keterangan_inventory_in,
		tgl_buku_in,
		id_admin,
		status_inventory_in
		) values
		(".$this->db->escape($post_id).",
		".$this->db->escape($post_tgl).",
		".$this->db->escape($post_jumlah).",
		".$this->db->escape($post_jenis_in).",
		".$this->db->escape($post_keterangan).",
		now(),
		".$this->db->escape($id_admin).",
		1)";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	function inventory_in_update_delete($id,$admin){
		$sql = "update tbl_inventory_in set status_inventory_in=0, id_admin_hapus_in=".$this->db->escape($admin)." where id_inventory_in = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	public function inventory_in_edit($id){
		
		return $this->db->query("select * from tbl_inventory_in, tbl_jenis_in, tbl_inventory,admin
		where
		admin.id_admin=tbl_inventory_in.id_admin and
		tbl_inventory.id_inventory=tbl_inventory_in.id_inventory and
		tbl_jenis_in.id_jenis_in=tbl_inventory_in.id_jenis_in 
		and  tbl_inventory_in.status_inventory_in=1 and tbl_inventory_in.id_inventory_in=".$this->db->escape($id)."
		order by tbl_inventory_in.id_inventory_in desc")->result();
	}
	
	public function inventory_in_edit_proses(){
		$post_id_inventory_in=$this->input->post('id_inventory_in');
		$post_barcode=$this->input->post('barcode');
		$post_id=$this->input->post('id');
		$post_tgl=$this->input->post('tgl');
		$post_jumlah=$this->input->post('jumlah');
		$post_jenis_in=$this->input->post('jenis_in');
		$post_keterangan=$this->input->post('ket');
		$id_admin=$this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id');
		
		$sql = "update tbl_inventory_in set
		
		id_inventory=".$this->db->escape($post_id).",
		tgl_inventory_in=".$this->db->escape($post_tgl).",
		jumlah_inventory_in=".$this->db->escape($post_jumlah).",
		id_jenis_in=".$this->db->escape($post_jenis_in).",
		keterangan_inventory_in=".$this->db->escape($post_keterangan).",
		tgl_buku_in=now(),
		id_admin=".$this->db->escape($id_admin).",
		status_inventory_in=1
		where id_inventory_in=".$this->db->escape($post_id_inventory_in)."
		";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	//laporan
	
	public function laporan_inventory_in($limit,$start){
		
		return $this->db->query("select * from tbl_inventory_in, tbl_jenis_in, tbl_inventory,admin
		where
			( admin.id_admin=tbl_inventory_in.id_admin and
		tbl_inventory.id_inventory=tbl_inventory_in.id_inventory and
		tbl_jenis_in.id_jenis_in=tbl_inventory_in.id_jenis_in 
		and  tbl_inventory_in.status_inventory_in=1 )
		and 
		(
		tbl_inventory_in.tgl_buku_in like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' or
		tbl_inventory_in.tgl_inventory_in like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' or 
		tbl_jenis_in.nama_jenis_in like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' or
		tbl_inventory.barcode_inventory like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' or
		tbl_inventory.judul_inventory like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' 
		)
		order by tbl_inventory_in.id_inventory_in desc limit $start, $limit")->result();
	}
	
	
	public function laporan_jumlah_inventory_in(){
		return $this->db->query("select * from tbl_inventory_in, tbl_jenis_in, tbl_inventory,admin
		where
		( admin.id_admin=tbl_inventory_in.id_admin and
		tbl_inventory.id_inventory=tbl_inventory_in.id_inventory and
		tbl_jenis_in.id_jenis_in=tbl_inventory_in.id_jenis_in 
		and  tbl_inventory_in.status_inventory_in=1 )
		and 
		(
		tbl_inventory_in.tgl_buku_in like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' or
		tbl_inventory_in.tgl_inventory_in like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' or 
		tbl_jenis_in.nama_jenis_in like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' or
		tbl_inventory.barcode_inventory like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' or
		tbl_inventory.judul_inventory like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' 
		)
		order by tbl_inventory_in.id_inventory_in desc")->num_rows();
	}
	
	public function laporanlist_inventory_inprint(){
		
		return $this->db->query("select * from tbl_inventory_in, tbl_jenis_in, tbl_inventory,admin
		where
			( admin.id_admin=tbl_inventory_in.id_admin and
		tbl_inventory.id_inventory=tbl_inventory_in.id_inventory and
		tbl_jenis_in.id_jenis_in=tbl_inventory_in.id_jenis_in 
		and  tbl_inventory_in.status_inventory_in=1 )
		and 
		(
		tbl_inventory_in.tgl_buku_in like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' or
		tbl_inventory_in.tgl_inventory_in like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' or 
		tbl_jenis_in.nama_jenis_in like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' or
		tbl_inventory.barcode_inventory like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' or
		tbl_inventory.judul_inventory like '%".mysql_real_escape_string($this->session->userdata('lap_search_inv_in'))."%' 
		)
		order by tbl_inventory_in.id_inventory_in desc ")->result();
	}
}
?>