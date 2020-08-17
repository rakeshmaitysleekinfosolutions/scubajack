<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <!-- font-awesome Css -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/css/all.min.css" rel="stylesheet" />
  <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
  <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
  <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css">
  <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/font/font.css">
  <?php echo $this->template->stylesheet; ?>
  <title>Scuba Jack</title>
</head>

<body>
  <header class="menu-area sticky">
    <div class="container">
      <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="<?php echo base_url();?>"> <img src="<?php echo base_url();?>assets/images/scuba-logo.png"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"> <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> </li>
            <li class="nav-item"> <a class="nav-link" href="#">About us</a> </li>
            <li class="nav-item"> <a class="nav-link ">
          Membership
        </a> </li>
            <li class="nav-item"> <a class="nav-link " href="#">Contact us</a> </li>
          </ul>
          <form class="form-inline searchs "> <i class="fas fa-search"></i> </form>
          <?php if(isLogged()) {?> 
            <a href="<?php echo base_url('account');?>">
              <button class="btn my-account" type="submit"><i class="fas fa-user"></i>My Account</button>
            </a>
          <?php } else { ?>
            <a href="<?php echo base_url('login');?>">
              <button class="btn my-account" type="submit"><i class="fas fa-user"></i>My Account</button>
            </a>
          <?php } ?>
        </div>
      </nav>
    </div>
  </header>
  <?php echo $this->template->content; ?>
  <!-------------------------adventure part end----------------->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="logo"> <img src="<?php echo base_url();?>assets/images/scuba-logo.png"> </div>
        </div>
        <div class="col-md-4">
          <div class="foot-two">
            <h4>Contact Us</h4>
            <h5>16 Gibbs Hill Drive, Gloucester, MA. 01930</h5>
            <h6>berhcostanzo@hotmail.com</h6>
            <p>Call us at <span>+978-491-0747</span></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="foot-three">
            <h4>Links</h4>
            <h5>© 2020adventuresofscubajack.com All rights reserved</h5>
            <li> Terms & Privacy Policy |
              <li>
                <li> Warranty-Promise | </li>
                <li> My Account</li>
          </div>
        </div>
      </div>
    </div>
  </footer>
   <!-------------------------footer end-------------------------->
  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquiry.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/popper.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <?php echo $this->template->javascript; ?>
</body>

</html>