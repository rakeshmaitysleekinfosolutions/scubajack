<?php
class Product_model extends MY_Model {
	
	public function __construct(){
		$this->load->database();
	}


	public function fetch_sub_cat($category_id)
	 {
		$this->db->where('parent_id', $category_id);
		// $this->db->order_by('state_name', 'ASC');
		$query = $this->db->get('bd_category');
		$output = '<option value="">Select Sub Category</option>';
		foreach($query->result() as $row)
		{
		$output .= '<option value="'.$row->id.'">'.$row->category_name.'</option>';
		}
		return $output;
	 }
    
    public function get_product_data()
    {
        $query=$this->db->query('SELECT bd_product.*,state_name, category_name, (SELECT state_name FROM `bd_state` WHERE bd_product.city_id=bd_state.id )  as city_name, (SELECT category_name FROM `bd_category` WHERE bd_product.subcategory_id=bd_category.id )  as subcategory_name  FROM `bd_product` LEFT JOIN bd_state ON bd_product.state_id=bd_state.id LEFT JOIN bd_category ON bd_product.category_id=bd_category.id');
        $result=$query->result_array();
        
        return $result;
    }
    
    public function fetch_city($state_id)
	{
		$this->db->where('state_parent_id', $state_id);
		// $this->db->order_by('state_name', 'ASC');
		$query = $this->db->get('bd_state');
		$output = '<option value="">Select City</option>';
		foreach($query->result() as $row)
		{
		$output .= '<option value="'.$row->id.'">'.$row->state_name.'</option>';
		}
		return $output;
	}
	
	
}