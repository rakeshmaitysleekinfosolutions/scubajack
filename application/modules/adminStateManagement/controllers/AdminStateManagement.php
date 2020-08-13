<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminStateManagement extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('State_model');
		$this->load->model('MY_Model');
	}

	public function add_state(){
		if ($this->session->userdata('logged_in')) {
			$this->template->admin('adminStateManagement/add_state');
		} else{
			redirect('admin-login','refresh');
		}
	}


	public function add_state_details(){
		if ($this->session->userdata('logged_in')) {
			if ($this->input->post('submit')) {
				$insert_state = array();
				$insert_state['state_name'] = $this->input->post('state_name');
				$insert_state['state_zip'] = $this->input->post('state_zip');
				$insert_state['state_shortname'] = $this->input->post('state_shortname');
				$insert_state['dom'] = date('Y-m-d H:i:s');
				$res = $this->State_model->add_states($insert_state);

				if ($res) {
					$this->session->set_flashdata('succ', '<strong>Success!</strong>State Added Successfully');
				} else {
					$this->session->set_flashdata('err', '<strong>Success!</strong>State Added Unsuccessfully');
				}
				redirect('add-state','refresh');
			}
		} else{
			redirect('admin-login','refresh');
		}
	}

	public function state_list(){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(state_parent_id = '0')";
			$data['state_details'] = $this->State_model->getData('bd_state',$conditions);
			$this->template->admin('state_list',$data);
		} else{
			redirect('admin-login','refresh');
		}
	}


	public function edit_state($id){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(id = '".$id."')";
			$data['state'] = $this->State_model->getData('bd_state', $conditions, '1');


			if ($this->input->post('submit')) {
				$update_data = array();
				$id = $this->input->post('id');
				$update_data['state_name'] = $this->input->post('state_name');
				$update_data['state_zip'] = $this->input->post('state_zip');
				$update_data['state_shortname'] = $this->input->post('state_shortname');

				$conditions = "(id = '".$id."')";
				$result = $this->State_model->updateData('bd_state', $conditions, $update_data);
				if ($result) {
					$this->session->set_flashdata('succ', '<strong>State Update Successfully </strong>');
					redirect('edit-state'.'/'.$id,'refresh');
				} else{
					$this->session->set_flashdata('succ', '<strong>State Update Unsuccessfully </strong>');
				}

			}
			$this->template->admin('edit_states',$data);
			
		} else{
			redirect('admin-login','refresh');
		}
	}


	public function delete_state($id){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(id = '".$id."')";
			// $conditions = "(id = '".$id."' AND state_parent_id <> '".$id."')";
			// $conditions = "(id = $id AND state_parent_id != $id)";
			$del = $this->State_model->deleteData('bd_state', $conditions);
			// echo '<pre>';
			// $data['state_p_id'] = $this->State_model->getAllState();
	
			// foreach ($data['state_p_id'] as $value) {
				
			// $this->db->where('id', $id);
			// $this->db->where_not_in('state_parent_id', $value['state_parent_id']);
			// $del = $this->db->delete('bd_state');
			// }
			

			if ($del) {
				$this->session->set_flashdata('succ', '<strong>State Delete Successfully </strong>');
					redirect('state-list','refresh');
			} else{
				$this->session->set_flashdata('succ', '<strong>State Not Deleted </strong>');
			}
		} else{
			redirect('admin-login','refresh');
		}
	}

	public function stateStatusChange($id="", $status=""){
		if ($this->session->userdata('logged_in')) {
			$sess_data = $this->session->userdata('sess_data');
				$conditions = "(id = '".$id."')";
				$res = $this->State_model->change_status('bd_state','status', $status, $conditions);
				if($res){
					$this->session->set_flashdata('succ','Updated Successfully.');
				}else{
					$this->session->set_flashdata('err','Failed to update.');
				}
				redirect('state-list');
			
		} else{
			redirect('admin-login');
		}
	}













	///////////////////////////////CITY MANAGEMENT////////////////////////////////
	public function add_city(){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(state_parent_id = 0)";
			$data['state_list'] = $this->State_model->getData('bd_state', $conditions);
			$this->template->admin('add_city',$data);
		} 
		else{
			redirect('admin-login','refresh');
		}
	}




	public function add_city_details(){
		if ($this->session->userdata('logged_in')) {
			if ($this->input->post('submit')) {
				$insert_city = array();
				$insert_city['state_parent_id'] = $this->input->post('parent_id');
				$insert_city['state_name'] = $this->input->post('state_name');
				$insert_city['state_zip'] = $this->input->post('state_zip');
				$insert_city['state_shortname'] = $this->input->post('state_shortname');
				$insert_city['dom'] = date('Y-m-d H:i:s');
				$res = $this->State_model->insertData('bd_state',$insert_city);

				if ($res) {
					$this->session->set_flashdata('succ', '<strong>Success!</strong>City Added Successfully');
				} else {
					$this->session->set_flashdata('err', '<strong>Success!</strong>City Added Unsuccessfully');
				}
				redirect('add-city','refresh');
			}
		} else{
			redirect('admin-login','refresh');
		}
	}


	public function city_list(){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(state_parent_id <> '0')";
			$data['city_details'] = $this->State_model->getData('bd_state',$conditions);
			$this->template->admin('city_list',$data);
		} else{
			redirect('admin-login','refresh');
		}
	}


	public function edit_city($id){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(id = '".$id."')";
			$data['city'] = $this->State_model->getData('bd_state', $conditions, '1');


			if ($this->input->post('submit')) {
				$update_data = array();
				$id = $this->input->post('id');
				$update_data['state_name'] = $this->input->post('state_name');
				$update_data['state_zip'] = $this->input->post('state_zip');
				$update_data['state_shortname'] = $this->input->post('state_shortname');

				$conditions = "(id = '".$id."')";
				$result = $this->State_model->updateData('bd_state', $conditions, $update_data);
				if ($result) {
					$this->session->set_flashdata('succ', '<strong>City Update Successfully </strong>');
					redirect('edit-city'.'/'.$id,'refresh');
				} else{
					$this->session->set_flashdata('succ', '<strong>City Update Unsuccessfully </strong>');
				}

			}
			$this->template->admin('edit_city',$data);
			
		} else{
			redirect('admin-login','refresh');
		}
	}



	public function delete_city($id){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(id = '".$id."')";
			$del = $this->State_model->deleteData('bd_state', $conditions);
			if ($del) {
				$this->session->set_flashdata('succ', '<strong>City Deleted Successfully </strong>');
					redirect('city-list','refresh');
			} else{
				$this->session->set_flashdata('succ', '<strong>City Not Deleted </strong>');
			}
		} else{
			redirect('admin-login','refresh');
		}
	}



	public function cityStatusChange($id="", $status=""){
		if ($this->session->userdata('logged_in')) {
			$sess_data = $this->session->userdata('sess_data');
				$conditions = "(id = '".$id."')";
				$res = $this->State_model->change_status('bd_state','status', $status, $conditions);
				if($res){
					$this->session->set_flashdata('succ','Updated Successfully.');
				}else{
					$this->session->set_flashdata('err','Failed to update.');
				}
				redirect('city-list');
			
		} else{
			redirect('admin-login');
		}
	}

	
}
