<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends BaseController {

	protected $rows;
	protected $error = array();
    private $localeKey;
    private $foreignKey;
    private $relatedModels;
    protected $selected;
    protected $id;
    public function __constructor() {
         parent::__constructor();
         //$this->getTemplate();
    }
    public function getTemplate() {
        $this->load->library('template');
        return $this->template->set_template('layout/admin');
    }
    public function setLocaleKey($localeKey) {
        $this->localeKey = $localeKey;
        return $this;
    }
    public function setForeignKey($foreignKey) {
        $this->foreignKey = $foreignKey;
        return $this;
    }
    public function destroy($modelClass, $localeKey = null, $foreignKey = null, $forceDelete = false) {
        if($localeKey) {
            $this->setLocaleKey($localeKey);
        }
        if($foreignKey) {
            $this->setForeignKey($foreignKey);
        } else {
            $this->setForeignKey($localeKey);
        }
        if($this->foreignKey) {
            $this->relatedModels = $modelClass::factory()->related_models;
        }
        if($modelClass::factory()->delete($this->localeKey, $forceDelete)) {
            if($this->relatedModels) {
                foreach($this->relatedModels as $model) {
                    $model::factory()->delete([
                        $model::factory()->foreignKey => $this->foreignKey,
                    ], $forceDelete);
                }
                return true;
            }
            return true;
        }
    }
	

}
