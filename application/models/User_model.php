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
     * @desc Get All Customer 
     * @return Array
     */
    public function getUsers() {
        $this->results = Customer_model::factory()->find()->get()->result_array();
        foreach ($this->results as $result) {
            $this->data[] = array(
                'id'                => $result['id'],
                'name'              => strip_tags(html_entity_decode($result['firstname'], ENT_QUOTES, 'UTF-8')). ' '. strip_tags(html_entity_decode($result['lastname'], ENT_QUOTES, 'UTF-8')),
                'firstname'         => $result['firstname'],
                'lastname'          => $result['lastname'],
                'email'             => $result['email'],
                'telephone'         => $result['telephone'],
                'address'           => Address_model::factory()->getAddressesByCustomerId($result['id'])
            );
        }

        if($this->data) {
            return $this->data;
        }
	}
	/*
    public function getTotalCustomers() {
		$sql = "SELECT COUNT(*) AS total FROM `customers` WHERE `is_deleted` = '0'";
		$query = $this->db->query($sql);
		return $query->row_array()['total'];
		
	}
	*/
	public function getTotalCustomers($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM customers";
		$implode = array();
        
		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape_str($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$implode[] = "email LIKE '" . $this->db->escape_str($data['filter_email']) . "%'";
		}

		if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])) {
			$implode[] = "newsletter = '" . (int)$data['filter_newsletter'] . "'";
		}

		if (!empty($data['filter_id_customer_group'])) {
			$implode[] = "id_customer_group = '" . (int)$data['filter_id_customer_group'] . "'";
		}

		if (!empty($data['filter_ip'])) {
			$implode[] = "id_customers IN (SELECT id_customers FROM " . DB_PREFIX . "customers_ip WHERE ip = '" . $this->db->escape_str($data['filter_ip']) . "')";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_created_at'])) {
			$implode[] = "DATE(created_at) = DATE('" . $this->db->escape_str($data['filter_created_at']) . "')";
        }
        //default
        $implode[] = "`is_deleted` = '0'";
		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row_array()['total'];
	}


    // Customer
    public function addCustomer($data) {
		if (isset($data['id_customer_group'])) {
			$id_customer_group = $data['id_customer_group'];
		} 
		// echo $id_customer_group;
		// exit;
		$customer_group_info = CustomerGroup_model::factory()->getCustomerGroup($id_customer_group);
		$salt = token(9);
		$this->db->query("INSERT INTO customers SET id_customer_group = '" . (int)$id_customer_group . "', store_id = '" . (int)$this->config->item('config_store_id') . "', language_id = '" . (int)$this->config->item('config_language_id') . "', firstname = '" . $this->db->escape_str($data['firstname']) . "', lastname = '" . $this->db->escape_str($data['lastname']) . "', email = '" . $this->db->escape_str($data['email']) . "', telephone = '" . $this->db->escape_str($data['telephone']) . "', fax = '" . $this->db->escape_str($data['fax']) . "', custom_field = '" . $this->db->escape_str(isset($data['custom_field']['account']) ? json_encode($data['custom_field']['account']) : '') . "', salt = '" . $this->db->escape_str($salt) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($data['password'])))) . "', newsletter = '" . (isset($data['newsletter']) ? (int)$data['newsletter'] : 0) . "', ip = '" . $this->db->escape_str($this->input->server('REMOTE_ADDR')) . "', status = '1', approved = '" . (int)!$customer_group_info['approval'] . "', date_added = NOW()");

		$id_customers = $this->db->insert_id();

		$this->db->query("INSERT INTO address SET id_customers = '" . (int)$id_customers . "', firstname = '" . $this->db->escape_str($data['firstname']) . "', lastname = '" . $this->db->escape_str($data['lastname']) . "', company = '" . $this->db->escape_str($data['company']) . "', address_1 = '" . $this->db->escape_str($data['address_1']) . "', address_2 = '" . $this->db->escape_str($data['address_2']) . "', city = '" . $this->db->escape_str($data['city']) . "', postcode = '" . $this->db->escape_str($data['postcode']) . "', id_country = '" . (int)$data['country_id'] . "', id_zone = '" . (int)$data['zone_id'] . "', custom_field = '" . $this->db->escape_str(isset($data['custom_field']['address']) ? json_encode($data['custom_field']['address']) : '') . "'");

		$id_address = $this->db->insert_id();

		$this->db->query("UPDATE customers SET id_address = '" . (int)$id_address . "' WHERE id = '" . (int)$id_customers . "'");
		/*
		$this->load->language('mail/customer');

		$subject = sprintf($this->config->item('text_subject'), html_entity_decode($this->config->item('config_name'), ENT_QUOTES, 'UTF-8'));

		$message = sprintf($this->config->item('text_welcome'), html_entity_decode($this->config->item('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

		if (!$customer_group_info['approval']) {
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
			$message .= $this->config->item('text_customer_group') . ' ' . $customer_group_info['name'] . "\n";
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
			$mail->setSubject(html_entity_decode($this->config->item('text_new_customer'), ENT_QUOTES, 'UTF-8'));
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
		return $id_customers;
	}

	public function editCustomer($data) {
		$id_customers = $this->customer->getId();

		$this->db->query("UPDATE customers SET firstname = '" . $this->db->escape_str($data['firstname']) . "', lastname = '" . $this->db->escape_str($data['lastname']) . "', email = '" . $this->db->escape_str($data['email']) . "', telephone = '" . $this->db->escape_str($data['telephone']) . "' WHERE id = '" . (int)$id_customers . "'");
	}

	public function editPassword($email, $password) {
		// echo "UPDATE customers SET salt = '" . $this->db->escape_str($salt = token(9)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE LOWER(email) = '" . $this->db->escape_str(strtolower($email)) . "'";
		// exit;
		$this->db->query("UPDATE customers SET salt = '" . $this->db->escape_str($salt = token(9)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE LOWER(email) = '" . $this->db->escape_str(strtolower($email)) . "'");
	}

	public function editCode($email, $code) {
		$this->db->query("UPDATE `customers` SET code = '" . $this->db->escape_str($code) . "' WHERE LCASE(email) = '" . $this->db->escape_str(strtolower($email)) . "'");
	}

	public function editNewsletter($newsletter) {
		$this->db->query("UPDATE customers SET newsletter = '" . (int)$newsletter . "' WHERE id = '" . (int)$this->customer->getId() . "'");
	}

	public function getCustomer($id_customers) {
		$query = $this->db->query("SELECT * FROM customers WHERE id = '" . (int)$id_customers . "'");

		return $query->row_array();
	}

	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT * FROM customers WHERE LOWER(email) = '" . $this->db->escape_str(strtolower($email)) . "'");

		return $query->row_array();
	}

	public function getCustomerByCode($code) {
		$query = $this->db->query("SELECT id_customers, firstname, lastname, email FROM `customers` WHERE code = '" . $this->db->escape_str($code) . "' AND code != ''");

		return $query->row_array();
	}

	public function getCustomerByToken($token) {
		$query = $this->db->query("SELECT * FROM customers WHERE token = '" . $this->db->escape_str($token) . "' AND token != ''");

		$this->db->query("UPDATE customers SET token = ''");

		return $query->row_array();
	}

	public function getTotalCustomersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM customers WHERE LOWER(email) = '" . $this->db->escape_str(strtolower($email)) . "'");

		return $query->row_array()['total'];
	}

	public function getRewardTotal($id_customers) {
		$query = $this->db->query("SELECT SUM(points) AS total FROM customer_reward WHERE id_customers = '" . (int)$id_customers . "'");

		return $query->row_array()['total'];
	}

	public function getIps($id_customers) {
		$query = $this->db->query("SELECT * FROM `customer_ip` WHERE id_customers = '" . (int)$id_customers . "'");

		return $query->result_array();
	}

	public function addLoginAttempt($email) {
		$query = $this->db->query("SELECT * FROM customers_login WHERE email = '" . $this->db->escape_str(strtolower((string)$email)) . "' AND ip = '" . $this->db->escape_str($this->input->server('REMOTE_ADDR')) . "'");

		if (!$query->num_rows()) {
			$this->db->query("INSERT INTO customers_login SET email = '" . $this->db->escape_str(strtolower((string)$email)) . "', ip = '" . $this->db->escape_str($this->input->server('REMOTE_ADDR')) . "', total = 1, created_at = '" . $this->db->escape_str(date('Y-m-d H:i:s')) . "', updated_at = '" . $this->db->escape_str(date('Y-m-d H:i:s')) . "'");
		} else {
			$this->db->query("UPDATE customers_login SET total = (total + 1), updated_at = '" . $this->db->escape_str(date('Y-m-d H:i:s')) . "' WHERE customer_login_id = '" . (int)$query->row['customer_login_id'] . "'");
		}
	}

	public function getLoginAttempts($email) {
		$query = $this->db->query("SELECT * FROM `customers_login` WHERE email = '" . $this->db->escape_str(strtolower($email)) . "'");

		return $query->row_array();
	}

	public function deleteLoginAttempts($email) {
		$this->db->query("DELETE FROM `customers_login` WHERE email = '" . $this->db->escape_str(strtolower($email)) . "'");
	}

	public function getCustomers() {
		$customer_array = array();
		$customers = Customer_model::factory()->find()->get()->result_array();
		if($customers) {
			foreach ($customers as $key => $value) {
				$customer_array[] = array(
					'customer_id' 	=> $value['id'],
					'email'			=> $value['email']
				);
			}
		}

		if(!empty($customer_array)) {
			return $customer_array;
		}
	}
	public function getUserByCode($code) {
		$query = $this->db->query("SELECT * FROM `customers` WHERE code = '" . $this->db->escape_str($code) . "' AND code != ''");

		return $query->row_array();
	}
   
	public function getUpcomingEventByCustomerId($customerId) {
		if($customerId) {
			$order_info = Order_model::factory()->find()->where('id_customers', $customerId)->get()->result_array();
		}
		$arr = array();
		if($order_info) {
			foreach ($order_info as $key => $value) {
				$arr[] = Event_model::factory()->getEvent($value['id_events']);
			}
		}
		$current_ts = strtotime(date('Y-m-d H:i:s'));
		if($arr) {
			foreach ($arr as $event) {
				if(isset($event['event_datetime']) && !empty($event['event_datetime'])) {
					$event_datetime = strtotime($event['event_datetime']);
				} else {
					$event_datetime   = strtotime(date('Y-m-d H:i:s'));
				}
				if($current_ts <= $event_datetime) {
					$eventArr[] = Event_model::factory()->getUpcomingEventByEvent($event);
				} 
				
			}
		}
		
		if(!empty($eventArr)) {
			foreach($eventArr as $event) {
				
                $events[] = array(
                    'id'        => $event['id'],
					'title'     => $event['title'],
                    'sub_title' => $event['sub_title'],
                    'text'      => $event['description'],
                    'img'       => base_url($event['image']),
                    'slug'      => $event['slug'],
                    'venue'     => $event['venue'],
                    'artists'   => $event['artists'],
                    'day'       => date('jS', strtotime($event['event_datetime'])),
                    'month'     => date('M', strtotime($event['event_datetime'])),
                    'year'      => date('Y', strtotime($event['event_datetime'])),
                    'view'      => url('event/'.$event['slug']),
                    'sale'      => $event['sale'],
                    'time'      => date("H:i:s",strtotime($event['event_datetime']))
                );
            }
		}
		if(!empty($events)) {
			return $events;
		}
	}
    public function getPastEventByCustomerId($customerId) {
		if($customerId) {
			$order_info = Order_model::factory()->find()->where('id_customers', $customerId)->get()->result_array();
		}
		
		$arr = array();
		if($order_info) {
			foreach ($order_info as $key => $value) {
				$arr[] = Event_model::factory()->getEvent($value['id_events']);
			}
		}
		$current_ts = strtotime(date('Y-m-d H:i:s'));
		if($arr) {
			foreach ($arr as $key => $event) {
				if(isset($event['event_datetime']) && !empty($event['event_datetime'])) {
					$event_datetime = strtotime($event['event_datetime']);
				} else {
					$event_datetime   = strtotime(date('Y-m-d H:i:s'));
				}
				if($current_ts >= $event_datetime) {
					$eventArr[] = Event_model::factory()->getPastEventByEvent($event);
				} 
				
			}
		}
		// echo "<pre>";
		// print_r($eventArr);
		// exit;
		if(!empty($eventArr)) {
			foreach($eventArr as $event) {
				
                $past_events[] = array(
                    'id'        => $event['id'],
					'title'     => $event['title'],
                    'sub_title' => $event['sub_title'],
                    'text'      => $event['description'],
                    'img'       => base_url($event['image']),
                    'slug'      => $event['slug'],
                    'venue'     => $event['venue'],
                    'artists'   => $event['artists'],
                    'day'       => date('jS', strtotime($event['event_datetime'])),
                    'month'     => date('M', strtotime($event['event_datetime'])),
                    'year'      => date('Y', strtotime($event['event_datetime'])),
                    'view'      => url('event/'.$event['slug']),
                    'sale'      => $event['sale'],
                    'time'      => date("H:i:s",strtotime($event['event_datetime']))
                );
            }
		}
		if(!empty($past_events)) {
			return $past_events;
		}
	}
}