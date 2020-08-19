<?php
if(!defined('BASEPATH')) EXIT("No direct script access allowed");
	if(!function_exists('image_uploads')){
	
	function image_uploads($folder_name, $file_name){		
		    $CI = & get_instance();	
		    //file upload destination
            $config['upload_path'] = './assets/uploads/'.$folder_name;
            $config['allowed_types'] = 'jpg|JPG|png|PNG|JPEG|jpeg|mp4';
            $config['max_size']   = '1000000';
  		    $config['max_width']  = '1024000';
  		    $config['max_height'] = '768000';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            //thumbnail path
           // $thumb_path = './assets/uploads/thumb/';
            //  $thumb_path = './assets/uploads/thumb_new/';
            //store file info once uploaded
            $CI->load->library('upload', $config);
            //$CI->load->library('image_lib');
            
            $file_data = array();
            //check for errors
            $is_file_error = FALSE;
            //check if file was selected for upload
           if (!$_FILES) {
                $is_file_error = TRUE;
				$display_error  =  handle_error('Select at least one file.');
            }
          
            //if file was selected then proceed to upload
            if (!$is_file_error) {
                //load the preferences
                //$CI->load->library('upload', $config);
                //check file successfully uploaded. 'file_name' is the name of the input
               
                if (!$CI->upload->do_upload($file_name)) {
                    //if file upload failed then catch the errors
                    $display_error  = handle_error($CI->upload->display_errors());
                    $is_file_error = TRUE;
                 }else {
                	  
                    //store the file info
                    $file_data = $CI->upload->data();
                }
            }
            // There were errors, we have to delete the uploaded files
            if ($is_file_error) {
                if ($file_data) {
                    $file = './assets/uploads/'.$folder_name.$file_data['file_name'];
                    if (file_exists($file)) {
                        unlink($file);
                    }
                    
                }
                $message =  $display_error;
            }
		   if (!$is_file_error) {
                $message = $file_data; 
               	} 
		return $message;
	}
	
}
  
  	function handle_error($err) {
     	$CI = & get_instance();	
        $error = $err . "\r\n";
        return $error;
    }





    function get_count($table_name, $conditions){
        $CI =& get_instance();
        $CI->db->where($conditions);
        $result = $CI->db->get($table_name)->num_rows();
        return $result ? $result : false;
    }

    function image_unlink($folder_name,$file_name)
    {
        $file = './assets/uploads/'.$folder_name.'/'.$file_name;
        if (file_exists($file)) {
            unlink($file);
        }
    }

  
    if ( ! function_exists('dd')) {
        function dd($attr) {
            echo "<pre>";
            print_r($attr);
            die();
        }
    }
    if ( ! function_exists('__token')) {
        function __token() {
           $CI = get_instance();
           $CI->load->library('security');
           return $CI->security->get_csrf_token_name();
        }
    }
    if ( ! function_exists('csrf_token')) {
        function csrf_token() {
           $CI = get_instance();
           $CI->load->library('security');
           return $CI->security->get_csrf_hash();
        }
    }
    if ( ! function_exists('token')) { 
        function token($length = 32) {
            // Create random token
            $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $max = strlen($string) - 1;
            $token = '';
            for ($i = 0; $i < $length; $i++) {
                $token .= $string[mt_rand(0, $max)];
            }	
            return $token;
        }
    }
    
    if ( ! function_exists('admin_url')) {
        function admin_url($uri = '', $protocol = NULL) {
            return get_instance()->config->base_url('admin/'.$uri, $protocol);
        }
    }
    if(!function_exists('isLogged')) {
        function isLogged() {
            $ci = get_instance();
            return ($ci->session->userdata('user_id')) && (int) $ci->session->userdata('user_id') > 0 ? (int) $ci->session->userdata('user_id') : false;
        }
    }
    if ( ! function_exists('url')) {
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
	function url($uri = '', $protocol = NULL) {
		//getLocale(getLocaleId()).'/'.
		return get_instance()->config->site_url($uri, $protocol);
	}
    if(!function_exists('hasSession')) {
        function hasSession($key) {
            $ci = get_instance();
            return ($ci->session->has_userdata($key)) ? true : false;
        }
    }
    if(!function_exists('getSession')) {
        function getSession($key) {
            $ci = get_instance();
            return ($ci->session->userdata($key) && !empty($ci->session->userdata($key))) ? $ci->session->userdata($key) : '';
        }
    }
    if(!function_exists('setSession')) {
        function setSession($key, $value) {
            $ci = get_instance();
            $ci->session->set_userdata($key, $value);
        }
    }
    if(!function_exists('unsetSession')) {
        function unsetSession($key) {
            $ci = get_instance();
            $ci->session->unset_userdata($key);
        }
    }
    if(!function_exists('setMessage')) {
        function setMessage($key, $value) {
            $ci = get_instance();
            $ci->session->set_flashdata($key, $value);
        }
    }
    if(!function_exists('getMessage')) {
        function getMessage($key) {
            $ci = get_instance();
            return ($ci->session->flashdata($key) && !empty($ci->session->flashdata($key))) ? $ci->session->flashdata($key) : '';
        }
    }
    if(!function_exists('hasMessage')) {
        function hasMessage($key) {
            $ci = get_instance();
            return ($ci->session->flashdata($key)) ? true : false;
        }
    }
}
?>