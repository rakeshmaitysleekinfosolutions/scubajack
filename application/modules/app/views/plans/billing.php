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
                    <div class="right-sides signup-form ">
                        <h3>Billing</h3>
                        <form method="post" action="<?php echo base_url('subscribe');?>">

                            <input type="hidden" name="slug"
                                   value="2-simultaneous-stream" />
                            <input type="submit" name="subscribe" value="Subscribe"
                                   class="btn-subscribe" />
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