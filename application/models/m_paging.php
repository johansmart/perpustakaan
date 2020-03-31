<?php
class M_paging extends CI_Model{

	public function ubahpaging($url){
		$pagi = $this->input->post('paginge');
		$this->db->query("update set_paging set paging = ".$this->db->escape($pagi)."");
		redirect($url);
	}
	
	
	
}
?>