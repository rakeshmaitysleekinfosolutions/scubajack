<div class="content container-fluid">
    <form id="frmSignUp" action="<?php echo admin_url('question/store');?>" method="post">

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
                <h4 class="page-title">Add Category</h4>
            </div>

            <div class="col-sm-4 text-right m-b-30">
                <button type="submit" class="btn btn-primary rounded"><i class="fa fa-save"></i> Save</button>
                <a href="<?php echo $back;?>" class="btn btn-primary rounded"><i class="fa fa-back"></i> Back</a>
            </div>
        </div>
        <div class="card-box">
            <h3 class="card-title">Category Details</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Quiz <span class="text-danger">*</span></label>
                                        <select name="quiz" class="select floating" id="input-payment-status" >
                                            <option value="">select option</option>
                                            <?php if(isset($quizzes)) {
                                                foreach ($quizzes as $quiz) {?>
                                                    <option value="<?php echo $quiz->id;?>"><?php echo $quiz->name;?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <?php if($error_quiz) { ?>
                                            <div class="text-danger"><?php echo $error_quiz;?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Question <span class="text-danger">*</span></label>
                                            <input value="<?php echo $name;?>" class="form-control" type="text" name="name" id="input-payment-firstname" autocomplete="off" >
                                            <?php if($error_name) { ?>
                                                <div class="text-danger"><?php  echo $error_name;?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="select floating" id="input-payment-status" >
                                            <option value="0" <?php echo ($status == 0) ? 'selected' : '';?>>Inactive</option>
                                            <option value="1" <?php echo ($status == 1) ? 'selected' : '';?>>Active</option>
                                        </select>

                                    </div>
                                </div>

                            </div>
                        </div>
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