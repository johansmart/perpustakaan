<?php
class M_member extends CI_Model{

	// public function read()
	// {
		
	// }

	public function list_member($limit,$start,$cari_art){
			$cari_art 			= $this->session->userdata('search');
		return $this->db->query("select * from tbl_member,tbl_jenis_member
		where 
		tbl_member.id_jenis_member=tbl_jenis_member.id_jenis_member and
		status_member='1' and (
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_jenis_member.nama_jenis_member like'%".mysql_real_escape_string($cari_art)."%' ) 
		
		order by id_member desc limit $start, $limit")->result();
	}
	public function jumlah_list_member(){
	$cari_art 			= $this->session->userdata('search');
		return $this->db->query("select * from tbl_member,tbl_jenis_member 
		where 
		tbl_member.id_jenis_member=tbl_jenis_member.id_jenis_member and
		status_member='1' and (
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_jenis_member.nama_jenis_member like'%".mysql_real_escape_string($cari_art)."%' ) order by id_member desc ")->num_rows();
	}
	
	
	
	function member_delete($id){
		$sql = "delete from tbl_member where id_member = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	public function member_add($post_id,$post_barcode,$post_nama,$post_tempat_lahir,$post_tanggal_lahir,$post_jk,$post_status,$post_exp,$post_jenis_member,$file_name){
	
		$sql = "insert into tbl_member 
		(
		no_identitas_member,
		barcode_member,
		nama_member,
		tempat_lahir_member,
		tanggal_lahir_member,
		jenis_kelamin_member,
		id_jenis_member,
		exp_card_member,
		photo_member,
		status_member
		) values
		(".$this->db->escape($post_id).",
		".$this->db->escape($post_barcode).",
		".$this->db->escape($post_nama).",
		".$this->db->escape($post_tempat_lahir).",
		".$this->db->escape($post_tanggal_lahir).",
		".$this->db->escape($post_jk).",
		".$this->db->escape($post_jenis_member).",
		".$this->db->escape($post_exp).",
		".$this->db->escape($file_name).",
		".$this->db->escape($post_status).")";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	public function member_edit($id){
			
		return $this->db->query("select * from tbl_member m,tbl_jenis_member j,tbl_kota k
		where 
		m.tempat_lahir_member=k.id_kota and
		m.id_jenis_member=j.id_jenis_member and
		m.id_member=".mysql_real_escape_string($id)."
		 ")->result();
	}
	
	public function member_edit_proses($post_id_member,$post_id,$post_barcode,$post_nama,$post_tempat_lahir,$post_tanggal_lahir,$post_jk,$post_status,$post_exp,$post_jenis_member){
	
		$sql = "update tbl_member 
		set
		no_identitas_member=".$this->db->escape($post_id).",
		barcode_member=".$this->db->escape($post_barcode).",
		nama_member=".$this->db->escape($post_nama).",
		tempat_lahir_member=".$this->db->escape($post_tempat_lahir).",
		tanggal_lahir_member=".$this->db->escape($post_tanggal_lahir).",
		jenis_kelamin_member=".$this->db->escape($post_jk).",
		id_jenis_member=".$this->db->escape($post_jenis_member).",
		exp_card_member=".$this->db->escape($post_exp).",
		status_member=".$this->db->escape($post_status)."
		where id_member=".$this->db->escape($post_id_member)."
		";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	public function member_edit_prosesphoto($post_id_member,$post_id,$post_barcode,$post_nama,$post_tempat_lahir,$post_tanggal_lahir,$post_jk,$post_status,$post_exp,$post_jenis_member,$file_name){
	
		$sql = "update tbl_member 
		set
		no_identitas_member=".$this->db->escape($post_id).",
		barcode_member=".$this->db->escape($post_barcode).",
		nama_member=".$this->db->escape($post_nama).",
		tempat_lahir_member=".$this->db->escape($post_tempat_lahir).",
		tanggal_lahir_member=".$this->db->escape($post_tanggal_lahir).",
		jenis_kelamin_member=".$this->db->escape($post_jk).",
		id_jenis_member=".$this->db->escape($post_jenis_member).",
		exp_card_member=".$this->db->escape($post_exp).",
		photo_member=".$this->db->escape($file_name).",
		status_member=".$this->db->escape($post_status)."
		where id_member=".$this->db->escape($post_id_member)."
		";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	function cekid_member($id){
		$sql = "select * from tbl_member where no_identitas_member= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekid_member2($id,$id2){
		$sql = "select * from tbl_member where no_identitas_member= ".$this->db->escape($id)." and no_identitas_member<> ".$this->db->escape($id2)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	public function member_get($barcode){
			
		$sql = "select * from tbl_member m,tbl_jenis_member j,tbl_kota k
		where 
		m.tempat_lahir_member=k.id_kota and
		m.id_jenis_member=j.id_jenis_member and
		m.barcode_member='".mysql_real_escape_string($barcode)."'
		 ";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	public function laporanlist_member($limit,$start,$cari_art){
			$cari_art 			= $this->session->userdata('search_mmbr');
		return $this->db->query("select * from tbl_member,tbl_jenis_member,tbl_kota
		where 
		tbl_member.id_jenis_member=tbl_jenis_member.id_jenis_member and
		tbl_member.tempat_lahir_member=tbl_kota.id_kota and
		status_member='1' and (
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_jenis_member.nama_jenis_member like'%".mysql_real_escape_string($cari_art)."%' ) 
		
		order by id_member desc limit $start, $limit")->result();
	}
	public function laporanjumlah_list_member(){
	$cari_art 			= $this->session->userdata('search_mmbr');
		return $this->db->query("select * from tbl_member,tbl_jenis_member ,tbl_kota
		where 
		tbl_member.id_jenis_member=tbl_jenis_member.id_jenis_member and
		tbl_member.tempat_lahir_member=tbl_kota.id_kota and
		status_member='1' and (
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_jenis_member.nama_jenis_member like'%".mysql_real_escape_string($cari_art)."%' ) order by id_member desc ")->num_rows();
	}
	public function laporanlist_memberprint(){
			$cari_art 			= $this->session->userdata('search_mmbr');
		return $this->db->query("select * from tbl_member,tbl_jenis_member,tbl_kota
		where 
		tbl_member.id_jenis_member=tbl_jenis_member.id_jenis_member and
		tbl_member.tempat_lahir_member=tbl_kota.id_kota and
		status_member='1' and (
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($cari_art)."%' or
		tbl_jenis_member.nama_jenis_member like'%".mysql_real_escape_string($cari_art)."%' ) 
		
		order by id_member desc ")->result();
	}
	
	//ajax
	public function member_cekbarcode($barcode){
			
		$sql = "select * from tbl_member
		where 
		tbl_member.barcode_member=".$this->db->escape($barcode)."
		
		 ";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	public function member_cekbarcodeedit($barcode0,$barcode){
			
		$sql = "select * from tbl_member
		where 
		tbl_member.barcode_member=".$this->db->escape($barcode)." 
		and
		
		tbl_member.barcode_member <>".$this->db->escape($barcode0)." 
		
		 ";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
}
?>