<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Category extends AdminController {

    public function onLoadDatatableEventHandler() {
		$this->load->model('Category_model');
		$this->results = $this->Category_model->findAll();
		if($this->results) {
			foreach($this->results as $result) {
				$this->rows[] = array(
					'id'			=> $result->id,
					'name'		    => $result->name,
					'slug' 		    => $result->slug,
                    'status' 		=> ($result->status && $result->status == 1) ? 1 : 0,
                    'created_at'    => Carbon::createFromTimeStamp(strtotime($result->created_at))->diffForHumans(),
                    'updated_at'    => ($result->updated_at) ? Carbon::createFromTimeStamp(strtotime($result->updated_at))->diffForHumans() : ''
				);
			}
			$i = 0;
			foreach($this->rows as $row) {
			        $checked = ($row['status']) ? 'checked' : '';
					$this->data[$i][] = '<td class="text-center">
											<label class="css-control css-control-primary css-checkbox">
												<input data-id="'.$row['id'].'" type="checkbox" class="css-control-input selectCheckbox" id="row_'.$row['id'].'" name="row_'.$row['id'].'">
												<span class="css-control-indicator"></span>
											</label>
										</td>';
					$this->data[$i][] = '<td>'.$row['name'].'</td>';
					$this->data[$i][] = '<td>'.$row['slug'].'</td>';
					$this->data[$i][] = '<td>
											<div class="material-switch pull-right">
											<input data-id="'.$row['id'].'" class="checkboxStatus" id="chat_module" type="checkbox" value="'.$row['status'].'" '.$checked.'/>
											<label for="chat_module" class="label-success"></label>
										</div>
                                        </td>';
                    $this->data[$i][] = '<td>'.$row['created_at'].'</td>';
                    $this->data[$i][] = '<td>'.$row['updated_at'].'</td>';
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
    public function index() {
        $this->template->set_template('layout/admin');
       
		$this->template->stylesheet->add('assets/theme/light/js/datatables/dataTables.bootstrap4.css');
        $this->template->javascript->add('assets/theme/light/js/datatables/jquery.dataTables.min.js');
		$this->template->javascript->add('assets/theme/light/js/datatables/dataTables.bootstrap4.min.js');
        $this->template->javascript->add('assets/js/admin/category/Category.js');

		$this->template->content->view('category/index');
		$this->template->publish();
    }
    public function getData() {

        // Errors
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }
      
        if (isset($this->error['name'])) {
            $this->data['error_name'] = $this->error['name'];
        } else {
            $this->data['error_name'] = '';
        }

        if (isset($this->error['slug'])) {
            $this->data['error_slug'] = $this->error['slug'];
        } else {
            $this->data['error_slug'] = '';
        }

        if (isset($this->error['status'])) {
            $this->data['error_status'] = $this->error['status'];
        } else {
            $this->data['error_status'] = '';
        }

        // Data

        // User ID
        if (!empty($this->input->post('categoryId'))) {
            $this->data['categoryId'] = $this->input->post('categoryId');
        } elseif (!empty($this->category)) {
            $this->data['categoryId'] = $this->category->id;
        } else {
            $this->data['categoryId'] = '';
        }
        // Name
        if (!empty($this->input->post('name'))) {
            $this->data['name'] = $this->input->post('name');
        } elseif (!empty($this->category)) {
            $this->data['name'] = $this->category->name;
        } else {
            $this->data['name'] = '';
        }

        // Slug
        if (!empty($this->input->post('slug'))) {
            $this->data['slug'] = $this->input->post('slug');
        } elseif (!empty($this->category)) {
            $this->data['slug'] = $this->category->slug;
        } else {
            $this->data['slug'] = '';
        }
        // Description
        if (!empty($this->input->post('description'))) {
            $this->data['description'] = $this->input->post('description');
        } elseif (!empty($this->categoryDescription)) {
            $this->data['description'] = $this->categoryDescription->description;
        } else {
            $this->data['description'] = '';
        }
        // Meta Title
        if (!empty($this->input->post('meta_title'))) {
            $this->data['meta_title'] = $this->input->post('meta_title');
        } elseif (!empty($this->categoryDescription)) {
            $this->data['meta_title'] = $this->categoryDescription->meta_title;
        } else {
            $this->data['meta_title'] = '';
        }
        // Meta Description
        if (!empty($this->input->post('meta_description'))) {
            $this->data['meta_description'] = $this->input->post('meta_description');
        } elseif (!empty($this->categoryDescription)) {
            $this->data['meta_description'] = $this->categoryDescription->meta_description;
        } else {
            $this->data['meta_description'] = '';
        }
        // Meta keyword
        if (!empty($this->input->post('meta_keyword'))) {
            $this->data['meta_keyword'] = $this->input->post('meta_keyword');
        } elseif (!empty($this->categoryDescription)) {
            $this->data['meta_keyword'] = $this->categoryDescription->meta_keyword;
        } else {
            $this->data['meta_keyword'] = '';
        }
       
        // Status
        if (!empty($this->input->post('status'))) {
            $this->data['status'] = $this->input->post('status');
        } elseif (!empty($this->category)) {
            $this->data['status'] = $this->category->status;
        } else {
            $this->data['status'] = 0;
        }
        // Image
		if (!empty($this->input->post('image'))) {
			$this->data['image'] = $this->input->post('image');
		} elseif (!empty($this->categoryDescription)) {
			$this->data['image'] = $this->categoryDescription->image;
		} else {
			$this->data['image'] = '';
		}

		

		if (!empty($this->input->post('image')) && is_file(DIR_IMAGE . $this->input->post('image'))) {
			$this->data['thumb'] = $this->resize($this->input->post('image'), 100, 100);
		} elseif (!empty($this->categoryDescription) && is_file(DIR_IMAGE . $this->categoryDescription->image)) {
			$this->data['thumb'] = $this->resize($this->categoryDescription->image, 100, 100);
		} else {
			$this->data['thumb'] = $this->resize('no_image.png', 100, 100);
		}

		$this->data['placeholder'] = $this->resize('no_image.png', 100, 100);
    }
    protected function validateForm() {

		if ((strlen($this->input->post('name')) < 1) || (strlen(trim($this->input->post('name'))) > 32)) {
			$this->error['name'] = $this->lang->line('error_name');
		}

		if ((strlen($this->input->post('slug')) < 1) || (strlen(trim($this->input->post('slug'))) > 32)) {
			$this->error['slug'] = $this->lang->line('error_lastname');
		}
		
        if ($this->input->post('status') == '') {
            $this->error['status'] = $this->lang->line('error_status');
        }
        
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->lang->line('error_warning');
		}
      
		return !$this->error;
    }
    public function create() {
        $this->template->javascript->add('assets/js/jquery.validate.js');
        $this->template->javascript->add('assets/js/additional-methods.js');
        $this->template->javascript->add('assets/js/admin/category/Category.js');

        $this->template->stylesheet->add('assets/theme/light/plugins/summernote/dist/summernote.css');
        $this->template->javascript->add('assets/theme/light/plugins/summernote/dist/summernote.min.js');

        $this->template->set_template('layout/admin');
        $this->getData();
        $this->template->content->view('category/create', $this->data);
        $this->template->publish();
    }
}