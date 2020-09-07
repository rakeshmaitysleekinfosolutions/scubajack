<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppController extends BaseController {

    private $csrfArray;
    public function __constructor() {

         parent::__constructor();


         $this->csrfArray =  array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
        );

    }
    public  function __token() {
        return (isset($this->csrfArray['name'])) ? $this->csrfArray['name'] : '';
    }
    public	function csrf_token() {
        return (isset($this->csrfArray['hash'])) ? $this->csrfArray['hash'] : '';
    }

    public function isSubscribed() {
        if($this->hasSession('subscribe')) {
            return true;
        }
        return false;
    }


}
