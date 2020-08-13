
<div class="page  has-sidebar-left height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        CATEGORIES
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Categories</a>
                    </li>
                    
                    <li class="float-right">
                        <a class="nav-link"  href="<?php echo base_url('add-category'); ?>" ><i class="icon icon-plus-circle"></i> Add New Category</a>
                    </li>
                </ul>
            </div>
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
                          
                                    <table id="example" class="table table-striped table-hover r-0  display">
                                        <thead>
                                        <tr class="no-b">
                                            
                                            <th>SL. No.</th>
                                            <th>CATEGORY NAME</th>
                                            <!-- <th>CATEGORY DESC</th> -->
                                            <th>CATEGORY SHORT DESC</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                        </thead>


                                        <tbody>

                                        <?php
                                        if (!empty($cat_details)) {
                                            $i = 1;
                                            foreach ($cat_details as $cat) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <div>
                                                    <div>
                                                        <strong><?php echo $cat['category_name'] ?></strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- <td><?php //echo $cat['catagory_desc'] ?></td> -->
                                            <td><?php echo $cat['category_short_desc'] ?></td>
                                            <td><span class="icon icon-circle s-12  mr-2 text-success"></span><?php echo $cat['status'] ?></td>
                                            <td>
                                               
                                                <a href="<?php echo base_url('edit-category').'/'.$cat['id'];  ?>"><i class="icon-pencil"></i></a>
                                                <a href="<?php echo base_url('delete-category').'/'.$cat['id'];  ?>" onclick = "return(confirm('Do you want to Delete?'))"><i class="icon-delete"></i></a>
                                            </td>
                                        </tr>
                                        <?php 
                                            $i++;
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table> 



    <!-- <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SL. No.</th>
                                            <th>CATEGORY NAME</th>
                                            <th>CATEGORY DESC</th>
                                            <th>CATEGORY SHORT DESC</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            


        </tbody>
    </table> -->
                           
                            </div>
                        </div>
                    </div>
                </div>

             
            </div>                 
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="<?php echo base_url('add-category'); ?>" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i
            class="icon-add"></i></a>
</div>


