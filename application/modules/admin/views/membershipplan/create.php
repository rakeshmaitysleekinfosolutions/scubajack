<div class="content container-fluid">
    <form id="frm" action="<?php echo admin_url('membershipplan/store');?>" method="post">

        <div class="row">
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
        </div>
        <div class="row">
            <div class="col-sm-8">
                <h4 class="page-title">Add Membership Plan</h4>
            </div>
            <div class="col-sm-4 text-right m-b-30">
                <button type="submit" class="btn btn-primary rounded"><i class="fa fa-save"></i> Save</button>
                <a href="<?php echo $back;?>" class="btn btn-primary rounded"><i class="fa fa-back"></i> Back</a>
            </div>
        </div>
        <div class="card-box">
            <h3 class="card-title">Membership Plan</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="">
                            <div class="row">
                                <div class="form-group">
                                    <label class="control-label">Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" id="input-name" autocomplete="off" value="<?php echo $name;?>" required>
                                    <?php if($error_name) { ?>
                                        <div class="text-danger"><?php  echo $error_name;?></div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description <span class="text-danger"></span></label>
                                    <textarea class="form-control" type="text" name="description" id="input-description" autocomplete="off" ><?php echo $description;?></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Price <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="price" id="input-price" autocomplete="off" value="<?php echo $price;?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    var myLabel = myLabel || {};
    myLabel.baseUrl = '<?php echo base_url();?>';
</script>