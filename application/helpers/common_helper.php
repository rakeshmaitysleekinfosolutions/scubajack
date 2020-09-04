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
    if ( ! function_exists('encrypt')) {
        function encrypt($str) {
            return base64_encode($str);
        }
    }
    if ( ! function_exists('decrypt')) {
        function decrypt($str) {
            return base64_decode($str);

        }
    }
    function compress($input, $ascii_offset = 38){
        $input = strtoupper($input);
        $output = '';
        //We can try for a 4:3 (8:6) compression (roughly), 24 bits for 4 chars
        foreach(str_split($input, 4) as $chunk) {
            $chunk = str_pad($chunk, 4, '=');

            $int_24 = 0;
            for($i=0; $i<4; $i++){
                //Shift the output to the left 6 bits
                $int_24 <<= 6;

                //Add the next 6 bits
                //Discard the leading ascii chars, i.e make
                $int_24 |= (ord($chunk[$i]) - $ascii_offset) & 0b111111;
            }

            //Here we take the 4 sets of 6 apart in 3 sets of 8
            for($i=0; $i<3; $i++) {
                $output = pack('C', $int_24) . $output;
                $int_24 >>= 8;
            }
        }

        return $output;
    }
    function decompress($input, $ascii_offset = 38) {

        $output = '';
        foreach(str_split($input, 3) as $chunk) {

            //Reassemble the 24 bit ints from 3 bytes
            $int_24 = 0;
            foreach(unpack('C*', $chunk) as $char) {
                $int_24 <<= 8;
                $int_24 |= $char & 0b11111111;
            }

            //Expand the 24 bits to 4 sets of 6, and take their character values
            for($i = 0; $i < 4; $i++) {
                $output = chr($ascii_offset + ($int_24 & 0b111111)) . $output;
                $int_24 >>= 6;
            }
        }

        //Make lowercase again and trim off the padding.
        return strtolower(rtrim($output, '='));
    }
    if ( ! function_exists('strCompress')) {
        function strCompress($str, $length = 9) {
            return gzencode($str, $length);
        }
    }
    if ( ! function_exists('strUnCompress')) {
        function strUnCompress($str,$length = 9) {
            return gzdecode($str, $length);
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
    if(!function_exists('pdfThumbnail')) {
        function pdfThumbnail($source, $target) {
            $ci = get_instance();
            $target = dirname($source).DIRECTORY_SEPARATOR.$target;
            $im     = new Imagick($source."[0]"); // 0-first page, 1-second page
            $im->setImageColorspace(255); // prevent image colors from inverting
            $im->setimageformat("jpeg");
            $im->thumbnailimage(160, 120); // width and height
            $im->writeimage($target);
            $im->clear();
            $im->destroy();
        }
    }
    if(!function_exists('getYoutubeIdFromUrl')) {
        function getYoutubeIdFromUrl($url) {
            $parts = parse_url($url);
            if(isset($parts['query'])){
                parse_str($parts['query'], $qs);
                if(isset($qs['v'])){
                    return $qs['v'];
                }else if(isset($qs['vi'])){
                    return $qs['vi'];
                }
            }
            if(isset($parts['path'])){
                $path = explode('/', trim($parts['path'], '/'));
                return $path[count($path)-1];
            }
            return false;
        }
    }
    if(!function_exists('embedUrl')) {
        function embedUrl($url) {
            $parts = parse_url($url);
            if(isset($parts['query'])){
                parse_str($parts['query'], $qs);
                if(isset($qs['v'])){
                    return "https://www.youtube.com/embed/".$qs['v'];
                }else if(isset($qs['vi'])){
                    return "https://www.youtube.com/embed/".$qs['vi'];
                }
            }
            if(isset($parts['path'])){
                $path = explode('/', trim($parts['path'], '/'));
                return "https://www.youtube.com/embed/".$path[count($path)-1];
            }
            return false;
        }
    }



}
?>