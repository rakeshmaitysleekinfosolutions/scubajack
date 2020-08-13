<!--  -->

<div class="page has-sidebar-left  height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Change Password
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="<?php echo base_url('admin-dashboard');  ?>"><i class="icon icon-home2"></i>Dashboard</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#" ><i class="icon icon-plus-circle"></i> Change Password</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>





    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">


                    <form action="<?php echo base_url('update-password'); ?>" method="post" onsubmit="return password_check()">
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">About Admin Credentials</h5>



                                <?php if($this->session->flashdata('succ')){ ?>
                                <div class="alert alert-success alert-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo $this->session->flashdata('succ'); ?>
                                </div>
                                <?php } ?>
                                <?php if($this->session->flashdata('err')){ ?>
                                <div class="alert alert-danger alert-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo $this->session->flashdata('err'); ?>
                                </div>
                                <?php } ?>

                
                                <div class="form-row">
                                    <div class="col-md-8">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12"> Old Password</label>
                                            <input name="old_password" id="old_password" placeholder="Enter Old Password" class="form-control r-0 light s-12 " type="password" required>
                                        </div>  
                                    </div>
                                    
                                    <div class="col-md-8">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">New Password</label>
                                            <input name="password" id="password" placeholder="Enter New Password" class="form-control r-0 light s-12 " type="password" required>
                                        </div>  
                                    </div>

                                </div>

                               
                                
                            </div>
                            
                           
                            <hr>
                            <div class="card-body">
                                <input type="submit" name="submit" value="Update Data" class="btn btn-primary btn-lg">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    </div>
    

</div>
