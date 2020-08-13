
<div class="page  has-sidebar-left height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        CITIES
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All CITIES</a>
                    </li>
                    
                    <li class="float-right">
                        <a class="nav-link"  href="<?php echo base_url('add-city'); ?>" ><i class="icon icon-plus-circle"></i> Add New City</a>
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
                                            <th>CiTY NAME</th>
                                            <th>CiTY SHORT NAME</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                        </thead>

                                        <tbody>


                                        <?php
                                        if (!empty($city_details)) {
                                            $i = 1;
                                            foreach ($city_details as $city) {
                                                $id = $city['id'];
                                                $status = $city['status'];
                                           
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <div>
                                                    <div>
                                                        <strong><?php echo $city['state_name'] ?></strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo $city['state_shortname'] ?></td>

                                            <!-- <td><span class="icon icon-circle s-12  mr-2 text-success"></span><?php echo $city['status'] ?></td> -->
                                             <td class="status">
                                                <a class="<?php echo($status == 'Active'?'active':'inactive') ?>" href="<?php echo base_url();?>city-status-change/<?php echo $id; ?>/<?php echo($status == 'Active'?'Inactive':'Active') ?>">

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
                                                <a href="<?php echo base_url('edit-city').'/'.$city['id'];  ?>"><i class="icon-pencil"></i></a>
                                                <a href="<?php echo base_url('delete-city').'/'.$city['id'];  ?>" onclick = "return(confirm('Do you want to Delete?'))"><i class="icon-delete"></i></a>

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

        
            </div>                 
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="<?php echo base_url('add-city'); ?>" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i
            class="icon-add"></i></a>
</div>


