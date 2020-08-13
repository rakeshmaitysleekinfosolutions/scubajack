<!--  -->

<div class="page has-sidebar-left  height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Profile
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="<?php echo base_url('admin-dashboard');  ?>"><i class="icon icon-home2"></i>Dashboard</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#" ><i class="icon icon-plus-circle"></i> View Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>





    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">


                    <form action="<?php echo base_url('edit-profile').'/'.$profile[0]['admin_id']; ?>" method="post">
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">About Admin Details</h5>



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
                                            <label for="name" class="col-form-label s-12"> NAME</label>
                                            <input type="hidden" name="admin_id" value="<?php  echo $profile[0]['admin_id'];?>">
                                            <input name="admin_name" id="admin_name" placeholder="Enter Name" class="form-control r-0 light s-12 " type="text" value="<?php  echo $profile[0]['admin_name'];?>" readonly="">
                                        </div>  
                                    </div>
                                    
                                    <div class="col-md-8">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">USER NAME</label>
                                            <input name="admin_user_name" id="admin_user_name" placeholder="Enter User Name" class="form-control r-0 light s-12 " type="text" value="<?php  echo $profile[0]['admin_user_name'];?>" readonly="">
                                        </div>  
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">EMAIL ID</label>
                                            <input name="admin_email" id="admin_email" placeholder="Enter Email Id" class="form-control r-0 light s-12 " type="text" value="<?php  echo $profile[0]['admin_email'];?>" readonly="">
                                        </div>  
                                    </div>

                                </div>

                               
                                
                            </div>
                            
                           
                           
                        </div>
                    </form>




                </div>
            </div>
    </div>
    </div>






</div>
