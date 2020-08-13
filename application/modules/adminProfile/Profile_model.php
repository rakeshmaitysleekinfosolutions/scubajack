<?php
class Profile_model extends MY_Model {
	
	public function __construct(){
		$this->load->database();
	}
	

	public function getAllState(){
		return $this->db->get('bd_state')->result_array();
	}

	

	
}