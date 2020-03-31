<?php
class M_peminjaman extends CI_Model{

	//list transaksi peminjaman
	public function list_peminjamanhariini($limit,$start,$cari_peminjaman){
		$today=date('Y-m-d');
		$cari_peminjaman 			= $this->session->userdata('search_inv');
		return $this->db->query("select * from admin ,tbl_peminjaman,tbl_inventory,tbl_member where

			(tbl_peminjaman.id_admin=admin.id_admin and 
			tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and 
			tbl_peminjaman.id_member=tbl_member.id_member 
			and tbl_peminjaman.tgl_peminjaman = ".$this->db->escape($today).")
			
			and
			(
			tbl_peminjaman.tgl_tempo_peminjaman like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.id_inventory  like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.id_member like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_inventory.barcode_inventory  like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_member.barcode_member  like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.id_admin like'%".mysql_real_escape_string($cari_peminjaman)."%' )
			
			group by tbl_peminjaman.id_peminjaman
			order by tbl_peminjaman.id_peminjaman desc limit $start, $limit")->result();
	}
	public function jumlah_list_peminjamanhariini(){
		$today=date('Y-m-d');
		$cari_peminjaman 			= $this->session->userdata('search_inv');
		return $this->db->query("select * from admin ,tbl_peminjaman,tbl_inventory,tbl_member where

			(tbl_peminjaman.id_admin=admin.id_admin and 
			tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and 
			tbl_peminjaman.id_member=tbl_member.id_member
			and tbl_peminjaman.tgl_peminjaman = ".$this->db->escape($today).")
			and
			(
			tbl_peminjaman.tgl_tempo_peminjaman like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.id_inventory  like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_inventory.barcode_inventory  like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_member.barcode_member  like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.id_member like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.id_admin like'%".mysql_real_escape_string($cari_peminjaman)."%' )
			
			group by tbl_peminjaman.id_peminjaman
			order by tbl_peminjaman.id_peminjaman desc
			")->num_rows();
	}
	//end
	
	public function list_peminjamanadd($id_transaksi){
			
		return $this->db->query("select * from admin ,tbl_peminjaman,tbl_inventory,tbl_member 
			where

			(tbl_peminjaman.id_admin=admin.id_admin and 
			tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and 
			tbl_peminjaman.id_member=tbl_member.id_member)
			and
			tbl_peminjaman.id_transaksi_peminjaman='".mysql_real_escape_string($id_transaksi)."'
			group by tbl_peminjaman.id_peminjaman
			order by tbl_peminjaman.id_peminjaman desc ")->result();
	}
	public function peminjaman_print($id_transaksi){
			
		return $this->db->query("select * from admin ,tbl_peminjaman,tbl_inventory,tbl_member 
			where

			(tbl_peminjaman.id_admin=admin.id_admin and 
			tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and 
			tbl_peminjaman.id_member=tbl_member.id_member)
			and
			tbl_peminjaman.id_transaksi_peminjaman='".mysql_real_escape_string($id_transaksi)."'
			group by tbl_peminjaman.id_peminjaman
			order by tbl_peminjaman.id_peminjaman desc ")->result();
	}
	public function list_peminjaman($limit,$start,$cari_peminjaman){
			$cari_peminjaman 			= $this->session->userdata('search_inv');
		return $this->db->query("select * from admin ,tbl_peminjaman,tbl_inventory,tbl_member where

			(tbl_peminjaman.id_admin=admin.id_admin and 
			tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and 
			tbl_peminjaman.id_member=tbl_member.id_member)
			and
			(tbl_peminjaman.tgl_peminjaman like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.tgl_tempo_peminjaman like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.id_inventory  like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.id_member like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.id_admin like'%".mysql_real_escape_string($cari_peminjaman)."%' )
			group by tbl_peminjaman.id_peminjaman
			order by tbl_peminjaman.id_peminjaman desc limit $start, $limit")->result();
	}
	public function jumlah_list_peminjaman(){
	$cari_peminjaman 			= $this->session->userdata('search_inv');
		return $this->db->query("select * from admin ,tbl_peminjaman,tbl_inventory,tbl_member where

			(tbl_peminjaman.id_admin=admin.id_admin and 
			tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and 
			tbl_peminjaman.id_member=tbl_member.id_member)
			and
			(tbl_peminjaman.tgl_peminjaman like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.tgl_tempo_peminjaman like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.id_inventory  like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.id_member like'%".mysql_real_escape_string($cari_peminjaman)."%'  or
			tbl_peminjaman.id_admin like'%".mysql_real_escape_string($cari_peminjaman)."%' )
			group by tbl_peminjaman.id_peminjaman
			order by tbl_peminjaman.id_peminjaman desc
			")->num_rows();
	}
	
	public function peminjaman_add($id_admin,$id_member,$id_inventory,$post_jumlah,$post_tgl,$post_tgl2,$post_id_transaksi){
		
		$sql = "insert into tbl_peminjaman
		(
		id_transaksi_peminjaman,
		id_member,
		id_admin,
		id_inventory,
		tgl_peminjaman,
		tgl_tempo_peminjaman,
		jumlah_pinjam,
		status_peminjaman,
		status_trash
		) values
		(".$this->db->escape($post_id_transaksi).",
		".$this->db->escape($id_member).",
		".$this->db->escape($id_admin).",
		".$this->db->escape($id_inventory).",
		".$this->db->escape($post_tgl).",
		".$this->db->escape($post_tgl2).",
		".$this->db->escape($post_jumlah).",
		1,
		0
		)";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function peminjaman_delete($id){
		$sql = "delete from tbl_peminjaman where id_peminjaman= ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	function peminjaman_cek($id_member,$id_inventory){
		$sql = "select * from tbl_peminjaman
		where id_member= ".$this->db->escape($id_member)." and id_inventory =".$this->db->escape($id_inventory)." and status_peminjaman='1'";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	function peminjaman_cekmax($id_member,$post_tgl){
		$sql = "select * from tbl_peminjaman
		where id_member= ".$this->db->escape($id_member)." and tgl_peminjaman=".$this->db->escape($post_tgl)."";
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
	
	public function inventory_get2($barcode,$barcode_member){
			
		$sql = "select * from admin ,tbl_peminjaman,tbl_inventory,tbl_member 
			where

			(tbl_peminjaman.id_admin=admin.id_admin and 
			tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and 
			tbl_peminjaman.id_member=tbl_member.id_member)
			and tbl_inventory.barcode_inventory=".$this->db->escape($barcode)."
			and tbl_member.barcode_member=".$this->db->escape($barcode_member)."
			and tbl_peminjaman.status_peminjaman=1
			group by tbl_member.id_member
		 ";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	//laporan peminjaman
	//peminjaman
	//peminjaman hari ini
	public function list_peminjaman_hariini($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		tbl_peminjaman.tgl_peminjaman=".$this->db->escape($today)." )
		
		and 
		(
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%'  or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		admin.nama_lengkap_admin like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		admin.username_admin like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' 
		) 
		
		order by tbl_peminjaman.id_peminjaman desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_peminjaman_hariini(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		tbl_peminjaman.tgl_peminjaman=".$this->db->escape($today)." )
		
		and 
		(
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%'  or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		admin.nama_lengkap_admin like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		admin.username_admin like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' 
		) 
		
		order by tbl_peminjaman.id_peminjaman desc		")->num_rows();
	}
	public function jumlah_list_peminjamantotal(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(tbl_peminjaman.jumlah_denda_telat+tbl_peminjaman.denda_lainnya) as total_semua
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		tbl_peminjaman.tgl_peminjaman=".$this->db->escape($today)." )
		
		and 
		(
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%'  or
		tbl_inventory.barcode_inventory like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		tbl_inventory.judul_inventory like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		admin.nama_lengkap_admin like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' or
		admin.username_admin like'%".mysql_real_escape_string($this->session->userdata('search_peminjaman'))."%' 
		) 
		
		order by tbl_peminjaman.id_peminjaman desc		")->row()->total_semua;
	}
	public function jumlah_list_peminjamantotalprint(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(tbl_peminjaman.jumlah_denda_telat+tbl_peminjaman.denda_lainnya) as total_semua
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		tbl_peminjaman.tgl_peminjaman=".$this->db->escape($today)." )
		
		
		
		order by tbl_peminjaman.id_peminjaman desc		")->row()->total_semua;
	}
	public function list_peminjaman_hari_ini_print(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		tbl_peminjaman.tgl_peminjaman=".$this->db->escape($today)." )
		
		order by tbl_peminjaman.id_peminjaman desc
		");
	}
	
	//peminjaman hari ini
	
	//tanggal
	public function list_peminjaman_tanggal($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		tbl_peminjaman.tgl_peminjaman=".$this->db->escape($this->session->userdata('search_peminjaman_tanggal'))." )
		
		
		order by tbl_peminjaman.id_peminjaman desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_peminjaman_tanggal(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		tbl_peminjaman.tgl_peminjaman=".$this->db->escape($this->session->userdata('search_peminjaman_tanggal'))." )
		
		
		order by tbl_peminjaman.id_peminjaman desc		")->num_rows();
	}
	public function jumlah_list_peminjamantotal_tanggal(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		tbl_peminjaman.tgl_peminjaman=".$this->db->escape($this->session->userdata('search_peminjaman_tanggal'))." )
		
		
		order by tbl_peminjaman.id_peminjaman desc		")->row()->total_semua;
	}
	public function list_peminjaman_tanggal_print(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		tbl_peminjaman.tgl_peminjaman=".$this->db->escape($this->session->userdata('search_peminjaman_tanggal'))." )
		
		order by tbl_peminjaman.id_peminjaman desc
		");
	}
	
	//end tanggal
	
	//bulan
		public function list_peminjaman_bulan($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		(
			(
			tbl_peminjaman.id_member=tbl_member.id_member and
			tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
			tbl_peminjaman.id_admin=admin.id_admin and 
			month(tbl_peminjaman.tgl_peminjaman)=".$this->db->escape($this->session->userdata('search_peminjaman_bulan'))."   and
			year(tbl_peminjaman.tgl_peminjaman)=".$this->db->escape($this->session->userdata('search_peminjaman_tahun'))." 
			)
		
		) 
		
		order by tbl_peminjaman.id_peminjaman desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_peminjaman_bulan(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		(
			(
			tbl_peminjaman.id_member=tbl_member.id_member and
			tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
			tbl_peminjaman.id_admin=admin.id_admin and 
			month(tbl_peminjaman.tgl_peminjaman)=".$this->db->escape($this->session->userdata('search_peminjaman_bulan'))."   and
			year(tbl_peminjaman.tgl_peminjaman)=".$this->db->escape($this->session->userdata('search_peminjaman_tahun'))." 
			)
	
		) 
		
		order by tbl_peminjaman.id_peminjaman desc		")->num_rows();
	}
	public function jumlah_list_peminjamantotal_bulan(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		(
			(
			tbl_peminjaman.id_member=tbl_member.id_member and
			tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
			tbl_peminjaman.id_admin=admin.id_admin and 
			month(tbl_peminjaman.tgl_peminjaman)=".$this->db->escape($this->session->userdata('search_peminjaman_bulan'))."   and
			year(tbl_peminjaman.tgl_peminjaman)=".$this->db->escape($this->session->userdata('search_peminjaman_tahun'))." 
			)
		
		) 
		
		order by tbl_peminjaman.id_peminjaman desc		")->row()->total_semua;
	}
	public function list_peminjaman_bulan_print(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		(
			(tbl_peminjaman.id_member=tbl_member.id_member and
			tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
			tbl_peminjaman.id_admin=admin.id_admin and 
			month(tbl_peminjaman.tgl_peminjaman)=".$this->db->escape($this->session->userdata('search_peminjaman_bulan'))."   and
			year(tbl_peminjaman.tgl_peminjaman)=".$this->db->escape($this->session->userdata('search_peminjaman_tahun'))." 
			) 
		
		
		) 
		order by tbl_peminjaman.id_peminjaman desc
		");
	}
	
	//end bulan
	
	//tahun
	public function list_peminjaman_tahun($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		year(tbl_peminjaman.tgl_peminjaman)=".$this->db->escape($this->session->userdata('search_peminjaman_tahun'))." )
		
		
		order by tbl_peminjaman.id_peminjaman desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_peminjaman_tahun(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		year(tbl_peminjaman.tgl_peminjaman)=".$this->db->escape($this->session->userdata('search_peminjaman_tahun'))." )
		
		
		order by tbl_peminjaman.id_peminjaman desc		")->num_rows();
	}
	public function jumlah_list_peminjamantotal_tahun(){
			$today=date('Y-m-d');
		return $this->db->query("select sum(jumlah_denda_telat+denda_lainnya) as total_semua
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		year(tbl_peminjaman.tgl_peminjaman)=".$this->db->escape($this->session->userdata('search_peminjaman_tahun'))." )
		
		
		order by tbl_peminjaman.id_peminjaman desc		")->row()->total_semua;
	}
	public function list_peminjaman_tahun_print(){
			$today=date('Y-m-d');
		return $this->db->query("select *
		from tbl_peminjaman,tbl_member,tbl_inventory,admin where 
		
		
		(tbl_peminjaman.id_member=tbl_member.id_member and
		tbl_peminjaman.id_inventory=tbl_inventory.id_inventory and
		tbl_peminjaman.id_admin=admin.id_admin and 
		year(tbl_peminjaman.tgl_peminjaman)=".$this->db->escape($this->session->userdata('search_peminjaman_tahun'))." )
		
		order by tbl_peminjaman.id_peminjaman desc
		");
	}
	
	//end tahun
	//end peminjaman
	//end laporan peminjaman
}
?>