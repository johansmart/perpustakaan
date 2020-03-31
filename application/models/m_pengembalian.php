<?php
class M_pengembalian extends CI_Model{
	//select menu pengembalian 
	public function list_pengembalianhariini($limit,$start,$cari_pengembalian){
			$cari_pengembalian 			= $this->session->userdata('search_inv');
			$today=date('Y-m-d');
		return $this->db->query("select * from admin ,tbl_pengembalian,tbl_inventory,tbl_member where

			(tbl_pengembalian.id_admin=admin.id_admin and 
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and 
			tbl_pengembalian.id_member=tbl_member.id_member	
			and tbl_pengembalian.tgl_pengembalian = ".$this->db->escape($today).")
			and
			(
			tbl_pengembalian.tgl_tempo like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.id_inventory  like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.id_member like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_inventory.barcode_inventory  like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_member.barcode_member  like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.id_admin like'%".mysql_real_escape_string($cari_pengembalian)."%' )
			group by tbl_pengembalian.id_pengembalian
			order by tbl_pengembalian.id_pengembalian desc limit $start, $limit")->result();
	}
	public function jumlah_list_pengembalianhariini(){
		$cari_pengembalian 			= $this->session->userdata('search_inv');
		$today=date('Y-m-d');
		return $this->db->query("select * from admin ,tbl_pengembalian,tbl_inventory,tbl_member where

			(tbl_pengembalian.id_admin=admin.id_admin and 
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and 
			tbl_pengembalian.id_member=tbl_member.id_member
			and tbl_pengembalian.tgl_pengembalian = ".$this->db->escape($today).")
			and
			(
			tbl_pengembalian.tgl_tempo like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.id_inventory  like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.id_member like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_inventory.barcode_inventory  like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_member.barcode_member  like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.id_admin like'%".mysql_real_escape_string($cari_pengembalian)."%' )
			group by tbl_pengembalian.id_pengembalian
			order by tbl_pengembalian.id_pengembalian desc
			")->num_rows();
	}
	public function pengembalian_printdendahariini(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		
		from admin ,tbl_pengembalian,tbl_inventory,tbl_member 
			where

			(tbl_pengembalian.id_admin=admin.id_admin and 
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and 
			tbl_pengembalian.id_member=tbl_member.id_member
			and tbl_pengembalian.tgl_pengembalian = ".$this->db->escape($today)."
			)
			 ")->result();
	}
	//end
	public function list_pengembalianadd($id_transaksi){
			
		return $this->db->query("select tgl_tempo,tbl_pengembalian.id_inventory,tbl_pengembalian.id_member,id_pengembalian,nama_lengkap_admin,barcode_member,barcode_inventory,selisih,jumlah_denda_telat,denda_lainnya,ket_denda_lainnya,
		sum(jumlah_denda_telat) as total_telat, sum(denda_lainnya) as total_denda_lain, sum(jumlah_denda_telat+denda_lainnya) as total
		
		from admin ,tbl_pengembalian,tbl_inventory,tbl_member 
			where


			(tbl_pengembalian.id_admin=admin.id_admin and 
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and 
			tbl_pengembalian.id_member=tbl_member.id_member)
			and
			tbl_pengembalian.id_transaksi_pengembalian='".mysql_real_escape_string($id_transaksi)."'
			group by tbl_pengembalian.id_pengembalian
			order by tbl_pengembalian.id_pengembalian desc ")->result();
	}
	public function pengembalian_print($id_transaksi){
			
		return $this->db->query("select nama_lengkap_admin,tbl_pengembalian.id_member, tbl_pengembalian.id_transaksi_pengembalian, tbl_pengembalian.id_inventory, tbl_pengembalian.tgl_pengembalian,tbl_pengembalian.tgl_tempo, barcode_member,barcode_inventory,selisih,jumlah_denda_telat,denda_lainnya,ket_denda_lainnya,
		sum(jumlah_denda_telat) as total_telat, sum(denda_lainnya) as total_denda_lain, sum(jumlah_denda_telat+denda_lainnya) as total
		
		from admin ,tbl_pengembalian,tbl_inventory,tbl_member 
			where

			(tbl_pengembalian.id_admin=admin.id_admin and 
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and 
			tbl_pengembalian.id_member=tbl_member.id_member)
			and
			tbl_pengembalian.id_transaksi_pengembalian='".mysql_real_escape_string($id_transaksi)."'
			group by tbl_pengembalian.id_pengembalian
			order by tbl_pengembalian.id_pengembalian desc ")->result();
	}
	public function pengembalian_printtotal($id_transaksi){
			
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		
		from admin ,tbl_pengembalian,tbl_inventory,tbl_member 
			where

			(tbl_pengembalian.id_admin=admin.id_admin and 
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and 
			tbl_pengembalian.id_member=tbl_member.id_member)
			and
			tbl_pengembalian.id_transaksi_pengembalian='".mysql_real_escape_string($id_transaksi)."' ")->result();
	}
	
	public function pengembalian_printdenda(){
			
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		
		from admin ,tbl_pengembalian,tbl_inventory,tbl_member 
			where

			(tbl_pengembalian.id_admin=admin.id_admin and 
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and 
			tbl_pengembalian.id_member=tbl_member.id_member)
			 ")->result();
	}
	public function list_pengembalian($limit,$start,$cari_pengembalian){
			$cari_pengembalian 			= $this->session->userdata('search_inv');
		return $this->db->query("select * from admin ,tbl_pengembalian,tbl_inventory,tbl_member where

			(tbl_pengembalian.id_admin=admin.id_admin and 
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and 
			tbl_pengembalian.id_member=tbl_member.id_member)
			and
			(tbl_pengembalian.tgl_pengembalian like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.tgl_tempo like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.id_inventory  like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.id_member like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.id_admin like'%".mysql_real_escape_string($cari_pengembalian)."%' )
			group by tbl_pengembalian.id_pengembalian
			order by tbl_pengembalian.id_pengembalian desc limit $start, $limit")->result();
	}
	public function jumlah_list_pengembalian(){
	$cari_pengembalian 			= $this->session->userdata('search_inv');
		return $this->db->query("select * from admin ,tbl_pengembalian,tbl_inventory,tbl_member where

			(tbl_pengembalian.id_admin=admin.id_admin and 
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and 
			tbl_pengembalian.id_member=tbl_member.id_member)
			and
			(tbl_pengembalian.tgl_pengembalian like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.tgl_tempo like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.id_inventory  like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.id_member like'%".mysql_real_escape_string($cari_pengembalian)."%'  or
			tbl_pengembalian.id_admin like'%".mysql_real_escape_string($cari_pengembalian)."%' )
			group by tbl_pengembalian.id_pengembalian
			order by tbl_pengembalian.id_pengembalian desc
			")->num_rows();
	}
	
	public function pengembalian_add($id_member,$id_admin,$id_inventory,$post_tgl_tempo,$post_tgl,$post_selisih,$post_denda_hari,$post_jumlah_denda_telat,$post_denda_lain,$post_ket_denda,$post_jumlah_denda_lain,$post_id_transaksi){
		
		$sql = "insert into tbl_pengembalian
		(id_transaksi_pengembalian,
		id_member,
		id_admin,
		id_inventory,
		tgl_tempo,
		tgl_pengembalian,
		selisih,
		denda_hari,
		jumlah_denda_telat,
		id_jenis_denda_lainnya,
		ket_denda_lainnya,
		denda_lainnya,
		status_pengembalian,
		status_trash
		) values
		(".$this->db->escape($post_id_transaksi).",
		".$this->db->escape($id_member).",
		".$this->db->escape($id_admin).",
		".$this->db->escape($id_inventory).",
		".$this->db->escape($post_tgl_tempo).",
		".$this->db->escape($post_tgl).",
		".$this->db->escape($post_selisih).",
		".$this->db->escape($post_denda_hari).",
		".$this->db->escape($post_jumlah_denda_telat).",
		".$this->db->escape($post_denda_lain).",
		".$this->db->escape($post_ket_denda).",
		".$this->db->escape($post_jumlah_denda_lain).",
		1,
		0
		)";
		$qsql = $this->db->query($sql);
		return $qsql;
		
	}
	function pengembalian_delete($id){
		$sql = "delete from tbl_pengembalian where id_pengembalian= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function pengembalian_batal($id_member,$id_inventory,$tgl){
		$sql = "update tbl_peminjaman set status_peminjaman='1'
		where id_member= ".$this->db->escape($id_member)." and id_inventory =".$this->db->escape($id_inventory)."
		and tgl_tempo_peminjaman=".$this->db->escape($tgl)." ";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	function pengembalian_cek($id_member,$id_inventory,$post_id_transaksi_pinjam){
		$sql = "select * from tbl_peminjaman
		where id_member= ".$this->db->escape($id_member)." and id_inventory =".$this->db->escape($id_inventory)."
		and id_transaksi_peminjaman=".$this->db->escape($post_id_transaksi_pinjam)." and status_peminjaman='0'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function peminjaman_edit($id_member,$id_inventory,$post_id_transaksi_pinjam){
		$sql = "update tbl_peminjaman set status_peminjaman='0'
		where id_member= ".$this->db->escape($id_member)." and id_inventory =".$this->db->escape($id_inventory)."
		and id_transaksi_peminjaman=".$this->db->escape($post_id_transaksi_pinjam)." ";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	function pengembalian_cekmax($id_member,$post_tgl){
		$sql = "select * from tbl_pengembalian
		where id_member= ".$this->db->escape($id_member)." and tgl_pengembalian=".$this->db->escape($post_tgl)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	//denda
	//denda hari ini
	public function list_denda($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($today)." )
		and 
		(tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0)
		) 
		and 
		(
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%'  or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		admin.nama_lengkap_admin like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		admin.username_admin like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' 
		) 
		
		order by tbl_pengembalian.id_pengembalian desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_denda(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($today)." )
		and 
		(tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0)
		) 
		and 
		(
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%'  or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		admin.nama_lengkap_admin like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		admin.username_admin like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' 
		) 
		
		order by tbl_pengembalian.id_pengembalian desc		")->num_rows();
	}
	public function jumlah_list_dendatotal(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($today)." )
		and 
		(tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0)
		) 
		and 
		(
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%'  or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		admin.nama_lengkap_admin like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' or
		admin.username_admin like'%".mysql_real_escape_string($this->session->userdata('search_denda'))."%' 
		) 
		
		order by tbl_pengembalian.id_pengembalian desc		")->row()->total_semua;
	}
	public function list_denda_hari_ini_print(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($today)." )
		and 
		(tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0)
		) 
		order by tbl_pengembalian.id_pengembalian desc
		");
	}
	
	//denda hari ini
	
	//tanggal
	public function list_denda_tanggal($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($this->session->userdata('search_denda_tanggal'))." )
		and 
		(tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0)
		) 
		
		order by tbl_pengembalian.id_pengembalian desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_denda_tanggal(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($this->session->userdata('search_denda_tanggal'))." )
		and 
		(tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0)
		) 
		
		order by tbl_pengembalian.id_pengembalian desc		")->num_rows();
	}
	public function jumlah_list_dendatotal_tanggal(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($this->session->userdata('search_denda_tanggal'))." )
		and 
		(tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0)
		) 
		
		order by tbl_pengembalian.id_pengembalian desc		")->row()->total_semua;
	}
	public function list_denda_tanggal_print(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($this->session->userdata('search_denda_tanggal'))." )
		and 
		(tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0)
		) 
		order by tbl_pengembalian.id_pengembalian desc
		");
	}
	
	//end tanggal
	
	//bulan
		public function list_denda_bulan($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
			(
			tbl_pengembalian.id_member=tbl_member.id_member and
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
			tbl_pengembalian.id_admin=admin.id_admin and 
			month(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_denda_bulan'))."   and
			year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_denda_tahun'))." 
			)
		and 
			(
			tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0
			)
		) 
		
		order by tbl_pengembalian.id_pengembalian desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_denda_bulan(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
			(
			tbl_pengembalian.id_member=tbl_member.id_member and
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
			tbl_pengembalian.id_admin=admin.id_admin and 
			month(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_denda_bulan'))."   and
			year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_denda_tahun'))." 
			)
		and 
			(
			tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0
			)
		) 
		
		order by tbl_pengembalian.id_pengembalian desc		")->num_rows();
	}
	public function jumlah_list_dendatotal_bulan(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
			(
			tbl_pengembalian.id_member=tbl_member.id_member and
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
			tbl_pengembalian.id_admin=admin.id_admin and 
			month(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_denda_bulan'))."   and
			year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_denda_tahun'))." 
			)
		and 
			(
			tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0
			)
		) 
		
		order by tbl_pengembalian.id_pengembalian desc		")->row()->total_semua;
	}
	public function list_denda_bulan_print(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
			(tbl_pengembalian.id_member=tbl_member.id_member and
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
			tbl_pengembalian.id_admin=admin.id_admin and 
			month(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_denda_bulan'))."   and
			year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_denda_tahun'))." 
			) 
		and 
			(
			tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0
			)
		) 
		order by tbl_pengembalian.id_pengembalian desc
		");
	}
	
	//end bulan
	
	//tahun
	public function list_denda_tahun($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_denda_tahun'))." )
		and 
		(tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0)
		) 
		
		order by tbl_pengembalian.id_pengembalian desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_denda_tahun(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_denda_tahun'))." )
		and 
		(tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0)
		) 
		
		order by tbl_pengembalian.id_pengembalian desc		")->num_rows();
	}
	public function jumlah_list_dendatotal_tahun(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_denda_tahun'))." )
		and 
		(tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0)
		) 
		
		order by tbl_pengembalian.id_pengembalian desc		")->row()->total_semua;
	}
	public function list_denda_tahun_print(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_denda_tahun'))." )
		and 
		(tbl_pengembalian.denda_lainnya<>0 or tbl_pengembalian.jumlah_denda_telat<>0)
		) 
		order by tbl_pengembalian.id_pengembalian desc
		");
	}
	
	//end tahun
	//end denda
	
	
	//laporan pengembalian
	//pengembalian
	//pengembalian hari ini
	public function list_pengembalian_hariini($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($today)." )
		
		and 
		(
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%'  or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		admin.nama_lengkap_admin like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		admin.username_admin like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' 
		) 
		
		order by tbl_pengembalian.id_pengembalian desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_pengembalian_hariini(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($today)." )
		
		and 
		(
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%'  or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		admin.nama_lengkap_admin like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		admin.username_admin like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' 
		) 
		
		order by tbl_pengembalian.id_pengembalian desc		")->num_rows();
	}
	public function jumlah_list_pengembaliantotal(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(tbl_pengembalian.jumlah_denda_telat+tbl_pengembalian.denda_lainnya) as total_semua
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($today)." )
		
		and 
		(
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%'  or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		admin.nama_lengkap_admin like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' or
		admin.username_admin like'%".mysql_real_escape_string($this->session->userdata('search_pengembalian'))."%' 
		) 
		
		order by tbl_pengembalian.id_pengembalian desc		")->row()->total_semua;
	}
	public function jumlah_list_pengembaliantotalprint(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(tbl_pengembalian.jumlah_denda_telat+tbl_pengembalian.denda_lainnya) as total_semua
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($today)." )
		
		
		
		order by tbl_pengembalian.id_pengembalian desc		")->row()->total_semua;
	}
	public function list_pengembalian_hari_ini_print(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($today)." )
		
		order by tbl_pengembalian.id_pengembalian desc
		");
	}
	
	//pengembalian hari ini
	
	//tanggal
	public function list_pengembalian_tanggal($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($this->session->userdata('search_pengembalian_tanggal'))." )
		
		
		order by tbl_pengembalian.id_pengembalian desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_pengembalian_tanggal(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($this->session->userdata('search_pengembalian_tanggal'))." )
		
		
		order by tbl_pengembalian.id_pengembalian desc		")->num_rows();
	}
	public function jumlah_list_pengembaliantotal_tanggal(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($this->session->userdata('search_pengembalian_tanggal'))." )
		
		
		order by tbl_pengembalian.id_pengembalian desc		")->row()->total_semua;
	}
	public function list_pengembalian_tanggal_print(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		tbl_pengembalian.tgl_pengembalian=".$this->db->escape($this->session->userdata('search_pengembalian_tanggal'))." )
		
		order by tbl_pengembalian.id_pengembalian desc
		");
	}
	
	//end tanggal
	
	//bulan
		public function list_pengembalian_bulan($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
			(
			tbl_pengembalian.id_member=tbl_member.id_member and
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
			tbl_pengembalian.id_admin=admin.id_admin and 
			month(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_pengembalian_bulan'))."   and
			year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_pengembalian_tahun'))." 
			)
		
		) 
		
		order by tbl_pengembalian.id_pengembalian desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_pengembalian_bulan(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
			(
			tbl_pengembalian.id_member=tbl_member.id_member and
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
			tbl_pengembalian.id_admin=admin.id_admin and 
			month(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_pengembalian_bulan'))."   and
			year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_pengembalian_tahun'))." 
			)
	
		) 
		
		order by tbl_pengembalian.id_pengembalian desc		")->num_rows();
	}
	public function jumlah_list_pengembaliantotal_bulan(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
			(
			tbl_pengembalian.id_member=tbl_member.id_member and
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
			tbl_pengembalian.id_admin=admin.id_admin and 
			month(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_pengembalian_bulan'))."   and
			year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_pengembalian_tahun'))." 
			)
		
		) 
		
		order by tbl_pengembalian.id_pengembalian desc		")->row()->total_semua;
	}
	public function list_pengembalian_bulan_print(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		(
			(tbl_pengembalian.id_member=tbl_member.id_member and
			tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
			tbl_pengembalian.id_admin=admin.id_admin and 
			month(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_pengembalian_bulan'))."   and
			year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_pengembalian_tahun'))." 
			) 
		
		
		) 
		order by tbl_pengembalian.id_pengembalian desc
		");
	}
	
	//end bulan
	
	//tahun
	public function list_pengembalian_tahun($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_pengembalian_tahun'))." )
		
		
		order by tbl_pengembalian.id_pengembalian desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_pengembalian_tahun(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_pengembalian_tahun'))." )
		
		
		order by tbl_pengembalian.id_pengembalian desc		")->num_rows();
	}
	public function jumlah_list_pengembaliantotal_tahun(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_pengembalian_tahun'))." )
		
		
		order by tbl_pengembalian.id_pengembalian desc		")->row()->total_semua;
	}
	public function list_pengembalian_tahun_print(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_pengembalian,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_pengembalian.id_member=tbl_member.id_member and
		tbl_pengembalian.id_inventory=tbl_inventory.id_inventory and
		tbl_pengembalian.id_admin=admin.id_admin and 
		year(tbl_pengembalian.tgl_pengembalian)=".$this->db->escape($this->session->userdata('search_pengembalian_tahun'))." )
		
		order by tbl_pengembalian.id_pengembalian desc
		");
	}
	
	//end tahun
	//end pengembalian
	//end laporan pengembalian
	
}
?>