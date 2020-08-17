<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Setting_model extends BaseModel {
    
    protected $table = "settings";

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
        return new Setting_model($attr);
    }

    public function getSetting($code) {
		$setting_data = array();

		$query = $this->db->query("SELECT * FROM settings WHERE `code` = '" . $this->db->escape_str($code) . "'");

		foreach ($query->rows as $result) {
			if (!$result['serialized']) {
				$setting_data[$result['key']] = $result['value'];
			} else {
				$setting_data[$result['key']] = json_decode($result['value'], true);
			}
		}

		return $setting_data;
	}


	public function addSetting($code, $data) {
		$this->db->query("DELETE FROM `settings` WHERE `code` = '" . $this->db->escape_str($code) . "'");

		foreach ($data as $key => $value) {
			if (substr($key, 0, strlen($code)) == $code) {
				if (!is_array($value)) {
					$this->db->query("INSERT INTO settings SET `code` = '" . $this->db->escape_str($code) . "', `key` = '" . $this->db->escape_str($key) . "', `value` = '" . $this->db->escape_str($value) . "'");
				} else {
					$this->db->query("INSERT INTO settings SET `code` = '" . $this->db->escape_str($code) . "', `key` = '" . $this->db->escape_str($key) . "', `value` = '" . $this->db->escape_str(json_encode($value, true)) . "', serialized = '1'");
				}
			}
		}
	}

	public function deleteSetting($code) {
		$this->db->query("DELETE FROM settings WHERE `code` = '" . $this->db->escape_str($code) . "'");
	}
	
	public function getSettingValue($key) {
		$query = $this->db->query("SELECT value FROM settings WHERE `key` = '" . $this->db->escape_str($key) . "'");

		if ($query->num_rows()) {
			return $query->row_array()['value'];
		} else {
			return null;	
		}
	}
	
	public function editSettingValue($code = '', $key = '', $value = '') {
		if (!is_array($value)) {
			$this->db->query("UPDATE settings SET `value` = '" . $this->db->escape_str($value) . "', serialized = '0'  WHERE `code` = '" . $this->db->escape_str($code) . "' AND `key` = '" . $this->db->escape_str($key) . "'");
		} else {
			$this->db->query("UPDATE settings SET `value` = '" . $this->db->escape_str(json_encode($value)) . "', serialized = '1' WHERE `code` = '" . $this->db->escape_str($code) . "' AND `key` = '" . $this->db->escape_str($key) . "'");
		}
	}
}