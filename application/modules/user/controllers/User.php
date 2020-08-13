<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends AdminController {

	public function __constructor() {
		parent::__construct();
		
		
	}	
	public function get() {
		$this->load->model('User_model', 'model_user');
		$this->results = $this->model_user->findAll();
		if($this->results) {
			foreach($this->results as $result) {
				$this->data[] = '<tr>
                        <td>'.$result->firstname.'</td>
						<td>'.$result->lastname.'</td>
						<td>'.$result->email.'</td>
						<td>'.$result->status.'</td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#delete_client"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>';
			}
		}

		if($this->data) {
			return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array('data' => $this->data)));
		} else {
			return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array('data' => [])));
		}
 	}
	public function index()
	{
	
		//$this->beforeRender();

		$this->template->set_template('layout/admin');
		$this->template->stylesheet->add('assets/theme/light/js/datatables/dataTables.bootstrap4.css');
        $this->template->javascript->add('assets/theme/light/js/datatables/jquery.dataTables.min.js');
		$this->template->javascript->add('assets/theme/light/js/datatables/dataTables.bootstrap4.min.js');
		
		$this->template->javascript->add('assets/js/User.js');
		$this->template->content->view('index');
		$this->template->publish();
	}

	public function create() {
		$this->template->set_template('layout/admin');
		$this->template->content->view('create');
		$this->template->publish();
	}
	public function store() {}
	public function edit() {}
	public function update() {}
	public function show() {
		//$this->template->admin('show');
	}
	public function delete() {}
}