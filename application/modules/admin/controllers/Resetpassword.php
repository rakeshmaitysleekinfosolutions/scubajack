<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetpassword extends AdminController {

	public function __constructor() {
		parent::__construct();
    }

    public function index() {
        $this->template->set_template('layout/admin');
        $this->template->content->view('resetpassword/index');
        $this->template->publish();
    }
}