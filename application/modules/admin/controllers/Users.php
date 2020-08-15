<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends AdminController {

	public function __constructor() {
		parent::__construct();
		
		
	}	
	public function onLoadDatatableEventHandler() {
		$this->load->model('User_model', 'model_user');
		$this->results = $this->model_user->findAll();
		if($this->results) {
			foreach($this->results as $result) {
				$this->rows[] = array(
					'id'			=> $result->id,
					'firstname'		=> $result->firstname,
					'lastname' 		=> $result->lastname,
					'email' 		=> $result->email,
					'status' 		=> ($result->status && $result->status == 1) ? array('text' => 'Ative', 'icon' => 'fa fa-dot-circle-o text-success') : array('text' => 'Inactive', 'icon' => 'fa fa-dot-circle-o text-danger'),
				);
			}
			$i = 0;
			foreach($this->rows as $row) {
					$this->data[$i][] = '<td class="text-center">
											<label class="css-control css-control-primary css-checkbox">
												<input data-id="'.$row['id'].'" type="checkbox" class="css-control-input" id="row_'.$row['id'].'" name="row_'.$row['id'].'">
												<span class="css-control-indicator"></span>
											</label>
										</td>';
					$this->data[$i][] = '<td>'.$row['firstname'].'</td>';
					$this->data[$i][] = '<td>'.$row['lastname'].'</td>';
					$this->data[$i][] = '<td>'.$row['email'].'</td>';
					$this->data[$i][] = '<td>
											<div class="dropdown action-label">
												<a class="btn btn-white btn-sm rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="'.$row['status']['icon'].'"></i> '.$row['status']['text'].' <i class="caret"></i></a>
												<ul class="dropdown-menu">
													<li><a href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a></li>
													<li><a href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a></li>
												</ul>
											</div>
										</td>';
					$this->data[$i][] = '<td class="text-right">
	                            <div class="dropdown">
	                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
	                                <ul class="dropdown-menu pull-right">
	                                    <li><a class="edit" href="javascript:void(0);" data-id="'.$row['id'].'" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
	                                    <li><a class="delete" href="#" data-toggle="modal" data-target="#delete_client"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
	                                </ul>
	                            </div>
	                        </td>
	                    ';
	                    $i++;
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
	public function onChangeStatusEventHandler() {
		if($this->isAjaxRequest()) {
			$this->setRequest($this->input->post());
			
		}
	}
	public function index()
	{
	
		//$this->beforeRender();

		$this->template->set_template('layout/admin');
		$this->template->stylesheet->add('assets/theme/light/js/datatables/dataTables.bootstrap4.css');
        $this->template->javascript->add('assets/theme/light/js/datatables/jquery.dataTables.min.js');
		$this->template->javascript->add('assets/theme/light/js/datatables/dataTables.bootstrap4.min.js');
		
		$this->template->javascript->add('assets/js/Users.js');
		$this->template->content->view('users/index');
		$this->template->publish();
	}

	public function create() {
		$this->template->set_template('layout/admin');
		$this->template->content->view('users/create');
		$this->template->publish();
	}
	public function store() {}
	public function edit($id) {
		$this->template->set_template('layout/admin');
		$this->template->content->view('users/edit');
		$this->template->publish();
	}
	public function update() {}
	public function show() {
		//$this->template->admin('show');
	}
	public function delete() {}
}