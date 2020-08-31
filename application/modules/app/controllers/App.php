<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends AppController {

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

    public function index()
	{

        $categories = Category_model::factory()->find()->where('status', 1)->order_by('id', 'asc')->limit(4)->get()->result_object();

        if($categories) {
            foreach ($categories as $category) {
                $this->categoryDescription  = CategoryDescription_model::factory()->findOne(['category_id' => $category->id]);

                if (is_file(DIR_IMAGE . $this->categoryDescription->image)) {
                    $this->image = $this->resize($this->categoryDescription->image, 534, 205);
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

        // Features product
        $this->featuresProduct = FeaturesProduct_model::factory()->find()->limit(4)->get()->result_object();
        if($this->featuresProduct) {
            foreach ($this->featuresProduct as $featureProduct) {
                $this->product              = Product_model::factory()->findOne($featureProduct->product_id);

                if (is_file(DIR_IMAGE . $this->product->productImages()->image)) {
                    $this->image = $this->resize($this->product->productImages()->image, 255, 325);
                } else {
                    $this->image = $this->resize('no_image.png', 255, 325);
                }

                $this->data['featuresProduct'][] = array(
                    'id'            => $this->product->id,
                    'name'          => $this->product->name,
                    'slug'          => $this->product->slug,
                    'description'   => $this->product->productDescription()->description,
                    'img'           => $this->image,
                    'video'         => $this->product->productVideos()->url,
                    'pdf'           => $this->product->productPdf()->pdf,
                );

//                $this->productDescription   = ProductDescription_model::factory()->findOne($featureProduct->product_id);
//                $this->productImages        = ProductImages_model::factory()->findOne($featureProduct->product_id);
//                $this->productVideos        = ProductVideos_model::factory()->findOne($featureProduct->product_id);
//                $this->productPdfs          = Productpdf_model::factory()->findOne($featureProduct->product_id);

            }
        }


        //dd($this->data['featuresProduct']);

		$this->template->set_template('layout/app');
		$this->template->content->view('index', $this->data);
		$this->template->publish();
	}

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


}