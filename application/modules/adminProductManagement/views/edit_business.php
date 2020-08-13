
<div class="page  has-sidebar-left height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        BUSINESS
                    </h4>
                </div>
            </div>
           <!--  <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Business</a>
                    </li>
                    
                    <li class="float-right">
                        <a class="nav-link"  href="<?php echo base_url('add-business'); ?>" ><i class="icon icon-plus-circle"></i> Add New Business</a>
                    </li>
                </ul>
            </div> -->
        </div>
    </header>



    <div class="container-fluid animatedParent animateOnce">
        <div class="tab-content my-3" id="v-pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                <div class="row my-3">
                    <div class="col-md-12">
                        <?php 
                            if($this->session->flashdata('succ')){ ?>
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
                        <div class="card r-0 shadow">
                            <div class="table-responsive">
                          		<h1 style="text-align: center">COMING    SOON!!</h1>
                                   
                            </div>
                        </div>
                    </div>
                </div>

             
            </div>                 
        </div>
    </div>

</div>


