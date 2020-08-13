<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminCategoryManagement extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model');
		$this->load->model('MY_Model');
	}

	public function add_category(){
		if ($this->session->userdata('logged_in')) {
			// $data['state_list'] = $this->Category_model->getData('bd_state');
			$this->template->admin('adminCategoryManagement/add_category');
		} else{
			redirect('admin-login','refresh');
		}
	}


	public function add_category_details(){
		if ($this->session->userdata('logged_in')) {
			if ($this->input->post('submit')) {
				$insert_cat = array();
				$insert_cat['parent_id'] = '0';
				$insert_cat['category_name'] = $this->input->post('category_name');
				$insert_cat['catagory_desc'] = $this->input->post('catagory_desc');
				$insert_cat['category_short_desc'] = $this->input->post('category_short_desc');
				// $insert_cat['state_id'] = $this->input->post('state_id');


				if(!empty($_FILES['category_icon']['tmp_name'])){
					$image_data = image_uploads('category_icon','category_icon');
					if(!empty($image_data)){
						$insert_cat['category_icon'] = $image_data['file_name'];
					}
				}



				$insert_cat['dom'] = date('Y-m-d H:i:s');
				$res = $this->Category_model->insertData('bd_category',$insert_cat);

				if ($res) {
					$this->session->set_flashdata('succ', '<strong>Success!</strong>Category Added Successfully');
				} else {
					$this->session->set_flashdata('err', '<strong>Success!</strong>Category Added Unsuccessfully');
				}
				redirect('add-category','refresh');
			}
		} else{
			redirect('admin-login','refresh');
		}
	}

	public function category_list(){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(parent_id = '0')";
			$data['cat_details'] = $this->Category_model->getData('bd_category',$conditions);
			$this->template->admin('category_list',$data);
		} else{
			redirect('admin-login','refresh');
		}
	}


	public function edit_category($id){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(id = '".$id."')";
			// $data['state_list'] = $this->Category_model->getData('bd_state');
			$data['category_val'] = $this->Category_model->getData('bd_category', $conditions,'1');


			if ($this->input->post('submit')) {
				$update_cat = array();
				$id = $this->input->post('id');
				$update_cat['parent_id'] = '0';
				$update_cat['category_name'] = $this->input->post('category_name');
				$update_cat['catagory_desc'] = $this->input->post('catagory_desc');
				$update_cat['category_short_desc'] = $this->input->post('category_short_desc');

				if(!empty($_FILES['category_icon']['tmp_name'])){
					$image_data = image_uploads('category_icon','category_icon');
					if(!empty($image_data)){
						$update_cat['category_icon'] = $image_data['file_name'];
					}
				}

				// $update_cat['state_id'] = $this->input->post('state_id');
				$update_cat['dom'] = date('Y-m-d H:i:s');

				$conditions = "(id = '".$id."')";
				$result = $this->Category_model->updateData('bd_category', $conditions, $update_cat);
				if ($result) {
					$this->session->set_flashdata('succ', '<strong>Category Update Successfully </strong>');
					redirect('edit-category'.'/'.$id,'refresh');
				} else{
					$this->session->set_flashdata('succ', '<strong>Category Update Unsuccessfully </strong>');
				}

			}
			$this->template->admin('edit_category',$data);
			
		} else{
			redirect('admin-login','refresh');
		}
	}


	public function delete_category($id){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(id = '".$id."')";
			$del = $this->Category_model->deleteData('bd_category', $conditions);
			if ($del) {
				$this->session->set_flashdata('succ', '<strong>Category Delete Successfully </strong>');
					redirect('category-list','refresh');
			} else{
				$this->session->set_flashdata('succ', '<strong>Category Not Deleted </strong>');
			}
		} else{
			redirect('admin-login','refresh');
		}
	}

	
}
