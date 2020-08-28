<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends AppController {

    public function index()
	{

        $this->data['categories'] = Category_model::factory()->findAll(['status' => 1]);

		$this->template->set_template('layout/app');
		$this->template->content->view('index', $this->data);
		$this->template->publish();
	}


}