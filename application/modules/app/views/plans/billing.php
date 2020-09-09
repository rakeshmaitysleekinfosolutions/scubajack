<section class="loginpage">
    <div class="formbox">
        <div class="container">
            <div class="row">
                <div class="col-md-5 pr-0">
                    <?php if(isset($plan)) { ?>
                        <div class="plan-billing">
                            <h4 class="planheading"><?php echo $plan->name;?></h4>
                            <h2>$<?php echo $plan->price;?></h2>
                            <p><?php echo $plan->frequency;?></p>
                            <h6 class="description"><?php echo $plan->description;?></h6>
                        </div>
                    <?php } ?>
                </div>
          
                <div class="col-md-7 pl-0" id="my-container">
                    <div class="right-sides signup-form ">
                        <h3>Billing</h3>
                        <form id="frmSignUp" action="<?php echo base_url('register');?>" method="post">
                            <div class="form-group register">
                                <label for="exampleInputEmail1"></label>
                                <input value="<?php echo userName();?>" type="text" class="form-control" autocomplete="off" readonly>
                                <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --></div>
                            <div class="form-group register">
                                <label for="exampleInputPassword1"></label>
                                <input value="<?php echo userEmail();?>" type="text" class="form-control"  readonly>
                            </div>
                            <!-- <button type="submit" class="btn submits" id="registerButton" data-loading-text="Loading...">Sign Up</button> -->
                        </form>
                    <div class="billingcard">
                        <div class="row">
                        <div  class="col-md-4">
                            <div class="tabs-card ">
                            <ul class="nav flex-column">

                                <li class="active"><a href="#Paypal" data-toggle="tab">Paypal</a></li>
                                <li><a href="#Embgateway" data-toggle="tab">Embgateway </a></li>
                                <li><a href="#Stripe" data-toggle="tab">Credit Card (Stripe)</a></li>

                            </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content">
                            <div class="tab-pane active" id="Paypal">
                                <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" alt="PayPal acceptance mark"><a href="https://www.paypal.com/us/webapps/mpp/paypal-popup" class="about_paypal" onclick="javascript:window.open('https://www.paypal.com/us/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;">What is PayPal?</a>
                                <form id="frmPaypal" method="post">
                                    <input type="hidden" name="planId" id="planId" value="<?php echo $plan->paypal_plan_id;?>">
                                    <button type="button" class="btn submits" id="processToPayPal">Process to PayPal</button>
                                </form>

                            </div>
                            <div class="tab-pane" id="Embgateway">
                                <img src="https://adventuresofscubajack.com/wp-content/plugins/embgateway-payment-gateway-for-woocommerce/images/logo.png" alt="Embgateway">

                            </div>
                            <div class="tab-pane " id="Stripe">
                                     <img src="https://adventuresofscubajack.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg" class="stripe-visa-icon stripe-icon" alt="Visa"><img src="https://adventuresofscubajack.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg" class="stripe-amex-icon stripe-icon" alt="American Express"><img src="https://adventuresofscubajack.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg" class="stripe-mastercard-icon stripe-icon" alt="Mastercard"><img src="https://adventuresofscubajack.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/discover.svg" class="stripe-discover-icon stripe-icon" alt="Discover"><img src="https://adventuresofscubajack.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/jcb.svg" class="stripe-jcb-icon stripe-icon" alt="JCB"><img src="https://adventuresofscubajack.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/diners.svg" class="stripe-diners-icon stripe-icon" alt="Diners">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</section>
<script>
    var myLabel = myLabel || {};
    myLabel.baseUrl = '<?php echo base_url();?>';
    myLabel.paypal = '<?php echo base_url('paypal');?>';
</script> 