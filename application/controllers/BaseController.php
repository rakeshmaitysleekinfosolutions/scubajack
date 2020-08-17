<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseController extends MX_Controller {
    public $data;
    public $results;
    public $json = array();
    public $request = array();
    
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
    public function redirect($uri = '', $method = 'auto', $code = NULL)
	{
		if ( ! preg_match('#^(\w+:)?//#i', $uri))
		{
			$uri = site_url($uri);
		}

		// IIS environment likely? Use 'refresh' for better compatibility
		if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== FALSE)
		{
			$method = 'refresh';
		}
		elseif ($method !== 'refresh' && (empty($code) OR ! is_numeric($code)))
		{
			if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1')
			{
				$code = ($_SERVER['REQUEST_METHOD'] !== 'GET')
					? 303	// reference: http://en.wikipedia.org/wiki/Post/Redirect/Get
					: 307;
			}
			else
			{
				$code = 302;
			}
		}

		switch ($method)
		{
			case 'refresh':
				header('Refresh:0;url='.$uri);
				break;
			default:
				header('Location: '.$uri, TRUE, $code);
				break;
		}
		exit;
    }
   
    /**
     * Site URL
     *
     * Create a local URL based on your basepath. Segments can be passed via the
     * first parameter either as a string or an array.
     *
     * @param	string	$uri
     * @param	string	$protocol
     * @return	string
     */
    public function url($uri = '', $protocol = NULL) {
        //getLocale(getLocaleId()).'/'.
        return get_instance()->config->site_url($uri, $protocol);
    }
    
}