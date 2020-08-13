<?php
date_default_timezone_set('Asia/Kolkata');
if (!defined('BASEPATH'))
    EXIT("No direct script access allowed");

class MY_Model extends CI_Model {

    public $image_url = '';
 	public function __construct() {
        parent::__construct();
        $this->load->database();
	}




	function getData($tablename='', $conditions='',$mul_recode='0',$selected_fild='*',$order_by='',$limit='')
	{
		if(!empty($tablename)) {
		  $this->db->select($selected_fild);
		  if( !empty($conditions) ){
		  $this->db->where($conditions);
		  }
		  if( !empty($order_by) ){
		  $this->db->where($order_by);
		  } 
		  if( !empty($limit) ){
		  $this->db->where($limit);
		  }

		  $result = $this->db->get($tablename);

		  if($mul_recode == '1' ){
		  $result = $result->row_array();
		  } else {
		  $result = $result->result_array();
		  }		           
		}

		return $result ? $result : false;
	}

	function insertData($tablename='', $data='')
	{
		$this->db->insert($tablename, $data);
		// echo $this->db->last_query(); exit;
		$inserted_id = $this->db->insert_id();
		return $inserted_id ? $inserted_id : false;
	}

	function insertBatch($tablename='', $data='')
	{
		$result = $this->db->insert_batch($tablename, $data);
		return $result ? $result : false;
	}

	function updateData($tablename='', $conditions='',$data='')
	{
		$this->db->where($conditions);
       $result = $this->db->update($tablename, $data);
       return $result ? $result : false;
	}

	function deleteData($tablename='', $conditions='')
	{
		$this->db->where($conditions);
        $result = $this->db->delete($tablename);
        return $result ? $result : false;
	}



	public function change_status($table = "", $field= "", $status= "", $conditions= ""){
		if ($table != "" && $field != "" && $status != "" && $conditions != "") {
			$this->db->where($conditions);
			$this->db->update($table,array($field=>$status));

			if ($this->db->affected_rows() > 0) {
				return 1;
			}else{
				return 0;
			}
		} else{
			return 0;
		}
	}



	public function addMultipleImages($folder_name='',$file_name=''){
		if(!empty($_FILES[''.$file_name.'']['name'])){
	        $filesCount = count($_FILES[''.$file_name.'']['name']);
	        $fileData;
	        $uploadData = array();

	        for($i = 0; $i < $filesCount; $i++){
	            $_FILES['file']['name']     = $_FILES[''.$file_name.'']['name'][$i];
	            $_FILES['file']['type']     = $_FILES[''.$file_name.'']['type'][$i];
	            $_FILES['file']['tmp_name'] = $_FILES[''.$file_name.'']['tmp_name'][$i];
	            $_FILES['file']['error']     = $_FILES[''.$file_name.'']['error'][$i];
	            $_FILES['file']['size']     = $_FILES[''.$file_name.'']['size'][$i];
	            
	            // File upload configuration
	            $uploadPath = './assets/uploads/'.$folder_name.'/';
	            $config['upload_path'] = $uploadPath;
	            $config['allowed_types'] = 'jpg|jpeg|png|gif';
	            $config['encrypt_name'] = TRUE;
	            
	            // Load and initialize upload library
	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);
	            
	            // Upload file to server
	            if($this->upload->do_upload('file')){
	                // Uploaded file data
	                $fileData = $this->upload->data();

	                $uploadData[$i]['file_name'] = $fileData['file_name'];

	            }
	        }
	        return $uploadData;
	    }
	}


}