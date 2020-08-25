<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class CategoryToProduct_model extends BaseModel {
    
    protected $table = "category_to_products";

    protected $primaryKey = 'id';
  
    // Record status for checking is deleted or not
    const SOFT_DELETED = 'is_deleted';
    
    public static function factory($attr = array()) {
        return new CategoryToProduct_model($attr);
    }
    
}