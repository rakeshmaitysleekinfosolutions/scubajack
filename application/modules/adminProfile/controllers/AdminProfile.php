<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminProfile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model');
		$this->load->model('MY_Model');
	}


	public function edit_profile($admin_id){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(admin_id = '".$admin_id."')";
			$data['profile'] = $this->Profile_model->getData('bd_admins', $conditions);
			


			if ($this->input->post('submit')) {
				$update_data = array();
				$admin_id = $this->input->post('admin_id');
				$update_data['admin_name'] = $this->input->post('admin_name');
				$update_data['admin_user_name'] = $this->input->post('admin_user_name');
				$update_data['admin_email'] = $this->input->post('admin_email');

				$conditions = "(admin_id = '".$admin_id."')";
				$result = $this->Profile_model->updateData('bd_admins', $conditions, $update_data);
				if ($result) {
					$this->session->set_flashdata('succ', '<strong>Profile Update Successfully </strong>');
					redirect('edit-profile'.'/'.$admin_id,'refresh');
				} else{
					$this->session->set_flashdata('succ', '<strong>Profile Update Unsuccessfully </strong>');
				}

			}
			$this->template->admin('edit_profile',$data);
			
		}
	}


	public function view_profile($admin_id){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(admin_id = '".$admin_id."')";
			$data['profile'] = $this->Profile_model->getData('bd_admins', $conditions);
			
			$this->template->admin('view_profile',$data);
			
		}
	}

	
}
