<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;

class countryDescriptionBlogImage extends AdminController{


    private $countryDescription;
    /**
     * @var object
     */
    private $countryDescriptionBlogImage;
    private $blogId;

    public function __construct() {
        parent::__construct();
        $this->lang->load('admin/countrydescription');
        $this->template->set_template('layout/admin');
    }


    public function index($blogId) {
        $this->template->stylesheet->add('assets/theme/light/js/datatables/dataTables.bootstrap4.css');
        $this->template->javascript->add('assets/theme/light/js/datatables/jquery.dataTables.min.js');
        $this->template->javascript->add('assets/theme/light/js/datatables/dataTables.bootstrap4.min.js');
        $this->template->javascript->add('assets/js/admin/countrydescriptionblogimage/CountryDescriptionBlogImage.js');

        $this->template->content->view('countrydescriptionblogimage/index');
        $this->template->publish();
    }

    /**
     *
     */
    public function setData() {
        // Country Description Blog
        if (isset($this->countryDescriptionBlogImage)) {
            $this->data['primaryKey'] = $this->countryDescriptionBlogImage->id;
        } else {
            $this->data['primaryKey'] = '';
        }
        if (!empty($this->input->post('title'))) {
            $this->data['title'] = $this->input->post('title');
        } elseif(!empty($this->countryDescriptionBlogImage)) {
            $this->data['title'] = $this->countryDescriptionBlogImage->title;
        } else {
            $this->data['title'] = '';
        }
        // Images
        if (!empty($this->input->post('images'))) {
            $images = $this->input->post('images');
        } elseif (!empty($this->questionImages)) {
            $images = $this->questionImages;
        } else {
            $images = array();
        }
        $this->data['images'] = array();

        foreach ($images as $image) {
            if (is_file(DIR_IMAGE . $image->image)) {
                $image = $image->image;
                $thumb = $image->image;
            } else {
                $image = '';
                $thumb = 'no_image.png';
            }

            $this->data['images'][] = array(
                'image'      => $image,
                'thumb'      => $this->resize($thumb, 100, 100)
            );
        }

        $this->data['placeholder'] = $this->resize('no_image.png', 100, 100);
    }
    /*
     *
     */
    public function create($blogId) {
        $this->template->javascript->add('assets/js/jquery.validate.js');
        $this->template->javascript->add('assets/js/additional-methods.js');
        $this->template->javascript->add('assets/js/admin/countrydescriptionblogimage/CountryDescriptionBlogImage.js');
        $this->setData();
        $this->data['back'] = admin_url('countrydescriptionblogimage/index/'.$blogId);
        $this->template->content->view('countrydescriptionblogimage/create', $this->data);
        $this->template->publish();
    }

    public function store() {
        try {
            if ($this->isPost()) {
                $this->setData();
                CountryDescriptionBlogImage_model::factory()->insert([
                    'title'             => $this->data['title'],
                ]);
                $this->setId(Question_model::factory()->getLastInsertID());
                if(isset($this->data['images'])) {
                    foreach ($this->data['images'] as $image) {
                        CountryDescriptionBlogImage_model::factory()->update([
                            'image' => $image,
                        ], $this->id);
                    }
                }
                $this->setMessage('message', $this->lang->line('text_success'));
                $this->redirect(admin_url('countrydescriptionblogimage/create/'));
            }
            $this->create();
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }

    public function edit($id) {
        try {
            $this->countryDescriptionBlogImage = CountryDescriptionBlogImage_model::factory()->findOne($id);
            if(!$this->countryDescriptionBlogImage) {
                $this->setMessage('warning', $this->lang->line('text_notfound'));
                $this->redirect(admin_url('countrydescriptionblogimage/'.$id));
            }
            $this->template->javascript->add('assets/js/jquery.validate.js');
            $this->template->javascript->add('assets/js/additional-methods.js');
            $this->template->javascript->add('assets/js/admin/countrydescriptionblogimage/CountryDescriptionBlogImage.js');
            $this->setData();
            $this->template->content->view('countrydescriptionblogimage/edit', $this->data);
            $this->template->publish();
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function update($id) {
        try {
            $this->setData();
            if ($this->isPost()) {
                CountryDescriptionBlogImage_model::factory()->update([
                    'country_id'        => $this->data['countryId'],
                    'title'             => $this->data['title'],
                    'description'       => $this->data['description'],
                    'image'             => $this->data['image'],
                ], $id);

                $this->setMessage('message', $this->lang->line('text_success'));
                $this->redirect(admin_url('countrydescription/edit/'.$id));
            }
            $this->edit($id);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }

    public function delete() {
        try {
            if($this->isAjaxRequest()) {
                $this->request = $this->input->post();

                if(!empty($this->request['selected']) && isset($this->request['selected'])) {
                    if(array_key_exists('selected', $this->request) && is_array($this->request['selected'])) {
                        $this->selected = $this->request['selected'];
                    }
                }
                if($this->selected) {
                    foreach ($this->selected as $id) {
                        CountryDescriptionBlogImage_model::factory()->delete($id);
                    }
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array('data' => $this->onLoadDatatableEventHandler(), 'status' => true,'message' => 'Record has been successfully deleted')));
                }
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array('data' => $this->onLoadDatatableEventHandler(), 'status' => false, 'message' => 'Sorry! we could not delete this record')));

            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function onLoadDatatableEventHandler() {

        $this->results = CountryDescriptionBlogImage_model::factory()->findAll();
        if($this->results) {
            foreach($this->results as $result) {
                if (is_file(DIR_IMAGE . $result->image)) {
                    $image = $this->resize($result->image, 40, 40);
                } else {
                    $image = $this->resize('no_image.png', 40, 40);
                }
                $this->rows[] = array(
                    'id'			=> $result->id,
                    'country'		=> $result->country->name,
                    'title'		    => $result->title,
                    'countBlogs'    => count($result->blogs),
                    'img'		    => $image,
                    'created_at'    => Carbon::createFromTimeStamp(strtotime($result->created_at))->diffForHumans(),
                    'updated_at'    => ($result->updated_at) ? Carbon::createFromTimeStamp(strtotime($result->updated_at))->diffForHumans() : ''
                );
            }
            $i = 0;
            foreach($this->rows as $row) {

                $this->data[$i][] = '<td class="text-center">
											<label class="css-control css-control-primary css-checkbox">
												<input data-id="'.$row['id'].'" type="checkbox" class="css-control-input selectCheckbox" id="row_'.$row['id'].'" name="row_'.$row['id'].'">
												<span class="css-control-indicator"></span>
											</label>
										</td>';
                $this->data[$i][] = '<td><img src="'.$row['img'].'"></td>';
                $this->data[$i][] = '<td>'.$row['title'].'</td>';
                $this->data[$i][] = '<td>'.$row['country'].'</td>';
                $this->data[$i][] = '<td>'.$row['created_at'].'</td>';
                $this->data[$i][] = '<td>'.$row['updated_at'].'</td>';
                $this->data[$i][] = '<td class="text-right">
	                            <div class="dropdown">
	                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
	                                <ul class="dropdown-menu pull-right">
	                                    <li><a class="edit" href="javascript:void(0);" data-id="'.$row['id'].'" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
	                                    <li><a class="blog" href="javascript:void(0);" data-id="'.$row['id'].'" data-toggle="modal" data-target="#edit_client"><i class="fab fa-blogger"></i> Blog('.$row['countBlogs'].')</a></li>
	                                    
	                                </ul>
	                            </div>
	                        </td>
                        ';
                $i++;
            }


        }
//        <li><a class="delete" href="javascript:void(0);" data-id="'.$row['id'].'" data-toggle="modal" data-target="#delete_client"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
        if($this->data) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('data' => $this->data)));
        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('data' => [])));
        }
    }

    public function onChangeStatusEventHandler() {
        try {
            if($this->isAjaxRequest()) {
                $this->id       = ($this->input->post('id')) ? $this->input->post('id') : '';
                $this->status   = ($this->input->post('status')) ? $this->input->post('status') : '';
                Quiz_model::factory()->update([
                    'status' => $this->status,
                ], $this->id);
                $this->json['status'] = 'Status has been successfully updated';
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }
    public function validateForm()
    {
        // TODO: Implement validateForm() method.
        if ((strlen($this->input->post('question')) < 1) || (strlen(trim($this->input->post('question'))) > 255)) {
            $this->error['question'] = $this->lang->line('error_question');
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->lang->line('error_warning');
        }
        //$this->dd($this->error);
        return !$this->error;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function fetchBlog($id) {
        $this->results = countryDescriptionBlogImage_model::factory()->findAll(['country_descriptions_id' => $id]);
        if($this->results) {
            foreach($this->results as $result) {
                if (is_file(DIR_IMAGE . $result->image)) {
                    $image = $this->resize($result->image, 40, 40);
                } else {
                    $image = $this->resize('no_image.png', 40, 40);
                }
                $this->rows[] = array(
                    'id'			=> $result->id,
                    'country_descriptions_id'			=> $result->country_descriptions_id,
                    'title'		    => $result->title,
                    'img'		    => $image,
                    'created_at'    => Carbon::createFromTimeStamp(strtotime($result->created_at))->diffForHumans(),
                    'updated_at'    => ($result->updated_at) ? Carbon::createFromTimeStamp(strtotime($result->updated_at))->diffForHumans() : ''
                );
            }
            $i = 0;
            foreach($this->rows as $row) {

                $this->data[$i][] = '<td class="text-center">
											<label class="css-control css-control-primary css-checkbox">
												<input data-id="'.$row['id'].'" type="checkbox" class="css-control-input selectCheckbox" id="row_'.$row['id'].'" name="row_'.$row['id'].'">
												<span class="css-control-indicator"></span>
											</label>
										</td>';
                $this->data[$i][] = '<td><img src="'.$row['img'].'"></td>';
                $this->data[$i][] = '<td>'.$row['title'].'</td>';
                $this->data[$i][] = '<td>'.$row['created_at'].'</td>';
                $this->data[$i][] = '<td>'.$row['updated_at'].'</td>';
                $this->data[$i][] = '<td class="text-right">
	                            <div class="dropdown">
	                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
	                                <ul class="dropdown-menu pull-right">
	                                    <li><a class="edit" href="javascript:void(0);" data-id="'.$row['id'].'" data-country_descriptions_id="'.$row['country_descriptions_id'].'" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
	                                    <li><a class="edit" href="'.base_url('countrydescription/blogimages/'.$row['id']).'" ><i class="fa fa-pencil m-r-5"></i> Images</a></li>
	                                </ul>
	                            </div>
	                        </td>
                        ';
                $i++;
            }
        }
        if($this->data) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('data' => $this->data)));
        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('data' => [])));
        }
    }

    /**
     * @param $id
     */
    public function getCountryDescription($id) {
        $this->blogId = $id;
        $this->countryDescription   = CountryDescriptionBlogImage_model::factory()->findOne($this->blogId);
    }

    /**
     *
     */


    /**
     * @param $blogId
     */
    public function blog($blogId) {
        $this->getCountryDescription($blogId);
        if($this->countryDescription) {
            $this->data['countryDescUrl']       = admin_url('countrydescription');
            $this->data['fetchBlogUrl']         = admin_url('countrydescription/fetchBlog/'.$this->blogId);
            $this->data['editBlogUrl']          = admin_url('countrydescription/editblog/');
            $this->data['createBlogUrl']        = admin_url('countrydescription/createblog/'.$this->blogId);
            $this->data['saveBlogUrl']          = admin_url('countrydescription/storeblog/'.$this->blogId);
            $this->data['backBlogUrl']          = admin_url('countrydescription/blog/'.$this->blogId);
        }
        if(!$this->countryDescription) {
            $this->redirect($this->data['countryDescUrl']);
        }
        $this->template->stylesheet->add('assets/theme/light/js/datatables/dataTables.bootstrap4.css');
        $this->template->javascript->add('assets/theme/light/js/datatables/jquery.dataTables.min.js');
        $this->template->javascript->add('assets/theme/light/js/datatables/dataTables.bootstrap4.min.js');
        $this->template->javascript->add('assets/js/admin/countrydescription/Blog.js');

        $this->template->content->view('countrydescription/blog/index', $this->data);
        $this->template->publish();
    }

    /**
     * @param $blogId
     */
    public function createBlog($blogId) {
        $this->getCountryDescription($blogId);
        if($this->countryDescription) {
            $this->data['saveBlogUrl']          = admin_url('countrydescription/storeblog/'.$this->blogId);
            $this->data['backBlogUrl']          = admin_url('countrydescription/blog/'.$this->blogId);
        }
        $this->setData();

        if(!$this->countryDescription) {
            $this->redirect($this->data['countryDescUrl']);
        }
        $this->template->javascript->add('assets/js/jquery.validate.js');
        $this->template->javascript->add('assets/js/additional-methods.js');
        $this->template->javascript->add('assets/js/admin/countrydescription/Blog.js');

        $this->template->content->view('countrydescription/blog/create', $this->data);
        $this->template->publish();
    }

    /**
     * @param $blogId
     */
    public function storeBlog($blogId) {
        try {
            if ($this->isPost()) {
                $this->getCountryDescription($blogId);
                $this->setData();
                countryDescriptionBlogImage_model::factory()->insert([
                    'country_descriptions_id '        => $this->blogId,
                    'title'             => $this->data['title'],
                    'slug'             => $this->data['slug'],
                    'description'       => $this->data['description'],
                    'small_description'       => $this->data['smallDescription'],
                    'image'             => $this->data['image'],
                ]);
                $this->setMessage('message', $this->lang->line('text_success'));
                $this->data['createBlogUrl']        = admin_url('countrydescription/createblog/'.$this->blogId);
                $this->redirect($this->data['createBlogUrl']);
            }
            $this->createBlog($this->countryDescription->id);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }

    public function editBlog($id, $blogId) {
        try {
            $this->getCountryDescription($blogId);
            $this->countryDescriptionBlogImage = countryDescriptionBlogImage_model::factory()->findOne($id);
            $this->setData();
            $this->template->javascript->add('assets/js/jquery.validate.js');
            $this->template->javascript->add('assets/js/additional-methods.js');
            $this->template->javascript->add('assets/js/admin/countrydescription/Blog.js');

            $this->data['backBlogUrl']          = admin_url('countrydescription/blog/'.$this->blogId);
            $this->data['updateBlogUrl']          = admin_url('countrydescription/updateblog/'.$id.'/'.$this->blogId);

            $this->template->content->view('countrydescription/blog/edit', $this->data);
            $this->template->publish();
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function updateBlog($id, $blogId) {
        try {
            $this->getCountryDescription($blogId);
            $this->data['backBlogUrl'] = admin_url('countrydescription/blog/'.$this->blogId);
            $this->data['editBlogUrl'] = admin_url('countrydescription/editblog/'.$id.'/'.$this->blogId);
            $this->setData();
            if ($this->isPost()) {
                countryDescriptionBlogImage_model::factory()->update([
                    'country_descriptions_id '        => $this->blogId,
                    'title'             => $this->data['title'],
                    'slug'             => $this->data['slug'],
                    'description'       => $this->data['description'],
                    'small_description'       => $this->data['smallDescription'],
                    'image'             => $this->data['image'],
                ], $id);
                $this->setMessage('message', $this->lang->line('text_success'));
                $this->redirect($this->data['editBlogUrl']);
            }
            $this->editBlog($id, $blogId);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }

    public function deleteBlog() {
        try {
            if($this->isAjaxRequest()) {
                $this->request = $this->input->post();

                if(!empty($this->request['selected']) && isset($this->request['selected'])) {
                    if(array_key_exists('selected', $this->request) && is_array($this->request['selected'])) {
                        $this->selected = $this->request['selected'];
                    }
                }
                if($this->selected) {
                    foreach ($this->selected as $id) {
                        countryDescriptionBlogImage_model::factory()->delete($id);
                    }
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array('data' => $this->onLoadDatatableEventHandler(), 'status' => true,'message' => 'Record has been successfully deleted')));
                }
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array('data' => $this->onLoadDatatableEventHandler(), 'status' => false, 'message' => 'Sorry! we could not delete this record')));

            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}