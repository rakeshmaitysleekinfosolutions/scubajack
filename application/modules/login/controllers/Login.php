<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends AppController {

	public function index()
	{
		$this->template->set_template('layout/app');
		$this->template->content->view('login/index');
		$this->template->publish();
	}


}