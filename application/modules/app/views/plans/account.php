<section class="loginpage">
    <div class="formbox">
        <div class="container">
            <div class="row">
                <div class="col-md-8 pr-0">
                    <div class="left">
                        <!-- <h3>Subscribe with us</h3>
                        <p>where The World And Reading Colide Each booklet come with activities,video's and quizzes.</p> -->
                        <?php if(isset($plan)) { ?>
                            <div class="col-md-4">
                                <div class="price-box">
                                    <h2>$<?php echo $plan->price;?></h2>
                                    <p>QUARTERLY</p>
                                    <h3><?php echo $plan->name;?></h3>
                                    <ul class="list">
                                        <li><?php echo $plan->description;?></li>
                                    </ul>
                                </div>
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