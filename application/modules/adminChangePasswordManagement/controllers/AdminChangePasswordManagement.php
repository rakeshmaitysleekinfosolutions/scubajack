<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminChangePasswordManagement extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Chnage_password_model');
		$this->load->model('MY_Model');
	}

	public function change_password(){
		if ($this->session->userdata('logged_in')) {
            
            $conditions = "(admin_id = '1')";
            $result['profile'] = $this->Chnage_password_model->getData('bd_admins', $conditions);
			$this->template->admin('adminChangePasswordManagement/change_password',$result);
		} else{
			redirect('admin-login','refresh');
		}
	}


	public function update_password(){
		if ($this->session->userdata('logged_in')) {
			if ($this->input->post('submit')) {
				
                $data = $this->input->post();
                $old_password=$this->input->post('old_password');
                $conditions = "(admin_password = '".md5($old_password)."')";
                $result = $this->Chnage_password_model->getData('bd_admins', $conditions);
                
                if($result)
                {
                    $update_data=array("admin_password"=>md5($this->input->post('password')));
                    $conditions = "(admin_id = '1')";
                    $res = $this->Chnage_password_model->updateData('bd_admins',$conditions,$update_data);

                    if ($res) {
                        $this->session->set_flashdata('succ', '<strong>Success!</strong>Password Updated Successfully');
                    } else {
                        $this->session->set_flashdata('err', '<strong>Success!</strong>Password Updated Unsuccessfully');
                    }
                }
                else
                {
                    $this->session->set_flashdata('err', '<strong>Error!</strong>Old password wrong');
                }
                
                
				
				redirect('change-password','refresh');
			}
		} else{
			redirect('admin-login','refresh');
		}
	}
}
