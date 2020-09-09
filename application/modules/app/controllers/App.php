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
    /**
     * @var object
     */
    private $plan;
    private $slug;
    /**
     * @var Paypal
     */
    private $paypal;

    public function __construct()
    {
        parent::__construct();
        $this->template->set_template('layout/app');
        $this->paypal = new Paypal();
        //$this->paypal->setApiContext($this->config->item('CLIENT_ID'),$this->config->item('CLIENT_SECRET'));

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
     * Home page features products and activity books
     * @throws Exception
     */
    public function index2() {


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
        $this->template->content->view('static', $this->data);
        $this->template->publish();
    }

    /**
     * List of all product category
     */
    public function category() {
        $this->getCategoryArray(null,'sort_order');
        $this->template->content->view('category/index', $this->data);
        $this->template->publish();
    }
    /**
     * @param $categorySlug
     */
    public function products($categorySlug) {
        if(!$this->isSubscribed()) redirect('viewplans');

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
     * View Plans
     */
    public function viewPlans() {
        $this->data['plans'] = Membershipplan_model::factory()->findAll();
        $this->template->content->view('plans/index', $this->data);
        $this->template->publish();
    }

    /**
     * View Plan
     * @param $slug
     */
    public function account($slug) {

        if($slug) $this->slug = $slug;

        $this->plan = Membershipplan_model::factory()->findOne(['slug' => $this->slug]);

        if(!$this->plan) {
            redirect('viewplans');
        }
        if($this->plan) {
            $this->data['plan'] = $this->plan;
        }
        if ($this->user->isLogged()) {
            redirect('plan/billing/'.$this->plan->slug);
        }
        if($this->isPost()) {
            $this->planId     = ($this->input->post('planId')) ? $this->input->post('planId') : '';

            User_model::factory()->addUser($this->input->post());
            // Clear any previous login attempts for unregistered accounts.
            User_model::factory()->deleteLoginAttempts($this->input->post('email'));
            // Login
            User_model::factory()->login($this->input->post('email'), $this->input->post('password'));
            redirect('plan/'.$this->plan->slug.'/billing');
        }
        //$this->dd($this->data);
        $this->template->javascript->add('assets/js/jquery.validate.js');
        $this->template->javascript->add('assets/js/additional-methods.js');
        $this->template->javascript->add('assets/js/plans/Account.js');
        $this->template->content->view('plans/account', $this->data);
        $this->template->publish();
    }
    /**
     * View Plan
     * @param $slug
     */
    public function createAccount() {

        $this->slug     = ($this->input->post('slug')) ? $this->input->post('slug') : '';

        $this->plan = Membershipplan_model::factory()->findOne(['slug' => $this->slug]);

        if(!$this->plan) {
            $this->json['redirect'] 		= url('viewplans');;
        }
        if($this->plan) {
            $this->data['plan'] = $this->plan;
        }

        $this->lang->load('app/emails/register_lang');
        $this->lang->load('app/register_lang');

        if (User_model::factory()->getTotalUsersByEmail($this->input->post('email'))) {
            $this->json['error']['warning'] = $this->lang->line('error_exists');
        }
        if($this->isPost() ) {
            User_model::factory()->addUser($this->input->post());
            // Clear any previous login attempts for unregistered accounts.
            User_model::factory()->deleteLoginAttempts($this->input->post('email'));
            // Login
            $this->user->login($this->input->post('email'), $this->input->post('password'));
            /*
            $subject 						= sprintf($this->lang->line('text_subject'), "SCUBA JACK");

            $this->data['text_welcome'] 	= sprintf($this->lang->line('text_welcome'), "SCUBA JACK");

            $this->data['text_email'] 		= sprintf($this->lang->line('text_email'), $this->input->post('email'));
            $this->data['text_password'] 	= sprintf($this->lang->line('text_password'), $this->input->post('password'));

            $this->data['text_app_name'] 	= "SCUBA JACK";
            $this->data['text_service'] 	= $this->lang->line('text_service');
            $this->data['text_thanks'] 		= $this->lang->line('text_thanks');

            $mail 							= new Mail($this->config->item('config_mail_engine'));
            $mail->parameter 				= $this->config->item('config_mail_parameter');
            $mail->smtp_hostname 			= $this->config->item('config_mail_smtp_hostname');
            $mail->smtp_username 			= $this->config->item('config_mail_smtp_username');
            $mail->smtp_password 			= html_entity_decode($this->config->item('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port 				= $this->config->item('config_mail_smtp_port');
            $mail->smtp_timeout 			= $this->config->item('config_mail_smtp_timeout');

            $mail->setTo($this->input->post('email'));
            $mail->setFrom($this->config->item('config_email'));
            $mail->setSender($this->config->item('config_sender_name'));
            $mail->setSubject($subject);
            $mail->setText($this->template->content->view('emails/registration', $this->data));
            $mail->send();
            */
            $this->json['success']          = $this->lang->line('text_success');
            $this->json['redirect'] 		= url('plan/'.$this->plan->slug.'/billing');;
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->json));
        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->json));
        }
    }

    /**
     * Billing
     * @param $slug
     */
    public function billing($slug) {

        if($slug) $this->slug = $slug;

        $this->plan = Membershipplan_model::factory()->findOne(['slug' => $this->slug]);

        if($this->plan) {
            $this->data['plan'] = $this->plan;
        }
        $this->template->javascript->add('assets/js/plans/PayPal.js');
        $this->template->content->view('plans/billing', $this->data);
        $this->template->publish();
    }
    public function setSubscriptionPlan() {
        $this->slug     = ($this->input->post('slug')) ? $this->input->post('slug') : '';
        $this->plan     = Membershipplan_model::factory()->findOne(['slug' => $this->slug]);
        if($this->plan) return $this->plan;
    }

    public function processToPayPal() {
        if($this->isPost() && $this->isAjaxRequest()) {
            try {
                $planId     = ($this->input->post('planId')) ? $this->input->post('planId') : '';
                if($planId) {
                    $this->plan = Membershipplan_model::factory()->findOne(['paypal_plan_id' => $planId]);
                }
                if($this->plan) {
                    // Set Plan Id
                    $this->paypal
                        ->setPlanId($this->plan->paypal_plan_id)
                        ->setPlanName($this->plan->name)
                        ->setPlanDescription($this->plan->name);

                    $this->paypal->agreement();
                    $this->json['redirect'] = $this->paypal->agreement->getApprovalLink();
                }
            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                $this->json['code'] = $ex->getCode();
                $this->json['data'] = $ex->getData();
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));
            } catch (Exception $ex) {
                die($ex);
            }
        }
    }
    public function subscribeReturnUrl() {
        if (!empty($this->input->get('status'))) {
            if($this->input->get('status') == "success") {
                $token = $this->input->get('token');
                try {
                    // Execute agreement
                    $this->paypal->agreement->execute($token, $this->paypal->getApiContext());
                } catch (PayPal\Exception\PayPalConnectionException $ex) {
                    echo $ex->getCode();
                    echo $ex->getData();
                    die($ex);
                } catch (Exception $ex) {
                    die($ex);
                }
            } else {
                echo "user canceled agreement";
            }
            exit;
        }
    }
    /**
     * Membership plan subscribe
     */
    public function explore() {
        $this->template->content->view('country/index');
        $this->template->publish();
    }
     /**
     * Membership plan subscribe
     */
    public function about() {

        $this->template->content->view('information/about');
        $this->template->publish();
    }
    public function getPlans() {
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($this->paypal->getAllPlan()));
    }


}