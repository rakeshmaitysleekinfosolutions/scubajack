<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends AppController {
    
	public function __construct()
	{
        parent::__construct();
      
    }
    public function index() {
		// $this->template->javascript->add('assets/js/jquery.validate.js'); 
        // $this->template->javascript->add('assets/js/additional-methods.js');
        // $this->template->javascript->add('assets/js/register/register.js');
		$this->template->set_template('layout/app');
        $this->template->content->view('account/index', $this->data);
        $this->template->publish();
	}

	public function logout() {
        if ($this->user->isLogged()) {
			$this->user->logout();
			$this->redirect($this->url(''));
		}
    }
}