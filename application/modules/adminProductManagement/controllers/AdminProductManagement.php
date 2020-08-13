<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminProductManagement extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->model('MY_Model');
	}

	public function add_product(){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(parent_id = '0')";
			$data['cat_list'] = $this->Product_model->getData('bd_category', $conditions);
			$data['city_list'] = $this->Product_model->getData('bd_state');
            
            $conditions = "(state_parent_id = '0')";
			$data['state_list'] = $this->Product_model->getData('bd_state',$conditions);
            
			$this->template->admin('adminProductManagement/add_product',$data);
		} 
		else{
			redirect('admin-login','refresh');
		}
	}

	public function fetch_sub_category()
	{
		if($this->input->post('category_id'))
		{
			echo $this->Product_model->fetch_sub_cat($this->input->post('category_id'));
		}
	}
    
    public function fetch_sub_category_data()
	{
		if($this->input->post('category_id'))
		{
            $parent_id=$this->input->post('category_id');
            $conditions = "(parent_id = '$parent_id')";
			$res=$this->Product_model->getData('bd_category',$conditions);
            
            echo json_encode($res);
		}
	}
    
    public function fetch_city_data()
	{
		if($this->input->post('state_id'))
		{
            $state_id=$this->input->post('state_id');
            $conditions = "(state_parent_id = '$state_id')";
			$res=$this->Product_model->getData('bd_state',$conditions);
            
            echo json_encode($res);
		}
	}
    
    public function fetch_city()
	{
		if($this->input->post('state_id'))
		{
			echo $this->Product_model->fetch_city($this->input->post('state_id'));
		}
	}
    


	public function add_product_details(){
		if ($this->session->userdata('logged_in')) {
			if ($this->input->post('submit')) {
				$insert_product = array();
				$insert_product['city_id'] = $this->input->post('city_id');
				$insert_product['category_id'] = $this->input->post('category_id');
				$insert_product['subcategory_id'] = $this->input->post('subcategory_id');
				$insert_product['product_name'] = $this->input->post('product_name');
				$insert_product['product_desc'] = $this->input->post('product_desc');
				$insert_product['product_short_desc'] = $this->input->post('product_short_desc');
				$insert_product['product_address'] = $this->input->post('product_address');
				$insert_product['phone_no'] = $this->input->post('phone_no');
				$insert_product['website_link'] = $this->input->post('website_link');
				$insert_product['open_time'] = $this->input->post('open_time');
				$insert_product['close_time'] = $this->input->post('close_time');
				$insert_product['view_status'] = 'Yes';
				$insert_product['status'] = 'Active';
				$insert_product['dom'] = date('Y-m-d H:i:s');
                
                $open_time=$this->input->post('open_time');
                $close_time=$this->input->post('close_time');
                
                $insert_product['open_time']=implode(",",$open_time);
                $insert_product['close_time']=implode(",",$close_time);

				// if(!empty($_FILES['product_image']['tmp_name'])){
				// 	$image_data = image_uploads('product_image','product_image');
				// 	if(!empty($image_data)){
				// 		$insert_product['product_image'] = $image_data['file_name'];
				// 	}
				// }


				$res = $this->Product_model->insertData('bd_product',$insert_product);

				if ($res) {
					$business_image_uploade_details = $this->Product_model->addMultipleImages('business_image','product_image');

					if(!empty($business_image_uploade_details)){
						foreach ($business_image_uploade_details as $business_image) {
							foreach ($business_image as $key => $value) {
								// echo $value;
								$this->db->insert('bd_business_images',array('bimg_business_id'=>$res,
									'bimg_name'=>$value,
									// 'rimg_hotel_id'=>$hotel_id,
									// 'do'=>date('Y-m-d H:i:s'),
									'dom'=>date('Y-m-d H:i:s')));
							}
						}
					}
				}


				if ($res) {
					$this->session->set_flashdata('succ', '<strong>Success!</strong>Business Added Successfully');
				} else {
					$this->session->set_flashdata('err', '<strong>Success!</strong>Business Added Unsuccessfully');
				}
				redirect('add-business','refresh');
			}
		} else{
			redirect('admin-login','refresh');
		}
	}

	public function products_list(){
		if ($this->session->userdata('logged_in')) {
			$data['products_details'] = $this->Product_model->get_product_data();
			$this->template->admin('product_list',$data);
		} else{
			redirect('admin-login','refresh');
		}
	}


	public function edit_product($id){
		if ($this->session->userdata('logged_in')) {
			 
            $conditions = "(product_id = '".$id."')";
            $data['product_list'] = $this->Product_model->getData('bd_product', $conditions);
            
            $conditions = "(bimg_business_id = '".$id."')";
            $data['image_list'] = $this->Product_model->getData('bd_business_images', $conditions);
            
            $conditions = "(parent_id = '0')";
            $data['cat_list'] = $this->Product_model->getData('bd_category', $conditions);
			$data['city_list'] = $this->Product_model->getData('bd_state');
            
            $conditions = "(state_parent_id = '0')";
			$data['state_list'] = $this->Product_model->getData('bd_state',$conditions);
            
			 if ($this->input->post('submit')) {
			 	$update_data =$this->input->post();
                 unset($update_data['submit']);
                 
                $open_time=$this->input->post('open_time');
                $close_time=$this->input->post('close_time');
                
                $update_data['open_time']=implode(",",$open_time);
                $update_data['close_time']=implode(",",$close_time);

			 	$conditions = "(product_id = '".$id."')";
			 	$result = $this->Product_model->updateData('bd_product', $conditions, $update_data);
                 
                 if ($result) {
					$business_image_uploade_details = $this->Product_model->addMultipleImages('business_image','product_image');

					if(!empty($business_image_uploade_details)){
						foreach ($business_image_uploade_details as $business_image) {
							foreach ($business_image as $key => $value) {
								// echo $value;
								$this->db->insert('bd_business_images',array('bimg_business_id'=>$id,
									'bimg_name'=>$value,
									'dom'=>date('Y-m-d H:i:s')));
							}
						}
					}
				}
                 
                 
			 	if ($result) {
			 		$this->session->set_flashdata('succ', '<strong>Update Successfully </strong>');
			 		redirect('edit-business'.'/'.$id,'refresh');
			 	} else{
			 		$this->session->set_flashdata('succ', '<strong>Update Unsuccessfully </strong>');
			 	}

			 }
			$this->template->admin('edit_product',$data);
			
		} else{
			redirect('admin-login','refresh');
		}
	}
    
    public function productStatusChange($product_id="", $status=""){
		if ($this->session->userdata('logged_in')) {
			$sess_data = $this->session->userdata('sess_data');
				$conditions = "(product_id = '".$product_id."')";
				$res = $this->Product_model->change_status('bd_product','status', $status, $conditions);
				if($res){
					$this->session->set_flashdata('succ','Updated Successfully.');
				}else{
					$this->session->set_flashdata('err','Failed to update.');
				}
				redirect('business-list');
			
		} else{
			redirect('admin-login');
		}
	}



	public function delete_product($id){
		if ($this->session->userdata('logged_in')) {
			$conditions = "(product_id = '".$id."')";
			$del = $this->Product_model->deleteData('bd_product', $conditions);
            
            $conditions = "(bimg_business_id = '".$id."')";
			$del = $this->Product_model->deleteData('bd_business_images', $conditions);
            
			if ($del) {
				$this->session->set_flashdata('succ', '<strong>Delete Successfully </strong>');
					redirect('business-list','refresh');
			} else{
				$this->session->set_flashdata('succ', '<strong>Not Deleted </strong>');
			}
		} else{
			redirect('admin-login','refresh');
		}
	}
    
    public function delete_product_image(){
		
        $bimg_id=$this->input->post('bimg_id');
        $bimg_name=$this->input->post('bimg_name');
        $conditions = "(bimg_id = '".$bimg_id."')";
        $del = $this->Product_model->deleteData('bd_business_images', $conditions);
        
        image_unlink('business_image',$bimg_name);
        
        echo json_encode($del);
            
	}

	
}
