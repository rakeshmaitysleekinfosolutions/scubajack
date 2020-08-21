<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends AppController {

    public function index()
	{
	    $this->load->model('Category_model');
	    $categories = $this->Category_model->findAll(['status' => 1]);

        if($categories) {
            $this->data['categories'] = $categories;
        }
		$this->template->set_template('layout/app');
		$this->template->content->view('index', $this->data);
		$this->template->publish();
	}


}