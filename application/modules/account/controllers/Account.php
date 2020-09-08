<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Account extends AppController {

    /**
     * @var object
     */

    private $error;
    /**
     * @var object
     */
    private $auser;

    public function __construct()
	{
        parent::__construct();
        $this->lang->load('admin/users_lang');
        $this->template->set_template('layout/app');

    }
    public function index() {
        if (!$this->user->isLogged()) {
            $this->redirect($this->url('login'));
        }
        //if(!$this->isSubscribed()) redirect('subscribe-now');

        if(isLogged()) {
            $this->auser = User_model::factory()->findOne(userId());
        }
        if($this->auser) {
            $this->data['user'] = $this->auser;
            $this->data['registrationDate'] =Carbon::createFromTimeStamp(strtotime($this->auser->created_at));
        }

        $this->template->javascript->add('assets/js/jquery.validate.js');
        $this->template->javascript->add('assets/js/additional-methods.js');
        $this->template->javascript->add('assets/js/account/Account.js');
        $this->template->content->view('account/index', $this->data);
        $this->template->publish();
	}
    public function update() {

        if($this->isAjaxRequest() && $this->isPost()) {
            $this->request = $this->xss_clean($this->input->post());
            if ((strlen(trim($this->request['firstname'])) < 1) || (strlen(trim($this->request['firstname'])) > 32)) {
                $this->json['error']['firstname'] = $this->lang->line('error_firstname');
            }

            if ((strlen(trim($this->request['lastname'])) < 1) || (strlen(trim($this->request['lastname'])) > 32)) {
                $this->json['error']['lastname'] = $this->lang->line('error_lastname');
            }

            if ((strlen($this->request['email']) > 96) || !filter_var($this->request['email'], FILTER_VALIDATE_EMAIL)) {
                $this->json['error']['email'] = $this->lang->line('error_email');
            }


            if (!empty($this->request['password'])) {
                if ((strlen($this->request['password']) < 4) || (strlen($this->request['password']) > 20)) {
                    $this->json['error']['password'] = $this->lang->line('error_password');
                }
            }
            if (!empty($this->request['confirm'])) {
                if ($this->request['confirm'] != $this->request['password']) {
                    $this->json['error']['confirm'] = $this->lang->line('error_confirm');
                }
            }
            //dd($this->json);
            if(!$this->json) {
                User_model::factory()->updateAccount(userId(), $this->request);
                $this->json['success'] = $this->lang->line('text_success');
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));

            }
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->json));

        }
    }
	public function logout() {
        if ($this->user->isLogged()) {
			$this->user->logout();
			$this->redirect($this->url(''));
		}
    }
}