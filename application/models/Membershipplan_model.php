<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Membershipplan_model extends BaseModel {


    protected $table = "membership_plans";

    protected $primaryKey = 'id';

    protected $timestamps = true;

    // Record status for checking is deleted or not
    const SOFT_DELETED = 'is_deleted';

    public static function factory($attr = array()) {
        return new Membershipplan_model($attr);
    }


}
