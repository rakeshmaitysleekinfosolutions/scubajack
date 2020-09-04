<!------------header end----------->
  <section>
    <div class="bluebg">
      <h3>Majestic Learning</h3> </div>
<!--       <div class="continent"> <img src="--><?php //echo base_url();?><!--assets/images/world-map.png" usemap="#imagemap">-->
<!--          <map name="imagemap">-->
<!--            <area coords="650,20,100,100" shape="rect" href="https://getbootstrap.com/" title="Greenland" alt="greeen" target="_blank">-->
<!--            <area coords="150,100,300,350" shape="rect" href="https://www.wikipedia.org/" title="United states" alt="test333" target="_blank">-->
<!--            <area coords="700,100,300,350" shape="rect" href="https://www.w3schools.com/" title="Brazil" alt="test" target="_blank">-->
<!--              <area coords="1000,100,300,350" shape="rect" href="https://es.wikipedia.org/wiki/Wikipedia:Portada" title="africa" alt="test" target="_blank">-->
<!--            <area coords="1450,100,300,350" shape="rect" href="https://www.w3schools.com/" title="Test" alt="test" target="_blank"> </area>-->
<!--            </map>-->
<!---->
<!--        </div>-->
<!--      <div id="chartdiv"></div>-->

   
          <div class="continent" id="map">
              <div class="map__image">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:amcharts="http://amcharts.com/ammap" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 597 585">
                      <g>
                          <?php if(isset($maps)) { ?>
                              <?php foreach ($maps as $map) { ?>
                                  <a xlink:title="<?php echo $map->country->name;?>" xlink:href="javascript:void(0);" ><path id="<?php echo $map->country->iso_code_2;?>"  title="<?php echo $map->country->name;?>"  d="<?php echo $map->path_d;?>"/></a>
                              <?php } ?>
                          <?php } ?>
                      </g>
                  </svg>
              </div>
          </div>

    <div class="tagline">
      <div class="darkbluebg">
        <h4>where the world and reading collide</h4>
        <p>Each booklet come with activities,video's and quizzes.</p>
      </div>
      <div class="yellowbg"> </div>
  </section>
  <!-----------banner part end-------->
  <section class="pre-school">
    <h3>We provide a <span>variety of  quality</span> of Pre-school and elementary</h3>
    <p>education for children</p>
    <div class="pre-banner">
      <a href="#"><img src="<?php echo base_url();?>assets/images/play-button.png" data-toggle="modal" data-target="#exampleModalCenter"></a>
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">video</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
              <iframe width="100%" height="460" src="https://www.youtube.com/embed/aDGArpQMi78" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
             <!--  <iframe width="100%" height="460" src="https://www.youtube.com/embed/-x1HTBAAFk8" rel="0&amp;modestbranding=1&amp;autohide=1&amp;showinfo=0&amp;controls=0" frameborder="0" allowfullscreen=""></iframe> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="elementary">
      <div class="container">
        <div class="row">
          <div class="col-md-6"> <img src="<?php echo base_url();?>assets/images/p1.jpg">
            <p>Preschool <span>learning</span></p>
          </div>
          <div class="col-md-6"> <img src="<?php echo base_url();?>assets/images/p2.jpg">
            <p>Elementary <span>learning</span></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!------------preschool part end--------->
  <section class="sub">
    <div class="subscription">
      <p>Start your subscription today and get access to<br/>
      <span>your Virtual Field Trips, books, video’s, activities and FUN!</span></p>
      <button type="button" class="btn start-sub">Start Subscription</button>
    </div>
    <div class="sub-banner"> </div>
  </section>
  <!------------- subscription part end--------->
  <section class="world_reading">
    <h3>Where<span> the world and Reading</span> Collide!</h3>
    <p>Comes with Quizzes & Videos!</p>
    <div class="container">
      <div class="row">
          <?php if($products) {
              foreach ($products as $product) { ?>
                <div class="col-md-3 col-12">
          <div class="books"> <img src="<?php echo $product['img'];?>" alt="<?php echo $product['name'];?>">
            <div class="books-details">
              <p><?php echo $product['name'];?></p>
                <?php if($product['quiz']) {?>
                    <p class="qu"><a href="<?php echo $product['quiz'];?>">quiz</a></p>
                <?php } ?>
            </div>
            <div class="more">

                <?php if($product['video']) {?>
                    <a href="#headerPopup<?php echo $product['id'];?>" id="" class="btn vdo popup-modal headerVideoLink"><i class="far fa-play-circle"></i>video</a>
                    <div id="headerPopup<?php echo $product['id'];?>" class="mfp-hide embed-responsive embed-responsive-21by9">
                        <iframe class="embed-responsive-item" width="854" height="480" src="<?php echo embedUrl($product['video']);?>?rel=0&enablejsapi=1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture; frameborder="0"; fullscreen;"></iframe>
                    </div>
                <?php } ?>
              <button type="button" class="btn dwnld"><i class="far fa-arrow-alt-circle-down"></i>download</button>
            </div>
          </div>
        </div>
        <?php } ?>
          <?php } ?>
      </div>
      <center><a class="btn see-more">See more</a></center>
    </div>
  </section>
  <!------------------- world & reading part end ------->
  <section class="skill">
    <div class="container">
      <div class="logo"> <img src="<?php echo base_url();?>assets/images/scuba-logo.png"> </div>
      <div class="skill-list">
        <div class="row">
            <?php if($categories) { ?>
                <?php foreach ($categories as $category) {?>
                    <div class="col-md-6">
                        <div class="skillbox">
                            <img src="<?php echo $category['img'];?>">
                          <div class="s-link">
                            <a href="<?php echo base_url($category['slug']);?>" class="btn whitebtn"><?php echo $category['name'];?></a>
                          </div>
                        </div>
                    </div>
                <?php } ?>
            <?php }  ?>
            <?php
            /*
           <div class="col-md-6">
                <div class="skillbox">
                  <div class="s-link">
                    <button type="button" class="btn whitebtn">story books</button>
                  </div>
                </div>
            </div>
          <div class="col-md-6">
            <div class="skillbox2">
              <div class="s-link">
                <button type="button" class="btn whitebtn">Learn to read</button>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="skillbox3">
              <div class="s-link">
                <button type="button" class="btn whitebtn">Number</button>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="skillbox4">
              <div class="s-link">
                <button type="button" class="btn whitebtn">Color</button>
              </div>
            </div>
          </div>
            */?>
        </div>
        <center><a href="<?php echo base_url('all');?>" class="btn see-more">See all</a></center>
      </div>
    </div>
  </section>
  <!----------------------- skill part end----------------->
  <section class="adventure">
    <h3>Learn to READ with<span>The Adventures</span> of Scuba Jack.</h3>
    <div class="container">
      <div class="activity-wrapper">
        <div class="row">
          <div class="col-md-3 col-12">
            <div class="activity-box"> <img src="<?php echo base_url();?>assets/images/a1.jpg">
              <center>
                <button type="button" class="btn activity-book"><i class="far fa-arrow-alt-circle-down"></i>activity book</button>
              </center>
            </div>
          </div>
          <div class="col-md-3 col-12">
            <div class="activity-box"> <img src="<?php echo base_url();?>assets/images/a2.jpg">
              <center>
                <button type="button" class="btn activity-book"><i class="far fa-arrow-alt-circle-down"></i>activity book</button>
              </center>
            </div>
          </div>
          <div class="col-md-3 col-12">
            <div class="activity-box"> <img src="<?php echo base_url();?>assets/images/a3.jpg">
              <center>
                <button type="button" class="btn activity-book"><i class="far fa-arrow-alt-circle-down"></i>activity book</button>
              </center>
            </div>
          </div>
          <div class="col-md-3 col-12">
            <div class="activity-box"> <img src="<?php echo base_url();?>assets/images/a4.jpg">
              <center>
                <button type="button" class="btn activity-book"><i class="far fa-arrow-alt-circle-down"></i>activity book</button>
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


