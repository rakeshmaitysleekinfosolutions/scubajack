<?php

class User {
	private $id;
	private $firstname;
	private $lastname;
	private $id_customer_group;
	private $email;
	private $telephone;
	private $id_address;
	private	$createdAt;
	private $ci;

	public function __construct() {
		$this->ci = &get_instance();
		$this->ci->load->library('session');
		if ($this->ci->session->userdata('user_id')) {
			
			$customer_query = $this->ci->db->query("SELECT * FROM users WHERE id = '" . (int)$this->ci->session->userdata('user_id') . "' AND status = '1'");
			
			if ($customer_query->num_rows()) {
				$this->id                   = $customer_query->row_array()['id'];
				$this->firstname            = $customer_query->row_array()['firstname'];
				$this->lastname             = $customer_query->row_array()['lastname'];
				$this->id_customer_group    = $customer_query->row_array()['id_customer_group'];
				$this->email                = $customer_query->row_array()['email'];
				$this->telephone            = $customer_query->row_array()['telephone'];
				$this->id_address           = $customer_query->row_array()['id_address'];
				$this->createdAt            = $customer_query->row_array()['created_at'];
				
				$this->ci->db->query("UPDATE users SET ip = '" . $this->ci->db->escape_str($this->ci->input->server('REMOTE_ADDR')) . "' WHERE id = '" . (int)$this->id . "'");

				$query = $this->ci->db->query("SELECT * FROM users_ip WHERE id = '" . (int)$this->ci->session->userdata('id') . "' AND ip = '" . $this->ci->db->escape_str($this->ci->input->server('REMOTE_ADDR')) . "'");

				if (!$query->num_rows()) {
					$this->ci->db->query("INSERT INTO users_ip SET id = '" . (int)$this->ci->session->userdata('id') . "', ip = '" . $this->ci->db->escape_str($this->ci->input->server('REMOTE_ADDR')) . "', created_at = NOW()");
				}
			} else {
				$this->logout();
			}
		}
	}

	public function login($email, $password, $override = false) {
		if ($override) {
			$customer_query = $this->ci->db->query("SELECT * FROM users WHERE LOWER(email) = '" . $this->ci->db->escape_str(strtolower($email)) . "' AND status = '1'");
		} else {
			$customer_query = $this->ci->db->query("SELECT * FROM users WHERE LOWER(email) = '" . $this->ci->db->escape_str(strtolower($email)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->ci->db->escape_str($password) . "'))))) OR password = '" . $this->ci->db->escape_str(md5($password)) . "') AND status = '1' AND approved = '1'");
		}

		if ($customer_query->num_rows()) {
			$this->ci->session->set_userdata('user',$customer_query->row_array());
			$this->ci->session->set_userdata('is_logged',1);
			$this->ci->session->set_userdata('user_id',$customer_query->row_array()['id']);

			$this->id                   = $customer_query->row_array()['id'];
			$this->firstname            = $customer_query->row_array()['firstname'];
			$this->lastname             = $customer_query->row_array()['lastname'];
			
			$this->email                = $customer_query->row_array()['email'];
			$this->telephone            = $customer_query->row_array()['telephone'];
			$this->newsletter           = $customer_query->row_array()['newsletter'];
			$this->id_address           = $customer_query->row_array()['id_address'];

			$this->ci->db->query("UPDATE users SET ip = '" . $this->ci->db->escape_str($this->request->server['REMOTE_ADDR']) . "' WHERE id = '" . (int)$this->id . "'");
			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		$this->id                   = '';
		$this->firstname            = '';
		$this->lastname             = '';
		$this->id_customer_group    = '';
		$this->email                = '';
		$this->telephone            = '';
		$this->fax                  = '';
		$this->newsletter           = '';
		$this->id_address           = '';
		$this->ci->session->unset_userdata('user');
		$this->ci->session->unset_userdata('is_logged');
		$this->ci->session->unset_userdata('user_id');
		return true;
	}
	public function isLogged() {
		return $this->id;
	}
	public function getId() {
		return $this->id;
	}
	public function getFirstName() {
		return $this->firstname;
	}
	public function getLastName() {
		return $this->lastname;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getTelephone() {
		return $this->telephone;
	}
	public function getCreatedAt() {
		return $this->createdAt;
	}
	public function getAddressId() {
		return $this->id_address;
	}

	

	
}
