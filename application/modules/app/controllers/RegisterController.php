<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends AppController {
    
	public function __construct()
	{
        parent::__construct();
        $this->load->model('User_model', 'model_user');
		$this->load->model('UserActivity_model', 'model_user_activity');
    }
    public function index() {

		if ($this->user->isLogged()) {
			$this->redirect(url(''));
		}
		
       
		if($this->isAjaxRequest() && $this->isPost()) {

			if ((strlen(trim($this->input->post('firstname'))) < 1) || (strlen(trim($this->input->post('firstname'))) > 32)) {
				$json['error']['firstname'] = $this->config->item('error_firstname');
			}
			
			if ((strlen(trim($this->input->post('lastname'))) < 1) || (strlen(trim($this->input->post('lastname'))) > 32)) {
				$json['error']['lastname'] = $this->config->item('error_lastname');
			}
			
			if ((strlen($this->input->post('email')) > 96) || !filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
				$json['error']['email'] = $this->config->item('error_email');
			}
			
			if ($this->model_user->getTotalCustomersByEmail($this->input->post('email'))) {
				$json['error']['warning'] = $this->config->item('error_exists');
			}
			
			if ((strlen($this->input->post('telephone')) < 3) || (strlen($this->input->post('telephone')) > 32)) {
			    $json['error']['telephone'] = $this->config->item('error_telephone');
			}
			
			if ((strlen($this->input->post('password')) < 4) || (strlen($this->input->post('password')) > 20)) {
				$json['error']['password'] = $this->config->item('error_password');
			}
			
			if ($this->input->post('confirm') != $this->input->post('password')) {
				$json['error']['confirm'] = $this->config->item('error_confirm');
			}
			
			if (!$this->input->post('agree')) {
				$json['error']['warning'] = sprintf($this->config->item('error_agree'), $information_info['title']);
			}
			
            if (!$json) {
				$id_customers = $this->model_user->addCustomer($this->input->post());
				if($id_customers) {
					$customer_info = $this->model_user->getCustomer($id_customers);
				}
				// Clear any previous login attempts for unregistered accounts.
				$this->model_user->deleteLoginAttempts($this->input->post('email'));
				 $this->customer->login($this->input->post('email'), $this->input->post('password'));
				 $activity_data = array(
							'customer_id' => $id_customers,
							'name'        => $this->input->post('firstname') . ' ' . $this->input->post('lastname')
						);
				$this->model_user_activity->addActivity('register', $activity_data);
				$customer_group_info = $this->customer_group->getCustomerGroup($customer_group_id);
				$json['success']            = $this->config->item('text_success');
				$json['redirect'] = url('');
            } 
            return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($json));
        }
		

		$this->template->javascript->add('assets/js/jquery.validate.js'); 
        $this->template->javascript->add('assets/js/additional-methods.js');
        $this->template->javascript->add('assets/js/register/register.js');
		$this->template->set_template('layout/app');
        $this->template->content->view('app/register/index', $this->data);
        $this->template->publish();
	}

}