<?php if(!$country) { ?>
    <section class="gallery-box">
        <div class="container">
            <h3 class="gallery"><?php echo $message;?></h3>
        </div>
    </section>
<?php } else {

if($isContent) {
    ?>
<section class="country">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="city-picture">
                    <img src="<?php echo resize($countryDescription->image,445,450);?>" alt="city-image">
                </div>
            </div>
            <div class="col-md-7">
                <div class="city-text">
                    <h3><?php echo $countryDescription->title;?></h3>
                    <p><?php echo $countryDescription->description;?></p>
                </div>
            </div>
        </div>
    </div>
</section>
    <?php
    if($blogs) {?>
    <section class="gallery-box">
        <div class="container">
            <h3 class="gallery">Explore</h3>
<!--            <p class="sub-text">Adventuring with purpose. We believe there's nothing more rewarding than completing a journey together,-->
<!--                as you work as a team towards a shared goal - both big challenges and microexpeditions</p>-->
            <div class="row">
                <?php foreach ($blogs as $blog) {?>
                    <div class="col-md-4">
                    <div class="card blog" >
                        <img class="img-fluid" src="<?php echo $blog['image'];?>" alt="Card image cap">
                        <div class="card-body">
                            <a href="<?php echo $blog['slug'];?>"><h4><?php echo $blog['title'];?></h4></a>
                            <p><?php echo $blog['smallDescription'];?></p>
                        </div>
                    </div>
                </div>
                <?php  } ?>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php } else {?>
    <h2>Content not available</h2>

    <?php } ?>
<!-- 1st part end -->

<?php } ?>