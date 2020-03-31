<?php
class M_kunjungan extends CI_Model{

	public function list_kunjungan($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		
		(tbl_member.id_member=tbl_kunjungan.id_member and tgl_kunjungan=".$this->db->escape($today)." ) 
		and (
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($this->session->userdata('search_kunjungan'))."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($this->session->userdata('search_kunjungan'))."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($this->session->userdata('search_kunjungan'))."%'  ) 
		
		order by id_kunjungan desc limit $start, $limit")->result();
	}
	
	public function jumlah_list_kunjungan(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		(tbl_member.id_member=tbl_kunjungan.id_member and tgl_kunjungan=".$this->db->escape($today)." ) 
		and (
		tbl_member.no_identitas_member like'%".mysql_real_escape_string($this->session->userdata('search_kunjungan'))."%' or
		tbl_member.barcode_member like'%".mysql_real_escape_string($this->session->userdata('search_kunjungan'))."%' or
		tbl_member.nama_member like'%".mysql_real_escape_string($this->session->userdata('search_kunjungan'))."%'  ) 
		
		order by id_kunjungan asc ")->num_rows();
	}
	
	public function list_kunjungannow(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		tbl_member.id_member=tbl_kunjungan.id_member and tgl_kunjungan=".$this->db->escape($today)."
		order by tbl_kunjungan.id_kunjungan desc  limit 0, 10")->result();
	}

	
	function kunjungan_cek($barcode){
		$sql = "select * from tbl_member where barcode_member= ".$this->db->escape($barcode)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function kunjungan_cekabsensi($id){
			$today=date('Y-m-d');
		$sql = "select * from tbl_kunjungan where id_member= ".$this->db->escape($id)." and tgl_kunjungan=".$this->db->escape($today)." ";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function kunjungan_add($id_member){
	
		$sql = "insert into tbl_kunjungan (id_member,tgl_kunjungan) values(".$this->db->escape($id_member).",now())";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	
	//laporan
	
	public function list_kunjungan_hari_ini_print(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		tbl_member.id_member=tbl_kunjungan.id_member and tgl_kunjungan=".$this->db->escape($today)."
		order by tbl_kunjungan.id_kunjungan");
	}
	public function list_kunjungan_hari_ini_printtotal(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		tbl_member.id_member=tbl_kunjungan.id_member and tgl_kunjungan=".$this->db->escape($today)."
		order by tbl_kunjungan.id_kunjungan")->num_rows();
	}
	//tanggal
	public function list_kunjungan_tanggal($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		
		(tbl_member.id_member=tbl_kunjungan.id_member and tgl_kunjungan=".$this->db->escape($this->session->userdata('search_kunjungan_tanggal'))." ) 
		order by tbl_kunjungan.id_kunjungan desc limit $start, $limit")->result();
	}
	public function jumlah_list_kunjungan_tanggal(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
			(tbl_member.id_member=tbl_kunjungan.id_member and tgl_kunjungan=".$this->db->escape($this->session->userdata('search_kunjungan_tanggal'))." ) 
		order by tbl_kunjungan.id_kunjungan desc ")->num_rows();
	}
	public function list_kunjungan_tanggal_print(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		tbl_member.id_member=tbl_kunjungan.id_member and tgl_kunjungan=".$this->db->escape($this->session->userdata('search_kunjungan_tanggal'))."
		order by tbl_kunjungan.id_kunjungan desc");
	}
	public function list_kunjungan_tanggal_printtotal(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		tbl_member.id_member=tbl_kunjungan.id_member and tgl_kunjungan=".$this->db->escape($this->session->userdata('search_kunjungan_tanggal'))."
		order by tbl_kunjungan.id_kunjungan desc")->num_rows();
	}
	//edn tanggal
	
	//bulan
	public function list_kunjungan_bulan($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		
		(tbl_member.id_member=tbl_kunjungan.id_member and
		month(tgl_kunjungan)=".$this->db->escape($this->session->userdata('search_kunjungan_bulan'))."   and
		year(tgl_kunjungan)=".$this->db->escape($this->session->userdata('search_kunjungan_tahun'))." ) 
		order by tbl_kunjungan.id_kunjungan desc limit $start, $limit")->result();
	}
	public function jumlah_list_kunjungan_bulan(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		(tbl_member.id_member=tbl_kunjungan.id_member and
		month(tgl_kunjungan)=".$this->db->escape($this->session->userdata('search_kunjungan_bulan'))."   and
		year(tgl_kunjungan)=".$this->db->escape($this->session->userdata('search_kunjungan_tahun'))." ) 
		order by tbl_kunjungan.id_kunjungan desc ")->num_rows();
	}
	public function list_kunjungan_bulan_print(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		(tbl_member.id_member=tbl_kunjungan.id_member and
		month(tgl_kunjungan)=".$this->db->escape($this->session->userdata('search_kunjungan_bulan'))."   and
		year(tgl_kunjungan)=".$this->db->escape($this->session->userdata('search_kunjungan_tahun'))." ) 
		order by tbl_kunjungan.id_kunjungan desc");
	}
	public function list_kunjungan_bulan_printtotal(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		(tbl_member.id_member=tbl_kunjungan.id_member and
		month(tgl_kunjungan)=".$this->db->escape($this->session->userdata('search_kunjungan_bulan'))."   and
		year(tgl_kunjungan)=".$this->db->escape($this->session->userdata('search_kunjungan_tahun'))." ) 
		order by tbl_kunjungan.id_kunjungan desc")->num_rows();
	}
	//edn bulan
	
		//tahun
	public function list_kunjungan_tahun($limit,$start){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		
		(tbl_member.id_member=tbl_kunjungan.id_member and year(tgl_kunjungan)=".$this->db->escape($this->session->userdata('search_kunjungan_tahun'))." ) 
		order by tbl_kunjungan.id_kunjungan desc limit $start, $limit")->result();
	}
	public function jumlah_list_kunjungan_tahun(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
			(tbl_member.id_member=tbl_kunjungan.id_member and year(tgl_kunjungan)=".$this->db->escape($this->session->userdata('search_kunjungan_tahun'))." ) 
		order by tbl_kunjungan.id_kunjungan desc ")->num_rows();
	}
	public function list_kunjungan_tahun_print(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		tbl_member.id_member=tbl_kunjungan.id_member and year(tgl_kunjungan)=".$this->db->escape($this->session->userdata('search_kunjungan_tahun'))."
		order by tbl_kunjungan.id_kunjungan desc");
	}
	public function list_kunjungan_tahun_printtotal(){
			$today=date('Y-m-d');
		return $this->db->query("select tgl_kunjungan,barcode_member,tbl_kunjungan.id_member,nama_member,no_identitas_member 
		from tbl_kunjungan,tbl_member where 
		tbl_member.id_member=tbl_kunjungan.id_member and year(tgl_kunjungan)=".$this->db->escape($this->session->userdata('search_kunjungan_tahun'))."
		order by tbl_kunjungan.id_kunjungan desc")->num_rows();
	}
	//edn tahun
	
}
?>