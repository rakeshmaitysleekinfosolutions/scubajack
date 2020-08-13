
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
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Business</a>
                    </li>
                    
                    <li class="float-right">
                        <a class="nav-link"  href="<?php echo base_url('add-business'); ?>" ><i class="icon icon-plus-circle"></i> Add New Business</a>
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
                                            <th>BUSINESS NAME</th>
                                            <th>PHONE NO</th>
                                            <th>WEBSITE LINK</th>
                                            <th>CITY</th>
                                            <th>STATE</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                        </thead>


                                        <tbody>

                                        <?php
                                        if (!empty($products_details)) {
                                            $i = 1;
                                            foreach ($products_details as $product) {
                                                
                                                $id = $product['product_id'];
                                                $status = $product['status'];
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <div>
                                                    <div>
                                                        <strong><?php echo $product['product_name']; ?></strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo $product['phone_no']; ?></td>
                                            <td><?php echo $product['website_link']; ?></td>
                                            <td><?php echo $product['city_name']; ?></td>
                                            <td><?php echo $product['state_name']; ?></td>
                                            <td class="status">
                                                <a class="<?php echo($status == 'Active'?'active':'inactive') ?>" href="<?php echo base_url();?>product-status-change/<?php echo $id; ?>/<?php echo($status == 'Active'?'Inactive':'Active') ?>">
                                                    <?php 
                                                    if ($status == 'Active') { ?>
                                                        <span class="icon icon-circle s-12  mr-2 text-success"></span>
                                                    <?php echo $status;  } else{ ?>
                                                        <span class="icon icon-circle s-12  mr-2 text-danger"></span>
                                                    <?php echo $status; }
                                                    ?>
                                                
                                                </a>
                                            </td>
                                            <td>
                                               
                                                <a href="<?php echo base_url('edit-business').'/'.$product['product_id'];  ?>"><i class="icon-pencil"></i></a>
                                                <a href="<?php echo base_url('delete-business').'/'.$product['product_id'];  ?>" onclick = "return(confirm('Do you want to Delete?'))"><i class="icon-delete"></i></a>
                                            </td>
                                        </tr>
                                        <?php 
                                            $i++;
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table> 
                            </div>
                        </div>
                    </div>
                </div>

             
            </div>                 
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="<?php echo base_url('add-business'); ?>" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i
            class="icon-add"></i></a>
</div>


