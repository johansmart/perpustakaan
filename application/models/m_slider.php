<?php
class M_slider extends CI_Model{

	public function list_slider(){
		
		return $this->db->query("select * from slider where status_slider='publish' order by id_slider desc")->result();
	}
	
	
	public function jumlah_slider (){
		return $this->db->query("select * from slider  where status_slider='publish'  order by id_slider  desc ")->num_rows();
	}
	
	
	public function slider($limit,$start,$cari_art){
			$cari_art 			= $this->session->userdata('search');
		return $this->db->query("select * from slider
		where 
		slider.nama_slider like'%".mysql_real_escape_string($cari_art)."%' 
		
		 order by id_slider desc limit $start, $limit")->result();
	}
	public function jumlahslider(){
	$cari_art 			= $this->session->userdata('search');
		return $this->db->query("select * from slider
		where 
		slider.nama_slider like'%".mysql_real_escape_string($cari_art)."%' 
		 order by id_slider desc ")->num_rows();
	}
	
	function slider_add($post_nama,$post_keterangan,$post_status,$file_name){
				
		$sql = "insert into slider
		(nama_slider,ket_slider,image_slider,status_slider) values 
		(".$this->db->escape($post_nama).",
		".$this->db->escape($post_keterangan).",
		".$this->db->escape($file_name).",
		".$this->db->escape($post_status)."
		)";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	public function slider_edit($id){
			
		return $this->db->query("select * from slider where id_slider='".mysql_real_escape_string($id)."' ")->result();
	}
	public function slider_edit_proses($post_nama,$post_keterangan,$post_status,$file_name,$post_id){
				
		$sql = "update slider  set
		nama_slider=".$this->db->escape($post_nama).",
		ket_slider=".$this->db->escape($post_keterangan).",
		status_slider=".$this->db->escape($post_status).",
		image_slider=".$this->db->escape($file_name)."
		where id_slider=".$this->db->escape($post_id)."
		";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	public function slider_edit_prosestanpagantiimage($post_nama,$post_keterangan,$post_status,$post_id){
				
		$sql = "update slider  set
		nama_slider=".$this->db->escape($post_nama).",
		ket_slider=".$this->db->escape($post_keterangan).",
		status_slider=".$this->db->escape($post_status)."
		where id_slider=".$this->db->escape($post_id)."
		";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function slider_delete($id){
		$sql = "delete from slider where id_slider = ".$this->db->escape($id)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
}
?>