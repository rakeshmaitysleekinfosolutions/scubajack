
<div class="page  has-sidebar-left height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        STATES
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All STATES</a>
                    </li>
                    
                    <li class="float-right">
                        <a class="nav-link"  href="<?php echo base_url('add-state'); ?>" ><i class="icon icon-plus-circle"></i> Add New State</a>
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
                        <div class="card r-0 shadow">
                            <div class="table-responsive">
                                <form>
                                    <table id="example" class="table table-striped table-hover r-0">
                                        <thead>
                                        <tr class="no-b">
                                            <!-- <th style="width: 30px">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="checkedAll" class="custom-control-input"><label
                                                        class="custom-control-label" for="checkedAll"></label>
                                                </div>
                                            </th> -->
                                            <th>SL. No.</th>
                                            <th>STATE NAME</th>
                                            <th>STATE SHORT NAME</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                        </thead>

                                        <tbody>


                                        <?php
                                        if (!empty($state_details)) {
                                            $i = 1;
                                            foreach ($state_details as $states) {
                                                $id = $states['id'];
                                                $status = $states['status'];
                                           
                                        ?>
                                        <tr>
                                            <!-- <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input checkSingle"
                                                           id="user_id_10" required><label
                                                        class="custom-control-label" for="user_id_10"></label>
                                                </div>
                                            </td> -->
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <!-- <div class="avatar avatar-md mr-3 mt-1 float-left">
                                                    <img  src="assets/img/dummy/u1.png" alt="">
                                                </div> -->
                                                <div>
                                                    <div>
                                                        <strong><?php echo $states['state_name'] ?></strong>
                                                    </div>
                                                    <!-- <small> alexander@paper.com</small> -->
                                                </div>
                                            </td>
                                            <td><?php echo $states['state_shortname'] ?></td>

                                            <td class="status">
                                                <a class="<?php echo($status == 'Active'?'active':'inactive') ?>" href="<?php echo base_url();?>state-status-change/<?php echo $id; ?>/<?php echo($status == 'Active'?'Inactive':'Active') ?>">
                                                   

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
                                                <!-- <a href="panel-page-profile.html"><i class="icon-eye mr-3"></i></a> -->
                                                <a href="<?php echo base_url('edit-state').'/'.$states['id'];  ?>"><i class="icon-pencil"></i></a>
                                                <a href="<?php echo base_url('delete-state').'/'.$states['id'];  ?>" onclick = "return(confirm('Do you want to Delete?'))"><i class="icon-delete"></i></a>



                                                
                                            </td>
                                        </tr>
                                        <?php 
                                            $i++;
                                            }
                                        }
                                        ?>

                                        </tbody>

                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

               <!--  <nav class="my-3" aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav> -->
            </div>                 
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="<?php echo base_url('add-state'); ?>" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i
            class="icon-add"></i></a>
</div>


