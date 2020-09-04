<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends AppController {

    private $limit;
    private $categorySlug;
    /**
     * @var object
     */
    private $categoryId;
    /**
     * @var array|int
     */
    private $categoryToProducts;
    /**
     * @var object
     */
    private $category;
    private $productModelInstances;
    private $products;
    private $var = 'products';
    private $orderBy;

    public function __construct()
    {
        parent::__construct();
        $this->template->set_template('layout/app');
    }

    /**
     * @var object
     */
    private $categoryDescription;
    /**
     * @var string|void
     */
    private $image;
    /**
     * @var object
     */
    private $product;
    /**
     * @var array|object[]
     */
    private $featuresProduct;
    /**
     * @var object
     */
    private $productPdfs;
    /**
     * @var object
     */
    private $productImages;
    /**
     * @var object
     */
    private $productDescription;
    /**
     * @var object
     */
    private $productVideos;

    /**
     * @param $productModelInstance
     * @param null $limit
     * @param null $var
     */
    private function formatProductModelInstanceToArray($productModelInstance, $limit = null, $var = null) {
        if($limit) $this->limit = $limit;
        if($var) $this->var = $var;
        if($productModelInstance) $this->productModelInstances = $productModelInstance;

        if($this->productModelInstances) {
            foreach ($this->productModelInstances as $productModelInstance) {
                if (is_file(DIR_IMAGE . $productModelInstance->product->images->image)) {
                    $this->image = $this->resize($productModelInstance->product->images->image, 255, 325);
                } else {
                    $this->image = $this->resize('no_image.png', 255, 325);
                }
               // dd($productModelInstance->product->categoryToProduct->category);
                $this->data[$this->var][] = array(
                    'id'            => $productModelInstance->product->id,
                    'name'          => $productModelInstance->product->name,
                    'slug'          => $productModelInstance->product->slug,
                    'description'   => ($productModelInstance->product->description) ? $productModelInstance->product->description->description : "",
                    'img'           => $this->image,
                    'video'         => ($productModelInstance->product->videos) ? $productModelInstance->product->videos->url : "",
                    'pdf'           => ($productModelInstance->product->pdf) ? $productModelInstance->product->pdf->pdf : "",
                    'quiz'          => ($productModelInstance->product->quiz) ? base_url('quiz/'.$productModelInstance->product->quiz->slug) : "",
                    'category'      => array(
                        'name'        => $productModelInstance->product->categoryToProduct->category->name,
                        'description' => $productModelInstance->product->categoryToProduct->category->description->description
                    )
                );
            }
        }
    }

    /**
     * @param null $limit
     * @param null $orderBy
     * @throws Exception
     */
    private function getCategoryArray($limit = null, $orderBy = null) {
        if($limit) $this->limit = $limit;
        if($orderBy) $this->orderBy = $orderBy;
        $categories = Category_model::factory()->findAll([],$limit,$this->orderBy);
        //$this->dd($categories);
        if($categories) {
            foreach ($categories as $category) {
                //$this->dd($category);
                if (is_file(DIR_IMAGE . $category->description->image)) {
                    $this->image = $this->resize($category->description->image, 534, 205);
                } else {
                    $this->image = $this->resize('no_image.png', 534, 205);
                }

                $this->data['categories'][] = array(
                    'id'    => $category->id,
                    'name'  => $category->name,
                    'slug'  => $category->slug,
                    'img'   => $this->image,
                );
            }
        }
    }

    /**
     * Home page features products and activity books
     * @throws Exception
     */
    public function index() {
        $this->getCategoryArray(4, 'sort_order');
        // Features Product
        $this->formatProductModelInstanceToArray(FeaturesProduct_model::factory()->findAll(),4);
        // Activity Books
        //$this->formatProductModelInstanceToArray(FeaturesProduct_model::factory()->findAll(),4, 'activityBooks');
        //dd($this->data['activityBooks']);
        $this->data['maps'] = Map_model::factory()->findAll(['status' => 1]);
        //dd($this->data['maps']);
        $this->template->stylesheet->add('assets/css/magnific-popup.min.css');
        $this->template->javascript->add('assets/js/jquery.magnific-popup.min.js');
		$this->template->content->view('index', $this->data);
		$this->template->publish();
	}

    /**
     * List of all product category
     */
    public function category() {
        $this->getCategoryArray();
        $this->template->content->view('category/index', $this->data);
        $this->template->publish();
    }
    /**
     * @param $categorySlug
     */
    public function products($categorySlug) {
        if($categorySlug)               $this->categorySlug         = $categorySlug;
        if($this->categorySlug)         $this->category             = Category_model::factory()->findOne(['slug' => $this->categorySlug,'status' => 1]);
        $this->data['category'] = array();
        if($this->category) {
            $this->categoryToProducts   = $this->category->products;
            $this->data['category'] = array(
                'name'        => $this->category->name,
                'description' => $this->category->description->description
            );
        }

        $this->formatProductModelInstanceToArray($this->categoryToProducts);
        $this->template->stylesheet->add('assets/css/magnific-popup.min.css');
        $this->template->javascript->add('assets/js/jquery.magnific-popup.min.js');
        $this->template->content->view('product/index', $this->data);
        $this->template->publish();
    }

    /**
     * splash screen
     * @return mixed
     */
	public function setSplashScreen() {
        if($this->isAjaxRequest() && $this->isPost()) {
            $this->setSession('splashscreen',1);
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('status' => true)));
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array('status' => false)));
    }
    /**
     * Membership plan subscribe
     */
    public function subscribe() {
        if($this->isPost()) {

        }

        $this->data['plans'] = Membershipplan_model::factory()->findAll();
        $this->template->content->view('subscribe/index', $this->data);
        $this->template->publish();
    }
}