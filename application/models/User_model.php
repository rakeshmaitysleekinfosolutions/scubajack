<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends BaseModel {
    
    protected $table = "users";

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
        return new User_model($attr);
    }


    /**
     * @desc Get All User 
     * @return Array
     */
    public function getUsers() {
        $this->results = User_model::factory()->find()->get()->result_array();
        foreach ($this->results as $result) {
            $this->data[] = array(
                'id'                => $result['id'],
                'name'              => strip_tags(html_entity_decode($result['firstname'], ENT_QUOTES, 'UTF-8')). ' '. strip_tags(html_entity_decode($result['lastname'], ENT_QUOTES, 'UTF-8')),
                'firstname'         => $result['firstname'],
                'lastname'          => $result['lastname'],
                'email'             => $result['email'],
                'telephone'         => $result['telephone'],
                'address'           => Address_model::factory()->getAddressesByUserId($result['id'])
            );
        }

        if($this->data) {
            return $this->data;
        }
	}
    /**
	 * @method Add new user
	 * @param $data Array()
	 */
    public function addUser($data) {

		$salt = token(9);
		$this->db->query("INSERT INTO users SET firstname = '" . $this->db->escape_str($data['firstname']) . "', lastname = '" . $this->db->escape_str($data['lastname']) . "', email = '" . $this->db->escape_str($data['email']) . "', salt = '" . $this->db->escape_str($salt) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($data['password'])))) . "', ip = '" . $this->db->escape_str($this->input->server('REMOTE_ADDR')) . "', status = 1");

		$user_id = $this->db->insert_id();

		$this->db->query("INSERT INTO users_address SET user_id = '" . (int)$user_id . "', firstname = '" . $this->db->escape_str($data['firstname']) . "', lastname = '" . $this->db->escape_str($data['lastname']) . "'");

		$address_id = $this->db->insert_id();

		$this->db->query("UPDATE users SET address_id = '" . (int)$address_id . "' WHERE id = '" . (int)$user_id . "'");
		/*
		$this->load->language('mail/User');

		$subject = sprintf($this->config->item('text_subject'), html_entity_decode($this->config->item('config_name'), ENT_QUOTES, 'UTF-8'));

		$message = sprintf($this->config->item('text_welcome'), html_entity_decode($this->config->item('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

		if (!$User_group_info['approval']) {
			$message .= $this->config->item('text_login') . "\n";
		} else {
			$message .= $this->config->item('text_approval') . "\n";
		}

		$message .= $this->url->link('account/login', '', true) . "\n\n";
		$message .= $this->config->item('text_services') . "\n\n";
		$message .= $this->config->item('text_thanks') . "\n";
		$message .= html_entity_decode($this->config->item('config_name'), ENT_QUOTES, 'UTF-8');

		$mail = new Mail();
		$mail->protocol = $this->config->item('config_mail_protocol');
		$mail->parameter = $this->config->item('config_mail_parameter');
		$mail->smtp_hostname = $this->config->item('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->item('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->item('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->item('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->item('config_mail_smtp_timeout');

		$mail->setTo($data['email']);
		$mail->setFrom($this->config->item('config_email'));
		$mail->setSender(html_entity_decode($this->config->item('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
		$mail->send();

		// Send to main admin email if new account email is enabled
		if (in_array('account', (array)$this->config->item('config_mail_alert'))) {
			$message  = $this->config->item('text_signup') . "\n\n";
			$message .= $this->config->item('text_website') . ' ' . html_entity_decode($this->config->item('config_name'), ENT_QUOTES, 'UTF-8') . "\n";
			$message .= $this->config->item('text_firstname') . ' ' . $data['firstname'] . "\n";
			$message .= $this->config->item('text_lastname') . ' ' . $data['lastname'] . "\n";
			$message .= $this->config->item('text_User_group') . ' ' . $User_group_info['name'] . "\n";
			$message .= $this->config->item('text_email') . ' '  .  $data['email'] . "\n";
			$message .= $this->config->item('text_telephone') . ' ' . $data['telephone'] . "\n";

			$mail = new Mail();
			$mail->protocol = $this->config->item('config_mail_protocol');
			$mail->parameter = $this->config->item('config_mail_parameter');
			$mail->smtp_hostname = $this->config->item('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->item('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->item('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->item('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->item('config_mail_smtp_timeout');

			$mail->setTo($this->config->item('config_email'));
			$mail->setFrom($this->config->item('config_email'));
			$mail->setSender(html_entity_decode($this->config->item('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($this->config->item('text_new_User'), ENT_QUOTES, 'UTF-8'));
			$mail->setText($message);
			$mail->send();

			// Send to additional alert emails if new account email is enabled
			$emails = explode(',', $this->config->item('config_alert_email'));

			foreach ($emails as $email) {
				if (utf8_strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}
		*/
		return $user_id;
	}

	public function editUser($id, $data) {
		$this->db->query("UPDATE users SET firstname = '" . $this->db->escape_str($data['firstname']) . "', lastname = '" . $this->db->escape_str($data['lastname']) . "', email = '" . $this->db->escape_str($data['email']) . "', phone = '" . $this->db->escape_str($data['phone']) . "' , status = '" . $this->db->escape_str($data['status']) . "' WHERE id = '" . (int)$id . "'");
        if ($data['password']) {
            $salt = token(9);
            $this->db->query("UPDATE `users` SET salt = '" . $this->db->escape_str($salt) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE id = '" . (int)$id . "'");
        }
        $this->db->query("DELETE FROM users_address WHERE user_id = '" . (int)$id . "'");
        if (isset($data['address'])) {
            foreach ($data['address'] as $address) {
                //dd($address);
                $this->db->query("INSERT INTO users_address SET user_id = '" . (int)$id . "', firstname = '" . $this->db->escape_str($data['firstname']) . "', lastname = '" . $this->db->escape_str($data['lastname']) . "', address_1 = '" . $this->db->escape_str($address['address_1']) . "', address_2 = '" . $this->db->escape_str($address['address_2']) . "', city = '" . $this->db->escape_str($address['city']) . "', postcode = '" . $this->db->escape_str($address['postcode']) . "', country_id = '" . (int)$address['country_id'] . "', state_id = '" . (int)$address['state_id'] . "'");
               // $address_id = $this->db->insert_id();
               // $this->db->query("UPDATE users SET address_id = '" . (int)$address_id . "' WHERE id = '" . (int)$id . "'");
            }
        }
	}

	public function editPassword($email, $password) {
		$this->db->query("UPDATE users SET salt = '" . $this->db->escape_str($salt = token(9)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE LOWER(email) = '" . $this->db->escape_str(strtolower($email)) . "'");
	}

	public function editCode($email, $code) {
		$this->db->query("UPDATE `users` SET code = '" . $this->db->escape_str($code) . "' WHERE LCASE(email) = '" . $this->db->escape_str(strtolower($email)) . "'");
	}

	public function editNewsletter($newsletter) {
		$this->db->query("UPDATE users SET newsletter = '" . (int)$newsletter . "' WHERE id = '" . (int)$this->User->getId() . "'");
	}

	public function getUser($user_id) {
		$query = $this->db->query("SELECT * FROM users WHERE id = '" . (int)$user_id . "'");

		return $query->row_array();
	}
	public function getUserById($id) {

    }

	public function getUserByEmail($email) {
		$query = $this->db->query("SELECT * FROM users WHERE LOWER(email) = '" . $this->db->escape_str(strtolower($email)) . "'");

		return $query->row_array();
	}

	public function getUserByCode($code) {
		$query = $this->db->query("SELECT id, firstname, lastname, email FROM `users` WHERE code = '" . $this->db->escape_str($code) . "' AND code != ''");

		return $query->row_array();
	}

	public function getUserByToken($token) {
		$query = $this->db->query("SELECT * FROM users WHERE token = '" . $this->db->escape_str($token) . "' AND token != ''");

		$this->db->query("UPDATE users SET token = ''");

		return $query->row_array();
	}

	public function getTotalusersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM users WHERE LOWER(email) = '" . $this->db->escape_str(strtolower($email)) . "'");

		return $query->row_array()['total'];
	}

	public function getRewardTotal($user_id) {
		$query = $this->db->query("SELECT SUM(points) AS total FROM User_reward WHERE user_id = '" . (int)$user_id . "'");

		return $query->row_array()['total'];
	}

	public function getIps($user_id) {
		$query = $this->db->query("SELECT * FROM `User_ip` WHERE user_id = '" . (int)$user_id . "'");

		return $query->result_array();
	}

	public function addLoginAttempt($email) {
		$query = $this->db->query("SELECT * FROM users_login WHERE email = '" . $this->db->escape_str(strtolower((string)$email)) . "' AND ip = '" . $this->db->escape_str($this->input->server('REMOTE_ADDR')) . "'");

		if (!$query->num_rows()) {
			$this->db->query("INSERT INTO users_login SET email = '" . $this->db->escape_str(strtolower((string)$email)) . "', ip = '" . $this->db->escape_str($this->input->server('REMOTE_ADDR')) . "', total = 1, created_at = '" . $this->db->escape_str(date('Y-m-d H:i:s')) . "', updated_at = '" . $this->db->escape_str(date('Y-m-d H:i:s')) . "'");
		} else {
			$this->db->query("UPDATE users_login SET total = (total + 1), updated_at = '" . $this->db->escape_str(date('Y-m-d H:i:s')) . "' WHERE User_login_id = '" . (int)$query->row['User_login_id'] . "'");
		}
	}

	public function getLoginAttempts($email) {
		$query = $this->db->query("SELECT * FROM `users_login` WHERE email = '" . $this->db->escape_str(strtolower($email)) . "'");

		return $query->row_array();
	}

	public function deleteLoginAttempts($email) {
		$this->db->query("DELETE FROM `users_login` WHERE email = '" . $this->db->escape_str(strtolower($email)) . "'");
	}

	public function user($id) {
        return User_model::factory()->findOne($id);
    }

	public function address() {
        return $this->hasMany('UserAddress_model', 'user_id', 'id')->get()->row_object();
    }

//    public function getAddress() {
//        return $this->address()->result_array();
//    }
//    public function toArray($relationNames =[]){
//        $data = parent::toArray();
//        foreach ($relationNames as $relationName){
//            try{
//                $data[$relationName] =  $this->$relationName;
//            }catch(\Exception $e){}
//        }
//        dd($data);
//        return $data;
//    }
	

	
	
}