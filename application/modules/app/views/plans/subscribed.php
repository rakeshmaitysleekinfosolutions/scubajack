<section class="pricing">
    <div class="container">
            <div class="row">
                <div class="">
                    <h2>You have already subscribed <?php echo (isset($plan['name'])) ? $plan['name'] : '';?> plan</h2>
                    <p>Price: $<?php echo (isset($plan['price'])) ? $plan['price'] : '';?></p>
                    <h3>Expire Date: <?php echo (isset($plan['end_at'])) ? $plan['end_at'] : '';?></h3>
                    <h3>Day Left: <?php echo (isset($plan['daysLeft'])) ? $plan['daysLeft'] : '';?></h3>
                    <h6 class="description"><?php echo (isset($plan['description'])) ? $plan['description'] : '';?></h6>

                    <p>Subscriber Name: <?php echo (isset($subscriber['name'])) ? $subscriber['name'] : '';?></p>
                    <h3>Subscriber Email: <?php echo (isset($subscriber['email'])) ? $subscriber['email'] : '';?></h3>
                </div>
            </div>
    </div>
</section>

