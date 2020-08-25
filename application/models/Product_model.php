<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Product_model extends BaseModel {
    
    protected $table = "products";

    protected $primaryKey = 'id';

    protected $timestamps = true;

    // Mainstream creating field name
    const CREATED_AT = 'created_at';

    // Mainstream updating field name
    const UPDATED_AT = 'updated_at';

    // Use unixtime for saving datetime
    protected $dateFormat = 'datetime';

    // Record status for checking is deleted or not
    const SOFT_DELETED = 'is_deleted';

    // 0: actived, 1: deleted
    protected $recordDeletedFalseValue = '1';

    protected $recordDeletedTrueValue = '0';

    public static function factory($attr = array()) {
        return new Product_model($attr);
    }
    public function addProduct($data = array()) {
        $this->db->query("INSERT INTO products SET name = '" . $this->db->escape_str($data['name']) . "', slug = '" . $this->db->escape_str($data['slug']) . "', status = '" . $this->db->escape_str($data['status'])."'");
        $productId = $this->db->insert_id();
        if(isset($productId)) {
            if($data['categories']) {
                foreach ($data['categories'] as $category) {
                    $this->db->query("INSERT INTO category_to_products SET category_id = '" . (int)$category . "' product_id = '".$productId."'");
                }
            }
            $this->db->query("INSERT INTO product_description SET product_id = '" . (int)$productId . "', description = '" . $this->db->escape_str($data['description']) . "', meta_title = '" . $this->db->escape_str($data['meta_title']) . "', meta_keyword = '" . $this->db->escape_str($data['meta_keyword']) . "', meta_description = '" . $this->db->escape_str($data['meta_description']) . "'");
            $this->db->query("INSERT INTO product_images SET product_id = '" . (int)$productId . "', image = '" . $this->db->escape_str($data['image']) . "'");
            $this->db->query("INSERT INTO product_videos SET product_id = '" . (int)$productId . "', url = '" . $this->db->escape_str($data['youtubeUrl']) . "'");
        }

    }
    public function categoryDescription() {
        return $this->hasMany('CategoryDescription_model', 'category_id', 'id')->get()->row_object();
    }
    public function getCategoryBySlug($slug) {
        $query = $this->db->query("SELECT * FROM category WHERE slug = '" . $this->db->escape_str(strtolower($slug)) . "'");
        return $query->row_array();
    }

    public function editProduct($productId, $data) {
        $this->db->query("UPDATE products SET name = '" . $this->db->escape_str($data['name']) . "', slug = '" . $this->db->escape_str($data['slug']) . "', status = '" . $this->db->escape_str($data['status'])."' WHERE id = '" . (int)$productId . "'");
        $this->db->query("UPDATE category_to_products SET category_id = '".(int)$data['category_id']."' WHERE product_id = '" . (int)$productId . "'");
        $this->db->query("UPDATE product_description SET product_id = '" . (int)$productId . "', image = '" . $this->db->escape_str($data['image']) . "', description = '" . $this->db->escape_str($data['description']) . "', meta_title = '" . $this->db->escape_str($data['meta_title']) . "', meta_keyword = '" . $this->db->escape_str($data['meta_keyword']) . "', meta_description = '" . $this->db->escape_str($data['meta_description']) . "'");
        $this->db->query("UPDATE products_images SET image = '".(int)$data['image']."' WHERE product_id = '" . (int)$productId . "'");
        $this->db->query("UPDATE products_videos SET url = '".(int)$data['youtube_url']."' WHERE product_id = '" . (int)$productId . "'");
    }
    public function deleteCategory($categoryId, $forceDelete = false) {
        if($forceDelete) {
            $this->db->query("DELETE FROM category WHERE id = '" . (int)$categoryId . "'");
            $this->db->query("DELETE FROM category_description WHERE category_id = '" . (int)$categoryId . "'");
        }
        $this->db->query("UPDATE category SET is_deleted = 1 WHERE id = '" . (int)$categoryId . "'");
        $this->db->query("UPDATE category_description SET is_deleted = 1 WHERE category_id = '" . (int)$categoryId . "'");
    }
    public function updateStatus($categoryId, $status) {
        $this->db->query("UPDATE category SET status = '" . $this->db->escape_str($status) . "' WHERE id = '" . (int)$categoryId . "'");
    }

}