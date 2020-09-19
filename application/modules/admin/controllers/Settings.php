<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;


class Settings extends AdminController {

    /**
     * @var string
     */
    private $action;
    /**
     * @var array|null
     */
    private $settings;

    public function __construct() {
        parent::__construct();
        $this->template->set_template('layout/admin');
    }
    public function setData() {
        if (isset($this->settings)) {
            $this->data['id'] = $this->settings->id;
        } else {
            $this->data['id'] = '';
        }
        if (isset($this->settings)) {
            $this->data['action'] = 'edit';
        } else {
            $this->data['action'] = 'add';
        }
        if (!empty($this->input->post('company_name'))) {
            $this->data['company_name'] = $this->input->post('company_name');
        } elseif (!empty($this->settings)) {
            $this->data['company_name'] = $this->settings->company_name;
        }else {
            $this->data['company_name'] = '';
        }
        if (!empty($this->input->post('contact_person'))) {
            $this->data['contact_person'] = $this->input->post('contact_person');
        } elseif (!empty($this->settings)) {
            $this->data['contact_person'] = $this->settings->contact_person;
        } else {
            $this->data['contact_person'] = '';
        }
        if (!empty($this->input->post('address_1'))) {
            $this->data['address_1'] = $this->input->post('address_1');
        } elseif (!empty($this->settings)) {
            $this->data['address_1'] = $this->settings->address_1;
        } else {
            $this->data['address_1'] = '';
        }
        if (!empty($this->input->post('address_2'))) {
            $this->data['address_2'] = $this->input->post('address_2');
        } elseif (!empty($this->settings)) {
            $this->data['address_2'] = $this->settings->address_2;
        } else {
            $this->data['address_2'] = '';
        }
        if (!empty($this->input->post('country_id'))) {
            $this->data['country_id'] = $this->input->post('country_id');
        } elseif (!empty($this->settings)) {
            $this->data['country_id'] = $this->settings->country_id;
        } else {
            $this->data['country_id'] = '';
        }
        if (!empty($this->input->post('state_id'))) {
            $this->data['state_id'] = $this->input->post('state_id');
        } elseif (!empty($this->settings)) {
            $this->data['state_id'] = $this->settings->state_id;
        } else {
            $this->data['state_id'] = '';
        }
        if (!empty($this->input->post('city'))) {
            $this->data['city'] = $this->input->post('city');
        } elseif (!empty($this->settings)) {
            $this->data['city'] = $this->settings->city;
        } else {
            $this->data['city'] = '';
        }
        if (!empty($this->input->post('postal_code'))) {
            $this->data['postal_code'] = $this->input->post('postal_code');
        } elseif (!empty($this->settings)) {
            $this->data['postal_code'] = $this->settings->postal_code;
        } else {
            $this->data['postal_code'] = '';
        }
        if (!empty($this->input->post('email'))) {
            $this->data['email'] = $this->input->post('email');
        } elseif (!empty($this->settings)) {
            $this->data['email'] = $this->settings->email;
        } else {
            $this->data['email'] = '';
        }
        if (!empty($this->input->post('phone_1'))) {
            $this->data['phone_1'] = $this->input->post('phone_1');
        } elseif (!empty($this->settings)) {
            $this->data['phone_1'] = $this->settings->phone_1;
        } else {
            $this->data['phone_1'] = '';
        }
        if (!empty($this->input->post('phone_2'))) {
            $this->data['phone_2'] = $this->input->post('phone_2');
        } elseif (!empty($this->settings)) {
            $this->data['phone_2'] = $this->settings->phone_2;
        } else {
            $this->data['phone_2'] = '';
        }

        if (!empty($this->input->post('point'))) {
            $this->data['point'] = $this->input->post('point');
        } elseif (!empty($this->settings)) {
            $this->data['point'] = $this->settings->point;
        } else {
            $this->data['point'] = '';
        }
        if (!empty($this->input->post('logo'))) {
            $this->data['logo'] = $this->input->post('logo');
        } elseif (!empty($this->settings)) {
            $this->data['logo'] = $this->settings->logo;
        } else {
            $this->data['logo'] = '';
        }
        if (!empty($this->input->post('logo')) && is_file(DIR_IMAGE . $this->input->post('logo'))) {
            $this->data['thumb'] = $this->resize($this->input->post('logo'), 100, 100);
        } elseif (!empty($this->settings) && is_file(DIR_IMAGE . $this->settings->logo)) {
            $this->data['thumb'] = $this->resize($this->settings->logo, 100, 100);
        } else {
            $this->data['thumb'] = $this->resize('no_image.png', 100, 100);
        }

        $this->data['placeholder']  = $this->resize('no_image.png', 100, 100);
        $this->data['countries']    = Country_model::factory()->findAll();

    }
    public function index() {
        if($this->isPost()) {
            $this->action = ($this->input->post('action')) ? $this->input->post('action') : "";
            $this->id     = ($this->input->post('id')) ? $this->input->post('id') : "";

            switch ($this->action) {
                case 'add':
                    $this->setData();

                    Setting_model::factory()->insert([
                        'company_name'      => $this->data['company_name'],
                        'contact_person'    => $this->data['contact_person'],
                        'address_1'         => $this->data['address_1'],
                        'address_2'         => $this->data['address_2'],
                        'country_id '       => $this->data['country_id'],
                        'state_id '         => $this->data['state_id'],
                        'city'              => $this->data['city'],
                        'postal_code'       => $this->data['postal_code'],
                        'email'             => $this->data['email'],
                        'phone_1'           => $this->data['phone_1'],
                        'phone_2'           => $this->data['phone_2'],
                        'point'             => $this->data['point'],
                        'logo'              => $this->data['logo'],
                    ]);
                    $this->setMessage('message', 'Settings has been successfully modified');
                    redirect(admin_url('settings'));
                case 'edit':
                    $this->setData();
                    //dd($this->data);
                    Setting_model::factory()->update([
                        'company_name'      => $this->data['company_name'],
                        'contact_person'    => $this->data['contact_person'],
                        'address_1'         => $this->data['address_1'],
                        'address_2'         => $this->data['address_2'],
                        'country_id '       => $this->data['country_id'],
                        'state_id '         => $this->data['state_id'],
                        'city'              => $this->data['city'],
                        'postal_code'       => $this->data['postal_code'],
                        'email'             => $this->data['email'],
                        'phone_1'           => $this->data['phone_1'],
                        'phone_2'           => $this->data['phone_2'],
                        'point'             => $this->data['point'],
                        'logo'              => $this->data['logo'],
                    ], $this->id);
                    $this->setMessage('message', 'Settings has been successfully modified');
                    //redirect(admin_url('settings'));
            }
        }
        $this->settings = Setting_model::factory()->find()->get()->row_object();
        //dd($this->settings);
        $this->setData();
        $this->template->javascript->add('assets/js/jquery.validate.js');
        $this->template->javascript->add('assets/js/additional-methods.js');
        $this->template->javascript->add('assets/js/admin/settings/Settings.js');
        $this->template->content->view('settings/index', $this->data);
        $this->template->publish();
    }
    public function point() {
        $this->template->content->view('settings/point');
        $this->template->publish();
    }
    public function store() {}
    public function update() {}
}