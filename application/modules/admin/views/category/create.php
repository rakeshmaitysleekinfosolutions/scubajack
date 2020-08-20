
<div class="content container-fluid">
    <form id="frmSignUp" action="<?php echo admin_url('category/update');?>" method="post">
        
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                    <h3 class="page-title">Category Details</h3>
                    <?php if($error_warning) { ?>
                        <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i><?php echo $error_warning;?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php } ?>
                    <?php if(hasMessage('message')) { ?>
                        <div class="alert alert-success alert-dismissible"><i class="fa fa-exclamation-circle"></i><?php echo getMessage('message');?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Name <span class="text-danger">*</span></label>
                                <input value="<?php echo $name;?>" class="form-control" type="text" name="name" id="input-payment-firstname" autocomplete="off" >
                                <?php if($error_name) { ?>
                                    <div class="text-danger"><?php  echo $error_name;?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Slug <span class="text-danger"></span></label>
                                <input value="<?php echo $slug;?>" class="form-control" type="text" name="lastname" id="input-payment-lastname" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Upload Image</label>
                                
                                <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb;?>" alt="" title="" data-placeholder="<?php echo $placeholder;?>"/></a> <input type="hidden" name="image" value="<?php echo $image;?>" id="input-image"/>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="select floating" id="input-payment-status" >
                                    <option value="">Select option</option>
                                    <option value="0" <?php echo ($status == 0) ? 'selected' : '';?>>Inactive</option>
                                    <option value="1" <?php echo ($status == 1) ? 'selected' : '';?>>Active</option>
                                </select>
                                <?php if($error_status) { ?>
                                    <div class="text-danger"><?php echo $error_status;?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <h3 class="page-sub-title">Category Description</h3>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="4" cols="5" class="form-control summernote" placeholder="Enter your message here"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta Title</label>
                            <input type="text" class="form-control" placeholder="Enter your message here">
                        </div>
                        <div class="form-group">
                            <label>Meta keyword</label>
                            <textarea rows="2" cols="5" class="form-control " placeholder="Enter your message here"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea rows="2" cols="5" class="form-control " placeholder="Enter your message here"></textarea>
                        </div>
                    <div class="row">
                            <div class="col-sm-12 m-t-20">
                                <button type="submit" name="submit" class="btn btn-primary">Save &amp; update</button>
                                <a href="javascript:history.go(-1)" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>


            </div>
        </div>
    </form>
</div>
<script>
    var myLabel = myLabel || {};
    myLabel.baseUrl = '<?php echo base_url();?>';
    myLabel.filemanager = '<?php echo admin_url('filemanager');?>';
</script>