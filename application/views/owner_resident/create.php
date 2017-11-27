
<?php $mode_create = array('owner_resident', 'create'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo $this->lang->line('property_create'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>" accept-charset="utf-8" enctype="multipart/form-data">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="code"></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="hidden" name="code" class="form-control" id="code" value="<?php echo $code; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="propertycode"><?php echo $this->lang->line('property_propertycode'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="propertycode" class="form-control" id="propertycode">
                    </div>
                </div>
                
                <?php
                if (!empty($error)) {
                    echo "     <div class='alert alert-danger'> ";
                    echo "<strong>Danger!</strong>" . $error;
                    echo "  </div>    ";
                }
                ?>

                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" 
                                onCLick="this.form.function.value = 'back';this.form.submit()">
                            <span class="glyphicon glyphicon-step-backward"></span><?php echo $this->lang->line('button_black'); ?> </button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('button_add'); ?></button>
                    </div>
                </div> 

                <input type="hidden" name="function" value="create"/>
                <input type="hidden" name="item" value="property"/>
            </form>
        </div> 
    </div>
</div>





<script type="text/javascript">
    $(document).ready(function () {
        $('#datePicker1').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'months'
        });
        $('#addForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                code: {
                    validators: {
                        notEmpty: {
                            message: 'The code is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The code must be less than 255 characters long'
                        }
                    }
                },
                locations: {
                    validators: {
                        notEmpty: {
                            message: 'The locations no. is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The locations no. must be less than 255 characters long'
                        }
                    }
                }



            }
        })
    });
</script>