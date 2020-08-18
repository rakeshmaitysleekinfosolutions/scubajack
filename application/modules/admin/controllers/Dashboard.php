<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends AdminController {

	public function __constructor() {
		parent::__construct();
    }

    public function index() {
        $this->template->set_template('layout/admin');
        $this->template->content->view('dashboard/index');
        $this->template->publish();
    }
}