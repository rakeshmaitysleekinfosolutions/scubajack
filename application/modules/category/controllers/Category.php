<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends AppController {

    /**
     * @var object
     */
    private $categoryDescription;
    /**
     * @var string|void
     */
    private $image;

    private $products;
    private $category;
    private $product;

    public function index() {
		$this->template->set_template('layout/app');
		$this->template->content->view('index', $this->data);
		$this->template->publish();
	}
    public function show($slug) {
        /*
        $this->data['slug'] = $slug;
        $this->category = Category_model::factory()->find()->where('slug', $slug)->get()->row_object();
        if($this->category) {
            $this->products = CategoryToProduct_model::factory()->findAll(['category_id' => $this->category->id]);
        }
        if($this->products) {
            foreach ($this->products as $product) {
                $this->product = Product_model::factory()->findOne($product->product_id);
                $this->product = Product_model::factory()->findOne($product->product_id);
               // $this->dd($this->product);
                $this->data['products'][] = array(
                    'id' => $this->product->id,
                    'name' => $this->product->name,
                    'slug' => $this->product->slug
                );
            }
        }
        dd($this->data['products']);
        */
//        $this->data['slug'] = $slug;
//        $this->category = Category_model::factory()->find()->where('slug', $slug)->get()->row_object();

        $this->template->set_template('layout/app');
        $this->template->content->view('category/index');
        $this->template->publish();
    }


}