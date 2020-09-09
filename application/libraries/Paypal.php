<?php
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\ShippingAddress;
use PayPal\Exception\PayPalConnectionException;
/**
 * Class PaymentDefinition
 *
 * Resource representing payment definition scheduling information.
 *
 * @package PayPal\Api
 *
 * @property string name
 * @property string type
 * @property string frequency_interval
 * @property string frequency
 * @property string cycles
 * @property \PayPal\Api\Currency amount
 */
class Paypal {
    public $plan;
    public $paymentDefinition;
    /**
     * @var MerchantPreferences
     */
    public $MerchantPreferences;
    /**
     * @var ChargeModel
     */
    public $chargeModel;
    /**
     * @var Patch
     */
    public $patch;
    /**
     * @var PayPalModel
     */
    public $payPalModel;
    /**
     * @var PatchRequest
     */
    public $patchRequest;
    /**
     * @var PayPalConnectionException
     */
    public $payPalConnectionException;
    /**
     * @var Payer
     */
    public $payer;
    /**
     * @var ShippingAddress
     */
    public $shippingAddress;
    /**
     * @var Agreement
     */
    public $agreement;
    /**
     * @var ApiContext
     */
    public $apiContext;
    /**
     * @var MerchantPreferences
     */
    public $merchantPreferences;
    /**
     * @var Currency
     */
    public $currency;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $paymentDefinitionName;
    /**
     * @var string
     */
    private $paymentDefinitionType;
    private $frequencyInterval;
    /**
     * @var string
     */
    private $chargeModelType;

    private $jsonArray = array();
    private $planName;
    private $planDescription;
    private $state;
    /**
     * @var string
     */
    private $planId;
    /**
     * @var Plan
     */
    private $patchedPlan;
    private $date;

    public function __construct() {
        $this->plan                         = new Plan();
        $this->paymentDefinition            = new PaymentDefinition();
        $this->chargeModel                  = new ChargeModel();
        $this->merchantPreferences          = new MerchantPreferences();
        $this->patch                        = new Patch();
        $this->payPalModel                  = new PayPalModel();
        $this->patchRequest                 = new PatchRequest();
        $this->payer                        = new Payer();
        $this->shippingAddress              = new ShippingAddress();
        $this->agreement                    = new Agreement();
        $this->apiContext                   = new ApiContext();
        $this->currency                     = new Currency();
//        $this->apiContext = new ApiContext(
//            new \PayPal\Auth\OAuthTokenCredential(
//                $this->config->item('CLIENT_ID'),
//                $this->config->item('CLIENT_SECRET')
//            )
//        );
    }
    public static function factory() {
        return new Paypal();
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
        return $this;
    }
    public function setApiContext($clientId, $clientSecret) {
        $this->apiContext = new ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );
        return $this;
    }
    public function setPaymentModel($str) {
        $this->payPalModel = $str;
        return $this;
    }
    public function getPlan() {
        return $this->plan;
    }
    public function getPaymentDefinition() {
        return $this->paymentDefinition;
    }
    public function getChargeModel() {
        return $this->chargeModel;
    }
    public function getMerchantPreferences() {
        return $this->merchantPreferences;
    }
    public function getPatch() {
        return $this->patch;
    }
    public function getPyPalModel() {
        return $this->payPalModel;
    }
    public function getPatchRequest() {
        return $this->patchRequest;
    }
    public function getPayer() {
        return $this->payer;
    }
    public function getShippingAddress() {
        return $this->shippingAddress;
    }
    public function getAgreement() {
        return $this->agreement;
    }
    public function getApiContext() {
        return $this->apiContext;
    }
    public function getCurrency() {
        return $this->currency;
    }
    /**
     * Name of the billing plan. 128 characters max.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setPlanName($planName) {
        $this->planName = $planName;
        return $this;
    }
    /**
     * Name of the billing plan. 128 characters max.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setPlanDescription($planDescription) {
        $this->planDescription = $planDescription;
        return $this;
    }
    /**
     * Name of the billing plan. 128 characters max.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setPlanId($planId) {
        $this->planId = $planId;
        return $this;
    }
    /**
     * Name of the billing plan. 128 characters max.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    /**
     * Name of the payment definition. 128 characters max.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setPaymentDefinitionName($name) {
        $this->paymentDefinitionName = $name;
        return $this;
    }
    /**
     * Type of the payment definition. Allowed values: `TRIAL`, `REGULAR`.
     *
     * @param string $type
     *
     * @return $this
     */
    public function setPaymentDefinitionType($type) {
        $this->paymentDefinitionType = $type;
        return $this;
    }
    /**
     * Description of the billing plan. 128 characters max.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Description of the billing plan. 128 characters max.
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Type of the billing plan. Allowed values: `FIXED`, `INFINITE`.
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }


    /**
     * Name of the payment definition. 128 characters max.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Type of the payment definition. Allowed values: `TRIAL`, `REGULAR`.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * How frequently the customer should be charged.
     *
     * @param string $frequency_interval
     *
     * @return $this
     */
    public function setFrequencyInterval($frequencyInterval)
    {
        $this->frequencyInterval = $frequencyInterval;
        return $this;
    }

    /**
     * How frequently the customer should be charged.
     *
     * @return string
     */
    public function getFrequencyInterval()
    {
        return $this->frequencyInterval;
    }

    /**
     * Frequency of the payment definition offered. Allowed values: `WEEK`, `DAY`, `YEAR`, `MONTH`.
     *
     * @param string $frequency
     *
     * @return $this
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
        return $this;
    }

    /**
     * Frequency of the payment definition offered. Allowed values: `WEEK`, `DAY`, `YEAR`, `MONTH`.
     *
     * @return string
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Number of cycles in this payment definition.
     *
     * @param string $cycles
     *
     * @return $this
     */
    public function setCycles($cycles)
    {
        $this->cycles = $cycles;
        return $this;
    }

    /**
     * Number of cycles in this payment definition.
     *
     * @return string
     */
    public function getCycles()
    {
        return $this->cycles;
    }

    /**
     * Amount that will be charged at the end of each cycle for this payment definition.
     *
     * @param \PayPal\Api\Currency $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Amount that will be charged at the end of each cycle for this payment definition.
     *
     * @return \PayPal\Api\Currency
     */
    public function getAmount()
    {
        return $this->amount;
    }
    /**
     * Type of charge model. Allowed values: `SHIPPING`, `TAX`.
     *
     * @param string $type
     *
     * @return $this
     */
    public function setChargeModelType($type)
    {
        $this->chargeModelType = $type;
        return $this;
    }

    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }
    public function createOrUpdatePlan() {
        $this->plan->setName($this->planName)
            ->setDescription($this->planDescription)
            ->settype('FIXED');

        $this->paymentDefinition->setName($this->paymentDefinitionName)
            ->setType($this->paymentDefinitionType)
            ->setFrequency($this->frequency)
            ->setFrequencyInterval($this->frequencyInterval)
            ->setCycles($this->cycles)
            ->setAmount($this->currency);

        $this->chargeModel->setType($this->chargeModelType)
             ->setAmount($this->currency);

        $this->paymentDefinition->setChargeModels(array(
            $this->getChargeModel()
        ));

        $this->merchantPreferences->setReturnUrl(base_url('subscribe/return/success'))
            ->setCancelUrl(base_url('subscribe/return/cancel'))
            ->setAutoBillAmount('yes')
            ->setInitialFailAmountAction('CONTINUE')
            ->setMaxFailAttempts('0')
            ->setSetupFee($this->currency);

        $this->plan->setPaymentDefinitions(array($this->getPaymentDefinition()))
            ->setMerchantPreferences($this->getMerchantPreferences());
        try {
            $this->plan->create($this->getApiContext());
            $this->patch->setOp('replace')
                ->setPath('/')
                ->setValue($this->setPaymentModel($this->state));
            $this->patchRequest->addPatch($this->getPatch());
            $this->plan->update($this->getPatchRequest(), $this->getApiContext());
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            $this->jsonArray['code'] = $ex->getCode();
            $this->jsonArray['data'] = $ex->getData();
            return $this->jsonArray;
        } catch (Exception $ex) {
            die($ex);
        }
    }
    public function getPlanId() {
        return $this->plan->getId();
    }

    public function deletePlan() {
        try {
            $this->plan->delete($this->getApiContext());
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            $this->jsonArray['code'] = $ex->getCode();
            $this->jsonArray['data'] = $ex->getData();
            return $this->jsonArray;
        } catch (Exception $ex) {
            die($ex);
        }
    }
    public function setStartDate($date) {
        $this->date = $date;
        return $this;
    }
    public function setPatchPlan($id) {
        $this->patchedPlan = Plan::get($this->plan->getId(), $this->getApiContext());
        return $this;
    }
    public function agreement() {
        /*
        // Create new agreement
        $this->setStartDate(date('c', time() + 3600));
        $this->agreement
            ->setName($this->plan->getName())
            ->setDescription($this->plan->getDescription())
            ->setStartDate($this->date);
        // Get Plan

        $this->agreement->setPlan($this->getPlan());
        dd($this->agreement);
        // Add payer type
        $this->payer->setPaymentMethod('paypal');

        $this->agreement->setPayer($this->getPayer());

        // Adding shipping details
        $this->shippingAddress->setLine1('111 First Street')
            ->setCity('Saratoga')
            ->setState('CA')
            ->setPostalCode('95070')
            ->setCountryCode('US');

        $this->agreement->setShippingAddress($this->getShippingAddress());

        // Create agreement
        //dd($this->getApiContext());
        dd($this->agreement->create($this->getApiContext()));

        // Extract approval URL to redirect user
        */
        // Create new agreement
        $startDate = date('c', time() + 3600);
        $agreement = new Agreement();
        $agreement->setName('PHP Tutorial Plan Subscription Agreement')
            ->setDescription('PHP Tutorial Plan Subscription Billing Agreement')
            ->setStartDate($startDate);
        $patchedPlan = Plan::get('P-7JX46940CT5823849OIT5III', $this->getApiContext());
// Set plan id
        $plan = new Plan();
        $plan->setId($patchedPlan->getId());
        $agreement->setPlan($plan);

// Add payer type
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $agreement->setPayer($payer);

// Adding shipping details
        $shippingAddress = new ShippingAddress();
        $shippingAddress->setLine1('111 First Street')
            ->setCity('Saratoga')
            ->setState('CA')
            ->setPostalCode('95070')
            ->setCountryCode('US');
        $agreement->setShippingAddress($shippingAddress);

        try {
            // Create agreement
            $agreement = $agreement->create($this->getApiContext());

            // Extract approval URL to redirect user
            $approvalUrl = $agreement->getApprovalLink();

            header("Location: " . $approvalUrl);
            exit();
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }

    }

    /**
     * @param Plan $plan
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;
    }
    public function getAllPlan() {
        return Plan::all(array('page_size' => 10), $this->getApiContext())->getPlans();

    }
}

