<!--  -->

<div class="page has-sidebar-left  height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Category
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="<?php echo base_url('category-list');  ?>"><i class="icon icon-home2"></i>All Category</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="<?php echo base_url('add-category'); ?>" ><i class="icon icon-plus-circle"></i> Add New Category</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>





    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">


                    <form action="<?php echo base_url(); ?>edit-category/<?php if(isset($category_val['id'])){echo $category_val['id'];} ?>" method="post"      enctype='multipart/form-data'>
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">About Category</h5>



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

                                

                                <input type="hidden" name="id" value="<?php  echo $category_val['id'];?>">


                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">CATEGORY NAME</label>
                                            <input name="category_name" id="category_name" placeholder="Enter Category Name" class="form-control r-0 light s-12 " type="text" value="<?php if(isset($category_val['category_name'])){ echo $category_val['category_name'];} ?>">
                                        </div>  
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">CATEGORY DESC</label>
                                            <textarea class="ckeditor" name="catagory_desc" id="catagory_desc" placeholder="Enter Category Desc" class="form-control r-0 light s-12 ">
                                            <?php if(isset($category_val['catagory_desc'])){ echo $category_val['catagory_desc'];} ?></textarea>
                                        </div>  
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">CATEGORY SHORT DESC</label>
                                            <input name="category_short_desc" id="category_short_desc" placeholder="Enter Category Short Desc" class="form-control r-0 light s-12 " type="text" value="<?php if(isset($category_val['category_short_desc'])){ echo $category_val['category_short_desc'];} ?>">
                                        </div>  
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">CATEGORY IMAGE</label>

                                            <div class="custom-file mb-3">
                                                    <input type="file" name="category_icon" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Category Icon</label>
                                                </div>
                                               <?php if(isset($category_val['category_icon'])){ ?>
                                                <img id="display_img" src="<?php echo base_url().'assets/uploads/category_icon/'.$category_val['category_icon']; ?>" class="img-responsive" width="100px" height="100px">
                                            </div>
                                            <?php }else{ ?>
                                                <img id="display_img" src="<?php echo base_url().'assets/uploads/banners/no-image.png'; ?>" class="img-responsive" width="100px" height="100px">
                                            <?php }?>

                                        </div>  
                                    </div>

                                    <!-- <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">SELECT STATE</label>
                                            <select name="state_id" class="form-control r-0 light s-12">

                                                <?php
                                                if(isset($state_list)){ foreach ($state_list as $state) { 
                                                        if (($state['id']) ==  ($category_val['state_id'])){
                                                    ?>
                                                        <option value="<?php echo $state['id']; ?>" selected><?php 
                                                            echo $state['state_name']; ?></option>
                                                    <?php } else{ ?>
                                                        <option value="<?php echo $state['id']; ?>"><?php 
                                                      echo $state['state_name']; ?></option>
                                                    <?php }

                                                     } 
                                                  }?>
                                            </select>           
                                        </div>  
                                    </div> -->
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
