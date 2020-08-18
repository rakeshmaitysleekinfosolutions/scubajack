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
	public function store() {
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
			
			if ($this->model_user->getTotalUsersByEmail($this->request['email'])) {
				$this->json['error']['warning'] = $this->lang->line('error_exists');
			}
			
			
			if ((strlen($this->request['password']) < 4) || (strlen($this->request['password']) > 20)) {
				$this->json['error']['password'] = $this->lang->line('error_password');
			}
			
			if ($this->request['confirm'] != $this->request['password']) {
				$this->json['error']['confirm'] = $this->lang->line('error_confirm');
			}
			
            if (!$this->json) {
				// Add new user
				$useId = $this->model_user->addUser($this->request);
				if($useId) {
					// Get User
					$userInfo = $this->model_user->getUser($useId);
				}
				$this->json['success']          = $this->lang->line('text_success');
				$this->json['redirect'] 		= url('/');
            } 
            return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($this->json));
        }
	}
	public function edit($id) {
		

		$this->template->set_template('layout/admin');
		$this->template->content->view('users/edit', $this->data);
		$this->template->publish();
	}
	public function update() {
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['firstname'])) {
			$this->data['error_firstname'] = $this->error['firstname'];
		} else {
			$this->data['error_firstname'] = '';
		}
		
		if ($this->isPost() && $this->validateForm()) {
			$this->request = $this->xss_clean($this->input->post());
			$this->model_user->editUser($this->request['user_id'], $this->request);
			//$this->session->data['success'] = $this->lang->line('text_success');
		}
	}
	public function show() {
		//$this->template->admin('show');
	}
	public function delete() {}
	protected function validateForm() {
		

		if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = $this->language->get('error_email');
		}

		$customer_info = $this->model_user->getCustomerByEmail($this->request->post['email']);

		if (!isset($this->request->get['customer_id'])) {
			if ($customer_info) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		} else {
			if ($customer_info && ($this->request->get['customer_id'] != $customer_info['customer_id'])) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		}

		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		// Custom field validation
		$this->load->model('customer/custom_field');

		$custom_fields = $this->model_customer_custom_field->getCustomFields(array('filter_customer_group_id' => $this->request->post['customer_group_id']));

		foreach ($custom_fields as $custom_field) {
			if (($custom_field['location'] == 'account') && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['custom_field_id']])) {
				$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			} elseif (($custom_field['location'] == 'account') && ($custom_field['type'] == 'text') && !empty($custom_field['validation']) && !filter_var($this->request->post['custom_field'][$custom_field['custom_field_id']], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $custom_field['validation'])))) {
				$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			}			
		}

		if ($this->request->post['password'] || (!isset($this->request->get['customer_id']))) {
			if ((utf8_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) < 4) || (utf8_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) > 40)) {
				$this->error['password'] = $this->language->get('error_password');
			}

			if ($this->request->post['password'] != $this->request->post['confirm']) {
				$this->error['confirm'] = $this->language->get('error_confirm');
			}
		}

		if (isset($this->request->post['address'])) {
			foreach ($this->request->post['address'] as $key => $value) {
				if ((utf8_strlen($value['firstname']) < 1) || (utf8_strlen($value['firstname']) > 32)) {
					$this->error['address'][$key]['firstname'] = $this->language->get('error_firstname');
				}

				if ((utf8_strlen($value['lastname']) < 1) || (utf8_strlen($value['lastname']) > 32)) {
					$this->error['address'][$key]['lastname'] = $this->language->get('error_lastname');
				}

				if ((utf8_strlen($value['address_1']) < 3) || (utf8_strlen($value['address_1']) > 128)) {
					$this->error['address'][$key]['address_1'] = $this->language->get('error_address_1');
				}

				if ((utf8_strlen($value['city']) < 2) || (utf8_strlen($value['city']) > 128)) {
					$this->error['address'][$key]['city'] = $this->language->get('error_city');
				}

				$this->load->model('localisation/country');

				$country_info = $this->model_localisation_country->getCountry($value['country_id']);

				if ($country_info && $country_info['postcode_required'] && (utf8_strlen($value['postcode']) < 2 || utf8_strlen($value['postcode']) > 10)) {
					$this->error['address'][$key]['postcode'] = $this->language->get('error_postcode');
				}

				if ($value['country_id'] == '') {
					$this->error['address'][$key]['country'] = $this->language->get('error_country');
				}

				if (!isset($value['zone_id']) || $value['zone_id'] == '') {
					$this->error['address'][$key]['zone'] = $this->language->get('error_zone');
				}

				
			}
		}

	
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}
}