<section class="loginpage">
    <div class="formbox subpage">
        <div class="container">
            <div class="row">
                <div class="col-md-8 pr-0 ">
                    <div class="plan">
                        <?php if(isset($plan)) { ?>
                            <div class="price-box-two">
                                <h4 class="planheading"><?php echo $plan->name;?></h4>
                                <h2>$<?php echo $plan->price;?></h2>
                                <p><?php echo $plan->frequency;?></p>
                                <h6 class="description"><?php echo $plan->description;?></h6>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-4 pl-0" id="my-container">
                    <div class="right-sides createAccountFrm ">
                        <h3>Create an account</h3>
                        <form id="frm" action="<?php echo base_url('createAccount');?>" method="post">
                            <input type="hidden" name="<?php echo __token();?>" value="<?php echo csrf_token();?>">
                            <input type="hidden" name="slug" value="<?php echo $plan->slug;?>">
                            <div class="row">
                                <div class="col form-group register">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input name="firstname" id="firstname" type="text" class="form-control"  autocomplete="off" required>
                                </div>
                                <div class="col form-group register">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input name="lastname" id="lastname" type="text" class="form-control" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group register">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" id="email" type="text" class="form-control" autocomplete="off" required>
                                <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --></div>
                            <div class="form-group register">
                                <label for="exampleInputPassword1">Password</label>
                                <input name="password" id="password" type="password" class="form-control" placeholder="*******" autocomplete="off" required>
                            </div>
                            <button type="submit" class="btn submits" id="createAccountBtn" data-loading-text="Loading...">Sign Up</button>
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