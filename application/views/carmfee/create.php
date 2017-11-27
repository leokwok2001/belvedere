
<?php $mode_create = array('carmfee', 'create'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo $this->lang->line('carmfee_create'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>" accept-charset="utf-8" enctype="multipart/form-data">

  
                <div class="form-group">
                    <label class="control-label col-sm-2" for="fee"><?php echo $this->lang->line('carmfee_fee'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="fee" class="form-control" id="fee">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="eff_date"><?php echo $this->lang->line('carmfee_eff_date'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">          
                        <div class="input-group input-append date" id="datePicker1">
                            <input type="text" name="eff_date" class="form-control" id="eff_date">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" 
                                onCLick="this.form.function.value = 'back';this.form.submit()">
                            <span class="glyphicon glyphicon-step-backward"></span><?php echo $this->lang->line('button_black'); ?> </button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('button_add'); ?></button>
                    </div>
                </div> 
                <input type="hidden" name="function" value="create"/>
                <input type="hidden" name="item" value="carmfee"/>
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
                
                fee: {
                    validators: {
                        notEmpty: {
                            message: 'The fee is required and cannot be empty'
                        },
                        numeric: {
                            message: 'The fee must be numeric'
                        }
                    }
                }
            }
        })
    });
</script>