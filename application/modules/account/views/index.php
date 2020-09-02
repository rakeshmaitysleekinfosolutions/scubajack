<section class="dashboard-wrapper">
    <div class="container">
      <div class="dash-area">
        <div class="row">
          <div class="col-md-4">
            <div class="tabs">
              <ul class="nav flex-column">
                <li class="active"><a href="#home" data-toggle="tab">Dashboard</a></li>
                  <li><a href="#passport" data-toggle="tab">Passport</a></li>
                <li><a href="#Orders" data-toggle="tab">Orders</a></li>
                <li><a href="#download" data-toggle="tab">Downloads</a></li>
<!--                <li><a href="#adress" data-toggle="tab">Address</a></li>-->
                <li><a href="#account-details" data-toggle="tab">Account Details</a></li>
                <li><a href="#log-out" data-toggle="tab" onclick="return logout();">Log out</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-8">
            <div class="tab-content">
              <div class="tab-pane active" id="home">
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
                <?php
                /*
              <div class="tab-pane" id="adress">
                <div class="billing">
                  <h4>The following addresses will be used on the checkout page by default.</h4>
                  <form>
                    <div class="form-row">
                      <div class="col shipping">
                        <label for="inputPassword4">First Name</label>
                        <input type="text" class="form-control" placeholder="First name"> </div>
                      <div class="col shipping">
                        <label for="inputPassword4">Last Name</label>
                        <input type="text" class="form-control" placeholder="Last name"> </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6 shipping">
                        <label for="inputEmail4">Country</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> </div>
                      <div class="form-group col-md-6 shipping">
                        <label for="inputPassword4">State</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="Password"> </div>
                    </div>
                    <div class="form-group shipping">
                      <label for="inputAddress">Address 1</label>
                      <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"> </div>
                    <div class="form-group shipping">
                      <label for="inputAddress2">Address 2</label>
                      <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor"> </div>
                    <div class="form-row ">
                      <div class="form-group col-md-6 shipping">
                        <label for="inputCity">Phone Number</label>
                        <input type="text" class="form-control" id="inputCity"> </div>
                      <div class="form-group col-md-6 shipping">
                        <label for="inputState">Zip Code</label>
                        <select id="inputState" class="form-control">
                          <option selected>Zip Code</option>
                          <option>...</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck"> Check me out </label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                  </form>
                </div>
              </div>
                */?>
                <div class="tab-pane" id="passport"></div>
              <div class="tab-pane" id="account-details">
                <div class="details flup">
                  <h3>fill your details</h3>
                  <form>
                    <div class="form-row">
                      <div class="col account">
                        <label for="inputAddress">First name</label>
                        <input type="text" class="form-control" placeholder="First name"> </div>
                      <div class="col account">
                        <label for="inputAddress">Last name</label>
                        <input type="text" class="form-control" placeholder="First name"> </div>
                    </div>
                    <div class="form-group account">
                      <label for="inputAddress">Display Name</label>
                      <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"> </div>
                    <div class="form-group account">
                      <label for="inputAddress">Email Address</label>
                      <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"> </div>
                    <div class="form-group account">
                      <label for="inputAddress">New Password</label>
                      <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"> </div>
                    <div class="form-group account ">
                      <label for="inputAddress">Confirm New password</label>
                      <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"> </div>
                  </form>
                  <button type="button" class="btn savechanges">Save changes</button>
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