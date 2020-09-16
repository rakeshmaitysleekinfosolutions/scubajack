<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class CountryDescriptionBlog_model extends BaseModel {
    
    protected $table = "country_descriptions_blogs";

    protected $primaryKey = 'id';

    protected $timestamps = true;

    // Record status for checking is deleted or not
    const SOFT_DELETED = 'is_deleted';

    public static function factory($attr = array()) {
        return new CountryDescriptionBlog_model($attr);
    }
    public function countryDescription() {
        return $this->hasOne(CountryDescription_model::class, 'id', 'country_descriptions_id');
    }
}