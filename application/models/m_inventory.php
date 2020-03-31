<?php
class M_inventory extends CI_Model{

	public function list_inventory($limit,$start,$cari_inv){
			$cari_inv 			= $this->session->userdata('search_inv');
		return $this->db->query("select * from tbl_inventory,tbl_category_inventory,tbl_pengarang,tbl_penerbit,tbl_bahasa,tbl_kota,tbl_klasifikasi,tbl_letak_rak
		where 
		tbl_inventory.id_category_inventory=tbl_category_inventory.id_category_inventory and
		tbl_inventory.id_bahasa=tbl_bahasa.id_bahasa and
		tbl_inventory.id_pengarang=tbl_pengarang.id_pengarang and
		tbl_inventory.id_penerbit=tbl_penerbit.id_penerbit and
		tbl_inventory.id_kota=tbl_kota.id_kota and 
		tbl_inventory.klasifikasi1_inventory=tbl_klasifikasi.id_klasifikasi and
		tbl_inventory.id_letak_rak=tbl_letak_rak.id_letak_rak and
		status_inventory='1' and (
		tbl_letak_rak.nama_letak_rak like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_pengarang.nama_pengarang like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_penerbit.nama_penerbit like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_kota.nama_kota like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.tahun like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.ISBN like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_category_inventory.nama_category_inventory like'%".mysql_real_escape_string($cari_inv)."%' ) order by id_inventory desc limit $start, $limit")->result();
	}
	public function jumlah_list_inventory(){
	$cari_inv 			= $this->session->userdata('search_inv');
		return $this->db->query("select * from tbl_inventory,tbl_category_inventory,tbl_pengarang,tbl_penerbit,tbl_bahasa,tbl_kota,tbl_klasifikasi,tbl_letak_rak
		where 
		tbl_inventory.id_category_inventory=tbl_category_inventory.id_category_inventory and
		tbl_inventory.id_bahasa=tbl_bahasa.id_bahasa and
		tbl_inventory.id_pengarang=tbl_pengarang.id_pengarang and
		tbl_inventory.id_penerbit=tbl_penerbit.id_penerbit and
		tbl_inventory.id_kota=tbl_kota.id_kota and 
		tbl_inventory.klasifikasi1_inventory=tbl_klasifikasi.id_klasifikasi and
		tbl_inventory.id_letak_rak=tbl_letak_rak.id_letak_rak and
		status_inventory='1' and (
		tbl_letak_rak.nama_letak_rak like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_pengarang.nama_pengarang like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_penerbit.nama_penerbit like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_kota.nama_kota like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.tahun like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.ISBN like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_category_inventory.nama_category_inventory like'%".mysql_real_escape_string($cari_inv)."%' ) order by id_inventory desc ")->num_rows();
	}
	
	function cek_isbn($isbn){
		$sql = "select * from tbl_inventory where ISBN= ".$this->db->escape($isbn)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cek_isbn2($isbn,$isbn2){
		$sql = "select * from tbl_inventory where ISBN= ".$this->db->escape($isbn)." and ISBN<> ".$this->db->escape($isbn2)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	function cek_barcode($barcode){
		$sql = "select * from tbl_inventory where barcode_inventory= ".$this->db->escape($barcode)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cek_barcode2($barcode,$barcode2){
		$sql = "select * from tbl_inventory where barcode_inventory= ".$this->db->escape($barcode)." and barcode_inventory<> ".$this->db->escape($barcode2)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	function inventory_delete($id){
		$sql = "delete from tbl_inventory where id_inventory = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	public function inventory_add1(){
		$post_barcode=$this->input->post('barcode');
		$post_category_inventory=$this->input->post('category_inventory');
		$post_judul=$this->input->post('judul');
		$post_isbn=$this->input->post('isbn');
		$post_pengarang=$this->input->post('pengarang');
		$post_penerbit=$this->input->post('penerbit');
		$post_kota=$this->input->post('kota');
		$post_tahun=$this->input->post('tahun');
		$post_letak_rak=$this->input->post('letak_rak');
		$post_bahasa=$this->input->post('bahasa');
		$post_halaman=$this->input->post('halaman');
		$post_detail=$this->input->post('detail');
		$post_klasifikasi=$this->input->post('klasifikasi');
		$post_status=$this->input->post('status');
		
		$sql = "insert into tbl_inventory 
		(
		barcode_inventory,
		id_category_inventory,
		judul_inventory,
		ISBN,
		id_pengarang,
		id_penerbit,
		id_kota,
		tahun,
		id_letak_rak,
		id_bahasa,
		jumlah_halaman_inventory,
		detail_inventory,
		klasifikasi1_inventory,
		status_inventory
		) values
		(".$this->db->escape($post_barcode).",
		".$this->db->escape($post_category_inventory).",
		".$this->db->escape($post_judul).",
		".$this->db->escape($post_isbn).",
		".$this->db->escape($post_pengarang).",
		".$this->db->escape($post_penerbit).",
		".$this->db->escape($post_kota).",
		".$this->db->escape($post_tahun).",
		".$this->db->escape($post_letak_rak).",
		".$this->db->escape($post_bahasa).",
		".$this->db->escape($post_halaman).",
		".$this->db->escape($post_detail).",
		".$this->db->escape($post_klasifikasi).",
		".$this->db->escape($post_status).")";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	public function inventory_add2($file_name){
		$post_barcode=$this->input->post('barcode');
		$post_category_inventory=$this->input->post('category_inventory');
		$post_judul=$this->input->post('judul');
		$post_isbn=$this->input->post('isbn');
		$post_pengarang=$this->input->post('pengarang');
		$post_penerbit=$this->input->post('penerbit');
		$post_kota=$this->input->post('kota');
		$post_tahun=$this->input->post('tahun');
		$post_letak_rak=$this->input->post('letak_rak');
		$post_bahasa=$this->input->post('bahasa');
		$post_halaman=$this->input->post('halaman');
		$post_detail=$this->input->post('detail');
		$post_klasifikasi=$this->input->post('klasifikasi');
		$post_status=$this->input->post('status');
		
		$sql = "insert into tbl_inventory 
		(
		barcode_inventory,
		id_category_inventory,
		judul_inventory,
		ISBN,
		id_pengarang,
		id_penerbit,
		id_kota,
		tahun,
		id_letak_rak,
		id_bahasa,
		jumlah_halaman_inventory,
		detail_inventory,
		klasifikasi1_inventory,
		image_inventory,
		status_inventory
		) values
		(".$this->db->escape($post_barcode).",
		".$this->db->escape($post_category_inventory).",
		".$this->db->escape($post_judul).",
		".$this->db->escape($post_isbn).",
		".$this->db->escape($post_pengarang).",
		".$this->db->escape($post_penerbit).",
		".$this->db->escape($post_kota).",
		".$this->db->escape($post_tahun).",
		".$this->db->escape($post_letak_rak).",
		".$this->db->escape($post_bahasa).",
		".$this->db->escape($post_halaman).",
		".$this->db->escape($post_detail).",
		".$this->db->escape($post_klasifikasi).",
		".$this->db->escape($file_name).",
		".$this->db->escape($post_status).")";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	public function inventory_edit($id){
			
		return $this->db->query("select * from tbl_inventory,tbl_category_inventory,tbl_pengarang,tbl_penerbit,tbl_bahasa,tbl_kota,tbl_klasifikasi,tbl_letak_rak
		where 
		tbl_inventory.id_category_inventory=tbl_category_inventory.id_category_inventory and
		tbl_inventory.id_bahasa=tbl_bahasa.id_bahasa and
		tbl_inventory.id_pengarang=tbl_pengarang.id_pengarang and
		tbl_inventory.id_penerbit=tbl_penerbit.id_penerbit and
		tbl_inventory.id_kota=tbl_kota.id_kota and 
		tbl_inventory.klasifikasi1_inventory=tbl_klasifikasi.id_klasifikasi and
		tbl_inventory.id_letak_rak=tbl_letak_rak.id_letak_rak and
		tbl_inventory.status_inventory='1' and tbl_inventory.id_inventory=".$this->db->escape($id)."
		 ")->result();
	}
	
	public function inventory_edit_proses1(){
		
		$post_id_inventory=$this->input->post('id_inventory');
		$post_barcode=$this->input->post('barcode');
		$post_category_inventory=$this->input->post('category_inventory');
		$post_judul=$this->input->post('judul');
		$post_isbn=$this->input->post('isbn');
		$post_pengarang=$this->input->post('pengarang');
		$post_penerbit=$this->input->post('penerbit');
		$post_kota=$this->input->post('kota');
		$post_tahun=$this->input->post('tahun');
		$post_letak_rak=$this->input->post('letak_rak');
		$post_bahasa=$this->input->post('bahasa');
		$post_halaman=$this->input->post('halaman');
		$post_detail=$this->input->post('detail');
		$post_klasifikasi=$this->input->post('klasifikasi');
		$post_status=$this->input->post('status');
		
		$sql = "update tbl_inventory set
		barcode_inventory=".$this->db->escape($post_barcode).",
		id_category_inventory=".$this->db->escape($post_category_inventory).",
		judul_inventory=".$this->db->escape($post_judul).",
		ISBN=".$this->db->escape($post_isbn).",
		id_pengarang=".$this->db->escape($post_pengarang).",
		id_penerbit=".$this->db->escape($post_penerbit).",
		id_kota=".$this->db->escape($post_kota).",
		tahun=".$this->db->escape($post_tahun).",
		id_letak_rak=".$this->db->escape($post_letak_rak).",
		id_bahasa=".$this->db->escape($post_bahasa).",
		jumlah_halaman_inventory=".$this->db->escape($post_halaman).",
		detail_inventory=".$this->db->escape($post_detail).",
		klasifikasi1_inventory=".$this->db->escape($post_klasifikasi).",
		status_inventory=".$this->db->escape($post_status)."
		where
		id_inventory=".$this->db->escape($post_id_inventory)."
		";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
		public function inventory_edit_proses2($file_name){
		
		$post_id_inventory=$this->input->post('id_inventory');
		$post_barcode=$this->input->post('barcode');
		$post_category_inventory=$this->input->post('category_inventory');
		$post_judul=$this->input->post('judul');
		$post_isbn=$this->input->post('isbn');
		$post_pengarang=$this->input->post('pengarang');
		$post_penerbit=$this->input->post('penerbit');
		$post_kota=$this->input->post('kota');
		$post_tahun=$this->input->post('tahun');
		$post_letak_rak=$this->input->post('letak_rak');
		$post_bahasa=$this->input->post('bahasa');
		$post_halaman=$this->input->post('halaman');
		$post_detail=$this->input->post('detail');
		$post_klasifikasi=$this->input->post('klasifikasi');
		$post_status=$this->input->post('status');
		
		$sql = "update tbl_inventory set
		barcode_inventory=".$this->db->escape($post_barcode).",
		id_category_inventory=".$this->db->escape($post_category_inventory).",
		judul_inventory=".$this->db->escape($post_judul).",
		ISBN=".$this->db->escape($post_isbn).",
		id_pengarang=".$this->db->escape($post_pengarang).",
		id_penerbit=".$this->db->escape($post_penerbit).",
		id_kota=".$this->db->escape($post_kota).",
		tahun=".$this->db->escape($post_tahun).",
		id_letak_rak=".$this->db->escape($post_letak_rak).",
		id_bahasa=".$this->db->escape($post_bahasa).",
		jumlah_halaman_inventory=".$this->db->escape($post_halaman).",
		detail_inventory=".$this->db->escape($post_detail).",
		klasifikasi1_inventory=".$this->db->escape($post_klasifikasi).",
		image_inventory=".$this->db->escape($file_name).",
		status_inventory=".$this->db->escape($post_status)."
		where
		id_inventory=".$this->db->escape($post_id_inventory)."
		";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	
	
	public function inventory_edit_prosesphoto($post_id_inventory,$post_id,$post_barcode,$post_nama,$post_tempat_lahir,$post_tanggal_lahir,$post_jk,$post_status,$post_exp,$post_category_inventory,$file_name){
	
		$sql = "update tbl_inventory 
		set
		no_identitas_inventory=".$this->db->escape($post_id).",
		barcode_inventory=".$this->db->escape($post_barcode).",
		nama_inventory=".$this->db->escape($post_nama).",
		tempat_lahir_inventory=".$this->db->escape($post_tempat_lahir).",
		tanggal_lahir_inventory=".$this->db->escape($post_tanggal_lahir).",
		jenis_kelamin_inventory=".$this->db->escape($post_jk).",
		id_category_inventory=".$this->db->escape($post_category_inventory).",
		exp_card_inventory=".$this->db->escape($post_exp).",
		photo_inventory=".$this->db->escape($file_name).",
		status_inventory=".$this->db->escape($post_status)."
		where id_inventory=".$this->db->escape($post_id_inventory)."
		";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	function cekid_inventory($id){
		$sql = "select * from tbl_inventory where no_identitas_inventory= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function cekid_inventory2($id,$id2){
		$sql = "select * from tbl_inventory where no_identitas_inventory= ".$this->db->escape($id)." and no_identitas_inventory<> ".$this->db->escape($id2)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	public function inventory_get2($barcode,$barcode_member){
			
		$sql = "select * from admin ,tbl_peminjaman,tbl_inventory,tbl_member 
			where

			(tbl_peminjaman.id_admin=admin.id_admin and 
			tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and 
			tbl_peminjaman.id_member=tbl_member.id_member)
			and tbl_inventory.barcode_inventory=".$this->db->escape($barcode)."
			and tbl_member.barcode_member=".$this->db->escape($barcode_member)."
			group by tbl_peminjaman.id_peminjaman
		 ";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	public function inventory_get($barcode){
			
		$sql = "select * from tbl_inventory,tbl_category_inventory,tbl_pengarang,tbl_penerbit,tbl_bahasa,tbl_kota,tbl_klasifikasi,tbl_letak_rak
		where 
		tbl_inventory.id_category_inventory=tbl_category_inventory.id_category_inventory and
		tbl_inventory.id_bahasa=tbl_bahasa.id_bahasa and
		tbl_inventory.id_pengarang=tbl_pengarang.id_pengarang and
		tbl_inventory.id_penerbit=tbl_penerbit.id_penerbit and
		tbl_inventory.id_kota=tbl_kota.id_kota and 
		tbl_inventory.klasifikasi1_inventory=tbl_klasifikasi.id_klasifikasi and
		tbl_inventory.id_letak_rak=tbl_letak_rak.id_letak_rak and
		tbl_inventory.status_inventory='1' and tbl_inventory.barcode_inventory=".$this->db->escape($barcode)."
		group by tbl_inventory.id_inventory
		 ";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	public function inventory_cekbarcode($barcode){
			
		$sql = "select * from tbl_inventory
		where 
		tbl_inventory.barcode_inventory=".$this->db->escape($barcode)."
		
		 ";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	public function inventory_cekbarcodeedit($barcode0,$barcode){
			
		$sql = "select * from tbl_inventory
		where 
		tbl_inventory.barcode_inventory=".$this->db->escape($barcode)."
		and
		
		tbl_inventory.barcode_inventory <>".$this->db->escape($barcode0)."
		 ";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	//laporan
	public function laporan_list_inventory($limit,$start,$cari_inv){
			$cari_inv 			= $this->session->userdata('lap_search_inv');
		return $this->db->query("select * from tbl_inventory,tbl_category_inventory,tbl_pengarang,tbl_penerbit,tbl_bahasa,tbl_kota,tbl_klasifikasi,tbl_letak_rak
		where 
		tbl_inventory.id_category_inventory=tbl_category_inventory.id_category_inventory and
		tbl_inventory.id_bahasa=tbl_bahasa.id_bahasa and
		tbl_inventory.id_pengarang=tbl_pengarang.id_pengarang and
		tbl_inventory.id_penerbit=tbl_penerbit.id_penerbit and
		tbl_inventory.id_kota=tbl_kota.id_kota and 
		tbl_inventory.klasifikasi1_inventory=tbl_klasifikasi.id_klasifikasi and
		tbl_inventory.id_letak_rak=tbl_letak_rak.id_letak_rak and
		status_inventory='1' and (
		tbl_letak_rak.nama_letak_rak like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_pengarang.nama_pengarang like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_penerbit.nama_penerbit like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_kota.nama_kota like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.tahun like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.ISBN like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_category_inventory.nama_category_inventory like'%".mysql_real_escape_string($cari_inv)."%' ) order by id_inventory desc limit $start, $limit")->result();
	}
	public function laporan_jumlah_list_inventory(){
	$cari_inv 			= $this->session->userdata('lap_search_inv');
		return $this->db->query("select * from tbl_inventory,tbl_category_inventory,tbl_pengarang,tbl_penerbit,tbl_bahasa,tbl_kota,tbl_klasifikasi,tbl_letak_rak
		where 
		tbl_inventory.id_category_inventory=tbl_category_inventory.id_category_inventory and
		tbl_inventory.id_bahasa=tbl_bahasa.id_bahasa and
		tbl_inventory.id_pengarang=tbl_pengarang.id_pengarang and
		tbl_inventory.id_penerbit=tbl_penerbit.id_penerbit and
		tbl_inventory.id_kota=tbl_kota.id_kota and 
		tbl_inventory.klasifikasi1_inventory=tbl_klasifikasi.id_klasifikasi and
		tbl_inventory.id_letak_rak=tbl_letak_rak.id_letak_rak and
		status_inventory='1' and (
		tbl_letak_rak.nama_letak_rak like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_pengarang.nama_pengarang like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_penerbit.nama_penerbit like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_kota.nama_kota like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.tahun like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.ISBN like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_category_inventory.nama_category_inventory like'%".mysql_real_escape_string($cari_inv)."%' ) order by id_inventory desc ")->num_rows();
	}
	
	public function laporanlist_inventoryprint(){
			$cari_inv 			= $this->session->userdata('lap_search_inv');
		return $this->db->query("select * from tbl_inventory,tbl_category_inventory,tbl_pengarang,tbl_penerbit,tbl_bahasa,tbl_kota,tbl_klasifikasi,tbl_letak_rak
		where 
		tbl_inventory.id_category_inventory=tbl_category_inventory.id_category_inventory and
		tbl_inventory.id_bahasa=tbl_bahasa.id_bahasa and
		tbl_inventory.id_pengarang=tbl_pengarang.id_pengarang and
		tbl_inventory.id_penerbit=tbl_penerbit.id_penerbit and
		tbl_inventory.id_kota=tbl_kota.id_kota and 
		tbl_inventory.klasifikasi1_inventory=tbl_klasifikasi.id_klasifikasi and
		tbl_inventory.id_letak_rak=tbl_letak_rak.id_letak_rak and
		status_inventory='1' and (
		tbl_letak_rak.nama_letak_rak like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_pengarang.nama_pengarang like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_penerbit.nama_penerbit like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_kota.nama_kota like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.tahun like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.ISBN like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($cari_inv)."%' or
		tbl_category_inventory.nama_category_inventory like'%".mysql_real_escape_string($cari_inv)."%' ) 
		order by id_inventory desc ")->result();
	}
}
?>