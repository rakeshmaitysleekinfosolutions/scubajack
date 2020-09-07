<section class="book-list">
    <h3><span><?php echo ($category['name']) ? $category['name'] : "";?> </span></h3>
	<p><?php echo ($category['description']) ? $category['description'] : "";?></p>
	<div class="container">
        <?php if(isset($products)) {?>
		<div class="row">
            <?php foreach ($products as $product) {?>
                <div class="col-md-3">
                    <div class="cards ">
                        <div class="book-details"> <img src="<?php echo $product['img'];?>" alt="<?php echo $product['name'];?>"> </div>
                        <div class="card-body">
                            <h5><?php echo $product['name'];?></h5>
                            <?php if($product['video']) { ?>
                            <a href="headerPopup<?php echo $product['id'];?>" class="btn  watch btn headerVideoLink ">
                            <i class="fab fa-youtube"></i>Watch</a>
                            <a href="#" class="btn  craft"><i class="fas fa-puzzle-piece"></i>Craft</a>
                                
                                <div id="headerPopup<?php echo $product['id'];?>" class="mfp-hide embed-responsive embed-responsive-21by9">
                                    <iframe class="embed-responsive-item" width="854" height="480" src="<?php echo embedUrl($product['video']);?>?rel=0&enablejsapi=1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture; frameborder="0"; fullscreen;"></iframe>
                                </div>
                            <?php } ?>
                            <?php if($product['pdf']) { ?>
                                <a href="#" class="btn  craft"><i class="fas fa-puzzle-piece"></i>Craft</a>
                            <?php } ?>
                            <div class="only-one">
               <center> <a href="#" class="btn watch-only"><i class="fab fa-youtube"></i>Watch</a>
               </center> 
               <center> <a href="#" class="btn  craft-only"><i class="fas fa-puzzle-piece"></i>Craft</a></center>
              </div>
                            <!-- <center> <a href="#" class="btn  order"><i class="fas fa-download"></i>Order now</a></center> -->
                        </div>
                    </div>
                </div>
            <?php } ?>
		</div>
        <?php } else { ?>
            <div class="row">Product no found!</div>
        <?php } ?>
	</div>
</section>
<!-- book-list part end -->

<script>
var myLabel = myLabel || {};
myLabel.baseUrl = '<?php echo base_url();?>';
</script>