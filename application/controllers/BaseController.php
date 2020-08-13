<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseController extends MX_Controller {
    public $data;
    public $results;
    
    public function __constructor() {
         parent::__constructor();
         $this->load->library('security');
	}	
    
    protected function dd($attr) {
        echo "<pre>";
        print_r($attr);
        die();
    }
    protected function isAjaxRequest() {
        if ($this->input->is_ajax_request()) {
            return true;
        }
         return false;
    }
    protected function isPost() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            return true;
        }
        return false;
    }
    protected function xss_clean($data) {
        return $this->security->xss_clean($data);
    }
    protected function get($key){
        if ($this->has($key))
        {
            return $this->input->get($key);
        }
        return false;
    }
    protected function post($key) {
        if ($this->has($key))
        {
            return $this->xss_clean($this->input->post($key));
        }
        return false;
    }
    protected function setCookie($array = array(), $XSSFilter  = TRUE) {
        $this->input->cookie($array, $XSSFilter); // with XSS filter
        return $this;
    }
    protected function has($key)
    {
        return (!empty($key) && $key !== NULL);
    }
}