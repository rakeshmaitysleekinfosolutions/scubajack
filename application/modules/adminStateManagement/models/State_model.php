<?php
class State_model extends MY_Model {
	
	public function __construct(){
		$this->load->database();
	}
	
	public function add_states($insert_state =""){
		$this->db->insert('bd_state',$insert_state);
		$insert_id = $this->db->insert_id();
		return $insert_id ? $insert_id : false;
	}

	public function getAllState(){
		// $this->db->select('state_parent_id');
		return $this->db->get('bd_state')->result_array();
	}

	

	
}