<?php
class M_setting extends CI_Model{
	public function setting_umum(){
		
		return $this->db->query("select * from tbl_setting ")->result();
	}
	function setting_umum_proses($post_denda,$post_peminjamanhari,$post_tempopeminjaman,$post_peminjaman){
				
		$sql = "update tbl_setting set 
		denda=".$this->db->escape($post_denda).",
		max_peminjaman_perhari=".$this->db->escape($post_peminjamanhari).",
		max_tempo_peminjaman=".$this->db->escape($post_tempopeminjaman).",
		max_peminjaman=".$this->db->escape($post_peminjaman)."
		where id_setting=1";
		$qsql = $this->db->query($sql);
		return $qsql;
	}

	public function readLibrary()
	{
		return $this->db->get('r_config')->result_array();
	}

	public function inputLibraryInfo($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('r_config', $data); 
		return $this->db->affected_rows();
	}
}
?>