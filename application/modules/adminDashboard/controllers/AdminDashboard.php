<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminDashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('MY_Model');
	}

	public function index(){
		if(!$this->session->userdata('logged_in')){
			$this->load->view('adminDashboard/login');

		}else{
			redirect(admin_url('dashboard'));
		}
	}

	public function login(){
		$admin_email = $this->input->post('admin_email'); 
		$admin_password = md5($this->input->post('admin_password')); 
		
		// $admin_password = $this->input->post('admin_password'); 
		// $admin_password = md5(SECURITY_SALT.$this->security->xss_clean($this->input->post('admin_password')));
		$res = $this->admin_model->check_login($admin_email,$admin_password);
		if ($res->num_rows() > 0) {
			$usr_data = $res->row_array();
			$sess_arr = array(
				'id'=>  $usr_data['admin_id'],
				'email'=> $usr_data['admin_email'],
				'name'=> $usr_data['admin_name'],
				'username'=> $usr_data['admin_user_name'],
				'role'=> $usr_data['admin_role'],
				'last_login'=> $usr_data['admin_last_login'],
			);
			$this->session->set_userdata('logged_in', True);
			$this->session->set_userdata('sess_data', $sess_arr);

			$result = $this->admin_model->last_login($usr_data['admin_id']);

				if($result){
					$this->session->set_flashdata('succ','<strong>Welcome</strong>. You have successfully logged in.');
					redirect(admin_url('dashboard'));
				}else{
					$this->session->set_flashdata('err','Failed to Login.');
					redirect('admin');
				}
		} else{
			$this->session->set_flashdata('err','You have enter a wrong email or password.');
			redirect('admin','refresh');
		}


	}

	public function dashboard()
	{
		$this->load->view('adminIncludes/header');
		$this->load->view('adminIncludes/side_menu');
		$this->load->view('adminIncludes/top_menu');
		$this->load->view('adminDashboard/dashboard');
		$this->load->view('adminIncludes/footer');
	}


	public function admin_logout(){
		$this->session->sess_destroy();
		redirect('admin');
	}
}
