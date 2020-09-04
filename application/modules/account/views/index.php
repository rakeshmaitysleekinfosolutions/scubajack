<section class="dashboard-wrapper">
    <div class="container">
      <div class="dash-area">
        <div class="row">
          <div class="col-md-4">
            <div class="tabs">
              <ul class="nav flex-column">
                <li ><a href="#home" data-toggle="tab">Dashboard</a></li>
                  <li><a href="#passport" data-toggle="tab">Passport</a></li>
                <li><a href="#Orders" data-toggle="tab">Orders</a></li>
                <li><a href="#download" data-toggle="tab">Downloads</a></li>
                <li class="active"><a href="#account-details" data-toggle="tab">Account Details</a></li>
                <li><a href="#log-out" data-toggle="tab" onclick="return logout();">Log out</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-8">
            <div class="tab-content">
              <div class="tab-pane " id="home">
                <p>Hello <span>user</span> (not you? <a href="#">Log out</a>)</p>
                <p> From your account dashboard you can view your<a href="#"> recent orders,</a> manage your <a href="#">shipping and billing addresses</a>, and edit your<a href="#"> password and account 
                    </a>details. </p>
              </div>
              <div class="tab-pane" id="Orders">
                <div class="order-box border-left-blue"> <i class="far fa-check-circle"></i>
                  <p>No order has been made yet
                    <button type="button" class="btn browse-products">Browse products</button>
                  </p>
                </div>
              </div>
              <div class="tab-pane" id="download">
                <div class="order-box border-left-blue"> <i class="far fa-check-circle"></i>
                  <p>No download has been made yet
                    <button type="button" class="btn browse-products">Browse products</button>
                  </p>
                </div>
              </div>

              <div class="tab-pane active" id="account-details">
                <div class="details flup" id="my-container">
                  <h3>Account Details</h3>
                  <form id="frm" class="frm" action="<?php echo base_url('account/update');?>" method="post">
                    <div class="form-row">
                      <div class="col account">
                        <label for="inputAddress">First name</label>
                        <input value="<?php echo $user->firstname;?>" id="firstname" name="firstname" type="text" class="form-control" placeholder="First name" required>
                      </div>
                      <div class="col account">
                        <label for="inputAddress">Last name</label>
                        <input value="<?php echo $user->lastname;?>" id="lastname" name="lastname" type="text" class="form-control" placeholder="Last name" required>
                      </div>
                    </div>
                      <div class="form-row">
                          <div class="col account">
                              <label for="inputAddress">Email Address</label>
                              <input value="<?php echo $user->email;?>" id="email" name="email" type="text" class="form-control"  placeholder="example@mail.com" required readonly>
                          </div>
                          <div class="col account">
                              <label for="inputAddress">Phone</label>
                              <input value="<?php echo $user->phone;?>" id="phone" name="phone" type="text" class="form-control" placeholder="1234567896" required>
                          </div>
                      </div>

                    <div class="form-group account">
                      <label for="inputAddress">New Password</label>
                      <input type="password" id="password" name="password" class="form-control" placeholder="*******">
                    </div>
                    <div class="form-group account ">
                      <label for="inputAddress">Confirm New password</label>
                      <input type="password" id="confirm" name="confirm" class="form-control"  placeholder="********">
                    </div>
                      <button id="btn" type="submit" class="btn savechanges">Update Profile</button>
                  </form>

                </div>
              </div>
              <div class="tab-pane" id="passport">
                                        <div class="blue-box">
                                          <div class="row">
                                            <div class="col-md-7">
                                              <div class="blue-text">
                                                <!--  <p>More off this less hello salamander lied porpoise much over tightly circa horse taped so innocuously outside crud mightily rigorous plot life. .</p> -->
                                              </div>
                                            </div>
                                            <div class="col-md-5">
                                              <div class="blue-right">
                                                <img src="<?php echo base_url('assets/images/p-new.jpg');?>">
                                                <form>
                                                  <div class="form-group pfile">
                                                    <input value="<?php echo $user->firstname. ' '. $user->lastname;?>" type="text" class="form-control" id="formGroupExampleInput " placeholder="your name" readonly>
                                                  </div>
                                                  <div class="form-group pfile">
                                                    <input value="<?php echo $registrationDate;?>" type="text" class="form-control" id="formGroupExampleInput2" placeholder="date of joining" readonly>
                                                  </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
              <div class="tab-pane" id="log-out" >
                <p>Hello <span>user</span> (not you? <a href="javascript:void(0);" onclick="return logout();">Log out</a>)</p>
                <p> From your account dashboard you can view your<a href="#"> recent orders,</a> manage your <a href="#">shipping and billing addresses</a>, and edit your<a href="#"> password and account 
                    </a>details. </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<script>
   var myLabel = myLabel || {};
  myLabel.baseUrl = '<?php echo base_url();?>';
  
  function logout () {
      window.location.href = '<?php echo base_url('account/logout');?>';
        // return true or false, depending on whether you want to allow the `href` property to follow through or not
    }
</script>