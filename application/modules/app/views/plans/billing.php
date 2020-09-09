<section class="loginpage">
    <div class="formbox">
        <div class="container">
            <div class="row">
                <div class="col-md-5 pr-0">
                    <div class="plan-billing">
                        <h4 class="planheading">Yearly plan  </h4>
                       
                                    <h2 class="bill-price">$500.00</h2>
                                    <p class="bill-term">QUARTERLY</p>
                                    <h3 class="bill-duration">2 Simultaneous Stream</h3>
                                    <h6 class="description">Lorem ipsum, or lipsum as it is sometimes known               
                        <?php if(isset($plan)) { ?>
                            <!-- <div class="col-md-5"> -->
                                <!-- <div class="price-box"> -->
                                    <!-- <h2>$<?php //echo $plan->price;?></h2> -->
                                    <!-- <p>QUARTERLY</p> -->
                                    <!-- <h3><?php //echo $plan->name;?></h3> -->
                                    <ul class="list">
                                        <li><?php echo $plan->description;?></li>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-7 pl-0" id="my-container">
                    <div class="right-sides signup-form ">
                        <h3>Billing</h3>
                        <p>Already have a SCUBA JACK Account? <a href="<?php echo base_url('login');?>">Sign In</a></p>
                        <form id="frmSignUp" action="<?php echo base_url('register');?>" method="post">
                            <div class="form-group register">
                            <div class="row">
                        <div class="col form-group register">
                           <label for="exampleInputEmail1">First Name</label>
                           <input name="firstname" id="input-payment-firstname" type="text" class="form-control" autocomplete="off" required="" aria-required="true">
                        </div>
                        <div class="col form-group register">
                           <label for="exampleInputEmail1">Last Name</label>
                           <input name="lastname" id="input-payment-lastname" type="text" class="form-control" autocomplete="off" required="" aria-required="true">
                        </div>
                     </div>
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" id="input-payment-email" type="text" class="form-control" autocomplete="off" required>
                                <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --></div>
                            <div class="form-group register">
                                <label for="exampleInputPassword1">Password</label>
                                <input name="password" id="input-payment-password" type="password" class="form-control" placeholder="*******" autocomplete="off" required>
                            </div>
                            <!-- <button type="submit" class="btn submits" id="registerButton" data-loading-text="Loading...">Sign Up</button> -->
                        </form>
                        <div class="billingcard">
                        <div class="row">
                            <div  class="col-md-4">
                                <div class="tabs-card ">
                                <ul class="nav flex-column">
                                    
                                    <li class="active"><a href="#credit" data-toggle="tab">Credit Card</a></li>
                                    <li><a href="#debit" data-toggle="tab">Debit card</a></li>
                                    <li><a href="#other" data-toggle="tab">Others</a></li>
                                   
                                </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content">
                                <div class="tab-pane active" id="credit">
                               <p> Lorem ipsum is a placeholder text commonly used to 
                                   demonstrate the visual form of a document or a 
                                   typeface without relying on meaningful conten</p>

                                 
                                    
                                </div>
                                <div class="tab-pane" id="debit">
                                    <p>Please fill your debit card details</p>
                                    
                                </div>
                                <div class="tab-pane " id="other">
                                    <p>Lorem ipsum, or lipsum as it is sometimes known</p>
                                    
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
</script> 