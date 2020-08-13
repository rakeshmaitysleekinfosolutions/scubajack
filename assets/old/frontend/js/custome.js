var base_url=$("#base_url").val();
var pageURL = $(location).attr("href");
/////////////////////////////////Add business////////////////////////////////

var index=pageURL.indexOf("add-business-user");
if(index!== -1)
{
    $('#category_id').change(function(){
      var category_id = $('#category_id').val();
      if(category_id != '')
      {
       $.ajax({
        url:base_url+"adminProductManagement/fetch_sub_category",
        method:"POST",
        data:{category_id:category_id},
        success:function(data)
        {
         $('#sub_cat_id').html(data);
        }
       });
      }
      else
      {
       $('#sub_cat_id').html('<option value="">Select Sub Category</option>');
      }
     });




    $('#state_id').change(function(){
      var state_id = $('#state_id').val();
          if(state_id != '')
          {
           $.ajax({
            url:base_url+"adminProductManagement/fetch_city",
            method:"POST",
            data:{state_id:state_id},
            success:function(data)
            {
             $('#city_id').html(data);
            }
           });
          }
          else
          {
           $('#city_id').html('<option value="">Select City</option>');
          }
         });
}


/////////////////////////////////Edit business////////////////////////////////

$(document).ready(function(){
    var index2=pageURL.indexOf("edit-business-user");
    if(index2!== -1)
    {
        stateChange();
        categoryChange();
    }
 
});

function stateChange()
{
    var state_id = $('#state_id').val();
    var temp_city_id = $('#temp_city_id').val();

      if(state_id != '')
      {
       $.ajax({
        url:base_url+"adminProductManagement/fetch_city_data",
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

            $('#city_id').html(content);
        }
       });
      }
      else
      {
       $('#city_id').html('<option value="">Select City</option>');
  }
}
       
function categoryChange()
{
    var category_id=$("#category_id").val();
    var temp_sub_category_id=$("#temp_sub_category_id").val();
    if(category_id != '')
      {
       $.ajax({
        url:base_url+"adminProductManagement/fetch_sub_category_data",
        method:"POST",
        data:{category_id:category_id},
        success:function(data)
        {
            var res=JSON.parse(data);
            var content='<option value="" >Select Sub Category</option>';

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


            $('#sub_cat_id').html(content);
        }
       });
      }
      else
      {
       $('#sub_cat_id').html('<option value="">Select Sub Category</option>');
      }
}



function deleteImage(bimg_id,bimg_name)
{
    var result = confirm("Want to delete?");

    if (result) {
    //Logic to delete the item
        $.ajax({
        url:base_url+"adminProductManagement/delete_product_image",
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





//////////Business image multiple/////////////////////

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


//////////////////////Sign Up///////////////////////////////////
var index3=pageURL.indexOf("user-signup");
if(index3!== -1)
{
    function stateChange(state_id){
        var state_name = $("#state_id option:selected").html();
        $("#cust_state").val(state_name);
      if(state_id != '')
      {
       $.ajax({
        url:base_url+"adminProductManagement/fetch_city",
        method:"POST",
        data:{state_id:state_id},
        success:function(data)
        {
         $('#city_id').html(data);
        }
       });
      }
      else
      {
       $('#city_id').html('<option value="">Select City</option>');
      }
    }

    function citychange(city_id)
    {
        var city_name = $("#city_id option:selected").html();
        $("#cust_city").val(city_name);
    }
}


function goToLogin()
{
    window.location.href=base_url+'user-login';
}

function passwordcheck()
{
    var pwd=$("#pwd").val();
    var confirmpwd=$("#confirmpwd").val();
    
    if(pwd!=confirmpwd)
    {
        $("#password-alert-danger").html('<div class="alert alert-danger alert-dismissable" role="alert" id="password-alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password Missmatch</div>');
        return false;;
    }
}