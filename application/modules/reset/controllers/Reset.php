<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends AppController {
    
	public function __construct()
	{
        parent::__construct();
        $this->load->model('User_model', 'model_user');
		$this->load->model('UserActivity_model', 'model_user_activity');
		$this->lang->load('app/forgotten_lang');
    }
    public function index() {
        if ($this->user->isLogged()) {
			$this->redirect($this->url(''));
		}
        // $lang_password = __('settings', 'lang_password', true, false);
        // if (!$lang_password) {
		// 	$this->response->redirect(url('signin'));
		// }
		if ($this->input->get('code')) {
            $code = $this->input->get('code');
        } else {
            $code = '';
        }

        $userInfo = $this->model_user->getUserByCode($code);
       
        if ($userInfo) {
            if($this->isAjaxRequest() && $this->isPost()) {

                $this->request = $this->xss_clean($this->input->post());

                if ((strlen($this->request['password']) < 4) || (strlen($this->request['password']) > 20)) {
                    $this->json['error']['password'] = $this->lang->line('error_password');
                }
                if ($this->request['confirm'] != $this->request['password']) {
                    $this->json['error']['confirm'] = $this->lang->line('error_confirm');
                }
                if(!$this->json) {
                    if($this->request['password'] && $this->request['confirm']) {
                        $this->model_user->editPassword($userInfo['email'], $this->request['password']);
                        // $activity_data = array(
                        //     'customer_id' => $userInfo['id'],
                        //     'name'        => $this->request('firstname') . ' ' . $this->request('lastname')
                        // );
                        // $this->customer_account_activity->addActivity('reset_password', $activity_data);
                        
                        $this->session->userdata('success',$this->lang->line('text_success'));
                        $this->json['success']      = $this->lang->line('text_success');
                        $this->json['redirect']     = url('login');

                        
                    }
                } 
                    return $this->output
                                ->set_content_type('application/json')
                                ->set_status_header(200)
                                ->set_output(json_encode($this->json));
                
              
            }
            $this->data['action'] = url('reset?code=' . $code);
            $this->data['cancel'] = url('login');
            //$this->dd($this->data);

            $this->template->javascript->add('assets/js/jquery.validate.js'); 
            $this->template->javascript->add('assets/js/additional-methods.js');
            $this->template->javascript->add('assets/js/reset/Reset.js');
        
            $this->template->set_template('layout/app');
            $this->template->content->view('reset/index', $this->data);
            $this->template->publish();
		} else {
			// $this->load->model('Setting_model', 'model_setting_setting');
            // $this->model_setting_setting->editSettingValue('lang', 'lang_password', '0');
            $this->session->userdata('error',$this->lang->line('error_code'));
            $this->redirect('login');
        }
    }
}