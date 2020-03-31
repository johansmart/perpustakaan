<?php
class M_profile extends CI_Model{
	public function profile(){
		
		return $this->db->query("select * from profile ")->result();
	}
	function profile_proses($post_detail){
				
		$sql = "update profile set 
		detail_profile=".$this->db->escape($post_detail)."";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	function profile_gantigambar_proses($file_name){
		$post_id=$this->input->post('id');
		
		$sql = "update profile set
		image_profile='$file_name'		
		";
		$qsql = $this->db->query($sql);
		return $qsql;
	}
	
	
}
?>