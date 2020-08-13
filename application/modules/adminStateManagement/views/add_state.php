<!--  -->

<div class="page has-sidebar-left  height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        State
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="<?php echo base_url('state-list');  ?>"><i class="icon icon-home2"></i>All States</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="<?php echo base_url('add-state'); ?>" ><i class="icon icon-plus-circle"></i> Add New State</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>





    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-10  offset-md-1">

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


                    <form action="<?php echo base_url('add-state-details'); ?>" method="post">
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">About State</h5>


                
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">STATE NAME</label>
                                            <input name="state_name" id="name" placeholder="Enter State Name" class="form-control r-0 light s-12 " type="text">
                                        </div>  
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">STATE Zip CODE</label>
                                            <input name="state_zip" id="name" placeholder="Enter Zip Code" class="form-control r-0 light s-12 " type="text">
                                        </div>  
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">STATE SHORT NAME</label>
                                            <input name="state_shortname" id="name" placeholder="Enter State Short Name" class="form-control r-0 light s-12 " type="text">
                                        </div>  
                                    </div>
                                </div>

                               
                                
                            </div>
                            
                           
                            <hr>
                            <div class="card-body">
                                <input type="submit" name="submit" value="Save Data" class="btn btn-primary btn-lg">
                            </div>
                        </div>
                    </form>




                </div>
            </div>
    </div>
    </div>






</div>
