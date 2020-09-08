 <section class="pricing">
    <div class="container">
        <?php if(isset($plans)) { ?>
            <div class="row">
            <?php foreach ($plans as $plan) { ?>

                    <div class="col-md-4">
                      <div class="price-box">
                        <h2>$<?php echo $plan->price;?></h2>
                        <p>QUARTERLY</p>
                        <h3><?php echo $plan->name;?></h3>
                       <ul class="list">
                          <li><?php echo $plan->description;?></li>
                        </ul>
                        <a href="<?php echo base_url('plan/'.$plan->slug);?>" class="btn sub-button">Subscribe</a>
                      </div>
                    </div>

            <?php } ?>
            </div>
        <?php } else { ?>

            <div class="row"></div>
        <?php } ?>
    </div>
  </section>

