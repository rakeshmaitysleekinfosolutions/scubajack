<!--  -->
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<div class="page has-sidebar-left  height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Business
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="<?php echo base_url('business-list');  ?>"><i class="icon icon-home2"></i>All Business</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="<?php echo base_url('add-business'); ?>" ><i class="icon icon-plus-circle"></i> Add New Business</a>
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



                    <form action="<?php echo base_url('edit-business/').$product_list[0]['product_id']; ?>" method="post" enctype='multipart/form-data'>
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">About Business</h5>
                
                                <div class="form-row">



                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">SELECT STATE</label>
                                            <select name="state_id" class="form-control r-0 light s-12" id="state_id" onchange="stateChange()">
                                                <option disabled="" selected="">Select State</option>
                                                <?php
                                                if (!empty($state_list)) {
                                                    foreach ($state_list as $state) { ?>
                                                    <option value="<?php echo $state['id']; ?>" <?php if($state['id']==$product_list[0]['state_id']) { echo "selected"; } ?> >
                                                    <?php  echo $state['state_name']; ?>
                                                    </option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>  
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">SELECT CITY</label>
                                            <select name="city_id" id="city_id" class="form-control r-0 light s-12">
                                                <option value="">Select City</option>
                                            </select>
                                        </div>  
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">SELECT CATEGORY</label>
                                            <select name="category_id" class="form-control r-0 light s-12" id="category_id" onchange="categoryChange()" required>
                                                <option>Select Category</option>
                                                <?php
                                                if (!empty($cat_list)) {
                                                    foreach ($cat_list as $cat) { ?>
                                                    <option value="<?php echo $cat['id']; ?>" <?php if($cat['id']==$product_list[0]['category_id']) { echo "selected"; } ?> >
                                                    <?php  echo $cat['category_name']; ?>
                                                    </option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>  
                                    </div>




                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">SELECT SUB CATEGORY</label>
                                            <select name="subcategory_id" id="sub_cat_id" class="form-control r-0 light s-12">
                                                <option value="">Select Sub Category</option>
                                            </select>
                                        </div>  
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">BUSINESS NAME</label>
                                            <input name="product_name" id="product_name" placeholder="Enter Business Name" value="<?= $product_list[0]['product_name'];?>" class="form-control r-0 light s-12 " type="text" required>
                                        </div>  
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">BUSINESS DESC</label>
                                            <textarea class="ckeditor" name="product_desc" id="product_desc" placeholder="Enter Desc" class="form-control r-0 light s-12 " required><?= $product_list[0]['product_desc'];?></textarea>
                                        </div>  
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">BUSINESS SHORT DESC</label>
                                            <input name="product_short_desc" id="product_short_desc" placeholder="Enter Short Desc" class="form-control r-0 light s-12 " value="<?= $product_list[0]['product_short_desc'];?>" type="text" required>
                                        </div>  
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">ADDRESS</label>
                                            <input name="product_address" id="product_address" placeholder="Enter Address" class="form-control r-0 light s-12 " type="text" value="<?= $product_list[0]['product_address'];?>" required>
                                        </div>  
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-6">PHONE NO</label>
                                            <input name="phone_no" id="phone_no" placeholder="Enter Phone no" class="form-control r-0 light s-12 " type="text" value="<?= $product_list[0]['phone_no'];?>" required>
                                        </div>  
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-6">WEBSITE LINK</label>
                                            <input name="website_link" id="website_link" placeholder="Enter Website Link" class="form-control r-0 light s-12 " type="text" value="<?= $product_list[0]['website_link'];?>" required>
                                        </div>  
                                    </div>

                                    <?php 
                                        $dayArray=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
                                        $opentimeArray=explode(",",$product_list[0]['open_time']);
                                        $closetimeArray=explode(",",$product_list[0]['close_time']);
                                        for($i=0;$i<count($dayArray);$i++)
                                        {
                                    ?>
                                    <div class="col-md-4">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-6">DAY</label>
                                            <input class="form-control r-0 light s-12 " type="text" value="<?= $dayArray[$i]?>" readonly>
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-6">OPEN TIME</label>
                                            <input name="open_time[]" id="open_time" placeholder="Enter Open Time" class="form-control r-0 light s-12 " type="text" value="<?php if(isset($opentimeArray[$i])) { echo  $opentimeArray[$i]; }?>" required>
                                        </div>  
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-6">CLOSE TIME</label>
                                            <input name="close_time[]" id="close_time" placeholder="Enter Close Time" class="form-control r-0 light s-12 " type="text" value="<?php if(isset($closetimeArray[$i])) { echo  $closetimeArray[$i]; }?>" required>
                                        </div>  
                                    </div>
                                    <?php }?>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-6">PREVIOUS BUSINESS IMAGE</label>
                                            <div class="field_wrapper_images">
                                                  <div>
                                                        <?php
                                                        if($image_list!="")
                                                        {
                                                            for($i=0; $i<count($image_list);$i++)
                                                            {
                                                        ?>
                                                            <div class="row image-div" id="prev_img_div_<?= $image_list[$i]['bimg_id'];?>">
                                                                <div class="col-md-6">
                                                                    <img src="<?= base_url('assets/uploads/business_image/').$image_list[$i]['bimg_name'];?>" width="100px" height="100px">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button type="button" class="btn btn-danger" onclick="deleteImage(<?= $image_list[$i]['bimg_id'];?>,'<?= $image_list[$i]['bimg_name'];?>')">Delete</button>
                                                                </div>
                                                                </div>
                                                        <?php } } else {?>
                                                        <h3>No image found</h3>
                                                      <?php } ?>
                                                  </div>
                                              </div>
                                        </div>  
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-6">ADD BUSINESS IMAGE</label>
                                            


                                            <div class="field_wrapper_image">
                                                  <div>
                                                      <input type="file" name="product_image[]"  class="form-control" value=""/>
                                                      <a href="javascript:void(0);" class="add_button_image" title="Add field">
                                                        <!-- <img src="http://demos.codexworld.com/add-remove-input-fields-dynamically-using-jquery/add-icon.png"/> -->
                                                        <img src="https://image.flaticon.com/icons/png/512/61/61733.png" width="30px" height="30px">

                                                    </a>
                                                  </div>
                                              </div>
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

<input type="hidden" id="temp_sub_category_id" value="<?= $product_list[0]['subcategory_id'];?>">
<input type="hidden" id="temp_city_id" value="<?= $product_list[0]['city_id'];?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
    categoryChange();
    stateChange();
    
    
 var maxField_image = 10; //Input fields increment limitation
    var addButton_image = $('.add_button_image'); //Add button selector
    var wrapper_image = $('.field_wrapper_image'); //Input field wrapper
    var fieldHTML_image = '<div><br><input type="file" name="product_image[]" class="form-control" value=""/><a href="javascript:void(0);" class="remove_button_image">&nbsp<img src="https://cdn.pixabay.com/photo/2013/07/12/17/00/remove-151678_960_720.png" width="30px" height="30px"/></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton_image).click(function(){
        //Check maximum number of input fields
        if(x < maxField_image){ 
            x++; //Increment field counter
            $(wrapper_image).append(fieldHTML_image); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper_image).on('click', '.remove_button_image', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });


 
});
function categoryChange()
{
    var category_id=$("#category_id").val();
    var temp_sub_category_id=$("#temp_sub_category_id").val();
    if(category_id != '')
      {
       $.ajax({
        url:"<?php echo base_url(); ?>adminProductManagement/fetch_sub_category_data",
        method:"POST",
        data:{category_id:category_id},
        success:function(data)
        {
            var res=JSON.parse(data);
            var content='';
            
            if(res.length>0)
            {
                for(var i=0;i<res.length;i++)
                {
                    if(temp_sub_category_id==res[i].id)
                    {
                        var txt="selected";
                    }
                    content+='<option value="'+res[i].id+'" '+txt+'>'+res[i].category_name+'</option>';
                }
            }
            else
            {
                content='<option value="">Select Sub Category</option>';
            }
            
            $('#sub_cat_id').html(content);
        }
       });
      }
      else
      {
       $('#sub_cat_id').html('<option value="">Select Sub Category</option>');
      }
}
    
function stateChange()
{
    var state_id = $('#state_id').val();
    var temp_city_id = $('#temp_city_id').val();
      if(state_id != '')
      {
       $.ajax({
        url:"<?php echo base_url(); ?>adminProductManagement/fetch_city_data",
        method:"POST",
        data:{state_id:state_id},
        success:function(data)
        {
            var res=JSON.parse(data);
            var content='';
            
            if(res.length>0)
            {
                for(var i=0;i<res.length;i++)
                {
                    if(temp_city_id==res[i].id)
                    {
                        var txt="selected";
                    }
                    content+='<option value="'+res[i].id+'" '+txt+'>'+res[i].state_name+'</option>';
                }
            }
            else
            {
                content='<option value="">Select City</option>';
            }
            $('#city_id').html(content);
        }
       });
      }
      else
      {
       $('#city_id').html('<option value="">Select City</option>');
  }
}
    
function deleteImage(bimg_id,bimg_name)
{
    var result = confirm("Want to delete?");

    if (result) {
    //Logic to delete the item
        $.ajax({
        url:"<?php echo base_url(); ?>adminProductManagement/delete_product_image",
        method:"POST",
        data:{bimg_id:bimg_id,bimg_name:bimg_name},
        success:function(data)
        {
            var res=JSON.parse(data);
            $('#prev_img_div_'+bimg_id).remove();
        }
       });
    }
     
}
</script>
