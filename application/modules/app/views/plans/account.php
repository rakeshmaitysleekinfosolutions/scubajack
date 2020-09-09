<section class="loginpage">
    <div class="formbox subpage">
        <div class="container">
            <div class="row">
                <div class="col-md-8 pr-0 ">
                    <div class="plan">
                     
                        <?php if(isset($plan)) { ?>
                            <!-- <div class="col-md-4"> -->
                            <div class="price-box-two"> 
                                    <h4 class="planheading">Yearly plan  </h4>
                                    <h2>$<?php echo $plan->price;?></h2>
                                    <p>QUARTERLY</p>
                                    <h3><?php echo $plan->name;?></h3>
                                    <h6 class="description">Lorem ipsum, or lipsum as it is sometimes known,
                                         is dummy text used in laying out print,</h6>
                                    <ul class="list">
                                        <!-- <li><?php echo $plan->description;?></li> -->
                                    </ul>
                                </div>
                            <!-- </div> -->
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-4 pl-0 " id="my-container">
                    <div class="right-sides signup-form plan-details">
                        <h3>Register with us</h3>
                        <p>Already have a SCUBA JACK Account? <a href="<?php echo base_url('login');?>">Sign In</a></p>
                        <form id="frmSignUp" action="<?php echo base_url('register');?>" method="post">
                            <input type="hidden" name="<?php echo __token();?>" value="<?php echo csrf_token();?>">
                            <div class="row">
                                <div class="col form-group register">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input name="firstname" id="input-payment-firstname" type="text" class="form-control"  autocomplete="off" required>
                                </div>
                                <div class="col form-group register">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input name="lastname" id="input-payment-lastname" type="text" class="form-control" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group register">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" id="input-payment-email" type="text" class="form-control" autocomplete="off" required>
                                <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --></div>
                            <div class="form-group register">
                                <label for="exampleInputPassword1">Password</label>
                                <input name="password" id="input-payment-password" type="password" class="form-control" placeholder="*******" autocomplete="off" required>
                            </div>

                         

                                <button type="submit" class="btn submits" id="registerButton" data-loading-text="Loading...">Sign Up</button>
                        </form>
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