<?php
class ControllerAutoloader {
    static public function loader($className) {
        $filename = APPPATH . "controllers/" . str_replace("\\", '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
class LibraryAutoloader {
    static public function loader($className) {
        $filename = APPPATH . "libraries/" . str_replace("\\", '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
class ConfigAutoloader {
    static public function loader($className) {
        $filename = APPPATH . "config/" . str_replace("\\", '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
class ModelAutoloader {
    static public function loader($className) {
        $filename = APPPATH . "models/" . str_replace("\\", '/', $className) . ".php";
       // echo $filename;
       // exit;
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
class HelperAutoloader {
    static public function loader($className) {
        $filename = APPPATH . "helpers/" . str_replace("\\", '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
spl_autoload_register('ControllerAutoloader::loader');
spl_autoload_register('LibraryAutoloader::loader');
spl_autoload_register('ModelAutoloader::loader');
spl_autoload_register('ConfigAutoloader::loader');
spl_autoload_register('HelperAutoloader::loader');


//require_once FCPATH.'/vendor/autoload.php';


//require_once 'PHPExcel/Classes/IOFactory.php';
//require_once FCPATH.'/application/libraries/PHPExcel/Classes/PHPExcel.php';